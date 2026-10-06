<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

final class DeforestationStoryMedia
{
    private const VIDEO_EXTENSIONS = ['mp4', 'mov', 'webm'];

    private const SHARE_WIDTH = 1200;

    private const SHARE_HEIGHT = 630;

    // Originals at or under this size are served as they are.
    private const DISPLAY_MAX_BYTES = 400 * 1024;

    // ponytail: copies are made on first view; cap per request so a cold list page stays fast.
    // Remaining images fall back to the original and get their copy on a later view.
    private const GENERATIONS_PER_REQUEST = 4;

    public static function isVideo(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        $urlPath = parse_url($path, PHP_URL_PATH) ?: $path;
        $extension = strtolower(pathinfo($urlPath, PATHINFO_EXTENSION));

        return in_array($extension, self::VIDEO_EXTENSIONS, true);
    }

    // Videos can't be og:image, so a still frame is saved next to the video on submit.
    public static function posterPath(string $path): string
    {
        return preg_replace('/\.[^.\/]+$/', '', $path).'.poster.jpg';
    }

    // Needs ffmpeg on the server; without it the story keeps the default meta image.
    public static function makeVideoPoster(string $path): void
    {
        $disk = Storage::disk('public');
        $result = Process::timeout(60)->run([
            'ffmpeg', '-y', '-i', $disk->path($path), '-vf', 'thumbnail', '-frames:v', '1', $disk->path(self::posterPath($path)),
        ]);

        if ($result->failed()) {
            Log::warning('Video poster generation failed', ['path' => $path, 'error' => $result->errorOutput()]);
        }
    }

    // og:image URL for a story's hero media, or null when there is nothing usable.
    public static function metaImageUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return self::isVideo($path) ? null : $path;
        }

        if (self::isVideo($path)) {
            $path = self::posterPath($path);

            if (! Storage::disk('public')->exists($path)) {
                return null;
            }
        }

        return self::shareImageUrl($path);
    }

    /**
     * Small 1200x630 JPEG for og:image. Social crawlers (WhatsApp especially) ignore large
     * images and fall back to the favicon, so the hero image is cropped once and reused.
     */
    public static function shareImageUrl(string $path): string
    {
        return self::cachedJpeg($path, 'share/'.md5($path).'.jpg', function (int $width, int $height) {
            $scale = max(self::SHARE_WIDTH / $width, self::SHARE_HEIGHT / $height);
            $cropWidth = (int) round(self::SHARE_WIDTH / $scale);
            $cropHeight = (int) round(self::SHARE_HEIGHT / $scale);

            return [self::SHARE_WIDTH, self::SHARE_HEIGHT,
                intdiv($width - $cropWidth, 2), intdiv($height - $cropHeight, 2), $cropWidth, $cropHeight];
        }, limited: false);
    }

    /**
     * Uploaded story photos are often several MB. Pages show a copy scaled down to $maxWidth
     * (aspect ratio kept); the original stays untouched for the lightbox and downloads.
     */
    public static function displayImageUrl(string $path, int $maxWidth): string
    {
        $disk = Storage::disk('public');

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (! $disk->exists($path) || $disk->size($path) <= self::DISPLAY_MAX_BYTES) {
            return $disk->url($path);
        }

        return self::cachedJpeg($path, "resized/{$maxWidth}/".md5($path).'.jpg', function (int $width, int $height) use ($maxWidth) {
            $targetWidth = min($width, $maxWidth);

            return [$targetWidth, (int) round($height * $targetWidth / $width), 0, 0, $width, $height];
        });
    }

    /**
     * Returns the URL of $target, creating it from $path on first use. $geometry receives the
     * source size and returns [targetW, targetH, srcX, srcY, srcW, srcH]. Any failure falls
     * back to the original file.
     */
    private static function cachedJpeg(string $path, string $target, callable $geometry, bool $limited = true): string
    {
        $disk = Storage::disk('public');

        if ($disk->exists($target)) {
            return $disk->url($target);
        }

        $generated = request()->attributes->get('story_media_generated', 0);

        if ($limited && $generated >= self::GENERATIONS_PER_REQUEST) {
            return $disk->url($path);
        }

        try {
            $info = $disk->exists($path) ? getimagesize($disk->path($path)) : false;

            if (! $info || ! self::fitsInMemory($info[0], $info[1])) {
                return $disk->url($path);
            }

            $source = match ($info['mime']) {
                'image/jpeg' => imagecreatefromjpeg($disk->path($path)),
                'image/png' => imagecreatefrompng($disk->path($path)),
                'image/webp' => imagecreatefromwebp($disk->path($path)),
                default => false,
            };

            if (! $source) {
                return $disk->url($path);
            }

            [$targetWidth, $targetHeight, $srcX, $srcY, $srcWidth, $srcHeight] = $geometry($info[0], $info[1]);

            $canvas = imagecreatetruecolor($targetWidth, $targetHeight);
            imagefill($canvas, 0, 0, imagecolorallocate($canvas, 255, 255, 255));
            imagecopyresampled($canvas, $source, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $srcWidth, $srcHeight);

            $disk->makeDirectory(dirname($target));
            imageinterlace($canvas, true);
            imagejpeg($canvas, $disk->path($target), 82);
            imagedestroy($source);
            imagedestroy($canvas);
            request()->attributes->set('story_media_generated', $generated + 1);
        } catch (\Throwable) {
            return $disk->url($path);
        }

        return $disk->url($target);
    }

    // GD decodes the whole bitmap (~5 bytes/pixel); an out-of-memory fatal can't be caught, so check first.
    private static function fitsInMemory(int $width, int $height): bool
    {
        $limit = ini_parse_quantity(ini_get('memory_limit'));

        return $limit <= 0 || memory_get_usage() + $width * $height * 5 + 16 * 1024 * 1024 < $limit;
    }
}

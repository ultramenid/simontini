<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

final class DeforestationStoryMedia
{
    private const VIDEO_EXTENSIONS = ['mp4', 'mov', 'webm'];

    private const SHARE_WIDTH = 1200;

    private const SHARE_HEIGHT = 630;


    public static function isVideo(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        $urlPath = parse_url($path, PHP_URL_PATH) ?: $path;
        $extension = strtolower(pathinfo($urlPath, PATHINFO_EXTENSION));

        return in_array($extension, self::VIDEO_EXTENSIONS, true);
    }

    /**
     * Small 1200x630 JPEG for og:image. Social crawlers (WhatsApp especially) ignore large
     * images and fall back to the favicon, so the hero image is cropped once and reused.
     */
    public static function shareImageUrl(string $path): string
    {
        $disk = Storage::disk('public');
        $target = 'share/'.md5($path).'.jpg';

        if ($disk->exists($target)) {
            return $disk->url($target);
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

            [$width, $height] = $info;
            $scale = max(self::SHARE_WIDTH / $width, self::SHARE_HEIGHT / $height);
            $cropWidth = (int) round(self::SHARE_WIDTH / $scale);
            $cropHeight = (int) round(self::SHARE_HEIGHT / $scale);

            $canvas = imagecreatetruecolor(self::SHARE_WIDTH, self::SHARE_HEIGHT);
            imagefill($canvas, 0, 0, imagecolorallocate($canvas, 255, 255, 255));
            imagecopyresampled(
                $canvas, $source, 0, 0,
                intdiv($width - $cropWidth, 2), intdiv($height - $cropHeight, 2),
                self::SHARE_WIDTH, self::SHARE_HEIGHT, $cropWidth, $cropHeight,
            );

            $disk->makeDirectory('share');
            imagejpeg($canvas, $disk->path($target), 82);
            imagedestroy($source);
            imagedestroy($canvas);
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

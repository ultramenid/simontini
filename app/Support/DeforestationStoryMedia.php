<?php

namespace App\Support;

final class DeforestationStoryMedia
{
    private const VIDEO_EXTENSIONS = ['mp4', 'mov', 'webm'];

    public static function isVideo(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        $urlPath = parse_url($path, PHP_URL_PATH) ?: $path;
        $extension = strtolower(pathinfo($urlPath, PATHINFO_EXTENSION));

        return in_array($extension, self::VIDEO_EXTENSIONS, true);
    }
}

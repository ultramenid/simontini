<?php

namespace App\Support;

final class DeforestationStoryStopper
{
    public const STYLE = 'position:relative;top:1px;display:inline-block;flex:0 0 8px;width:8px;height:8px;margin-left:1px;border-radius:0;background:#d71920;vertical-align:middle;font-size:0;line-height:0;';

    public static function markup(): string
    {
        return '<span class="story-inline-stopper" data-story-inline-stopper="true" contenteditable="false" aria-hidden="true" style="'.self::STYLE.'">&nbsp;</span>';
    }

    public static function normalizeHtml(?string $html): string
    {
        if ($html === null || $html === '' || ! str_contains($html, 'story-inline-stopper')) {
            return (string) $html;
        }

        $normalized = preg_replace(
            '/<span\b[^>]*\bstory-inline-stopper\b[^>]*>.*?<\/span>/is',
            self::markup(),
            $html,
        );

        return is_string($normalized) ? $normalized : $html;
    }
}

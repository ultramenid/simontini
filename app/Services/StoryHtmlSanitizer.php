<?php

namespace App\Services;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

/**
 * Sanitizer HTML untuk konten artikel Deforestory (TinyMCE, caption, footer).
 * Allowlist lebar — hanya membuang script/style/event handler/scheme berbahaya;
 * jangan mengetatkan lebih dari output TinyMCE atau konten redaksional bisa rusak.
 *
 * ponytail: sanitize hanya di save-time; artikel lama tetap tepercaya,
 * simpan ulang artikel untuk membersihkan baris lama.
 */
class StoryHtmlSanitizer
{
    private HtmlSanitizer $sanitizer;

    public function __construct()
    {
        $config = (new HtmlSanitizerConfig)
            ->allowRelativeLinks()
            ->allowRelativeMedias()
            ->allowLinkSchemes(['http', 'https', 'mailto'])
            ->allowMediaSchemes(['http', 'https'])
            ->forceAttribute('a', 'rel', 'noopener noreferrer');

        foreach (self::ALLOWED_ELEMENTS as $element => $attributes) {
            $config = $config->allowElement($element, $attributes);
        }

        $this->sanitizer = new HtmlSanitizer($config);
    }

    private const ALLOWED_ELEMENTS = [
        'p' => ['class', 'style', 'id'],
        'br' => [],
        'hr' => [],
        'strong' => [],
        'em' => [],
        'b' => [],
        'i' => [],
        'u' => [],
        's' => [],
        'sup' => [],
        'sub' => [],
        'small' => [],
        'mark' => [],
        'code' => [],
        'pre' => [],
        'q' => ['cite'],
        'cite' => [],
        'abbr' => ['title'],
        'span' => ['class', 'style'],
        'div' => ['class', 'style'],
        'a' => ['href', 'title', 'target'],
        'ul' => ['class'],
        'ol' => ['class', 'start'],
        'li' => ['class'],
        'blockquote' => ['class', 'cite'],
        'h1' => ['class', 'style', 'id'],
        'h2' => ['class', 'style', 'id'],
        'h3' => ['class', 'style', 'id'],
        'h4' => ['class', 'style', 'id'],
        'h5' => ['class', 'style', 'id'],
        'h6' => ['class', 'style', 'id'],
        'figure' => ['class'],
        'figcaption' => ['class'],
        'img' => ['src', 'alt', 'title', 'width', 'height', 'loading', 'class', 'style'],
        'table' => ['class'],
        'thead' => [],
        'tbody' => [],
        'tfoot' => [],
        'tr' => [],
        'td' => ['colspan', 'rowspan', 'class', 'style'],
        'th' => ['colspan', 'rowspan', 'class', 'style', 'scope'],
        'iframe' => ['src', 'title', 'width', 'height', 'allow', 'allowfullscreen', 'loading', 'class'],
        'video' => ['src', 'controls', 'width', 'height', 'poster', 'class'],
        'source' => ['src', 'type'],
        'audio' => ['src', 'controls', 'class'],
    ];

    public function sanitize(string $html): string
    {
        return trim($this->sanitizer->sanitize($html));
    }
}
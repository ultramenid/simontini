<?php

namespace App\Services;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerAction;
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
    private HtmlSanitizerConfig $config;

    private HtmlSanitizer $sanitizer;

    public function __construct()
    {
        $config = (new HtmlSanitizerConfig)
            ->allowRelativeLinks()
            ->allowRelativeMedias()
            ->allowLinkSchemes(['http', 'https', 'mailto'])
            ->allowMediaSchemes(['http', 'https'])
            ->forceAttribute('a', 'rel', 'noopener noreferrer')
            // Default Symfony memotong input di 20KB — artikel panjang jadi terpotong.
            ->withMaxInputLength(-1)
            // Tag tak dikenal dibuang tapi isinya tetap (default Symfony: isi ikut hilang).
            ->defaultAction(HtmlSanitizerAction::Block);

        foreach (self::ALLOWED_ELEMENTS as $element => $attributes) {
            $config = $config->allowElement($element, $attributes);
        }

        foreach (self::GLOBAL_ATTRIBUTES as $attribute) {
            $config = $config->allowAttribute($attribute, '*');
        }

        $this->config = $config;
        $this->sanitizer = new HtmlSanitizer($config);
    }

    // Berlaku di semua elemen; dipakai widget editor (before/after, galeri
    // lightbox, visualisasi data, stopper). data-* lain diizinkan saat sanitize().
    private const GLOBAL_ATTRIBUTES = [
        'class', 'style', 'id', 'title', 'lang', 'dir', 'role',
        'aria-label', 'aria-hidden', 'contenteditable', 'draggable',
        'data-before-after-after', 'data-before-after-caption', 'data-before-after-range',
        'data-figure-index', 'data-gallery', 'data-glightbox', 'data-reference-id',
        'data-story-before-after', 'data-story-data-visualization', 'data-story-gallery',
        'data-story-inline-stopper', 'data-story-lightbox-gallery', 'data-visualization-id',
    ];

    private const ALLOWED_ELEMENTS = [
        'p' => [],
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
        'abbr' => [],
        'span' => [],
        'div' => [],
        'section' => [],
        'article' => [],
        'header' => [],
        'footer' => [],
        'aside' => [],
        'nav' => [],
        'main' => [],
        'a' => ['href', 'target'],
        'ul' => [],
        'ol' => ['start', 'type'],
        'li' => [],
        'blockquote' => ['cite'],
        'h1' => [],
        'h2' => [],
        'h3' => [],
        'h4' => [],
        'h5' => [],
        'h6' => [],
        'figure' => [],
        'figcaption' => [],
        'img' => ['src', 'alt', 'width', 'height', 'loading'],
        'table' => [],
        'caption' => [],
        'colgroup' => ['span'],
        'col' => ['span'],
        'thead' => [],
        'tbody' => [],
        'tfoot' => [],
        'tr' => [],
        'td' => ['colspan', 'rowspan'],
        'th' => ['colspan', 'rowspan', 'scope'],
        'iframe' => ['src', 'width', 'height', 'allow', 'allowfullscreen', 'loading', 'frameborder', 'scrolling', 'referrerpolicy'],
        'video' => ['src', 'controls', 'width', 'height', 'poster'],
        'source' => ['src', 'type'],
        'audio' => ['src', 'controls'],
        'input' => ['type', 'min', 'max', 'step', 'value'],
    ];

    public function sanitize(string $html): string
    {
        // Symfony menganggap script/style dsb. elemen <head>, jadi dropElement() tidak
        // berlaku di body dan Block akan membocorkan isinya sebagai teks. Buang utuh di sini;
        // Tag tanpa penutup dibuang sampai akhir, sama seperti perilaku browser.
        // Sisa yang lolos regex tetap di-Block dan di-escape oleh sanitizer.
        $html = preg_replace('#<(script|style|noscript|template|title)\b[^>]*>.*?(?:</\1\s*>|$)#is', '', $html) ?? '';

        // Symfony tidak punya wildcard data-*; izinkan nama data-* yang muncul di input.
        // data-* tidak dieksekusi browser, jadi aman untuk HTML custom.
        preg_match_all('/\bdata-[a-z0-9_.:-]+/i', $html, $matches);
        $dataAttributes = array_diff(array_unique(array_map('strtolower', $matches[0])), self::GLOBAL_ATTRIBUTES);

        $sanitizer = $this->sanitizer;
        if ($dataAttributes !== []) {
            $config = $this->config;
            foreach ($dataAttributes as $attribute) {
                $config = $config->allowAttribute($attribute, '*');
            }
            $sanitizer = new HtmlSanitizer($config);
        }

        return trim($sanitizer->sanitize($html));
    }
}
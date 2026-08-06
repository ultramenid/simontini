<?php

namespace App\Services;

use Illuminate\Support\Str;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class CommentHtmlSanitizer
{
    private HtmlSanitizer $sanitizer;

    public function __construct()
    {
        $config = (new HtmlSanitizerConfig)
            ->allowElement('p')
            ->allowElement('br')
            ->allowElement('strong')
            ->allowElement('em')
            ->allowElement('ul')
            ->allowElement('ol')
            ->allowElement('li')
            ->allowElement('a', ['href'])
            ->allowLinkSchemes(['http', 'https'])
            ->forceAttribute('a', 'target', '_blank')
            ->forceAttribute('a', 'rel', 'nofollow noopener noreferrer');

        $this->sanitizer = new HtmlSanitizer($config);
    }

    public function sanitize(string $content): string
    {
        // Komentar lama berbentuk teks/Markdown tetap dapat ditampilkan.
        if ($content === strip_tags($content)) {
            $content = Str::markdown($content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]);
        }

        return trim($this->sanitizer->sanitize($content));
    }

    public function plainText(string $sanitizedHtml): string
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($sanitizedHtml))) ?? '');
    }
}

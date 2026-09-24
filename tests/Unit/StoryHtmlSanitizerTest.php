<?php

use App\Services\StoryHtmlSanitizer;

uses(Tests\TestCase::class);

it('keeps custom layout html, styles and editor widget attributes', function () {
    $html = '<section class="hero" style="padding:40px"><div id="intro" style="display:grid">'
        .'<p>Teks <a class="glightbox2" data-gallery="g1" href="/x" style="color:#fff">link</a> <strong style="color:red">tebal</strong></p>'
        .'<figure class="story-before-after-figure" contenteditable="false"><div class="story-before-after" data-story-before-after="" style="--before-after-position:50%">'
        .'<input class="story-before-after-range" data-before-after-range="" type="range" min="0" max="100" value="50" aria-label="Geser"></div></figure>'
        .'<ul style="list-style:none"><li style="margin:0">item</li></ul></div></section>';

    $out = app(StoryHtmlSanitizer::class)->sanitize($html);

    expect($out)
        ->toContain('<section class="hero" style="padding:40px">')
        ->toContain('<div id="intro" style="display:grid">')
        ->toContain('class="glightbox2"')
        ->toContain('data-gallery="g1"')
        ->toContain('<strong style="color:red">')
        ->toContain('data-story-before-after')
        ->toContain('<input class="story-before-after-range" data-before-after-range')
        ->toContain('type="range"')
        ->toContain('<li style="margin:0">');
});

it('does not truncate long articles', function () {
    $html = str_repeat('<p>'.str_repeat('x', 100).'</p>', 300);

    expect(app(StoryHtmlSanitizer::class)->sanitize($html))->toBe($html);
});

it('still strips scripts, styles, event handlers and javascript links', function () {
    $out = app(StoryHtmlSanitizer::class)->sanitize(
        '<script>alert(1)</script><style>p{}</style><p onclick="alert(1)">a</p><a href="javascript:alert(1)">c</a><svg><script>alert(2)</script></svg>'
    );

    expect($out)
        ->not->toContain('alert')
        ->not->toContain('p{}')
        ->not->toContain('onclick')
        ->toContain('<p>a</p>')
        ->toContain('c');
});

it('keeps the content of unknown tags and arbitrary data attributes', function () {
    $out = app(StoryHtmlSanitizer::class)->sanitize(
        '<custom-card data-x="1"><p data-anim="fade-up" data-delay="200">isi kartu</p></custom-card>'
    );

    expect($out)->toBe('<p data-anim="fade-up" data-delay="200">isi kartu</p>');
});

<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

uses(DatabaseTransactions::class);

function seoStory(array $overrides = []): object
{
    $id = DB::table('deforestory')->insertGetId([
        'title_id' => 'Cerita SEO', 'title_en' => 'SEO Story', 'desrkirpsi_id' => 'Deskripsi', 'desrkirpsi_en' => 'Description', 'slug' => 'cerita-seo-'.uniqid(),
        'date' => '2026-04-23', 'content_id' => '<p>Isi</p>', 'content_en' => '<p>Body</p>',
        'status' => 'draft', 'created_at' => now(), 'updated_at' => now(), ...$overrides,
    ]);

    return DB::table('deforestory')->find($id);
}

function jsonLdBlocks(string $html): array
{
    preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $matches);

    return array_map(fn ($json) => json_decode($json, true, flags: JSON_THROW_ON_ERROR), $matches[1]);
}

it('returns 404 for unknown top-level paths instead of the homepage', function () {
    $this->get('/llms-missing-xyz')->assertNotFound();
    $this->get('/jp')->assertNotFound();
    $this->get('/en')->assertOk();
});

it('renders language, canonical, hreflang and a single h1 on main pages', function (string $path, string $lang) {
    $html = $this->get($path.'?utm_source=test')->assertOk()->getContent();

    expect($html)
        ->toContain('<html lang="'.$lang.'">')
        ->toContain('<link rel="canonical" href="'.url($path).'">')
        ->toContain('hreflang="id"')->toContain('hreflang="en"')->toContain('hreflang="x-default"')
        ->toContain('<meta name="twitter:site" content="@AURIGA_ID">')
        ->not->toContain('assets/logo.png" />')
        ->and(substr_count($html, '<h1'))->toBe(1);
})->with([
    ['/id', 'id'],
    ['/en', 'en'],
    ['/id/insight', 'id'],
    ['/en/download', 'en'],
    ['/id/mapndata', 'id'],
]);

it('describes the site and datasets with structured data', function () {
    $types = collect(jsonLdBlocks($this->get('/id')->getContent()))->pluck('@type');
    expect($types->all())->toContain('WebSite', 'Organization');

    expect(jsonLdBlocks($this->get('/en/download')->getContent())[0])
        ->toMatchArray(['@type' => 'Dataset', 'isAccessibleForFree' => true]);
});

it('links STADI report translations and marks them as articles', function () {
    $html = $this->get('/jp/status-of-deforestation-in-indonesia-2024')->assertOk()->getContent();

    expect($html)
        ->toContain('<html lang="ja">')
        ->toContain('<link rel="alternate" hreflang="id" href="'.url('/id/status-deforestasi-indonesia-2024').'">')
        ->toContain('<link rel="alternate" hreflang="ja" href="'.url('/jp/status-of-deforestation-in-indonesia-2024').'">')
        ->and(substr_count($html, '<h1'))->toBe(1)
        ->and(jsonLdBlocks($html)[0])->toMatchArray(['@type' => 'Article', 'inLanguage' => 'ja']);
});

it('keeps the draft STADI 2025 copy out of the index', function () {
    $this->get('/id/stadi2025')->assertOk()->assertSee('<meta name="robots" content="noindex, follow">', false);
});

it('lists pages, reports and open published stories in the sitemap', function () {
    DB::table('deforestory')->delete();
    $open = seoStory(['status' => 'publish', 'updated_at' => '2026-05-01 10:00:00']);
    $locked = seoStory(['status' => 'publish', 'is_locked' => true]);
    $draft = seoStory();

    $xml = $this->get('/sitemap.xml')->assertOk()->getContent();

    expect($xml)
        ->toContain('<loc>'.url('/id/deforestory').'</loc>')
        ->toContain('<loc>'.url('/en/status-of-deforestation-in-indonesia-2025').'</loc>')
        ->toContain(route('deforestation.show', ['locale' => 'en', 'id' => $open->id, 'slug' => $open->slug]))
        ->toContain('2026-05-01T10:00:00')
        ->not->toContain('/'.$locked->id.'/'.$locked->slug)
        ->not->toContain('/'.$draft->id.'/'.$draft->slug);
});

it('lets crawlers fetch uploaded images', function () {
    expect(file_get_contents(public_path('robots.txt')))->not->toContain('Disallow: /storage');
});

it('prints chart data as a table on chart pages and under charts in stories', function () {
    $chartId = DB::table('data_visualizations')->insertGetId([
        'title' => 'Deforestasi Bulanan', 'provider' => 'internal', 'chart_type' => 'column', 'embed_url' => '', 'is_active' => true,
        'chart_data' => json_encode(['columns' => ['Bulan', 'Hektare'], 'rows' => [['Jan', '1701'], ['Feb', '357']], 'bottom_text' => 'Sumber: Simontini']),
        'created_at' => now(), 'updated_at' => now(),
    ]);

    $this->get(route('data-visualizations.show', $chartId))
        ->assertOk()
        ->assertSee('<th scope="row">Jan</th>', false)
        ->assertSee('<td>1701</td>', false)
        ->assertSee('<meta name="description" content="Deforestasi Bulanan. Hektare: Jan 1701, Feb 357.">', false)
        ->assertSee('<link rel="canonical"', false);

    $this->get(route('data-visualizations.embed', $chartId))->assertOk()->assertSee('<td>357</td>', false);

    $story = seoStory([
        'status' => 'publish',
        'date' => '2026-04-23',
        'content_id' => '<figure class="story-data-visualization"><iframe src="https://simontini.id/embed/data-visualizations/'.$chartId.'"></iframe></figure>',
    ]);

    $this->get(route('deforestation.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]))
        ->assertOk()
        ->assertSee('</figure><details class="chart-data story-chart-data">', false)
        ->assertSee('Lihat data grafik')
        ->assertSee('<td>1701</td>', false)
        ->assertSee('<time datetime="2026-04-23">23 April 2026</time>', false);
});

it('serves a scaled-down copy of large story photos and keeps small ones as they are', function () {
    Storage::fake('public', ['url' => 'https://simontini.id/storage']);
    $noise = imagecreatetruecolor(3000, 2000);
    for ($i = 0; $i < 20000; $i++) {
        imagesetpixel($noise, random_int(0, 2999), random_int(0, 1999), random_int(0, 0xFFFFFF));
    }
    ob_start();
    imagejpeg($noise, null, 100);
    Storage::disk('public')->put('deforestory/id/big.jpg', ob_get_clean());
    Storage::disk('public')->put('deforestory/id/small.jpg', 'tiny');

    $url = \App\Support\DeforestationStoryMedia::displayImageUrl('deforestory/id/big.jpg', 800);
    $copy = 'resized/800/'.md5('deforestory/id/big.jpg').'.jpg';

    expect($url)->toBe('https://simontini.id/storage/'.$copy)
        ->and(array_slice(getimagesize(Storage::disk('public')->path($copy)), 0, 2))->toBe([800, 533])
        ->and(\App\Support\DeforestationStoryMedia::displayImageUrl('deforestory/id/small.jpg', 800))
        ->toBe('https://simontini.id/storage/deforestory/id/small.jpg');
});

it('builds llms.txt from published stories on each request', function () {
    DB::table('deforestory')->delete();
    $story = seoStory(['status' => 'publish', 'title_id' => 'Hutan & Sawit', 'desrkirpsi_en' => "Line one\n<b>bold</b>"]);
    seoStory(['title_id' => 'Draft rahasia']);

    $this->get('/llms.txt')
        ->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('- [Hutan & Sawit]('.route('deforestation.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]).')', false)
        ->assertSee('Line one bold', false)
        ->assertDontSee('Draft rahasia');
});

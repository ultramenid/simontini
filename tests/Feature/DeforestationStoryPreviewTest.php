<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

uses(DatabaseTransactions::class);

it('renders the localized footer on public and preview articles and hides empty footers', function () {
    $story = createDeforestationStory(['status' => 'publish', 'footer_id' => '<p><strong>PENULIS</strong> Footer ID</p>', 'footer_en' => '<p><em>AUTHOR</em> Footer EN</p>']);
    foreach (['id' => 'Footer ID', 'en' => 'Footer EN'] as $locale => $text) {
        $parameters = ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug];
        $this->get(route('deforestation.show', $parameters))->assertOk()->assertSee('data-story-footer', false)->assertSee($text);
        $this->get(URL::temporarySignedRoute('deforestation.preview.show', now()->addHour(), $parameters))->assertOk()->assertSee($text);
    }
    DB::table('deforestory')->where('id', $story->id)->update(['footer_id' => '<p>&nbsp;</p>']);
    $this->get(route('deforestation.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]))->assertOk()->assertDontSee('data-story-footer', false);
});

it('persists independent metadata click switches and renders plain labels when disabled', function () {
    DB::table('deforestory_display_settings')->updateOrInsert(['id' => 1], ['category_clickable' => true, 'region_clickable' => true]);
    createDeforestationStory(['status' => 'publish', 'category_id' => 'Kategori toggle', 'category_en' => 'Toggle category', 'region_id' => 'Daerah toggle', 'region_en' => 'Toggle region']);
    $cms = \Livewire\Livewire::test(\App\Livewire\DeforestoryIndex::class)
        ->call('toggleMetadataLink', 'category')->assertSet('categoryClickable', false);
    foreach (['id', 'en'] as $locale) {
        $this->get(route('deforestation.index', ['locale' => $locale]))->assertOk()
            ->assertDontSee('data-category-link', false)->assertSee('data-region-link', false);
    }
    $cms->call('toggleMetadataLink', 'region')->assertSet('regionClickable', false);
    \Livewire\Livewire::test(\App\Livewire\DeforestoryIndex::class)->assertSet('categoryClickable', false)->assertSet('regionClickable', false);
    $this->get(route('deforestation.index', ['locale' => 'id', 'category' => 'unmatched', 'region' => 'unmatched']))
        ->assertOk()->assertSee('Kategori toggle')->assertSee('Daerah toggle')
        ->assertDontSee('data-category-link', false)->assertDontSee('data-region-link', false);
    $this->get(URL::temporarySignedRoute('deforestation.preview.index', now()->addHour(), ['locale' => 'en']))
        ->assertOk()->assertSee('Toggle category')->assertDontSee('data-category-link', false)->assertDontSee('data-region-link', false);
    $cms->call('toggleMetadataLink', 'category')->call('toggleMetadataLink', 'region');
    $this->get(route('deforestation.index', ['locale' => 'id']))->assertSee('data-category-link', false)->assertSee('data-region-link', false);
});

function createDeforestationStory(array $overrides = []): object
{
    $values = [
        'external_id' => null,
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Cerita Hutan Indonesia',
        'title_en' => 'Indonesia Forest Story',
        'slug' => 'cerita-hutan-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi cerita Indonesia.',
        'desrkirpsi_en' => 'English story description.',
        'date' => '2026-08-03',
        'content_id' => '<p>Konten cerita Indonesia.</p>',
        'content_en' => '<p>English story content.</p>',
        'status' => 'draft',
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $id = DB::table('deforestory')->insertGetId([...$values, ...$overrides]);

    return DB::table('deforestory')->find($id);
}

function temporaryDeforestationPreviewUrl(string $routeName, array $parameters): string
{
    return URL::temporarySignedRoute($routeName, now()->addHour(), $parameters);
}

function setGlobalDeforestationPreviewPassword(string $password): void
{
    DB::table('deforestory_preview_settings')->updateOrInsert(
        ['id' => 1],
        ['password_hash' => Hash::make($password), 'updated_at' => now()],
    );
}

it('only displays published stories on the public list', function () {
    $draft = createDeforestationStory(['title_id' => 'Cerita Draft']);
    $published = createDeforestationStory(['title_id' => 'Cerita Published', 'status' => 'publish']);

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee($published->title_id)
        ->assertDontSee($draft->title_id);
});

it('renders the requested Indonesian Deforestory introduction', function () {
    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee('Cerita ringkas kasus-kasus deforestasi Indonesia.')
        ->assertSee('Mengkombinasi analisis data sekunder dengan pengamatan lapangan oleh Auriga Nusantara dan atau mitra.')
        ->assertSee('Kasus-kasus yang tampil di laman ini terbuka untuk ditindaklanjuti dengan laporan investigasi yang akan ditampilkan tersendiri di tempat terpisah.')
        ->assertSee('Demi terhentinya deforestasi.')
        ->assertDontSee('Setiap artikel membuka ruang interaksi dengan pembaca')
        ->assertDontSee('Data dalam Simontini bersifat terbuka');

    $this->get(route('deforestation.index', ['locale' => 'en']))
        ->assertOk()
        ->assertSee('Simontini data is open and publicly accessible');
});

it('marks the deforestory navigation as active on list and detail pages', function () {
    $story = createDeforestationStory(['status' => 'publish']);
    $activeNavigation = '/class="py-2 hover:border-b hover:border-simontini\s+border-b border-simontini\s*">\s*<a[^>]*>DEFORESTORY<\/a>/';

    $listResponse = $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk();

    expect($listResponse->getContent())->toMatch($activeNavigation);

    $detailResponse = $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))->assertOk();

    expect($detailResponse->getContent())->toMatch($activeNavigation);
});

it('keeps the mobile navigation above story media while scrolling', function () {
    $mobileNavigation = file_get_contents(resource_path('views/partials/topbarMobile.blade.php'));

    expect($mobileNavigation)
        ->toContain('sticky top-0 isolate z-[1000] bg-simontini');
});

it('paginates the public story list twelve per page and keeps filters in page links', function () {
    DB::table('deforestory')->delete();

    collect(range(1, 13))->each(fn (int $number) => createDeforestationStory([
        'title_id' => sprintf('Cerita Halaman %02d', $number),
        'category_id' => 'Sawit',
        'date' => sprintf('2030-01-%02d', $number),
        'status' => 'publish',
    ]));

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee('Cerita Halaman 13')
        ->assertSee('Cerita Halaman 02')
        ->assertDontSee('Cerita Halaman 01')
        ->assertSee('Halaman 1 dari 2')
        ->assertDontSee('data-page-previous', false)
        ->assertSee(route('deforestation.index', ['locale' => 'id', 'page' => 2]), false);

    $this->get(route('deforestation.index', ['locale' => 'id', 'page' => 2]))
        ->assertOk()
        ->assertSee('Cerita Halaman 01')
        ->assertDontSee('Cerita Halaman 02')
        ->assertDontSee('data-page-next', false);

    $this->get(route('deforestation.index', ['locale' => 'id', 'category' => 'Sawit']))
        ->assertSee(e(route('deforestation.index', ['locale' => 'id', 'category' => 'Sawit', 'page' => 2])), false);
});

it('shows month headings only when there are at least two stories', function () {
    DB::table('deforestory')->delete();
    $monthHeading = 'class="mb-8 text-2xl font-bold';

    createDeforestationStory(['status' => 'publish']);
    $this->get(route('deforestation.index', ['locale' => 'id']))->assertDontSee($monthHeading, false);

    createDeforestationStory(['status' => 'publish']);
    $this->get(route('deforestation.index', ['locale' => 'id']))->assertSee($monthHeading, false);
});

it('signs page links on the preview story list', function () {
    DB::table('deforestory')->delete();

    collect(range(1, 13))->each(fn (int $number) => createDeforestationStory([
        'title_id' => sprintf('Preview Halaman %02d', $number),
        'date' => sprintf('2030-01-%02d', $number),
    ]));

    $html = $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.index', ['locale' => 'id']))
        ->assertOk()
        ->getContent();

    preg_match('/data-page-next href="([^"]+)"/', $html, $match);

    $this->get(html_entity_decode($match[1]))
        ->assertOk()
        ->assertSee('Preview Halaman 01');
});

it('returns 404 when a draft story is opened publicly', function () {
    $story = createDeforestationStory();

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertNotFound();
});

it('renders social sharing metadata from the published story', function () {
    $story = createDeforestationStory([
        'title_id' => 'Judul Metadata Deforestory',
        'desrkirpsi_id' => 'Deskripsi metadata untuk pratinjau tautan.',
        'status' => 'publish',
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('<meta property="og:title" content="Judul Metadata Deforestory">', false)
        ->assertSee('<meta property="og:description" content="Deskripsi metadata untuk pratinjau tautan.">', false)
        ->assertSee('<meta property="og:image"', false)
        ->assertSee('<meta name="twitter:card" content="summary_large_image">', false);
});

it('renders hreflang alternates and Article structured data for search engines', function () {
    DB::table('deforestory')->delete();
    $story = createDeforestationStory(['title_id' => 'Judul </script> SEO', 'status' => 'publish']);
    $show = fn (string $locale) => route('deforestation.show', ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug]);

    $html = $this->get($show('id'))
        ->assertOk()
        ->assertSee('<link rel="alternate" hreflang="en" href="'.$show('en').'">', false)
        ->assertSee('<link rel="alternate" hreflang="x-default" href="'.$show('id').'">', false)
        ->assertSee('<meta name="twitter:site" content="@AURIGA_ID">', false)
        ->getContent();

    preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $html, $jsonLd);
    expect(json_decode($jsonLd[1], true))
        ->toMatchArray(['@type' => 'Article', 'headline' => 'Judul </script> SEO', 'mainEntityOfPage' => $show('id')]);

    $this->get(route('deforestation.index', ['locale' => 'en', 'category' => 'Sawit']))
        ->assertOk()
        ->assertSee('<link rel="canonical" href="'.route('deforestation.index', ['locale' => 'en']).'">', false)
        ->assertSee('<link rel="alternate" hreflang="id" href="'.route('deforestation.index', ['locale' => 'id']).'">', false);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]))
        ->assertOk()
        ->assertDontSee('application/ld+json', false)
        ->assertDontSee('hreflang', false);
});

it('shares a small 1200x630 crop of the story image on detail and list pages', function () {
    Storage::fake('public', ['url' => 'https://simontini.id/storage']);
    $canvas = imagecreatetruecolor(3000, 2000);
    ob_start();
    imagejpeg($canvas);
    Storage::disk('public')->put('deforestory/id/hero.jpg', ob_get_clean());

    DB::table('deforestory')->delete();
    $story = createDeforestationStory(['image_id' => 'deforestory/id/hero.jpg', 'status' => 'publish']);
    $shareImage = 'share/'.md5('deforestory/id/hero.jpg').'.jpg';
    $metaTag = '<meta property="og:image" content="https://simontini.id/storage/'.$shareImage.'">';

    $this->get(route('deforestation.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]))
        ->assertOk()
        ->assertSee($metaTag, false);

    expect(array_slice(getimagesize(Storage::disk('public')->path($shareImage)), 0, 2))->toBe([1200, 630]);

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee($metaTag, false);
});

it('shares a random published story image on the list page, skipping drafts and videos', function () {
    DB::table('deforestory')->delete();
    createDeforestationStory(['image_id' => 'https://cdn.test/draft.jpg']);
    createDeforestationStory(['image_id' => 'https://cdn.test/clip.mp4', 'status' => 'publish']);
    $fallback = '<meta property="og:image" content="'.asset('assets/meta-image-2025.jpg').'">';

    $this->get(route('deforestation.index', ['locale' => 'id']))->assertOk()->assertSee($fallback, false);

    createDeforestationStory(['image_id' => 'https://cdn.test/a.jpg', 'status' => 'publish']);
    createDeforestationStory(['image_id' => 'https://cdn.test/b.jpg', 'status' => 'publish']);
    $seen = collect(range(1, 20))->map(function () {
        preg_match('/og:image" content="([^"]+)"/', $this->get(route('deforestation.index', ['locale' => 'id', 'category' => 'none']))->getContent(), $match);

        return $match[1];
    })->unique()->sort()->values()->all();

    expect($seen)->toBe(['https://cdn.test/a.jpg', 'https://cdn.test/b.jpg']);
});

it('renders the hero image description below the detail image', function () {
    $story = createDeforestationStory([
        'image_id' => 'deforestory/id/hero.jpg',
        'image_description_id' => '<p><strong>Foto udara hutan</strong>, sumber Auriga Nusantara.</p>',
        'image_description_en' => 'Aerial forest photo, source Auriga Nusantara.',
        'status' => 'publish',
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('text-[12px] font-normal leading-[1.6] text-black', false)
        ->assertSee('<p><strong>Foto udara hutan</strong>, sumber Auriga Nusantara.</p>', false);

    $this->get(route('deforestation.show', [
        'locale' => 'en',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Aerial forest photo, source Auriga Nusantara.')
        ->assertDontSee('Foto udara hutan, sumber Auriga Nusantara.');
});

it('renders an uploaded video as media on story list and detail pages', function () {
    $story = createDeforestationStory([
        'image_id' => 'deforestory/id/hero-video.mp4',
        'status' => 'publish',
    ]);

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee('<video', false)
        ->assertSee('hero-video.mp4', false);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('<video', false)
        ->assertDontSee('controls', false)
        ->assertSee('autoplay', false)
        ->assertSee('loop', false)
        ->assertSee('muted', false)
        ->assertSee('playsinline', false)
        ->assertSee('hero-video.mp4', false);
});

it('renders custom GLightbox image markup in the story detail', function () {
    $imageUrl = 'https://stg.simontini.id/storage/references/lightbox-story.jpg';
    $story = createDeforestationStory([
        'content_type' => 'custom',
        'content_id' => '<div style="width: 100%; margin: 24px 0;"><a class="glightbox2 gbox" href="'.$imageUrl.'" data-glightbox="description: Dokumentasi deforestasi"><img src="'.$imageUrl.'" alt="Dokumentasi deforestasi" style="cursor: zoom-in;"></a></div>',
        'status' => 'publish',
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('class="glightbox2 gbox"', false)
        ->assertSee('data-glightbox="description: Dokumentasi deforestasi"', false)
        ->assertSee('href="'.$imageUrl.'"', false);
});

it('rejects preview URLs without a valid signature', function () {
    $this->get(route('deforestation.preview.index', ['locale' => 'id']))
        ->assertForbidden();
});

it('allows guests to open a signed preview link', function () {
    $story = createDeforestationStory(['title_id' => 'Draft Tautan Aman']);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Draft Tautan Aman')
        ->assertSee('MODE PREVIEW');
});

it('asks for the article password before opening a locked preview', function () {
    setGlobalDeforestationPreviewPassword('password-global');
    $story = createDeforestationStory([
        'title_id' => 'Draft Preview Terkunci',
        'content_id' => '<p>Konten yang harus dilindungi.</p>',
        'is_locked' => true,
    ]);
    $previewUrl = temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]);

    $this->get($previewUrl)
        ->assertOk()
        ->assertSee('Password artikel')
        ->assertSee('Draft Preview Terkunci')
        ->assertSee('x-on:submit.prevent="startLoader()"', false)
        ->assertSee('data-deforestory-hero-loader', false)
        ->assertSee('deforestory-hero-loader-title', false)
        ->assertSee('assets/loader/loader.jpg', false)
        ->assertSee('bg-white', false)
        ->assertDontSee('deforestory-loader-letter')
        ->assertDontSee("letters: Array(11).fill('A')")
        ->assertDontSee('Membuka artikel...')
        ->assertDontSee('Konten yang harus dilindungi.');
});

it('unlocks every locked article after the global password is accepted', function () {
    setGlobalDeforestationPreviewPassword('password-global');
    $firstStory = createDeforestationStory([
        'title_id' => 'Artikel Pertama',
        'content_id' => '<p>Isi artikel pertama.</p>',
        'is_locked' => true,
    ]);
    $secondStory = createDeforestationStory([
        'title_id' => 'Artikel Kedua',
        'content_id' => '<p>Isi artikel kedua.</p>',
        'is_locked' => true,
    ]);
    $firstPreviewUrl = temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $firstStory->id,
        'slug' => $firstStory->slug,
    ]);
    $firstUnlockUrl = temporaryDeforestationPreviewUrl('deforestation.preview.unlock', [
        'locale' => 'id',
        'id' => $firstStory->id,
        'slug' => $firstStory->slug,
    ]);
    $secondPreviewUrl = temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $secondStory->id,
        'slug' => $secondStory->slug,
    ]);

    $this->from($firstPreviewUrl)
        ->post($firstUnlockUrl, ['password' => 'password-global'])
        ->assertRedirect();

    $this->get($firstPreviewUrl)
        ->assertOk()
        ->assertSee('Isi artikel pertama.');

    $this->get($secondPreviewUrl)
        ->assertOk()
        ->assertSee('Isi artikel kedua.')
        ->assertDontSee('Password artikel');
});

it('rejects an incorrect preview password', function () {
    setGlobalDeforestationPreviewPassword('password-benar');
    $story = createDeforestationStory([
        'is_locked' => true,
    ]);
    $previewUrl = temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]);
    $unlockUrl = temporaryDeforestationPreviewUrl('deforestation.preview.unlock', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]);

    $this->from($previewUrl)
        ->post($unlockUrl, ['password' => 'password-salah'])
        ->assertRedirect($previewUrl)
        ->assertSessionHasErrors('password');

    $this->get($previewUrl)
        ->assertOk()
        ->assertSee('Password artikel')
        ->assertDontSee('Konten cerita Indonesia.');
});

it('revokes an unlocked preview session when the global password changes', function () {
    setGlobalDeforestationPreviewPassword('password-lama');
    $story = createDeforestationStory([
        'content_id' => '<p>Konten sesi global.</p>',
        'is_locked' => true,
    ]);
    $previewUrl = temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]);
    $unlockUrl = temporaryDeforestationPreviewUrl('deforestation.preview.unlock', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]);

    $this->from($previewUrl)
        ->post($unlockUrl, ['password' => 'password-lama'])
        ->assertRedirect();

    $this->get($previewUrl)->assertSee('Konten sesi global.');

    setGlobalDeforestationPreviewPassword('password-baru');

    $this->get($previewUrl)
        ->assertSee('Password artikel')
        ->assertDontSee('Konten sesi global.');
});

it('still asks a logged in CMS user for the password on a locked preview', function () {
    setGlobalDeforestationPreviewPassword('password-global');
    $story = createDeforestationStory([
        'content_id' => '<p>Konten untuk pengguna CMS.</p>',
        'is_locked' => true,
    ]);

    $this->withSession(['id' => 1])
        ->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', [
            'locale' => 'id',
            'id' => $story->id,
            'slug' => $story->slug,
        ]))
        ->assertOk()
        ->assertSee('Password artikel')
        ->assertSee('data-deforestory-hero-loader', false)
        ->assertDontSee('Konten untuk pengguna CMS.');
});

it('only renders the reload animation for a locked preview article', function () {
    $story = createDeforestationStory([
        'is_locked' => false,
    ]);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertDontSee('data-deforestory-reload-loader', false)
        ->assertDontSee('data-deforestory-hero-loader', false)
        ->assertDontSee('Memuat artikel terkunci...');
});

it('uses the public loader image for locked preview text and background', function () {
    $story = createDeforestationStory([
        'image_id' => 'deforestory/id/hero-preview.jpg',
        'is_locked' => true,
    ]);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('data-deforestory-loader-image="loader.jpg"', false)
        ->assertSee('assets/loader/loader.jpg', false)
        ->assertSee('deforestoryLoaderReveal()', false)
        ->assertSee('deforestory-loader-bg', false)
        ->assertSee('bg-white', false)
        ->assertDontSee('hero-preview.jpg')
        ->assertDontSee('<canvas', false)
        ->assertDontSee('deforestoryHeroTextFill()');
});

it('requires a password for locked stories on the public page as well', function () {
    setGlobalDeforestationPreviewPassword('password-global');
    $story = createDeforestationStory([
        'status' => 'publish',
        'is_locked' => true,
        'content_id' => '<p>Konten publik terkunci.</p>',
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Password artikel')
        ->assertDontSee('Konten publik terkunci.');
});

it('shows a lock badge on the preview index for locked Deforestory items only', function () {
    $locked = createDeforestationStory([
        'title_id' => 'Cerita Terkunci',
        'is_locked' => true,
    ]);
    $open = createDeforestationStory([
        'title_id' => 'Cerita Terbuka',
        'is_locked' => false,
    ]);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee('Cerita Terkunci')
        ->assertSee('Cerita Terbuka')
        ->assertSee('data-preview-lock', false)
        ->assertSee('Preview dikunci');

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertDontSee('data-preview-lock', false)
        ->assertDontSee('Preview dikunci');

    expect($locked->is_locked)->toBeTruthy();
    expect($open->is_locked)->toBeFalsy();
});

it('allows a signed preview index to display drafts with noindex metadata', function () {
    $story = createDeforestationStory([
        'title_id' => 'Draft Rahasia',
        'is_locked' => true,
    ]);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee('Draft Rahasia')
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
        ->assertSee('MODE PREVIEW')
        ->assertDontSee('Dilindungi password');

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('MODE PREVIEW')
        ->assertDontSee('Kembali ke CMS');
});

it('rejects a signed preview URL after it is changed', function () {
    $url = temporaryDeforestationPreviewUrl('deforestation.preview.index', ['locale' => 'en']);

    $this->get($url.'&changed=1')->assertForbidden();
});

it('redirects an incorrect preview slug to the canonical preview URL', function () {
    $story = createDeforestationStory();
    $expiresAt = now()->addHour();

    $this->get(URL::temporarySignedRoute(
        'deforestation.preview.show',
        $expiresAt,
        [
            'locale' => 'id',
            'id' => $story->id,
            'slug' => 'slug-salah',
        ],
    ))
        ->assertRedirect(URL::temporarySignedRoute(
            'deforestation.preview.show',
            $expiresAt,
            [
                'locale' => 'id',
                'id' => $story->id,
                'slug' => $story->slug,
            ],
        ));
});

it('does not include preview URLs in the sitemap', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertDontSee('/preview/');
});

it('does not expose draft stories through the public API', function () {
    $draft = createDeforestationStory(['title_id' => 'Draft API Rahasia']);
    $published = createDeforestationStory(['title_id' => 'Published API', 'status' => 'publish']);

    $this->getJson('/api/deforestory?per_page=100')
        ->assertOk()
        ->assertJsonMissing(['id' => $draft->id])
        ->assertJsonFragment(['id' => $published->id]);
});

it('filters story categories and regions through separately signed preview links', function () {
    $story = createDeforestationStory(['title_id' => 'Filter Target', 'category_id' => 'Kategori Unik', 'region_id' => 'Daerah Unik']);
    $sameCategory = createDeforestationStory(['title_id' => 'Filter Category Match', 'category_id' => 'Kategori Unik', 'region_id' => 'Daerah Lain']);
    $sameRegion = createDeforestationStory(['title_id' => 'Filter Region Match', 'category_id' => 'Kategori Lain', 'region_id' => 'Daerah Unik']);
    $response = $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.index', ['locale' => 'id']))->assertOk();
    $document = new DOMDocument();
    @$document->loadHTML($response->getContent());
    $xpath = new DOMXPath($document);
    $categoryUrl = $xpath->query('//a[@data-category-link and normalize-space(.)="Kategori Unik"]')->item(0)->getAttribute('href');
    $regionUrl = $xpath->query('//a[@data-region-link and normalize-space(.)="Daerah Unik"]')->item(0)->getAttribute('href');
    expect($xpath->query('//a//a')->length)->toBe(0);
    $this->get($categoryUrl)->assertOk()->assertSee($story->title_id)->assertSee($sameCategory->title_id)->assertDontSee($sameRegion->title_id)->assertSee('Lihat semua artikel');
    $this->get($regionUrl)->assertOk()->assertSee($story->title_id)->assertSee($sameRegion->title_id)->assertDontSee($sameCategory->title_id);
    $this->get(str_replace('Kategori%20Unik', 'Kategori%20Lain', $categoryUrl))->assertForbidden();
});

it('filters public localized metadata while excluding drafts', function () {
    $published = createDeforestationStory(['title_en' => 'Public Filter Match', 'status' => 'publish', 'category_en' => 'Unique Category', 'region_en' => 'Unique Region']);
    $draft = createDeforestationStory(['title_en' => 'Hidden Filter Draft', 'category_en' => 'Unique Category', 'region_en' => 'Unique Region']);
    $other = createDeforestationStory(['title_en' => 'Other Filter Story', 'status' => 'publish', 'category_en' => 'Other Category', 'region_en' => 'Other Region']);
    foreach (['category' => 'Unique Category', 'region' => 'Unique Region'] as $field => $value) {
        $this->get(route('deforestation.index', ['locale' => 'en', $field => $value]))->assertOk()->assertSee($published->title_en)->assertDontSee($draft->title_en)->assertDontSee($other->title_en);
    }
    $this->get(route('deforestation.index', ['locale' => 'en', 'category' => 'Unknown category']))->assertOk()->assertSee('No deforestation stories are available yet.');
});

it('hides the story date in the byline when the global date setting is off', function () {
    DB::table('deforestory_display_settings')->updateOrInsert(['id' => 1], ['date_visible' => true]);
    $story = createDeforestationStory(['status' => 'publish', 'date' => '2025-03-14']);
    $url = route('deforestation.show', ['locale' => 'id', 'id' => $story->id, 'slug' => $story->slug]);

    $this->get($url)->assertOk()->assertSee('<time datetime="2025-03-14">', false);

    \Livewire\Livewire::test(\App\Livewire\DeforestoryIndex::class)
        ->assertSet('dateVisible', true)
        ->call('toggleMetadataLink', 'date')
        ->assertSet('dateVisible', false);

    $this->get($url)->assertOk()->assertDontSee('<time datetime="2025-03-14">', false)->assertSee('Auriga Nusantara');
    \Livewire\Livewire::test(\App\Livewire\DeforestoryIndex::class)->assertSet('dateVisible', false)->assertSee('Settings');
});

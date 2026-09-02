<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

uses(DatabaseTransactions::class);

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

it('displays every published story without pagination', function () {
    $stories = collect(range(1, 13))->map(fn (int $number) => createDeforestationStory([
        'title_id' => "Cerita Tanpa Pagination {$number}",
        'status' => 'publish',
    ]));

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee($stories->first()->title_id)
        ->assertSee($stories->last()->title_id)
        ->assertDontSee('Showing 1 to');
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

it('renders the hero image description below the detail image', function () {
    $story = createDeforestationStory([
        'image_id' => 'deforestory/id/hero.jpg',
        'image_description_id' => 'Foto udara hutan, sumber Auriga Nusantara.',
        'image_description_en' => 'Aerial forest photo, source Auriga Nusantara.',
        'status' => 'publish',
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Foto udara hutan, sumber Auriga Nusantara.');

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

it('allows a logged in CMS user to open a locked preview without a password', function () {
    $story = createDeforestationStory([
        'content_id' => '<p>Konten untuk pengguna CMS.</p>',
        'is_locked' => true,
    ]);

    $this->withSession(['id' => 123])
        ->get(temporaryDeforestationPreviewUrl('deforestation.preview.show', [
            'locale' => 'id',
            'id' => $story->id,
            'slug' => $story->slug,
        ]))
        ->assertOk()
        ->assertSee('Konten untuk pengguna CMS.')
        ->assertDontSee('Password artikel');
});

it('keeps published stories publicly accessible when only their preview is locked', function () {
    $story = createDeforestationStory([
        'status' => 'publish',
        'is_locked' => true,
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Konten cerita Indonesia.')
        ->assertDontSee('Password artikel');
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

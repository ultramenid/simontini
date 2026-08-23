<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
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

it('only displays published stories on the public list', function () {
    $draft = createDeforestationStory(['title_id' => 'Cerita Draft']);
    $published = createDeforestationStory(['title_id' => 'Cerita Published', 'status' => 'publish']);

    $this->get(route('deforestation.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee($published->title_id)
        ->assertDontSee($draft->title_id);
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

it('allows a signed preview index to display drafts with noindex metadata', function () {
    $story = createDeforestationStory(['title_id' => 'Draft Rahasia']);

    $this->get(temporaryDeforestationPreviewUrl('deforestation.preview.index', ['locale' => 'id']))
        ->assertOk()
        ->assertSee('Draft Rahasia')
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
        ->assertSee('MODE PREVIEW');

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

<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

function createCmsPreviewUser(int $roleId): int
{
    return DB::table('users')->insertGetId([
        'name' => 'Preview User',
        'email' => 'preview-'.uniqid().'@simontini.test',
        'password' => Hash::make('password'),
        'role_id' => $roleId,
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

it('only displays published stories on the public list', function () {
    $draft = createDeforestationStory(['title_id' => 'Cerita Draft']);
    $published = createDeforestationStory(['title_id' => 'Cerita Published', 'status' => 'publish']);

    $this->get('/id/deforestation-story')
        ->assertOk()
        ->assertSee($published->title_id)
        ->assertDontSee($draft->title_id);
});

it('returns 404 when a draft story is opened publicly', function () {
    $story = createDeforestationStory();

    $this->get("/id/deforestation-story/{$story->id}/{$story->slug}")
        ->assertNotFound();
});

it('redirects guests from preview to login', function () {
    $this->get('/id/preview/deforestation-story')
        ->assertRedirect(route('login'));
});

it('forbids a logged-in user without an admin or editor role', function () {
    $userId = createCmsPreviewUser(2);

    $this->withSession(['id' => $userId, 'role_id' => 2])
        ->get('/id/preview/deforestation-story')
        ->assertForbidden();
});

it('allows admins to preview drafts with noindex metadata', function () {
    $userId = createCmsPreviewUser(1);
    $story = createDeforestationStory(['title_id' => 'Draft Rahasia']);

    $this->withSession(['id' => $userId, 'role_id' => 1])
        ->get('/id/preview/deforestation-story')
        ->assertOk()
        ->assertSee('Draft Rahasia')
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
        ->assertSee('MODE PREVIEW');

    $this->withSession(['id' => $userId, 'role_id' => 1])
        ->get("/id/preview/deforestation-story/{$story->id}/{$story->slug}")
        ->assertOk()
        ->assertSee('Kembali ke CMS');
});

it('allows editors to open preview pages', function () {
    $userId = createCmsPreviewUser(3);

    $this->withSession(['id' => $userId, 'role_id' => 3])
        ->get('/en/preview/deforestation-story')
        ->assertOk();
});

it('redirects an incorrect preview slug to the canonical preview URL', function () {
    $userId = createCmsPreviewUser(1);
    $story = createDeforestationStory();

    $this->withSession(['id' => $userId, 'role_id' => 1])
        ->get("/id/preview/deforestation-story/{$story->id}/slug-salah")
        ->assertRedirect(route('deforestation.preview.show', [
            'locale' => 'id',
            'id' => $story->id,
            'slug' => $story->slug,
        ]));
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

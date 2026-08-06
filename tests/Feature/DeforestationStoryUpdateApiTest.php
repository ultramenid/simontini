<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

uses(DatabaseTransactions::class);

function createStoryForUpdateApi(array $overrides = []): object
{
    $values = [
        'external_id' => null,
        'uuid' => (string) Str::uuid(),
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Story Timeline',
        'title_en' => 'Timeline Story',
        'slug' => 'story-timeline-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi story timeline.',
        'desrkirpsi_en' => 'Timeline story description.',
        'date' => '2026-08-03',
        'content_id' => '<p>Konten utama.</p>',
        'content_en' => '<p>Main content.</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $id = DB::table('deforestory')->insertGetId([...$values, ...$overrides]);

    return DB::table('deforestory')->find($id);
}

function storyUpdatePayload(array $overrides = []): array
{
    return [
        'external_id' => 'remote-update-'.uniqid(),
        'title_id' => 'Pemantauan Terbaru Bentang Alam',
        'title_en' => 'Latest Landscape Monitoring',
        'description_id' => 'Perubahan bentang alam masih berlangsung.',
        'description_en' => 'Landscape changes are still ongoing.',
        'image_url' => 'https://example.org/images/forest.jpg',
        'target_url' => 'https://example.org/news/forest-update',
        'published_at' => '2026-08-03',
        'status' => 'on',
        ...$overrides,
    ];
}

it('rejects story update sync without a valid API token', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);

    $this->postJson('/api/deforestory/'.Str::uuid().'/updates/sync', [])
        ->assertUnauthorized();
});

it('requires the Deforestory UUID in the endpoint URL', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);

    $this->withToken('story-update-token')
        ->postJson('/api/deforestory/updates/sync', storyUpdatePayload())
        ->assertNotFound();
});

it('rejects an unknown Deforestory UUID', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);

    $this->withToken('story-update-token')
        ->postJson('/api/deforestory/'.Str::uuid().'/updates/sync', storyUpdatePayload())
        ->assertUnprocessable()
        ->assertJsonValidationErrors('deforestory_uuid');
});

it('creates and updates a story timeline item using a bearer token', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);
    $story = createStoryForUpdateApi();
    $payload = storyUpdatePayload(['external_id' => 'remote-fixed-123']);
    $endpoint = "/api/deforestory/{$story->uuid}/updates/sync";

    $this->withToken('story-update-token')
        ->postJson($endpoint, $payload)
        ->assertCreated()
        ->assertJsonPath('action', 'created')
        ->assertJsonPath('deforestory_uuid', $story->uuid)
        ->assertJsonPath('data.deforestory_id', $story->id);

    $this->withToken('story-update-token')
        ->postJson($endpoint, [
            ...$payload,
            'title_id' => 'Judul Pembaruan Diubah',
        ])
        ->assertOk()
        ->assertJsonPath('action', 'updated')
        ->assertJsonPath('data.title_id', 'Judul Pembaruan Diubah');

    expect(DB::table('deforestation_story_updates')->where('external_id', 'remote-fixed-123')->count())
        ->toBe(1);
});

it('shows active timeline updates but hides inactive updates publicly', function () {
    $story = createStoryForUpdateApi();
    $base = storyUpdatePayload();

    DB::table('deforestation_story_updates')->insert([
        'deforestory_id' => $story->id,
        'external_id' => 'visible-'.uniqid(),
        'title_id' => 'Pembaruan Terlihat',
        'title_en' => 'Visible Update',
        'description_id' => $base['description_id'],
        'description_en' => $base['description_en'],
        'image_url' => $base['image_url'],
        'target_url' => $base['target_url'],
        'published_at' => $base['published_at'],
        'status' => 'on',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('deforestation_story_updates')->insert([
        'deforestory_id' => $story->id,
        'external_id' => 'hidden-'.uniqid(),
        'title_id' => 'Pembaruan Disembunyikan',
        'title_en' => 'Hidden Update',
        'description_id' => $base['description_id'],
        'description_en' => $base['description_en'],
        'image_url' => $base['image_url'],
        'target_url' => $base['target_url'],
        'published_at' => $base['published_at'],
        'status' => 'off',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->get("/id/deforestory/{$story->id}/{$story->slug}")
        ->assertOk()
        ->assertSee('Pembaruan Terlihat')
        ->assertDontSee('Pembaruan Disembunyikan')
        ->assertSee('update-timeline-item', false);
});

it('does not provide a public GET endpoint for raw timeline data', function () {
    $this->getJson('/api/deforestory/'.Str::uuid().'/updates/sync')
        ->assertMethodNotAllowed();
});

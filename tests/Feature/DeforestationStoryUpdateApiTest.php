<?php

use App\Jobs\SendDeforestationStoryUpdateEmail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
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
        'title_id' => 'Pemantauan Terbaru Bentang Alam',
        'title_en' => 'Latest Landscape Monitoring',
        'description_id' => 'Perubahan bentang alam masih berlangsung.',
        'description_en' => 'Landscape changes are still ongoing.',
        'target_url_id' => 'https://example.org/id/news/forest-update',
        'target_url_en' => 'https://example.org/en/news/forest-update',
        'published_at' => '2026-08-03',
        ...$overrides,
    ];
}

it('rejects story update sync without a valid API token', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);

    $this->postJson('/api/deforestory/sync/'.Str::uuid(), [])
        ->assertUnauthorized();
});

it('requires a valid Deforestory UUID in the endpoint URL', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);

    $this->withToken('story-update-token')
        ->postJson('/api/deforestory/sync/not-a-uuid', storyUpdatePayload())
        ->assertNotFound();
});

it('rejects an unknown Deforestory UUID', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);

    $this->withToken('story-update-token')
        ->postJson('/api/deforestory/sync/'.Str::uuid(), storyUpdatePayload())
        ->assertUnprocessable()
        ->assertJsonValidationErrors('deforestory_uuid');
});

it('triggers subscriber emails without storing the Pasopati article', function () {
    Queue::fake();
    config(['services.deforestory.api_token' => 'story-update-token']);
    $story = createStoryForUpdateApi();
    $payload = storyUpdatePayload();
    $endpoint = "/api/deforestory/sync/{$story->uuid}";
    $updatesBefore = DB::table('deforestation_story_updates')->count();
    DB::table('deforestation_story_subscriptions')->insert([
        'deforestory_id' => $story->id,
        'name' => 'Subscriber API',
        'email' => 'subscriber-api-'.uniqid().'@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withToken('story-update-token')
        ->postJson($endpoint, $payload)
        ->assertAccepted()
        ->assertJsonPath('action', 'triggered')
        ->assertJsonPath('deforestory_uuid', $story->uuid)
        ->assertJsonMissingPath('data');

    expect(DB::table('deforestation_story_updates')->count())->toBe($updatesBefore);
    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class);
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
        'image_url' => 'https://example.org/images/visible.jpg',
        'target_url' => $base['target_url_id'],
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
        'image_url' => 'https://example.org/images/hidden.jpg',
        'target_url' => $base['target_url_id'],
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
    $this->getJson('/api/deforestory/sync/'.Str::uuid())
        ->assertMethodNotAllowed();
});

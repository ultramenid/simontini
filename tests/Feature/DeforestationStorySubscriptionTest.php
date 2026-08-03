<?php

use App\Jobs\SendDeforestationStoryUpdateEmail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

uses(DatabaseTransactions::class);

function createSubscribedStory(): object
{
    $id = DB::table('deforestory')->insertGetId([
        'external_id' => null,
        'image_id' => null,
        'image_en' => null,
        'title_id' => 'Story Berlangganan',
        'title_en' => 'Subscribed Story',
        'slug' => 'story-berlangganan-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-03',
        'content_id' => '<p>Konten</p>',
        'content_en' => '<p>Content</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return DB::table('deforestory')->find($id);
}

it('stores a subscription for a published story', function () {
    $story = createSubscribedStory();

    $this->postJson("/id/deforestation-story/{$story->id}/subscribe", [
        'name' => 'Pelanggan Simontini',
        'email' => 'subscriber@example.test',
    ])->assertCreated();

    $this->assertDatabaseHas('deforestation_story_subscriptions', [
        'deforestory_id' => $story->id,
        'email' => 'subscriber@example.test',
        'status' => 'active',
    ]);
});

it('queues one email when a new active story update arrives', function () {
    Queue::fake();
    config(['services.deforestory.api_token' => 'test-api-token']);

    $story = createSubscribedStory();
    $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
        'deforestory_id' => $story->id,
        'name' => 'Pelanggan Simontini',
        'email' => 'subscriber@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->withToken('test-api-token')->postJson('/api/deforestory/updates/sync', [
        'external_id' => 'update-'.uniqid(),
        'deforestory_id' => $story->id,
        'title_id' => 'Pembaruan Raja Ampat',
        'title_en' => 'Raja Ampat Update',
        'description_id' => 'Ada pembaruan terbaru.',
        'description_en' => 'A new update is available.',
        'image_url' => 'https://example.test/update.jpg',
        'target_url' => 'https://example.test/update',
        'published_at' => '2026-08-03',
        'status' => 'on',
    ]);

    $response->assertCreated()->assertJsonPath('queued_notifications', 1);
    $this->assertDatabaseHas('deforestation_story_update_notifications', [
        'subscription_id' => $subscriptionId,
        'status' => 'queued',
    ]);
    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, 1);
});

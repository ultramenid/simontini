<?php

use App\Jobs\SendDeforestationStoryUpdateEmail;
use App\Jobs\SendNewDeforestationStoryEmail;
use App\Services\DeforestationStoryNotificationDispatcher;
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

    $this->postJson(route('deforestation.subscribe', [
        'locale' => 'id',
        'id' => $story->id,
    ]), [
        'name' => 'Pelanggan Simontini',
        'email' => 'subscriber@example.test',
    ])->assertCreated();

    $this->assertDatabaseHas('deforestation_story_subscriptions', [
        'deforestory_id' => $story->id,
        'email' => 'subscriber@example.test',
        'status' => 'active',
    ]);
});

it('stores a global subscription from the deforestation story index', function () {
    $this->postJson(route('deforestation.subscribe.all', ['locale' => 'id']), [
        'name' => 'Subscriber Global',
        'email' => 'global-subscriber@example.test',
    ])->assertCreated();

    $this->assertDatabaseHas('deforestation_story_subscriptions', [
        'deforestory_id' => null,
        'email' => 'global-subscriber@example.test',
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
    $expectedNotifications = DB::table('deforestation_story_subscriptions')
        ->where('status', 'active')
        ->where(fn ($query) => $query->where('deforestory_id', $story->id)->orWhereNull('deforestory_id'))
        ->count();

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

    $response->assertCreated()->assertJsonPath('queued_notifications', $expectedNotifications);
    $this->assertDatabaseHas('deforestation_story_update_notifications', [
        'subscription_id' => $subscriptionId,
        'status' => 'queued',
    ]);
    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, $expectedNotifications);
});

it('also queues update emails for global subscribers', function () {
    Queue::fake();
    config(['services.deforestory.api_token' => 'test-api-token']);

    $story = createSubscribedStory();
    DB::table('deforestation_story_subscriptions')->insert([
        'deforestory_id' => null,
        'name' => 'Subscriber Global',
        'email' => 'global-update@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $expectedNotifications = DB::table('deforestation_story_subscriptions')
        ->whereNull('deforestory_id')
        ->where('status', 'active')
        ->count();

    $this->withToken('test-api-token')->postJson('/api/deforestory/updates/sync', [
        'external_id' => 'global-update-'.uniqid(),
        'deforestory_id' => $story->id,
        'title_id' => 'Pembaruan Global',
        'title_en' => 'Global Update',
        'description_id' => 'Pembaruan untuk seluruh subscriber.',
        'description_en' => 'An update for every subscriber.',
        'image_url' => 'https://example.test/global.jpg',
        'target_url' => 'https://example.test/global',
        'published_at' => '2026-08-04',
        'status' => 'on',
    ])->assertCreated()->assertJsonPath('queued_notifications', $expectedNotifications);

    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, $expectedNotifications);
});

it('queues an email for global subscribers when a new story is published', function () {
    Queue::fake();
    config(['services.deforestory.api_token' => 'test-api-token']);

    DB::table('deforestation_story_subscriptions')->insert([
        'deforestory_id' => null,
        'name' => 'Subscriber Story Baru',
        'email' => 'new-story@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $expectedNotifications = DB::table('deforestation_story_subscriptions')
        ->whereNull('deforestory_id')
        ->where('status', 'active')
        ->count();

    $this->withToken('test-api-token')->postJson('/api/deforestory', [
        'title_id' => 'Deforestory Baru',
        'title_en' => 'New Deforestory',
        'desrkirpsi_id' => 'Deskripsi story baru.',
        'desrkirpsi_en' => 'New story description.',
        'date' => '2026-08-04',
        'content_id' => '<p>Konten Indonesia.</p>',
        'content_en' => '<p>English content.</p>',
        'status' => 'publish',
    ])->assertCreated()->assertJsonPath('queued_notifications', $expectedNotifications);

    Queue::assertPushed(SendNewDeforestationStoryEmail::class, $expectedNotifications);
});

it('does not email subscribers when the same story is republished', function () {
    Queue::fake();

    DB::table('deforestation_story_subscriptions')->insert([
        'deforestory_id' => null,
        'name' => 'Subscriber Publish Pertama',
        'email' => 'first-publication@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $story = createSubscribedStory();
    $dispatcher = app(DeforestationStoryNotificationDispatcher::class);
    $firstQueued = $dispatcher->queueNewStory($story->id);

    DB::table('deforestory')->where('id', $story->id)->update(['status' => 'draft']);
    DB::table('deforestory')->where('id', $story->id)->update(['status' => 'publish']);
    $republishQueued = $dispatcher->queueNewStory($story->id);

    expect($firstQueued)->toBeGreaterThan(0)
        ->and($republishQueued)->toBe(0)
        ->and(DB::table('deforestory')->where('id', $story->id)->value('first_published_at'))
        ->not->toBeNull();
    Queue::assertPushed(SendNewDeforestationStoryEmail::class, $firstQueued);
});

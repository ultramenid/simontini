<?php

use App\Jobs\SendDeforestationStoryWebhook;
use App\Services\DeforestationStoryWebhookDispatcher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;

uses(DatabaseTransactions::class);

function createWebhookStory(string $status): int
{
    return DB::table('deforestory')->insertGetId([
        'uuid' => (string) Str::uuid(),
        'title_id' => 'Story webhook',
        'title_en' => 'Webhook story',
        'slug' => 'story-webhook',
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-06',
        'content_id' => 'Konten',
        'content_en' => 'Content',
        'status' => $status,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

it('queues an outbound webhook for a published story', function () {
    Queue::fake();
    config(['services.deforestory.webhook_url' => 'https://pasopati.test/api']);
    $storyId = createWebhookStory('publish');

    $queued = app(DeforestationStoryWebhookDispatcher::class)
        ->dispatch($storyId, 'created');

    expect($queued)->toBeTrue();
    Queue::assertPushed(SendDeforestationStoryWebhook::class, function ($job) use ($storyId) {
        return $job->payload['event'] === 'deforestory.created'
            && $job->payload['data']['id'] === $storyId
            && $job->payload['data']['status'] === 'publish';
    });
});

it('does not queue an outbound webhook for a draft story', function () {
    Queue::fake();
    config(['services.deforestory.webhook_url' => 'https://pasopati.test/api']);
    $storyId = createWebhookStory('draft');

    $queued = app(DeforestationStoryWebhookDispatcher::class)
        ->dispatch($storyId, 'created');

    expect($queued)->toBeFalse();
    Queue::assertNothingPushed();
});

it('queues an unpublished webhook when a published story becomes draft', function () {
    Queue::fake();
    config(['services.deforestory.webhook_url' => 'https://pasopati.test/api']);
    $storyId = createWebhookStory('draft');

    $queued = app(DeforestationStoryWebhookDispatcher::class)
        ->dispatch($storyId, 'unpublished');

    expect($queued)->toBeTrue();
    Queue::assertPushed(SendDeforestationStoryWebhook::class, function ($job) use ($storyId) {
        return $job->payload['event'] === 'deforestory.unpublished'
            && $job->payload['data']['id'] === $storyId
            && $job->payload['data']['status'] === 'draft';
    });
});

it('puts an updated card using its permanent UUID and bearer authentication', function () {
    $uuid = '0e932e55-c03e-4fa8-a794-d9761445635c';
    Http::fake(["https://pasopati.test/api/deforestory/cards/{$uuid}" => Http::response(['ok' => true])]);
    config([
        'services.deforestory.webhook_url' => 'https://pasopati.test/api',
        'services.deforestory.webhook_token' => 'webhook-secret',
    ]);
    $payload = [
        'event_id' => 'event-1',
        'event' => 'deforestory.updated',
        'occurred_at' => now()->toIso8601String(),
        'data' => [
            'id' => 10,
            'uuid' => $uuid,
            'slug' => 'story-test',
            'date' => '2026-08-06',
            'image_id' => 'https://simontini.test/storage/story.jpg',
            'title_id' => 'Story Test',
            'title_en' => 'Test Story',
            'desrkirpsi_id' => 'Deskripsi story',
            'desrkirpsi_en' => 'Story description',
            'status' => 'publish',
        ],
    ];

    (new SendDeforestationStoryWebhook($payload))->handle();

    Http::assertSent(function (Request $request) {
        return $request->method() === 'PUT'
            && $request->url() === 'https://pasopati.test/api/deforestory/cards/0e932e55-c03e-4fa8-a794-d9761445635c'
            && $request->hasHeader('Authorization', 'Bearer webhook-secret')
            && $request->hasHeader('X-Simontini-Event', 'deforestory.updated')
            && $request->hasHeader('X-Deforestory-Delivery', 'event-1')
            && filled($request->header('X-Simontini-Signature')[0] ?? null)
            && $request['cards'][0]['slug'] === 'story-test'
            && $request['cards'][0]['category'] === 'deforestory'
            && $request['cards'][0]['year'] === '2026'
            && $request['cards'][0]['image_id'] === 'https://simontini.test/storage/story.jpg'
            && $request['cards'][0]['uuid'] === '0e932e55-c03e-4fa8-a794-d9761445635c'
            && $request['cards'][0]['date'] === '2026-08-06'
            && $request['cards'][0]['status'] === 'publish'
            && $request['cards'][0]['title_id'] === 'Story Test';
    });
});

it('posts a newly published card to the cards collection', function () {
    Http::fake(['https://pasopati.test/api/deforestory/cards' => Http::response(['received' => true])]);
    config([
        'services.deforestory.webhook_url' => 'https://pasopati.test/api',
        'services.deforestory.webhook_token' => 'webhook-secret',
    ]);
    $payload = [
        'event_id' => 'event-2',
        'event' => 'deforestory.created',
        'occurred_at' => now()->toIso8601String(),
        'data' => [
            'id' => 11,
            'uuid' => 'aa6eeadd-8c93-4e5a-a626-a809f706cd9e',
            'slug' => 'story-baru',
            'date' => '2026-08-06',
            'image_id' => 'https://simontini.test/storage/story-baru.jpg',
            'image_en' => 'https://simontini.test/storage/story-new.jpg',
            'title_id' => 'Story Baru',
            'title_en' => 'New Story',
            'desrkirpsi_id' => 'Deskripsi baru',
            'desrkirpsi_en' => 'New description',
            'status' => 'publish',
        ],
    ];

    (new SendDeforestationStoryWebhook($payload))->handle();

    Http::assertSent(fn (Request $request) => $request->method() === 'POST'
        && $request->url() === 'https://pasopati.test/api/deforestory/cards'
        && $request['cards'][0]['uuid'] === 'aa6eeadd-8c93-4e5a-a626-a809f706cd9e'
        && $request['cards'][0]['slug'] === 'story-baru'
        && $request['cards'][0]['image_id'] === 'https://simontini.test/storage/story-baru.jpg'
        && $request['cards'][0]['image_en'] === 'https://simontini.test/storage/story-new.jpg'
        && $request['cards'][0]['date'] === '2026-08-06'
        && $request['cards'][0]['status'] === 'publish'
        && $request['cards'][0]['year'] === '2026');
});

it('puts draft status by UUID when a story is unpublished', function () {
    $uuid = '77153520-032c-463b-847e-40b7510c53d9';
    Http::fake(["https://pasopati.test/api/deforestory/cards/{$uuid}" => Http::response(['ok' => true])]);
    config(['services.deforestory.webhook_url' => 'https://pasopati.test/api']);

    (new SendDeforestationStoryWebhook([
        'event_id' => 'event-unpublished',
        'event' => 'deforestory.unpublished',
        'occurred_at' => now()->toIso8601String(),
        'data' => [
            'id' => 12,
            'uuid' => $uuid,
            'slug' => 'story-draft',
            'date' => '2026-08-06',
            'title_id' => 'Story Draft',
            'title_en' => 'Draft Story',
            'status' => 'draft',
        ],
    ]))->handle();

    Http::assertSent(fn (Request $request) => $request->method() === 'PUT'
        && $request->url() === "https://pasopati.test/api/deforestory/cards/{$uuid}"
        && $request->hasHeader('X-Simontini-Event', 'deforestory.unpublished')
        && $request['cards'][0]['uuid'] === $uuid
        && $request['cards'][0]['status'] === 'draft');
});

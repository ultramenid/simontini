<?php

use App\Jobs\SendDeforestationStoryUpdateEmail;
use App\Mail\DeforestationStoryUpdated;
use App\Services\DeforestationStoryUpdateNotifier;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
        'image_url' => 'https://example.org/images/forest-update.jpg',
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
    config(['cache.default' => 'array']);
    Cache::flush();
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
    $expectedNotifications = DB::table('deforestation_story_subscriptions')
        ->where('status', 'active')
        ->where(fn ($query) => $query
            ->where('deforestory_id', $story->id)
            ->orWhereNull('deforestory_id'))
        ->get(['email'])
        ->unique(fn (object $subscription): string => mb_strtolower(trim($subscription->email)))
        ->count();

    $this->withToken('story-update-token')
        ->postJson($endpoint, $payload)
        ->assertAccepted()
        ->assertJsonPath('action', 'queued')
        ->assertJsonPath('queue', 'pasopati-updates')
        ->assertJsonPath('queued_jobs', $expectedNotifications)
        ->assertJsonPath('subscriber_count', $expectedNotifications)
        ->assertJsonPath('deforestory_uuid', $story->uuid)
        ->assertJsonMissingPath('data');

    expect(DB::table('deforestation_story_updates')->count())->toBe($updatesBefore);
    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, function ($job) use ($story): bool {
        return $job->storyId === $story->id
            && $job->subscriptionId > 0
            && strlen($job->eventKey) === 64
            && $job->article['title_id'] === 'Pemantauan Terbaru Bentang Alam';
    });
});

it('does not queue the same Pasopati update payload twice', function () {
    Queue::fake();
    config([
        'cache.default' => 'array',
        'services.deforestory.api_token' => 'story-update-token',
    ]);
    Cache::flush();
    $story = createStoryForUpdateApi();
    $endpoint = "/api/deforestory/sync/{$story->uuid}";
    $payload = storyUpdatePayload();
    $expectedJobs = DB::table('deforestation_story_subscriptions')
        ->where('status', 'active')
        ->where(fn ($query) => $query
            ->where('deforestory_id', $story->id)
            ->orWhereNull('deforestory_id'))
        ->get(['email'])
        ->unique(fn (object $subscription): string => mb_strtolower(trim($subscription->email)))
        ->count();

    $this->withToken('story-update-token')->postJson($endpoint, $payload)
        ->assertAccepted()
        ->assertJsonPath('action', 'queued')
        ->assertJsonPath('queued_jobs', $expectedJobs);

    $this->withToken('story-update-token')->postJson($endpoint, $payload)
        ->assertAccepted()
        ->assertJsonPath('action', 'duplicate')
        ->assertJsonPath('queued_jobs', 0);

    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, $expectedJobs);
});

it('does not send the same update event twice when its job is retried', function () {
    Mail::fake();
    $story = createStoryForUpdateApi();
    $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
        'deforestory_id' => $story->id,
        'name' => 'Subscriber Idempotent',
        'email' => 'idempotent-'.uniqid().'@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $article = storyUpdatePayload();
    $eventKey = hash('sha256', $story->uuid.'|'.json_encode($article));
    $notifier = app(DeforestationStoryUpdateNotifier::class);

    (new SendDeforestationStoryUpdateEmail(
        $subscriptionId,
        $story->id,
        $eventKey,
        $article,
    ))->handle($notifier);

    (new SendDeforestationStoryUpdateEmail(
        $subscriptionId,
        $story->id,
        $eventKey,
        $article,
    ))->handle($notifier);

    Mail::assertSent(DeforestationStoryUpdated::class, 1);
    expect(DB::table('deforestation_email_deliveries')
        ->where('subscription_id', $subscriptionId)
        ->where('story_id', $story->id)
        ->where('event_key', $eventKey)
        ->where('status', 'sent')
        ->count())->toBe(1);
});

it('validates the optional update image as an HTTP URL', function () {
    config(['services.deforestory.api_token' => 'story-update-token']);
    $story = createStoryForUpdateApi();

    $this->withToken('story-update-token')
        ->postJson("/api/deforestory/sync/{$story->uuid}", storyUpdatePayload([
            'image_url' => 'bukan-url-gambar',
        ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors('image_url');
});

it('consumes Pasopati reports by Deforestory UUID on the detail page', function () {
    $story = createStoryForUpdateApi();
    config([
        'services.deforestory.webhook_url' => 'https://pasopati.test/api',
    ]);
    Http::fake([
        "https://pasopati.test/api/deforestory/by-uuid/laporan/{$story->uuid}" => Http::response([
            [
                'title_id' => 'Laporan Pasopati Terbaru',
                'title_en' => 'Latest Pasopati Report',
                'description_id' => '&lt;p&gt;Deskripsi laporan dari API.&lt;/p&gt;',
                'description_en' => '&amp;lt;p&amp;gt;Report description from API.&amp;lt;/p&amp;gt;',
                'image_url' => 'https://pasopati.test/images/report.jpg',
                'target_url_id' => 'https://pasopati.test/id/laporan/latest',
                'target_url_en' => 'https://pasopati.test/en/report/latest',
                'published_at' => '2026-08-07',
            ],
        ]),
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Laporan Pasopati Terbaru')
        ->assertSee('Deskripsi laporan dari API.')
        ->assertDontSee('&lt;p&gt;Deskripsi laporan dari API.&lt;/p&gt;', false)
        ->assertDontSee('&amp;lt;p&amp;gt;', false)
        ->assertSee('https://pasopati.test/id/laporan/latest', false);

    Http::assertSent(fn ($request) => $request->method() === 'GET'
        && $request->url() === "https://pasopati.test/api/deforestory/by-uuid/laporan/{$story->uuid}");
});

it('uses the Pasopati page metadata image when the report payload has no image field', function () {
    config([
        'cache.default' => 'array',
        'services.deforestory.webhook_url' => 'https://pasopati.test/api',
    ]);
    $story = createStoryForUpdateApi();
    $targetUrl = 'https://pasopati.test/id/laporan/dengan-image';
    $imageUrl = 'https://pasopati.test/storage/laporan/image.jpg';

    Http::fake([
        "https://pasopati.test/api/deforestory/by-uuid/laporan/{$story->uuid}" => Http::response([
            storyUpdatePayload([
                'image_url' => null,
                'target_url_id' => $targetUrl,
                'target_url_en' => $targetUrl,
            ]),
        ]),
        $targetUrl => Http::response('<html><head><meta property="og:image" content="https://pasopati.test/img/generic.png"></head><body><figure><img src="'.$imageUrl.'"></figure></body></html>'),
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee($imageUrl, false);
});

it('falls back to local updates when Pasopati reports cannot be loaded', function () {
    $story = createStoryForUpdateApi();
    config([
        'services.deforestory.webhook_url' => 'https://pasopati.test/api',
    ]);
    Http::fake([
        'https://pasopati.test/*' => Http::response(['message' => 'Unauthorized'], 401),
    ]);
    DB::table('deforestation_story_updates')->insert([
        'deforestory_id' => $story->id,
        'external_id' => 'local-fallback',
        'title_id' => 'Pembaruan Lokal Cadangan',
        'title_en' => 'Local Fallback Update',
        'description_id' => 'Data lokal tetap tampil.',
        'description_en' => 'Local data remains visible.',
        'image_url' => 'https://example.test/images/local-fallback.jpg',
        'target_url' => 'https://example.test/local',
        'published_at' => '2026-08-07',
        'status' => 'on',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('Pembaruan Lokal Cadangan')
        ->assertSee('Data lokal tetap tampil.');
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

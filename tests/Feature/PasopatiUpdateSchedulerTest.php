<?php

use App\Jobs\SendDeforestationStoryUpdateEmail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;

uses(DatabaseTransactions::class);

it('queues only reports added after the initial Pasopati scan', function () {
    Queue::fake();
    config([
        'cache.default' => 'array',
        'services.deforestory.webhook_url' => 'https://pasopati.test/api',
    ]);
    Cache::flush();

    $uuid = (string) Str::uuid();
    $storyId = DB::table('deforestory')->insertGetId([
        'uuid' => $uuid,
        'title_id' => 'Story',
        'title_en' => 'Story',
        'slug' => 'scheduled-story-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi',
        'desrkirpsi_en' => 'Description',
        'date' => '2026-08-12',
        'content_id' => '<p>Konten</p>',
        'content_en' => '<p>Content</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    DB::table('deforestation_story_subscriptions')->insert([
        'deforestory_id' => null,
        'name' => 'Subscriber',
        'email' => 'scheduler@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $expectedNotifications = DB::table('deforestation_story_subscriptions')
        ->where('status', 'active')
        ->where(fn ($query) => $query->where('deforestory_id', $storyId)->orWhereNull('deforestory_id'))
        ->count();

    $old = pasopatiScheduledReport('old', '2026-08-11');
    $new = pasopatiScheduledReport('new', '2026-08-12');
    Http::fakeSequence()
        ->push([$old])
        ->push([$old])
        ->push([$old, $new])
        ->push([$old, $new])
        ->push([$old, $new])
        ->push([$old, $new]);
    $this->artisan('deforestory:sync-pasopati', ['--uuid' => $uuid])->assertSuccessful();
    Queue::assertNothingPushed();

    $this->artisan('deforestory:sync-pasopati', ['--uuid' => $uuid])->assertSuccessful();

    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, function ($job) use ($storyId): bool {
        return $job->storyId === $storyId && $job->article['title_id'] === 'Laporan new';
    });
    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, $expectedNotifications);

    $this->artisan('deforestory:sync-pasopati', ['--uuid' => $uuid])->assertSuccessful();
    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, $expectedNotifications);
});

function pasopatiScheduledReport(string $id, string $date): array
{
    return [
        'external_id' => $id,
        'title_id' => "Laporan {$id}",
        'title_en' => "Report {$id}",
        'description_id' => 'Deskripsi laporan.',
        'description_en' => 'Report description.',
        'image_url' => "https://pasopati.test/images/{$id}.jpg",
        'target_url_id' => "https://pasopati.test/id/{$id}",
        'target_url_en' => "https://pasopati.test/en/{$id}",
        'published_at' => $date,
        'status' => 'on',
    ];
}

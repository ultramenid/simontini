<?php

use App\Jobs\SendDeforestationStoryUpdateEmail;
use App\Jobs\SendDeforestationSubscriptionConfirmationEmail;
use App\Jobs\SendNewDeforestationStoryEmail;
use App\Mail\DeforestationStoryUpdated;
use App\Mail\DeforestationSubscriptionConfirmed;
use App\Mail\NewDeforestationStoryPublished;
use App\Services\DeforestationStoryNotificationDispatcher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;

uses(DatabaseTransactions::class);

function createSubscribedStory(): object
{
    $id = DB::table('deforestory')->insertGetId([
        'external_id' => null,
        'uuid' => (string) Str::uuid(),
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
    Queue::fake();
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
    Queue::assertPushed(SendDeforestationSubscriptionConfirmationEmail::class, 1);
});

it('stores a global subscription from the deforestation story index', function () {
    Queue::fake();
    $this->postJson(route('deforestation.subscribe.all', ['locale' => 'id']), [
        'name' => 'Subscriber Global',
        'email' => 'global-subscriber@example.test',
    ])->assertCreated();

    $this->assertDatabaseHas('deforestation_story_subscriptions', [
        'deforestory_id' => null,
        'email' => 'global-subscriber@example.test',
        'status' => 'active',
    ]);
    Queue::assertPushed(SendDeforestationSubscriptionConfirmationEmail::class, 1);
});

it('sends a confirmation email after a subscription is activated', function () {
    Mail::fake();
    $story = createSubscribedStory();
    $token = hash('sha256', uniqid('', true));
    $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
        'deforestory_id' => $story->id,
        'name' => 'Subscriber Konfirmasi',
        'email' => 'confirmation@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => $token,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    (new SendDeforestationSubscriptionConfirmationEmail($subscriptionId))->handle();

    Mail::assertSent(DeforestationSubscriptionConfirmed::class, function (DeforestationSubscriptionConfirmed $mail) use ($story, $token): bool {
        return $mail->hasTo('confirmation@example.test')
            && $mail->mailData['storyTitle'] === 'Story Berlangganan'
            && $mail->mailData['destinationUrl'] === route('deforestation.show', [
                'locale' => 'id',
                'id' => $story->id,
                'slug' => $story->slug,
            ])
            && str_contains($mail->mailData['unsubscribeUrl'], $token);
    });
});

it('deletes a subscription through its unsubscribe token', function () {
    $token = hash('sha256', uniqid('', true));
    $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
        'deforestory_id' => null,
        'name' => 'Subscriber Unsubscribe',
        'email' => 'unsubscribe@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => $token,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->get(route('deforestation.unsubscribe', [
        'locale' => 'id',
        'token' => $token,
    ]))
        ->assertOk()
        ->assertSee('Langganan dihentikan');

    $this->assertDatabaseMissing('deforestation_story_subscriptions', [
        'id' => $subscriptionId,
        'email' => 'unsubscribe@example.test',
    ]);
});

it('queues one email when a new active story update arrives', function () {
    Queue::fake();
    config(['services.deforestory.api_token' => 'test-api-token']);

    $story = createSubscribedStory();
    DB::table('deforestation_story_subscriptions')->insert([
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

    $response = $this->withToken('test-api-token')->postJson("/api/deforestory/sync/{$story->uuid}", [
        'title_id' => 'Pembaruan Raja Ampat',
        'title_en' => 'Raja Ampat Update',
        'description_id' => 'Ada pembaruan terbaru.',
        'description_en' => 'A new update is available.',
        'target_url_id' => 'https://example.test/id/update',
        'target_url_en' => 'https://example.test/en/update',
        'published_at' => '2026-08-03',
    ]);

    $response->assertAccepted()->assertJsonPath('queued_notifications', $expectedNotifications);
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

    $this->withToken('test-api-token')->postJson("/api/deforestory/sync/{$story->uuid}", [
        'title_id' => 'Pembaruan Global',
        'title_en' => 'Global Update',
        'description_id' => 'Pembaruan untuk seluruh subscriber.',
        'description_en' => 'An update for every subscriber.',
        'target_url_id' => 'https://example.test/id/global',
        'target_url_en' => 'https://example.test/en/global',
        'published_at' => '2026-08-04',
    ])->assertAccepted()->assertJsonPath('queued_notifications', $expectedNotifications);

    Queue::assertPushed(SendDeforestationStoryUpdateEmail::class, $expectedNotifications);
});

it('sends an article email from the queued payload without storing the article', function () {
    Mail::fake();
    $story = createSubscribedStory();
    $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
        'deforestory_id' => $story->id,
        'name' => 'Subscriber Payload',
        'email' => 'payload@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $updatesBefore = DB::table('deforestation_story_updates')->count();
    $article = [
        'title_id' => 'Artikel Pasopati Tanpa Penyimpanan',
        'title_en' => 'Pasopati Article Without Storage',
        'description_id' => 'Artikel hanya diteruskan ke email.',
        'description_en' => 'The article is only forwarded to email.',
        'image_url' => 'https://example.test/images/pasopati-update.jpg',
        'image_url_id' => 'https://example.test/images/pasopati-update-id.jpg',
        'image_url_en' => 'https://example.test/images/pasopati-update-en.jpg',
        'target_url_id' => 'https://example.test/id/payload',
        'target_url_en' => 'https://example.test/en/payload',
        'published_at' => '2026-08-06',
    ];

    (new SendDeforestationStoryUpdateEmail($subscriptionId, $story->id, $article))->handle();

    Mail::assertSent(DeforestationStoryUpdated::class, function (DeforestationStoryUpdated $mail): bool {
        return $mail->hasTo('payload@example.test')
            && $mail->mailData['titleId'] === 'Artikel Pasopati Tanpa Penyimpanan'
            && $mail->mailData['imageUrlId'] === 'https://example.test/images/pasopati-update-id.jpg'
            && $mail->mailData['imageUrlEn'] === 'https://example.test/images/pasopati-update-en.jpg'
            && $mail->mailData['targetUrlId'] === 'https://example.test/id/payload'
            && $mail->mailData['targetUrlEn'] === 'https://example.test/en/payload'
            && str_contains($mail->mailData['unsubscribeUrl'], '/id/deforestory/unsubscribe/');
    });
    expect(DB::table('deforestation_story_updates')->count())->toBe($updatesBefore);
});

it('renders remote images from URLs without attaching image files', function () {
    $updateImageUrl = 'https://example.test/images/update.jpg';
    $updateMail = new DeforestationStoryUpdated([
        'titleId' => 'Pembaruan Indonesia',
        'titleEn' => 'English Update',
        'storyTitleId' => 'Story Indonesia',
        'storyTitleEn' => 'English Story',
        'descriptionId' => 'Deskripsi pembaruan.',
        'descriptionEn' => 'Update description.',
        'imageUrl' => $updateImageUrl,
        'targetUrlId' => 'https://example.test/id/update',
        'targetUrlEn' => 'https://example.test/en/update',
        'unsubscribeUrl' => 'https://simontini.test/id/deforestory/unsubscribe/token-update',
        'publishedAt' => '2026-08-06',
    ]);
    $newStoryImageId = 'https://example.test/images/story-id.jpg';
    $newStoryImageEn = 'https://example.test/images/story-en.jpg';
    $newStoryMail = new NewDeforestationStoryPublished([
        'titleId' => 'Story Indonesia',
        'titleEn' => 'English Story',
        'descriptionId' => 'Deskripsi story.',
        'descriptionEn' => 'Story description.',
        'imageUrlId' => $newStoryImageId,
        'imageUrlEn' => $newStoryImageEn,
        'storyUrlId' => 'https://example.test/id/story',
        'storyUrlEn' => 'https://example.test/en/story',
        'unsubscribeUrl' => 'https://simontini.test/id/deforestory/unsubscribe/token-story',
        'publishedAt' => '2026-08-06',
    ]);

    expect($updateMail->render())
        ->toContain($updateImageUrl)
        ->toContain('<img')
        ->toContain('Unsubscribe')
        ->toContain('token-update')
        ->and($newStoryMail->render())
        ->toContain($newStoryImageId)
        ->toContain($newStoryImageEn)
        ->toContain('<img')
        ->toContain('border-top:1px solid #aebbb8')
        ->toContain('Unsubscribe')
        ->toContain('token-story')
        ->and($updateMail->attachments())->toBeEmpty();
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

it('sends a new story email without a publication notification record', function () {
    Mail::fake();
    config(['filesystems.disks.public.url' => 'https://stg.simontini.id/storage']);
    $story = createSubscribedStory();
    DB::table('deforestory')->where('id', $story->id)->update([
        'image_id' => 'deforestory/id/story-email.jpg',
        'image_en' => 'deforestory/en/story-email.jpg',
        'desrkirpsi_id' => '<p>Deskripsi story email.</p>',
    ]);
    $subscriptionId = DB::table('deforestation_story_subscriptions')->insertGetId([
        'deforestory_id' => null,
        'name' => 'Subscriber Tanpa Record',
        'email' => 'no-publication-record@example.test',
        'locale' => 'id',
        'status' => 'active',
        'unsubscribe_token' => hash('sha256', uniqid('', true)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    (new SendNewDeforestationStoryEmail($subscriptionId, $story->id))->handle();

    Mail::assertSent(NewDeforestationStoryPublished::class, function (NewDeforestationStoryPublished $mail): bool {
        return $mail->hasTo('no-publication-record@example.test')
            && $mail->mailData['titleId'] === 'Story Berlangganan'
            && $mail->mailData['descriptionId'] === 'Deskripsi story email.'
            && $mail->mailData['imageUrlId'] === 'https://stg.simontini.id/storage/deforestory/id/story-email.jpg'
            && $mail->mailData['imageUrlEn'] === 'https://stg.simontini.id/storage/deforestory/en/story-email.jpg'
            && str_contains($mail->mailData['unsubscribeUrl'], '/id/deforestory/unsubscribe/');
    });
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

<?php

namespace App\Jobs;

use App\Mail\DeforestationStoryUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendDeforestationStoryUpdateEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(public int $notificationId) {}

    public function handle(): void
    {
        $notification = DB::table('deforestation_story_update_notifications as notification')
            ->join('deforestation_story_subscriptions as subscription', 'subscription.id', '=', 'notification.subscription_id')
            ->join('deforestation_story_updates as story_update', 'story_update.id', '=', 'notification.update_id')
            ->join('deforestory as story', 'story.id', '=', 'story_update.deforestory_id')
            ->where('notification.id', $this->notificationId)
            ->where('subscription.status', 'active')
            ->where('story_update.status', 'on')
            ->select([
                'notification.id',
                'subscription.name',
                'subscription.email',
                'subscription.locale',
                'story.id as story_id',
                'story.slug',
                'story.title_id as story_title_id',
                'story.title_en as story_title_en',
                'story_update.title_id',
                'story_update.title_en',
                'story_update.description_id',
                'story_update.description_en',
                'story_update.image_url',
                'story_update.target_url',
                'story_update.published_at',
            ])
            ->first();

        if (! $notification) {
            return;
        }

        $locale = $notification->locale === 'en' ? 'en' : 'id';
        $title = $locale === 'en' ? $notification->title_en : $notification->title_id;
        $storyTitle = $locale === 'en' ? $notification->story_title_en : $notification->story_title_id;
        $description = $locale === 'en' ? $notification->description_en : $notification->description_id;

        Mail::to($notification->email, $notification->name)->send(
            new DeforestationStoryUpdated([
                'name' => $notification->name,
                'locale' => $locale,
                'title' => $title,
                'storyTitle' => $storyTitle,
                'description' => $description,
                'targetUrl' => $notification->target_url,
                'publishedAt' => $notification->published_at,
            ]),
        );

        DB::table('deforestation_story_update_notifications')
            ->where('id', $this->notificationId)
            ->update(['status' => 'sent', 'sent_at' => now(), 'error' => null, 'updated_at' => now()]);
    }

    public function failed(?Throwable $exception): void
    {
        DB::table('deforestation_story_update_notifications')
            ->where('id', $this->notificationId)
            ->update([
                'status' => 'failed',
                'error' => mb_substr($exception?->getMessage() ?? 'Unknown queue error', 0, 2000),
                'updated_at' => now(),
            ]);
    }
}

<?php

namespace App\Jobs;

use App\Mail\NewDeforestationStoryPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SendNewDeforestationStoryEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(public int $notificationId) {}

    public function handle(): void
    {
        $data = DB::table('deforestation_story_publication_notifications as notification')
            ->join('deforestation_story_subscriptions as subscription', 'subscription.id', '=', 'notification.subscription_id')
            ->join('deforestory as story', 'story.id', '=', 'notification.story_id')
            ->where('notification.id', $this->notificationId)
            ->where('subscription.status', 'active')
            ->where('story.status', 'publish')
            ->select([
                'subscription.name', 'subscription.email', 'subscription.locale',
                'story.id as story_id', 'story.slug', 'story.title_id', 'story.title_en',
                'story.desrkirpsi_id', 'story.desrkirpsi_en', 'story.image_id', 'story.image_en',
                'story.date',
            ])
            ->first();

        if (! $data) {
            return;
        }

        $locale = $data->locale === 'en' ? 'en' : 'id';
        $title = $locale === 'en' ? $data->title_en : $data->title_id;
        $description = $locale === 'en' ? $data->desrkirpsi_en : $data->desrkirpsi_id;
        $image = $locale === 'en' && $data->image_en ? $data->image_en : $data->image_id;
        $imageUrl = ! app()->environment('local') && $image && Storage::disk('public')->exists($image)
            ? url(Storage::url($image))
            : null;
        $storyUrl = route('deforestation.show', [
            'locale' => $locale,
            'id' => $data->story_id,
            'slug' => $data->slug,
        ]);

        Mail::to($data->email, $data->name)->send(new NewDeforestationStoryPublished([
            'name' => $data->name,
            'locale' => $locale,
            'title' => $title,
            'description' => $description,
            'imageUrl' => $imageUrl,
            'storyUrl' => $storyUrl,
            'publishedAt' => $data->date,
        ]));

        DB::table('deforestation_story_publication_notifications')
            ->where('id', $this->notificationId)
            ->update(['status' => 'sent', 'sent_at' => now(), 'error' => null, 'updated_at' => now()]);
    }

    public function failed(?Throwable $exception): void
    {
        DB::table('deforestation_story_publication_notifications')
            ->where('id', $this->notificationId)
            ->update([
                'status' => 'failed',
                'error' => mb_substr($exception?->getMessage() ?? 'Unknown queue error', 0, 2000),
                'updated_at' => now(),
            ]);
    }
}

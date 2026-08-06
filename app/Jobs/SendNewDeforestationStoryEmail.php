<?php

namespace App\Jobs;

use App\Mail\NewDeforestationStoryPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SendNewDeforestationStoryEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(
        public int $subscriptionId,
        public int $storyId,
    ) {}

    public function handle(): void
    {
        $subscription = DB::table('deforestation_story_subscriptions')
            ->where('id', $this->subscriptionId)
            ->whereNull('deforestory_id')
            ->where('status', 'active')
            ->first(['name', 'email', 'locale']);
        $story = DB::table('deforestory')
            ->where('id', $this->storyId)
            ->where('status', 'publish')
            ->first();

        if (! $subscription || ! $story) {
            return;
        }

        $titleEn = $story->title_en ?: $story->title_id;
        $titleId = $story->title_id ?: $story->title_en;
        $descriptionEn = $story->desrkirpsi_en ?: $story->desrkirpsi_id;
        $descriptionId = $story->desrkirpsi_id ?: $story->desrkirpsi_en;
        $image = $story->image_en ?: $story->image_id;
        $imageUrl = ! app()->environment('local') && $image && Storage::disk('public')->exists($image)
            ? url(Storage::url($image))
            : null;
        $storyUrlEn = route('deforestation.show', [
            'locale' => 'en',
            'id' => $story->id,
            'slug' => $story->slug,
        ]);
        $storyUrlId = route('deforestation.show', [
            'locale' => 'id',
            'id' => $story->id,
            'slug' => $story->slug,
        ]);

        Mail::to($subscription->email, $subscription->name)->send(new NewDeforestationStoryPublished([
            'name' => $subscription->name,
            'titleEn' => $titleEn,
            'titleId' => $titleId,
            'descriptionEn' => $descriptionEn,
            'descriptionId' => $descriptionId,
            'imageUrl' => $imageUrl,
            'storyUrlEn' => $storyUrlEn,
            'storyUrlId' => $storyUrlId,
            'publishedAt' => $story->date,
        ]));
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Gagal mengirim email Deforestory baru.', [
            'subscription_id' => $this->subscriptionId,
            'story_id' => $this->storyId,
            'error' => $exception?->getMessage() ?? 'Unknown queue error',
        ]);
    }
}

<?php

namespace App\Jobs;

use App\Mail\DeforestationStoryUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendDeforestationStoryUpdateEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(
        public int $subscriptionId,
        public int $storyId,
        public array $article,
    ) {}

    public function handle(): void
    {
        $subscription = DB::table('deforestation_story_subscriptions as subscription')
            ->where('subscription.id', $this->subscriptionId)
            ->where('subscription.status', 'active')
            ->where(function ($query) {
                $query->where('subscription.deforestory_id', $this->storyId)
                    ->orWhereNull('subscription.deforestory_id');
            })
            ->select([
                'subscription.name',
                'subscription.email',
                'subscription.locale',
            ])
            ->first();
        $story = DB::table('deforestory')->find($this->storyId);

        if (! $subscription || ! $story) {
            return;
        }

        Mail::to($subscription->email, $subscription->name)->send(
            new DeforestationStoryUpdated([
                'name' => $subscription->name,
                'titleEn' => $this->article['title_en'] ?: $this->article['title_id'],
                'titleId' => $this->article['title_id'] ?: $this->article['title_en'],
                'storyTitleEn' => $story->title_en ?: $story->title_id,
                'storyTitleId' => $story->title_id ?: $story->title_en,
                'descriptionEn' => $this->article['description_en'] ?: $this->article['description_id'],
                'descriptionId' => $this->article['description_id'] ?: $this->article['description_en'],
                'imageUrl' => $this->article['image_url'] ?? null,
                'targetUrlId' => $this->article['target_url_id'],
                'targetUrlEn' => $this->article['target_url_en'],
                'publishedAt' => $this->article['published_at'],
            ]),
        );
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Gagal mengirim email artikel Pasopati.', [
            'subscription_id' => $this->subscriptionId,
            'story_id' => $this->storyId,
            'error' => $exception?->getMessage() ?? 'Unknown queue error',
        ]);
    }
}

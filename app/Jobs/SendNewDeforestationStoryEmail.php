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
            ->first(['name', 'email', 'locale', 'unsubscribe_token']);
        $story = DB::table('deforestory')
            ->where('id', $this->storyId)
            ->where('status', 'publish')
            ->first();

        if (! $subscription || ! $story) {
            return;
        }

        $titleEn = $story->title_en ?: $story->title_id;
        $titleId = $story->title_id ?: $story->title_en;
        $descriptionEn = $this->plainText($story->desrkirpsi_en ?: $story->desrkirpsi_id);
        $descriptionId = $this->plainText($story->desrkirpsi_id ?: $story->desrkirpsi_en);
        $imageId = $story->image_id ?: $story->image_en;
        $imageEn = $story->image_en ?: $story->image_id;
        $imageUrlId = $this->publicImageUrl($imageId);
        $imageUrlEn = $this->publicImageUrl($imageEn);
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
            'imageUrlId' => $imageUrlId,
            'imageUrlEn' => $imageUrlEn,
            'storyUrlEn' => $storyUrlEn,
            'storyUrlId' => $storyUrlId,
            'unsubscribeUrl' => route('deforestation.unsubscribe', [
                'locale' => in_array($subscription->locale, ['id', 'en'], true)
                    ? $subscription->locale
                    : 'id',
                'token' => $subscription->unsubscribe_token,
            ]),
            'publishedAt' => $story->date,
        ]));
    }

    private function publicImageUrl(?string $image): ?string
    {
        if (blank($image)) {
            return null;
        }

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        return Storage::disk('public')->url($image);
    }

    private function plainText(?string $value): string
    {
        $decoded = (string) $value;

        for ($iteration = 0; $iteration < 2; $iteration++) {
            $decoded = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        return trim((string) preg_replace('/\s+/u', ' ', strip_tags($decoded)));
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

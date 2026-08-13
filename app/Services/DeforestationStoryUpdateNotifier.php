<?php

namespace App\Services;

use App\Mail\DeforestationStoryUpdated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DeforestationStoryUpdateNotifier
{
    public function sendToSubscription(int $subscriptionId, int $storyId, array $article): bool
    {
        $story = DB::table('deforestory')->find($storyId);
        $subscription = DB::table('deforestation_story_subscriptions')
            ->where('id', $subscriptionId)
            ->where('status', 'active')
            ->where(function ($query) use ($storyId) {
                $query->where('deforestory_id', $storyId)
                    ->orWhereNull('deforestory_id');
            })
            ->first(['name', 'email', 'locale', 'unsubscribe_token']);

        if (! $story || ! $subscription) {
            return false;
        }

        $this->send($story, $subscription, $article);

        return true;
    }

    public function sendToSubscribers(int $storyId, array $article): int
    {
        $story = DB::table('deforestory')->find($storyId);

        if (! $story) {
            return 0;
        }

        $subscriptions = DB::table('deforestation_story_subscriptions')
            ->where('status', 'active')
            ->where(function ($query) use ($storyId) {
                $query->where('deforestory_id', $storyId)
                    ->orWhereNull('deforestory_id');
            })
            ->orderByRaw('CASE WHEN deforestory_id = ? THEN 0 ELSE 1 END', [$storyId])
            ->get([
                'name',
                'email',
                'locale',
                'unsubscribe_token',
            ])
            ->unique(fn (object $subscription): string => mb_strtolower(trim($subscription->email)))
            ->values();

        foreach ($subscriptions as $subscription) {
            $this->send($story, $subscription, $article);
        }

        return $subscriptions->count();
    }

    private function send(object $story, object $subscription, array $article): void
    {
        Mail::to($subscription->email, $subscription->name)->send(
            new DeforestationStoryUpdated([
                'name' => $subscription->name,
                'titleEn' => $article['title_en'] ?: $article['title_id'],
                'titleId' => $article['title_id'] ?: $article['title_en'],
                'storyTitleEn' => $story->title_en ?: $story->title_id,
                'storyTitleId' => $story->title_id ?: $story->title_en,
                'descriptionEn' => $this->plainText($article['description_en'] ?: $article['description_id']),
                'descriptionId' => $this->plainText($article['description_id'] ?: $article['description_en']),
                'imageUrl' => $article['image_url'] ?? null,
                'imageUrlId' => $article['image_url_id'] ?? $article['image_url'] ?? null,
                'imageUrlEn' => $article['image_url_en'] ?? $article['image_url'] ?? null,
                'targetUrlId' => $article['target_url_id'],
                'targetUrlEn' => $article['target_url_en'],
                'unsubscribeUrl' => route('deforestation.unsubscribe', [
                    'locale' => in_array($subscription->locale, ['id', 'en'], true)
                        ? $subscription->locale
                        : 'id',
                    'token' => $subscription->unsubscribe_token,
                ]),
                'publishedAt' => $article['published_at'],
            ]),
        );
    }

    private function plainText(?string $value): string
    {
        $decoded = html_entity_decode(
            $value ?? '',
            ENT_QUOTES | ENT_HTML5,
            'UTF-8',
        );

        return trim((string) preg_replace('/\s+/u', ' ', strip_tags($decoded)));
    }
}

<?php

namespace App\Services;

use App\Mail\DeforestationStoryUpdated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DeforestationStoryUpdateNotifier
{
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

        return $subscriptions->count();
    }

    private function plainText(?string $value): string
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($value ?? ''))) ?? '');
    }
}

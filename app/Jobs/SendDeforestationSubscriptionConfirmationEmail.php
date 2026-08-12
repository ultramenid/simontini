<?php

namespace App\Jobs;

use App\Mail\DeforestationSubscriptionConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendDeforestationSubscriptionConfirmationEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(public int $subscriptionId) {}

    public function handle(): void
    {
        $subscription = DB::table('deforestation_story_subscriptions')
            ->where('id', $this->subscriptionId)
            ->where('status', 'active')
            ->first();

        if (! $subscription) {
            return;
        }

        $locale = in_array($subscription->locale, ['id', 'en'], true)
            ? $subscription->locale
            : 'id';
        $story = $subscription->deforestory_id
            ? DB::table('deforestory')->where('id', $subscription->deforestory_id)->first()
            : null;

        if ($subscription->deforestory_id && ! $story) {
            return;
        }

        $destinationUrl = $story
            ? route('deforestation.show', [
                'locale' => $locale,
                'id' => $story->id,
                'slug' => $story->slug,
            ])
            : route('deforestation.index', ['locale' => $locale]);

        Mail::to($subscription->email, $subscription->name)->send(
            new DeforestationSubscriptionConfirmed([
                'name' => $subscription->name,
                'locale' => $locale,
                'isGlobal' => $story === null,
                'storyTitle' => $story
                    ? ($locale === 'en' ? ($story->title_en ?: $story->title_id) : ($story->title_id ?: $story->title_en))
                    : null,
                'destinationUrl' => $destinationUrl,
                'unsubscribeUrl' => route('deforestation.unsubscribe', [
                    'locale' => $locale,
                    'token' => $subscription->unsubscribe_token,
                ]),
            ]),
        );
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Gagal mengirim email konfirmasi langganan Deforestory.', [
            'subscription_id' => $this->subscriptionId,
            'error' => $exception?->getMessage() ?? 'Unknown queue error',
        ]);
    }
}

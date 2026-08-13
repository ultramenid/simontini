<?php

namespace App\Jobs;

use App\Services\DeforestationStoryUpdateNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendDeforestationStoryUpdateEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public bool $failOnTimeout = true;

    public function __construct(
        public int $subscriptionId,
        public int $storyId,
        public string $eventKey,
        public array $article,
    ) {
        $this->onQueue('pasopati-updates');
    }

    public function handle(DeforestationStoryUpdateNotifier $notifier): void
    {
        $claimed = DB::table('deforestation_email_deliveries')->insertOrIgnore([
            'subscription_id' => $this->subscriptionId,
            'story_id' => $this->storyId,
            'event_key' => $this->eventKey,
            'status' => 'processing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($claimed === 0) {
            return;
        }

        try {
            $sent = $notifier->sendToSubscription(
                $this->subscriptionId,
                $this->storyId,
                $this->article,
            );

            if (! $sent) {
                DB::table('deforestation_email_deliveries')
                    ->where('subscription_id', $this->subscriptionId)
                    ->where('story_id', $this->storyId)
                    ->where('event_key', $this->eventKey)
                    ->delete();

                return;
            }

            DB::table('deforestation_email_deliveries')
                ->where('subscription_id', $this->subscriptionId)
                ->where('story_id', $this->storyId)
                ->where('event_key', $this->eventKey)
                ->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'updated_at' => now(),
                ]);
        } catch (Throwable $exception) {
            DB::table('deforestation_email_deliveries')
                ->where('subscription_id', $this->subscriptionId)
                ->where('story_id', $this->storyId)
                ->where('event_key', $this->eventKey)
                ->delete();

            throw $exception;
        }
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Gagal mengirim email pembaruan Deforestory.', [
            'story_id' => $this->storyId,
            'subscription_id' => $this->subscriptionId,
            'event_key' => $this->eventKey,
            'error' => $exception?->getMessage() ?? 'Unknown queue error',
        ]);
    }
}

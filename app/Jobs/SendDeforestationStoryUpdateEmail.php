<?php

namespace App\Jobs;

use App\Services\DeforestationStoryUpdateNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendDeforestationStoryUpdateEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(
        public int $storyId,
        public array $article,
    ) {
        $this->onQueue('pasopati-updates');
    }

    public function handle(DeforestationStoryUpdateNotifier $notifier): void
    {
        $notifier->sendToSubscribers($this->storyId, $this->article);
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Gagal mengirim email pembaruan Deforestory.', [
            'story_id' => $this->storyId,
            'error' => $exception?->getMessage() ?? 'Unknown queue error',
        ]);
    }
}

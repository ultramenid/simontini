<?php

namespace App\Services;

use App\Jobs\SendNewDeforestationStoryEmail;
use Illuminate\Support\Facades\DB;

class DeforestationStoryNotificationDispatcher
{
    public function queueNewStory(int $storyId): int
    {
        return DB::transaction(function () use ($storyId): int {
            $story = DB::table('deforestory')
                ->select(['id', 'status', 'first_published_at'])
                ->where('id', $storyId)
                ->lockForUpdate()
                ->first();

            if ($story === null
                || $story->status !== 'publish'
                || $story->first_published_at !== null) {
                return 0;
            }

            // Tandai publish pertama walaupun subscriber belum tersedia. Dengan
            // begitu draft -> publish berikutnya tidak dianggap story baru.
            DB::table('deforestory')
                ->where('id', $storyId)
                ->update(['first_published_at' => now()]);

            $queued = 0;
            $subscriptions = DB::table('deforestation_story_subscriptions')
                ->whereNull('deforestory_id')
                ->where('status', 'active')
                ->get(['id']);

            foreach ($subscriptions as $subscription) {
                SendNewDeforestationStoryEmail::dispatch(
                    (int) $subscription->id,
                    $storyId,
                );
                $queued++;
            }

            return $queued;
        });
    }
}

<?php

namespace App\Services;

use App\Jobs\SendNewDeforestationStoryEmail;
use Illuminate\Support\Facades\DB;

class DeforestationStoryNotificationDispatcher
{
    public function queueNewStory(int $storyId): int
    {
        $storyIsPublished = DB::table('deforestory')
            ->where('id', $storyId)
            ->where('status', 'publish')
            ->exists();

        if (! $storyIsPublished) {
            return 0;
        }

        $queued = 0;
        $subscriptions = DB::table('deforestation_story_subscriptions')
            ->whereNull('deforestory_id')
            ->where('status', 'active')
            ->get(['id']);

        foreach ($subscriptions as $subscription) {
            $notificationId = DB::table('deforestation_story_publication_notifications')->insertGetId([
                'story_id' => $storyId,
                'subscription_id' => $subscription->id,
                'status' => 'queued',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            SendNewDeforestationStoryEmail::dispatch((int) $notificationId);
            $queued++;
        }

        return $queued;
    }
}

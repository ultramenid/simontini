<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendDeforestationStoryUpdateEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class DeforestationStoryUpdateApiController extends Controller
{
    public function sync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'external_id' => ['required', 'string', 'max:255'],
            'deforestory_id' => ['nullable', 'integer', 'required_without:story_slug'],
            'story_slug' => ['nullable', 'string', 'max:255', 'required_without:deforestory_id'],
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_id' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image_url' => ['required', 'url:http,https', 'max:2048'],
            'target_url' => ['required', 'url:http,https', 'max:2048'],
            'published_at' => ['required', 'date'],
            'status' => ['sometimes', Rule::in(['on', 'off'])],
        ]);

        $story = DB::table('deforestory')
            ->when(
                isset($validated['deforestory_id']),
                fn ($query) => $query->where('id', $validated['deforestory_id']),
                fn ($query) => $query->where('slug', $validated['story_slug']),
            )
            ->first();

        if ($story === null) {
            throw ValidationException::withMessages([
                isset($validated['deforestory_id']) ? 'deforestory_id' : 'story_slug' => 'Deforestation Story tidak ditemukan.',
            ]);
        }

        $existing = DB::table('deforestation_story_updates')
            ->where('external_id', $validated['external_id'])
            ->first();

        $values = [
            'deforestory_id' => $story->id,
            'title_id' => $validated['title_id'],
            'title_en' => $validated['title_en'],
            'description_id' => $validated['description_id'],
            'description_en' => $validated['description_en'],
            'image_url' => $validated['image_url'],
            'target_url' => $validated['target_url'],
            'published_at' => $validated['published_at'],
            'status' => $validated['status'] ?? 'on',
            'updated_at' => now(),
        ];

        if ($existing === null) {
            $values['created_at'] = now();
        }

        DB::table('deforestation_story_updates')->updateOrInsert(
            ['external_id' => $validated['external_id']],
            $values,
        );

        $update = DB::table('deforestation_story_updates')
            ->where('external_id', $validated['external_id'])
            ->first();

        $shouldNotify = $update->status === 'on'
            && ($existing === null || $existing->status !== 'on');
        $queuedNotifications = 0;

        if ($shouldNotify) {
            $subscriptions = DB::table('deforestation_story_subscriptions')
                ->where('deforestory_id', $story->id)
                ->where('status', 'active')
                ->get(['id']);

            foreach ($subscriptions as $subscription) {
                $inserted = DB::table('deforestation_story_update_notifications')->insertOrIgnore([
                    'update_id' => $update->id,
                    'subscription_id' => $subscription->id,
                    'status' => 'queued',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($inserted === 1) {
                    $notificationId = DB::table('deforestation_story_update_notifications')
                        ->where('update_id', $update->id)
                        ->where('subscription_id', $subscription->id)
                        ->value('id');

                    SendDeforestationStoryUpdateEmail::dispatch((int) $notificationId);
                    $queuedNotifications++;
                }
            }
        }

        return response()->json([
            'message' => $existing
                ? 'Pembaruan story berhasil diperbarui.'
                : 'Pembaruan story berhasil dibuat.',
            'action' => $existing ? 'updated' : 'created',
            'queued_notifications' => $queuedNotifications,
            'data' => $update,
        ], $existing ? Response::HTTP_OK : Response::HTTP_CREATED);
    }
}

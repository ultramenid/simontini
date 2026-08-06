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
    public function sync(Request $request, string $deforestoryUuid): JsonResponse
    {
        $validated = $request->validate([
            'external_id' => ['required', 'string', 'max:255'],
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
            ->where('uuid', $deforestoryUuid)
            ->first();

        if ($story === null) {
            throw ValidationException::withMessages([
                'deforestory_uuid' => 'Deforestation Story dengan UUID tersebut tidak ditemukan.',
            ]);
        }

        $queuedNotifications = 0;

        if (($validated['status'] ?? 'on') === 'on') {
            $subscriptions = DB::table('deforestation_story_subscriptions')
                ->where('status', 'active')
                ->where(function ($query) use ($story) {
                    $query->where('deforestory_id', $story->id)
                        ->orWhereNull('deforestory_id');
                })
                ->get(['id']);

            foreach ($subscriptions as $subscription) {
                SendDeforestationStoryUpdateEmail::dispatch(
                    (int) $subscription->id,
                    (int) $story->id,
                    $validated,
                );
                $queuedNotifications++;
            }
        }

        return response()->json([
            'message' => 'Trigger artikel Pasopati berhasil diterima.',
            'action' => 'triggered',
            'deforestory_uuid' => $story->uuid,
            'external_id' => $validated['external_id'],
            'queued_notifications' => $queuedNotifications,
        ], Response::HTTP_ACCEPTED);
    }
}

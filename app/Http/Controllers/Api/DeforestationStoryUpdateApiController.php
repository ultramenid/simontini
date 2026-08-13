<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendDeforestationStoryUpdateEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class DeforestationStoryUpdateApiController extends Controller
{
    public function sync(Request $request, string $uuid): JsonResponse
    {
        $validated = $request->validate([
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_id' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image_url' => ['nullable', 'url:http,https', 'max:2048'],
            'image_url_id' => ['nullable', 'url:http,https', 'max:2048'],
            'image_url_en' => ['nullable', 'url:http,https', 'max:2048'],
            'target_url_id' => ['required', 'url:http,https', 'max:2048'],
            'target_url_en' => ['required', 'url:http,https', 'max:2048'],
            'published_at' => ['required', 'date'],
        ]);

        $story = DB::table('deforestory')
            ->where('uuid', $uuid)
            ->first();
        $uuidReconciled = false;

        if ($story === null) {
            $story = $this->findStoryByPasopatiTarget($validated);

            if ($story !== null
                && ! DB::table('deforestory')->where('uuid', $uuid)->exists()) {
                DB::table('deforestory')
                    ->where('id', $story->id)
                    ->update([
                        'uuid' => $uuid,
                        'updated_at' => now(),
                    ]);

                $story->uuid = $uuid;
                $uuidReconciled = true;
            }
        }

        if ($story === null) {
            throw ValidationException::withMessages([
                'deforestory_uuid' => 'Deforestation Story dengan UUID tersebut tidak ditemukan.',
            ]);
        }

        $subscriptions = DB::table('deforestation_story_subscriptions')
            ->where('status', 'active')
            ->where(function ($query) use ($story) {
                $query->where('deforestory_id', $story->id)
                    ->orWhereNull('deforestory_id');
            })
            ->orderByRaw('CASE WHEN deforestory_id = ? THEN 0 ELSE 1 END', [$story->id])
            ->get(['id', 'email'])
            ->unique(fn (object $subscription): string => mb_strtolower(trim($subscription->email)))
            ->values();
        $subscriberCount = $subscriptions->count();

        $fingerprint = hash('sha256', $uuid.'|'.json_encode($validated));
        $deduplicationKey = 'deforestory:update-trigger:'.$fingerprint;
        $queued = Cache::add($deduplicationKey, true, now()->addDay());
        $scheduledEmails = 0;

        if ($queued) {
            foreach ($subscriptions as $subscription) {
                SendDeforestationStoryUpdateEmail::dispatchAfterResponse(
                    (int) $subscription->id,
                    (int) $story->id,
                    $fingerprint,
                    $validated,
                );
                $scheduledEmails++;
            }
        }

        return response()->json([
            'message' => $queued
                ? 'Trigger artikel Pasopati berhasil diterima.'
                : 'Trigger artikel Pasopati sudah pernah diterima.',
            'action' => $queued ? 'queued' : 'duplicate',
            'deforestory_uuid' => $story->uuid,
            'uuid_reconciled' => $uuidReconciled,
            'delivery' => 'after_response',
            'scheduled_emails' => $scheduledEmails,
            // Dipertahankan sementara agar consumer lama tidak rusak.
            'queue' => 'pasopati-updates',
            'queued_jobs' => $scheduledEmails,
            'subscriber_count' => $subscriberCount,
        ], Response::HTTP_ACCEPTED);
    }

    private function findStoryByPasopatiTarget(array $validated): ?object
    {
        $pasopatiHost = parse_url(
            (string) config('services.deforestory.webhook_url'),
            PHP_URL_HOST,
        );

        if (blank($pasopatiHost)) {
            return null;
        }

        foreach (['target_url_id', 'target_url_en'] as $field) {
            $url = (string) ($validated[$field] ?? '');
            $host = parse_url($url, PHP_URL_HOST);
            $path = trim((string) parse_url($url, PHP_URL_PATH), '/');

            if (! $host || ! hash_equals($pasopatiHost, $host)) {
                continue;
            }

            $segments = explode('/', $path);

            if (count($segments) < 4
                || ! in_array($segments[0], ['id', 'en'], true)
                || $segments[1] !== 'deforestory') {
                continue;
            }

            $slug = Str::slug(rawurldecode($segments[2]));

            if ($slug === '') {
                continue;
            }

            $stories = DB::table('deforestory')
                ->where('slug', $slug)
                ->limit(2)
                ->get();

            if ($stories->count() === 1) {
                return $stories->first();
            }
        }

        return null;
    }
}

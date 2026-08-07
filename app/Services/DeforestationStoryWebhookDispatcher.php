<?php

namespace App\Services;

use App\Jobs\SendDeforestationStoryWebhook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class DeforestationStoryWebhookDispatcher
{
    public function dispatch(int $storyId, string $action): bool
    {
        if (blank(config('services.deforestory.webhook_url'))) {
            return false;
        }

        $story = DB::table('deforestory')->find($storyId);

        if ($story === null) {
            return false;
        }

        if ($action === 'unpublished' && $story->status !== 'draft') {
            return false;
        }

        if ($action !== 'unpublished' && $story->status !== 'publish') {
            return false;
        }

        try {
            // Antrean email tidak boleh gagal hanya karena sinkronisasi Pasopati
            // sedang menolak payload atau card belum tersedia.
            SendDeforestationStoryWebhook::dispatchSync([
                'event_id' => (string) Str::uuid(),
                'event' => "deforestory.{$action}",
                'occurred_at' => now()->toIso8601String(),
                'data' => [
                    'id' => $story->id,
                    'uuid' => $story->uuid,
                    'external_id' => $story->external_id,
                    'title_id' => $story->title_id,
                    'title_en' => $story->title_en,
                    'slug' => $story->slug,
                    'desrkirpsi_id' => $story->desrkirpsi_id,
                    'desrkirpsi_en' => $story->desrkirpsi_en,
                    'date' => $story->date,
                    'content_id' => $story->content_id,
                    'content_en' => $story->content_en,
                    'image_id' => $this->publicFileUrl($story->image_id),
                    'image_en' => $this->publicFileUrl($story->image_en),
                    'status' => $story->status,
                    'url_id' => route('deforestation.show', [
                        'locale' => 'id',
                        'id' => $story->id,
                        'slug' => $story->slug,
                    ]),
                    'url_en' => route('deforestation.show', [
                        'locale' => 'en',
                        'id' => $story->id,
                        'slug' => $story->slug,
                    ]),
                    'updated_at' => $story->updated_at,
                ],
            ]);
        } catch (Throwable $exception) {
            Log::warning('Sinkronisasi Deforestory ke Pasopati gagal.', [
                'story_id' => $story->id,
                'action' => $action,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }

        return true;
    }

    private function publicFileUrl(?string $path): ?string
    {
        return filled($path) ? url(Storage::url($path)) : null;
    }
}

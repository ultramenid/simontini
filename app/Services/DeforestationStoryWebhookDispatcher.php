<?php

namespace App\Services;

use App\Jobs\SendDeforestationStoryWebhook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        // Status CMS harus langsung tercermin di Pasopati. Webhook dibuat
        // sinkron agar publish/draft tidak tertahan ketika queue worker lokal
        // belum dijalankan. Antrean email tetap berjalan secara terpisah.
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

        return true;
    }

    private function publicFileUrl(?string $path): ?string
    {
        return filled($path) ? url(Storage::url($path)) : null;
    }
}

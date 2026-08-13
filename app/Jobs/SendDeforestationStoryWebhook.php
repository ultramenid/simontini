<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class SendDeforestationStoryWebhook implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 60;

    public function __construct(public array $payload) {}

    public function handle(): void
    {
        $baseUrl = rtrim((string) config('services.deforestory.webhook_url'), '/');

        if ($baseUrl === '') {
            return;
        }

        $token = (string) config('services.deforestory.webhook_token', '');
        $story = $this->payload['data'] ?? [];
        $event = $this->payload['event'] ?? '';
        $isUnpublished = $event === 'deforestory.unpublished';
        $isUpdate = in_array($event, ['deforestory.updated', 'deforestory.unpublished'], true);

        if ($isUpdate && empty($story['uuid']) && isset($story['id'])) {
            $currentStory = DB::table('deforestory')->find($story['id']);

            if ($currentStory === null
                || ($isUnpublished && $currentStory->status !== 'draft')
                || (! $isUnpublished && $currentStory->status !== 'publish')) {
                return;
            }

            $story = array_merge($story, [
                'uuid' => $currentStory->uuid,
                'slug' => $currentStory->slug,
                'image_id' => filled($currentStory->image_id) ? url(Storage::url($currentStory->image_id)) : null,
                'image_en' => filled($currentStory->image_en) ? url(Storage::url($currentStory->image_en)) : null,
                'title_id' => $currentStory->title_id,
                'title_en' => $currentStory->title_en,
                'desrkirpsi_id' => $currentStory->desrkirpsi_id,
                'desrkirpsi_en' => $currentStory->desrkirpsi_en,
                'date' => $currentStory->date,
                'status' => $currentStory->status,
            ]);
        }

        $storyUuid = $story['uuid']
            ?? DB::table('deforestory')->where('id', $story['id'] ?? 0)->value('uuid');
        $card = [
            'uuid' => $storyUuid ?? '',
            'slug' => $story['slug'] ?? '',
            'card_uuid' => $storyUuid ?? '',
            'card_slug' => $story['slug'] ?? '',
            'category' => 'deforestory',
            'year' => isset($story['date']) ? substr((string) $story['date'], 0, 4) : '',
            'image' => $story['image_id'] ?? $story['image_en'] ?? null,
            'image_id' => $story['image_id'] ?? null,
            'image_en' => $story['image_en'] ?? null,
            'title_id' => $story['title_id'] ?? '',
            'title_en' => $story['title_en'] ?? '',
            'date' => $story['date'] ?? null,
            'status' => $story['status'] ?? 'publish',
            'excerpt_id' => strip_tags((string) ($story['desrkirpsi_id'] ?? '')),
            'excerpt_en' => strip_tags((string) ($story['desrkirpsi_en'] ?? '')),
            'sort' => (int) ($story['id'] ?? 0),
        ];

        if (blank($card['uuid']) && blank($card['slug'])) {
            throw new RuntimeException(
                'UUID atau slug belum tersedia untuk Deforestory ID '.($story['id'] ?? 0).'.'
            );
        }

        $pasopatiPayload = ['cards' => [$card]];
        $body = json_encode($pasopatiPayload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $request = Http::acceptJson()
            ->asJson()
            ->timeout((int) config('services.deforestory.webhook_timeout', 10))
            ->withHeaders([
                'X-Simontini-Event' => $this->payload['event'],
                'X-Deforestory-Delivery' => $this->payload['event_id'],
                'X-Simontini-Signature' => $token !== ''
                    ? hash_hmac('sha256', $body, $token)
                    : '',
            ]);

        if ($token !== '') {
            $request = $request->withToken($token);
        }

        $request = $request->withBody($body, 'application/json');
        $cardsUrl = $this->cardsUrl($baseUrl);

        $method = $event === 'deforestory.created' ? 'POST' : 'PUT';
        $targetUrl = $method === 'POST'
            ? $cardsUrl
            : $cardsUrl.'/'.rawurlencode((string) $card['uuid']);
        $response = $method === 'POST'
            ? $request->post($targetUrl)
            : $request->put($targetUrl);

        $response->throw();

        Log::info('Sinkronisasi Deforestory ke Pasopati berhasil.', [
            'event' => $event,
            'uuid' => $card['uuid'],
            'slug' => $card['slug'],
            'method' => $method,
            'url' => $targetUrl,
            'status' => $response->status(),
        ]);
    }

    private function cardsUrl(string $baseUrl): string
    {
        if (str_ends_with($baseUrl, '/deforestory/cards')) {
            return $baseUrl;
        }

        return $baseUrl.'/deforestory/cards';
    }
}

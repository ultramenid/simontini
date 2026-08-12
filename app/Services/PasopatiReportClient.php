<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class PasopatiReportClient
{
    public function forStory(string $uuid, string $locale, bool $includeInactive = false): ?Collection
    {
        $baseUrl = rtrim((string) config('services.deforestory.webhook_url'), '/');

        if ($baseUrl === '' || ! Str::isUuid($uuid)) {
            return null;
        }

        $url = $baseUrl.'/deforestory/by-uuid/laporan/'.rawurlencode($uuid);

        try {
            $response = Http::acceptJson()
                ->timeout(8)
                ->retry(2, 200, throw: false)
                ->get($url);

            if (! $response->successful() || ! is_array($response->json())) {
                Log::warning('Gagal mengambil laporan Deforestory dari Pasopati.', [
                    'uuid' => $uuid,
                    'status' => $response->status(),
                ]);

                return null;
            }

            $payload = $response->json();
            $items = array_is_list($payload) ? $payload : ($payload['data'] ?? []);

            if (! is_array($items)) {
                return collect();
            }

            return collect($items)
                ->filter(fn ($item) => is_array($item))
                ->filter(function (array $item) use ($includeInactive): bool {
                    if ($includeInactive || ! isset($item['status'])) {
                        return true;
                    }

                    return in_array(Str::lower((string) $item['status']), ['on', 'active', 'publish'], true);
                })
                ->filter(fn (array $item): bool => filled($item['published_at'] ?? null))
                ->map(function (array $item) use ($locale): object {
                    $titleId = (string) ($item['title_id'] ?? $item['title_en'] ?? '');
                    $titleEn = (string) ($item['title_en'] ?? $item['title_id'] ?? '');
                    $descriptionId = $this->plainText($item['description_id'] ?? $item['description_en'] ?? '');
                    $descriptionEn = $this->plainText($item['description_en'] ?? $item['description_id'] ?? '');

                    return (object) [
                        'id' => $item['external_id'] ?? $item['uuid'] ?? substr(hash('sha256', json_encode($item)), 0, 16),
                        'title_id' => $titleId,
                        'title_en' => $titleEn,
                        'description_id' => $descriptionId,
                        'description_en' => $descriptionEn,
                        'localized_title' => $locale === 'en' ? $titleEn : $titleId,
                        'localized_description' => $locale === 'en' ? $descriptionEn : $descriptionId,
                        'image_url' => $item['image_url'] ?? $item['image'] ?? null,
                        'target_url' => $locale === 'en'
                            ? ($item['target_url_en'] ?? $item['target_url_id'] ?? $item['target_url'] ?? '#')
                            : ($item['target_url_id'] ?? $item['target_url_en'] ?? $item['target_url'] ?? '#'),
                        'published_at' => $item['published_at'],
                        'status' => $item['status'] ?? 'on',
                    ];
                })
                ->sortByDesc('published_at')
                ->values();
        } catch (Throwable $exception) {
            Log::warning('Pasopati tidak dapat dihubungi saat mengambil laporan Deforestory.', [
                'uuid' => $uuid,
                'error' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    private function plainText(mixed $value): string
    {
        $decoded = (string) $value;

        // Pasopati dapat mengirim HTML mentah maupun HTML entity-encoded.
        // Decode dua kali agar &lt;p&gt; dan &amp;lt;p&amp;gt; sama-sama bersih.
        for ($iteration = 0; $iteration < 2; $iteration++) {
            $decoded = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $text = strip_tags($decoded);

        return trim((string) preg_replace('/\s+/u', ' ', $text));
    }
}

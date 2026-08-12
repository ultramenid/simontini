<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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
                    $targetUrl = $locale === 'en'
                        ? ($item['target_url_en'] ?? $item['target_url_id'] ?? $item['target_url'] ?? '#')
                        : ($item['target_url_id'] ?? $item['target_url_en'] ?? $item['target_url'] ?? '#');

                    return (object) [
                        'id' => $item['external_id'] ?? $item['uuid'] ?? substr(hash('sha256', json_encode($item)), 0, 16),
                        'title_id' => $titleId,
                        'title_en' => $titleEn,
                        'description_id' => $descriptionId,
                        'description_en' => $descriptionEn,
                        'localized_title' => $locale === 'en' ? $titleEn : $titleId,
                        'localized_description' => $locale === 'en' ? $descriptionEn : $descriptionId,
                        'image_url' => $this->resolveImageUrl(
                            $item['image_url'] ?? $item['image'] ?? null,
                            (string) $targetUrl,
                        ),
                        'target_url' => $targetUrl,
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

    private function resolveImageUrl(mixed $providedImage, string $targetUrl): ?string
    {
        if (filter_var($providedImage, FILTER_VALIDATE_URL)) {
            return (string) $providedImage;
        }

        $pasopatiHost = parse_url((string) config('services.deforestory.webhook_url'), PHP_URL_HOST);
        $targetHost = parse_url($targetUrl, PHP_URL_HOST);

        // Batasi pengambilan metadata ke host Pasopati agar URL dari payload
        // eksternal tidak dapat digunakan untuk melakukan SSRF.
        if (! $pasopatiHost || ! $targetHost || ! hash_equals($pasopatiHost, $targetHost)) {
            return null;
        }

        return Cache::remember(
            'pasopati:report-image:'.hash('sha256', $targetUrl),
            now()->addDay(),
            function () use ($targetUrl): ?string {
                try {
                    $html = Http::timeout(5)->retry(1, 100, throw: false)->get($targetUrl)->body();

                    if ($html === '') {
                        return null;
                    }

                    $document = new \DOMDocument;
                    @$document->loadHTML($html);
                    $xpath = new \DOMXPath($document);
                    $node = $xpath->query('//figure//img[@src]/@src')?->item(0)
                        ?? $xpath->query('//meta[@property="og:image" or @name="twitter:image"]/@content')?->item(0);
                    $imageUrl = trim((string) $node?->nodeValue);

                    $imageHost = parse_url($imageUrl, PHP_URL_HOST);
                    $targetHost = parse_url($targetUrl, PHP_URL_HOST);

                    return filter_var($imageUrl, FILTER_VALIDATE_URL)
                        && $imageHost
                        && $targetHost
                        && hash_equals($targetHost, $imageHost)
                            ? $imageUrl
                            : null;
                } catch (Throwable) {
                    return null;
                }
            },
        );
    }
}

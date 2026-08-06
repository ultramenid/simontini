<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class CloudflareD1
{
    public function query(string $sql, array $params = []): array
    {
        $accountId = config('services.cloudflare_d1.account_id');
        $databaseId = config('services.cloudflare_d1.database_id');
        $token = config('services.cloudflare_d1.api_token');

        if (! $accountId || ! $databaseId || ! $token) {
            throw new RuntimeException('Konfigurasi Cloudflare D1 belum lengkap.');
        }

        $response = Http::acceptJson()
            ->withToken($token)
            ->timeout(15)
            ->retry(2, 200)
            ->post("https://api.cloudflare.com/client/v4/accounts/{$accountId}/d1/database/{$databaseId}/query", [
                'sql' => $sql,
                'params' => array_values($params),
            ]);

        if (! $response->successful() || ! $response->json('success')) {
            throw new RuntimeException(
                data_get($response->json(), 'errors.0.message', 'Cloudflare D1 tidak dapat dihubungi.'),
            );
        }

        return $response->json('result.0.results', []);
    }
}

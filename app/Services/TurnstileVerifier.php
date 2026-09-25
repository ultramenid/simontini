<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurnstileVerifier
{
    public function verify(string $token, string $expectedAction, ?string $ipAddress = null): bool
    {
        $secret = config('services.turnstile.secret_key');
        $expectedHostnames = config('services.turnstile.hostnames', []);

        if (! $secret || $expectedHostnames === []) {
            Log::error('Turnstile is not configured: set TURNSTILE_SECRET and TURNSTILE_HOSTNAMES.');
        }

        if (! $secret || $token === '' || mb_strlen($token) > 2048 || $expectedHostnames === []) {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => $ipAddress,
                ]);
        } catch (\Throwable) {
            return false;
        }

        // Cloudflare's test keys return no action, so local development could never pass.
        $isLocalTestKey = $response->json('metadata.result_with_testing_key') === true
            && ! app()->isProduction();

        $passed = $response->successful()
            && $response->json('success') === true
            && ($isLocalTestKey || hash_equals($expectedAction, (string) $response->json('action')))
            && in_array($response->json('hostname'), $expectedHostnames, true);

        if (! $passed) {
            Log::warning('Turnstile verification failed', [
                'status' => $response->status(),
                'error_codes' => $response->json('error-codes'),
                'action' => $response->json('action'),
                'hostname' => $response->json('hostname'),
            ]);
        }

        return $passed;
    }
}

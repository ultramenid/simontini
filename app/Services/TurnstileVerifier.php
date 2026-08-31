<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TurnstileVerifier
{
    public function verify(string $token, string $expectedAction, ?string $ipAddress = null): bool
    {
        $secret = config('services.turnstile.secret_key');
        $expectedHostnames = config('services.turnstile.hostnames', []);

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

        return $response->successful()
            && $response->json('success') === true
            && hash_equals($expectedAction, (string) $response->json('action'))
            && in_array($response->json('hostname'), $expectedHostnames, true);
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TurnstileVerifier
{
    public function verify(string $token, ?string $ipAddress = null): bool
    {
        $secret = config('services.turnstile.secret_key');

        if (! $secret) {
            return false;
        }

        $response = Http::asForm()
            ->timeout(10)
            ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $ipAddress,
            ]);

        return $response->successful() && $response->json('success') === true;
    }
}

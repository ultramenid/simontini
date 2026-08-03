<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeforestoryApiToken
{
    public function handle(Request $request, Closure $next): Response|JsonResponse
    {
        $configuredToken = (string) config('services.deforestory.api_token');
        $requestToken = (string) $request->bearerToken();

        if ($configuredToken === '' || $requestToken === '' || ! hash_equals($configuredToken, $requestToken)) {
            return response()->json([
                'message' => 'API token tidak valid.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}

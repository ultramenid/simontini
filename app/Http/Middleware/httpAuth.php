<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class httpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $expectedUser = (string) config('cms.basic_auth.user');
        $expectedPassword = (string) config('cms.basic_auth.password');
        $user = (string) $request->getUser();
        $password = (string) $request->getPassword();

        // Gagal tertutup: tanpa kredensial di env, halaman tidak bisa dibuka.
        if ($expectedUser === '' || $expectedPassword === ''
            || ! hash_equals($expectedUser, $user)
            || ! hash_equals($expectedPassword, $password)) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Restricted Area"',
            ]);
        }

        return $next($request);
    }
}

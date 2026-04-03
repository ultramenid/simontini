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
        $user = $request->getUser();
        $password = $request->getPassword();

        if ($user !== 'Auriga' || $password !== 'S.T.A.D.I.2025') {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Restricted Area"',
            ]);
        }

        return $next($request);
    }
}

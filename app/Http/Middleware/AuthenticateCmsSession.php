<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateCmsSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->session()->get('id');

        if (! $userId) {
            return redirect()->guest(route('login'));
        }

        $user = DB::table('users')
            ->select(['id', 'name', 'email', 'role_id', 'status'])
            ->where('id', $userId)
            ->where('status', 1)
            ->first();

        if ($user === null) {
            $request->session()->forget(['id', 'role_id']);

            return redirect()->guest(route('login'));
        }

        $request->attributes->set('cmsUser', $user);

        return $next($request);
    }
}

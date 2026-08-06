<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCmsRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->attributes->get('cmsUser');
        $allowedRoleIds = collect($roles)
            ->map(fn (string $role) => config("cms.role_ids.{$role}"))
            ->filter()
            ->values()
            ->all();

        abort_unless($user && in_array((int) $user->role_id, $allowedRoleIds, true), 403);

        return $next($request);
    }
}

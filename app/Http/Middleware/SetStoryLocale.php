<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetStoryLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = (string) $request->route('locale');
        abort_unless(in_array($locale, ['id', 'en'], true), 404);

        app()->setLocale($locale);

        return $next($request);
    }
}

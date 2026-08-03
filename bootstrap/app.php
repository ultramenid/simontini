<?php

use App\Http\Middleware\AuthenticateCmsSession;
use App\Http\Middleware\DeforestoryApiToken;
use App\Http\Middleware\EnsureCmsRole;
use App\Http\Middleware\httpAuth;
use App\Http\Middleware\SetStoryLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => AuthenticateCmsSession::class,
            'deforestory.token' => DeforestoryApiToken::class,
            'httpauth' => httpAuth::class,
            'role' => EnsureCmsRole::class,
            'story.locale' => SetStoryLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

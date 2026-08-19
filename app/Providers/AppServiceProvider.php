<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('comments', function (Request $request) {
            $email = mb_strtolower(trim((string) $request->input('email', '')));
            $identity = filter_var($email, FILTER_VALIDATE_EMAIL)
                ? 'email:'.hash('sha256', $email)
                : 'ip:'.$request->ip();

            $response = fn (Request $request, array $headers) => back()
                ->with('comment_error', 'Terlalu banyak komentar dikirim. Tunggu sebentar lalu coba kembali.')
                ->withHeaders($headers);

            return [
                Limit::perMinute(10)->by('comments:minute:'.$identity)->response($response),
                Limit::perHour(60)->by('comments:hour:'.$identity)->response($response),
            ];
        });
    }
}

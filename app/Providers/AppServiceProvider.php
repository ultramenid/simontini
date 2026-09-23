<?php

namespace App\Providers;

use App\Http\Middleware\AuthenticateCmsSession;
use App\Http\Middleware\EnsureCmsRole;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        // Middleware CMS harus tetap berjalan pada permintaan /livewire/update,
        // karena snapshot Livewire tidak terikat pada sesi.
        Livewire::addPersistentMiddleware([AuthenticateCmsSession::class, EnsureCmsRole::class]);

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

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });
    }
}

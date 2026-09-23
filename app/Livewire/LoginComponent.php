<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LoginComponent extends Component
{
    public $email, $password;

    // Hash statis agar percobaan login dengan email yang tidak ada
    // tetap menjalani bcrypt seperti percobaan dengan password salah.
    private const DUMMY_HASH = '$2y$12$sZz71f3E0g0XnjwWGGqS.eQCm/np6G3hc4uJldIFSLGvMj/66zuNW';

    public function login(){
        $throttleKey = 'cms-login:'.mb_strtolower(trim((string) $this->email)).'|'.(string) request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            Toaster::error('Terlalu banyak percobaan masuk. Coba lagi dalam '.RateLimiter::availableIn($throttleKey).' detik.');

            return;
        }

        $user = filter_var($this->email, FILTER_VALIDATE_EMAIL)
            ? DB::table('users')->where('email', $this->email)->where('status', 1)->first()
            : null;

        $passwordOk = Hash::check($this->password, $user?->password ?? self::DUMMY_HASH);

        if (! $user || ! $passwordOk) {
            RateLimiter::hit($throttleKey, 300);

            Toaster::error('check your login information');

            return;
        }

        RateLimiter::clear($throttleKey);

        // Regenerasi ID sesi agar sesi yang tertanam sebelum login tidak dibawa ke sesi terautentikasi.
        request()->session()->regenerate();

        session([
            'id' => $user->id,
            'role_id' => $user->role_id,
        ]);

        redirect('/cms/dashboard');
    }

    public function render()
    {
        return view('livewire.login-component');
    }
}
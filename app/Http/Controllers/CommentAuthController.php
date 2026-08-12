<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class CommentAuthController extends Controller
{
    public function redirect(Request $request): RedirectResponse
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return redirect()->to(url()->previous())->with(
                'comment_error',
                'Login Google belum dikonfigurasi. Isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET terlebih dahulu.',
            );
        }

        $returnTo = $request->query('return_to');

        if (! is_string($returnTo) || ! $this->isSafeReturnUrl($returnTo, $request)) {
            $returnTo = url()->previous();
        }

        $request->session()->put('comment_login_intended', $returnTo);

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $providerUserId = (string) $googleUser->getId();
        $name = $googleUser->getName() ?: $googleUser->getNickname() ?: 'Pengguna Google';
        $email = $googleUser->getEmail();
        $avatar = $googleUser->getAvatar();
        $existingUser = DB::table('comment_users')
            ->where('provider', 'google')
            ->where('provider_user_id', $providerUserId)
            ->first();

        if ($existingUser) {
            DB::table('comment_users')->where('id', $existingUser->id)->update([
                'name' => $name,
                'email' => $email,
                'avatar' => $avatar,
                'last_login_at' => now(),
                'updated_at' => now(),
            ]);
            $commentUserId = $existingUser->id;
        } else {
            $commentUserId = DB::table('comment_users')->insertGetId([
                'provider' => 'google',
                'provider_user_id' => $providerUserId,
                'name' => $name,
                'email' => $email,
                'avatar' => $avatar,
                'last_login_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $request->session()->put('comment_user', [
            'local_id' => $commentUserId,
            'provider' => 'google',
            'id' => $providerUserId,
            'name' => $name,
            'email' => $email,
            'avatar' => $avatar,
        ]);
        $request->session()->regenerate();

        return redirect()->to($request->session()->pull('comment_login_intended', '/'));
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('comment_user');
        $request->session()->regenerateToken();

        return back();
    }

    private function isSafeReturnUrl(string $url, Request $request): bool
    {
        if (str_starts_with($url, '/')) {
            return ! str_starts_with($url, '//');
        }

        $parts = parse_url($url);

        return is_array($parts)
            && in_array($parts['scheme'] ?? null, ['http', 'https'], true)
            && isset($parts['host'])
            && strcasecmp($parts['host'], $request->getHost()) === 0;
    }
}

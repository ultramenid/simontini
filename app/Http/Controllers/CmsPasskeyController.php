<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Passkeys\Actions\GenerateRegistrationOptions;
use Laravel\Passkeys\Actions\GenerateVerificationOptions;
use Laravel\Passkeys\Actions\StorePasskey;
use Laravel\Passkeys\Actions\VerifyPasskey;
use Laravel\Passkeys\Exceptions\InvalidPasskeyException;
use Laravel\Passkeys\Http\Requests\PasskeyRegistrationRequest;
use Laravel\Passkeys\Http\Requests\PasskeyVerificationRequest;
use Laravel\Passkeys\Support\WebAuthn;

/**
 * Passkey (WebAuthn / biometrik) untuk CMS. Memakai aksi dari laravel/passkeys,
 * tetapi login disimpan ke sesi CMS (session 'id' & 'role_id') seperti LoginComponent.
 */
class CmsPasskeyController extends Controller
{
    public function loginOptions(Request $request, GenerateVerificationOptions $generate): JsonResponse
    {
        $options = $generate();

        $request->session()->put('passkey.verification_options', WebAuthn::toJson($options));

        return response()->json(['options' => WebAuthn::toBrowserArray($options)]);
    }

    public function login(PasskeyVerificationRequest $request, VerifyPasskey $verify): JsonResponse
    {
        $passkey = $verify($request->credential(), $request->verificationOptions());
        $user = $passkey->user;

        if (! $user || (int) $user->status !== 1) {
            throw InvalidPasskeyException::make('Akun ini tidak aktif.');
        }

        $request->session()->regenerate();

        session([
            'id' => $user->id,
            'role_id' => $user->role_id,
        ]);

        return response()->json(['redirect' => url('/cms/dashboard')]);
    }

    /**
     * Menambah passkey wajib konfirmasi password, agar sesi yang dibajak
     * tidak bisa menanamkan passkey milik penyerang.
     */
    public function registrationOptions(Request $request, GenerateRegistrationOptions $generate): JsonResponse
    {
        $request->validate(['password' => ['required', 'string']]);

        $user = $this->currentUser($request);

        if (! Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages(['password' => 'Password salah.']);
        }

        $options = $generate($user);

        $request->session()->put('passkey.registration_options', WebAuthn::toJson($options));

        return response()->json(['options' => WebAuthn::toBrowserArray($options)]);
    }

    public function store(PasskeyRegistrationRequest $request, StorePasskey $store): JsonResponse
    {
        $passkey = $store(
            $this->currentUser($request),
            trim($request->string('name')->toString()),
            $request->credential(),
            $request->registrationOptions(),
        );

        return response()->json(['id' => $passkey->id], 201);
    }

    private function currentUser(Request $request): User
    {
        return User::findOrFail($request->attributes->get('cmsUser')->id);
    }
}

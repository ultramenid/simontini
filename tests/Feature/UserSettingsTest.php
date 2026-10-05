<?php

use App\Livewire\UserSettings;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

function settingsUser(array $overrides = []): int
{
    return DB::table('users')->insertGetId($overrides + [
        'name' => 'Editor', 'email' => 'settings-'.uniqid().'@simontini.test', 'password' => Hash::make('Old!Passw0rd'),
        'role_id' => config('cms.role_ids.editor'), 'status' => 1, 'created_at' => now(), 'updated_at' => now(),
    ]);
}

function addPasskey(int $userId, string $name = 'MacBook'): int
{
    return DB::table('passkeys')->insertGetId([
        'user_id' => $userId, 'name' => $name, 'credential_id' => uniqid('cred'), 'credential' => '{}',
        'created_at' => now(), 'updated_at' => now(),
    ]);
}

beforeEach(function () {
    Http::fake(['api.pwnedpasswords.com/*' => Http::response('')]);
});

it('shows the settings page to any logged in user, not only admins', function () {
    $this->get('/cms/settings')->assertRedirect(route('login'));

    $this->withSession(['id' => settingsUser()])
        ->get('/cms/settings')
        ->assertOk()
        ->assertSee('Pengaturan akun')
        ->assertSee('Login biometrik');
});

it('updates the own profile and password only with the current password', function () {
    $id = settingsUser();
    session(['id' => $id]);

    Livewire::test(UserSettings::class)
        ->set('name', 'Nama Baru')->set('email', 'Baru@Simontini.test')
        ->call('saveProfile')->assertHasNoErrors()
        ->set('current_password', 'wrong')->set('password', 'New!Passw0rd')->set('password_confirmation', 'New!Passw0rd')
        ->call('savePassword')->assertHasErrors('current_password')
        ->set('current_password', 'Old!Passw0rd')
        ->call('savePassword')->assertHasNoErrors();

    $user = DB::table('users')->find($id);
    expect($user->name)->toBe('Nama Baru')
        ->and($user->email)->toBe('baru@simontini.test')
        ->and(Hash::check('New!Passw0rd', $user->password))->toBeTrue();
});

it('deletes only the own passkeys', function () {
    $id = settingsUser();
    $mine = addPasskey($id);
    $theirs = addPasskey(settingsUser());
    session(['id' => $id]);

    Livewire::test(UserSettings::class)
        ->assertSee('MacBook')
        ->call('deletePasskey', $theirs)
        ->call('deletePasskey', $mine);

    expect(DB::table('passkeys')->where('id', $mine)->exists())->toBeFalse()
        ->and(DB::table('passkeys')->where('id', $theirs)->exists())->toBeTrue();
});

it('requires the current password before issuing passkey registration options', function () {
    $id = settingsUser();

    $this->withSession(['id' => $id])
        ->postJson('/cms/settings/passkeys/options', ['password' => 'wrong'])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('password');

    $this->withSession(['id' => $id])
        ->postJson('/cms/settings/passkeys/options', ['password' => 'Old!Passw0rd'])
        ->assertOk()
        ->assertJsonPath('options.authenticatorSelection.userVerification', 'required')
        ->assertSessionHas('passkey.registration_options');
});

it('issues login options to guests and rejects invalid credentials', function () {
    $this->getJson('/cms/passkeys/login/options')
        ->assertOk()
        ->assertJsonStructure(['options' => ['challenge']]);

    $this->postJson('/cms/passkeys/login', [
        'credential' => ['id' => 'x', 'rawId' => 'eA', 'type' => 'public-key', 'response' => ['clientDataJSON' => 'e30']],
    ])->assertUnprocessable();

    expect(session('id'))->toBeNull();
});

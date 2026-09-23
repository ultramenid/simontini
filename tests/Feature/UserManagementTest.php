<?php

use App\Livewire\UserManagement;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

beforeEach(function () {
    // Cek kebocoran password memanggil API Have I Been Pwned; anggap selalu aman.
    Http::fake(['api.pwnedpasswords.com/*' => Http::response('')]);
    session(['id' => 1]);
});

it('refuses the component to non admin users even outside the route', function () {
    $editorId = DB::table('users')->insertGetId([
        'name' => 'Editor', 'email' => 'editor-only@simontini.test', 'password' => Hash::make('x'),
        'role_id' => config('cms.role_ids.editor'), 'status' => 1, 'created_at' => now(), 'updated_at' => now(),
    ]);
    session(['id' => $editorId]);

    Livewire::test(UserManagement::class)->assertForbidden();
});

it('shows the user CMS page only to logged in admins', function () {
    session()->flush();
    $this->get('/cms/users')->assertRedirect(route('login'));

    $this->withSession(['id' => 1])
        ->get('/cms/users')
        ->assertOk()
        ->assertSee('User CMS')
        ->assertSee(DB::table('users')->where('id', 1)->value('email'));
});

it('rejects weak passwords and creates a user with a hashed strong password', function () {
    $component = Livewire::test(UserManagement::class)
        ->call('create')
        ->set('name', 'Editor Baru')
        ->set('email', 'Editor@Simontini.test')
        ->set('roleId', config('cms.role_ids.editor'));

    foreach (['short1!A', 'alllowercase123!', 'NoNumbersHere!!', 'NoSymbols12345', 'Str0ng!Passw0rd'] as $i => $password) {
        $component->set('password', $password)->set('password_confirmation', $i === 4 ? 'different' : $password)
            ->call('save')->assertHasErrors('password');
    }

    $component->set('password', 'Str0ng!Passw0rd')->set('password_confirmation', 'Str0ng!Passw0rd')
        ->call('save')->assertHasNoErrors();

    $user = DB::table('users')->where('email', 'editor@simontini.test')->first();
    expect($user)->not->toBeNull()
        ->and(Hash::check('Str0ng!Passw0rd', $user->password))->toBeTrue()
        ->and((int) $user->role_id)->toBe(config('cms.role_ids.editor'));
});

it('keeps the password when editing without a new one and blocks self lockout', function () {
    $oldHash = DB::table('users')->where('id', 1)->value('password');

    Livewire::test(UserManagement::class)
        ->call('edit', 1)
        ->set('name', 'Admin Ganti Nama')
        ->call('save')
        ->assertHasNoErrors();

    expect(DB::table('users')->where('id', 1)->value('password'))->toBe($oldHash)
        ->and(DB::table('users')->where('id', 1)->value('name'))->toBe('Admin Ganti Nama');

    Livewire::test(UserManagement::class)
        ->call('edit', 1)
        ->set('active', false)
        ->call('save')
        ->assertHasErrors('roleId');

    expect((int) DB::table('users')->where('id', 1)->value('status'))->toBe(1);
});

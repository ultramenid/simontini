<?php

use App\Livewire\DeforestoryAdd;
use App\Livewire\DeforestoryIndex;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

it('stores one hashed password for every locked Deforestory preview', function () {
    $component = Livewire::test(DeforestoryIndex::class)
        ->set('globalPreviewPassword', 'password-global')
        ->set('globalPreviewPassword_confirmation', 'password-global')
        ->call('saveGlobalPreviewPassword')
        ->assertHasNoErrors();

    $settings = DB::table('deforestory_preview_settings')->where('id', 1)->first();

    expect($settings->password_hash)->not->toBe('password-global')
        ->and(Hash::check('password-global', $settings->password_hash))->toBeTrue()
        ->and(Crypt::decryptString($settings->password_encrypted))->toBe('password-global');

    $component
        ->call('revealGlobalPreviewPassword')
        ->assertSet('revealedGlobalPreviewPassword', 'password-global')
        ->call('hideGlobalPreviewPassword')
        ->assertSet('revealedGlobalPreviewPassword', null);
});

it('allows an article to use the global preview lock without its own password', function () {
    Livewire::test(DeforestoryAdd::class)
        ->set('title_id', 'Artikel Terkunci')
        ->set('title_en', 'Locked Story')
        ->set('desrkirpsi_id', 'Deskripsi artikel.')
        ->set('desrkirpsi_en', 'Story description.')
        ->set('content_id', '<p>Konten.</p>')
        ->set('content_en', '<p>Content.</p>')
        ->set('status', 'draft')
        ->set('is_locked', true)
        ->call('save')
        ->assertHasNoErrors();

    expect(DB::table('deforestory')->where('title_id', 'Artikel Terkunci')->value('is_locked'))->toBeTrue();
});

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
        ->assertHasNoErrors()
        ->assertSee('••••••••')
        ->assertSee('Lihat Password');

    $settings = DB::table('deforestory_preview_settings')->where('id', 1)->first();

    expect($settings->password_hash)->not->toBe('password-global')
        ->and(Hash::check('password-global', $settings->password_hash))->toBeTrue()
        ->and(Crypt::decryptString($settings->password_encrypted))->toBe('password-global');

    $component
        ->call('revealGlobalPreviewPassword')
        ->assertSet('revealedGlobalPreviewPassword', 'password-global')
        ->assertSee('Sembunyikan')
        ->call('hideGlobalPreviewPassword')
        ->assertSet('revealedGlobalPreviewPassword', null);
});

it('keeps the global password display and toggle at fixed dimensions', function () {
    $view = file_get_contents(resource_path('views/livewire/deforestory-index.blade.php'));

    expect($view)
        ->toContain('setTimeout(() => visible = false, 5000)')
        ->toContain('grid-cols-[minmax(0,1fr)_8rem]')
        ->toContain('lg:w-[480px] lg:flex-none')
        ->toContain('class="inline-flex w-32 items-center justify-center');
});

it('allows an article preview lock to be toggled directly from the CMS list', function () {
    Livewire::test(DeforestoryAdd::class)
        ->set('title_id', 'Artikel Terkunci')
        ->set('title_en', 'Locked Story')
        ->set('desrkirpsi_id', 'Deskripsi artikel.')
        ->set('desrkirpsi_en', 'Story description.')
        ->set('content_id', '<p>Konten.</p>')
        ->set('content_en', '<p>Content.</p>')
        ->set('status', 'draft')
        ->set('is_locked', false)
        ->call('save')
        ->assertHasNoErrors();

    $storyId = DB::table('deforestory')->where('title_id', 'Artikel Terkunci')->value('id');
    $component = Livewire::test(DeforestoryIndex::class)
        ->assertSee('Kunci Preview')
        ->call('toggleLock', $storyId)
        ->assertSee('Buka Kunci');

    expect((bool) DB::table('deforestory')->where('id', $storyId)->value('is_locked'))->toBeTrue();

    $component
        ->call('toggleLock', $storyId)
        ->assertSee('Kunci Preview');

    expect((bool) DB::table('deforestory')->where('id', $storyId)->value('is_locked'))->toBeFalse();
});

it('searches Deforestory titles in Indonesian and English', function () {
    foreach ([
        ['Jejak Nikel Sulawesi Unik', 'Unique Sulawesi Nickel Story'],
        ['Pemulihan Hutan Papua Unik', 'Unique Papua Forest Recovery'],
    ] as [$titleId, $titleEn]) {
        Livewire::test(DeforestoryAdd::class)
            ->set('title_id', $titleId)
            ->set('title_en', $titleEn)
            ->set('desrkirpsi_id', 'Deskripsi pencarian.')
            ->set('desrkirpsi_en', 'Search description.')
            ->set('content_id', '<p>Konten.</p>')
            ->set('content_en', '<p>Content.</p>')
            ->set('date', '2099-01-01')
            ->set('status', 'draft')
            ->call('save')
            ->assertHasNoErrors();
    }

    Livewire::test(DeforestoryIndex::class)
        ->set('search', 'nikel sulawesi unik')
        ->assertSee('Jejak Nikel Sulawesi Unik')
        ->assertDontSee('Pemulihan Hutan Papua Unik')
        ->set('search', 'papua forest recovery')
        ->assertSee('Pemulihan Hutan Papua Unik')
        ->assertDontSee('Jejak Nikel Sulawesi Unik');
});

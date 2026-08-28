<?php

use App\Livewire\DeforestoryAdd;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

it('provides a bilingual default Tiptap template with three images and the requested paragraph order', function () {
    $component = new DeforestoryAdd;

    $component->loadTemplateContent();

    foreach ([$component->content_id, $component->content_en] as $content) {
        expect($content)->not->toContain('data-story-gallery')
            ->and(substr_count($content, '<figure'))->toBe(3)
            ->and(substr_count($content, '<p>'))->toBe(5)
            ->and(strpos($content, '<figure'))->toBeLessThan(strpos($content, '<p>'));
    }
});

it('keeps TinyMCE custom mode empty and restores the default content only for Tiptap template mode', function () {
    Livewire::test(DeforestoryAdd::class)
        ->set('content_type', 'custom')
        ->assertSet('content_id', '')
        ->assertSet('content_en', '')
        ->set('content_type', 'template')
        ->assertSet('content_id', fn (string $content): bool => substr_count($content, '<figure') === 3)
        ->assertSet('content_en', fn (string $content): bool => substr_count($content, '<figure') === 3);
});

it('limits both CMS descriptions to 150 characters', function () {
    Livewire::test(DeforestoryAdd::class)
        ->set('desrkirpsi_id', str_repeat('a', 151))
        ->set('desrkirpsi_en', str_repeat('b', 151))
        ->call('save')
        ->assertHasErrors([
            'desrkirpsi_id' => 'max',
            'desrkirpsi_en' => 'max',
        ]);
});

it('stores both hero image descriptions from the CMS form', function () {
    Livewire::test(DeforestoryAdd::class)
        ->set('title_id', 'Story dengan Caption Hero')
        ->set('title_en', 'Story with a Hero Caption')
        ->set('desrkirpsi_id', 'Ringkasan story dengan caption hero.')
        ->set('desrkirpsi_en', 'Story summary with a hero caption.')
        ->set('image_description_id', 'Foto udara hutan, sumber Auriga Nusantara.')
        ->set('image_description_en', 'Aerial forest photo, source Auriga Nusantara.')
        ->set('date', '2026-08-28')
        ->set('status', 'draft')
        ->call('save')
        ->assertHasNoErrors();

    $story = DB::table('deforestory')
        ->where('title_id', 'Story dengan Caption Hero')
        ->first();

    expect($story->image_description_id)
        ->toBe('Foto udara hutan, sumber Auriga Nusantara.')
        ->and($story->image_description_en)
        ->toBe('Aerial forest photo, source Auriga Nusantara.');
});

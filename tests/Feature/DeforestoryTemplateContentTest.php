<?php

use App\Livewire\DeforestoryAdd;
use Livewire\Livewire;

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

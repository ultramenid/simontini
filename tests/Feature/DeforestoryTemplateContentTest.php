<?php

use App\Livewire\DeforestoryAdd;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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

it('keeps bilingual content editors without floating language markers', function () {
    $view = file_get_contents(resource_path('views/livewire/deforestory-add.blade.php'));

    expect($view)
        ->toContain('data-content-editor-language="id"')
        ->toContain('data-content-editor-language="en"')
        ->not->toContain('data-content-editor-jump=')
        ->not->toContain('content-language-switcher');
});

it('places both story titles before the image upload fields', function () {
    $view = file_get_contents(resource_path('views/livewire/deforestory-add.blade.php'));

    expect(strpos($view, 'Judul Indonesia'))->toBeLessThan(strpos($view, 'Media Indonesia'))
        ->and(strpos($view, 'Judul Inggris'))->toBeLessThan(strpos($view, 'Media Indonesia'));
});

it('uses compact TinyMCE editors for both hero image descriptions', function () {
    $view = file_get_contents(resource_path('views/livewire/deforestory-add.blade.php'));
    $component = file_get_contents(resource_path('views/components/tinymce-editor.blade.php'));
    $script = file_get_contents(resource_path('js/app.js'));

    expect($view)
        ->toContain('wire:model="image_description_id"')
        ->toContain('wire:model="image_description_en"')
        ->toContain('preset="caption"')
        ->not->toContain('<textarea wire:model="image_description_id"')
        ->not->toContain('<textarea wire:model="image_description_en"')
        ->and($component)
        ->toContain('data-tinymce-preset="{{ $preset }}"')
        ->and($script)
        ->toContain("wrapper.dataset.tinymcePreset === 'caption'")
        ->toContain('height: isCaptionEditor ? 220 : 560')
        ->toContain("? 'undo redo | fontsize | bold italic underline")
        ->toContain("? '10px 11px 12px 14px 16px 18px 20px 24px'")
        ->toContain("font-size: \${isCaptionEditor ? '12px' : '16px'}");
});

it('accepts and stores a Deforestory video smaller than fifty megabytes', function () {
    Storage::fake('public');
    $video = UploadedFile::fake()->create('hero-deforestory.mp4', 49 * 1024, 'video/mp4');

    Livewire::test(DeforestoryAdd::class)
        ->set('title_id', 'Story dengan Video')
        ->set('title_en', 'Story with Video')
        ->set('desrkirpsi_id', 'Ringkasan story dengan video.')
        ->set('desrkirpsi_en', 'Story summary with video.')
        ->set('image_id', $video)
        ->set('date', '2026-09-01')
        ->set('status', 'draft')
        ->call('save')
        ->assertHasNoErrors();

    $story = DB::table('deforestory')->where('title_id', 'Story dengan Video')->first();
    $storedVideo = $story->image_id;

    expect($storedVideo)->toEndWith('.mp4')
        ->and($story->image_en)->toBeNull()
        ->and(config('livewire.temporary_file_upload.rules'))->toContain('max:51200');
    Storage::disk('public')->assertExists($storedVideo);
});

it('stores Indonesian and English Deforestory media separately', function () {
    Storage::fake('public');

    Livewire::test(DeforestoryAdd::class)
        ->set('title_id', 'Story dengan Dua Media')
        ->set('title_en', 'Story with Two Media Files')
        ->set('desrkirpsi_id', 'Ringkasan story dengan dua media.')
        ->set('desrkirpsi_en', 'Story summary with two media files.')
        ->set('image_id', UploadedFile::fake()->create('hero-indonesia.mp4', 1024, 'video/mp4'))
        ->set('image_en', UploadedFile::fake()->create('hero-english.webm', 1024, 'video/webm'))
        ->set('date', '2026-09-01')
        ->set('status', 'draft')
        ->call('save')
        ->assertHasNoErrors();

    $story = DB::table('deforestory')->where('title_id', 'Story dengan Dua Media')->first();

    expect($story->image_id)->toStartWith('deforestory/id/')
        ->and($story->image_en)->toStartWith('deforestory/en/')
        ->and($story->image_en)->not->toBe($story->image_id);
    Storage::disk('public')->assertExists($story->image_id);
    Storage::disk('public')->assertExists($story->image_en);
});

it('rejects Deforestory media larger than fifty megabytes', function () {
    $video = UploadedFile::fake()->create('video-terlalu-besar.mp4', (50 * 1024) + 1, 'video/mp4');
    $component = new DeforestoryAdd;
    $rulesMethod = new ReflectionMethod($component, 'rules');
    $rules = $rulesMethod->invoke($component);
    $validator = Validator::make(['image_id' => $video], ['image_id' => $rules['image_id']]);

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('image_id'))->toBeTrue();
});

it('shows upload progress and prevents saving while media is uploading', function () {
    $view = file_get_contents(resource_path('views/livewire/deforestory-add.blade.php'));

    expect($view)
        ->toContain('x-on:livewire-upload-start="uploading = true; progress = 0"')
        ->toContain('x-on:livewire-upload-progress="progress = $event.detail.progress"')
        ->toContain('Mengunggah media Indonesia...')
        ->toContain('Mengunggah media Inggris...')
        ->toContain('wire:model="image_id"')
        ->toContain('wire:model="image_en"')
        ->toContain('wire:target="save,image_id,image_en"')
        ->toContain('Menunggu upload...');
});

it('uses selectable cards for the TinyMCE Data and Grafik picker', function () {
    $script = file_get_contents(resource_path('js/app.js'));

    expect($script)
        ->toContain("modal.dataset.visualizationCardPicker = ''")
        ->toContain('card.dataset.visualizationCard = String(item.id)')
        ->toContain("badge.textContent = 'Dipilih'")
        ->toContain("width: 'min(1400px, 100%)'")
        ->toContain("? 'repeat(4, minmax(0, 1fr))'")
        ->toContain("? 'repeat(2, minmax(0, 1fr))'")
        ->toContain("height: 'min(540px, calc(100vh - 250px))'")
        ->toContain('const visualizationsPerPage = 8')
        ->toContain('renderVisualizationPage')
        ->toContain('Menampilkan ${firstIndex + 1}–${lastIndex} dari ${cards.length} data')
        ->toContain("createPageButton('‹'")
        ->toContain("createPageButton('›'")
        ->toContain("width: '960px'")
        ->toContain('const scale = preview.clientWidth / 960')
        ->toContain("outline: 'none'")
        ->toContain("iframeWindow.addEventListener('keydown', onPickerKeydown, true)")
        ->toContain("if (event.key !== 'Escape') return")
        ->toContain("insertButton.textContent = 'Masukkan Grafik'")
        ->not->toContain("name: 'visualizationId'");
});

it('rewrites stored TinyMCE stoppers to the brand square on the public story page', function () {
    $oldStopper = '<span class="story-inline-stopper" data-story-inline-stopper="true" contenteditable="false" aria-hidden="true" style="display: inline-block; width: .7em; height: .7em; margin-left: 1px; background: #FF0000; vertical-align: middle; line-height: 1;">&nbsp;</span>';

    $id = DB::table('deforestory')->insertGetId([
        'title_id' => 'Cerita Stopper Lama',
        'title_en' => 'Old Stopper Story',
        'slug' => 'cerita-stopper-lama-'.uniqid(),
        'desrkirpsi_id' => 'Deskripsi cerita stopper.',
        'desrkirpsi_en' => 'Stopper story description.',
        'date' => '2026-09-04',
        'content_id' => '<p>hektare'.$oldStopper.'</p>',
        'content_en' => '<p>hectares'.$oldStopper.'</p>',
        'status' => 'publish',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $story = DB::table('deforestory')->find($id);

    $this->get(route('deforestation.show', [
        'locale' => 'id',
        'id' => $story->id,
        'slug' => $story->slug,
    ]))
        ->assertOk()
        ->assertSee('hektare', false)
        ->assertSee('width:8px;height:8px', false)
        ->assertSee('background:#d71920', false)
        ->assertDontSee('width: .7em', false)
        ->assertDontSee('background: #FF0000', false);
});

it('provides an inline red stopper at the current TinyMCE cursor position', function () {
    $script = file_get_contents(resource_path('js/app.js'));
    $styles = file_get_contents(resource_path('css/app.css'));

    expect($script)
        ->toContain('addBorderMerah addStopper')
        ->toContain("text: '+ Stopper'")
        ->toContain('data-story-inline-stopper="true"')
        ->toContain('margin-left:1px')
        ->not->toContain("insertContent('&nbsp;<span class=\"story-inline-stopper\"")
        ->toContain('position:relative;top:1px')
        ->toContain('vertical-align:middle')
        ->toContain('width:8px;height:8px')
        ->toContain('background:#d71920')
        ->toContain("replace(/[\\u00a0 ]+$/, '')")
        ->toContain('normalizeInlineStoppers();')
        ->toContain('editor.undoManager.transact')
        ->and($styles)
        ->toContain('.public-story-content .story-inline-stopper')
        ->toContain('width: 8px !important;')
        ->toContain('height: 8px !important;')
        ->toContain('background: #d71920 !important');
});

it('uses twelve pixel descriptions for story images and GLightbox', function () {
    $script = file_get_contents(resource_path('js/app.js'));
    $styles = file_get_contents(resource_path('css/app.css'));

    expect($script)
        ->not->toContain('story-content-caption" style="margin: 4px 0 0; padding: 0; color: #000; font-size: 14px')
        ->toContain('story-content-caption" style="margin: 4px 0 0; padding: 0; color: #000; font-size: 12px')
        ->and($styles)
        ->toContain('font-size: .75rem !important;')
        ->toContain('.glightbox-container .gslide-desc')
        ->toContain('font-size: 12px !important;');
});

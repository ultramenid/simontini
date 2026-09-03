<?php

use App\Livewire\ReferenceIndex;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(DatabaseTransactions::class);

it('requires a title and description when uploading a reference image', function () {
    Storage::fake('public');

    Livewire::test(ReferenceIndex::class)
        ->set('image', UploadedFile::fake()->image('forest.jpg'))
        ->call('save')
        ->assertHasErrors(['title' => 'required', 'alt_text' => 'required']);
});

it('uploads a complete reference image', function () {
    Storage::fake('public');

    Livewire::test(ReferenceIndex::class)
        ->set('image', UploadedFile::fake()->image('forest.jpg'))
        ->set('title', 'Hutan Indonesia')
        ->set('alt_text', 'Pemandangan hutan Indonesia')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('reference_images', [
        'title' => 'Hutan Indonesia',
        'alt_text' => 'Pemandangan hutan Indonesia',
    ]);
});

it('uploads a non-image reference file to private storage', function () {
    Storage::fake('local');

    Livewire::test(ReferenceIndex::class)
        ->set('image', UploadedFile::fake()->create('laporan.pdf', 100, 'application/pdf'))
        ->set('title', 'Laporan Deforestasi')
        ->set('alt_text', 'Dokumen laporan deforestasi')
        ->call('save')
        ->assertHasNoErrors();

    $file = DB::table('reference_images')
        ->where('title', 'Laporan Deforestasi')
        ->first();

    expect($file)
        ->not->toBeNull()
        ->and($file->disk)->toBe('local')
        ->and($file->mime_type)->toBe('application/pdf')
        ->and($file->original_name)->toBe('laporan.pdf');

    Storage::disk('local')->assertExists($file->image_path);
});

it('accepts GIF video PDF and Word reference files up to fifty megabytes', function (string $name, string $mimeType, string $expectedDisk) {
    Storage::fake($expectedDisk);

    Livewire::test(ReferenceIndex::class)
        ->set('image', UploadedFile::fake()->create($name, 100, $mimeType))
        ->set('title', 'Reference '.$name)
        ->set('alt_text', 'Deskripsi '.$name)
        ->call('save')
        ->assertHasNoErrors();

    $file = DB::table('reference_images')->where('original_name', $name)->first();

    expect($file)
        ->not->toBeNull()
        ->and($file->disk)->toBe($expectedDisk)
        ->and($file->mime_type)->toBe($mimeType);

    Storage::disk($expectedDisk)->assertExists($file->image_path);
})->with([
    'GIF' => ['animasi.gif', 'image/gif', 'public'],
    'MP4' => ['video.mp4', 'video/mp4', 'local'],
    'PDF' => ['laporan.pdf', 'application/pdf', 'local'],
    'DOC' => ['dokumen.doc', 'application/msword', 'local'],
    'DOCX' => ['dokumen.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'local'],
]);

it('rejects unsupported reference formats and files larger than fifty megabytes', function () {
    Livewire::test(ReferenceIndex::class)
        ->set('image', UploadedFile::fake()->create('program.exe', 100, 'application/octet-stream'))
        ->set('title', 'Program')
        ->set('alt_text', 'File tidak didukung')
        ->call('save')
        ->assertHasErrors(['image']);

    Livewire::test(ReferenceIndex::class)
        ->set('image', UploadedFile::fake()->create('video-besar.mp4', (50 * 1024) + 1, 'video/mp4'))
        ->set('title', 'Video Besar')
        ->set('alt_text', 'Video lebih dari batas')
        ->call('save')
        ->assertHasErrors(['image']);
});

it('shows the supported Reference formats and fifty megabyte limit', function () {
    $view = file_get_contents(resource_path('views/livewire/reference-index.blade.php'));

    expect($view)
        ->toContain('accept=".jpg,.jpeg,.png,.webp,.gif,.mp4,.mov,.webm,.pdf,.doc,.docx')
        ->toContain('JPG, PNG, WebP, GIF, MP4, MOV, WebM, PDF, DOC, atau DOCX.')
        ->toContain('Maksimal 50 MB per file.');
});

it('shows upload progress and replaces the temporary preview when another file is selected', function () {
    $view = file_get_contents(resource_path('views/livewire/reference-index.blade.php'));

    expect($view)
        ->toContain('x-on:livewire-upload-start="startUpload()"')
        ->toContain('x-on:livewire-upload-finish="finishUpload()"')
        ->toContain('x-on:livewire-upload-progress="progress = $event.detail.progress"')
        ->toContain('Mengunggah dan menyiapkan preview...')
        ->toContain('Upload selesai, menampilkan preview...')
        ->toContain('this.progress = 100;')
        ->toContain('}, 700);')
        ->toContain('x-transition:leave="transition ease-in duration-300"')
        ->toContain('x-bind:style="`width: ${progress}%`"')
        ->toContain('x-show="!uploading"')
        ->toContain('wire:key="reference-preview-{{ md5($image->getFilename()) }}"')
        ->toContain('x-bind:disabled="uploading"');
});

it('allows Livewire to generate temporary GIF video and PDF previews', function () {
    expect(config('livewire.temporary_file_upload.preview_mimes'))
        ->toContain('gif')
        ->toContain('mp4')
        ->toContain('mov')
        ->toContain('webm')
        ->toContain('pdf');
});

it('renders temporary and saved video previews in Reference', function () {
    Storage::fake('local');
    Storage::disk('local')->put('reference-files/video.mp4', 'fake-video-content');

    $id = DB::table('reference_images')->insertGetId([
        'title' => 'Video Hutan',
        'alt_text' => 'Video kondisi hutan',
        'image_path' => 'reference-files/video.mp4',
        'disk' => 'local',
        'original_name' => 'video.mp4',
        'mime_type' => 'video/mp4',
        'file_size' => 18,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->get('/cms/reference')
        ->assertOk()
        ->assertSee('<video', false)
        ->assertSee(route('cms.reference.preview', $id), false)
        ->assertSee('controls', false)
        ->assertSee('preload="metadata"', false);

    $view = file_get_contents(resource_path('views/livewire/reference-index.blade.php'));

    expect($view)
        ->toContain('$image->temporaryUrl() }}" controls preload="metadata"')
        ->toContain("str_starts_with(\$image->getMimeType() ?: '', 'video/')");
});

it('streams a private Reference video inline for an authenticated preview', function () {
    Storage::fake('local');
    Storage::disk('local')->put('reference-files/video-preview.mp4', 'fake-video-content');

    $id = DB::table('reference_images')->insertGetId([
        'title' => 'Video Preview',
        'alt_text' => 'Preview video hutan',
        'image_path' => 'reference-files/video-preview.mp4',
        'disk' => 'local',
        'original_name' => 'video-preview.mp4',
        'mime_type' => 'video/mp4',
        'file_size' => 18,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->get(route('cms.reference.preview', $id))
        ->assertOk()
        ->assertHeader('content-type', 'video/mp4')
        ->assertHeader('content-disposition', 'inline; filename=video-preview.mp4');
});

it('renders and streams a private PDF preview', function () {
    Storage::fake('local');
    Storage::disk('local')->put('reference-files/laporan-preview.pdf', '%PDF-fake-content');

    $id = DB::table('reference_images')->insertGetId([
        'title' => 'Laporan Preview',
        'alt_text' => 'Preview laporan PDF',
        'image_path' => 'reference-files/laporan-preview.pdf',
        'disk' => 'local',
        'original_name' => 'laporan-preview.pdf',
        'mime_type' => 'application/pdf',
        'file_size' => 18,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->get('/cms/reference')
        ->assertOk()
        ->assertSee('<iframe', false)
        ->assertSee(route('cms.reference.preview', $id), false);

    $this->withSession(['id' => 1])
        ->get(route('cms.reference.preview', $id))
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf')
        ->assertHeader('content-disposition', 'inline; filename=laporan-preview.pdf');

    $view = file_get_contents(resource_path('views/livewire/reference-index.blade.php'));

    expect($view)->toContain('$image->temporaryUrl() }}" title="Preview PDF"');
});

it('renders a Tiptap selection button for the requested editor', function () {
    Storage::fake('public');

    DB::table('reference_images')->insert([
        'title' => 'Hutan Pilihan',
        'alt_text' => 'Deskripsi hutan pilihan',
        'image_path' => 'references/forest.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->get('https://stg.simontini.id/cms/reference?picker=1&editor=content_id')
        ->assertOk()
        ->assertSee('data-tiptap-reference-select', false)
        ->assertSee('data-editor-key="content_id"', false)
        ->assertSee('https://stg.simontini.id/storage/references/forest.jpg', false)
        ->assertSee('Pilih untuk Editor');
});

it('renders multi-image GLightbox controls for a TinyMCE picker', function () {
    Storage::fake('public');

    DB::table('reference_images')->insert([
        'title' => 'Galeri Hutan',
        'alt_text' => 'Dokumentasi galeri hutan',
        'image_path' => 'references/gallery.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->get('/cms/reference?picker=1&multiple=1&editor=content_id')
        ->assertOk()
        ->assertSee('data-reference-gallery-panel', false)
        ->assertSee('data-reference-gallery-toggle', false)
        ->assertSee('data-reference-gallery-caption', false)
        ->assertSee('data-editor-key="content_id"', false)
        ->assertSee('Masukkan Galeri ke Editor');
});

it('renders the reference picker without the CMS chrome inside a modal', function () {
    $response = $this->withSession(['id' => 1])
        ->get('/cms/reference?picker=1&multiple=1&modal=1&editor=content_id');

    $response
        ->assertOk()
        ->assertSee('data-reference-gallery-panel', false);

    $view = file_get_contents(resource_path('views/backends/reference.blade.php'));

    expect($view)
        ->toContain('@unless ($modal ?? false)')
        ->toContain('($modal ?? false) ? \'px-4 py-5\'');
});

it('opens the TinyMCE reference picker in an in-page modal', function () {
    $script = file_get_contents(resource_path('js/app.js'));

    expect($script)
        ->toContain("pickerUrl.searchParams.set('modal', '1')")
        ->toContain('overlay.dataset.tinymceReferenceModal')
        ->toContain("iframe.title = 'Reference Simontini'")
        ->toContain('window.parent.postMessage(payload, window.location.origin)')
        ->toContain("iframeWindow?.addEventListener('keydown', onKeydown, true)")
        ->toContain("iframeWindow?.removeEventListener('keydown', referencePickerModal.onKeydown, true)")
        ->toContain('closeReferencePickerModal(false)');
});

it('limits a Before After picker to exactly two images', function () {
    $this->withSession(['id' => 1])
        ->get('/cms/reference?picker=1&multiple=1&limit=2&purpose=before-after&editor=content_id')
        ->assertOk()
        ->assertSee('Pilih tepat 2 gambar')
        ->assertSee('data-reference-selection-limit="2"', false)
        ->assertSee('data-reference-selection-exact="2"', false)
        ->assertSee('Masukkan Before/After');
});

it('hides non-image files from an editor image picker', function () {
    Storage::fake('local');

    DB::table('reference_images')->insert([
        'title' => 'Dokumen Rahasia',
        'alt_text' => 'Dokumen bukan gambar',
        'image_path' => 'reference-files/document.pdf',
        'disk' => 'local',
        'original_name' => 'document.pdf',
        'mime_type' => 'application/pdf',
        'file_size' => 1024,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->withSession(['id' => 1])
        ->get('/cms/reference?picker=1&editor=content_id')
        ->assertOk()
        ->assertDontSee('Dokumen Rahasia');
});

it('keeps the TinyMCE single image output at a sixteen by nine ratio', function () {
    $script = file_get_contents(resource_path('js/app.js'));

    expect($script)
        ->toContain('story-single-image-figure')
        ->toContain('class="story-single-image"')
        ->toContain('aspect-ratio: 16 / 9')
        ->toContain('object-fit: cover');
});

it('separates Before After dragging from its management click', function () {
    $script = file_get_contents(resource_path('js/app.js'));

    expect($script)
        ->toContain('beforeAfterPointerGesture')
        ->toContain('suppressedBeforeAfterClick')
        ->toContain('installBeforeAfterPointerControls')
        ->toContain("editorDocument.addEventListener('pointerdown'")
        ->toContain('editorDocument.elementsFromPoint?.(event.clientX, event.clientY)')
        ->toContain('clickedOnHandle')
        ->toContain("editorDocument.addEventListener('dragstart'")
        ->toContain("block.setAttribute('draggable', 'false')")
        ->toContain('range.setPointerCapture?.(event.pointerId)')
        ->toContain("editorDocument.addEventListener('pointermove', moveSlider, true)")
        ->toContain("comparison.style.setProperty('--before-after-position'");
});

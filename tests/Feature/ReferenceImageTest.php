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
        ->assertSee('Pilih untuk Tiptap');
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

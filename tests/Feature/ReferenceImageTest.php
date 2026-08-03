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
        ->get('/cms/reference?picker=1&editor=content_id')
        ->assertOk()
        ->assertSee('data-tiptap-reference-select', false)
        ->assertSee('data-editor-key="content_id"', false)
        ->assertSee('Pilih untuk Tiptap');
});

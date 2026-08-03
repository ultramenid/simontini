<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ReferenceIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $image;

    public string $title = '';

    public string $alt_text = '';

    public bool $showForm = false;

    public bool $picker = false;

    public string $editorKey = '';

    public function mount(bool $picker = false, string $editorKey = ''): void
    {
        $this->picker = $picker;
        $this->editorKey = $editorKey;
    }

    protected function rules(): array
    {
        return [
            'image' => ['required', 'image', 'max:5120'],
            'title' => ['required', 'string', 'max:255'],
            'alt_text' => ['required', 'string', 'max:255'],
        ];
    }

    public function toggleForm(): void
    {
        $this->showForm = ! $this->showForm;
        $this->resetValidation();
    }

    public function save(): void
    {
        $validated = $this->validate();
        $path = $this->image->store('references', 'public');

        DB::table('reference_images')->insert([
            'title' => $validated['title'],
            'alt_text' => $validated['alt_text'],
            'image_path' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->reset(['image', 'title', 'alt_text']);
        $this->showForm = false;
        $this->resetPage();

        session()->flash('success', 'Gambar reference berhasil diunggah.');
    }

    public function delete(int $id): void
    {
        $item = DB::table('reference_images')->find($id);

        if ($item === null) {
            return;
        }

        DB::table('reference_images')->where('id', $id)->delete();
        Storage::disk('public')->delete($item->image_path);

        $this->resetPage();
        session()->flash('success', 'Gambar reference berhasil dihapus.');
    }

    public function render()
    {
        $items = DB::table('reference_images')
            ->orderByDesc('id')
            ->paginate(12);

        return view('livewire.reference-index', compact('items'));
    }
}

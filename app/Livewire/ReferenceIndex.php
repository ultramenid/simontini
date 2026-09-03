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

    public bool $multiple = false;

    public int $selectionLimit = 0;

    public string $pickerPurpose = '';

    public string $editorKey = '';

    public function mount(bool $picker = false, bool $multiple = false, int $selectionLimit = 0, string $pickerPurpose = '', string $editorKey = ''): void
    {
        $this->picker = $picker;
        $this->multiple = $multiple;
        $this->selectionLimit = max(0, $selectionLimit);
        $this->pickerPurpose = $pickerPurpose;
        $this->editorKey = $editorKey;
    }

    protected function rules(): array
    {
        return [
            'image' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,gif,mp4,mov,webm,pdf,doc,docx',
                'max:51200',
            ],
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
        $mimeType = $this->image->getMimeType() ?: 'application/octet-stream';
        $isImage = str_starts_with($mimeType, 'image/');
        $disk = $isImage ? 'public' : 'local';
        $directory = $isImage ? 'references' : 'reference-files';
        $path = $this->image->store($directory, $disk);

        DB::table('reference_images')->insert([
            'title' => $validated['title'],
            'alt_text' => $validated['alt_text'],
            'image_path' => $path,
            'disk' => $disk,
            'original_name' => $this->image->getClientOriginalName(),
            'mime_type' => $mimeType,
            'file_size' => $this->image->getSize(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->reset(['image', 'title', 'alt_text']);
        $this->showForm = false;
        $this->resetPage();

        session()->flash('success', 'File reference berhasil diunggah.');
    }

    public function delete(int $id): void
    {
        $item = DB::table('reference_images')->find($id);

        if ($item === null) {
            return;
        }

        DB::table('reference_images')->where('id', $id)->delete();
        Storage::disk($item->disk ?: 'public')->delete($item->image_path);

        $this->resetPage();
        session()->flash('success', 'File reference berhasil dihapus.');
    }

    public function render()
    {
        $items = DB::table('reference_images')
            ->when($this->picker, function ($query) {
                $query->where(function ($images) {
                    $images
                        ->where('mime_type', 'like', 'image/%')
                        ->orWhereNull('mime_type');
                });
            })
            ->orderByDesc('id')
            ->paginate(12);

        return view('livewire.reference-index', compact('items'));
    }
}

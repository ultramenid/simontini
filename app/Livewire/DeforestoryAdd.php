<?php

namespace App\Livewire;

use App\Services\DeforestationStoryNotificationDispatcher;
use App\Services\DeforestationStoryWebhookDispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class DeforestoryAdd extends Component
{
    use WithFileUploads;

    public ?int $deforestoryId = null;

    public $image_id;

    public $image_en;

    public ?string $currentImageId = null;

    public ?string $currentImageEn = null;

    public string $title_id = '';

    public string $title_en = '';

    public string $desrkirpsi_id = '';

    public string $desrkirpsi_en = '';

    public string $content_type = 'template';

    public string $date = '';

    public string $content_id = '';

    public string $content_en = '';

    public string $status = 'draft';

    public function mount(?int $deforestoryId = null): void
    {
        $this->deforestoryId = $deforestoryId;

        if ($this->deforestoryId === null) {
            $this->date = now()->toDateString();
            $this->loadTemplateContent();

            return;
        }

        $item = DB::table('deforestory')->find($this->deforestoryId);

        abort_if($item === null, 404);

        $this->title_id = $item->title_id;
        $this->title_en = $item->title_en;
        $this->desrkirpsi_id = $item->desrkirpsi_id;
        $this->desrkirpsi_en = $item->desrkirpsi_en;
        $this->content_type = $item->content_type ?? 'template';
        $this->date = $item->date;
        $this->content_id = $item->content_id;
        $this->content_en = $item->content_en;
        $this->status = $item->status;
        $this->currentImageId = $item->image_id;
        $this->currentImageEn = $item->image_en;
    }

    protected function rules(): array
    {
        return [
            'image_id' => ['nullable', 'image', 'max:3072'],
            'image_en' => ['nullable', 'image', 'max:3072'],
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'desrkirpsi_id' => ['required', 'string'],
            'desrkirpsi_en' => ['required', 'string'],
            'content_type' => ['required', Rule::in(['template', 'custom'])],
            'date' => ['required', 'date'],
            'content_id' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'status' => ['required', Rule::in(['publish', 'draft'])],
        ];
    }

    public function save(
        DeforestationStoryNotificationDispatcher $notifications,
        DeforestationStoryWebhookDispatcher $webhooks,
    )
    {
        $validated = $this->validate();
        unset($validated['image_id'], $validated['image_en']);
        $validated['slug'] = $this->uniqueSlug($this->title_id, $this->deforestoryId);

        if ($this->image_id) {
            $validated['image_id'] = $this->image_id->store('deforestory/id', 'public');

            if ($this->currentImageId) {
                Storage::disk('public')->delete($this->currentImageId);
            }
        }

        if ($this->image_en) {
            $validated['image_en'] = $this->image_en->store('deforestory/en', 'public');

            if ($this->currentImageEn) {
                Storage::disk('public')->delete($this->currentImageEn);
            }
        }

        if ($this->deforestoryId === null) {
            $storyId = DB::table('deforestory')->insertGetId([
                ...$validated,
                'uuid' => (string) Str::uuid(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($validated['status'] === 'publish') {
                $notifications->queueNewStory($storyId);
                $webhooks->dispatch($storyId, 'created');
            }

            session()->flash('success', 'Data Deforestory berhasil ditambahkan.');
        } else {
            $previousStatus = DB::table('deforestory')->where('id', $this->deforestoryId)->value('status');
            DB::table('deforestory')
                ->where('id', $this->deforestoryId)
                ->update([
                    ...$validated,
                    'updated_at' => now(),
                ]);

            if ($validated['status'] === 'publish' && $previousStatus !== 'publish') {
                $notifications->queueNewStory($this->deforestoryId);
            }

            if ($validated['status'] === 'publish') {
                $webhooks->dispatch(
                    $this->deforestoryId,
                    $previousStatus === 'publish' ? 'updated' : 'created',
                );
            } elseif ($previousStatus === 'publish') {
                $webhooks->dispatch($this->deforestoryId, 'unpublished');
            }

            session()->flash('success', 'Data Deforestory berhasil diperbarui.');
        }

        return $this->redirectRoute('cms.deforestory', navigate: true);
    }

    public function render()
    {
        return view('livewire.deforestory-add');
    }

    public function updatedContentType(string $contentType): void
    {
        if ($contentType === 'custom') {
            $this->content_id = '';
            $this->content_en = '';

            return;
        }

        if ($contentType === 'template') {
            $this->loadTemplateContent();
        }
    }

    public function loadTemplateContent(): void
    {
        $this->content_id = <<<'HTML'
<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Gambar+Pertama" alt="Ganti dengan deskripsi gambar pertama" width="100%"><figcaption class="story-content-caption">Caption, sumber, dan kredit gambar pertama.</figcaption></figure>
<p>Paragraf pertama: tulis konteks bentang alam, nilai ekologis, masyarakat, dan isu utama yang dibahas.</p>
<p>Paragraf kedua: jelaskan latar belakang serta alasan story ini penting bagi pembaca.</p>
<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Gambar+Utama" alt="Ganti dengan deskripsi gambar utama" width="100%"><figcaption class="story-content-caption">Caption, sumber gambar, dan kredit.</figcaption></figure>
<p>Paragraf ketiga: jelaskan tekanan, perubahan tutupan lahan, kegiatan ekstraktif, atau temuan penting.</p>
<p>Paragraf keempat: tulis metode pemantauan, sumber data, analisis citra, dan hasil verifikasi lapangan.</p>
<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Gambar+Pendukung" alt="Ganti dengan deskripsi gambar pendukung" width="100%"><figcaption class="story-content-caption">Caption gambar pendukung, sumber, dan kredit.</figcaption></figure>
<p>Paragraf penutup: tulis kesimpulan, rekomendasi, atau tindakan yang diperlukan.</p>
HTML;

        $this->content_en = <<<'HTML'
<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=First+Image" alt="Replace with the first image description" width="100%"><figcaption class="story-content-caption">Caption, source, and credit for the first image.</figcaption></figure>
<p>First paragraph: explain the landscape context, ecological value, local communities, and the main issue.</p>
<p>Second paragraph: provide the background and explain why this story matters to readers.</p>
<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Main+Image" alt="Replace with the main image description" width="100%"><figcaption class="story-content-caption">Caption, image source, and credit.</figcaption></figure>
<p>Third paragraph: describe pressures, land-cover changes, extractive activities, or important findings.</p>
<p>Fourth paragraph: explain monitoring methods, data sources, imagery analysis, and field verification.</p>
<figure class="story-content-figure"><img src="https://placehold.co/1200x750?text=Supporting+Image" alt="Replace with a supporting image description" width="100%"><figcaption class="story-content-caption">Supporting image caption, source, and credit.</figcaption></figure>
<p>Closing paragraph: write the conclusion, recommendations, or actions required.</p>
HTML;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'deforestation-story';
        $slug = $baseSlug;
        $suffix = 2;

        while (DB::table('deforestory')
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}

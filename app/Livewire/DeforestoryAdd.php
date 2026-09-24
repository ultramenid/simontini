<?php

namespace App\Livewire;

use App\Services\DeforestationStoryNotificationDispatcher;
use App\Services\DeforestationStoryWebhookDispatcher;
use App\Services\StoryHtmlSanitizer;
use App\Support\DeforestationStoryStopper;
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

    public string $image_description_id = '';

    public string $image_description_en = '';

    public string $title_id = '';

    public string $title_en = '';

    public string $index_title_id = '';

    public string $index_title_en = '';

    public string $category = '';

    public string $category_pair = '';

    public string $category_id = '';

    public string $category_en = '';

    public string $category_id_custom = '';

    public string $category_en_custom = '';

    public string $categorySaveMessage = '';

    public string $region = '';

    public string $region_pair = '';

    public string $region_id = '';

    public string $region_en = '';

    public string $region_id_custom = '';

    public string $region_en_custom = '';

    public string $regionSaveMessage = '';

    public int $meta_font_size = 14;

    public string $desrkirpsi_id = '';

    public string $desrkirpsi_en = '';

    public string $content_type = 'template';

    public string $date = '';

    public bool $show_date = true;

    public string $content_id = '';

    public string $content_en = '';

    public string $footer_id = '';

    public string $footer_en = '';

    public string $status = 'draft';

    public bool $is_locked = false;

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
        $this->index_title_id = $item->index_title_id ?? '';
        $this->index_title_en = $item->index_title_en ?? '';
        $this->category = $item->category ?? '';
        $this->category_id = $item->category_id ?? $item->category ?? '';
        $this->category_en = $item->category_en ?? $item->category ?? '';
        $this->category_pair = $this->categoryPairKey($this->category_id, $this->category_en);
        $this->region = $item->region ?? '';
        $this->region_id = $item->region_id ?? $item->region ?? '';
        $this->region_en = $item->region_en ?? $item->region ?? '';
        $this->region_pair = $this->pairKey($this->region_id, $this->region_en);
        $this->meta_font_size = (int) ($item->meta_font_size ?? 14);
        $this->desrkirpsi_id = $item->desrkirpsi_id;
        $this->desrkirpsi_en = $item->desrkirpsi_en;
        $this->content_type = $item->content_type ?? 'template';
        $this->date = $item->date;
        $this->show_date = (bool) ($item->show_date ?? true);
        $this->content_id = $item->content_id;
        $this->content_en = $item->content_en;
        $this->footer_id = $item->footer_id ?? '';
        $this->footer_en = $item->footer_en ?? '';
        $this->status = $item->status;
        $this->is_locked = (bool) ($item->is_locked ?? false);
        $this->currentImageId = $item->image_id;
        $this->currentImageEn = $item->image_en;
        $this->image_description_id = $item->image_description_id ?? '';
        $this->image_description_en = $item->image_description_en ?? '';
    }

    protected function rules(): array
    {
        return [
            'image_id' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,mp4,mov,webm', 'max:51200'],
            'image_en' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,mp4,mov,webm', 'max:51200'],
            'image_description_id' => ['nullable', 'string'],
            'image_description_en' => ['nullable', 'string'],
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'index_title_id' => ['nullable', 'string', 'max:255'],
            'index_title_en' => ['nullable', 'string', 'max:255'],
            'category_pair' => ['nullable', 'string', 'max:500'],
            'category_id' => ['nullable', 'string', 'max:100'],
            'category_en' => ['nullable', 'string', 'max:100'],
            'category_id_custom' => ['nullable', 'string', 'max:100'],
            'category_en_custom' => ['nullable', 'string', 'max:100'],
            'region_pair' => ['nullable', 'string', 'max:500'],
            'region_id' => ['nullable', 'string', 'max:100'],
            'region_en' => ['nullable', 'string', 'max:100'],
            'region_id_custom' => ['nullable', 'string', 'max:100'],
            'region_en_custom' => ['nullable', 'string', 'max:100'],
            'meta_font_size' => ['required', 'integer', 'min:10', 'max:28'],
            'desrkirpsi_id' => ['required', 'string', 'max:150'],
            'desrkirpsi_en' => ['required', 'string', 'max:150'],
            'content_type' => ['required', Rule::in(['template', 'custom'])],
            'date' => ['required', 'date'],
            'show_date' => ['boolean'],
            'content_id' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'footer_id' => ['nullable', 'string'],
            'footer_en' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['publish', 'draft'])],
            'is_locked' => ['boolean'],
        ];
    }

    public function save(
        DeforestationStoryNotificationDispatcher $notifications,
        DeforestationStoryWebhookDispatcher $webhooks,
    ) {
        $validated = $this->validate();
        unset($validated['image_id'], $validated['image_en']);
        if (($validated['category_pair'] ?? null) === '__custom__') {
            $categoryId = $validated['category_id_custom'] ?? null;
            $categoryEn = $validated['category_en_custom'] ?? null;
        } elseif (filled($validated['category_pair'] ?? null)) {
            [$categoryId, $categoryEn] = $this->parseCategoryPairKey($validated['category_pair']);
        } else {
            $categoryId = null;
            $categoryEn = null;
        }
        unset($validated['category_pair'], $validated['category_id_custom'], $validated['category_en_custom']);

        $validated['category_id'] = blank($categoryId)
            ? null
            : trim($categoryId);
        $validated['category_en'] = blank($categoryEn)
            ? null
            : trim($categoryEn);
        $validated['category'] = $validated['category_id'];

        if (($validated['region_pair'] ?? null) === '__custom__') {
            $regionId = $validated['region_id_custom'] ?? null;
            $regionEn = $validated['region_en_custom'] ?? null;
        } elseif (filled($validated['region_pair'] ?? null)) {
            [$regionId, $regionEn] = $this->parsePairKey($validated['region_pair']);
        } else {
            $regionId = null;
            $regionEn = null;
        }
        unset($validated['region_pair'], $validated['region_id_custom'], $validated['region_en_custom']);

        $validated['region_id'] = blank($regionId)
            ? null
            : trim($regionId);
        $validated['region_en'] = blank($regionEn)
            ? null
            : trim($regionEn);
        $validated['region'] = $validated['region_id'];

        // Sanitasi HTML di sisi server — sanitizer JS di editor mudah dilewati
        // dengan mem-posting langsung ke endpoint Livewire.
        $storySanitizer = app(StoryHtmlSanitizer::class);
        foreach (['content_id', 'content_en', 'footer_id', 'footer_en', 'image_description_id', 'image_description_en'] as $htmlField) {
            $validated[$htmlField] = $storySanitizer->sanitize($validated[$htmlField] ?? '');
        }

        $validated['content_id'] = DeforestationStoryStopper::normalizeHtml($validated['content_id']);
        $validated['content_en'] = DeforestationStoryStopper::normalizeHtml($validated['content_en']);
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

    public function saveCategory(): void
    {
        $this->categorySaveMessage = '';
        $this->category_id_custom = trim($this->category_id_custom);
        $this->category_en_custom = trim($this->category_en_custom);
        $labels = $this->validate([
            'category_id_custom' => ['required', 'string', 'max:100'],
            'category_en_custom' => ['required', 'string', 'max:100'],
        ]);

        $id = $labels['category_id_custom'];
        $en = $labels['category_en_custom'];
        $key = $this->pairKey($id, $en);
        DB::table('deforestory_categories')->insertOrIgnore([
            'label_id' => $id,
            'label_en' => $en,
            'pair_hash' => hash('sha256', $key),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('deforestory_categories')->where('pair_hash', hash('sha256', $key))
            ->update(['deleted_at' => null]);

        $this->category_id = $id;
        $this->category_en = $en;
        $this->category_pair = $key;
        $this->categorySaveMessage = 'Kategori tersimpan dan dipilih. Simpan artikel untuk menerapkannya.';
        $this->dispatch('deforestory-category-saved', key: $key, label: $id.' / '.$en);
        $this->reset('category_id_custom', 'category_en_custom');
    }

    public function deleteCategory(string $key): void
    {
        $this->resetErrorBag('category_pair');
        $category = collect($this->categoryOptions())->firstWhere('key', $key);
        if (! $category) {
            return;
        }
        if ($category['count'] > 0) {
            $this->addError('category_pair', 'Kategori masih digunakan oleh '.$category['count'].' artikel Deforestory. Ubah kategori artikel tersebut terlebih dahulu.');
            return;
        }

        DB::table('deforestory_categories')->updateOrInsert(
            ['pair_hash' => hash('sha256', $key)],
            ['label_id' => $category['id'], 'label_en' => $category['en'],
                'deleted_at' => now(), 'updated_at' => now()],
        );
        if ($this->category_pair === $key) {
            $this->reset('category_pair', 'category_id', 'category_en', 'category');
        }
        $this->categorySaveMessage = 'Kategori dihapus. Artikel Deforestory tetap tersimpan.';
        $this->dispatch('deforestory-category-deleted');
    }

    public function saveRegion(): void
    {
        $this->regionSaveMessage = '';
        $this->region_id_custom = trim($this->region_id_custom);
        $this->region_en_custom = trim($this->region_en_custom);
        $this->validate([
            'region_id_custom' => ['required', 'string', 'max:100'],
            'region_en_custom' => ['required', 'string', 'max:100'],
        ]);
        $id = $this->region_id_custom;
        $en = $this->region_en_custom;
        $key = $this->pairKey($id, $en);
        DB::table('deforestory_regions')->insertOrIgnore([
            'label_id' => $id, 'label_en' => $en, 'pair_hash' => hash('sha256', $key),
            'created_at' => now(), 'updated_at' => now(),
        ]);
        DB::table('deforestory_regions')->where('pair_hash', hash('sha256', $key))->update(['deleted_at' => null]);
        $this->region_id = $id;
        $this->region_en = $en;
        $this->region_pair = $key;
        $this->regionSaveMessage = 'Daerah tersimpan dan dipilih. Simpan artikel untuk menerapkannya.';
        $this->dispatch('deforestory-region-saved', key: $key, label: $id.' / '.$en);
        $this->reset('region_id_custom', 'region_en_custom');
    }

    public function deleteRegion(string $key): void
    {
        $this->resetErrorBag('region_pair');
        $region = collect($this->regionOptions())->firstWhere('key', $key);
        if (! $region) return;
        if ($region['count'] > 0) {
            $this->addError('region_pair', 'Daerah masih digunakan oleh '.$region['count'].' artikel Deforestory. Ubah daerah artikel tersebut terlebih dahulu.');
            return;
        }
        DB::table('deforestory_regions')->updateOrInsert(
            ['pair_hash' => hash('sha256', $key)],
            ['label_id' => $region['id'], 'label_en' => $region['en'], 'deleted_at' => now(), 'updated_at' => now()],
        );
        if ($this->region_pair === $key) {
            $this->reset('region_pair', 'region_id', 'region_en', 'region');
        }
        $this->regionSaveMessage = 'Daerah dihapus. Artikel Deforestory tetap tersimpan.';
        $this->dispatch('deforestory-region-deleted');
    }

    public function render()
    {
        return view('livewire.deforestory-add', [
            'categoryOptions' => $this->categoryOptions(),
            'regionOptions' => $this->regionOptions(),
        ]);
    }

    private function categoryOptions(): array
    {
        $fallback = [
            ['id' => 'Sawit', 'en' => 'Palm Oil'],
            ['id' => 'Food Estate', 'en' => 'Food Estate'],
            ['id' => 'Taman Nasional Kutai', 'en' => 'Kutai National Park'],
            ['id' => 'Logging', 'en' => 'Logging'],
            ['id' => 'Tambang', 'en' => 'Mining'],
            ['id' => 'Biomassa', 'en' => 'Biomass'],
        ];

        $existing = DB::table('deforestory')
            ->select(['category', 'category_id', 'category_en'])
            ->where(function ($query): void {
                $query->whereNotNull('category_id')
                    ->orWhereNotNull('category_en')
                    ->orWhereNotNull('category');
            })
            ->get()
            ->map(fn ($story): array => [
                'id' => trim((string) ($story->category_id ?: $story->category ?: '')),
                'en' => trim((string) ($story->category_en ?: $story->category ?: '')),
            ])
            ->filter(fn (array $category): bool => filled($category['id']) || filled($category['en']))
            ->all();

        $registry = DB::table('deforestory_categories')->get();
        $deleted = $registry->whereNotNull('deleted_at')->pluck('pair_hash')->all();
        $counts = collect($existing)->countBy(fn (array $category) => $this->pairKey($category['id'], $category['en']));
        $saved = $registry->whereNull('deleted_at')
            ->map(fn ($category): array => ['id' => $category->label_id, 'en' => $category->label_en])
            ->all();

        return collect([...$saved, ...$existing, ...$fallback])
            ->map(function (array $category) use ($counts): array {
                $category['id'] = trim((string) ($category['id'] ?? ''));
                $category['en'] = trim((string) ($category['en'] ?? ''));
                $category['key'] = $this->pairKey($category['id'], $category['en']);
                $category['count'] = $counts->get($category['key'], 0);

                return $category;
            })
            ->unique('key')
            ->filter(fn (array $category): bool => $category['count'] > 0 || ! in_array(hash('sha256', $category['key']), $deleted, true))
            ->sortBy('id')
            ->values()
            ->all();
    }

    private function categoryPairKey(?string $categoryId, ?string $categoryEn): string
    {
        return $this->pairKey($categoryId, $categoryEn);
    }

    private function parseCategoryPairKey(string $key): array
    {
        return $this->parsePairKey($key);
    }

    private function regionOptions(): array
    {
        $fallback = [
            ['id' => 'Gorontalo', 'en' => 'Gorontalo'],
            ['id' => 'Papua Barat Daya', 'en' => 'Southwest Papua'],
            ['id' => 'Kalimantan Timur', 'en' => 'East Kalimantan'],
            ['id' => 'Sulawesi Tengah', 'en' => 'Central Sulawesi'],
            ['id' => 'Maluku Utara', 'en' => 'North Maluku'],
        ];

        $existing = DB::table('deforestory')
            ->select(['region', 'region_id', 'region_en'])
            ->where(function ($query): void {
                $query->whereNotNull('region_id')
                    ->orWhereNotNull('region_en')
                    ->orWhereNotNull('region');
            })
            ->get()
            ->map(fn ($story): array => [
                'id' => trim((string) ($story->region_id ?: $story->region ?: '')),
                'en' => trim((string) ($story->region_en ?: $story->region ?: '')),
            ])
            ->filter(fn (array $region): bool => filled($region['id']) || filled($region['en']))
            ->all();

        $registry = DB::table('deforestory_regions')->get();
        $deleted = $registry->whereNotNull('deleted_at')->pluck('pair_hash')->all();
        $counts = collect($existing)->countBy(fn (array $region) => $this->pairKey($region['id'], $region['en']));
        $saved = $registry->whereNull('deleted_at')->map(fn ($region): array => ['id' => $region->label_id, 'en' => $region->label_en])->all();

        return collect([...$saved, ...$existing, ...$fallback])
            ->map(function (array $region) use ($counts): array {
                $region['id'] = trim((string) ($region['id'] ?? ''));
                $region['en'] = trim((string) ($region['en'] ?? ''));
                $region['key'] = $this->pairKey($region['id'], $region['en']);
                $region['count'] = $counts->get($region['key'], 0);

                return $region;
            })
            ->unique('key')
            ->filter(fn (array $region): bool => $region['count'] > 0 || ! in_array(hash('sha256', $region['key']), $deleted, true))
            ->sortBy('id')
            ->values()
            ->all();
    }

    private function pairKey(?string $id, ?string $en): string
    {
        return base64_encode(json_encode([
            'id' => $id ?? '',
            'en' => $en ?? '',
        ], JSON_THROW_ON_ERROR));
    }

    private function parsePairKey(string $key): array
    {
        $decoded = json_decode(base64_decode($key, true) ?: '', true);

        if (! is_array($decoded)) {
            return [null, null];
        }

        return [
            $decoded['id'] ?? null,
            $decoded['en'] ?? null,
        ];
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

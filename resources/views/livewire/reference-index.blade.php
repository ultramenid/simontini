<div class="deforestory-square">
    @if ($picker)
        <div class="mb-6 border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800">
            Pilih gambar untuk dimasukkan ke editor Tiptap. File selain gambar tetap dapat disimpan dan diunduh dari Reference, tetapi tidak dapat dimasukkan sebagai gambar Tiptap.
        </div>
    @endif

    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Reference Files</h1>
            <p class="mt-1 text-sm text-gray-500">Simpan dan kelola gambar, dokumen, arsip, audio, video, dan jenis file lainnya.</p>
        </div>

        <button type="button" wire:click="toggleForm" class="inline-flex shrink-0 items-center gap-2 border border-transparent px-4 py-2 text-sm font-semibold text-white shadow-sm hover:opacity-90" style="background-color: #376A64; color: #ffffff;">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
            </svg>
            {{ $showForm ? 'Tutup' : 'Upload File' }}
        </button>
    </div>

    @if (session('success'))
        <div class="mb-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($showForm)
        <form wire:submit="save" class="mb-7 border border-gray-200 bg-white p-6 shadow-sm">
            <div class="space-y-5">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">File <span class="text-red-500">*</span></label>
                    <input type="file" wire:model="image" class="block w-full border border-gray-300 bg-white p-2 text-sm text-gray-600 file:mr-4 file:border-0 file:bg-[#376A64] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
                    <p class="mt-2 text-xs text-gray-500">Semua jenis file dapat diunggah. Maksimal 10 MB per file.</p>
                    <p wire:loading wire:target="image" class="mt-1 text-xs font-medium text-[#376A64]">Mengunggah file...</p>
                    @error('image') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                @if ($image && str_starts_with($image->getMimeType() ?: '', 'image/'))
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="max-h-72 w-full border border-gray-200 object-contain">
                @elseif ($image)
                    <div class="border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-600">
                        File dipilih: <span class="font-semibold text-gray-900">{{ $image->getClientOriginalName() }}</span>
                    </div>
                @endif

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Judul <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="title" placeholder="Nama atau judul file" class="w-full border border-gray-300 px-3.5 py-2.5 text-sm outline-none focus:border-[#376A64]">
                    @error('title') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Deskripsi / Alt text <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="alt_text" placeholder="Deskripsi file atau alt text untuk gambar" class="w-full border border-gray-300 px-3.5 py-2.5 text-sm outline-none focus:border-[#376A64]">
                    @error('alt_text') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" wire:loading.attr="disabled" wire:target="save" class="px-5 py-2.5 text-sm font-semibold text-white hover:opacity-90 disabled:opacity-60" style="background-color: #376A64; color: #ffffff;">
                        <span wire:loading.remove wire:target="save">Simpan File</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </form>
    @endif

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($items as $item)
            @php
                $isImage = str_starts_with($item->mime_type ?: 'image/', 'image/');
                $fileUrl = ($item->disk ?: 'public') === 'public'
                    ? Storage::url($item->image_path)
                    : route('cms.reference.download', $item->id);
                $downloadUrl = route('cms.reference.download', $item->id);
                $fileName = $item->original_name ?: basename($item->image_path);
                $extension = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION) ?: 'FILE');
            @endphp
            <article class="border border-gray-200 bg-white shadow-sm">
                <div class="flex h-52 items-center justify-center overflow-hidden bg-gray-100">
                    @if ($isImage)
                        <img src="{{ $fileUrl }}" alt="{{ $item->alt_text ?: $item->title ?: 'Reference image' }}" class="h-full w-full object-cover">
                    @else
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-[#376A64]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 2.25H6.75A2.25 2.25 0 004.5 4.5v15a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V7.5m-5.25-5.25L19.5 7.5m-5.25-5.25V7.5h5.25" />
                            </svg>
                            <span class="mt-2 block text-sm font-bold text-gray-600">{{ $extension }}</span>
                        </div>
                    @endif
                </div>

                <div class="space-y-3 p-4">
                    <div>
                        <h2 class="font-semibold text-gray-900">{{ $item->title ?: 'Tanpa judul' }}</h2>
                        <p class="mt-1 text-xs text-gray-500">{{ $item->alt_text ?: 'Alt text belum diisi' }}</p>
                        <p class="mt-2 break-all text-xs text-gray-400">{{ $fileName }}</p>
                        @if ($item->file_size)
                            <p class="mt-1 text-xs text-gray-400">{{ number_format($item->file_size / 1024, 1) }} KB · {{ $item->mime_type ?: 'Tipe tidak diketahui' }}</p>
                        @endif
                    </div>

                    @if ($picker && $isImage)
                        <button
                            type="button"
                            data-tiptap-reference-select
                            data-editor-key="{{ $editorKey }}"
                            data-image-url="{{ url($fileUrl) }}"
                            data-image-title="{{ $item->title }}"
                            data-image-alt="{{ $item->alt_text }}"
                            class="w-full bg-[#376A64] px-3 py-2 text-xs font-semibold text-white hover:opacity-90"
                        >Pilih untuk Tiptap</button>
                    @elseif ($picker)
                        <div class="border border-amber-200 bg-amber-50 px-3 py-2 text-center text-xs text-amber-700">File ini bukan gambar</div>
                    @endif

                    <div x-data="{ copied: false }">
                        <input type="text" readonly value="{{ $fileUrl }}" class="w-full border border-gray-300 bg-gray-50 px-2 py-2 text-xs text-gray-500">
                        <button type="button" x-on:click="navigator.clipboard.writeText(@js($fileUrl)); copied = true; setTimeout(() => copied = false, 1500)" class="mt-2 w-full border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                            <span x-show="!copied">Salin URL</span>
                            <span x-show="copied" x-cloak>URL tersalin</span>
                        </button>
                    </div>

                    <a href="{{ $downloadUrl }}" class="block w-full border border-[#376A64] bg-white px-3 py-2 text-center text-xs font-semibold text-[#376A64] hover:bg-gray-50">Download</a>

                    <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Yakin ingin menghapus file reference ini?" class="w-full border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                </div>
            </article>
        @empty
            <div class="border border-dashed border-gray-300 bg-white px-6 py-14 text-center text-sm text-gray-500 sm:col-span-2 lg:col-span-3">
                Belum ada file reference.
            </div>
        @endforelse
    </div>

    @if ($items->hasPages())
        <div class="mt-6 border border-gray-200 bg-white px-5 py-4">
            {{ $items->links() }}
        </div>
    @endif

    <x-scroll-to-top />
</div>

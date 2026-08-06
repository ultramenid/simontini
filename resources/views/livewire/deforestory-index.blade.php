<div class="deforestory-square">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Deforestory</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola daftar konten deforestory.</p>
        </div>

        <a
            id="add-deforestory-button"
            href="{{ route('cms.deforestory.add') }}"
            class="inline-flex shrink-0 items-center gap-2 rounded-md border border-transparent px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
            style="background-color: #376A64; color: #ffffff;"
        >
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
            </svg>
            Tambah Data
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <div class="min-w-[900px]">
                <div class="grid grid-cols-[120px_minmax(480px,1fr)_110px_140px] items-center gap-5 border-b border-gray-200 bg-gray-50 px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-500">
                    <div>Image</div>
                    <div>Content</div>
                    <div>Tanggal</div>
                    <div class="text-center">Aksi</div>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse ($items as $item)
                        <div class="grid grid-cols-[120px_minmax(480px,1fr)_110px_140px] items-start gap-5 px-5 py-5 text-sm text-gray-700 transition hover:bg-gray-50">
                            <div class="h-20 w-28 overflow-hidden rounded-lg border border-gray-200 bg-gray-100">
                                @if ($item->image_id)
                                    <img src="{{ Storage::url($item->image_id) }}" alt="{{ $item->title_id }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full flex-col items-center justify-center text-gray-400">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" />
                                        </svg>
                                        <span class="mt-1 text-[10px]">No image</span>
                                    </div>
                                @endif
                            </div>

                            <div class="min-w-0 space-y-3">
                                <div>
                                    <p class="font-bold leading-5 text-gray-900">{{ $item->title_id }}</p>
                                </div>

                                <div>
                                    <p class="text-sm leading-5 text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($item->desrkirpsi_id), 180) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm leading-5 text-gray-500">{{ \Illuminate\Support\Str::limit(strip_tags($item->content_id), 240) }}</p>
                                </div>
                            </div>

                            <div class="whitespace-nowrap pt-1 text-xs font-medium text-gray-500">
                                {{ $item->date }}
                            </div>

                            <div class="flex flex-col gap-2">
                                <a href="{{ route('deforestation.preview.show', ['locale' => 'id', 'id' => $item->id, 'slug' => $item->slug]) }}" target="_blank" rel="noopener" class="w-full rounded-md border border-blue-200 bg-blue-50 px-3 py-1.5 text-center text-xs font-semibold text-blue-700 hover:bg-blue-100">Preview</a>

                                <a href="{{ route('cms.deforestory.edit', $item->id) }}" class="w-full rounded-md border border-gray-300 bg-white px-3 py-1.5 text-center text-xs font-semibold text-gray-700 hover:bg-gray-100">Edit</a>

                                <button type="button" wire:click="toggleStatus({{ $item->id }})" class="w-full rounded-md px-3 py-1.5 text-xs font-semibold text-white hover:opacity-90" style="background-color: {{ $item->status === 'publish' ? '#d97706' : '#376A64' }};">
                                    {{ $item->status === 'publish' ? 'Jadikan Draft' : 'Publish' }}
                                </button>

                                <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Yakin ingin menghapus data ini?" class="w-full rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-14 text-center text-sm text-gray-500">
                            Belum ada data deforestory.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        @if ($items->hasPages())
            <div class="border-t border-gray-200 px-5 py-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>

    <x-scroll-to-top />
</div>

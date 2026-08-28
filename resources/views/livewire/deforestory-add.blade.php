<div class="deforestory-square pb-10">
    <div class="mb-7 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="flex flex-col gap-5 px-6 py-6 sm:flex-row sm:items-center sm:justify-between" style="background: linear-gradient(135deg, #eef6f4 0%, #ffffff 60%);">
            <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl text-white shadow-sm" style="background-color: #376A64;">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#376A64]">Deforestory</p>
                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">{{ $deforestoryId ? 'Edit konten' : 'Tambah konten baru' }}</h1>
                    <p class="mt-1 text-sm text-gray-500">{{ $deforestoryId ? 'Perbarui informasi dan isi konten.' : 'Lengkapi informasi dan konten dalam dua bahasa.' }}</p>
                </div>
            </div>

            <a href="{{ route('cms.deforestory') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-400 hover:bg-gray-50">
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.56l3.22 3.22a.75.75 0 11-1.06 1.06l-4.5-4.5a.75.75 0 010-1.06l4.5-4.5a.75.75 0 011.06 1.06L5.56 9.25h10.69A.75.75 0 0117 10z" clip-rule="evenodd" />
                </svg>
                Kembali ke daftar
            </a>
        </div>
    </div>

    <form wire:submit="save" class="space-y-6">
        <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h2 class="text-base font-bold text-gray-900">Informasi utama</h2>
                <p class="mt-1 text-sm text-gray-500">Judul, tanggal publikasi, dan status konten.</p>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Gambar Indonesia</label>
                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-4">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                            <div class="flex aspect-video w-full items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-white sm:w-52">
                                @if ($image_id)
                                    <img src="{{ $image_id->temporaryUrl() }}" alt="Preview gambar Indonesia" class="h-full w-full object-cover">
                                @elseif ($currentImageId)
                                    <img src="{{ Storage::url($currentImageId) }}" alt="Gambar Indonesia saat ini" class="h-full w-full object-cover">
                                @else
                                    <div class="text-center text-gray-400">
                                        <svg class="mx-auto h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" />
                                        </svg>
                                        <p class="mt-1 text-xs">Belum ada gambar</p>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <input type="file" wire:model="image_id" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-[#376A64] file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-white hover:file:opacity-90">
                                <p class="mt-2 text-xs text-gray-500">JPG, PNG, atau WebP. Maksimal 3 MB.</p>
                                <p wire:loading wire:target="image_id" class="mt-1 text-xs font-medium text-[#376A64]">Mengunggah gambar Indonesia...</p>
                                @error('image_id') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Gambar Inggris</label>
                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-4">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                            <div class="flex aspect-video w-full items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-white sm:w-52">
                                @if ($image_en)
                                    <img src="{{ $image_en->temporaryUrl() }}" alt="Preview gambar Inggris" class="h-full w-full object-cover">
                                @elseif ($currentImageEn)
                                    <img src="{{ Storage::url($currentImageEn) }}" alt="Gambar Inggris saat ini" class="h-full w-full object-cover">
                                @else
                                    <div class="text-center text-gray-400">
                                        <svg class="mx-auto h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" />
                                        </svg>
                                        <p class="mt-1 text-xs">Belum ada gambar</p>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <input type="file" wire:model="image_en" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-[#376A64] file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-white hover:file:opacity-90">
                                <p class="mt-2 text-xs text-gray-500">JPG, PNG, atau WebP. Maksimal 3 MB.</p>
                                <p wire:loading wire:target="image_en" class="mt-1 text-xs font-medium text-[#376A64]">Mengunggah gambar Inggris...</p>
                                @error('image_en') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Deskripsi Hero Image Indonesia</label>
                    <textarea wire:model="image_description_id" rows="3" placeholder="Tulis caption, sumber, atau kredit hero image Indonesia" class="w-full resize-y rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15"></textarea>
                    <p class="mt-1.5 text-xs text-gray-500">Ditampilkan di bawah hero image pada halaman detail Indonesia.</p>
                    @error('image_description_id') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Deskripsi Hero Image Inggris</label>
                    <textarea wire:model="image_description_en" rows="3" placeholder="Write the English hero image caption, source, or credit" class="w-full resize-y rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15"></textarea>
                    <p class="mt-1.5 text-xs text-gray-500">Ditampilkan di bawah hero image pada halaman detail Inggris.</p>
                    @error('image_description_en') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Judul Indonesia <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="title_id" placeholder="Masukkan judul Bahasa Indonesia" class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15">
                    @error('title_id') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Judul Inggris <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="title_en" placeholder="Enter the English title" class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15">
                    @error('title_en') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" wire:model="date" class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15">
                    @error('date') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select wire:model="status" class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15">
                        <option value="draft">Draft — belum dipublikasikan</option>
                        <option value="publish">Publish — sudah dipublikasikan</option>
                    </select>
                    @error('status') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h2 class="text-base font-bold text-gray-900">Deskripsi singkat</h2>
                <p class="mt-1 text-sm text-gray-500">Ringkasan pendek yang mewakili isi konten.</p>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div x-data="{ descriptionLength: {{ mb_strlen($desrkirpsi_id) }} }">
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Deskripsi Indonesia <span class="text-red-500">*</span></label>
                    <textarea wire:model="desrkirpsi_id" x-on:input="descriptionLength = $event.target.value.length" maxlength="150" rows="4" placeholder="Tulis ringkasan dalam Bahasa Indonesia" class="w-full resize-y rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15"></textarea>
                    <p class="mt-1.5 text-right text-xs text-gray-500"><span x-text="descriptionLength"></span>/150 karakter</p>
                    @error('desrkirpsi_id') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ descriptionLength: {{ mb_strlen($desrkirpsi_en) }} }">
                    <label class="mb-1.5 block text-sm font-semibold text-gray-700">Deskripsi Inggris <span class="text-red-500">*</span></label>
                    <textarea wire:model="desrkirpsi_en" x-on:input="descriptionLength = $event.target.value.length" maxlength="150" rows="4" placeholder="Write a short English summary" class="w-full resize-y rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm shadow-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15"></textarea>
                    <p class="mt-1.5 text-right text-xs text-gray-500"><span x-text="descriptionLength"></span>/150 karakter</p>
                    @error('desrkirpsi_en') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h2 class="text-base font-bold text-gray-900">Isi konten</h2>
                <p class="mt-1 text-sm text-gray-500">Pilih Template untuk editor Tiptap atau Custom untuk editor HTML TinyMCE.</p>
            </div>

            <div class="mb-7 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <label class="cursor-pointer border p-4 transition {{ $content_type === 'template' ? 'border-[#376A64] bg-[#eef6f4]' : 'border-gray-200 bg-white hover:border-gray-300' }}">
                    <span class="flex items-start gap-3">
                        <input type="radio" wire:model.live="content_type" value="template" class="mt-1 border-gray-300 text-[#376A64] focus:ring-[#376A64]">
                        <span>
                            <strong class="block text-sm text-gray-900">Template</strong>
                            <span class="mt-1 block text-xs leading-5 text-gray-500">Gunakan Tiptap dengan format konten standar Simontini.</span>
                        </span>
                    </span>
                </label>
                <label class="cursor-pointer border p-4 transition {{ $content_type === 'custom' ? 'border-[#376A64] bg-[#eef6f4]' : 'border-gray-200 bg-white hover:border-gray-300' }}">
                    <span class="flex items-start gap-3">
                        <input type="radio" wire:model.live="content_type" value="custom" class="mt-1 border-gray-300 text-[#376A64] focus:ring-[#376A64]">
                        <span>
                            <strong class="block text-sm text-gray-900">Custom</strong>
                            <span class="mt-1 block text-xs leading-5 text-gray-500">Gunakan TinyMCE kosong dan Source Code untuk membuat HTML khusus dari awal.</span>
                        </span>
                    </span>
                </label>
            </div>
            @error('content_type') <p class="mb-4 text-xs font-medium text-red-600">{{ $message }}</p> @enderror

            @if ($content_type === 'template')
                <div class="mb-6 flex justify-end">
                    <button
                        type="button"
                        wire:click="loadTemplateContent"
                        wire:confirm="Isi konten Indonesia dan Inggris akan diganti dengan format template. Lanjutkan?"
                        class="border border-[#376A64] bg-white px-4 py-2 text-xs font-semibold text-[#376A64] hover:bg-[#eef6f4]"
                    >
                        Muat ulang format template
                    </button>
                </div>
            @endif

            <div class="space-y-7" wire:key="content-editors-{{ $content_type }}">
                @if ($content_type === 'template')
                    <x-tiptap-editor
                        wire:model="content_id"
                        :value="$content_id"
                        label="Konten Indonesia"
                        hint="Isi lengkap dalam Bahasa Indonesia"
                    />

                    <div class="border-t border-dashed border-gray-200"></div>

                    <x-tiptap-editor
                        wire:model="content_en"
                        :value="$content_en"
                        label="Konten Inggris"
                        hint="Full content in English"
                    />
                @else
                    <x-tinymce-editor
                        wire:model="content_id"
                        :value="$content_id"
                        label="Konten Custom Indonesia"
                        hint="HTML lengkap dengan TinyMCE dan Source Code"
                    />

                    <div class="border-t border-dashed border-gray-200"></div>

                    <x-tinymce-editor
                        wire:model="content_en"
                        :value="$content_en"
                        label="Konten Custom Inggris"
                        hint="Full custom HTML with TinyMCE and Source Code"
                    />
                @endif
            </div>
        </section>

        <div class="sticky bottom-4 z-10 flex flex-col-reverse gap-3 rounded-2xl border border-gray-200 bg-white/95 p-4 shadow-lg backdrop-blur sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-gray-500"><span class="font-semibold text-red-500">*</span> Semua kolom wajib diisi.</p>
            <div class="flex gap-3">
                <a href="{{ route('cms.deforestory') }}" class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 sm:flex-none">Batal</a>
                <button type="submit" class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90 disabled:cursor-wait disabled:opacity-60 sm:flex-none" style="background-color: #376A64; color: #ffffff;" wire:loading.attr="disabled" wire:target="save">
                    <svg wire:loading.remove wire:target="save" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 3a2 2 0 012-2h8.586A2 2 0 0115 1.586L18.414 5A2 2 0 0119 6.414V17a2 2 0 01-2 2H3a2 2 0 01-2-2V3a2 2 0 012-2zm3 0v5h8V3H6zm8 9H6v5h8v-5z" />
                    </svg>
                    <span wire:loading.remove wire:target="save">{{ $deforestoryId ? 'Perbarui Data' : 'Simpan Data' }}</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>
        </div>
    </form>

    <x-scroll-to-top />
</div>

@props([
    'label',
    'hint' => null,
    'value' => '',
])

@php
    $wireModel = $attributes->wire('model')->value();
@endphp

<div>
    <div class="mb-2 flex items-end justify-between gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-800">{{ $label }}</label>
            @if ($hint)
                <p class="mt-0.5 text-xs text-gray-500">{{ $hint }}</p>
            @endif
        </div>
        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-medium uppercase tracking-wide text-gray-500">Tiptap editor</span>
    </div>

    <div data-tiptap-wrapper data-tiptap-picker-id="{{ $wireModel }}" data-tiptap-reference-page-url="{{ route('cms.reference', ['picker' => 1, 'editor' => $wireModel]) }}">
        <div wire:ignore>
            <div class="overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm transition focus-within:border-[#376A64] focus-within:ring-2 focus-within:ring-[#376A64]/15">
            <div class="border-b border-gray-200 bg-gray-50">
                <div class="flex flex-wrap items-center gap-1.5 border-b border-gray-200 px-3 py-2">
                    <select data-tiptap-select="fontSize" title="Ukuran teks" class="tiptap-toolbar-select">
                        <option value="">Ukuran</option>
                        <option value="12px">12 px</option>
                        <option value="14px">14 px</option>
                        <option value="16px">16 px</option>
                        <option value="18px">18 px</option>
                        <option value="20px">20 px</option>
                        <option value="24px">24 px</option>
                        <option value="30px">30 px</option>
                        <option value="36px">36 px</option>
                    </select>

                    <select data-tiptap-select="lineHeight" title="Jarak antarbaris" class="tiptap-toolbar-select">
                        <option value="">Line height</option>
                        <option value="1">1.0</option>
                        <option value="1.15">1.15</option>
                        <option value="1.5">1.5</option>
                        <option value="1.75">1.75</option>
                        <option value="2">2.0</option>
                        <option value="2.5">2.5</option>
                    </select>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <button type="button" title="Bold" data-tiptap-command="bold" data-tiptap-active="bold" class="tiptap-toolbar-button text-sm font-bold">B</button>
                    <button type="button" title="Italic" data-tiptap-command="italic" data-tiptap-active="italic" class="tiptap-toolbar-button text-sm italic">I</button>
                    <button type="button" title="Underline" data-tiptap-command="underline" data-tiptap-active="underline" class="tiptap-toolbar-button text-sm underline">U</button>
                    <button type="button" title="Strikethrough" data-tiptap-command="strike" data-tiptap-active="strike" class="tiptap-toolbar-button text-sm line-through">S</button>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <button type="button" title="Heading 2" data-tiptap-command="heading" data-tiptap-value="2" data-tiptap-active="heading" class="tiptap-toolbar-button">H2</button>
                    <button type="button" title="Heading 3" data-tiptap-command="heading" data-tiptap-value="3" data-tiptap-active="heading" class="tiptap-toolbar-button">H3</button>
                    <button type="button" title="Paragraf" data-tiptap-command="paragraph" data-tiptap-active="paragraph" class="tiptap-toolbar-button">P</button>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <label title="Warna teks" class="tiptap-toolbar-button cursor-pointer gap-1">
                        <span class="font-bold">A</span>
                        <input type="color" value="#1f2937" data-tiptap-color="color" class="h-4 w-5 cursor-pointer border-0 bg-transparent p-0">
                    </label>
                    <label title="Warna highlight" class="tiptap-toolbar-button cursor-pointer gap-1">
                        <span class="rounded bg-yellow-200 px-1">A</span>
                        <input type="color" value="#fef08a" data-tiptap-color="backgroundColor" class="h-4 w-5 cursor-pointer border-0 bg-transparent p-0">
                    </label>
                </div>

                <div class="flex flex-wrap items-center gap-1.5 px-3 py-2">
                    <button type="button" title="Rata kiri" data-tiptap-command="textAlign" data-tiptap-value="left" data-tiptap-active="textAlign" class="tiptap-toolbar-button">Kiri</button>
                    <button type="button" title="Rata tengah" data-tiptap-command="textAlign" data-tiptap-value="center" data-tiptap-active="textAlign" class="tiptap-toolbar-button">Tengah</button>
                    <button type="button" title="Rata kanan" data-tiptap-command="textAlign" data-tiptap-value="right" data-tiptap-active="textAlign" class="tiptap-toolbar-button">Kanan</button>
                    <button type="button" title="Rata penuh" data-tiptap-command="textAlign" data-tiptap-value="justify" data-tiptap-active="textAlign" class="tiptap-toolbar-button">Justify</button>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <button type="button" title="Bullet list" data-tiptap-command="bulletList" data-tiptap-active="bulletList" class="tiptap-toolbar-button">• List</button>
                    <button type="button" title="Numbered list" data-tiptap-command="orderedList" data-tiptap-active="orderedList" class="tiptap-toolbar-button">1. List</button>
                    <button type="button" title="Kutipan" data-tiptap-command="blockquote" data-tiptap-active="blockquote" class="tiptap-toolbar-button">Quote</button>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <button type="button" title="Inline code" data-tiptap-command="code" data-tiptap-active="code" class="tiptap-toolbar-button font-mono">&lt;/&gt;</button>
                    <button type="button" title="Code block dengan syntax color" data-tiptap-command="codeBlock" data-tiptap-active="codeBlock" class="tiptap-toolbar-button font-mono">Code block</button>
                    <button type="button" title="Garis horizontal" data-tiptap-command="horizontalRule" class="tiptap-toolbar-button">―</button>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <button type="button" title="Tambah atau edit link" data-tiptap-command="link" data-tiptap-active="link" class="tiptap-toolbar-button">Link</button>
                    <button type="button" title="Hapus link" data-tiptap-command="unlink" class="tiptap-toolbar-button">Unlink</button>
                    <button type="button" title="Pilih gambar dari Reference" data-tiptap-image-picker class="tiptap-toolbar-button gap-1.5">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 15-5-5L5 21" />
                        </svg>
                        <span>Image</span>
                    </button>
                    <button type="button" title="Bersihkan format" data-tiptap-command="clearFormatting" class="tiptap-toolbar-button">Clear</button>
                    <button type="button" title="Source code" aria-label="Source code" data-tiptap-source-toggle class="tiptap-toolbar-button h-9 w-10 border border-gray-200 bg-white text-gray-700 shadow-sm" >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8 5-7 7 7 7M16 5l7 7-7 7" />
                        </svg>
                    </button>

                    <span class="mx-0.5 h-5 w-px bg-gray-300"></span>

                    <button type="button" title="Undo" data-tiptap-command="undo" class="tiptap-toolbar-button">Undo</button>
                    <button type="button" title="Redo" data-tiptap-command="redo" class="tiptap-toolbar-button">Redo</button>
                </div>

                <div class="flex flex-wrap items-center gap-1.5 border-t border-gray-200 bg-[#eef6f4] px-3 py-2">
                    <span class="mr-1 text-[11px] font-bold uppercase tracking-wider text-[#376A64]">Tabel</span>
                    <button type="button" data-tiptap-command="insertTable" class="tiptap-toolbar-button bg-white">+ Tabel 3×3</button>

                    <div data-tiptap-table-tools class="hidden contents">
                        <button type="button" data-tiptap-command="addRowBefore" class="tiptap-toolbar-button bg-white">+ Baris atas</button>
                        <button type="button" data-tiptap-command="addRowAfter" class="tiptap-toolbar-button bg-white">+ Baris bawah</button>
                        <button type="button" data-tiptap-command="deleteRow" class="tiptap-toolbar-button bg-white text-red-600">− Baris</button>
                        <button type="button" data-tiptap-command="addColumnBefore" class="tiptap-toolbar-button bg-white">+ Kolom kiri</button>
                        <button type="button" data-tiptap-command="addColumnAfter" class="tiptap-toolbar-button bg-white">+ Kolom kanan</button>
                        <button type="button" data-tiptap-command="deleteColumn" class="tiptap-toolbar-button bg-white text-red-600">− Kolom</button>
                        <button type="button" data-tiptap-command="mergeCells" class="tiptap-toolbar-button bg-white">Gabung sel</button>
                        <button type="button" data-tiptap-command="splitCell" class="tiptap-toolbar-button bg-white">Pisah sel</button>
                        <button type="button" data-tiptap-command="toggleHeaderRow" class="tiptap-toolbar-button bg-white">Header baris</button>
                        <button type="button" data-tiptap-command="toggleHeaderColumn" class="tiptap-toolbar-button bg-white">Header kolom</button>
                        <button type="button" data-tiptap-command="toggleHeaderCell" class="tiptap-toolbar-button bg-white">Header sel</button>
                        <button type="button" data-tiptap-command="deleteTable" class="tiptap-toolbar-button bg-red-50 text-red-700">Hapus tabel</button>
                    </div>
                </div>

                <div data-tiptap-selected-image-tools class="hidden flex-wrap items-center gap-2 border-t border-gray-200 bg-blue-50 px-3 py-2">
                    <span class="mr-1 text-[11px] font-bold uppercase tracking-wider text-blue-700">Image dipilih</span>
                    <div class="flex items-center gap-2">
                        <label class="flex items-center border border-blue-200 bg-white">
                            <span class="border-r border-blue-200 px-2 text-xs font-bold text-blue-700">W</span>
                            <input type="number" min="1" max="3000" value="100" data-tiptap-selected-image-width class="h-8 w-20 border-0 px-2 text-xs outline-none" aria-label="Lebar image">
                            <select data-tiptap-selected-image-width-unit class="h-8 border-0 border-l border-blue-200 bg-gray-50 px-1 text-xs font-semibold text-blue-700 outline-none">
                                <option value="%">%</option>
                                <option value="px">px</option>
                            </select>
                        </label>
                        <span class="text-xs font-bold text-gray-400">×</span>
                        <label class="flex items-center border border-blue-200 bg-white">
                            <span class="border-r border-blue-200 px-2 text-xs font-bold text-blue-700">H</span>
                            <input type="number" min="1" max="3000" data-tiptap-selected-image-height class="h-8 w-20 border-0 px-2 text-xs outline-none" aria-label="Tinggi image" placeholder="Auto">
                            <select data-tiptap-selected-image-height-unit class="h-8 border-0 border-l border-blue-200 bg-gray-50 px-1 text-xs font-semibold text-blue-700 outline-none">
                                <option value="%">%</option>
                                <option value="px">px</option>
                            </select>
                        </label>
                        <button type="button" data-tiptap-selected-image-apply class="h-8 bg-blue-700 px-3 text-xs font-semibold text-white">Terapkan W × H</button>
                        <button type="button" data-tiptap-selected-image-full class="h-8 border border-blue-200 bg-white px-3 text-xs font-semibold text-blue-700">100% × Auto</button>
                    </div>
                    <button type="button" data-tiptap-selected-image-delete class="tiptap-toolbar-button border border-red-200 bg-red-50 text-red-700">Hapus image</button>
                </div>
            </div>

            <div data-tiptap-content></div>
            <textarea data-tiptap-source class="hidden min-h-72 w-full resize-y border-0 bg-gray-950 p-4 font-mono text-sm leading-6 text-emerald-300 outline-none" spellcheck="false" aria-label="Kode HTML"></textarea>
            </div>

        </div>

        <textarea data-tiptap-input wire:model="{{ $wireModel }}" class="hidden" aria-hidden="true">{{ $value }}</textarea>
    </div>

    @error($wireModel)
        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
    @enderror
</div>

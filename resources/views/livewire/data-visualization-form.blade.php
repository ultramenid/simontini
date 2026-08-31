<div
    x-data="{
        activeTab: 'data',
        sections: {
            basic: true,
            typography: true,
            legend: true,
            workspace: true
        }
    }"
    x-on:data-visualization-preview.window="$nextTick(() => window.renderDataVisualizationChart?.($refs.formChartPreview, $event.detail.chartType, $event.detail.chartData))"
>
    <div class="mb-6">
        <a href="{{ route('cms.data-visualizations') }}" wire:navigate class="inline-flex items-center gap-2 text-sm font-semibold text-[#376A64] hover:underline">
            <span aria-hidden="true">&larr;</span> Kembali ke Data &amp; Grafik
        </a>
        <h1 class="mt-4 text-2xl font-semibold text-gray-900">{{ $visualizationId ? 'Edit Data & Grafik' : 'Tambah Data & Grafik' }}</h1>
        <p class="mt-1 text-sm text-gray-500">Masukkan data langsung melalui tabel, kemudian pilih bentuk grafiknya.</p>
    </div>

    <form wire:submit="save" class="overflow-hidden border border-gray-200 bg-white shadow-sm">
        <div class="grid grid-cols-1 gap-5 p-5 sm:p-7 md:grid-cols-2 lg:p-8">
            <button type="button" x-on:click="sections.basic = !sections.basic" class="flex w-full items-center justify-between gap-4 text-left md:col-span-2" x-bind:aria-expanded="sections.basic">
                <span>
                    <span class="block text-xs font-bold uppercase tracking-[0.14em] text-[#376A64]">Informasi Dasar</span>
                    <span class="mt-1 block text-sm font-normal text-gray-500">Identitas, jenis, dan status grafik yang akan ditampilkan.</span>
                </span>
                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center border border-gray-200 bg-gray-50 text-gray-500 transition hover:border-[#376A64] hover:text-[#376A64]" x-bind:class="sections.basic ? 'rotate-180' : ''">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m5 7.5 5 5 5-5" /></svg>
                </span>
            </button>
            <div x-show="sections.basic" x-transition.opacity.duration.150ms class="md:col-span-2">
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Judul <span class="text-red-500">*</span></label>
                <input type="text" wire:model="title" placeholder="Contoh: Tren Deforestasi Indonesia 2020–2026" class="w-full border border-gray-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10">
                @error('title') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </div>

            <fieldset x-show="sections.basic" x-transition.opacity.duration.150ms class="md:col-span-2">
                <legend class="mb-1.5 block text-sm font-semibold text-gray-700">Jenis Grafik <span class="text-red-500">*</span></legend>
                <div class="grid grid-cols-2 gap-2 bg-gray-50 p-2 sm:grid-cols-4">
                    @foreach ([
                        'line' => 'Line Chart',
                        'area' => 'Area Chart',
                        'bar' => 'Bar Chart',
                        'column' => 'Column Chart',
                        'doughnut' => 'Donut Chart',
                        'pie' => 'Pie Chart',
                        'area-grid' => 'Grid of Area',
                    ] as $chartValue => $chartLabel)
                        <label wire:key="chart-type-{{ $chartValue }}" class="relative cursor-pointer">
                            <input type="radio" wire:model.live="chart_type" value="{{ $chartValue }}" class="peer sr-only">
                            <span class="flex min-h-[132px] flex-col justify-between gap-3 border border-gray-200 bg-white p-4 text-left text-gray-700 shadow-sm transition hover:-translate-y-0.5 hover:border-[#376A64] hover:shadow peer-checked:border-[#376A64] peer-checked:bg-[#376A64] peer-checked:text-white peer-checked:shadow-md peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-[#376A64]">
                                <span class="block text-sm font-bold leading-tight">{{ $chartLabel }}</span>
                                <span class="block h-16 w-full opacity-75" aria-hidden="true">
                                    @switch($chartValue)
                                        @case('line')
                                            <svg class="h-full w-full" viewBox="0 0 160 64" fill="none" stroke="currentColor"><path d="M4 56H156M12 48 44 32 76 40 110 13 148 24" stroke-width="3"/><circle cx="12" cy="48" r="3" fill="currentColor"/><circle cx="44" cy="32" r="3" fill="currentColor"/><circle cx="76" cy="40" r="3" fill="currentColor"/><circle cx="110" cy="13" r="3" fill="currentColor"/><circle cx="148" cy="24" r="3" fill="currentColor"/></svg>
                                            @break
                                        @case('area')
                                            <svg class="h-full w-full" viewBox="0 0 160 64"><path d="M4 56 14 46 48 28 80 39 113 14 148 25 156 56Z" fill="currentColor" opacity=".24"/><path d="M14 46 48 28 80 39 113 14 148 25" fill="none" stroke="currentColor" stroke-width="3"/><path d="M4 56H156" stroke="currentColor" opacity=".4"/></svg>
                                            @break
                                        @case('bar')
                                            <svg class="h-full w-full" viewBox="0 0 160 64" fill="currentColor"><rect x="8" y="7" width="93" height="10"/><rect x="8" y="27" width="137" height="10" opacity=".72"/><rect x="8" y="47" width="64" height="10" opacity=".45"/></svg>
                                            @break
                                        @case('column')
                                            <svg class="h-full w-full" viewBox="0 0 160 64" fill="currentColor"><rect x="15" y="31" width="22" height="27" opacity=".45"/><rect x="51" y="12" width="22" height="46"/><rect x="87" y="23" width="22" height="35" opacity=".72"/><rect x="123" y="39" width="22" height="19" opacity=".38"/></svg>
                                            @break
                                        @case('doughnut')
                                            <svg class="h-full w-full" viewBox="0 0 160 64"><circle cx="80" cy="32" r="23" fill="none" stroke="currentColor" stroke-width="12" opacity=".2"/><path d="M80 9a23 23 0 0 1 20 34" fill="none" stroke="currentColor" stroke-width="12"/><path d="M100 43a23 23 0 0 1-35 7" fill="none" stroke="currentColor" stroke-width="12" opacity=".62"/></svg>
                                            @break
                                        @case('pie')
                                            <svg class="h-full w-full" viewBox="0 0 160 64"><circle cx="80" cy="32" r="25" fill="currentColor" opacity=".22"/><path d="M80 32V7a25 25 0 0 1 21 39Z" fill="currentColor"/><path d="m80 32 21 14a25 25 0 0 1-39 4Z" fill="currentColor" opacity=".62"/></svg>
                                            @break
                                        @case('area-grid')
                                            <svg class="h-full w-full" viewBox="0 0 160 64" fill="currentColor"><rect x="20" y="8" width="32" height="20"/><rect x="57" y="8" width="48" height="20" opacity=".7"/><rect x="110" y="8" width="30" height="20" opacity=".4"/><rect x="20" y="33" width="50" height="23" opacity=".55"/><rect x="75" y="33" width="28" height="23" opacity=".32"/><rect x="108" y="33" width="32" height="23" opacity=".82"/></svg>
                                            @break
                                    @endswitch
                                </span>
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('chart_type') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </fieldset>

            <div x-show="sections.basic" x-transition.opacity.duration.150ms>
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Status</label>
                <label class="flex min-h-[42px] items-center gap-3 border border-gray-300 bg-gray-50/70 px-3.5 py-2 text-sm text-gray-700">
                    <input type="checkbox" wire:model="is_active" class="h-4 w-4 border-gray-300 text-[#376A64] focus:ring-[#376A64]">
                    Aktif dan siap ditampilkan
                </label>
                @error('is_active') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </div>

            <div x-show="sections.basic" x-transition.opacity.duration.150ms class="md:col-span-2">
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea wire:model="description" rows="3" placeholder="Keterangan singkat mengenai data atau grafik" class="w-full border border-gray-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10"></textarea>
                @error('description') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="button" x-on:click="sections.typography = !sections.typography" class="mt-3 flex w-full items-center justify-between gap-4 border-t border-gray-200 pt-6 text-left md:col-span-2" x-bind:aria-expanded="sections.typography">
                <span>
                    <span class="block text-xs font-bold uppercase tracking-[0.14em] text-[#376A64]">Teks &amp; Tipografi</span>
                    <span class="mt-1 block text-sm font-normal text-gray-500">Atur judul dan catatan pendukung tanpa memenuhi area grafik.</span>
                </span>
                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center border border-gray-200 bg-gray-50 text-gray-500 transition hover:border-[#376A64] hover:text-[#376A64]" x-bind:class="sections.typography ? 'rotate-180' : ''">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m5 7.5 5 5 5-5" /></svg>
                </span>
            </button>

            <div x-show="sections.typography" x-transition.opacity.duration.150ms class="border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Teks Atas <span class="font-normal text-gray-400">(opsional)</span></label>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="top_text"
                    placeholder="Contoh: Luas deforestasi per bulan"
                    class="w-full border border-gray-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10"
                >
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin menampilkan judul di atas grafik.</p>
                @error('top_text') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Posisi</label>
                        <select wire:model.live="top_align" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                            <option value="left">Kiri</option>
                            <option value="center">Tengah</option>
                            <option value="right">Kanan</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Ukuran Font</label>
                        <input type="number" min="10" max="72" wire:model.live.debounce.300ms="top_font_size" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Ketebalan</label>
                        <select wire:model.live="top_font_weight" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                            <option value="normal">Regular</option>
                            <option value="600">Semibold</option>
                            <option value="bold">Bold</option>
                            <option value="900">Black</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Jenis Font</label>
                        <select wire:model.live="top_font_family" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                            <option value="Poppins">Poppins</option>
                            <option value="Arial">Arial</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Verdana">Verdana</option>
                            <option value="monospace">Monospace</option>
                        </select>
                    </div>
                </div>
                <label class="mt-2 inline-flex items-center gap-2 text-xs font-semibold text-gray-700">
                    <input type="checkbox" wire:model.live="top_italic" class="h-4 w-4 border-gray-300 text-[#376A64] focus:ring-[#376A64]">
                    <span class="italic">Italic</span>
                </label>
            </div>

            <div x-show="sections.typography" x-transition.opacity.duration.150ms class="border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Teks Bawah <span class="font-normal text-gray-400">(opsional)</span></label>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="bottom_text"
                    placeholder="Contoh: Sumber: Simontini, 2026"
                    class="w-full border border-gray-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10"
                >
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin menampilkan catatan di bawah grafik.</p>
                @error('bottom_text') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Posisi</label>
                        <select wire:model.live="bottom_align" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                            <option value="left">Kiri</option>
                            <option value="center">Tengah</option>
                            <option value="right">Kanan</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Ukuran Font</label>
                        <input type="number" min="10" max="72" wire:model.live.debounce.300ms="bottom_font_size" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Ketebalan</label>
                        <select wire:model.live="bottom_font_weight" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                            <option value="normal">Regular</option>
                            <option value="600">Semibold</option>
                            <option value="bold">Bold</option>
                            <option value="900">Black</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-600">Jenis Font</label>
                        <select wire:model.live="bottom_font_family" class="w-full border border-gray-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-[#376A64]">
                            <option value="Poppins">Poppins</option>
                            <option value="Arial">Arial</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Verdana">Verdana</option>
                            <option value="monospace">Monospace</option>
                        </select>
                    </div>
                </div>
                <label class="mt-2 inline-flex items-center gap-2 text-xs font-semibold text-gray-700">
                    <input type="checkbox" wire:model.live="bottom_italic" class="h-4 w-4 border-gray-300 text-[#376A64] focus:ring-[#376A64]">
                    <span class="italic">Italic</span>
                </label>
            </div>

            <button type="button" x-on:click="sections.legend = !sections.legend" class="mt-3 flex w-full items-center justify-between gap-4 border-t border-gray-200 pt-6 text-left md:col-span-2" x-bind:aria-expanded="sections.legend">
                <span>
                    <span class="block text-xs font-bold uppercase tracking-[0.14em] text-[#376A64]">Pengaturan Legend</span>
                    <span class="mt-1 block text-sm font-normal text-gray-500">Tentukan apakah nama seri data perlu ditampilkan dan posisinya.</span>
                </span>
                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center border border-gray-200 bg-gray-50 text-gray-500 transition hover:border-[#376A64] hover:text-[#376A64]" x-bind:class="sections.legend ? 'rotate-180' : ''">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m5 7.5 5 5 5-5" /></svg>
                </span>
            </button>

            <div x-show="sections.legend" x-transition.opacity.duration.150ms class="border border-gray-200 bg-gray-50/70 p-4">
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Legend</label>
                <label class="flex min-h-[42px] items-center gap-3 border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-700">
                    <input
                        type="checkbox"
                        wire:model.live="show_legend"
                        class="h-4 w-4 border-gray-300 text-[#376A64] focus:ring-[#376A64]"
                    >
                    Tampilkan nama seri data
                </label>
            </div>

            <div x-show="sections.legend" x-transition.opacity.duration.150ms class="border border-gray-200 bg-gray-50/70 p-4">
                <label class="mb-1.5 block text-sm font-semibold text-gray-700">Posisi Legend</label>
                <select
                    wire:model.live="legend_position"
                    class="w-full border border-gray-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10"
                >
                    <option value="top">Di atas grafik</option>
                    <option value="bottom">Di bawah grafik</option>
                </select>
                @error('legend_position') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="button" x-on:click="sections.workspace = !sections.workspace" class="mt-3 flex w-full items-center justify-between gap-4 border-t border-gray-200 pt-6 text-left md:col-span-2" x-bind:aria-expanded="sections.workspace">
                <span>
                    <span class="block text-xs font-bold uppercase tracking-[0.14em] text-[#376A64]">Workspace Grafik</span>
                    <span class="mt-1 block text-sm font-normal text-gray-500">Kelola isi tabel dan periksa hasilnya secara realtime.</span>
                </span>
                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center border border-gray-200 bg-gray-50 text-gray-500 transition hover:border-[#376A64] hover:text-[#376A64]" x-bind:class="sections.workspace ? 'rotate-180' : ''">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m5 7.5 5 5 5-5" /></svg>
                </span>
            </button>

            <div x-show="sections.workspace" x-transition.opacity.duration.150ms class="overflow-hidden border border-gray-200 bg-white md:col-span-2">
                <div class="flex border-b border-gray-200 bg-gray-50 px-3 pt-2" role="tablist" aria-label="Data dan preview grafik">
                    <button
                        type="button"
                        role="tab"
                        x-on:click="activeTab = 'preview'; $nextTick(() => $wire.preview())"
                        x-bind:aria-selected="activeTab === 'preview'"
                        x-bind:class="activeTab === 'preview' ? 'border-[#376A64] text-[#376A64]' : 'border-transparent text-gray-500 hover:text-gray-800'"
                        class="-mb-px inline-flex items-center gap-2 border-b-2 px-5 py-3 text-sm font-semibold transition"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M3 16.5h14M5 14V9m5 5V4m5 10V7" /></svg>
                        Preview
                    </button>
                    <button
                        type="button"
                        role="tab"
                        x-on:click="activeTab = 'data'"
                        x-bind:aria-selected="activeTab === 'data'"
                        x-bind:class="activeTab === 'data' ? 'border-[#376A64] text-[#376A64]' : 'border-transparent text-gray-500 hover:text-gray-800'"
                        class="-mb-px inline-flex items-center gap-2 border-b-2 px-5 py-3 text-sm font-semibold transition"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="2.5" y="2.5" width="15" height="15" rx="1" /><path d="M2.5 7.5h15M2.5 12.5h15M7.5 2.5v15M12.5 2.5v15" /></svg>
                        Data
                    </button>
                </div>

                <div x-show="activeTab === 'data'" role="tabpanel" class="p-4 sm:p-5">
                    <div class="mb-3 flex justify-end gap-2">
                        <button type="button" wire:click="addRow" class="border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">+ Baris</button>
                        <button type="button" wire:click="addColumn" class="border border-[#376A64] bg-white px-3 py-2 text-xs font-semibold text-[#376A64] hover:bg-[#F3F8F7]">+ Kolom</button>
                    </div>

                    <div data-spreadsheet class="overflow-x-auto border border-gray-300 bg-white">
                        <table class="min-w-full border-collapse text-sm">
                            <thead>
                                <tr class="h-8">
                                    <th class="w-10 min-w-10 border-b border-r border-gray-300 bg-gray-100 text-center text-xs text-gray-500">↳</th>
                                    @foreach ($columns as $columnIndex => $column)
                                        <th
                                            wire:key="column-letter-{{ $columnIndex }}"
                                            class="group relative min-w-32 border-b border-r px-2 py-1.5 text-center text-xs font-semibold last:border-r-0"
                                            style="{{ $columnIndex === 0 ? 'background:#F7D9E2;border-color:#E8AFC0;color:#7A334B;' : 'background:#D8CFEB;border-color:#A997D4;color:#453B63;' }}"
                                        >
                                            <span class="mr-1 inline-flex h-4 min-w-5 items-center justify-center px-1 text-[8px] font-bold text-white" style="background: {{ $columnIndex === 0 ? '#DB7895' : '#8F78C7' }};">Aa1</span>
                                            {{ chr(65 + $columnIndex) }}
                                            @if ($columnIndex > 0 && count($columns) > 2)
                                                <button type="button" wire:click="removeColumn({{ $columnIndex }})" wire:confirm="Hapus kolom beserta seluruh datanya?" class="absolute right-0.5 top-1/2 hidden h-6 w-6 -translate-y-1/2 text-base text-red-700 hover:bg-white/50 group-hover:block" aria-label="Hapus kolom {{ chr(65 + $columnIndex) }}">&times;</button>
                                            @endif
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="h-9">
                                    <th class="border-b border-r border-gray-300 bg-gray-100 px-2 text-center text-xs font-medium text-gray-600">1</th>
                                    @foreach ($columns as $columnIndex => $column)
                                        <td data-spreadsheet-cell data-row="0" data-column="{{ $columnIndex }}" class="simontini-spreadsheet-cell border-b border-r p-0 last:border-r-0" style="{{ $columnIndex === 0 ? 'background:#FCECF1;border-color:#E8AFC0;' : 'background:#E9E3F4;border-color:#A997D4;' }}">
                                            <input type="text" wire:model="columns.{{ $columnIndex }}" aria-label="Nama kolom {{ chr(65 + $columnIndex) }}" class="h-9 w-full min-w-32 border-0 bg-transparent px-2 text-xs font-semibold text-gray-900 outline-none ring-inset focus:ring-2 focus:ring-[#376A64]">
                                            @error("columns.$columnIndex") <p class="px-3 pb-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                                        </td>
                                    @endforeach
                                </tr>

                                @foreach ($rows as $rowIndex => $row)
                                    <tr wire:key="data-row-{{ $rowIndex }}" class="group h-9">
                                        <th class="relative border-b border-r border-gray-300 bg-gray-100 px-2 text-center text-xs font-medium text-gray-600">
                                            <span class="group-hover:hidden">{{ $rowIndex + 2 }}</span>
                                            <button type="button" wire:click="removeRow({{ $rowIndex }})" @disabled(count($rows) <= 1) class="hidden h-6 w-6 text-base text-red-600 hover:bg-red-50 group-hover:inline-flex group-hover:items-center group-hover:justify-center disabled:cursor-not-allowed disabled:opacity-30" aria-label="Hapus baris {{ $rowIndex + 2 }}">&times;</button>
                                        </th>
                                        @foreach ($columns as $columnIndex => $column)
                                            <td data-spreadsheet-cell data-row="{{ $rowIndex + 1 }}" data-column="{{ $columnIndex }}" class="simontini-spreadsheet-cell border-b border-r border-gray-300 p-0 last:border-r-0">
                                                <input
                                                    type="text"
                                                    wire:model="rows.{{ $rowIndex }}.{{ $columnIndex }}"
                                                    aria-label="Baris {{ $rowIndex + 2 }} kolom {{ chr(65 + $columnIndex) }}"
                                                    class="h-9 w-full min-w-32 border-0 bg-white px-2 text-xs text-gray-900 outline-none ring-inset focus:ring-2 focus:ring-[#376A64]"
                                                >
                                                @error("rows.$rowIndex.$columnIndex") <p class="px-3 pb-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @error('rows') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                <div x-cloak x-show="activeTab === 'preview'" role="tabpanel" class="bg-white p-4 sm:p-6">
                    <div class="relative min-h-[460px] w-full">
                        <canvas x-ref="formChartPreview" aria-label="Preview grafik dari data tabel" role="img"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-7 lg:px-8">
            <a href="{{ route('cms.data-visualizations') }}" wire:navigate class="border border-gray-300 bg-white px-5 py-2.5 text-center text-sm font-semibold text-gray-700 hover:bg-gray-100">Batal</a>
            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-90 disabled:opacity-60" style="background-color: #376A64; color: #ffffff;">
                <span wire:loading.remove wire:target="save">{{ $visualizationId ? 'Simpan Perubahan' : 'Simpan Data & Grafik' }}</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>

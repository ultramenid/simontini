<div
    x-data="{
        previewOpen: false,
        previewUrl: '',
        previewTitle: '',
        shareOpen: false,
        shareTitle: '',
        publicUrl: '',
        embedUrl: '',
        copied: '',
        viewMode: window.localStorage.getItem('simontini-data-visualization-view') || 'list',
        setViewMode(mode) {
            this.viewMode = mode;
            window.localStorage.setItem('simontini-data-visualization-view', mode);
        },
        async copyText(value, type) {
            await navigator.clipboard.writeText(value);
            this.copied = type;
            setTimeout(() => { if (this.copied === type) this.copied = ''; }, 1600);
        }
    }"
    x-on:keydown.escape.window="previewOpen = false; shareOpen = false"
>
    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Data &amp; Grafik</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola, publikasikan, dan sematkan grafik interaktif Simontini.</p>
        </div>

        <div class="flex flex-wrap items-center justify-end gap-3">
            <div class="inline-flex border border-gray-300 bg-white p-1" role="group" aria-label="Pilih tampilan Data dan Grafik">
                <button
                    type="button"
                    x-on:click="setViewMode('list')"
                    x-bind:class="viewMode === 'list' ? 'bg-[#376A64] text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800'"
                    class="inline-flex h-9 items-center gap-2 px-3 text-xs font-semibold transition"
                    title="Tampilan daftar"
                >
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M7 5h10M7 10h10M7 15h10"/><circle cx="3" cy="5" r=".8" fill="currentColor"/><circle cx="3" cy="10" r=".8" fill="currentColor"/><circle cx="3" cy="15" r=".8" fill="currentColor"/></svg>
                    Daftar
                </button>
                <button
                    type="button"
                    x-on:click="setViewMode('card')"
                    x-bind:class="viewMode === 'card' ? 'bg-[#376A64] text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800'"
                    class="inline-flex h-9 items-center gap-2 px-3 text-xs font-semibold transition"
                    title="Tampilan card"
                >
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="2.5" y="2.5" width="6" height="6"/><rect x="11.5" y="2.5" width="6" height="6"/><rect x="2.5" y="11.5" width="6" height="6"/><rect x="11.5" y="11.5" width="6" height="6"/></svg>
                    Card
                </button>
            </div>

            <a href="{{ route('cms.data-visualizations.add') }}" wire:navigate class="inline-flex h-[47px] items-center gap-2 px-4 text-sm font-semibold text-white shadow-sm hover:opacity-90" style="background-color: #376A64; color: #ffffff;">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                </svg>
                Tambah Data &amp; Grafik
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div x-cloak x-show="viewMode === 'list'" class="overflow-hidden border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-5 py-3.5">Judul</th>
                        <th class="px-5 py-3.5">Jenis Grafik</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Diperbarui</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($items as $item)
                        @php
                            $chartData = json_decode($item->chart_data ?? '', true) ?: ['columns' => ['Kategori', 'Nilai'], 'rows' => []];
                            $chartLabel = match ($item->chart_type ?? 'column') {
                                'line' => 'Line Chart',
                                'area' => 'Area Chart',
                                'bar' => 'Bar Chart',
                                'doughnut' => 'Donut Chart',
                                'pie' => 'Pie Chart',
                                'area-grid' => 'Grid of Area',
                                'sankey' => 'Sankey / Alluvial',
                                default => 'Column Chart',
                            };
                        @endphp
                        <tr wire:key="data-visualization-{{ $item->id }}" class="align-top hover:bg-gray-50">
                            <td class="max-w-md px-5 py-4">
                                <p class="font-semibold text-gray-900">{{ $item->title }}</p>
                                @if ($item->description)
                                    <p class="mt-1 line-clamp-2 text-xs leading-5 text-gray-500">{{ $item->description }}</p>
                                @endif
                                <p class="mt-2 text-xs text-gray-400">{{ count($chartData['rows'] ?? []) }} baris · {{ max(0, count($chartData['columns'] ?? []) - 1) }} seri data</p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex bg-[#E8F1EF] px-2.5 py-1 text-xs font-semibold text-[#376A64]">
                                    {{ $chartLabel }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <button type="button" wire:click="toggleStatus({{ $item->id }})" class="inline-flex items-center gap-2 text-xs font-semibold {{ $item->is_active ? 'text-green-700' : 'text-gray-500' }}">
                                    <span class="h-2.5 w-2.5 rounded-full {{ $item->is_active ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-xs text-gray-500">
                                {{ \Illuminate\Support\Carbon::parse($item->updated_at)->format('d M Y, H:i') }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <button type="button" x-on:click="previewTitle = @js($item->title); previewOpen = true; $nextTick(() => window.renderDataVisualizationChart?.($refs.previewChart, @js($item->chart_type ?? 'bar'), @js($chartData)))" class="border border-[#376A64] bg-white px-3 py-2 text-xs font-semibold text-[#376A64] hover:bg-[#F3F8F7]">Preview</button>
                                    @if ($item->is_active)
                                        <button
                                            type="button"
                                            x-on:click="shareTitle = @js($item->title); publicUrl = @js(route('data-visualizations.show', $item->id)); embedUrl = @js(route('data-visualizations.embed', $item->id)); copied = ''; shareOpen = true"
                                            class="border border-[#376A64] bg-[#376A64] px-3 py-2 text-xs font-semibold text-white hover:opacity-90"
                                        >Bagikan</button>
                                    @endif
                                    <a href="{{ route('cms.data-visualizations.edit', $item->id) }}" wire:navigate class="border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Yakin ingin menghapus data & grafik ini?" class="border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-100">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center text-sm text-gray-500">Belum ada data &amp; grafik.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div x-cloak x-show="viewMode === 'card'" class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($items as $item)
            @php
                $cardChartData = json_decode($item->chart_data ?? '', true) ?: ['columns' => ['Kategori', 'Nilai'], 'rows' => []];
                $cardChartLabel = match ($item->chart_type ?? 'column') {
                    'line' => 'Line Chart',
                    'area' => 'Area Chart',
                    'bar' => 'Bar Chart',
                    'doughnut' => 'Donut Chart',
                    'pie' => 'Pie Chart',
                    'area-grid' => 'Grid of Area',
                    'sankey' => 'Sankey / Alluvial',
                    default => 'Column Chart',
                };
                $cardPreviewData = array_merge($cardChartData, [
                    'top_text' => '',
                    'bottom_text' => '',
                    'show_legend' => false,
                    'compact_preview' => true,
                ]);
            @endphp
            <article wire:key="data-visualization-card-{{ $item->id }}" class="group flex min-w-0 flex-col border border-gray-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg">
                <div class="relative aspect-video w-full overflow-hidden border-b border-gray-200 bg-[#FAFBFB] p-4">
                    <canvas
                        data-card-chart="{{ $item->id }}"
                        x-effect="if (viewMode === 'card') $nextTick(() => window.renderDataVisualizationChart?.($el, @js($item->chart_type ?? 'bar'), @js($cardPreviewData)))"
                        aria-label="Preview {{ $item->title }}"
                        role="img"
                    ></canvas>
                </div>

                <div class="flex flex-1 flex-col p-4">
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <span class="inline-flex border border-[#D4E3E0] bg-[#F2F7F6] px-2 py-1 text-[10px] font-bold uppercase tracking-[0.08em] text-[#376A64]">{{ $cardChartLabel }}</span>
                        <button type="button" wire:click="toggleStatus({{ $item->id }})" class="inline-flex items-center gap-2 text-xs font-semibold {{ $item->is_active ? 'text-green-700' : 'text-gray-500' }}">
                            <span class="h-2 w-2 {{ $item->is_active ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </div>

                    <h2 class="line-clamp-2 text-[17px] font-bold leading-snug text-gray-900">{{ $item->title }}</h2>
                    @if ($item->description)
                        <p class="mt-2 line-clamp-2 text-xs leading-5 text-gray-500">{{ $item->description }}</p>
                    @endif
                    <div class="mt-4 flex items-center justify-between gap-3 border-t border-gray-100 pt-3 text-[11px] text-gray-400">
                        <span>{{ count($cardChartData['rows'] ?? []) }} baris · {{ max(0, count($cardChartData['columns'] ?? []) - 1) }} seri</span>
                        <span class="whitespace-nowrap">{{ \Illuminate\Support\Carbon::parse($item->updated_at)->format('d M Y') }}</span>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-2 border-t border-gray-100 pt-3">
                        <button type="button" x-on:click="previewTitle = @js($item->title); previewOpen = true; $nextTick(() => window.renderDataVisualizationChart?.($refs.previewChart, @js($item->chart_type ?? 'bar'), @js($cardChartData)))" class="border border-[#376A64] bg-white px-3 py-2 text-center text-xs font-semibold text-[#376A64] hover:bg-[#F3F8F7]">Preview</button>
                        @if ($item->is_active)
                            <button
                                type="button"
                                x-on:click="shareTitle = @js($item->title); publicUrl = @js(route('data-visualizations.show', $item->id)); embedUrl = @js(route('data-visualizations.embed', $item->id)); copied = ''; shareOpen = true"
                                class="border border-[#376A64] bg-[#376A64] px-3 py-2 text-center text-xs font-semibold text-white hover:opacity-90"
                            >Bagikan</button>
                        @else
                            <span class="border border-gray-200 bg-gray-50 px-3 py-2 text-center text-xs font-semibold text-gray-400">Belum aktif</span>
                        @endif
                        <a href="{{ route('cms.data-visualizations.edit', $item->id) }}" wire:navigate class="border border-gray-300 bg-white px-3 py-2 text-center text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                        <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Yakin ingin menghapus data & grafik ini?" class="border border-red-200 bg-white px-3 py-2 text-center text-xs font-semibold text-red-600 hover:bg-red-50">Hapus</button>
                    </div>
                </div>
            </article>
        @empty
            <div class="border border-gray-200 bg-white px-6 py-14 text-center text-sm text-gray-500 sm:col-span-2 lg:col-span-3 xl:col-span-4">Belum ada data &amp; grafik.</div>
        @endforelse
    </div>

    @if ($items->hasPages())
        <div class="mt-5 border border-gray-200 bg-white px-5 py-4">{{ $items->links() }}</div>
    @endif

    <div x-cloak x-show="previewOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 p-4" x-on:click.self="previewOpen = false">
        <div class="flex max-h-[92vh] w-full max-w-6xl flex-col overflow-hidden bg-white shadow-2xl" role="dialog" aria-modal="true" aria-label="Preview data dan grafik">
            <div class="flex items-center justify-between gap-4 border-b border-gray-200 px-5 py-4">
                <h2 class="truncate text-lg font-semibold text-gray-900" x-text="previewTitle"></h2>
                <button type="button" x-on:click="previewOpen = false" class="text-2xl leading-none text-gray-500 hover:text-gray-900" aria-label="Tutup preview">&times;</button>
            </div>
            <div class="relative min-h-[420px] w-full bg-white p-6">
                <canvas x-ref="previewChart" aria-label="Preview grafik" role="img"></canvas>
            </div>
        </div>
    </div>

    <div x-cloak x-show="shareOpen" class="fixed inset-0 z-[110] flex items-center justify-center bg-black/60 p-4" x-on:click.self="shareOpen = false">
        <div class="w-full max-w-2xl border border-gray-200 bg-white shadow-2xl" role="dialog" aria-modal="true" aria-label="Bagikan data dan grafik">
            <div class="flex items-center justify-between gap-4 border-b border-gray-200 px-5 py-4">
                <div class="min-w-0">
                    <p class="text-xs font-bold uppercase tracking-[0.12em] text-[#376A64]">Publikasi Grafik</p>
                    <h2 class="mt-1 truncate text-lg font-semibold text-gray-900" x-text="shareTitle"></h2>
                </div>
                <button type="button" x-on:click="shareOpen = false" class="text-2xl leading-none text-gray-500 hover:text-gray-900" aria-label="Tutup">&times;</button>
            </div>

            <div class="space-y-6 p-5">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-800">Link publik</label>
                    <div class="flex flex-col gap-2 sm:flex-row">
                        <input type="text" x-bind:value="publicUrl" readonly class="min-w-0 flex-1 border border-gray-300 bg-gray-50 px-3 py-2.5 text-sm text-gray-700 outline-none">
                        <a x-bind:href="publicUrl" target="_blank" rel="noopener" class="border border-gray-300 bg-white px-4 py-2.5 text-center text-sm font-semibold text-gray-700 hover:bg-gray-50">Buka</a>
                        <button type="button" x-on:click="copyText(publicUrl, 'public')" class="border border-[#376A64] bg-[#376A64] px-4 py-2.5 text-sm font-semibold text-white">
                            <span x-text="copied === 'public' ? 'Tersalin' : 'Salin'"></span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-gray-800">Kode embed iframe</label>
                    <textarea
                        readonly
                        rows="4"
                        x-bind:value="`<div style=&quot;position:relative;width:100%;aspect-ratio:16/9;overflow:hidden;&quot;><iframe src=&quot;${embedUrl}&quot; width=&quot;100%&quot; height=&quot;100%&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot; loading=&quot;lazy&quot; title=&quot;${shareTitle.replaceAll('&quot;', '')}&quot; style=&quot;position:absolute;inset:0;width:100%;height:100%;border:0;overflow:hidden;&quot;></iframe></div>`"
                        class="w-full border border-gray-300 bg-gray-50 px-3 py-2.5 font-mono text-xs leading-5 text-gray-700 outline-none"
                    ></textarea>
                    <div class="mt-2 flex justify-end">
                        <button
                            type="button"
                            x-on:click="copyText(`<div style=&quot;position:relative;width:100%;aspect-ratio:16/9;overflow:hidden;&quot;><iframe src=&quot;${embedUrl}&quot; width=&quot;100%&quot; height=&quot;100%&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot; loading=&quot;lazy&quot; title=&quot;${shareTitle.replaceAll('&quot;', '')}&quot; style=&quot;position:absolute;inset:0;width:100%;height:100%;border:0;overflow:hidden;&quot;></iframe></div>`, 'embed')"
                            class="border border-[#376A64] bg-white px-4 py-2 text-sm font-semibold text-[#376A64] hover:bg-[#F3F8F7]"
                        >
                            <span x-text="copied === 'embed' ? 'Kode tersalin' : 'Salin kode embed'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-scroll-to-top />
</div>

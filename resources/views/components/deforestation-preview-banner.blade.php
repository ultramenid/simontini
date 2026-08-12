@props(['status' => null])

<div class="border-b border-amber-300 bg-amber-100">
    <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6">
        <div class="flex flex-wrap items-center gap-2">
            <span class="bg-amber-600 px-3 py-1 text-xs font-bold uppercase tracking-wider text-white">MODE PREVIEW</span>
            <span class="text-sm font-semibold text-amber-950">KONTEN BELUM DIPUBLIKASIKAN</span>
            @if ($status)
                <span class="border px-2.5 py-1 text-xs font-bold {{ $status === 'publish' ? 'border-green-300 bg-green-100 text-green-800' : 'border-amber-300 bg-white text-amber-800' }}">
                    {{ $status === 'publish' ? 'Published' : 'Draft' }}
                </span>
            @endif
        </div>
    </div>
</div>

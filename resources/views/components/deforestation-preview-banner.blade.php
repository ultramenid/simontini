@props(['status' => null])

<div class="border-b border-amber-300 bg-amber-100">
    <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div class="flex flex-wrap items-center gap-2">
            <span class="bg-amber-600 px-3 py-1 text-xs font-bold uppercase tracking-wider text-white">MODE PREVIEW</span>
            <span class="text-sm font-semibold text-amber-950">KONTEN BELUM DIPUBLIKASIKAN</span>
            @if ($status)
                <span class="border px-2.5 py-1 text-xs font-bold {{ $status === 'publish' ? 'border-green-300 bg-green-100 text-green-800' : 'border-amber-300 bg-white text-amber-800' }}">
                    {{ $status === 'publish' ? 'Published' : 'Draft' }}
                </span>
            @endif
        </div>

        <a href="{{ route('cms.deforestory') }}" class="inline-flex items-center justify-center border border-amber-700 bg-white px-4 py-2 text-sm font-semibold text-amber-900 hover:bg-amber-50">
            Kembali ke CMS
        </a>
    </div>
</div>

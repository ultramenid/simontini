@php
    $menu = [
        ['dashboard', url('/cms/dashboard'), 'Dashboard'],
        ['deforestory', route('cms.deforestory'), 'Deforestory'],
        ['reference', route('cms.reference'), 'Reference'],
        ['data-visualizations', route('cms.data-visualizations'), 'Data & Grafik'],
        ['comments', route('cms.comments'), 'Komentar'],
        ['subscribers', route('cms.subscribers'), 'Subscriber'],
        ['users', route('cms.users'), 'User'],
    ];
@endphp

<div class="sticky top-0 z-30 border-b border-gray-200 bg-white/95 backdrop-blur">
    <nav class="mx-auto flex max-w-6xl gap-1 overflow-x-auto px-6 scrollbar-hide" aria-label="CMS">
        @foreach ($menu as [$key, $href, $label])
            <a href="{{ $href }}"
               @if ($nav === $key) aria-current="page" @endif
               class="-mb-px whitespace-nowrap border-b-2 px-3 py-3 text-sm transition-colors {{ $nav === $key ? 'border-simontini font-semibold text-simontini' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-900' }}">
                {{ $label }}
            </a>
        @endforeach
    </nav>
</div>

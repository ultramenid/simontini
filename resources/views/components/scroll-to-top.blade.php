@props([
    'label' => 'Kembali ke atas',
    'variant' => 'solid',
    'double' => false,
    'raised' => false,
])

<div
    x-data="{ visible: window.scrollY > 400 }"
    x-on:scroll.window="visible = window.scrollY > 400"
    x-show="visible"
    x-transition.opacity.duration.200ms
    x-cloak
    @class([
        'fixed right-6',
        'bottom-24 z-[80]' => $raised,
        'bottom-6 z-50' => ! $raised,
    ])
>
    <button
        type="button"
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        title="{{ $label }}"
        aria-label="{{ $label }}"
        @class([
            'flex h-12 w-12 items-center justify-center border border-[#376A64] shadow-lg transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#376A64] focus-visible:ring-offset-2',
            'border-2 bg-white text-[#376A64] hover:bg-[#376A64] hover:text-white' => $variant === 'outline',
            'bg-[#376A64] text-white hover:bg-white hover:text-[#376A64]' => $variant !== 'outline',
        ])
    >
        <svg class="{{ $double ? 'h-6 w-6' : 'h-5 w-5' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            @if ($double)
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5M4.5 12.75l7.5-7.5 7.5 7.5" />
            @else
                <path stroke-linecap="round" stroke-linejoin="round" d="m5 15 7-7 7 7" />
            @endif
        </svg>
    </button>
</div>

{{-- Shared pagination markup for Laravel ($livewire = false) and Livewire ($livewire = true) paginators. --}}
@php
    $pageName = $paginator->getPageName();
    $scrollTo ??= 'body';
    $scroll = $scrollTo !== false ? "(\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()" : '';
    $go = fn ($page) => $livewire
        ? 'type="button" wire:click="gotoPage('.$page.', \''.$pageName.'\')" x-on:click="'.$scroll.'"'
        : 'href="'.e($paginator->url($page)).'"';
    $tag = $livewire ? 'button' : 'a';
    $item = 'inline-flex h-9 min-w-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition';
    $idle = 'border-gray-200 bg-white text-gray-700 hover:border-[#376A64] hover:text-[#376A64]';
    $off = 'cursor-not-allowed border-gray-100 bg-gray-50 text-gray-300';
@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center justify-between gap-3 sm:flex-row">
        <p class="text-sm text-gray-500">
            Menampilkan <span class="font-semibold text-gray-800">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
            dari <span class="font-semibold text-gray-800">{{ $paginator->total() }}</span>
        </p>

        <div class="flex flex-wrap items-center gap-1.5">
            @if ($paginator->onFirstPage())
                <span class="{{ $item }} {{ $off }}" aria-disabled="true" aria-label="Sebelumnya">&lsaquo;</span>
            @else
                <{{ $tag }} {!! $go($paginator->currentPage() - 1) !!} rel="prev" class="{{ $item }} {{ $idle }}" aria-label="Sebelumnya">&lsaquo;</{{ $tag }}>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-1 text-sm text-gray-400">{{ $element }}</span>
                @else
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="{{ $item }} border-[#376A64] bg-[#376A64] font-semibold text-white" aria-current="page">{{ $page }}</span>
                        @else
                            <{{ $tag }} {!! $go($page) !!} @if ($livewire) wire:key="paginator-{{ $pageName }}-page{{ $page }}" @endif class="{{ $item }} {{ $idle }}" aria-label="Halaman {{ $page }}">{{ $page }}</{{ $tag }}>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <{{ $tag }} {!! $go($paginator->currentPage() + 1) !!} rel="next" class="{{ $item }} {{ $idle }}" aria-label="Berikutnya">&rsaquo;</{{ $tag }}>
            @else
                <span class="{{ $item }} {{ $off }}" aria-disabled="true" aria-label="Berikutnya">&rsaquo;</span>
            @endif
        </div>
    </nav>
@endif

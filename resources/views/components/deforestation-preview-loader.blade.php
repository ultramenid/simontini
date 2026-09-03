@props(['story' => null])

@php
    $loaderImages = collect(glob(public_path('assets/loader/*.{jpg,jpeg,png,webp,gif,JPG,JPEG,PNG,WEBP,GIF}'), GLOB_BRACE) ?: [])
        ->map(fn (string $path): string => asset('assets/loader/'.basename($path)))
        ->values();
    $loaderUrl = $loaderImages->first();
@endphp

@once
    <script>
        window.deforestoryLoaderReveal = function () {
            return {
                phase: 'hold',
                init() {
                    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                    const holdMs = reduced ? 50 : 150;
                    const openMs = reduced ? 200 : 2000;

                    setTimeout(() => {
                        this.phase = 'opening';
                        setTimeout(() => {
                            this.phase = 'done';
                            window.dispatchEvent(new CustomEvent('deforestory-loader-finished'));
                        }, openMs);
                    }, holdMs);
                },
            };
        };
    </script>
@endonce

<div
    {{ $attributes->class('fixed inset-0 z-[9999] overflow-hidden') }}
    data-deforestory-hero-loader
    data-deforestory-loader-image="{{ $loaderUrl ? basename(parse_url($loaderUrl, PHP_URL_PATH)) : 'none' }}"
    role="status"
    aria-live="polite"
    aria-label="Deforestory"
>
    <div class="absolute inset-0" x-data="deforestoryLoaderReveal()">
        <div
            class="deforestory-loader-bg"
            x-bind:class="{ 'is-opening': phase === 'opening' || phase === 'done' }"
            aria-hidden="true"
        ></div>

        <div class="relative z-10 flex h-full w-full items-center justify-center px-4">
            <p
                class="deforestory-hero-loader-title"
                x-bind:class="{ 'is-opening': phase === 'opening' || phase === 'done' }"
                @if ($loaderUrl)
                    style="background-image: url('{{ $loaderUrl }}')"
                @endif
            >Deforestory</p>
        </div>
    </div>
</div>

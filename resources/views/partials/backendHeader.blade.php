<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-6 py-3">
        <a href="{{ url('/cms/dashboard') }}" class="flex items-center">
            <img src="{{ asset('assets/logo-simontinus.png') }}" alt="Simontini" class="h-9">
        </a>

        <div class="flex items-center gap-4">
            <a href="{{ url('/id') }}" target="_blank" rel="noopener" class="hidden items-center gap-1.5 text-xs font-semibold text-gray-500 hover:text-simontini sm:inline-flex">
                Lihat situs
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5h5v5m0-5L10 14M19 14v5H5V5h5"/></svg>
            </a>
            @include('partials.toogleProfile')
        </div>
    </div>
</header>

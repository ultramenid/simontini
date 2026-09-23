<div class="relative" x-data="{ open: false }" @keydown.escape="open = false" @click.outside="open = false">
    <button type="button" @click="open = !open" aria-label="Akun" aria-haspopup="true" :aria-expanded="open"
            class="flex h-9 w-9 items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:border-simontini hover:text-simontini focus:outline-none focus-visible:ring-2 focus-visible:ring-[#376A64]">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 100-8 4 4 0 000 8zM4 20a8 8 0 0116 0"/></svg>
    </button>

    <div x-show="open" x-cloak x-transition.opacity class="absolute right-0 z-40 mt-2 w-40 border border-gray-200 bg-white py-1 shadow-lg">
        <a href="{{ url('/cms/logout') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
            Log out
        </a>
    </div>
</div>

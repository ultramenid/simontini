<div
    x-data="{ visible: window.scrollY > 400 }"
    x-on:scroll.window="visible = window.scrollY > 400"
    x-show="visible"
    x-transition.opacity.duration.200ms
    x-cloak
    class="fixed bottom-6 right-6 z-50"
>
    <button
        type="button"
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        title="Kembali ke atas"
        aria-label="Kembali ke atas"
        class="flex h-12 w-12 items-center justify-center border border-[#376A64] bg-[#376A64] text-white shadow-lg transition hover:bg-white hover:text-[#376A64]"
    >
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="m5 15 7-7 7 7" />
        </svg>
    </button>
</div>

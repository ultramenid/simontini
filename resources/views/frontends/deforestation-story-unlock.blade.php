@extends('layouts.indexLayout')

@section('meta')
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="{{ $description }}">
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    <x-deforestation-preview-banner />

    <main class="flex min-h-[70vh] items-center justify-center bg-[#f7f8f8] px-5 py-16 sm:px-8">
        <section class="w-full max-w-lg border border-[#d8e1df] bg-white px-6 py-10 text-center shadow-sm sm:px-10 sm:py-12">
            <span class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#e5efed] text-[#376A64]">
                <svg class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5 8V6a5 5 0 0110 0v2a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2Zm8-2v2H7V6a3 3 0 116 0Z" clip-rule="evenodd" /></svg>
            </span>

            <p class="mt-6 text-[10px] font-bold uppercase tracking-[0.18em] text-[#376A64]">
                {{ $locale === 'en' ? 'Protected preview' : 'Preview dilindungi' }}
            </p>
            <h1 class="mt-3 text-2xl font-black leading-tight tracking-[-0.035em] text-[#1a1a1a] sm:text-3xl">
                {{ $story->localized_title }}
            </h1>
            <p class="mx-auto mt-4 max-w-md text-sm leading-6 text-[#6f746f]">
                {{ $locale === 'en'
                    ? 'Enter this story’s password to continue.'
                    : 'Masukkan password khusus artikel ini untuk melanjutkan.' }}
            </p>

            <form
                method="POST"
                action="{{ $unlockUrl }}"
                x-data="{
                    submitting: false,
                    letters: Array(11).fill('A'),
                    settled: Array(11).fill(false),
                    spinTimer: null,
                    startLoader(form) {
                        if (this.submitting) return;

                        this.submitting = true;
                        this.letters = Array(11).fill('A');
                        this.settled = Array(11).fill(false);

                        const target = Array.from('Deforestory');
                        const alphabet = Array.from('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                        if (reducedMotion) {
                            this.letters = target;
                            this.settled = Array(11).fill(true);
                            setTimeout(() => form.submit(), 250);
                            return;
                        }

                        let tick = 0;
                        this.spinTimer = setInterval(() => {
                            tick += 1;
                            this.letters = this.letters.map((letter, index) => (
                                this.settled[index] ? letter : alphabet[(tick + (index * 3)) % alphabet.length]
                            ));
                        }, 55);

                        target.forEach((letter, index) => {
                            setTimeout(() => {
                                const nextLetters = [...this.letters];
                                const nextSettled = [...this.settled];
                                nextLetters[index] = letter;
                                nextSettled[index] = true;
                                this.letters = nextLetters;
                                this.settled = nextSettled;
                            }, 320 + (index * 80));
                        });

                        setTimeout(() => {
                            clearInterval(this.spinTimer);
                            this.letters = target;
                            this.settled = Array(11).fill(true);
                            setTimeout(() => form.submit(), 250);
                        }, 1250);
                    },
                }"
                x-on:submit.prevent="startLoader($el)"
                class="mt-8 text-left"
            >
                @csrf
                <label for="preview-password" class="mb-2 block text-xs font-bold uppercase tracking-[0.1em] text-[#1a1a1a]">
                    {{ $locale === 'en' ? 'Story password' : 'Password artikel' }}
                </label>
                <input
                    id="preview-password"
                    name="password"
                    type="password"
                    required
                    maxlength="100"
                    autocomplete="current-password"
                    autofocus
                    class="w-full rounded-lg border border-[#cfd8d6] px-4 py-3 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/15"
                    aria-describedby="preview-password-error"
                >
                @error('password')
                    <p id="preview-password-error" class="mt-2 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror

                <button type="submit" x-bind:disabled="submitting" class="mt-5 w-full rounded-lg bg-[#376A64] px-6 py-3 text-xs font-bold uppercase tracking-[0.12em] text-white transition hover:bg-[#2d5954] disabled:cursor-wait disabled:opacity-70">
                    {{ $locale === 'en' ? 'Open story' : 'Buka artikel' }}
                </button>

                <div
                    x-show="submitting"
                    x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/95 px-6 backdrop-blur-sm"
                    role="status"
                    aria-live="assertive"
                    aria-label="Deforestory"
                >
                    <div class="text-center">
                        <div class="flex items-end justify-center" aria-hidden="true">
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[0] }" x-text="letters[0]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[1] }" x-text="letters[1]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[2] }" x-text="letters[2]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[3] }" x-text="letters[3]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[4] }" x-text="letters[4]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[5] }" x-text="letters[5]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[6] }" x-text="letters[6]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[7] }" x-text="letters[7]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[8] }" x-text="letters[8]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[9] }" x-text="letters[9]">A</span>
                            <span class="deforestory-loader-letter" x-bind:class="{ 'is-settled': settled[10] }" x-text="letters[10]">A</span>
                        </div>
                        <p class="mt-4 text-xs font-semibold tracking-[0.12em] text-[#376A64]">
                            {{ $locale === 'en' ? 'Opening story...' : 'Membuka artikel...' }}
                        </p>
                    </div>
                </div>
            </form>

            <a href="{{ $previewIndexUrl }}" class="mt-6 inline-flex text-xs font-semibold text-[#376A64] underline decoration-[#376A64]/40 underline-offset-4 hover:decoration-[#376A64]">
                {{ $locale === 'en' ? 'Back to preview list' : 'Kembali ke daftar preview' }}
            </a>
        </section>
    </main>
@endsection

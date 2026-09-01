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

            <form method="POST" action="{{ $unlockUrl }}" class="mt-8 text-left">
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

                <button type="submit" class="mt-5 w-full rounded-lg bg-[#376A64] px-6 py-3 text-xs font-bold uppercase tracking-[0.12em] text-white transition hover:bg-[#2d5954]">
                    {{ $locale === 'en' ? 'Open story' : 'Buka artikel' }}
                </button>
            </form>

            <a href="{{ $previewIndexUrl }}" class="mt-6 inline-flex text-xs font-semibold text-[#376A64] underline decoration-[#376A64]/40 underline-offset-4 hover:decoration-[#376A64]">
                {{ $locale === 'en' ? 'Back to preview list' : 'Kembali ke daftar preview' }}
            </a>
        </section>
    </main>
@endsection

@extends('layouts.indexLayout')

@section('meta')
    @if ($isPreview)
        <meta name="robots" content="noindex, nofollow">
    @endif
    <meta name="description" content="{{ $description }}">
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    @if ($isPreview)
        <x-deforestation-preview-banner />
    @endif

    <div
        x-data="{ subscribeOpen: false, subscribed: false, subscriptionEmail: '' }"
        x-on:story-subscription-succeeded="subscribeOpen = true; subscribed = true; subscriptionEmail = $event.detail.email"
    >
        <section class="flex h-[40vh] min-h-[300px] w-full items-center bg-[#376A64] px-5 text-center text-white sm:min-h-[340px]">
            <div class="mx-auto w-full max-w-4xl">
                <h1 class="text-3xl font-black tracking-wide sm:text-6xl">Deforestory</h1>
                <p class="mx-auto mt-4 max-w-3xl px-4 text-xs leading-6 sm:text-base sm:leading-7">
                    {{ $locale === 'en'
                        ? 'Simontini data is open and publicly accessible under the Creative Commons CC-BY-SA license, subject to its terms of use.'
                        : 'Cerita ringkas kasus-kasus deforestasi Indonesia. Mengkombinasi analisis data sekunder dengan pengamatan lapangan oleh Auriga Nusantara dan atau mitra. Kasus-kasus yang tampil di laman ini terbuka untuk ditindaklanjuti dengan laporan investigasi yang akan ditampilkan tersendiri di tempat terpisah. Demi terhentinya deforestasi.' }}
                </p>
                <button data-subscribe-open type="button" x-on:click="subscribed = false; subscriptionEmail = ''; subscribeOpen = true" class="mt-7 rounded-lg bg-white px-8 py-3 text-xs font-bold uppercase tracking-[0.14em] text-[#376A64] shadow-lg transition duration-300 hover:-translate-y-0.5 hover:bg-[#f5f0e8] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white" aria-haspopup="dialog">
                    Subscribe
                </button>
            </div>
        </section>

        <div x-show="subscribeOpen" x-cloak x-on:keydown.escape.window="subscribeOpen = false; subscribed = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4" role="dialog" aria-modal="true">
            <button type="button" x-on:click="subscribeOpen = false; subscribed = false" class="absolute inset-0 h-full w-full bg-black/55" aria-label="Tutup popup subscribe"></button>
            <div x-on:click.stop class="relative z-10 max-h-[calc(100vh-2rem)] w-full max-w-lg overflow-y-auto rounded-2xl bg-white p-6 text-left shadow-2xl sm:p-8">
                <button type="button" x-on:click="subscribeOpen = false; subscribed = false" class="absolute right-4 top-3 text-3xl leading-none text-[#7a6e60] hover:text-[#1a1a1a]" aria-label="Tutup popup">×</button>

                <div x-show="!subscribed">
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#bc4a3c]">{{ $locale === 'en' ? 'Follow updates' : 'Ikuti pembaruan' }}</p>
                    <h2 class="mt-2 pr-8 text-2xl font-black tracking-[-0.04em] sm:text-3xl">{{ $locale === 'en' ? 'Follow every Deforestory' : 'Ikuti semua Deforestory' }}</h2>
                    <p class="mt-3 text-sm leading-6 text-[#7a6e60]">{{ $locale === 'en' ? 'Enter your email address to follow new stories and updates.' : 'Masukkan alamat email untuk mengikuti story baru dan seluruh pembaruan yang akan muncul di halaman ini.' }}</p>

                    <form method="POST" action="{{ route('deforestation.subscribe.all', ['locale' => $locale]) }}" data-story-subscribe-form data-loading-label="{{ $locale === 'en' ? 'Processing...' : 'Memproses...' }}" class="mt-6">
                        @csrf
                        <label for="subscribe-name" class="mb-2 block text-xs font-bold uppercase tracking-[0.1em]">{{ $locale === 'en' ? 'Full name' : 'Nama lengkap' }}</label>
                        <input id="subscribe-name" name="name" type="text" required maxlength="100" autocomplete="name" placeholder="{{ $locale === 'en' ? 'Your name' : 'Nama Anda' }}" class="w-full rounded-full border border-[#e2d8cc] bg-white px-5 py-3.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10">
                        <label for="subscribe-email" class="mb-2 mt-4 block text-xs font-bold uppercase tracking-[0.1em]">{{ $locale === 'en' ? 'Email address' : 'Alamat email' }}</label>
                        <input id="subscribe-email" name="email" type="email" required autocomplete="email" placeholder="nama@email.com" class="w-full rounded-full border border-[#e2d8cc] bg-white px-5 py-3.5 text-sm outline-none transition focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10">
                        <button type="submit" class="mt-5 w-full rounded-full bg-[#376A64] px-6 py-3.5 text-[11px] font-bold uppercase tracking-[0.12em] text-white transition hover:bg-[#2d5954] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#376A64] disabled:cursor-wait disabled:opacity-70">{{ $locale === 'en' ? 'Subscribe' : 'Aktifkan langganan' }}</button>
                        <p data-story-subscribe-feedback class="mt-3 hidden text-center text-xs font-semibold" role="status" aria-live="polite"></p>
                    </form>
                </div>

                <div x-show="subscribed" x-cloak class="px-3 py-10 text-center" role="status" aria-live="polite">
                    <span class="subscription-success-icon mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#e5efed] text-[#376A64]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-10 w-10" aria-hidden="true"><path class="subscription-success-check" d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <h2 class="mt-6 text-2xl font-black tracking-[-0.03em]">{{ $locale === 'en' ? 'Email successfully registered' : 'Email berhasil didaftarkan' }}</h2>
                    <p class="mt-3 break-all text-sm font-semibold text-[#376A64]" x-text="subscriptionEmail"></p>
                    <p class="mt-3 text-sm leading-6 text-[#7a6e60]">{{ $locale === 'en' ? 'You will receive the latest Deforestory updates.' : 'Anda akan menerima pembaruan Deforestory terbaru.' }}</p>
                    <button type="button" x-on:click="subscribeOpen = false; subscribed = false" class="mt-7 rounded-full bg-[#376A64] px-8 py-3 text-[11px] font-bold uppercase tracking-[0.12em] text-white hover:bg-[#2d5954]">{{ $locale === 'en' ? 'Close' : 'Tutup' }}</button>
                </div>
            </div>
        </div>
    </div>

    <main>
        <section id="publikasi" class="scroll-mt-24">
            <div class="mx-auto max-w-[1440px] px-5 py-14 sm:px-8 sm:py-20 lg:px-12 lg:py-24">
                <div class="space-y-24 sm:space-y-28">
                    @forelse ($storyGroups as $month => $monthStories)
                    <section class="scroll-mt-40">
                        <h2 class="mb-8 text-2xl font-bold leading-relaxed tracking-[-0.05em] text-[#376A64] sm:text-3xl">{{ $month }}</h2>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-12 md:grid-cols-2 xl:grid-cols-4 xl:gap-x-7">
                            @foreach ($monthStories as $story)
                                <x-deforestation-story-card :story="$story" :locale="$locale" :is-preview="$isPreview" />
                            @endforeach
                        </div>
                    </section>
                    @empty
                        <div class="border border-dashed border-gray-300 px-6 py-16 text-center text-gray-500">
                            {{ $locale === 'en' ? 'No deforestation stories are available yet.' : 'Belum ada Deforestory yang tersedia.' }}
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

@endsection

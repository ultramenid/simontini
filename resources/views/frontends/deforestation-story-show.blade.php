@extends('layouts.indexLayout')

@section('meta')
    @php
        $metaTitle = $story->localized_title;
        $metaDescription = \Illuminate\Support\Str::limit(
            trim(preg_replace('/\s+/', ' ', strip_tags($story->localized_description))),
            160
        );
        $metaUrl = route(
            $isPreview ? 'deforestation.preview.show' : 'deforestation.show',
            ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug]
        );
        $metaImage = asset('assets/meta-image-2025.jpg');

        if ($story->localized_image) {
            $metaImage = \Illuminate\Support\Str::startsWith($story->localized_image, ['http://', 'https://'])
                ? $story->localized_image
                : url(\Illuminate\Support\Facades\Storage::url($story->localized_image));
        }
    @endphp

    @if ($isPreview)
        <meta name="robots" content="noindex, nofollow">
    @else
        <link rel="canonical" href="{{ $metaUrl }}">
    @endif
    <meta name="description" content="{{ $metaDescription }}">

    <meta property="og:type" content="article">
    <meta property="og:site_name" content="SIMONTINI">
    <meta property="og:locale" content="{{ $locale === 'en' ? 'en_US' : 'id_ID' }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $metaUrl }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:image:alt" content="{{ $metaTitle }}">
    <meta property="article:published_time" content="{{ \Carbon\Carbon::parse($story->date)->toIso8601String() }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    @if ($isPreview)
        <x-deforestation-preview-banner />
    @endif

    <main
        class="pb-24"
        x-data="{ subscribeOpen: false, subscribed: false, subscriptionEmail: '' }"
        x-on:story-subscription-succeeded="subscribeOpen = true; subscribed = true; subscriptionEmail = $event.detail.email"
    >
        <article>
            @if ($story->localized_image)
                <figure class="mx-auto max-w-[1200px] px-5 pt-9 sm:px-8 sm:pt-14 lg:px-12">
                    <div class="aspect-[16/9] overflow-hidden bg-[#e8e8e8]">
                        <img src="{{ Storage::url($story->localized_image) }}" alt="{{ $story->localized_title }}" class="h-full w-full object-cover" fetchpriority="high">
                    </div>
                </figure>
            @endif

            <div class="mx-auto max-w-[720px] px-5 pt-10 sm:px-8 sm:pt-14">
                <h1 class="text-3xl font-black uppercase leading-[1.08] tracking-[-0.045em] sm:text-4xl">{{ $story->localized_title }}</h1>

                <div class="article-copy public-story-content mt-9 text-[15px] leading-[1.85] text-gray-800 sm:text-[17px]">
                    {!! $story->localized_content !!}
                </div>

                <div class="mt-12 border-b border-[#e2d8cc] px-4 pb-8 text-center">
                    <p class="text-lg font-black tracking-[-0.025em] text-[#1a1a1a] sm:text-xl">
                        {{ $locale === 'en' ? 'Follow this story’s progress' : 'Ikuti perkembangan story ini' }}
                    </p>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#7a6e60]">
                        {{ $locale === 'en' ? 'Get an email notification whenever a new update is published.' : 'Dapatkan pemberitahuan melalui email setiap kali ada pembaruan terbaru.' }}
                    </p>
                    <button type="button" x-on:click="subscribed = false; subscriptionEmail = ''; subscribeOpen = true" class="mt-5 shrink-0 rounded-lg bg-[#376A64] px-6 py-3 text-[10px] font-bold uppercase tracking-[0.12em] text-white transition hover:bg-[#2d5954]">
                        Subscribe
                    </button>
                </div>

                @if ($updates->isNotEmpty())
                    <section class="mt-20" aria-label="{{ $locale === 'en' ? 'Story updates' : 'Pembaruan story' }}">
                        <div class="space-y-10">
                            @foreach ($updates as $update)
                                @php
                                    $updateDate = \Carbon\Carbon::parse($update->published_at)->locale($locale);
                                    $updateAnchor = 'update-'.\Illuminate\Support\Str::slug($update->localized_title).'-'.$update->id;
                                @endphp
                                <div id="{{ $updateAnchor }}" class="update-timeline-item relative">
                                    <time datetime="{{ $update->published_at }}" class="mb-5 flex items-center gap-3 lg:absolute lg:-left-36 lg:top-3 lg:z-10 lg:mb-0 lg:w-32 lg:justify-end">
                                        <span class="flex flex-col items-center text-center">
                                            <span class="text-xs font-black uppercase leading-none tracking-[0.1em] text-[#bc4a3c]">{{ $updateDate->translatedFormat('d M') }}</span>
                                            <span class="mt-1 text-sm font-black uppercase leading-none tracking-[0.12em] text-[#7a6e60]">{{ $updateDate->format('Y') }}</span>
                                        </span>
                                        <span class="h-4 w-4 shrink-0 rounded-full bg-[#376A64] ring-4 ring-[#e5efed]" aria-hidden="true"></span>
                                    </time>

                                    <article class="w-full overflow-hidden border border-[#e2d8cc] bg-white shadow-sm sm:aspect-[320/63]">
                                        <a href="{{ $update->target_url }}" target="_blank" rel="noopener noreferrer" class="block sm:grid sm:h-full sm:grid-cols-[35%_1fr]">
                                            <div class="aspect-video overflow-hidden bg-[#e8e8e8] sm:h-full sm:aspect-auto">
                                                @if (filled($update->image_url))
                                                    <img src="{{ $update->image_url }}" alt="{{ $update->localized_title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
                                                @endif
                                            </div>
                                            <div class="flex min-h-0 flex-col overflow-hidden p-5 sm:h-full sm:p-3">
                                                <h3 class="update-card-title text-lg font-black uppercase leading-tight tracking-[-0.03em]">{{ $update->localized_title }}</h3>
                                                <p class="update-card-description mt-2 text-xs leading-5 text-gray-600 sm:text-sm">{{ $update->localized_description }}</p>
                                                <span class="mt-4 inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.14em] text-[#bc4a3c] sm:mt-auto sm:pt-2">Go to <span aria-hidden="true">→</span></span>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                @include('frontends.partials.story-comments')
            </div>
        </article>

        <div x-show="subscribeOpen" x-cloak x-on:keydown.escape.window="subscribeOpen = false; subscribed = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4" role="dialog" aria-modal="true">
            <button type="button" x-on:click="subscribeOpen = false; subscribed = false" class="absolute inset-0 h-full w-full bg-black/55" aria-label="Tutup popup subscribe"></button>
            <div x-on:click.stop class="relative z-10 max-h-[calc(100vh-2rem)] w-full max-w-lg overflow-y-auto rounded-[2rem] bg-white p-6 text-left shadow-2xl sm:p-8">
                <button type="button" x-on:click="subscribeOpen = false; subscribed = false" class="absolute right-4 top-3 text-3xl leading-none text-[#7a6e60] hover:text-[#1a1a1a]" aria-label="Tutup popup">×</button>

                <div x-show="!subscribed">
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#bc4a3c]">{{ $locale === 'en' ? 'Story updates' : 'Pembaruan story' }}</p>
                    <h2 class="mt-2 pr-8 text-2xl font-black tracking-[-0.04em] sm:text-3xl">{{ $locale === 'en' ? 'Follow this story' : 'Ikuti story ini' }}</h2>
                    <p class="mt-3 text-sm leading-6 text-[#7a6e60]">{{ $locale === 'en' ? 'Enter your email to receive updates about' : 'Masukkan alamat email untuk menerima pembaruan tentang' }} “{{ $story->localized_title }}”.</p>
                    <form method="POST" action="{{ route('deforestation.subscribe', ['locale' => $locale, 'id' => $story->id]) }}" data-story-subscribe-form data-loading-label="{{ $locale === 'en' ? 'Processing...' : 'Memproses...' }}" class="mt-6">
                        @csrf
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.1em]">{{ $locale === 'en' ? 'Full name' : 'Nama lengkap' }}</label>
                        <input name="name" type="text" required maxlength="100" autocomplete="name" class="w-full rounded-full border border-[#e2d8cc] px-5 py-3.5 text-sm outline-none focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10">
                        <label class="mb-2 mt-4 block text-xs font-bold uppercase tracking-[0.1em]">Email</label>
                        <input name="email" type="email" required autocomplete="email" class="w-full rounded-full border border-[#e2d8cc] px-5 py-3.5 text-sm outline-none focus:border-[#376A64] focus:ring-2 focus:ring-[#376A64]/10">
                        <button type="submit" class="mt-5 w-full rounded-full bg-[#376A64] px-6 py-3.5 text-[11px] font-bold uppercase tracking-[0.12em] text-white hover:bg-[#2d5954] disabled:cursor-wait disabled:opacity-70">{{ $locale === 'en' ? 'Subscribe' : 'Aktifkan langganan' }}</button>
                        <p data-story-subscribe-feedback class="mt-3 hidden text-center text-xs font-semibold" role="status" aria-live="polite"></p>
                    </form>
                </div>

                <div x-show="subscribed" x-cloak class="px-3 py-10 text-center" role="status" aria-live="polite">
                    <span class="subscription-success-icon mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#e5efed] text-[#376A64]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-10 w-10" aria-hidden="true"><path class="subscription-success-check" d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <h2 class="mt-6 text-2xl font-black tracking-[-0.03em]">{{ $locale === 'en' ? 'Email successfully registered' : 'Email berhasil didaftarkan' }}</h2>
                    <p class="mt-3 break-all text-sm font-semibold text-[#376A64]" x-text="subscriptionEmail"></p>
                    <p class="mt-3 text-sm leading-6 text-[#7a6e60]">{{ $locale === 'en' ? 'You will receive this story’s latest updates.' : 'Anda akan menerima pembaruan terbaru dari story ini.' }}</p>
                    <button type="button" x-on:click="subscribeOpen = false; subscribed = false" class="mt-7 rounded-full bg-[#376A64] px-8 py-3 text-[11px] font-bold uppercase tracking-[0.12em] text-white hover:bg-[#2d5954]">{{ $locale === 'en' ? 'Close' : 'Tutup' }}</button>
                </div>
            </div>
        </div>

        <x-scroll-to-top
            :label="$locale === 'en' ? 'Back to top' : 'Kembali ke atas'"
            variant="outline"
            double
            raised
        />
    </main>

@endsection

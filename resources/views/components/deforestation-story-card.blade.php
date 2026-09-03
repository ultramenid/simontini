@props(['story', 'locale', 'isPreview' => false])

@php
    $detailRoute = $isPreview ? 'deforestation.preview.show' : 'deforestation.show';
    $detailParameters = ['locale' => $locale, 'id' => $story->id, 'slug' => $story->slug];
    $detailUrl = $isPreview
        ? URL::temporarySignedRoute(
            $detailRoute,
            request()->integer('expires')
                ? \Carbon\Carbon::createFromTimestamp(request()->integer('expires'))
                : now()->addDays(7),
            $detailParameters,
        )
        : route($detailRoute, $detailParameters);
@endphp

<article class="story-card relative">
    <a href="{{ $detailUrl }}" class="block focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#bc4a3c]">
        <div class="relative aspect-[16/10] overflow-hidden bg-[#e8e8e8]">
            @if ($story->localized_image)
                @if ($story->localized_media_is_video ?? false)
                    <video src="{{ Storage::url($story->localized_image) }}" muted playsinline preload="metadata" class="h-full w-full object-cover"></video>
                @else
                    <img src="{{ Storage::url($story->localized_image) }}" alt="{{ $story->localized_title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
                @endif
            @else
                <div class="flex h-full items-center justify-center text-sm text-gray-400">No image</div>
            @endif

            @if ($isPreview && ($story->is_locked ?? false))
                <span
                    data-preview-lock
                    class="absolute right-2 top-2 z-10 inline-flex h-9 w-9 items-center justify-center rounded-full text-white shadow"
                    style="background-color: #376A64"
                    title="{{ $locale === 'en' ? 'Protected preview' : 'Preview dikunci' }}"
                    aria-label="{{ $locale === 'en' ? 'Protected preview' : 'Preview dikunci' }}"
                >
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5 8V6a5 5 0 0110 0v2a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2Zm8-2v2H7V6a3 3 0 116 0Z" clip-rule="evenodd" /></svg>
                </span>
            @endif
        </div>

        <div class="pt-5">
            <h3 data-card-title class="story-title text-[16px] font-bold leading-[1.2] tracking-[-0.025em]">{{ $story->localized_title }}</h3>
            <p data-card-description class="story-description mt-3 text-[12px] font-normal leading-[1.6] text-black">{{ \Illuminate\Support\Str::limit(strip_tags($story->localized_description), 147) }}</p>
        </div>
    </a>
</article>

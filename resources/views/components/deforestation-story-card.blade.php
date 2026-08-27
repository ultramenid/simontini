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

<article class="story-card group relative">
    <a href="{{ $detailUrl }}" class="block focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#bc4a3c]">
        <div class="aspect-[16/10] overflow-hidden bg-[#e8e8e8]">
            @if ($story->localized_image)
                <img src="{{ Storage::url($story->localized_image) }}" alt="{{ $story->localized_title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
            @else
                <div class="flex h-full items-center justify-center text-sm text-gray-400">No image</div>
            @endif
        </div>

        <div class="pt-5">
            <h3 class="story-title text-lg font-black uppercase leading-[1.25] tracking-[-0.025em] transition-colors duration-300 group-hover:text-[#bc4a3c]">{{ $story->localized_title }}</h3>
            <p class="story-description mt-3 text-[12px] leading-[1.75] text-[#1a1a1a]/70">{{ strip_tags($story->localized_description) }}</p>
        </div>
    </a>
</article>

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
        <div class="aspect-[16/10] overflow-hidden bg-[#e8e8e8]">
            @if ($story->localized_image)
                <img src="{{ Storage::url($story->localized_image) }}" alt="{{ $story->localized_title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
            @else
                <div class="flex h-full items-center justify-center text-sm text-gray-400">No image</div>
            @endif
        </div>

        <div class="pt-5">
            <h3 data-card-title class="story-title text-[16px] font-bold leading-[1.2] tracking-[-0.025em]">{{ $story->localized_title }}</h3>
            <p data-card-description class="story-description mt-3 text-[12px] font-normal leading-[1.6] text-black">{{ \Illuminate\Support\Str::limit(strip_tags($story->localized_description), 147) }}</p>
        </div>
    </a>
</article>

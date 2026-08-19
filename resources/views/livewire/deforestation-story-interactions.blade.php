<div>
    @if ($updates->isNotEmpty())
        <section class="mt-20" aria-label="{{ $locale === 'en' ? 'Story updates' : 'Pembaruan story' }}">
            <div class="space-y-10">
                @foreach ($updates as $update)
                    @php
                        $updateDate = \Carbon\Carbon::parse($update->published_at)->locale($locale);
                        $updateAnchor = 'update-'.\Illuminate\Support\Str::slug($update->localized_title).'-'.$update->id;
                    @endphp
                    <div id="{{ $updateAnchor }}" class="update-timeline-item relative" wire:key="story-update-{{ $update->id }}">
                        <time datetime="{{ $update->published_at }}" class="mb-5 flex items-center gap-3 lg:absolute lg:-left-36 lg:top-3 lg:z-10 lg:mb-0 lg:w-32 lg:justify-end">
                            <span class="flex flex-col items-center text-center">
                                <span class="text-xs font-black uppercase leading-none tracking-[0.1em] text-[#bc4a3c]">{{ $updateDate->translatedFormat('d M') }}</span>
                                <span class="mt-1 text-sm font-black uppercase leading-none tracking-[0.12em] text-[#7a6e60]">{{ $updateDate->format('Y') }}</span>
                            </span>
                            <span class="h-4 w-4 shrink-0 rounded-full bg-[#376A64] ring-4 ring-[#e5efed]" aria-hidden="true"></span>
                        </time>

                        <article class="w-full overflow-hidden border border-[#e2d8cc] bg-white shadow-sm">
                            <a href="{{ $update->target_url }}" target="_blank" rel="noopener noreferrer" class="block sm:grid sm:grid-cols-[28%_1fr]">
                                <div class="aspect-video overflow-hidden bg-[#e8e8e8] sm:self-start">
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

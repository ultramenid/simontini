@php
    $publicName = $comment->user_name === 'Anonymous' && $locale === 'id' ? 'Anonim' : $comment->user_name;
    $replies = $comments->where('parent_id', $comment->id);
    $canReply = $depth < 3;
@endphp

<article
    id="comment-{{ $comment->id }}"
    data-comment-thread-item
    class="comment-thread-item {{ $depth === 0 ? 'border-b border-[#e2d8cc] pb-8' : '' }}"
    x-data="{
        repliesOpen: false,
        replyVerified: false,
        replyAnonymous: false,
        replyDisplayName: @js(session('comment_display_name', $commentUser['name'] ?? ''))
    }"
    x-on:reply-turnstile-success.window="if ($event.detail.id === {{ $comment->id }}) replyVerified = true"
    x-on:reply-turnstile-expired.window="if ($event.detail.id === {{ $comment->id }}) replyVerified = false"
>
    @if ($replies->isNotEmpty())
        <span
            x-show="repliesOpen"
            data-comment-parent-rail
            class="comment-thread-parent-rail"
            aria-hidden="true"
        ></span>
    @endif

    <div class="flex gap-3 sm:gap-4">
        <span data-comment-thread-avatar class="relative z-[2] flex {{ $depth === 0 ? 'h-12 w-12 bg-[#376A64] text-base text-white' : 'h-10 w-10 bg-[#e5efed] text-sm text-[#376A64]' }} shrink-0 items-center justify-center rounded-full font-black">
            {{ $comment->user_name === 'Anonymous' ? '?' : strtoupper(mb_substr($publicName, 0, 1)) }}
        </span>
        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-baseline justify-between gap-2">
                <h3 class="{{ $depth === 0 ? 'text-base' : 'text-sm' }} font-bold">{{ $publicName }}</h3>
                <time class="text-[11px] text-[#7a6e60]" datetime="{{ $comment->created_at }}">{{ \Carbon\Carbon::parse($comment->created_at)->locale($locale)->diffForHumans() }}</time>
            </div>
            <div class="mt-2 break-words text-sm leading-7 text-gray-700 [&_a]:text-[#376A64] [&_a]:underline [&_ol]:my-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-black [&_ul]:my-2 [&_ul]:list-disc [&_ul]:pl-5">
                {!! $comment->safe_comment !!}
            </div>

            @if ($canReply || $replies->isNotEmpty())
                <div class="mt-4 flex flex-wrap items-center gap-5 text-[10px] font-black uppercase tracking-[0.14em] text-[#376A64]">
                @if ($canReply)
                    @if ($commentUser)
                        <button type="button" data-comment-reply-toggle="{{ $comment->id }}" class="hover:text-[#bc4a3c]">{{ $locale === 'en' ? 'Reply' : 'Balas' }}</button>
                    @else
                        <button type="button" data-comment-reply-toggle="{{ $comment->id }}" aria-expanded="false" class="hover:text-[#bc4a3c]">{{ $locale === 'en' ? 'Reply' : 'Balas' }}</button>
                    @endif
                @endif

                @if ($replies->isNotEmpty())
                    <button type="button" data-comment-replies-toggle x-on:click="repliesOpen = !repliesOpen" class="inline-flex items-center gap-2 hover:text-[#bc4a3c]">
                        <svg class="h-3.5 w-3.5 transition-transform" x-bind:class="repliesOpen ? 'rotate-180' : ''" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m3 6 5 5 5-5"/></svg>
                        <span x-text="repliesOpen ? @js($locale === 'en' ? 'Hide replies' : 'Sembunyikan balasan') : @js(($locale === 'en' ? 'View ' : 'Lihat ').$replies->count().($locale === 'en' ? ' replies' : ' balasan'))"></span>
                    </button>
                @endif
                </div>
            @endif
        </div>
    </div>

    @if ($commentUser && $canReply)
        @include('frontends.partials.comment-reply-form')
    @elseif (! $commentUser && $canReply && $googleLoginReady)
        @include('frontends.partials.comment-reply-login')
    @endif

    @if ($replies->isNotEmpty())
        <div x-show="repliesOpen" data-comment-thread-children x-transition.opacity.duration.200ms class="comment-thread-children {{ $depth === 0 ? 'ml-6' : 'ml-5' }} mt-4 space-y-4 pl-8">
            @foreach ($replies as $reply)
                @include('frontends.partials.comment-item', ['comment' => $reply, 'depth' => $depth + 1])
            @endforeach
        </div>
    @endif
</article>

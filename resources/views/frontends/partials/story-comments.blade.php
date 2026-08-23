<section id="comments" class="mt-20 scroll-mt-28 border-t border-[#e2d8cc] pt-12" aria-labelledby="comments-title">
    <div class="flex items-end justify-between gap-5">
        <div>
            <p class="text-[11px] font-black uppercase tracking-[0.24em] text-[#376A64]">{{ $locale === 'en' ? 'Discussion' : 'Diskusi' }}</p>
            <h2 id="comments-title" class="mt-3 text-[28px] font-bold tracking-[-0.045em] sm:text-[32px]" style="font-weight: 700;">{{ $locale === 'en' ? 'Comments' : 'Komentar' }}</h2>
        </div>
        <p class="pb-1 text-sm text-[#7a6e60] sm:text-base">{{ $comments->count() }} {{ $locale === 'en' ? 'comments' : 'komentar' }}</p>
    </div>

    @if (session('comment_success'))
        <div class="mt-6 border-l-4 border-[#376A64] bg-[#e5efed] px-5 py-4 text-sm font-semibold text-[#244b47]">{{ session('comment_success') }}</div>
    @endif
    @if (session('comment_error'))
        <div class="mt-6 border-l-4 border-[#bc4a3c] bg-red-50 px-5 py-4 text-sm font-semibold text-red-800">{{ session('comment_error') }}</div>
    @endif
    <div data-comment-feedback class="mt-6 hidden border-l-4 px-5 py-4 text-sm font-semibold" role="status" aria-live="polite"></div>

    @php
        $displayName = old('display_name', session('comment_display_name', ''));
        $commentEmail = old('email', session('comment_email', ''));
    @endphp

    @include('frontends.partials.comment-guest-composers')

    @if (! $commentsAvailable)
        <p class="mt-8 border-l-4 border-amber-500 bg-amber-50 px-4 py-3 text-sm text-amber-900">{{ $locale === 'en' ? 'Comments are temporarily unavailable.' : 'Komentar sedang tidak dapat dimuat.' }}</p>
    @elseif ($comments->isEmpty())
        <p class="mt-10 text-sm text-[#7a6e60]">{{ $locale === 'en' ? 'No comments yet.' : 'Belum ada komentar.' }}</p>
    @else
        @php
            $mainComments = $comments->whereNull('parent_id')->values();
        @endphp
        <div class="mt-12" x-data="{ visibleMainComments: 5, totalMainComments: {{ $mainComments->count() }} }">
            <div class="space-y-8">
                @foreach ($mainComments as $mainCommentIndex => $comment)
                    <div
                        x-show="visibleMainComments > {{ $mainCommentIndex }}"
                        @if ($mainCommentIndex >= 5) x-cloak x-transition.opacity.duration.200ms @endif
                        data-main-comment-index="{{ $mainCommentIndex }}"
                    >
                        @include('frontends.partials.comment-item', ['depth' => 0])
                    </div>
                @endforeach
            </div>

            <div x-cloak x-show="visibleMainComments < totalMainComments" class="mt-10 text-center">
                <button
                    type="button"
                    x-on:click="visibleMainComments = Math.min(visibleMainComments + 5, totalMainComments)"
                    class="border border-[#376A64] px-6 py-3 text-[10px] font-black uppercase tracking-[0.14em] text-[#376A64] transition hover:bg-[#376A64] hover:text-white"
                >{{ $locale === 'en' ? 'Read more' : 'Lihat komentar lainnya' }}</button>
            </div>
        </div>
    @endif
</section>

@once
    @push('scripts')
        <script>
            window.initializeCommentTurnstiles = function (root) {
                if (!window.turnstile) return;

                const scope = root && root.querySelectorAll ? root : document;
                scope.querySelectorAll('[data-comment-turnstile]:not([data-turnstile-widget-id])').forEach(function (element) {
                    if (!element.isConnected) return;

                    const replyId = Number(element.dataset.replyTurnstileId || 0);
                    const replyEvent = function (name) {
                        return function () {
                            window.dispatchEvent(new CustomEvent(name, { detail: { id: replyId } }));
                        };
                    };
                    const callback = replyId
                        ? replyEvent('reply-turnstile-success')
                        : window[element.dataset.callback];
                    const expiredCallback = replyId
                        ? replyEvent('reply-turnstile-expired')
                        : window[element.dataset.expiredCallback];
                    const errorCallback = replyId
                        ? replyEvent('reply-turnstile-expired')
                        : window[element.dataset.errorCallback];

                    try {
                        const widgetId = window.turnstile.render(element, {
                            sitekey: element.dataset.sitekey,
                            theme: element.dataset.theme || 'light',
                            size: element.dataset.size || 'flexible',
                            callback: typeof callback === 'function' ? callback : undefined,
                            'expired-callback': typeof expiredCallback === 'function' ? expiredCallback : undefined,
                            'error-callback': typeof errorCallback === 'function' ? errorCallback : undefined,
                        });

                        element.dataset.turnstileWidgetId = widgetId;
                    } catch (error) {
                        delete element.dataset.turnstileWidgetId;
                    }
                });
            };

            window.commentTurnstileSuccess = function () {
                window.dispatchEvent(new CustomEvent('comment-turnstile-success'));
            };
            window.commentTurnstileExpired = function () {
                window.dispatchEvent(new CustomEvent('comment-turnstile-expired'));
            };
            window.quickCommentTurnstileSuccess = function () {
                window.dispatchEvent(new CustomEvent('quick-comment-turnstile-success'));
            };
            window.quickCommentTurnstileExpired = function () {
                window.dispatchEvent(new CustomEvent('quick-comment-turnstile-expired'));
            };
        </script>
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit&amp;onload=initializeCommentTurnstiles" async defer></script>
    @endpush
@endonce

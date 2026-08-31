<div
    class="mt-12"
    data-main-comment-composer
    x-data="{
        expanded: {{ old('comment') || $errors->any() ? 'true' : 'false' }},
        displayName: @js($displayName),
        email: @js($commentEmail),
        anonymous: {{ old('anonymous') ? 'true' : 'false' }},
        commentText: @js(old('comment', '')),
        commentLength: 0,
        turnstilePassed: false,
        collapse() {
            this.expanded = false;
            this.$refs.editorWrapper?.tiptapEditor?.commands.blur();
        }
    }"
    x-on:comment-turnstile-success.window="turnstilePassed = true"
    x-on:comment-turnstile-expired.window="turnstilePassed = false"
    x-on:comment-submitted.window="if (!$event.detail.quick) { turnstilePassed = false; expanded = false }"
    x-on:comment-editor-updated="commentText = $event.detail.html; commentLength = $event.detail.textLength"
    x-on:click.outside="if (expanded) collapse()"
    x-on:keydown.escape.window="if (expanded) collapse()"
>
    <form method="POST" data-comment-ajax-form action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}">
        @csrf

        <div class="grid gap-4 sm:grid-cols-[3.5rem_1fr] sm:items-start sm:gap-4">
            <span class="hidden h-14 w-14 items-center justify-center rounded-full bg-[#376A64] text-lg font-bold text-white sm:flex" x-text="anonymous ? '?' : (displayName.trim().charAt(0).toUpperCase() || 'A')"></span>
            <div class="space-y-3">
                <div>
                    <label for="display_name" class="sr-only">{{ $locale === 'en' ? 'Name' : 'Nama' }} *</label>
                    <input id="display_name" name="display_name" type="text" minlength="2" maxlength="60" required autocomplete="name" x-model="displayName" value="{{ $displayName }}" placeholder="{{ $locale === 'en' ? 'Name *' : 'Nama *' }}" class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-3 text-lg font-medium text-[#1a1a1a] outline-none placeholder:text-[#9f9890] focus:border-[#376A64] focus:ring-0 sm:text-xl">
                    @error('display_name')<p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror
                </div>

                <label class="flex cursor-pointer items-center gap-2 text-xs text-[#665f56]">
                    <input type="checkbox" name="anonymous" value="1" x-model="anonymous" class="h-4 w-4 border-[#8b8379] text-[#376A64] focus:ring-[#376A64]">
                    <span>{{ $locale === 'en' ? 'Post as Anonymous' : 'Tampilkan sebagai Anonymous' }}</span>
                </label>

                <div>
                    <label for="comment_email" class="sr-only">Email *</label>
                    <input id="comment_email" name="email" type="email" maxlength="255" required autocomplete="email" x-model="email" value="{{ $commentEmail }}" placeholder="Email *" class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-3 text-base text-[#1a1a1a] outline-none placeholder:text-[#9f9890] focus:border-[#376A64] focus:ring-0 sm:text-lg">
                    <p class="mt-1 text-[10px] text-[#7a6e60]">{{ $locale === 'en' ? 'Required and never shown publicly.' : 'Wajib diisi dan tidak ditampilkan ke publik.' }}</p>
                    @error('email')<p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div x-ref="editorWrapper" x-on:focusin="expanded = true" x-bind:data-expanded="expanded ? 'true' : 'false'" data-tiptap-wrapper class="comment-tiptap-editor mt-7 overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7] transition-colors focus-within:border-[#376A64]">
            <input id="comment" type="hidden" name="comment" x-model="commentText" value="{{ old('comment') }}" data-tiptap-input>
            <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'What do you think?' : 'Apa pendapat Anda?' }}"></div>
            <div x-show="expanded" x-transition.opacity.duration.200ms class="flex items-center justify-between border-t border-[#dedede] bg-white/60 px-4 py-2.5 sm:px-5">
                @include('frontends.partials.comment-editor-toolbar')
                <span data-tiptap-character-count class="text-[10px] tabular-nums text-[#9a9289]">0/2000</span>
            </div>
        </div>
        @error('comment')<p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror

        <div x-show="expanded" x-transition.opacity.duration.200ms>
            <div x-show="!turnstilePassed" class="mt-3 border border-[#e3e0dc] bg-[#fafafa] px-4 py-5 sm:px-5">
                <p class="mb-4 text-[10px] font-black uppercase tracking-[0.14em] text-[#7a7167]">{{ $locale === 'en' ? 'Security verification' : 'Verifikasi keamanan' }}</p>
                <div class="cf-turnstile" data-comment-turnstile data-sitekey="{{ config('services.turnstile.site_key') }}" data-action="comment" data-theme="light" data-size="flexible" data-callback="commentTurnstileSuccess" data-expired-callback="commentTurnstileExpired" data-error-callback="commentTurnstileExpired"></div>
                @error('cf-turnstile-response')<p class="mt-3 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror
            </div>
            <div class="mt-4 flex justify-end">
                <button type="submit" x-bind:disabled="!turnstilePassed || commentLength < 2 || commentLength > 2000" class="bg-[#376A64] px-7 py-3 text-[10px] font-black uppercase tracking-[0.14em] text-white hover:bg-[#2d5954] disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Submit' : 'Kirim' }}</button>
            </div>
        </div>
    </form>
</div>

<div
    data-floating-comment-composer
    x-data="{
        visible: false,
        expanded: false,
        anonymous: false,
        displayName: @js($displayName),
        email: @js($commentEmail),
        commentText: '',
        commentLength: 0,
        turnstilePassed: false,
        quickWidgetId: null,
        renderQuickTurnstile() {
            const renderWidget = () => {
                if (!this.expanded || this.quickWidgetId !== null) return;
                if (!window.turnstile) {
                    window.setTimeout(renderWidget, 100);
                    return;
                }

                this.quickWidgetId = window.turnstile.render(this.$refs.quickTurnstile, {
                    sitekey: @js(config('services.turnstile.site_key')),
                    action: 'comment',
                    theme: 'light',
                    size: 'flexible',
                    callback: window.quickCommentTurnstileSuccess,
                    'expired-callback': window.quickCommentTurnstileExpired,
                    'error-callback': window.quickCommentTurnstileExpired
                });
            };

            window.setTimeout(renderWidget, 0);
        },
        openQuickComposer() {
            this.expanded = true;
            this.renderQuickTurnstile();
        }
    }"
    x-init="
        const section = $el.closest('#comments');
        const composer = section?.querySelector('[data-main-comment-composer]');
        const updateVisibility = () => {
            if (!section || !composer) return;
            visible = composer.getBoundingClientRect().bottom < 80 && section.getBoundingClientRect().bottom > 100;
        };
        updateVisibility();
        window.addEventListener('scroll', updateVisibility, { passive: true });
        window.addEventListener('resize', updateVisibility);
        $cleanup(() => {
            window.removeEventListener('scroll', updateVisibility);
            window.removeEventListener('resize', updateVisibility);
        });
    "
    x-on:quick-comment-turnstile-success.window="turnstilePassed = true"
    x-on:quick-comment-turnstile-expired.window="turnstilePassed = false"
    x-on:comment-submitted.window="if ($event.detail.quick) { turnstilePassed = false; quickWidgetId = null; expanded = false }"
    x-on:comment-editor-updated="commentText = $event.detail.html; commentLength = $event.detail.textLength"
    x-on:click.outside="if (expanded) expanded = false"
    x-on:keydown.escape.window="if (expanded) expanded = false"
    x-show="visible"
    x-cloak
    x-transition.opacity.duration.200ms
    class="fixed inset-x-0 bottom-0 z-[70] border-t border-[#d6dfdd]/70 bg-white/95 px-2 py-2 shadow-[0_-8px_24px_rgba(28,54,51,0.08)] backdrop-blur-md sm:px-4 sm:py-3"
>
    <button
        type="button"
        x-show="!expanded"
        x-on:click="openQuickComposer()"
        class="mx-auto flex w-full max-w-[680px] items-center gap-2.5 text-left sm:gap-3"
        aria-label="{{ $locale === 'en' ? 'Open comment form' : 'Buka form komentar' }}"
    >
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-sm font-black text-white sm:h-12 sm:w-12 sm:text-base" x-text="displayName.trim().charAt(0).toUpperCase() || 'A'"></span>
        <span class="flex-1 border border-[#d6dfdd] bg-[#f7f7f7] px-4 py-3 text-sm text-[#9a9289] hover:border-[#376A64] sm:text-base">{{ $locale === 'en' ? 'Write a comment' : 'Tulis komentar' }}</span>
    </button>

    <form
        method="POST"
        action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}"
        data-comment-ajax-form
        data-quick-comment-form
        x-bind:aria-hidden="expanded ? 'false' : 'true'"
        x-bind:inert="!expanded"
        x-bind:class="expanded
            ? 'max-h-[72dvh] translate-y-0 opacity-100 sm:max-h-[76vh]'
            : 'pointer-events-none max-h-0 translate-y-3 opacity-0'"
        class="mx-auto w-full max-w-[680px] overflow-y-auto overscroll-contain px-1 transition-[max-height,opacity,transform] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] sm:px-0 motion-reduce:transition-none"
    >
        @csrf

        <div class="flex items-start gap-2.5 sm:gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-sm font-black text-white sm:h-12 sm:w-12 sm:text-base" x-text="anonymous ? '?' : (displayName.trim().charAt(0).toUpperCase() || 'A')"></span>
            <div class="min-w-0 flex-1">
                <div class="space-y-2">
                    <div>
                        <label class="sr-only">{{ $locale === 'en' ? 'Name' : 'Nama' }} *</label>
                        <input name="display_name" type="text" minlength="2" maxlength="60" required autocomplete="name" x-model="displayName" placeholder="{{ $locale === 'en' ? 'Name *' : 'Nama *' }}" class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-2.5 text-base font-medium text-[#1a1a1a] outline-none placeholder:text-[#9f9890] focus:border-[#376A64] focus:ring-0 sm:text-lg">
                    </div>

                    <label class="flex cursor-pointer items-center gap-1.5 text-[10px] text-[#6f665c] sm:text-[11px]">
                        <input type="checkbox" name="anonymous" value="1" x-model="anonymous" class="h-3.5 w-3.5 border-[#9aa9a6] text-[#376A64] focus:ring-[#376A64]">
                        <span>{{ $locale === 'en' ? 'Post as Anonymous' : 'Tampilkan sebagai Anonymous' }}</span>
                    </label>

                    <div>
                        <label class="sr-only">Email *</label>
                        <input name="email" type="email" maxlength="255" required autocomplete="email" x-model="email" placeholder="Email *" class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-2.5 text-[15px] text-[#1a1a1a] outline-none placeholder:text-[#9f9890] focus:border-[#376A64] focus:ring-0 sm:text-base">
                        <p class="mt-1 text-[9px] text-[#7a6e60] sm:text-[10px]">{{ $locale === 'en' ? 'Required and never shown publicly.' : 'Wajib diisi dan tidak ditampilkan ke publik.' }}</p>
                    </div>
                </div>

                <div
                    x-ref="quickEditor"
                    data-expanded="true"
                    data-tiptap-wrapper
                    class="comment-tiptap-editor quick-comment-editor mt-3 overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7] focus-within:border-[#376A64]"
                >
                    <input type="hidden" name="comment" x-model="commentText" data-tiptap-input>
                    <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'What do you think?' : 'Tulis komentar' }}"></div>
                    <div class="flex items-center justify-between border-t border-[#dedede] bg-white/60 px-3 py-2 sm:px-4">
                        @include('frontends.partials.comment-editor-toolbar')
                        <span data-tiptap-character-count class="text-[10px] tabular-nums text-[#9a9289]">0/2000</span>
                    </div>
                </div>

                <div>
                    <div x-show="!turnstilePassed" class="mt-2 border border-[#e3e0dc] bg-[#fafafa] px-3 py-3 sm:px-4">
                        <p class="mb-2 text-[9px] font-black uppercase tracking-[0.14em] text-[#7a7167]">{{ $locale === 'en' ? 'Security verification' : 'Verifikasi keamanan' }}</p>
                        <div x-ref="quickTurnstile" data-quick-turnstile></div>
                    </div>
                    <p data-comment-feedback class="mt-3 hidden text-xs font-semibold" role="status" aria-live="polite"></p>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" x-bind:disabled="!turnstilePassed || commentLength < 2 || commentLength > 2000" class="bg-[#376A64] px-6 py-2.5 text-[9px] font-black uppercase tracking-[0.14em] text-white hover:bg-[#2d5954] disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Submit' : 'Kirim' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<section id="comments" class="mt-20 scroll-mt-28 border-t border-[#e2d8cc] pt-12" aria-labelledby="comments-title">
    <div class="flex items-end justify-between gap-5">
        <div>
            <p class="text-[11px] font-black uppercase tracking-[0.24em] text-[#376A64]">{{ $locale === 'en' ? 'Discussion' : 'Diskusi' }}</p>
            <h2 id="comments-title" class="mt-3 text-4xl font-black tracking-[-0.045em] sm:text-5xl">{{ $locale === 'en' ? 'Comments' : 'Komentar' }}</h2>
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
        $commentUser = session('comment_user');
        $googleLoginReady = filled(config('services.google.client_id')) && filled(config('services.google.client_secret'));
        $displayName = old('display_name', session('comment_display_name', $commentUser['name'] ?? ''));
        $commentLoginUrl = route('comments.login.google', ['return_to' => url()->current().'#comments']);
    @endphp
    @if ($commentUser)
        <div
            class="mt-12"
            data-main-comment-composer
            x-data="{
                expanded: {{ old('comment') || $errors->has('comment') || $errors->has('cf-turnstile-response') ? 'true' : 'false' }},
                anonymous: {{ old('anonymous') ? 'true' : 'false' }},
                displayName: @js($displayName),
                commentText: @js(old('comment', '')),
                commentLength: 0,
                turnstilePassed: false,
                collapseComment() {
                    this.expanded = false;
                    this.$refs.editorWrapper?.tiptapEditor?.commands.blur();
                },
                cancelComment() {
                    this.commentText = '';
                    this.commentLength = 0;
                    if (this.$refs.editorWrapper?.tiptapEditor) {
                        this.$refs.editorWrapper.tiptapEditor.commands.clearContent();
                    }
                    this.expanded = false;
                    this.turnstilePassed = false;
                    if (window.turnstile) window.turnstile.reset();
                }
            }"
            x-on:comment-turnstile-success.window="turnstilePassed = true"
            x-on:comment-turnstile-expired.window="turnstilePassed = false"
            x-on:comment-editor-updated="commentText = $event.detail.html; commentLength = $event.detail.textLength"
            x-on:comment-submitted.window="if (! $event.detail?.quick) cancelComment()"
            x-on:click.outside="if (expanded) collapseComment()"
            x-on:keydown.escape.window="if (expanded) collapseComment()"
        >
            <form method="POST" data-comment-ajax-form action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}">
                @csrf

                <div class="flex items-center gap-4 sm:gap-6">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-xl font-bold text-white sm:h-16 sm:w-16" x-text="anonymous ? '?' : (displayName.trim().charAt(0).toUpperCase() || 'A')"></span>
                    <div class="min-w-0 flex-1">
                        <label for="display_name" class="sr-only">{{ $locale === 'en' ? 'Display name' : 'Nama tampilan' }}</label>
                        <input id="display_name" name="display_name" type="text" maxlength="60" x-model="displayName" :disabled="anonymous" value="{{ $displayName }}" placeholder="{{ $locale === 'en' ? 'Your name' : 'Nama Anda' }}" class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-2 py-3 text-xl font-medium text-[#1a1a1a] outline-none placeholder:text-[#b8b2aa] focus:border-[#376A64] focus:ring-0 disabled:cursor-not-allowed disabled:opacity-40 sm:text-2xl">
                        @error('display_name')<p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap items-center justify-between gap-4 pl-[4.5rem] sm:pl-[5.5rem]">
                    <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-[#6f665c]">
                        <input type="checkbox" name="anonymous" value="1" x-model="anonymous" class="h-4 w-4 border-[#9aa9a6] text-[#376A64] focus:ring-[#376A64]">
                        <span>{{ $locale === 'en' ? 'Post as Anonymous' : 'Tampilkan sebagai Anonymous' }}</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <span class="hidden text-xs text-[#8a8177] sm:inline">{{ $locale === 'en' ? 'Verified with Google' : 'Terverifikasi dengan Google' }}</span>
                        <button form="comment-logout-form" type="submit" class="text-[10px] font-black uppercase tracking-[0.14em] text-[#bc4a3c] hover:underline">{{ $locale === 'en' ? 'Sign out' : 'Keluar' }}</button>
                    </div>
                </div>

                <label for="comment" class="sr-only">{{ $locale === 'en' ? 'Write a comment' : 'Tulis komentar' }}</label>
                <div
                    x-ref="editorWrapper"
                    x-on:focusin="expanded = true"
                    x-bind:data-expanded="expanded ? 'true' : 'false'"
                    data-tiptap-wrapper
                    class="comment-tiptap-editor mt-7 overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7] transition-colors focus-within:border-[#376A64]"
                >
                    <input id="comment" type="hidden" name="comment" x-model="commentText" value="{{ old('comment') }}" data-tiptap-input>
                    <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'What do you think?' : 'Apa pendapat Anda?' }}"></div>

                    <div x-show="expanded" x-transition.opacity.duration.200ms class="flex items-center justify-between border-t border-[#dedede] bg-white/60 px-4 py-2.5 sm:px-5">
                        <div class="flex items-center gap-1 text-[#665f56]">
                            <button type="button" data-tiptap-command="bold" data-tiptap-active="bold" class="flex h-8 w-8 items-center justify-center text-base font-black transition hover:bg-[#e5efed] hover:text-[#376A64]" title="Bold" aria-label="Bold">B</button>
                            <button type="button" data-tiptap-command="italic" data-tiptap-active="italic" class="flex h-8 w-8 items-center justify-center font-serif text-lg italic transition hover:bg-[#e5efed] hover:text-[#376A64]" title="Italic" aria-label="Italic">i</button>
                            <button type="button" data-tiptap-command="link" data-tiptap-active="link" class="flex h-8 w-8 items-center justify-center text-lg transition hover:bg-[#e5efed] hover:text-[#376A64]" title="Link" aria-label="Link">↗</button>
                            <button type="button" data-tiptap-command="bulletList" data-tiptap-active="bulletList" class="flex h-8 w-8 items-center justify-center transition hover:bg-[#e5efed] hover:text-[#376A64]" title="Bullet list" aria-label="Bullet list">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="3" cy="5" r="1" fill="currentColor" stroke="none"/><circle cx="3" cy="10" r="1" fill="currentColor" stroke="none"/><circle cx="3" cy="15" r="1" fill="currentColor" stroke="none"/><path d="M7 5h10M7 10h10M7 15h10"/></svg>
                            </button>
                            <button type="button" data-tiptap-command="orderedList" data-tiptap-active="orderedList" class="flex h-8 w-8 items-center justify-center transition hover:bg-[#e5efed] hover:text-[#376A64]" title="Numbered list" aria-label="Numbered list">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M2 4h2v4M2 8h3M2 12c.5-.7 2.8-.7 2.8.5 0 1-2.8 2-2.8 3.5h3M8 5h9M8 10h9M8 15h9"/></svg>
                            </button>
                        </div>
                        <span data-tiptap-character-count class="text-[10px] tabular-nums text-[#9a9289]">0/2000</span>
                    </div>
                </div>
                @error('comment')<p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror

                <div x-show="expanded" x-transition.opacity.duration.200ms>
                    <div x-show="!turnstilePassed" x-transition.opacity.duration.200ms class="mt-3 border border-[#e3e0dc] bg-[#fafafa] px-4 py-5 sm:px-5">
                        <p class="mb-4 text-[10px] font-black uppercase tracking-[0.14em] text-[#7a7167]">{{ $locale === 'en' ? 'Security verification' : 'Verifikasi keamanan' }}</p>
                        <div
                            class="cf-turnstile"
                            data-sitekey="{{ config('services.turnstile.site_key') }}"
                            data-theme="light"
                            data-size="flexible"
                            data-callback="commentTurnstileSuccess"
                            data-expired-callback="commentTurnstileExpired"
                            data-error-callback="commentTurnstileExpired"
                        ></div>
                        @error('cf-turnstile-response')<p class="mt-3 text-xs font-semibold text-red-700">{{ $message }}</p>@enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end gap-3">
                        <div class="flex items-center gap-3">
                            <button type="button" x-on:click="cancelComment()" class="px-4 py-2.5 text-xs font-bold text-[#3f3a35] transition hover:bg-[#f1efec]">{{ $locale === 'en' ? 'Cancel' : 'Batal' }}</button>
                            <button type="submit" x-bind:disabled="!turnstilePassed || commentLength < 2 || commentLength > 2000" class="shrink-0 bg-[#376A64] px-6 py-3 text-[10px] font-black uppercase tracking-[0.14em] text-white transition hover:bg-[#2d5954] disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Submit' : 'Kirim' }}</button>
                        </div>
                    </div>

                    <p class="mt-4 text-xs leading-5 text-[#7a6e60] sm:text-sm">{{ $locale === 'en' ? 'Comments are shown after moderation.' : 'Komentar akan tampil setelah disetujui admin.' }}</p>
                </div>
            </form>

            <form id="comment-logout-form" method="POST" action="{{ route('comments.logout') }}" class="hidden">
                @csrf
            </form>
        </div>
    @else
        @if ($googleLoginReady)
            <div
                data-main-comment-composer
                class="mt-12 border border-[#e2d8cc] bg-[#f8f6f2] px-6 py-10 text-center sm:px-10"
            >
                <p class="text-sm leading-6 text-[#766d63] sm:text-base">
                    {{ $locale === 'en' ? 'Sign in to join the discussion. Your login is used only for comments.' : 'Masuk untuk ikut berdiskusi. Login hanya digunakan untuk komentar.' }}
                </p>
                <a href="{{ $commentLoginUrl }}" class="mt-6 inline-flex items-center gap-3 bg-white px-6 py-3.5 text-xs font-bold text-[#1a1a1a] shadow-sm ring-1 ring-[#d8cec2] transition-colors hover:bg-gray-50 sm:text-sm">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285F4" d="M21.6 12.23c0-.71-.06-1.4-.18-2.07H12v3.92h5.38a4.6 4.6 0 0 1-2 3.02v2.54h3.24c1.9-1.75 2.98-4.33 2.98-7.41Z"/>
                        <path fill="#34A853" d="M12 22c2.7 0 4.97-.9 6.62-2.36l-3.24-2.54c-.9.6-2.05.96-3.38.96-2.61 0-4.82-1.76-5.61-4.13H3.04v2.62A10 10 0 0 0 12 22Z"/>
                        <path fill="#FBBC05" d="M6.39 13.93A6.02 6.02 0 0 1 6.08 12c0-.67.11-1.32.31-1.93V7.45H3.04A10 10 0 0 0 2 12c0 1.61.38 3.14 1.04 4.55l3.35-2.62Z"/>
                        <path fill="#EA4335" d="M12 5.94c1.47 0 2.79.5 3.82 1.49l2.87-2.87A9.62 9.62 0 0 0 12 2a10 10 0 0 0-8.96 5.45l3.35 2.62C7.18 7.7 9.39 5.94 12 5.94Z"/>
                    </svg>
                    {{ $locale === 'en' ? 'Continue with Google' : 'Lanjutkan dengan Google' }}
                </a>
            </div>
        @else
            <div data-main-comment-composer class="mt-7 border border-[#e2d8cc] bg-[#f8f6f2] p-6">
                <p class="mt-4 border-l-4 border-amber-500 bg-amber-50 px-4 py-3 text-left text-xs font-semibold leading-5 text-amber-900">
                    {{ $locale === 'en' ? 'Google sign-in has not been configured by the administrator.' : 'Login Google belum dikonfigurasi oleh administrator.' }}
                </p>
            </div>
        @endif
    @endif

    @if ($commentUser)
    <div
        data-floating-comment-composer
        x-data="{
            visible: false,
            expanded: false,
            anonymous: false,
            displayName: @js($displayName),
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
                        theme: 'light',
                        size: 'flexible',
                        callback: window.quickCommentTurnstileSuccess,
                        'expired-callback': window.quickCommentTurnstileExpired,
                        'error-callback': window.quickCommentTurnstileExpired
                    });
                };

                window.setTimeout(renderWidget, 0);
            }
        }"
        x-init="
            const section = $el.closest('#comments');
            const composer = section?.querySelector('[data-main-comment-composer]');
            const updateVisibility = () => {
                if (!section || !composer) return;
                const sectionRect = section.getBoundingClientRect();
                const composerRect = composer.getBoundingClientRect();
                visible = composerRect.bottom < 80 && sectionRect.bottom > 100;
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
        x-on:comment-editor-updated="commentText = $event.detail.html; commentLength = $event.detail.textLength"
        x-on:comment-submitted.window="
            if ($event.detail?.quick) {
                commentText = '';
                commentLength = 0;
                expanded = false;
                turnstilePassed = false;
                if (window.turnstile && quickWidgetId !== null) window.turnstile.reset(quickWidgetId);
            }
        "
        x-on:click.outside="if (expanded) expanded = false"
        x-on:keydown.escape.window="if (expanded) expanded = false"
        x-show="visible"
        x-cloak
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-x-0 bottom-0 z-[70] border-t border-[#d6dfdd]/70 bg-white/95 p-3 shadow-[0_-8px_24px_rgba(28,54,51,0.08)] backdrop-blur-md sm:p-4"
    >
        <form
            method="POST"
            action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}"
            data-comment-ajax-form
            data-quick-comment-form
            x-bind:class="expanded ? 'max-h-[70vh]' : 'max-h-[4.5rem]'"
            class="mx-auto max-w-[760px] overflow-y-auto overscroll-contain transition-[max-height] duration-300 ease-out"
        >
            @csrf

            <div class="flex items-start gap-3 sm:gap-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-sm font-black text-white sm:h-11 sm:w-11" x-text="anonymous ? '?' : (displayName.trim().charAt(0).toUpperCase() || 'A')"></span>
                <div class="min-w-0 flex-1">
                    <div x-show="expanded" x-transition.opacity.duration.150ms class="mb-3 flex flex-wrap items-center justify-between gap-3">
                        <label class="min-w-[180px] flex-1">
                            <span class="sr-only">{{ $locale === 'en' ? 'Display name' : 'Nama tampilan' }}</span>
                            <input
                                name="display_name"
                                type="text"
                                maxlength="60"
                                x-model="displayName"
                                x-bind:disabled="anonymous"
                                placeholder="{{ $locale === 'en' ? 'Your name' : 'Nama Anda' }}"
                                class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-2 text-base font-semibold text-[#1a1a1a] outline-none focus:border-[#376A64] focus:ring-0 disabled:opacity-40"
                            >
                        </label>
                        <span class="text-[10px] font-bold uppercase tracking-[0.1em] text-[#8a8177]">{{ $locale === 'en' ? 'Verified with Google' : 'Terverifikasi dengan Google' }}</span>
                    </div>

                    <label x-show="expanded" x-transition.opacity.duration.150ms class="mb-3 inline-flex cursor-pointer items-center gap-2 text-xs text-[#6f665c]">
                        <input type="checkbox" name="anonymous" value="1" x-model="anonymous" class="h-4 w-4 border-[#9aa9a6] text-[#376A64] focus:ring-[#376A64]">
                        <span>{{ $locale === 'en' ? 'Post as Anonymous' : 'Tampilkan sebagai Anonymous' }}</span>
                    </label>

                    <div
                        x-on:focusin="expanded = true; renderQuickTurnstile()"
                        x-bind:data-expanded="expanded ? 'true' : 'false'"
                        data-tiptap-wrapper
                        class="comment-tiptap-editor quick-comment-editor overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7] transition-colors focus-within:border-[#376A64]"
                    >
                        <input type="hidden" name="comment" x-model="commentText" data-tiptap-input>
                        <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'What do you think?' : 'Apa pendapat Anda?' }}"></div>

                        <div x-show="expanded" x-transition.opacity.duration.150ms class="flex items-center justify-between border-t border-[#dedede] bg-white/70 px-3 py-2 sm:px-4">
                            <div class="flex items-center gap-1 text-[#665f56]">
                                <button type="button" data-tiptap-command="bold" data-tiptap-active="bold" class="flex h-8 w-8 items-center justify-center text-base font-black hover:bg-[#e5efed] hover:text-[#376A64]" title="Bold" aria-label="Bold">B</button>
                                <button type="button" data-tiptap-command="italic" data-tiptap-active="italic" class="flex h-8 w-8 items-center justify-center font-serif text-lg italic hover:bg-[#e5efed] hover:text-[#376A64]" title="Italic" aria-label="Italic">i</button>
                                <button type="button" data-tiptap-command="link" data-tiptap-active="link" class="flex h-8 w-8 items-center justify-center text-lg hover:bg-[#e5efed] hover:text-[#376A64]" title="Link" aria-label="Link">↗</button>
                                <button type="button" data-tiptap-command="bulletList" data-tiptap-active="bulletList" class="flex h-8 w-8 items-center justify-center hover:bg-[#e5efed] hover:text-[#376A64]" title="Bullet list" aria-label="Bullet list">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="3" cy="5" r="1" fill="currentColor" stroke="none"/><circle cx="3" cy="10" r="1" fill="currentColor" stroke="none"/><circle cx="3" cy="15" r="1" fill="currentColor" stroke="none"/><path d="M7 5h10M7 10h10M7 15h10"/></svg>
                                </button>
                                <button type="button" data-tiptap-command="orderedList" data-tiptap-active="orderedList" class="flex h-8 w-8 items-center justify-center hover:bg-[#e5efed] hover:text-[#376A64]" title="Numbered list" aria-label="Numbered list">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M2 4h2v4M2 8h3M2 12c.5-.7 2.8-.7 2.8.5 0 1-2.8 2-2.8 3.5h3M8 5h9M8 10h9M8 15h9"/></svg>
                                </button>
                            </div>
                            <span data-tiptap-character-count class="text-[10px] tabular-nums text-[#9a9289]">0/2000</span>
                        </div>
                    </div>

                    <div x-show="expanded" x-transition.opacity.duration.150ms>
                        <div x-show="!turnstilePassed" x-transition.opacity.duration.150ms class="mt-3 border border-[#e3e0dc] bg-[#fafafa] p-3">
                            <div
                                x-ref="quickTurnstile"
                                data-quick-turnstile
                            ></div>
                        </div>

                        <p data-comment-feedback class="mt-3 hidden text-xs font-semibold" role="status" aria-live="polite"></p>

                        <div class="mt-3 flex items-center justify-end gap-3">
                            <button type="submit" x-bind:disabled="!turnstilePassed || commentLength < 2 || commentLength > 2000" class="bg-[#376A64] px-6 py-3 text-[10px] font-black uppercase tracking-[0.14em] text-white hover:bg-[#2d5954] disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Submit' : 'Kirim' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @elseif ($googleLoginReady)
        <div
            data-floating-comment-composer
            x-data="{ visible: false, expanded: false }"
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
            x-on:keydown.escape.window="expanded = false"
            x-show="visible"
            x-cloak
            x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-x-0 bottom-0 z-[70] border-t border-[#d6dfdd]/70 bg-white/95 p-3 shadow-[0_-8px_24px_rgba(28,54,51,0.08)] backdrop-blur-md sm:p-4"
        >
            <div x-on:click.outside="expanded = false" class="mx-auto max-w-[760px]">
                <button
                    x-show="!expanded"
                    type="button"
                    x-on:click="expanded = true"
                    class="flex w-full items-center gap-3 text-left"
                    aria-label="{{ $locale === 'en' ? 'Open sign-in options' : 'Buka pilihan login' }}"
                >
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#376A64] font-black text-white">?</span>
                    <span class="flex-1 border border-[#d6dfdd] bg-[#f7f7f7] px-4 py-3 text-sm text-[#9a9289] transition-colors hover:border-[#376A64]">{{ $locale === 'en' ? 'What do you think?' : 'Apa pendapat Anda?' }}</span>
                </button>

                <div
                    x-show="expanded"
                    x-cloak
                    x-transition.opacity.duration.150ms
                    class="border border-[#e2d8cc] bg-[#f8f6f2] px-6 py-7 text-center sm:px-10"
                >
                    <p class="text-sm leading-6 text-[#6f665c] sm:text-base">
                        {{ $locale === 'en' ? 'Sign in to join the discussion. Your login is used only for comments.' : 'Masuk untuk ikut berdiskusi. Login hanya digunakan untuk komentar.' }}
                    </p>
                    <a href="{{ $commentLoginUrl }}" class="mt-5 inline-flex items-center gap-3 bg-white px-6 py-3.5 text-xs font-bold shadow-sm ring-1 ring-[#d8cec2] transition-colors hover:bg-gray-50 sm:text-sm">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true"><path fill="#4285F4" d="M21.6 12.2c0-.7-.1-1.5-.2-2.2H12v4.3h5.4a4.6 4.6 0 0 1-2 3v2.8h3.5c2-1.9 3.2-4.6 3.2-7.9z"/><path fill="#34A853" d="M12 22c2.9 0 5.3-.9 7-2.6l-3.5-2.8a6.4 6.4 0 0 1-9.6-3.4H2.3V16A10 10 0 0 0 12 22z"/><path fill="#FBBC05" d="M5.9 13.2A6 6 0 0 1 5.6 12c0-.4.1-.8.2-1.2V8H2.3A10 10 0 0 0 2 12c0 1.4.3 2.8.8 4z"/><path fill="#EA4335" d="M12 5.6c1.6 0 3 .5 4.1 1.6l3.1-3A10 10 0 0 0 2.3 8l3.6 2.8A6 6 0 0 1 12 5.6z"/></svg>
                        {{ $locale === 'en' ? 'Continue with Google' : 'Lanjutkan dengan Google' }}
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if (! $commentsAvailable)
        <p class="mt-8 border-l-4 border-amber-500 bg-amber-50 px-4 py-3 text-sm text-amber-900">{{ $locale === 'en' ? 'Comments are temporarily unavailable.' : 'Komentar sedang tidak dapat dimuat.' }}</p>
    @elseif ($comments->isEmpty())
        <p class="mt-10 text-sm text-[#7a6e60]">{{ $locale === 'en' ? 'No comments yet.' : 'Belum ada komentar.' }}</p>
    @else
        @php
            $mainComments = $comments->whereNull('parent_id')->values();
        @endphp
        <div
            class="mt-12"
            x-data="{ visibleMainComments: 5, totalMainComments: {{ $mainComments->count() }} }"
        >
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
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush
@endonce

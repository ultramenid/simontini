<div id="comment-reply-form-{{ $comment->id }}" data-comment-reply-panel="{{ $comment->id }}" class="mt-6 hidden sm:ml-12">
    <form method="POST" data-comment-ajax-form action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

        <div class="flex items-center gap-4 sm:gap-6">
            <span
                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-xl font-bold text-white sm:h-16 sm:w-16"
                x-text="replyAnonymous ? '?' : (replyDisplayName.trim().charAt(0).toUpperCase() || 'A')"
            ></span>
            <div class="min-w-0 flex-1">
                <label for="reply-display-name-{{ $comment->id }}" class="sr-only">{{ $locale === 'en' ? 'Display name' : 'Nama tampilan' }}</label>
                <input
                    id="reply-display-name-{{ $comment->id }}"
                    name="display_name"
                    type="text"
                    maxlength="60"
                    required
                    x-model="replyDisplayName"
                    x-bind:disabled="replyAnonymous"
                    placeholder="{{ $locale === 'en' ? 'Your name' : 'Nama Anda' }}"
                    class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-2 py-3 text-xl font-medium text-[#1a1a1a] outline-none placeholder:text-[#b8b2aa] focus:border-[#376A64] focus:ring-0 disabled:cursor-not-allowed disabled:opacity-40 sm:text-2xl"
                >
            </div>
        </div>

        <div class="mt-4 flex flex-wrap items-center justify-between gap-4 pl-[4.5rem] sm:pl-[5.5rem]">
            <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-[#6f665c]">
                <input type="checkbox" name="anonymous" value="1" x-model="replyAnonymous" class="h-4 w-4 border-[#9aa9a6] text-[#376A64] focus:ring-[#376A64]">
                <span>{{ $locale === 'en' ? 'Post as Anonymous' : 'Tampilkan sebagai Anonymous' }}</span>
            </label>
            <div class="flex items-center gap-3">
                <span class="hidden text-xs text-[#8a8177] sm:inline">{{ $locale === 'en' ? 'Verified with Google' : 'Terverifikasi dengan Google' }}</span>
                <button form="comment-logout-form" type="submit" class="text-[10px] font-black uppercase tracking-[0.14em] text-[#bc4a3c] hover:underline">{{ $locale === 'en' ? 'Sign out' : 'Keluar' }}</button>
            </div>
        </div>

        <div data-tiptap-wrapper class="comment-tiptap-editor comment-reply-editor mt-7 overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7] transition-colors focus-within:border-[#376A64]" data-expanded="true">
            <input type="hidden" name="comment" data-tiptap-input>
            <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'What do you think?' : 'Apa pendapat Anda?' }}"></div>
            <div class="flex items-center justify-between border-t border-[#dedede] bg-white/60 px-4 py-2.5 sm:px-5">
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

        <div x-show="!replyVerified" class="mt-3 border border-[#e3e0dc] bg-[#fafafa] px-4 py-5 sm:px-5">
            <p class="mb-4 text-[10px] font-black uppercase tracking-[0.14em] text-[#7a7167]">{{ $locale === 'en' ? 'Security verification' : 'Verifikasi keamanan' }}</p>
            <div
                class="cf-turnstile"
                data-sitekey="{{ config('services.turnstile.site_key') }}"
                data-size="flexible"
                data-callback="commentReplyTurnstileSuccess{{ $comment->id }}"
                data-expired-callback="commentReplyTurnstileExpired{{ $comment->id }}"
                data-error-callback="commentReplyTurnstileExpired{{ $comment->id }}"
            ></div>
        </div>

        <div class="mt-4 flex justify-end gap-3">
            <button type="button" data-comment-reply-close="{{ $comment->id }}" class="px-4 py-2.5 text-xs font-bold text-[#3f3a35] transition hover:bg-[#f1efec]">{{ $locale === 'en' ? 'Cancel' : 'Batal' }}</button>
            <button type="submit" x-bind:disabled="!replyVerified" class="bg-[#376A64] px-6 py-3 text-[10px] font-black uppercase tracking-[0.14em] text-white transition hover:bg-[#2d5954] disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Reply' : 'Balas' }}</button>
        </div>

        <p class="mt-4 text-xs leading-5 text-[#7a6e60] sm:text-sm">{{ $locale === 'en' ? 'Your reply will appear immediately after submission.' : 'Balasan akan langsung tampil setelah dikirim.' }}</p>
    </form>
</div>

@push('scripts')
    <script>
        window.commentReplyTurnstileSuccess{{ $comment->id }} = function () {
            window.dispatchEvent(new CustomEvent('reply-turnstile-success', { detail: { id: {{ $comment->id }} } }));
        };
        window.commentReplyTurnstileExpired{{ $comment->id }} = function () {
            window.dispatchEvent(new CustomEvent('reply-turnstile-expired', { detail: { id: {{ $comment->id }} } }));
        };
    </script>
@endpush

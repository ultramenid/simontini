<div id="comment-reply-form-{{ $comment->id }}" data-comment-reply-panel="{{ $comment->id }}" class="mt-5 hidden sm:ml-12">
    <form method="POST" data-comment-ajax-form action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

        <div class="mb-4 flex items-center gap-3">
            <span
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-sm font-black text-white"
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
                    class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-2 py-2 text-base font-semibold text-[#1a1a1a] outline-none placeholder:font-normal placeholder:text-[#b8b2aa] focus:border-[#376A64] focus:ring-0 disabled:cursor-not-allowed disabled:opacity-40"
                >
            </div>
        </div>

        <div data-tiptap-wrapper class="comment-tiptap-editor comment-reply-editor overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7]" data-expanded="true">
            <input type="hidden" name="comment" data-tiptap-input>
            <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'Write a reply…' : 'Tulis balasan…' }}"></div>
            <div class="flex items-center gap-1 border-t border-[#dedede] bg-white/60 px-3 py-2 text-[#665f56]">
                <button type="button" data-tiptap-command="bold" data-tiptap-active="bold" class="flex h-8 w-8 items-center justify-center font-black hover:bg-[#e5efed]">B</button>
                <button type="button" data-tiptap-command="italic" data-tiptap-active="italic" class="flex h-8 w-8 items-center justify-center font-serif text-lg italic hover:bg-[#e5efed]">i</button>
                <button type="button" data-tiptap-command="link" data-tiptap-active="link" class="flex h-8 w-8 items-center justify-center text-lg hover:bg-[#e5efed]">↗</button>
                <button type="button" data-tiptap-command="bulletList" data-tiptap-active="bulletList" class="flex h-8 w-8 items-center justify-center text-xs font-bold hover:bg-[#e5efed]">•≡</button>
                <button type="button" data-tiptap-command="orderedList" data-tiptap-active="orderedList" class="flex h-8 w-8 items-center justify-center text-xs font-bold hover:bg-[#e5efed]">1.</button>
            </div>
        </div>

        <label class="mt-3 inline-flex cursor-pointer items-center gap-2 text-xs text-[#6f665c]">
            <input type="checkbox" name="anonymous" value="1" x-model="replyAnonymous" class="h-4 w-4 border-[#9aa9a6] text-[#376A64] focus:ring-[#376A64]">
            <span>{{ $locale === 'en' ? 'Reply as Anonymous' : 'Balas sebagai Anonymous' }}</span>
        </label>

        <div x-show="!replyVerified" class="mt-4">
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
            <button type="button" data-comment-reply-close="{{ $comment->id }}" class="px-4 py-2.5 text-xs font-bold">{{ $locale === 'en' ? 'Cancel' : 'Batal' }}</button>
            <button type="submit" x-bind:disabled="!replyVerified" class="bg-[#376A64] px-5 py-2.5 text-[10px] font-black uppercase tracking-[0.14em] text-white disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Reply' : 'Balas' }}</button>
        </div>
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

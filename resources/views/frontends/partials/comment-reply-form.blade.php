<div id="comment-reply-form-{{ $comment->id }}" data-comment-reply-panel="{{ $comment->id }}" class="mt-5 hidden sm:ml-10">
    <form method="POST" data-comment-ajax-form action="{{ route('deforestation.comments.store', ['locale' => $locale, 'id' => $story->id]) }}">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

        <div class="flex items-center gap-3 sm:gap-4">
            <span
                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#376A64] text-lg font-bold text-white sm:h-14 sm:w-14 sm:text-xl"
                x-text="replyDisplayName.trim().charAt(0).toUpperCase() || 'A'"
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
                    placeholder="{{ $locale === 'en' ? 'Name *' : 'Nama *' }}"
                    class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-3 text-lg font-medium text-[#1a1a1a] outline-none placeholder:text-[#9f9890] focus:border-[#376A64] focus:ring-0 sm:text-xl"
                >
            </div>
        </div>

        <div class="mt-3 pl-[3.75rem] sm:pl-[4.5rem]">
            <label class="mb-2.5 flex cursor-pointer items-center gap-2 text-xs text-[#665f56] sm:text-[13px]">
                <input type="checkbox" name="anonymous" value="1" x-model="replyAnonymous" class="h-4 w-4 border-[#8b8379] text-[#376A64] focus:ring-[#376A64]">
                <span>{{ $locale === 'en' ? 'Post as Anonymous' : 'Tampilkan sebagai Anonymous' }}</span>
            </label>
            <label for="reply-email-{{ $comment->id }}" class="sr-only">Email</label>
            <input id="reply-email-{{ $comment->id }}" name="email" type="email" maxlength="255" required autocomplete="email" x-model="replyEmail" placeholder="Email *" class="w-full border-0 border-b border-[#ccd7d4] bg-transparent px-1 py-3 text-base text-[#1a1a1a] outline-none placeholder:text-[#9f9890] focus:border-[#376A64] focus:ring-0 sm:text-lg">
            <p class="mt-1.5 text-[11px] text-[#7a6e60] sm:text-xs">{{ $locale === 'en' ? 'Required. Your email will not be published.' : 'Wajib diisi. Email tidak akan dipublikasikan.' }}</p>
        </div>

        <div data-tiptap-wrapper class="comment-tiptap-editor comment-reply-editor mt-4 overflow-hidden border border-[#d6dfdd] bg-[#f7f7f7] transition-colors focus-within:border-[#376A64]" data-expanded="true">
            <input type="hidden" name="comment" data-tiptap-input>
            <div data-tiptap-content data-placeholder="{{ $locale === 'en' ? 'What do you think?' : 'Apa pendapat Anda?' }}"></div>
            <div class="flex items-center justify-between border-t border-[#dedede] bg-white/60 px-2.5 py-1.5 sm:px-3 sm:py-2">
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

        <div x-show="!replyVerified" class="mt-2 border border-[#e3e0dc] bg-[#fafafa] px-3 py-3 sm:px-4">
            <p class="mb-2 text-[9px] font-black uppercase tracking-[0.14em] text-[#7a7167]">{{ $locale === 'en' ? 'Security verification' : 'Verifikasi keamanan' }}</p>
            <div
                class="cf-turnstile"
                data-comment-turnstile
                data-reply-turnstile-id="{{ $comment->id }}"
                data-sitekey="{{ config('services.turnstile.site_key') }}"
                data-size="flexible"
            ></div>
        </div>

        <div class="mt-3 flex justify-end gap-2">
            <button type="button" data-comment-reply-close="{{ $comment->id }}" class="px-3 py-2 text-[11px] font-bold text-[#3f3a35] transition hover:bg-[#f1efec]">{{ $locale === 'en' ? 'Cancel' : 'Batal' }}</button>
            <button type="submit" x-bind:disabled="!replyVerified" class="bg-[#376A64] px-5 py-2.5 text-[9px] font-black uppercase tracking-[0.14em] text-white transition hover:bg-[#2d5954] disabled:cursor-not-allowed disabled:bg-[#b9cbc8]">{{ $locale === 'en' ? 'Reply' : 'Balas' }}</button>
        </div>

        <p class="mt-3 text-[10px] leading-4 text-[#7a6e60] sm:text-xs">{{ $locale === 'en' ? 'Your reply will appear immediately after submission.' : 'Balasan akan langsung tampil setelah dikirim.' }}</p>
    </form>
</div>

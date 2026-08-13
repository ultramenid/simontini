@php
    $replyReturnUrl = request()->fullUrlWithQuery(['reply_to' => $comment->id]).'#comment-'.$comment->id;
    $replyLoginUrl = route('comments.login.google', ['return_to' => $replyReturnUrl]);
@endphp

<div
    id="comment-reply-login-{{ $comment->id }}"
    data-comment-reply-panel="{{ $comment->id }}"
    class="mt-5 hidden sm:ml-12"
>
    <div class="border border-[#e2d8cc] bg-[#f8f6f2] px-6 py-8 text-center sm:px-10">
        <p class="text-sm leading-6 text-[#766d63] sm:text-base">
            {{ $locale === 'en'
                ? 'Sign in to reply. Your login is used only for comments.'
                : 'Masuk untuk membalas komentar. Login hanya digunakan untuk komentar.' }}
        </p>
        <a href="{{ $replyLoginUrl }}" class="mt-6 inline-flex items-center gap-3 bg-white px-6 py-3.5 text-xs font-bold text-[#1a1a1a] shadow-sm ring-1 ring-[#d8cec2] transition-colors hover:bg-gray-50 sm:text-sm">
            <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="#4285F4" d="M21.6 12.23c0-.71-.06-1.4-.18-2.07H12v3.92h5.38a4.6 4.6 0 0 1-2 3.02v2.54h3.24c1.9-1.75 2.98-4.33 2.98-7.41Z"/>
                <path fill="#34A853" d="M12 22c2.7 0 4.97-.9 6.62-2.36l-3.24-2.54c-.9.6-2.05.96-3.38.96-2.61 0-4.82-1.76-5.61-4.13H3.04v2.62A10 10 0 0 0 12 22Z"/>
                <path fill="#FBBC05" d="M6.39 13.93A6.02 6.02 0 0 1 6.08 12c0-.67.11-1.32.31-1.93V7.45H3.04A10 10 0 0 0 2 12c0 1.61.38 3.14 1.04 4.55l3.35-2.62Z"/>
                <path fill="#EA4335" d="M12 5.94c1.47 0 2.79.5 3.82 1.49l2.87-2.87A9.62 9.62 0 0 0 12 2a10 10 0 0 0-8.96 5.45l3.35 2.62C7.18 7.7 9.39 5.94 12 5.94Z"/>
            </svg>
            {{ $locale === 'en' ? 'Continue with Google' : 'Lanjutkan dengan Google' }}
        </a>
    </div>
</div>

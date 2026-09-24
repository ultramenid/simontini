@props(['title', 'locale' => 'id', 'hideOnLoad' => true])

{{-- Loader seperti halaman STADI, versi putih dengan logo Simontini.
     hideOnLoad=false: tetap tampil sampai halaman berikutnya terbuka (mis. setelah submit password). --}}
<div id="site-loader" class="site-loader--story" role="status" aria-live="polite" aria-label="{{ $locale === 'en' ? 'Loading' : 'Memuat' }} {{ $title }}">
    <div class="loader-mark">
        <img src="{{ asset('assets/logo-simontinus-loader.webp') }}" alt="" width="225" height="48">
        <div class="loader-sub">{{ $title }}</div>
        <div class="loader-bar"><span></span></div>
    </div>
</div>

@if ($hideOnLoad)
    <noscript><style>#site-loader { display: none; }</style></noscript>
    <script>
        (function () {
            var loader = document.getElementById('site-loader');
            document.documentElement.style.overflow = 'hidden';
            var hide = function () {
                document.documentElement.style.overflow = '';
                loader.classList.add('is-hidden');
                loader.setAttribute('aria-hidden', 'true');
                setTimeout(function () { loader.remove(); }, 450);
            };
            // Tunggu seluruh konten (gambar, font, iframe grafik) selesai dimuat.
            if (document.readyState === 'complete') hide();
            else window.addEventListener('load', hide, { once: true });
        })();
    </script>
@endif

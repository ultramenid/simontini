<!doctype html>
<html lang="{{ $locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $locale === 'en' ? 'Subscription Stopped' : 'Langganan Dihentikan' }} · SIMONTINI</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-[#f3f6f5] px-5 font-sans text-[#1a1a1a]">
    <main class="w-full max-w-xl border border-[#d9e1df] bg-white px-8 py-12 text-center sm:px-14">
        <div class="mx-auto flex h-16 w-16 items-center justify-center bg-[#376A64] text-3xl font-bold text-white">✓</div>
        <p class="mt-8 text-xs font-bold uppercase tracking-[0.16em] text-[#376A64]">SIMONTINI</p>
        <h1 class="mt-3 text-3xl font-black uppercase tracking-[-0.03em]">
            {{ $locale === 'en' ? 'Subscription stopped' : 'Langganan dihentikan' }}
        </h1>
        <p class="mx-auto mt-4 max-w-md text-base leading-7 text-[#655f57]">
            {{ $locale === 'en'
                ? 'You will no longer receive email notifications from this subscription.'
                : 'Anda tidak akan menerima lagi notifikasi email dari langganan ini.' }}
        </p>
        <a href="{{ route('deforestation.index', ['locale' => $locale]) }}" class="mt-8 inline-block bg-[#376A64] px-7 py-4 text-xs font-bold uppercase tracking-[0.12em] text-white">
            {{ $locale === 'en' ? 'Return to Deforestory' : 'Kembali ke Deforestory' }}
        </a>
    </main>
</body>
</html>

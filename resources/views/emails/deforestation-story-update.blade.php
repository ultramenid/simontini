<!doctype html>
<html lang="{{ $locale }}">
<body style="margin:0;background:#f3f6f5;font-family:Arial,sans-serif;color:#1a1a1a">
    <div style="max-width:640px;margin:0 auto;padding:32px 16px">
        <div style="background:#fff;border:1px solid #d9e1df;padding:32px">
            <p style="margin:0 0 8px;color:#376A64;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.12em">SIMONTINI · {{ $storyTitle }}</p>
            <h1 style="margin:0 0 18px;font-size:26px;line-height:1.25">{{ $title }}</h1>
            <p style="margin:0 0 20px;color:#555;line-height:1.7">{{ $description }}</p>
            <p style="margin:0 0 24px;color:#7a6e60;font-size:13px">{{ \Carbon\Carbon::parse($publishedAt)->locale($locale)->translatedFormat('d F Y') }}</p>
            <a href="{{ $targetUrl }}" style="display:inline-block;background:#376A64;color:#fff;padding:13px 20px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase">{{ $locale === 'en' ? 'Open source update' : 'Buka pembaruan sumber' }}</a>
        </div>
    </div>
</body>
</html>

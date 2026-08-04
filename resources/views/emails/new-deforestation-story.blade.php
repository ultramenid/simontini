<!doctype html>
<html lang="{{ $locale }}">
<body style="margin:0;background:#f3f6f5;font-family:Arial,sans-serif;color:#1a1a1a">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;background:#f3f6f5">
        <tr>
            <td align="center" style="padding:32px 16px">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:640px;background:#ffffff;border:1px solid #d9e1df">
                    @if (! empty($imageUrl))
                        <tr>
                            <td style="padding:0;line-height:0">
                                <img src="{{ $imageUrl }}" width="640" alt="{{ $title }}" style="display:block;width:100%;max-width:640px;height:auto;border:0">
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td style="padding:30px 32px 34px">
                            <p style="margin:0 0 10px;color:#376A64;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.12em">SIMONTINI · {{ $locale === 'en' ? 'New Deforestory' : 'Deforestory Baru' }}</p>
                            <h1 style="margin:0 0 14px;font-size:26px;line-height:1.25;color:#1a1a1a">{{ $title }}</h1>
                            <p style="margin:0 0 18px;color:#555555;font-size:15px;line-height:1.7">{{ $description }}</p>
                            <p style="margin:0 0 24px;color:#7a6e60;font-size:13px">{{ \Carbon\Carbon::parse($publishedAt)->locale($locale)->translatedFormat('d F Y') }}</p>
                            <a href="{{ $storyUrl }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em">{{ $locale === 'en' ? 'Read Deforestory' : 'Baca Deforestory' }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

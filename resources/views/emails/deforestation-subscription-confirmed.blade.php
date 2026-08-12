<!doctype html>
<html lang="{{ $locale }}">
<body style="margin:0;background:#f3f6f5;font-family:Arial,sans-serif;color:#1a1a1a">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;background:#f3f6f5">
        <tr>
            <td align="center" style="padding:32px 16px">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:640px;background:#ffffff;border:1px solid #d9e1df">
                    <tr>
                        <td align="center" style="padding:42px 30px">
                            <div style="width:72px;height:72px;line-height:72px;background:#e5efed;color:#376A64;font-size:38px;font-weight:bold;text-align:center;border-radius:50%">✓</div>
                            <p style="margin:26px 0 0;color:#376A64;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.14em">SIMONTINI · DEFORESTORY</p>
                            <h1 style="margin:12px 0 0;font-size:28px;line-height:1.3">
                                {{ $locale === 'en' ? 'Subscription activated' : 'Langganan berhasil diaktifkan' }}
                            </h1>
                            <p style="margin:18px auto 0;max-width:500px;color:#655f57;font-size:15px;line-height:1.7">
                                @if ($locale === 'en')
                                    Hi {{ $name }}, you will now receive {{ $isGlobal ? 'new Deforestory stories and their latest updates.' : 'the latest updates for “'.$storyTitle.'”.' }}
                                @else
                                    Halo {{ $name }}, Anda sekarang akan menerima {{ $isGlobal ? 'story Deforestory baru beserta seluruh pembaruannya.' : 'pembaruan terbaru untuk “'.$storyTitle.'”.' }}
                                @endif
                            </p>
                            <div style="margin-top:28px">
                                <a href="{{ $destinationUrl }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:14px 22px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.07em">
                                    {{ $locale === 'en' ? 'Open Deforestory' : 'Buka Deforestory' }}
                                </a>
                            </div>
                            <p style="margin:28px 0 0;color:#7a6e60;font-size:12px;line-height:1.6">
                                {{ $locale === 'en' ? 'Did not request this subscription?' : 'Tidak merasa mendaftar langganan ini?' }}
                                <a href="{{ $unsubscribeUrl }}" style="color:#b94a3c;text-decoration:underline">
                                    {{ $locale === 'en' ? 'Unsubscribe' : 'Berhenti berlangganan' }}
                                </a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

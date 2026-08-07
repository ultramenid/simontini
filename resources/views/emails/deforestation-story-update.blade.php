<!doctype html>
<html lang="id">
<body style="margin:0;background:#f3f6f5;font-family:Arial,sans-serif;color:#1a1a1a">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;background:#f3f6f5">
        <tr>
            <td align="center" style="padding:32px 16px">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:640px;background:#ffffff;border:1px solid #d9e1df">
                    <tr>
                        <td style="padding:30px 28px 32px">
                            <p style="margin:0 0 24px;color:#376A64;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.12em">
                                SIMONTINI · Pembaruan Story / Story Update
                            </p>

                            <p lang="id" style="margin:0 0 9px;color:#376A64;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.12em">Indonesia</p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;border:1px solid #d9e1df">
                                @if (! empty($imageUrl))
                                    <tr>
                                        <td style="padding:0;line-height:0">
                                            <img src="{{ $imageUrl }}" width="582" alt="{{ $titleId }}" style="display:block;width:100%;max-width:582px;height:auto;border:0">
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td lang="id" style="padding:26px 26px 28px">
                                        <h1 style="margin:0 0 18px;font-size:25px;line-height:1.3">{{ $titleId }}</h1>
                                        <p style="margin:0 0 20px;color:#555555;font-size:15px;line-height:1.7">{{ $descriptionId }}</p>
                                        <p style="margin:0 0 24px;color:#7a6e60;font-size:13px">{{ \Carbon\Carbon::parse($publishedAt)->locale('id')->translatedFormat('d F Y') }}</p>
                                        <a href="{{ $targetUrlId }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em">Buka Pembaruan Sumber</a>
                                        <a href="{{ $unsubscribeUrl }}" style="display:inline-block;margin-left:8px;border:1px solid #b94a3c;color:#b94a3c;padding:12px 19px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em">Berhenti Berlangganan</a>
                                    </td>
                                </tr>
                            </table>

                            <p lang="en" style="margin:24px 0 9px;color:#376A64;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.12em">English</p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;border:1px solid #d9e1df">
                                @if (! empty($imageUrl))
                                    <tr>
                                        <td style="padding:0;line-height:0">
                                            <img src="{{ $imageUrl }}" width="582" alt="{{ $titleEn }}" style="display:block;width:100%;max-width:582px;height:auto;border:0">
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td lang="en" style="padding:26px 26px 28px">
                                        <h2 style="margin:0 0 18px;font-size:25px;line-height:1.3">{{ $titleEn }}</h2>
                                        <p style="margin:0 0 20px;color:#555555;font-size:15px;line-height:1.7">{{ $descriptionEn }}</p>
                                        <p style="margin:0 0 24px;color:#7a6e60;font-size:13px">{{ \Carbon\Carbon::parse($publishedAt)->locale('en')->translatedFormat('d F Y') }}</p>
                                        <a href="{{ $targetUrlEn }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em">Open Source Update</a>
                                        <a href="{{ $unsubscribeUrl }}" style="display:inline-block;margin-left:8px;border:1px solid #b94a3c;color:#b94a3c;padding:12px 19px;text-decoration:none;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em">Unsubscribe</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @media only screen and (max-width: 620px) {
            .email-shell { width: 100% !important; }
            .email-padding { padding: 22px 16px 26px !important; }
            .card-copy { padding: 22px 18px 24px !important; }
            .email-title { font-size: 23px !important; }
            .action-button { display: block !important; text-align: center !important; }
        }
    </style>
</head>
<body style="margin:0;background:#edf3f1;font-family:Arial,sans-serif;color:#1a1a1a">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;background:#edf3f1">
        <tr>
            <td align="center" style="padding:28px 12px">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" border="0" class="email-shell" style="width:100%;max-width:620px;background:#ffffff;border:1px solid #d7e1df">
                    <tr>
                        <td style="background:#376A64;padding:26px 28px;color:#ffffff">
                            <p style="margin:0;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.16em">SIMONTINI</p>
                            <h1 class="email-title" style="margin:8px 0 0;font-size:24px;line-height:1.3;color:#ffffff">Pembaruan Deforestory / Deforestory Update</h1>
                        </td>
                    </tr>

                    <tr>
                        <td class="email-padding" style="padding:28px 24px 32px">
                            <p lang="id" style="margin:0 0 8px;color:#376A64;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.15em">Indonesia</p>
                            <p lang="id" style="margin:0 0 16px;color:#655f57;font-size:14px;line-height:1.7">
                                Ada pembaruan terbaru untuk <strong style="color:#1a1a1a">{{ $storyTitleId }}</strong>.
                            </p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;border:1px solid #d7e1df;background:#ffffff">
                                @if (! empty($imageUrlId ?? $imageUrl ?? null))
                                    <tr>
                                        <td style="padding:0;line-height:0;background:#e8e8e8">
                                            <a href="{{ $targetUrlId }}" style="display:block;text-decoration:none">
                                                <img src="{{ $imageUrlId ?? $imageUrl }}" width="570" alt="{{ $titleId }}" style="display:block;width:100%;max-width:570px;height:auto;border:0">
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td lang="id" class="card-copy" style="padding:24px">
                                        <p style="margin:0 0 10px;color:#b94a3c;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.14em">Pembaruan terbaru</p>
                                        <h2 style="margin:0 0 12px;font-size:23px;line-height:1.32;color:#1a1a1a">{{ $titleId }}</h2>
                                        <p style="margin:0;color:#555555;font-size:14px;line-height:1.7">{{ $descriptionId }}</p>
                                        <p style="margin:18px 0 22px;color:#7a6e60;font-size:12px">{{ \Carbon\Carbon::parse($publishedAt)->locale('id')->translatedFormat('d F Y') }}</p>
                                        <a href="{{ $targetUrlId }}" class="action-button" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em">Buka Pembaruan</a>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin:30px 0 26px">
                                <tr>
                                    <td style="height:1px;padding:0;border-top:1px solid #aebbb8;font-size:0;line-height:0">&nbsp;</td>
                                </tr>
                            </table>

                            <p lang="en" style="margin:0 0 8px;color:#376A64;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.15em">English</p>
                            <p lang="en" style="margin:0 0 16px;color:#655f57;font-size:14px;line-height:1.7">
                                A new update is available for <strong style="color:#1a1a1a">{{ $storyTitleEn }}</strong>.
                            </p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;border:1px solid #d7e1df;background:#ffffff">
                                @if (! empty($imageUrlEn ?? $imageUrl ?? null))
                                    <tr>
                                        <td style="padding:0;line-height:0;background:#e8e8e8">
                                            <a href="{{ $targetUrlEn }}" style="display:block;text-decoration:none">
                                                <img src="{{ $imageUrlEn ?? $imageUrl }}" width="570" alt="{{ $titleEn }}" style="display:block;width:100%;max-width:570px;height:auto;border:0">
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td lang="en" class="card-copy" style="padding:24px">
                                        <p style="margin:0 0 10px;color:#b94a3c;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.14em">Latest update</p>
                                        <h2 style="margin:0 0 12px;font-size:23px;line-height:1.32;color:#1a1a1a">{{ $titleEn }}</h2>
                                        <p style="margin:0;color:#555555;font-size:14px;line-height:1.7">{{ $descriptionEn }}</p>
                                        <p style="margin:18px 0 22px;color:#7a6e60;font-size:12px">{{ \Carbon\Carbon::parse($publishedAt)->locale('en')->translatedFormat('d F Y') }}</p>
                                        <a href="{{ $targetUrlEn }}" class="action-button" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em">Open Update</a>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin-top:28px;border-top:1px solid #d7e1df">
                                <tr>
                                    <td align="center" style="padding:22px 10px 0;color:#7a6e60;font-size:12px;line-height:1.65">
                                        Tidak ingin menerima email ini lagi? / No longer want these emails?<br>
                                        <a href="{{ $unsubscribeUrl }}" style="display:inline-block;margin-top:8px;color:#b94a3c;font-weight:700;text-decoration:underline">Berhenti berlangganan / Unsubscribe</a>
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

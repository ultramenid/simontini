<!doctype html>
<html lang="id">
<body style="margin:0;background:#edf3f1;font-family:Arial,sans-serif;color:#1a1a1a">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;background:#edf3f1">
        <tr>
            <td align="center" style="padding:28px 12px">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:620px;background:#ffffff;border:1px solid #d7e1df">
                    <tr>
                        <td style="background:#376A64;padding:26px 28px;color:#ffffff">
                            <p style="margin:0;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.16em">SIMONTINI</p>
                            <h1 style="margin:8px 0 0;font-size:23px;line-height:1.3;color:#ffffff">Deforestory Baru / New Deforestory</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 24px 32px">
                            <p style="margin:0 0 20px;color:#655f57;font-size:14px;line-height:1.65">
                                Konten Deforestory terbaru telah dipublikasikan. The latest Deforestory content has been published.
                            </p>

                            <p lang="id" style="margin:0 0 8px;color:#376A64;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.15em">Indonesia</p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;border:1px solid #d7e1df;background:#ffffff">
                                @if (! empty($imageUrlId))
                                    <tr>
                                        <td style="padding:0;line-height:0;background:#e8e8e8">
                                            <img src="{{ $imageUrlId }}" width="570" height="260" alt="{{ $titleId }}" style="display:block;width:100%;height:260px;object-fit:cover;border:0">
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td lang="id" style="padding:24px">
                                        <h2 style="margin:0 0 11px;font-size:23px;line-height:1.32;color:#1a1a1a">{{ $titleId }}</h2>
                                        <p style="margin:0;color:#555555;font-size:14px;line-height:1.7">{{ $descriptionId }}</p>
                                        <p style="margin:18px 0 22px;color:#7a6e60;font-size:12px">{{ \Carbon\Carbon::parse($publishedAt)->locale('id')->translatedFormat('d F Y') }}</p>
                                        <a href="{{ $storyUrlId }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 19px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em">Baca Deforestory</a>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin:30px 0 26px">
                                <tr>
                                    <td style="height:1px;padding:0;border-top:1px solid #aebbb8;font-size:0;line-height:0">&nbsp;</td>
                                </tr>
                            </table>

                            <p lang="en" style="margin:0 0 8px;color:#376A64;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.15em">English</p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;border:1px solid #d7e1df;background:#ffffff">
                                @if (! empty($imageUrlEn))
                                    <tr>
                                        <td style="padding:0;line-height:0;background:#e8e8e8">
                                            <img src="{{ $imageUrlEn }}" width="570" height="260" alt="{{ $titleEn }}" style="display:block;width:100%;height:260px;object-fit:cover;border:0">
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td lang="en" style="padding:24px">
                                        <h2 style="margin:0 0 11px;font-size:23px;line-height:1.32;color:#1a1a1a">{{ $titleEn }}</h2>
                                        <p style="margin:0;color:#555555;font-size:14px;line-height:1.7">{{ $descriptionEn }}</p>
                                        <p style="margin:18px 0 22px;color:#7a6e60;font-size:12px">{{ \Carbon\Carbon::parse($publishedAt)->locale('en')->translatedFormat('d F Y') }}</p>
                                        <a href="{{ $storyUrlEn }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 19px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em">Read Deforestory</a>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;margin-top:26px;border-top:1px solid #d7e1df">
                                <tr>
                                    <td align="center" style="padding:22px 10px 0;color:#7a6e60;font-size:12px;line-height:1.65">
                                        Tidak ingin menerima email ini lagi? / No longer want these emails?<br>
                                        <a href="{{ $unsubscribeUrl }}" style="display:inline-block;margin-top:9px;color:#b94a3c;font-weight:700;text-decoration:underline">Berhenti berlangganan / Unsubscribe</a>
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

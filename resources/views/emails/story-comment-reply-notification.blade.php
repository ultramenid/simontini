<!doctype html>
<html lang="id">
<body style="margin:0;background:#f3f6f5;font-family:Arial,sans-serif;color:#1a1a1a">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%;background:#f3f6f5">
        <tr>
            <td align="center" style="padding:32px 16px">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:620px;background:#ffffff;border:1px solid #d9e1df">
                    <tr>
                        <td style="padding:34px 34px 12px">
                            <p style="margin:0;color:#376A64;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.14em">SIMONTINI · KOMENTAR / COMMENT</p>
                            <h1 style="margin:14px 0 0;font-size:26px;line-height:1.3">Komentar Anda mendapat balasan</h1>
                            <p style="margin:12px 0 0;color:#655f57;font-size:15px;line-height:1.7">Halo {{ $recipientName }}, <strong>{{ $replyAuthor }}</strong> membalas komentar Anda pada “{{ $storyTitleId }}”.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 34px 34px">
                            <div style="padding:18px;background:#f6f8f7;border-left:4px solid #cadbd8">
                                <p style="margin:0;color:#7a6e60;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em">Komentar Anda</p>
                                <p style="margin:10px 0 0;color:#4b5563;font-size:14px;line-height:1.65">{{ $originalComment }}</p>
                            </div>
                            <div style="margin-top:12px;padding:18px;background:#edf4f2;border-left:4px solid #376A64">
                                <p style="margin:0;color:#376A64;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em">Balasan {{ $replyAuthor }}</p>
                                <p style="margin:10px 0 0;color:#263238;font-size:15px;line-height:1.65">{{ $replyComment }}</p>
                            </div>
                            <div style="margin-top:24px">
                                <a href="{{ $urlId }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em">Buka komentar</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top:1px solid #aebbb8;padding:30px 34px 12px">
                            <h2 style="margin:0;font-size:23px;line-height:1.3">Your comment received a reply</h2>
                            <p style="margin:12px 0 0;color:#655f57;font-size:15px;line-height:1.7">Hi {{ $recipientName }}, <strong>{{ $replyAuthor }}</strong> replied to your comment on “{{ $storyTitleEn }}”.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 34px 38px">
                            <div style="padding:18px;background:#f6f8f7;border-left:4px solid #cadbd8">
                                <p style="margin:0;color:#7a6e60;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em">Your comment</p>
                                <p style="margin:10px 0 0;color:#4b5563;font-size:14px;line-height:1.65">{{ $originalComment }}</p>
                            </div>
                            <div style="margin-top:12px;padding:18px;background:#edf4f2;border-left:4px solid #376A64">
                                <p style="margin:0;color:#376A64;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em">Reply from {{ $replyAuthor }}</p>
                                <p style="margin:10px 0 0;color:#263238;font-size:15px;line-height:1.65">{{ $replyComment }}</p>
                            </div>
                            <div style="margin-top:24px">
                                <a href="{{ $urlEn }}" style="display:inline-block;background:#376A64;color:#ffffff;padding:13px 20px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em">View comment</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

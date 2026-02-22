<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9;">

    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 560px; margin: 40px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
        {{-- Header --}}
        <tr>
            <td style="background: linear-gradient(135deg, #6366F1, #7C3AED); padding: 32px 40px; text-align: center;">
                <h1 style="color: #ffffff; font-size: 22px; margin: 0; font-weight: 700;">🔐 IT System Gasindogroup</h1>
                <p style="color: rgba(255,255,255,0.85); font-size: 13px; margin: 8px 0 0;">Password Reset</p>
            </td>
        </tr>

        {{-- Body --}}
        <tr>
            <td style="padding: 32px 40px;">
                <p style="font-size: 15px; color: #1f2937; margin: 0 0 16px;">
                    Halo <strong>{{ $user->name }}</strong>,
                </p>

                <p style="font-size: 14px; color: #4b5563; line-height: 1.6; margin: 0 0 24px;">
                    Password akun Anda telah direset. Berikut adalah informasi login sementara Anda:
                </p>

                {{-- Credentials Box --}}
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="background: #f8f9fc; border-radius: 12px; border: 1px solid #e5e7eb; margin-bottom: 24px;">
                    <tr>
                        <td style="padding: 20px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td
                                        style="font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; padding-bottom: 6px;">
                                        Username</td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-size: 16px; color: #1f2937; font-weight: 600; padding-bottom: 16px;">
                                        {{ $user->username }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; padding-bottom: 6px;">
                                        Password Baru</td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-size: 18px; color: #6366F1; font-weight: 700; font-family: 'Courier New', monospace; letter-spacing: 2px;">
                                        {{ $newPassword }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                {{-- Warning --}}
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="background: #fffbeb; border-radius: 10px; border: 1px solid #fde68a; margin-bottom: 24px;">
                    <tr>
                        <td style="padding: 14px 18px;">
                            <p style="font-size: 13px; color: #92400e; margin: 0; line-height: 1.5;">
                                ⚠️ <strong>Penting:</strong> Segera ganti password ini setelah login untuk keamanan akun
                                Anda.
                            </p>
                        </td>
                    </tr>
                </table>

                {{-- Button --}}
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align: center;">
                            <a href="{{ url('/login') }}"
                                style="display: inline-block; background: linear-gradient(135deg, #6366F1, #7C3AED); color: #ffffff; text-decoration: none; padding: 12px 32px; border-radius: 10px; font-size: 14px; font-weight: 600;">
                                Login Sekarang →
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- Footer --}}
        <tr>
            <td style="padding: 20px 40px; border-top: 1px solid #f0f0f0; text-align: center;">
                <p style="font-size: 11px; color: #9ca3af; margin: 0;">
                    Email ini dikirim secara otomatis oleh IT System Gasindogroup.<br>
                    Jika Anda tidak meminta reset password, abaikan email ini.
                </p>
            </td>
        </tr>
    </table>

</body>

</html>
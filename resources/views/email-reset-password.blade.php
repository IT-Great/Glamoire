<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Glamoire</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .header {
            background: #183018;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .logo {
            position: relative;
            z-index: 1;
        }

        .logo h1 {
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .logo p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .content {
            padding: 50px 40px;
            background: #ffffff;
        }

        .content h2 {
            color: #1a202c;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 24px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .greeting {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 24px;
        }

        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 32px;
            line-height: 1.7;
        }

        .button-container {
            text-align: center;
            margin: 40px 0;
        }

        .reset-button {
            display: inline-block;
            background: #183018;
            color: #ffffff;
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -10px rgba(102, 126, 234, 0.5);
            position: relative;
            overflow: hidden;
        }

        .reset-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .reset-button:hover::before {
            left: 100%;
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -10px rgba(102, 126, 234, 0.6);
        }

        .alternative-text {
            font-size: 14px;
            color: #718096;
            margin-bottom: 16px;
        }

        .url-box {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            word-break: break-all;
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 13px;
            color: #4a5568;
            margin-bottom: 32px;
            position: relative;
        }

        .notes-section {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 20%, #fff5f5 100%);
            border-left: 4px solid #f56565;
            border-radius: 0 12px 12px 0;
            padding: 24px;
            margin: 32px 0;
        }

        .notes-section h3 {
            color: #c53030;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }

        .notes-section h3::before {
            content: '⚠️';
            margin-right: 8px;
        }

        .notes-list {
            list-style: none;
        }

        .notes-list li {
            color: #742a2a;
            font-size: 14px;
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .notes-list li::before {
            content: '•';
            color: #f56565;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .signature {
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .signature p {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.6;
        }

        .team-name {
            color: #667eea;
            font-weight: 600;
        }

        .footer {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer p {
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
        }

        .divider {
            width: 60px;
            height: 4px;
            background: #183018;
            border-radius: 2px;
            margin: 32px auto;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .content {
                padding: 30px 25px;
            }

            .header {
                padding: 30px 25px;
            }

            .logo h1 {
                font-size: 28px;
            }

            .content h2 {
                font-size: 24px;
            }

            .reset-button {
                padding: 14px 32px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">
                <h1>Glamoire</h1>
                <p>Vegan Skin Beauty</p>
            </div>
        </div>

        <div class="content">
            <h2>Reset Password</h2>

            <div class="divider"></div>

            <p class="greeting">Halo <strong>{{ $userName ?? 'Admin' }}</strong>,</p>

            <p class="message">
                Kami menerima permintaan untuk reset password akun Anda. Untuk keamanan akun, silakan klik tombol di
                bawah ini untuk membuat password baru yang aman.
            </p>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button text-white">Reset Password Sekarang</a>
            </div>

            <p class="alternative-text">Atau copy dan paste link berikut di browser Anda:</p>
            <div class="url-box">
                {{ $resetUrl }}
            </div>

            <div class="notes-section">
                <h3>Penting untuk Diperhatikan</h3>
                <ul class="notes-list">
                    <li>Link reset password ini hanya berlaku selama <strong>1 jam</strong> setelah email ini dikirim
                    </li>
                    <li>Jika Anda tidak meminta reset password, abaikan email ini dengan aman</li>
                    <li>Untuk menjaga keamanan akun, jangan bagikan link ini kepada siapapun</li>
                    <li>Setelah reset, gunakan password yang kuat dan unik</li>
                </ul>
            </div>

            <div class="signature">
                <p>Dengan hormat,<br>
                    <span class="team-name">Tim Glamoire</span>
                </p>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis dari sistem keamanan Glamoire.<br>
                Mohon tidak membalas email ini. Jika butuh bantuan, hubungi customer service kami.</p>
        </div>
    </div>
</body>

</html>

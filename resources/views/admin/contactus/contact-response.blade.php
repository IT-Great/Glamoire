<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            background-image: url('https://example.com/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            color: #2c3e50;
        }

        .email-container {
            max-width: 680px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .email-header {
            background: linear-gradient(135deg, #183018 0%, #2c5e2e 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .email-content {
            padding: 40px 30px;
        }

        .important-notice {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 4px;
        }

        .important-notice h2 {
            margin-top: 0;
            color: #1e40af;
            font-size: 18px;
        }

        .important-notice ul {
            padding-left: 20px;
        }

        .question-section,
        .response-section {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .question-section {
            border-left: 4px solid #ff6b6b;
        }

        .response-section {
            border-left: 4px solid #4ade80;
        }

        .action-button {
            display: inline-block;
            background-color: #183018;
            color: white !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .action-button:hover {
            background-color: #2c5e2e;
        }

        .footer {
            background-color: #f1f5f9;
            color: #64748b;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                width: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>

<body style="background-color: #f3f4f6; padding: 20px;">
    <div class="email-container">
        <div class="email-header">
            <h1>Tanggapan Atas Pertanyaan Anda</h1>
        </div>

        <div class="email-content">
            <div class="important-notice">
                <h2>🚨 Petunjuk Penting</h2>
                <p>Mohon TIDAK membalas email ini. Untuk pertanyaan lebih lanjut:</p>
                <ul>
                    <li>Kirim pertanyaan baru melalui <a href="{{ $contactUsLink }}" style="color: #3b82f6;">Formulir
                            Contact Us</a></li>
                    <li>Chat Admin kami di WhatsApp: <a href="{{ $whatsappLink }}" style="color: #3b82f6;">Klik untuk Chat
                            Admin</a></li>
                </ul>
            </div>

            <p>Halo {{ $contact->name }},</p>

            <p>Terima kasih telah menghubungi kami. Tim kami telah dengan seksama memperhatikan pertanyaan Anda.</p>

            <div class="question-section">
                <h3 style="color: #ef4444;">📝 Pertanyaan Anda</h3>
                <p>{{ $contact->question }}</p>
            </div>

            <div class="response-section">
                <h3 style="color: #22c55e;">💡 Tanggapan Kami</h3>
                <p>{{ $response }}</p>
            </div>

            <a href="{{ url('/') }}" class="action-button">Kunjungi Website Kami</a>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Glamoire. Hak Cipta Dilindungi Undang-Undang.</p>
            <p>Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi tim dukungan kami.</p>
        </div>
    </div>
</body>

</html>

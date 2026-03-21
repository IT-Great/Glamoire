<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subjectText }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background-color: #183018; padding: 30px 20px; text-align: center; color: #D4AF37; }
        .header h1 { margin: 0; font-size: 24px; letter-spacing: 2px; text-transform: uppercase; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; font-size: 16px; }
        .content p { margin-bottom: 20px; white-space: pre-wrap; }
        .footer { background-color: #f3f4f6; padding: 20px; text-align: center; color: #6b7280; font-size: 12px; }
        .btn-shop { display: inline-block; padding: 12px 30px; background-color: #D4AF37; color: #183018; text-decoration: none; font-weight: bold; border-radius: 50px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Glamoire</h1>
        </div>
        <div class="content">
            <p>{{ $messageText }}</p>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="btn-shop">Kunjungi Toko Kami</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Glamoire. All rights reserved.<br>
            Anda menerima email ini karena Anda berlangganan newsletter kami.
        </div>
    </div>
</body>
</html>

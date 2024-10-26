<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Promo Code Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            color: #555555;
            line-height: 1.6;
        }
        .promo-code {
            background-color: #ff6b6b;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            margin: 20px 0;
            text-align: center;
            border-radius: 5px;
        }
        .btn {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 15px 20px;
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            width: 100%;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Selamat! Kamu Mendapatkan Kode Promo Untuk Pengguna Baru di Glamoire! 🎁</h1>
        <p>Hi <strong>{{ $data['fullname'] }}</strong>,</p>
        <p>We’re excited to have you on board! As a special thank you for joining us, here’s an exclusive <strong>Promo Code</strong> just for you:</p>

        <div class="promo-code">
            {{ $data['code'] }}
        </div>

        <p>Use this code at checkout to enjoy <strong>amazing discounts</strong> on your next purchase. Here’s how to use it:</p>
        <ul>
            <li>Visit our website and browse our awesome products.</li>
            <li>Add your favorites to your cart.</li>
            <li>Enter your promo code at checkout and watch the magic happen!</li>
        </ul>

        <a href="https://www.glamoire.com" class="btn">Shop Now</a>

        <p>But hurry! This offer is <strong>valid only for a limited time</strong>. Don't miss out on the chance to treat yourself!</p>

        <div class="footer">
            <p>If you have any questions, feel free to reply to this email or contact our support team. We’re always here to help.</p>
            <p><strong>Stay awesome,</strong></p>
            <p>The Glamoire Team</p>
            <p><a href="https://www.yourwebsite.com" style="color: #ff6b6b;">Visit Our Website</a></p>
            <p>Follow us on social media for more exclusive offers and the latest updates!</p>
        </div>
    </div>
</body>
</html>

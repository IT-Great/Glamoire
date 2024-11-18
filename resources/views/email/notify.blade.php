<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Back in Stock Notification</title>
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
        .product-name {
            font-size: 18px;
            color: #333333;
            font-weight: bold;
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
            margin-top: 20px;
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
        <h1>🛍️ Product Back in Stock!</h1>
        <p>Hi <strong>{{ $data['fullname'] }}</strong>,</p>
        <p>Good news! The item you’ve been waiting for is now back in stock:</p>

        <p class="product-name">{{ $data['product_name'] }}</p>

        <p>We wanted to let you know as soon as possible, so you can grab yours before it runs out again!</p>
        
        <a href="{{ $data['product_link'] }}" class="btn">Shop Now</a>

        <p>Thank you for being a valued customer. We hope this item is everything you’ve been looking for!</p>

        <div class="footer">
            <p>If you have any questions, feel free to reach out to our support team. We’re here to help!</p>
            <p><strong>Happy shopping,</strong></p>
            <p>The Glamoire Team</p>
            <p><a href="https://www.glamoire.com" style="color: #4CAF50;">Visit Our Website</a></p>
            <p>Follow us on social media for more updates and exclusive offers!</p>
        </div>
    </div>
</body>
</html>

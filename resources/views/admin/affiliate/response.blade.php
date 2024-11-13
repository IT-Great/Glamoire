<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .email-content {
            padding: 30px;
            background-color: #ffffff;
        }
        .question-section {
            background-color: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .response-section {
            background-color: #ffffff;
            padding: 20px;
            border-left: 4px solid #6366f1;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f9fafb;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #6366f1;
            color: #ffffff !important; /* Tambahkan !important untuk memastikan warna teks */
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-color: #f3f4f6; padding: 20px;">
    <div class="email-container">
        <div class="email-header">
            <h1>Response to Your Affiliate</h1>
        </div>
        
        <div class="email-content">
            <p>Hello {{ $partner->name }},</p>
            
            <p>Thank you for reaching out to us. We've reviewed your Affiliate and here's our response:</p>
            
            <div class="question-section">
                <h3>Your Question:</h3>
                <p>{{ $partner->question }}</p>
            </div>
            
            <div class="response-section">
                <h3>Our Response:</h3>
                <p>{{ $response }}</p>
            </div>
            
            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Glamoire. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
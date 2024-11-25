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
            background-color: #183018;
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
            border-left: 4px solid #183018;
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
            background-color: #183018;
            color: #ffffff !important;
            /* Tambahkan !important untuk memastikan warna teks */
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>

<body style="background-color: #f3f4f6; padding: 20px;">
    <div class="email-container">
        <div class="email-header">
            <h1>Response to Your Question</h1>
        </div>

        <div class="email-content">
            <p>Hello {{ $contact->name }},</p>

            <p>Thank you for reaching out to us. We've reviewed your question and here's our response:</p>

            <div class="question-section">
                <h3>Your Question:</h3>
                <p>{{ $contact->question }}</p>
            </div>

            <div class="response-section">
                <h3>Our Response:</h3>
                <p>{{ $response }}</p>
            </div>

            @if ($contact->response_image || $contact->response_video)
                <p>We have attached the following media files to this email:</p>
                <ul>
                    @if ($contact->response_image)
                        <li>Supporting image</li>
                    @endif
                    @if ($contact->response_video)
                        <li>Supporting video</li>
                    @endif
                </ul>
            @endif

            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Glamoire. All rights reserved.</p>
        </div>
    </div>
</body>

</html>

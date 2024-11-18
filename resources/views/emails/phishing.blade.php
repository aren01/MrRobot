<!DOCTYPE html>
<html>

<head>
    <title>Google Account Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
        }

        .content {
            text-align: center;
        }

        .content h1 {
            color: #333;
        }

        .content p {
            color: #666;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #4285f4;
            border-radius: 5px;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
@component('mail::message')

<body>
    <div class="email-container">
        <div class="header">
            <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_150x54dp.png" alt="Google">
        </div>
        <div class="content">
            <h1>Password Reset Request</h1>
            <p>We received a request to reset your Google account password. Click the button below to reset your password:</p>
            @component('mail::button', ['url' => $url]) Reset Password @endcomponent
            <p>If you did not request a password reset, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043</p>
        </div>
    </div>
</body>
{{ config('app.name') }}
@endcomponent

</html>
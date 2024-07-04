<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .verification-code {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .thank-you {
            font-size: 16px;
            margin-top: 20px;
        }
        .welcome {
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification Code</h2>
        <p class="verification-code">Your email verification code is: <strong>{{ $verificationCode }}</strong></p>
        <p>Please use this code to verify your email address.</p>
        <p class="welcome">Welcome to UniSoko! We're delighted to have you as part of our community.</p>
        <p class="thank-you">Thank you for registering with us!</p>
    </div>
</body>
</html>

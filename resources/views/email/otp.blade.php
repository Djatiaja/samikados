<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .otp-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .otp-container h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 10px;
        }

        .otp-container p {
            font-size: 18px;
            color: #555555;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 28px;
            color: #007bff;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 10px 0;
        }

        .note {
            font-size: 14px;
            color: #888888;
        }
    </style>
</head>

<body>
    <div class="otp-container">
        <h1>Welcome, {{$user_name}}!</h1>
        <p>Your one-time password (OTP) is:</p>
        <div class="otp-code">{{$user_token}}</div>
        <p class="note">Please use this code to complete your verification process. This code will expire in 3 minutes.
        </p>
    </div>
</body>

</html>
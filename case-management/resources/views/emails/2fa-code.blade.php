<!DOCTYPE html>
<html>

<head>
    <title>Your Two-Factor Authentication Code</title>
</head>

<body>
    <h1>Your Two-Factor Authentication Code</h1>
    <p>Please use the following code to complete your login:</p>
    <h2 style="font-size: 24px; letter-spacing: 2px; font-weight: bold;">{{ $code }}</h2>
    <p>This code will expire in 10 minutes.</p>
    <p>If you did not request this code, you can safely ignore this email.</p>
    <p>Thank you,<br>The {{ config('app.name') }} Team</p>
</body>

</html>

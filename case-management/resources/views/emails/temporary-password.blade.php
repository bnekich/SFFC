<!DOCTYPE html>
<html>

<head>
    <title>Your Temporary Password</title>
</head>

<body>
    <h1>Welcome to {{ config('app.name') }}</h1>
    <p>Hello {{ $user->firstName }},</p>

    <p>An account has been created for you. Your temporary password is: <strong>{{ $password }}</strong></p>

    <p>You will be required to change this password upon your first login.</p>

    <p>Thank you,<br>The {{ config('app.name') }} Team</p>
</body>

</html>

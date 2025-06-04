<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Your POS</title>
</head>
<body>
    <h2>Welcome {{ $name }}!</h2>

    <p>Your POS system is ready. Here are your login details:</p>

    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
        <li><strong>Access URL:</strong> <a href="{{ $url }}">{{ $url }}</a></li>
    </ul>

    <p>You are currently on the <strong>Free Plan</strong> with 14 days access.</p>
    <p>We’re excited to have you onboard!</p>
</body>
</html>

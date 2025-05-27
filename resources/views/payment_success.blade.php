<!DOCTYPE html>
<html>
<head>
    <title>Subscription Successful</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Thank you for subscribing to the {{ ucfirst($user->plan_name) }} plan.</p>

    <p>Your custom POS domain is: <a href="https://{{ $domain }}">{{ $domain }}</a></p>

    <p><strong>Admin Login Details:</strong></p>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>You can log in here: <a href="https://{{ $domain }}/login">{{ $domain }}/login</a></p>

    <p>— Ogalearn POS Team</p>
</body>
</html>

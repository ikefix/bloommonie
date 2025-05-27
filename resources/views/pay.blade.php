<!DOCTYPE html>
<html>
<head>
    <title>Pay with Paystack</title>
</head>
<body>
    <h2>Subscribe to POS Inventory - ₦1000</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('pay') }}">
        @csrf
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Payment Successful</h3>
    <p>Thank you for subscribing to our POS platform.</p>
    <pre>{{ print_r($paymentDetails, true) }}</pre>
</div>
@endsection

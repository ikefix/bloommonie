<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;

class SubscriptionController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('register')->with('error', 'Please register or log in before subscribing.');
        }

        $user = auth()->user();

        // Validate the input
        $request->validate([
            'amount' => 'required|numeric',
            'plan' => 'required|string',
        ]);

        $amount = $request->amount;
        $plan = $request->plan;

        // Save subscription data in session
        session([
            'plan' => $plan,
            'amount' => $amount,
        ]);

        // Redirect to Paystack
        return Paystack::getAuthorizationUrl([
            'email' => $user->email,
            'amount' => $amount,
            'metadata' => [
                'user_id' => $user->id,
                'plan' => $plan,
            ],
        ])->redirectNow();
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData(); // Returns the payment data

        $user = auth()->user();
        $plan = session('plan');
        $amount = session('amount');

        // Save subscription info to the user
        $user->subscription_plan = $plan;
        $user->subscription_expires_at = now()->addMonth(); // or addYear() if it's a yearly plan
        $user->save();

        return redirect()->route('home')->with('success', 'Payment successful and subscription activated!');
    }
}

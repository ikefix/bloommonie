<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Models\Subscription;

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

    // Get metadata from payment details
    $metadata = $paymentDetails['data']['metadata'] ?? [];
    $userId = $metadata['user_id'] ?? null;
    $plan = $metadata['plan'] ?? 'lite'; // default to 'lite' if not set
    $amount = $paymentDetails['data']['amount'] ?? 0;
    $reference = $paymentDetails['data']['reference'] ?? null;

    // Get the user from DB instead of relying on session
    $user = \App\Models\User::find($userId);

    if (!$user) {
        return redirect()->route('register')->with('error', 'User not found.');
    }

    // Determine subscription duration
    $endsAt = $plan === 'lite' ? now()->addMonth() : now()->addYear();

    // Optional: update user's subscription plan info for quick access
    $user->subscription_plan = $plan;
    $user->subscription_expires_at = $endsAt;
    $user->save();

    // Save full subscription to subscriptions table
    Subscription::create([
        'user_id' => $user->id,
        'plan' => $plan,
        'amount' => $amount,
        'payment_reference' => $reference,
        'starts_at' => now(),
        'ends_at' => $endsAt,
    ]);

    return redirect()->route('login')->with('success', 'Payment successful. Please log in to continue.');
}


}
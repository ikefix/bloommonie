<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;


class SubscriptionController extends Controller

{
    // public function redirectToGateway(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'company_name' => 'required',
    //         'name' => 'required',
    //     ]);

    //     session([
    //         'company_name' => $request->company_name,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'amount' => 5000 * 100, // Amount in kobo
    //     ]);

    //     return Paystack::getAuthorizationUrl([
    //         'email' => $request->email,
    //         'amount' => session('amount'),
    //         'metadata' => [
    //             'company_name' => $request->company_name,
    //             'name' => $request->name,
    //         ],
    //     ])->redirectNow();
    // }
    public function redirectToGateway(Request $request)
{
    $user = auth()->user(); // make sure the user is logged in

    $request->validate([
        'amount' => 'required|numeric',
        'plan' => 'required|string',
    ]);

    $amount = $request->amount;
    $plan = $request->plan;

    session([
        'plan' => $plan,
        'amount' => $amount,
    ]);

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
    $paymentDetails = Paystack::getPaymentData(); // This returns the payment data

    $user = auth()->user();
    $plan = session('plan');
    $amount = session('amount');

    // Example: Save subscription info to the user or subscription table
    $user->subscription_plan = $plan;
    $user->subscription_expires_at = now()->addMonth(); // or addYear() if yearly
    $user->save();

    // Optional: create a record in a subscriptions table
    // Subscription::create([...]);

    return redirect()->route('dashboard')->with('success', 'Payment successful and subscription activated!');
}
}



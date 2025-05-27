<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    // Redirect to Paystack payment page
    public function redirectToGateway(Request $request)
    {
        try {
            $user = Auth::user();

            // Prepare metadata
            $metadata = [
                'plan' => $request->plan,
                'user_id' => $user->id
            ];

            // Set Paystack payment details
            return Paystack::getAuthorizationUrl([
                'email' => $user->email,
                'amount' => $request->amount,
                'metadata' => $metadata
            ])->redirectNow();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Paystack Error: ' . $e->getMessage());
        }
    }

    // Handle Paystack callback
    public function handleGatewayCallback()
    {
        try {
            $paymentDetails = Paystack::getPaymentData(); // returns array

            // TODO: You can save the transaction details to your DB
            // Example:
            // Transaction::create([
            //     'user_id' => Auth::id(),
            //     'reference' => $paymentDetails['data']['reference'],
            //     'amount' => $paymentDetails['data']['amount'],
            //     'status' => $paymentDetails['data']['status'],
            //     'plan' => $paymentDetails['data']['metadata']['plan'],
            // ]);

            return view('payment-success')->with('details', $paymentDetails);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Callback error: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeToPOSMail;

class CompanyRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_admin' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,email',
            'company_phone' => 'required',
            'password' => 'required|min:6|confirmed',
            'company_name' => 'required|string|max:255',
            'num_employees' => 'required|string',
            'annual_revenue' => 'required|string',
            'industry' => 'required|string',
            'custom_industry' => 'nullable|string',
            'current_inventory_system' => 'required|string',
            'current_inventory_system_other' => 'nullable|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        // Save plain password before hashing (if needed for email)
        $plainPassword = $validated['password'];

        // Create the company
        $company = Company::create([
            'name' => $validated['company_admin'],
            'email' => $validated['company_email'],
            'phonenumber' => $validated['company_phone'],
            'password' => Hash::make($validated['password']),
            'companyname' => $validated['company_name'],
            'employees' => $validated['num_employees'],
            'revenue' => $validated['annual_revenue'],
            'industry' => $validated['industry'] === 'Other'
                ? $validated['custom_industry']
                : $validated['industry'],
            'inventory' => $validated['current_inventory_system'] === 'other'
                ? $validated['current_inventory_system_other']
                : $validated['current_inventory_system'],
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
        ]);

        // Create the tenant
        $tenant = Tenant::create([
            'name' => $validated['company_name'],
            'domain' => strtolower(str_replace(' ', '', $validated['company_name'])) . '.bloommonie.com',
        ]);

        // (Optional) Send Welcome Email
        try {
            Mail::to($company->email)->send(new WelcomeToPOSMail($company, $tenant, $plainPassword));
        } catch (\Exception $e) {
            // Log error or handle email failure gracefully
        }

        // (Optional) Login the user if this is a web session
        // Auth::login($company); // only if `Company` is a guard user

        // Redirect to POS welcome page
        return redirect()->route('pos.welcome');
    }
}

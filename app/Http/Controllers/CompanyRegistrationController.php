<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Company;

use App\Models\User;


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

        // 1. Create the company
        $company = Company::create([
            'name' => $validated['company_admin'],
            'email' => $validated['company_email'],
            'phonenumber' => $validated['company_phone'],
            'password' => Hash::make($validated['password']),
            'companyname' => $validated['company_name'],
            'employees' => $validated['num_employees'],
            'revenue' => $validated['annual_revenue'],
            'industry' => $validated['industry'] === 'Other' ? $validated['custom_industry'] : $validated['industry'],
            'inventory' => $validated['current_inventory_system'] === 'other' ? $validated['current_inventory_system_other'] : $validated['current_inventory_system'],
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
        ]);

        // // 2. Create tenant
        // $subdomain = strtolower(str_replace(' ', '', $validated['company_name']));
        // $domain = $subdomain . '.bloommonie.com';

        // $tenant = Tenant::create([
        //     'company_id' => $company->id,
        //     'name' => $validated['company_name'],
        //     'domain' => $domain,
        // ]);

        // 3. Seed tenant's admin user
        // $plainPassword = $validated['password'];

        // $user = User::create([
        //     'tenant_id' => $tenant->id,
        //     'name' => $validated['company_admin'],
        //     'email' => $validated['company_email'],
        //     'password' => Hash::make($plainPassword),
        //     'role' => 'admin',
        // ]);

        // 4. Send welcome email with POS link
        // Mail::to($user->email)->send(new WelcomeToPOSMail($user, $tenant, $plainPassword));

        // 5. Redirect to POS subdomain (e.g., http://companyname.bloommonie.com)
        return redirect()->away("http://$domain");
    }
}


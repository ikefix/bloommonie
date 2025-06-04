<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeToPOSMail;


class RegisterController extends Controller
{

protected function create(array $data)
{
    // Store password temporarily to email it
    $plainPassword = $data['password'];

    // Create the user
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($plainPassword),
        'company_phone' => $data['company_phone'],
        'company_name' => $data['company_name'],
        'num_employees' => $data['num_employees'],
        'annual_revenue' => $data['annual_revenue'],
        'industry' => $data['industry'],
        'custom_industry' => $data['custom_industry'] ?? null,
        'current_inventory_system' => $data['current_inventory_system'],
        'current_inventory_system_other' => $data['current_inventory_system_other'] ?? null,
        'country' => $data['country'],
        'state' => $data['state'],
        'city' => $data['city'],
    ]);

    // Generate slug
    $slug = Str::slug($data['company_name']) . '-' . uniqid();

    // Create tenant
    $tenant = Tenant::create([
        'user_id' => $user->id,
        'slug' => $slug,
        'plan' => 'free',
        'expires_at' => now()->addDays(14), // 14-day trial
    ]);

    // Send welcome email
    Mail::to($user->email)->send(new WelcomeToPOSMail($user, $tenant, $plainPassword));

    return $user;
}

}

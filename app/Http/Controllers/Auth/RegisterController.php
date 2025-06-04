<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use App\Mail\WelcomeToPOSMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home'; // Or wherever you want to redirect

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Validate registration input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_phone' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'num_employees' => ['required'],
            'annual_revenue' => ['required'],
            'industry' => ['required'],
            'custom_industry' => ['nullable'],
            'current_inventory_system' => ['required'],
            'current_inventory_system_other' => ['nullable'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
        ]);
    }

    // Create the user and tenant, and send welcome email
    protected function create(array $data)
    {
        $plainPassword = $data['password'];

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

        $slug = Str::slug($data['company_name']) . '-' . uniqid();

        $tenant = Tenant::create([
            'user_id' => $user->id,
            'slug' => $slug,
            'plan' => 'free',
            'expires_at' => now()->addDays(14),
        ]);

        // Send email with POS URL and credentials
        Mail::to($user->email)->send(new WelcomeToPOSMail($user, $tenant, $plainPassword));

        return $user;
    }
}

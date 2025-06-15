<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

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

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
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
    }

    protected function registered(\Illuminate\Http\Request $request, $user)
    {
        return redirect('welcome')->with('success', 'Registration successful! Welcome to your dashboard.');
    }
}

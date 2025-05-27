<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */protected function validator(array $data)
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


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
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
    
}

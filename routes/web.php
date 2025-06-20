<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyRegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SubscriptionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('/welcome'); // Ensure 'welcome.blade.php' exists
});

 Auth::routes(); // Ensure Auth is imported

Route::get('/home', [HomeController::class, 'index'])->name('home'); // Ensure HomeController exists

// PAGES LINKS
Route::get('/features', function () {
    return view('layouts.featureslayer');
})->name('features');

Route::get('/pricing', function () {
    return view('layouts.pricing');
})->name('pricing');

Route::get('/support', function () {
    return view('layouts.support');
})->name('support');

Route::post('/register-company', [CompanyRegistrationController::class, 'store'])->name('register-company');



Route::get('/subscribe', [SubscriptionController::class, 'showForm'])->name('subscribe.form');
Route::post('/paystack/checkout', [SubscriptionController::class, 'redirectToGateway'])->name('paystack.checkout');
Route::get('/paystack/callback', [SubscriptionController::class, 'handleGatewayCallback'])->name('paystack.callback');



// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

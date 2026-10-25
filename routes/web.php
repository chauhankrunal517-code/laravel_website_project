<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;


Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('userlogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [RegisterController::class, 'showRegister'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.store');

Route::middleware('auth')->group(function () {
    Route::get('/home', fn () => view('home'))->name('home');
    Route::get('/profile', fn () => view('profile'))->name('profile');

    Route::get('/Menu', fn () => view('Menu'))->name('Menu');
    Route::get('/Restaurants', fn () => view('Restaurant'))->name('Restaurants');
    Route::get('/Offers', fn () => view('offers'))->name('Offers');
});

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');


    
/*
|--------------------------------------------------------------------------
| Forgot Password Routes
|--------------------------------------------------------------------------
*/

// Display forgot password page
Route::get('/forgot-password', [
    AuthController::class,
    'forgotPassword'
])->name('forgot.password');

// Send email reset link
Route::post('/forgot-password', [
    AuthController::class,
    'sendResetLink'
])->name('password.email.custom');

// Open the reset page from the email
Route::get('/reset-password/{token}', [
    AuthController::class,
    'showResetPassword'
])->name('password.reset');

// Save the new password
Route::post('/reset-password', [
    AuthController::class,
    'resetPassword'
])->name('password.update.custom');
/*
|--------------------------------------------------------------------------
| Admin Dashboard Route
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {

    if (!session()->has('admin_id')) {
        return redirect()->route('login');
    }

    return view('admin.dashboard');

})->name('admin.dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])
        ->name('cart.remove');
});
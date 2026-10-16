<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

// Update password in the users table.
Route::post('/forgot-password/update', [AuthController::class, 'resetPassword'])
    ->name('password.update.custom');
    Route::get('/admin/dashboard', function () {

    if (!session()->has('admin_id')) {
        return redirect()->route('login');
    }

    return view('admin.dashboard');



})->name('admin.dashboard');

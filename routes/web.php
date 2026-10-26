<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Models\Food;

/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('userlogin');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Registration Routes
|--------------------------------------------------------------------------
*/

Route::get('/signup', [RegisterController::class, 'showRegister'])
    ->name('signup');

Route::post('/signup', [RegisterController::class, 'register'])
    ->name('signup.store');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/Menu', function () {
        $foods = Food::where('status', 'Available')
            ->latest()
            ->get();

        return view('Menu', compact('foods'));
    })->name('Menu');

    Route::get('/Restaurants', function () {
        return view('Restaurant');
    })->name('Restaurants');

    Route::get('/Offers', function () {
        return view('offers');
    })->name('Offers');

});

/*
|--------------------------------------------------------------------------
| Forgot Password Routes
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email.custom');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update.custom');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Route
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {

    if (!session()->has('admin_id')) {
        return redirect()->route('login');
    }

    $foods = Food::latest()->get();

    return view('admin.dashboard', compact('foods'));

})->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Admin Food Management Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/menu', [FoodController::class, 'index'])
    ->name('admin.food.index');

Route::post('/admin/food/store', [FoodController::class, 'store'])
    ->name('admin.food.store');

Route::delete('/admin/food/{id}', [FoodController::class, 'destroy'])
    ->name('admin.food.destroy');


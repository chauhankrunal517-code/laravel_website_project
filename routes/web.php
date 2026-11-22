<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CheckoutController;

use App\Models\Food;
use Barryvdh\DomPDF\Facade\Pdf;


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

    // Home
    Route::get('/home', function () {
        return view('home');
    })->name('home');


    // Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');


    // Menu
    Route::get('/Menu', function () {

        $foods = Food::where('status', 'Available')
            ->latest()
            ->get();

        return view('Menu', compact('foods'));

    })->name('Menu');


    // Restaurants
    Route::get('/Restaurants', function () {
        return view('Restaurant');
    })->name('Restaurants');


    // Offers
    Route::get('/Offers', function () {
        return view('Offers');
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

Route::patch('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');


/*
|--------------------------------------------------------------------------
| Checkout and Payment Routes
|--------------------------------------------------------------------------
*/

// Display Payment Page
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

// Place Order and Send Invoice Email
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])
    ->name('order.place');

// Payment Success Page
Route::get('/payment-success/{id}', [CheckoutController::class, 'success'])
    ->name('payment.success');


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


/*
|--------------------------------------------------------------------------
| DomPDF Test Route
|--------------------------------------------------------------------------
*/

// Test PDF generation
Route::get('/test-invoice', function () {

    $pdf = Pdf::loadHTML('
        <html>
            <body style="font-family: DejaVu Sans; text-align: center;">
                <h1 style="color: #ff6b35;">GourmetGo</h1>
                <h2>Invoice PDF Test</h2>
                <p>PDF generation working successfully!</p>
                <hr>
                <h3>Fresh Flavors, Fast Delivery.</h3>
            </body>
        </html>
    ');

    return $pdf->download('GourmetGo-Test-Invoice.pdf');

})->name('test.invoice');

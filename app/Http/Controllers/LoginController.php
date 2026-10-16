<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        // If normal user is already logged in
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // If admin is already logged in
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_type' => 'required|in:user,admin',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // =====================================
        // ADMIN LOGIN
        // =====================================

        if ($request->login_type === 'admin') {

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        return back()->withErrors([
            'email' => 'Admin email does not exist in database.'
        ])->withInput();
    }

    if (!Hash::check($request->password, $admin->password)) {
        return back()->withErrors([
            'email' => 'Admin email found, but password is incorrect.'
        ])->withInput();
    }

    session([
        'admin_id' => $admin->id,
        'admin_name' => $admin->name,
        'admin_email' => $admin->email,
    ]);

    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

        // =====================================
        // USER LOGIN
        // =====================================

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {

            return back()
                ->withErrors([
                    'email' => 'Invalid user email or password.',
                ])
                ->withInput($request->only('email', 'login_type'));
        }

        // Login normal user
        Auth::login(
            $user,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('success', 'Welcome to GourmetGo!');
    }

    // =====================================
    // LOGOUT
    // =====================================

    public function logout(Request $request)
    {
        // Logout normal user
        if (Auth::check()) {
            Auth::logout();
        }

        // Remove admin session
        $request->session()->forget([
            'admin_id',
            'admin_name',
            'admin_email',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}

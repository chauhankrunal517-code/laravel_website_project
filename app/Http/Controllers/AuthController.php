<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= USER LOGIN =================

    public function loginusercheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            session(['id' => $user->id]);

            return redirect('/home');
        }

        return back()
            ->with('error', 'Invalid Credentials')
            ->withInput();
    }


    // ================= USER LOGOUT =================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out successfully.');
    }


    // ================= ADMIN LOGIN =================

    public function logincheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            session(['id' => $admin->id]);

            return redirect('/admin');
        }

        return back()
            ->with('error', 'Invalid Credentials')
            ->withInput();
    }


    // ================= ADMIN LOGOUT =================

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login');
    }


    // ================= FORGOT PASSWORD PAGE =================

    public function forgotPassword()
    {
        return view('forgot-password');
    }


    // ================= RESET PASSWORD =================

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Find user using email
        $user = User::where('email', $request->email)->first();

        // Email not found
        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'Email address not found.',
                ])
                ->withInput();
        }

        // Update password
        $user->password = Hash::make($request->password);

        // Save to database
        $user->save();

        // Redirect to login
        return redirect()
            ->route('login')
            ->with(
                'success',
                'Password changed successfully. You can now login.'
            );
    }
}

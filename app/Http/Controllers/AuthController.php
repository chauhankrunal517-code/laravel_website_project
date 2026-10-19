<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

        return redirect()->route('admin.login');
    }

    // ================= FORGOT PASSWORD PAGE =================

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    // ================= SEND RESET LINK =================

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            // Temporarily disable password-reset throttling for testing.
            config([
                'auth.passwords.users.throttle' => 0,
            ]);

            $status = Password::broker('users')->sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with(
                    'success',
                    'Password reset link has been sent to your email.'
                );
            }

            if ($status === Password::RESET_THROTTLED) {
                return back()->withErrors([
                    'email' => 'Please wait before retrying. Try again later.',
                ])->withInput();
            }

            return back()->withErrors([
                'email' => __($status),
            ])->withInput();

        } catch (\Throwable $e) {
            report($e); 

            return back()->withErrors([
                'email' => 'Error: ' . $e->getMessage(),
            ])->withInput();
        }
    }

    // ================= SHOW RESET PASSWORD PAGE =================

    public function showResetPassword(Request $request, $token)
    {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    // ================= RESET PASSWORD =================

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Password changed successfully. You can now login.'
                );
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}
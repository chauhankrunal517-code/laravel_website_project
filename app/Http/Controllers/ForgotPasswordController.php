<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class ForgotPasswordController extends Controller
{
    // Show forgot password page
    public function showForgotPassword(): View
    {
        return view('forgot-password');
    }

    // Send password reset link to registered email
    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with(
                    'success',
                    'Password reset link has been sent to your email.'
                );
            }

            return back()
                ->withErrors([
                    'email' => __($status),
                ])
                ->withInput($request->only('email'));

        } catch (Throwable $e) {
            // Write the actual exception to storage/logs/laravel.log
            report($e);

            return back()
                ->withErrors([
                    'email' => config('app.debug')
                        ? $e->getMessage()
                        : 'Unable to send reset email. Check Laravel logs.',
                ])
                ->withInput($request->only('email'));
        }
    }

    // Display reset password page from email link
    public function showResetPassword(
        Request $request,
        string $token
    ): View {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    // Save the new password
    public function resetPassword(Request $request): RedirectResponse
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
            function (User $user, string $password): void {
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
                    'Password changed successfully. Please login.'
                );
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}

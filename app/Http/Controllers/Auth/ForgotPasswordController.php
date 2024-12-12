<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Menampilkan form untuk meminta reset password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirimkan link reset password ke email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Mengirimkan link reset password
        $status = Password::sendResetLink($request->only('email'));

        // Mengembalikan status pengiriman reset link
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Menampilkan form untuk reset password
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Memproses penggantian password
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Menangani reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Menyimpan password baru setelah di-hash
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        // Mengembalikan status reset password
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}



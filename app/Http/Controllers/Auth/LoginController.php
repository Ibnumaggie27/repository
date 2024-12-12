<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, cek role
            $role = Auth::user()->role;
            
            // Redirect berdasarkan role
            if ($role == 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('pribadi.index');
            }
        }

        // Jika login gagal
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('login');
        }

}

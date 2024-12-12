<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');  // pastikan file login.blade.php ada di resources/views/auth/
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Cek apakah pengguna adalah admin atau user dan redirect ke halaman yang sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role === 'user') {
                return redirect()->route('pribadi.index');
            }
        }
    
        return redirect()->back()->withErrors(['login' => 'Username atau password salah']);
    }
    
    

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

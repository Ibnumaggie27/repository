<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index'); // Arahkan ke file view yang sesuai
    }
    public function showChangePasswordForm()
    {
        return view('auth.change');
    }

    // Mengubah password
    public function changePassword(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'new_password' => 'required|min:8|confirmed', // Validasi untuk password baru
    ]);

    // Mengambil user yang sedang login
    $user = Auth::user();

    // Pastikan $user adalah instance dari User model
    if ($user instanceof User) {
        // Mengubah password dan menyimpannya
        $user->password = Hash::make($request->new_password);
        $user->save(); // Simpan perubahan
    } else {
        // Jika terjadi error, redirect dengan pesan error
        return redirect()->route('pribadi.index')->with('error', 'Terjadi kesalahan.');
    }

    return redirect()->route('pribadi.index')->with('success', 'Password berhasil diperbarui!');
}


}

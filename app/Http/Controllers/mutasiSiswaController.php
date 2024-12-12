<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class mutasiSiswaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian
        $query = $request->input('query');
    
        // Mulai query
        $siswas = Siswa::query(); // Mulai query dengan model Siswa
    
        // Tambahkan filter pencarian jika ada input
        if ($query) {
            $siswas = $siswas->where('nama', 'like', "%{$query}%")
                             ->orWhere('nisn', 'like', "%{$query}%")
                             ->orWhere('kelas', 'like', "%{$query}%");
        }
    
        // Tambahkan paginasi
        $siswas = $siswas->paginate(10)->appends(request()->query()); // Tambahkan query string untuk menjaga input pencarian
    
        // Hitung data mutasi siswa berdasarkan role
        $masuk = Siswa::where('status', 'masuk')->count();
        $keluar = Siswa::where('status', 'keluar')->count();
        $lulus = Siswa::where('status', 'lulus')->count();
    
        // Kirim data ke view
        return view('admin.mutasiSiswa.index', compact('masuk', 'keluar', 'lulus', 'siswas'));
    }
    
    public function create()
    {
        return view('admin.mutasiSiswa.create'); // Sesuaikan dengan path view Anda
    }
}

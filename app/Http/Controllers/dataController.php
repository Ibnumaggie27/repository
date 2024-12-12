<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataGuru;

class dataController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $user = auth()->user(); // Ambil user yang login
    
        // Ambil data guru berdasarkan relasi di model User
        $dataGurus = DataGuru::query();
    
        // Filter data berdasarkan user yang login
        if ($user->dataGuru) { // Pastikan user memiliki data guru terkait
            $dataGurus = $dataGurus->where('nip', $user->dataGuru->nip); // Cocokkan NIP
        }
    
        // Jika ada pencarian, tambahkan filter pencarian
        if ($query) {
            $dataGurus = $dataGurus->where('nama', 'like', "%{$query}%");
        }
    
        // Paginasi data yang difilter
        $dataGurus = $dataGurus->paginate(10)->appends(request()->query());
    
        return view('user.data.index', compact('dataGurus'));
    }
    


    // Method untuk menampilkan form create data
    public function create()
    {
        return view('user.data.create');  // Pastikan view 'user.data.create' ada
    }
    public function show($id)
{
    $dataGurus = DataGuru::findOrFail($id);
    return view('user.data.detail', compact('dataGurus'));
}
}

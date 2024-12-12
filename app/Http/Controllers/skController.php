<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sk;
use App\Models\DataGuru;
use Illuminate\Support\Facades\Storage;

class skController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian dari request
        $query = $request->input('query');
        
        // Mulai query dengan model SK
        $sks = Sk::with('guru'); // Pastikan data guru dimuat dengan eager loading
    
        // Jika ada input pencarian, tambahkan filter
        if ($query) {
            $sks = $sks->where('nama', 'like', "%{$query}%");
        }
    
        // Paginasi hasil query
        $sks = $sks->paginate(10)->appends(request()->query()); // Tambahkan query string ke pagination
        
        // Kirim data ke view
        return view('admin.sk.index', compact('sks'));
    }
    
    
    public function index1(Request $request)
{
    // Ambil input pencarian dari request
    $query = $request->input('query');
    
    // Ambil id_guru dari user yang sedang login
    $idGuru = auth()->user()->dataGuru?->id; // Relasi user ke data_guru

    // Jika id_guru tidak ditemukan, kembalikan error atau data kosong
    if (!$idGuru) {
        return view('user.sk.index', [
            'sks' => collect([]) // Kirimkan koleksi kosong jika tidak ada id_guru
        ]);
    }

    // Query data SK berdasarkan id_guru
    $sks = Sk::with('guru') // Eager loading relasi guru
        ->where('id_guru', $idGuru) // Filter berdasarkan id_guru
        ->when($query, function ($queryBuilder, $query) {
            return $queryBuilder->where('nama', 'like', "%{$query}%");
        })
        ->paginate(10)
        ->appends(request()->query());

    // Kirimkan data ke view
    return view('user.sk.index', compact('sks'));
}

    
    public function create()
{
    $gurus = DataGuru::all(); // Ambil semua data guru
    return view('admin.sk.create', compact('gurus'));
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'file' => 'required|file|max:2048',
            'id_guru' => 'required|exists:data_guru,id', 
        ]);

        $file = $request->file('file');
        $filePath = $file->store('uploads/sk', 'public');

        Sk::create([
            'nama' => $request->nama,
            'file_path' => $filePath,
            'id_guru' => $validatedData['id_guru'],
        ]);

        return redirect()->route('admin.sk.index')->with('success', 'Surat Keterangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sk = Sk::findOrFail($id);
        $gurus = DataGuru::all(); // Ambil data guru untuk pilihan di form
        return view('admin.sk.edit', compact('sk', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $sk = Sk::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,txt',
            'id_guru' => 'required|exists:data_guru,id',
        ]);

        // Update nama
        $sk->nama = $validated['nama'];

        // Jika ada file baru, proses file upload
        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::delete('public/' . $sk->file_path);

            // Upload file baru
            $sk->file_path = $request->file('file')->store('uploads', 'public');
        }

        // Update id_guru
        $sk->id_guru = $validated['id_guru'];

        // Simpan perubahan
        $sk->save();

        return redirect()->route('admin.sk.index');
    }

    public function destroy($id)
    {
        // Cari sk berdasarkan ID
        $sk = Sk::findOrFail($id);
    
        // Cek apakah sk memiliki file dan file tersebut ada di penyimpanan
        if ($sk->file_path && Storage::exists('public/' . $sk->file_path)) {
            // Hapus file dari penyimpanan
            Storage::delete('public/' . $sk->file_path);
        }
    
        // Hapus sk dari database
        $sk->delete();
    
        // Redirect setelah penghapusan
        return redirect()->route('admin.sk.index')->with('success', 'sk beserta file berhasil dihapus.');
    }
}

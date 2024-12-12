<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // Menampilkan daftar soal
    public function index(Request $request)
    {
        $query = $request->input('query');
        $soals = soal::query();
    
        if ($query) {
            $soals = $soals->where('nama', 'like', "%{$query}%");
        }
        $soals = Soal::paginate(10)->appends(request()->query()); // Mengambil semua data soal
        return view('admin.soal.index', compact('soals'));
    }
    public function index1(Request $request)
    {
        $query = $request->input('query');
        $soals = soal::query();
    
        if ($query) {
            $soals = $soals->where('nama', 'like', "%{$query}%");
        }
        $soals = Soal::paginate(10)->appends(request()->query()); // Mengambil semua data soal
        return view('user.soal.index', compact('soals'));
    }

    // Menampilkan form untuk menambahkan soal
    public function create()
    {
        return view('admin.soal.create'); // Sesuaikan dengan struktur folder view
    }

    // Menyimpan soal baru
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'file' => 'required|file|max:20480', // Validasi file dengan ukuran maksimal 20 MB dan tipe file yang diterima
    ]);

    // Simpan file ke dalam storage
    $filePath = $request->file('file')->store('uploads/soal', 'public'); // Menyimpan file ke folder public

    // Simpan data soal ke dalam database
    Soal::create([
        'nama' => $request->nama,
        'file_path' => $filePath, // Menyimpan path file yang telah di-upload
    ]);

    // Redirect ke halaman daftar soal dengan pesan sukses
    return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil ditambahkan.');
}

    

    // Menampilkan form edit soal
    public function edit($id)
    {
        $soal = Soal::findOrFail($id); // Cari soal berdasarkan ID atau kembalikan 404 jika tidak ditemukan
        return view('admin.soal.edit', compact('soal'));
    }

    // Memperbarui soal
    public function update(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'file' => 'nullable|file|max:20480', // File tidak wajib diunggah saat update
        ]);

        // Update file jika ada file baru yang diunggah
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('soals', 'public');
            $soal->file = $filePath;
        }

        $soal->nama = $request->nama;
        $soal->save();

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    // Menghapus soal
    public function destroy($id)
{
    // Cari soal berdasarkan ID
    $soal = Soal::findOrFail($id);

    // Cek apakah soal memiliki file dan file tersebut ada di penyimpanan
    if ($soal->file_path && Storage::exists('public/' . $soal->file_path)) {
        // Hapus file dari penyimpanan
        Storage::delete('public/' . $soal->file_path);
    }

    // Hapus soal dari database
    $soal->delete();

    // Redirect setelah penghapusan
    return redirect()->route('admin.soal.index')->with('success', 'Soal beserta file berhasil dihapus.');
}
}

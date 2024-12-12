<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\absensi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class absenController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');
        $absensis = absensi::query();
    
        if ($query) {
            $absensis = $absensis->where('nama', 'like', "%{$query}%");
        }
        // Mengambil semua data guru dari tabel data_guru
        $absensis = $absensis->paginate(10)->appends(request()->query()); // Mengambil data absensi beserta data siswa terkait
    return view('admin.absen.index', compact('absensis'));
}

    public function create()
{
    return view('admin.absen.create'); // Sesuaikan dengan path view Anda
}

public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('uploads/absensi', 'public');

        absensi::create([
            'nama' => $request->nama,
            'file_path' => $filePath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.absen.index')->with('success', 'Absensi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Find the absensi record by id
        $absensi = Absensi::findOrFail($id);
        
        // Pass the record to the edit view
        return view('admin.absen.edit', compact('absensi'));
    }

    public function update(Request $request, $id)
{
    // Validate the input data
    $request->validate([
        'nama' => 'required|string|max:50',
        'file' => 'nullable|file|max:2048', // Make file optional
    ]);

    // Find the absensi record by id
    $absensi = Absensi::findOrFail($id);

    // Update the name
    $absensi->nama = $request->input('nama');

    // Check if a new file is uploaded
    if ($request->hasFile('file')) {
        // Delete old file if exists
        if ($absensi->file_path && Storage::exists('public/' . $absensi->file_path)) {
            Storage::delete('public/' . $absensi->file_path);
        }

        // Store new file and update the file path
        $file = $request->file('file');
        $absensi->file_path = $file->storeAs('absensi', $file->getClientOriginalName(), 'public');
    }

    // Save the updated absensi record
    $absensi->save();

    // Redirect with success message
    return redirect()->route('admin.absen.index')->with('success', 'Absensi updated successfully!');
}

public function destroy($id)
    {
        // Cari absen berdasarkan ID
        $absen = absensi::findOrFail($id);
    
        // Cek apakah absen memiliki file dan file tersebut ada di penyimpanan
        if ($absen->file_path && Storage::exists('public/' . $absen->file_path)) {
            // Hapus file dari penyimpanan
            Storage::delete('public/' . $absen->file_path);
        }
    
        // Hapus absen dari database
        $absen->delete();
    
        // Redirect setelah penghapusan
        return redirect()->route('admin.absen.index')->with('success', 'absen beserta file berhasil dihapus.');
    }

}

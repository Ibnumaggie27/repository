<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataNilai;
use Illuminate\Support\Facades\Storage;

class dataNilaiController extends Controller
{
        public function index(Request $request)
    {
        $query = $request->input('query');
        $nilais = DataNilai::query();
    
        if ($query) {
            $nilais = $nilais->where('nama', 'like', "%{$query}%");
        }
        // Mengambil semua data guru dari tabel data_guru
        $nilais = $nilais->paginate(10)->appends(request()->query());
        return view('admin.dataNilai.index', compact('nilais'));
    }

    public function create()
    {
        return view('admin.dataNilai.create'); // Sesuaikan dengan path view Anda
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('uploads/nilai', 'public');

        DataNilai::create([
            'nama' => $request->nama,
            'file_path' => $filePath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dataNilai.index')->with('success', 'Data Nilai berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        // Find the absensi record by id
        $nilais = DataNilai::findOrFail($id);
        
        // Pass the record to the edit view
        return view('admin.dataNilai.edit', compact('nilais'));
    }

    public function update(Request $request, $id)
{
    // Validate the input data
    $request->validate([
        'nama' => 'required|string|max:50',
        'file' => 'nullable|file|max:2048', // Make file optional
    ]);

    // Find the absensi record by id
    $nilais = DataNilai::findOrFail($id);

    // Update the name
    $nilais->nama = $request->input('nama');

    // Check if a new file is uploaded
    if ($request->hasFile('file')) {
        // Delete old file if exists
        if ($nilais->file_path && Storage::exists('public/' . $nilais->file_path)) {
            Storage::delete('public/' . $nilais->file_path);
        }

        // Store new file and update the file path
        $file = $request->file('file');
        $nilais->file_path = $file->storeAs('nilai', $file->getClientOriginalName(), 'public');
    }

    // Save the updated absensi record
    $nilais->save();

    // Redirect with success message
    return redirect()->route('admin.dataNilai.index')->with('success', 'Nilai updated successfully!');
}

    public function destroy($id)
    {
        // Cari nilai berdasarkan ID
        $nilai = DataNilai::findOrFail($id);
    
        // Cek apakah nilai memiliki file dan file tersebut ada di penyimpanan
        if ($nilai->file_path && Storage::exists('public/' . $nilai->file_path)) {
            // Hapus file dari penyimpanan
            Storage::delete('public/' . $nilai->file_path);
        }
    
        // Hapus nilai dari database
        $nilai->delete();
    
        // Redirect setelah penghapusan
        return redirect()->route('admin.dataNilai.index')->with('success', 'nilai beserta file berhasil dihapus.');
    }

}

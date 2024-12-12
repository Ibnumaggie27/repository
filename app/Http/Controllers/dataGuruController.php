<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Imports\DataGuruImport;
use Maatwebsite\Excel\Facades\Excel;

class DataGuruController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $dataGurus = DataGuru::query();
    
        if ($query) {
            $dataGurus = $dataGurus->where('nama', 'like', "%{$query}%")
                             ->orWhere('nip', 'like', "%{$query}%");
        }
        // Mengambil semua data guru dari tabel data_guru
        $dataGurus = $dataGurus->paginate(10)->appends(request()->query());

        // Mengirimkan data ke view
        return view('admin.dataGuru.index', compact('dataGurus'));
    }
    public function create()
    {
        return view('admin.dataGuru.create'); 
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:255|unique:data_guru,nip',
        'tempat_lahir' => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'jk' => 'required|in:l,p', // Validasi jenis kelamin
        'agama' => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu', // Validasi agama
        'alamat' => 'required|string',
        'no_hp' => 'nullable|string|max:15', // Optional phone number
        'email' => 'nullable|email|max:100', // Optional email
        'tahun_masuk' => 'required|integer',
        'status' => 'required|in:aktif,nonaktif,pensiun', // Validasi status
        'gambar_ijazah' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        'gambar_ktp' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
    ]);

    DB::transaction(function () use ($request) {
        // Simpan data ke tabel data_guru
        $dataGuru = DataGuru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'tahun_masuk' => $request->tahun_masuk,
            'status' => $request->status,
            'gambar_ijazah' => $request->file('gambar_ijazah') 
                ? $request->file('gambar_ijazah')->store('uploads/ijazah', 'public') 
                : null,
            'gambar_ktp' => $request->file('gambar_ktp') 
                ? $request->file('gambar_ktp')->store('uploads/ktp', 'public') 
                : null,
        ]);

        // Tambahkan data ke tabel users
        User::create([
            'nama'=>$request->nama,
            'username' => $request->nip, // Username dari NIP
            'password' => Hash::make('123456'), // Password default
        ]);
    });

    return redirect()->route('admin.dataGuru.index')->with('success', 'Data guru dan akun berhasil dibuat.');
}

public function edit($id)
{
    $guru = DataGuru::findOrFail($id);
    return view('admin.dataGuru.edit', compact('guru'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:255|unique:data_guru,nip,' . $id,
        'tempat_lahir' => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'jk' => 'required|in:l,p',
        'agama' => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
        'alamat' => 'required|string',
        'no_hp' => 'nullable|string|max:15',
        'email' => 'nullable|email|max:100',
        'tahun_masuk' => 'required|integer',
        'status' => 'required|in:aktif,nonaktif,pensiun',
        'gambar_ijazah' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        'gambar_ktp' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
    ]);

    $guru = DataGuru::findOrFail($id);

    DB::transaction(function () use ($request, $guru) {
        // Update data guru
        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'tahun_masuk' => $request->tahun_masuk,
            'status' => $request->status,
            'gambar_ijazah' => $request->file('gambar_ijazah') 
                ? $request->file('gambar_ijazah')->store('uploads/ijazah', 'public') 
                : $guru->gambar_ijazah, // Preserve old file if not updated
            'gambar_ktp' => $request->file('gambar_ktp') 
                ? $request->file('gambar_ktp')->store('uploads/ktp', 'public') 
                : $guru->gambar_ktp, // Preserve old file if not updated
        ]);
    });

    return redirect()->route('admin.dataGuru.index')->with('success', 'Data guru berhasil diperbarui.');
}

public function destroy($id)
{
    // Cari dataGuru berdasarkan ID
    $dataGuru = DataGuru::findOrFail($id);

    // Hapus file gambar ijazah jika ada
    if ($dataGuru->gambar_ijazah && Storage::exists('public/' . $dataGuru->gambar_ijazah)) {
        Storage::delete('public/' . $dataGuru->gambar_ijazah);
    }

    // Hapus file gambar KTP jika ada
    if ($dataGuru->gambar_ktp && Storage::exists('public/' . $dataGuru->gambar_ktp)) {
        Storage::delete('public/' . $dataGuru->gambar_ktp);
    }

    // Hapus data pengguna di tabel users
    $user = User::where('username', $dataGuru->nip)->first();
    if ($user) {
        $user->delete();
    }

    // Hapus dataGuru dari database
    $dataGuru->delete();

    // Redirect setelah penghapusan
    return redirect()->route('admin.dataGuru.index')->with('success', 'Data Guru, file terkait, dan akun pengguna berhasil dihapus.');
}
public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Validasi file
        ]);

        try {
            Excel::import(new DataGuruImport, $request->file('file'));
            return redirect()->route('admin.dataGuru.index')->with('success', 'Data guru berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


}


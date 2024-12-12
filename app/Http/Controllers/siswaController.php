<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;

class SiswaController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');
    $siswas = Siswa::query();

    if ($query) {
        $siswas = $siswas->where('nama', 'like', "%{$query}%")
                         ->orWhere('nisn', 'like', "%{$query}%")
                         ->orWhere('kelas', 'like', "%{$query}%");
    }

    // Menambahkan paginasi dan appends query parameter
    $siswas = $siswas->paginate(10)->appends(request()->query());

    return view('admin.siswa.index', compact('siswas'));
}


    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'nis' => 'required|string|max:15|unique:siswas,nis',
        'nisn' => 'required|string|max:15|unique:siswas,nisn',
        'tempatLahir' => 'required|string|max:50',
        'tanggalLahir' => 'required|date',
        'jk' => 'required|in:l,p', // Validasi jenis kelamin
        'agama' => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
        'alamat' => 'required|string',
        'noHp' => 'required|string|max:15',
        'namaOrangTua' => 'required|string|max:100',
        'pekerjaanOrangTua' => 'required|string|max:50',
        'kelas' => 'required|in:1,2,3,4,5,6', // Validasi kelas
        'tahunMasuk' => 'required|integer',
        'status' => 'required|in:masuk,keluar,lulus', // Validasi status
    ]);

    // Simpan data ke database
    Siswa::create($request->only([
        'nama','nis', 'nisn', 'tempatLahir', 'tanggalLahir', 'jk', 'agama', 'alamat',
        'noHp', 'namaOrangTua', 'pekerjaanOrangTua', 'kelas', 'tahunMasuk', 'status'
    ]));

    // Redirect dengan pesan sukses
    return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
}

public function edit($id)
{
    $siswa = Siswa::findOrFail($id);
    return view('admin.siswa.edit', compact('siswa'));
}

public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'nis' => "required|string|max:15|unique:siswas,nis,{$id}",
        'nisn' => "required|string|max:15|unique:siswas,nisn,{$id}",
        'tempatLahir' => 'required|string|max:50',
        'tanggalLahir' => 'required|date',
        'jk' => 'required|in:l,p', // Validasi jenis kelamin
        'agama' => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
        'alamat' => 'required|string',
        'noHp' => 'required|string|max:15',
        'namaOrangTua' => 'required|string|max:100',
        'pekerjaanOrangTua' => 'required|string|max:50',
        'kelas' => 'required|in:1,2,3,4,5,6', // Validasi kelas
        'tahunMasuk' => 'required|integer',
        'status' => 'required|in:masuk,keluar,lulus', // Validasi status
    ]);

    // Update data
    $siswa->update($request->only([
        'nama', 'nis', 'nisn', 'tempatLahir', 'tanggalLahir', 'jk', 'agama', 'alamat',
        'noHp', 'namaOrangTua', 'pekerjaanOrangTua', 'kelas', 'tahunMasuk', 'status'
    ]));

    // Redirect dengan pesan sukses
    return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
}


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv', // Validasi file
        ]);

        // Import file
        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diimport.');
    }

        public function export()
            {
                return Excel::download(new SiswaExport, 'data_siswa_per_kelas.xlsx');
            }
}

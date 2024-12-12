<?php

namespace App\Imports;

use App\Models\DataGuru;
use Maatwebsite\Excel\Concerns\ToModel;

class DataGuruImport implements ToModel
{
    public function model(array $row)
{
    return new DataGuru([
        'nama' => $row['Nama'],
        'nip' => $row['nip'], // Sesuaikan dengan nama kolom di Excel
        'tempat_lahir' => $row['Tempat Lahir'],
        'tanggal_lahir' => \Carbon\Carbon::createFromFormat('d-m-Y', $row['Tanggal Lahir'])->format('Y-m-d'),
        'jk' => strtolower($row['Jenis Kelamin']) == 'p' ? 'p' : 'l',
        'agama' => strtolower($row['Agama']),
        'alamat' => $row['Alamat'],
        'no_hp' => $row['No HP'],
        'email' => $row['Email'],
        'tahun_masuk' => $row['Tahun Masuk'],
        'status' => strtolower($row['status']) == 'aktif' ? 'aktif' : 'nonaktif', // Sesuaikan dengan status yang ada di Excel
        'gambar_ijazah' => $row['Gambar Ijazah'] ?? null, // Menambahkan pengecekan null
        'gambar_ktp' => $row['Gambar KTP'] ?? null, // Menambahkan pengecekan null
    ]);
}

}

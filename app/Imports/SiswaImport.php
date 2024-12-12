<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\ValidationException;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validasi data sebelum disimpan ke database
        if (empty($row['nama']) || empty($row['nis']) || empty($row['nisn'])) {
            throw ValidationException::withMessages(['error' => 'Kolom nama, NIS, dan NISN wajib diisi.']);
        }

        return new Siswa([
            'nis' => $row['nis'],                         // Kolom NIS
            'nisn' => $row['nisn'],                       // Kolom NISN
            'nama' => $row['nama'],                       // Kolom Nama
            'tempatLahir' => $row['tempat_lahir'] ?? '',  // Default kosong jika tidak ada data
            'tanggalLahir' => $row['tanggal_lahir'],      // Kolom Tanggal Lahir
            'jk' => strtolower($row['jk']),              // Pastikan huruf kecil sesuai enum ('l', 'p')
            'agama' => strtolower($row['agama']),        // Pastikan huruf kecil sesuai enum
            'alamat' => $row['alamat'],                  // Kolom Alamat
            'noHp' => $row['no_hp'],                     // Kolom No HP
            'namaOrangTua' => $row['nama_orang_tua'],     // Kolom Nama Orang Tua
            'pekerjaanOrangTua' => $row['pekerjaan_orang_tua'], // Kolom Pekerjaan Orang Tua
            'kelas' => $row['kelas'],                    // Kolom Kelas
            'tahunMasuk' => $row['tahun_masuk'],         // Kolom Tahun Masuk
            'status' => strtolower($row['status']),      // Pastikan huruf kecil sesuai enum
        ]);
    }
}

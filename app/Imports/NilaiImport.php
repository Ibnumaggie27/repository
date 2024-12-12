<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\DataNilai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek apakah nama siswa ada di tabel siswas
        $siswa = Siswa::where('nama', $row['nama'])->first();

        // Jika siswa ditemukan, ambil ID-nya, jika tidak, tidak menyimpan data
        if ($siswa) {
            // Gunakan updateOrCreate untuk menghindari duplikasi entri berdasarkan siswa_id
            return DataNilai::updateOrCreate(
                ['siswa_id' => $siswa->id], // Kunci pencarian berdasarkan siswa_id
                [
                    'matematika' => $row['matematika'],
                    'bahasaIndonesia' => $row['bahasa_indonesia'],
                    'ppkn' => $row['ppkn'],
                ]
            );
        }

        // Jika siswa tidak ditemukan, kembalikan null atau bisa menambahkan logika lainnya
        return null;
    }
}


<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek apakah nama siswa ada di tabel siswas
        $siswa = Siswa::where('nama', $row['nama'])->first();

        // Jika siswa ditemukan, ambil ID-nya, jika tidak, tidak menyimpan data
        if ($siswa) {
            return new Absensi([
                'siswa_id' => $siswa->id,  // Simpan ID siswa
                'hadir' => $row['hadir'],
                'sakit' => $row['sakit'],
                'izin' => $row['izin'],
                'alpa' => $row['alpa'],
            ]);
        }

        // Jika siswa tidak ditemukan, kembalikan null atau bisa menambahkan logika lainnya
        return null;
    }
}

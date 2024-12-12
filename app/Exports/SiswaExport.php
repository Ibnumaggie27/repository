<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SiswaExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];
        $kelasList = \App\Models\Siswa::distinct()->orderBy('kelas')->pluck('kelas'); // Urutkan kelas berdasarkan nilai kelas

        foreach ($kelasList as $kelas) {
            $sheets[] = new SiswaPerKelasExport($kelas); // Tambahkan sheet untuk setiap kelas
        }

        return $sheets;
    }
}


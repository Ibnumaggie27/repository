<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NilaiTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        // Ambil semua kelas yang ada dan urutkan secara numerik
        $kelasList = Siswa::distinct()->pluck('kelas')->sort()->values();
        
        // Array untuk menampung semua sheet per kelas
        $sheets = [];
        
        foreach ($kelasList as $kelas) {
            // Ambil siswa berdasarkan kelas
            $siswas = Siswa::where('kelas', $kelas)->get();
            
            // Tambahkan sheet untuk setiap kelas
            $sheets[] = new NilaiTemplateSheet($siswas, $kelas);
        }

        return $sheets;
    }
}






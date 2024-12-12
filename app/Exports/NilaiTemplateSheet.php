<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class NilaiTemplateSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $siswas;
    protected $kelas;

    // Constructor menerima data siswa dan kelas
    public function __construct($siswas, $kelas)
    {
        $this->siswas = $siswas;
        $this->kelas = $kelas;
    }

    // Mengembalikan data siswa dalam bentuk koleksi
    public function collection()
    {
        $data = [];
        
        foreach ($this->siswas as $siswa) {
            $data[] = [
                'nama' => $siswa->nama,
                'matematika' => null, // Kolom untuk nilai matematika
                'bahasaIndonesia' => null, // Kolom untuk nilai bahasa Indonesia
                'ppkn' => null  // Kolom untuk nilai PPKN
            ];
        }

        return collect($data);
    }

    // Header untuk setiap sheet
    public function headings(): array
    {
        return [
            'Nama',
            'Matematika',
            'Bahasa Indonesia',
            'PPKN'
        ];
    }

    // Nama sheet sesuai dengan kelas
    public function title(): string
    {
        return 'Kelas ' . $this->kelas; // Nama sheet per kelas
    }
}




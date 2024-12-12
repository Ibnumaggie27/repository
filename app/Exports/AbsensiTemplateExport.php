<?php

// app/Exports/AbsensiTemplateExport.php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class AbsensiTemplateExport implements FromCollection, WithHeadings, WithStrictNullComparison
{
    protected $siswas;

    public function __construct($siswas)
    {
        $this->siswas = $siswas;
    }

    public function collection()
    {
        $data = [];
        
        foreach ($this->siswas as $siswa) {
            $data[] = [
                'nama' => $siswa->nama,
                'hadir' => null, // Kolom untuk hadir
                'sakit' => null, // Kolom untuk sakit
                'izin' => null,  // Kolom untuk izin
                'alpa' => null   // Kolom untuk alpa
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Hadir',
            'Sakit',
            'Izin',
            'Alpa'
        ];
    }
}


<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'NIS',
            'NISN',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Alamat',
            'No HP',
            'Nama Orang Tua',
            'Pekerjaan Orang Tua',
            'Kelas',
            'Tahun Masuk',
            'Status'
        ];
    }
}


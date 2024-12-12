<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'nip',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Alamat',
            'No HP',
            'Email',
            'Tahun Masuk',
            'Status'
        ];
    }
}


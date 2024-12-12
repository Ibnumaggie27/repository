<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SiswaPerKelasExport implements FromCollection, WithHeadings, WithTitle
{
    protected $kelas;

    public function __construct($kelas)
    {
        $this->kelas = $kelas;
    }

    public function collection()
    {
        // Mengambil data berdasarkan kelas dan memilih kolom yang diperlukan
        return Siswa::where('kelas', $this->kelas)
                    ->select(
                        'nis',
                        'nisn',
                        'nama',
                        'tempatLahir',
                        'tanggalLahir',
                        'jk',
                        'agama',
                        'alamat',
                        'noHp',
                        'namaOrangTua',
                        'pekerjaanOrangTua',
                        'tahunMasuk',
                        'status'
                    )
                    ->get();
    }

    public function headings(): array
    {
        // Menambahkan semua kolom sesuai dengan migrasi
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
            'Tahun Masuk',
            'Status',
        ];
    }

    public function title(): string
    {
        // Menentukan judul untuk setiap sheet berdasarkan kelas
        return "Kelas " . $this->kelas;
    }
}

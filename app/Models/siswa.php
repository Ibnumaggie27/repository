<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas'; // Tipe data id adalah bigint

    // Kolom yang diizinkan untuk diisi melalui mass assignment
    protected $fillable = [
        'nis', 'nisn', 'nama', 'tempatLahir', 'tanggalLahir', 'jk', 
        'agama', 'alamat', 'noHp', 'namaOrangTua', 'pekerjaanOrangTua', 
        'kelas', 'tahunMasuk', 'status'
    ];

    // Boot method untuk menangani event model
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNilai extends Model
{
    use HasFactory;
    protected $table = 'data_nilais';
    protected $primaryKey = 'id'; // Tetapkan kolom id sebagai primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'bigint';
    protected $fillable = ['nama', 'file_path'];

    // Pastikan created_at dan updated_at otomatis di-cast sebagai datetime
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($siswa) {
            // Membuat ID dengan 6 angka unik
            $siswa->id = self::generateUniqueId();
        });
    }

    // Method untuk membuat ID unik
    private static function generateUniqueId()
    {
        do {
            $id = random_int(100000, 999999); // Generate 6 angka acak
        } while (self::where('id', $id)->exists()); // Pastikan tidak ada duplikat
        return $id;
    }
}

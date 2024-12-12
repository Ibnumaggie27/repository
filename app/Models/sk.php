<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    use HasFactory;

    protected $table = 'sks';
    protected $primaryKey = 'id'; // Tetapkan kolom id sebagai primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'bigint';

    // Hanya kolom yang diizinkan untuk diisi
    protected $fillable = ['nama', 'file_path', 'id_guru'];

    // Pastikan created_at dan updated_at otomatis di-cast sebagai datetime
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke model DataGuru
    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'id_guru');
    }
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

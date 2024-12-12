<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory;

    protected $table = 'data_guru'; // Nama tabel
    protected $fillable = [
     'nip',
    'nama',
    'tempat_lahir',
    'tanggal_lahir',
    'jk',
    'agama',
    'alamat',
    'no_hp',
    'email',
    'tahun_masuk',
    'status',
    'gambar_ijazah',
    'gambar_ktp',]; // Field yang dapat diisi

    public function sks()
    {
        return $this->hasMany(Sk::class, 'id_guru');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'username', 'nip');
    }
}

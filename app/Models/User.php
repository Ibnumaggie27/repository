<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel

    protected $fillable = ['nama', 'username', 'password', 'role', 'email']; // Field yang dapat diisi

    /**
     * Relasi dengan tabel data_guru (Inverse of One-to-One).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataGuru()
    {
        return $this->belongsTo(DataGuru::class, 'username', 'nip');
    }

    /**
     * Booting model User untuk menyinkronkan email dengan data_guru.
     */
    protected static function boot()
    {
        parent::boot();

        // Event untuk mengisi email dari data_guru
        static::saving(function ($user) {
            if ($user->dataGuru) {
                $user->email = $user->dataGuru->email; // Ambil email dari data_guru
            }
        });
    }

    /**
     * Mendapatkan nama dari dataGuru jika tersedia, atau nama asli dari User.
     *
     * @return string
     */
    public function getNamaLengkapAttribute()
    {
        return $this->dataGuru?->nama ?? $this->nama;
    }

    /**
     * Cek apakah user adalah admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah user biasa.
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'admin', // Username untuk admin
            'username' => 'admin', // Username untuk admin
            'password' => Hash::make('admin123'), // Password (hashed)
            'email' => 'admin@gmail.com', // Role sebagai admin
            'role' => 'admin', // Role sebagai admin
            'created_at' => now(), // Timestamp created_at
            'updated_at' => now(), // Timestamp updated_at
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_guru', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nip', 20)->unique(); // NIP guru (unik)
            $table->string('nama', 100); // Nama guru
            $table->string('tempat_lahir', 50); // Tempat lahir
            $table->date('tanggal_lahir'); // Tanggal lahir
            $table->enum('jk', ['l', 'p']); // Jenis kelamin
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']); // Agama
            $table->text('alamat'); // Alamat
            $table->string('no_hp', 15)->nullable(); // Nomor HP (opsional)
            $table->string('email', 100)->nullable(); // Email (opsional)
            $table->year('tahun_masuk'); // Tahun masuk
            $table->enum('status', ['aktif', 'nonaktif', 'pensiun'])->default('aktif'); // Status kepegawaian
            $table->string('gambar_ijazah', 255)->nullable(); // Path ke gambar ijazah (opsional)
            $table->string('gambar_ktp', 255)->nullable(); // Path ke gambar KTP (opsional)
            $table->timestamps();// Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_guru');
    }
}


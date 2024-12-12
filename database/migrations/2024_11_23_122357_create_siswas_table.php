<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis',15)->unique();
            $table->string('nisn',15)->unique();
            $table->string('nama',100);
            $table->string('tempatLahir',50);
            $table->date('tanggalLahir');
            $table->enum('jk',['l','p']);
            $table->enum('agama',['islam','kristen','katolik','hindu','buddha','konghucu']);
            $table->text('alamat');
            $table->string('noHp',15);
            $table->string('namaOrangTua',100);
            $table->string('pekerjaanOrangTua',50);
            $table->enum('kelas',['1','2','3','4','5','6']);
            $table->year('tahunMasuk');
            $table->enum('status', ['masuk', 'keluar','lulus'])->default('masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}

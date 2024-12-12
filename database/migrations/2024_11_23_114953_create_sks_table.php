<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sks', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->unsigned();
            $table->string('nama',50);
            $table->string('file_path');
            $table->unsignedBigInteger('id_guru'); // Tambahkan kolom id_guru
            $table->foreign('id_guru') // Definisikan relasi foreign key
                  ->references('id')->on('data_guru')
                  ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['nama', 'created_at'], 'unique_nama_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sks');
    }
}

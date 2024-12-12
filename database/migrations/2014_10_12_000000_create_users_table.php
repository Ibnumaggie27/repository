<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->string('nama'); 
        $table->string('username')->unique(); // Username
        $table->string('password'); // Password
        $table->string('email', 100)->nullable()->unique();
        $table->enum('role', ['admin', 'user'])->default('user'); // Role
        $table->timestamps(); // Kolom created_at dan updated_at
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

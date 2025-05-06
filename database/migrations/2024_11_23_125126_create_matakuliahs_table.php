<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatakuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->id(); // kolom id
            $table->string('kode_matakuliah')->unique(); // kode matakuliah
            $table->string('nama_matakuliah'); // nama matakuliah
            $table->string('type_matakuliah'); // type matakuliah
            $table->string('semester'); // semester
            $table->integer('sks'); // sks
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matakuliahs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamsTable extends Migration
{
    public function up(): void
    {
        Schema::create('jams', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jam');
            $table->string('jamnya');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jams');
    }
}

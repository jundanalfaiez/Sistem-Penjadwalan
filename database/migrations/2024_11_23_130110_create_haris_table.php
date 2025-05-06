<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('haris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_hari')->unique();
            $table->string('hari');
            $table->timestamps();
        });
    }
    
    
    public function down()
    {
        Schema::dropIfExists('haris');
    }
    
};

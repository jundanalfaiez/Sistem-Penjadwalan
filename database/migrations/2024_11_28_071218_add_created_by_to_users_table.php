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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('role'); // Tambahkan kolom created_by
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Relasi ke tabel users
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by']); // Hapus foreign key
            $table->dropColumn('created_by'); // Hapus kolom created_by
        });
    }
    
};

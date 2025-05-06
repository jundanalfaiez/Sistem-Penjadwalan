<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tables = ['matakuliahs', 'ruangans', 'dosens', 'periodes', 'jadwals', 'haris', 'jams'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('created_by')->after('id')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        $tables = ['matakuliahs', 'ruangans', 'dosens', 'periodes', 'jadwals', 'haris', 'jams'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign([$table->getTable() . '_created_by_foreign']);
                $table->dropColumn('created_by');
            });
        }
    }
};
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('tables', function (Blueprint $table) {
//             //
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('tables', function (Blueprint $table) {
//             //
//         });
//     }
// };

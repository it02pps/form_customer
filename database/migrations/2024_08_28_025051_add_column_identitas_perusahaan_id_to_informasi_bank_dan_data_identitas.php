<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('informasi_bank', function (Blueprint $table) {
            $table->unsignedBigInteger('identitas_perusahaan_id')->after('id');
            $table->foreign('identitas_perusahaan_id')->references('id')->on('identitas_perusahaan')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('data_identitas', function (Blueprint $table) {
            $table->unsignedBigInteger('identitas_perusahaan_id')->after('id');
            $table->foreign('identitas_perusahaan_id')->references('id')->on('identitas_perusahaan')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi_bank', function (Blueprint $table) {
            $table->dropForeign(['identitas_perusahaan_id']);
            $table->dropColumn('identitas_perusahaan_id');
        });

        Schema::table('data_identitas', function (Blueprint $table) {
            $table->dropForeign(['identitas_perusahaan_id']);
            $table->dropColumn('identitas_perusahaan_id');
        });
    }
};

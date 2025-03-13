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
            $table->string('nomor_rekening')->nullable()->change();
            $table->string('nama_rekening')->nullable()->change();
            $table->string('nama_bank')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi_bank', function (Blueprint $table) {
            //
        });
    }
};

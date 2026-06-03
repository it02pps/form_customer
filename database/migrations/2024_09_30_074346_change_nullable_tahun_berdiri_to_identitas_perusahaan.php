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
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            $table->date('tahun_berdiri')->nullable()->change();
            $table->string('lama_usaha')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            $table->date('tahun_berdiri')->change();
            $table->string('lama_usaha')->change();
        });
    }
};

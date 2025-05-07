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
            $table->text('alamat_ktp')->after('nomor_ktp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            $table->dropColumn(['alamat_ktp']);
        });
    }
};

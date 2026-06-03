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
            $table->text('alamat_npwp')->after('sppkp')->nullable();
            $table->string('kota_npwp')->after('alamat_npwp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            $table->dropColumn('alamat_npwp');
            $table->dropColumn('kota_npwp');
        });
    }
};

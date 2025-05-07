<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            DB::statement("ALTER TABLE `identitas_perusahaan` CHANGE `status_cust` `status_cust` ENUM('lama','baru','usaha_baru') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            //
        });
    }
};

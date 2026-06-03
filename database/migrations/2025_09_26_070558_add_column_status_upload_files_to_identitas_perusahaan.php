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
            $table->string('status_upload_nik')->nullable();
            $table->string('status_upload_npwp')->nullable();
            $table->string('status_upload_sppkp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            $table->dropColumn(['status_upload_nik', 'status_upload_npwp', 'status_upload_sppkp']);
        });
    }
};

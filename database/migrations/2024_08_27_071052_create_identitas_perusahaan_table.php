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
        Schema::create('identitas_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->text('alamat_lengkap');
            $table->string('nama_group_perusahaan');
            $table->string('kota_kabupaten');
            $table->string('kecamatan');
            $table->string('bidang_usaha');
            $table->date('tahun_berdiri');
            $table->string('alamat_email');
            $table->enum('status_kepemilikan', ['milik_sendiri', 'sewa', 'group']);
            $table->enum('identitas', ['ktp', 'npwp']);
            // KTP
            $table->string('nama_lengkap')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->string('foto_ktp')->nullable();

            // NPWP
            $table->enum('badan_usaha', ['pt', 'cv', 'pd', 'pribadi'])->nullable()->default(null);
            $table->string('nomor_npwp')->nullable();
            $table->string('nama_npwp')->nullable();
            $table->string('email_khusus_faktur_pajak')->nullable();
            $table->string('foto_npwp')->nullable();

            // PKP
            $table->enum('status_pkp', ['pkp', 'non_pkp'])->nullable()->default(null);
            $table->string('sppkp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_perusahaan');
    }
};

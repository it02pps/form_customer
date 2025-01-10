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
        Schema::create('tipe_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('identitas_perusahaan_id');
            $table->foreign('identitas_perusahaan_id')->references('id')->on('identitas_perusahaan')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('jenis_transaksi', ['cash', 'credit']);
            $table->enum('tipe_harga', ['end_user', 'retail']);
            $table->string('kategori_customer');
            $table->double('plafond');
            $table->string('payment_term');
            $table->enum('channel_distributor', ['allptk', 'alljkt']);
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_customer');
    }
};

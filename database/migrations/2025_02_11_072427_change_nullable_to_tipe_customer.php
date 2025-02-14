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
        Schema::table('tipe_customer', function (Blueprint $table) {
            $table->unsignedBigInteger('identitas_perusahaan_id')->nullable()->change();
            $table->enum('jenis_transaksi', ['cash', 'credit'])->nullable()->change();
            $table->enum('tipe_harga', ['end_user', 'retail'])->nullable()->change();
            $table->string('kategori_customer')->nullable()->change();
            $table->double('plafond')->nullable()->change();
            $table->string('payment_term')->nullable()->change();
            $table->enum('channel_distributor', ['allptk', 'alljkt'])->nullable()->change();
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipe_customer', function (Blueprint $table) {
            //
        });
    }
};

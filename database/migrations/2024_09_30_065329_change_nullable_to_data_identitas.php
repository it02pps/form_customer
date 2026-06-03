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
        Schema::table('data_identitas', function (Blueprint $table) {
            $table->string('nama')->nullable()->change();
            $table->string('jabatan')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->enum('identitas', ['ktp', 'npwp'])->nullable()->change();
            $table->string('foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_identitas', function (Blueprint $table) {
            //
        });
    }
};

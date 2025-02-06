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
        Schema::table('cabang', function (Blueprint $table) {
            $table->string('nitku')->nullable()->change();
            $table->string('nama')->nullable()->change();
            $table->string('alamat')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabang', function (Blueprint $table) {
            //
        });
    }
};

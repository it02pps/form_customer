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
            $table->renameColumn('status_usaha', 'bentuk_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas_perusahaan', function (Blueprint $table) {
            $table->renameColumn('bentuk_usaha', 'status_usaha');
        });
    }
};

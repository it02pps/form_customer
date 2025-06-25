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
            $table->string('new_bill_to_code')->nullable()->after('kode_customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipe_customer', function (Blueprint $table) {
            $table->dropColumn('new_bill_to_code');
        });
    }
};

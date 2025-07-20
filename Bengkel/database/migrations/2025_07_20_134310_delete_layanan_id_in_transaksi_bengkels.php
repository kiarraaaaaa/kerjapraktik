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
        Schema::table('transaksi_bengkels', function (Blueprint $table) {
            // drop the 'layanan_id' column
            $table->dropForeign(['layanan_id']);
            $table->dropColumn('layanan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_bengkels', function (Blueprint $table) {
            // revert the changes by adding 'layanan_id' column back
            $table->foreignUuid('layanan_id')->nullable()->constrained('layanans')->onDelete('cascade');
        });
    }
};

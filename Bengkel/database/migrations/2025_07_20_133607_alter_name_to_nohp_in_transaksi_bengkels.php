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
        if (Schema::hasColumn('transaksi_bengkels', 'name')) {
            Schema::table('transaksi_bengkels', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }

        Schema::table('transaksi_bengkels', function (Blueprint $table) {
            $table->string('nohp')->after('alamat')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('transaksi_bengkels', 'nohp')) {
            Schema::table('transaksi_bengkels', function (Blueprint $table) {
                $table->dropColumn('nohp');
            });
        }

        Schema::table('transaksi_bengkels', function (Blueprint $table) {
            $table->string('name')->after('alamat')->nullable();
        });
    }
};

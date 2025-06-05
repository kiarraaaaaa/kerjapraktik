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
        Schema::create('transaksi_suku_cadangs', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('transaksi_bengkel_id')->constrained('transaksi_bengkels')->onDelete('cascade');
            $table->foreignUuid('suku_cadang_id')->constrained('suku_cadangs')->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_suku_cadangs');
    }
};

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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kartu_keluarga_id')->constrained('kartu_keluargas')->onDelete('cascade');
            $table->foreignId('kategori_transaksi_id')->constrained('kategori_transaksis')->onDelete('cascade');
            $table->tinyInteger('bulan');
            $table->year('tahun');
            $table->decimal('jumlah', 15, 2);
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->timestamps();
            
            // Uniqueness check: Satu KK, satu kategori, satu periode = satu tagihan
            $table->unique(['kartu_keluarga_id', 'kategori_transaksi_id', 'bulan', 'tahun'], 'tagihan_unique_constraint');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};

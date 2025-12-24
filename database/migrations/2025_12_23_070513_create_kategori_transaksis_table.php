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
        Schema::create('kategori_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->string('slug')->nullable();
            $table->enum('jenis', ['Pemasukan', 'Pengeluaran']);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_transaksis');
    }
};

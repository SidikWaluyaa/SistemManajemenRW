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
        Schema::create('surat_pengantars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained()->onDelete('cascade');
            $table->string('no_surat')->unique()->nullable();
            $table->string('jenis_surat');
            $table->text('keperluan');
            $table->enum('status', ['Diajukan', 'Disetujui', 'Ditolak'])->default('Diajukan');
            $table->date('tanggal_surat')->nullable();
            $table->text('keterangan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantars');
    }
};

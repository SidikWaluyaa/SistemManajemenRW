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
        Schema::create('program_bansos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program'); // Contoh: BLT BBM, PKH, Beras
            $table->enum('jenis_bantuan', ['Tunai', 'Non-Tunai']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_bansos_id')->constrained('program_bansos')->onDelete('cascade');
            $table->foreignId('kartu_keluarga_id')->constrained('kartu_keluargas')->onDelete('cascade');
            $table->date('tanggal_terima');
            $table->enum('status', ['Diajukan', 'Disetujui', 'Disalurkan', 'Ditolak'])->default('Diajukan');
            $table->string('bukti_foto')->nullable();
            $table->text('keterangan')->nullable();
            
            // Siapa petugas yang input/menyerahkan
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_bansos');
        Schema::dropIfExists('program_bansos');
    }
};

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
        Schema::table('kategori_transaksis', function (Blueprint $table) {
            $table->decimal('nominal_default', 15, 2)->nullable()->after('jenis');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('warga_id')->nullable()->after('user_id')->constrained('wargas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['warga_id']);
            $table->dropColumn('warga_id');
        });

        Schema::table('kategori_transaksis', function (Blueprint $table) {
            $table->dropColumn('nominal_default');
        });
    }
};

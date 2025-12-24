<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KategoriTransaksiController;
use App\Http\Controllers\SuratPengantarController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\MutasiWargaController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\LaporanKeuanganController;

use App\Http\Controllers\WargaReportController;
use App\Http\Controllers\KartuKeluargaReportController;
use App\Http\Controllers\SuratPengantarReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Warga
    Route::get('/warga/export', [WargaReportController::class, 'export'])->name('warga.export');
    Route::get('/warga/{id}/cetak', [WargaReportController::class, 'cetak'])->name('warga.cetak');
    Route::resource('warga', WargaController::class);

    // Kartu Keluarga
    Route::get('/kk/{id}/cetak', [KartuKeluargaReportController::class, 'cetak'])->name('kk.cetak');
    Route::resource('kk', KartuKeluargaController::class);

    // Keuangan & Transaksi
    Route::get('/transaksi/laporan', [LaporanKeuanganController::class, 'index'])->name('transaksi.laporan');
    Route::get('/transaksi/export', [LaporanKeuanganController::class, 'export'])->name('transaksi.export');
    Route::resource('transaksi', KeuanganController::class);
    Route::resource('kategori', KategoriTransaksiController::class);

    // Surat Pengantar
    Route::get('/surat/{id}/cetak', [SuratPengantarReportController::class, 'cetak'])->name('surat.cetak');
    Route::resource('surat', SuratPengantarController::class);

    // Inventory / Assets
    Route::resource('inventory/assets', App\Http\Controllers\AssetController::class, ['as' => 'inventory']);
    Route::resource('inventory/loans', App\Http\Controllers\AssetLoanController::class, ['as' => 'inventory']);

    // Tagihan & Pembayaran
    Route::post('/tagihan/generate', [TagihanController::class, 'generate'])->name('tagihan.generate');
    Route::post('/tagihan/{id}/bayar', [TagihanController::class, 'bayar'])->name('tagihan.bayar');
    Route::resource('tagihan', TagihanController::class);

    // Bansos
    Route::resource('bansos/program', App\Http\Controllers\ProgramBansosController::class, ['as' => 'bansos']);
    Route::resource('bansos/penerima', App\Http\Controllers\PenerimaBansosController::class, ['as' => 'bansos']);
    
    // Mutasi Warga
    Route::resource('mutasi', MutasiWargaController::class);

    // User Management (Admin Only)
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
    });
});

require __DIR__.'/auth.php';

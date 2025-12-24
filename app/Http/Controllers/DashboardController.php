<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\KartuKeluarga;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = Warga::count();
        $totalKK = KartuKeluarga::count();
        $pemasukan = Transaksi::where('tipe', 'Pemasukan')->sum('jumlah');
        $pengeluaran = Transaksi::where('tipe', 'Pengeluaran')->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;

        // Chart Data Preparation
        $chartData = Transaksi::selectRaw('MONTH(tanggal_transaksi) as month, tipe, SUM(jumlah) as total')
            ->whereYear('tanggal_transaksi', date('Y'))
            ->groupBy('month', 'tipe')
            ->orderBy('month')
            ->get();

        $months = [];
        $incomeData = [];
        $expenseData = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $incomeData[] = $chartData->where('month', $i)->where('tipe', 'Pemasukan')->first()->total ?? 0;
            $expenseData[] = $chartData->where('month', $i)->where('tipe', 'Pengeluaran')->first()->total ?? 0;
        }

        return view('dashboard', compact('totalWarga', 'totalKK', 'saldo', 'pemasukan', 'pengeluaran', 'months', 'incomeData', 'expenseData'));
    }
}

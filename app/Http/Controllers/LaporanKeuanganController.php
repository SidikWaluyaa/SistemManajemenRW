<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;

class LaporanKeuanganController extends Controller
{
    /**
     * Menampilkan laporan keuangan bulanan.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('month', date('m'));
        $tahun = $request->input('year', date('Y'));

        $query = Transaksi::with(['kategori', 'warga'])
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun);

        if ($request->user()->role === 'rt') {
            $query->whereHas('warga', function($q) {
                $q->where('rt', request()->user()->rt);
            });
        }

        $transactions = $query->orderBy('tanggal_transaksi')->get();
        
        $pemasukan = $transactions->where('tipe', 'Pemasukan')->sum('jumlah');
        $pengeluaran = $transactions->where('tipe', 'Pengeluaran')->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;

        return view('keuangan.laporan', [
            'transactions' => $transactions,
            'month' => $bulan,
            'year' => $tahun,
            'totalPemasukan' => $pemasukan,
            'totalPengeluaran' => $pengeluaran,
            'saldoAkhir' => $saldo
        ]);
    }

    /**
     * Export laporan keuangan ke Excel.
     */
    public function export()
    {
        return Excel::download(new TransaksiExport, 'laporan_keuangan_rw10.xlsx');
    }
}

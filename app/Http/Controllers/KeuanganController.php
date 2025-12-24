<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\KategoriTransaksi;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaksi::with('kategori', 'user')->latest()->paginate(10);
        
        $pemasukan = Transaksi::where('tipe', 'Pemasukan')->sum('jumlah');
        $pengeluaran = Transaksi::where('tipe', 'Pengeluaran')->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;

        return view('keuangan.index', compact('transactions', 'pemasukan', 'pengeluaran', 'saldo'));
    }

    // laporan() and export() moved to LaporanKeuanganController
    // This controller now focuses only on CRUD Actions

    public function create()
    {
        $categories = KategoriTransaksi::all();
        
        $wargaQuery = \App\Models\Warga::query();
        if (request()->user()->role === 'rt') {
            $wargaQuery->where('rt', request()->user()->rt);
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap')->get();

        return view('keuangan.create', compact('categories', 'wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'kategori_transaksi_id' => 'nullable|exists:kategori_transaksis,id',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warga_id' => 'nullable|exists:wargas,id',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti_transaksi', 'public');
            $validated['bukti_foto'] = $path;
        }

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used strictly, but can just redirect or show.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaksi::findOrFail($id);
        $categories = KategoriTransaksi::all();

        $wargaQuery = \App\Models\Warga::query();
        if (request()->user()->role === 'rt') {
            $wargaQuery->where('rt', request()->user()->rt);
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap')->get();

        return view('keuangan.edit', compact('transaction', 'categories', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'kategori_transaksi_id' => 'nullable|exists:kategori_transaksis,id',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warga_id' => 'nullable|exists:wargas,id',
        ]);

        $validated['user_id'] = $request->user()->id;

        $transaction = Transaksi::findOrFail($id);

        if ($request->hasFile('bukti_foto')) {
            // Delete old photo
            if ($transaction->bukti_foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($transaction->bukti_foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($transaction->bukti_foto);
            }
            $path = $request->file('bukti_foto')->store('bukti_transaksi', 'public');
            $validated['bukti_foto'] = $path;
        }

        $transaction->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaksi::findOrFail($id);
        
        if ($transaction->bukti_foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($transaction->bukti_foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($transaction->bukti_foto);
        }

        $transaction->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

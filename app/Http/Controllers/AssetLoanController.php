<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetLoan;
use App\Models\Asset;
use App\Models\Warga;

class AssetLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = AssetLoan::with(['asset', 'warga'])->latest()->paginate(10);
        return view('inventory.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Asset::where('kondisi', '!=', 'Rusak Berat')->get(); // Only good assets
        
        $wargaQuery = Warga::query();
        if (request()->user()->role === 'rt') {
            $wargaQuery->where('rt', request()->user()->rt);
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap')->get();

        return view('inventory.loans.create', compact('assets', 'wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'warga_id' => 'required|exists:wargas,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'Diajukan'; // Default status

        AssetLoan::create($validated);

        return redirect()->route('inventory.loans.index')->with('success', 'Pengajuan peminjaman berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = AssetLoan::findOrFail($id);
        $assets = Asset::all();
        $wargas = Warga::all(); // Admin can see all, simplifed logic
        
        return view('inventory.loans.edit', compact('loan', 'assets', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'warga_id' => 'required|exists:wargas,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required|in:Diajukan,Dipinjam,Dikembalikan,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $loan = AssetLoan::findOrFail($id);
        $loan->update($validated);

        return redirect()->route('inventory.loans.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = AssetLoan::findOrFail($id);
        $loan->delete();

        return redirect()->route('inventory.loans.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}

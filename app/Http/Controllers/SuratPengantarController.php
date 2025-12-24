<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratPengantarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \App\Models\SuratPengantar::with('warga');

        if (request()->user()->role === 'rt') {
            $query->whereHas('warga', function($q) {
                $q->where('rt', request()->user()->rt);
            });
        }

        $surats = $query->latest()->paginate(10);
        return view('surat.index', compact('surats'));
    }

    public function create()
    {
        $wargaQuery = \App\Models\Warga::query();
        if (request()->user()->role === 'rt') {
            $wargaQuery->where('rt', request()->user()->rt);
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap')->get();

        return view('surat.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'tanggal_surat' => 'required|date',
        ]);

        // Auto Generate No Surat: 001/RTxx/RW10/RomawiBulan/Tahun
        $warga = \App\Models\Warga::findOrFail($request->warga_id);
        $rt = $warga->rt;
        $bulanRomawi = $this->getRomawi(date('n', strtotime($request->tanggal_surat)));
        $tahun = date('Y', strtotime($request->tanggal_surat));
        
        // Count surat for this RT in this month/year for numbering
        $count = \App\Models\SuratPengantar::whereYear('tanggal_surat', $tahun)
                    ->whereMonth('tanggal_surat', date('m', strtotime($request->tanggal_surat)))
                    ->whereHas('warga', function($q) use ($rt) {
                        $q->where('rt', $rt);
                    })->count();
        
        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $noSurat = "{$nomorUrut}/RT{$rt}/RW10/{$bulanRomawi}/{$tahun}";

        $validated['no_surat'] = $noSurat;
        $validated['status'] = 'Disetujui'; // Auto approve for simplicity for now, or 'Diajukan' if we want approval flow. Let's say RT makes it, so it's approved.

        \App\Models\SuratPengantar::create($validated);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function show(string $id)
    {
        $surat = \App\Models\SuratPengantar::with('warga')->findOrFail($id);
        return view('surat.cetak', compact('surat'));
    }
    
    // cetak logic moved to SuratPengantarReportController

    public function edit(string $id)
    {
        $surat = \App\Models\SuratPengantar::findOrFail($id);
         $wargaQuery = \App\Models\Warga::query();
        if (request()->user()->role === 'rt') {
            $wargaQuery->where('rt', request()->user()->rt);
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap')->get();

        return view('surat.edit', compact('surat', 'wargas'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'status' => 'required|in:Diajukan,Disetujui,Ditolak',
        ]);

        $surat = \App\Models\SuratPengantar::findOrFail($id);
        $surat->update($validated);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $surat = \App\Models\SuratPengantar::findOrFail($id);
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }

    private function getRomawi($bulan) {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $map[$bulan];
    }
}

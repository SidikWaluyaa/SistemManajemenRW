<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaBansos;
use App\Models\ProgramBansos;
use App\Models\KartuKeluarga;

class PenerimaBansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PenerimaBansos::with(['program', 'kartuKeluarga', 'user']);

        // Search by Kepala Keluarga
        if ($request->filled('search')) {
            $query->whereHas('kartuKeluarga', function($q) use ($request) {
                $q->where('kepala_keluarga', 'like', '%'.$request->search.'%')
                  ->orWhere('nomor_kk', 'like', '%'.$request->search.'%');
            });
        }

        // Filter by Program
        if ($request->filled('program_id')) {
            $query->where('program_bansos_id', $request->program_id);
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $penerimas = $query->latest()->paginate(10)->withQueryString();
        $programs = ProgramBansos::all();

        return view('bansos.penerima.index', compact('penerimas', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = ProgramBansos::all();
        $kks = KartuKeluarga::orderBy('kepala_keluarga')->get();
        return view('bansos.penerima.create', compact('programs', 'kks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_bansos_id' => 'required|exists:program_bansos,id',
            'kartu_keluarga_id' => 'required|exists:kartu_keluargas,id',
            'tanggal_terima' => 'required|date',
            'status' => 'required|in:Diajukan,Disetujui,Disalurkan,Ditolak',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti_bansos', 'public');
            $validated['bukti_foto'] = $path;
        }

        PenerimaBansos::create($validated);

        return redirect()->route('bansos.penerima.index')->with('success', 'Data Penerima Bansos berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penerima = PenerimaBansos::findOrFail($id);
        $programs = ProgramBansos::all();
        $kks = KartuKeluarga::orderBy('kepala_keluarga')->get();

        return view('bansos.penerima.edit', compact('penerima', 'programs', 'kks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'program_bansos_id' => 'required|exists:program_bansos,id',
            'kartu_keluarga_id' => 'required|exists:kartu_keluargas,id',
            'tanggal_terima' => 'required|date',
            'status' => 'required|in:Diajukan,Disetujui,Disalurkan,Ditolak',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $penerima = PenerimaBansos::findOrFail($id);

        if ($request->hasFile('bukti_foto')) {
            if ($penerima->bukti_foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($penerima->bukti_foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($penerima->bukti_foto);
            }
            $path = $request->file('bukti_foto')->store('bukti_bansos', 'public');
            $validated['bukti_foto'] = $path;
        }

        $penerima->update($validated);

        return redirect()->route('bansos.penerima.index')->with('success', 'Data Penerima Bansos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penerima = PenerimaBansos::findOrFail($id);
        
        if ($penerima->bukti_foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($penerima->bukti_foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($penerima->bukti_foto);
        }

        $penerima->delete();

        return redirect()->route('bansos.penerima.index')->with('success', 'Data Penerima Bansos berhasil dihapus.');
    }
}

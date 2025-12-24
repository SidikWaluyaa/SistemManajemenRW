<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MutasiWargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \App\Models\MutasiWarga::with('warga');

        if (request()->user()->role === 'rt') {
            $query->whereHas('warga', function($q) {
                $q->where('rt', request()->user()->rt);
            });
        }
        
        $mutasis = $query->latest()->paginate(10);
        return view('mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        $wargaQuery = \App\Models\Warga::whereIn('status_warga', ['Tetap', 'Kontrak']); // Only active wargas
        
        if (request()->user()->role === 'rt') {
            $wargaQuery->where('rt', request()->user()->rt);
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap')->get();

        return view('mutasi.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jenis_mutasi' => 'required|in:Pindah,Meninggal',
            'tanggal_mutasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Create Mutasi Record
        \App\Models\MutasiWarga::create($validated);

        // Update Warga Status
        $warga = \App\Models\Warga::findOrFail($request->warga_id);
        $warga->update(['status_warga' => $request->jenis_mutasi]);

        return redirect()->route('mutasi.index')->with('success', 'Data mutasi berhasil dicatat. Status warga telah diperbarui.');
    }

    public function show(string $id)
    {
        // Not implemented needed yet?
    }

    public function edit(string $id)
    {
        // Mutasi shouldn't be edited easily as it affects status. 
        // For simplicity, let's just allow Destroy (which should revert status?)
        // Or just basic edit info.
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $mutasi = \App\Models\MutasiWarga::findOrFail($id);
        
        // Revert Warga Status to Tetap (Default) or maybe we should have stored previous status?
        // For now, let's assume if we delete mutation record, they become 'Tetap' again or we warn user.
        $mutasi->warga->update(['status_warga' => 'Tetap']); 
        
        $mutasi->delete();

        return redirect()->route('mutasi.index')->with('success', 'Data mutasi dihapus. Status warga dikembalikan menjadi Tetap.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \App\Models\KartuKeluarga::query();

        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'rt') {
            $query->where('rt', $user->rt);
        }

        $kks = $query->latest()->paginate(10);
        return view('kk.index', compact('kks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'rt') {
            $request->merge(['rt' => $user->rt]);
        }
        $validated = $request->validate([
            'nomor_kk' => 'required|numeric|unique:kartu_keluargas,nomor_kk',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'desa_kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten_kota' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|string',
        ]);

        \App\Models\KartuKeluarga::create($validated);

        return redirect()->route('kk.index')->with('success', 'Kartu Keluarga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kk = \App\Models\KartuKeluarga::with('wargas')->findOrFail($id);
        return view('kk.show', compact('kk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kk = \App\Models\KartuKeluarga::findOrFail($id);
        return view('kk.edit', compact('kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'rt') {
            $request->merge(['rt' => $user->rt]);
        }
        $validated = $request->validate([
            'nomor_kk' => 'required|numeric|unique:kartu_keluargas,nomor_kk,'.$id,
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'desa_kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten_kota' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|string',
        ]);

        $kk = \App\Models\KartuKeluarga::findOrFail($id);
        $kk->update($validated);

        return redirect()->route('kk.index')->with('success', 'Kartu Keluarga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kk = \App\Models\KartuKeluarga::findOrFail($id);
        $kk->delete();

        return redirect()->route('kk.index')->with('success', 'Kartu Keluarga berhasil dihapus.');
    }
    // cetak method moved to KartuKeluargaReportController
}

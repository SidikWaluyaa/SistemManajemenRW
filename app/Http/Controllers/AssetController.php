<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::latest()->paginate(10);
        return view('inventory.assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:assets,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tanggal_perolehan' => 'nullable|date',
            'sumber' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('assets', 'public');
            $validated['foto'] = $path;
        }

        Asset::create($validated);

        return redirect()->route('inventory.assets.index')->with('success', 'Data Aset berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asset = Asset::findOrFail($id);
        return view('inventory.assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:assets,kode_barang,'.$id,
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tanggal_perolehan' => 'nullable|date',
            'sumber' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $asset = Asset::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($asset->foto && Storage::disk('public')->exists($asset->foto)) {
                Storage::disk('public')->delete($asset->foto);
            }
            $path = $request->file('foto')->store('assets', 'public');
            $validated['foto'] = $path;
        }

        $asset->update($validated);

        return redirect()->route('inventory.assets.index')->with('success', 'Data Aset berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset = Asset::findOrFail($id);
        
        if ($asset->foto && Storage::disk('public')->exists($asset->foto)) {
            Storage::disk('public')->delete($asset->foto);
        }

        $asset->delete();

        return redirect()->route('inventory.assets.index')->with('success', 'Data Aset berhasil dihapus.');
    }
}

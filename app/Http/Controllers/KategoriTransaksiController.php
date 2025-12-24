<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = \App\Models\KategoriTransaksi::latest()->paginate(10);
        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'deskripsi' => 'nullable|string',
            'nominal_default' => 'nullable|numeric|min:0',
        ]);
        
        $validated['slug'] = \Illuminate\Support\Str::slug($request->nama_kategori);

        \App\Models\KategoriTransaksi::create($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = \App\Models\KategoriTransaksi::findOrFail($id);
        return view('kategori.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'deskripsi' => 'nullable|string',
            'nominal_default' => 'nullable|numeric|min:0',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->nama_kategori);

        $category = \App\Models\KategoriTransaksi::findOrFail($id);
        $category->update($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $category = \App\Models\KategoriTransaksi::findOrFail($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

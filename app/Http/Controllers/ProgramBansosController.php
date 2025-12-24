<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramBansos;

class ProgramBansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = ProgramBansos::latest()->paginate(10);
        return view('bansos.program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bansos.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'jenis_bantuan' => 'required|in:Tunai,Non-Tunai',
            'keterangan' => 'nullable|string',
        ]);

        ProgramBansos::create($validated);

        return redirect()->route('bansos.program.index')->with('success', 'Program Bansos berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = ProgramBansos::findOrFail($id);
        return view('bansos.program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'jenis_bantuan' => 'required|in:Tunai,Non-Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $program = ProgramBansos::findOrFail($id);
        $program->update($validated);

        return redirect()->route('bansos.program.index')->with('success', 'Program Bansos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = ProgramBansos::findOrFail($id);
        $program->delete();

        return redirect()->route('bansos.program.index')->with('success', 'Program Bansos berhasil dihapus.');
    }
}

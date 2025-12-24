<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Warga::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%'.$request->search.'%')
                  ->orWhere('nik', 'like', '%'.$request->search.'%');
            });
        }

        // Scope by RT if user is RT admin
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'rt') {
            $query->where('rt', $user->rt);
        } elseif ($request->filled('rt')) {
            $rt = $request->rt;
            // Handle various formats: '4', '04', '004'
            $formats = [
                $rt, 
                (string)(int)$rt, 
                str_pad($rt, 2, '0', STR_PAD_LEFT),
                str_pad($rt, 3, '0', STR_PAD_LEFT)
            ];
            $query->whereIn('rt', array_unique($formats));
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        if ($request->filled('status_warga')) {
            $query->where('status_warga', $request->status_warga);
        }

        $wargas = $query->latest()->paginate(10)->withQueryString();
        
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        $kks = \App\Models\KartuKeluarga::all();
        return view('warga.create', compact('kks'));
    }

    public function store(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'rt') {
            $request->merge(['rt' => $user->rt]);
        }

        $validated = $request->validate([
            'kartu_keluarga_id' => 'nullable|exists:kartu_keluargas,id',
            'nik' => 'required|numeric|unique:wargas,nik',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'desa_kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten_kota' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'agama' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'status_perkawinan' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:3',
            'kewarganegaraan' => 'required|string',
            'status_warga' => 'required|string',
            'pendidikan' => 'nullable|string',
            'status_hubungan_dalam_keluarga' => 'nullable|string',
            'nama_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'foto_warga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto_warga')) {
            $path = $request->file('foto_warga')->store('foto_warga', 'public');
            $validated['foto_warga'] = $path;
        }

        \App\Models\Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warga = \App\Models\Warga::with('kartuKeluarga')->findOrFail($id);
        return view('warga.show', compact('warga'));
    }

    public function edit(string $id)
    {
        $warga = \App\Models\Warga::findOrFail($id);
        $kks = \App\Models\KartuKeluarga::all();
        return view('warga.edit', compact('warga', 'kks'));
    }

    public function update(Request $request, string $id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'rt') {
            $request->merge(['rt' => $user->rt]);
        }
        $validated = $request->validate([
            'kartu_keluarga_id' => 'nullable|exists:kartu_keluargas,id',
            'nik' => 'required|numeric|unique:wargas,nik,'.$id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'desa_kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten_kota' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'agama' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'status_perkawinan' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:3',
            'kewarganegaraan' => 'required|string',
            'status_warga' => 'required|string',
            'pendidikan' => 'nullable|string',
            'status_hubungan_dalam_keluarga' => 'nullable|string',
            'nama_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'foto_warga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $warga = \App\Models\Warga::findOrFail($id);

        if ($request->hasFile('foto_warga')) {
            if ($warga->foto_warga && \Illuminate\Support\Facades\Storage::disk('public')->exists($warga->foto_warga)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($warga->foto_warga);
            }
            $path = $request->file('foto_warga')->store('foto_warga', 'public');
            $validated['foto_warga'] = $path;
        }

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil diperbarui.');
    }

    // cetak() and export() moved to WargaReportController

    public function destroy(string $id)
    {
        $warga = \App\Models\Warga::findOrFail($id);
        
        if ($warga->foto_warga && \Illuminate\Support\Facades\Storage::disk('public')->exists($warga->foto_warga)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($warga->foto_warga);
        }

        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil dihapus.');
    }
}

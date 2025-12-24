<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $status = $request->input('status');

        $query = \App\Models\Tagihan::with(['kartuKeluarga.wargas' => function($q) {
            $q->where('status_hubungan_dalam_keluarga', 'Kepala Keluarga');
        }, 'kategoriTransaksi'])
        ->where('bulan', $bulan)
        ->where('tahun', $tahun);

        if ($request->user()->role === 'rt') {
            $query->whereHas('kartuKeluarga', function($q) {
                $q->where('rt', request()->user()->rt);
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $tagihans = $query->get(); // Get all for simplicity in table, or paginate if too many

        $categories = \App\Models\KategoriTransaksi::where('jenis', 'Pemasukan')->whereNotNull('nominal_default')->get();

        return view('tagihan.index', compact('tagihans', 'bulan', 'tahun', 'status', 'categories'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030',
            'kategori_transaksi_id' => 'required|exists:kategori_transaksis,id',
        ]);

        $kategori = \App\Models\KategoriTransaksi::findOrFail($request->kategori_transaksi_id);
        
        // Logic: Get All KK (Scoped by RT if user is RT, but usually generation is Global or per RT?)
        // Let's assume Admin generates for all, RT generates for their RT.
        
        $kkQuery = \App\Models\KartuKeluarga::query();
        if ($request->user()->role === 'rt') {
            $kkQuery->where('rt', $request->user()->rt);
        }
        $kks = $kkQuery->get();

        $count = 0;
        foreach ($kks as $kk) {
            // Check if already exists
            $exists = \App\Models\Tagihan::where('kartu_keluarga_id', $kk->id)
                ->where('kategori_transaksi_id', $kategori->id)
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->exists();

            if (!$exists) {
                \App\Models\Tagihan::create([
                    'kartu_keluarga_id' => $kk->id,
                    'kategori_transaksi_id' => $kategori->id,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'jumlah' => $kategori->nominal_default ?? 0,
                    'status' => 'Belum Lunas',
                ]);
                $count++;
            }
        }

        return redirect()->route('tagihan.index', ['bulan' => $request->bulan, 'tahun' => $request->tahun])
            ->with('success', "Berhasil membuat $count tagihan baru untuk {$kategori->nama_kategori}.");
    }

    public function bayar(Request $request, string $id)
    {
        $tagihan = \App\Models\Tagihan::with('kartuKeluarga')->findOrFail($id);
        
        if ($tagihan->status === 'Lunas') {
             return redirect()->back()->with('error', 'Tagihan sudah lunas.');
        }

        // Create Transaksi Pemasukan automatically
        // Find Kepala Keluarga id to link as warga_id payer
        $kepalaKeluarga = $tagihan->kartuKeluarga->wargas()->where('status_hubungan_dalam_keluarga', 'Kepala Keluarga')->first();
        $payerId = $kepalaKeluarga ? $kepalaKeluarga->id : null; 

        \App\Models\Transaksi::create([
            'user_id' => $request->user()->id,
            'tipe' => 'Pemasukan',
            'kategori_transaksi_id' => $tagihan->kategori_transaksi_id,
            'warga_id' => $payerId,
            'jumlah' => $tagihan->jumlah,
            'tanggal_transaksi' => now(),
            'keterangan' => "Pembayaran Tagihan Bulan {$tagihan->bulan}/{$tagihan->tahun} - KK No. {$tagihan->kartuKeluarga->nomor_kk}",
        ]);

        $tagihan->update(['status' => 'Lunas']);

        return redirect()->back()->with('success', 'Tagihan berhasil dibayar dan transaksi tercatat.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga;

class KartuKeluargaReportController extends Controller
{
    /**
     * Cetak Kartu Keluarga.
     */
    public function cetak(string $id)
    {
        $kk = KartuKeluarga::with('wargas')->findOrFail($id);
        return view('kk.cetak', compact('kk'));
    }
}

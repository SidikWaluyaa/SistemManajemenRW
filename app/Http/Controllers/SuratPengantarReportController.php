<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;

class SuratPengantarReportController extends Controller
{
    /**
     * Cetak Surat Pengantar.
     */
    public function cetak(string $id)
    {
        $surat = SuratPengantar::with('warga')->findOrFail($id);
        return view('surat.cetak', compact('surat'));
    }
}

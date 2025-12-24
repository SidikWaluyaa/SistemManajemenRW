<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WargaExport;

class WargaReportController extends Controller
{
    /**
     * Cetak detail data warga.
     */
    public function cetak($id)
    {
        $warga = Warga::findOrFail($id);
        
        // Ensure user can view this warga
        if (request()->user()->role === 'rt' && $warga->rt !== request()->user()->rt) {
            abort(403);
        }

        return view('warga.cetak', compact('warga'));
    }

    /**
     * Export data warga ke Excel.
     */
    public function export()
    {
        return Excel::download(new WargaExport, 'data_warga_rw10.xlsx');
    }
}

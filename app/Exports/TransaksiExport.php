<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Transaksi::with(['warga', 'kategori']);

        if (Auth::user()->role === 'rt') {
            $query->whereHas('warga', function($q) {
                $q->where('rt', Auth::user()->rt);
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Tipe',
            'Kategori',
            'Keterangan',
            'Warga (Pembayar)',
            'RT',
            'Jumlah (Rp)',
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->tanggal_transaksi->format('d-m-Y'),
            $transaksi->tipe,
            $transaksi->kategori->nama_kategori ?? '-',
            $transaksi->keterangan,
            $transaksi->warga->nama_lengkap ?? '-',
            $transaksi->warga->rt ?? '-',
            $transaksi->jumlah,
        ];
    }
}

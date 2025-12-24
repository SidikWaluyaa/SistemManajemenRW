<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class WargaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Warga::query();

        if (Auth::user()->role === 'rt') {
            $query->where('rt', Auth::user()->rt);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIK',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Pekerjaan',
            'Alamat KTP',
            'RT',
            'RW',
            'Status Warga',
        ];
    }

    public function map($warga): array
    {
        return [
            $warga->nama_lengkap,
            "'".$warga->nik, // Force string in Excel to prevent scientific notation
            $warga->jenis_kelamin,
            $warga->tempat_lahir,
            $warga->tanggal_lahir ? $warga->tanggal_lahir->format('d-m-Y') : '',
            $warga->agama,
            $warga->pekerjaan,
            $warga->alamat_ktp,
            $warga->rt,
            '10', // RW
            $warga->status_warga,
        ];
    }
}

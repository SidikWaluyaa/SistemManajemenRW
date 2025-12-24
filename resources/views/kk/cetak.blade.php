<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Keluarga - {{ $kk->nomor_kk }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.4; font-size: 12px; }
        .container { width: 100%; margin: 0 auto; padding: 10px; }
        .header { text-align: center; margin-bottom: 20px; font-weight: bold; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 2px; }
        .header h2 { margin: 5px 0; font-size: 18px; }
        .info-table { width: 100%; border: none; margin-bottom: 20px; }
        .info-table td { padding: 2px; vertical-align: top; }
        .label { font-weight: bold; width: 15%; }
        .separator { width: 1%; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        .data-table th { background-color: #f0f0f0; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
        @media print {
            .no-print { display: none; }
            @page { size: landscape; margin: 10mm; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <button class="no-print" onclick="window.print()" style="margin-bottom: 20px; padding: 10px 20px; cursor: pointer;">Cetak</button>
        
        <div class="header">
            <h1>KARTU KELUARGA</h1>
            <h2>No. {{ $kk->nomor_kk }}</h2>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Nama Kepala Keluarga</td>
                <td class="separator">:</td>
                <td style="width: 40%;">{{ strtoupper($kk->kepala_keluarga) }}</td>
                <td class="label">Kecamatan</td>
                <td class="separator">:</td>
                <td>{{ strtoupper($kk->kecamatan) }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="separator">:</td>
                <td>{{ $kk->alamat }}</td>
                <td class="label">Kabupaten/Kota</td>
                <td class="separator">:</td>
                <td>{{ strtoupper($kk->kabupaten_kota) }}</td>
            </tr>
            <tr>
                <td class="label">RT/RW</td>
                <td class="separator">:</td>
                <td>{{ $kk->rt }} / {{ $kk->rw }}</td>
                <td class="label">Kode Pos</td>
                <td class="separator">:</td>
                <td>{{ $kk->kode_pos }}</td>
            </tr>
            <tr>
                <td class="label">Desa/Kelurahan</td>
                <td class="separator">:</td>
                <td>{{ strtoupper($kk->desa_kelurahan) }}</td>
                <td class="label">Provinsi</td>
                <td class="separator">:</td>
                <td>{{ strtoupper($kk->provinsi) }}</td>
            </tr>
        </table>

        <!-- Table Bagian 1 -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Nama Lengkap</th>
                    <th style="width: 15%;">NIK</th>
                    <th style="width: 5%;">JK</th>
                    <th style="width: 15%;">Tempat Lahir</th>
                    <th style="width: 10%;">Tanggal Lahir</th>
                    <th style="width: 10%;">Agama</th>
                    <th style="width: 10%;">Pendidikan</th>
                    <th style="width: 10%;">Jenis Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kk->wargas as $index => $warga)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ strtoupper($warga->nama_lengkap) }}</td>
                    <td>{{ $warga->nik }}</td>
                    <td class="text-center">{{ $warga->jenis_kelamin }}</td>
                    <td>{{ $warga->tempat_lahir }}</td>
                    <td class="text-center">{{ $warga->tanggal_lahir ? $warga->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                    <td>{{ $warga->agama }}</td>
                    <td>{{ $warga->pendidikan }}</td>
                    <td>{{ $warga->pekerjaan }}</td>
                </tr>
                @endforeach
                @for($i = $kk->wargas->count(); $i < 5; $i++)
                <tr>
                    <td class="text-center">&nbsp;</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                @endfor
            </tbody>
        </table>

        <!-- Table Bagian 2 -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Status Perkawinan</th>
                    <th style="width: 15%;">Status Hubungan Dalam Keluarga</th>
                    <th style="width: 15%;">Kewarganegaraan</th>
                    <th style="width: 25%;">Nama Ayah</th>
                    <th style="width: 25%;">Nama Ibu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kk->wargas as $index => $warga)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $warga->status_perkawinan }}</td>
                    <td>{{ $warga->status_hubungan_dalam_keluarga }}</td>
                    <td>{{ $warga->kewarganegaraan }}</td>
                    <td>{{ $warga->nama_ayah }}</td>
                    <td>{{ $warga->nama_ibu }}</td>
                </tr>
                @endforeach
                 @for($i = $kk->wargas->count(); $i < 5; $i++)
                <tr>
                    <td class="text-center">&nbsp;</td>
                    <td></td><td></td><td></td><td></td><td></td>
                </tr>
                @endfor
            </tbody>
        </table>

        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <div style="text-align: center; width: 30%;">
                <p>Kepala Keluarga</p>
                <br><br><br>
                <p><b>{{ strtoupper($kk->kepala_keluarga) }}</b></p>
            </div>
            <div style="text-align: center; width: 30%;">
                <p>Ketua RW 010</p>
                <br><br><br>
                <p><b>( ....................... )</b></p>
            </div>
             <div style="text-align: center; width: 30%;">
                <p>Bandung, {{ date('d-m-Y') }}</p>
                <p>Kepala Dinas Kependudukan</p>
                <br><br><br>
                <p><b>( ....................... )</b></p>
            </div>
        </div>

    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Warga - {{ $warga->nama_lengkap }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header h2 { margin: 5px 0; font-size: 18px; }
        .photo-section { text-align: right; margin-bottom: 20px; }
        .photo { width: 150px; height: 150px; border: 1px solid #777; object-fit: cover; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table td { padding: 8px; vertical-align: top; }
        .label { width: 30%; font-weight: bold; }
        .separator { width: 2%; }
        .value { width: 68%; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <button class="no-print" onclick="window.print()" style="margin-bottom: 20px; padding: 10px 20px; cursor: pointer;">Cetak Dokument</button>
        
        <div class="header">
            <h1>BIODATA PENDUDUK</h1>
            <h2>RUKUN WARGA 010, KELURAHAN CIGERELENG</h2>
        </div>

        @if($warga->foto_warga)
            <div class="photo-section">
                <img src="{{ asset('storage/' . $warga->foto_warga) }}" alt="Foto Warga" class="photo">
            </div>
        @endif

        <table class="data-table">
            <tr>
                <td class="label">NIK</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->nik }}</td>
            </tr>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->nama_lengkap }}</td>
            </tr>
            <tr>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->tempat_lahir }}, {{ $warga->tanggal_lahir ? $warga->tanggal_lahir->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="separator">:</td>
                <td class="value">
                    {{ $warga->alamat }}<br>
                    RT {{ $warga->rt }} / RW {{ $warga->rw }}<br>
                    Kel. {{ $warga->desa_kelurahan }}, Kec. {{ $warga->kecamatan }}<br>
                    {{ $warga->kabupaten_kota }} - {{ $warga->provinsi }}
                </td>
            </tr>
            <tr>
                <td class="label">Agama</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->agama }}</td>
            </tr>
            <tr>
                <td class="label">Status Perkawinan</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->status_perkawinan }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->pekerjaan }}</td>
            </tr>
            <tr>
                <td class="label">Kewarganegaraan</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->kewarganegaraan }}</td>
            </tr>
            <tr>
                <td class="label">Status Warga</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->status_warga }}</td>
            </tr>
            <tr>
                <td class="label">Nomor KK</td>
                <td class="separator">:</td>
                <td class="value">{{ $warga->kartu_keluarga_id ? $warga->kartuKeluarga->nomor_kk : '-' }}</td>
            </tr>
        </table>
        
        <div style="margin-top: 50px; text-align: right;">
            <p>Bandung, {{ date('d F Y') }}</p>
            <br><br><br>
            <p>( Ketua RW 010 )</p>
        </div>
    </div>
</body>
</html>

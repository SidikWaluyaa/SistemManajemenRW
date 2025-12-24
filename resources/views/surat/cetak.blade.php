<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Pengantar - {{ $surat->no_surat }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 800px; /* A4 width approx */
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h3, .header h2 {
            margin: 5px 0;
            text-transform: uppercase;
        }
        .content {
            margin-bottom: 50px;
        }
        .content p {
            margin-bottom: 15px;
            text-align: justify;
        }
        .data-table {
            width: 100%;
            margin-left: 30px;
            margin-bottom: 20px;
        }
        .data-table td {
            padding: 5px;
            vertical-align: top;
        }
        .data-table td:first-child {
            width: 150px;
        }
        .data-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }
        .signature {
            width: 100%;
            margin-top: 50px;
        }
        .signature-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .no-print {
            margin-bottom: 20px;
            text-align: center;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background-color: #4CAF50; color: white; border: none; font-size: 16px;">Cetak Dokumen</button>
    </div>

    <div class="container">
        <div class="header">
            <h3>RUKUN TETANGGA {{ $surat->warga->rt }} RUKUN WARGA 10</h3>
            <h3>KELURAHAN [NAMA KELURAHAN] KECAMATAN [NAMA KECAMATAN]</h3>
            <h2>KOTA [NAMA KOTA]</h2>
        </div>

        <div style="text-align: center; margin-bottom: 30px;">
            <h3 style="text-decoration: underline; margin-bottom: 5px;">SURAT PENGANTAR</h3>
            <span>Nomor: {{ $surat->no_surat }}</span>
        </div>

        <div class="content">
            <p>Yang bertanda tangan di bawah ini Ketua RT {{ $surat->warga->rt }} RW 10, menerangkan bahwa:</p>
            
            <table class="data-table">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><strong>{{ strtoupper($surat->warga->nama_lengkap) }}</strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $surat->warga->nik }}</td>
                </tr>
                <tr>
                    <td>Tempat/Tgl Lahir</td>
                    <td>:</td>
                    <td>{{ $surat->warga->tempat_lahir }}, {{ $surat->warga->tanggal_lahir->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $surat->warga->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $surat->warga->pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $surat->warga->agama }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $surat->warga->alamat_ktp }}</td>
                </tr>
            </table>

            <p>Orang tersebut diatas adalah benar-benar warga kami yang berdomisili di lingkungan RT {{ $surat->warga->rt }} RW 10. Surat pengantar ini diberikan untuk keperluan:</p>

            <div style="margin: 20px 0; border: 1px solid #ccc; padding: 15px; font-weight: bold; text-align: center; background-color: #f9f9f9;">
                {{ strtoupper($surat->jenis_surat) }} - {{ $surat->keperluan }}
            </div>

            <p>Demikian surat pengantar ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="signature">
            <div class="signature-box">
                <p>Bandung,  {{ $surat->tanggal_surat->translatedFormat('d F Y') }}</p>
                <p>Ketua RT {{ $surat->warga->rt }}</p>
                <br><br><br><br>
                <p><strong>(...........................................)</strong></p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        /* Reset dan base styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.4;
            color: #000;
            background: #fff;
            padding: 20px;
            font-size: 12px;
        }

        /* Container utama */
        .surat-container {
            max-width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            padding: 40px;
            position: relative;
        }

        /* Kop surat */
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .kop-surat h2 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .kop-surat p {
            font-size: 11px;
            margin-bottom: 0;
        }

        /* Judul surat */
        .judul-surat {
            text-align: center;
            margin: 25px 0;
        }

        .judul-surat h3 {
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .judul-surat p {
            font-size: 11px;
            font-weight: bold;
        }

        /* Isi surat */
        .isi-surat {
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .isi-surat p {
            margin-bottom: 12px;
            text-indent: 30px;
        }

        /* Tabel data */
        .tabel-data {
            margin: 15px 0 15px 40px;
            border-collapse: collapse;
        }

        .tabel-data td {
            padding: 3px 8px;
            vertical-align: top;
        }

        .tabel-data td:first-child {
            width: 120px;
        }

        /* Tanda tangan */
        .ttd-section {
            margin-top: 50px;
            text-align: right;
            float: right;
            width: 300px;
        }

        .ttd-info {
            text-align: center;
        }

        .ttd-info p {
            margin-bottom: 5px;
        }

        .qr-code {
            width: 80px;
            height: 80px;
            margin: 5px auto;
            border: 1px solid #ddd;
            padding: 2px;
            background: white;
        }

        .nama-jabatan {
            margin-top: 10px;
        }

        .nama-jabatan p {
            margin-bottom: 3px;
        }

        /* Clear float */
        .clear {
            clear: both;
        }

        /* Untuk print */
        @media print {
            body {
                padding: 0;
                margin: 0;
            }

            .surat-container {
                padding: 30px;
                margin: 0;
                max-width: none;
                min-height: auto;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="surat-container">
        <!-- Kop Surat -->
        <div class="kop-surat">
            <h1>PEMERINTAH DESA MANGGALUNG</h1>
            <h2>KECAMATAN MANDALLE - KABUPATEN PANGKAJENE DAN KEPULAUAN</h2>
            <p><strong>Alamat:</strong> Jl. Desa Manggalung, Kec. Mandalle, Kab. Pangkajene dan Kepulauan</p>
        </div>

        <!-- Judul Surat -->
        <div class="judul-surat">
            <h3>surat keterangan tidak mampu</h3>
            <p>Nomor: 
                @if($sktm->nomor_surat)
                    {{ $sktm->nomor_surat }}
                @else
                    {{ $sktm->id }}/SKTM/{{ date('Y') }}
                @endif
            </p>
        </div>

        <!-- Isi Surat -->
        <div class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Manggalung, Kecamatan Mandalle, Kabupaten Pangkajene dan Kepulauan, dengan ini menerangkan bahwa:</p>

            <table class="tabel-data">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong>{{ $sktm->nama }}</strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><strong>{{ $sktm->nik }}</strong></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><strong>{{ $sktm->alamat }}</strong></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><strong>{{ $sktm->pekerjaan }}</strong></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><strong>{{ $sktm->agama }}</strong></td>
                </tr>
            </table>

            <p>Adalah benar yang bersangkutan berasal dari keluarga kurang mampu dan memerlukan bantuan.</p>
            <p>Surat keterangan ini dibuat untuk keperluan administrasi dan bantuan sosial.</p>
            <p>Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd-section">
            <div class="ttd-info">
                <p>Desa Manggalung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p><strong>Kepala Desa</strong></p>

                <!-- QR Code -->
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ urlencode($linkVerifikasi) }}"
                    alt="QR Code Verifikasi" class="qr-code">

                <div class="nama-jabatan">
                    <p><strong><u>Nama Kepala Desa</u></strong></p>
                    <p>NIP. 123456789</p>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</body>
</html>
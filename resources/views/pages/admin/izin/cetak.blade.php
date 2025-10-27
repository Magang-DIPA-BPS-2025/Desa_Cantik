<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Kegiatan</title>
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
            width: 100%;
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
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .surat-container {
                padding: 30px;
                margin: 0;
                max-width: none;
                min-height: auto;
                page-break-after: avoid;
            }

            .no-print {
                display: none;
            }

            @page {
                size: A4;
                margin: 0;
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
            <h3>surat izin kegiatan</h3>
            <p>Nomor: 
                @if($izin->nomor_surat)
                    {{ $izin->nomor_surat }}
                @else
                    {{ $izin->id }}/SIZ/{{ date('Y') }}
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
                    <td><strong>{{ $izin->nama }}</strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><strong>{{ $izin->nik }}</strong></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><strong>{{ $izin->alamat }}</strong></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><strong>{{ $izin->pekerjaan ?? '-' }}</strong></td>
                </tr>
            </table>

            <p>Telah mengajukan permohonan izin untuk melaksanakan kegiatan dengan rincian sebagai berikut:</p>

            <table class="tabel-data">
                <tr>
                    <td>Jenis Kegiatan</td>
                    <td>:</td>
                    <td><strong>{{ $izin->jenis_acara }}</strong></td>
                </tr>
                <tr>
                    <td>Hari</td>
                    <td>:</td>
                    <td><strong>{{ $izin->hari }}</strong></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><strong>{{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }}</strong></td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td><strong>{{ $izin->tempat }}</strong></td>
                </tr>
            </table>

            <p>Dengan ini memberikan izin kepada yang bersangkutan untuk melaksanakan kegiatan tersebut dengan ketentuan:</p>
            <p>1. Wajib menjaga ketertiban dan keamanan selama kegiatan berlangsung</p>
            <p>2. Bertanggung jawab penuh terhadap kebersihan lokasi kegiatan</p>
            <p>3. Menjaga hubungan baik dengan masyarakat sekitar</p>
            <p>4. Mematuhi semua peraturan yang berlaku</p>

            <p>Demikian surat izin ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd-section">
            <div class="ttd-info">
                <p>Desa Manggalung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p><strong>Kepala Desa</strong></p>

                <!-- QR Code -->
                @if($qrCodeSuccess && !empty($qrCodeBase64))
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code Verifikasi" class="qr-code">
                @else
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ urlencode($linkVerifikasi) }}" alt="QR Code Verifikasi" class="qr-code">
                @endif
                <p style="font-size: 9px; color: #666;">Scan untuk verifikasi</p>

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
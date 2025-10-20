<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Usaha</title>
    <style>
        body { 
            font-family: 'Times New Roman', serif; 
            margin: 40px; 
            color: #000;
        }
        .kop {
            text-align: center; 
            border-bottom: 3px solid #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px;
        }
        .kop h2, .kop h3 { margin: 0; }
        .isi { 
            text-align: justify; 
            line-height: 1.8; 
            font-size: 16px;
        }
        .ttd { 
            margin-top: 60px; 
            text-align: right; 
            font-size: 16px;
        }
        .center { text-align: center; }
        .qr { 
            margin-top: 60px; 
            text-align: left; 
            font-size: 14px;
        }
        table { line-height: 1.8; }
    </style>
</head>
<body>

    {{-- HEADER SURAT --}}
    <div class="kop">
        <h2>PEMERINTAH DESA CONTOH</h2>
        <h3>KECAMATAN CONTOH - KABUPATEN CONTOH</h3>
        <p><b>Alamat:</b> Jl. Contoh No. 123, Desa Contoh, Kec. Contoh</p>
    </div>

    {{-- JUDUL --}}
    <div class="center">
        <h3><u>SURAT KETERANGAN USAHA</u></h3>
        <p>Nomor: {{ $sku->id }}/SKU/{{ date('Y') }}</p>
    </div>

    {{-- ISI SURAT --}}
    <div class="isi">
        <p>Yang bertanda tangan di bawah ini Kepala Desa Contoh, dengan ini menerangkan bahwa:</p>

        <table style="margin-left: 40px;">
            <tr><td width="150">Nama</td><td width="10">:</td><td>{{ $sku->nama }}</td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $sku->nik }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $sku->alamat }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $sku->pekerjaan ?? '-' }}</td></tr>
        </table>

        <p>Adalah benar yang bersangkutan memiliki usaha dengan keterangan sebagai berikut:</p>

        <table style="margin-left: 40px;">
            <tr><td width="150">Nama Usaha</td><td width="10">:</td><td>{{ $sku->nama_usaha }}</td></tr>
            <tr><td>Alamat Usaha</td><td>:</td><td>{{ $sku->alamat_usaha }}</td></tr>
        </table>

        <p>Surat keterangan ini dibuat untuk keperluan <i>{{ $sku->keperluan ?? 'Administrasi' }}</i>.</p>

        <p>Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <p>Desa Contoh, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p><b>Kepala Desa Contoh</b></p>
        <br><br><br>
        <p><u><b>Nama Kepala Desa</b></u></p>
    </div>

    {{-- QR CODE VERIFIKASI --}}
    <div class="qr">
        <p><b>QR Code Verifikasi:</b></p>

        {{-- Generate QR pakai GD, bukan Imagick --}}
       <img src="data:image/png;base64,{!! base64_encode(
    QrCode::format('png')
        ->size(150)
        ->errorCorrection('H')
        ->generate(url('/verifikasi-surat/' . $sku->id), null, 'gd')
) !!}" alt="QR Code">

        <p style="font-size: 12px; color: #555;">Scan untuk memverifikasi keaslian surat</p>
    </div>

</body>
</html>

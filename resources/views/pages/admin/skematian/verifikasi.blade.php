<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat Keterangan Kematian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .status {
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-weight: bold;
        }
        .valid {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .invalid {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .data-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>VERIFIKASI SURAT KETERANGAN KEMATIAN</h1>
            <p>Sistem Verifikasi Digital Desa Manggalung</p>
        </div>

        @if($valid && isset($kematian))
            <div class="status valid">
                ✅ SURAT VALID - Terverifikasi di Sistem
            </div>

            <h2>Data Almarhum/Almarhumah</h2>
            <table class="data-table">
                <tr>
                    <td width="200"><strong>Nama</strong></td>
                    <td>{{ $kematian->nama }}</td>
                </tr>
                <tr>
                    <td><strong>NIK</strong></td>
                    <td>{{ $kematian->nik }}</td>
                </tr>
                <tr>
                    <td><strong>Nomor KK</strong></td>
                    <td>{{ $kematian->nomor_kk }}</td>
                </tr>
                <tr>
                    <td><strong>Tempat/Tgl Lahir</strong></td>
                    <td>{{ $kematian->tempat_lahir }}, {{ \Carbon\Carbon::parse($kematian->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>{{ $kematian->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>{{ $kematian->alamat }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Kematian</strong></td>
                    <td>{{ \Carbon\Carbon::parse($kematian->tanggal_kematian)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Status Verifikasi</strong></td>
                    <td>{{ $kematian->status_verifikasi }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Dibuat</strong></td>
                    <td>{{ $kematian->created_at->translatedFormat('d F Y') }}</td>
                </tr>
            </table>

            <div style="margin-top: 30px; padding: 15px; background-color: #e9ecef; border-radius: 5px;">
                <h3>Informasi Surat</h3>
                <p><strong>Nomor Surat:</strong>  
                    @if($kematian->nomor_surat)
                        {{ $kematian->nomor_surat }}
                    @else
                        {{ $kematian->id }}/SKM/{{ date('Y') }}
                    @endif
                </p>
                <p><strong>Tanggal Verifikasi:</strong> {{ now()->translatedFormat('d F Y H:i:s') }}</p>
            </div>

        @else
            <div class="status invalid">
                ❌ SURAT TIDAK VALID
            </div>
            <p style="text-align: center;">{{ $pesan ?? 'Data surat tidak ditemukan dalam sistem.' }}</p>
        @endif

        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/') }}" class="back-button">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
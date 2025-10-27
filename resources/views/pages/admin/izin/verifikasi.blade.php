<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat Izin Kegiatan</title>
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
            <h1>VERIFIKASI SURAT IZIN KEGIATAN</h1>
            <p>Sistem Verifikasi Digital Desa Manggalung</p>
        </div>

        @if($valid && isset($izin))
            <div class="status valid">
                ✅ SURAT VALID - Terverifikasi di Sistem
            </div>

            <h2>Data Pemohon</h2>
            <table class="data-table">
                <tr>
                    <td width="200"><strong>Nama</strong></td>
                    <td>{{ $izin->nama }}</td>
                </tr>
                <tr>
                    <td><strong>NIK</strong></td>
                    <td>{{ $izin->nik }}</td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>{{ $izin->alamat }}</td>
                </tr>
                <tr>
                    <td><strong>Pekerjaan</strong></td>
                    <td>{{ $izin->pekerjaan ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>No HP</strong></td>
                    <td>{{ $izin->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $izin->email ?? '-' }}</td>
                </tr>
            </table>

            <h2>Detail Kegiatan</h2>
            <table class="data-table">
                <tr>
                    <td width="200"><strong>Jenis Kegiatan</strong></td>
                    <td>{{ $izin->jenis_acara }}</td>
                </tr>
                <tr>
                    <td><strong>Hari</strong></td>
                    <td>{{ $izin->hari }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>{{ \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Tempat</strong></td>
                    <td>{{ $izin->tempat }}</td>
                </tr>
            </table>

            <div style="margin-top: 30px; padding: 15px; background-color: #e9ecef; border-radius: 5px;">
                <h3>Informasi Surat</h3>
                <p><strong>Nomor Surat:</strong>  
                    @if($izin->nomor_surat)
                        {{ $izin->nomor_surat }}
                    @else
                        {{ $izin->id }}/SIZ/{{ date('Y') }}
                    @endif
                </p>
                <p><strong>Status Verifikasi:</strong> {{ $izin->status_verifikasi }}</p>
                <p><strong>Tanggal Dibuat:</strong> {{ $izin->created_at->translatedFormat('d F Y') }}</p>
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
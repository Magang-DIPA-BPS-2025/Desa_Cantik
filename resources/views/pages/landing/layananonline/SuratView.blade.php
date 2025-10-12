@extends('layouts.landing.app')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-3">
        <img src="{{ asset('img/stisla.svg') }}" alt="Logo" height="60">
    </div>
    <h3 class="text-center mb-4">{{ strtoupper($surat->jenisSurat->nama_surat ?? 'SURAT KETERANGAN') }}</h3>

    <div class="mb-3">
        <p>Yang bertanda tangan di bawah ini Kepala Desa menerangkan bahwa:</p>
        <table class="table table-borderless">
            <tr>
                <td style="width:220px">Nama</td>
                <td>: {{ $surat->penduduk->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $surat->penduduk->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>: {{ ($surat->penduduk->tempat_lahir ?? '-') . ', ' . ($surat->penduduk->tanggal_lahir ?? '-') }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $surat->penduduk->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nomor Surat</td>
                <td>: {{ $surat->nomor_surat }}</td>
            </tr>
            <tr>
                <td>Tanggal Dibuat</td>
                <td>: {{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d M Y') }}</td>
            </tr>
        </table>
    </div>

    <p class="mb-5">Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

    <div class="d-flex justify-content-between align-items-end mt-5">
        <div>
            <strong>{{ $kepalaDesa }}</strong>
        </div>
        <div class="text-right">
            @if ($surat->qr_code)
                <img src="{{ asset('storage/' . $surat->qr_code) }}" alt="QR Code" width="140">
            @endif
        </div>
    </div>
</div>
@endsection




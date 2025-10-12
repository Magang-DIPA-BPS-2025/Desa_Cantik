@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Detail Surat</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $surat->penduduk->nama ?? '-' }}</dd>

                        <dt class="col-sm-3">NIK</dt>
                        <dd class="col-sm-9">{{ $surat->penduduk->nik ?? '-' }}</dd>

                        <dt class="col-sm-3">Jenis Surat</dt>
                        <dd class="col-sm-9">{{ $surat->jenisSurat->nama_surat ?? '-' }}</dd>

                        <dt class="col-sm-3">Nomor Surat</dt>
                        <dd class="col-sm-9">{{ $surat->nomor_surat ?? '-' }}</dd>

                        <dt class="col-sm-3">Tanggal Dibuat</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d M Y') }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">{{ $surat->status }}</dd>

                        <dt class="col-sm-3">Keterangan</dt>
                        <dd class="col-sm-9">{{ $surat->keterangan ?? '-' }}</dd>
                    </dl>

                    @if ($surat->status !== 'Disetujui')
                        <div class="d-flex align-items-center">
                            <form action="{{ route('admin.surat.approve', $surat->id) }}" method="POST" class="mr-3">
                                @csrf
                                <button type="submit" class="btn btn-success">Verifikasi dan Setujui</button>
                            </form>

                            <form action="{{ route('admin.surat.reject', $surat->id) }}" method="POST" class="form-inline">
                                @csrf
                                <input type="text" name="keterangan" class="form-control mr-2" placeholder="Alasan penolakan" required>
                                <button type="submit" class="btn btn-danger">Tolak Surat</button>
                            </form>
                        </div>
                    @else
                        <div class="mt-4">
                            @if ($surat->qr_code)
                                <p><strong>QR Code:</strong></p>
                                <img src="{{ asset('storage/' . $surat->qr_code) }}" alt="QR Code" width="160">
                            @endif
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection




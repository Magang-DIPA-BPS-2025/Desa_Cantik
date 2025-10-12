@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="section-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">NIK</dt>
                        <dd class="col-sm-9">{{ $surat->nik }}</dd>
                        <dt class="col-sm-3">Jenis Surat</dt>
                        <dd class="col-sm-9">{{ $surat->jenis_surat }}</dd>
                        <dt class="col-sm-3">Usaha</dt>
                        <dd class="col-sm-9">{{ $surat->usaha ?? '-' }}</dd>
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">{{ $surat->status }}</dd>
                        <dt class="col-sm-3">Tanggal</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d M Y') }}</dd>
                    </dl>

                    @if ($surat->status !== 'Disetujui')
                        <form action="{{ route('admin.surat_pengantar.approve', $surat->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success">Verifikasi dan Setujui</button>
                        </form>
                    @else
                        <div class="mt-4 d-flex justify-content-between">
                            <strong>Kepala Desa</strong>
                            @if($surat->qr_code)
                                <img src="{{ asset('storage/' . $surat->qr_code) }}" width="140" alt="QR">
                            @endif
                        </div>
                    @endif
                </div>
                <div class="card-footer"><a href="{{ route('admin.surat_pengantar.index') }}" class="btn btn-secondary">Kembali</a></div>
            </div>
        </div>
    </section>
</div>
@endsection




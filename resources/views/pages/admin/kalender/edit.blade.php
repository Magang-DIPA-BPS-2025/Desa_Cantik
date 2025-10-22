@extends('layouts.app', ['title' => 'Edit Kegiatan'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Kegiatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('kalender.index') }}">Kalender Desa</a></div>
                <div class="breadcrumb-item">Edit Kegiatan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Kegiatan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kalender.update', $kalender->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Nama Kegiatan --}}
                                <div class="form-group">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                                        id="nama_kegiatan" 
                                        name="nama_kegiatan" 
                                        value="{{ old('nama_kegiatan', $kalender->nama_kegiatan) }}" 
                                        placeholder="Masukkan nama kegiatan">
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tanggal Kegiatan --}}
                                <div class="form-group">
                                    <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                    <input 
                                        type="date" 
                                        class="form-control @error('tanggal_kegiatan') is-invalid @enderror" 
                                        id="tanggal_kegiatan" 
                                        name="tanggal_kegiatan" 
                                        value="{{ old('tanggal_kegiatan', $kalender->tanggal_kegiatan->format('Y-m-d')) }}">
                                    @error('tanggal_kegiatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol --}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('kalender.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div> {{-- end card-body --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

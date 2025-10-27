@extends('layouts.app', ['title' => 'Edit Surat Izin Kegiatan'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Surat Izin Kegiatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('izin.index') }}">Surat Izin</a></div>
                <div class="breadcrumb-item">Edit Surat Izin</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('izin.update', $izin->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_surat">Nomor Surat</label>
                                    <input type="text" 
                                           class="form-control @error('nomor_surat') is-invalid @enderror" 
                                           id="nomor_surat" 
                                           name="nomor_surat" 
                                           value="{{ old('nomor_surat', $izin->nomor_surat) }}"
                                           placeholder="Contoh: 001/SIZ/2024">
                                    @error('nomor_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nik') is-invalid @enderror" 
                                           id="nik" 
                                           name="nik" 
                                           value="{{ old('nik', $izin->nik) }}" 
                                           required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" 
                                           name="nama" 
                                           value="{{ old('nama', $izin->nama) }}" 
                                           required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" 
                                           class="form-control @error('pekerjaan') is-invalid @enderror" 
                                           id="pekerjaan" 
                                           name="pekerjaan" 
                                           value="{{ old('pekerjaan', $izin->pekerjaan) }}">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" 
                                      name="alamat" 
                                      rows="3" 
                                      required>{{ old('alamat', $izin->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_acara">Jenis Acara/Kegiatan <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('jenis_acara') is-invalid @enderror" 
                                           id="jenis_acara" 
                                           name="jenis_acara" 
                                           value="{{ old('jenis_acara', $izin->jenis_acara) }}" 
                                           required>
                                    @error('jenis_acara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hari">Hari Pelaksanaan <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('hari') is-invalid @enderror" 
                                           id="hari" 
                                           name="hari" 
                                           value="{{ old('hari', $izin->hari) }}" 
                                           required>
                                    @error('hari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Kegiatan <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" 
                                           name="tanggal" 
                                           value="{{ old('tanggal', $izin->tanggal) }}" 
                                           required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat">Tempat Kegiatan <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('tempat') is-invalid @enderror" 
                                           id="tempat" 
                                           name="tempat" 
                                           value="{{ old('tempat', $izin->tempat) }}" 
                                           required>
                                    @error('tempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" 
                                           class="form-control @error('no_hp') is-invalid @enderror" 
                                           id="no_hp" 
                                           name="no_hp" 
                                           value="{{ old('no_hp', $izin->no_hp) }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $izin->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                            <a href="{{ route('izin.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
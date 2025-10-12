@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surat.update', $surat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="penduduk_id">Nama Penduduk</label>
                            <select name="penduduk_id" class="form-control @error('penduduk_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Penduduk --</option>
                                @foreach ($penduduks as $penduduk)
                                    <option value="{{ $penduduk->id }}" {{ old('penduduk_id', $surat->penduduk_id) == $penduduk->id ? 'selected' : '' }}>
                                        {{ $penduduk->nama }} ({{ $penduduk->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('penduduk_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_surat_id">Jenis Surat</label>
                            <select name="jenis_surat_id" class="form-control @error('jenis_surat_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                @foreach ($jenisSurats as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis_surat_id', $surat->jenis_surat_id) == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_surat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_surat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_dibuat">Tanggal Dibuat</label>
                            <input type="date" name="tanggal_dibuat" class="form-control @error('tanggal_dibuat') is-invalid @enderror" value="{{ old('tanggal_dibuat', $surat->tanggal_dibuat) }}" required>
                            @error('tanggal_dibuat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="menunggu_verifikasi" {{ old('status', $surat->status) == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                <option value="diproses" {{ old('status', $surat->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ old('status', $surat->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ old('status', $surat->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $surat->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('surat.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection




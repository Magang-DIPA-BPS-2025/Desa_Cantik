@extends('layouts.app', ['title' => 'Tambah PPID'])

@push('styles')
<style>
    .card {
        width: 100%;
        border-radius: 0;
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data PPID</h1>
        </div>

        <div class="section-body px-0">
            <div class="row mx-0">
                <div class="col-12 px-0">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('ppid.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Judul --}}
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Tanggal --}}
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Kategori --}}
                                <div class="form-group">
    <label for="kategori">Kategori Informasi</label>
    <select name="kategori" id="kategori" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="berkala">Informasi Berkala</option>
        <option value="serta">Informasi Serta Merta</option>
        <option value="setiap">Informasi Setiap Saat</option>
    </select>
</div>


                                {{-- File --}}
                                <div class="mb-3">
                                    <label for="file" class="form-label">File (Opsional)</label>
                                    <input type="file" id="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Tombol --}}
                                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-3">
                                    <a href="{{ route('ppid.index') }}" class="btn btn-secondary flex-fill flex-sm-auto">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary flex-fill flex-sm-auto">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

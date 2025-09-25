@extends('layouts.app', ['title' => 'Tambah Galeri Desa'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Foto Galeri</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4>Form Tambah Foto</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('galeriDesa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Judul --}}
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text"
                                       name="judul"
                                       id="judul"
                                       value="{{ old('judul') }}"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       placeholder="Masukkan judul foto">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gambar --}}
                            <div class="form-group">
                                <label for="gambar">Upload Foto</label>
                                <input type="file"
                                       name="gambar"
                                       id="gambar"
                                       class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('galeriDesa.index') }}" class="btn btn-secondary mx-2">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

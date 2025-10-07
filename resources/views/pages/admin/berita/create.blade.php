@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    {{-- Notifikasi --}}
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Berita Desa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Judul --}}
                                <div class="form-group">
                                    <label for="judul">Judul Berita</label>
                                    <input type="text" name="judul" id="judul"
                                           class="form-control @error('judul') is-invalid @enderror"
                                           value="{{ old('judul') }}" placeholder="Masukkan judul berita..." required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Kategori --}}
                                <div class="form-group mt-3">
                                    <label for="id_kategori">Kategori</label>
                                    <select name="id_kategori" id="id_kategori"
                                            class="form-control @error('id_kategori') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi Singkat --}}
                                <div class="form-group mt-3">
                                    <label for="deskripsi_singkat">Deskripsi Singkat</label>
                                    <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="5"
                                              class="form-control @error('deskripsi_singkat') is-invalid @enderror"
                                              placeholder="Tuliskan deskripsi singkat berita..." required>{{ old('deskripsi_singkat') }}</textarea>
                                    @error('deskripsi_singkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- Tanggal Event (opsional) --}}
                                <div class="form-group mt-3">
                                    <label for="tanggal_event">Tanggal Event (Opsional)</label>
                                    <input type="date" name="tanggal_event" id="tanggal_event"
                                           class="form-control @error('tanggal_event') is-invalid @enderror"
                                           value="{{ old('tanggal_event') }}">
                                    @error('tanggal_event')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Foto --}}
                                <div class="form-group mt-3">
                                    <label for="foto">Foto Berita</label>
                                    <input type="file" name="foto" id="foto"
                                           class="form-control @error('foto') is-invalid @enderror" required>
                                    <small class="text-muted">Format diperbolehkan: JPG, JPEG, PNG, GIF (maks. 2MB)</small>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('berita.index') }}" class="btn btn-secondary mr-2">
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
            </div>
        </div>
    </section>
</div>
@endsection

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
                                <h4>Form Edit Berita</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Judul --}}
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" id="judul"
                                               class="form-control @error('judul') is-invalid @enderror"
                                               value="{{ old('judul', $berita->judul) }}" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Kategori --}}
                                    <div class="form-group mt-3">
                                        <label for="id_kategori">Kategori</label>
                                        <select name="id_kategori" id="id_kategori"
                                                class="form-control @error('id_kategori') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}"
                                                    {{ old('id_kategori', $berita->id_kategori) == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div class="form-group mt-3">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                                  required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Gambar --}}
                                    <div class="form-group mt-3">
                                        <label for="gambar">Gambar</label>
                                        <div class="mb-2">
                                            @if ($berita->gambar)
                                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" width="120">
                                            @else
                                                <p>Tidak ada gambar</p>
                                            @endif
                                        </div>
                                        <input type="file" name="gambar" id="gambar"
                                               class="form-control @error('gambar') is-invalid @enderror">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tombol Aksi --}}
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="{{ route('berita.index') }}" class="btn btn-secondary mr-2">Batal</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
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

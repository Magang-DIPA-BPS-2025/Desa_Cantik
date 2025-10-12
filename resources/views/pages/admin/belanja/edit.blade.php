@extends('layouts.app', ['title' => 'Edit UMKM'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit UMKM</h1>
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
                            <h4>Form Edit UMKM Desa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('belanja.update', $belanja->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Judul --}}
                                <div class="form-group">
                                    <label for="judul">Judul UMKM</label>
                                    <input type="text" name="judul" id="judul"
                                           class="form-control @error('judul') is-invalid @enderror"
                                           value="{{ old('judul', $belanja->judul) }}" placeholder="Masukkan judul UMKM..." required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Harga --}}
                                <div class="form-group mt-3">
                                    <label for="harga">Harga (Rp)</label>
                                    <input type="number" name="harga" id="harga"
                                           class="form-control @error('harga') is-invalid @enderror"
                                           value="{{ old('harga', $belanja->harga) }}" placeholder="Masukkan harga..." required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Rating --}}
                                <div class="form-group mt-3">
                                    <label for="rating">Rating (0-5)</label>
                                    <input type="number" step="0.1" name="rating" id="rating"
                                           class="form-control @error('rating') is-invalid @enderror"
                                           value="{{ old('rating', $belanja->rating) }}" min="0" max="5" placeholder="Masukkan rating..." required>
                                    @error('rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- WhatsApp --}}
                                <div class="form-group mt-3">
                                    <label for="wa">Nomor WhatsApp (Opsional)</label>
                                    <input type="text" name="wa" id="wa"
                                           class="form-control @error('wa') is-invalid @enderror"
                                           value="{{ old('wa', $belanja->wa) }}" placeholder="Contoh: 6281234567890">
                                    @error('wa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Foto --}}
                                <div class="form-group mt-3">
                                    <label for="foto">Foto UMKM</label>
                                    <input type="file" name="foto" id="foto"
                                           class="form-control @error('foto') is-invalid @enderror">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto. Format diperbolehkan: JPG, JPEG, PNG, GIF (maks. 2MB)</small>
                                    @if($belanja->foto)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $belanja->foto) }}" alt="Foto UMKM" width="150">
                                        </div>
                                    @endif
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('belanja.index') }}" class="btn btn-secondary mr-2">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
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

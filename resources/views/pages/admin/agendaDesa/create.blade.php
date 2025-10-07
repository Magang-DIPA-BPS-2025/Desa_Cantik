@extends('layouts.app', ['title' => 'Tambah Agenda'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Agenda</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    {{-- Tambahkan enctype agar bisa upload file --}}
                    <form action="{{ route('AgendaDesa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                   class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                   value="{{ old('nama_kegiatan') }}" required>
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori"
                                    class="form-control @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Umum','Rapat','Pelatihan','Sosialisasi','Acara Resmi','Internal','Eksternal'] as $option)
                                    <option value="{{ $option }}" {{ old('kategori') == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="waktu_pelaksanaan">Waktu Pelaksanaan</label>
                            <input type="datetime-local" name="waktu_pelaksanaan" id="waktu_pelaksanaan"
                                   class="form-control @error('waktu_pelaksanaan') is-invalid @enderror"
                                   value="{{ old('waktu_pelaksanaan') }}" required>
                            @error('waktu_pelaksanaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- === Tambahan field foto === --}}
                        <div class="form-group">
                            <label for="foto">Foto Agenda</label>
                            <input type="file" name="foto" id="foto"
                                   class="form-control-file @error('foto') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(event)">
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            {{-- Preview gambar --}}
                            <div class="mt-3">
                                <img id="preview" src="#" alt="Preview Foto"
                                     style="display: none; width: 150px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('AgendaDesa.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Script untuk preview foto --}}
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.style.display = 'none';
        }
    }
</script>
@endsection

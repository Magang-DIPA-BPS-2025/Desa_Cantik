@extends('layouts.app', ['title' => 'Edit Buku Tamu'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Buku Tamu</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.buku.update', $bukuTamu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $bukuTamu->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="asal">Asal Instansi</label>
                            <input type="text" name="asal" id="asal"
                                   class="form-control @error('asal') is-invalid @enderror"
                                   value="{{ old('asal', $bukuTamu->asal) }}" required>
                            @error('asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_hp">Nomor HP</label>
                            <input type="text" name="nomor_hp" id="nomor_hp"
                                   class="form-control @error('nomor_hp') is-invalid @enderror"
                                   value="{{ old('nomor_hp', $bukuTamu->nomor_hp) }}">
                            @error('nomor_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <textarea name="keperluan" id="keperluan" rows="3"
                                      class="form-control @error('keperluan') is-invalid @enderror"
                                      required>{{ old('keperluan', $bukuTamu->keperluan) }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

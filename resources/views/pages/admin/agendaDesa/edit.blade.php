@extends('layouts.app', ['title' => 'Edit Agenda Desa'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Agenda Desa</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('AgendaDesa.update', $agenda->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                   class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                   value="{{ old('nama_kegiatan', $agenda->nama_kegiatan) }}" required>
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      required>{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
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
                                    <option value="{{ $option }}" {{ old('kategori', $agenda->kategori) == $option ? 'selected' : '' }}>{{ $option }}</option>
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
                                   value="{{ old('waktu_pelaksanaan', \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->format('Y-m-d\TH:i')) }}" required>
                            @error('waktu_pelaksanaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('AgendaDesa.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

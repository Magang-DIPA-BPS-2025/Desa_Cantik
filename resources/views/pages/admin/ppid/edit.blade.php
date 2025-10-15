@extends('layouts.app', ['title' => 'Edit PPID'])

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
            <h1>Edit Data PPID</h1>
        </div>

        <div class="section-body px-0">
            <div class="row mx-0">
                <div class="col-12 px-0">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('ppid.update', $ppid->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Judul --}}
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $ppid->judul) }}" required>
                                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $ppid->deskripsi) }}</textarea>
                                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Tanggal --}}
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $ppid->tanggal ? $ppid->tanggal->format('Y-m-d') : '') }}" required>
                                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Kategori --}}
                                <div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="berkala" {{ old('kategori') == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
        <option value="serta" {{ old('kategori') == 'serta' ? 'selected' : '' }}>Informasi Serta Merta</option>
        <option value="setiap" {{ old('kategori') == 'setiap' ? 'selected' : '' }}>Informasi Setiap Saat</option>
    </select>
    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>


                                {{-- File Saat Ini --}}
                                <div class="mb-3">
                                    <label class="form-label">File Saat Ini</label><br>
                                    @if($ppid->file)
                                        <a href="{{ asset('storage/' . $ppid->file) }}" target="_blank">{{ $ppid->file }}</a>
                                    @else
                                        <span class="text-muted">Tidak ada file</span>
                                    @endif
                                </div>

                                {{-- Ganti File --}}
                                <div class="mb-3">
                                    <label for="file" class="form-label">Ganti File (opsional)</label>
                                    <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                </div>

                                {{-- Tombol --}}
                                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-3">
                                    <a href="{{ route('ppid.index') }}" class="btn btn-secondary flex-fill flex-sm-auto">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary flex-fill flex-sm-auto">
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

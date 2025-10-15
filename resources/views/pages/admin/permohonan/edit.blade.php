@extends('layouts.app', ['title' => 'Edit Permohonan Informasi'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Permohonan Informasi</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $permohonan->nama) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $permohonan->nomor_telepon) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Asal Instansi</label>
                            <input type="text" name="asal_instansi" value="{{ old('asal_instansi', $permohonan->asal_instansi) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="alamat_email" value="{{ old('alamat_email', $permohonan->alamat_email) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Isi Permohonan</label>
                            <textarea name="permohonan" class="form-control" required>{{ old('permohonan', $permohonan->permohonan) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Upload File (Opsional)</label>
                            <input type="file" name="file_path" class="form-control">

                            @if ($permohonan->file_path)
                                <div class="mt-2">
                                    <p>File saat ini:</p>
                                    <a href="{{ asset('storage/' . $permohonan->file_path) }}" 
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file"></i> Lihat / Unduh File
                                    </a>

                                    {{-- Jika kamu ingin preview langsung di bawahnya --}}
                                    @if(Str::endsWith($permohonan->file_path, ['jpg', 'jpeg', 'png']))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $permohonan->file_path) }}" 
                                                 alt="Preview" width="200" 
                                                 class="img-thumbnail border">
                                        </div>
                                    @elseif(Str::endsWith($permohonan->file_path, ['pdf']))
                                        <div class="mt-3">
                                            <iframe src="{{ asset('storage/' . $permohonan->file_path) }}" 
                                                    width="100%" height="400px"></iframe>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('permohonan.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

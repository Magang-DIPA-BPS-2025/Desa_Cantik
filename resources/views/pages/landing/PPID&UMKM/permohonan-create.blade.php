@extends('layouts.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Form Permohonan Informasi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('permohonan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" required>
        </div>
        <div class="mb-3">
            <label for="asal_instansi" class="form-label">Asal Instansi</label>
            <input type="text" name="asal_instansi" class="form-control" id="asal_instansi">
        </div>
        <div class="mb-3">
            <label for="alamat_email" class="form-label">Email</label>
            <input type="email" name="alamat_email" class="form-control" id="alamat_email" required>
        </div>
        <div class="mb-3">
            <label for="permohonan" class="form-label">Permohonan Informasi</label>
            <textarea name="permohonan" class="form-control" id="permohonan" rows="5" required></textarea>
        </div>
        <button type="submit" 
        class="btn btn-success mt-3 mb-3" 
        style="background-color: #1b7d48; border-color: #1b7d48;">
    Kirim Permohonan
</button>

    </form>

    {{-- Tombol Kembali --}}
    <a href="{{ route('ppid') }}" class="btn btn-secondary mt-2">
        <i class="fas fa-arrow-left"></i> Kembali ke PPID
    </a>
</div>
@endsection

@extends('layouts.error', ['title' => '403 - Akses Ditolak'])

@section('content')
<div class="error-container">
    <div class="error-code">403</div>
    <div class="error-message">
        <i class="fas fa-ban fa-lg text-danger mb-3"></i><br>
        Maaf, Anda tidak memiliki akses ke halaman ini
    </div>
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ url('/') }}" class="btn btn-home">
            <i class="fas fa-home me-2"></i>Kembali ke Beranda
        </a>
        <button onclick="history.back()" class="btn btn-outline-primary ms-2">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </button>
    </div>
</div>
@endsection
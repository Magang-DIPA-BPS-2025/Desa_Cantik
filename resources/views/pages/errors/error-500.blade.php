@extends('layouts.error', ['title' => '500 - Kesalahan Server'])

@section('content')
<div class="error-container">
    <div class="error-code">500</div>
    <div class="error-message">
        <i class="fas fa-exclamation-triangle fa-lg text-warning mb-3"></i><br>
        Maaf, terjadi kesalahan pada server
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
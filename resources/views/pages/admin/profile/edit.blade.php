@extends('layouts.app', ['title' => 'Edit Profil'])

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Edit Profil</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Profil</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Profil</h4>
                    </div>
                    <div class="card-body">

                        {{-- ALERT --}}
                        @if (session('message'))
                            @if (session('message') == 'update' || session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <i class="fas fa-check-circle"></i> Profil berhasil diperbarui
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <i class="fas fa-exclamation-circle"></i> {{ session('message') }}
                                    </div>
                                </div>
                            @endif
                        @endif

                        {{-- VALIDATION ERRORS --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           placeholder="Masukkan Nama Lengkap"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('username') is-invalid @enderror" 
                                           name="username" 
                                           value="{{ old('username', $user->username) }}" 
                                           placeholder="Masukkan Username"
                                           required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Username digunakan untuk login
                                    </small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Password Baru</label>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           placeholder="Kosongkan jika tidak ingin mengubah password"
                                           minlength="6">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.
                                    </small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Role</label>
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ ucfirst($user->role) }}" 
                                           disabled>
                                    <small class="form-text text-muted">
                                        Role tidak dapat diubah
                                    </small>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

@push('scripts')
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
@endsection


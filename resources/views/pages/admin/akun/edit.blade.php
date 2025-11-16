@extends('layouts.app', ['title' => 'Edit Akun'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Akun</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('akun.update', $datas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $datas->id }}">
                            <input type="hidden" name="role" value="admin">

                            <div class="card">
                                <div class="card-body">

                                    {{-- ALERT --}}
                                    @if (session('message'))
                                        @if (session('message') == 'update')
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle"></i> Akun berhasil diperbarui
                                            </div>
                                        @elseif(strpos(session('message'), 'berhasil') !== false || strpos(session('message'), 'sukses') !== false)
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle"></i> {{ session('message') }}
                                            </div>
                                        @else
                                            <div class="alert alert-danger">
                                                <i class="fas fa-exclamation-circle"></i> {{ session('message') }}
                                            </div>
                                        @endif
                                    @endif

                                    {{-- VALIDATION ERRORS --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input value="{{ $datas->name }}" name="name" required
                                                    placeholder="Masukkan Nama Akun" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input value="{{ $datas->username }}" name="username" required
                                                    placeholder="Masukkan Username untuk login" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password (Kosongkan jika tidak ingin diubah)</label>
                                                <input name="password" placeholder="Masukkan Password" type="password"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Update Data Akun
                                            </button>
                                        </div>
                                        <div class="col-md-8 text-right">
                                            <a href="{{ route('akun.index') }}" class="btn btn-warning my-2">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
@endsection
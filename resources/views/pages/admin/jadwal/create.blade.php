@extends('layouts.app', ['title' => 'Tambah Jadwal'])
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Jadwal</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Tambah Jadwal</h4>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Nama Tema</label>
                                    <div class="col-md-7">
                                        <select class="form-control select2 @error('pelajaran_id') is-invalid @enderror" name="pelajaran_id" required>
                                            <option value="">--- Pilih Tema ---</option>
                                            @foreach ($tema as $item)
                                                <option value="{{ $item->id }}" {{ old('pelajaran_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pelajaran_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Kelas</label>
                                    <div class="col-md-7">
                                        <select class="form-control select2 @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                                            <option value="">--- Pilih Kelas ---</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nm_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Guru</label>
                                    <div class="col-md-7">
                                        <select class="form-control select2 @error('guru_id') is-invalid @enderror" name="guru_id" required>
                                            <option value="">--- Pilih Guru ---</option>
                                            @foreach ($guru as $item)
                                                <option value="{{ $item->id }}" {{ old('guru_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('guru_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Hari</label>
                                    <div class="col-md-7">
                                        <select class="form-control select2 @error('hari') is-invalid @enderror" name="hari" required>
                                            <option value="">--- Pilih Hari ---</option>
                                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
                                                    {{ $hari }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Waktu Mulai</label>
                                    <div class="col-md-7">
                                        <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror" required value="{{ old('waktu_mulai') }}">
                                        @error('waktu_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Waktu Selesai</label>
                                    <div class="col-md-7">
                                        <input type="time" name="waktu_selesai" class="form-control @error('waktu_selesai') is-invalid @enderror" required value="{{ old('waktu_selesai') }}">
                                        @error('waktu_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Keterangan</label>
                                    <div class="col-md-7">
                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <button class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('jadwal.index') }}" class="btn btn-warning">Kembali</a>
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
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
@endsection

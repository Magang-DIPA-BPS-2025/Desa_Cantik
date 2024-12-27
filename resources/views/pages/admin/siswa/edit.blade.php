@extends('layouts.app', ['title' => 'Edit Data Guru RPPH'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Guru</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('guru.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $pegawai->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input name="nama_lengkap" value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap">
                                                @error('nama_lengkap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input name="nip" value="{{ old('nip', $pegawai->nip) }}" type="text" class="form-control @error('nip') is-invalid @enderror" id="nip">
                                                @error('nip')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_ktp">Nomor KTP</label>
                                                <input name="no_ktp" value="{{ old('no_ktp', $pegawai->no_ktp) }}" type="number" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp">
                                                @error('no_ktp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="jenis_pegawai">Status Kepegawaian</label>
                                                <select name="jenis_pegawai" class="form-control selectric @error('jenis_pegawai') is-invalid @enderror" id="jenis_pegawai">
                                                    <option value="">-- Pilih status kepegawaian --</option>
                                                    <option value="BBGP" {{ old('jenis_pegawai', $pegawai->jenis_pegawai) == 'BBGP' ? 'selected' : '' }}>Pegawai BBGP</option>
                                                    <option value="PPNPN" {{ old('jenis_pegawai', $pegawai->jenis_pegawai) == 'PPNPN' ? 'selected' : '' }}>Pegawai PPNPN</option>
                                                </select>
                                                @error('jenis_pegawai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="golongan">Golongan</label>
                                                <select name="golongan" class="form-control select2 @error('golongan') is-invalid @enderror" id="golongan">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach ($datas['golongan'] as $v)
                                                        <option value="{{ $v->name }}" {{ old('golongan', $pegawai->golongan) == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('golongan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <select name="jabatan" class="form-control select2 @error('jabatan') is-invalid @enderror" id="jabatan">
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    @foreach ($datas['jabatan'] as $v)
                                                        <option value="{{ $v->name }}" {{ old('jabatan', $pegawai->jabatan) == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary mx-1">Reset</button>
                                    <a href="{{ session('role') == 'pegawai' ? route('pegawai.show', session('no_ktp')) : route('pegawai.index') }}" class="btn btn-warning">Kembali</a>
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
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    @endpush
@endsection

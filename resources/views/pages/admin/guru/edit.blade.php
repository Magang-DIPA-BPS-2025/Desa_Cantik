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
                    <form action="{{ route('guru.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input name="nama_lengkap"
                                                value="{{ old('nama_lengkap', $data->nama_lengkap) }}" type="text"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="nama_lengkap">
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input name="nip" value="{{ old('nip', $data->nip) }}" type="text"
                                                class="form-control @error('nip') is-invalid @enderror" id="nip">
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input name="email" value="{{ old('email', $data->email) }}" type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="no_hp">No. Handphone</label>
                                            <input name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" type="text"
                                                class="form-control @error('no_hp') is-invalid @enderror" id="no_hp">
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_ktp">Nomor KTP</label>
                                            <input name="no_ktp" value="{{ old('no_ktp', $data->no_ktp) }}"
                                                type="number" class="form-control @error('no_ktp') is-invalid @enderror"
                                                id="no_ktp">
                                            @error('no_ktp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender"
                                                class="form-control select2 @error('gender') is-invalid @enderror"
                                                id="gender">
                                                <option value="Laki-laki" {{ old('gender', $data->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('gender', $data->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input name="tempat_lahir"
                                                value="{{ old('tempat_lahir', $data->tempat_lahir) }}" type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                id="tempat_lahir">
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input name="tgl_lahir" value="{{ old('tgl_lahir', $data->tgl_lahir) }}"
                                                type="date"
                                                class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                id="tgl_lahir">
                                            @error('tgl_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input name="agama" value="{{ old('agama', $data->agama) }}" type="text"
                                                class="form-control @error('agama') is-invalid @enderror" id="agama">
                                            @error('agama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat_rumah">Alamat Rumah</label>
                                            <input name="alamat_rumah"
                                                value="{{ old('alamat_rumah', $data->alamat_rumah) }}" type="text"
                                                class="form-control @error('alamat_rumah') is-invalid @enderror"
                                                id="alamat_rumah">
                                            @error('alamat_rumah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pas_foto">Pas Foto</label>
                                    <input type="file" name="pas_foto"
                                        class="form-control @error('pas_foto') is-invalid @enderror" id="pas_foto">
                                    @error('pas_foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary mx-1">Reset</button>
                                <a href="{{ route('guru.index') }}" class="btn btn-warning">Kembali</a>
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
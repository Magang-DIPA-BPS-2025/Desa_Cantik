@extends('layouts.app', ['title' => 'Data Guru'])
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Guru</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Tambah Guru</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Nama Lengkap</label>
                                    <div class="col-md-7">
                                        <input required type="text" name="nama_lengkap" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Email</label>
                                    <div class="col-md-7">
                                        <input required type="email" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Nomor KTP</label>
                                    <div class="col-md-7">
                                        <input required type="number" name="no_ktp" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">NIP</label>
                                    <div class="col-md-7">
                                        <input required type="number" name="nip" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Tempat Lahir</label>
                                    <div class="col-md-7">
                                        <input required type="text" name="tempat_lahir" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Tanggal Lahir</label>
                                    <div class="col-md-7">
                                        <input required type="date" name="tgl_lahir" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Gender</label>
                                    <div class="col-md-7">
                                        <select class="form-control selectric" name="gender" required>
                                            <option value="#">---Pilih-Gender---</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Agama</label>
                                    <div class="col-md-7">
                                        <select class="form-control selectric" name="agama" required>
                                        <option value="#">---Pilih-Agama---</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Alamat</label>
                                    <div class="col-md-7">
                                        <textarea required name="alamat_rumah" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Nomor Handphone</label>
                                    <div class="col-md-7">
                                        <input required type="text" name="no_hp" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Foto</label>
                                    <div class="col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Pilih Foto</label>
                                            <input required type="file" name="pas_foto" id="image-upload">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <button class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('guru.index') }}" class="btn btn-warning">Kembali</a>
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
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
@endsection
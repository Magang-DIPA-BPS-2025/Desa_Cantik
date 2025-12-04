@extends('layouts.app', ['title' => 'Data Penduduk'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
        <style>
            /* Styling untuk tombol */
            .form-buttons {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-top: 20px;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                min-width: 100px;
                padding: 8px 20px;
            }

            .btn-warning {
                background-color: #ffc107;
                border-color: #ffc107;
                color: #212529;
                min-width: 100px;
                padding: 8px 20px;
            }

            /* Styling untuk dropdown agar font ditengah */
            .selectric .label {
                display: flex;
                align-items: center;
                height: 100%;
                margin: 0;
                font-size: 14px;
                line-height: 1.5;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Penduduk</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('dataPenduduk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Tambah Penduduk</h4>
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

                                    <!-- Field-field form -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">NIK</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="nik" class="form-control"
                                                value="{{ old('nik') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">No KK</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="nokk" class="form-control"
                                                value="{{ old('nokk') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="nama" class="form-control"
                                                value="{{ old('nama') }}">
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Jenis Kelamin</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="jenis_kelamin" required>
                                                <option value="">--- Pilih Jenis Kelamin ---</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tempat Lahir</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="tempat_lahir" class="form-control"
                                                value="{{ old('tempat_lahir') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tanggal Lahir</label>
                                        <div class="col-md-7">
                                            <input required type="date" name="tanggal_lahir" class="form-control"
                                                value="{{ old('tanggal_lahir') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Alamat</label>
                                        <div class="col-md-7">
                                            <textarea required name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Dusun</label>
                                        <div class="col-md-7">
                                            <select name="dusun" class="form-control selectric">
                                                <option value="">-- Pilih Dusun --</option>
                                                <option value="Manggalung" {{ old('dusun') == 'Manggalung' ? 'selected' : '' }}>Manggalung</option>
                                                <option value="Lokae" {{ old('dusun') == 'Lokae' ? 'selected' : '' }}>Lokae</option>
                                                <option value="Kattena" {{ old('dusun') == 'Kattena' ? 'selected' : '' }}>Kattena</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">RT</label>
                                        <div class="col-md-3">
                                            <input required type="text" name="rt" class="form-control"
                                                value="{{ old('rt') }}">
                                        </div>

                                        <label class="col-form-label col-md-1">RW</label>
                                        <div class="col-md-3">
                                            <input required type="text" name="rw" class="form-control"
                                                value="{{ old('rw') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Desa</label>
                                        <div class="col-md-7">
                                            <input
                                                type="text"
                                                name="keldesa"
                                                class="form-control"
                                                value="Manggalung"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Kecamatan</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="kecamatan" class="form-control"
                                                value="{{ old('kecamatan') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Agama</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="agama" required>
                                                <option value="">--- Pilih Agama ---</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Status Perkawinan</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="status_perkawinan" required>
                                                <option value="">--- Pilih Status ---</option>
                                                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Pekerjaan -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Pekerjaan</label>
                                        <div class="col-md-7">
                                            <select name="pekerjaan" class="form-control selectric" required>
                                                <option value="">-- Pilih Pekerjaan --</option>
                                                <option value="Belum/Tidak Bekerja" {{ old('pekerjaan') == 'Belum/Tidak Bekerja' ? 'selected' : '' }}>Belum/Tidak Bekerja</option>
                                                <option value="Petani" {{ old('pekerjaan') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                                <option value="Nelayan" {{ old('pekerjaan') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                                <option value="Pedagang" {{ old('pekerjaan') == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                                <option value="PNS" {{ old('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Guru" {{ old('pekerjaan') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                                <option value="Karyawan Swasta" {{ old('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                <option value="Tukang" {{ old('pekerjaan') == 'Tukang' ? 'selected' : '' }}>Tukang</option>
                                                <option value="Lainnya" {{ old('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Kewarganegaraan</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="kewarganegaraan" class="form-control"
                                                value="{{ old('kewarganegaraan') }}">
                                        </div>
                                    </div>

                                    <!-- Pendidikan -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Pendidikan</label>
                                        <div class="col-md-7">
                                            <select name="pendidikan" class="form-control selectric" required>
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="Tidak Sekolah" {{ old('pendidikan') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                                <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                                <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                                <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                                <option value="D1" {{ old('pendidikan') == 'D1' ? 'selected' : '' }}>Diploma 1 (D1)</option>
                                                <option value="D2" {{ old('pendidikan') == 'D2' ? 'selected' : '' }}>Diploma 2 (D2)</option>
                                                <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                                <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Disabilitas -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Disabilitas</label>
                                        <div class="col-md-7">
                                            <select name="disabilitas" class="form-control selectric" required>
                                                <option value="">-- Pilih Disabilitas --</option>
                                                <option value="Tidak Ada" {{ old('disabilitas') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                                                <option value="Fisik" {{ old('disabilitas') == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                                                <option value="Intelektual" {{ old('disabilitas') == 'Intelektual' ? 'selected' : '' }}>Intelektual</option>
                                                <option value="Mental" {{ old('disabilitas') == 'Mental' ? 'selected' : '' }}>Mental</option>
                                                <option value="Sensorik" {{ old('disabilitas') == 'Sensorik' ? 'selected' : '' }}>Sensorik</option>
                                                <option value="Ganda" {{ old('disabilitas') == 'Ganda' ? 'selected' : '' }}>Disabilitas Ganda</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tahun -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tahun</label>
                                        <div class="col-md-7">
                                            <div class="form-action-container">
                                                <div class="tahun-field">
                                                    <select name="tahun" class="form-control selectric" required>
                                                        @php
                                                            $currentYear = date('Y');
                                                        @endphp
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <option value="{{ $currentYear - $i }}"
                                                                {{ old('tahun') == ($currentYear - $i) ? 'selected' : '' }}>
                                                                {{ $currentYear - $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="button-container">
                                                    <div class="form-buttons">
                                                        <a href="{{ route('dataPenduduk.index') }}" class="btn btn-warning">Batal</a>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
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
        <script>
            $(document).ready(function() {
                // Inisialisasi semua select dengan selectric
                $('select').selectric();

                // Styling untuk teks di tengah dropdown
                $('.selectric .label').css({
                    'display': 'flex',
                    'align-items': 'center',
                    'justify-content': 'flex-start',
                    'height': '100%',
                    'line-height': '1.5'
                });
            });
        </script>
    @endpush
@endsection

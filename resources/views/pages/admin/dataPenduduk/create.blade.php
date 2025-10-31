@extends('layouts.app', ['title' => 'Data Penduduk'])

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
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control selectric" name="jenis_kelamin" required>
                                            <option value="">--- Pilih Jenis Kelamin ---</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
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
                                            <textarea required name="alamat"
                                                class="form-control">{{ old('alamat') }}</textarea>
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Dusun</label>
                                    <div class="col-md-7">
                                        <select name="dusun" class="form-control">
                                            <option value="">-- Pilih Dusun --</option>
                                            <option value="Manggalung" {{ old('dusun') == 'Manggalung' ? 'selected' : '' }}>Manggalung</option>
                                            <option value="Lokae" {{ old('dusun') == 'Lokae' ? 'selected' : '' }}>Lokae</option>
                                            <option value="Kattena" {{ old('dusun') == 'Kattena' ? 'selected' : '' }}>Kattena</option>
                                            <option value="Mallawa" {{ old('dusun') == 'Mallawa' ? 'selected' : '' }}>Mallawa</option>
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
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Status Perkawinan</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="status_perkawinan" required>
                                                <option value="">--- Pilih Status ---</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Pekerjaan --}}
                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <select name="pekerjaan" id="pekerjaan" class="form-control" required>
                                            <option value="">-- Pilih Pekerjaan --</option>
                                            <option value="Belum/Tidak Bekerja" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Belum/Tidak Bekerja' ? 'selected' : '' }}>Belum/Tidak Bekerja
                                            </option>
                                            <option value="Petani" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                            <option value="Nelayan" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                            <option value="Pedagang" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                            <option value="PNS" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                            <option value="Guru" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                            <option value="Karyawan Swasta" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                            <option value="Tukang" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Tukang' ? 'selected' : '' }}>Tukang</option>
                                            <option value="Lainnya" {{ old('pekerjaan', $dataPenduduk->pekerjaan ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Kewarganegaraan</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="kewarganegaraan" class="form-control"
                                                value="{{ old('kewarganegaraan') }}">
                                        </div>
                                    </div>

                                    {{-- Pendidikan --}}
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan</label>
                                        <select name="pendidikan" id="pendidikan" class="form-control" required>
                                            <option value="">-- Pilih Pendidikan --</option>
                                            <option value="Tidak Sekolah" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                            <option value="SD" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                                            <option value="SMP" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                            <option value="SMA" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                            <option value="D1" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'D1' ? 'selected' : '' }}>Diploma 1 (D1)</option>
                                            <option value="D2" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'D2' ? 'selected' : '' }}>Diploma 2 (D2)</option>
                                            <option value="D3" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                            <option value="S1" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('pendidikan', $dataPenduduk->pendidikan ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                    </div>

                                    {{-- Disabilitas --}}
                                    <div class="form-group">
                                        <label for="disabilitas">Disabilitas</label>
                                        <select name="disabilitas" id="disabilitas" class="form-control" required>
                                            <option value="">-- Pilih Disabilitas --</option>
                                            <option value="Tidak Ada" {{ old('disabilitas', $dataPenduduk->disabilitas ?? '') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                                            <option value="Fisik" {{ old('disabilitas', $dataPenduduk->disabilitas ?? '') == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                                            <option value="Intelektual" {{ old('disabilitas', $dataPenduduk->disabilitas ?? '') == 'Intelektual' ? 'selected' : '' }}>Intelektual</option>
                                            <option value="Mental" {{ old('disabilitas', $dataPenduduk->disabilitas ?? '') == 'Mental' ? 'selected' : '' }}>Mental</option>
                                            <option value="Sensorik" {{ old('disabilitas', $dataPenduduk->disabilitas ?? '') == 'Sensorik' ? 'selected' : '' }}>Sensorik</option>
                                            <option value="Ganda" {{ old('disabilitas', $dataPenduduk->disabilitas ?? '') == 'Ganda' ? 'selected' : '' }}>Disabilitas Ganda</option>
                                        </select>
                                    </div>

                            <div class="form-group row">
                                    <label class="col-form-label col-md-3">Tahun</label>
                                    <div class="col-md-7">
                                        <select name="tahun" class="form-control" required>
                                            @php
                                                $currentYear = date('Y'); // tahun sekarang
                                            @endphp
                                            @for ($i = 0; $i < 5; $i++)
                                                <option value="{{ $currentYear - $i }}"
                                                    {{ old('tahun') == ($currentYear - $i) ? 'selected' : '' }}>
                                                    {{ $currentYear - $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>


                                    <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                            <a href="{{ route('dataPenduduk.index') }}" class="btn btn-warning">Kembali</a>
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

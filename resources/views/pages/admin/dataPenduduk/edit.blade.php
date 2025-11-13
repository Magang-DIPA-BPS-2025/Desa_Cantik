@extends('layouts.app', ['title' => 'Edit Data Penduduk'])

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
                <h1>Edit Data Penduduk</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('dataPenduduk.update', $dataPenduduk->nik) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Edit Penduduk</h4>
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
                                            <input type="text" name="nik" class="form-control"
                                                value="{{ old('nik', $dataPenduduk->nik) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">No KK</label>
                                        <div class="col-md-7">
                                            <input type="text" name="nokk" class="form-control"
                                                value="{{ old('nokk', $dataPenduduk->nokk) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                                        <div class="col-md-7">
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ old('nama', $dataPenduduk->nama) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control selectric" name="jenis_kelamin" required>
                                            <option value="">--- Pilih Jenis Kelamin ---</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $dataPenduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $dataPenduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tempat Lahir</label>
                                        <div class="col-md-7">
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                value="{{ old('tempat_lahir', $dataPenduduk->tempat_lahir) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tanggal Lahir</label>
                                        <div class="col-md-7">
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                value="{{ old('tanggal_lahir', $dataPenduduk->tanggal_lahir) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Alamat</label>
                                        <div class="col-md-7">
                                            <textarea name="alamat" class="form-control" required>{{ old('alamat', $dataPenduduk->alamat) }}</textarea>
                                        </div>
                                    </div>

                                   <div class="form-group row">
                                    <label class="col-form-label col-md-3">Dusun</label>
                                    <div class="col-md-7">
                                        <select name="dusun" class="form-control">
                                            <option value="">-- Pilih Dusun --</option>
                                            <option value="Manggalung" {{ old('dusun', $dataPenduduk->dusun) == 'Manggalung' ? 'selected' : '' }}>Manggalung</option>
                                            <option value="Lokae" {{ old('dusun', $dataPenduduk->dusun) == 'Lokae' ? 'selected' : '' }}>Lokae</option>
                                            <option value="Kattena" {{ old('dusun', $dataPenduduk->dusun) == 'Kattena' ? 'selected' : '' }}>Kattena</option>
                                        </select>
                                    </div>
                                </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">RT</label>
                                        <div class="col-md-3">
                                            <input type="text" name="rt" class="form-control"
                                                value="{{ old('rt', $dataPenduduk->rt) }}" required>
                                        </div>

                                        <label class="col-form-label col-md-1">RW</label>
                                        <div class="col-md-3">
                                            <input type="text" name="rw" class="form-control"
                                                value="{{ old('rw', $dataPenduduk->rw) }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Kel/Desa</label>
                                        <div class="col-md-7">
                                            <input 
                                                type="text" 
                                                name="keldesa" 
                                                class="form-control" 
                                                value="{{ old('keldesa', $dataPenduduk->keldesa ?? 'Manggalung') }}" 
                                                readonly 
                                                required>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Kecamatan</label>
                                        <div class="col-md-7">
                                            <input type="text" name="kecamatan" class="form-control"
                                                value="{{ old('kecamatan', $dataPenduduk->kecamatan) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Agama</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="agama" required>
                                                <option value="">--- Pilih Agama ---</option>
                                                @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
                                                    <option value="{{ $agama }}" {{ old('agama', $dataPenduduk->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Status Perkawinan</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="status_perkawinan" required>
                                                <option value="">--- Pilih Status ---</option>
                                                @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status)
                                                    <option value="{{ $status }}" {{ old('status_perkawinan', $dataPenduduk->status_perkawinan) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <select name="pekerjaan" class="form-control" required>
                                            @foreach(['Belum/Tidak Bekerja','Petani','Nelayan','Pedagang','PNS','Guru','Karyawan Swasta','Tukang','Lainnya'] as $pekerjaan)
                                                <option value="{{ $pekerjaan }}" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == $pekerjaan ? 'selected' : '' }}>{{ $pekerjaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Kewarganegaraan</label>
                                        <div class="col-md-7">
                                            <input type="text" name="kewarganegaraan" class="form-control"
                                                value="{{ old('kewarganegaraan', $dataPenduduk->kewarganegaraan) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <select name="pendidikan" class="form-control" required>
                                            @foreach(['Tidak Sekolah','SD','SMP','SMA','D1','D2','D3','S1','S2','S3'] as $pendidikan)
                                                <option value="{{ $pendidikan }}" {{ old('pendidikan', $dataPenduduk->pendidikan) == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Disabilitas</label>
                                        <select name="disabilitas" class="form-control" required>
                                            @foreach(['Tidak Ada','Fisik','Intelektual','Mental','Sensorik','Ganda'] as $disabilitas)
                                                <option value="{{ $disabilitas }}" {{ old('disabilitas', $dataPenduduk->disabilitas) == $disabilitas ? 'selected' : '' }}>{{ $disabilitas }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Tahun</label>
                        <div class="col-md-7">
                            <select name="tahun" class="form-control" required>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    <option value="{{ $currentYear - $i }}"
                                        {{ old('tahun', $dataPenduduk->tahun ?? '') == $currentYear - $i ? 'selected' : '' }}>
                                        {{ $currentYear - $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>




                                    <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                                            <a href="{{ route('dataPenduduk.index') }}" class="btn btn-warning">Kembali</a>
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

@extends('layouts.app', ['title' => 'Edit Data Penduduk'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Penduduk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('dataPenduduk.index') }}">Data Penduduk</a></div>
                    <div class="breadcrumb-item active">Edit</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Penduduk</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dataPenduduk.update', $dataPenduduk->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- NIK -->
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control"
                                    value="{{ old('nik', $dataPenduduk->nik) }}" required>
                            </div>

                             <!-- NIK -->
                            <div class="form-group">
                                <label>No KK</label>
                                <input type="text" name="nokk" class="form-control"
                                    value="{{ old('nokk', $dataPenduduk->nokk) }}" required>
                            </div>

                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ old('nama', $dataPenduduk->nama) }}" required>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control selectric" name="jenis_kelamin" required>
                                    <option value="">--- Pilih Jenis Kelamin ---</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $dataPenduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $dataPenduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>


                            <!-- Tempat Lahir -->
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                    value="{{ old('tempat_lahir', $dataPenduduk->tempat_lahir) }}">
                            </div>

                            <!-- Alamat -->
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control"
                                    rows="3">{{ old('alamat', $dataPenduduk->alamat) }}</textarea>
                            </div>

                            <!-- RT / RW -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $dataPenduduk->rt) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $dataPenduduk->rw) }}">
                                </div>
                            </div>

                            <!-- Kel/Desa -->
                            <div class="form-group">
                                <label>Kelurahan/Desa</label>
                                <input type="text" name="keldesa" class="form-control"
                                    value="{{ old('keldesa', $dataPenduduk->keldesa) }}">
                            </div>

                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control"
                                    value="{{ old('kecamatan', $dataPenduduk->kecamatan) }}">
                            </div>

                            <!-- Agama -->
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control selectric" name="agama" required>
                                    <option value="">--- Pilih Agama ---</option>
                                    <option value="Islam" {{ old('agama', $dataPenduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $dataPenduduk->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $dataPenduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $dataPenduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Budha" {{ old('agama', $dataPenduduk->agama) == 'Budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="Konghucu" {{ old('agama', $dataPenduduk->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>

                            <!-- Status Perkawinan -->
                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <select class="form-control selectric" name="status_perkawinan" required>
                                    <option value="">--- Pilih Status ---</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan', $dataPenduduk->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin
                                    </option>
                                    <option value="Kawin" {{ old('status_perkawinan', $dataPenduduk->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $dataPenduduk->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup
                                    </option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $dataPenduduk->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati
                                    </option>
                                </select>
                            </div>

                            <!-- Pekerjaan -->
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select class="form-control selectric" name="pekerjaan" required>
                                    <option value="">--- Pilih Pekerjaan ---</option>
                                    <option value="Petani" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Petani' ? 'selected' : '' }}>Petani</option>
                                    <option value="pelajar" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                                    <option value="Nelayan" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                    <option value="Pedagang" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                    <option value="PNS" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="Guru" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="Karyawan Swasta" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                    <option value="Tukang" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Tukang' ? 'selected' : '' }}>Tukang</option>
                                    <option value="Lainnya" {{ old('pekerjaan', $dataPenduduk->pekerjaan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <!-- Kewarganegaraan -->
                            <div class="form-group">
                                <label>Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" class="form-control"
                                    value="{{ old('kewarganegaraan', $dataPenduduk->kewarganegaraan) }}">
                            </div>

                            <!-- Pendidikan -->
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select class="form-control selectric" name="pendidikan" required>
                                    <option value="">--- Pilih Pendidikan ---</option>
                                    <option value="SD" {{ old('pendidikan', $dataPenduduk->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan', $dataPenduduk->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan', $dataPenduduk->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="D3" {{ old('pendidikan', $dataPenduduk->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('pendidikan', $dataPenduduk->pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan', $dataPenduduk->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                                </select>
                            </div>

                            <!-- Disabilitas -->
                            <div class="form-group">
                                <label>Disabilitas</label>
                                <select class="form-control selectric" name="disabilitas" required>
                                    <option value="">--- Pilih Disabilitas ---</option>
                                    <option value="Tidak Ada" {{ old('disabilitas', $dataPenduduk->disabilitas) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                                    <option value="Fisik" {{ old('disabilitas', $dataPenduduk->disabilitas) == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                                    <option value="Intelektual" {{ old('disabilitas', $dataPenduduk->disabilitas) == 'Intelektual' ? 'selected' : '' }}>Intelektual</option>
                                    <option value="Mental" {{ old('disabilitas', $dataPenduduk->disabilitas) == 'Mental' ? 'selected' : '' }}>Mental</option>
                                    <option value="Sensorik" {{ old('disabilitas', $dataPenduduk->disabilitas) == 'Sensorik' ? 'selected' : '' }}>Sensorik</option>
                                    <option value="Ganda" {{ old('disabilitas', $dataPenduduk->disabilitas) == 'Ganda' ? 'selected' : '' }}>Ganda</option>
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('dataPenduduk.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

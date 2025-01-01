@extends('layouts.app', ['title' => 'Edit Jadwal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Jadwal</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mata_pelajaran">Mata Pelajaran</label>
                                        <select name="mata_pelajaran_id" id="mata_pelajaran"
                                            class="form-control select2 @error('mata_pelajaran_id') is-invalid @enderror">
                                            <option value="">-- Pilih Mata Pelajaran --</option>
                                            @foreach ($mataPelajaran as $mp)
                                                <option value="{{ $mp->id }}" 
                                                    {{ old('mata_pelajaran_id', $jadwal->mata_pelajaran_id) == $mp->id ? 'selected' : '' }}>
                                                    {{ $mp->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mata_pelajaran_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <select name="hari" id="hari"
                                            class="form-control select2 @error('hari') is-invalid @enderror">
                                            <option value="">-- Pilih Hari --</option>
                                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                                <option value="{{ $hari }}"
                                                    {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                                    {{ $hari }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <input type="time" name="jam_mulai" id="jam_mulai" 
                                            value="{{ old('jam_mulai', $jadwal->jam_mulai) }}"
                                            class="form-control @error('jam_mulai') is-invalid @enderror">
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jam_selesai">Jam Selesai</label>
                                        <input type="time" name="jam_selesai" id="jam_selesai" 
                                            value="{{ old('jam_selesai', $jadwal->jam_selesai) }}"
                                            class="form-control @error('jam_selesai') is-invalid @enderror">
                                        @error('jam_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ruangan">Ruangan</label>
                                        <input type="text" name="ruangan" id="ruangan" 
                                            value="{{ old('ruangan', $jadwal->ruangan) }}"
                                            class="form-control @error('ruangan') is-invalid @enderror">
                                        @error('ruangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
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

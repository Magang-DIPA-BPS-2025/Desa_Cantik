@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surat.store') }}" method="POST" id="form-surat">
                        @csrf

                        <div class="form-group">
                            <label for="nik_input">Cari NIK</label>
                            <div class="input-group">
                                <input type="text" id="nik_input" class="form-control" placeholder="Masukkan NIK (16 digit)">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" id="btn-cari-nik">Cari</button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Isi NIK lalu klik Cari untuk mengisi otomatis.</small>
                        </div>

                        <div class="form-group">
                            <label for="penduduk_id">Nama Penduduk</label>
                            <select name="penduduk_id" class="form-control @error('penduduk_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Penduduk --</option>
                                @foreach ($penduduks as $penduduk)
                                    <option value="{{ $penduduk->id }}" {{ old('penduduk_id') == $penduduk->id ? 'selected' : '' }}>
                                        {{ $penduduk->nama }} ({{ $penduduk->nik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('penduduk_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_surat_id">Jenis Surat</label>
                            <select name="jenis_surat_id" class="form-control @error('jenis_surat_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                @foreach ($jenisSurats as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis_surat_id') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_surat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_surat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" value="{{ old('nomor_surat') }}">
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_dibuat">Tanggal Dibuat</label>
                            <input type="date" name="tanggal_dibuat" class="form-control @error('tanggal_dibuat') is-invalid @enderror" value="{{ old('tanggal_dibuat', date('Y-m-d')) }}" required>
                            @error('tanggal_dibuat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('surat.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCari = document.getElementById('btn-cari-nik');
    const nikInput = document.getElementById('nik_input');
    const pendudukSelect = document.querySelector('select[name="penduduk_id"]');

    function setSelectedPenduduk(id) {
        if (!id) return;
        for (const opt of pendudukSelect.options) {
            if (opt.value == id) { opt.selected = true; break; }
        }
    }

    btnCari.addEventListener('click', async function() {
        const nik = (nikInput.value || '').trim();
        if (nik.length < 8) { alert('Masukkan NIK yang valid.'); return; }
        try {
            const res = await fetch(`/get-data/${encodeURIComponent(nik)}`);
            const json = await res.json();
            if (json && json.success && json.data) {
                const penduduk = json.data;
                // If penduduk exists in dropdown, select it; otherwise append then select
                let found = false;
                for (const opt of pendudukSelect.options) {
                    if (opt.text.includes(penduduk.nik)) { found = true; setSelectedPenduduk(opt.value); break; }
                }
                if (!found) {
                    const opt = document.createElement('option');
                    opt.value = penduduk.id;
                    opt.text = `${penduduk.nama} (${penduduk.nik})`;
                    pendudukSelect.appendChild(opt);
                    setSelectedPenduduk(penduduk.id);
                }
            } else {
                alert('Data penduduk tidak ditemukan.');
            }
        } catch (e) {
            alert('Gagal mengambil data. Coba lagi.');
        }
    });
});
</script>
@endpush

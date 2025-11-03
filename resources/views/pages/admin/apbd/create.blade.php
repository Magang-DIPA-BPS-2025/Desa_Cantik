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
                    <form action="{{ route('apbd.store') }}" method="POST">
                        @csrf

                        {{-- Tahun Anggaran --}}
                        <div class="form-group">
                            <label for="tahun">Tahun Anggaran</label>
                            <select name="tahun" class="form-control @error('tahun') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Tahun</option>
                                @for ($year = now()->year - 10; $year <= now()->year + 10; $year++)
                                    <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Total Pendapatan dan Belanja --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_pendapatan">Total Pendapatan (Rp)</label>
                                    <input type="number" name="total_pendapatan"
                                           class="form-control @error('total_pendapatan') is-invalid @enderror"
                                           value="{{ old('total_pendapatan') }}"
                                           placeholder="Masukkan total pendapatan..."
                                           min="0" required>
                                    @error('total_pendapatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_belanja">Total Belanja (Rp)</label>
                                    <input type="number" name="total_belanja"
                                           class="form-control @error('total_belanja') is-invalid @enderror"
                                           value="{{ old('total_belanja') }}"
                                           placeholder="Masukkan total belanja..."
                                           min="0" required>
                                    @error('total_belanja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Penerimaan, Pengeluaran, Surplus/Defisit --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="penerimaan">Penerimaan (Rp)</label>
                                    <input type="number" name="penerimaan"
                                           class="form-control @error('penerimaan') is-invalid @enderror"
                                           value="{{ old('penerimaan') }}"
                                           placeholder="Masukkan penerimaan..."
                                           min="0" required>
                                    @error('penerimaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pengeluaran">Pengeluaran (Rp)</label>
                                    <input type="number" name="pengeluaran"
                                           class="form-control @error('pengeluaran') is-invalid @enderror"
                                           value="{{ old('pengeluaran') }}"
                                           placeholder="Masukkan pengeluaran..."
                                           min="0" required>
                                    @error('pengeluaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                        <div class="form-group">
                                    <label for="surplus_defisit">Surplus/Defisit (Rp)</label>
                                    <input type="number" name="surplus_defisit"
                                           class="form-control @error('surplus_defisit') is-invalid @enderror"
                                           value="{{ old('surplus_defisit') }}"
                                           placeholder="Masukkan surplus/defisit..."
                                    required>
                                    @error('surplus_defisit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Pendapatan --}}
                        <h5 class="mt-4 mb-3">Pendapatan</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pendapatan_pad">PAD (Rp)</label>
                                    <input type="number" name="pendapatan_pad"
                                           class="form-control @error('pendapatan_pad') is-invalid @enderror"
                                           value="{{ old('pendapatan_pad') }}"
                                           placeholder="Masukkan PAD..."
                                           min="0" required>
                                    @error('pendapatan_pad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pendapatan_transfer">Transfer (Rp)</label>
                                    <input type="number" name="pendapatan_transfer"
                                           class="form-control @error('pendapatan_transfer') is-invalid @enderror"
                                           value="{{ old('pendapatan_transfer') }}"
                                           placeholder="Masukkan transfer..."
                                           min="0" required>
                                    @error('pendapatan_transfer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pendapatan_lain">Lainnya (Rp)</label>
                                    <input type="number" name="pendapatan_lain"
                                           class="form-control @error('pendapatan_lain') is-invalid @enderror"
                                           value="{{ old('pendapatan_lain') }}"
                                           placeholder="Masukkan pendapatan lainnya..."
                                           min="0" required>
                                    @error('pendapatan_lain')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Belanja --}}
                        <h5 class="mt-4 mb-3">Belanja</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="belanja_pemerintahan">Pemerintahan (Rp)</label>
                                    <input type="number" name="belanja_pemerintahan"
                                           class="form-control @error('belanja_pemerintahan') is-invalid @enderror"
                                           value="{{ old('belanja_pemerintahan') }}"
                                           placeholder="Masukkan belanja pemerintahan..."
                                           min="0" required>
                                    @error('belanja_pemerintahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="belanja_pembangunan">Pembangunan (Rp)</label>
                                    <input type="number" name="belanja_pembangunan"
                                           class="form-control @error('belanja_pembangunan') is-invalid @enderror"
                                           value="{{ old('belanja_pembangunan') }}"
                                           placeholder="Masukkan belanja pembangunan..."
                                           min="0" required>
                                    @error('belanja_pembangunan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="belanja_pembinaan">Pembinaan (Rp)</label>
                                    <input type="number" name="belanja_pembinaan"
                                           class="form-control @error('belanja_pembinaan') is-invalid @enderror"
                                           value="{{ old('belanja_pembinaan') }}"
                                           placeholder="Masukkan belanja pembinaan..."
                                           min="0" required>
                                    @error('belanja_pembinaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="belanja_pemberdayaan">Pemberdayaan (Rp)</label>
                                    <input type="number" name="belanja_pemberdayaan"
                                           class="form-control @error('belanja_pemberdayaan') is-invalid @enderror"
                                           value="{{ old('belanja_pemberdayaan') }}"
                                           placeholder="Masukkan belanja pemberdayaan..."
                                           min="0" required>
                                    @error('belanja_pemberdayaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="belanja_bencana">Bencana (Rp)</label>
                                    <input type="number" name="belanja_bencana"
                                           class="form-control @error('belanja_bencana') is-invalid @enderror"
                                           value="{{ old('belanja_bencana') }}"
                                           placeholder="Masukkan belanja bencana..."
                                           min="0" required>
                                    @error('belanja_bencana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Pembiayaan --}}
                        <h5 class="mt-4 mb-3">Pembiayaan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pembiayaan_penerimaan">Penerimaan (Rp)</label>
                                    <input type="number" name="pembiayaan_penerimaan"
                                           class="form-control @error('pembiayaan_penerimaan') is-invalid @enderror"
                                           value="{{ old('pembiayaan_penerimaan') }}"
                                           placeholder="Masukkan pembiayaan penerimaan..."
                                           min="0" required>
                                    @error('pembiayaan_penerimaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pembiayaan_pengeluaran">Pengeluaran (Rp)</label>
                                    <input type="number" name="pembiayaan_pengeluaran"
                                           class="form-control @error('pembiayaan_pengeluaran') is-invalid @enderror"
                                           value="{{ old('pembiayaan_pengeluaran') }}"
                                           placeholder="Masukkan pembiayaan pengeluaran..."
                                           min="0" required>
                                    @error('pembiayaan_pengeluaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('apbd.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

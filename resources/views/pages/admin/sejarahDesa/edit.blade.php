@extends('layouts.app', ['title' => 'Edit Sejarah Desa'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Sejarah Desa</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('sejarahDesa.update', $sejarah->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" id="judul"
                                            class="form-control @error('judul') is-invalid @enderror"
                                            value="{{ old('judul', $sejarah->judul) }}" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="isi">Isi Sejarah</label>
                                        <textarea name="isi" id="isi" rows="6"
                                            class="form-control @error('isi') is-invalid @enderror"
                                            required>{{ old('isi', $sejarah->isi) }}</textarea>
                                        @error('isi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('sejarahDesa.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

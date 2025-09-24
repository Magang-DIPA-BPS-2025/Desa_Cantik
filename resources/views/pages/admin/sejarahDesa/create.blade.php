@extends('layouts.app', ['title' => 'Tambah Sejarah Desa'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Sejarah Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('sejarahDesa.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control"
                                           value="{{ old('judul') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="isi">Isi Sejarah</label>
                                    <textarea name="isi" id="isi" rows="6" class="form-control" required>{{ old('isi') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
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

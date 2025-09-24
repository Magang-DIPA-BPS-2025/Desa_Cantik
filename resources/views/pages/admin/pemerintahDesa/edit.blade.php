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
                    <form action="{{ route('pemerintah-desa.update', $pemerintahDesa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control"
                                   value="{{ old('nama', $pemerintahDesa->nama) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control"
                                   value="{{ old('jabatan', $pemerintahDesa->jabatan) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tupoksi">Tupoksi</label>
                            <textarea name="tupoksi" class="form-control" rows="4">{{ old('tupoksi', $pemerintahDesa->tupoksi) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            @if($pemerintahDesa->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pemerintahDesa->foto) }}" alt="Foto" width="120" class="img-thumbnail">
                                </div>
                            @endif
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('pemerintah-desa.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

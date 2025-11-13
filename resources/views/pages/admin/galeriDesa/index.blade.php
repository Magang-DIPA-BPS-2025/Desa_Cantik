@extends('layouts.app', ['title' => 'Galeri Desa'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Galeri Desa</h1>
            </div>

            <div class="section-body">
                <div class="d-flex justify-content-between mb-4">
                    <a href="{{ route('galeriDesa.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Foto
                    </a>
                </div>

                <div class="row">
                    @forelse($galeris as $galeri)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                {{-- Gambar --}}
                                @if($galeri->gambar)
                                    <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                         class="card-img-top rounded-top"
                                         alt="{{ $galeri->judul ?? 'Galeri ' . $galeri->id }}"
                                         style="height:200px; object-fit:cover;">
                                @else
                                    <img src="https://via.placeholder.com/300x200.png?text=No+Image"
                                         class="card-img-top rounded-top"
                                         alt="No Image">
                                @endif

                                {{-- Judul --}}
                                <div class="card-body text-center py-2">
                                    <h6 class="mb-0 fw-bold">
                                        {{ $galeri->judul ?? 'Tanpa Judul' }}
                                    </h6>
                                </div>

                                {{-- Aksi --}}
                                <div class="card-footer d-flex justify-content-center p-2">
                                    <a href="{{ route('galeriDesa.edit', $galeri->id) }}"
                                       class="btn btn-warning btn-sm mx-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('galeriDesa.destroy', $galeri->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm mx-2">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">Belum ada foto galeri.</div>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-end mt-3">
    {{ $galeris->links() }}
</div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush

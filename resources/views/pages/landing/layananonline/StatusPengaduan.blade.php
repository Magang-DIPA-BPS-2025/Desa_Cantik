@extends('layouts.landing.app')

@section('content')
<div class="container mt-5 mb-5">

    {{-- === JUDUL === --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold text-success">Status Pengaduan Online Warga Desa</h2>
        <p class="text-muted">Masukkan email Anda untuk melihat status pengaduan yang telah dikirim.</p>
    </div>

    {{-- === CARD FORM PENCARIAN === --}}
    <div class="card shadow-lg border-0 mx-auto mb-4" style="max-width: 1200px;">
        <div class="card-body p-4">

            <form action="{{ route('pengaduan.userStatus') }}" method="GET" id="searchForm">
                <div class="row g-3 align-items-center">
                    <div class="col-md-9 col-sm-12">
                        <input type="email" name="email" class="form-control form-control-lg"
                            placeholder="Masukkan email Anda..." value="{{ request('email') }}" required>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <button class="btn btn-success btn-lg w-100" type="submit" id="btnCari">
                            <span id="textCari"><i class="fas fa-search"></i> Cek Status</span>
                            <span id="loadingCari" class="d-none"><i class="fas fa-spinner fa-spin"></i> Memproses...</span>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- === CARD TABEL HASIL === --}}
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 1200px;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelapor</th>
                            <th>Email</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Waktu Pengaduan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse((request('email') ? $pengaduans : []) as $index => $data)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ Str::limit($data->judul, 60) }}</td>
                                <td class="text-center">
                                    @if($data->status == 'baru')
                                        <span class="badge bg-primary">Baru</span>
                                    @elseif($data->status == 'diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @elseif($data->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($data->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Diketahui</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $data->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    @if(request('email'))
                                        Tidak ada pengaduan ditemukan untuk email ini.
                                    @else
                                        Silakan masukkan email Anda terlebih dahulu.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- === SCRIPT LOADING TOMBOL === --}}
<script>
document.getElementById('searchForm').addEventListener('submit', function() {
    document.getElementById('btnCari').disabled = true;
    document.getElementById('textCari').classList.add('d-none');
    document.getElementById('loadingCari').classList.remove('d-none');
});
</script>
@endsection

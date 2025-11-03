@extends('layouts.app', ['title' => 'Data Penduduk'])

@push('styles')
<style>
/* ======================================
    Styling umum dan modal
====================================== */
.modal-lg { max-width: 90%; }
.file-viewer { width: 100%; height: 80vh; border: none; border-radius: 6px; }
.badge-nomor { font-size: 11px; background-color: #e3f2fd; color: #1976d2; border: 1px solid #bbdefb; }

/* ======================================
    Table & Controls
====================================== */
.table-top-controls, .dataTables-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 10px;
}
.btn-download-excel, .btn-tambah-data {
    display: flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 8px; font-size: 14px; font-weight: 500;
    cursor: pointer; transition: .3s; text-decoration: none; font-family: 'Poppins', sans-serif;
}
.btn-download-excel { background: #16a34a; color: #fff; border: none; }
.btn-download-excel:hover { background: #15803d; color: #fff; text-decoration: none; }
.btn-tambah-data { background: #3b82f6; color: #fff; border: none; }
.btn-tambah-data:hover { background: #2563eb; color: #fff; }

/* DataTables style */
.dataTables-length, .dataTables-filter { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.dataTables-length label, .dataTables-filter label { margin-bottom: 0; font-weight: 500; white-space: nowrap; }
.dataTables-length select, .dataTables-filter input { width: auto; display: inline-block; min-width: 70px; }
.dataTables-filter input { min-width: 150px; }

/* Table custom */
.table-custom { width: 100%; border-collapse: collapse; }
.table-custom th { background: #f8f9fa; padding: 12px; text-align: center; font-weight: 600; border-bottom: 2px solid #dee2e6; }
.table-custom td { padding: 12px; text-align: center; border-bottom: 1px solid #dee2e6; }
.table-custom tbody tr:hover { background-color: #f8f9fa; }

/* Aksi horizontal */
.aksi-container { display: flex; justify-content: center; align-items: center; gap: 5px; flex-wrap: nowrap; }
.btn-aksi { padding: 0.35rem 0.5rem; font-size: 0.75rem; border-radius: 4px; min-width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; }
.aksi-container form { margin: 0; display: inline; }

/* Pagination */
.pagination-container { margin-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
.pagination-info { font-size: 14px; color: #6c757d; }
.pagination-wrapper { display: flex; justify-content: flex-end; }

/* Responsive */
@media (max-width: 576px) {
    .dataTables-controls { flex-direction: column; align-items: stretch; gap: 10px; }
    .dataTables-length, .dataTables-filter { justify-content: space-between; width: 100%; background: #f8f9fa; padding: 10px; border-radius: 8px; border: 1px solid #e9ecef; }
    .btn-download-excel { width: 100%; justify-content: center; }
    .dataTables-length select, .dataTables-filter input { flex: 1; }
    .pagination-container { flex-direction: column; text-align: center; }
    .pagination-wrapper, .pagination-info { justify-content: center; width: 100%; text-align: center; }
}
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penduduk</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Notifikasi --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                    @endif

                    {{-- Tombol Tambah & Download --}}
                    <div class="table-top-controls mb-3">
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('dataPenduduk.create') }}" class="btn-tambah-data">
                                <i class="fas fa-plus"></i> Tambah Data Penduduk
                            </a>
                            <button class="btn-download-excel" onclick="downloadExcel()">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </button>
                        </div>
                    </div>

                    {{-- Controls --}}
                    <form method="GET" action="{{ route('dataPenduduk.index') }}" id="filter-form">
                        <div class="dataTables-controls">
                            <div class="dataTables-length">
                                <label for="per_page">Show</label>
                                <select name="per_page" id="per_page" class="form-control form-control-sm" onchange="document.getElementById('filter-form').submit()">
                                    <option value="10" {{ request('per_page',10)==10?'selected':'' }}>10</option>
                                    <option value="25" {{ request('per_page')==25?'selected':'' }}>25</option>
                                    <option value="50" {{ request('per_page')==50?'selected':'' }}>50</option>
                                    <option value="100" {{ request('per_page')==100?'selected':'' }}>100</option>
                                </select>
                                <span>entries</span>
                            </div>
                            <div class="dataTables-filter">
                                <label for="search">Search:</label>
                                <input type="search" name="search" id="search" class="form-control form-control-sm" placeholder="Cari...">
                                @if(request('search'))
                                <a href="{{ route('dataPenduduk.index') }}" class="btn btn-sm btn-outline-secondary ml-2">Reset</a>
                                @endif
                            </div>
                        </div>
                    </form>

                    {{-- Tabel --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-custom" id="table-penduduk">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>No KK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Dusun</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Kel/Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Agama</th>
                                    <th>Status Perkawinan</th>
                                    <th>Pekerjaan</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Pendidikan</th>
                                    <th>Disabilitas</th>
                                    <th>Tahun</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $index => $penduduk)
                                <tr>
                                    <td>{{ ($datas->currentPage()-1)*$datas->perPage()+$loop->iteration }}</td>
                                    <td>{{ $penduduk->nik }}</td>
                                    <td>{{ $penduduk->nokk }}</td>
                                    <td>{{ $penduduk->nama }}</td>
                                    <td>{{ $penduduk->jenis_kelamin }}</td>
                                    <td>{{ $penduduk->tempat_lahir }}</td>
                                    <td>{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>{{ $penduduk->alamat }}</td>
                                    <td>{{ $penduduk->dusun }}</td>
                                    <td>{{ $penduduk->rt }}</td>
                                    <td>{{ $penduduk->rw }}</td>
                                    <td>{{ $penduduk->keldesa }}</td>
                                    <td>{{ $penduduk->kecamatan }}</td>
                                    <td>{{ $penduduk->agama }}</td>
                                    <td>{{ $penduduk->status_perkawinan }}</td>
                                    <td>{{ $penduduk->pekerjaan }}</td>
                                    <td>{{ $penduduk->kewarganegaraan }}</td>
                                    <td>{{ $penduduk->pendidikan }}</td>
                                    <td>{{ $penduduk->disabilitas }}</td>
                                    <td>{{ $penduduk->tahun }}</td>
                                    <td>
                                        <div class="aksi-container">
                                            <a href="{{ route('dataPenduduk.edit',$penduduk->nik) }}" class="btn btn-warning btn-aksi" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('dataPenduduk.destroy',$penduduk->nik) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-aksi" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="21" class="text-center text-muted"><i>Tidak ada data penduduk</i></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($datas->hasPages())
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan {{ ($datas->currentPage()-1)*$datas->perPage()+1 }} sampai {{ min($datas->currentPage()*$datas->perPage(), $datas->total()) }} dari {{ $datas->total() }} entri
                        </div>
                        <div class="pagination-wrapper">
                            {{ $datas->links() }}
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
// Download Excel
function downloadExcel() {
    const wb = XLSX.utils.table_to_book(document.querySelector("#table-penduduk"));
    XLSX.writeFile(wb, "Data_Penduduk_Desa.xlsx");
}

// Live search
$(document).ready(function(){
    $('#filter-form').on('submit', function(e){ e.preventDefault(); });
    $('#search').on('keyup', function(){
        var value = $(this).val().toLowerCase();
        $('#table-penduduk tbody tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endpush

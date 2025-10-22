@extends('layouts.landing.app')

@section('content')
@push('styles')
<style>
body {
    background-color: #edf7f0;
    font-family: 'Poppins', sans-serif;
    color: #16a34a;
}

h4, h5 {
    font-weight: 600;
    color: #1aa04bff;
}

/* CARD LEBAR */
.card-custom {
    background: #ffffff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(20, 83, 45, 0.1);
    transition: all 0.3s ease;
    margin-bottom: 2rem;
    width: 100%;
    max-width: 100%;
    padding: 2rem;
}

.card-custom:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(20, 83, 45, 0.15);
}

.form-control {
    border-radius: 12px;
    border: 1px solid #c7e3d9;
    padding: 0.6rem 1rem;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.25);
}

.btn-primary, .btn-success {
    border-radius: 12px;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #16a34a;
    border-color: #16a34a;
}

.btn-primary:hover {
    background-color: #15803d;
    border-color: #15803d;
    transform: translateY(-2px);
}

.btn-success {
    background-color: #1aa04bff;
    border-color: #1aa04bff;
    color: white;
}

.btn-success:hover {
    background-color: #16a34a;
    border-color: #16a34a;
    transform: translateY(-2px);
}

.alert {
    border-radius: 12px;
    border: none;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-left: 4px solid #10b981;
}

.alert-danger {
    background-color: #fee2e2;
    color: #7f1d1d;
    border-left: 4px solid #ef4444;
}

/* ===== TABEL ===== */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

#tabelBukuTamu {
    border-collapse: collapse;
    width: 100%;
    table-layout: auto;
}

#tabelBukuTamu th,
#tabelBukuTamu td {
    border: 1px solid #16a34a;
    padding: 0.7rem 0.8rem;
    vertical-align: middle;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}

#tabelBukuTamu th {
    background-color: rgba(22,163,74,0.05);
    color: #16a34a;
    font-weight: 600;
    text-align: center;
}

#tabelBukuTamu td.no-column {
    text-align: center;
    width: 50px;
}

/* responsive di hp */
@media (max-width: 768px) {
    #tabelBukuTamu th, #tabelBukuTamu td {
        font-size: 0.85rem;
    }

    .card-custom {
        padding: 1rem;
    }

    .btn {
        width: 100%;
        margin-top: 0.5rem;
    }
}

@media (max-width: 480px) {
    #tabelBukuTamu th, #tabelBukuTamu td {
        font-size: 0.75rem;
        padding: 0.4rem 0.4rem;
    }
}
</style>
@endpush

<div class="container mt-5 mb-5">
    <h4 class="mb-4">
        <i class="bi bi-journal-bookmark-fill me-2"></i><strong>Formulir Buku Tamu Desa Manggalung</strong>
    </h4>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger shadow-sm rounded mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-custom">
        <form action="{{ route('bukutamu') }}" method="POST" class="mb-0">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Asal Instansi / Tempat <span class="text-danger">*</span></label>
                    <input type="text" name="asal" class="form-control" placeholder="Contoh: Dinas Kominfo" value="{{ old('asal') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Keperluan <span class="text-danger">*</span></label>
                <textarea name="keperluan" class="form-control" placeholder="Tuliskan keperluan kunjungan Anda" rows="3" required>{{ old('keperluan') }}</textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>

    <div class="card-custom mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">
                <i class="bi bi-table me-2"></i><strong>Data Pengunjung</strong>
            </h5>
            <button class="btn btn-success" onclick="downloadExcel()">
                <i class="bi bi-file-earmark-excel me-1"></i> Ekspor ke Excel
            </button>
        </div>

        <div class="table-responsive">
            <table id="tabelBukuTamu" class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Asal</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukutamus as $index => $tamu)
                        <tr>
                            <td class="no-column">{{ ($bukutamus->currentPage() - 1) * $bukutamus->perPage() + $index + 1 }}</td>
                            <td>{{ $tamu->nama }}</td>
                            <td>{{ $tamu->asal }}</td>
                            <td>{{ $tamu->keperluan }}</td>
                            <td>
                                <small>{{ $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y H:i') }} WITA</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                Belum ada data pengunjung
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bukutamus->count() > 0)
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">Menampilkan {{ $bukutamus->count() }} dari {{ $bukutamus->total() }} data pengunjung</small>
                <div>
                    {{ $bukutamus->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
function downloadExcel() {
    const table = document.getElementById('tabelBukuTamu');
    const rows = table.querySelectorAll('tbody tr');
    if(rows.length === 0 || (rows[0].querySelector('td') && rows[0].querySelector('td').colSpan > 1)) {
        alert('Tidak ada data untuk diekspor!');
        return;
    }
    if (!confirm('Apakah Anda yakin ingin mengekspor data buku tamu ke Excel?')) return;

    const wb = XLSX.utils.book_new();
    const excelData = [
        ["DATA BUKU TAMU DESA KAMIRI"],
        ["Tanggal Ekspor: " + new Date().toLocaleDateString('id-ID')],
        ["Jumlah Data: {{ $bukutamus->count() }}"],
        [""],
        ["No","Nama","Asal","Keperluan","Tanggal Kunjungan"]
    ];

    @foreach($bukutamus as $index => $tamu)
    excelData.push([
        {{ $index + 1 }},
        "{{ $tamu->nama }}",
        "{{ $tamu->asal }}",
        "{{ $tamu->keperluan }}",
        "{{ $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y H:i') }} WITA"
    ]);
    @endforeach

    const ws = XLSX.utils.aoa_to_sheet(excelData);
    ws['!cols'] = [{wch:6},{wch:25},{wch:25},{wch:50},{wch:25}];
    XLSX.utils.book_append_sheet(wb, ws, "Buku Tamu");
    XLSX.writeFile(wb, `Buku_Tamu_Desa_Kamiri_${new Date().toISOString().split('T')[0]}.xlsx`);
}
</script>
@endpush
@endsection

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
        color: #16a34a;
    }

    .card-custom {
        background: #ffffff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 6px 18px rgba(20, 83, 45, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 2rem;
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
        background-color: #22c55e;
        border-color: #22c55e;
        color: white;
    }

    .btn-success:hover {
        background-color: #16a34a;
        border-color: #16a34a;
        transform: translateY(-2px);
    }

    table {
        border-radius: 12px;
        overflow: hidden;
        background-color: #ffffff;
    }

    table thead {
        background-color: #16a34a;
        color: white;
    }

    table tbody tr:hover {
        background-color: #d1fae5;
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

    .no-column {
        color: #000000 !important;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .btn {
            width: 100%;
            margin-top: 0.5rem;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
    }
</style>
@endpush

<div class="container mt-5 mb-5">
    {{-- Header Judul --}}
    <h4 class="mb-4">
        <i class="bi bi-journal-bookmark-fill me-2"></i><strong>Formulir Buku Tamu Desa Manggalung</strong>
    </h4>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
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

    {{-- Card Form --}}
    <div class="card-custom p-4">
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
                <label class="form-label fw-semibold">Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" placeholder="Masukkan nomor HP aktif" value="{{ old('nomor_hp') }}">
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

    {{-- Data Pengunjung --}}
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">
                <i class="bi bi-table me-2"></i><strong>Data Pengunjung</strong>
            </h5>
            <button class="btn btn-success" onclick="downloadExcel()">
                <i class="bi bi-file-earmark-excel me-1"></i> Ekspor ke Excel
            </button>
        </div>

        <div class="table-responsive">
            <table id="tabelBukuTamu" class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Asal</th>
                        <th>Nomor HP</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukutamus as $index => $tamu)
                        <tr>
                            <td class="no-column">{{ $index + 1 }}</td>
                            <td>{{ $tamu->nama }}</td>
                            <td>{{ $tamu->asal }}</td>
                            <td>{{ $tamu->nomor_hp ?? '-' }}</td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 200px;" title="{{ $tamu->keperluan }}">
                                    {{ $tamu->keperluan }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y H:i') }} WITA</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                Belum ada data pengunjung
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Info jumlah data --}}
        @if($bukutamus->count() > 0)
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">Menampilkan {{ $bukutamus->count() }} data pengunjung</small>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<!-- Library untuk export Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
    function downloadExcel() {
        // Cek apakah ada data
        const table = document.getElementById('tabelBukuTamu');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        // Jika tidak ada data atau hanya ada row "Belum ada data"
        if (rows.length === 0 || (rows[0].querySelector('td') && rows[0].querySelector('td').colSpan > 1)) {
            alert('Tidak ada data untuk diekspor!');
            return;
        }

        // Konfirmasi sebelum download
        if (!confirm('Apakah Anda yakin ingin mengekspor data buku tamu ke Excel?')) {
            return;
        }

        try {
            // Buat workbook baru
            const wb = XLSX.utils.book_new();
            
            // Data untuk Excel
            const excelData = [
                ["DATA BUKU TAMU DESA KAMIRI"],
                ["Tanggal Ekspor: " + new Date().toLocaleDateString('id-ID')],
                ["Jumlah Data: {{ $bukutamus->count() }}"],
                [""], // Baris kosong
                ["No", "Nama", "Asal", "Nomor HP", "Keperluan", "Tanggal Kunjungan"] // Header
            ];

            // Tambahkan data dari tabel
            @foreach($bukutamus as $index => $tamu)
                excelData.push([
                    {{ $index + 1 }},
                    "{{ $tamu->nama }}",
                    "{{ $tamu->asal }}",
                    "{{ $tamu->nomor_hp ?? '-' }}",
                    "{{ $tamu->keperluan }}",
                    "{{ $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y H:i') }} WITA"
                ]);
            @endforeach

            // Buat worksheet dari data
            const ws = XLSX.utils.aoa_to_sheet(excelData);
            
            // Atur lebar kolom
            const colWidths = [
                { wch: 8 },  // No
                { wch: 25 }, // Nama
                { wch: 25 }, // Asal
                { wch: 15 }, // Nomor HP
                { wch: 40 }, // Keperluan
                { wch: 25 }  // Tanggal
            ];
            ws['!cols'] = colWidths;

            // Style untuk header
            if (ws['!ref']) {
                const range = XLSX.utils.decode_range(ws['!ref']);
                
                // Header utama (A1)
                if (!ws['A1'].s) ws['A1'].s = {};
                ws['A1'].s = {
                    font: { bold: true, sz: 16 },
                    alignment: { horizontal: 'center' }
                };

                // Merge cell untuk judul utama
                ws['!merges'] = [
                    { s: { r: 0, c: 0 }, e: { r: 0, c: 5 } } // A1 sampai F1
                ];

                // Header tabel (baris 5)
                for (let col = 0; col <= 5; col++) {
                    const cellAddress = XLSX.utils.encode_cell({ r: 4, c: col });
                    if (!ws[cellAddress].s) ws[cellAddress].s = {};
                    ws[cellAddress].s = {
                        font: { bold: true, color: { rgb: "FFFFFF" } },
                        fill: { fgColor: { rgb: "16A34A" } },
                        alignment: { horizontal: 'center' }
                    };
                }
            }
            
            // Tambah worksheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, "Buku Tamu");
            
            // Download file
            const fileName = `Buku_Tamu_Desa_Kamiri_${new Date().toISOString().split('T')[0]}.xlsx`;
            XLSX.writeFile(wb, fileName);
            
        } catch (error) {
            console.error('Error exporting to Excel:', error);
            alert('Terjadi kesalahan saat mengekspor data. Silakan coba lagi.');
        }
    }

    // Auto-hide alerts setelah 5 detik
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                try {
                    bsAlert.close();
                } catch (e) {
                    // Jika tidak bisa close secara programmatic, sembunyikan manual
                    alert.style.display = 'none';
                }
            });
        }, 5000);
    });
</script>
@endpush
@endsection


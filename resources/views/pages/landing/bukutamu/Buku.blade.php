@extends('layouts.landing.app')

@section('content')
<title>Formulir Buku Tamu Desa Manggalung</title>

<style>
    body { 
        background-color: #f8fafc; 
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
        color: #333;
    }
    
    /* Header Section - Mengikuti gaya dari halaman jumlah penduduk */
    .container-main { 
        max-width: 1400px; 
        margin: auto; 
        padding: 20px; 
    }

    .gallery-header {
        margin-bottom: 2rem;
        margin-top: -1rem;
    }

    .gallery-title {
        font-size: 2.8rem;
        font-weight: 600;
        color: #2E7D32;
        line-height: 1.1;
        margin-bottom: 0.5rem;
        font-family: 'Poppins', sans-serif;
    }

    .gallery-header p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 0;
        font-family: 'Open Sans', sans-serif;
    }

    /* Card Style - Mengikuti gaya dari halaman jumlah penduduk */
    .card { 
        background: #fff; 
        border-radius: 14px; 
        padding: 25px; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.06); 
        transition: .25s; 
        border: none;
        margin-bottom: 25px;
    }

    .card:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 12px 28px rgba(0,0,0,0.12); 
    }

    /* Form Styles */
    .form-group { 
        margin-bottom: 25px; 
        text-align: left;
    }
    
    label { 
        font-weight: 600; 
        margin-bottom: 10px; 
        display: block; 
        color: #2c3e50; 
        font-size: 15px;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }
    
    input, textarea, select { 
        width: 100%; 
        padding: 14px 16px; 
        border: 2px solid #e2e8f0; 
        border-radius: 8px; 
        font-size: 15px; 
        transition: all 0.3s ease;
        background: #f8fafc;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }
    
    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #2E7D32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        background: #fff;
    }
    
    textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .btn-submit { 
        background: linear-gradient(135deg, #2E7D32, #4CAF50); 
        color: #fff; 
        border: none; 
        padding: 16px 30px; 
        border-radius: 8px; 
        font-size: 16px; 
        cursor: pointer; 
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }
    
    .btn-submit:hover { 
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
    }

    .btn-excel {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }

    .btn-excel:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }

    /* Table Styles */
    .table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 18px; 
        font-size: 15px; 
        font-family: 'Open Sans', sans-serif; 
    }

    .table th, .table td { 
        padding: 12px; 
        text-align: left; 
        border-bottom: 1px solid #e5e7eb; 
    }

    .table thead { 
        background: linear-gradient(90deg, #16a34a, #16a34a); 
        color: #fff; 
        font-weight: 600; 
        font-family: 'Poppins', sans-serif; 
    }

    .table th {
        text-align: center;
    }

    .table td.no-column {
        text-align: center;
        width: 60px;
    }

    /* Alert Styles */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border: none;
        font-weight: 500;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    /* Row dan Column Layout */
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-col {
        flex: 1;
    }

    /* Pagination */
    .pagination-info {
        font-family: 'Open Sans', sans-serif;
        color: #666;
        font-size: 14px;
    }

    .pagination {
        font-family: 'Open Sans', sans-serif;
    }
    
    @media (max-width: 768px) {
        .card {
            padding: 20px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .gallery-title {
            font-size: 2.2rem;
        }
        
        .table {
            font-size: 14px;
        }
        
        .table th, .table td {
            padding: 8px;
        }
    }

    @media (max-width: 576px) {
        .gallery-title { 
            font-size: 1.8rem; 
        }
        
        .gallery-header p {
            font-size: 1rem;
        }
        
        .container-main {
            padding: 15px;
        }
        
        .card {
            padding: 15px;
        }
        
        .btn-submit, .btn-excel {
            width: 100%;
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="container-main">
    <!-- Judul Halaman - Mengikuti gaya dari halaman jumlah penduduk -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            FORMULIR BUKU TAMU
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Data kunjungan tamu dan pengunjung Desa Manggalung
        </p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form Input -->
    <div class="card">
        <div class="form-group">
            <h5 class="form-section-title" style="color: #2E7D32; font-weight: 600; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                <i class="bi bi-person-plus me-2"></i>
                Form Input Data Tamu
            </h5>
        </div>

        <form action="{{ route('bukutamu') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label>Asal Instansi / Tempat <span class="text-danger">*</span></label>
                        <input type="text" name="asal" placeholder="Contoh: Dinas Kominfo" value="{{ old('asal') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Keperluan <span class="text-danger">*</span></label>
                <textarea name="keperluan" placeholder="Tuliskan keperluan kunjungan Anda" rows="3" required>{{ old('keperluan') }}</textarea>
            </div>

            <div class="form-group" style="text-align: right;">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-save me-2"></i> Simpan Data Tamu
                </button>
            </div>
        </form>
    </div>

    <!-- Card Tabel Data -->
    <div class="card">
        <div class="form-row" style="align-items: center; margin-bottom: 20px;">
            <div class="form-col">
                <h5 class="form-section-title" style="color: #2E7D32; font-weight: 600; margin-bottom: 0; font-family: 'Poppins', sans-serif;">
                    <i class="bi bi-table me-2"></i>
                    Data Pengunjung
                </h5>
            </div>
            <div class="form-col" style="flex: 0 0 auto; text-align: right;">
                <button class="btn-excel" onclick="downloadExcel()">
                    <i class="bi bi-file-earmark-excel me-2"></i> Ekspor Excel
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Asal</th>
                        <th>Keperluan</th>
                        <th style="width: 150px;">Tanggal</th>
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
            <div class="form-row" style="align-items: center; margin-top: 20px;">
                <div class="form-col">
                    <small class="pagination-info">
                        Menampilkan {{ $bukutamus->count() }} dari {{ $bukutamus->total() }} data pengunjung
                    </small>
                </div>
                <div class="form-col" style="flex: 0 0 auto; text-align: right;">
                    {{ $bukutamus->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
function downloadExcel() {
    const table = document.querySelector('.table');
    const rows = table.querySelectorAll('tbody tr');
    
    if(rows.length === 0 || (rows[0].querySelector('td') && rows[0].querySelector('td').colSpan > 1)) {
        alert('Tidak ada data untuk diekspor!');
        return;
    }
    
    if (!confirm('Apakah Anda yakin ingin mengekspor data buku tamu ke Excel?')) return;

    const wb = XLSX.utils.book_new();
    const excelData = [
        ["DATA BUKU TAMU DESA MANGGAUNG"],
        ["Tanggal Ekspor: " + new Date().toLocaleDateString('id-ID')],
        ["Jumlah Data: {{ $bukutamus->count() }}"],
        [""],
        ["No", "Nama", "Asal", "Keperluan", "Tanggal Kunjungan"]
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
    ws['!cols'] = [{wch: 6}, {wch: 25}, {wch: 25}, {wch: 50}, {wch: 25}];
    XLSX.utils.book_append_sheet(wb, ws, "Buku Tamu");
    XLSX.writeFile(wb, `Buku_Tamu_Desa_Manggalung_${new Date().toISOString().split('T')[0]}.xlsx`);
}
</script>
@endsection
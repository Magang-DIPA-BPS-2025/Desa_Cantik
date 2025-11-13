@extends('layouts.app', ['title' => 'Data APBD Desa'])

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    .action-buttons { display: flex; gap: 5px; justify-content: center; }
    .action-buttons .btn { width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 14px; border-radius: 6px; }

    .control-bar { 
        display: flex; 
        flex-direction: column; 
        gap: 15px; 
        margin-bottom: 20px; 
    }
    
    /* Baris pertama - Tombol aksi vertikal */
    .button-row { 
        display: flex; 
        flex-direction: column;
        gap: 8px; 
        width: 100%;
        max-width: 200px;
    }
    
    /* Baris kedua - Entries dan Pencarian */
    .filter-row { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        gap: 15px;
        flex-wrap: wrap;
        width: 100%;
    }
    
    .entries-control { 
        display: flex; 
        align-items: center; 
        gap: 10px;
        flex-shrink: 0;
    }
    
    .search-container { 
        position: relative; 
        width: 300px; 
        flex-shrink: 0;
    }
    
    .search-container .form-control { 
        padding-right: 40px; 
        border-radius: 6px;
    }
    
    .clear-search { 
        position: absolute; 
        right: 10px; 
        top: 50%; 
        transform: translateY(-50%); 
        background: none; 
        border: none; 
        color: #999; 
        cursor: pointer; 
        display: none;
        padding: 5px;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 12px;
        width: 100%;
        text-align: center;
        border: 1px solid transparent;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .form-control {
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Dropdown Download */
    .download-dropdown {
        position: relative;
        width: 100%;
    }

    .download-dropdown .btn {
        width: 100%;
        justify-content: space-between;
    }

    .download-dropdown .dropdown-menu {
        width: 100%;
        min-width: 200px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 6px;
    }

    .download-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .download-dropdown .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .download-dropdown .dropdown-item i {
        width: 16px;
        text-align: center;
    }


    /* Pagination */
.pagination-container { 
    margin-top: 20px; 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    flex-wrap: wrap; 
    gap: 10px; 
}
.pagination-info { 
    font-size: 14px; 
    color: #6c757d; 
}
.pagination-wrapper { 
    display: flex; 
    justify-content: flex-end; 
}

    @media (max-width: 768px) {
        .filter-row { 
            flex-direction: column; 
            align-items: stretch; 
            gap: 10px;
        }
        
        .search-container { 
            width: 100%; 
        }
        
        .entries-control {
            justify-content: flex-start;
        }
        
        .button-row {
            max-width: 100%;
        }
    }

    @media (min-width: 769px) {
        .button-row {
            max-width: 180px;
        }
    }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data APBD Desa</h1>
        </div>
        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <!-- Control Bar -->
                    <div class="control-bar">
                        <!-- Baris 1: Tombol Aksi VERTIKAL -->
                        <div class="button-row">
                            <a href="{{ route('apbd.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data APBD
                            </a>
                            
                            <!-- Dropdown Download -->
                            <div class="download-dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="downloadDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-download"></i> Download Data
                                </button>
                                <div class="dropdown-menu" aria-labelledby="downloadDropdown">
                                    <a class="dropdown-item" href="#" id="export-excel-btn">
                                        <i class="fas fa-file-excel text-success"></i> Download Excel
                                    </a>
                                    <a class="dropdown-item" href="#" id="export-pdf-btn">
                                        <i class="fas fa-file-pdf text-danger"></i> Download PDF
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Baris 2: Entries dan Pencarian -->
                        <div class="filter-row">
                            <div class="entries-control">
                                <label for="entries-select" class="mb-0 text-nowrap">Tampilkan</label>
                                <select id="entries-select" class="form-control form-control-sm" style="width: 80px;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="text-nowrap">entri</span>
                            </div>

                            <div class="search-container">
                                <input type="text" id="custom-search" class="form-control form-control-sm" placeholder="Cari data...">
                                <button type="button" id="clear-search" class="clear-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-apbd">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Total Pendapatan</th>
                                    <th>Total Belanja</th>
                                    <th>Surplus/Defisit</th>
                                    <th>PAD (%)</th>
                                    <th>Transfer (%)</th>
                                    <th>Lainnya (%)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apbds as $index => $apbd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $apbd->tahun }}</td>
                                    <td class="text-end">{{ number_format($apbd->total_pendapatan,0,',','.') }}</td>
                                    <td class="text-end">{{ number_format($apbd->total_belanja,0,',','.') }}</td>
                                    <td class="text-end">
                                        <span class="badge {{ $apbd->surplus_defisit >= 0 ? 'bg-success' : 'bg-danger' }} text-white">
                                            {{ number_format($apbd->surplus_defisit,0,',','.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $apbd->pendapatan_pad_persen }}%</td>
                                    <td class="text-center">{{ $apbd->pendapatan_transfer_persen }}%</td>
                                    <td class="text-center">{{ $apbd->pendapatan_lain_persen }}%</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('apbd.edit',$apbd->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('apbd.destroy',$apbd->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($apbds->hasPages())
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan {{ ($apbds->currentPage()-1)*$apbds->perPage()+1 }} sampai {{ min($apbds->currentPage()*$apbds->perPage(), $apbds->total()) }} dari {{ $apbds->total() }} entri
                        </div>
                        <div class="pagination-wrapper">
                            {{ $apbds->links() }}
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
$(document).ready(function(){

    // Inisialisasi DataTable TANPA PAGINATION
    var table = $('#table-apbd').DataTable({
        pageLength: parseInt($('#entries-select').val()) || 10,
        lengthChange: false,
        paging: false, // PAGINATION DINONAKTIFKAN
        searching: true,
        ordering: true,
        info: false, // INFO DINONAKTIFKAN
        autoWidth: false,
        language: { 
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            search: "Cari:",
            searchPlaceholder: "Cari data..."
        },
        columnDefs: [
            { orderable: false, targets: [0, 8] }, // Kolom No dan Aksi tidak bisa diurutkan
            { className: "dt-center", targets: [0, 1, 5, 6, 7, 8] }, // Center untuk kolom tertentu
            { className: "dt-right", targets: [2, 3, 4] } // Right align untuk kolom angka
        ],
        dom: '<"row"<"col-sm-12"tr>>', // HANYA TABEL, TANPA PAGINATION DAN INFO
        drawCallback: function(settings) {
            // Update nomor urut setelah filter
            var api = this.api();
            var rows = api.rows({page:'current'}).nodes();
            var start = 0;
            
            api.column(0, {page:'current'}).nodes().each(function(cell, i) {
                cell.innerHTML = start + i + 1;
            });
        }
    });

    // Custom search
    $('#custom-search').on('keyup', function(){
        table.search(this.value).draw();
        $('#clear-search').toggle(this.value.length > 0);
    });
    
    $('#clear-search').on('click', function(){
        $('#custom-search').val('').trigger('keyup').focus();
    });

    // Entries per page - TIDAK DIPERLUKAN LAGI KARENA PAGINATION DINONAKTIFKAN
    $('#entries-select').on('change', function(){
        // Nonaktifkan fungsi entries karena pagination sudah dinonaktifkan
        alert('Fitur pagination telah dinonaktifkan. Semua data akan ditampilkan sekaligus.');
    });

    // Export Excel
    $('#export-excel-btn').on('click', function(e){
        e.preventDefault();
        console.log('Export Excel clicked');
        
        try {
            var wb = XLSX.utils.book_new();
            var ws_data = [];
            
            // Header
            var headers = [];
            $('#table-apbd thead tr th').each(function(){
                if($(this).text() !== "Aksi"){ 
                    headers.push($(this).text().trim()); 
                }
            });
            ws_data.push(headers);
            
            // Data rows - ambil semua data
            var allData = table.rows().data();
            
            for (var i = 0; i < allData.length; i++) {
                var row = [];
                var rowData = allData[i];
                
                // Loop melalui setiap cell dalam row (kecuali kolom aksi)
                for (var j = 0; j < rowData.length - 1; j++) {
                    var cellContent = rowData[j];
                    
                    // Jika cell berisi HTML (seperti badge), ambil teksnya saja
                    if (typeof cellContent === 'string' && cellContent.includes('<')) {
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = cellContent;
                        cellContent = tempDiv.textContent || tempDiv.innerText || '';
                    }
                    
                    row.push(cellContent);
                }
                ws_data.push(row);
            }
            
            // Buat worksheet
            var ws = XLSX.utils.aoa_to_sheet(ws_data);
            
            // Atur lebar kolom
            var colWidths = [
                {wch: 5},   // No
                {wch: 8},   // Tahun
                {wch: 15},  // Total Pendapatan
                {wch: 15},  // Total Belanja
                {wch: 15},  // Surplus/Defisit
                {wch: 10},  // PAD (%)
                {wch: 12},  // Transfer (%)
                {wch: 10}   // Lainnya (%)
            ];
            ws['!cols'] = colWidths;
            
            // Tambah worksheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, "APBD Desa");
            
            // Export file
            var fileName = "data_apbd_desa_" + new Date().toISOString().split('T')[0] + ".xlsx";
            XLSX.writeFile(wb, fileName);
            
            console.log('Excel export successful');
            
        } catch (error) {
            console.error('Error exporting Excel:', error);
            alert('Terjadi kesalahan saat mengekspor ke Excel: ' + error.message);
        }
    });

    // Export PDF
    $('#export-pdf-btn').on('click', function(e){
        e.preventDefault();
        console.log('Export PDF clicked');
        
        try {
            // Pastikan jsPDF tersedia
            if (typeof window.jspdf === 'undefined') {
                throw new Error('jsPDF library tidak ditemukan');
            }
            
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape');
            
            // Judul
            doc.setFontSize(16);
            doc.setTextColor(40, 40, 40);
            doc.text('DATA APBD DESA', 148, 15, { align: 'center' });
            
            // Tanggal export
            doc.setFontSize(10);
            doc.setTextColor(100, 100, 100);
            doc.text('Dicetak pada: ' + new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }), 148, 22, { align: 'center' });
            
            // Prepare data untuk tabel
            var headers = [];
            var rows = [];
            
            // Ambil headers (kecuali kolom Aksi)
            $('#table-apbd thead tr th').each(function(){
                if($(this).text() !== "Aksi"){ 
                    headers.push($(this).text().trim()); 
                }
            });
            
            // Ambil semua data rows dari DataTable
            var allData = table.rows().data();
            
            for (var i = 0; i < allData.length; i++) {
                var rowData = [];
                var data = allData[i];
                
                // Loop melalui setiap cell dalam row (kecuali kolom aksi)
                for (var j = 0; j < data.length - 1; j++) {
                    var cellContent = data[j];
                    
                    // Jika cell berisi HTML (seperti badge), ambil teksnya saja
                    if (typeof cellContent === 'string' && cellContent.includes('<')) {
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = cellContent;
                        cellContent = tempDiv.textContent || tempDiv.innerText || '';
                    }
                    
                    rowData.push(cellContent);
                }
                rows.push(rowData);
            }
            
            // Jika tidak ada data
            if (rows.length === 0) {
                doc.text('Tidak ada data untuk ditampilkan', 20, 40);
            } else {
                // Buat tabel dengan autoTable
                doc.autoTable({
                    head: [headers],
                    body: rows,
                    startY: 35,
                    theme: 'grid',
                    styles: {
                        fontSize: 9,
                        cellPadding: 3,
                        overflow: 'linebreak'
                    },
                    headStyles: {
                        fillColor: [41, 128, 185],
                        textColor: 255,
                        fontStyle: 'bold',
                        halign: 'center'
                    },
                    bodyStyles: {
                        halign: 'left'
                    },
                    columnStyles: {
                        0: { halign: 'center', cellWidth: 15 }, // No
                        1: { halign: 'center', cellWidth: 20 }, // Tahun
                        2: { halign: 'right', cellWidth: 30 },  // Total Pendapatan
                        3: { halign: 'right', cellWidth: 30 },  // Total Belanja
                        4: { halign: 'right', cellWidth: 25 },  // Surplus/Defisit
                        5: { halign: 'center', cellWidth: 20 }, // PAD (%)
                        6: { halign: 'center', cellWidth: 25 }, // Transfer (%)
                        7: { halign: 'center', cellWidth: 20 }  // Lainnya (%)
                    },
                    margin: { top: 35 },
                    didDrawPage: function (data) {
                        // Footer
                        var pageCount = doc.internal.getNumberOfPages();
                        doc.setFontSize(8);
                        doc.setTextColor(150, 150, 150);
                        doc.text('Halaman ' + data.pageNumber + ' dari ' + pageCount, doc.internal.pageSize.width / 2, doc.internal.pageSize.height - 10, { align: 'center' });
                    }
                });
            }
            
            // Simpan PDF
            var fileName = 'data_apbd_desa_' + new Date().toISOString().split('T')[0] + '.pdf';
            doc.save(fileName);
            
            console.log('PDF export successful');
            
        } catch (error) {
            console.error('Error exporting PDF:', error);
            alert('Terjadi kesalahan saat mengekspor ke PDF: ' + error.message);
        }
    });

});
</script>
@endpush
@endsection
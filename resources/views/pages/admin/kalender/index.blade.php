@extends('layouts.app', ['title' => 'Kalender Desa'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            #table-kegiatan tbody tr:hover { background-color: #f2f7fb; }

            .action-buttons { 
                display: flex; 
                gap: 5px; 
                justify-content: center;
                align-items: center;
            }
            
            .action-buttons .btn {
                width: 35px; 
                height: 35px; 
                font-size: 14px;
                display: flex; 
                align-items: center; 
                justify-content: center;
                padding: 0; 
                border-radius: 6px; 
                color: white;
                transition: transform 0.2s;
            }
            .action-buttons .btn-warning { background-color: #FFA500; border: none; }
            .action-buttons .btn-danger { background-color: #FF4D4F; border: none; }
            .action-buttons .btn:hover { transform: scale(1.1); }

            .action-buttons form {
                margin: 0;
                display: inline-flex;
            }

            .pagination { justify-content: flex-end !important; }

            /* Control bar */
            .control-bar { 
                display: flex; 
                justify-content: space-between; 
                align-items: flex-end; 
                margin-bottom: 15px; 
                flex-wrap: wrap; 
                gap: 15px; 
            }
            .left-controls { 
                display: flex; 
                flex-direction: column; 
                align-items: flex-start; 
                gap: 10px; 
            }
            .right-controls { 
                display: flex; 
                align-items: center; 
            }
            .entries-control { 
                display: flex; 
                align-items: center; 
                gap: 10px; 
            }

            /* Search box */
            .search-container { 
                position: relative; 
                width: 300px; 
            }
            .search-container .form-control { 
                padding-right: 40px; 
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
            }
            .clear-search:hover { color: #333; }

            /* Table alignment fixes */
            .table-custom {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }
            
            .table-custom th { 
                background: #f8f9fa; 
                padding: 14px 8px; 
                text-align: center; 
                font-weight: 600; 
                border-bottom: 2px solid #dee2e6; 
                vertical-align: middle;
                font-size: 14px;
            }
            
            .table-custom td { 
                padding: 12px 8px; 
                text-align: center; 
                border-bottom: 1px solid #dee2e6; 
                vertical-align: middle;
                font-size: 14px;
            }

            /* Atur lebar kolom spesifik untuk alignment yang konsisten */
            .table-custom th:nth-child(1), /* No */
            .table-custom td:nth-child(1) {
                width: 60px;
                text-align: center;
            }

            .table-custom th:nth-child(2), /* Nama Kegiatan */
            .table-custom td:nth-child(2) {
                width: 250px;
                text-align: left;
                padding-left: 12px;
            }

            .table-custom th:nth-child(3), /* Tanggal Kegiatan */
            .table-custom td:nth-child(3) {
                width: 150px;
                text-align: center;
            }

            .table-custom th:nth-child(4), /* Dibuat Pada */
            .table-custom td:nth-child(4) {
                width: 180px;
                text-align: center;
            }

            .table-custom th:nth-child(5), /* Aksi */
            .table-custom td:nth-child(5) {
                width: 120px;
                text-align: center;
            }

            /* Dropdown Download */
            .download-dropdown {
                position: relative;
                display: inline-block;
            }

            .btn-download {
                background: #2E7D32; 
                color: #fff; 
                border: none; 
                border-radius: 8px; 
                padding: 8px 14px; 
                display: flex; 
                align-items: center; 
                gap: 6px; 
                font-size: 14px; 
                font-weight: 500; 
                cursor: pointer; 
                transition: .3s; 
                font-family: 'Poppins', sans-serif; 
                text-decoration: none;
            }

            .btn-download:hover { 
                background: #1B5E20; 
                color: #fff; 
                text-decoration: none; 
            }

            .download-dropdown-content {
                display: none;
                position: absolute;
                background-color: #fff;
                min-width: 160px;
                box-shadow: 0 8px 16px rgba(0,0,0,0.1);
                border-radius: 8px;
                z-index: 1000;
                overflow: hidden;
                margin-top: 5px;
            }

            .download-dropdown-content a {
                color: #333;
                padding: 10px 16px;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                transition: background-color 0.2s;
            }

            .download-dropdown-content a:hover {
                background-color: #f8f9fa;
                color: #2E7D32;
            }

            .download-dropdown-content a i {
                width: 16px;
                text-align: center;
            }

            .download-dropdown:hover .download-dropdown-content {
                display: block;
            }

            @media (max-width: 992px) {
                .control-bar {
                    flex-direction: column;
                    align-items: stretch;
                }
                .left-controls {
                    align-items: stretch;
                }
                .right-controls {
                    width: 100%;
                }
                .search-container {
                    width: 100%;
                }
            }

            @media (max-width: 768px) {
                .table-responsive {
                    overflow-x: auto;
                }
                
                .table-custom {
                    table-layout: auto;
                    min-width: 700px;
                }
                
                .table-custom th,
                .table-custom td {
                    width: auto !important;
                    padding: 10px 6px;
                    font-size: 13px;
                }

                .action-buttons .btn {
                    width: 32px;
                    height: 32px;
                    font-size: 12px;
                }

                .download-dropdown-content {
                    min-width: 140px;
                }
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kalender Desa</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <!-- Notifikasi -->
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

                        <!-- Control Bar -->
                        <div class="control-bar">
                            <div class="left-controls">
                                <a href="{{ route('kalenderDesa.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Kegiatan
                                </a>

                                <!-- Dropdown Download -->
                                <div class="download-dropdown">
                                    <button class="btn-download">
                                        <i class="fas fa-download"></i> Download
                                        <i class="fas fa-caret-down" style="margin-left: 5px;"></i>
                                    </button>
                                    <div class="download-dropdown-content">
                                        <a href="#" onclick="downloadPDF()">
                                            <i class="fas fa-file-pdf text-danger"></i> Download PDF
                                        </a>
                                        <a href="#" onclick="downloadExcel()">
                                            <i class="fas fa-file-excel text-success"></i> Download Excel
                                        </a>
                                    </div>
                                </div>

                                <!-- Entries Control -->
                                <div class="entries-control">
                                    <label for="entries-select" class="mb-0">Tampilkan</label>
                                    <select id="entries-select" class="form-control form-control-sm" style="width: auto;">
                                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                    <span>entri</span>
                                </div>
                            </div>

                            <div class="right-controls">
                                <div class="search-container">
                                    <input type="text" class="form-control" id="custom-search" placeholder="Cari kegiatan..." value="{{ request('search') }}">
                                    <button class="clear-search" id="clear-search" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Kegiatan -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-custom" id="table-kegiatan">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatans as $i => $kegiatan)
                                        <tr>
                                            <td>{{ $kegiatans->firstItem() + $i }}</td>
                                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}</td>
                                            <td>{{ $kegiatan->created_at ? \Carbon\Carbon::parse($kegiatan->created_at)->format('d-m-Y H:i') : '-' }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('kalender.edit', $kegiatan->id) }}" class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kalender.destroy', $kegiatan->id) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin hapus kegiatan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Hapus">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($kegiatans->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Menampilkan {{ $kegiatans->firstItem() ?? 0 }} hingga {{ $kegiatans->lastItem() ?? 0 }} dari {{ $kegiatans->total() }} entri
                            </div>
                            <div>{{ $kegiatans->links('pagination::bootstrap-4') }}</div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function(){
                const searchInput = document.getElementById('custom-search');
                const clearSearch = document.getElementById('clear-search');
                const entriesSelect = document.getElementById('entries-select');

                // Entries control
                if(entriesSelect){
                    entriesSelect.addEventListener('change', function(){
                        const perPage = this.value;
                        const url = new URL(window.location.href);
                        url.searchParams.set('per_page', perPage);
                        window.location.href = url.toString();
                    });
                }

                // Search functionality
                if(searchInput && clearSearch){
                    searchInput.addEventListener('input',()=>{ 
                        clearSearch.style.display = searchInput.value ? 'block':'none'; 
                    });
                    
                    clearSearch.addEventListener('click', ()=>{
                        searchInput.value=''; 
                        clearSearch.style.display='none';
                        const url = new URL(window.location.href);
                        url.searchParams.delete('search');
                        window.location.href = url.toString();
                    });
                    
                    searchInput.addEventListener('keypress', function(e){
                        if(e.key === 'Enter'){
                            const searchTerm = this.value;
                            const url = new URL(window.location.href);
                            if(searchTerm) {
                                url.searchParams.set('search', searchTerm);
                            } else {
                                url.searchParams.delete('search');
                            }
                            window.location.href = url.toString();
                        }
                    });
                }

                // Tampilkan clear button jika ada pencarian
                @if(request('search'))
                    if(clearSearch) clearSearch.style.display = 'block';
                @endif
            });

            // PDF Download Function
            async function downloadPDF() {
                const btn = document.querySelector('.btn-download');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';
                btn.disabled = true;

                try {
                    const element = document.createElement('div');
                    element.style.padding = '20px';
                    element.innerHTML = `<div style="text-align:center;margin-bottom:20px;">
                        <h2 style="margin:0;color:#333;">Data Kalender Desa</h2>
                        <p style="margin:5px 0 0 0;color:#666;">Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
                    </div>`;

                    const table = document.querySelector('#table-kegiatan').cloneNode(true);
                    // Hapus kolom aksi
                    table.querySelectorAll('tr').forEach(row => {
                        const cells = row.querySelectorAll('td, th');
                        if (cells.length > 0) row.removeChild(cells[cells.length - 1]);
                    });

                    // Styling tabel untuk PDF
                    table.style.width = '100%';
                    table.style.borderCollapse = 'collapse';
                    table.style.fontSize = '10px';
                    table.style.fontFamily = 'Arial, sans-serif';
                    
                    table.querySelectorAll('th').forEach(th => {
                        th.style.backgroundColor = '#4f46e5';
                        th.style.color = 'white';
                        th.style.border = '1px solid #3730a3';
                        th.style.padding = '6px';
                        th.style.textAlign = 'center';
                        th.style.fontWeight = 'bold';
                    });
                    
                    table.querySelectorAll('td').forEach(td => {
                        td.style.border = '1px solid #e5e7eb';
                        td.style.padding = '5px';
                        td.style.verticalAlign = 'middle';
                    });
                    
                    // Center untuk kolom no, tanggal, dan dibuat pada
                    table.querySelectorAll('td:nth-child(1), td:nth-child(3), td:nth-child(4)').forEach(td => {
                        td.style.textAlign = 'center';
                    });

                    element.appendChild(table);

                    await html2pdf().set({
                        margin: [10, 10, 10, 10],
                        filename: 'Data_Kalender_Desa.pdf',
                        image: { type: 'jpeg', quality: 0.8 },
                        html2canvas: { scale: 2, useCORS: true, logging: false, allowTaint: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                    }).from(element).save();

                } catch(e) {
                    console.error(e);
                    alert('Terjadi kesalahan saat membuat PDF.');
                } finally {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }

            // Excel Download Function
            function downloadExcel() {
                const btn = document.querySelector('.btn-download');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat Excel...';
                btn.disabled = true;

                try {
                    // Ambil data dari tabel
                    const table = document.getElementById('table-kegiatan');
                    const data = [];

                    // Ambil header
                    const headers = [];
                    table.querySelectorAll('thead th').forEach((th, index) => {
                        // Skip kolom aksi (kolom terakhir)
                        if (index < table.querySelectorAll('thead th').length - 1) {
                            headers.push(th.innerText.trim());
                        }
                    });
                    data.push(headers);

                    // Ambil data baris
                    table.querySelectorAll('tbody tr').forEach(tr => {
                        const row = [];
                        tr.querySelectorAll('td').forEach((td, index) => {
                            // Skip kolom aksi (kolom terakhir)
                            if (index < tr.querySelectorAll('td').length - 1) {
                                row.push(td.innerText.trim());
                            }
                        });
                        data.push(row);
                    });

                    // Buat workbook dan worksheet
                    const ws = XLSX.utils.aoa_to_sheet(data);
                    
                    // Atur lebar kolom
                    const colWidths = [
                        { wch: 8 },   // No
                        { wch: 40 },  // Nama Kegiatan
                        { wch: 15 },  // Tanggal Kegiatan
                        { wch: 20 }   // Dibuat Pada
                    ];
                    ws['!cols'] = colWidths;

                    // Buat workbook
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Data Kalender Desa');

                    // Download file
                    XLSX.writeFile(wb, `Data_Kalender_Desa_${new Date().toISOString().split('T')[0]}.xlsx`);

                } catch(e) {
                    console.error(e);
                    alert('Terjadi kesalahan saat membuat Excel.');
                } finally {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }
        </script>
    @endpush
@endsection
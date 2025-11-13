@extends('layouts.app', ['title' => 'Berita Desa'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            #table-berita tbody tr:hover { background-color: #f2f7fb; }

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

            /* Foto */
            .foto-berita {
                width: 80px;
                height: 60px;
                object-fit: cover;
                border-radius: 6px;
                border: 1px solid #ddd;
                display: block;
                margin: 0 auto;
            }

            /* Deskripsi styling */
            .deskripsi-singkat {
                max-width: 280px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

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

            .table-custom th:nth-child(2), /* Judul */
            .table-custom td:nth-child(2) {
                width: 100px;
                text-align: left;
                padding-left: 12px;
            }

            .table-custom th:nth-child(3), /* Kategori */
            .table-custom td:nth-child(3) {
                width: 120px;
                text-align: center;
            }

            .table-custom th:nth-child(4), /* Tanggal */
            .table-custom td:nth-child(4) {
                width: 120px;
                text-align: center;
            }

            .table-custom th:nth-child(5), /* Deskripsi Singkat */
            .table-custom td:nth-child(5) {
                width: 240px;
                text-align: left;
                padding-left: 12px;
            }

            .table-custom th:nth-child(6), /* Foto */
            .table-custom td:nth-child(6) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(7), /* Dilihat */
            .table-custom td:nth-child(7) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(8), /* Aksi */
            .table-custom td:nth-child(8) {
                width: 120px;
                text-align: center;
            }

            /* Styling untuk sel tanpa foto */
            .no-foto {
                color: #6c757d;
                font-style: italic;
                font-size: 12px;
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
                    min-width: 900px;
                }
                
                .table-custom th,
                .table-custom td {
                    width: auto !important;
                    padding: 10px 6px;
                    font-size: 13px;
                }

                .foto-berita {
                    width: 60px;
                    height: 45px;
                }

                .deskripsi-singkat {
                    max-width: 200px;
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
                <h1>Data Berita Desa</h1>
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
                                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Berita
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
                                    <input type="text" class="form-control" id="custom-search" placeholder="Cari berita..." value="{{ request('search') }}">
                                    <button class="clear-search" id="clear-search" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Berita -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-custom" id="table-berita">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi Singkat</th>
                                        <th>Foto</th>
                                        <th>Dilihat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $i => $berita)
                                        <tr>
                                            <td>{{ $datas->firstItem() + $i }}</td>
                                            <td>{{ $berita->judul }}</td>
                                            <td>{{ $berita->kategori->nama ?? '-' }}</td>
                                            <td>{{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->format('d-m-Y') : '-' }}</td>
                                            <td class="deskripsi-singkat" title="{{ $berita->deskripsi_singkat }}">
                                                {{ Str::limit($berita->deskripsi_singkat, 50) }}
                                            </td>
                                            <td>
                                                @if($berita->foto)
                                                    <img src="{{ asset('storage/' . $berita->foto) }}" class="foto-berita" alt="Foto Berita">
                                                @else
                                                    <span class="no-foto">Tidak ada foto</span>
                                                @endif
                                            </td>
                                            <td>{{ $berita->dilihat }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin hapus berita ini?')">
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
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Menampilkan {{ $datas->firstItem() ?? 0 }} hingga {{ $datas->lastItem() ?? 0 }} dari {{ $datas->total() }} entri
                            </div>
                            <div>{{ $datas->links('pagination::bootstrap-4') }}</div>
                        </div>

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
            async function getBase64Image(img) {
                return new Promise((resolve, reject) => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const image = new Image();
                    image.crossOrigin = 'Anonymous';
                    image.onload = function() {
                        canvas.width = image.width;
                        canvas.height = image.height;
                        ctx.drawImage(image, 0, 0);
                        resolve(canvas.toDataURL('image/jpeg', 0.8));
                    };
                    image.onerror = function() { reject(new Error('Gagal memuat gambar')); };
                    image.src = img.src;
                });
            }

            async function downloadPDF() {
                const btn = document.querySelector('.btn-download');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';
                btn.disabled = true;

                try {
                    const element = document.createElement('div');
                    element.style.padding = '20px';
                    element.innerHTML = `<div style="text-align:center;margin-bottom:20px;">
                        <h2 style="margin:0;color:#333;">Data Berita Desa</h2>
                        <p style="margin:5px 0 0 0;color:#666;">Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
                    </div>`;

                    const table = document.querySelector('#table-berita').cloneNode(true);
                    // Hapus kolom aksi
                    table.querySelectorAll('tr').forEach(row => {
                        const cells = row.querySelectorAll('td, th');
                        if (cells.length > 0) row.removeChild(cells[cells.length - 1]);
                    });

                    // Proses gambar
                    const fotoCells = table.querySelectorAll('td:nth-child(6)');
                    for (let i = 0; i < fotoCells.length; i++) {
                        const cell = fotoCells[i];
                        const img = cell.querySelector('img');
                        if (img) {
                            cell.innerHTML = `<img src="${await getBase64Image(img)}" style="width:40px;height:30px;border-radius:4px;border:1px solid #ddd;">`;
                        } else {
                            cell.innerHTML = '<span style="color:#999;font-size:10px;">Tidak Ada Foto</span>';
                        }
                    }

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
                    
                    // Center untuk kolom tertentu
                    table.querySelectorAll('td:nth-child(1), td:nth-child(3), td:nth-child(4), td:nth-child(6), td:nth-child(7)').forEach(td => {
                        td.style.textAlign = 'center';
                    });

                    // Atur lebar kolom deskripsi
                    table.querySelectorAll('td:nth-child(5)').forEach(td => {
                        td.style.maxWidth = '200px';
                        td.style.wordWrap = 'break-word';
                    });

                    element.appendChild(table);

                    await html2pdf().set({
                        margin: [10, 10, 10, 10],
                        filename: 'Data_Berita_Desa.pdf',
                        image: { type: 'jpeg', quality: 0.8 },
                        html2canvas: { scale: 2, useCORS: true, logging: false, allowTaint: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
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
                    const table = document.getElementById('table-berita');
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
                                if (index === 5) { // Kolom foto
                                    const img = td.querySelector('img');
                                    row.push(img ? 'Ada Foto' : 'Tidak Ada Foto');
                                } else if (index === 4) { // Kolom deskripsi singkat
                                    row.push(td.getAttribute('title') || td.innerText.trim());
                                } else {
                                    row.push(td.innerText.trim());
                                }
                            }
                        });
                        data.push(row);
                    });

                    // Buat workbook dan worksheet
                    const ws = XLSX.utils.aoa_to_sheet(data);
                    
                    // Atur lebar kolom
                    const colWidths = [
                        { wch: 5 },   // No
                        { wch: 25 },  // Judul
                        { wch: 15 },  // Kategori
                        { wch: 12 },  // Tanggal
                        { wch: 40 },  // Deskripsi Singkat
                        { wch: 10 },  // Foto
                        { wch: 10 }    // Dilihat
                    ];
                    ws['!cols'] = colWidths;

                    // Buat workbook
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Data Berita Desa');

                    // Download file
                    XLSX.writeFile(wb, `Data_Berita_Desa_${new Date().toISOString().split('T')[0]}.xlsx`);

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
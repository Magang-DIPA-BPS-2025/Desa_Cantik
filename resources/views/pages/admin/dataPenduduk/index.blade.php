@extends('layouts.app', ['title' => 'Data Penduduk'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            #table-penduduk tbody tr:hover { background-color: #f2f7fb; }

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

            .table-custom {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }
            
            .table-custom th { 
                background: #f8f9fa; 
                padding: 12px 8px; 
                text-align: center; 
                font-weight: 600; 
                border-bottom: 2px solid #dee2e6; 
                vertical-align: middle;
                font-size: 12px;
            }
            
            .table-custom td { 
                padding: 10px 8px; 
                text-align: center; 
                border-bottom: 1px solid #dee2e6; 
                vertical-align: middle;
                font-size: 11px;
            }

            .table-custom th:nth-child(1), 
            .table-custom td:nth-child(1) {
                width: 50px;
                text-align: center;
            }

            .table-custom th:nth-child(2),
            .table-custom td:nth-child(2) {
                width: 120px;
                text-align: center;
            }

            .table-custom th:nth-child(3), 
            .table-custom td:nth-child(3) {
                width: 120px;
                text-align: center;
            }

            .table-custom th:nth-child(4), 
            .table-custom td:nth-child(4) {
                width: 150px;
                text-align: left;
                padding-left: 8px;
            }

            .table-custom th:nth-child(5), 
            .table-custom td:nth-child(5) {
                width: 80px;
                text-align: center;
            }

            .table-custom th:nth-child(6), 
            .table-custom td:nth-child(6) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(7), 
            .table-custom td:nth-child(7) {
                width: 90px;
                text-align: center;
            }

            .table-custom th:nth-child(8), 
            .table-custom td:nth-child(8) {
                width: 150px;
                text-align: left;
                padding-left: 8px;
            }

            .table-custom th:nth-child(9), 
            .table-custom td:nth-child(9) {
                width: 80px;
                text-align: center;
            }

            .table-custom th:nth-child(10), 
            .table-custom td:nth-child(10) {
                width: 50px;
                text-align: center;
            }

            .table-custom th:nth-child(11), 
            .table-custom td:nth-child(11) {
                width: 50px;
                text-align: center;
            }

            .table-custom th:nth-child(12), 
            .table-custom td:nth-child(12) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(13), 
            .table-custom td:nth-child(13) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(14), 
            .table-custom td:nth-child(14) {
                width: 80px;
                text-align: center;
            }

            .table-custom th:nth-child(15), 
            .table-custom td:nth-child(15) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(16), 
            .table-custom td:nth-child(16) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(17), 
            .table-custom td:nth-child(17) {
                width: 100px;
                text-align: center;
            }

            .table-custom th:nth-child(18), 
            .table-custom td:nth-child(18) {
                width: 80px;
                text-align: center;
            }

            .table-custom th:nth-child(19), 
            .table-custom td:nth-child(19) {
                width: 70px;
                text-align: center;
            }

            .table-custom th:nth-child(20), 
            .table-custom td:nth-child(20) {
                width: 60px;
                text-align: center;
            }

            .table-custom th:nth-child(21), 
            .table-custom td:nth-child(21) {
                width: 80px;
                text-align: center;
            }

            .text-ellipsis {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 140px;
                display: inline-block;
            }

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

            .pdf-loading {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .pdf-loading-content {
                background: white;
                padding: 20px;
                border-radius: 8px;
                text-align: center;
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
                    min-width: 1200px;
                }
                
                .table-custom th,
                .table-custom td {
                    width: auto !important;
                    padding: 8px 6px;
                    font-size: 11px;
                }

                .action-buttons .btn {
                    width: 30px;
                    height: 30px;
                    font-size: 11px;
                }

                .download-dropdown-content {
                    min-width: 140px;
                }

                .main-content {
                    transition: margin-left 0.3s ease;
                }
                
                .sidebar-open .main-content {
                    margin-left: 0;
                }
            }

            @media (max-width: 768px) {
                body.sidebar-open {
                    overflow: hidden;
                }
                
                .sidebar-open .sidebar {
                    transform: translateX(0);
                }
                
                .main-content {
                    transition: transform 0.3s ease;
                }
                
                .sidebar-open .main-content {
                    transform: translateX(250px);
                }
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Penduduk</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

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

                        <div class="pdf-loading" id="pdfLoading">
                            <div class="pdf-loading-content">
                                <div class="spinner-border text-primary mb-3" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p>Sedang membuat PDF, harap tunggu...</p>
                            </div>
                        </div>

                        <div class="control-bar">
                            <div class="left-controls">
                                <a href="{{ route('dataPenduduk.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data Penduduk
                                </a>

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
                                    <input type="text" class="form-control" id="custom-search" placeholder="Cari data penduduk..." value="{{ request('search') }}">
                                    <button class="clear-search" id="clear-search" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-custom" id="table-penduduk">
                                <thead class="thead-dark">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $i => $penduduk)
                                        <tr>
                                            <td>{{ $datas->firstItem() + $i }}</td>
                                            <td>{{ $penduduk->nik }}</td>
                                            <td>{{ $penduduk->nokk }}</td>
                                            <td>
                                                <span class="text-ellipsis" title="{{ $penduduk->nama }}">
                                                    {{ $penduduk->nama }}
                                                </span>
                                            </td>
                                            <td>{{ $penduduk->jenis_kelamin }}</td>
                                            <td>{{ $penduduk->tempat_lahir }}</td>
                                            <td>{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
                                            <td>
                                                <span class="text-ellipsis" title="{{ $penduduk->alamat }}">
                                                    {{ $penduduk->alamat }}
                                                </span>
                                            </td>
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
                                                <div class="action-buttons">
                                                    <a href="{{ route('dataPenduduk.edit', $penduduk->nik) }}" class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('dataPenduduk.destroy', $penduduk->nik) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin hapus data ini?')">
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

                        @if($datas->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Menampilkan {{ $datas->firstItem() ?? 0 }} hingga {{ $datas->lastItem() ?? 0 }} dari {{ $datas->total() }} entri
                            </div>
                            <div>{{ $datas->links('pagination::bootstrap-4') }}</div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function(){
                const searchInput = document.getElementById('custom-search');
                const clearSearch = document.getElementById('clear-search');
                const entriesSelect = document.getElementById('entries-select');

                if(entriesSelect){
                    entriesSelect.addEventListener('change', function(){
                        const perPage = this.value;
                        const url = new URL(window.location.href);
                        url.searchParams.set('per_page', perPage);
                        window.location.href = url.toString();
                    });
                }

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

                @if(request('search'))
                    if(clearSearch) clearSearch.style.display = 'block';
                @endif

                const mainContent = document.querySelector('.main-content');
                if (window.innerWidth <= 768) {
                    mainContent.addEventListener('click', function() {
                        const sidebar = document.querySelector('.sidebar');
                        const navbarCollapse = document.querySelector('.navbar-collapse');
                        if (sidebar && sidebar.classList.contains('show')) {
                            sidebar.classList.remove('show');
                            document.body.classList.remove('sidebar-open');
                        }
                        if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                            navbarCollapse.classList.remove('show');
                        }
                    });
                }
            });

            async function downloadPDF() {
                const btn = document.querySelector('.btn-download');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';
                btn.disabled = true;

                const loadingElement = document.getElementById('pdfLoading');
                loadingElement.style.display = 'flex';

                try {
                    const { jsPDF } = window.jspdf;
                    
                    const doc = new jsPDF({
                        orientation: 'landscape',
                        unit: 'mm',
                        format: 'a4'
                    });
                    
                    const title = "DATA PENDUDUK DESA";
                    const date = new Date().toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    doc.setFontSize(16);
                    doc.setTextColor(40, 40, 40);
                    doc.text(title, 210 / 2, 15, { align: 'center' });
                    
                    doc.setFontSize(10);
                    doc.setTextColor(100, 100, 100);
                    doc.text('Dicetak pada: ' + date, 210 / 2, 22, { align: 'center' });
                    
                    const headers = [
                        'No', 'NIK', 'No KK', 'Nama', 'Jenis Kelamin', 'Tempat Lahir', 
                        'Tanggal Lahir', 'Alamat', 'Dusun', 'RT', 'RW', 'Kel/Desa', 
                        'Kecamatan', 'Agama', 'Status Perkawinan', 'Pekerjaan', 
                        'Kewarganegaraan', 'Pendidikan', 'Disabilitas', 'Tahun'
                    ];
                    
                    const rows = [];
                    @foreach($datas as $index => $penduduk)
                        rows.push([
                            {{ $index + 1 }},
                            '{{ $penduduk->nik }}',
                            '{{ $penduduk->nokk }}',
                            '{{ $penduduk->nama }}',
                            '{{ $penduduk->jenis_kelamin }}',
                            '{{ $penduduk->tempat_lahir }}',
                            '{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format("d-m-Y") }}',
                            '{{ $penduduk->alamat }}',
                            '{{ $penduduk->dusun }}',
                            '{{ $penduduk->rt }}',
                            '{{ $penduduk->rw }}',
                            '{{ $penduduk->keldesa }}',
                            '{{ $penduduk->kecamatan }}',
                            '{{ $penduduk->agama }}',
                            '{{ $penduduk->status_perkawinan }}',
                            '{{ $penduduk->pekerjaan }}',
                            '{{ $penduduk->kewarganegaraan }}',
                            '{{ $penduduk->pendidikan }}',
                            '{{ $penduduk->disabilitas }}',
                            '{{ $penduduk->tahun }}'
                        ]);
                    @endforeach
                    
                    doc.autoTable({
                        head: [headers],
                        body: rows,
                        startY: 30,
                        theme: 'grid',
                        styles: {
                            fontSize: 6,
                            cellPadding: 1,
                            overflow: 'linebreak',
                            lineColor: [200, 200, 200],
                            lineWidth: 0.1
                        },
                        headStyles: {
                            fillColor: [41, 128, 185],
                            textColor: 255,
                            fontStyle: 'bold',
                            halign: 'center',
                            fontSize: 7
                        },
                        bodyStyles: {
                            halign: 'left',
                            valign: 'middle'
                        },
                        margin: { top: 30, right: 5, bottom: 20, left: 5 },
                        pageBreak: 'auto',
                        showHead: 'everyPage',
                        didDrawPage: function(data) {
                            const pageCount = doc.internal.getNumberOfPages();
                            doc.setFontSize(8);
                            doc.setTextColor(150, 150, 150);
                            doc.text('Halaman ' + data.pageNumber + ' dari ' + pageCount, 
                                    210 / 2,
                                    148,
                                    { align: 'center' });
                        }
                    });
                    
                    const fileName = 'data_penduduk_desa_' + new Date().toISOString().split('T')[0] + '.pdf';
                    doc.save(fileName);
                    
                } catch(e) {
                    console.error(e);
                    alert('Terjadi kesalahan saat membuat PDF.');
                } finally {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    loadingElement.style.display = 'none';
                }
            }

            function downloadExcel() {
                const btn = document.querySelector('.btn-download');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat Excel...';
                btn.disabled = true;

                try {
                    const table = document.getElementById('table-penduduk');
                    const data = [];

                    const headers = [];
                    table.querySelectorAll('thead th').forEach((th, index) => {
                        if (index < table.querySelectorAll('thead th').length - 1) {
                            headers.push(th.innerText.trim());
                        }
                    });
                    data.push(headers);
                    table.querySelectorAll('tbody tr').forEach(tr => {
                        const row = [];
                        tr.querySelectorAll('td').forEach((td, index) => {
                            if (index < tr.querySelectorAll('td').length - 1) {
                                row.push(td.innerText.trim());
                            }
                        });
                        data.push(row);
                    });

                    const ws = XLSX.utils.aoa_to_sheet(data);
                    
                    const colWidths = [
                        { wch: 8 },   
                        { wch: 20 },  
                        { wch: 20 },  
                        { wch: 25 },  
                        { wch: 15 },  
                        { wch: 15 },  
                        { wch: 15 },  
                        { wch: 30 },  
                        { wch: 12 },  
                        { wch: 8 },   
                        { wch: 8 },   
                        { wch: 15 },  
                        { wch: 15 },  
                        { wch: 12 },  
                        { wch: 18 },  
                        { wch: 15 },  
                        { wch: 18 },  
                        { wch: 15 },  
                        { wch: 12 },  
                        { wch: 10 }   
                    ];
                    ws['!cols'] = colWidths;

                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Data Penduduk Desa');

                    XLSX.writeFile(wb, `Data_Penduduk_Desa_${new Date().toISOString().split('T')[0]}.xlsx`);

                } catch(e) {
                    console.error(e);
                    alert('Terjadi kesalahan saat membuat Excel.');
                } finally {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                function handleMobileSidebar() {
                    if (window.innerWidth <= 768) {
                        document.querySelector('.main-content').addEventListener('click', function() {
                            const sidebar = document.querySelector('.sidebar');
                            const navbarCollapse = document.querySelector('.navbar-collapse');
                            
                            if (sidebar && sidebar.classList.contains('show')) {
                                sidebar.classList.remove('show');
                                document.body.classList.remove('sidebar-open');
                            }
                            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                                navbarCollapse.classList.remove('show');
                            }
                        });

                        window.addEventListener('scroll', function() {
                            const sidebar = document.querySelector('.sidebar');
                            const navbarCollapse = document.querySelector('.navbar-collapse');
                            
                            if (sidebar && sidebar.classList.contains('show')) {
                                sidebar.classList.remove('show');
                                document.body.classList.remove('sidebar-open');
                            }
                            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                                navbarCollapse.classList.remove('show');
                            }
                        });
                    }
                }

                handleMobileSidebar();
                window.addEventListener('resize', handleMobileSidebar);
            });
        </script>
    @endpush
@endsection
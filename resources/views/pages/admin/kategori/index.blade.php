@extends('layouts.app', ['title' => 'Kategori Berita'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            #table-kategori tbody tr:hover { background-color: #f2f7fb; }

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
                width: 80px;
                text-align: center;
            }

            .table-custom th:nth-child(2), /* Nama Kategori */
            .table-custom td:nth-child(2) {
                width: 200px;
                text-align: left;
                padding-left: 12px;
            }

            .table-custom th:nth-child(3), /* Deskripsi */
            .table-custom td:nth-child(3) {
                width: 400px;
                text-align: left;
                padding-left: 12px;
            }

            .table-custom th:nth-child(4), /* Aksi */
            .table-custom td:nth-child(4) {
                width: 120px;
                text-align: center;
            }

            /* Deskripsi styling */
            .deskripsi-singkat {
                max-width: 380px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
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
                    min-width: 600px;
                }
                
                .table-custom th,
                .table-custom td {
                    width: auto !important;
                    padding: 10px 6px;
                    font-size: 13px;
                }

                .deskripsi-singkat {
                    max-width: 200px;
                }
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kategori Berita</h1>
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
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Kategori
                                </a>

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
                                    <input type="text" class="form-control" id="custom-search" placeholder="Cari kategori..." value="{{ request('search') }}">
                                    <button class="clear-search" id="clear-search" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Kategori -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-custom" id="table-kategori">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoris as $i => $kategori)
                                        <tr>
                                            <td>{{ $kategoris->firstItem() + $i }}</td>
                                            <td>{{ $kategori->nama }}</td>
                                            <td class="deskripsi-singkat" title="{{ $kategori->deskripsi }}">
                                                {{ Str::limit($kategori->deskripsi, 80) }}
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
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
                                Menampilkan {{ $kategoris->firstItem() ?? 0 }} hingga {{ $kategoris->lastItem() ?? 0 }} dari {{ $kategoris->total() }} entri
                            </div>
                            <div>{{ $kategoris->links('pagination::bootstrap-4') }}</div>
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
        </script>
    @endpush
@endsection
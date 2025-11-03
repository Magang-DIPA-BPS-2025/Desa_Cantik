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
                            <button class="btn btn-success" id="export-excel-btn">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </button>
                        </div>

                        <!-- Baris 2: Entries dan Pencarian -->
                        <div class="filter-row">
                            <div class="entries-control">
                                <label for="entries-select" class="mb-0 text-nowrap">Tampilkan</label>
                                <select id="entries-select" class="form-control form-control-sm" style="width: 80px;">
                                    <option value="10" {{ request('perPage')==10 ? 'selected':'' }}>10</option>
                                    <option value="25" {{ request('perPage')==25 ? 'selected':'' }}>25</option>
                                    <option value="50" {{ request('perPage')==50 ? 'selected':'' }}>50</option>
                                    <option value="100" {{ request('perPage')==100 ? 'selected':'' }}>100</option>
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
                                @forelse ($apbds as $index => $apbd)
                                <tr>
                                    <td>{{ $index+1 }}</td>
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
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">Belum ada data APBD.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

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

<script>
$(document).ready(function(){

    // Inisialisasi DataTable
    var table = $('#table-apbd').DataTable({
        pageLength: parseInt($('#entries-select').val()) || 10,
        lengthChange: false,
        language: { 
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            search: "Cari:",
            searchPlaceholder: "Cari data..."
        },
        columnDefs: [{ orderable: false, targets: -1 }],
        dom: '<"top">rt<"bottom"lip><"clear">'
    });

    // Custom search
    $('#custom-search').on('keyup', function(){
        table.search(this.value).draw();
        $('#clear-search').toggle(this.value.length > 0);
    });
    
    $('#clear-search').on('click', function(){
        $('#custom-search').val('').trigger('keyup').focus();
    });

    // Entries per page
    $('#entries-select').on('change', function(){
        table.page.len($(this).val()).draw();
    });

    // Export Excel
    $('#export-excel-btn').on('click', function(){
        var wb = XLSX.utils.book_new();
        var ws_data = [];
        var headers = [];
        
        $('#table-apbd thead tr th').each(function(){
            if($(this).text() !== "Aksi"){ 
                headers.push($(this).text().trim()); 
            }
        });
        ws_data.push(headers);
        
        table.rows({ search: 'applied' }).every(function(){
            var row = [];
            var data = this.data();
            for(var i = 0; i < headers.length; i++){
                row.push($(data[i]).text().trim() || data[i]);
            }
            ws_data.push(row);
        });
        
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "APBD Desa");
        XLSX.writeFile(wb, "data_apbd_desa_" + new Date().toISOString().split('T')[0] + ".xlsx");
    });

});
</script>
@endpush
@endsection
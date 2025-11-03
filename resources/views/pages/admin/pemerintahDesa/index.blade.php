@extends('layouts.app', ['title' => 'Pemerintah Desa'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    #table-pemerintah-desa tbody tr:hover { background-color: #f2f7fb; }

    .action-buttons { display: flex; gap: 5px; justify-content: center; }
    .action-buttons .btn {
        width: 40px; height: 40px; font-size: 16px;
        display: flex; align-items: center; justify-content: center;
        padding: 0; border-radius: 6px; color: white;
        transition: transform 0.2s;
    }
    .action-buttons .btn-warning { background-color: #FFA500; border: none; }
    .action-buttons .btn-danger { background-color: #FF4D4F; border: none; }
    .action-buttons .btn:hover { transform: scale(1.1); }

    .pagination { justify-content: flex-end !important; }

    /* Control bar */
    .control-bar { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 15px; flex-wrap: wrap; gap: 15px; }
    .left-controls { display: flex; flex-direction: column; align-items: flex-start; gap: 10px; }
    .right-controls { display: flex; align-items: center; }
    .entries-control { display: flex; align-items: center; gap: 10px; }

    /* Search box */
    .search-container { position: relative; width: 300px; }
    .search-container .form-control { padding-right: 40px; }
    .clear-search {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #999; cursor: pointer; display: none;
    }
    .clear-search:hover { color: #333; }

    /* Foto */
    .img-thumbnail { border-radius: 8px; object-fit: cover; }

    /* Tombol PDF */
    .btn-download-pdf { 
        background: #dc2626; color: #fff; border: none; border-radius: 8px; padding: 8px 14px; 
        display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 500; cursor: pointer; 
        transition: .3s; font-family: 'Poppins', sans-serif; text-decoration: none;
    }
    .btn-download-pdf:hover { background: #b91c1c; color: #fff; text-decoration: none; }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header"><h1>Data Pemerintah Desa</h1></div>
        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Control Bar -->
                    <div class="control-bar">
                        <div class="left-controls">
                            <a href="{{ route('pemerintah-desa.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <button class="btn-download-pdf" onclick="downloadPDF()">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </button>
                            <div class="entries-control">
                                <label for="entries-select" class="mb-0">Tampilkan</label>
                                <select id="entries-select" class="form-control form-control-sm" style="width: auto;">
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <span>entri</span>
                            </div>
                        </div>
                        <div class="right-controls">
                            <div class="search-container">
                                <input type="text" class="form-control" id="custom-search" placeholder="Cari data...">
                                <button class="clear-search" id="clear-search" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-pemerintah-desa">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tupoksi</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $index => $desa)
                                    <tr>
                                        <td>{{ $datas->firstItem() + $index }}</td>
                                        <td>{{ $desa->nama }}</td>
                                        <td>{{ $desa->jabatan }}</td>
                                        <td>{{ Str::limit($desa->tupoksi, 50) }}</td>
                                        <td>
                                            @if($desa->foto)
                                                <img src="{{ asset('storage/' . $desa->foto) }}" width="60" height="60" class="img-thumbnail">
                                            @else
                                                <span class="text-muted">Belum ada foto</span>
                                            @endif
                                        </td>
                                        <td class="action-buttons">
                                            <a href="{{ route('pemerintah-desa.edit', $desa->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pemerintah-desa.destroy', $desa->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

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
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
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
        const btn = document.querySelector('.btn-download-pdf');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';
        btn.disabled = true;

        try {
            const element = document.createElement('div');
            element.style.padding = '20px';
            element.innerHTML = `<div style="text-align:center;margin-bottom:20px;">
                <h2 style="margin:0;color:#333;">Data Pemerintah Desa</h2>
                <p style="margin:5px 0 0 0;color:#666;">Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
            </div>`;

            const table = document.querySelector('#table-pemerintah-desa').cloneNode(true);
            table.querySelectorAll('tr').forEach(row => {
                const cells = row.querySelectorAll('td, th');
                if (cells.length > 0) row.removeChild(cells[cells.length - 1]);
            });

            const fotoCells = table.querySelectorAll('td:nth-child(5)');
            for (let i=0; i<fotoCells.length; i++) {
                const cell = fotoCells[i];
                const img = cell.querySelector('img');
                if (img) cell.innerHTML = `<img src="${await getBase64Image(img)}" style="width:40px;height:40px;border-radius:4px;border:1px solid #ddd;">`;
                else cell.innerHTML = '<span style="color:#999;font-size:10px;">Tidak Ada Foto</span>';
            }

            table.style.width='100%'; table.style.borderCollapse='collapse'; table.style.fontSize='10px'; table.style.fontFamily='Arial, sans-serif';
            table.querySelectorAll('th').forEach(th=>{
                th.style.backgroundColor='#4f46e5'; th.style.color='white'; th.style.border='1px solid #3730a3';
                th.style.padding='6px'; th.style.textAlign='center'; th.style.fontWeight='bold';
            });
            table.querySelectorAll('td').forEach(td=>{
                td.style.border='1px solid #e5e7eb'; td.style.padding='5px'; td.style.verticalAlign='middle';
            });
            table.querySelectorAll('td:nth-child(5)').forEach(td=>{ td.style.textAlign='center'; });
            table.querySelectorAll('td:nth-child(4)').forEach(td=>{ td.style.maxWidth='200px'; td.style.wordWrap='break-word'; });

            element.appendChild(table);

            await html2pdf().set({
                margin:[10,10,10,10],
                filename:'Data_Pemerintah_Desa.pdf',
                image:{type:'jpeg',quality:0.8},
                html2canvas:{scale:2,useCORS:true,logging:false,allowTaint:true},
                jsPDF:{unit:'mm',format:'a4',orientation:'landscape'}
            }).from(element).save();

        } catch(e) {
            console.error(e);
            alert('Terjadi kesalahan saat membuat PDF.');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }

    document.addEventListener('DOMContentLoaded', function(){
        const searchInput = document.getElementById('custom-search');
        const clearSearch = document.getElementById('clear-search');
        const entriesSelect = document.getElementById('entries-select');

        if(entriesSelect){
            entriesSelect.addEventListener('change', function(){
                const perPage = this.value;
                const url = new URL(window.location.href);
                url.searchParams.set('perPage', perPage);
                window.location.href = url.toString();
            });
        }

        if(searchInput && clearSearch){
            searchInput.addEventListener('input',()=>{ clearSearch.style.display = searchInput.value ? 'block':'none'; });
            clearSearch.addEventListener('click', ()=>{
                searchInput.value=''; clearSearch.style.display='none';
                const url=new URL(window.location.href);
                url.searchParams.delete('search');
                window.location.href=url.toString();
            });
            searchInput.addEventListener('keypress', function(e){
                if(e.key==='Enter'){
                    const searchTerm=this.value;
                    const url=new URL(window.location.href);
                    if(searchTerm) url.searchParams.set('search', searchTerm);
                    else url.searchParams.delete('search');
                    window.location.href=url.toString();
                }
            });
        }
    });
</script>
@endpush

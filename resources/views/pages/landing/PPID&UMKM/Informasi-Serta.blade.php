@extends('layouts.landing.app')

@push('styles')
<style>
/* Sama seperti berkalas.blade.php */
.ppid-card { border: 1px solid #ddd; border-radius: 6px; padding: 15px; margin-bottom: 15px; transition: box-shadow 0.2s; width: 100%; }
.ppid-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
.ppid-card h5 { font-weight: 600; margin-bottom: 10px; cursor: pointer; }
.sub-item { border-top: 1px solid #eee; padding-top: 10px; margin-top: 10px; }
.sub-item h6 { margin-bottom: 5px; }
.file-viewer { width: 100%; height: 70vh; border: none; border-radius: 6px; }
.btn-group-file { display: flex; gap: 5px; margin-top: 10px; }
.btn-group-file .btn-file { flex: 1; white-space: nowrap; text-align: center; font-size: 0.85rem; padding: 5px 0; }
</style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Informasi Publik Serta Merta</h2>

    @if($sertas->isEmpty())
        <p class="text-muted">Belum ada informasi serta merta.</p>
    @else
        @foreach($sertas as $ppid)
            <div class="ppid-card">
                <h5 data-toggle="collapse" data-target="#ppid-{{ $ppid->id }}">
                    {{ $ppid->judul }} 
                    <small class="text-muted">({{ $ppid->tanggal instanceof \Carbon\Carbon ? $ppid->tanggal->format('d-m-Y') : $ppid->tanggal }})</small>
                    <i class="fas fa-chevron-down float-right"></i>
                </h5>
                
                <div class="collapse mt-2" id="ppid-{{ $ppid->id }}">
                    <p>{{ $ppid->deskripsi }}</p>

                   @if($ppid->sub_items && $ppid->sub_items->isNotEmpty())
                        @foreach($ppid->sub_items as $sub)
                            <div class="sub-item">
                                <h6>{{ $sub->judul }}</h6>
                                <p>{{ $sub->deskripsi }}</p>
                                @if($sub->file)
                                    <div class="btn-group-file">
                                        <button type="button" class="btn btn-info btn-sm btn-view-file btn-file" data-file="{{ asset('storage/' . $sub->file) }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                        <a href="{{ asset('storage/' . $sub->file) }}" class="btn btn-success btn-sm btn-file" download>
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @elseif($ppid->file)
                        <div class="btn-group-file">
                            <button type="button" class="btn btn-info btn-sm btn-view-file btn-file" data-file="{{ asset('storage/' . $ppid->file) }}">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                            <a href="{{ asset('storage/' . $ppid->file) }}" class="btn btn-success btn-sm btn-file" download>
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        {{-- Tombol Kembali --}}
    <a href="{{ route('ppid') }}" class="btn btn-secondary mb-4">
        <i class="fas fa-arrow-left"></i> Kembali ke PPID
    </a>
    @endif
</div>

@include('pages.landing.PPID&UMKM.ppid-file-modal')
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $(document).on('click', '.btn-view-file', function(){
        let fileUrl = $(this).data('file');
        let fileViewer = $('#fileViewer');
        const ext = fileUrl.split('.').pop().toLowerCase();
        if(['jpg','jpeg','png','gif'].includes(ext)){
            fileViewer.attr('src', fileUrl);
        } else if(ext === 'pdf'){
            fileViewer.attr('src', fileUrl + '#toolbar=0');
        } else {
            fileViewer.attr('src', 'https://docs.google.com/gview?embedded=true&url=' + encodeURIComponent(fileUrl));
        }
        $('#fileModal').modal('show');
    });
    $('#fileModal').on('hidden.bs.modal', function(){ $('#fileViewer').attr('src',''); });
});
</script>
@endpush

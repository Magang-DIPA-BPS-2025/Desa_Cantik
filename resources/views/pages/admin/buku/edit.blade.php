@extends('layouts.app', ['title' => 'Edit Buku Tamu'])

@push('styles')
<!-- Signature Pad CSS -->
<style>
    .signature-pad { 
        border: 1px solid #e2e8f0; 
        border-radius: 4px; 
        width: 100%; 
        height: 200px; 
        background: #f8fafc; 
    }
    .ttd-preview {
        width: 120px;
        height: 60px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .ttd-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Buku Tamu</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.buku.update', $bukuTamu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $bukuTamu->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="asal">Asal Instansi</label>
                            <input type="text" name="asal" id="asal"
                                   class="form-control @error('asal') is-invalid @enderror"
                                   value="{{ old('asal', $bukuTamu->asal) }}" required>
                            @error('asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan"
                                   class="form-control @error('jabatan') is-invalid @enderror"
                                   value="{{ old('jabatan', $bukuTamu->jabatan) }}">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <textarea name="keperluan" id="keperluan" rows="3"
                                      class="form-control @error('keperluan') is-invalid @enderror"
                                      required>{{ old('keperluan', $bukuTamu->keperluan) }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanda Tangan --}}
                        <div class="form-group">
                            <label for="tanda_tangan">Tanda Tangan</label>
                            <div class="mb-2">
                                <div class="ttd-preview" id="ttdPreview" onclick="openSignaturePad()">
                                    @if($bukuTamu->tanda_tangan)
                                        <img src="{{ $bukuTamu->tanda_tangan }}" alt="TTD {{ $bukuTamu->nama }}">
                                    @else
                                        <span class="text-muted">Klik untuk menambahkan TTD</span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="tanda_tangan" id="tanda_tangan" value="{{ old('tanda_tangan', $bukuTamu->tanda_tangan) }}">
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Signature Pad -->
<div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <canvas id="signatureCanvas" class="signature-pad"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="clearSignature()">Hapus</button>
                <button type="button" class="btn btn-primary" onclick="saveSignature()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.0/dist/signature_pad.umd.min.js"></script>
<script>
let signaturePad;
const ttdInput = document.getElementById('tanda_tangan');
const ttdPreview = document.getElementById('ttdPreview');

function openSignaturePad() {
    $('#signatureModal').modal('show');
    const canvas = document.getElementById('signatureCanvas');
    if (!signaturePad) {
        signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255,255,255,0)',
        });
        if(ttdInput.value){
            signaturePad.fromDataURL(ttdInput.value);
        }
    }
    resizeCanvas();
}

function resizeCanvas() {
    const canvas = document.getElementById('signatureCanvas');
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    if(ttdInput.value){
        signaturePad.fromDataURL(ttdInput.value);
    }
}

function clearSignature() {
    signaturePad.clear();
}

function saveSignature() {
    if (signaturePad.isEmpty()) {
        alert("Tanda tangan masih kosong!");
        return;
    }
    const dataURL = signaturePad.toDataURL();
    ttdInput.value = dataURL;
    ttdPreview.innerHTML = `<img src="${dataURL}" alt="TTD Preview">`;
    $('#signatureModal').modal('hide');
}
</script>
@endpush

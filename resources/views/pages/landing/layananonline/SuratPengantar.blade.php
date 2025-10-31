@extends('layouts.landing.app')

@section('content')
<title>Formulir Layanan Administrasi</title>

<style>
    body { 
        background-color: #f8fafc; 
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
        color: #333;
    }
    
    /* Header Section - DIPERBAIKI seperti halaman status surat */
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

    /* Card Style - DIPERBAIKI seperti halaman status surat */
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
    
    input, select { 
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
    
    input:focus, select:focus {
        outline: none;
        border-color: #2E7D32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        background: #fff;
    }
    
    .btn-submit { 
        background: linear-gradient(135deg, #2E7D32, #4CAF50); 
        color: #fff; 
        border: none; 
        padding: 16px 30px; 
        border-radius: 8px; 
        font-size: 16px; 
        cursor: pointer; 
        width: 100%; 
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 10px;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }
    
    .btn-submit:hover { 
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
    }
    
    .hidden { 
        display: none; 
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
        
        .container-main {
            padding: 15px;
        }
    }

    @media (max-width: 576px) {
        .gallery-title { 
            font-size: 1.8rem; 
        }
        
        .gallery-header p {
            font-size: 1rem;
        }
        
        .card {
            padding: 15px;
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<!-- DIPERBAIKI: Menggunakan struktur seperti halaman status surat -->
<div class="container-main">
    <!-- Judul Halaman - Mengikuti gaya dari halaman status surat -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            FORMULIR LAYANAN ADMINISTRASI
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Pilih jenis surat untuk menampilkan form sesuai kebutuhan administrasi Desa Manggalung
        </p>
    </div>

    <!-- Card Formulir - Menggunakan card style seperti halaman status surat -->
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif

        {{-- Form utama --}}
        <form id="formLayanan" method="POST" action="#">
            @csrf
            <input type="hidden" name="tanggal_dibuat" value="{{ date('Y-m-d') }}">

            {{-- Jenis Surat --}}
            <div class="form-group">
                <label>Pilih Jenis Surat <span class="text-danger">*</span></label>
                <select id="jenisSurat" name="jenis_surat" required>
                    <option value="">-- Pilih Jenis Surat --</option>
                    <option value="SURAT KETERANGAN USAHA (SKU)">SURAT KETERANGAN USAHA (SKU)</option>
                    <option value="SURAT KETERANGAN TIDAK MAMPU (SKTM)">SURAT KETERANGAN TIDAK MAMPU (SKTM)</option>
                    <option value="SURAT KETERANGAN KEMATIAN">SURAT KETERANGAN KEMATIAN</option>
                    <option value="SURAT IZIN KEGIATAN">SURAT IZIN KEGIATAN</option>
                </select>
            </div>

            {{-- Form Umum --}}
            <div id="formUmum" class="hidden">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input type="text" name="nik" id="nik" placeholder="Masukkan 16 digit NIK" required>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" placeholder="Nama lengkap sesuai KTP" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Alamat Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat lengkap tempat tinggal" required>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Kota/kabupaten tempat lahir">
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan saat ini">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Contoh: 081234567890">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" placeholder="email@contoh.com">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form SKU --}}
            <div id="formSKU" class="hidden">
                <div class="form-group">
                    <label>Nama Usaha</label>
                    <input type="text" placeholder="Masukkan nama usaha/perusahaan" name="nama_usaha">
                </div>
                <div class="form-group">
                    <label>Alamat Usaha</label>
                    <input type="text" placeholder="Masukkan alamat lengkap usaha" name="alamat_usaha">
                </div>
            </div>

            {{-- Form SKTM --}}
            <div id="formSKTM" class="hidden">
                <div class="form-group">
                    <label>Agama</label>
                    <input type="text" placeholder="Masukkan agama" name="agama">
                </div>
            </div>

            {{-- Form SK Kematian --}}
            <div id="formKematian" class="hidden">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Nomor Kartu Keluarga</label>
                            <input type="text" placeholder="Masukkan Nomor KK" name="nomor_kk">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Tanggal Kematian</label>
                            <input type="date" name="tanggal_kematian">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Surat Izin Kegiatan --}}
            <div id="formIzin" class="hidden">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Hari Pelaksanaan</label>
                            <input type="text" name="hari" placeholder="Contoh: Senin, Selasa, dll">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" name="tanggal">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tempat Kegiatan</label>
                    <input type="text" name="tempat" placeholder="Lokasi lengkap kegiatan">
                </div>
                <div class="form-group">
                    <label>Jenis Acara/Kegiatan</label>
                    <input type="text" name="jenis_acara" placeholder="Jenis acara/kegiatan yang akan dilaksanakan">
                </div>
            </div>

            <button class="btn-submit" type="submit">
                <i class="bi bi-send-check me-2"></i> Kirim Permohonan Surat
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisSurat = document.getElementById('jenisSurat');
    const form = document.getElementById('formLayanan');

    const formUmum = document.getElementById('formUmum');
    const formKematian = document.getElementById('formKematian');
    const formSKU = document.getElementById('formSKU');
    const formIzin = document.getElementById('formIzin');
    const formSKTM = document.getElementById('formSKTM');

    // Saat jenis surat dipilih
    jenisSurat.addEventListener('change', function () {
        // Sembunyikan semua form dulu
        [formUmum, formKematian, formSKU, formIzin, formSKTM].forEach(f => f.classList.add('hidden'));

        // Tampilkan form umum dulu (selalu wajib)
        if (this.value) formUmum.classList.remove('hidden');

        // Tentukan action dan tampilkan form tambahan
        switch (this.value) {
            case 'SURAT KETERANGAN USAHA (SKU)':
                formSKU.classList.remove('hidden');
                form.action = "{{ route('sku.store') }}";
                break;
            case 'SURAT KETERANGAN TIDAK MAMPU (SKTM)':
                formSKTM.classList.remove('hidden');
                form.action = "{{ route('sktm.store') }}";
                break;
            case 'SURAT KETERANGAN KEMATIAN':
                formKematian.classList.remove('hidden');
                form.action = "{{ route('kematian.store') }}";
                break;
            case 'SURAT IZIN KEGIATAN':
                formIzin.classList.remove('hidden');
                form.action = "{{ route('izin.store') }}";
                break;
            default:
                form.action = "#";
        }
    });

    // Ambil data penduduk otomatis berdasarkan NIK
    document.getElementById('nik').addEventListener('blur', function() {
        const nik = this.value.trim();
        if (!nik) return;

        fetch(`/api/penduduk/${nik}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const p = data.data;
                    document.getElementById('nama').value = p.nama;
                    document.getElementById('alamat').value = p.alamat;
                    document.getElementById('tanggal_lahir').value = p.tanggal_lahir;
                    document.getElementById('tempat_lahir').value = p.tempat_lahir;
                    document.getElementById('jenis_kelamin').value = p.jenis_kelamin;
                    document.getElementById('pekerjaan').value = p.pekerjaan;
                } else {
                    alert('Data penduduk tidak ditemukan!');
                }
            })
            .catch(err => console.error('Error:', err));
    });
});
</script>
@endsection
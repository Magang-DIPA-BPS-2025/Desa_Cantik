@extends('layouts.landing.app')

@section('content')
<title>Formulir Layanan Administrasi</title>

<style>
    body { 
        background-color: #f8fafc; 
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
        color: #333;
    }
    
    /* Header Section */
    .form-header-section {
        padding: 40px 0 20px;
    }
    
    .form-header {
        text-align: left;
        max-width: 1200px;
        margin: 0 auto 30px;
        padding: 0 20px;
    }
    
    .form-title {
        font-weight: 700;
        color: #2E7D32;
        font-size: 2.8rem;
        line-height: 1.1;
        margin-bottom: 15px;
        text-align: left;
        font-family: 'Poppins', sans-serif;
    }
    
    .form-subtitle {
        color: #666;
        font-size: 1.2rem;
        margin-bottom: 0;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }

    /* Form Container */
    .form-box { 
        background: #fff; 
        max-width: 1200px; 
        margin: auto; 
        padding: 50px; 
        border-radius: 12px; 
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); 
        margin-bottom: 60px; 
        border: 1px solid #eaeaea;
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
    
    /* Card Styles untuk form sections */
    .form-section {
        background: #f8fafc;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 4px solid #2E7D32;
        text-align: left;
    }
    
    .form-section-title {
        color: #2E7D32;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
        text-align: left;
        font-family: 'Poppins', sans-serif;
    }
    
    .form-section-title i {
        font-size: 1.2rem;
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
        .form-box {
            padding: 30px 20px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .form-title {
            font-size: 2.2rem;
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="form-header-section">
    <div class="form-header">
        <h2 class="form-title">FORMULIR LAYANAN ADMINISTRASI</h2>
        <p class="form-subtitle">
            Pilih jenis surat untuk menampilkan form sesuai kebutuhan administrasi Desa Manggalung
        </p>
    </div>
</div>

<div class="form-box">
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
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-card-checklist"></i>
                Jenis Layanan Surat
            </div>
            <div class="form-group">
                <label>Pilih Jenis Surat</label>
                <select id="jenisSurat" name="jenis_surat" required>
                    <option value="">-- Pilih Jenis Surat --</option>
                    <option value="SURAT KETERANGAN USAHA (SKU)">SURAT KETERANGAN USAHA (SKU)</option>
                    <option value="SURAT KETERANGAN TIDAK MAMPU (SKTM)">SURAT KETERANGAN TIDAK MAMPU (SKTM)</option>
                    <option value="SURAT KETERANGAN KEMATIAN">SURAT KETERANGAN KEMATIAN</option>
                    <option value="SURAT IZIN KEGIATAN">SURAT IZIN KEGIATAN</option>
                </select>
            </div>
        </div>

        {{-- Form Umum --}}
        <div id="formUmum" class="hidden">
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-person-vcard"></i>
                    Data Pribadi Pemohon
                </div>
                
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
        </div>

        {{-- Form SKU --}}
        <div id="formSKU" class="hidden">
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-shop"></i>
                    Data Usaha
                </div>
                <div class="form-group">
                    <label>Nama Usaha</label>
                    <input type="text" placeholder="Masukkan nama usaha/perusahaan" name="nama_usaha">
                </div>
                <div class="form-group">
                    <label>Alamat Usaha</label>
                    <input type="text" placeholder="Masukkan alamat lengkap usaha" name="alamat_usaha">
                </div>
            </div>
        </div>

        {{-- Form SKTM --}}
        <div id="formSKTM" class="hidden">
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-heart-pulse"></i>
                    Data Tambahan SKTM
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input type="text" placeholder="Masukkan agama" name="agama">
                </div>
            </div>
        </div>

        {{-- Form SK Kematian --}}
        <div id="formKematian" class="hidden">
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-flower1"></i>
                    Data Kematian
                </div>
                <div class="form-group">
                    <label>Nomor Kartu Keluarga</label>
                    <input type="text" placeholder="Masukkan Nomor KK" name="nomor_kk">
                </div>
                <div class="form-group">
                    <label>Tanggal Kematian</label>
                    <input type="date" name="tanggal_kematian">
                </div>
            </div>
        </div>

        {{-- Form Surat Izin Kegiatan --}}
        <div id="formIzin" class="hidden">
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-calendar-event"></i>
                    Data Kegiatan
                </div>
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
        </div>

        <button class="btn-submit" type="submit">
            <i class="bi bi-send-check me-2"></i> Kirim Permohonan Surat
        </button>
    </form>
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
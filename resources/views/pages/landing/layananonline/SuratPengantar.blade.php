@extends('layouts.landing.app')

@section('content')
<title>Formulir Layanan Administrasi</title>

<style>
    body { background-color: #f0f4f8; font-family: 'Segoe UI', Arial, sans-serif; }
    .content-header { text-align: left; max-width: 1000px; margin: 40px auto 30px; }
    .content-header h1 { font-weight: 700; color: #2c3e50; font-size: 32px; }
    .form-box { background: #fff; max-width: 1000px; margin: auto; padding: 40px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); margin-bottom: 90px; }
    .form-group { margin-bottom: 18px; }
    label { font-weight: 600; margin-bottom: 8px; display: block; color: #2c3e50; }
    input, select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 10px; font-size: 15px; }
    .btn-submit { background: linear-gradient(90deg, #3B82F6, #31C48D); color: #fff; border: none; padding: 14px 30px; border-radius: 10px; font-size: 16px; cursor: pointer; width: 100%; font-weight: 600; }
    .btn-submit:hover { background: linear-gradient(90deg, #2c6ed5, #28a172); }
    .hidden { display: none; }
</style>

<div class="content-header">
    <h1>Formulir Layanan Administrasi</h1>
    <p>Pilih jenis surat untuk menampilkan form sesuai kebutuhan.</p>
</div>

<div class="form-box">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form utama --}}
    <form id="formLayanan" method="POST" action="#">
        @csrf
        <input type="hidden" name="tanggal_dibuat" value="{{ date('Y-m-d') }}">

        {{-- Jenis Surat --}}
        <div class="form-group">
            <label>Jenis Surat</label>
            <select id="jenisSurat" name="jenis_surat" required>
                <option value="">-- Pilih Jenis Surat --</option>
                <option value="SURAT KETERANGAN USAHA (SKU)">SKU</option>
                <option value="SURAT KETERANGAN TIDAK MAMPU (SKTM)">SKTM</option>
                <option value="SURAT KETERANGAN KEMATIAN">SK Kematian</option>
                <option value="SURAT IZIN KEGIATAN">Surat Izin Kegiatan</option>
            </select>
        </div>

        {{-- Form Umum --}}
        <div id="formUmum" class="hidden">
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" id="nik" placeholder="Masukkan NIK" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Penduduk" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Alamat Penduduk" required>
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan">
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan Nomor HP">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email">
            </div>
        </div>

        {{-- Form SKU --}}
        <div id="formSKU" class="hidden">
            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" placeholder="Masukkan Nama Usaha" name="nama_usaha">
            </div>
            <div class="form-group">
                <label>Alamat Usaha</label>
                <input type="text" placeholder="Masukkan Alamat Usaha" name="alamat_usaha">
            </div>
        </div>

        {{-- Form SKTM --}}
        <div id="formSKTM" class="hidden">
            <div class="form-group">
                <label>Agama</label>
                <input type="text" placeholder="Masukkan Agama" name="agama">
            </div>
        </div>

        {{-- Form SK Kematian --}}
        <div id="formKematian" class="hidden">
            <div class="form-group">
                <label>Nomor Kartu Keluarga</label>
                <input type="text" placeholder="Masukkan Nomor KK" name="no_kk">
            </div>
            <div class="form-group">
                <label>Tanggal Kematian</label>
                <input type="date" name="tanggal_kematian">
            </div>
        </div>

        {{-- Form Surat Izin Kegiatan --}}
        <div id="formIzin" class="hidden">
            <div class="form-group">
                <label>Hari</label>
                <input type="text" name="hari" placeholder="Contoh: Senin">
            </div>
            <div class="form-group">
                <label>Tanggal Kegiatan</label>
                <input type="date" name="tanggal">
            </div>
            <div class="form-group">
                <label>Tempat</label>
                <input type="text" name="tempat" placeholder="Lokasi kegiatan">
            </div>
            <div class="form-group">
                <label>Jenis Acara</label>
                <input type="text" name="jenis_acara" placeholder="Jenis acara">
            </div>
        </div>

        <button class="btn-submit" type="submit">Kirim Permohonan Surat</button>
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

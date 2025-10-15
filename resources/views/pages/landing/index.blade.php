@extends('layouts.landing.app')
@section('content')

@push('styles')
<style>
/* ---------------- Body ---------------- */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
    color: #333;
    margin: 0;
}

/* ---------------- Hero Section ---------------- */
.hero-section {
    background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(0,0,0,0.3)),
        url('{{ asset("landing/images/slider-main/makassar.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 150px 20px;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
}
.hero-section h1 { font-size: 48px; font-weight: 700; margin-bottom: 15px; }
.hero-section h2 { font-size: 24px; margin-bottom: 10px; }
.hero-section h3 {
    display: inline-block;
    background: linear-gradient(45deg, #7CB518, #4CAF50);
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 18px;
    color: #fff;
}

/* ---------------- Statistik Slider ---------------- */
.statistik {
    background: linear-gradient(135deg, #C0D09D, #A5C37A);
    padding: 70px 20px;
    text-align: center;
    border-radius: 40px;
    margin: 60px auto;
    width: 95%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
}
.statistik h2 { margin-bottom: 40px; font-size: 28px; font-weight: 700; color: #1b5e20; }
#slider {
    display: flex;
    gap: 20px;
    scroll-behavior: smooth;
    overflow-x: auto;
    padding-bottom: 10px;
}
#slider::-webkit-scrollbar { display: none; }
#slider > .item { flex: 0 0 calc(25% - 15px); box-sizing: border-box; }
.statistik .item {
    flex: 0 0 auto;
    width: 100%;
    padding: 20px;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform .25s ease, box-shadow .25s ease;
    text-align: center;
}
.statistik .item:hover { transform: translateY(-6px); box-shadow: 0 12px 26px rgba(0,0,0,0.12); }
.statistik img { width: 64px; margin-bottom: 12px; }
.statistik .angka { font-size: 26px; font-weight: 800; color: #2e7d32; margin: 6px 0; }
.statistik .label { font-size: 14px; color: #555; }

/* Tombol Navigasi Carousel */
.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.8);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    cursor: pointer;
    font-size: 22px;
    color: #1b5e20;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    transition: all 0.3s;
    z-index: 10;
}
.slider-btn:hover { background: #1b5e20; color: #fff; }
.slider-btn.left { left: -20px; }
.slider-btn.right { right: -20px; }
@media (max-width: 1024px) { #slider > .item { flex: 0 0 33.33%; max-width: 33.33%; } }
@media (max-width: 768px) { #slider > .item { flex: 0 0 50%; max-width: 50%; } .slider-btn.left { left:0; } .slider-btn.right{ right:0; } }
@media (max-width: 480px) { #slider > .item { flex: 0 0 100%; max-width: 100%; } }

/* ---------------- Profil Desa ---------------- */
.profil { padding: 70px 20px; display: flex; flex-wrap: wrap; align-items: center; gap: 40px; max-width: 1100px; margin: auto; }
.profil-text { flex: 1; }
.profil-text h2 { font-size: 32px; margin-bottom: 20px; color: #2e7d32; }
.profil-text p { line-height: 1.8; }
.profil-img { flex: 1; text-align: center; }
.profil-img img { width: 100%; max-width: 450px; border-radius: 20px; cursor: pointer; }

/* ---------------- Chart ---------------- */
.chart-section { padding: 60px 20px; background: #fff; text-align: center; }
.chart-section h2 { margin-bottom: 30px; color: #2e7d32; }
.chart-wrapper { max-width: 450px; margin: auto; }

/* ---------------- APB Desa ---------------- */
.apb-desa { padding: 80px 20px; background: #fff; }
.apb-container { display: flex; align-items: center; justify-content: center; gap: 40px; flex-wrap: wrap; max-width: 1200px; margin: auto; }
.apbdesa-img img { max-width: 400px; cursor: pointer; }
.apb-info { flex: 1; min-width: 300px; }
.apb-info h2 { color: #2e7d32; font-size: 32px; font-weight: 700; margin-bottom: 15px; }
.apb-info p { font-size: 16px; margin-bottom: 25px; }
.apb-card { background: #f9f9f9; border-radius: 12px; padding: 18px 25px; margin-bottom: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
.apb-card span { font-size: 14px; color: #fff; }
.apb-card h3 { font-size: 22px; font-weight: 700; margin-top: 8px; color: #fff; }
.apb-card.pendapatan { background: linear-gradient(135deg, #4CAF50, #81C784); color: white; }
.apb-card.belanja { background: linear-gradient(135deg, #E53935, #EF5350); color: white; }
.apb-btn { display:inline-block; text-decoration:none; background:#4CAF50; color:#fff; padding:12px 22px; border-radius:8px; font-weight:600; transition: 0.3s; }
.apb-btn:hover { background:#388e3c; }

/* ---------------- Section Title ---------------- */
.section-title { 
    text-align:center; 
    color:#2e7d32; 
    margin-bottom:40px; 
    font-size:32px; 
    font-weight:700; 
}

/* ---------------- CONTAINER GRID UNIFORM ---------------- */
.uniform-grid-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.uniform-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    width: 100%;
}

@media (max-width: 1024px) { 
    .uniform-grid { 
        grid-template-columns: repeat(2, 1fr); 
    } 
}

@media (max-width: 768px) { 
    .uniform-grid { 
        grid-template-columns: 1fr; 
        gap: 20px;
    } 
}

/* ---------------- CARD UNIFORM ---------------- */
.uniform-card { 
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}

.uniform-card:hover { 
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

.uniform-card-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
}

.uniform-card-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.uniform-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 10px 0;
    line-height: 1.4;
}

.uniform-card-date {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 15px;
}

.uniform-card-text {
    font-size: 0.9rem;
    color: #555;
    line-height: 1.5;
    margin-bottom: 15px;
    flex-grow: 1;
}

.uniform-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
    width: 100%;
}

/* ---------------- Section Styles ---------------- */
.berita-section {
    background: #f9fafb;
    padding: 80px 0;
}

.agenda-section {
    background: #f9fafb;
    padding: 80px 0;
}

.umkm-section {
    background: #f9fafb;
    padding: 80px 0;
}

.galeri-section {
    background: #f9fafb;
    padding: 80px 0;
}

/* ---------------- Tombol Lihat Semua ---------------- */
.btn-view-all-container { 
    text-align: center; 
    margin-top: 50px;
}

.btn-view-all { 
    background: #4CAF50;
    color: #fff;
    padding: 14px 32px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-view-all:hover { 
    background: #388e3c;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* ---------------- Overlay untuk Galeri ---------------- */
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.uniform-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    font-size: 2rem;
    color: white;
    margin-bottom: 10px;
}

.gallery-overlay small {
    color: white;
    font-weight: 600;
    text-transform: uppercase;
}

/* ---------------- Modal Galeri Custom ---------------- */
.galeri-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    overflow: auto;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.galeri-modal-content {
    position: relative;
    margin: 5% auto;
    width: 90%;
    max-width: 800px;
    animation: zoomIn 0.3s ease;
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.galeri-modal-image {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

/* Tombol Close Modal */
.galeri-close {
    position: absolute;
    top: -40px;
    right: -40px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    background: rgba(0, 0, 0, 0.5);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 2px solid #fff;
}

.galeri-close:hover {
    background: #ff4444;
    transform: rotate(90deg);
}

/* Responsive untuk modal */
@media (max-width: 768px) {
    .galeri-modal-content {
        width: 95%;
        margin: 10% auto;
    }
    
    .galeri-close {
        top: -30px;
        right: -10px;
        width: 40px;
        height: 40px;
        font-size: 30px;
    }
}

/* ---------------- UMKM Button ---------------- */
.umkm-btn {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: auto;
}

.umkm-btn:hover {
    background: #388e3c;
}
</style>
@endpush

{{-- ---------------- Hero ---------------- --}}
<div class="hero-section">
    <h2>Selamat Datang di Website Resmi</h2>
    <h1>Desa Cantik Desa Manggalung</h1>
    <h3>Badan Pusat Statistik Sulsel</h3>
</div>

{{-- ---------------- Statistik ---------------- --}}
<div class="statistik">
    <h2>Statistik Penduduk Kelurahan Maccini Sombala Tahun 2025</h2>
    <button class="slider-btn left" id="slideLeft"><i class="fa fa-chevron-left"></i></button>
    <button class="slider-btn right" id="slideRight"><i class="fa fa-chevron-right"></i></button>
    <div class="slider-wrapper overflow-hidden">
        <div id="slider">
            {{-- Statistik Items --}}
            <div class="item"><img src="{{ asset('landing/images/icon-image/dusun.png') }}" alt="Dusun"><p class="angka">7</p><p class="label">Dusun</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/rt.png') }}" alt="RT"><p class="angka">23</p><p class="label">RT</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/rw.png') }}" alt="RW"><p class="angka">12</p><p class="label">RW</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/kepalaKeluarga.png') }}" alt="Kepala Keluarga"><p class="angka">2.463</p><p class="label">Kepala Keluarga</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/male.png') }}" alt="Laki-laki"><p class="angka">4.952</p><p class="label">Laki-laki</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/women.png') }}" alt="Perempuan"><p class="angka">4.716</p><p class="label">Perempuan</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/disabi.png') }}" alt="Disabilitas"><p class="angka">4</p><p class="label">Disabilitas</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/family.png') }}" alt="Jumlah Penduduk"><p class="angka">9.668</p><p class="label">Jumlah Penduduk</p></div>
        </div>
    </div>
</div>

{{-- ---------------- Profil Desa ---------------- --}}
<div class="profil">
    <div class="profil-text">
        <h2>Tentang Kelurahan</h2>
        <p>Kelurahan Maccini Sombala merupakan salah satu kelurahan di Kota Makassar yang memiliki potensi besar dalam pembangunan masyarakat. Dengan jumlah penduduk lebih dari <b>9.600 jiwa</b>, wilayah ini terus berkembang dengan berbagai program sosial, pendidikan, serta peningkatan infrastruktur.</p>
    </div>
    <div class="profil-img">
        <img src="{{ asset('landing/images/slider-main/kelurahan.jpg') }}" alt="Kelurahan" onclick="openModal('{{ asset('landing/images/slider-main/kelurahan.jpg') }}')">
    </div>
</div>

{{-- ---------------- Chart Penduduk ---------------- --}}
<div class="chart-section">
    <h2>Visualisasi Statistik Penduduk</h2>
    <div class="chart-wrapper">
        <canvas id="chartPenduduk"></canvas>
    </div>
</div>

{{-- ---------------- APB Desa ---------------- --}}
<div class="apb-desa">
    <div class="apb-container">
        <div class="apbdesa-img">
            <img src="{{ asset('landing/images/slider-main/apbd.png') }}" alt="APBD Desa" onclick="openModal('{{ asset('landing/images/slider-main/apbd.png') }}')">
        </div>
        <div class="apb-info">
            <h2>APB DESA 2024</h2>
            <p>Akses cepat dan transparan terhadap APB Desa serta proyek pembangunan</p>
            <div class="apb-card pendapatan"><span>Pendapatan Desa</span><h3>Rp4.802.205.800,00</h3></div>
            <div class="apb-card belanja"><span>Belanja Desa</span><h3>Rp4.888.222.678,00</h3></div>
            <a href="{{ url('/apbd') }}" class="apb-btn"><i class="fa fa-file-alt"></i> LIHAT DATA LEBIH LENGKAP</a>
        </div>
    </div>
</div>

{{-- ---------------- Berita Terbaru ---------------- --}}
<div class="berita-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Berita Terbaru</h2>
        <div class="uniform-grid">
            @foreach($beritas->take(6) as $berita)
            <a href="{{ route('berita.show', $berita->id) }}" class="uniform-card-link">
                <div class="uniform-card">
                    <img src="{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}" 
                         alt="{{ $berita->judul }}" 
                         class="uniform-card-img">
                    <div class="uniform-card-content">
                        <h4 class="uniform-card-title">{{ Str::limit($berita->judul,50) }}</h4>
                        <small class="uniform-card-date">
                            {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d M Y') : $berita->created_at->translatedFormat('d M Y') }}
                        </small>
                        <p class="uniform-card-text">{{ Str::limit(strip_tags($berita->isi), 80) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('berita') }}" class="btn-view-all">Lihat Semua Berita</a>
        </div>
    </div>
</div>

{{-- ---------------- Agenda Desa Terbaru ---------------- --}}
<div class="agenda-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Agenda Desa Terbaru</h2>
        <div class="uniform-grid">
            @foreach($latest_agendas->take(6) as $agenda)
            <a href="{{ route('agenda.show', $agenda->id) }}" class="uniform-card-link">
                <div class="uniform-card">
                    <img src="{{ $agenda->foto ? asset('storage/'.$agenda->foto) : asset('img/example-image.jpg') }}" 
                         alt="{{ $agenda->nama_kegiatan }}" 
                         class="uniform-card-img">
                    <div class="uniform-card-content">
                        <h4 class="uniform-card-title">{{ Str::limit($agenda->nama_kegiatan,50) }}</h4>
                        <small class="uniform-card-date">
                            {{ $agenda->waktu_pelaksanaan ? \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->translatedFormat('d M Y') : '' }} 
                            @if($agenda->kategori) | {{ $agenda->kategori }} @endif
                        </small>
                        <p class="uniform-card-text">{{ Str::limit(strip_tags($agenda->deskripsi), 80) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('agenda') }}" class="btn-view-all">Lihat Semua Agenda</a>
        </div>
    </div>
</div>

{{-- ---------------- UMKM Desa ---------------- --}}
<div class="umkm-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">UMKM Desa</h2>
        <div class="uniform-grid">
            @foreach($belanjas->take(6) as $umkm)
            <a href="{{ route('belanja.usershow', $umkm->id) }}" class="uniform-card-link">
                <div class="uniform-card">
                    @if($umkm->foto)
                    <img src="{{ asset('storage/' . $umkm->foto) }}"
                         alt="{{ $umkm->judul }}"
                         class="uniform-card-img">
                    @else
                    <img src="{{ asset('img/default-product.png') }}"
                         alt="Default"
                         class="uniform-card-img">
                    @endif
                    <div class="uniform-card-content">
                        <h4 class="uniform-card-title">{{ $umkm->judul }}</h4>
                        <p class="uniform-card-text">Harga: Rp {{ number_format($umkm->harga,0,',','.') }}</p>
                        <p class="uniform-card-text">Rating: {{ $umkm->rating }} ⭐</p>
                        <button class="umkm-btn">Lihat Detail</button>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('belanja') }}" class="btn-view-all">Lihat Semua UMKM</a>
        </div>
    </div>
</div>

{{-- ---------------- Galeri Desa ---------------- --}}
<div class="galeri-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Galeri Desa</h2>
        <div class="uniform-grid">
            @foreach($galeris->take(6) as $galeri)
            <div class="uniform-card position-relative">
                <div class="gallery-item" onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}')" style="cursor: pointer;">
                    <img src="{{ $galeri->gambar ? asset('storage/'.$galeri->gambar) : asset('img/default-image.png') }}" 
                         alt="Galeri Desa"
                         class="uniform-card-img">
                    <div class="gallery-overlay">
                        <i class="fa fa-search-plus"></i>
                        <small>Klik untuk memperbesar</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('galeri.user.index') }}" class="btn-view-all">Lihat Semua Galeri</a>
        </div>
    </div>
</div>

{{-- ---------------- Modal Popup Gambar ---------------- --}}
<div id="galeriModal" class="galeri-modal">
    <div class="galeri-modal-content">
        <span class="galeri-close" onclick="closeModal()">&times;</span>
        <img class="galeri-modal-image" id="modalImage">
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ---------------- Chart Penduduk ----------------
const ctx = document.getElementById('chartPenduduk');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Kepala Keluarga','Laki-laki', 'Perempuan', 'Disabilitas','Jumlah Penduduk'],
        datasets: [{
            data: [2463,4952,4716,4,9668],
            backgroundColor: ['#22c55e', '#60a5fa', '#f97316', '#a78bfa', '#ef4444'],
            borderColor: '#ffffff',
            borderWidth: 2,
            hoverOffset: 8,
            borderRadius: 6
        }]
    },
    options: {
        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } },
        cutout: '65%'
    }
});

// ---------------- Slider Otomatis ----------------
const slider = document.getElementById('slider');
const leftBtn = document.getElementById('slideLeft');
const rightBtn = document.getElementById('slideRight');
const itemWidth = slider.children[0].offsetWidth + 20;
let autoSlideInterval;

leftBtn.addEventListener('click', ()=>{
    if(slider.scrollLeft<=0) slider.scrollTo({left:slider.scrollWidth, behavior:'smooth'});
    else slider.scrollBy({left:-itemWidth, behavior:'smooth'});
    resetAutoSlide();
});
rightBtn.addEventListener('click', ()=>{
    if(slider.scrollLeft + slider.clientWidth >= slider.scrollWidth-10) slider.scrollTo({left:0, behavior:'smooth'});
    else slider.scrollBy({left:itemWidth, behavior:'smooth'});
    resetAutoSlide();
});

function autoSlide(){
    autoSlideInterval = setInterval(()=>{
        if(slider.scrollLeft + slider.clientWidth >= slider.scrollWidth-10) slider.scrollTo({left:0, behavior:'smooth'});
        else slider.scrollBy({left:itemWidth, behavior:'smooth'});
    },3000);
}
function resetAutoSlide(){ clearInterval(autoSlideInterval); autoSlide(); }
autoSlide();
slider.addEventListener('mouseenter',()=>clearInterval(autoSlideInterval));
slider.addEventListener('mouseleave', autoSlide);

// ---------------- Modal Galeri Functions ----------------
function openModal(imageSrc) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    
    modal.style.display = 'block';
    modalImage.src = imageSrc;
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('galeriModal');
    modal.style.display = 'none';
    
    // Restore body scroll
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the image
window.addEventListener('click', function(event) {
    const modal = document.getElementById('galeriModal');
    if (event.target === modal) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
</script>
@endpush
@endsection
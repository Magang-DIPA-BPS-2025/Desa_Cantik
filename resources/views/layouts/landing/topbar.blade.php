<!-- resources/views/layouts/landing/topbar.blade.php -->
<!-- Header -->
<header id="main-header">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="logo-area">
            <img src="{{ asset('landing/images/footer/desaCanti.png') }}" alt="Logo Desa Cantik" />
            <span class="brand-text">DESA CANTIK</span>
        </div>

        <!-- Desktop Navigation -->
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                    <i class="fas fa-home nav-icon"></i>BERANDA
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('galeri*', 'sejarah', 'pemerintah', 'apbd') ? 'active' : '' }}">
                    <i class="fas fa-landmark nav-icon"></i>PROFIL DESA
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('galeri.user.index') }}"><i class="fas fa-images dropdown-icon"></i>Galeri Desa</a>
                    <a href="{{ route('SejarahDesa') }}"><i class="fas fa-history dropdown-icon"></i>Sejarah Desa</a>
                    <a href="{{ route('pemerintah') }}"><i class="fas fa-users dropdown-icon"></i>Pemerintah Desa</a>
                    <a href="{{ route('apbd') }}"><i class="fas fa-chart-pie dropdown-icon"></i>APBD Desa</a>
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('berita*', 'agenda*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper nav-icon"></i>BERITA & AGENDA
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('berita') }}"><i class="fas fa-file-alt dropdown-icon"></i>Berita Desa</a>
                    <a href="{{ route('agenda') }}"><i class="fas fa-calendar-alt dropdown-icon"></i>Agenda Desa</a>
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('statistik*', 'pendidikan', 'pekerjaan', 'agama') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar nav-icon"></i>DATA STATISTIK
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('statistik.penduduk') }}"><i class="fas fa-users dropdown-icon"></i>Jumlah Penduduk</a>
                    <a href="{{ route('pendidikan') }}"><i class="fas fa-graduation-cap dropdown-icon"></i>Data Pendidikan</a>
                    <a href="{{ route('pekerjaan') }}"><i class="fas fa-briefcase dropdown-icon"></i>Data Pekerjaan</a>
                    <a href="{{ route('agama') }}"><i class="fas fa-pray dropdown-icon"></i>Data Agama</a>
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('pengantar*', 'status*', 'pengaduan*') ? 'active' : '' }}">
                    <i class="fas fa-laptop-code nav-icon"></i>LAYANAN ONLINE
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('pengantar') }}"><i class="fas fa-envelope dropdown-icon"></i>Surat Pengantar</a>
                    <a href="{{ route('status') }}"><i class="fas fa-tasks dropdown-icon"></i>Status Pengantar</a>
                    <a href="{{ route('pengaduan') }}"><i class="fas fa-exclamation-circle dropdown-icon"></i>Pengaduan</a>
                    <a href="{{ route('pengaduan.userStatus') }}"><i class="fas fa-question-circle dropdown-icon"></i>Status Pengaduan</a>
                    <a href="{{ route('bukutamu') }}"><i class="fas fa-book-open sidebar-icon"></i>Buku Tamu</a>              
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('ppid*', 'belanja*', 'permohonan*') ? 'active' : '' }}">
                    <i class="fas fa-store nav-icon"></i>PPID & UMKM
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('ppid') }}"><i class="fas fa-info-circle dropdown-icon"></i>PPID</a>
                    <a href="{{ route('belanja') }}"><i class="fas fa-shopping-bag dropdown-icon"></i>UMKM</a>
                    <a href="{{ route('permohonan.userStatus') }}"><i class="fas fa-file-contract dropdown-icon"></i>Status Permohonan</a>
                    
                </div>
            </li>

        </ul>

        <!-- Mobile Toggle Button -->
        <button class="nav-toggle" id="nav-toggle" aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Mobile Sidebar -->
<div class="mobile-sidebar" id="mobile-sidebar" aria-hidden="true">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('landing/images/footer/desaCanti.png') }}" alt="Logo Desa Cantik" />
            <span class="sidebar-brand">DESA CANTIK</span>
        </div>
        <button class="close-sidebar" id="close-sidebar" aria-label="Tutup menu">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Container untuk menu -->
    <div class="sidebar-menu-container">
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="/" class="sidebar-link {{ request()->is('/') ? 'active' : '' }}">
                    <i class="fas fa-home sidebar-icon"></i>
                    <span>BERANDA</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                    <i class="fas fa-landmark sidebar-icon"></i>
                    <span>PROFIL DESA</span>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="{{ route('galeri.user.index') }}"><i class="fas fa-images dropdown-icon"></i>Galeri Desa</a>
                    <a href="{{ route('SejarahDesa') }}"><i class="fas fa-history dropdown-icon"></i>Sejarah Desa</a>
                    <a href="{{ route('pemerintah') }}"><i class="fas fa-users dropdown-icon"></i>Pemerintah Desa</a>
                    <a href="{{ route('apbd') }}"><i class="fas fa-chart-pie dropdown-icon"></i>APBD Desa</a>
                </div>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                    <i class="fas fa-newspaper sidebar-icon"></i>
                    <span>BERITA & AGENDA</span>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="{{ route('berita') }}"><i class="fas fa-file-alt dropdown-icon"></i>Berita Desa</a>
                    <a href="{{ route('agenda') }}"><i class="fas fa-calendar-alt dropdown-icon"></i>Agenda Desa</a>
                </div>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar sidebar-icon"></i>
                    <span>DATA STATISTIK</span>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="{{ route('statistik.penduduk') }}"><i class="fas fa-users dropdown-icon"></i>Jumlah Penduduk</a>
                    <a href="{{ route('pendidikan') }}"><i class="fas fa-graduation-cap dropdown-icon"></i>Data Pendidikan</a>
                    <a href="{{ route('pekerjaan') }}"><i class="fas fa-briefcase dropdown-icon"></i>Data Pekerjaan</a>
                    <a href="{{ route('agama') }}"><i class="fas fa-pray dropdown-icon"></i>Data Agama</a>
                </div>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                    <i class="fas fa-laptop-code sidebar-icon"></i>
                    <span>LAYANAN ONLINE</span>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="{{ route('pengantar') }}"><i class="fas fa-envelope dropdown-icon"></i>Surat Pengantar</a>
                    <a href="{{ route('status') }}"><i class="fas fa-tasks dropdown-icon"></i>Status Pengantar</a>
                    <a href="{{ route('pengaduan') }}"><i class="fas fa-exclamation-circle dropdown-icon"></i>Pengaduan</a>
                    <a href="{{ route('pengaduan.userStatus') }}"><i class="fas fa-question-circle dropdown-icon"></i>Status Pengaduan</a>
                    <a href="{{ route('bukutamu') }}"><i class="fas fa-book-open sidebar-icon"></i>Buku Tamu</a>
                </div>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link sidebar-dropdown-toggle">
                    <i class="fas fa-store sidebar-icon"></i>
                    <span>PPID & UMKM</span>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="{{ route('ppid') }}"><i class="fas fa-info-circle dropdown-icon"></i>PPID</a>
                    <a href="{{ route('belanja') }}"><i class="fas fa-shopping-bag dropdown-icon"></i>UMKM</a>
                    <a href="{{ route('permohonan.userStatus') }}"><i class="fas fa-file-contract dropdown-icon"></i>Status Permohonan</a>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>

<style>
/* Import Google Fonts Modern */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600&display=swap');

/* Terapkan font modern ke seluruh navbar */
* {
    font-family: 'Poppins', 'Open Sans', sans-serif;
    box-sizing: border-box;
}

body {
    padding-top: 80px !important;
}

/* Header */
#main-header {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 4px 25px rgba(0,0,0,0.08);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.navbar-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 80px;
    transition: height 0.3s ease;
}

/* Logo */
.logo-area {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo-area img {
    height: 45px;
    width: 45px;
    object-fit: contain;
}

.brand-text {
    font-size: 22px;
    font-weight: 700;
    color: #2E7D32;
    line-height: 1;
    letter-spacing: -0.5px;
}

/* Navigation Menu */
.nav-menu {
    display: flex;
    gap: 6px;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
    height: 100%;
}

.nav-item { 
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    overflow: visible !important; /* penting supaya dropdown tidak terpotong */
}

.nav-link {
    text-decoration: none;
    color: #2D3748;
    font-weight: 500;
    font-size: 14px;
    padding: 12px 16px;
    border-radius: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    height: 44px;
    line-height: 1;
    letter-spacing: -0.2px;
}

.nav-link:hover {
    background: rgba(76,175,80,0.08);
    color: #2E7D32;
    transform: translateY(-1px);
}

.nav-link.active {
    background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
}

/* Ikon Navbar */
.nav-icon {
    font-size: 14px; 
    width: 16px; 
    text-align: center; 
    color: #2E7D32 !important;
    transition: all 0.3s ease;
}

.nav-link.active .nav-icon {
    color: white !important;
}

/* Dropdown (DESKTOP) - perbaikan agar tidak cepat tertutup */
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    padding: 8px 0;
    min-width: 220px;
    border: 1px solid rgba(0,0,0,0.05);
    z-index: 1000;

    /* Appearance control for smooth show/hide */
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
    pointer-events: none; /* jangan ganggu hover sebelum tampil */
}

/* Show dropdown on hover, plus keep visible when hovering dropdown itself */
.nav-item:hover > .dropdown-menu,
.dropdown-menu:hover {
    display: block;
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

/* Small delay before hiding to avoid flicker when moving mouse */
.nav-item:not(:hover) > .dropdown-menu {
    transition-delay: 0.15s;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    color: #4A5568;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    font-weight: 400;
}

.dropdown-menu a:hover {
    background: rgba(76,175,80,0.08);
    color: #2E7D32;
    padding-left: 24px;
}

/* Dropdown icon */
.dropdown-icon {
    width: 16px; 
    text-align: center; 
    font-size: 13px;
    color: #2E7D32 !important;
    transition: all 0.3s ease;
}

/* Mobile Toggle */
.nav-toggle {
    display: none;
    background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
    border: none;
    border-radius: 10px;
    width: 46px;
    height: 46px;
    color: white;
    cursor: pointer;
    font-size: 18px;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
}

.nav-toggle:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(46, 125, 50, 0.4);
}

/* Mobile Sidebar */
.mobile-sidebar {
    position: fixed;
    top: 0;
    left: -100%;
    width: 85%;
    max-width: 320px;
    height: 100vh;
    background: white;
    box-shadow: 4px 0 30px rgba(0,0,0,0.15);
    z-index: 9999;
    transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}

.mobile-sidebar.active { left: 0; }

.sidebar-header {
    padding: 25px 20px;
    border-bottom: 1px solid rgba(0,0,0,0.08);
    background: white !important;
    position: relative;
}

.sidebar-logo { display: flex; align-items: center; gap: 12px; }
.sidebar-logo img { height: 40px; width: 40px; object-fit: contain; filter: none !important; }
.sidebar-brand { font-size: 18px; font-weight: 700; color: #2E7D32 !important; }

.close-sidebar {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(46, 125, 50, 0.1);
    border: none;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    color: #2E7D32 !important;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}
.close-sidebar:hover { transform: rotate(90deg); background: rgba(46,125,50,0.2); color:#1b5e20 !important; }

/* Sidebar menu */
.sidebar-menu-container { flex: 1; display: flex; flex-direction: column; padding: 20px 0; }
.sidebar-menu { padding: 0; list-style: none; width: 100%; }
.sidebar-item { position: relative; margin-bottom: 4px; }
.sidebar-link {
    display: flex; align-items: center; padding: 16px 25px; color: #2D3748;
    text-decoration: none; font-weight: 500; font-size: 15px; transition: all .3s;
    border-left: 4px solid transparent;
}
.sidebar-icon { margin-right: 15px; width: 20px; text-align: center; font-size: 16px; color: #2E7D32 !important; }
.chevron-icon { margin-left: auto; font-size: 12px; transition: transform .3s; color:#666; }

.sidebar-link:hover, .sidebar-link.active {
    background: rgba(76,175,80,0.08);
    color: #2E7D32;
    border-left-color: #2E7D32;
    padding-left: 28px;
}

.sidebar-dropdown { background: rgba(248,249,250,0.8); display: none; border-left: 4px solid #4CAF50; }
.sidebar-dropdown.active { display: block; animation: slideDown .3s cubic-bezier(.4,0,.2,1) forwards; }
@keyframes slideDown { from { opacity:0; max-height:0 } to { opacity:1; max-height:500px } }

.sidebar-dropdown a {
    display:flex; align-items:center; padding:14px 25px 14px 60px; color:#5a6268;
    text-decoration:none; font-size:14px; transition: all 0.3s ease; font-weight:400;
    border-bottom: 1px solid rgba(233,236,239,0.5);
}
.sidebar-dropdown a:last-child { border-bottom: none; }
.sidebar-dropdown a:hover { background: rgba(76,175,80,0.1); color:#2E7D32; padding-left: 64px; }
.sidebar-dropdown a .dropdown-icon { margin-right: 12px; width:16px; text-align:center; font-size:13px; color:#2E7D32 !important; }

/* Overlay */
.sidebar-overlay {
    position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);
    z-index: 9998; display: none; backdrop-filter: blur(5px);
}
.sidebar-overlay.active { display: block; animation: fadeIn .3s ease; }
@keyframes fadeIn { from { opacity:0 } to { opacity:1 } }

/* Scroll Effect */
#main-header.scrolled { height: 70px; background: rgba(255,255,255,0.98); box-shadow: 0 4px 20px rgba(0,0,0,0.1); backdrop-filter: blur(30px); }
#main-header.scrolled .navbar-container { height: 70px; }

/* Responsive */
@media (max-width: 1200px) {
    .nav-link { font-size: 13px; padding: 10px 14px; }
    .brand-text { font-size: 20px; }
}
@media (max-width: 1024px) {
    .nav-menu { gap: 4px; }
    .nav-link { font-size: 12px; padding: 10px 12px; }
    .brand-text { font-size: 18px; }
    .dropdown-menu { min-width: 200px; }
}
@media (max-width: 900px) {
    .nav-menu { display: none; }
    .nav-toggle { display: flex; }
    .navbar-container { padding: 0 20px; }
    .brand-text { font-size: 18px; }
    .logo-area img { height: 40px; width: 40px; }
}
@media (max-width: 480px) {
    .navbar-container { padding: 0 15px; }
    .brand-text { font-size: 16px; }
    .mobile-sidebar { width: 85%; }
    .sidebar-link { padding: 14px 20px; font-size: 14px; }
    .sidebar-dropdown a { padding: 12px 20px 12px 55px; font-size: 13px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById("nav-toggle");
    const sidebar = document.getElementById("mobile-sidebar");
    const closeSidebar = document.getElementById("close-sidebar");
    const overlay = document.getElementById("sidebar-overlay");
    const dropdownToggles = document.querySelectorAll(".sidebar-dropdown-toggle");
    const header = document.getElementById("main-header");

    // === Buka Sidebar ===
    if (toggle) {
        toggle.addEventListener("click", () => {
            sidebar.classList.add("active");
            overlay.classList.add("active");
            sidebar.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = "hidden";
        });
    }

    // === Tutup Sidebar ===
    function closeMobileSidebar() {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        sidebar.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = "";
        
        // Tutup semua dropdown saat sidebar ditutup
        document.querySelectorAll('.sidebar-dropdown').forEach(dropdown => {
            dropdown.classList.remove('active');
        });
        
        // Reset semua panah dropdown
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(toggle => {
            toggle.classList.remove('active');
        });
    }

    if (closeSidebar) {
        closeSidebar.addEventListener("click", closeMobileSidebar);
    }
    if (overlay) {
        overlay.addEventListener("click", closeMobileSidebar);
    }

    // === Dropdown Handler (sidebar mobile) ===
    if (dropdownToggles) {
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();

                const dropdown = this.nextElementSibling;
                
                // Tutup dropdown lain yang terbuka
                document.querySelectorAll('.sidebar-dropdown').forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('active');
                    }
                });
                
                // Reset toggle lain
                document.querySelectorAll('.sidebar-dropdown-toggle').forEach(otherToggle => {
                    if (otherToggle !== this) {
                        otherToggle.classList.remove('active');
                    }
                });

                // Toggle dropdown yang diklik
                dropdown.classList.toggle("active");
                this.classList.toggle("active");
            });
        });
    }

    // === Scroll header efek ===
    if (header) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });
    }

    // === Tutup sidebar ketika link diklik (kecuali dropdown toggle) ===
    document.querySelectorAll('.sidebar-link[href]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.classList.contains('sidebar-dropdown-toggle')) {
                closeMobileSidebar();
            }
        });
    });

    // === Tekan ESC untuk menutup sidebar ===
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            closeMobileSidebar();
        }
    });

    // Accessibility: allow focusing dropdown via keyboard on desktop
    document.querySelectorAll('.nav-item > .nav-link').forEach(link => {
        link.addEventListener('focus', () => {
            const parent = link.closest('.nav-item');
            const dropdown = parent ? parent.querySelector('.dropdown-menu') : null;
            if (dropdown) {
                dropdown.style.opacity = '1';
                dropdown.style.visibility = 'visible';
                dropdown.style.transform = 'translateY(0)';
                dropdown.style.pointerEvents = 'auto';
            }
        });
        link.addEventListener('blur', () => {
            const parent = link.closest('.nav-item');
            const dropdown = parent ? parent.querySelector('.dropdown-menu') : null;
            if (dropdown) {
                // small timeout to allow focusing on dropdown items
                setTimeout(() => {
                    if (!parent.matches(':hover') && !dropdown.matches(':hover')) {
                        dropdown.style.opacity = '';
                        dropdown.style.visibility = '';
                        dropdown.style.transform = '';
                        dropdown.style.pointerEvents = '';
                    }
                }, 150);
            }
        });
    });
});
</script>

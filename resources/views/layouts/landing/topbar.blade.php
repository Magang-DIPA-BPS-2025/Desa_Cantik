<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Desa Cantik - Website Resmi</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Reset & Base Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f9fafb;
      color: #333;
      overflow-x: hidden;
    }

    /* Header */
    header {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
    }

    .navbar-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 80px;
    }

    /* Logo - SEJAJAR DENGAN MENU */
    .logo-area {
      display: flex;
      align-items: center;
      gap: 12px;
      padding-left: 10px; /* Sesuaikan dengan padding menu */
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
    }

    /* Navigation Menu - SEJAJAR DENGAN LOGO */
    .nav-menu {
      display: flex;
      gap: 8px;
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
    }

    .nav-link {
      text-decoration: none;
      color: #2D3748;
      font-weight: 500;
      font-size: 14px;
      padding: 12px 16px;
      border-radius: 8px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
      height: 44px; /* Tinggi konsisten */
      line-height: 1;
    }

    .nav-link:hover {
      background: rgba(76, 175, 80, 0.1);
      color: #2E7D32;
    }

    .nav-link.active {
      background: #2E7D32;
      color: white;
    }

    .nav-link i {
      font-size: 14px;
      width: 16px;
      text-align: center;
    }

    /* Dropdown */
    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      border-radius: 8px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      padding: 8px 0;
      min-width: 200px;
      display: none;
      z-index: 1000;
      margin-top: 8px;
    }

    .nav-item:hover .dropdown-menu {
      display: block;
    }

    .dropdown-menu a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      color: #4A5568;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .dropdown-menu a:hover {
      background: rgba(76, 175, 80, 0.1);
      color: #2E7D32;
    }

    .dropdown-menu a i {
      width: 16px;
      text-align: center;
    }

    /* Mobile Toggle */
    .nav-toggle {
      display: none;
      background: #2E7D32;
      border: none;
      border-radius: 8px;
      width: 44px;
      height: 44px;
      color: white;
      cursor: pointer;
      font-size: 18px;
      align-items: center;
      justify-content: center;
    }

    /* Mobile Sidebar - TAMPILAN LEBIH RAPI */
    .mobile-sidebar {
      position: fixed;
      top: 0;
      left: -100%;
      width: 320px;
      height: 100vh;
      background: white;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
      z-index: 9999;
      transition: left 0.3s ease;
      overflow-y: auto;
    }

    .mobile-sidebar.active {
      left: 0;
    }

    .sidebar-header {
      padding: 25px 20px 20px;
      border-bottom: 1px solid #e2e8f0;
      background: rgba(76, 175, 80, 0.05);
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sidebar-logo img {
      height: 40px;
      width: 40px;
    }

    .sidebar-brand {
      font-size: 20px;
      font-weight: 700;
      color: #2E7D32;
    }

    .close-sidebar {
      position: absolute;
      top: 25px;
      right: 20px;
      background: #2E7D32;
      border: none;
      border-radius: 6px;
      width: 36px;
      height: 36px;
      color: white;
      cursor: pointer;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar-menu {
      padding: 0;
      list-style: none;
    }

    .sidebar-item {
      position: relative;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 20px;
      color: #2D3748;
      text-decoration: none;
      font-weight: 500;
      font-size: 15px;
      border-bottom: 1px solid #f7fafc;
      transition: all 0.3s ease;
      min-height: 56px;
    }

    .sidebar-link i:first-child {
      margin-right: 12px;
      width: 18px;
      text-align: center;
      font-size: 16px;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
      background: rgba(76, 175, 80, 0.1);
      color: #2E7D32;
    }

    /* Dropdown Mobile */
    .sidebar-dropdown {
      background: #f8f9fa;
      display: none;
    }

    .sidebar-dropdown.active {
      display: block;
    }

    .sidebar-dropdown a {
      display: flex;
      align-items: center;
      padding: 14px 20px 14px 52px;
      color: #4A5568;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
      border-bottom: 1px solid #e2e8f0;
      min-height: 48px;
    }

    .sidebar-dropdown a:last-child {
      border-bottom: none;
    }

    .sidebar-dropdown a:hover {
      background: rgba(76, 175, 80, 0.1);
      color: #2E7D32;
    }

    .sidebar-dropdown a i {
      margin-right: 10px;
      width: 16px;
      text-align: center;
      font-size: 14px;
    }

    /* Overlay */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 9998;
      display: none;
    }

    .sidebar-overlay.active {
      display: block;
    }

    /* ================== BANNER ================== */
    .custom-header-banner {
      width: 100%;
      height: 200px;
      overflow: hidden;
      position: relative;
      margin-top: 80px; /* beri jarak sesuai tinggi navbar agar tidak tertutup */
      background: none; /* pastikan tidak ada background abu-abu */
      border: none; 
      padding: 0;
    }

    .custom-header-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      margin: 0;
      border: none;
    }

    /* Class untuk menyembunyikan banner */
    .banner-hidden {
      display: none;
    }

    /* Responsive */
    @media (max-width: 1100px) {
      .navbar-container {
        padding: 0 25px;
      }
      
      .nav-link {
        padding: 10px 14px;
        font-size: 13px;
      }
    }

    @media (max-width: 991px) {
      .nav-menu {
        display: none;
      }

      .nav-toggle {
        display: flex;
      }

      .navbar-container {
        height: 75px;
        padding: 0 20px;
      }

      .brand-text {
        font-size: 20px;
      }

      .logo-area img {
        height: 40px;
        width: 40px;
      }

      .custom-header-banner {
        height: 300px;
        margin-top: 75px;
      }
    }

    @media (max-width: 768px) {
      .custom-header-banner {
        height: 250px;
      }
    }

    @media (max-width: 480px) {
      .navbar-container {
        padding: 0 15px;
        height: 70px;
      }

      .brand-text {
        font-size: 18px;
      }

      .logo-area img {
        height: 36px;
        width: 36px;
      }

      .mobile-sidebar {
        width: 280px;
      }
      
      .sidebar-brand {
        font-size: 18px;
      }
      
      .custom-header-banner {
        height: 200px;
        margin-top: 70px;
      }
    }

    /* Scroll Effect */
    header.scrolled {
      height: 70px;
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    header.scrolled .navbar-container {
      height: 70px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header id="main-header">
    <div class="navbar-container">
      <!-- Logo - SEJAJAR DENGAN MENU -->
      <div class="logo-area">
        <img src="{{ asset('landing/images/footer/desaCanti.png') }}" alt="Logo Desa Cantik" />
        <span class="brand-text">DESA CANTIK</span>
      </div>

      <!-- Desktop Navigation - SEJAJAR DENGAN LOGO -->
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
            <i class="fas fa-home"></i>BERANDA
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('galeri*', 'sejarah', 'pemerintah', 'apbd') ? 'active' : '' }}">
            <i class="fas fa-landmark"></i>PROFIL DESA
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('galeri.user.index') }}" class="{{ request()->is('galeri*') ? 'active' : '' }}"><i class="fas fa-images"></i>Galeri Desa</a>
            <a href="{{ route('sejarah') }}" class="{{ request()->is('sejarah') ? 'active' : '' }}"><i class="fas fa-history"></i>Sejarah Desa</a>
            <a href="{{ route('pemerintah') }}" class="{{ request()->is('pemerintah') ? 'active' : '' }}"><i class="fas fa-users"></i>Pemerintah Desa</a>
            <a href="{{ route('apbd') }}" class="{{ request()->is('apbd') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i>APBD Desa</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('berita*', 'agenda*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i>BERITA & AGENDA
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i>Berita Desa</a>
            <a href="{{ route('agenda') }}" class="{{ request()->is('agenda*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i>Agenda Desa</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('statistik*', 'pendidikan', 'pekerjaan', 'agama') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i>DATA STATISTIK
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('statistik.penduduk') }}" class="{{ request()->is('statistik*') ? 'active' : '' }}"><i class="fas fa-users"></i>Jumlah Penduduk</a>
            <a href="{{ route('pendidikan') }}" class="{{ request()->is('pendidikan') ? 'active' : '' }}"><i class="fas fa-graduation-cap"></i>Data Pendidikan</a>
            <a href="{{ route('pekerjaan') }}" class="{{ request()->is('pekerjaan') ? 'active' : '' }}"><i class="fas fa-briefcase"></i>Data Pekerjaan</a>
            <a href="{{ route('agama') }}" class="{{ request()->is('agama') ? 'active' : '' }}"><i class="fas fa-pray"></i>Data Agama</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('pengantar*', 'status*', 'pengaduan*') ? 'active' : '' }}">
            <i class="fas fa-laptop-code"></i>LAYANAN ONLINE
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('pengantar') }}" class="{{ request()->is('pengantar*') ? 'active' : '' }}"><i class="fas fa-envelope"></i>Surat Pengantar</a>
            <a href="{{ route('status') }}" class="{{ request()->is('status*') ? 'active' : '' }}"><i class="fas fa-tasks"></i>Status Pengantar</a>
            <a href="{{ route('pengaduan') }}" class="{{ request()->is('pengaduan*') ? 'active' : '' }}"><i class="fas fa-exclamation-circle"></i>Pengaduan</a>
            <a href="{{ route('pengaduan.userStatus') }}" class="{{ request()->is('pengaduan*') ? 'active' : '' }}"><i class="fas fa-question-circle"></i>Status Pengaduan</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('ppid*', 'belanja*', 'permohonan*') ? 'active' : ' ' }}">
            <i class="fas fa-store"></i>PPID & UMKM
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('ppid') }}" class="{{ request()->is('ppid*') ? 'active' : '' }}"><i class="fas fa-info-circle"></i>PPID</a>
            <a href="{{ route('belanja') }}" class="{{ request()->is('belanja*') ? 'active' : '' }}"><i class="fas fa-shopping-bag"></i>UMKM</a>
            <a href="{{ route('permohonan.userStatus') }}" class="{{ request()->is('permohonan*') ? 'active' : '' }}"><i class="fas fa-file-contract"></i>Status Permohonan</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="{{ route('bukutamu') }}" class="nav-link {{ request()->is('bukutamu*') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i>BUKU TAMU
          </a>
        </li>
      </ul>

      <!-- Mobile Toggle Button -->
      <button class="nav-toggle" id="nav-toggle">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </header>

  <!-- BANNER - Hanya tampil jika bukan halaman beranda -->
  @if (!request()->is('/'))
  <section class="custom-header-banner">
    <img src="{{ asset('landing/images/banner/navbar.jpg') }}" alt="Banner Desa Cantik">
  </section>
  @endif

  <!-- Mobile Sidebar -->
  <div class="mobile-sidebar" id="mobile-sidebar">
    <div class="sidebar-header">
      <div class="sidebar-logo">
        <img src="{{ asset('landing/images/footer/desaCanti.png') }}" alt="Logo Desa Cantik" />
        <span class="sidebar-brand">DESA CANTIK</span>
      </div>
      <button class="close-sidebar" id="close-sidebar">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <ul class="sidebar-menu">
      <li class="sidebar-item">
        <a href="/" class="sidebar-link {{ request()->is('/') ? 'active' : '' }}">
          <i class="fas fa-home"></i>BERANDA
        </a>
      </li>

      <li class="sidebar-item">
        <a href="#" class="sidebar-link sidebar-dropdown-toggle {{ request()->is('galeri*', 'sejarah', 'pemerintah', 'apbd') ? 'active' : '' }}">
          <i class="fas fa-landmark"></i>PROFIL DESA
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="sidebar-dropdown">
          <a href="{{ route('galeri.user.index') }}" class="{{ request()->is('galeri*') ? 'active' : '' }}"><i class="fas fa-images"></i>Galeri Desa</a>
          <a href="{{ route('sejarah') }}" class="{{ request()->is('sejarah') ? 'active' : '' }}"><i class="fas fa-history"></i>Sejarah Desa</a>
          <a href="{{ route('pemerintah') }}" class="{{ request()->is('pemerintah') ? 'active' : '' }}"><i class="fas fa-users"></i>Pemerintah Desa</a>
          <a href="{{ route('apbd') }}" class="{{ request()->is('apbd') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i>APBD Desa</a>
        </div>
      </li>

      <li class="sidebar-item">
        <a href="#" class="sidebar-link sidebar-dropdown-toggle {{ request()->is('berita*', 'agenda*') ? 'active' : '' }}">
          <i class="fas fa-newspaper"></i>BERITA & AGENDA
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="sidebar-dropdown">
          <a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i>Berita Desa</a>
          <a href="{{ route('agenda') }}" class="{{ request()->is('agenda*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i>Agenda Desa</a>
        </div>
      </li>

      <li class="sidebar-item">
        <a href="#" class="sidebar-link sidebar-dropdown-toggle {{ request()->is('statistik*', 'pendidikan', 'pekerjaan', 'agama') ? 'active' : '' }}">
          <i class="fas fa-chart-bar"></i>DATA STATISTIK
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="sidebar-dropdown">
          <a href="{{ route('statistik.penduduk') }}" class="{{ request()->is('statistik*') ? 'active' : '' }}"><i class="fas fa-users"></i>Jumlah Penduduk</a>
          <a href="{{ route('pendidikan') }}" class="{{ request()->is('pendidikan') ? 'active' : '' }}"><i class="fas fa-graduation-cap"></i>Data Pendidikan</a>
          <a href="{{ route('pekerjaan') }}" class="{{ request()->is('pekerjaan') ? 'active' : '' }}"><i class="fas fa-briefcase"></i>Data Pekerjaan</a>
          <a href="{{ route('agama') }}" class="{{ request()->is('agama') ? 'active' : '' }}"><i class="fas fa-pray"></i>Data Agama</a>
        </div>
      </li>

      <li class="sidebar-item">
        <a href="#" class="sidebar-link sidebar-dropdown-toggle {{ request()->is('pengantar*', 'status*', 'pengaduan*') ? 'active' : '' }}">
          <i class="fas fa-laptop-code"></i>LAYANAN ONLINE
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="sidebar-dropdown">
          <a href="{{ route('pengantar') }}" class="{{ request()->is('pengantar*') ? 'active' : '' }}"><i class="fas fa-envelope"></i>Surat Pengantar</a>
          <a href="{{ route('status') }}" class="{{ request()->is('status*') ? 'active' : '' }}"><i class="fas fa-tasks"></i>Status Pengantar</a>
          <a href="{{ route('pengaduan') }}" class="{{ request()->is('pengaduan*') ? 'active' : '' }}"><i class="fas fa-exclamation-circle"></i>Pengaduan</a>
          <a href="{{ route('pengaduan.userStatus') }}" class="{{ request()->is('pengaduan*') ? 'active' : '' }}"><i class="fas fa-question-circle"></i>Status Pengaduan</a>
        </div>
      </li>

      <li class="sidebar-item">
        <a href="#" class="sidebar-link sidebar-dropdown-toggle {{ request()->is('ppid*', 'belanja*', 'permohonan*') ? 'active' : '' }}">
          <i class="fas fa-store"></i>PPID & UMKM
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="sidebar-dropdown">
          <a href="{{ route('ppid') }}" class="{{ request()->is('ppid*') ? 'active' : '' }}"><i class="fas fa-info-circle"></i>PPID</a>
          <a href="{{ route('belanja') }}" class="{{ request()->is('belanja*') ? 'active' : '' }}"><i class="fas fa-shopping-bag"></i>UMKM</a>
          <a href="{{ route('permohonan.userStatus') }}" class="{{ request()->is('permohonan*') ? 'active' : '' }}"><i class="fas fa-file-contract"></i>Status Permohonan</a>
        </div>
      </li>

      <li class="sidebar-item">
        <a href="{{ route('bukutamu') }}" class="sidebar-link {{ request()->is('bukutamu*') ? 'active' : '' }}">
          <i class="fas fa-book-open"></i>BUKU TAMU
        </a>
      </li>
    </ul>
  </div>

  <!-- Overlay -->
  <div class="sidebar-overlay" id="sidebar-overlay"></div>

  <!-- JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggle = document.getElementById("nav-toggle");
      const sidebar = document.getElementById("mobile-sidebar");
      const closeSidebar = document.getElementById("close-sidebar");
      const overlay = document.getElementById("sidebar-overlay");
      const dropdownToggles = document.querySelectorAll(".sidebar-dropdown-toggle");
      const header = document.getElementById("main-header");

      // Toggle sidebar
      toggle.addEventListener("click", () => {
        sidebar.classList.add("active");
        overlay.classList.add("active");
        document.body.style.overflow = "hidden";
      });

      // Close sidebar
      function closeMobileSidebar() {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        document.body.style.overflow = "";
      }

      closeSidebar.addEventListener("click", closeMobileSidebar);
      overlay.addEventListener("click", closeMobileSidebar);

      // Mobile dropdown handling
      dropdownToggles.forEach(toggle => {
        toggle.addEventListener("click", function(e) {
          e.preventDefault();
          const dropdown = this.nextElementSibling;
          const chevron = this.querySelector(".fa-chevron-down");
          
          // Tutup dropdown lainnya
          document.querySelectorAll(".sidebar-dropdown").forEach(d => {
            if (d !== dropdown) {
              d.classList.remove("active");
              d.previousElementSibling.querySelector(".fa-chevron-down").style.transform = "rotate(0deg)";
            }
          });
          
          // Toggle dropdown saat ini
          dropdown.classList.toggle("active");
          
          if (dropdown.classList.contains("active")) {
            chevron.style.transform = "rotate(180deg)";
          } else {
            chevron.style.transform = "rotate(0deg)";
          }
        });
      });

      // Header scroll effect
      window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
          header.classList.add("scrolled");
        } else {
          header.classList.remove("scrolled");
        }
      });

      // Close sidebar ketika klik link
      document.querySelectorAll('.sidebar-link[href]').forEach(link => {
        link.addEventListener('click', closeMobileSidebar);
      });

      // Keyboard escape to close sidebar
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
          closeMobileSidebar();
        }
      });
    });
  </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Desa Cantik - Website Resmi</title>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    header {
      background-color: white;
      border-bottom: 1px solid #ddd;
      width: 100%;
      position: relative;
      z-index: 999;
    }

    .navbar-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 10px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .logo-area {
      display: flex;
      align-items: center;
    }

    .logo-area img {
      height: 40px;
      margin-right: 6px;
    }

    .nav-toggle {
      display: none;
      font-size: 28px;
      background: none;
      border: none;
      cursor: pointer;
      color: #333;
    }

    .nav-menu {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .nav-item {
      list-style: none;
      position: relative;
    }

    .nav-link {
      text-decoration: none;
      color: #333;
      font-weight: bold;
      padding: 12px 15px;
      display: block;
      white-space: nowrap;
    }

    .nav-link:hover {
      color: orange;
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #fff;
      border: 1px solid #ccc;
      display: none;
      flex-direction: column;
      min-width: 200px;
      z-index: 1000;
    }

    .dropdown-menu a {
      padding: 10px 15px;
      color: #333;
      text-decoration: none;
    }

    .dropdown-menu a:hover {
      background-color: #f2f2f2;
    }

    .nav-item:hover .dropdown-menu {
      display: flex;
    }

    /* Mobile Styles */
    @media (max-width: 991px) {
      .navbar-container {
        flex-direction: column;
        align-items: flex-start;
      }

      .logo-area {
        order: 1;
        width: 100%;
        justify-content: flex-start;
        padding: 10px 20px;
      }

      .nav-toggle {
        order: 2;
        align-self: flex-end;
        margin: 10px 10px 0 0;
        display: block;
      }

      .nav-menu {
        order: 3;
        width: 100%;
        flex-direction: column;
        display: none;
        border-top: 1px solid #ddd;
        margin-top: 0;
      }

      .nav-menu.active {
        display: flex;
      }

      .nav-item {
        width: 100%;
      }

      .nav-link {
        padding: 12px 20px;
        border-bottom: 1px solid #eee;
      }

      .dropdown-menu {
        position: relative;
        display: none;
        width: 100%;
        border: none;
        box-shadow: none;
      }

      .dropdown-menu.active {
        display: flex !important;
      }

      .nav-item:hover .dropdown-menu {
        display: none;
      }

      .nav-item.has-dropdown > .nav-link::after {
        content: " ▼";
        font-size: 12px;
        float: right;
      }

      .nav-item.has-dropdown.active > .nav-link::after {
        content: " ▲";
      }
    }

    /* Tanda panah dropdown di desktop */
    .nav-item.has-dropdown > .nav-link::after {
      content: " ▼";
      font-size: 12px;
      float: right;
    }

    .nav-item.has-dropdown.active > .nav-link::after {
      content: " ▲";
    }

    .hero-banner img {
      max-width: 100%;
      height: auto;
      display: block;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <header>
    <div class="navbar-container">
      <!-- Logo -->
      <div class="logo-area">
        <img src="{{ asset('landing/images/footer/logobps.png') }}" alt="Logo BPS" />
        <img src="{{ asset('landing/images/footer/desaCanti.png') }}" alt="Logo Desa Cantik" />
        <span class="brand-text">DESA CANTIK</span>
      </div>

      <!-- Toggle Button -->
      <button class="nav-toggle" id="nav-toggle">☰</button>

      <!-- Menu -->
      <ul class="nav-menu" id="nav-menu">
        <li class="nav-item"><a href="/" class="nav-link">BERANDA</a></li>

        <li class="nav-item has-dropdown">
          <a href="#" class="nav-link">PROFIL DESA</a>
          <div class="dropdown-menu">
            <a href="{{ route('galeri.user.index') }}">Galeri Desa</a>
            <a href="{{ route('sejarah') }}">Sejarah Desa</a>
            <a href="{{ route('pemerintah') }}">Pemerintah Desa</a>
          </div>
        </li>

        <li class="nav-item has-dropdown">
          <a href="#" class="nav-link">BERITA & AGENDA</a>
          <div class="dropdown-menu">
            <a href="{{ route('berita') }}">Berita Desa</a>
            <a href="{{ route('agenda') }}">Agenda Desa</a>
          </div>
        </li>

        <li class="nav-item has-dropdown">
          <a href="#" class="nav-link">DATA STATISTIK DESA</a>
          <div class="dropdown-menu">
            <a href="{{ route('statistik.penduduk') }}">Jumlah Penduduk</a>
            <a href="{{ route('pendidikan') }}">Data Pendidikan</a>
            <a href="{{ route('pekerjaan') }}">Data Pekerjaan</a>
            <a href="{{ route('agama') }}">Data Agama</a>
          </div>
        </li>

        <li class="nav-item has-dropdown">
          <a href="#" class="nav-link">LAYANAN ONLINE</a>
          <div class="dropdown-menu">
            <a href="{{ route('pengantar') }}">Surat Pengantar</a>
            <a href="{{ route('status') }}">Status Pengantar</a>
            <a href="{{ route('pengaduan') }}">Pengaduan</a>
            <a href="{{ route('statuspengaduan') }}">Status Pengaduan</a>
            <a href="{{ route('penyandang') }}">Penyandang Disabilitas</a>
          </div>
        </li>
      </ul>
    </div>
  </header>

{{-- Hero Banner tampil jika bukan halaman beranda --}}
@if (!request()->is('/'))
  <style>
    .hero-banner {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    .hero-banner img {
      width: 100%;       /* full lebar layar */
      height: auto;      /* proporsional */
      max-height: 300px; /* batasi tinggi biar tidak terlalu tinggi */
      object-fit: cover; /* potong gambar biar tetap rapi */
      display: block;
    }
  </style>

  <div class="hero-banner">
    <img src="{{ asset('landing/images/banner/navbar.jpg') }}" alt="Banner Desa">
  </div>
@endif



  <!-- SCRIPT -->
  <script>
    const toggle = document.getElementById("nav-toggle");
    const menu = document.getElementById("nav-menu");
    const dropdownItems = document.querySelectorAll(".nav-item.has-dropdown");

    // Toggle menu (mobile)
    toggle.addEventListener("click", () => {
      menu.classList.toggle("active");
    });

    // Mobile dropdown logic
    function isMobile() {
      return window.innerWidth <= 991;
    }

    dropdownItems.forEach((item) => {
      const link = item.querySelector(".nav-link");
      const dropdown = item.querySelector(".dropdown-menu");

      link.addEventListener("click", function (e) {
        if (isMobile()) {
          e.preventDefault();
          const isActive = dropdown.classList.contains("active");

          // Close all dropdowns
          document.querySelectorAll(".dropdown-menu").forEach((d) => d.classList.remove("active"));
          document.querySelectorAll(".nav-item.has-dropdown").forEach((i) => i.classList.remove("active"));

          // Open clicked one
          if (!isActive) {
            dropdown.classList.add("active");
            item.classList.add("active");
          }
        }
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (e) {
      if (isMobile()) {
        if (!e.target.closest(".nav-item.has-dropdown")) {
          document.querySelectorAll(".dropdown-menu").forEach((d) => d.classList.remove("active"));
          document.querySelectorAll(".nav-item.has-dropdown").forEach((i) => i.classList.remove("active"));
        }
      }
    });

    // On resize, reset dropdown state
    window.addEventListener("resize", () => {
      if (!isMobile()) {
        document.querySelectorAll(".dropdown-menu").forEach((d) => d.classList.remove("active"));
        document.querySelectorAll(".nav-item.has-dropdown").forEach((i) => i.classList.remove("active"));
      }
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Desa Cantik - Website Resmi</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f9fafb;
      color: #333;
    }

    header {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      width: 100%;
      position: sticky;
      top: 0;
      z-index: 999;
      transition: all 0.3s ease;
    }

    .navbar-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* Logo */
    .logo-area {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .logo-area img {
      height: 38px;
    }

    .brand-text {
      font-size: 22px;
      font-weight: 700;
      color: #2e7d32;
      letter-spacing: 1px;
    }

    /* Menu */
    .nav-menu {
      display: flex;
      gap: 20px;
      align-items: center;
      transition: all 0.3s ease;
    }

    .nav-item {
      list-style: none;
      position: relative;
    }

    .nav-link {
      text-decoration: none;
      color: #333;
      font-weight: 600;
      font-size: 16px;
      padding: 10px 14px;
      position: relative;
      transition: color 0.3s ease;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -3px;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #4CAF50, #FFA500);
      transition: width 0.3s ease;
    }

    .nav-link:hover {
      color: #4CAF50;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* Dropdown */
    .dropdown-menu {
      position: absolute;
      top: 120%;
      left: 0;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      padding: 10px 0;
      display: none;
      flex-direction: column;
      min-width: 200px;
      animation: fadeIn 0.3s ease;
    }

    .dropdown-menu a {
  padding: 12px 20px;
  color: #333;
  text-decoration: none;
  font-size: 16px;
  font-weight: 500;
  transition: background 0.2s ease;
}

.dropdown-menu a:hover {
  background: #f5f5f5;
  color: #4CAF50;
}

.dropdown-menu a + a {
  border-top: 1px solid #f2f2f2;
}


    .nav-item:hover .dropdown-menu {
      display: flex;
    }

    /* Toggle button */
    .nav-toggle {
      display: none;
      font-size: 26px;
      background: none;
      border: none;
      cursor: pointer;
      color: #333;
      transition: transform 0.3s ease;
    }

    .nav-toggle.active {
      transform: rotate(90deg);
    }

    /* Hero Banner */
    .hero-banner img {
      width: 100%;
      max-height: 250px;
      object-fit: cover;
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Mobile */
    @media (max-width: 991px) {
      .nav-toggle {
        display: block;
      }

      .nav-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        flex-direction: column;
        background: #fff;
        border-top: 1px solid #eee;
        display: none;
      }

      .nav-menu.active {
        display: flex;
        animation: fadeInDown 0.3s ease;
      }

      .nav-item {
        width: 100%;
      }

      .nav-link {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
      }

      .dropdown-menu {
        position: relative;
        top: 0;
        left: 0;
        box-shadow: none;
        border-radius: 0;
      }

      .nav-item:hover .dropdown-menu {
        display: none;
      }

      .nav-item.active .dropdown-menu {
        display: flex;
      }
    }

    /* Animations */
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }

    @keyframes fadeInDown {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <header>
    <div class="navbar-container">
      <!-- Logo -->
      <div class="logo-area">
        <img src="{{ asset('landing/images/footer/desaCanti.png') }}" alt="Logo Desa Cantik" />
        <span class="brand-text">DESA CANTIK</span>
      </div>

      <!-- Toggle -->
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
            <a href="{{ route('apbd') }}">APBD Desa</a>
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
  <div class="hero-banner">
    <img src="{{ asset('landing/images/banner/navbar.jpg') }}" alt="Banner Desa">
  </div>
  @endif

  <!-- Script -->
  <script>
    const toggle = document.getElementById("nav-toggle");
    const menu = document.getElementById("nav-menu");
    const dropdownItems = document.querySelectorAll(".nav-item.has-dropdown");

    toggle.addEventListener("click", () => {
      menu.classList.toggle("active");
      toggle.classList.toggle("active");
    });

    function isMobile() {
      return window.innerWidth <= 991;
    }

    dropdownItems.forEach((item) => {
      const link = item.querySelector(".nav-link");
      const dropdown = item.querySelector(".dropdown-menu");

      link.addEventListener("click", function (e) {
        if (isMobile()) {
          e.preventDefault();
          item.classList.toggle("active");
        }
      });
    });
  </script>
</body>
</html>



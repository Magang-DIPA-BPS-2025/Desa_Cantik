@extends('layouts.landing.app')

@section('content')
<div class="container-fluid py-4" style="background-color: #C0D09D; min-height: 100vh; display: flex; flex-direction: column;">
  <div class="container my-5 text-center flex-grow-1">
    <h2 class="mb-4">SUSUNAN ORGANISASI PEMERINTAH DESA</h2>
    <p class="fw-bold">KECAMATAN SOMBA OPU KABUPATEN GOWA</p>

    <div class="org-container p-3 bg-light border rounded shadow-sm">
      <img src="{{ asset('landing/images/struktur/struktur-desa.png') }}"
           alt="Struktur Pemerintah Desa"
           class="img-fluid mx-auto d-block">
    </div>

    <div class="tupoksi bg-success-subtle p-4 mt-5 rounded">
      <h4 class="fw-bold">Tupoksi Desa</h4>
      <p class="mb-0">Menjelaskan tugas pokok dan fungsi dari setiap perangkat desa sesuai struktur organisasi.</p>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center text-white py-3 mt-auto">
  </footer>
</div>

<style>
  /* Header CSS (kopi dari file topbar) */
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

  /* Styling container pemerintah desa */
  .org-container img {
    max-width: 100%;
    height: auto;
  }

  .tupoksi {
    background-color: #d1e7dd;
  }
</style>

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
@endsection

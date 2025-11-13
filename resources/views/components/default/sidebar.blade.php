<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">DESA CANTIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ request()->is('penduduk*') ? route('penduduk.index') : route('dashboard') }}">DESA</a>
        </div>

        @php
            // Dapatkan nama route saat ini
            $currentRouteName = request()->route()->getName();

            // Tentukan menu aktif berdasarkan route
            $activeMenu = '';

            // Dashboard
            if (str_contains($currentRouteName, 'dashboard')) {
                $activeMenu = 'dashboard';
            }
            // Data Penduduk
            elseif (str_contains($currentRouteName, 'dataPenduduk')) {
                $activeMenu = 'datapenduduk';
            }
            // Profil Desa
            elseif (
                str_contains($currentRouteName, 'galeriDesa') ||
                str_contains($currentRouteName, 'pemerintah-desa') ||
                str_contains($currentRouteName, 'apbd')
            ) {
                $activeMenu = 'profil';
            }
            // Agenda
            elseif (
                str_contains($currentRouteName, 'AgendaDesa') ||
                str_contains($currentRouteName, 'berita') ||
                str_contains($currentRouteName, 'kategori') ||
                str_contains($currentRouteName, 'kalender')
            ) {
                $activeMenu = 'agenda';
            }
            // Persuratan
            elseif (
                str_contains($currentRouteName, 'sku') ||
                str_contains($currentRouteName, 'sktm') ||
                    str_contains($currentRouteName, 'izin') ||
                str_contains($currentRouteName, 'kematian')
            ) {
                $activeMenu = 'persuratan';
            }
            // Pengaduan
            elseif (str_contains($currentRouteName, 'pengaduan')) {
                $activeMenu = 'pengaduan';
            }
            // PPID & UMKM
            elseif (
                str_contains($currentRouteName, 'ppid') ||
                str_contains($currentRouteName, 'belanja')
            ) {
                $activeMenu = 'ppidumkm';
            }
            // Permohonan
            elseif (str_contains($currentRouteName, 'permohonan')) {
                $activeMenu = 'permohonan';
            }
            // Buku Tamu
            elseif (str_contains($currentRouteName, 'buku')) {
                $activeMenu = 'buku';
            }
            // Data Akun
            elseif (str_contains($currentRouteName, 'akun')) {
                $activeMenu = 'akun';
            }

            // Tentukan sub-menu aktif
            $activeSubmenu = '';
            if (str_contains($currentRouteName, 'galeriDesa')) {
                $activeSubmenu = 'galeriDesa';
            } elseif (str_contains($currentRouteName, 'pemerintah-desa')) {
                $activeSubmenu = 'pemerintahDesa';
            } elseif (str_contains($currentRouteName, 'apbd')) {
                $activeSubmenu = 'apbd';
            } elseif (str_contains($currentRouteName, 'AgendaDesa')) {
                $activeSubmenu = 'kegiatan';
            } elseif (str_contains($currentRouteName, 'berita')) {
                $activeSubmenu = 'berita';
            } elseif (str_contains($currentRouteName, 'kategori')) {
                $activeSubmenu = 'kategori';
            } elseif (str_contains($currentRouteName, 'kalender')) {
                $activeSubmenu = 'kalender';
            } elseif (str_contains($currentRouteName, 'sku')) {
                $activeSubmenu = 'suratSku';
            } elseif (str_contains($currentRouteName, 'sktm')) {
                $activeSubmenu = 'suratSktm';
            } elseif (str_contains($currentRouteName, 'kematian')) {
                $activeSubmenu = 'kematian';
            } elseif (str_contains($currentRouteName, 'izin')) {
                $activeSubmenu = 'izin';
            } elseif (str_contains($currentRouteName, 'ppid')) {
                $activeSubmenu = 'ppid';
            } elseif (str_contains($currentRouteName, 'belanja')) {
                $activeSubmenu = 'belanja';
            }

            // Tentukan dropdown mana yang harus show
            $showProfil = in_array($activeMenu, ['profil']);
            $showAgenda = in_array($activeMenu, ['agenda']);
            $showPersuratan = in_array($activeMenu, ['persuratan']);
            $showPpidUmkm = in_array($activeMenu, ['ppidumkm']);
            $showPengaduan = in_array($activeMenu, ['pengaduan']);
        @endphp

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            {{-- Dashboard --}}
            <li class="nav-item {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            @if(session('role') == 'admin')
                {{-- Data Penduduk --}}
                <li class="nav-item {{ $activeMenu == 'datapenduduk' ? 'active' : '' }}">
                    <a href="{{ route('dataPenduduk.index') }}" class="nav-link">
                        <i class="fas fa-user"></i><span>Data Penduduk</span>
                    </a>
                </li>

                {{-- Data Profil Desa --}}
                <li class="nav-item dropdown {{ $showProfil ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-sitemap"></i> <span>Data Profil Desa</span>
                    </a>
                    <ul class="dropdown-menu {{ $showProfil ? 'show' : '' }}">
                        <li class="{{ $activeSubmenu == 'galeriDesa' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('galeriDesa.index') }}">Galeri Desa</a>
                        </li>
                          <li class="{{ $activeSubmenu == 'pemerintah-desa' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pemerintah-desa.index') }}">Pemerintah Desa</a>
                        </li>
                      
                        <li class="{{ $activeSubmenu == 'apbd' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('apbd.index') }}">APBD Desa</a>
                        </li>
                    </ul>
                </li>

                {{-- Data Agenda --}}
                <li class="nav-item dropdown {{ $showAgenda ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-calendar-week"></i> <span>Data Agenda</span>
                    </a>
                    <ul class="dropdown-menu {{ $showAgenda ? 'show' : '' }}">
                        <li class="{{ $activeSubmenu == 'kegiatan' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('AgendaDesa.index') }}">Agenda Desa</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'berita' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.berita.index') }}">Berita Desa</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'kategori' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kategori.index') }}">Kategori Berita</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'kalender' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kalender.index') }}">Kalender</a>
                        </li>
                    </ul>
                </li>

                {{-- Data Persuratan --}}
                <li class="nav-item dropdown {{ $showPersuratan ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-envelope"></i> <span>Data Persuratan</span>
                    </a>
                    <ul class="dropdown-menu {{ $showPersuratan ? 'show' : '' }}">
                        <li class="{{ $activeSubmenu == 'suratSku' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('sku.index') }}">Surat SKU</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'suratSktm' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('sktm.index') }}">Surat SKTM</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'kematian' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kematian.index') }}">Surat Kematian</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'izin' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('izin.index') }}">Surat Izin</a>
                        </li>
                    </ul>
                </li>

                {{-- Data Pengaduan --}}
                <li class="nav-item dropdown {{ $showPengaduan ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-comments"></i> <span>Data Pengaduan</span>
                    </a>
                    <ul class="dropdown-menu {{ $showPengaduan ? 'show' : '' }}">
                        <li class="{{ $activeSubmenu == 'pengaduan' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pengaduan.index') }}">Data Pengaduan</a>
                        </li>
                    </ul>
                </li>

                {{-- Data PPID & UMKM --}}
                <li class="nav-item dropdown {{ $showPpidUmkm ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-calendar-week"></i> <span>Data PPID & UMKM</span>
                    </a>
                    <ul class="dropdown-menu {{ $showPpidUmkm ? 'show' : '' }}">
                        <li class="{{ $activeSubmenu == 'ppid' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ppid.index') }}">PPID</a>
                        </li>
                        <li class="{{ $activeSubmenu == 'belanja' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('belanja.index') }}">UMKM</a>
                        </li>
                    </ul>
                </li>

                {{-- Permohonan Informasi --}}
                <li class="nav-item {{ $activeMenu == 'permohonan' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('permohonan.index') }}">
                        <i class="fas fa-file-alt"></i> <span>Permohonan Informasi</span>
                    </a>
                </li>

                {{-- Buku Tamu --}}
                <li class="nav-item {{ $activeMenu == 'buku' ? 'active' : '' }}">
                    <a href="{{ route('admin.buku.index') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i><span> Buku Tamu</span>
                    </a>
                </li>

                {{-- Data Akun --}}
                <li class="nav-item {{ $activeMenu == 'akun' ? 'active' : '' }}">
                    <a href="{{ route('akun.index') }}" class="nav-link">
                        <i class="fas fa-user"></i> <span>Data Akun</span>
                    </a>
                </li>
            @endif
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>

<!-- JavaScript untuk interaktifitas dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi dropdown yang aktif
        const activeDropdowns = document.querySelectorAll('.nav-item.dropdown.active');
        activeDropdowns.forEach(dropdown => {
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.add('show');
            }
        });

        // Handle klik pada dropdown toggle
        const dropdownToggles = document.querySelectorAll('.nav-link.has-dropdown');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();

                const parent = this.parentElement;
                const dropdownMenu = this.nextElementSibling;

                // Tutup semua dropdown lainnya
                document.querySelectorAll('.nav-item.dropdown .dropdown-menu.show').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle dropdown saat ini
                if (dropdownMenu) {
                    dropdownMenu.classList.toggle('show');

                    // Tambah/remove class active pada parent
                    if (dropdownMenu.classList.contains('show')) {
                        parent.classList.add('active');
                    } else {
                        // Jangan remove active jika ini adalah menu yang memang aktif
                        if (!parent.classList.contains('active')) {
                            parent.classList.remove('active');
                        }
                    }
                }
            });
        });

        // Tutup dropdown ketika klik di luar
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.nav-item.dropdown')) {
                document.querySelectorAll('.nav-item.dropdown .dropdown-menu.show').forEach(menu => {
                    // Jangan tutup menu yang memang aktif
                    const parent = menu.closest('.nav-item.dropdown');
                    if (!parent.classList.contains('active')) {
                        menu.classList.remove('show');
                    }
                });
            }
        });
    });
</script>

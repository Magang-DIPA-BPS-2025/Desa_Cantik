<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">DESA CANTIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">DESA</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            {{-- Dashboard --}}
            <li class="nav-item {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            @if (session('role') == 'admin')

                {{-- Data Penduduk (tetap sesuai route aslinya) --}}
                <li class="{{ $menu == 'dataPenduduk' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dataPenduduk.index') }}">
                        <i class="fas fa-user"></i> <span>Data Penduduk</span>
                    </a>
                </li>

                {{-- Data Profil Desa --}}
                <li class="nav-item dropdown {{ $menu == 'galeriDesa' || $menu == 'jadwal' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link has-dropdown">
                        <i class="fas fa-sitemap"></i>
                        <span>Data Profil Desa</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('galeriDesa.index') }}">Galeri Desa</a></li>
                        <li><a class="nav-link" href="{{ route('sejarahDesa.index') }}">Sejarah</a></li>
                        <li><a class="nav-link" href="{{ route('pemerintah-desa.index') }}">Pemerintah Desa</a></li>
                         <li><a class="nav-link" href="{{ route('apbd.index') }}">APBD Desa</a></li>
                    </ul>
                </li>

                {{-- Data Agenda --}}
                <li class="nav-item dropdown {{ $menu == 'kegiatan' || $menu == 'peserta' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-calendar-week"></i>
                        <span>Data Agenda</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('AgendaDesa.index') }}">Agenda Desa</a></li>
                        <li><a class="nav-link" href="{{ route('berita.index') }}">Berita Desa</a></li>
                        <li><a class="nav-link" href="{{ route('kategori.index') }}">Kategori Berita</a></li>
                    </ul>
                </li>

                {{-- Data Persuratan --}}
                <li class="nav-item dropdown {{ $menu == 'persuratan' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-envelope"></i>
                        <span>Data Persuratan</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('dashboard') }}">Data Surat</a></li>
                        <li><a class="nav-link" href="{{ route('dashboard') }}">Data Jadwal RPPH</a></li>
                    </ul>
                </li>

                {{-- Data Pengaduan --}}
                <li class="nav-item dropdown {{ $menu == 'pengaduan' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-comments"></i>
                        <span>Data Pengaduan</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                        <li><a class="nav-link" href="{{ route('dashboard') }}">Jadwal Tindak Lanjut</a></li>
                    </ul>
                </li>

                {{-- Data Akun --}}
                <li class="{{ $menu == 'akun' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
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

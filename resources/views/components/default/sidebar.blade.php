<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">DESA CANTIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
             <a href="{{ request()->is('penduduk*') ? route('penduduk.index') : route('dashboard') }}"> DESA
</a>
        </div>

        @php
            // Daftar sub-menu untuk dropdown
            $profilMenus = ['galeriDesa','sejarahDesa','pemerintahDesa','apbd'];
            $agendaMenus = ['kegiatan','berita','kategori'];
            $persuratanMenus = ['persuratan']; // jika ada sub-menu spesifik, bisa ditambahkan
            $pengaduanMenus = ['pengaduan'];
              $ppidMenus = ['ppid'];
        @endphp

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            {{-- Dashboard --}}
            <li class="nav-item {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            @if(session('role') == 'admin')

                {{-- Data Penduduk --}}


                 <li class="nav-item {{ $menu == 'datapenduduk' ? 'active' : '' }}">
                <a href="{{ route('dataPenduduk.index') }}" class="nav-link">
                    <i class="fas fa-user"></i><span>Data Penduduk</span>
                </a>
                </li>

                {{-- Data Profil Desa --}}
                <li class="nav-item dropdown {{ in_array($menu, $profilMenus) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-sitemap"></i> <span>Data Profil Desa</span></a>
                    <ul class="dropdown-menu {{ in_array($menu, $profilMenus) ? 'show' : '' }}">
                        <li><a class="nav-link {{ $menu == 'galeriDesa' ? 'active' : '' }}" href="{{ route('galeriDesa.index') }}">Galeri Desa</a></li>
                        <li><a class="nav-link {{ $menu == 'sejarahDesa' ? 'active' : '' }}" href="{{ route('sejarahDesa.index') }}">Sejarah</a></li>
                        <li><a class="nav-link {{ $menu == 'pemerintahDesa' ? 'active' : '' }}" href="{{ route('pemerintah-desa.index') }}">Pemerintah Desa</a></li>
                        <li><a class="nav-link {{ $menu == 'apbd' ? 'active' : '' }}" href="{{ route('apbd.index') }}">APBD Desa</a></li>
                    </ul>
                </li>

                {{-- Data Agenda --}}
                <li class="nav-item dropdown {{ in_array($menu, $agendaMenus) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-week"></i> <span>Data Agenda</span></a>
                    <ul class="dropdown-menu {{ in_array($menu, $agendaMenus) ? 'show' : '' }}">
                        <li><a class="nav-link {{ $menu == 'kegiatan' ? 'active' : '' }}" href="{{ route('AgendaDesa.index') }}">Agenda Desa</a></li>
                        <li><a class="nav-link {{ $menu == 'berita' ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">Berita Desa</a></li>
                        <li><a class="nav-link {{ $menu == 'kategori' ? 'active' : '' }}" href="{{ route('kategori.index') }}">Kategori Berita</a></li>
                    </ul>
                </li>



                {{-- Data Persuratan --}}
                <li class="nav-item dropdown {{ in_array($menu, $persuratanMenus) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i> <span>Data Persuratan</span></a>
                    <ul class="dropdown-menu {{ in_array($menu, $persuratanMenus) ? 'show' : '' }}">
                        <li><a class="nav-link {{ $menu == 'surat' ? 'active' : '' }}" href="{{ route('surat.index') }}">Data Persuratan</a></li>
                    </ul>
                </li>

                {{-- Data Pengaduan --}}
                <li class="nav-item dropdown {{ in_array($menu, $pengaduanMenus) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-comments"></i> <span>Data Pengaduan</span></a>
                    <ul class="dropdown-menu {{ in_array($menu, $pengaduanMenus) ? 'show' : '' }}">
                        <li><a class="nav-link {{ $menu == 'pengaduan' ? 'active' : '' }}" href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                    </ul>
                </li>

                {{-- Data PPID & UMKM --}}
                <li class="nav-item dropdown {{ in_array($menu, $ppidMenus) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-week"></i> <span>Data PPID&UMKM</span></a>
                    <ul class="dropdown-menu {{ in_array($menu, $agendaMenus) ? 'show' : '' }}">
                        <li><a class="nav-link {{ $menu == 'ppid' ? 'active' : '' }}" href="{{ route('ppid.index') }}">PPID</a></li>
                        <li><a class="nav-link {{ $menu == 'belanja' ? 'active' : '' }}" href="{{ route('belanja.index') }}">UMKM</a></li>
                    </ul>
                </li>

                {{-- Data Akun --}}
                <li class="nav-item {{ $menu == 'akun' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
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

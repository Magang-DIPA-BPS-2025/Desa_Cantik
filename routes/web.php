<?php
use App\Http\Controllers\HomeController;
use App\Models\Berita;
use App\Http\Controllers\TTSController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PemerintahDesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApbdController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\SktmController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\SejarahDesaController;
use App\Http\Controllers\PermohonanInformasiController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\BelanjaDesaController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\sKematianController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\Landing\ApbdDesaController;
use App\Models\Agenda;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;



//
// ===================== USER ROUTES ===================== //


Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers\User'],
    function () {
        // Redirect root
        Route::redirect('/', '/');

        //home 
        Route::get('/', [HomeController::class, 'userBeranda'])->name('home');
    
       
        // Galeri Desa (static view)
        Route::get('/galeri', [GaleriController::class, 'userIndex'])->name('galeri.user.index');

        // Sejarah Desa (dynamic view)
        Route::get('/sejarah', [SejarahDesaController::class, 'userIndex'])->name('SejarahDesa');

        // Pemerintah Desa (dynamic view)
        Route::get('/pemerintah', [PemerintahDesaController::class, 'userIndex'])->name('pemerintah');

        // APBD Desa (single data view)
        Route::get('/apbd', [ApbdController::class, 'show'])->name('apbd');
        Route::get('/apbd-desa/{year}', [ApbdController::class, 'getByYear']);

        // APBD Desa (list view)
        Route::get('/apbd-list', [ApbdController::class, 'userIndex'])->name('apbd.list');

        Route::get('/berita', [BeritaController::class, 'userIndex'])->name('berita');
        Route::get('/berita/{id}', [BeritaController::class, 'userShow'])->name('berita.show');
        Route::get('/detail/{jenis}/{id}', [UserController::class, 'detail'])->name('user.detail.berita');

        //Agenda Desa (dynamic view)
        Route::get('/agenda', [AgendaController::class, 'userIndex'])->name('agenda');
        Route::get('/agenda/{id}', [AgendaController::class, 'userShow'])->name('agenda.show');

        //Jumlah Penduduk (static view)
        Route::get('/statistik-penduduk', [DataPendudukController::class, 'statistik'])->name('statistik.penduduk');

        //Data Pendidikan (dynamic view)
        Route::get('/pendidikan', [DataPendudukController::class, 'statistikPendidikan'])->name('pendidikan');

        //Data Pekerjaan (dynamic view)
        Route::get('/pekerjaan', [DataPendudukController::class, 'statistikPekerjaan'])->name('pekerjaan');

        //Data Agama (dynamic view)
        Route::get('/agama', [DataPendudukController::class, 'statistikAgama'])->name('agama');
        // Halaman form pengajuan umum
    


        Route::get('/status', [SuratController::class, 'userStatus'])->name('status');



        // Pengajuan surat berdasarkan jenis
        Route::post('/izin', [IzinController::class, 'store'])->name('izin.store');


        //Status Surat (by NIK) & view approved letter
        Route::get('/pengantar', [SuratController::class, 'userIndex'])->name('pengantar');
        Route::post('/pengantar', [SkuController::class, 'userStore'])->name('pengantar.store');


        Route::get('/verifikasi-surat/{id}', [SkuController::class, 'verifikasiSurat'])->name('verifikasi.surat');
        Route::get('/verifikasi-surat-sktm/{id}', [SktmController::class, 'verifikasiSurat'])->name('verifikasi.surat.sktm');
        Route::get('/verifikasi-surat-kematian/{id}', [sKematianController::class, 'verifikasiSurat'])->name('verifikasi.surat.kematian');
         Route::get('/verifikasi-surat-izin/{id}', [IzinController::class, 'verifikasiSurat'])->name('verifikasi.surat.izin');


        //Pengaduan (dynamic view)
        Route::get('/pengaduan', [PengaduanController::class, 'userIndex'])->name('pengaduan');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
        Route::get('/status-pengaduan', [PengaduanController::class, 'userStatus'])->name('pengaduan.userStatus');

        //Surat Pengaduan (dynamic view)
        Route::get('/statuspengaduan', [PengaduanController::class, 'userStatus'])->name('statuspengaduan');
        Route::post('/pengantar/sku', [SkuController::class, 'store'])->name('pengantar.sku.store');


        //Penyandang (static view)
        Route::get('/penyandang', function () {
            return view('pages.landing.layananonline.PenyandangDisabilitas');
        })->name('penyandang');

        //PPID & Belanja Desa
        Route::get('/ppid', [App\Http\Controllers\PPIDController::class, 'userindex'])
            ->name('ppid');
        Route::get('/ppid/status-permohonan', [App\Http\Controllers\PermohonanInformasiController::class, 'userStatus'])
            ->name('permohonan.userStatus');

        // routes/web.php
        Route::get('/ppid/dasar-hukum', function () {
            return view('pages.landing.PPID&UMKM.dasar-hukum');
        })->name('ppid.dasar-hukum');

        // Informasi Secara Berkala
        Route::get('/ppid/berkala', [App\Http\Controllers\PPIDController::class, 'berkala'])->name('ppid.berkala');

        // Informasi Serta Merta
        Route::get('/ppid/serta', [PPIDController::class, 'serta'])->name('ppid.serta');

        // Informasi Setiap Saat
        Route::get('/ppid/setiap', [PPIDController::class, 'setiap'])->name('ppid.setiap');

        Route::get('/permohonan-informasi', [PermohonanInformasiController::class, 'create'])->name('userindex');
        Route::post('/permohonan-informasi', [PermohonanInformasiController::class, 'store'])->name('permohonan.store');

        Route::get('/belanja', [BelanjaDesaController::class, 'userIndex'])->name('belanja');
        Route::get('/belanja/{id}', [BelanjaDesaController::class, 'userShow'])->name('belanja.usershow');
        Route::post('/belanja/{id}/rating', [BelanjaDesaController::class, 'storeRating'])->name('belanja.rating');

        Route::get('/bukutamu', [BukuTamuController::class, 'index'])->name('bukutamu');
        Route::post('/bukutamu', [BukuTamuController::class, 'store'])->name('bukutamu.store');


    }
);


//
// ===================== ADMIN ROUTES ===================== //
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers', 'middleware' => 'ValidasiUser'],
    function () {

        Route::redirect('/admin', 'dashboard/');

        Route::prefix('dashboard')->group(function () {

            // Dashboard
            Route::get('/', 'AdminController@index')->name('dashboard');
            Route::get('/jadwalKegiatan', 'AdminController@jadwal')->name('dashboard.jadwal');
            Route::get('/jadwalKegiatan/{nik}', 'AdminController@getJadwalByPegawai')->name('dashboard.jadwal.getByPegawai');

            Route::get('/kalender/data', [App\Http\Controllers\KalenderController::class, 'getKalenderData'])->name('kalender.data');


            Route::prefix('kalender')->group(function () {
                Route::get('/', [KalenderController::class, 'index'])->name('kalender.index');
                Route::post('/', [KalenderController::class, 'store'])->name('kalender.store');
                Route::get('/create', [KalenderController::class, 'create'])->name('kalenderDesa.create');
                Route::get('/{id}/edit', [KalenderController::class, 'edit'])->name('kalender.edit');
                Route::get('/events', [KalenderController::class, 'getEvents'])->name('kalender.events');
                Route::put('/{id}', [KalenderController::class, 'update'])->name('kalender.update');
                Route::delete('/{id}', [KalenderController::class, 'destroy'])->name('kalender.destroy');
            });

            Route::get('/getByKegiatan', 'AdminController@getByKegiatan')->name('dashboard.jadwal.getByKegiatan')->withoutMiddleware(['ValidasiUser']);
            Route::get('/getByKegiatanUser', 'AdminController@getByKegiatanUser')->name('dashboard.jadwal.getByKegiatanUser')->withoutMiddleware(['ValidasiUser']);

            // Profile
            Route::get('/profile/{id}', 'AdminController@profile')->name('profile.index');
            Route::put('/profile/update', 'AdminController@profile_update')->name('profile.update');

            // Data Penduduk
            Route::prefix('dataPenduduk')->group(function () {
                Route::get('/', 'DataPendudukController@index')->name('dataPenduduk.index');
                Route::get('/create', 'DataPendudukController@create')->name('dataPenduduk.create');
                Route::post('/store', 'DataPendudukController@store')->name('dataPenduduk.store');
                Route::get('/edit/{nik}', 'DataPendudukController@edit')->name('dataPenduduk.edit');
                Route::put('/update/{nik}', 'DataPendudukController@update')->name('dataPenduduk.update');
                Route::delete('/destroy/{nik}', 'DataPendudukController@destroy')->name('dataPenduduk.destroy');
            });

            // Akun
            Route::prefix('akun')->group(function () {
                Route::get('/', 'AkunController@index')->name('akun.index');
                Route::get('/create', 'AkunController@create')->name('akun.create');
                Route::post('/store', 'AkunController@store')->name('akun.store');
                Route::post('/regis', 'AkunController@regis')->name('akun.regis');
                Route::get('/edit/{id}', 'AkunController@edit')->name('akun.edit');
                Route::put('/update', 'AkunController@update')->name('akun.update');
                Route::post('/hapus/{id}', 'AkunController@destroy')->name('akun.hapus');
            });

            Route::prefix('agenda')->group(function () {
                Route::get('/', 'AgendaController@index')->name('agenda.index');
                Route::get('/create', 'AgendaController@create')->name('agenda.create');
                Route::post('/store', 'AgendaController@store')->name('agenda.store');
                Route::get('/edit/{id}', 'AgendaController@edit')->name('agenda.edit');
                Route::put('/update', 'AgendaController@update')->name('agenda.update');
                Route::post('/hapus/{id}', 'AgendaController@destroy')->name('agenda.hapus');
            });

            // Galeri Desa
            Route::prefix('galeriDesa')->group(function () {
                Route::get('/', 'GaleriController@index')->name('galeriDesa.index');
                Route::get('/create', 'GaleriController@create')->name('galeriDesa.create');
                Route::post('/store', 'GaleriController@store')->name('galeriDesa.store');
                Route::get('/edit/{id}', 'GaleriController@edit')->name('galeriDesa.edit');
                Route::put('/update/{id}', 'GaleriController@update')->name('galeriDesa.update');
                Route::delete('/delete/{id}', 'GaleriController@destroy')->name('galeriDesa.destroy');
            });

            Route::prefix('admin')->group(function () {
                Route::get('/permohonan', [PermohonanInformasiController::class, 'index'])->name('permohonan.index');
                Route::get('/permohonan/{id}/edit', [PermohonanInformasiController::class, 'edit'])->name('permohonan.edit');
                Route::put('/permohonan/{id}', [PermohonanInformasiController::class, 'update'])->name('permohonan.update');
                Route::put('/permohonan/{id}/status', [PermohonanInformasiController::class, 'updateStatus'])->name('permohonan.updateStatus');
                Route::delete('/permohonan/{id}', [PermohonanInformasiController::class, 'destroy'])->name('permohonan.destroy');
            });


            // routes/web.php
            Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
                ->name('admin.dashboard');

            Route::prefix('admin')->group(function () {
                Route::get('/buku-tamu', [BukuTamuController::class, 'adminIndex'])->name('admin.buku.index');
                Route::get('/buku-tamu/{id}/edit', [BukuTamuController::class, 'edit'])->name('admin.buku.edit');
                Route::put('/buku-tamu/{id}', [BukuTamuController::class, 'update'])->name('admin.buku.update');
                Route::delete('/buku-tamu/{id}', [BukuTamuController::class, 'destroy'])->name('admin.buku.destroy');
            });

            Route::resource('pemerintah-desa', PemerintahDesaController::class);

            Route::resource('apbd', ApbdController::class);


            Route::resource('AgendaDesa', AgendaController::class);
            Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
            Route::get('/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
            Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
            Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('admin.berita.show');
            Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
            Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('admin.berita.update');
            Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

            Route::resource('kategori', KategoriController::class);

            Route::resource('pengaduan', PengaduanController::class);

            Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
            // Route admin SKU
            Route::middleware(['ValidasiUser'])->group(function () {
                // Resource route untuk CRUD dasar
                Route::resource('admin/sku', SkuController::class)->names([
                    'index' => 'sku.index',
                    'show' => 'sku.show',
                    'edit' => 'sku.edit',
                    'update' => 'sku.update',
                    'destroy' => 'sku.destroy'
                ]);

                // Custom routes untuk verifikasi dan cetak
                Route::get('admin/sku/{id}/verifikasi', [SkuController::class, 'verifikasi'])->name('sku.verifikasi');
                Route::get('admin/sku/{id}/cetak', [SkuController::class, 'cetak'])->name('sku.cetak');
            });

            // Routes SKTM
            Route::resource('admin/sktm', SktmController::class)->names([
                'index' => 'sktm.index',
                'create' => 'sktm.create',
                'store' => 'sktm.store',
                'show' => 'sktm.show',
                'edit' => 'sktm.edit',
                'update' => 'sktm.update',
                'destroy' => 'sktm.destroy',
            ]);

            Route::get('/sktm/verifikasi/{id}', [SktmController::class, 'verifikasi'])->name('sktm.verifikasi');
            Route::get('/sktm/cetak/{id}', [SktmController::class, 'cetak'])->name('sktm.cetak');


            Route::resource('admin/kematian', sKematianController::class);


            Route::get('/kematian/verifikasi/{id}', [sKematianController::class, 'verifikasi'])->name('kematian.verifikasi');
            Route::get('/kematian/cetak/{id}', [sKematianController::class, 'cetak'])->name('kematian.cetak');



            Route::prefix('admin')->group(function () {
                Route::get('/izin', [IzinController::class, 'index'])->name('izin.index');
                Route::get('/izin/{id}/edit', [IzinController::class, 'edit'])->name('izin.edit');
                Route::put('/izin/{id}', [IzinController::class, 'update'])->name('izin.update');
                Route::delete('/izin/{id}', [IzinController::class, 'destroy'])->name('izin.destroy');
                Route::get('/izin/verifikasi/{id}', [IzinController::class, 'verifikasi'])->name('izin.verifikasi');
                Route::get('/izin/cetak/{id}', [IzinController::class, 'cetak'])->name('izin.cetak');
            });




            Route::resource('ppid', PPIDController::class);

            // routes/web.php
            Route::prefix('admin')->group(function () {
                Route::get('/belanja', [BelanjaDesaController::class, 'index'])->name('belanja.index');
                Route::get('/belanja/create', [BelanjaDesaController::class, 'create'])->name('belanja.create');
                Route::post('/belanja', [BelanjaDesaController::class, 'store'])->name('belanja.store');
                Route::get('/belanja/{id}/edit', [BelanjaDesaController::class, 'edit'])->name('belanja.edit');
                Route::put('/belanja/{id}', [BelanjaDesaController::class, 'update'])->name('belanja.update');
                Route::delete('/belanja/{id}', [BelanjaDesaController::class, 'destroy'])->name('belanja.destroy');
            });


        });
    }
);

// ===================== AUTH ROUTES ===================== //
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@login_action')->name('login_action');
    Route::get('/logout', function () {
        Session::flush();
        return redirect()->route('home')->with('message', 'sukses logout');
    })->name('logout');
});
@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons-wind.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/fullcalendar/dist/fullcalendar.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            @if (session('role') == 'admin' ||
                    session('role') == 'guru')
                <div class="card">
                    <div class="card-header">
                        <h4>Data Statistik</h4>
                    </div>
                    <div class="card-body">
                        <h4>Filter Ketenagaan <span id="title-chart"></span></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="" class="form-control selectric" id="filterKetenagaan">
                                        <option value="">-- pilih ketenagaan --</option>
                                        <option value="tenagaPendidik">Tenaga Pendidik</option>
                                        <option value="tenagaKependidikan">Tenaga Kependidikan</option>
                                        <option value="stakeholder">Stakeholder</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- tenaga pendidik --}}
                        <div id="tenagaPendidik">

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Guru</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="guruChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Konselor</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="konselorChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Lainnya</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="lainChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        {{-- tenaga kependidik --}}
                        <div id="tenagaKependidikan">

                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Pengawas</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="pengawasChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Kepala Sekolah</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="kepalaSekolahChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Lainnya (Tenaga Kependidikan)</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="lainTenagaKependidikanChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- stakeholder --}}
                        <div id="stakeholder">

                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Stakeholder</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="stakeholderChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Calendar Penugasan Dan Pendamping Lokakarya</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="fc-overflow">
                                <div id="jadwal"></div>
                            </div>

                        </div>

                    </div>
                </div>
            @endif

            @if (session('role') == 'pegawai')
                <div class="card">
                    <div class="card-header">
                        <h4>Calendar Penugasan Dan Pendamping Lokakarya</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="fc-overflow">
                                <div id="jadwal-pegawai"></div>
                            </div>

                        </div>

                    </div>
                </div>
            @endif

            @if (session('role') == 'tenaga pendidik' ||
                    session('role') == 'tenaga kependidikan' ||
                    session('role') == 'stakeholder')
                <div class="card">
                    <div class="card-header">
                        <h4>Cetak biodata anda dari kegiatan yang telah di daftar</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    @if ($datas['kegiatan'] == null)
                                        <div></div>
                                    @else
                                        <select name="kegiatan" class="form-control select2" id="kegiatanSelect">
                                            <option value="">-- pilih kegiatan --</option>
                                            @foreach ($datas['kegiatan']->getKegiatan as $v)
                                                <option value="{{ $v->id }}">{{ $v->nama_kegiatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md">
                                <a id="btnPrint" href="" target="_blank" class="btn btn-primary"><i
                                        class="fas fa-print"></i>
                                    Cetak Biodata</a>
                            </div>

                        </div>

                    </div>
                </div>
            @endif


        </section>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detail Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <p><strong>Penugasan:</strong> <span id="eventTitle"></span></p>
                    {{-- <p><strong>Tipe Penugasan:</strong> <span id="eventType"></span></p> --}}
                    <div id="eventNama"></div> <!-- Nama penugasan akan ditampilkan di sini -->
                    <p><strong>Tanggal Kegiatan:</strong> <span id="eventStart"></span></p>
                    {{-- <p><strong>Deskripsi:</strong></p>
                    <p id="eventDescription"></p> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>




    @push('scripts')
        {{-- <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script> --}}
        <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/id.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
        <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>


        <script>
            $(document).ready(function() {

                // $('.has-dropdown').click(function(e) {
                //     e.preventDefault();
                //     $(this).next('.dropdown-menu').slideToggle();
                // });
                moment.locale('id');
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    type: "GET",
                    url: `dashboard/jadwalKegiatan`,
                    success: function(response) {
                        var data = [];

                        response.jadwal.forEach(element => {
                            var mulai = element.tgl_kegiatan + ' ' + (element.jam_mulai ??
                                '00:00:00');
                            var selesai = element.tgl_selesai_kegiatan + ' ' + (element
                                .jam_selesai ?? '23:59:59');

                            // Generate random color
                            var randomColor = getRandomColor();
                            data.push({
                                title: element.kegiatan,
                                start: moment(mulai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                end: moment(selesai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                backgroundColor: randomColor,
                                textColor: '#fff',
                                penugasan_pegawai: element.penugasan_pegawai,
                                penugasan_ppnpn: element.penugasan_ppnpn,
                                description: element.deskripsi,
                                tgl: `${moment(element.tgl_kegiatan).format('dddd, D MMMM')} s/d ${moment(element.tgl_selesai_kegiatan).format('dddd, D MMMM YYYY')}`,
                                jam: `${element.jam_mulai ?? ''} - ${element.jam_selesai ?? ''} WITA`
                            });
                        });


                });





                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    type: "GET",
                    url: `dashboard/jadwalKegiatan/{{ session('no_ktp') }}`,
                    success: function(response) {
                        var data = [];
                        console.log(response);

                        response.jadwal.forEach(element => {
                            var mulai = element.tgl_kegiatan + ' ' + (element.jam_mulai ??
                                '00:00:00');
                            var selesai = element.tgl_selesai_kegiatan + ' ' + (element
                                .jam_selesai ?? '23:59:59');
                            // Generate random color
                            var randomColor = getRandomColor();

                            data.push({
                                title: `${element.kegiatan == '' || element.kegiatan == undefined ? element.jenis : element.kegiatan}`,
                                start: moment(mulai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                end: moment(selesai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                backgroundColor: randomColor,
                                textColor: '#fff',
                                nama: element.nama,
                                jenis: element.jenis ?? '',
                                description: element.deskripsi,
                                tgl: `${moment(element.tgl_kegiatan).format('dddd, D MMMM')} s/d ${moment(element.tgl_selesai_kegiatan).format(' D MMMM YYYY')}`,
                                jam: `${element.jam_mulai ?? ''} - ${element.jam_selesai ?? ''} WITA`,

                            });
                        });



                function stripHtml(html) {
                    var temporalDivElement = document.createElement("div");
                    temporalDivElement.innerHTML = html;
                    return temporalDivElement.textContent || temporalDivElement.innerText || "";
                }

                let tp = $('#tenagaPendidik').hide();
                let tk = $('#tenagaKependidikan').hide();
                let stk = $('#stakeholder').hide();
                let titleChart = $('#title-chart');

                $('#filterKetenagaan').on('change', function() {
                    let val = $(this).find('option:selected').val();

                    if (val == '') {
                        titleChart.text('')
                        tp.hide();
                        tk.hide();
                        stk.hide();
                    } else if (val == 'tenagaPendidik') {
                        titleChart.text('Tenaga Pendidik')

                        tp.show();
                        tk.hide();
                        stk.hide();
                    } else if (val == 'tenagaKependidikan') {
                        tp.hide();
                        titleChart.text('Tenaga Kependidikan')

                        tk.show();
                        stk.hide();
                    } else if (val == 'stakeholder') {
                        titleChart.text('Stakeholder')

                        tp.hide();
                        tk.hide();
                        stk.show();
                    }


                });

                const btnPrint = $('#btnPrint');
                btnPrint.hide();

                $('#kegiatanSelect').change(function() {
                    console.log($(this).val());
                    const val = $(this).val()
                    $.ajax({
                        url: '{{ route('dashboard.jadwal.getByKegiatan') }}', // Ganti dengan route yang sesuai untuk mengambil status
                        type: 'GET',
                        data: {
                            kegiatan_id: val,
                            nik: '{{ session('no_ktp') }}'
                        },
                        success: function(response) {
                            // console.log(response.status);
                            console.log(response.data.id);
                            const idPeserta = response.data.id
                            if (response.status) {
                                var url = '{{ route('peserta.cetak', ['id' => ':id']) }}'
                                url = url.replace(':id', idPeserta)
                                btnPrint.attr({
                                    'href': url
                                });
                                btnPrint.show();
                            } else {
                                btnPrint.hide();
                            }
                        },
                        error: function(error) {
                            console.error(error);
                            alert('Error fetching kegiatan status.');
                        }
                    });
                })




                // Function to generate random color
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            });
        </script>

      
    @endpush
@endsection

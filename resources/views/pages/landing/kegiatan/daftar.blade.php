@extends('layouts.landing.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div id="banner-area" class="banner-area"
        style="background-image:url({{ asset('landing/images/banner/bannerKegiatan.png') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">Daftar Kegiatan {{ $status['kegiatanById']->nama_kegiatan }} </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Kegiatan</li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Kegiatan</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <form action="{{ route('user.kegiatan_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- {{ dd($_GET['kegiatan_id']) }} --}}
                    <input type="hidden" name="kegiatan_id" id="kegiatan_id"
                        value="{{ $_GET['kegiatan_id'] ?? $kegiatan_id }}">
                    <div class="">
                        <div class="card-body">

                            <div class="row">

                                {{-- <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama dan NIK</label>
                                    <input  name="no_ktp" id="no_ktp" type="text"
                                        class="form-control" required>
                                    <select required name="id_pegawai" id="id_pegawai"
                                        class="form-control select2">
                                        <option value="">-- Pilih pegawai --</option>
                                        @foreach ($merge as $v)
                                            <option data-no_ktp="{{ $v->no_ktp }}"
                                                data-nama="{{ $v->nama_lengkap }}"
                                                data-golongan="{{ $v->golongan }}"
                                                data-kabupaten="{{ $v->kabupaten }}"
                                                data-gender="{{ $v->gender }}"
                                                data-jabatan="{{ $v->jabatan ?? $v->status_kepegawaian }}"
                                                data-instansi="{{ $v->instansi }}"
                                                data-wa="{{ $v->no_wa }}"
                                                data-hp="{{ $v->no_hp }}"
                                                data-instansi="{{ $v->instansi }}"
                                                value="{{ $v->id }}">
                                                {{ $v->no_ktp }} - {{ $v->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input name="nama" id="nama" type="nama" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input name="no_ktp" id="no_ktp" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input name="nip" id="nip" type="text" class="form-control" required>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kabupaten / Kota (jika tidak ada, pilih lainnya)</label>
                                        <select name="kabupaten" id="kabupaten" class="form-control select2">
                                            <option id="selectedKab" value="">-- piilih kabupaten --</option>
                                            @foreach ($status['kabupaten'] as $v)
                                                <option value=" {{ $v->name }} ">{{ $v->name }}</option>
                                            @endforeach
                                            <option id="selectedKabLainnya" value="lainnya">Lainnya</option>
                                        </select>
                                        {{-- <input readonly name="kabupaten" id="kabupaten" type="text"
                                        class="form-control" required> --}}
                                    </div>
                                </div>

                                <div class="col-md-4" id="formAsal" style="display: none;">
                                    <div class="form-group">
                                        <label>Asal Kabupaten / Kota</label>
                                        <input  name="asal_kabupaten" id="asal_kabupaten" type="text"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Instansi</label>
                                        <input name="instansi" id="instansi" type="text" class="form-control" required>
                                    </div>
                                </div>




                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jkl" id="gender" class="form-control">
                                            <option value="">-- pilih jenis kelamin --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        {{-- <input name="gender" id="gender" type="text" class="form-control"
                                        required> --}}
                                    </div>
                                </div>
                                @if (session('dataAda'))
                                    {{-- {{ dump(session('dataAda') ) }} --}}



                                    {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Golongan</label>

                                        <select name="golongan" id="" class="form-control select2">
                                        <option value="">-- pilih golongan --</option>
                                        @foreach ($status['golongan'] as $v)
                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                        <input name="golongan" id="golongan" type="text"
                                            class="form-control" required>
                                    </div>
                                </div> --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jenis Golongan</label>
                                            <select required name="jenis_gol" id="jenis_gol" class="form-control ">
                                                <option value="">-- pilih jenis golongan --</option>
                                                <option value="PNS">PNS</option>
                                                <option value="P3K">PPPK/P3K</option>
                                                <option value="Tidak ada golongan">Tidak Ada Golongan</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3" id="form_diluar_gol">
                                        <div class="form-group">
                                            <label>Isi Golongan </label>
                                            <input name="diluar_gol" id="diluar_gol" placeholder="jika tidak ada ketik tanda -" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="form_golongan_pns">
                                        <div class="form-group">
                                            <label>Golongan PNS</label>

                                            <select name="golongan_pns" id="golongan_pns" class="form-control select2">
                                                <option id="valPns" value="">-- pilih golongan --</option>
                                                @foreach ($status['golongan'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input readonly name="golongan_pns" id="golongan_pns" type="text"
                                            class="form-control" required> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="form_golongan_p3k">
                                        <div class="form-group">
                                            <label>Golongan PPPK/P3K</label>

                                            <select name="golongan_p3k" id="golongan_p3k" class="form-control select2">
                                                <option id="valP3K" value="">-- pilih golongan --
                                                </option>
                                                @foreach ($status['golongan_p3k'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input readonly name="golongan_p3k" id="golongan_p3k" type="text"
                                            class="form-control" required> --}}
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jenis Golongan</label>
                                            <select required name="jenis_gol" id="jenis_gol" class="form-control ">
                                                <option value="">-- pilih jenis golongan --</option>
                                                <option value="PNS">PNS</option>
                                                <option value="P3K">PPPK/P3K</option>
                                                <option value="Tidak ada golongan">Tidak Ada Golongan</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3" id="form_diluar_gol">
                                        <div class="form-group">
                                            <label>Isi Golongan </label>
                                            <input name="diluar_gol" id="diluar_gol" placeholder="jika tidak ada ketik tanda -" type="text"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="form_golongan_pns">
                                        <div class="form-group">
                                            <label>Golongan PNS</label>

                                            <select name="golongan_pns" id="golongan_pns" class="form-control select2">
                                                <option id="valPns" value="">-- pilih golongan --
                                                </option>
                                                @foreach ($status['golongan'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input  name="golongan" id="golongan" type="text"
                                        class="form-control" required> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="form_golongan_p3k">
                                        <div class="form-group">
                                            <label>Golongan PPPK/P3K</label>

                                            <select name="golongan_p3k" id="golongan_p3k" class="form-control select2">
                                                <option id="valP3K" value="">-- pilih golongan --
                                                </option>
                                                @foreach ($status['golongan_p3k'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input  name="golongan" id="golongan" type="text"
                                        class="form-control" required> --}}
                                        </div>
                                    </div>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor WhatsApp</label>
                                        <input name="no_wa" id="no_wa" type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Handphone</label>
                                        <input name="no_hp" id="no_hp" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Surat Tugas (CONTOH : **/**/**/**)</label>
                                        <input name="no_surat_tugas" id="no_surat_tugas" type="text"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal Surat Tugas</label>
                                        <input name="tgl_surat_tugas" id="tgl_surat_tugas" type="date"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status Keikutpesertaan</label>
                                        <select required name="status_keikutpesertaan" id="status_keikutpesertaan"
                                            class="form-control">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="peserta">Peserta</option>
                                            <option value="panitia">Panitia</option>
                                            <option value="narasumber">Narasumber</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            {{-- Signature Section --}}
                            <div class="row">
                                <div class="col-md-3">
                                    {{-- Uncomment if using signature --}}
                                    {{-- <div class="form-group">
                                    <label for="signature">Tanda Tangan Digital</label>
                                    <div id="signature-pad" class="signature-pad">
                                        <canvas width="600" height="200"></canvas>
                                    </div>
                                    <input type="hidden" name="signature" id="signature">
                                    <button id="clear" class="btn btn-secondary mt-2">Clear</button>
                                </div> --}}
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit" onclick="submitSignature()">Submit</button>
                            <a href="{{ route('user.kegiatan') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: '{{ route('user.peserta.cekData') }}',
                    type: 'GET',
                    data: {
                        nik: '{{ session('nik') }}'
                    },
                    success: function(response) {
                        console.log('hai :', response.data);
                        console.log(response);
                        let kb = $.trim(response.data.kabupaten);
                        let jenis_gol = $.trim(response.data.jenis_gol);
                        console.log(kb.length);

                        $('#no_ktp').val(response.data.no_ktp);
                        $('#nip').val(response.data.nip);
                        $('#nama').val(response.data.nama ?? response.data.nama_lengkap);
                        $('#jabatan').val(response.data.jabatan);
                        // $('#gender').val(response.data.jkl);
                        $(`#gender option[value="${response.data.jkl ?? response.data.gender}"]`).prop(
                            'selected', true);

                        // change jenis golongan 
                        let gol_pns = $('#form_golongan_pns');
                        let gol_p3k = $('#form_golongan_p3k')
                        let tdk_gol = $('#form_diluar_gol')
                        let gol = ''
                        $(`#jenis_gol option[value="${response.data.jenis_gol}"]`).prop('selected', true);
                        if (jenis_gol == 'PNS') {
                            gol_pns.show();
                            gol = response.data.golongan
                            $('#golongan_pns').append($("<option>")
                                .text(gol)
                                .attr('value', gol)
                                .removeAttr('disabled')
                                .prop('selected', true)
                            );
                            // $(`#jenis_gol option[value="${golongan}"]`).prop('selected', true);
                        } else if (jenis_gol == 'P3K') {
                            gol_p3k.show();
                            gol = response.data.golongan
                            $('#golongan_p3k').append($("<option>")
                                .text(gol)
                                .attr('value', gol)
                                .removeAttr('disabled')
                                .prop('selected', true)
                            );
                        } else if (jenis_gol == 'Tidak ada golongan') {
                            tdk_gol.show();
                            gol = response.data.golongan
                            $('#diluar_gol').val(gol)
                        }

                        // $(`#kabupaten option[value="${response.data.kabupaten}"]`).prop('selected', true);
                        // $('#kabupaten').select2();
                        // $('#kabupaten').val(kb).trigger('change');
                        let selectedKab = $('#kabupaten')

                        selectedKab.append($("<option>")
                            .text(response.data.kabupaten)
                            .attr('value', response.data.kabupaten)
                            .removeAttr('disabled')
                            .prop('selected', true)
                        );
                        console.log(selectedKab);
                        // console.log('Selected value:', $('#kabupaten').val());

                        // $('#kabupaten').val(kb);

                        $('#golongan').val(response.data.golongan);
                        $('#jenis_gol').val(response.data.jenis_gol);
                        $('#instansi').val(response.data.instansi ?? response.instansi);
                        $('#no_hp').val(response.data.no_hp);
                        $('#no_wa').val(response.data.no_wa);
                        // $('#no_surat_tugas').val(response.data.no_surat_tugas);
                        // $('#tgl_surat_tugas').val(response.data.tgl_surat_tugas);

                        // console.log($('#no_wa').val(response.data.no_wa));

                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error fetching detail.');
                    }
                });


                $('.select2').select2();
                $('#formOpsional').hide();
                $('#narasumberTime').hide();

                // Handle change event for Kabupaten selection
                $('#kabupaten').change(function() {
                    let selectedValue = $(this).val();
                    if (selectedValue === 'lainnya') {
                        $('#formAsal').show(); // Show the input for manual entry
                    } else {
                        $('#formAsal').hide(); // Hide the input
                        $('#asal_kabupaten').val(''); // Clear the input value if not needed
                    }
                });



                $('#status_keikutpesertaan').change(function() {
                    let status = $(this).val();
                    if (status === 'peserta') {
                        $('#formOpsional').show();
                    } else if (status === 'panitia') {
                        $('#formOpsional').hide();
                    } else if (status === 'narasumber') {
                        $('#formOpsional').hide();

                    } else {
                        $('#formOpsional').hide();
                    }
                });


                // change jenis golongan 
                let gol_pns = $('#form_golongan_pns');
                let gol_p3k = $('#form_golongan_p3k')
                let tdk_gol = $('#form_diluar_gol')

                $('#form_diluar_gol').hide();
                $('#form_golongan_pns').hide();
                $('#form_golongan_p3k').hide();

                let valPns = $('#valPns');
                let valP3K = $('#valP3K')

                $('#jenis_gol').change(function() {
                    let status = $(this).val();
                    console.log(status);
                    if (status == 'PNS') {
                        gol_pns.show();
                        gol_p3k.hide().val('');
                        tdk_gol.hide().val('');
                    } else if (status == 'P3K') {
                        gol_p3k.show();
                        gol_pns.hide().val('');
                        tdk_gol.hide().val('');
                    } else if (status == 'Tidak ada golongan') {
                        gol_pns.hide().val('');
                        gol_p3k.hide().val('');
                        tdk_gol.show();
                    } else {
                        gol_pns.hide().val('');
                        gol_p3k.hide().val('');
                        tdk_gol.hide();
                    }



                });

                $('#id_pegawai').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    // console.log(selectedOption);
                    var jabatan = selectedOption.data('jabatan');
                    var nama = selectedOption.data('nama');
                    var no_ktp = selectedOption.data('no_ktp');
                    var nip = selectedOption.data('nip');
                    var kabupaten = selectedOption.data('kabupaten');
                    var golongan = selectedOption.data('golongan');
                    var jenis_gol = selectedOption.data('jenis_gol');
                    var gender = selectedOption.data('gender');
                    var instansi = selectedOption.data('instansi');
                    var no_hp = selectedOption.data('hp');
                    var no_wa = selectedOption.data('wa');
                    // console.log(kabupaten);

                    // Isi input form dengan data yang sesuai
                    console.log(gender);
                    $('#no_ktp').val(no_ktp);
                    $('#nip').val(nip);
                    $('#nama').val(`${nama}`);
                    $('#jabatan').val(jabatan);
                    $(`#gender option[value="${gender}"]`).attr('selected', 'selected');
                    $('#golongan').val(golongan);
                    $('#jenis_gol').val(jenis_gol);
                    $('#kabupaten').val(kabupaten);
                    $('#instansi').val(instansi);
                    $('#no_hp').val(no_hp);
                    $('#no_wa').val(no_wa);
                });



            });

            const canvas = document.querySelector("canvas");
            const signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function(event) {
                event.preventDefault();
                signaturePad.clear();
            });

            function submitSignature() {
                if (signaturePad.isEmpty()) {
                    alert("Please provide a signature first.");
                } else {
                    const dataUrl = signaturePad.toDataURL();
                    document.getElementById('signature').value = dataUrl;
                }
            }
        </script>
    @endpush
@endsection

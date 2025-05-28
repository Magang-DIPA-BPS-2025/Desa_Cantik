@extends('layouts.app', ['title' => 'Tambah Data Guru'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
        <style>
            :root {
                --primary: #4361ee;
                --primary-light: #eef2ff;
                --secondary: #3f37c9;
                --success: #4cc9f0;
                --warning: #f8961e;
                --danger: #f72585;
                --dark: #212529;
                --light: #f8f9fa;
                --gray: #6c757d;
                --border-radius: 0.5rem;
                --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .teacher-form {
                background-color: white;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-md);
                overflow: hidden;
            }

            .form-header {
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                color: white;
                padding: 1.5rem 2rem;
            }

            .form-header h4 {
                font-weight: 600;
                margin-bottom: 0;
            }

            .form-body {
                padding: 2rem;
            }

            .form-group.row {
                margin-bottom: 1.5rem;
                align-items: center;
            }

            .form-control {
                border-radius: var(--border-radius);
                border: 1px solid #e2e8f0;
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
            }

            .col-form-label {
                font-weight: 500;
                color: var(--dark);
            }

            .btn {
                border-radius: var(--border-radius);
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background-color: var(--primary);
                border-color: var(--primary);
            }

            .btn-primary:hover {
                background-color: var(--secondary);
                border-color: var(--secondary);
            }

            .btn-warning {
                background-color: var(--warning);
                border-color: var(--warning);
                color: white;
            }

            .btn-warning:hover {
                opacity: 0.9;
            }

            .image-preview {
                width: 100%;
                border: 2px dashed #e2e8f0;
                border-radius: var(--border-radius);
                padding: 1.5rem;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .image-preview:hover {
                border-color: var(--primary);
            }

            #image-label {
                display: block;
                font-weight: 500;
                color: var(--gray);
                margin-bottom: 0.5rem;
            }

            .select2-container--default .select2-selection--single {
                height: auto;
                padding: 0.75rem 1rem;
                border: 1px solid #e2e8f0;
                border-radius: var(--border-radius);
            }

            .selectric {
                border-radius: var(--border-radius) !important;
                border: 1px solid #e2e8f0 !important;
            }

            .section-header h1 {
                font-weight: 700;
                color: var(--dark);
            }

            @media (max-width: 768px) {
                .form-body {
                    padding: 1rem;
                }

                .form-group.row {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .col-form-label {
                    margin-bottom: 0.5rem;
                }

                .col-md-7 {
                    width: 100%;
                }
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Guru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('guru.index') }}">Data Guru</a></div>
                    <div class="breadcrumb-item">Tambah Guru</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="teacher-form">
                                <div class="form-header">
                                    <h4><i class="fas fa-user-plus mr-2"></i> Form Tambah Guru</h4>
                                </div>
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Nama Lengkap</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="nama_lengkap" class="form-control"
                                                placeholder="Masukkan nama lengkap">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Email</label>
                                        <div class="col-md-7">
                                            <input required type="email" name="email" class="form-control"
                                                placeholder="contoh@gmail.com">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Nomor KTP</label>
                                        <div class="col-md-7">
                                            <input required type="number" name="no_ktp" class="form-control"
                                                placeholder="Masukkan nomor KTP">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">NIP</label>
                                        <div class="col-md-7">
                                            <input required type="number" name="nip" class="form-control"
                                                placeholder="Masukkan NIP">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tempat Lahir</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="tempat_lahir" class="form-control"
                                                placeholder="Masukkan tempat lahir">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Tanggal Lahir</label>
                                        <div class="col-md-7">
                                            <input required type="date" name="tgl_lahir" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Jenis Kelamin</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="gender" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Agama</label>
                                        <div class="col-md-7">
                                            <select class="form-control selectric" name="agama" required>
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Alamat</label>
                                        <div class="col-md-7">
                                            <textarea required name="alamat_rumah" class="form-control" rows="3"
                                                placeholder="Masukkan alamat lengkap"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Nomor Handphone</label>
                                        <div class="col-md-7">
                                            <input required type="text" name="no_hp" class="form-control"
                                                placeholder="Contoh: 081234567890">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Foto</label>
                                        <div class="col-md-7">
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">
                                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2"
                                                        style="color: var(--primary);"></i>
                                                    <div>Pilih Foto Guru</div>
                                                    <small class="text-muted">Format: JPG, PNG (Maks. 2MB)</small>
                                                </label>
                                                <input required type="file" name="pas_foto" id="image-upload"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-7 offset-md-3 d-flex gap-2">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-save mr-2"></i> Simpan Data
                                            </button>
                                            <a href="{{ route('guru.index') }}" class="btn btn-warning">
                                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
        <script>
            $(document).ready(function () {
                // Preview image upload
                $.uploadPreview({
                    input_field: "#image-upload",
                    preview_box: "#image-preview",
                    label_field: "#image-label",
                    label_default: "Pilih Foto Guru",
                    label_selected: "Ganti Foto",
                    no_label: false,
                    success_callback: null
                });

                // Add modern datepicker
                $('input[type="date"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1900,
                    maxYear: parseInt(moment().format('YYYY'), 10),
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
            });
        </script>
    @endpush
@endsection
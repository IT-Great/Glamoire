<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/detailproduct.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        .list-group-item {
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            transform: scale(1.02);
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .upload__img-box-single,
        .upload__video-box {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .upload__img-box-single,
        .upload__video-box {
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .upload__img-close,
        .upload__video-close {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 2px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-affiliate-admin') }}"
                                            style="text-decoration: none;">Affiliate</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Affiliate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="container">
                        <div class="card">
                            <div class="card-header text-primary">
                                <h4>Detail Informasi Afiliasi</h4>
                                <p class="text-primary-50">Ringkasan dan detail mitra afiliasi</p>
                            </div>
                            <div class="card-body">
                                <!-- Informasi Pribadi -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Informasi Pribadi</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-circle text-primary me-3"
                                                    style="font-size: 24px;"></i>
                                                <div>
                                                    <h6 class="mb-1">Nama Lengkap</h6>
                                                    <p class="text-muted">{{ $partners->fullname }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Kontak -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Informasi Kontak</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-telephone text-primary me-3"
                                                    style="font-size: 24px;"></i>
                                                <div>
                                                    <h6 class="mb-1">Nomor Telepon</h6>
                                                    <p class="text-muted">{{ $partners->handphone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-envelope text-primary me-3"
                                                    style="font-size: 24px;"></i>
                                                <div>
                                                    <h6 class="mb-1">Alamat Email</h6>
                                                    <p class="text-muted">{{ $partners->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Produk -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Informasi Produk</h5>
                                    <div class="mb-3">
                                        <h6 class="mb-1">Kategori Produk</h6>
                                        <p class="text-muted">{{ $partners->category_product }}</p>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Deskripsi</h6>
                                        <p class="text-muted">{{ $partners->description }}</p>
                                    </div>
                                </div>

                                <!-- Dokumen -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Dokumen</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-1">Dokumen Perusahaan</h6>
                                            <div class="p-3 border rounded bg-white">
                                                @if ($partners->fileCompany)
                                                    <a href="{{ asset('storage/' . $partners->fileCompany->file_path) }}"
                                                        class="d-flex align-items-center text-decoration-none">
                                                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                                        <span>{{ $partners->fileCompany->file_name }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-muted"><i
                                                            class="bi bi-exclamation-circle me-2"></i>Belum ada dokumen
                                                        diunggah</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="mb-1">Dokumen BPOM</h6>
                                            <div class="p-3 border rounded bg-white">
                                                @if ($partners->fileBpom)
                                                    <a href="{{ asset('storage/' . $partners->fileBpom->file_path) }}"
                                                        class="d-flex align-items-center text-decoration-none">
                                                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                                        <span>{{ $partners->fileBpom->file_name }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-muted"><i
                                                            class="bi bi-exclamation-circle me-2"></i>Belum ada dokumen
                                                        diunggah</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Status -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Informasi Status</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="mb-1">Status BPOM</h6>
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ $partners->bpom ? 'checked' : '' }} disabled>
                                                <label class="form-check-label me-3">Ya</label>
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ !$partners->bpom ? 'checked' : '' }} disabled>
                                                <label class="form-check-label">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">Sudah Pernah Menghubungi</h6>
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ $partners->reached_email ? 'checked' : '' }} disabled>
                                                <label class="form-check-label me-3">Ya</label>
                                                <input type="radio" class="form-check-input"
                                                    {{ !$partners->reached_email ? 'checked' : '' }} disabled>
                                                <label class="form-check-label">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">Distributor Resmi</h6>
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ $partners->distributor ? 'checked' : '' }} disabled>
                                                <label class="form-check-label me-3">Ya</label>
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ !$partners->distributor ? 'checked' : '' }} disabled>
                                                <label class="form-check-label">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Tanggapan -->
                                <form action="{{ route('send-response-affiliate', $partners->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="response"><strong>Tanggapan Anda: <span
                                                    class="text-danger">*</span></strong></label>
                                        <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" id="response" name="response"
                                            rows="5" placeholder="Tulis tanggapan Anda secara rinci di sini..."></textarea>

                                        @if ($errors->has('response'))
                                            <p style="color: red">{{ $errors->first('response') }}</p>
                                        @else
                                            <small class="text-muted" style="font-size: 14px;">
                                                Harap berikan tanggapan yang komprehensif dan jelas untuk menjawab
                                                pertanyaan pengguna.
                                            </small>
                                        @endif
                                    </div>

                                    <div class="col-12 d-flex justify-content-end mt-4">
                                        <a href="{{ route('index-affiliate-admin') }}"
                                            class="btn btn-secondary btn-sm d-flex align-items-center justify-content-center me-2"
                                            style="font-weight: bold; border-radius: 5px; min-width: 120px;">
                                            <i class="bi bi-box-arrow-in-left me-1"></i> Kembali
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                            id="submitButton"
                                            style="border-radius: 5px; font-weight: bold; min-width: 120px;">
                                            Kirim Tanggapan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ebedf2;
            padding: 15px 25px;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
            margin-bottom: 10px;
        }

        .invoice-header {
            padding: 20px;
            border-bottom: 1px solid #ebedf2;
            background-color: #f8f9fa;
        }

        .invoice-meta-data {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .invoice-meta-item {
            margin-bottom: 10px;
        }

        .amount-box {
            background-color: #f0f7ff;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
        }

        .amount-value {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge {
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 50px;
        }

        .status-paid {
            background-color: #d1f3e0;
            color: #17a85e;
        }

        .status-not-yet {
            background-color: #ffece8;
            color: #ff5c4d;
        }

        .payment-history-item {
            border-left: 3px solid #5d87ff;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .payment-date {
            font-size: 12px;
            color: #6c757d;
        }

        .payment-amount {
            font-weight: 600;
            color: #2c3e50;
        }

        .payment-method-badge {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 50px;
            background-color: #e9ecef;
            color: #495057;
        }

        .payment-method-cash {
            background-color: #fff4de;
            color: #ffa800;
        }

        .payment-method-bank {
            background-color: #e8f4ff;
            color: #0d6efd;
        }

        .invoice-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .invoice-detail-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .deadline-info {
            font-size: 14px;
        }

        .deadline-safe {
            color: #198754;
        }

        .deadline-warning {
            color: #ffc107;
        }

        .deadline-danger {
            color: #dc3545;
        }

        .proof-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .proof-image:hover {
            transform: scale(1.02);
        }

        .detail-section {
            margin-bottom: 20px;
        }

        .detail-label {
            font-weight: 500;
            color: #6c757d;
        }

        .detail-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #e9ecef;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 25px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #5d87ff;
            border: 3px solid #ffffff;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .payment-proof-modal .modal-body {
            padding: 0;
        }

        .payment-proof-modal .modal-content {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .invoice-meta-data {
                flex-direction: column;
            }

            .invoice-actions {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        /* Styling container Select2 */
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        /* Styling rendered text */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px;
            padding-right: 30px;
        }

        /* Styling arrow position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 6px;
        }

        /* Tambahkan styling untuk dropdown options */
        .select-lg-dropdown .select2-results__option {
            padding: 6px 12px;
        }

        /* Hanya berlaku di halaman Edit Invoice Supplier */
        #main a {
            text-decoration: none !important;
        }

        #main a:hover {
            text-decoration: underline;
            /* opsional, kalau mau underline saat hover */
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">

                <div class="page-title mb-2">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Edit Brand</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('index-brand-admin') }}">Brand</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Brand</li>
                                </ol>
                            </nav>
                            <p class="text-subtitle text-muted mt-2">
                                Edit data Brand secara Keseluruhan.
                            </p>

                        </div>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical"
                                            action="{{ route('update-brand-admin', $brand->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- Metode PUT untuk update -->
                                            <div class="form-body">
                                                <div class="row">
                                                    <!-- Kolom Kiri -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="brand-name">Brand Name <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    id="brand-name"
                                                                    value="{{ old('name', $brand->name) }}"
                                                                    name="name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('name'))
                                                                <p style="color: red">{{ $errors->first('name') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Berikan nama yang unik untuk Brand Anda yang akan
                                                                    mudah dikenali oleh pengguna.
                                                                </small>
                                                            @endif

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="brand-description">Description <span
                                                                    style="color: red">*</span></label>
                                                            <textarea class="form-control" id="brand-description" rows="3" name="description">{{ old('description', $brand->description) }}</textarea>
                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Jelaskan apa yang membuat Brand Anda menonjol dan
                                                                    misinya.
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Kolom Kanan -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="card mb-4">
                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0">Brand Logo</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                @if ($brand->brand_logo)
                                                                    <div class="mb-4">
                                                                        <label class="form-label fw-semibold">Logo
                                                                            Saat Ini</label>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <a href="{{ asset('storage/' . $brand->brand_logo) }}"
                                                                                target="_blank">
                                                                                <img src="{{ asset('storage/' . $brand->brand_logo) }}"
                                                                                    alt="Invoice Document"
                                                                                    class="rounded shadow-sm"
                                                                                    style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                            </a>
                                                                            <div>
                                                                                <p class="mb-1 fw-bold">
                                                                                    {{ basename($brand->brand_logo) }}
                                                                                </p>
                                                                                <small class="text-muted">Brand Logo
                                                                                    yang telah diunggah</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <div class="mb-3">
                                                                    <label for="brand_logo"
                                                                        class="form-label fw-semibold">Unggah Brand
                                                                        Logo
                                                                        Baru (Opsional)</label>
                                                                    <div class="border rounded p-4 text-center position-relative {{ $errors->has('brand_logo') ? 'border-danger' : 'border-secondary-subtle' }}"
                                                                        style="background-color: #f9f9f9;">
                                                                        <input type="file" name="brand_logo"
                                                                            id="file-input-invoice"
                                                                            class="form-control d-none file-upload-input"
                                                                            onchange="previewFile(this, 'invoice');"
                                                                            accept="image/*">
                                                                        <label for="file-input-invoice"
                                                                            class="cursor-pointer">
                                                                            <i class="bi bi-cloud-arrow-up"
                                                                                style="font-size: 2.5rem; color: #6c757d;"></i>
                                                                            <p class="mt-2 mb-1 fw-medium">Klik untuk
                                                                                memilih file</p>
                                                                            <small class="text-muted d-block">Format
                                                                                diterima: JPG, PNG, PDF &mdash; Maks.
                                                                                5MB</small>
                                                                        </label>
                                                                    </div>
                                                                    @if ($errors->has('brand_logo'))
                                                                        <div class="text-danger mt-2 small">
                                                                            {{ $errors->first('brand_logo') }}</div>
                                                                    @endif
                                                                </div>

                                                                <div class="file-upload-content mt-3 d-none"
                                                                    id="file-upload-content-invoice">
                                                                    <label class="form-label fw-semibold">Preview
                                                                        Brand Logo Baru</label>
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <a href="#"
                                                                            id="file-preview-link-invoice"
                                                                            target="_blank">
                                                                            <img class="file-upload-image rounded shadow-sm d-none"
                                                                                id="file-upload-image-invoice"
                                                                                src="#" alt="Preview"
                                                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                            <i id="file-upload-icon-invoice"
                                                                                class="bi bi-file-earmark-pdf d-none"
                                                                                style="font-size: 2.5rem;"></i>
                                                                        </a>
                                                                        <div class="flex-grow-1">
                                                                            <div class="fw-bold"
                                                                                id="image-file-name-invoice">Nama File
                                                                            </div>
                                                                            <small class="text-muted">Brand Logo yang akan
                                                                                diunggah</small>
                                                                        </div>
                                                                        <button type="button"
                                                                            onclick="removeUpload('invoice')"
                                                                            class="btn btn-sm btn-outline-danger">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- Submit Button -->
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="reset"
                                                        class="btn btn-sm btn-light-secondary me-3 mb-1">Reset
                                                        Form</button>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary me-1 mb-1">Submit
                                                        Brand</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Formulir -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                @include('admin.layouts.footer')

            </div>
        </div>

        <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        {{-- upload file gambar --}}
        <script>
            function previewFile(input, type) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('file-upload-content-' + type).classList.remove('d-none');
                        document.getElementById('file-upload-image-' + type).src = e.target.result;
                        document.getElementById('file-preview-link-' + type).href = e.target.result;
                        document.getElementById('image-file-name-' + type).innerText = input.files[0].name;
                        if (input.files[0].type === 'application/pdf') {
                            document.getElementById('file-upload-icon-' + type).classList.remove('d-none');
                            document.getElementById('file-upload-image-' + type).classList.add('d-none');
                        } else {
                            document.getElementById('file-upload-icon-' + type).classList.add('d-none');
                            document.getElementById('file-upload-image-' + type).classList.remove('d-none');
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeUpload(type) {
                const fileInput = document.querySelector('#file-input-' + type);
                fileInput.value = '';
                document.getElementById('file-upload-content-' + type).classList.add('d-none');
            }
        </script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
</body>

</html>

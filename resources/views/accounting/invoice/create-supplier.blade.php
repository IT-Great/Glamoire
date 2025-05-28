<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .page-title h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Stats Card Styling */
        .stats-card {
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stats-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .stats-card-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-title {
            font-size: 0.9rem;
            font-weight: 400;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0;
        }



        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .badge.bg-info {
            background-color: var(--info-color) !important;
            color: white;
        }

        .badge.bg-danger {
            background-color: var(--danger-color) !important;
        }

        /* Quick Action Button */
        .quick-action-btn {
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .stats-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .table td {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .product-details {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .d-flex.align-items-center.gap-3 {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .action-buttons .badge {
                display: block;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }


        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            opacity: 0.5;
            margin-bottom: 1.5rem;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .finance-nav {
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .finance-nav-item {
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: #4a4a4a;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid transparent;
        }

        .finance-nav-item i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .finance-nav-item.active {
            background-color: var(--primary-color);
            /* Make sure --primary-color is defined */
            color: #fff;
            border-color: var(--primary-color);
        }

        .finance-nav-item.active i {
            transform: scale(1.2);
            color: #fff;
        }

        .finance-nav-item:hover:not(.active) {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
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

        .upload-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 8px;
            font-weight: 500;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .preview-header {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .preview-icon {
            font-size: 2rem;
            color: #64748b;
        }

        .preview-details {
            flex: 1;
        }

        .preview-filename {
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 250px;
        }

        .preview-meta {
            font-size: 12px;
            color: #64748b;
        }

        .remove-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .remove-button:hover {
            background-color: #fecaca;
        }

        .progress-container {
            height: 4px;
            background-color: #e2e8f0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
            display: none;
        }

        .progress-bar {
            height: 100%;
            background-color: #3b82f6;
            width: 0%;
            transition: width 0.3s ease;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Make design responsive */
        @media (max-width: 640px) {

            .logo-preview,
            .preview-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo-image-container,
            .preview-image-container {
                width: 100%;
                height: 120px;
                margin-bottom: 12px;
            }

            .remove-button {
                margin-top: 12px;
                align-self: flex-end;
            }
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title" style="margin-bottom: 25px;">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Tambahkan Supplier Baru</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                            class="d-flex align-items-center"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('index-supplier') }}"
                                            class="d-flex align-items-center"><i
                                                class="bi bi-person-lines-fill me-2"></i>Supplier</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Supplier Baru</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="finance-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('store-invoice') }}" class="finance-nav-item">
                        <i class="bi bi-receipt"></i>Buat Invoice
                    </a>
                    <a href="{{ route('create-supplier') }}" class="finance-nav-item active">
                        <i class="bi bi-person-lines-fill"></i>Tambahkan Supplier
                    </a>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header bg-white">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div>
                                                <h4 class=" d-flex align-items-center">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Buat Supplier Baru
                                                </h4>
                                                <p class="text-muted">Isi formulir di bawah ini untuk
                                                    membuat supplier baru</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('store-supplier') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">

                                                <div class="row">
                                                    {{-- start kiri --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="name" class="form-label">Nama <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Nama" id="name"
                                                                    name="name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan nama supplier (contoh:
                                                                Helmi, Beni)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="email" class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Email" id="email"
                                                                    name="email">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-envelope"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan email supplier (contoh:
                                                                beni@example.com)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="city" class="form-label">Kota</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Kota" id="city"
                                                                    name="city">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-building"></i>
                                                                </div>
                                                            </div>
                                                            @error('city')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan kota supplier (contoh:
                                                                Surabaya, Sidoarjo)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="post_code" class="form-label">Kode Pos</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('post_code') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Kode Pos" id="post_code"
                                                                    name="post_code">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-mailbox"></i>
                                                                </div>
                                                            </div>
                                                            @error('post_code')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan kode pos supplier
                                                                (contoh: 61124)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="accountnumber" class="form-label">Nomor
                                                                Rekening Perusahaan</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('accountnumber') ? 'is-invalid' : '' }}"
                                                                    placeholder="Contoh: 1234567890"
                                                                    id="accountnumber" name="accountnumber"
                                                                    value="{{ old('accountnumber') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-credit-card"></i>
                                                                </div>
                                                            </div>
                                                            @error('accountnumber')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan nomor rekening bank
                                                                perusahaan (contoh: 1234567890)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="bank_name" class="form-label">Nama
                                                                Bank</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Contoh: BCA, Mandiri, BNI"
                                                                    id="bank_name" name="bank_name"
                                                                    value="{{ old('bank_name') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                            </div>
                                                            @error('bank_name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan nama bank dari nomor
                                                                rekening di atas (contoh: Mandiri, BCA)</small>
                                                        </div>

                                                    </div>

                                                    {{-- start kanan --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="no_telp" class="form-label">No. Telepon <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan No. Telepon" id="no_telp"
                                                                    name="no_telp">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-telephone"></i>
                                                                </div>
                                                            </div>
                                                            @error('no_telp')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan nomor telepon supplier
                                                                (contoh: +62898979****)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="address" class="form-label">Alamat</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Alamat" id="address"
                                                                    name="address">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                </div>
                                                            </div>
                                                            @error('address')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan alamat supplier (contoh:
                                                                Jl. Raya No 112)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="province" class="form-label">Provinsi</label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Provinsi" id="province"
                                                                    name="province">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-geo-alt"></i>
                                                                </div>
                                                            </div>
                                                            @error('province')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <small class="text-muted">Masukkan provinsi supplier
                                                                (contoh: Jawa Timur, Jawa Tengah)</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="description"
                                                                class="form-label">Deskripsi</label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Masukkan deskripsi" id="description" name="description" rows="4"
                                                                    style="height: 100px"></textarea>
                                                                <label for="description">Deskripsi</label>
                                                            </div>
                                                            <small class="text-muted">Masukkan keterangan tambahan
                                                                mengenai supplier ini</small>
                                                        </div>
                                                    </div>


                                                    <div class="col-12 d-flex justify-content-end mt-3">
                                                        <a href="{{ route('index-supplier') }}" type="button"
                                                            class="btn btn-sm btn-light-secondary me-2 d-flex align-items-center">
                                                            <i class="bi bi-arrow-left-circle me-1"></i>
                                                            Kembali
                                                        </a>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary d-flex align-items-center">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            Submit Invoice
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            @include('admin.layouts.footer')

        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                placeholder: 'Pilih Kategori',
                width: '100%',
                dropdownAutoWidth: true
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            @if ($errors->any())
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: 'Error: {{ $errors->first() }}',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            @endif
        });
    </script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-upload-wrap').style.display = 'none';
                    document.getElementById('file-upload-content').style.display = 'block';
                    document.getElementById('file-upload-image').src = e.target.result;
                    document.getElementById('image-file-name').innerText = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeUpload(el, id) {
            const fileInput = document.querySelector('.file-upload-input');
            fileInput.value = '';
            document.getElementById('image-upload-wrap').style.display = 'flex';
            document.getElementById('file-upload-content').style.display = 'none';
        }

        // Calculate PPH based on amount and percentage
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const pphPercentageInput = document.getElementById('pph-percentage');
            const pphInput = document.getElementById('pph');

            function calculatePPH() {
                const amount = parseFloat(amountInput.value) || 0;
                const percentage = parseFloat(pphPercentageInput.value) || 0;
                const pphAmount = (amount * percentage / 100).toFixed(2);
                pphInput.value = pphAmount;
            }

            amountInput.addEventListener('input', calculatePPH);
            pphPercentageInput.addEventListener('input', calculatePPH);
        });
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

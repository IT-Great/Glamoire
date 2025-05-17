<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate - Glamoire</title>

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

        /* Product Card Styling */
        .product-card {
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table> :not(:first-child) {
            border-top: none;
        }

        .table th {
            font-weight: 600;
            color: var(--text-primary);
            background-color: rgba(243, 246, 249, 0.6);
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding: 1.25rem 1.5rem;
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .table>tbody>tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Product Image */
        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        /* Product Details */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .product-meta {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* Message Preview */
        .message-preview {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Stock Badge */
        .stock-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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

        /* Search and Filter Container */
        .search-filter-container {
            margin-bottom: 1.5rem;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-input {
            border-radius: 10px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .filter-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .filter-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
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

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--secondary-color) !important;
            color: white !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--text-secondary);
            font-size: 0.9rem;
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
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading fade-in">
                <div class="container-fluid">
                    <!-- Judul Halaman -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="mb-2">Affiliate Management</h3>
                                <p>Tinjau dan tanggapi semua pengajuan kerja sama</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigasi Breadcrumb -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-affiliate-admin') }}"
                                            class="d-flex align-items-center">
                                            <i class="bi bi-envelope me-1"></i>Affiliate
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Affiliate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <section class="section">
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
                                                            class="bi bi-exclamation-circle me-2"></i>Belum ada
                                                        dokumen
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
                                                            class="bi bi-exclamation-circle me-2"></i>Belum ada
                                                        dokumen
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
        <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Produk - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/product/index.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
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

        .stats-card-danger {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
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
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
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
            <div class="page-heading">
                <div class="page-title mb-4">
                    <!-- Judul Halaman -->
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="page-title d-flex align-items-center">
                                <div>
                                    <h3 class="mb-1">Stok Produk</h3>
                                    <p class="mb-0">Kelola dan pantau stok produk Anda secara akurat untuk memastikan
                                        ketersediaan barang dan kelancaran proses penjualan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigasi Breadcrumb -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-product-admin') }}" class="d-flex align-items-center">
                                            <i class="bi bi-box-seam text-primary me-2"></i>
                                            Produk
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Stok Produk</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row mb-4 slide-in">
                    {{-- Total Produk --}}
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div class="stats-title">Total Produk</div>
                            <h3 class="stats-number">{{ $products->count() }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-cart-fill"></i>
                                    Total semua produk aktif
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Stok Aman --}}
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div class="stats-card stats-card-success">
                            <div class="stats-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="stats-title">Stok Aman</div>
                            <h3 class="stats-number">{{ $products->where('stock_quantity', '>', 10)->count() }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-check2 me-1"></i>
                                    Lebih dari 10 item tersedia
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Stok Rendah --}}
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        @php
                            $lowStockProducts = $products
                                ->where('stock_quantity', '<=', 15)
                                ->where('stock_quantity', '>', 0)
                                ->count();
                            $lowStockVariants = $products
                                ->flatMap(fn($product) => $product->productVariations)
                                ->filter(fn($v) => $v->variant_stock <= 15 && $v->variant_stock > 0)
                                ->count();
                            $totalLowStock = $lowStockProducts + $lowStockVariants;
                        @endphp
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div class="stats-title">Stok Rendah</div>
                            <h3 class="stats-number">{{ $totalLowStock }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-arrow-down me-1"></i>
                                    Kurang dari 15 unit
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Habis Stok --}}
                    <div class="col-12 col-md-3">
                        @php
                            $outOfStockProducts = $products->where('stock_quantity', '=', 0)->count();
                            $outOfStockVariants = $products
                                ->flatMap(fn($product) => $product->productVariations)
                                ->filter(fn($v) => $v->variant_stock == 0)
                                ->count();
                            $totalOutOfStock = $outOfStockProducts + $outOfStockVariants;
                        @endphp
                        <div class="stats-card stats-card-danger">
                            <div class="stats-icon">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                            <div class="stats-title">Habis Stok</div>
                            <h3 class="stats-number">{{ $totalOutOfStock }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    Perlu restock segera
                                </small>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Tab Navigation -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('index-stock-product-admin') }}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('outof-stock-product-admin') }}">Stok Habis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('low-stock-product-admin') }}">Stok Rendah</a>
                    </li>
                </ul>

                <!-- Info Alert -->
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi penting tentang manajemen stok:
                    <ul class="mb-0">
                        {{-- <li><strong>Lokasi:</strong> Pastikan identifikasi lokasi produk dengan tepat.</li> --}}
                        {{-- <li><strong>Batas Stok:</strong> Atur batas stok aman untuk pembaruan tepat waktu.</li>
                        --}}
                        <li><strong>Stok Tersedia:</strong> Jaga jumlah stok yang akurat.</li>
                        <li><strong>Pengaturan Stok:</strong> Sesuaikan pengaturan berdasarkan permintaan produk.</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>

                <!-- Modal Import Product Stocks -->
                <div class="modal fade" id="importProductStockModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-white">
                                <h5 class="modal-title">
                                    <i class="bi bi-upload"></i> Import Product Stocks
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('import.product.stocks') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="product">
                                <div class="modal-body">
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {!! session('error') !!}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="productFile" class="form-label fw-medium">Upload File <span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="productFile" name="file" class="form-control"
                                            accept=".xlsx,.xls,.csv" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-lg"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-upload"></i> Import
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Import Product Variant Stocks -->
                <div class="modal fade" id="importVariantStockModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-white">
                                <h5 class="modal-title">
                                    <i class="bi bi-upload"></i> Import Product Variant Stocks
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('import.product.variants') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="variant">
                                <div class="modal-body">
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {!! session('error') !!}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="variantFile" class="form-label fw-medium">Upload File <span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="variantFile" name="file" class="form-control"
                                            accept=".xlsx,.xls,.csv" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-lg"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-upload"></i> Import
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Product Table -->
                <div class="card stock-card mt-4">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="mb-0">Stock Inventory</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center mt-3 mt-md-0">
                                <div class="d-flex gap-3">
                                    <div class="dropdown">
                                        <button class="btn btn-soft-success d-flex align-items-center" type="button"
                                            id="importDropdown" data-bs-toggle="dropdown">
                                            <i class="bi bi-cloud-upload me-2"></i>
                                            <span class="d-none d-md-inline">Import</span>
                                            <i class="bi bi-chevron-down ms-2"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                            aria-labelledby="importDropdown">
                                            <li class="dropdown-header">Produk Stok</li>
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#importProductStockModal">
                                                    <i class="bi bi-upload me-2 text-success"></i> Import Produk
                                                    Stok
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('download.product.stock.template') }}">
                                                    <i class="bi bi-file-earmark-arrow-down me-2 text-primary"></i>
                                                    Download Import Template
                                                </a>
                                            </li>

                                            <li class="dropdown-divider"></li>
                                            <li class="dropdown-header">Produk Variasi</li>
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#importVariantStockModal">
                                                    <i class="bi bi-upload me-2 text-success"></i> Import Produk
                                                    Variasi Stok
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('download.product.variant.stock.template') }}">
                                                    <i class="bi bi-file-earmark-arrow-down me-2 text-primary"></i>
                                                    Download Variasi Template
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-primary d-flex align-items-center" type="button"
                                            id="exportDropdown" data-bs-toggle="dropdown">
                                            <i class="bi bi-cloud-download me-2"></i>
                                            <span class="d-none d-md-inline">Export</span>
                                            <i class="bi bi-chevron-down ms-2"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                            aria-labelledby="exportDropdown">
                                            <li class="dropdown-header">Export Options</li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('export.product.stocks') }}?type=product">
                                                    <i class="bi bi-file-earmark-spreadsheet me-2 text-primary"></i>
                                                    Export Produk Stok
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('export.product.variants') }}?type=variant">
                                                    <i class="bi bi-file-earmark-spreadsheet me-2 text-primary"></i>
                                                    Export Produk Variasi Stok
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Produk Detail</th>
                                    <th>Total Stok</th>
                                    <th>Detail Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($products as $item)
                                <tr class="product-row">
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                class="product-image"
                                                onclick="openImageInNewTab('{{ Storage::url($item->main_image) }}')">
                                            <div class="product-details">
                                                <span class="product-name">
                                                    {{ Str::limit($item->product_name, 20, '...') }}
                                                </span>
                                                <span class="product-meta">SKU: {{ $item->product_code }}</span>
                                                <span class="product-meta">Category:
                                                    {{ $item->categoryProduct->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->total_stock }}</td>
                                    <td>
                                        @foreach ($item->stocks as $stock)
                                        <div class="stock-batch mb-1">
                                            <span class="badge bg-info">
                                                {{ $stock->quantity }} units
                                            </span>
                                            <span class="text-muted">
                                                Exp:
                                                {{ \Carbon\Carbon::parse($stock->date_expired)->format('d M Y') }}
                                            </span>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($item->isInitialStock() && $item->stock_quantity > 15)
                                        <span
                                            class="badge rounded-pill bg-primary d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>Stock Awal</span>
                                        </span>
                                        @elseif ($item->total_stock > 15)
                                        <span
                                            class="badge rounded-pill bg-success d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>Stock Update</span>
                                        </span>
                                        @elseif ($item->total_stock > 0)
                                        <span
                                            class="badge rounded-pill bg-warning text-dark d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>Low Stock</span>
                                        </span>
                                        @else
                                        <span
                                            class="badge rounded-pill bg-danger text-dark d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-x-circle-fill"></i>
                                            <span>Out of Stock</span>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-primary update-btn d-inline-flex align-items-center"
                                            data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                            data-status="{{ $item->stock_quantity > 15 && $item->total_stock <= 15 ? 'stock_awal' : 'stock_update' }}">
                                            <i class="bi bi-pencil"></i> Update
                                        </button>
                                    </td>
                                </tr>

                                <!-- Product Variants Rows -->
                                @foreach ($item->productVariations as $variant)
                                <tr class="variant-row">
                                    <td class="ps-5">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-details">
                                                <span class="product-name">
                                                    {{ Str::limit($item->product_name, 20, '...') }}

                                                    <span class="variant-indicator">Variant</span>
                                                </span>
                                                <span class="product-meta">
                                                    {{ $variant->variant_type }}:
                                                    {{ $variant->variant_value }}
                                                </span>
                                                <span class="product-meta">SKU: {{ $variant->sku }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $variant->variant_stock ?? 0 }}</td>
                                    <td>
                                        @foreach ($variant->stocks as $stock)
                                        <div class="stock-batch mb-1">
                                            <span class="badge bg-info">
                                                {{ $stock->quantity }} units
                                            </span>
                                            <span class="text-muted">
                                                Exp:
                                                {{ \Carbon\Carbon::parse($stock->date_expired)->format('d M Y') }}
                                            </span>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                        $variantStockInitial = $variant->variant_stock ?? 0;
                                        $variantTotalStock = $variant->stocks->sum('quantity');
                                        @endphp
                                        @if ($variantStockInitial > 15 && $variantTotalStock == 0)
                                        <span
                                            class="badge rounded-pill bg-primary d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>Stock Awal</span>
                                        </span>
                                        @elseif ($variantStockInitial + $variantTotalStock > 15)
                                        <span
                                            class="badge rounded-pill bg-success d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>Stock Update</span>
                                        </span>
                                        @elseif ($variantStockInitial > 0 || $variantTotalStock > 0)
                                        <span
                                            class="badge rounded-pill bg-warning text-dark d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>Low Stock </span>
                                        </span>
                                        @else
                                        <span
                                            class="badge rounded-pill bg-danger text-dark d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-x-circle-fill"></i>
                                            <span>Out of Stock</span>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-primary update-btn d-inline-flex align-items-center"
                                            data-id="{{ $item->id }}" data-variant-id="{{ $variant->id }}"
                                            data-name="{{ $item->product_name }}"
                                            data-status="{{ $item->isInitialStock() ? 'stock_awal' : 'stock_update' }}">
                                            <i class="bi bi-pencil"></i> Update
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody> --}}
                            <tbody id="variant-table-body">
                                @foreach ($products as $item)
                                    <tr class="product-row">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                    class="product-image"
                                                    onclick="openImageInNewTab('{{ Storage::url($item->main_image) }}')">
                                                <div class="product-details">
                                                    <span class="product-name">
                                                        {{ Str::limit($item->product_name, 20, '...') }}
                                                    </span>
                                                    <span class="product-meta">SKU: {{ $item->product_code }}</span>
                                                    <span class="product-meta">Category:
                                                        {{ $item->categoryProduct->name }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ $item->stock_quantity }}</td>

                                        <td>
                                            @php
                                                $allStocks = collect();

                                                // Hitung total history update
                                                // $totalUpdateStock = $item->stocks ? $item->stocks->sum('quantity') : 0;
                                                
                                                // Hitung HANYA stok update untuk produk utama (mengabaikan variasi)
                                                $totalUpdateStock = $item->stocks ? $item->stocks->filter(function ($q) {
                                                    return is_null($q->variation_id) || $q->variation_id == 0;
                                                })->sum('quantity') : 0;

                                                // RUMUS: Sisa Stok Awal = Total Stok Saat Ini - Total Update
                                                $initialStockQty = $item->stock_quantity - $totalUpdateStock;

                                                // 1. Masukkan Stok Awal (Hanya jika sisa stok awal > 0)
                                                if ($initialStockQty > 0 && !empty($item->date_expired)) {
                                                    $allStocks->push([
                                                        'quantity' => $initialStockQty,
                                                        'date_expired' => $item->date_expired,
                                                        'label' => 'Stok Awal'
                                                    ]);
                                                }

                                                // 2. Masukkan Data Stok Update dari tabel product_stocks
                                                if ($item->stocks) {
                                                    foreach ($item->stocks as $st) {
                                                        if ($st->quantity > 0 && !empty($st->date_expired)) {
                                                            $allStocks->push([
                                                                'quantity' => $st->quantity,
                                                                'date_expired' => $st->date_expired,
                                                                'label' => 'Update'
                                                            ]);
                                                        }
                                                    }
                                                }

                                                // 3. Urutkan dari tanggal kadaluarsa terdekat (asc)
                                                $sortedStocks = $allStocks->sortBy(function ($s) {
                                                    return \Carbon\Carbon::parse($s['date_expired'])->timestamp;
                                                });
                                            @endphp

                                            <div class="d-flex flex-column gap-1">
                                                @forelse ($sortedStocks as $stock)
                                                    <div class="stock-batch mb-1 d-flex align-items-center gap-2">
                                                        <span
                                                            class="badge {{ $stock['label'] == 'Stok Awal' ? 'bg-primary' : 'bg-info' }}"
                                                            style="min-width: 65px;">
                                                            {{ $stock['quantity'] }} units
                                                        </span>
                                                        <span class="text-muted" style="font-size: 0.85rem;">
                                                            Exp: <span
                                                                class="{{ \Carbon\Carbon::parse($stock['date_expired'])->isPast() ? 'text-danger fw-bold' : '' }}">{{ \Carbon\Carbon::parse($stock['date_expired'])->format('d M Y') }}</span>
                                                            <small
                                                                style="font-size: 0.7rem; opacity: 0.7;">({{ $stock['label'] }})</small>
                                                        </span>
                                                    </div>
                                                @empty
                                                    <span class="badge bg-danger">Habis</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->isInitialStock() && $item->stock_quantity > 15)
                                                <span
                                                    class="badge rounded-pill bg-primary d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>Stock Awal</span>
                                                </span>
                                            @elseif ($item->stock_quantity > 15)
                                                <span
                                                    class="badge rounded-pill bg-success d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>Stock Update</span>
                                                </span>
                                            @elseif ($item->stock_quantity > 0)
                                                <span
                                                    class="badge rounded-pill bg-warning text-dark d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-exclamation-circle-fill"></i>
                                                    <span>Low Stock</span>
                                                </span>
                                            @else
                                                <span
                                                    class="badge rounded-pill bg-danger text-dark d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                    <span>Out of Stock</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-primary update-btn d-inline-flex align-items-center"
                                                data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                                data-status="{{ $item->stock_quantity > 15 && $item->isInitialStock() ? 'stock_awal' : 'stock_update' }}">
                                                <i class="bi bi-pencil"></i> Update
                                            </button>
                                        </td>
                                    </tr>

                                    @foreach ($item->productVariations as $variant)
                                        <tr class="variant-row">
                                            <td class="ps-5">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="product-details">
                                                        <span class="product-name">
                                                            {{ Str::limit($item->product_name, 20, '...') }}
                                                            <span class="variant-indicator">Variant</span>
                                                        </span>
                                                        <span class="product-meta">
                                                            {{ $variant->variant_type }}: {{ $variant->variant_value }}
                                                        </span>
                                                        <span class="product-meta">SKU: {{ $variant->sku }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $variant->variant_stock ?? 0 }}</td>

                                            <td>
                                                @php
                                                    $allVariantStocks = collect();
                                                    $variantTotalCurrentStock = $variant->variant_stock ?? 0;

                                                    // Hitung total history update varian
                                                    $variantTotalUpdateStock = $variant->stocks ? $variant->stocks->sum('quantity') : 0;

                                                    // RUMUS: Sisa Stok Awal Varian = Total Stok Saat Ini - Total Update
                                                    $variantInitialStockQty = $variantTotalCurrentStock - $variantTotalUpdateStock;

                                                    // 1. Masukkan Stok Awal Varian (Hanya jika sisa stok > 0)
                                                    if ($variantInitialStockQty > 0 && !empty($variant->variant_expired)) {
                                                        $allVariantStocks->push([
                                                            'quantity' => $variantInitialStockQty,
                                                            'date_expired' => $variant->variant_expired,
                                                            'label' => 'Stok Awal'
                                                        ]);
                                                    }

                                                    // 2. Masukkan Stok Update Varian
                                                    if ($variant->stocks) {
                                                        foreach ($variant->stocks as $st) {
                                                            if ($st->quantity > 0 && !empty($st->date_expired)) {
                                                                $allVariantStocks->push([
                                                                    'quantity' => $st->quantity,
                                                                    'date_expired' => $st->date_expired,
                                                                    'label' => 'Update'
                                                                ]);
                                                            }
                                                        }
                                                    }

                                                    // 3. Urutkan berdasarkan tanggal terdekat
                                                    $sortedVariantStocks = $allVariantStocks->sortBy(function ($s) {
                                                        return \Carbon\Carbon::parse($s['date_expired'])->timestamp;
                                                    });
                                                @endphp

                                                <div class="d-flex flex-column gap-1">
                                                    @forelse ($sortedVariantStocks as $stock)
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <span
                                                                class="badge {{ $stock['label'] == 'Stok Awal' ? 'bg-primary' : 'bg-info' }}"
                                                                style="min-width: 65px;">
                                                                {{ $stock['quantity'] }} units
                                                            </span>
                                                            <span class="text-muted" style="font-size: 0.85rem;">
                                                                Exp: <span
                                                                    class="{{ \Carbon\Carbon::parse($stock['date_expired'])->isPast() ? 'text-danger fw-bold' : '' }}">{{ \Carbon\Carbon::parse($stock['date_expired'])->format('d M Y') }}</span>
                                                                <small
                                                                    style="font-size: 0.7rem; opacity: 0.7;">({{ $stock['label'] }})</small>
                                                            </span>
                                                        </div>
                                                    @empty
                                                        <span class="badge bg-danger">Habis</span>
                                                    @endforelse
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $variantStockTotal = $variant->variant_stock ?? 0;
                                                    $isVariantInitial = $variant->stocks->count() === 0;
                                                @endphp

                                                @if ($isVariantInitial && $variantStockTotal > 15)
                                                    <span
                                                        class="badge rounded-pill bg-primary d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Stock Awal</span>
                                                    </span>
                                                @elseif ($variantStockTotal > 15)
                                                    <span
                                                        class="badge rounded-pill bg-success d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Stock Update</span>
                                                    </span>
                                                @elseif ($variantStockTotal > 0)
                                                    <span
                                                        class="badge rounded-pill bg-warning text-dark d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-exclamation-circle-fill"></i>
                                                        <span>Low Stock </span>
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill bg-danger text-dark d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                        <span>Out of Stock</span>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-sm btn-primary update-btn d-inline-flex align-items-center"
                                                    data-id="{{ $item->id }}" data-variant-id="{{ $variant->id }}"
                                                    data-name="{{ $item->product_name }}"
                                                    data-status="{{ $isVariantInitial && $variantStockTotal > 15 ? 'stock_awal' : 'stock_update' }}">
                                                    <i class="bi bi-pencil"></i> Update
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>

        {{-- update modal yang sesuai --}}
        <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title">
                            <i class="bi bi-pencil-square"></i> Update Stok Produk
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="updateStockForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="product_id" name="product_id">
                            <input type="hidden" id="variant_id" name="variant_id">

                            <!-- Informasi Produk -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" readonly>
                            </div>

                            <!-- Tabel Stok Existing -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Update Stok Saat Ini</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jumlah</th>
                                                <th>Tanggal Kadaluarsa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stockDetailTable"></tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Form Tambah Stok Baru -->
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Tambah Stok Baru <span
                                                class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Tanggal Kadaluarsa <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" id="stock_quantity"
                                            name="stock_quantity" required min="1" placeholder="Jumlah stok baru">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="date_expired" name="date_expired"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>

    {{-- fungsi untuk handle update stock product utama dan variant --}}
    {{-- yang digunakan --}}
    <script>
        $(document).ready(function () {
            const updateModal = document.getElementById('updateModal');
            const modal = new bootstrap.Modal(updateModal);

            // Fungsi untuk membuka modal update
            async function openUpdateModal(button) {
                const productId = $(button).data('id');
                const variantId = $(button).data('variant-id');
                const productName = $(button).data('name');
                const stockStatus = $(button).data('status');

                // Reset form
                $('#product_id').val(productId);
                $('#variant_id').val(variantId || '');
                $('#product_name').val(productName);
                $('#stock_quantity').val('');
                $('#date_expired').val('');

                // Tampilkan pesan loading
                $('#stockDetailTable').html('<tr><td colspan="2" class="text-center">Loading...</td></tr>');

                // Tampilkan modal sebelum mengambil data
                modal.show();

                try {
                    let endpoint, isVariant;
                    const stockStatus = $(button).data('status');

                    if (variantId) {
                        endpoint = `/get-variant-stock-details/${variantId}`;
                        isVariant = true;
                    } else {
                        endpoint = `/get-stock-details/${productId}`;
                        isVariant = false;
                    }

                    // Tangani status stok awal
                    const response = await fetch(endpoint);
                    const data = await response.json();
                    const stockData = isVariant ? data.variantStocks : data.mainProduct;

                    if (stockData.length === 0) {
                        // Ini adalah stok awal
                        const message = isVariant ?
                            '<tr><td colspan="2" class="text-center text-primary"><strong>Ini adalah stok awal produk varian. Belum ada update stok produk varian.</strong></td></tr>' :
                            '<tr><td colspan="2" class="text-center text-primary"><strong>Ini adalah stok awal produk. Belum ada update stok product.</strong></td></tr>';

                        $('#stockDetailTable').html(message);
                        return;
                    }

                    // Generate rows berdasarkan data stok
                    let rows = '';
                    stockData.forEach(stock => {
                        rows += `
                <tr>
                    <td>${stock.quantity}</td>
                    <td>${new Date(stock.date_expired).toLocaleDateString('id-ID')}</td>
                </tr>`;
                    });

                    $('#stockDetailTable').html(rows);
                } catch (error) {
                    $('#stockDetailTable').html(
                        '<tr><td colspan="2" class="text-center text-danger">Terjadi kesalahan saat memuat data stok</td></tr>'
                    );
                }
            }

            // Event handler untuk tombol update
            $(document).on('click', '.update-btn', function () {
                openUpdateModal(this);
            });

            // Handle form submission untuk update stok
            $('#updateStockForm').on('submit', async function (e) {
                e.preventDefault();

                const productId = $('#product_id').val();
                const formData = new FormData(this);

                try {
                    const response = await fetch(`/update-stock/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        body: formData,
                    });

                    const result = await response.json();

                    if (response.ok) {
                        modal.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.message,
                            timer: 1500,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat memperbarui stok',
                    });
                }
            });
        });
    </script>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Simple DataTable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);

            // Use event delegation for delete button
            table1.addEventListener('click', function (event) {
                if (event.target.closest('.delete-product')) {
                    let productId = event.target.closest('.delete-product').getAttribute('data-id');

                    // SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send AJAX request to delete product
                            fetch(`/delete-product/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Remove the product from the page
                                        document.querySelector(`#product-item-${productId}`)
                                            .remove();
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            icon: 'success',
                                            timer: 1800, // Auto-close alert after 2 seconds
                                            timerProgressBar: true, // Show progress bar
                                            showConfirmButton: true // Show OK button
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 1800, // Auto-close alert after 2 seconds
                                            timerProgressBar: true, // Show progress bar
                                            showConfirmButton: true // Show OK button
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                }
            });
        });
    </script>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4A69E2', // Mengatur warna tombol OK
                customClass: {
                    icon: 'swal-icon-success'
                },
                timer: 1800, // Mengatur waktu tampilan SweetAlert dalam milidetik (1000 ms = 1 detik)
                timerProgressBar: true, // Menampilkan progress bar timer
                didClose: () => {
                    // Optional: this can be used to trigger any action after the alert is closed
                }
            });
        </script>
    @endif
</body>

</html>
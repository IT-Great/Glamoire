<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            color: #435ebe;
        }

        .breadcrumb-item a {
            color: #435ebe;
            text-decoration: none;
        }

        .main-image-container {
            aspect-ratio: 4/3;
            overflow: hidden;
            border-radius: 0.375rem;
        }

        .main-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .main-image-container img:hover {
            transform: scale(1.05);
        }

        .gallery-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-thumbnail:hover {
            transform: scale(1.1);
        }

        .detail-group {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 500;
        }

        .stats-card {
            background: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .discount-badge {
            background: #fee2e2;
            color: #ef4444;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .product-table img {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            object-fit: cover;
        }

        .product-table td {
            vertical-align: middle;
        }

        .variant-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .color-swatch {
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            vertical-align: middle;
            margin-left: 0.5rem;
        }

        .product-video-container {
            max-width: 640px;
            margin: 0 auto;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-video-container .ratio {
            padding-top: 56.25%;
            position: relative;
        }

        .product-video-container .ratio video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .flatpickr-calendar {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .flatpickr-day.selected {
            background: #3b82f6;
            border-color: #3b82f6;
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
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="page-title">
                                <h3 class="mb-2">Detail Produk</h3>
                                <p>Lihat informasi lengkap mengenai produk yang dipilih pada halaman ini.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-product-admin') }}" class="d-flex align-items-center">
                                            <i class="bi bi-box-seam me-1"></i> Produk
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail Produk</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column - Images -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Tampilan Produk</h5>
                            </div>
                            <div class="card-body">
                                @if (!empty($product->main_image))
                                    <div class="main-image-container mb-3">
                                        <img src="{{ Storage::url($product->main_image) }}"
                                            alt="{{ $product->product_name }}"
                                            onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                    </div>
                                @endif

                                <div class="d-flex gap-2 flex-wrap">
                                    @if (!empty($product->images) && is_array($product->images))
                                        @foreach ($product->images as $image)
                                            <img src="{{ Storage::url($image) }}" alt="Gallery image"
                                                class="gallery-thumbnail"
                                                onclick="openImageInNewTab('{{ Storage::url($image) }}')">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (!empty($product->video))
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Video Produk</h5>
                                </div>
                                <div class="card-body">
                                    <div class="product-video-container">
                                        <div class="ratio">
                                            <video controls>
                                                <source src="{{ Storage::url($product->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Product Info -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Produk</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="bi bi-box me-2"></i>Nama Produk
                                            </div>
                                            <div class="detail-value">{{ $product->product_name }}</div>
                                        </div>

                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="bi bi-upc me-2"></i>Kode Produk
                                            </div>
                                            <div class="detail-value">{{ $product->product_code }}</div>
                                        </div>

                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="bi bi-tag me-2"></i>Kategori
                                            </div>
                                            <div class="detail-value">
                                                {{ $product->categoryProduct ? $product->categoryProduct->name : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="bi bi-building me-2"></i>Brand
                                            </div>
                                            <div class="detail-value">
                                                {{ $product->brand ? $product->brand->name : 'N/A' }}</div>
                                        </div>

                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="bi bi-box me-2"></i>Stok
                                            </div>
                                            <div class="detail-value">{{ $product->stock_quantity }}
                                                {{ $product->unit }}</div>
                                        </div>

                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="bi bi-currency-dollar me-2"></i>Harga
                                            </div>
                                            <div class="detail-value">
                                                <span class="discount-badge">
                                                    Rp. {{ number_format($product->regular_price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
s
                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="detail-group">
                                            <div class="detail-label">Detail Produk</div>
                                            <div class="stats-card">
                                                <div class="row g-3">
                                                    @if ($product->color || $product->color_text)
                                                        <div class="col-md-4">
                                                            <div class="detail-label">Warna</div>
                                                            <div class="detail-value">
                                                                @if ($product->color_text)
                                                                    {{ $product->color_text }}
                                                                @else
                                                                    <span class="color-swatch"
                                                                        style="background-color: {{ $product->color }};"></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-4">
                                                        <div class="detail-label">Berat</div>
                                                        <div class="detail-value">{{ $product->weight_product }}
                                                            gram</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="detail-label">Dimensi</div>
                                                        <div class="detail-value">
                                                            {{ $product->dimensions['length'] ?? 'N/A' }} x
                                                            {{ $product->dimensions['width'] ?? 'N/A' }} x
                                                            {{ $product->dimensions['height'] ?? 'N/A' }} cm
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($product->productVariations->isNotEmpty())
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Produk Variasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table product-table">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Value</th>
                                                    <th>SKU</th>
                                                    <th>Stok</th>
                                                    <th>Price</th>
                                                    <th>Expired</th>
                                                    <th>Weight</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->productVariations as $variant)
                                                    <tr>
                                                        <td>{{ ucfirst($variant->variant_type) }}</td>
                                                        <td>{{ $variant->variant_value }}</td>
                                                        <td>{{ $variant->sku }}</td>
                                                        <td>{{ $variant->variant_stock }}</td>
                                                        <td>{{ $variant->variant_price }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($variant->variant_expired)->format('d M Y') }}
                                                        </td>
                                                        <td>{{ $variant->weight_variant }}</td>
                                                        <td>
                                                            @if ($variant->use_variant_image && $variant->variant_image)
                                                                <img src="{{ Storage::url($variant->variant_image) }}"
                                                                    alt="{{ $variant->variant_value }}"
                                                                    class="variant-thumbnail"
                                                                    onclick="openImageInNewTab('{{ Storage::url($variant->variant_image) }}')">
                                                            @else
                                                                <span class="text-muted">No image</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Tambahan</h5>
                            </div>
                            <div class="card-body">
                                <div class="detail-group">
                                    <div class="detail-label">Deskripsi</div>
                                    <div class="detail-value">{{ $product->description }}</div>
                                </div>
                                <div class="detail-group mb-0">
                                    <div class="detail-label">Informasi Tambahan</div>
                                    <div class="detail-value">{{ $product->information_product }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

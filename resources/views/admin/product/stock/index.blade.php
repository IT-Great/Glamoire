<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Product - Glamoire</title>
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
        .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stock-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stock-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

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

        .stock-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 2px solid #435ebe;
            border-top: none;
            border-left: none;
            border-right: none;
            color: #435ebe;
            font-weight: 600;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #666;
            padding: 0.8rem 1.5rem;
        }

        .form-check-input:checked {
            background-color: #00C853;
            border-color: #00C853;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .product-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .main-product-row {
            background-color: #f7f9fc;
            font-weight: bold;
        }

        .variant-row {
            background-color: #ffffff;
            padding-left: 20px;
        }

        .variant-row td {
            font-size: 0.9rem;
            color: #555;
        }

        .badge-variant {
            background-color: #e3f2fd;
            color: #1e88e5;
            font-weight: 600;
            padding: 0.4rem 0.6rem;
            border-radius: 20px;
        }

        .product-row {
            background-color: #ffffff;
            border-left: 4px solid #435ebe;
            transition: background-color 0.3s ease;
        }


        .product-row:hover {
            background-color: #f8f9fa;
        }

        /* Variant Indicator */
        .variant-indicator {
            background-color: #6c757d;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            margin-left: 8px;
        }

        .stock-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .product-details {
                flex-direction: column;
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
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h2>Stock Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-product-admin') }}">Product</a>
                                    </li>
                                    <li class="breadcrumb-item active">Stock</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats">
                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Products</h6>
                                        <h3 class="mb-0">{{ $products->count() }}</h3>
                                    </div>
                                    <div class="stats-icon purple">
                                        <i class="bi bi-box fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">In Stock</h6>
                                        <h3 class="mb-0">{{ $products->where('stock_quantity', '>', 10)->count() }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-check-circle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Low Stock</h6>
                                        <h3 class="mb-0">
                                            @php
                                                // Menghitung low stock untuk produk utama
                                                $lowStockProducts = $products
                                                    ->where('stock_quantity', '<=', 15)
                                                    ->where('stock_quantity', '>', 0)
                                                    ->count();

                                                // Menghitung low stock untuk varian produk
                                                $lowStockVariants = $products
                                                    ->flatMap(function ($product) {
                                                        return $product->productVariations;
                                                    })
                                                    ->filter(function ($variant) {
                                                        return $variant->variant_stock <= 15 &&
                                                            $variant->variant_stock > 0;
                                                    })
                                                    ->count();
                                            @endphp

                                            {{-- Menampilkan total low stock --}}
                                            {{ $lowStockProducts + $lowStockVariants }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon yellow">
                                        <i class="bi bi-exclamation-triangle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Out of Stock</h6>
                                        <h3 class="mb-0">
                                            @php
                                                // Menghitung produk utama yang out of stock
                                                $outOfStockProducts = $products
                                                    ->where('stock_quantity', '=', 0)
                                                    ->count();

                                                // Menghitung varian produk yang out of stock
                                                $outOfStockVariants = $products
                                                    ->flatMap(function ($product) {
                                                        return $product->productVariations;
                                                    })
                                                    ->filter(function ($variant) {
                                                        return $variant->variant_stock == 0;
                                                    })
                                                    ->count();
                                            @endphp

                                            {{-- Menampilkan total out of stock --}}
                                            {{ $outOfStockProducts + $outOfStockVariants }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon red">
                                        <i class="bi bi-x-circle fs-3"></i>
                                    </div>
                                </div>
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
                        {{-- <li><strong>Batas Stok:</strong> Atur batas stok aman untuk pembaruan tepat waktu.</li> --}}
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
                                            <li class="dropdown-header">Product Stocks</li>
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#importProductStockModal">
                                                    <i class="bi bi-upload me-2 text-success"></i> Import Product
                                                    Stocks
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
                                            <li class="dropdown-header">Product Variants</li>
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#importVariantStockModal">
                                                    <i class="bi bi-upload me-2 text-success"></i> Import Product
                                                    Variant Stocks
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('download.product.variant.stock.template') }}">
                                                    <i class="bi bi-file-earmark-arrow-down me-2 text-primary"></i>
                                                    Download Variant Template
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
                                                    Export Product Stocks
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('export.product.variants') }}?type=variant">
                                                    <i class="bi bi-file-earmark-spreadsheet me-2 text-primary"></i>
                                                    Export Product Variant Stocks
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
                                    <th>Product Details</th>
                                    <th>Total Stock</th>
                                    <th>Stock Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                                            {{-- {{ Str::limit($item->product_name, 20, '...') }} --}}

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
                                                    data-id="{{ $item->id }}"
                                                    data-variant-id="{{ $variant->id }}"
                                                    data-name="{{ $item->product_name }}"
                                                    data-status="{{ $item->isInitialStock() ? 'stock_awal' : 'stock_update' }}">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                                            name="stock_quantity" required min="1"
                                            placeholder="Jumlah stok baru">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="date_expired"
                                            name="date_expired" required>
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
    {{-- yang digunakan  --}}
    <script>
        $(document).ready(function() {
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
                    // const baseUrl = window.location.origin + '/Glamoire/public'; // sesuaikan dengan path Anda

                    // if (variantId) {
                    //     endpoint = `${baseUrl}/get-variant-stock-details/${variantId}`;
                    // } else {
                    //     endpoint = `${baseUrl}/get-stock-details/${productId}`;
                    // }

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
            $(document).on('click', '.update-btn', function() {
                openUpdateModal(this);
            });

            // Handle form submission untuk update stok
            $('#updateStockForm').on('submit', async function(e) {
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
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Simple DataTable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);

            // Use event delegation for delete button
            table1.addEventListener('click', function(event) {
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

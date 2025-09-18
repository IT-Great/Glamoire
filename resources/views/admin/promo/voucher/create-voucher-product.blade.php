<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/promo/create-edit-voucher.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
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

        .action-buttons a {
            display: block;
            margin-bottom: 5px;
        }

        .promo-nav {
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .promo-nav-item {
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

        .promo-nav-item i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .promo-nav-item.active {
            background-color: var(--primary-color);
            /* Make sure --primary-color is defined */
            color: #fff;
            border-color: var(--primary-color);
        }

        .promo-nav-item.active i {
            transform: scale(1.2);
            color: #fff;
        }

        .promo-nav-item:hover:not(.active) {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
        }

        .voucher-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }

        .voucher-card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .voucher-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .voucher-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .voucher-image:hover {
            transform: scale(1.1);
        }

        .badge {
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
        }

        .status-active {
            background-color: green;
        }

        .status-expired {
            background-color: #f44336;
        }

        .custom-dropdown-menu {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, .1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .1);
            min-width: 180px;
        }

        .custom-dropdown-item-all,
        .custom-dropdown-item-product {
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            color: #444;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .custom-dropdown-item-all:hover,
        .custom-dropdown-item-product:hover {
            background-color: #f8f9fa;
            color: #2563eb;
            text-decoration: none;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1px solid #dee2e6;
            color: #444;
            font-weight: 500;
            padding: 8px 16px;
            min-width: 140px;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:focus {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #2563eb;
        }

        /* Style for the input when it has a value */
        .form-control:not(:placeholder-shown) {
            border-color: #dee2e6;
        }

        /* Adjust input padding to accommodate the formatted values */
        .form-control {
            padding-right: 8px;
            /* text-align: right; */
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
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Buat Voucher Produk</h3>
                            <p>
                                Buat Voucher Produk Sekarang Untuk Menarik Minat Pembeli
                            </p>
                        </div>
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-promo-voucher') }}" class="d-flex align-items-center">
                                            <i class="bi bi-tag me-1"></i> Voucher
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Buat Voucher</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <form action="{{ route('store-promo-product-voucher') }}" class="form form-vertical" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card mb-4">
                            <div class="card-body">
                                {{-- type --}}
                                <input type="hidden" name="type" value="product voucher">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-icon-left mb-4">
                                                <label for="first-name-icon">Nama Voucher <span
                                                        style="color: red">*</span></label>
                                                <div class="position-relative mt-2">
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                        placeholder="Masukkan nama voucher" id="first-name-icon"
                                                        name="promo_name" value="{{ old('promo_name') }}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-bag"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('promo_name'))
                                                    <p style="color: red">{{ $errors->first('promo_name') }}
                                                    </p>
                                                @else
                                                    <small class="form-text text-muted" style="font-size: 14px;">
                                                        Masukkan nama voucher. Ini akan ditampilkan kepada
                                                        pengguna.
                                                    </small>
                                                @endif
                                            </div>

                                            <div class="form-group has-icon-left mb-4">
                                                <label for="daterange">Periode <span style="color: red">*</span></label>
                                                <div class="position-relative mt-2">
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                                        id="daterange" name="date_range"
                                                        value="{{ old('date_range') }}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-calendar"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('date_range'))
                                                    <p style="color: red">{{ $errors->first('date_range') }}
                                                    </p>
                                                @else
                                                    <small class="form-text text-muted" style="font-size: 14px;">
                                                        Pilih tanggal mulai dan berakhir untuk masa berlaku
                                                        voucher. Gunakan format: MM/HH/YYYY.
                                                    </small>
                                                @endif
                                            </div>

                                            <div class="mb-4">
                                                <label for="promo_code" class="form-label">Kode Voucher <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text">Glamo</span>
                                                    <input type="text" class="form-control" id="promo_code"
                                                        name="promo_code"
                                                        value="{{ strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5)) }}">

                                                    <small class="form-text text-muted" style="font-size: 14px;">
                                                        Masukkan kombinasi angka dan huruf dari 0-9 dan a-z,
                                                        dan hanya harus sepanjang 5 digit.
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label for="usage_quota">Kuota Penggunaan Maks <span
                                                            style="color: red">*</span></label>
                                                    <input type="text"
                                                        class="form-control mt-2 {{ $errors->has('usage_quota') ? 'is-invalid' : '' }}"
                                                        placeholder="e.g., 100 times" name="usage_quota"
                                                        id="usage_quota" style="margin-bottom: 4px;"
                                                        value="{{ old('usage_quota') }}">
                                                    <small class="form-text text-muted">
                                                        Masukkan jumlah maksimum penggunaan item ini
                                                        (misalnya, 100,
                                                        200).
                                                    </small>
                                                    @if ($errors->has('usage_quota'))
                                                        <p style="color: red">
                                                            {{ $errors->first('usage_quota') }}</p>
                                                    @endif
                                                </div>

                                                <div class="col">
                                                    <label for="max_quantity_buyer">Jumlah Maks Per Pembeli
                                                        <span style="color: red">*</span></label>
                                                    <input type="text"
                                                        class="form-control mt-2 {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }}"
                                                        placeholder="e.g., 5 items per buyer"
                                                        name="max_quantity_buyer" id="max_quantity_buyer"
                                                        style="margin-bottom: 4px;"
                                                        value="{{ old('max_quantity_buyer') }}">
                                                    <small class="form-text text-muted">
                                                        Tentukan jumlah item maksimum yang dapat dibeli oleh
                                                        satu
                                                        pembeli (misalnya, 1, 5, 10).
                                                    </small>
                                                    @if ($errors->has('max_quantity_buyer'))
                                                        <p style="color: red">
                                                            {{ $errors->first('max_quantity_buyer') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label class="form-label fw-medium" for="first-name-icon">
                                                        Diskon <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <button class="btn dropdown-toggle" type="button"
                                                            id="dropdownTypeAll" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="bi bi-tag-fill me-1"></i>
                                                            Tipe Diskon<i class="bi bi-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu custom-dropdown-menu">
                                                            <li>
                                                                <a class="custom-dropdown-item-all" href="#"
                                                                    data-type="nominal">
                                                                    <i class="bi bi-cash"></i>
                                                                    Nominal
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="custom-dropdown-item-all" href="#"
                                                                    data-type="percentage">
                                                                    <i class="bi bi-percent"></i>
                                                                    Persentase
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <input type="text" class="form-control border-start-0"
                                                            id="discountInputAll" name="discount"
                                                            placeholder="Masukkan nilai diskon">
                                                        <span class="input-group-text bg-light"
                                                            id="formatSymbolAll">Rp</span>
                                                    </div>

                                                    <!-- Tambahkan hidden input di sini -->
                                                    <input type="hidden" id="globalDiscountType"
                                                        name="global_discount_type" value="nominal">

                                                    @if ($errors->has('discount'))
                                                        <div class="invalid-feedback d-block mt-1">
                                                            <i class="bi bi-exclamation-circle me-1"></i>
                                                            {{ $errors->first('discount') }}
                                                        </div>
                                                    @else
                                                        <small class="form-text text-muted mt-1">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            Masukkan jumlah diskon (misalnya, 10 untuk 10% diskon).
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label for="min_transaction">Minimal Pembelian <span
                                                            style="color: red">*</span></label>
                                                    <div class="input-group mt-2">
                                                        <span class="input-group-text">Rp.</span>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('min_transaction') ? 'is-invalid' : '' }}"
                                                            id="min_transaction" placeholder="x.xxx.xxx"
                                                            name="min_transaction"
                                                            value="{{ old('min_transaction') }}">
                                                    </div>
                                                    @if ($errors->has('min_transaction'))
                                                        <p style="color: red">
                                                            {{ $errors->first('min_transaction') }}</p>
                                                    @else
                                                        <small class="form-text text-muted" style="font-size: 14px;">
                                                            Masukkan jumlah transaksi minimum yang diperlukan
                                                            untuk
                                                            menggunakan voucher.
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="card">
                                                <label for="first-name-icon">Banner Voucher <span
                                                        style="color: red">*</span></label>
                                                <div class="image-upload-wrap mt-2" id="single-image-upload-wrap"
                                                    style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 8px; height: auto;">
                                                    <input type="file" name="image" class="file-upload-input"
                                                        onchange="readURLSingle(this);" accept="image/*"
                                                        style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                    <div class="drag-text" style="text-align: center; color: #888;">
                                                        <p>Drag and drop a file or select to add Image</p>
                                                    </div>
                                                </div>
                                                <div class="file-upload-content" id="single-file-upload-content"
                                                    style="display: flex; flex-wrap: wrap;">
                                                    <!-- Gambar yang diunggah akan ditambahkan di sini -->
                                                </div>

                                                @if ($errors->has('image'))
                                                    <p style="color: red">
                                                        {{ $errors->first('image') }}</p>
                                                @else
                                                    <small class="form-text text-muted">
                                                        Unggah gambar yang jelas dan berkualitas tinggi yang
                                                        paling mewakili produk Anda. Ini akan menjadi gambar
                                                        utama yang ditampilkan dalam hasil pencarian. Untuk
                                                        format file, gunakan JPG, JPEG, atau PNG, dan
                                                        pastikan ukurannya tidak lebih dari 2MB. Ukuran
                                                        gambar harus 256x64px.
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>Produk List</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="product_ids">Pilih Produk <span
                                            style="color: red">*</span></label><br>
                                    <small class="text-muted">Pilih produk yang ingin Anda terapkan diskon. Anda dapat
                                        memilih beberapa produk.</small>
                                </div>
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="select-all"> All
                                            </th>
                                            <th>Produk</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Batas Stok Produk</th>
                                            <th>Status</th>
                                            <th>Diskon per Produk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr @if ($product->has_active_promo || $product->stock_quantity <= 0) class="bg-light" @endif>
                                                <td>
                                                    <input type="checkbox" name="product_ids[]"
                                                        value="{{ $product->id }}" class="select-item"
                                                        @if ($product->has_active_promo || $product->stock_quantity <= 0) disabled @endif>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ Storage::url($product->main_image) }}"
                                                            target="_blank" rel="noopener">
                                                            <img src="{{ Storage::url($product->main_image) }}"
                                                                loading="lazy" class="lazyload me-2"
                                                                alt="Product Image"
                                                                style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                                        </a>


                                                        <div>
                                                            {{ Str::limit($product->product_name, 20, '...') }}
                                                            @if ($product->has_active_promo)
                                                                <div class="mt-1">
                                                                    <span class="badge bg-danger">Active Promo</span>
                                                                </div>
                                                            @endif
                                                            @if ($product->stock_quantity <= 0)
                                                                <div class="mt-1">
                                                                    <span class="badge bg-secondary">Out of
                                                                        Stock</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        @if ($product->stock_quantity <= 0) class="text-danger fw-bold" @endif>
                                                        {{ $product->stock_quantity }}
                                                    </span>
                                                </td>
                                                <td>Rp. {{ number_format($product->regular_price, 0, ',', '.') }}</td>
                                                <td>
                                                    <input type="number" class="form-control limit-stock"
                                                        placeholder="Limit Stock"
                                                        name="limit_stock[{{ $product->id }}]"
                                                        data-product-id="{{ $product->id }}" min="1"
                                                        max="{{ $product->stock_quantity }}"
                                                        value="{{ old('limit_stock.' . $product->id, '') }}"
                                                        @if ($product->has_active_promo || $product->stock_quantity <= 0) disabled @endif>
                                                    @if ($errors->has('limit_stock.' . $product->id))
                                                        <small class="text-danger">
                                                            {{ $errors->first('limit_stock.' . $product->id) }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->has_active_promo)
                                                        <span class="text-danger">Not Available</span>
                                                    @elseif ($product->stock_quantity <= 0)
                                                        <span class="text-secondary">Out of Stock</span>
                                                    @else
                                                        <span class="text-success">Available</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <button class="btn dropdown-toggle" type="button"
                                                            id="dropdownTypeProduct-{{ $product->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            @if ($product->has_active_promo || $product->stock_quantity <= 0) disabled @endif>
                                                            <i class="bi bi-tag-fill me-1"></i>
                                                            Tipe Diskon <i class="bi bi-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu custom-dropdown-menu">
                                                            <li>
                                                                <a class="custom-dropdown-item-product" href="#"
                                                                    data-type="nominal"
                                                                    data-product-id="{{ $product->id }}">
                                                                    <i class="bi bi-cash"></i>
                                                                    Nominal
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="custom-dropdown-item-product" href="#"
                                                                    data-type="percentage"
                                                                    data-product-id="{{ $product->id }}">
                                                                    <i class="bi bi-percent"></i>
                                                                    Persentase
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <input type="text"
                                                            class="form-control form-control-sm border-start-0"
                                                            id="discountInputProduct-{{ $product->id }}"
                                                            name="product_discount[{{ $product->id }}]"
                                                            placeholder="Masukkan diskon"
                                                            @if ($product->has_active_promo || $product->stock_quantity <= 0) disabled @endif>

                                                        <!-- Tambahkan input tersembunyi untuk menyimpan tipe diskon -->
                                                        <input type="hidden"
                                                            name="product_discount_type[{{ $product->id }}]"
                                                            id="productDiscountType-{{ $product->id }}"
                                                            value="nominal">

                                                        <span class="input-group-text bg-light"
                                                            id="formatSymbolProduct-{{ $product->id }}">Rp</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('index-promo-voucher') }}"
                                        class="btn btn-secondary btn-sm me-3"
                                        style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-box-arrow-in-left me-1"></i> Kembali
                                    </a>

                                    <button type="submit" class="btn btn-sm btn-primary me-1">Submit Voucher</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all checkboxes
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.select-item');

            // Function to update Select All checkbox status
            const updateSelectAllStatus = () => {
                const availableCheckboxes = Array.from(checkboxes).filter(cb => !cb.disabled);
                const checkedAvailableCheckboxes = availableCheckboxes.filter(cb => cb.checked);

                if (availableCheckboxes.length === 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                } else if (checkedAvailableCheckboxes.length === availableCheckboxes.length) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else if (checkedAvailableCheckboxes.length > 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = true;
                } else {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                }
            };

            // Function to handle individual checkbox changes
            const handleCheckboxChange = (checkbox) => {
                const productId = checkbox.value;
                const limitStockInput = document.querySelector(`input[name="limit_stock[${productId}]"]`);
                const discountInput = document.querySelector(`input[name="product_discount[${productId}]"]`);
                const dropdownButton = document.getElementById(`dropdownTypeProduct-${productId}`);

                if (limitStockInput) {
                    if (checkbox.checked) {
                        limitStockInput.removeAttribute('disabled');
                        discountInput.removeAttribute('disabled');
                        if (dropdownButton) dropdownButton.removeAttribute('disabled');
                    } else {
                        limitStockInput.setAttribute('disabled', 'disabled');
                        discountInput.setAttribute('disabled', 'disabled');
                        if (dropdownButton) dropdownButton.setAttribute('disabled', 'disabled');
                        limitStockInput.value = ''; // Clear the value when unchecked
                        discountInput.value = ''; // Clear the discount input
                    }
                }

                // Update select all status after individual checkbox change
                updateSelectAllStatus();
            };

            // Add event listeners to individual checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    handleCheckboxChange(this);
                });
            });

            // Handle "Select All" checkbox - hanya pilih produk yang available
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;

                    checkboxes.forEach(checkbox => {
                        // Hanya pilih checkbox yang tidak disabled (available products)
                        if (!checkbox.disabled) {
                            checkbox.checked = isChecked;
                            // Manually trigger the change event to update related inputs
                            handleCheckboxChange(checkbox);
                        }
                    });
                });
            }

            // Initial check untuk select all status
            updateSelectAllStatus();

            // Validate limit stock inputs
            const limitStockInputs = document.querySelectorAll('.limit-stock');

            limitStockInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const maxStock = parseInt(this.getAttribute('max'));
                    const value = this.value.trim();

                    if (value === '') {
                        this.setCustomValidity('');
                        this.reportValidity();
                        return;
                    }

                    const parsedValue = parseInt(value);

                    if (isNaN(parsedValue) || parsedValue <= 0) {
                        this.setCustomValidity('Please enter a valid number greater than 0');
                    } else if (parsedValue > maxStock) {
                        this.setCustomValidity(`Limit stock cannot exceed ${maxStock}`);
                    } else {
                        this.setCustomValidity('');
                    }

                    this.reportValidity();
                });
            });

            // Tambahkan tooltip untuk produk yang tidak available
            const disabledRows = document.querySelectorAll('tr.bg-light');
            disabledRows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                if (checkbox && checkbox.disabled) {
                    const stockQuantity = parseInt(row.querySelector('td:nth-child(3) span').textContent
                        .trim());

                    if (stockQuantity <= 0) {
                        checkbox.setAttribute('title', 'Produk ini tidak dapat dipilih karena stok kosong');
                        row.style.opacity = '0.6';
                    } else {
                        checkbox.setAttribute('title',
                            'Produk ini tidak dapat dipilih karena sudah memiliki promo aktif');
                        row.style.opacity = '0.6';
                    }
                }
            });
        });
    </script>

    {{-- handle input group discount --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format number to Indonesian Rupiah
            const formatRupiah = (number) => {
                const formatted = number.toString().replace(/\D/g, '');
                return formatted ? parseInt(formatted).toLocaleString('id-ID') : '';
            };

            // Handle All Products discount
            const initializeAllProductsDiscount = () => {
                const dropdownItems = document.querySelectorAll('.custom-dropdown-item-all');
                const dropdownButton = document.getElementById('dropdownTypeAll');
                const formatSymbol = document.getElementById('formatSymbolAll');
                const discountInput = document.getElementById('discountInputAll');
                const globalDiscountTypeInput = document.getElementById('globalDiscountType'); // Hidden input

                let currentType = 'nominal';

                dropdownItems.forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentType = this.dataset.type;
                        dropdownButton.innerHTML = currentType === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase';
                        formatSymbol.textContent = currentType === 'nominal' ? 'Rp' : '%';
                        discountInput.value = ''; // Reset input when changing type
                        globalDiscountTypeInput.value = currentType; // Set hidden input value
                    });
                });

                if (discountInput) {
                    discountInput.addEventListener('input', function() {
                        let value = this.value.replace(/\D/g, '');
                        if (currentType === 'nominal') {
                            this.value = value ? formatRupiah(value) : '';
                        } else {
                            // Untuk persentase, hanya tambahkan % di belakang angka
                            this.value = value ? value : '';
                        }
                    });
                }
            };

            // Handle individual product discounts
            const initializeProductDiscounts = () => {
                const dropdownItems = document.querySelectorAll('.custom-dropdown-item-product');
                const productTypes = {};

                dropdownItems.forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        const type = this.dataset.type;
                        const productId = this.dataset.productId;
                        const dropdownButton = document.getElementById(
                            `dropdownTypeProduct-${productId}`);
                        const formatSymbol = document.getElementById(
                            `formatSymbolProduct-${productId}`);
                        const discountInput = document.getElementById(
                            `discountInputProduct-${productId}`);
                        const productDiscountTypeInput = document.getElementById(
                            `productDiscountType-${productId}`);

                        productTypes[productId] = type;
                        dropdownButton.innerHTML = type === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase';
                        formatSymbol.textContent = type === 'nominal' ? 'Rp' : '%';
                        discountInput.value = ''; // Reset input when changing type

                        if (productDiscountTypeInput) {
                            productDiscountTypeInput.value = type;
                        }
                    });
                });

                document.querySelectorAll('input[id^="discountInputProduct-"]').forEach(input => {
                    input.addEventListener('input', function() {
                        const productId = this.id.split('-')[1];
                        const type = productTypes[productId] || 'nominal';
                        let value = this.value.replace(/\D/g, '');

                        if (type === 'nominal') {
                            this.value = value ? formatRupiah(value) : '';
                        } else {
                            // Untuk persentase, hanya tambahkan % di belakang angka
                            this.value = value ? value : '';
                        }
                    });
                });
            };

            // Initialize both handlers
            initializeAllProductsDiscount();
            initializeProductDiscounts();
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
        // HANDLE AUTO FORMAT RUPIAH
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Tambahkan titik setiap 3 digit
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }

        // Event listener untuk input min_transaction
        document.getElementById('min_transaction').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });

        // Event listener untuk input max_transaction
        document.getElementById('max_transaction').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment().startOf('day'), // Default start date
                endDate: moment().endOf('day') // Default end date
            });
        });
    </script>

    <!-- toastify -->
    <script src="assets/vendors/toastify/toastify.js"></script>

    {{-- Upload Single Image --}}
    <script>
        // Fungsi untuk mengunggah satu gambar
        function readURLSingle(input) {
            const singleUploadContent = document.getElementById('single-file-upload-content');
            singleUploadContent.innerHTML = ''; // Kosongkan konten jika sudah ada gambar sebelumnya

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Buat elemen gambar
                    const imgBox = document.createElement('div');
                    imgBox.classList.add('upload__img-box-single');

                    const imgBg = document.createElement('div');
                    imgBg.classList.add('img-bg');
                    imgBg.style.backgroundImage = `url(${e.target.result})`;

                    // Tambahkan tombol close
                    const imgClose = document.createElement('div');
                    imgClose.classList.add('upload__img-close');
                    imgClose.onclick = function() {
                        singleUploadContent.innerHTML = ''; // Hapus gambar jika tombol close diklik
                        input.value = ''; // Reset input file
                    };

                    imgBg.appendChild(imgClose);
                    imgBox.appendChild(imgBg);
                    singleUploadContent.appendChild(imgBox);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script src="assets/js/main.js"></script>
</body>

</html>

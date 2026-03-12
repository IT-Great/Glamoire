<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/product/createproduct.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">

    <style>
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

        .note-editor.note-frame {
            border-radius: 0.25rem;
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
                                <h3 class="mb-2">Buat Produk</h3>
                                <p>Tambahkan produk baru anda pada halaman ini.</p>
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
                                    <li class="breadcrumb-item active">Buat Produk</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header bg-white">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div>
                                                <h4 class=" d-flex align-items-center">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Buat Produk Baru
                                                </h4>
                                                <p class="text-muted">Silahkan isi detail dibawah ini untuk membuat
                                                    Produk baru</p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('store-product-admin') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Nama Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukan Nama Produk"
                                                                    id="first-name-icon" name="product_name"
                                                                    value="{{ old('product_name') }}" required>

                                                            </div>
                                                            @if ($errors->has('product_name'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('product_name') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Masukkan nama yang unik dan
                                                                    deskriptif untuk produk yang mudah diidentifikasi
                                                                    oleh pelanggan.</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Sub Kategori <span
                                                                    style="color: red">*</span></label>
                                                            <div class="form-group mt-2">
                                                                <select
                                                                    class="form-control select2-basic-category {{ $errors->has('category_product_id') ? 'is-invalid' : '' }}"
                                                                    name="category_product_id">
                                                                    <option value="" disabled
                                                                        {{ old('category_product_id') ? '' : 'selected' }}>
                                                                        Pilih Sub Kategori</option>
                                                                    @foreach ($subcategories as $subcategory)
                                                                        <option value="{{ $subcategory->id }}"
                                                                            {{ old('category_product_id') == $subcategory->id ? 'selected' : '' }}>
                                                                            {{ $subcategory->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('category_product_id'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('category_product_id') }}
                                                                    </p>
                                                                @else
                                                                    <small class="text-muted"
                                                                        style="font-size: 14px;">Pilih Sub Kategori
                                                                        yang
                                                                        sesuai atau tambahkan Sub Kategori yang baru
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Brand <span
                                                                    style="color: red">*</span></label>
                                                            <div class="form-group mt-2">
                                                                <select
                                                                    class="form-control select2-basic-brand {{ $errors->has('brand_id') ? 'is-invalid' : '' }}"
                                                                    name="brand_id">
                                                                    <option value="" disabled
                                                                        {{ old('brand_id') ? '' : 'selected' }}>Pilih
                                                                        Brand</option>
                                                                    @foreach ($brands as $brand)
                                                                        <option value="{{ $brand->id }}"
                                                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                                            {{ $brand->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('brand_id'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('brand_id') }}</p>
                                                                @else
                                                                    <small class="text-muted"
                                                                        style="font-size: 14px;">Pilih Brand yang
                                                                        sesuai
                                                                        atau tambahkan Brand yang baru</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- product code auto --}}
                                                        <input type="hidden" id="product-code-input"
                                                            name="product_code">

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Deskripsi Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <textarea class="summernote form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                                            </div>
                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Berikan secara rinci
                                                                    deskripsi produk Anda, dengan fokus pada fitur,
                                                                    manfaat, dan keunikan penjualan poin.</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Informasi Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <textarea class="summernote form-control {{ $errors->has('information_product') ? 'is-invalid' : '' }}"
                                                                    name="information_product" id="information_product" cols="30" rows="10">{{ old('information_product') }}</textarea>
                                                            </div>
                                                            @if ($errors->has('information_product'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('information_product') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Berikan teknis rinci
                                                                    atau informasi produk tertentu seperti
                                                                    spesifikasi, bahan, garansi, atau penggunaan
                                                                    instruksi.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-4">
                                                            <h4 class="card-title">Variasi Produk</h4>
                                                            <p class="card-subtitle">Tambahkan variasi agar pembeli
                                                                bisa
                                                                memilih produk yang tepat! Anda dapat memasukkan hingga
                                                                2 jenis
                                                                varian.</p>
                                                        </div>

                                                        <div class="mt-3">
                                                            <div id="variant-container">
                                                                <div class="variant-type mb-4 p-3 border rounded">
                                                                    <label>Tipe Variasi</label>
                                                                    <div class="d-flex align-items-center mt-2">
                                                                        <select
                                                                            class="select2-add-option form-select me-2"
                                                                            name="variant_type[]">
                                                                            <option value="warna">Warna</option>
                                                                            <option value="aroma">Aroma</option>
                                                                            <option value="rasa">Rasa</option>
                                                                            <option value="ukuran">Ukuran</option>
                                                                            <option value="bahan">Bahan</option>
                                                                            <option value="tekstur">Tekstur</option>
                                                                            <option value="desain">Desain</option>
                                                                            <option value="durabilitas">Durabilitas
                                                                            </option>
                                                                            <option value="fungsionalitas">
                                                                                Fungsionalitas</option>
                                                                        </select>
                                                                    </div>
                                                                    <small class="text-muted">Pilih jenis variasi atau
                                                                        tambahkan yang baru jika Anda tidak menemukan
                                                                        yang cocok dengan
                                                                        pilihan.</small>

                                                                    <div class="variant-values">
                                                                        <label class="form-label mt-4">Nilai
                                                                            Variasi</label>

                                                                        <select
                                                                            class="select2 form-select multiple-remove"
                                                                            name="variant_values[0][]"
                                                                            multiple="multiple"></select>
                                                                    </div>
                                                                    <small class="text-muted">Pilih nilai varian atau
                                                                        tambahkan yang baru jika menurut Anda tidak
                                                                        cocok dengan
                                                                        pilihan.</small>
                                                                </div>
                                                            </div>
                                                            <!-- Hidden image upload area -->
                                                            <div class="variant-images mt-3" style="display: none;">
                                                                <input type="file"
                                                                    class="form-control variant-image-upload"
                                                                    accept="image/*">
                                                            </div>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addVariantType">+ Tambah Produk Variasi</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Stok Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukan Stock Produk"
                                                                    id="first-name-icon" name="stock_quantity"
                                                                    value="{{ old('stock_quantity') }}">

                                                            </div>
                                                            @if ($errors->has('stock_quantity'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('stock_quantity') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Masukkan jumlah total
                                                                    item dalam stok. Hal Ini dapat membantu melacak
                                                                    inventaris
                                                                    tingkat.</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Harga Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="input-group mt-2">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('regular_price') ? 'is-invalid' : '' }}"
                                                                    placeholder="x.xxx.xxx" id="regular-price"
                                                                    name="regular_price"
                                                                    value="{{ old('regular_price') }}">

                                                            </div>
                                                            @if ($errors->has('regular_price'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('regular_price') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Mengatur
                                                                    harga jual produk dengan
                                                                    format x.xxx.xxx (Rupiah).</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="">Berat Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="input-group mt-2">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Masukkan Berat Produk"
                                                                    name="weight_product"
                                                                    value="{{ old('weight_product') }}">
                                                                <span class="input-group-text"
                                                                    id="basic-addon2">gram</span>

                                                            </div>
                                                            <small class="form-text text-muted">Tentukan berat
                                                                produk untuk perhitungan pengiriman.</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="">Dimensi Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Length" name="length"
                                                                            value="{{ old('length') }}">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon1">cm</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Width" name="width"
                                                                            value="{{ old('width') }}">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon2">cm</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Height" name="height"
                                                                            value="{{ old('height') }}">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon3">cm</span>
                                                                    </div>
                                                                </div>
                                                                <small class="form-text text-muted">Masukkan
                                                                    dimensi dari produk untuk perkiraan pengiriman
                                                                    yang
                                                                    akurat.</small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="date_expired">Tanggal Kadaluarsa</label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="datepicker form-control {{ $errors->has('date_expired') ? 'is-invalid' : '' }}"
                                                                    id="date_expired" name="date_expired"
                                                                    placeholder="Masukan Expired Produk" required>
                                                                <div class="form-control-icon ">
                                                                    <i
                                                                        class="bi bi-calendar d-flex align-items-center"></i>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('date_expired'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('date_expired') }}</p>
                                                            @else
                                                                <small class="form-text text-muted"
                                                                    style="font-size: 14px;">Silakan masukkan
                                                                    tanggal kadaluwarsa produk</small>
                                                            @endif
                                                        </div>

                                                        {{-- single image --}}
                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Gambar Utama
                                                                <span style="color: red"> *</span>
                                                            </label>

                                                            <div class="image-upload-wrap mt-2"
                                                                id="single-image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                                <input type="file" name="main_image_upload"
                                                                    id="main_image_upload" class="file-upload-input"
                                                                    onchange="uploadMainImageToTemp(this.files[0]);"
                                                                    accept="image/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a file or select to add Image</p>
                                                                </div>
                                                            </div>

                                                            <!-- Progress Bar untuk Main Image -->
                                                            <div id="main-upload-progress"
                                                                style="display: none; margin-bottom: 15px;">
                                                                <div
                                                                    style="background: #f0f0f0; border-radius: 10px; overflow: hidden; height: 30px; position: relative;">
                                                                    <div id="main-progress-bar"
                                                                        style="background: linear-gradient(90deg, #4CAF50, #45a049); height: 100%; width: 0%; transition: width 0.3s;">
                                                                        <span id="main-progress-text"
                                                                            style="color: white; font-weight: bold; font-size: 12px; position: absolute; width: 100%; text-align: center; line-height: 30px;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <span id="main-image-error" class="text-danger"
                                                                style="display:none; font-size: 13px;"></span>

                                                            <!-- Container untuk Single Image -->
                                                            <div class="file-upload-content"
                                                                id="single-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Gambar yang diunggah akan ditampilkan di sini -->
                                                            </div>

                                                            <!-- Hidden input untuk menyimpan path temporary main image -->
                                                            <input type="hidden" name="temp_main_image"
                                                                id="temp-main-image" value="">

                                                            @if ($errors->has('main_image'))
                                                                <p style="color: red margin-bottom: 20px;">
                                                                    {{ $errors->first('main_image') }}</p>
                                                            @else
                                                                <small class="form-text text-muted">
                                                                    Unggah gambar yang jelas dan berkualitas tinggi yang
                                                                    paling mewakili produk Anda.
                                                                    Gambar ini akan menjadi gambar utama yang
                                                                    ditampilkan dalam hasil pencarian.
                                                                    Gunakan format file JPG, JPEG, atau PNG, dan
                                                                    pastikan ukuran file tidak lebih dari 2MB.
                                                                    Ukuran gambar sebaiknya 1024x1024 piksel.
                                                                </small>
                                                            @endif
                                                        </div>


                                                        {{-- multiple image --}}
                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Gambar Tambahan
                                                                <span style="color: red">*</span>
                                                            </label>
                                                            <div class="image-upload-wrap mt-2" id="image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                                <input type="file" id="images"
                                                                    name="images_upload[]" class="file-upload-input"
                                                                    onchange="uploadImagesToTemp(this.files);"
                                                                    accept="image/*" multiple
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop files or select add Image(s)</p>
                                                                </div>
                                                            </div>

                                                            <!-- Progress Bar -->
                                                            <div id="upload-progress"
                                                                style="display: none; margin-bottom: 15px;">
                                                                <div
                                                                    style="background: #f0f0f0; border-radius: 10px; overflow: hidden; height: 30px; position: relative;">
                                                                    <div id="progress-bar"
                                                                        style="background: linear-gradient(90deg, #4CAF50, #45a049); height: 100%; width: 0%; transition: width 0.3s;">
                                                                        <span id="progress-text"
                                                                            style="color: white; font-weight: bold; font-size: 12px; position: absolute; width: 100%; text-align: center; line-height: 30px;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Tempat pesan error -->
                                                            <span id="image-error"
                                                                style="color: red; display: none; margin-bottom: 20px;"></span>

                                                            <div class="file-upload-content upload__img-wrap"
                                                                id="file-upload-content"
                                                                style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                                <!-- Gambar preview akan muncul di sini -->
                                                            </div>

                                                            <!-- Hidden inputs untuk menyimpan path temporary images -->
                                                            <div id="temp-images-container"></div>

                                                            @if ($errors->has('images'))
                                                                <p style="color: red">{{ $errors->first('images') }}
                                                                </p>
                                                            @endif

                                                            <small class="form-text text-muted">Tambahkan gambar
                                                                tambahan untuk menampilkan sudut atau fitur berbeda
                                                                dari produk Anda. Anda dapat mengunggah beberapa gambar
                                                                sekaligus. Gunakan format gambar JPG, JPEG,
                                                                atau PNG, dengan ukuran file tidak melebihi 2MB. Ukuran
                                                                gambar sebaiknya 1024x1024 piksel, dan
                                                                maksimal 12 gambar dapat diunggah.
                                                            </small>
                                                        </div>

                                                        {{-- video --}}
                                                        <div class="form-group mb-4">
                                                            <label for="video-upload">Video</label>
                                                            <div class="video-upload-wrap mt-2"
                                                                id="video-upload-wrap">
                                                                <input type="file" id="video" name="video"
                                                                    class="file-upload-input"
                                                                    onchange="readURLVideo(this);" accept="video/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a video file or select to
                                                                        upload
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <span id="video-error"
                                                                style="color: red; display: none;"></span>

                                                            <div class="file-upload-content"
                                                                id="video-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Video that is uploaded will be added here -->
                                                            </div>

                                                            <small class="form-text text-muted">Unggah video
                                                                singkat
                                                                untuk menunjukkan produk Anda sedang digunakan. Ini
                                                                dapat secara signifikan meningkatkan minat pembeli.
                                                                Format video yang diunggah harus MP4, dan ukuran
                                                                file
                                                                tidak boleh melebihi 5MB.</small>
                                                        </div>

                                                    </div>


                                                    <div class="col-12">
                                                        <div class="mt-5">
                                                            <h4 class="card-title">Tabel Variasi Produk</h4>
                                                            <p class="card-subtitle">Kelola detail variasi termasuk
                                                                harga, stok, berat, dan status untuk setiap varian.
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered variant-table mt-3">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Gambar</th>
                                                                            <th>Tipe Variasi</th>
                                                                            <th>Harga</th>
                                                                            <th>Stok</th>
                                                                            <th>Berat (grams)</th>
                                                                            <th>Tanggal Kadaluarsa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="variant-table-body">
                                                                        <!-- Additional rows will be dynamically added here -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-4">
                                                        <a href="{{ route('index-product-admin') }}"
                                                            class="btn btn-secondary btn-sm d-flex align-items-center justify-content-center me-2"
                                                            style="font-weight: bold; border-radius: 5px; min-width: 120px;">
                                                            <i class="bi bi-box-arrow-in-left me-1"></i> Kembali
                                                        </a>

                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                            id="submitButton"
                                                            style="border-radius: 5px; font-weight: bold; min-width: 120px;">
                                                            Submit Produk
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                        <!-- Modal untuk Add New Subcategory -->
                                        <div class="modal fade" id="addSubcategoryModal" tabindex="-1"
                                            aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addSubcategoryModalLabel">Add New
                                                            Subcategory</h5>

                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label>Select Category <span
                                                                    style="color: red">*</span></label>
                                                            <select class="form-control select2-category-modal"
                                                                id="categorySelect">
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            <small class="text-muted" style="font-size: 14px;">
                                                                Please select a category first before adding a
                                                                subcategory.
                                                            </small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Subcategory Name <span
                                                                    style="color: red">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="newSubcategoryName">

                                                            <small class="text-muted" style="font-size: 14px;">
                                                                Please enter a unique Subcategory
                                                                name to help organize your
                                                                products efficiently.
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="saveNewSubcategory">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal untuk Add New Brand -->
                                        <div class="modal fade" id="addBrandModal" tabindex="-1"
                                            aria-labelledby="addBrandModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addBrandModalLabel">Add New Brand
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="brandForm" enctype="multipart/form-data">
                                                            <div class="form-group mb-3">
                                                                <label>Brand Name <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="newBrandName" name="name">
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Give
                                                                    your brand a distinct
                                                                    name that users will recognize.</small>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Description <span
                                                                        style="color: red">*</span></label>
                                                                <textarea class="form-control" id="newBrandDescription" name="description"></textarea>
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Describe what makes your
                                                                    brand
                                                                    stand out and its mission.</small>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Brand Logo <span
                                                                        style="color: red">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    id="newBrandLogo" name="brand_logo"
                                                                    accept="image/*">
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Your brand logo should be in image format (e.g.,
                                                                    JPG, JPEG, PNG) and should not exceed 2MB in size.
                                                                </small>
                                                            </div>

                                                            <div id="imagePreview" class="mt-2"
                                                                style="display: none;">
                                                                <img id="preview" src="" alt="Preview"
                                                                    style="max-width: 200px; max-height: 200px;">
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="saveNewBrand">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
    <!-- Include jQuery dan jQuery UI CSS dan JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/vendors/toastify/toastify.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/product/createproduct.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>

    {{-- handle select brand & category --}}
    <script>
        // handle brand
        $(document).ready(function() {
            // Inisialisasi Select2 untuk brand
            $('.select2-basic-brand').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select a Brand",
                allowClear: true,
                dropdownParent: $('.select2-basic-brand').parent(),
                tags: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");
                    $result.text(data.text);

                    if (data.newOption) {
                        $result.append(" <em>(Press Enter to Add New)</em>");
                    }

                    return $result;
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;

                if (data.newOption) {
                    // Reset selection
                    $('.select2-basic-brand').val(null).trigger('change');

                    // Reset modal form dan error states
                    $('#brandForm')[0].reset();
                    $('#newBrandName').val(data.text);
                    $('#imagePreview').hide();
                    clearErrors();

                    // Show modal
                    $('#addBrandModal').modal('show');
                }
            });

            // Preview image before upload
            $('#newBrandLogo').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                        $('#imagePreview').show();
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Function to clear errors
            function clearErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $('.error-message').remove();
            }

            // Function to show errors
            function showErrors(errors) {
                clearErrors();

                Object.keys(errors).forEach(function(field) {
                    const element = $(`#new${field.charAt(0).toUpperCase() + field.slice(1)}`);
                    const errorMessage = errors[field][0];

                    // Add error class
                    element.addClass('is-invalid');

                    // Add error message
                    element.after(`<div class="invalid-feedback error-message">${errorMessage}</div>`);
                });

                // Show toast message for first error
                const firstError = Object.values(errors)[0][0];
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: `Error: ${firstError}`,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            }

            // Handle save new brand
            $('#saveNewBrand').click(function() {
                clearErrors();

                var formData = new FormData();
                formData.append('name', $('#newBrandName').val());
                formData.append('description', $('#newBrandDescription').val());
                formData.append('brand_logo', $('#newBrandLogo')[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                if (!$('#newBrandName').val() || !$('#newBrandDescription').val() || !$('#newBrandLogo')[0]
                    .files[0]) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: 'Please fill in all required fields',
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('store-brand-admin') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Add new option to select2
                            var newOption = new Option($('#newBrandName').val(), response.data
                                .id, true, true);
                            $('.select2-basic-brand').append(newOption).trigger('change');

                            // Close modal
                            $('#addBrandModal').modal('hide');

                            // Reset form
                            $('#brandForm')[0].reset();
                            $('#imagePreview').hide();
                            clearErrors();

                            // Show success message
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'success',
                                title: 'Brand has been added successfully!',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Validation errors
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            // Other errors
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'error',
                                title: xhr.responseJSON?.message ||
                                    'Failed to add brand',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    }
                });
            });
        });

        // handle category
        $(document).ready(function() {
            // Inisialisasi Select2 untuk category di modal
            $('.select2-category-modal').select2({
                width: '100%',
                dropdownParent: $('#addSubcategoryModal')
            });

            // Function to clear errors
            function clearErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $('.error-message').remove();
            }

            // Function to show errors
            function showErrors(errors) {
                clearErrors();

                Object.keys(errors).forEach(function(field) {
                    const element = $(`#${field}`);
                    const errorMessage = errors[field][0];

                    // Add error class
                    element.addClass('is-invalid');

                    // Add error message
                    element.after(`<div class="invalid-feedback error-message">${errorMessage}</div>`);
                });

                // Show toast message for first error
                const firstError = Object.values(errors)[0][0];
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: `Error: ${firstError}`,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            }

            // Inisialisasi Select2 untuk subcategory
            $('.select2-basic-category').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select a subcategory",
                allowClear: true,
                dropdownParent: $('.select2-basic-category').parent(),
                tags: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");
                    $result.text(data.text);

                    if (data.newOption) {
                        $result.append(" <em>(Press Enter to Add New)</em>");
                    }

                    return $result;
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;

                if (data.newOption) {
                    // Reset selection
                    $('.select2-basic-category').val(null).trigger('change');

                    // Reset modal form dan error states
                    $('#categorySelect').val('').trigger('change');
                    $('#newSubcategoryName').val(data.text);
                    clearErrors();

                    // Show modal
                    $('#addSubcategoryModal').modal('show');
                }
            });

            // Handle save new subcategory
            $('#saveNewSubcategory').click(function() {
                clearErrors();

                var categoryId = $('#categorySelect').val();
                var subcategoryName = $('#newSubcategoryName').val();

                if (!categoryId || !subcategoryName) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: 'Please fill in all required fields',
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('create-category-product') }}',
                    method: 'POST',
                    data: {
                        name: subcategoryName,
                        parent_id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Add new option to select2
                            var newOption = new Option(subcategoryName, response.data.id, true,
                                true);
                            $('.select2-basic-category').append(newOption).trigger('change');

                            // Close modal
                            $('#addSubcategoryModal').modal('hide');

                            // Reset form
                            $('#categorySelect').val('').trigger('change');
                            $('#newSubcategoryName').val('');
                            clearErrors();

                            // Show success message
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'success',
                                title: 'Subcategory has been added successfully!',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Validation errors
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            // Other errors
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'error',
                                title: xhr.responseJSON?.message ||
                                    'Failed to add subcategory',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    }
                });
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

    {{-- summernote --}}
    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 200,
        })
        $("#hint").summernote({
            height: 100,
            toolbar: false,
            placeholder: 'type with apple, orange, watermelon and lemon',
            hint: {
                words: ['apple', 'orange', 'watermelon', 'lemon'],
                match: /\b(\w{1,})$/,
                search: function(keyword, callback) {
                    callback($.grep(this.words, function(item) {
                        return item.indexOf(keyword) === 0;
                    }));
                }
            }
        });
    </script>

    {{-- multiple image --}}
    <script>
        const MAX_IMAGES = 12;
        let uploadedImages = []; // Array untuk menyimpan info gambar yang sudah diupload

        // Restore gambar yang sudah diupload sebelumnya (jika ada error)
        window.addEventListener('DOMContentLoaded', function() {
            @if (session('uploaded_temp_images'))
                const tempImages = @json(session('uploaded_temp_images'));
                uploadedImages = tempImages;
                restoreUploadedImages();
            @endif
        });

        function restoreUploadedImages() {
            const fileUploadContent = document.getElementById("file-upload-content");

            uploadedImages.forEach((imageData, index) => {
                displayImagePreview(imageData.url, imageData.path, index);
            });
        }

        function showProgress(current, total, text = '') {
            const progressContainer = document.getElementById("upload-progress");
            const progressBar = document.getElementById("progress-bar");
            const progressText = document.getElementById("progress-text");

            progressContainer.style.display = "block";
            const percentage = Math.round((current / total) * 100);
            progressBar.style.width = percentage + "%";
            progressText.textContent = text || `${current}/${total} (${percentage}%)`;

            if (current === total && !text) {
                progressText.textContent = `✓ ${total} images uploaded`;
                setTimeout(() => {
                    progressContainer.style.display = "none";
                }, 2000);
            }
        }

        function displayImagePreview(imageUrl, imagePath, index) {
            const fileUploadContent = document.getElementById("file-upload-content");
            const tempContainer = document.getElementById("temp-images-container");

            const imgBox = document.createElement("div");
            imgBox.classList.add("upload__img-box-multiple");
            imgBox.dataset.index = index;
            imgBox.dataset.path = imagePath;

            const imgBg = document.createElement("div");
            imgBg.classList.add("img-bg");
            imgBg.style.backgroundImage = `url(${imageUrl})`;

            const imgClose = document.createElement("div");
            imgClose.classList.add("upload__img-close");
            // Tambahkan ikon trash SVG
            imgClose.innerHTML = `<i class="bi bi-trash"></i>`;

            imgClose.onclick = function() {
                deleteImageFromTemp(imagePath, imgBox);
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            fileUploadContent.appendChild(imgBox);

            // Tambahkan hidden input untuk path gambar
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "temp_images[]";
            hiddenInput.value = imagePath;
            hiddenInput.dataset.path = imagePath;
            tempContainer.appendChild(hiddenInput);
        }

        async function deleteImageFromTemp(imagePath, imgBox) {
            try {
                // Hapus dari server
                const response = await fetch('{{ route('delete-temp-image') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        path: imagePath
                    })
                });

                if (response.ok) {
                    // Hapus dari array
                    uploadedImages = uploadedImages.filter(img => img.path !== imagePath);

                    // Hapus dari DOM
                    imgBox.remove();

                    // Hapus hidden input
                    const hiddenInput = document.querySelector(`input[data-path="${imagePath}"]`);
                    if (hiddenInput) hiddenInput.remove();

                    // Cek jika tidak ada gambar
                    if (uploadedImages.length === 0) {
                        const imageError = document.getElementById("image-error");
                        imageError.textContent = "Please upload at least one image.";
                        imageError.style.display = "block";
                    }
                }
            } catch (error) {
                console.error('Error deleting image:', error);
            }
        }

        // async function uploadImagesToTemp(files) {
        //     const fileUploadContent = document.getElementById("file-upload-content");
        //     const imageError = document.getElementById("image-error");
        //     const fileInput = document.getElementById("images");
        //     const totalFiles = uploadedImages.length + files.length;

        //     imageError.style.display = "none";

        //     // Validasi jumlah
        //     if (totalFiles > MAX_IMAGES) {
        //         imageError.textContent = `Maksimal ${MAX_IMAGES} gambar. Anda mencoba upload ${totalFiles} gambar.`;
        //         imageError.style.display = "block";
        //         fileInput.value = '';
        //         return;
        //     }

        //     const filesToProcess = Array.from(files);
        //     let uploadedCount = 0;

        //     showProgress(0, filesToProcess.length);

        //     for (const file of filesToProcess) {
        //         // Validasi ukuran
        //         const maxSize = 2 * 1024 * 1024; // 2MB
        //         if (file.size > maxSize) {
        //             imageError.textContent = "Setiap gambar maksimal 2MB.";
        //             imageError.style.display = "block";
        //             uploadedCount++;
        //             showProgress(uploadedCount, filesToProcess.length);
        //             continue;
        //         }

        //         // Validasi tipe
        //         if (!file.type.match("image.*")) {
        //             uploadedCount++;
        //             showProgress(uploadedCount, filesToProcess.length);
        //             continue;
        //         }

        //         // Upload ke server
        //         const formData = new FormData();
        //         formData.append('image', file);
        //         formData.append('_token', '{{ csrf_token() }}');

        //         try {
        //             const response = await fetch('{{ route('upload-temp-image') }}', {
        //                 method: 'POST',
        //                 body: formData
        //             });

        //             const result = await response.json();

        //             if (result.success) {
        //                 // Simpan info gambar
        //                 const imageData = {
        //                     path: result.path,
        //                     url: result.url,
        //                     name: file.name
        //                 };
        //                 uploadedImages.push(imageData);

        //                 // Tampilkan preview
        //                 displayImagePreview(result.url, result.path, uploadedImages.length - 1);
        //             } else {
        //                 imageError.textContent = result.message || "Upload failed.";
        //                 imageError.style.display = "block";
        //             }

        //             uploadedCount++;
        //             showProgress(uploadedCount, filesToProcess.length);

        //         } catch (error) {
        //             console.error('Upload error:', error);
        //             imageError.textContent = "Upload error occurred.";
        //             imageError.style.display = "block";
        //             uploadedCount++;
        //             showProgress(uploadedCount, filesToProcess.length);
        //         }
        //     }

        //     // Reset file input
        //     fileInput.value = '';
        // }

        async function uploadImagesToTemp(files) {
            const fileUploadContent = document.getElementById("file-upload-content");
            const imageError = document.getElementById("image-error");
            const fileInput = document.getElementById("images");
            const totalFiles = uploadedImages.length + files.length;

            imageError.style.display = "none";

            // Validasi jumlah
            if (totalFiles > MAX_IMAGES) {
                imageError.textContent = `Maksimal ${MAX_IMAGES} gambar. Anda mencoba upload ${totalFiles} gambar.`;
                imageError.style.display = "block";
                fileInput.value = '';
                return;
            }

            const filesToProcess = Array.from(files);
            let uploadedCount = 0;

            showProgress(0, filesToProcess.length);

            for (const file of filesToProcess) {
                // Validasi ukuran
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    imageError.textContent = "Setiap gambar maksimal 2MB.";
                    imageError.style.display = "block";
                    uploadedCount++;
                    showProgress(uploadedCount, filesToProcess.length);
                    continue;
                }

                // Validasi tipe
                if (!file.type.match("image.*")) {
                    uploadedCount++;
                    showProgress(uploadedCount, filesToProcess.length);
                    continue;
                }

                // Upload ke server
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', '{{ csrf_token() }}');

                try {
                    const response = await fetch('{{ route('upload-temp-image') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json' // Meminta respons JSON
                        }
                    });

                    // PERBAIKAN BUG
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        const result = await response.json();

                        if (result.success) {
                            // Simpan info gambar
                            const imageData = {
                                path: result.path,
                                url: result.url,
                                name: file.name
                            };
                            uploadedImages.push(imageData);

                            // Tampilkan preview
                            displayImagePreview(result.url, result.path, uploadedImages.length - 1);
                        } else {
                            imageError.textContent = result.message || "Upload failed.";
                            imageError.style.display = "block";
                        }
                    } else {
                         console.error("Non-JSON Response");
                         imageError.textContent = "Server error. Pastikan direktori storage bisa diakses.";
                         imageError.style.display = "block";
                    }

                    uploadedCount++;
                    showProgress(uploadedCount, filesToProcess.length);

                } catch (error) {
                    console.error('Upload error:', error);
                    imageError.textContent = "Upload error occurred.";
                    imageError.style.display = "block";
                    uploadedCount++;
                    showProgress(uploadedCount, filesToProcess.length);
                }
            }

            // Reset file input
            fileInput.value = '';
        }

        // Validasi sebelum submit
        document.querySelector("form").addEventListener("submit", function(event) {
            const imageError = document.getElementById("image-error");

            if (uploadedImages.length === 0) {
                event.preventDefault();
                imageError.textContent = "Minimal upload 1 gambar.";
                imageError.style.display = "block";
                imageError.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
                return;
            }

            // Tampilkan loading
            showProgress(1, 1, "Submitting form...");
        });
    </script>

    {{-- main image --}}
    <script>
        let uploadedMainImage = null; // Object untuk menyimpan info main image

        // Restore main image dari session (jika ada error)
        window.addEventListener('DOMContentLoaded', function() {
            @if (session('uploaded_temp_main_image'))
                const tempMainImage = @json(session('uploaded_temp_main_image'));
                uploadedMainImage = tempMainImage;
                restoreMainImage();
            @endif
        });

        function restoreMainImage() {
            if (!uploadedMainImage) return;

            const singleUploadContent = document.getElementById("single-file-upload-content");
            const tempMainImageInput = document.getElementById("temp-main-image");

            // Set hidden input value
            tempMainImageInput.value = uploadedMainImage.path;

            // Clear existing content
            singleUploadContent.innerHTML = "";

            // Create image preview
            const imgBox = document.createElement("div");
            imgBox.classList.add("upload__img-box-single");
            imgBox.dataset.restored = "true";
            imgBox.dataset.path = uploadedMainImage.path;

            const imgBg = document.createElement("div");
            imgBg.classList.add("img-bg");
            imgBg.style.backgroundImage = `url(${uploadedMainImage.url})`;

            // Badge untuk restored image
            const badge = document.createElement("div");
            // badge.className = "restored-image-badge";
            // badge.textContent = "Restored";
            imgBg.appendChild(badge);

            // Tombol close
            const imgClose = document.createElement("div");
            imgClose.classList.add("upload__img-close");
            imgClose.innerHTML = `<i class="bi bi-trash"></i>`;

            imgClose.onclick = function() {
                deleteMainImageFromTemp(uploadedMainImage.path, imgBox);
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            singleUploadContent.appendChild(imgBox);

            console.log('Main image restored from session');
        }

        function showMainProgress(text = '', percentage = 0) {
            const progressContainer = document.getElementById("main-upload-progress");
            const progressBar = document.getElementById("main-progress-bar");
            const progressText = document.getElementById("main-progress-text");

            progressContainer.style.display = "block";
            progressBar.style.width = percentage + "%";
            progressText.textContent = text;

            if (percentage >= 100) {
                setTimeout(() => {
                    progressContainer.style.display = "none";
                }, 2000);
            }
        }

        function displayMainImagePreview(imageUrl, imagePath) {
            const singleUploadContent = document.getElementById("single-file-upload-content");
            const tempMainImageInput = document.getElementById("temp-main-image");

            // Clear previous image
            singleUploadContent.innerHTML = "";

            // Set hidden input
            tempMainImageInput.value = imagePath;

            const imgBox = document.createElement("div");
            imgBox.classList.add("upload__img-box-single");
            imgBox.dataset.path = imagePath;
            imgBox.style.opacity = "0";
            imgBox.style.transform = "scale(0.8)";

            const imgBg = document.createElement("div");
            imgBg.classList.add("img-bg");
            imgBg.style.backgroundImage = `url(${imageUrl})`;

            const imgClose = document.createElement("div");
            imgClose.classList.add("upload__img-close");
            imgClose.innerHTML = `<i class="bi bi-trash"></i>`;

            imgClose.onclick = function() {
                deleteMainImageFromTemp(imagePath, imgBox);
            };

            imgBg.appendChild(imgClose);
            imgBox.appendChild(imgBg);
            singleUploadContent.appendChild(imgBox);

            // Animasi fade in
            setTimeout(() => {
                imgBox.style.transition = "opacity 0.3s, transform 0.3s";
                imgBox.style.opacity = "1";
                imgBox.style.transform = "scale(1)";
            }, 50);
        }

        async function deleteMainImageFromTemp(imagePath, imgBox) {
            try {
                // Hapus dari server
                const response = await fetch('{{ route('delete-temp-main-image') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        path: imagePath
                    })
                });

                if (response.ok) {
                    // Reset variable
                    uploadedMainImage = null;

                    // Animasi fade out
                    imgBox.style.transition = "opacity 0.3s, transform 0.3s";
                    imgBox.style.opacity = "0";
                    imgBox.style.transform = "scale(0.8)";

                    setTimeout(() => {
                        imgBox.remove();
                        document.getElementById("temp-main-image").value = "";
                        document.getElementById("main_image_upload").value = "";
                    }, 300);

                    console.log('Main image deleted from temp');
                }
            } catch (error) {
                console.error('Error deleting main image:', error);
            }
        }

        // async function uploadMainImageToTemp(file) {
        //     if (!file) return;

        //     const mainImageError = document.getElementById("main-image-error");
        //     const fileInput = document.getElementById("main_image_upload");

        //     // Reset error
        //     mainImageError.style.display = "none";
        //     mainImageError.textContent = "";

        //     // Validasi ukuran
        //     const maxSize = 2 * 1024 * 1024; // 2MB
        //     if (file.size > maxSize) {
        //         mainImageError.textContent = "Image file must be less than 2MB.";
        //         mainImageError.style.display = "block";
        //         fileInput.value = "";
        //         return;
        //     }

        //     // Validasi tipe
        //     if (!file.type.match("image.*")) {
        //         mainImageError.textContent = "Only image files are allowed.";
        //         mainImageError.style.display = "block";
        //         fileInput.value = "";
        //         return;
        //     }

        //     // Show progress
        //     showMainProgress("Uploading...", 30);

        //     // Upload ke server
        //     const formData = new FormData();
        //     formData.append('image', file);
        //     formData.append('_token', '{{ csrf_token() }}');

        //     try {
        //         const response = await fetch('{{ route('upload-temp-main-image') }}', {
        //             method: 'POST',
        //             body: formData
        //         });

        //         showMainProgress("Processing...", 70);

        //         const result = await response.json();

        //         if (result.success) {
        //             // Simpan info gambar
        //             uploadedMainImage = {
        //                 path: result.path,
        //                 url: result.url,
        //                 name: file.name
        //             };

        //             // Tampilkan preview
        //             displayMainImagePreview(result.url, result.path);

        //             showMainProgress("✓ Upload complete", 100);

        //             console.log('Main image uploaded successfully');
        //         } else {
        //             mainImageError.textContent = result.message || "Upload failed.";
        //             mainImageError.style.display = "block";
        //             showMainProgress("Upload failed", 0);
        //         }
        //     } catch (error) {
        //         console.error('Upload error:', error);
        //         mainImageError.textContent = "Upload error occurred.";
        //         mainImageError.style.display = "block";
        //         showMainProgress("Upload failed", 0);
        //     }

        //     // Reset file input
        //     fileInput.value = "";
        // }

        async function uploadMainImageToTemp(file) {
            if (!file) return;

            const mainImageError = document.getElementById("main-image-error");
            const fileInput = document.getElementById("main_image_upload");

            // Reset error
            mainImageError.style.display = "none";
            mainImageError.textContent = "";

            // Validasi ukuran
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (file.size > maxSize) {
                mainImageError.textContent = "Image file must be less than 2MB.";
                mainImageError.style.display = "block";
                fileInput.value = "";
                return;
            }

            // Validasi tipe
            if (!file.type.match("image.*")) {
                mainImageError.textContent = "Only image files are allowed.";
                mainImageError.style.display = "block";
                fileInput.value = "";
                return;
            }

            // Show progress
            showMainProgress("Uploading...", 30);

            // Upload ke server
            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{ csrf_token() }}');

            try {
                const response = await fetch('{{ route('upload-temp-main-image') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json' // Memaksa Laravel membalas dengan format JSON, bukan HTML
                    }
                });

                showMainProgress("Processing...", 70);

                // PERBAIKAN BUG: Cek apakah respons dari server adalah text/HTML atau JSON
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    const result = await response.json();

                    if (result.success) {
                        // Simpan info gambar
                        uploadedMainImage = {
                            path: result.path,
                            url: result.url,
                            name: file.name
                        };

                        // Tampilkan preview
                        displayMainImagePreview(result.url, result.path);

                        showMainProgress("✓ Upload complete", 100);
                        console.log('Main image uploaded successfully');
                    } else {
                        mainImageError.textContent = result.message || "Upload failed.";
                        mainImageError.style.display = "block";
                        showMainProgress("Upload failed", 0);
                    }
                } else {
                    // JIKA SERVER MENGEMBALIKAN HALAMAN HTML / ERROR PHP
                    const textResponse = await response.text();
                    console.error("Server mengembalikan non-JSON:", textResponse);

                    mainImageError.textContent = "Terjadi kesalahan di server. Pastikan Route/Controller berfungsi dengan benar.";
                    mainImageError.style.display = "block";
                    showMainProgress("Upload failed", 0);
                }

            } catch (error) {
                console.error('Upload error:', error);
                mainImageError.textContent = "Koneksi ke server gagal.";
                mainImageError.style.display = "block";
                showMainProgress("Upload failed", 0);
            }

            // Reset file input
            fileInput.value = "";
        }

        // Drag and drop support
        const singleUploadWrap = document.getElementById('single-image-upload-wrap');

        if (singleUploadWrap) {
            singleUploadWrap.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#4CAF50';
                this.style.background = '#f0f8f0';
            });

            singleUploadWrap.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#ddd';
                this.style.background = '#f8f8f8';
            });

            singleUploadWrap.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#ddd';
                this.style.background = '#f8f8f8';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    uploadMainImageToTemp(files[0]);
                }
            });
        }

        // Validasi sebelum submit form
        document.querySelector("form").addEventListener("submit", function(event) {
            const mainImageError = document.getElementById("main-image-error");
            const singleUploadContent = document.getElementById("single-file-upload-content");

            // Cek apakah ada main image
            if (singleUploadContent.children.length === 0) {
                event.preventDefault();
                mainImageError.textContent = "Main image is required.";
                mainImageError.style.display = "block";
                mainImageError.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
                return false;
            }
        });
    </script>
</body>

</html>

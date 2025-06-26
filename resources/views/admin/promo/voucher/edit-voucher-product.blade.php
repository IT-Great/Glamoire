<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Voucher - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/product/createproduct.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/promo/create-edit-voucher.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <style>
        .custom-dropdown-menu {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, .1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .1);
            min-width: 180px;
            margin-top: 8px;
            /* Add space between dropdown toggle and menu */
        }

        .custom-dropdown-menu li {
            margin-bottom: 4px;
            /* Add spacing between dropdown items */
        }

        .custom-dropdown-menu li:last-child {
            margin-bottom: 0;
            /* Remove margin from last item */
        }

        .custom-dropdown-item {
            padding: 10px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            color: #444;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            position: relative;
        }

        .custom-dropdown-item:hover {
            background-color: #f8f9fa;
            color: #2563eb;
            text-decoration: none;
        }

        .custom-dropdown-item.active {
            background-color: #e6f2ff;
            color: #2563eb;
        }

        .custom-dropdown-item.active::after {
            content: '✓';
            position: absolute;
            right: 16px;
            color: #2563eb;
        }

        .custom-dropdown-item i {
            font-size: 1rem;
            margin-right: 8px;
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
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('index-promo-voucher') }}">Voucher</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Promo Product Voucher
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <form action="{{ route('update-promo-product-voucher', $promo->id) }}" class="form form-vertical"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="container">
                            <h3 class="mb-2">Update Voucher</h3>
                            <p class="mb-3">
                                Buat Product Voucher Sekarang Untuk Menarik Minat Pembeli
                            </p>
                            <div class="card mb-4">
                                <div class="card-body">
                                    {{-- type --}}
                                    <input type="hidden" name="type" value="product voucher">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Nama Voucher <span
                                                            style="color: red">*</span></label>
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                            placeholder="Enter Voucher Name" id="first-name-icon"
                                                            name="promo_name" value="{{ $promo->promo_name }}">
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

                                                <div class="form-group has-icon-left">
                                                    <label for="daterange">Periode <span
                                                            style="color: red">*</span></label>
                                                    <div class="position-relative">
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                                            id="daterange" name="date_range"
                                                            value="{{ old('date_range', $promo->date_range ?? '') }}"
                                                            placeholder="Select date range">
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

                                                <label for="promo_code" class="form-label">Voucher Code <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text">Glamo</span>
                                                    <input type="text" class="form-control" id="promo_code"
                                                        name="promo_code" value="{{ $promo->promo_code }}">

                                                    <small class="form-text text-muted" style="font-size: 14px;">
                                                        Masukkan kombinasi angka dan huruf dari 0-9 dan a-z,
                                                        dan hanya harus sepanjang 5 digit.
                                                    </small>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="usage_quota">Kuota Penggunaan Maks <span
                                                                style="color: red">*</span></label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('usage_quota') ? 'is-invalid' : '' }}"
                                                            placeholder="e.g., 100 times" name="usage_quota"
                                                            id="usage_quota" style="margin-bottom: 4px;"
                                                            value="{{ $promo->usage_quota }}">
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
                                                            class="form-control {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }}"
                                                            placeholder="e.g., 5 items per buyer"
                                                            name="max_quantity_buyer" id="max_quantity_buyer"
                                                            style="margin-bottom: 4px;"
                                                            value="{{ $promo->max_quantity_buyer }}">
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

                                            <div class="col-md-6 mb-3">
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label class="form-label fw-medium" for="first-name-icon">
                                                            Diskon <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <button class="btn dropdown-toggle" type="button"
                                                                id="discountTypeDropdown" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i
                                                                    class="bi {{ $promo->discount_type == 'percentage' ? 'bi-percent' : 'bi-cash' }} me-1"></i>
                                                                <span id="discountTypeLabel">
                                                                    {{ $promo->discount_type == 'percentage' ? 'Persentase' : 'Nominal' }}
                                                                </span>
                                                                <i class="bi bi-chevron-down"></i>
                                                            </button>

                                                            <ul class="dropdown-menu custom-dropdown-menu">
                                                                <li>
                                                                    <a class="custom-dropdown-item" href="#"
                                                                        data-type="nominal"
                                                                        {{ $promo->discount_type == 'nominal' ? 'class="active"' : '' }}>
                                                                        <i class="bi bi-cash"></i>
                                                                        Nominal
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="custom-dropdown-item" href="#"
                                                                        data-type="percentage"
                                                                        {{ $promo->discount_type == 'percentage' ? 'class="active"' : '' }}>
                                                                        <i class="bi bi-percent"></i>
                                                                        Persentase
                                                                    </a>
                                                                </li>
                                                            </ul>

                                                            <input type="text" class="form-control border-start-0"
                                                                id="discountInput" name="discount"
                                                                placeholder="Masukkan nilai diskon"
                                                                value="{{ $promo->discount_type == 'percentage' ? $promo->discount . '%' : number_format($promo->discount, 0, ',', '.') }}"
                                                                data-current-type="{{ $promo->discount_type }}"
                                                                data-original-value="{{ $promo->discount }}">
                                                            <span class="input-group-text bg-light"
                                                                id="formatSymbol">{{ $promo->discount_type == 'percentage' ? '%' : 'Rp' }}</span>
                                                        </div>

                                                        <input type="hidden" id="globalDiscountType"
                                                            name="global_discount_type"
                                                            value="{{ $promo->discount_type }}">

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

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="min_transaction">Minimum Transaction <span
                                                                style="color: red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('min_transaction') ? 'is-invalid' : '' }}"
                                                                id="min_transaction" placeholder="x.xxx.xxx"
                                                                name="min_transaction"
                                                                value="{{ number_format($promo->min_transaction, 0, ',', '.') }}">
                                                        </div>
                                                        @if ($errors->has('min_transaction'))
                                                            <p style="color: red">
                                                                {{ $errors->first('min_transaction') }}</p>
                                                        @else
                                                            <small class="form-text text-muted"
                                                                style="font-size: 14px;">
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
                                                    <div class="image-upload-wrap" id="single-image-upload-wrap"
                                                        style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 8px; height: auto;">
                                                        <input type="file" name="image"
                                                            class="file-upload-input" onchange="readURLSingle(this);"
                                                            accept="image/*"
                                                            style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                        <div class="drag-text"
                                                            style="text-align: center; color: #888;">
                                                            <p>Drag and drop a file or select to add Image</p>
                                                        </div>
                                                    </div>
                                                    <div class="file-upload-content" id="single-file-upload-content"
                                                        style="display: flex; flex-wrap: wrap;">
                                                        <!-- Gambar yang diunggah akan ditambahkan di sini -->

                                                        @if ($promo->image)
                                                            <div class="image-preview-container">
                                                                <div class="image-preview-box">
                                                                    <span class="preview-label"
                                                                        style="color: green;">Old Image</span>
                                                                    <img src="{{ Storage::url($promo->image) }}"
                                                                        class="preview-image" alt="Old Image Preview"
                                                                        onclick="openImageInNewTab('{{ Storage::url($promo->image) }}')">
                                                                </div>
                                                            </div>
                                                        @endif

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
                                    <h4>Product List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="product_ids">Select Products <span
                                                style="color: red">*</span></label><br>
                                        <small class="text-muted">Pilih produk yang ingin Anda terapkan diskon. Anda
                                            dapat memilih beberapa produk.</small>
                                    </div>

                                    <table class="table" id="table1">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="select-all"> Select All
                                                </th>
                                                <th>Product</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Limit Stock Product</th>
                                                <th>Status</th>
                                                <th>Discount Per Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr @if ($product->has_other_active_promo) class="bg-light" @endif>
                                                    <td>
                                                        <input type="checkbox" name="product_ids[]"
                                                            value="{{ $product->id }}" class="select-item"
                                                            @if ($product->is_selected) checked @endif
                                                            @if ($product->has_other_active_promo) disabled @endif>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ Storage::url($product->main_image) }}"
                                                                loading="lazy" class="lazyload me-2"
                                                                alt="Product Image"
                                                                style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;"
                                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                            <div>
                                                                {{ Str::limit($product->product_name, 20, '...') }}
                                                                @if ($product->has_other_active_promo)
                                                                    <span class="badge bg-danger">Active Promo</span>
                                                                @elseif($product->is_selected)
                                                                    <span class="badge bg-success">Selected</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $product->stock_quantity }}</td>
                                                    <td>Rp. {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control limit-stock"
                                                            placeholder="Limit Stock"
                                                            name="limit_stock[{{ $product->id }}]"
                                                            data-product-id="{{ $product->id }}" min="1"
                                                            max="{{ $product->stock_quantity }}"
                                                            value="{{ old('limit_stock.' . $product->id, $product->pivot_limit_stock ?? '') }}"
                                                            @if (!$product->is_selected || $product->has_other_active_promo) disabled @endif>
                                                        @if ($errors->has('limit_stock.' . $product->id))
                                                            <small
                                                                class="text-danger">{{ $errors->first('limit_stock.' . $product->id) }}</small>
                                                        @endif
                                                    </td>


                                                    <td>
                                                        @if ($product->has_other_active_promo)
                                                            <span class="text-danger">Not Available</span>
                                                        @elseif($product->is_selected)
                                                            <span class="text-success">Current Promo</span>
                                                        @else
                                                            <span class="text-success">Available</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <button class="btn dropdown-toggle" type="button"
                                                                id="dropdownTypeProduct-{{ $product->id }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-tag-fill me-1"></i>
                                                                Tipe Diskon <i class="bi bi-chevron-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu custom-dropdown-menu">
                                                                <li>
                                                                    <a class="custom-dropdown-item-product"
                                                                        href="#" data-type="nominal"
                                                                        data-product-id="{{ $product->id }}">
                                                                        <i class="bi bi-cash"></i>
                                                                        Nominal
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="custom-dropdown-item-product"
                                                                        href="#" data-type="percentage"
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
                                                                @if (!$product->is_selected || $product->has_other_active_promo) disabled @endif>

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

                                        <button type="submit" class="btn btn-sm btn-primary me-1">Update
                                            Voucher</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/product/createproduct.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownItems = document.querySelectorAll('.custom-dropdown-item');
            const discountInput = document.getElementById('discountInput');
            const formatSymbol = document.getElementById('formatSymbol');
            const discountTypeLabel = document.getElementById('discountTypeLabel');
            const globalDiscountType = document.getElementById('globalDiscountType');

            // Fungsi untuk memformat angka ke format Rupiah tanpa 'Rp.'
            function formatRupiah(angka) {
                // Hapus karakter non-numeric
                let number = angka.toString().replace(/[^\d]/g, '');

                // Format dengan separator titik
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Fungsi untuk mendapatkan nilai murni (hanya angka)
            function getRawValue(value) {
                return value.replace(/[^\d]/g, '');
            }

            dropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const type = this.getAttribute('data-type');
                    const currentValue = discountInput.value;
                    const originalValue = discountInput.getAttribute('data-original-value');
                    const iconElement = document.querySelector('#discountTypeDropdown > i.bi');

                    if (type === 'percentage') {
                        formatSymbol.textContent = '%';
                        discountTypeLabel.textContent = 'Persentase';
                        globalDiscountType.value = 'percentage';
                        // Update icon to percent
                        iconElement.classList.remove('bi-cash');
                        iconElement.classList.add('bi-percent');

                        if (discountInput.getAttribute('data-current-type') === 'nominal') {
                            discountInput.value = originalValue + '%';
                        }
                    } else {
                        formatSymbol.textContent = 'Rp.'; // Tidak perlu tulisan Rp
                        discountTypeLabel.textContent = 'Nominal';
                        globalDiscountType.value = 'nominal';
                        // Update icon to cash
                        iconElement.classList.remove('bi-percent');
                        iconElement.classList.add('bi-cash');

                        if (discountInput.getAttribute('data-current-type') === 'percentage') {
                            discountInput.value = formatRupiah(originalValue);
                        }
                    }

                    discountInput.setAttribute('data-current-type', type);
                });
            });

            // Event listener untuk input
            discountInput.addEventListener('input', function() {
                const currentType = globalDiscountType.value;

                if (currentType === 'percentage') {
                    // Hanya angka untuk persentase
                    discountInput.value = discountInput.value.replace(/[^\d]/g, '') + '%';
                } else {
                    // Format angka biasa untuk nominal
                    const rawValue = getRawValue(discountInput.value);
                    discountInput.value = formatRupiah(rawValue);
                }
            });

            // Sebelum submit form, hapus format angka
            document.querySelector('form').addEventListener('submit', function(e) {
                const rawValue = getRawValue(discountInput.value);
                discountInput.value = rawValue;
            });

            // Set initial format if needed
            const initialType = globalDiscountType.value;
            if (initialType === 'nominal') {
                const initialValue = discountInput.value;
                discountInput.value = formatRupiah(initialValue);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle checkbox and limit stock interactions
            const checkboxes = document.querySelectorAll('.select-item');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const productId = this.value;
                    const limitStockInput = document.querySelector(
                        `input[name="limit_stock[${productId}]"]`);
                    const discountInput = document.querySelector(
                        `input[name="product_discount[${productId}]"]`);

                    if (limitStockInput) {
                        if (this.checked) {
                            limitStockInput.removeAttribute('disabled');
                            discountInput.removeAttribute('disabled');
                        } else {
                            limitStockInput.setAttribute('disabled', 'disabled');
                            discountInput.setAttribute('disabled', 'disabled');
                            limitStockInput.value = ''; // Clear the value when unchecked
                            discountInput.value = ''; // Clear the discount input
                        }
                    }
                });
            });

            // Handle "Select All" checkbox
            const selectAllCheckbox = document.getElementById('select-all');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        if (!checkbox.disabled) {
                            checkbox.checked = this.checked;
                            const event = new Event('change');
                            checkbox.dispatchEvent(event);
                        }
                    });
                });
            }

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

            // Format number to Indonesian Rupiah
            const formatRupiah = (number) => {
                const formatted = number.toString().replace(/\D/g, '');
                return formatted ? parseInt(formatted).toLocaleString('id-ID') : '';
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

                        productDiscountTypeInput.value = type;
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

            // Initialize product discounts handler
            initializeProductDiscounts();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);

            const checkboxes = document.querySelectorAll('.select-item');
            const selectAllCheckbox = document.getElementById('select-all');

            // Handle "Select All" checkbox
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        if (!checkbox.disabled) {
                            checkbox.checked = this.checked;
                        }
                    });
                });
            }

            // Update "Select All" state based on individual checkboxes
            function updateSelectAllState() {
                const enabledCheckboxes = Array.from(checkboxes).filter(cb => !cb.disabled);
                const allChecked = enabledCheckboxes.every(cb => cb.checked);
                const someChecked = enabledCheckboxes.some(cb => cb.checked);

                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }

            // Add change event listeners to all checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectAllState);
            });

            // Initialize select all state
            updateSelectAllState();

            // Image preview function
            window.openImageInNewTab = function(imageUrl) {
                window.open(imageUrl, '_blank');
            }
        });
    </script>

    <script>
        // Handle Select All
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // Optionally, you can also update the "Select All" checkbox state
        // if individual checkboxes are deselected
        document.querySelectorAll('.select-item').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectAll = document.getElementById('select-all');
                if (!this.checked) {
                    selectAll.checked = false;
                } else if (document.querySelectorAll('.select-item:checked').length === checkboxes.length) {
                    selectAll.checked = true;
                }
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
        $('#daterange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: '{{ $promo->start_date ?? now()->format('YYYY-MM-DD') }}',
            endDate: '{{ $promo->end_date ?? now()->format('YYYY-MM-DD') }}'
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
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Voucher - Glamoire</title>
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
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/promo/create-edit-voucher.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
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


        /* Style untuk mengatur checkbox column */
        #table1 th:first-child {
            width: 50px;
            min-width: 50px;
            max-width: 50px;
        }

        /* Style untuk checkbox */
        #table1 .form-check {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        #table1 .form-check-input {
            margin: 0;
        }

        /* Style untuk cell checkbox di body */
        #table1 tbody td:first-child {
            width: 50px;
            text-align: center;
        }

        /* Menyembunyikan ikon sort pada kolom pertama  */
        #table1 th:first-child .dataTable-sorter {
            display: none;
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
                    <h3 class="mb-2">Buat Brand Voucher</h3>
                    <p class="mb-3">
                        Buat Brand Voucher Sekarang Untuk Menarik Minat Pembeli.
                        <a href="#" class="text-blue">Pelajari Lebih Lanjut</a>
                    </p>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo-voucher') }}">Promo
                                            Voucher</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buat Brand Voucher</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section class="section">
                    <form action="{{ route('store-promo-brand-voucher') }}" class="form form-vertical" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card mb-4">
                            <div class="card-body">
                                {{-- type --}}
                                <input type="hidden" name="type" value="brand voucher">

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

                                            <div class="form-group mb-4">
                                                <label for="first-name-icon">Brand <span
                                                        style="color: red">*</span></label>
                                                <div class="form-group mt-2">
                                                    <select
                                                        class="form-control select2-basic-brand {{ $errors->has('brand_id') ? 'is-invalid' : '' }}"
                                                        name="brand_id">
                                                        <option value="" disabled
                                                            {{ old('brand_id') ? '' : 'selected' }}>
                                                            Select
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
                                                        <small class="text-muted mt-1" style="font-size: 14px;">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            Pilih atau tambah Brand</small>
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
                                                            Masukkan jumlah diskon (misalnya, 10 untuk 10%
                                                            diskon).
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
                            <div class="card-header ">
                                <h4>Product List</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="product_ids">Pilih Produk <span
                                            style="color: red">*</span></label><br>
                                    <small class="text-muted">Pilih produk yang ingin Anda terapkan diskon. Anda
                                        dapat memilih beberapa produk.</small>
                                </div>
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="select-all">
                                                </div>
                                            </th>
                                            <th>Product</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Limit Stock</th>
                                            <th>Status</th>
                                            <th>Discount Per Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('index-promo-voucher') }}"
                                        class="btn btn-secondary btn-sm me-3"
                                        style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-box-arrow-in-left me-1"></i> Kembali
                                    </a>

                                    <button type="reset" class="btn btn-sm btn-light-secondary me-3">Reset
                                        Voucher</button>
                                    <button type="submit" class="btn btn-sm btn-primary me-1">Submit
                                        Voucher</button>
                                </div>
                            </div>
                        </div>

                    </form>

                    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addBrandModalLabel">Add New Brand
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="brandForm" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label>Brand Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="newBrandName"
                                                name="name">
                                            <small class="text-muted" style="font-size: 14px;">
                                                Berikan nama yang unik untuk Brand Anda yang akan
                                                mudah dikenali oleh pengguna.
                                            </small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Description <span style="color: red">*</span></label>
                                            <textarea class="form-control" id="newBrandDescription" name="description"></textarea>
                                            <small class="text-muted" style="font-size: 14px;">
                                                Jelaskan apa yang membuat Brand Anda menonjol dan
                                                misinya.
                                            </small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Brand Logo <span style="color: red">*</span></label>
                                            <input type="file" class="form-control" id="newBrandLogo"
                                                name="brand_logo" accept="image/*">
                                            <small class="text-muted" style="font-size: 14px;">
                                                Logo Brand Anda harus dalam format gambar (misalnya,
                                                JPG, JPEG, PNG) dan tidak boleh melebihi 2MB.
                                            </small>
                                        </div>

                                        <div id="imagePreview" class="mt-2" style="display: none;">
                                            <img id="preview" src="" alt="Preview"
                                                style="max-width: 200px; max-height: 200px;">

                                        </div>
                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="saveNewBrand">Save</button>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    {{-- menampilkan data pada tabel --}}

    {{-- <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

        $(document).ready(function() {
            const formatRupiah = (number) => {
                const formatted = number.toString().replace(/\D/g, '');
                return formatted ? parseInt(formatted).toLocaleString('id-ID') : '';
            };

            // Initialize select2
            $('.select2-basic-brand').select2();

            // Keep track of modified product discount types
            const modifiedProductTypes = new Set();

            // Handle brand change
            $('.select2-basic-brand').on('change', function() {
                var brandId = $(this).val();
                if (brandId) {
                    $.ajax({
                        url: `/get-products-by-brand/${brandId}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                updateProductTable(response.products);
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching products:', xhr);
                        }
                    });
                }
            });

            // Handle global discount type change
            $('.custom-dropdown-item-all').on('click', function(e) {
                e.preventDefault();
                const type = $(this).data('type');
                const dropdownButton = $('#dropdownTypeAll');
                const formatSymbol = $('#formatSymbolAll');
                const discountInput = $('#discountInputAll');

                // Update global discount type
                $('#globalDiscountType').val(type);

                // Update UI for global discount
                dropdownButton.html(type === 'nominal' ?
                    '<i class="bi bi-cash me-1"></i>Nominal' :
                    '<i class="bi bi-percent me-1"></i>Persentase');
                formatSymbol.text(type === 'nominal' ? 'Rp' : '%');
                discountInput.val('');

                // Update all unmodified product discount types
                updateUnmodifiedProductTypes(type);
            });

            // Function to update unmodified product discount types
            function updateUnmodifiedProductTypes(globalType) {
                $('[id^="discountType-"]').each(function() {
                    const productId = this.id.split('-')[1];
                    if (!modifiedProductTypes.has(productId)) {
                        // Update hidden input
                        $(this).val(globalType);

                        // Update UI
                        const dropdownButton = $(`#dropdownTypeProduct-${productId}`);
                        const formatSymbol = $(`#formatSymbolProduct-${productId}`);

                        dropdownButton.html(globalType === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase');
                        formatSymbol.text(globalType === 'nominal' ? 'Rp' : '%');

                        // Clear input value when type changes
                        $(`#discountInputProduct-${productId}`).val('');
                    }
                });
            }

            // Function to update product table
            function updateProductTable(products) {
                var tbody = $('#table1 tbody');
                tbody.empty();

                products.forEach(function(product) {
                    var row = `
                        <tr>
                            <td>
                                <input type="checkbox" name="product_ids[]" 
                                    value="${product.id}" class="select-item">
                            </td>
                            <td>
                                <img src="${product.main_image}" 
                                    loading="lazy" class="lazyload" alt="Product Image"
                                    style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                ${product.product_name.length > 30 ? 
                                    product.product_name.substring(0, 30) + '...' : 
                                    product.product_name}
                            </td>
                            <td>${product.stock_quantity}</td>               
                            <td>Rp. ${number_format(product.regular_price)}</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <button class="btn dropdown-toggle" type="button"
                                        id="dropdownTypeProduct-${product.id}"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-tag-fill me-1"></i>
                                        Tipe Diskon <i class="bi bi-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu custom-dropdown-menu">
                                        <li>
                                            <a class="custom-dropdown-item-product"
                                                href="#" data-type="nominal"
                                                data-product-id="${product.id}">
                                                <i class="bi bi-cash"></i>
                                                Nominal
                                            </a>
                                        </li>
                                        <li>
                                            <a class="custom-dropdown-item-product"
                                                href="#" data-type="percentage"
                                                data-product-id="${product.id}">
                                                <i class="bi bi-percent"></i>
                                                Persentase
                                            </a>
                                        </li>
                                    </ul>
                                    <input type="text"
                                        class="form-control form-control-sm border-start-0"
                                        id="discountInputProduct-${product.id}"
                                        name="product_discount[${product.id}]"
                                        placeholder="Masukkan diskon">
                                    <span class="input-group-text bg-light"
                                        id="formatSymbolProduct-${product.id}">Rp</span>
                                    <input type="hidden" 
                                        name="discount_type[${product.id}]" 
                                        value="${$('#globalDiscountType').val()}" 
                                        id="discountType-${product.id}">
                                </div>
                            </td>
                        </tr>
                        `;
                    tbody.append(row);
                });

                // Reinitialize components
                reinitializeComponents();
            }

            // Helper function for number formatting
            function number_format(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Function to reinitialize components after table update
            function reinitializeComponents() {
                // Reinitialize select all functionality
                $('#select-all').off('change').on('change', function() {
                    $('.select-item').prop('checked', $(this).prop('checked'));
                });

                // Handle product-specific discount type changes
                $('.custom-dropdown-item-product').off('click').on('click', function(e) {
                    e.preventDefault();
                    const type = $(this).data('type');
                    const productId = $(this).data('product-id');

                    // Mark this product as modified
                    modifiedProductTypes.add(productId);

                    // Update UI and hidden input
                    const dropdownButton = $(`#dropdownTypeProduct-${productId}`);
                    const formatSymbol = $(`#formatSymbolProduct-${productId}`);
                    const discountInput = $(`#discountInputProduct-${productId}`);
                    const discountTypeInput = $(`#discountType-${productId}`);

                    dropdownButton.html(type === 'nominal' ?
                        '<i class="bi bi-cash me-1"></i>Nominal' :
                        '<i class="bi bi-percent me-1"></i>Persentase');
                    formatSymbol.text(type === 'nominal' ? 'Rp' : '%');
                    discountInput.val('');
                    discountTypeInput.val(type);
                });

                // Handle discount input formatting
                $('input[id^="discountInputProduct-"]').off('input').on('input', function() {
                    const productId = this.id.split('-')[1];
                    const type = $(`#discountType-${productId}`).val();
                    let value = this.value.replace(/\D/g, '');

                    if (type === 'nominal') {
                        this.value = value ? formatRupiah(value) : '';
                    } else {
                        // Untuk persentase, batasi maksimal 100
                        value = Math.min(parseInt(value) || 0, 100);
                        this.value = value ? value.toString() : '';
                    }
                });

                // Handle global discount input formatting
                $('#discountInputAll').off('input').on('input', function() {
                    const type = $('#globalDiscountType').val();
                    let value = this.value.replace(/\D/g, '');

                    if (type === 'nominal') {
                        this.value = value ? formatRupiah(value) : '';
                    } else {
                        value = Math.min(parseInt(value) || 0, 100);
                        this.value = value ? value.toString() : '';
                    }
                });
            }

            // Initialize components on page load
            reinitializeComponents();
        });
    </script> --}}

    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

        $(document).ready(function() {
            const formatRupiah = (number) => {
                const formatted = number.toString().replace(/\D/g, '');
                return formatted ? parseInt(formatted).toLocaleString('id-ID') : '';
            };

            // Initialize select2
            $('.select2-basic-brand').select2();

            // Keep track of modified product discount types
            const modifiedProductTypes = new Set();

            // Handle brand change
            $('.select2-basic-brand').on('change', function() {
                var brandId = $(this).val();
                if (brandId) {
                    $.ajax({
                        url: `/get-products-by-brand/${brandId}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                updateProductTable(response.products);
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching products:', xhr);
                        }
                    });
                }
            });

            // Handle global discount type change
            $('.custom-dropdown-item-all').on('click', function(e) {
                e.preventDefault();
                const type = $(this).data('type');
                const dropdownButton = $('#dropdownTypeAll');
                const formatSymbol = $('#formatSymbolAll');
                const discountInput = $('#discountInputAll');

                // Update global discount type
                $('#globalDiscountType').val(type);

                // Update UI for global discount
                dropdownButton.html(type === 'nominal' ?
                    '<i class="bi bi-cash me-1"></i>Nominal' :
                    '<i class="bi bi-percent me-1"></i>Persentase');
                formatSymbol.text(type === 'nominal' ? 'Rp' : '%');
                discountInput.val('');

                // Update all unmodified product discount types
                updateUnmodifiedProductTypes(type);
            });

            // Function to update unmodified product discount types
            function updateUnmodifiedProductTypes(globalType) {
                $('[id^="discountType-"]').each(function() {
                    const productId = this.id.split('-')[1];
                    if (!modifiedProductTypes.has(productId)) {
                        // Update hidden input
                        $(this).val(globalType);

                        // Update UI
                        const dropdownButton = $(`#dropdownTypeProduct-${productId}`);
                        const formatSymbol = $(`#formatSymbolProduct-${productId}`);

                        dropdownButton.html(globalType === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase');
                        formatSymbol.text(globalType === 'nominal' ? 'Rp' : '%');

                        // Clear input value when type changes
                        $(`#discountInputProduct-${productId}`).val('');
                    }
                });
            }

            // Function to update product table
            function updateProductTable(products) {
                var tbody = $('#table1 tbody');
                tbody.empty();

                products.forEach(function(product) {
                    var hasActivePromo = product.has_active_promo;
                    var rowClass = hasActivePromo ? 'class="bg-light"' : '';
                    var disabled = hasActivePromo ? 'disabled' : '';

                    var row = `
                <tr ${rowClass}>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" name="product_ids[]" 
                                value="${product.id}" class="form-check-input select-item" ${disabled}>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${product.main_image}" 
                                loading="lazy" class="lazyload me-2" alt="Product Image"
                                style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                            <div>
                                ${product.product_name.length > 30 ? 
                                    product.product_name.substring(0, 30) + '...' : 
                                    product.product_name}
                                ${hasActivePromo ? '<div class="mt-1"><span class="badge bg-danger">Active Promo</span></div>' : ''}
                            </div>
                        </div>
                    </td>
                    <td>${product.stock_quantity}</td>               
                    <td>Rp. ${number_format(product.regular_price)}</td>
                    <td>
                        <input type="number" class="form-control form-control-sm limit-stock"
                            placeholder="Limit Stock"
                            name="limit_stock[${product.id}]"
                            data-product-id="${product.id}"
                            min="1" max="${product.stock_quantity}"
                            ${disabled}>
                    </td>
                    <td>
                        ${hasActivePromo ? 
                            '<span class="text-danger">Not Available</span>' : 
                            '<span class="text-success">Available</span>'}
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <button class="btn dropdown-toggle" type="button"
                                id="dropdownTypeProduct-${product.id}"
                                data-bs-toggle="dropdown" aria-expanded="false" ${disabled}>
                                <i class="bi bi-tag-fill me-1"></i>
                                Tipe Diskon <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu custom-dropdown-menu">
                                <li>
                                    <a class="custom-dropdown-item-product"
                                        href="#" data-type="nominal"
                                        data-product-id="${product.id}">
                                        <i class="bi bi-cash"></i>
                                        Nominal
                                    </a>
                                </li>
                                <li>
                                    <a class="custom-dropdown-item-product"
                                        href="#" data-type="percentage"
                                        data-product-id="${product.id}">
                                        <i class="bi bi-percent"></i>
                                        Persentase
                                    </a>
                                </li>
                            </ul>
                            <input type="text"
                                class="form-control form-control-sm border-start-0"
                                id="discountInputProduct-${product.id}"
                                name="product_discount[${product.id}]"
                                placeholder="Masukkan diskon"
                                ${disabled}>
                            <span class="input-group-text bg-light"
                                id="formatSymbolProduct-${product.id}">Rp</span>
                            <input type="hidden" 
                                name="discount_type[${product.id}]" 
                                value="${$('#globalDiscountType').val()}" 
                                id="discountType-${product.id}">
                        </div>
                    </td>
                </tr>
            `;
                    tbody.append(row);
                });

                // Reinitialize components
                reinitializeComponents();
            }

            // Helper function for number formatting
            function number_format(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Function to reinitialize components after table update
            function reinitializeComponents() {
                // Reinitialize select all functionality
                $('#select-all').off('change').on('change', function() {
                    $('.select-item:not([disabled])').prop('checked', $(this).prop('checked'));
                });

                // Handle product-specific discount type changes
                $('.custom-dropdown-item-product').off('click').on('click', function(e) {
                    e.preventDefault();
                    const type = $(this).data('type');
                    const productId = $(this).data('product-id');

                    // Mark this product as modified
                    modifiedProductTypes.add(productId);

                    // Update UI and hidden input
                    const dropdownButton = $(`#dropdownTypeProduct-${productId}`);
                    const formatSymbol = $(`#formatSymbolProduct-${productId}`);
                    const discountInput = $(`#discountInputProduct-${productId}`);
                    const discountTypeInput = $(`#discountType-${productId}`);

                    dropdownButton.html(type === 'nominal' ?
                        '<i class="bi bi-cash me-1"></i>Nominal' :
                        '<i class="bi bi-percent me-1"></i>Persentase');
                    formatSymbol.text(type === 'nominal' ? 'Rp' : '%');
                    discountInput.val('');
                    discountTypeInput.val(type);
                });

                // Handle discount input formatting
                $('input[id^="discountInputProduct-"]').off('input').on('input', function() {
                    const productId = this.id.split('-')[1];
                    const type = $(`#discountType-${productId}`).val();
                    let value = this.value.replace(/\D/g, '');

                    if (type === 'nominal') {
                        this.value = value ? formatRupiah(value) : '';
                    } else {
                        // Untuk persentase, batasi maksimal 100
                        value = Math.min(parseInt(value) || 0, 100);
                        this.value = value ? value.toString() : '';
                    }
                });

                // Handle global discount input formatting
                $('#discountInputAll').off('input').on('input', function() {
                    const type = $('#globalDiscountType').val();
                    let value = this.value.replace(/\D/g, '');

                    if (type === 'nominal') {
                        this.value = value ? formatRupiah(value) : '';
                    } else {
                        value = Math.min(parseInt(value) || 0, 100);
                        this.value = value ? value.toString() : '';
                    }
                });
            }

            // Initialize components on page load
            reinitializeComponents();
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
                    });
                });

                discountInput.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (currentType === 'nominal') {
                        this.value = value ? formatRupiah(value) : '';
                    } else {
                        // Untuk persentase, hanya tambahkan % di belakang angka
                        this.value = value ? value : '';
                    }
                });
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

                        productTypes[productId] = type;
                        dropdownButton.innerHTML = type === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase';
                        formatSymbol.textContent = type === 'nominal' ? 'Rp' : '%';
                        discountInput.value = ''; // Reset input when changing type
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


    {{-- handle add brand --}}
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

    {{-- handle format rupiah --}}
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

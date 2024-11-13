<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Promo - Glamoire</title>
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

        .table-hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25em 0.6em;
        }

        /* Optional: Add smooth transition for checkbox */
        .select-item {
            transition: opacity 0.2s ease-in-out;
        }

        .select-item:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo') }}">Promo
                                        </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Promo
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <form action="{{ route('store-promo') }}" class="form form-vertical" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <h3 class="mb-2">Buat Promo</h3>
                            <p class="mb-3">
                                Buat Promo sekarang untuk menarik Pembeli.
                                <a href="#" class="text-blue">Pelajari Lebih Lanjut</a>
                            </p>
                            <div class="card mb-4">
                                <div class="card-body">
                                    {{-- type --}}
                                    <input type="hidden" name="type" value="promo">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-icon-left mb-4">
                                                    <label for="first-name-icon">Nama Promo <span
                                                            style="color: red">*</span></label>
                                                    <div class="position-relative mt-2">
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                            placeholder="Masukkan nama promo" id="first-name-icon"
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
                                                            Masukkan nama promo. Ini akan ditampilkan kepada pengguna.
                                                        </small>
                                                    @endif
                                                </div>

                                                <div class="form-group has-icon-left mb-4">
                                                    <label for="daterange">Periode <span
                                                            style="color: red">*</span></label>
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
                                                            Pilih tanggal mulai dan berakhir untuk masa berlaku promo.
                                                            Gunakan format: MM/HH/YYYY.
                                                        </small>
                                                    @endif
                                                </div>

                                                <div class="mb-4">
                                                    <label for="promo_code" class="form-label">Kode Promo <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text">Glamo</span>
                                                        <input type="text" class="form-control" id="promo_code"
                                                            name="promo_code"
                                                            value="{{ strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 5)) }}">

                                                        <small class="form-text text-muted" style="font-size: 14px;">
                                                            Masukkan kombinasi angka dan huruf dari 0-9 dan a-z, dan
                                                            hanya harus sepanjang 5 digit.
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <label for="usage_quota">Kuota Penggunaan Maks <span
                                                                style="color: red">*</span></label>

                                                        <input type="text"
                                                            class="form-control {{ $errors->has('usage_quota') ? 'is-invalid' : '' }} mt-2"
                                                            placeholder="e.g., 100 times" name="usage_quota"
                                                            id="usage_quota" style="margin-bottom: 4px;"
                                                            value="{{ old('usage_quota') }}">
                                                        <small class="form-text text-muted">
                                                            Masukkan jumlah maksimum penggunaan item ini (misalnya, 100,
                                                            200).
                                                        </small>
                                                        @if ($errors->has('usage_quota'))
                                                            <p style="color: red">
                                                                {{ $errors->first('usage_quota') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="col">
                                                        <label for="max_quantity_buyer">Jumlah Maks Per Pembeli <span
                                                                style="color: red">*</span></label>

                                                        <input type="text"
                                                            class="form-control {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }} mt-2"
                                                            placeholder="e.g., 5 items per buyer"
                                                            name="max_quantity_buyer" id="max_quantity_buyer"
                                                            style="margin-bottom: 4px;"
                                                            value="{{ old('max_quantity_buyer') }}">
                                                        <small class="form-text text-muted">
                                                            Tentukan jumlah item maksimum yang dapat dibeli oleh satu
                                                            pembeli (misalnya, 1, 5, 10).
                                                        </small>
                                                        @if ($errors->has('max_quantity_buyer'))
                                                            <p style="color: red">
                                                                {{ $errors->first('max_quantity_buyer') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
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
                                                            <small class="form-text text-muted"
                                                                style="font-size: 14px;">
                                                                Masukkan jumlah transaksi minimum yang diperlukan untuk
                                                                menggunakan voucher.
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <label for="first-name-icon">Banner Promo <span
                                                            style="color: red">*</span></label>
                                                    <div class="image-upload-wrap mt-2" id="single-image-upload-wrap"
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
                                                    </div>

                                                    @if ($errors->has('image'))
                                                        <p style="color: red">
                                                            {{ $errors->first('image') }}</p>
                                                    @else
                                                        <small class="form-text text-muted">
                                                            Unggah gambar yang jelas dan berkualitas tinggi yang paling
                                                            mewakili produk Anda. Ini akan menjadi gambar utama yang
                                                            ditampilkan dalam hasil pencarian. Untuk format file,
                                                            gunakan JPG, JPEG, atau PNG, dan pastikan ukurannya tidak
                                                            lebih dari 2MB. Ukuran gambar harus 2560x2560dpx.
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
                                                <th>
                                                    <input type="checkbox" id="select-all"> Select All
                                                </th>
                                                <th>Product</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr @if ($product->has_active_promo) class="bg-light" @endif>
                                                    <td>
                                                        <input type="checkbox" name="product_ids[]"
                                                            value="{{ $product->id }}" class="select-item"
                                                            @if ($product->has_active_promo) disabled @endif>
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
                                                                @if ($product->has_active_promo)
                                                                    <div class="mt-1">
                                                                        <span class="badge bg-danger">Active
                                                                            Promo</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $product->stock_quantity }}</td>
                                                    <td>Rp. {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        @if ($product->has_active_promo)
                                                            <span class="text-danger">Not Available</span>
                                                        @else
                                                            <span class="text-success">Available</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light-secondary me-3">Reset
                                            Promo</button>
                                        <button type="submit" class="btn btn-sm btn-primary me-1">Submit
                                            Promo</button>
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

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const discountInput = document.getElementById('discountInputAll');
            const globalDiscountTypeInput = document.getElementById('globalDiscountType');
            const checkboxes = document.querySelectorAll('.select-item');

            function calculateDiscountedPrice(originalPrice, discount, discountType) {
                if (!discount || isNaN(discount)) return originalPrice;

                if (discountType === 'percentage') {
                    return originalPrice - (originalPrice * (discount / 100));
                } else {
                    return originalPrice - discount;
                }
            }

            function formatPrice(price) {
                return price.toLocaleString('id-ID');
            }

            function updateDiscountedPrices() {
                // Get discount value and remove non-numeric characters
                const discountValue = discountInput.value.replace(/[^\d]/g, '');
                const discount = parseFloat(discountValue);
                const discountType = globalDiscountTypeInput.value;

                checkboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const priceCell = row.querySelector('td:nth-child(4)');
                    const originalPriceText = priceCell.innerText.split('After discount')[
                        0]; // Get only the original price
                    const originalPrice = parseFloat(originalPriceText.replace(/[^\d]/g, ''));

                    // Remove any existing discounted price display
                    const existingDiscountSpan = priceCell.querySelector('.discounted-price');
                    if (existingDiscountSpan) {
                        existingDiscountSpan.remove();
                    }

                    // Only show discount if checkbox is checked
                    if (checkbox.checked && !isNaN(discount) && discount > 0) {
                        const discountedPrice = calculateDiscountedPrice(originalPrice, discount,
                            discountType);

                        // Create and append discounted price element
                        const discountSpan = document.createElement('div');
                        discountSpan.className = 'discounted-price text-danger mt-1';
                        discountSpan.innerHTML = `
                    <small class="text-muted">After discount: </small>
                    <span class="fw-bold">Rp ${formatPrice(discountedPrice)}</span>
                `;
                        priceCell.appendChild(discountSpan);
                    }
                });
            }

            // Event listeners
            discountInput.addEventListener('input', updateDiscountedPrices);

            document.querySelectorAll('.custom-dropdown-item-all').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const type = this.dataset.type;
                    const dropdownButton = document.getElementById('dropdownTypeAll');
                    const formatSymbol = document.getElementById('formatSymbolAll');

                    dropdownButton.innerHTML = type === 'nominal' ?
                        '<i class="bi bi-cash me-1"></i>Nominal' :
                        '<i class="bi bi-percent me-1"></i>Persentase';
                    formatSymbol.textContent = type === 'nominal' ? 'Rp' : '%';
                    globalDiscountTypeInput.value = type;
                    discountInput.value = '';

                    updateDiscountedPrices();
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateDiscountedPrices);
            });

            // Handle "Select All" checkbox
            const selectAllCheckbox = document.getElementById('select-all');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateDiscountedPrices();
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format number to Indonesian Rupiah
            const formatRupiah = (number) => {
                const formatted = number.toString().replace(/\D/g, '');
                if (!formatted) return ''; // Jika input kosong, tidak perlu pemrosesan lebih lanjut

                let parsedValue = parseInt(formatted);

                // Jika parsedValue tidak valid, kembalikan string kosong
                if (isNaN(parsedValue)) {
                    return '';
                }

                return parsedValue.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0, // Menghapus digit desimal
                    maximumFractionDigits: 0
                }).replace("IDR", "").trim(); // Menghapus IDR dari string hasil
            };

            // Convert formatted string back to number
            const getNumericValue = (formattedString) => {
                return parseInt(formattedString.replace(/\D/g, '')) || 0;
            };

            // Handle All Products discount
            const initializeAllProductsDiscount = () => {
                const dropdownItems = document.querySelectorAll('.custom-dropdown-item-all');
                const dropdownButton = document.getElementById('dropdownTypeAll');
                const formatSymbol = document.getElementById('formatSymbolAll');
                const discountInput = document.getElementById('discountInputAll');
                const globalDiscountTypeInput = document.getElementById('globalDiscountType');
                const form = discountInput.closest('form');

                let currentType = 'nominal';

                dropdownItems.forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentType = this.dataset.type;
                        dropdownButton.innerHTML = currentType === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase';
                        formatSymbol.textContent = currentType === 'nominal' ? 'Rp' : '%';
                        discountInput.value = '';
                        globalDiscountTypeInput.value = currentType;
                    });
                });

                discountInput.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (currentType === 'nominal') {
                        this.value = value ? formatRupiah(value) : '';
                    } else {
                        this.value = value ? value : '';
                    }
                });

                // Add hidden input for storing numeric value
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = discountInput.name;
                discountInput.name = discountInput.name + '_display';
                discountInput.after(hiddenInput);

                // Update hidden input before form submission
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const numericValue = getNumericValue(discountInput.value);
                        hiddenInput.value = numericValue;
                    });
                }
            };

            // Initialize both handlers
            initializeAllProductsDiscount();
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount - Glamoire</title>

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
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
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
                    <h3 class="mb-2">Buat Diskon</h3>
                    <p class="mb-3">
                        Buat Diskon Produk Untuk Menarik Minat Pembeli.
                        <a href="#" class="text-blue"></a>
                    </p>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo-diskon') }}">Promo
                                            Discount</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Promo Discount</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <form action="{{ route('store-promo-diskon') }}" class="form form-vertical" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h4 class="">Buat Diskon Promosi</h4>
                                <p class="text-muted mb-0">Isi formulir di bawah ini untuk membuat diskon promosi
                                    baru. Pastikan semua informasi yang diperlukan disertakan, termasuk nama diskon,
                                    rentang tanggal, dan produk yang akan diberi diskon.
                                </p>
                            </div>
                            <div class="card-body">
                                {{-- type --}}
                                <input type="hidden" name="type" value="discount">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="form-group has-icon-left" style="margin-bottom: 40px;">
                                                <label for="promo_name">Nama Diskon <span
                                                        style="color: red">*</span></label>
                                                <div class="position-relative">
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                        placeholder="Example: 20% Off" id="promo_name" name="promo_name"
                                                        value="{{ old('promo_name') }}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-bag"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('promo_name'))
                                                    <p class="text-danger">
                                                        {{ $errors->first('promo_name') }}</p>
                                                @endif
                                                <small class="form-text text-muted" style="font-size: 14px;">Masukkan
                                                    nama diskon yang akan
                                                    ditampilkan kepada pelanggan.</small>
                                            </div>

                                            <div class="form-group has-icon-left">
                                                <label for="daterange">Periode <span style="color: red">*</span></label>
                                                <div class="position-relative">
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                                        id="daterange" name="date_range"
                                                        value="{{ old('date_range') }}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-calendar"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('date_range'))
                                                    <p class="text-danger">
                                                        {{ $errors->first('date_range') }}</p>
                                                @endif
                                                <small class="form-text text-muted" style="font-size: 14px;">Pilih
                                                    rentang tanggal di mana diskon akan berlaku.
                                                </small>
                                            </div>

                                        </div>

                                        <div class="col-md-12 mb-4">
                                            <div class="form-group has-icon-left">
                                                <label for="promo_name">Batas Pembelian <span
                                                        style="color: red">*</span></label>
                                                <div class="position-relative">
                                                    <input type="number"
                                                        class="form-control {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }}"
                                                        id="max_quantity_buyer" name="max_quantity_buyer"
                                                        value="{{ old('max_quantity_buyer') }}" min="0"
                                                        max="100">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-cart-fill"></i>
                                                    </div>
                                                </div>
                                                @if ($errors->has('max_quantity_buyer'))
                                                    <p class="text-danger">
                                                        {{ $errors->first('max_quantity_buyer') }}</p>
                                                @endif
                                                <small class="form-text text-muted" style="font-size: 14px;">Masukkan
                                                    nama diskon yang akan
                                                    ditampilkan kepada pelanggan.
                                                </small>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <label class="form-label">Pilih Jenis Diskon <span
                                                        style="color: red">*</span></label>
                                                <div class="form-group">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="discount_type" id="percentage_discount"
                                                            value="percentage" checked>
                                                        <label class="form-check-label" for="percentage_discount">
                                                            <strong>Persentase Diskon</strong><br>
                                                            <small class="text-muted">Contoh: Pilih 3,
                                                                diskon 10%<br>
                                                                Cocok untuk produk yang relatif lebih
                                                                murah</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="discount_type" id="nominal_discount"
                                                            value="nominal">
                                                        <label class="form-check-label" for="nominal_discount">
                                                            <strong>Nominal Diskon</strong><br>
                                                            <small class="text-muted">Contoh: Pilih 3,
                                                                diskon Rp10.000<br>
                                                                Cocok untuk produk yang relatif lebih
                                                                mahal</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="discount_type" id="package_price" value="package">
                                                        <label class="form-check-label" for="package_price">
                                                            <strong>Harga Paket Diskon</strong><br>
                                                            <small class="text-muted">Contoh: Beli 3
                                                                produk dengan harga Rp100.000<br>
                                                                Cocok untuk produk yang sering dibeli
                                                                bersamaan, seperti shampo dan
                                                                kondisioner</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Container untuk form tier diskon -->
                                        <div id="discount-container">
                                            <!-- Persentase Diskon -->
                                            <div id="percentage-form" class="discount-form">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Diskon Bertingkat - Persentase</h4>
                                                        <p class="text-muted mb-0">Atur diskon
                                                            berdasarkan jumlah pembelian</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="percentage-tiers">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tingkat</th>
                                                                        <th>Jumlah Minimal</th>
                                                                        <th>Diskon (%)</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="tier-1">
                                                                        <td>1</td>
                                                                        <td>
                                                                            <input type="number"
                                                                                name="percentage_min_quantity[]"
                                                                                class="form-control" value="2"
                                                                                min="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number"
                                                                                name="percentage_discount_value[]"
                                                                                class="form-control" value="10"
                                                                                min="0" max="100">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm delete-tier"
                                                                                style="display: none;">
                                                                                <i class="bi bi-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="mt-3">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="addTier('percentage')">
                                                                    <i class="bi bi-plus"></i> Tambah
                                                                    Tingkat
                                                                </button>
                                                                <small class="text-muted d-block mt-2">Maksimal
                                                                    3 tingkat diskon</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Nominal Diskon -->
                                            <div id="nominal-form" class="discount-form" style="display: none;">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Diskon Bertingkat - Nominal</h4>
                                                        <p class="text-muted mb-0">Atur diskon nominal
                                                            berdasarkan jumlah pembelian</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="nominal-tiers">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tingkat</th>
                                                                        <th>Jumlah Minimal</th>
                                                                        <th>Diskon (Rp)</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="nominal-tier-1">
                                                                        <td>1</td>
                                                                        <td>
                                                                            <input type="number"
                                                                                name="nominal_min_quantity[]"
                                                                                class="form-control" value="2"
                                                                                min="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number"
                                                                                name="nominal_discount_value[]"
                                                                                class="form-control" value="10000"
                                                                                min="0">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm delete-tier"
                                                                                style="display: none;">
                                                                                <i class="bi bi-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="mt-3">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="addTier('nominal')">
                                                                    <i class="bi bi-plus"></i> Tambah
                                                                    Tingkat
                                                                </button>
                                                                <small class="text-muted d-block mt-2">Maksimal
                                                                    3 tingkat diskon</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Harga Paket -->
                                            <div id="package-form" class="discount-form" style="display: none;">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Diskon Paket</h4>
                                                        <p class="text-muted mb-0">Atur harga paket
                                                            berdasarkan jumlah pembelian</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="package-tiers">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tingkat</th>
                                                                        <th>Jumlah Produk</th>
                                                                        <th>Harga Paket (Rp)</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="package-tier-1">
                                                                        <td>1</td>
                                                                        <td>
                                                                            <input type="number"
                                                                                name="package_quantity[]"
                                                                                class="form-control" value="2"
                                                                                min="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number"
                                                                                name="package_price[]"
                                                                                class="form-control" value="100000"
                                                                                min="0">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm delete-tier"
                                                                                style="display: none;">
                                                                                <i class="bi bi-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="mt-3">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="addTier('package')">
                                                                    <i class="bi bi-plus"></i> Tambah
                                                                    Tingkat
                                                                </button>
                                                                <small class="text-muted d-block mt-2">Maksimal
                                                                    3 tingkat diskon</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                            <th>Limit Stock Product</th>
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
                                                            loading="lazy" class="lazyload me-2" alt="Product Image"
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
                                                    <input type="number" class="form-control limit-stock"
                                                        placeholder="Limit Stock"
                                                        name="limit_stock[{{ $product->id }}]"
                                                        data-product-id="{{ $product->id }}" min="1"
                                                        max="{{ $product->stock_quantity }}"
                                                        value="{{ old('limit_stock.' . $product->id, '') }}" disabled
                                                        @if ($product->has_active_promo) disabled @endif>
                                                    @if ($errors->has('limit_stock.' . $product->id))
                                                        <small
                                                            class="text-danger">{{ $errors->first('limit_stock.' . $product->id) }}</small>
                                                    @endif
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
                                    <a href="{{ route('index-promo-diskon') }}" class="btn btn-secondary btn-sm me-3"
                                        style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-box-arrow-in-left me-1"></i> Kembali
                                    </a>
                                    <button type="reset" class="btn btn-sm btn-light-secondary me-3">Reset
                                        Promo</button>
                                    <button type="submit" class="btn btn-sm btn-primary me-1">Submit
                                        Promo</button>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle checkbox selection
            const checkboxes = document.querySelectorAll('.select-item');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const productId = this.value;
                    const limitStockInput = document.querySelector(
                        `input[name="limit_stock[${productId}]"]`);

                    if (limitStockInput) {
                        if (this.checked) {
                            limitStockInput.removeAttribute('disabled');
                            // Hapus atribut required
                            // limitStockInput.required = true; // Ini dihapus
                        } else {
                            limitStockInput.setAttribute('disabled', 'disabled');
                            // Hapus atribut required
                            // limitStockInput.required = false; // Ini dihapus
                            limitStockInput.value = ''; // Clear the value when unchecked
                        }
                    }
                });
            });

            // Handle "Select All" checkbox if you have one
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
                    const value = this.value.trim(); // Gunakan trim() untuk menghapus spasi

                    // Jika input kosong, batalkan validasi
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
        });
    </script>

    <script>
        // Objek untuk menyimpan state tiap jenis diskon
        const discountStates = {
            percentage: {
                currentTier: 1
            },
            nominal: {
                currentTier: 1
            },
            package: {
                currentTier: 1
            }
        };

        const maxTiers = 3;

        // Handler untuk radio button
        document.querySelectorAll('input[name="discount_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Sembunyikan semua form
                document.querySelectorAll('.discount-form').forEach(form => {
                    form.style.display = 'none';
                });

                // Tampilkan form yang sesuai
                const formId = this.value + '-form';
                document.getElementById(formId).style.display = 'block';
            });
        });

        function addTier(type) {
            if (discountStates[type].currentTier >= maxTiers) {
                alert('Maksimal ' + maxTiers + ' tingkat diskon');
                return;
            }

            discountStates[type].currentTier++;
            const tier = discountStates[type].currentTier;

            let template = '';
            switch (type) {
                case 'percentage':
                    template = `
                <tr id="percentage-tier-${tier}">
                    <td>${tier}</td>
                    <td><input type="number" name="percentage_min_quantity[]" class="form-control" value="${tier + 1}" min="2"></td>
                    <td><input type="number" name="percentage_discount_value[]" class="form-control" value="${tier * 5 + 5}" min="0" max="100"></td>
                    <td><button type="button" class="btn btn-danger btn-sm delete-tier" onclick="deleteTier('${type}', ${tier})"><i class="bi bi-trash"></i></button></td>
                </tr>
            `;
                    break;
                case 'nominal':
                    template = `
                <tr id="nominal-tier-${tier}">
                    <td>${tier}</td>
                    <td><input type="number" name="nominal_min_quantity[]" class="form-control" value="${tier + 1}" min="2"></td>
                    <td><input type="number" name="nominal_discount_value[]" class="form-control" value="${10000 * tier}" min="0"></td>
                    <td><button type="button" class="btn btn-danger btn-sm delete-tier" onclick="deleteTier('${type}', ${tier})"><i class="bi bi-trash"></i></button></td>
                </tr>
            `;
                    break;
                case 'package':
                    template = `
                <tr id="package-tier-${tier}">
                    <td>${tier}</td>
                    <td><input type="number" name="package_quantity[]" class="form-control" value="${tier + 1}" min="2"></td>
                    <td><input type="number" name="package_price[]" class="form-control" value="${100000 * tier}" min="0"></td>
                    <td><button type="button" class="btn btn-danger btn-sm delete-tier" onclick="deleteTier('${type}', ${tier})"><i class="bi bi-trash"></i></button></td>
                </tr>
            `;
                    break;
            }

            document.querySelector(`#${type}-tiers tbody`).insertAdjacentHTML('beforeend', template);
            updateDeleteButtons(type);
        }

        function deleteTier(type, tier) {
            document.getElementById(`${type}-tier-${tier}`).remove();
            discountStates[type].currentTier--;
            reorderTiers(type);
            updateDeleteButtons(type);
        }

        function reorderTiers(type) {
            const rows = document.querySelectorAll(`#${type}-tiers tbody tr`);
            rows.forEach((row, index) => {
                const newIndex = index + 1;
                row.id = `${type}-tier-${newIndex}`;
                row.cells[0].textContent = newIndex;
                row.querySelector('.delete-tier').setAttribute('onclick', `deleteTier('${type}', ${newIndex})`);
            });
        }

        function updateDeleteButtons(type) {
            const deleteButtons = document.querySelectorAll(`#${type}-tiers .delete-tier`);
            deleteButtons.forEach(button => {
                button.style.display = discountStates[type].currentTier > 1 ? 'block' : 'none';
            });
        }
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

    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/vendors/toastify/toastify.js"></script>

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

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

        .form-control:not(:placeholder-shown) {
            border-color: #dee2e6;
        }

        .form-control {
            padding-right: 8px;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .badge {
            padding: 0.25em 0.5em;
            font-size: 0.75em;
            border-radius: 0.25rem;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        .badge.bg-success {
            background-color: #198754 !important;
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
                                    <li class="breadcrumb-item active" aria-current="page">Update Promo Limited Voucher
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <form action="{{ route('update-promo-voucher-limited', $promo->id) }}" class="form form-vertical"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="limited voucher">

                        <div class="container">
                            <h3 class="mb-2">Update Voucher</h3>
                            <p class="mb-3">
                                Update a Limited Voucher now to attract Buyers.
                                <a href="#" class="text-blue">Learn More</a>
                            </p>
                            <div class="card mb-4">
                                <div class="card-body">
                                    {{-- type --}}
                                    <input type="hidden" name="type" value="new user voucher">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Voucher Name <span
                                                            style="color: red">*</span></label>
                                                    <div class="position-relative mt-2">
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
                                                        <small class="form-text text-muted"
                                                            style="font-size: 14px;">Enter the name of
                                                            the voucher. This will be displayed to
                                                            users.</small>
                                                    @endif
                                                </div>

                                                <div class="form-group has-icon-left">
                                                    <label for="daterange">Date Range <span
                                                            style="color: red">*</span></label>
                                                    <div class="position-relative mt-2">
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                                            id="daterange" name="date_range"
                                                            value="{{ $promo->date_range }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-calendar"></i>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('date_range'))
                                                        <p style="color: red">{{ $errors->first('date_range') }}
                                                        </p>
                                                    @else
                                                        <small class="form-text text-muted"
                                                            style="font-size: 14px;">Select the start and
                                                            end dates for the voucher validity. Use the format:
                                                            MM/DD/YYYY.</small>
                                                    @endif
                                                </div>

                                                <label for="promo_code" class="form-label">Voucher Code <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text">Glamo</span>
                                                    <input type="text" class="form-control" id="promo_code"
                                                        name="promo_code" value="{{ $promo->promo_code }}">

                                                    <small class="form-text text-muted" style="font-size: 14px;">
                                                        Enter a combination of numbers and letters from 0-9 and
                                                        a-z, and it should only be 5 digits long.
                                                    </small>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="usage_quota">Max Usage Quota <span
                                                                style="color: red">*</span></label>
                                                        <input type="text"
                                                            class="form-control mt-2 {{ $errors->has('usage_quota') ? 'is-invalid' : '' }}"
                                                            placeholder="e.g., 100 times" name="usage_quota"
                                                            id="usage_quota" style="margin-bottom: 4px;"
                                                            value="{{ $promo->usage_quota }}">
                                                        <small class="form-text text-muted">Enter the maximum
                                                            number of times this item can be used (e.g., 100,
                                                            200).</small>
                                                        @if ($errors->has('usage_quota'))
                                                            <p style="color: red">
                                                                {{ $errors->first('usage_quota') }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="col">
                                                        <label for="max_quantity_buyer">Max Quantity Per Buyer
                                                            <span style="color: red">*</span></label>
                                                        <input type="text"
                                                            class="form-control mt-2 {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }}"
                                                            placeholder="e.g., 5 items per buyer"
                                                            name="max_quantity_buyer" id="max_quantity_buyer"
                                                            style="margin-bottom: 4px;"
                                                            value="{{ $promo->max_quantity_buyer }}">
                                                        <small class="form-text text-muted">Specify the maximum
                                                            number of items a single buyer can purchase (e.g.,
                                                            1, 5, 10).</small>
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
                                                                placeholder="Masukkan nilai diskon"
                                                                value="{{ $promo->discount_value }}">
                                                            <span class="input-group-text bg-light"
                                                                id="formatSymbolAll">{{ $promo->discount_type == 'nominal' ? 'Rp' : '%' }}</span>
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

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="min_transaction">Minimum Transaction <span
                                                                style="color: red">*</span></label>
                                                        <div class="input-group mt-2">
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
                                                                style="font-size: 14px;">Enter the minimum
                                                                transaction amount required to apply the
                                                                voucher.</small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <label for="first-name-icon">Banner Voucher <span
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
                                                        <small class="form-text text-muted">Upload a clear,
                                                            high-quality image that best represents your
                                                            product. This will be the main image shown in search
                                                            results. For file formats, please use JPG, JPEG, or
                                                            PNG, and ensure the size is no more than
                                                            2MB.</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

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
                const globalDiscountType = document.getElementById('globalDiscountType'); // Hidden input
                let currentType = 'nominal'; // Default tipe

                dropdownItems.forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentType = this.dataset.type;

                        // Perbarui dropdown dan simbol format
                        dropdownButton.innerHTML = currentType === 'nominal' ?
                            '<i class="bi bi-cash me-1"></i>Nominal' :
                            '<i class="bi bi-percent me-1"></i>Persentase';
                        formatSymbol.textContent = currentType === 'nominal' ? 'Rp' : '%';
                        discountInput.value = ''; // Reset input saat tipe diubah

                        // Perbarui nilai tipe diskon di hidden input
                        globalDiscountType.value = currentType;
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

            // Handle individual product discounts (if needed)
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
                        discountInput.value = ''; // Reset input saat tipe diubah
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
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

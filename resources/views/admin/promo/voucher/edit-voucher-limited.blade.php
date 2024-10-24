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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box-single {
            width: 175px;
            height: 177px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
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
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo-voucher') }}">Promo
                                            Voucher</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Promo Limited Voucher
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('update-promo-voucher', $promo->id) }}"
                                            class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="type" value="voucher">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Voucher Name <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Voucher Name"
                                                                    id="first-name-icon" name="promo_name"
                                                                    value="{{ $promo->promo_name }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('promo_name'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('promo_name') }}
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
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                                                    id="daterange" name="date_range"
                                                                    value="{{ $promo->date_range }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('date_range'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('date_range') }}
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
                                                            <span class="input-group-text">Glam</span>
                                                            <input type="text" class="form-control" id="promo_code"
                                                                name="promo_code"
                                                                value="{{ $promo->promo_code }}">

                                                            <small class="form-text text-muted"
                                                                style="font-size: 14px;">
                                                                Enter a combination of numbers and letters from 0-9 and
                                                                a-z, and it should only be 5 digits long.
                                                            </small>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="usage_quota">Max Usage Quota <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('usage_quota') ? 'is-invalid' : '' }}"
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
                                                                    class="form-control {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }}"
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

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="first-name-icon">Discount <span
                                                                            style="color: red">*</span></label>
                                                                    <div class="position-relative">
                                                                        <input type="text"
                                                                            class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                                                            placeholder="Enter Discount"
                                                                            id="first-name-icon" name="discount"
                                                                            value="{{ $promo->discount }}">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-percent"></i>
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('discount'))
                                                                        <p style="color: red">
                                                                            {{ $errors->first('discount') }}</p>
                                                                    @else
                                                                        <small class="form-text text-muted"
                                                                            style="font-size: 14px;">Enter the
                                                                            discount amount (e.g., 10 for 10%
                                                                            off).</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="first-name-icon">Max Discount <span
                                                                            style="color: red">*</span></label>
                                                                    <div class="position-relative">
                                                                        <input type="text"
                                                                            class="form-control {{ $errors->has('max_discount') ? 'is-invalid' : '' }}"
                                                                            placeholder="Enter Max Discount"
                                                                            id="first-name-icon" name="max_discount"
                                                                            value="{{ $promo->max_discount }}">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-percent"></i>
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('max_discount'))
                                                                        <p style="color: red">
                                                                            {{ $errors->first('max_discount') }}</p>
                                                                    @else
                                                                        <small class="form-text text-muted"
                                                                            style="font-size: 14px;">Specify the
                                                                            maximum discount amount that can be applied
                                                                            (e.g., 50).</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="min_transaction">Minimum Transaction <span
                                                                    style="color: red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('min_transaction') ? 'is-invalid' : '' }}"
                                                                    id="min_transaction" placeholder="x.xxx.xxx"
                                                                    name="min_transaction"
                                                                    value="{{ $promo->min_transaction }}">
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

                                                        <div class="card">
                                                            <label for="first-name-icon">Banner Voucher <span
                                                                    style="color: red">*</span></label>
                                                            <div class="image-upload-wrap"
                                                                id="single-image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 8px; height: auto;">
                                                                <input type="file" name="image"
                                                                    class="file-upload-input"
                                                                    onchange="readURLSingle(this);" accept="image/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a file or select to add Image</p>
                                                                </div>
                                                            </div>

                                                            <div class="file-upload-content"
                                                                id="single-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Gambar yang diunggah akan ditambahkan di sini -->
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

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="reset"
                                                            class="btn btn-sm btn-light-secondary me-3">Reset
                                                            Voucher</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1">Submit Voucher</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box-multiple {
            width: 195px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-box-single {
            width: 450px;
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
                            {{-- <h3>Add Voucher New User</h3> --}}
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo-new-user') }}">Voucher
                                            New
                                            User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Voucher New User</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">

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
                                        <form action="{{ route('store-promo-new-user') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="type" value="new user">

                                            <div class="form-body">
                                                <h4 class="mb-4">Create New User Voucher</h4>
                                                <p class="text-muted">Fill out the form below to create a new user
                                                    voucher. Ensure that all required fields are filled out, including
                                                    the voucher name, minimum transaction, discount, and maximum
                                                    discount.</p>

                                                <div class="row">
                                                    <!-- Left Column -->
                                                    <div class="col-md-6">
                                                        <!-- Voucher Name -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="voucher-name">Voucher Name <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter the name of the voucher (e.g., New User Discount)"
                                                                    id="voucher-name" name="promo_name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('promo_name'))
                                                                <p style="color: red">{{ $errors->first('promo_name') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted" style="font-size: 14px;">Choose a
                                                                unique and descriptive name for this voucher.</small>
                                                        </div>

                                                        <!-- Minimum Transaction -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="min-transaction">Minimum Transaction <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('min_transaction') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter the minimum transaction amount (e.g., $100)"
                                                                    id="min-transaction" name="min_transaction">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cart"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('min_transaction'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('min_transaction') }}</p>
                                                            @endif
                                                            <small class="text-muted" style="font-size: 14px;">Specify
                                                                the minimum transaction value to apply the
                                                                voucher.</small>
                                                        </div>
                                                    </div>

                                                    <!-- Right Column -->
                                                    <div class="col-md-6">
                                                        <!-- Discount -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="discount">Discount (%) <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter the discount percentage (e.g., 10%)"
                                                                    id="discount" name="discount">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-percent"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('discount'))
                                                                <p style="color: red">{{ $errors->first('discount') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted" style="font-size: 14px;">Provide
                                                                the percentage of discount users will receive.</small>
                                                        </div>

                                                        <!-- Maximum Discount -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="max-discount">Maximum Discount Amount <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('max_discount') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter the maximum discount amount (e.g., $50)"
                                                                    id="max-discount" name="max_discount">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('max_discount'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('max_discount') }}</p>
                                                            @endif
                                                            <small class="text-muted" style="font-size: 14px;">Set a
                                                                limit on the maximum discount amount a user can
                                                                receive.</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="reset"
                                                            class="btn btn-sm btn-light-secondary me-3">Reset</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1">Submit</button>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

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

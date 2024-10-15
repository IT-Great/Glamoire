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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


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

                <!-- Basic Horizontal form layout section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('store-promo-diskon') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="type" value="discount">

                                            <div class="form-body">
                                                <h4 class="mb-4">Create a Promotional Discount</h4>
                                                <p class="text-muted">Fill out the form below to create a new
                                                    promotional discount. Please ensure all required information is
                                                    provided, including the discount name, date range, and the products
                                                    to be discounted.</p>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left"
                                                            style="margin-bottom: 20px;">
                                                            <label for="promo_name">Discount Name <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Example: 20% Off" id="promo_name"
                                                                    name="promo_name" value="{{ old('promo_name') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('promo_name'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('promo_name') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter the name of the discount
                                                                that will be displayed to customers.</small>
                                                        </div>

                                                        <div class="form-group has-icon-left">
                                                            <label for="daterange">Date Range <span
                                                                    style="color: red">*</span></label>
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
                                                            <small class="text-muted">Select the date range during which
                                                                the discount will be valid.</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left"
                                                            style="margin-bottom: 20px;">
                                                            <label for="discount">Discount Amount (%) <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="number"
                                                                    class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Discount Percentage"
                                                                    id="discount" name="discount"
                                                                    value="{{ old('discount') }}" min="0"
                                                                    max="100">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-percent"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('discount'))
                                                                <p class="text-danger">{{ $errors->first('discount') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted">Enter the discount percentage
                                                                (e.g., enter 20 for a 20% discount).</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12" style="margin-bottom: 20px;">
                                                        <div class="mb-2">
                                                            <label for="product_ids">Select Products <span
                                                                    style="color: red">*</span></label><br>
                                                            <small class="text-muted">Select the products to which you
                                                                want
                                                                to apply the discount. You can choose multiple
                                                                products.</small>
                                                        </div>
                                                        <table class="table" id="table1">
                                                            <thead>
                                                                <tr>
                                                                    <th>Select</th>
                                                                    <th>Product</th>
                                                                    <th>Stock</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($products as $product)
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox"
                                                                                name="product_ids[]"
                                                                                value="{{ $product->id }}">
                                                                        </td>
                                                                        <td>
                                                                            <img src="{{ Storage::url($product->main_image) }}"
                                                                                loading="lazy" class="lazyload"
                                                                                alt="Product Image"
                                                                                style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                                                            {{ $product->product_name }}
                                                                        </td>
                                                                        <td>{{ $product->stock_quantity }}</td>
                                                                        <td>Rp.
                                                                            {{ number_format($product->regular_price, 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="reset"
                                                            class="btn btn-sm btn-light-secondary me-1 mb-1"
                                                            style="margin-bottom: 20px;">Reset</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1 mb-1"
                                                            style="margin-bottom: 20px;">Create Discount</button>
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
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
    <!-- toastify -->
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

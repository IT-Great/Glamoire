<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

    <style>
        :root {
            --primary: #435ebe;
            --primary-light: #546fd0;
            --success: #4fbe87;
            --danger: #eb5757;
            --warning: #f59e0b;
            --info: #3b82f6;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
        }

        .promo-nav {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .promo-nav-item {
            padding: 12px 24px;
            border-radius: 10px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .promo-nav-item i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .promo-nav-item.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.2);
        }

        .promo-nav-item:hover:not(.active) {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 25px 30px;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
        }

        .card-header h4 i {
            margin-right: 10px;
            color: var(--primary);
        }

        .card-body {
            padding: 25px 30px;
        }

        .btn {
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 3px 10px rgba(67, 94, 190, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
            background-color: #fff;
        }

        .form-control-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 12px;
            color: var(--secondary);
        }

        .form-control-icon+.form-control {
            padding-left: 40px;
        }

        .has-icon-left .form-control {
            padding-left: 40px;
        }

        .form-select {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
        }

        .image-upload-wrap {
            border: 2px dashed #e0e0e0;
            border-radius: 15px;
            position: relative;
            text-align: center;
            transition: all 0.3s ease;
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .image-upload-wrap:hover {
            border-color: var(--primary);
            background-color: rgba(67, 94, 190, 0.03);
        }

        .file-upload-input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .bg-light-primary {
            background-color: rgba(67, 94, 190, 0.1) !important;
        }

        .text-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }

        footer {
            padding: 2rem 0;
            margin-top: 2rem;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title" style="margin-bottom: 25px;">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Supplier Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/invoice">Supplier</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Supplier</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('index-invoice') }}"
                        class="promo-nav-item {{ Route::currentRouteName() == 'index-invoice' ? 'active' : '' }}">
                        <i class="bi bi-receipt"></i>Invoice Management
                    </a>
                    <a href="{{ route('index-supplier') }}"
                        class="promo-nav-item {{ Route::currentRouteName() == 'index-supplier' ? 'active' : '' }}">
                        <i class="bi bi-truck"></i>Supplier Management
                    </a>
                    <a href="{{ route('create-invoice') }}"
                        class="promo-nav-item {{ Route::currentRouteName() == 'invoice-reports' ? 'active' : '' }}">
                        <i class="bi bi-graph-up"></i>Reports & Analytics
                    </a>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="bi bi-file-earmark-plus"></i> Create New Supplier</h4>
                                    <p class="text-subtitle text-muted">Fill in the form below to create a new Supplier
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('store-supplier') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    {{-- start kiri --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">Name
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Name" id="name"
                                                                    name="name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('name'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('name') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter a name supplier
                                                                (Helmi, beni)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">Email
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Email" id="email"
                                                                    name="email">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('email'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('email') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter email Supplier
                                                                (beni@example.com)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">City
                                                            </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter City" id="city"
                                                                    name="city">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('city'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('city') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter a city supplier
                                                                (Surabaya, SIdoarjo)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">Post Code
                                                            </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('post_code') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Post Code" id="post_code"
                                                                    name="post_code">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('post_code'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('post_code') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter post code supplier
                                                                (61124)</small>
                                                        </div>
                                                    </div>


                                                    {{-- start kanan --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">No. Telp
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter No Telp" id="no_telp"
                                                                    name="no_telp">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('no_telp'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('no_telp') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter no telp supplier
                                                                (+6298979****)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">Address
                                                            </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Address" id="address"
                                                                    name="address">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('address'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('address') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter address supplier
                                                                (Jl. Raya No 112)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">Province
                                                            </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('province') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Province" id="province"
                                                                    name="province">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('province'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('province') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter Province supplier
                                                                (Jawa Timur, Jawa Tengah)</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="description" class="form-label">Description
                                                            </label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Enter description" id="description" rows="4"
                                                                    style="height: 100px"></textarea>
                                                                <label for="description">Description</label>
                                                            </div>
                                                            <small class="text-muted">Enter details about this
                                                                supplier</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="card bg-light-primary bg-opacity-25 mb-4">
                                                            <div class="card-body py-3">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="bi bi-info-circle-fill text-primary me-2"
                                                                        style="font-size: 1.5rem;"></i>
                                                                    <div>
                                                                        <h6 class="mb-0">Invoice Summary</h6>
                                                                        <p class="mb-0 text-muted small">Please review
                                                                            all information before submitting</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-3">
                                                        <button type="button" class="btn btn-light-secondary me-2"
                                                            style="border-radius: 8px;">
                                                            <i class="bi bi-x-circle me-1"></i>
                                                            Cancel
                                                        </button>
                                                        <button type="reset" class="btn btn-light-secondary me-2"
                                                            style="border-radius: 8px;">
                                                            <i class="bi bi-arrow-repeat me-1"></i>
                                                            Reset
                                                        </button>
                                                        <button type="submit" class="btn btn-primary"
                                                            style="border-radius: 8px;">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            Submit Invoice
                                                        </button>
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

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                placeholder: 'Pilih Kategori',
                width: '100%',
                dropdownAutoWidth: true
            });
        });
    </script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-upload-wrap').style.display = 'none';
                    document.getElementById('file-upload-content').style.display = 'block';
                    document.getElementById('file-upload-image').src = e.target.result;
                    document.getElementById('image-file-name').innerText = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeUpload(el, id) {
            const fileInput = document.querySelector('.file-upload-input');
            fileInput.value = '';
            document.getElementById('image-upload-wrap').style.display = 'flex';
            document.getElementById('file-upload-content').style.display = 'none';
        }

        // Calculate PPH based on amount and percentage
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const pphPercentageInput = document.getElementById('pph-percentage');
            const pphInput = document.getElementById('pph');

            function calculatePPH() {
                const amount = parseFloat(amountInput.value) || 0;
                const percentage = parseFloat(pphPercentageInput.value) || 0;
                const pphAmount = (amount * percentage / 100).toFixed(2);
                pphInput.value = pphAmount;
            }

            amountInput.addEventListener('input', calculatePPH);
            pphPercentageInput.addEventListener('input', calculatePPH);
        });
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

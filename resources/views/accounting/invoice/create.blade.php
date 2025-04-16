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
                            <h2 class="mb-3">Invoice Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/invoice">Invoice</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Invoice</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('store-invoice') }}" class="promo-nav-item active">
                        <i class="bi bi-receipt"></i>Create Invoice
                    </a>
                    <a href="{{ route('create-supplier') }}" class="promo-nav-item">
                        <i class="bi bi-truck"></i>Create Supplier
                    </a>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('store-invoice') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h3><i class="bi bi-file-earmark-plus"></i> Create New Invoice</h3>
                                                <p class="text-subtitle text-muted">Fill in the form below to create a
                                                    new invoice
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">No. Invoice
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('no_invoice') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Invoice Number"
                                                                    id="invoice-number" name="no_invoice">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('no_invoice'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('no_invoice') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter a unique invoice number
                                                                (e.g. INV-2025-001)</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="debit-account" class="form-label">Debit Account
                                                                <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('debit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="debit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('debit_coa_id') ? '' : 'selected' }}>Pilih
                                                                    Debit Account</option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ old('debit_coa_id') == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('debit_coa_id'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('debit_coa_id') }}</p>
                                                            @else
                                                                <small class="text-muted">Select the account to be
                                                                    debited</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="amount" class="form-label">Amount <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Amount" id="amount"
                                                                    name="amount">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('amount'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('amount') }}</p>
                                                            @else
                                                                <small class="text-muted">Enter the invoice amount in
                                                                    IDR</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="pph-percentage" class="form-label">PPH
                                                                Percentage </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter PPH Percentage"
                                                                    id="pph-percentage" name="stock_quantity">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-percent"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('stock_quantity'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('stock_quantity') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter the PPH percentage (e.g. 10
                                                                for 10%)</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="end-date" class="form-label">Due Date</label>
                                                            <div class="position-relative">
                                                                <input type="date"
                                                                    class="form-control {{ $errors->has('diskon') ? 'is-invalid' : '' }}"
                                                                    id="end-date" name="diskon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('diskon'))
                                                                <p class="text-danger">{{ $errors->first('diskon') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted">Select the invoice due
                                                                date</small>
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
                                                                invoice</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label for="supplier-name" class="form-label">Supplier
                                                                Name <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"
                                                                name="supplier_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('supplier_id') ? '' : 'selected' }}>
                                                                    Pilih Supplier Name</option>
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}">
                                                                        {{ $supplier->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('supplier_id'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('supplier_id') }}</p>
                                                            @endif
                                                            <small class="text-muted">Select the supplier for this
                                                                invoice</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="kredit-account" class="form-label">Kredit
                                                                Account <span class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('kredit_coa_id') ? 'is-invalid' : '' }}"
                                                                name="kredit_coa_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('kredit_coa_id') ? '' : 'selected' }}>Pilih
                                                                    Kredit Account</option>
                                                                @foreach ($coas as $coa)
                                                                    <option value="{{ $coa->id }}"
                                                                        {{ old('kredit_coa_id') == $coa->id ? 'selected' : '' }}>
                                                                        {{ $coa->coa_no }} - {{ $coa->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('kredit_coa_id'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('kredit_coa_id') }}</p>
                                                            @else
                                                                <small class="text-muted">Select the account to be
                                                                    credited</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="pph" class="form-label">PPH </label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                                                    placeholder="PPH Amount (calculated)"
                                                                    id="pph" name="stock_quantity" readonly>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calculator"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('stock_quantity'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('stock_quantity') }}</p>
                                                            @endif
                                                            <small class="text-muted">Calculated PPH amount based on
                                                                percentage</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-date" class="form-label">Invoice Date
                                                            </label>
                                                            <div class="position-relative">
                                                                <input type="date"
                                                                    class="form-control {{ $errors->has('diskon') ? 'is-invalid' : '' }}"
                                                                    id="invoice-date" name="diskon">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar-check"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('diskon'))
                                                                <p class="text-danger">{{ $errors->first('diskon') }}
                                                                </p>
                                                            @endif
                                                            <small class="text-muted">Enter the invoice issue
                                                                date</small>
                                                        </div>

                                                        <div class="card mb-4">
                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0">Upload Invoice Document
                                                                </h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="image-upload-wrap {{ $errors->has('image_invoice') ? 'border border-danger' : '' }}"
                                                                    id="image-upload-wrap">
                                                                    <input type="file" name="image_invoice"
                                                                        class="file-upload-input"
                                                                        onchange="readURL(this, '');"
                                                                        accept="image/*">
                                                                    <div
                                                                        class="drag-text d-flex flex-column align-items-center justify-content-center py-5">
                                                                        <i class="bi bi-cloud-arrow-up"
                                                                            style="font-size: 3rem; color: {{ $errors->has('image_invoice') ? '#dc3545' : '#ccc' }};"></i>
                                                                        <p class="mt-3 mb-0">Drag and drop a file or
                                                                            click to upload</p>
                                                                        <small class="text-muted">Accepted formats:
                                                                            JPG, PNG, PDF (Max 5MB)</small>
                                                                    </div>
                                                                </div>
                                                                <div class="file-upload-content mt-3"
                                                                    id="file-upload-content" style="display:none;">
                                                                    <div class="d-flex align-items-center">
                                                                        <img class="file-upload-image me-3"
                                                                            id="file-upload-image" src="#"
                                                                            alt="your image"
                                                                            style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 5px;">
                                                                        <div class="flex-grow-1">
                                                                            <div class="image-file-name fw-bold"
                                                                                id="image-file-name"></div>
                                                                            <div class="text-muted small">Uploaded
                                                                                document</div>
                                                                        </div>
                                                                        <button type="button"
                                                                            onclick="removeUpload(this, '')"
                                                                            class="btn btn-sm btn-danger">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                @if ($errors->has('image_invoice'))
                                                                    <p class="text-danger mt-2">
                                                                        {{ $errors->first('image_invoice') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-3">
                                                        <a href="{{ route('index-invoice') }}" type="button"
                                                            class="btn btn-sm btn-light-secondary me-2">
                                                            <i class="bi bi-arrow-left-circle me-1"></i>
                                                            Kembali
                                                        </a>
                                                        <button type="submit" class="btn btn-sm btn-primary">
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
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                width: '100%',
                // Gunakan templateResult untuk mengontrol tampilan dropdown items
                templateResult: formatState,
                // Gunakan templateSelection untuk mengontrol selected item
                templateSelection: formatState,
                dropdownCssClass: 'select-lg-dropdown'
            });

            // Fungsi untuk format tampilan item
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                // Buat container dengan style yang mencegah overflow
                var $state = $(
                    '<span style="white-space: normal; word-break: break-word; display: block;">' + state.text +
                    '</span>'
                );

                return $state;
            }
        });
    </script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
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

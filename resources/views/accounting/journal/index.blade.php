<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal - Glamoire</title>

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
                    <a href="{{ route('index-invoice') }}"
                        class="promo-nav-item {{ Route::currentRouteName() == 'index-invoice' ? 'active' : '' }}">
                        <i class="bi bi-receipt"></i>Invoice Management
                    </a>
                    <a href="{{ route('index-supplier') }}"
                        class="promo-nav-item {{ Route::currentRouteName() == 'index-supplier' ? 'active' : '' }}">
                        <i class="bi bi-truck"></i>Supplier Management
                    </a>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4><i class="bi bi-file-earmark-plus"></i> Create New Invoice</h4>
                                    <p class="text-subtitle text-muted">Fill in the form below to create a new invoice
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('store-invoice') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="invoice-number" class="form-label">No. Invoice
                                                                <span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Invoice Number"
                                                                    id="invoice-number" name="product_name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-receipt"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('product_name'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('product_name') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter a unique invoice number
                                                                (e.g. INV-2025-001)</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="debit-account" class="form-label">Debit Account
                                                                <span class="text-danger">*</span></label>
                                                            <select class="choices form-select" id="debit-account"
                                                                name="brand_id">
                                                                <option value="">Select Debit Account</option>
                                                                <option value="1">1001 - Cash</option>
                                                                <option value="2">1002 - Bank Account</option>
                                                                <option value="3">1003 - Accounts Receivable
                                                                </option>
                                                            </select>
                                                            <small class="text-muted">Select the account to be
                                                                debited</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="amount" class="form-label">Amount <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Amount" id="amount"
                                                                    name="stock_quantity">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('stock_quantity'))
                                                                <p class="text-danger">
                                                                    {{ $errors->first('stock_quantity') }}</p>
                                                            @endif
                                                            <small class="text-muted">Enter the invoice amount in
                                                                IDR</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="pph-percentage" class="form-label">PPH
                                                                Percentage <span class="text-danger">*</span></label>
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
                                                            <label for="end-date" class="form-label">Due Date <span
                                                                    class="text-danger">*</span></label>
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
                                                                <span class="text-danger">*</span></label>
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
                                                            <select class="choices form-select" id="supplier-name"
                                                                name="category_product_id">
                                                                <option value="">Select Supplier</option>
                                                                <option value="1">PT Maju Bersama</option>
                                                                <option value="2">CV Sejahtera</option>
                                                                <option value="3">PT Karya Mandiri</option>
                                                            </select>
                                                            <small class="text-muted">Select the supplier for this
                                                                invoice</small>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="kredit-account" class="form-label">Kredit
                                                                Account <span class="text-danger">*</span></label>
                                                            <select class="choices form-select" id="kredit-account"
                                                                name="brand_id">
                                                                <option value="">Select Kredit Account</option>
                                                                <option value="1">2001 - Accounts Payable</option>
                                                                <option value="2">2002 - Accrued Expenses</option>
                                                                <option value="3">2003 - Taxes Payable</option>
                                                            </select>
                                                            <small class="text-muted">Select the account to be
                                                                credited</small>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="pph" class="form-label">PPH <span
                                                                    class="text-danger">*</span></label>
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
                                                                <span class="text-danger">*</span></label>
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
                                                                <div class="image-upload-wrap" id="image-upload-wrap">
                                                                    <input type="file" name="image"
                                                                        class="file-upload-input"
                                                                        onchange="readURL(this, '');"
                                                                        accept="image/*">
                                                                    <div
                                                                        class="drag-text d-flex flex-column align-items-center justify-content-center py-5">
                                                                        <i class="bi bi-cloud-arrow-up"
                                                                            style="font-size: 3rem; color: #ccc;"></i>
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
                                                            </div>
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

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; Invoice Management System</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by Your Company
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

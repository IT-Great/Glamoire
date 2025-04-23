<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
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

        .btn-warning {
            background-color: var(--warning);
            border-color: var(--warning);
            color: white;
        }

        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
        }

        .btn-info {
            background-color: var(--info);
            border-color: var(--info);
            color: white;
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
            border-radius: 6px;
        }

        .bg-light-success {
            background-color: rgba(79, 190, 135, 0.15);
            color: var(--success);
        }

        .bg-light-danger {
            background-color: rgba(235, 87, 87, 0.15);
            color: var(--danger);
        }

        .bg-light-warning {
            background-color: rgba(245, 158, 11, 0.15);
            color: var(--warning);
        }

        .bg-light-info {
            background-color: rgba(59, 130, 246, 0.15);
            color: var(--info);
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        table th {
            background-color: #f8f9fa;
            color: var(--dark);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 15px !important;
        }

        table td {
            padding: 18px 15px !important;
            vertical-align: middle;
            color: #495057;
            border-bottom: 1px solid #f0f0f0;
        }

        table tr:hover td {
            background-color: rgba(67, 94, 190, 0.03);
        }

        .amount-cell {
            font-weight: 600;
            font-family: monospace;
            font-size: 1.05rem;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons .btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stats-row {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 24px;
        }

        .stat-content h3 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 700;
        }

        .stat-content p {
            margin: 5px 0 0;
            color: var(--secondary);
            font-size: 0.9rem;
        }

        .icon-primary {
            background-color: rgba(67, 94, 190, 0.15);
            color: var(--primary);
        }

        .icon-success {
            background-color: rgba(79, 190, 135, 0.15);
            color: var(--success);
        }

        .icon-warning {
            background-color: rgba(245, 158, 11, 0.15);
            color: var(--warning);
        }

        .icon-danger {
            background-color: rgba(235, 87, 87, 0.15);
            color: var(--danger);
        }

        .deadline-near {
            color: var(--danger);
            font-weight: 500;
        }

        .deadline-upcoming {
            color: var(--warning);
            font-weight: 500;
        }

        .deadline-safe {
            color: var(--success);
            font-weight: 500;
        }

        .filters-row {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .filter-item {
            flex: 1;
            min-width: 200px;
        }

        .filter-item select,
        .filter-item input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }

        .filter-item select:focus,
        .filter-item input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 94, 190, 0.1);
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-success {
            color: var(--success) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .text-warning {
            color: var(--warning) !important;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .invoice-details {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .invoice-details p {
            margin-bottom: 5px;
        }

        .invoice-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: #495057;
        }

        .form-label {
            font-weight: 600;
        }

        .required-asterisk {
            color: red;
        }

        .payment-proof-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            display: none;
        }

        .payment-history-card {
            margin-bottom: 20px;
        }

        .invoice-details {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .payment-status-paid {
            color: #198754;
            font-weight: bold;
        }

        .payment-status-unpaid {
            color: #dc3545;
            font-weight: bold;
        }

        .payment-proof-img {
            max-width: 100%;
            height: auto;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-top: 10px;
        }

        .account-details {
            background-color: #f0f8ff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .payment-date {
            font-weight: 600;
            color: #495057;
        }

        .payment-reference {
            font-style: italic;
            color: #6c757d;
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
                                    <li class="breadcrumb-item"><a href="index.html"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="index.html">Invoice</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Invoices</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <!-- Stats Row -->
                    <div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-icon icon-primary">
                                <i class="bi bi-receipt"></i>
                            </div>
                            <div class="stat-content">
                                <h3>145</h3>
                                <p>Total Invoices</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-success">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h3>98</h3>
                                <p>Paid Invoices</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-warning">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="stat-content">
                                <h3>47</h3>
                                <p>Pending Invoices</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="stat-content">
                                <h3>12</h3>
                                <p>Overdue Invoices</p>
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

                    <!-- Filter Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Filter Invoices</h4>
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterCollapse">
                                <i class="bi bi-funnel me-1"></i> Show/Hide Filters
                            </button>
                        </div>
                        <div class="card-body collapse show" id="filterCollapse">
                            <form action="{{ route('index-invoice') }}" method="GET">
                                <div class="row">
                                    <!-- Date filters -->
                                    <div class="col-md-3">
                                        <label class="form-label">Invoice Date (From)</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Invoice Date (To)</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ request('end_date') }}">
                                    </div>

                                    <!-- Supplier filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Supplier</label>
                                        <select name="supplier_id" class="form-select">
                                            <option value="">All Suppliers</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                    {{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Invoice number filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Invoice Number</label>
                                        <input type="text" name="no_invoice" class="form-control"
                                            value="{{ request('no_invoice') }}" placeholder="Search by number...">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <!-- Payment status filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Payment Status</label>
                                        <select name="payment_status" class="form-select">
                                            <option value="">All Status</option>
                                            <option value="Paid"
                                                {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>
                                                Paid</option>
                                            <option value="Not Yet"
                                                {{ request('payment_status') == 'Not Yet' ? 'selected' : '' }}>
                                                Not Yet Paid</option>
                                        </select>
                                    </div>

                                    <!-- Payment method filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Payment Method</label>
                                        <select name="payment_method" class="form-select">
                                            <option value="">All Methods</option>
                                            <option value="Cash"
                                                {{ request('payment_method') == 'Cash' ? 'selected' : '' }}>
                                                Cash</option>
                                            <option value="Bank"
                                                {{ request('payment_method') == 'Bank' ? 'selected' : '' }}>
                                                Bank</option>
                                        </select>
                                    </div>

                                    <!-- Amount range filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Amount Range</label>
                                        <div class="input-group">
                                            <input type="number" name="min_amount" class="form-control"
                                                placeholder="Min" value="{{ request('min_amount') }}">
                                            <span class="input-group-text">to</span>
                                            <input type="number" name="max_amount" class="form-control"
                                                placeholder="Max" value="{{ request('max_amount') }}">
                                        </div>
                                    </div>

                                    <!-- Has image filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Documents</label>
                                        <div class="row ms-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="hasInvoiceImage"
                                                    name="has_invoice_image" value="1"
                                                    {{ request('has_invoice_image') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hasInvoiceImage">Has Invoice
                                                    Image</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="hasProofImage"
                                                    name="has_proof_image" value="1"
                                                    {{ request('has_proof_image') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hasProofImage">Has Payment
                                                    Proof</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <!-- Deadline filter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Deadline (From)</label>
                                        <input type="date" name="start_deadline" class="form-control"
                                            value="{{ request('start_deadline') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Deadline (To)</label>
                                        <input type="date" name="end_deadline" class="form-control"
                                            value="{{ request('end_deadline') }}">
                                    </div>

                                    <!-- COA filter if needed -->
                                    <div class="col-md-3">
                                        <label class="form-label">COA Account</label>
                                        <select name="coa_id" class="form-select">
                                            <option value="">All COAs</option>
                                            @foreach ($coas as $coa)
                                                <option value="{{ $coa->id }}"
                                                    {{ request('coa_id') == $coa->id ? 'selected' : '' }}>
                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Has PPH filter -->
                                    <div class="col-md-3 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hasPph"
                                                name="has_pph" value="1"
                                                {{ request('has_pph') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="hasPph">Has PPH</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('index-invoice') }}"
                                            class="btn btn-secondary me-2">Reset</a>
                                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- data table invoice --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4><i class="bi bi-receipt-cutoff"></i> Invoice List</h4>
                                </div>
                                <div
                                    class="col-12 col-md-6 d-flex justify-content-md-end align-items-center order-md-2 order-first">
                                    <a href="{{ route('create-invoice') }}" type="button"
                                        class="btn btn-sm btn-info d-flex align-items-center me-2">
                                        <i class="bi bi-file-earmark-excel me-2"></i>Export
                                    </a>
                                    <a href="{{ route('create-invoice') }}" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                        <i class="bi bi-plus-circle me-2"></i>Add Invoice
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO. INVOICE</th>
                                        <th>SUPPLIER</th>
                                        <th>AMOUNT</th>
                                        <th>DATE</th>
                                        <th>DEADLINE</th>
                                        <th>STATUS</th>
                                        <th>PAYMENT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td><strong>{{ $invoice->no_invoice }}</strong></td>
                                            <td>{{ $invoice->supplier->name ?? '-' }}</td>
                                            <td class="amount-cell">
                                                {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                                            </td>
                                            <td> {{ \Carbon\Carbon::parse($invoice->deadline_invoice)->format('M d, Y') }}
                                            </td>
                                            <td class="deadline-safe">
                                                {{ \Carbon\Carbon::parse($invoice->date)->format('M d, Y') }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-light-success">{{ $invoice->payment_status }}</span>
                                            </td>
                                            <td>{{ $invoice->payment_method }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('get-invoice-details', ['id' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('edit-invoice', ['id' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if ($invoice->payment_status == 'Not Yet')
                                                        <a href="{{ route('view-process-payment', ['id' => $invoice->id]) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="bi bi-credit-card"></i>
                                                        </a>
                                                    @endif
                                                    <button class="btn btn-sm btn-danger delete-invoice"
                                                        data-id="{{ $invoice->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    {{-- modal delete data --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-invoice', function(e) {
                e.preventDefault();

                const invoiceId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data invoice akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request delete ke server
                        $.ajax({
                            url: `/invoice-suppliers/${invoiceId}`,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Tampilkan pesan sukses dengan timer dan progress bar
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message ||
                                        'Invoice berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#4A69E2',
                                    timer: 2000, // waktu dalam ms
                                    timerProgressBar: true
                                }).then(() => {
                                    // Refresh halaman setelah sukses
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: xhr.responseJSON?.message ||
                                        'Terjadi kesalahan.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#dc3545',
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    {{-- modal sukses --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4A69E2',
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

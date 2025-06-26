<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .page-title h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Stats Card Styling */
        .stats-card {
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stats-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .stats-card-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-title {
            font-size: 0.9rem;
            font-weight: 400;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Product Card Styling */
        .product-card {
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table> :not(:first-child) {
            border-top: none;
        }

        .table th {
            font-weight: 600;
            color: var(--text-primary);
            background-color: rgba(243, 246, 249, 0.6);
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding: 1.25rem 1.5rem;
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .table>tbody>tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Product Image */
        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        /* Product Details */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .product-meta {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* Message Preview */
        .message-preview {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Stock Badge */
        .stock-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .badge.bg-info {
            background-color: var(--info-color) !important;
            color: white;
        }

        .badge.bg-danger {
            background-color: var(--danger-color) !important;
        }

        /* Search and Filter Container */
        .search-filter-container {
            margin-bottom: 1.5rem;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-input {
            border-radius: 10px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .filter-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .filter-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        /* Quick Action Button */
        .quick-action-btn {
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .stats-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .table td {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .product-details {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .d-flex.align-items-center.gap-3 {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .action-buttons .badge {
                display: block;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--secondary-color) !important;
            color: white !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            opacity: 0.5;
            margin-bottom: 1.5rem;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .finance-nav {
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .finance-nav-item {
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: #4a4a4a;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid transparent;
        }

        .finance-nav-item i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .finance-nav-item.active {
            background-color: var(--primary-color);
            /* Make sure --primary-color is defined */
            color: #fff;
            border-color: var(--primary-color);
        }

        .finance-nav-item.active i {
            transform: scale(1.2);
            color: #fff;
        }

        .finance-nav-item:hover:not(.active) {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h3 class="d-flex align-items-center gap-2 mb-1">
                                Finance
                                <span class="badge bg-danger text-uppercase">Pengeluaran</span>
                            </h3>
                            <p class="text-muted mb-2">
                                Halaman ini menampilkan semua transaksi <strong>pengeluaran (expense)</strong> yang
                                tercatat dalam sistem.
                            </p>

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-financial-expense') }}"
                                            class="d-flex align-items-center">
                                            <i class="bi bi-cash-stack me-2"></i>Pengeluaran (Expense)
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        List Pengeluaran Keuangan
                                    </li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </div>

                <div class="row mb-4 slide-in">
                    <!-- Total Pengeluaran -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-journals"></i>
                            </div>
                            <div class="stats-title">Total Pengeluaran</div>
                            <h3 class="stats-number">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-arrow-left-right me-1"></i>
                                    Semua transaksi pengeluaran
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Total Sudah Dibayar -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-success">
                            <div class="stats-icon">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="stats-title">Total Telah Dibayar</div>
                            <h3 class="stats-number">Rp {{ number_format($totalPaid, 0, ',', '.') }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Jumlah tagihan yang telah dibayar
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Total Belum Dibayar -->
                    <div class="col-12 col-md-4">
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-exclamation-circle"></i>
                            </div>
                            <div class="stats-title">Total Belum Dibayar</div>
                            <h3 class="stats-number">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-hourglass-split me-1"></i>
                                    Jumlah tagihan yang masih tertunda
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="finance-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('index-financial-income') }}"
                        class="finance-nav-item {{ Route::currentRouteName() == 'index-financial-income' ? 'active' : '' }}">
                        <i class="bi bi-arrow-up-circle me-2"></i>Income
                    </a>
                    <a href="{{ route('index-financial-expense') }}"
                        class="finance-nav-item {{ Route::currentRouteName() == 'index-financial-expense' ? 'active' : '' }}">
                        <i class="bi bi-arrow-down-circle me-2"></i>Expense
                    </a>
                </div>

                <!-- expense Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Expense Transactions</h4>
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
                                        <td class="amount-cell">Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                        </td>
                                        <td> {{ \Carbon\Carbon::parse($invoice->payment_date)->format('d M Y h:i A') }}
                                        </td>
                                        <td> {{ \Carbon\Carbon::parse($invoice->deadline_invoice)->format('d M Y h:i A') }}
                                        <td>
                                            <span class="badge bg-light-success">Paid</span>
                                        </td>
                                        <td>Bank Transfer</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="#"
                                                    class="btn btn-sm view-expense btn-primary d-flex align-items-center"
                                                    data-id="{{ $invoice->id }}">
                                                    <i class="bi bi-eye me-1"></i> Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-white">
                                <h5 class="modal-title" id="expenseModalLabel">
                                    <i class="bi bi-receipt"></i> Detail Invoice Supplier
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Informasi Header -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nomor Invoice</label>
                                    <input type="text" class="form-control" id="modalInvoiceNumber" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Status Invoice</label>
                                    <div>
                                        <span id="modalStatus" class="badge bg-warning">-</span>
                                    </div>
                                </div>

                                <!-- Detail Invoice Supplier -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Informasi Supplier</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Nama Supplier</td>
                                                    <td id="modalSupplierName">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Supplier</td>
                                                    <td id="modalSupplierAddress">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Kontak Supplier</td>
                                                    <td id="modalSupplierContact">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Invoice</td>
                                                    <td id="modalInvoiceDate">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Jatuh Tempo</td>
                                                    <td id="modalDueDate">-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Detail Keuangan -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Detail Keuangan</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td id="modalSubtotal" class="text-primary fw-bold">-</td>
                                                </tr>
                                                <tr>
                                                    <td>PPN (%)</td>
                                                    <td id="modalTaxPercentage">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai PPN</td>
                                                    <td id="modalTaxAmount" class="text-info">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Amount</td>
                                                    <td id="modalTotalAmount" class="text-success fw-bold">-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Deskripsi dan Catatan -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Deskripsi</label>
                                    <textarea class="form-control" id="modalDescription" rows="3" readonly></textarea>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Tutup
                                </button>
                                <button type="button" id="printExpense" class="btn btn-primary">
                                    <i class="bi bi-printer"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        $(document).ready(function() {
            // View expense details
            $(document).on('click', '.view-expense', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                // Show loading state
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: `/expense/${id}`, // Sesuaikan dengan route yang ada
                    method: 'GET',
                    success: function(response) {
                        // Close loading indicator
                        Swal.close();

                        // Populate modal with expense data (Invoice Supplier)
                        $('#modalInvoiceNumber').val(response.invoice_number ?? '-');

                        // Set status with appropriate color
                        $('#modalStatus').text(response.status ?? 'pending');
                        if (response.status === 'paid') {
                            $('#modalStatus').removeClass('bg-warning bg-danger').addClass(
                                'bg-success');
                        } else if (response.status === 'pending') {
                            $('#modalStatus').removeClass('bg-success bg-danger').addClass(
                                'bg-warning');
                        } else if (response.status === 'overdue') {
                            $('#modalStatus').removeClass('bg-success bg-warning').addClass(
                                'bg-danger');
                        }

                        // Supplier Information
                        $('#modalSupplierName').text(response.supplier?.name ?? response
                            .supplier_name ?? '-');
                        $('#modalSupplierAddress').text(response.supplier?.address ?? response
                            .supplier_address ?? '-');
                        $('#modalSupplierContact').text(response.supplier?.phone ?? response
                            .supplier_phone ?? '-');

                        // Format dates
                        if (response.invoice_date) {
                            const invoiceDate = new Date(response.invoice_date);
                            const formattedInvoiceDate = invoiceDate.toLocaleDateString(
                                'id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                            $('#modalInvoiceDate').text(formattedInvoiceDate);
                        } else {
                            $('#modalInvoiceDate').text('-');
                        }

                        if (response.due_date) {
                            const dueDate = new Date(response.due_date);
                            const formattedDueDate = dueDate.toLocaleDateString('id-ID', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            $('#modalDueDate').text(formattedDueDate);
                        } else {
                            $('#modalDueDate').text('-');
                        }

                        // Financial Details
                        $('#modalSubtotal').text(response.subtotal ? 'Rp ' + new Intl
                            .NumberFormat('id-ID').format(response.subtotal) : '-');
                        $('#modalTaxPercentage').text(response.tax_percentage ? response
                            .tax_percentage + '%' : '-');
                        $('#modalTaxAmount').text(response.tax_amount ? 'Rp ' + new Intl
                            .NumberFormat('id-ID').format(response.tax_amount) : '-');
                        $('#modalTotalAmount').text(response.total_amount ? 'Rp ' + new Intl
                            .NumberFormat('id-ID').format(response.total_amount) : '-');
                        $('#modalCOA').text(response.coa_code ?? response.chart_of_account ??
                            '-');

                        // Description and Notes
                        $('#modalDescription').val(response.description ?? '-');
                        $('#modalNotes').val(response.notes ?? '-');

                        // Show the modal
                        $('#expenseModal').modal('show');
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire('Error', 'Gagal memuat data invoice supplier.', 'error');
                    }
                });
            });

            // ========================================
            // FUNGSI PRINT EXPENSE TANPA BODY REPLACEMENT
            // ========================================
            $(document).on('click', '#printExpense', function() {
                // Sembunyikan elemen yang tidak perlu di-print
                const originalDisplay = [];
                const noPrintElements = document.querySelectorAll(
                    '.no-print, .modal-header, .modal-footer, .btn, button');

                noPrintElements.forEach((element, index) => {
                    originalDisplay[index] = element.style.display;
                    element.style.display = 'none';
                });

                // Buat style khusus untuk print
                const printStyle = document.createElement('style');
                printStyle.innerHTML = `
            @media print {
                body * {
                    visibility: hidden;
                }
                #expenseModal, #expenseModal * {
                    visibility: visible;
                }
                #expenseModal {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                }
                .modal-dialog {
                    width: 100%;
                    max-width: none;
                    margin: 0;
                }
                .modal-content {
                    border: none;
                    border-radius: 0;
                    box-shadow: none;
                }
                .modal-body {
                    padding: 15px !important;
                }
                .modal-body::before {
                    content: "Detail Invoice Supplier";
                    display: block;
                    text-align: center;
                    font-size: 24px;
                    font-weight: bold;
                    margin-bottom: 20px;
                    color: #333;
                }
                .table {
                    font-size: 12px;
                }
                .no-print, .btn, button {
                    display: none !important;
                }
                .badge {
                    -webkit-print-color-adjust: exact;
                    color-adjust: exact;
                }
            }
        `;

                // Tambahkan style ke head
                document.head.appendChild(printStyle);

                // Trigger print
                window.print();

                // Kembalikan tampilan elemen setelah print dengan delay
                setTimeout(() => {
                    noPrintElements.forEach((element, index) => {
                        element.style.display = originalDisplay[index];
                    });

                    // Hapus style print
                    if (document.head.contains(printStyle)) {
                        document.head.removeChild(printStyle);
                    }
                }, 1000);
            });
        });
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>

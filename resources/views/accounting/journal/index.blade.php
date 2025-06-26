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
            align-items: center;
            /* Tambahan agar semua button sejajar secara vertikal */
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
                <div class="page-title" style="margin-bottom: 25px;">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">Journal</h2>

                            <p class="text-muted mb-2">
                                Halaman ini menampilkan semua data <strong>transaksi</strong> yang tercatat dalam
                                sistem.
                            </p>

                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                                            <i class="bi bi-grid-fill me-2"></i>Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-journal') }}">Journal</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">List Journal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


                <section class="section">
                    <!-- Financial Summary -->
                    {{-- <div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-icon icon-primary">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="stat-content">
                                <h3>145</h3>
                                <p>Total Journal Entries</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-success">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="stat-content">
                                <h3>Rp 1.25B</h3>
                                <p>Total Debits</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-info">
                                <i class="bi bi-cash"></i>
                            </div>
                            <div class="stat-content">
                                <h3>Rp 1.25B</h3>
                                <p>Total Credits</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-warning">
                                <i class="bi bi-exclamation-diamond"></i>
                            </div>
                            <div class="stat-content">
                                <h3>3</h3>
                                <p>Unbalanced Entries</p>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mb-4 slide-in">
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <div class="stats-card stats-card-primary">
                                <div class="stats-icon">
                                    <i class="bi bi-receipt-cutoff"></i>
                                </div>
                                <div class="stats-title">Total Invoice</div>
                                {{-- <h3 class="stats-number">{{ $invoices->count() }}</h3> --}}
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Jumlah semua invoice yang terdata
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <div class="stats-card stats-card-success">
                                <div class="stats-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="stats-title">Total Nominal</div>
                                {{-- <h3 class="stats-number">Rp {{ number_format($invoices->sum('amount'), 0, ',', '.') }} --}}
                                </h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Total nilai dari semua invoice
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="stats-card stats-card-warning">
                                <div class="stats-icon">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                                <div class="stats-title">Invoice Belum Lunas</div>
                                {{-- <h3 class="stats-number">{{ $invoices->where('payment_status', 'Not Yet')->count() }}
                                </h3> --}}
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Invoice yang belum dibayar
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4 class="d-inline-flex align-items-center"><i class="bi bi-journal-plus"></i> Journal Entries</h4>
                                </div>
                                <div
                                    class="col-12 col-md-6 d-flex justify-content-md-end align-items-center order-md-2 order-first">
                                    <div class="dropdown me-2">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-download me-1"></i> Export
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="bi bi-file-earmark-excel me-2"></i>Excel</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="bi bi-file-earmark-pdf me-2"></i>PDF</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="bi bi-file-earmark-text me-2"></i>CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Transactions Section -->
                            <h4 class="mb-3">Transaction Journals</h4>
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>JOURNAL #</th>
                                        <th>DATE</th>
                                        <th>DESCRIPTION</th>
                                        <th>REFERENCE</th>
                                        <th>STATUS</th>
                                        <th>TOTAL DEBIT</th>
                                        <th>TOTAL CREDIT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr class="parent-row" data-id="TRN-{{ $transaction->id }}">
                                            <td><strong>TRN-{{ $transaction->id }}</strong></td>
                                            <td>{{ $transaction->date ? date('M d, Y', strtotime($transaction->date)) : '-' }}
                                            </td>
                                            <td>{{ $transaction->description ?? 'Transaction' }}</td>
                                            <td>{{ $transaction->no_transaction }}</td>
                                            <td>
                                                <span class="badge bg-light-success">Posted</span>
                                            </td>
                                            <td class="text-end">Rp
                                                {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                            <td class="text-end">Rp
                                                {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-outline-secondary toggle-details">
                                                        <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                    <a href="" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="detail-row" style="display: none;">
                                            <td colspan="8">
                                                <div class="journal-details">
                                                    <h6 class="mb-3">Entry Details</h6>
                                                    <table class="table table-sm table-borderless mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>ACCOUNT CODE</th>
                                                                <th>ACCOUNT NAME</th>
                                                                <th>DESCRIPTION</th>
                                                                <th class="text-end">DEBIT</th>
                                                                <th class="text-end">CREDIT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $transaction->debitCoa->code ?? '-' }}</td>
                                                                <td>{{ $transaction->debitCoa->name ?? '-' }}</td>
                                                                <td>{{ $transaction->description ?? 'Transaction' }}
                                                                    (Debit)
                                                                </td>
                                                                <td class="text-end">Rp
                                                                    {{ number_format($transaction->amount, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-end">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $transaction->kreditCoa->code ?? '-' }}</td>
                                                                <td>{{ $transaction->kreditCoa->name ?? '-' }}</td>
                                                                <td>{{ $transaction->description ?? 'Transaction' }}
                                                                    (Credit)</td>
                                                                <td class="text-end">-</td>
                                                                <td class="text-end">Rp
                                                                    {{ number_format($transaction->amount, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="table-light">
                                                                <td colspan="3"><strong>TOTAL</strong></td>
                                                                <td class="text-end"><strong>Rp
                                                                        {{ number_format($transaction->amount, 0, ',', '.') }}</strong>
                                                                </td>
                                                                <td class="text-end"><strong>Rp
                                                                        {{ number_format($transaction->amount, 0, ',', '.') }}</strong>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="entry-meta mt-3">
                                                        <span class="badge bg-light-secondary me-2"><i
                                                                class="bi bi-calendar me-1"></i>Created:
                                                            {{ date('M d, Y', strtotime($transaction->created_at)) }}</span>
                                                        <span class="badge bg-light-secondary me-2"><i
                                                                class="bi bi-info-circle me-1"></i>Type:
                                                            {{ ucfirst($transaction->type) }}</span>
                                                        @if ($transaction->recipient_name)
                                                            <span class="badge bg-light-secondary"><i
                                                                    class="bi bi-person me-1"></i>Recipient:
                                                                {{ $transaction->recipient_name }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Divider -->
                            <hr class="my-5">

                            <!-- Invoice Suppliers Section -->
                            <h4 class="mb-3">Invoice Supplier Journals</h4>
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>JOURNAL #</th>
                                        <th>DATE</th>
                                        <th>DESCRIPTION</th>
                                        <th>REFERENCE</th>
                                        <th>STATUS</th>
                                        <th>TOTAL DEBIT</th>
                                        <th>TOTAL CREDIT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoiceSuppliers as $invoice)
                                        <tr class="parent-row {{ $invoice->payment_status === 'Not Yet' ? 'table-warning' : '' }}"
                                            data-id="INV-{{ $invoice->id }}">
                                            <td><strong>INV-{{ $invoice->id }}</strong></td>
                                            <td>{{ $invoice->date ? date('M d, Y', strtotime($invoice->date)) : '-' }}
                                            </td>
                                            <td>{{ $invoice->description ?? 'Invoice Payment' }}</td>
                                            <td>{{ $invoice->no_invoice }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $invoice->payment_status === 'Paid' ? 'success' : 'warning' }}">
                                                    {{ $invoice->payment_status }}
                                                </span>
                                            </td>
                                            <td class="text-end">Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-outline-secondary toggle-details">
                                                        <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                    <a href="" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="detail-row" style="display: none;">
                                            <td colspan="8">
                                                <div class="journal-details">
                                                    <h6 class="mb-3">Entry Details</h6>
                                                    <table class="table table-sm table-borderless mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>ACCOUNT CODE</th>
                                                                <th>ACCOUNT NAME</th>
                                                                <th>DESCRIPTION</th>
                                                                <th class="text-end">DEBIT</th>
                                                                <th class="text-end">CREDIT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($invoice->payment_status === 'Paid' && $invoice->debitCoa && $invoice->kreditCoa)
                                                                <tr>
                                                                    <td>{{ $invoice->debitCoa->code ?? '-' }}</td>
                                                                    <td>{{ $invoice->debitCoa->name ?? '-' }}</td>
                                                                    <td>Payment to
                                                                        {{ $invoice->supplier->name ?? 'Supplier' }}
                                                                        (Debit)</td>
                                                                    <td class="text-end">Rp
                                                                        {{ number_format($invoice->amount, 0, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-end">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ $invoice->kreditCoa->code ?? '-' }}</td>
                                                                    <td>{{ $invoice->kreditCoa->name ?? '-' }}</td>
                                                                    <td>Invoice {{ $invoice->no_invoice }} (Credit)
                                                                    </td>
                                                                    <td class="text-end">-</td>
                                                                    <td class="text-end">Rp
                                                                        {{ number_format($invoice->amount, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">
                                                                        <i>Journal entries will be created when payment
                                                                            is processed.</i>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                        @if ($invoice->payment_status === 'Paid' && $invoice->debitCoa && $invoice->kreditCoa)
                                                            <tfoot>
                                                                <tr class="table-light">
                                                                    <td colspan="3"><strong>TOTAL</strong></td>
                                                                    <td class="text-end"><strong>Rp
                                                                            {{ number_format($invoice->amount, 0, ',', '.') }}</strong>
                                                                    </td>
                                                                    <td class="text-end"><strong>Rp
                                                                            {{ number_format($invoice->amount, 0, ',', '.') }}</strong>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        @endif
                                                    </table>

                                                    <div class="invoice-info mt-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card border-light mb-3">
                                                                    <div class="card-body">
                                                                        <h6 class="card-title">Invoice Information</h6>
                                                                        <table class="table table-sm">
                                                                            <tr>
                                                                                <td><strong>Supplier:</strong></td>
                                                                                <td>{{ $invoice->supplier->name ?? 'Unknown' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Invoice Date:</strong></td>
                                                                                <td>{{ date('M d, Y', strtotime($invoice->date)) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Due Date:</strong></td>
                                                                                <td>{{ date('M d, Y', strtotime($invoice->deadline_invoice)) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Status:</strong></td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge bg-{{ $invoice->payment_status === 'Paid' ? 'success' : 'warning' }}">
                                                                                        {{ $invoice->payment_status }}
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                            @if ($invoice->pph)
                                                                                <tr>
                                                                                    <td><strong>PPh:</strong></td>
                                                                                    <td>{{ $invoice->pph_percentage }}%
                                                                                        (Rp
                                                                                        {{ number_format($invoice->pph, 0, ',', '.') }})
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                            <tr>
                                                                                <td><strong>Payment Method:</strong>
                                                                                </td>
                                                                                <td>{{ $invoice->payment_method ?? 'Not specified' }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                @if ($invoice->image_invoice || $invoice->image_proof)
                                                                    <div class="card border-light mb-3">
                                                                        <div class="card-body">
                                                                            <h6 class="card-title">Documents</h6>
                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                @if ($invoice->image_invoice)
                                                                                    <a href="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-sm btn-outline-primary">
                                                                                        <i
                                                                                            class="bi bi-file-earmark-text me-1"></i>Invoice
                                                                                        Document
                                                                                    </a>
                                                                                @endif

                                                                                @if ($invoice->image_proof)
                                                                                    <a href="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-sm btn-outline-primary">
                                                                                        <i
                                                                                            class="bi bi-file-earmark-check me-1"></i>Payment
                                                                                        Proof
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($invoice->payments->count() > 0)
                                                        <h6 class="mt-4 mb-2">Payment History</h6>
                                                        <table class="table table-sm table-bordered mb-0">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Method</th>
                                                                    <th>Reference</th>
                                                                    <th>Notes</th>
                                                                    <th class="text-end">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($invoice->payments as $payment)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ date('M d, Y', strtotime($payment->payment_date)) }}
                                                                        </td>
                                                                        <td>{{ $payment->payment_method }}</td>
                                                                        <td>{{ $payment->reference_number ?? '-' }}
                                                                        </td>
                                                                        <td>{{ $payment->notes ?? '-' }}</td>
                                                                        <td class="text-end">Rp
                                                                            {{ number_format($payment->amount, 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot class="table-light">
                                                                <tr>
                                                                    <td colspan="5"><strong>TOTAL PAID</strong></td>
                                                                    <td class="text-end"><strong>Rp
                                                                            {{ number_format($invoice->payments->sum('amount'), 0, ',', '.') }}</strong>
                                                                    </td>
                                                                </tr>
                                                                @if ($invoice->payments->sum('amount') < $invoice->amount)
                                                                    <tr class="table-warning">
                                                                        <td colspan="5"><strong>REMAINING</strong>
                                                                        </td>
                                                                        <td class="text-end"><strong>Rp
                                                                                {{ number_format($invoice->amount - $invoice->payments->sum('amount'), 0, ',', '.') }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            </tfoot>
                                                        </table>
                                                    @elseif ($invoice->payment_status === 'Not Yet')
                                                        <div class="alert alert-warning mt-3">
                                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                                            This invoice hasn't been paid yet. Due date:
                                                            {{ date('M d, Y', strtotime($invoice->deadline_invoice)) }}
                                                        </div>
                                                    @endif
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

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle journal details for both tables
            document.querySelectorAll('.toggle-details').forEach(button => {
                button.addEventListener('click', function() {
                    const parentRow = this.closest('.parent-row');
                    const detailRow = parentRow.nextElementSibling;

                    // Toggle display
                    if (detailRow.style.display === 'none' || !detailRow.style.display) {
                        detailRow.style.display = 'table-row';
                        this.querySelector('i').classList.replace('bi-chevron-down',
                            'bi-chevron-up');
                    } else {
                        detailRow.style.display = 'none';
                        this.querySelector('i').classList.replace('bi-chevron-up',
                            'bi-chevron-down');
                    }
                });
            });

            // Delete journal functionality
            document.querySelectorAll('.delete-journal').forEach(button => {
                button.addEventListener('click', function() {
                    const journalId = this.dataset.id;
                    if (confirm('Are you sure you want to delete this journal entry?')) {
                        // Send delete request via AJAX or redirect to delete route
                        // Example: window.location.href = `/accounting/journal/delete/${journalId}`;
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle journal entry details
            const toggleButtons = document.querySelectorAll('.toggle-details');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const parentRow = this.closest('.parent-row');
                    const detailRow = parentRow.nextElementSibling;

                    if (detailRow.style.display === 'none') {
                        detailRow.style.display = 'table-row';
                        this.querySelector('i').classList.replace('bi-chevron-down',
                            'bi-chevron-up');
                    } else {
                        detailRow.style.display = 'none';
                        this.querySelector('i').classList.replace('bi-chevron-up',
                            'bi-chevron-down');
                    }
                });
            });

            // Initialize chart for Account Activity
            // Chart initialization code would go here
        });
    </script>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction - Glamoire</title>

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
                                Manajemen Transaksi
                            </h3>
                            <p class="text-muted mb-2">
                                Halaman ini menampilkan semua data <strong>transaksi</strong> yang tercatat dalam
                                sistem.
                            </p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                                            <i class="bi bi-grid-fill me-2"></i>Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('index-transaction') }}">Transaksi</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <!-- Stats Row -->
                    <div class="row mb-4 slide-in">
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <div class="stats-card stats-card-primary">
                                <div class="stats-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <div class="stats-title">Total Transactions</div>
                                <h3 class="stats-number">{{ $total_transactions }}</h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Jumlah seluruh transaksi yang tercatat
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <div class="stats-card stats-card-success">
                                <div class="stats-icon">
                                    <i class="bi bi-arrow-up-circle"></i>
                                </div>
                                <div class="stats-title">Total Amount</div>
                                <h3 class="stats-number">Rp {{ number_format($total_amount, 0, ',', '.') }}</h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Total nilai dari semua transaksi
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <div class="stats-card stats-card-warning">
                                <div class="stats-icon">
                                    <i class="bi bi-calendar-week"></i>
                                </div>
                                <div class="stats-title">Today's Transactions</div>
                                <h3 class="stats-number">{{ $today_transactions }}</h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Transaksi yang terjadi hari ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4><i class="bi bi-credit-card-2-front me-2"></i>Transaction List</h4>
                                </div>
                                <div
                                    class="col-12 col-md-6 d-flex justify-content-md-end align-items-center order-md-2 order-first">

                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle d-flex align-items-center"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-plus fs-6 me-2"></i>Add Transaction
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('create-transaction', ['type' => 'transfer']) }}">
                                                    <i class="bi bi-arrow-left-right me-2"></i>Transfer
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('create-transaction', ['type' => 'receive']) }}">
                                                    <i class="bi bi-download me-2"></i>Receive
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO. TRANSACTION</th>
                                        <th>TRANSFER FROM</th>
                                        <th>DEPOSIT TO</th>
                                        <th>RECIPIENT</th>
                                        <th>AMOUNT</th>
                                        <th>DATE</th>
                                        <th>TYPE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td><strong>{{ $transaction->no_transaction }}</strong></td>
                                            <td>{{ $transaction->kreditCoa->coa_no ?? '-' }} -
                                                {{ $transaction->kreditCoa->name ?? '-' }}</td>
                                            <td>{{ $transaction->debitCoa->coa_no ?? '-' }} -
                                                {{ $transaction->debitCoa->name ?? '-' }}</td>
                                            <td>{{ $transaction->recipient_name ?? '-' }}</td>
                                            <td class="amount-cell">Rp
                                                {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}</td>
                                            <td>{{ $transaction->type }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-info view-transaction d-flex align-items-center justify-content-center"
                                                        data-id="{{ $transaction->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    <a href="{{ route('edit-transaction', ['id' => $transaction->id]) }}"
                                                        class="btn btn-sm btn-warning d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <button
                                                        class="btn btn-sm btn-danger delete-transaction d-flex align-items-center justify-content-center"
                                                        data-id="{{ $transaction->id }}">
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

                <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Tambahkan modal-dialog-centered -->
                        <div class="modal-content">
                            <div class="modal-header" style="background: #183018; color: white;">
                                <h5 class="modal-title text-white" id="transactionModalLabel">
                                    <i class="bi bi-credit-card-2-front me-2"></i>Transaction Details
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Transaction Header Info -->
                                <div class="card mb-3 bg-light">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="transaction-icon me-3">
                                                        <i class="bi bi-hash fs-1 text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="text-muted mb-0">Transaction Number</h6>
                                                        <h4 id="transactionNumber" class="mb-0">TX123456789</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                                                    <div class="transaction-status text-end">
                                                        <h6 class="text-muted mb-0">Type</h6>
                                                        <span id="transactionTypeBadge"
                                                            class="badge bg-success">Transfer</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Transaction Details -->
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <!-- Amount Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2">
                                                    <i class="bi bi-cash-coin me-2"></i>Amount
                                                </h6>
                                                <h3 id="transactionAmount" class="text-success mb-0">Rp 1,000,000</h3>
                                            </div>
                                        </div>

                                        <!-- From/To Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bi bi-arrow-left-right me-2"></i>From/To
                                                </h6>
                                                <div class="d-flex align-items-center mb-3">
                                                    
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <small class="text-muted">FROM (CREDIT)</small>
                                                                <p id="transactionKreditCoa" class="mb-0 fw-bold">Cash
                                                                    - 1111</p>
                                                            </div>
                                                            <div class="text-end">
                                                                <small class="text-muted d-block">CREDIT AMOUNT</small>
                                                                <span id="transactionKreditAmount"
                                                                    class="badge bg-danger px-2 py-1">-Rp
                                                                    1,000,000</span>
                                                            </div>
                                                        </div>
                                                        <small id="transactionKreditType" class="text-muted">Account
                                                            Type: Cash</small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                   
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <small class="text-muted">TO (DEBIT)</small>
                                                                <p id="transactionDebitCoa" class="mb-0 fw-bold">Bank
                                                                    - 2222</p>
                                                            </div>
                                                            <div class="text-end">
                                                                <small class="text-muted d-block">DEBIT AMOUNT</small>
                                                                <span id="transactionDebitAmount"
                                                                    class="badge bg-success px-2 py-1">+Rp
                                                                    1,000,000</span>
                                                            </div>
                                                        </div>
                                                        <small id="transactionDebitType" class="text-muted">Account
                                                            Type: Bank</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <!-- Details Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bi bi-info-circle me-2"></i>Transaction Details
                                                </h6>
                                                <div class="transaction-details">
                                                    <div class="row mb-2">
                                                        <div class="col-5 text-muted">Date</div>
                                                        <div id="transactionDate" class="col-7 fw-bold">Jan 01, 2023
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-5 text-muted">Recipient</div>
                                                        <div id="transactionRecipient" class="col-7">John Doe</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-5 text-muted">Transaction Type</div>
                                                        <div id="transactionType" class="col-7">Transfer</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5 text-muted">Description</div>
                                                        <div id="transactionDescription" class="col-7">Monthly
                                                            payment</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Created Info -->
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bi bi-clock-history me-2"></i>Transaction History
                                                </h6>
                                                <div class="row mb-2">
                                                    <div class="col-5 text-muted">Created On</div>
                                                    <div id="transactionCreatedAt" class="col-7">Jan 01, 2023 10:30
                                                        AM</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 text-muted">Last Updated</div>
                                                    <div id="transactionUpdatedAt" class="col-7">Jan 01, 2023 10:30
                                                        AM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i>Close
                                </button>
                                <a href="#" id="editTransaction" class="btn btn-warning d-flex align-items-center">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a>
                                <button type="button" id="printTransaction" class="btn btn-primary d-flex align-items-center">
                                    <i class="bi bi-printer me-2"></i>Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    {{-- modal delete --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-transaction', function(e) {
                e.preventDefault();

                const transactionId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data transaksi akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/transaction/${transactionId}`,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message ||
                                        'Transaksi berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#4A69E2',
                                    timer: 2000,
                                    timerProgressBar: true
                                }).then(() => {
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



    <script>
        $(document).ready(function() {
            // Handle view transaction button click
            $(document).on('click', '.view-transaction', function(e) {
                e.preventDefault();

                // Get transaction ID from data attribute
                const transactionId = $(this).data('id');

                // Show loading state
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send AJAX request to get transaction details
                $.ajax({
                    url: `/transactions/${transactionId}`,
                    type: 'GET',
                    success: function(response) {
                        // Close loading indicator
                        Swal.close();

                        // Populate modal with transaction data
                        $('#transactionNumber').text(response.no_transaction);

                        // Format date
                        const transactionDate = new Date(response.date);
                        const formattedDate = transactionDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#transactionDate').text(formattedDate);

                        // Format created_at and updated_at
                        const createdAt = new Date(response.created_at);
                        const updatedAt = new Date(response.updated_at);

                        const formatDateTime = (date) => {
                            return date.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            }) + ' ' + date.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                        };

                        $('#transactionCreatedAt').text(formatDateTime(createdAt));
                        $('#transactionUpdatedAt').text(formatDateTime(updatedAt));

                        // Set COA information
                        $('#transactionKreditCoa').text(
                            `${response.kredit_coa.name} - ${response.kredit_coa.coa_no}`);
                        $('#transactionDebitCoa').text(
                            `${response.debit_coa.name} - ${response.debit_coa.coa_no}`);

                        // Set recipient
                        $('#transactionRecipient').text(response.recipient_name || 'N/A');

                        // Set transaction type
                        const typeCap = response.type.charAt(0).toUpperCase() + response.type
                            .slice(1);
                        $('#transactionType').text(typeCap);

                        // Set transaction type badge
                        const typeBadge = $('#transactionTypeBadge');
                        typeBadge.text(typeCap);

                        if (response.type === 'transfer') {
                            typeBadge.removeClass('bg-success').addClass('bg-primary');
                        } else if (response.type === 'receive') {
                            typeBadge.removeClass('bg-primary').addClass('bg-success');
                        }

                        // Format amount
                        $('#transactionAmount').text(
                            `Rp ${new Intl.NumberFormat('id-ID').format(response.amount)}`);

                        // Format amount for display
                        const formattedAmount =
                            `Rp ${new Intl.NumberFormat('id-ID').format(response.amount)}`;

                        // Set debit/credit information
                        $('#transactionKreditAmount').text(`-${formattedAmount}`);
                        $('#transactionDebitAmount').text(`+${formattedAmount}`);

                        // Set account types - you might need to adjust this based on your data structure
                        if (response.kredit_coa.type) {
                            $('#transactionKreditType').text(
                                `Account Type: ${response.kredit_coa.type}`);
                        } else {
                            // If type is not available, you can hide this or use a placeholder
                            $('#transactionKreditType').text('');
                        }

                        if (response.debit_coa.type) {
                            $('#transactionDebitType').text(
                                `Account Type: ${response.debit_coa.type}`);
                        } else {
                            // If type is not available, you can hide this or use a placeholder
                            $('#transactionDebitType').text('');
                        }

                        // Set description
                        $('#transactionDescription').text(response.description || 'N/A');

                        // Store transaction ID for edit button
                        $('#editTransaction').attr('href',
                            `/transactions/${transactionId}/edit`);

                        // Show the modal
                        $('#transactionModal').modal('show');
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Failed to load transaction details', 'error');
                    }
                });
            });

            // Handle print transaction button click
            $(document).on('click', '#printTransaction', function() {
                const printContent = $('.modal-body').html();
                const originalContent = $('body').html();

                // Create a print window
                $('body').html(`
                    <div style="padding: 20px;">
                        <h2 style="text-align: center; margin-bottom: 20px;">Transaction Details</h2>
                        ${printContent}
                    </div>
                `);

                // Print
                window.print();

                // Restore original content
                $('body').html(originalContent);

                // Re-initialize Bootstrap elements
                $('#transactionModal').modal('show');
            });
        });
    </script>



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

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

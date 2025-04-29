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

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
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
            color: var(--primary);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.375rem 0.7rem;
        }

        .stats-row {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            min-width: 230px;
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

        @media (max-width: 768px) {
            .stats-row {
                flex-direction: column;
            }

            .stat-card {
                min-width: 100%;
            }

            .action-buttons {
                flex-wrap: wrap;
            }
        }

        .modal-body {
            padding: 1.5rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .transaction-icon i {
            opacity: 0.8;
        }

        .account-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .account-icon i {
            font-size: 1.2rem;
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
                            <h2 class="mb-3">Transaction Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/transaction">Transaction</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Transactions</li>
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
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $total_transactions ?? 145 }}</h3>
                                <p>Total Transactions</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-success">
                                <i class="bi bi-arrow-up-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ number_format($total_amount ?? 25750000) }}</h3>
                                <p>Total Amount</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-warning">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $today_transactions ?? 12 }}</h3>
                                <p>Today's Transactions</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon icon-info"
                                style="background-color: rgba(59, 130, 246, 0.15); color: var(--info);">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $unique_recipients ?? 38 }}</h3>
                                <p>Unique Recipients</p>
                            </div>
                        </div>
                    </div>

                    <!-- filter -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Filter Transactions</h4>
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterCollapse">
                                <i class="bi bi-funnel me-1"></i> Show/Hide Filters
                            </button>
                        </div>
                        <div class="card-body collapse show" id="filterCollapse">
                            <form action="{{ route('index-transaction') }}" method="GET">
                                <div class="row">
                                    <!-- Date filters -->
                                    <div class="col-md-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ request('end_date') }}">
                                    </div>

                                    <!-- Transaction type -->
                                    <div class="col-md-3">
                                        <label class="form-label">Transaction Type</label>
                                        <select name="type" class="form-select">
                                            <option value="">All Types</option>
                                            <option value="transfer"
                                                {{ request('type') == 'transfer' ? 'selected' : '' }}>
                                                Transfer</option>
                                            <option value="receive"
                                                {{ request('type') == 'receive' ? 'selected' : '' }}>
                                                Receive</option>
                                        </select>
                                    </div>

                                    <!-- Transaction number -->
                                    <div class="col-md-3">
                                        <label class="form-label">Transaction Number</label>
                                        <input type="text" name="no_transaction" class="form-control"
                                            value="{{ request('no_transaction') }}" placeholder="Search by number...">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <!-- COA filters -->
                                    <div class="col-md-3">
                                        <label class="form-label">Transfer From (Credit)</label>
                                        <select name="kredit_coa_id" class="form-select">
                                            <option value="">All Accounts</option>
                                            @foreach ($coas as $coa)
                                                <option value="{{ $coa->id }}"
                                                    {{ request('kredit_coa_id') == $coa->id ? 'selected' : '' }}>
                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Deposit To (Debit)</label>
                                        <select name="debit_coa_id" class="form-select">
                                            <option value="">All Accounts</option>
                                            @foreach ($coas as $coa)
                                                <option value="{{ $coa->id }}"
                                                    {{ request('debit_coa_id') == $coa->id ? 'selected' : '' }}>
                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Recipient -->
                                    <div class="col-md-3">
                                        <label class="form-label">Recipient</label>
                                        <input type="text" name="recipient_name" class="form-control"
                                            value="{{ request('recipient_name') }}"
                                            placeholder="Search recipient...">
                                    </div>

                                    <!-- Amount range -->
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('index-transaction') }}"
                                            class="btn btn-secondary me-2">Reset</a>
                                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                                    </div>
                                </div>
                            </form>
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
                                            <i class="bi bi-plus-circle me-2"></i>Add Transaction
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
                                                        class="btn btn-sm btn-info view-transaction"
                                                        data-id="{{ $transaction->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    <a href="{{ route('edit-transaction', ['id' => $transaction->id]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-danger delete-transaction"
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

                <!-- Transaction Modal -->
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
                                                    <div
                                                        class="account-icon bg-danger bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="bi bi-arrow-up-right text-danger"></i>
                                                    </div>
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
                                                    <div
                                                        class="account-icon bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="bi bi-arrow-down-left text-success"></i>
                                                    </div>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i>Close
                                </button>
                                <a href="#" id="editTransaction" class="btn btn-warning">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a>
                                <button type="button" id="printTransaction" class="btn btn-primary">
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

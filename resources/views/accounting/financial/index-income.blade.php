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
        /* Modern Color Scheme - Reusing from COA page */
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #10b981;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-800: #343a40;
        }

        /* Card Styling */
        .card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 24px;
        }

        .card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }

        .card-header h4 {
            margin-bottom: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Navigation Tabs */
        .finance-nav {
            background: white;
            border-radius: 12px;
            padding: 0.75rem;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .finance-nav-item {
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            color: var(--gray-800);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .finance-nav-item.active {
            background: var(--primary);
            color: white;
        }

        .finance-nav-item:hover:not(.active) {
            background: var(--gray-100);
        }

        /* Stats Cards - From COA */
        .stats-card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.12);
        }

        .stats-icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: white;
        }

        .stats-icon.blue {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
        }

        .stats-icon.green {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stats-icon.orange {
            background: linear-gradient(135deg, #fb923c, #ea580c);
        }

        .stats-icon.red {
            background: linear-gradient(135deg, #f72585, #e63946);
        }

        .stats-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--dark);
        }

        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stats-trend {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
        }

        .stats-trend.up {
            color: #10b981;
        }

        .stats-trend.down {
            color: #ef4444;
        }

        /* Buttons */
        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-action.tiny {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            /* biasanya setara 14px */
            line-height: 1.5;
            border-radius: 0.2rem;

        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--gray-800);
            border: none;
        }

        /* Small Action Buttons */
        .btn-action {
            padding: 0.35rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            margin-right: 0.5rem;
        }

        .btn-action.view {
            background-color: var(--success);
            color: white;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .status-badge.success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .status-badge.pending {
            background-color: rgba(251, 146, 60, 0.15);
            color: #fb923c;
        }

        .status-badge.failed {
            background-color: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        /* Invoice Number Style */
        .invoice-number {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: var(--dark);
            padding: 0.3rem 0.6rem;
            background-color: var(--gray-100);
            border-radius: 4px;
            display: inline-block;
        }

        /* Currency formatting */
        .currency {
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }

        /* Chart container */
        .chart-container {
            height: 300px;
            margin-bottom: 1rem;
        }

        /* Date label */
        .date-label {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Summary block */
        .summary-block {
            background-color: var(--gray-100);
            border-radius: 8px;
            padding: 1rem;
        }

        .summary-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-size: 1.25rem;
            font-weight: 700;
        }

        /* Export button */
        .btn-export {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.25);
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
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
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h2>Financial Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('index-financial-income') }}">Financial Income</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <button class="btn btn-export">
                                <i class="bi bi-file-earmark-excel me-2"></i> Export Data
                            </button>
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
                    <a href="#" class="finance-nav-item">
                        <i class="bi bi-pie-chart me-2"></i>Reports
                    </a>
                    <a href="#" class="finance-nav-item">
                        <i class="bi bi-journal-text me-2"></i>Journal
                    </a>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats mb-4">
                    <div class="col-12 col-md-3 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Total Income</p>
                                        <h3 class="stats-value">Rp 45.8M</h3>
                                        <p class="stats-trend up">
                                            <i class="bi bi-arrow-up"></i> 12% from last month
                                        </p>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-cash-stack fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Pending</p>
                                        <h3 class="stats-value">Rp 12.3M</h3>
                                        <p class="stats-trend down">
                                            <i class="bi bi-arrow-down"></i> 3% from last month
                                        </p>
                                    </div>
                                    <div class="stats-icon orange">
                                        <i class="bi bi-hourglass-split fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Success Rate</p>
                                        <h3 class="stats-value">87%</h3>
                                        <p class="stats-trend up">
                                            <i class="bi bi-arrow-up"></i> 5% from last month
                                        </p>
                                    </div>
                                    <div class="stats-icon blue">
                                        <i class="bi bi-graph-up fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Due Soon</p>
                                        <h3 class="stats-value">Rp 8.7M</h3>
                                        <p class="stats-trend">
                                            <i class="bi bi-calendar-event"></i> Next 7 days
                                        </p>
                                    </div>
                                    <div class="stats-icon red">
                                        <i class="bi bi-clock-history fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Income Overview</h4>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-primary active">Monthly</button>
                            <button class="btn btn-sm btn-outline-primary">Quarterly</button>
                            <button class="btn btn-sm btn-outline-primary">Yearly</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <!-- Chart placeholder - in real application, you'd integrate a charting library -->
                            <div
                                style="height: 100%; background-color: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <p class="text-muted">Income trend chart would appear here</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 mb-3">
                                <div class="summary-block">
                                    <p class="summary-title">Top Income Source</p>
                                    <p class="summary-value">Sales Invoice</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="summary-block">
                                    <p class="summary-title">Average Invoice</p>
                                    <p class="summary-value">Rp 5.2M</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="summary-block">
                                    <p class="summary-title">Largest Invoice</p>
                                    <p class="summary-value">Rp 12.5M</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="summary-block">
                                    <p class="summary-title">Average Processing Time</p>
                                    <p class="summary-value">3.2 days</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Filter Income</h4>
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterCollapse">
                            <i class="bi bi-funnel me-1"></i> Show/Hide Filters
                        </button>
                    </div>
                    <div class="card-body collapse show" id="filterCollapse">
                        <form action="{{ route('index-financial-income') }}" method="GET">
                            <div class="row">
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
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>
                                            Success</option>
                                        <option value="pending"
                                            {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>
                                            Failed</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Supplier</label>
                                    <select name="supplier" class="form-select">
                                        <option value="">All Suppliers</option>
                                        <option value="1">Supplier A</option>
                                        <option value="2">Supplier B</option>
                                        <option value="3">Supplier C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('index-financial-income') }}"
                                        class="btn btn-secondary me-2">Reset</a>
                                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Income Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Income Transactions</h4>
                        <div>
                            <button class="btn btn-sm btn-outline-success" id="exportExcel">
                                <i class="bi bi-file-earmark-excel"></i> Export to Excel
                            </button>
                            <button class="btn btn-sm btn-outline-danger" id="exportPdf">
                                <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Invoice No</th>
                                    <th>No Transaction (Doku)</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finances as $finance)
                                    <tr>
                                        <td>
                                            <span class="invoice-number fw-bold">
                                                {{ $finance->order->invoice->no_invoice ?? 'Not Generated' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="transaction-id">{{ $finance->transaction_id ?? ($finance->order->doku_order_id ?? '—') }}</span>
                                        </td>
                                        <td>{{ Str::limit($finance->payment_method ?? 'N/A', 30, '...') }}</td>
                                        <td>
                                            <span class="currency">Rp
                                                {{ number_format($finance->amount, 0, ',', '.') }}</span>
                                        </td>

                                        <td>
                                            <span class="date-label">
                                                {{ $finance->payment_date ? \Carbon\Carbon::parse($finance->payment_date)->format('d M Y') : '—' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="status-badge {{ $finance->status == 'completed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($finance->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn-action view tiny view-income btn-primary"
                                                data-id="{{ $finance->id }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>

                <div class="modal fade" id="incomeModal" tabindex="-1" aria-labelledby="incomeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #183018; color: white;">
                                <h5 class="modal-title text-white" id="incomeModalLabel">
                                    <i class="bi bi-cash-coin me-2"></i>Income Detail
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
                                                        <i class="bi bi-receipt fs-1 text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="text-muted mb-0">Invoice Number</h6>
                                                        <h4 id="modalInvoiceNumber" class="mb-0">-</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                                                    <div class="transaction-status text-end">
                                                        <h6 class="text-muted mb-0">Status</h6>
                                                        <span id="modalStatus" class="badge bg-success">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Income Details -->
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <!-- Amount Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-2">
                                                    <i class="bi bi-cash-coin me-2"></i>Amount
                                                </h6>
                                                <h3 id="modalAmount" class="text-success mb-0">-</h3>
                                            </div>
                                        </div>

                                        <!-- Payment Method Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bi bi-credit-card me-2"></i>Payment Method
                                                </h6>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="account-icon bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                        <i class="bi bi-wallet2 text-success"></i>
                                                    </div>
                                                    <div>
                                                        <p id="modalPaymentMethod" class="mb-0 fw-bold">-</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Transaction ID Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bi bi-hash me-2"></i>Transaction ID (DOKU)
                                                </h6>
                                                <p id="modalTransactionID" class="mb-0">-</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <!-- Details Card -->
                                        <div class="card mb-3 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bi bi-info-circle me-2"></i>Payment Details
                                                </h6>
                                                <div class="transaction-details">
                                                    <div class="row mb-2">
                                                        <div class="col-5 text-muted">Order Date</div>
                                                        <div id="modalOrderDate" class="col-7">-</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-5 text-muted">Payment Date</div>
                                                        <div id="modalPaymentDate" class="col-7">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Breakdown -->
                                <div class="card border-0 shadow-sm mt-3">
                                    <div class="card-body">
                                        <h6 class="text-muted mb-3">
                                            <i class="bi bi-receipt me-2"></i>Order Breakdown
                                        </h6>
                                        <table class="table table-sm">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Description</th>
                                                    <th class="text-end">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="orderBreakdown">
                                                <!-- Will be populated by JS -->
                                            </tbody>
                                            <tfoot class="fw-bold">
                                                <tr>
                                                    <td>Total</td>
                                                    <td id="modalTotalAmount" class="text-end">-</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i>Close
                                </button>

                                <button type="button" id="printIncome" class="btn btn-primary">
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
        // View income details
        $(document).on('click', '.view-income', function(e) {
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
                url: `/income/${id}`,
                method: 'GET',
                success: function(response) {
                    // Close loading indicator
                    Swal.close();

                    // Populate modal with income data
                    $('#modalTransactionID').text(response.transaction_id ?? (response.order
                        ?.doku_order_id ?? '-'));
                    $('#modalPaymentMethod').text(response.payment_method ?? '-');

                    if (response.order?.invoice?.no_invoice) {
                        $('#modalInvoiceNumber').text(response.order.invoice.no_invoice);
                        // Enable the view invoice button and set its href
                        $('#viewInvoice').attr('href', `/invoices/${response.order.invoice.id}`)
                            .removeClass('disabled');
                    } else {
                        $('#modalInvoiceNumber').text('Not Generated');
                        // Disable the view invoice button
                        $('#viewInvoice').addClass('disabled');
                    }

                    // Format amount
                    $('#modalAmount').text('Rp ' + new Intl.NumberFormat('id-ID').format(response
                        .amount));

                    // Format payment date
                    if (response.payment_date) {
                        const paymentDate = new Date(response.payment_date);
                        const formattedPaymentDate = paymentDate.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#modalPaymentDate').text(formattedPaymentDate);
                    } else {
                        $('#modalPaymentDate').text('-');
                    }

                    // Format order date
                    if (response.order?.order_date) {
                        const orderDate = new Date(response.order.order_date);
                        const formattedOrderDate = orderDate.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#modalOrderDate').text(formattedOrderDate);
                    } else {
                        $('#modalOrderDate').text('-');
                    }

                    // Set status with appropriate color
                    $('#modalStatus').text(response.status);
                    if (response.status === 'completed') {
                        $('#modalStatus').removeClass('bg-warning bg-danger').addClass('bg-success');
                    } else if (response.status === 'pending') {
                        $('#modalStatus').removeClass('bg-success bg-danger').addClass('bg-warning');
                    } else {
                        $('#modalStatus').removeClass('bg-success bg-warning').addClass('bg-danger');
                    }

                    // Clear existing breakdown
                    $('#orderBreakdown').empty();

                    // Add item subtotal
                    if (response.order?.total_item_price) {
                        $('#orderBreakdown').append(`
                        <tr>
                            <td>Products Subtotal (${response.order.total_item || 0} items)</td>
                            <td class="text-end">Rp ${new Intl.NumberFormat('id-ID').format(response.order.total_item_price)}</td>
                        </tr>
                    `);
                    }

                    // Add shipping cost
                    if (response.order?.shipping_cost) {
                        $('#orderBreakdown').append(`
                        <tr>
                            <td>Shipping Cost (${response.order.kurir || 'Unknown Courier'})</td>
                            <td class="text-end">Rp ${new Intl.NumberFormat('id-ID').format(response.order.shipping_cost)}</td>
                        </tr>
                    `);
                    }

                    // Add discount if any
                    if (response.order?.discount_amount && response.order.discount_amount > 0) {
                        $('#orderBreakdown').append(`
                        <tr>
                            <td>Discount (${response.order.voucher_promo || 'Promo'})</td>
                            <td class="text-end text-danger">- Rp ${new Intl.NumberFormat('id-ID').format(response.order.discount_amount)}</td>
                        </tr>
                    `);
                    }

                    // Add shipping discount if any
                    if (response.order?.discount_ongkir && response.order.discount_ongkir > 0) {
                        $('#orderBreakdown').append(`
                        <tr>
                            <td>Shipping Discount (${response.order.voucher_ongkir || 'Promo'})</td>
                            <td class="text-end text-danger">- Rp ${new Intl.NumberFormat('id-ID').format(response.order.discount_ongkir)}</td>
                        </tr>
                    `);
                    }

                    // Set total amount
                    if (response.order?.total_amount) {
                        $('#modalTotalAmount').text('Rp ' + new Intl.NumberFormat('id-ID').format(
                            response.order.total_amount));
                    } else {
                        $('#modalTotalAmount').text('Rp ' + new Intl.NumberFormat('id-ID').format(
                            response.amount));
                    }

                    // Set edit link
                    $('#editIncome').attr('href', `/income/${id}/edit`);

                    // Show the modal
                    $('#incomeModal').modal('show');
                },
                error: function() {
                    Swal.fire('Error', 'Failed to load income data.', 'error');
                }
            });
        });


        // Handle print income button click
        $(document).on('click', '#printIncome', function() {
            const printContent = $('.modal-body').html();
            const originalContent = $('body').html();

            // Create a print window
            $('body').html(`
            <div style="padding: 20px;">
                <h2 style="text-align: center; margin-bottom: 20px;">Income Details</h2>
                ${printContent}
            </div>
        `);

            // Print
            window.print();

            // Restore original content
            $('body').html(originalContent);

            // Re-initialize Bootstrap elements
            $('#incomeModal').modal('show');
        });
    </script>



    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

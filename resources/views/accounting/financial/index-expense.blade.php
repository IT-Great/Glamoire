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

        .btn-action.edit {
            background-color: var(--info);
            color: white;
        }

        .btn-action.delete {
            background-color: var(--danger);
            color: white;
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
                                    <li class="breadcrumb-item"><a href="/brand-admin">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="/financial">Financial</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Income</li>
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
                                            name="has_pph" value="1" {{ request('has_pph') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="hasPph">Has PPH</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('index-invoice') }}" class="btn btn-secondary me-2">Reset</a>
                                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                        <td class="amount-cell">Rp 5,750,000</td>
                                        <td>Mar 15, 2023</td>
                                        <td class="deadline-safe">Apr 15, 2023</td>
                                        <td>
                                            <span class="badge bg-light-success">Paid</span>
                                        </td>
                                        <td>Bank Transfer</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('create-invoice', ['id' => 1]) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('edit-invoice', ['id' => 1]) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger delete-invoice" data-id="1">
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
            </div>
            @include('admin.layouts.footer')
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

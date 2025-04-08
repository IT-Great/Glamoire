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
                                    <li class="breadcrumb-item"><a href="index.html"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="index.html">Transaction</a></li>
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

                    <!-- Navigation Tabs -->
                    <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                        <a href="{{ route('index-transaction') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'index-transaction' ? 'active' : '' }}">
                            <i class="bi bi-credit-card"></i>All Transactions
                        </a>
                        {{-- <a href="{{ route('transfer-transaction') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'transfer-transaction' ? 'active' : '' }}">
                            <i class="bi bi-arrow-left-right"></i>Transfer History
                        </a> --}}
                        {{-- <a href="{{ route('transaction-reports') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'transaction-reports' ? 'active' : '' }}">
                            <i class="bi bi-graph-up"></i>Reports & Analytics
                        </a> --}}
                    </div>

                    <!-- Filters Row -->
                    <div class="filters-row">
                        <div class="filter-item">
                            <select id="account-filter" class="form-select">
                                <option value="">All Transfer Accounts</option>
                                @foreach ($transfer_accounts ?? [] as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <select id="deposit-filter" class="form-select">
                                <option value="">All Deposit Accounts</option>
                                @foreach ($deposit_accounts ?? [] as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <input type="date" id="date-filter" class="form-control" placeholder="Transaction Date">
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
                                    {{-- <a href="{{ route('export-transactions') }}" type="button"
                                        class="btn btn-sm btn-info d-flex align-items-center me-2">
                                        <i class="bi bi-file-earmark-excel me-2"></i>Export
                                    </a> --}}
                                    <a href="{{ route('create-transaction') }}" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                        <i class="bi bi-plus-circle me-2"></i>Add Transaction
                                    </a>
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
                                        <th>DESCRIPTION</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions ?? [] as $transaction)
                                        <tr>
                                            <td><strong>{{ $transaction->no_transaction }}</strong></td>
                                            <td>{{ $transaction->transferAccount->name ?? 'Cash Account' }}</td>
                                            <td>{{ $transaction->depositAccount->name ?? 'Main Account' }}</td>
                                            <td>{{ $transaction->recipient_name ?? 'N/A' }}</td>
                                            <td class="amount-cell">Rp {{ number_format($transaction->amount) }}</td>
                                            <td>{{ $transaction->date->format('M d, Y') }}</td>
                                            <td>{{ Str::limit($transaction->description, 30) ?? '-' }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('view-transaction', ['id' => $transaction->id]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('edit-transaction', ['id' => $transaction->id]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a> --}}
                                                    <button class="btn btn-sm btn-danger delete-transaction"
                                                        data-id="{{ $transaction->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <!-- Sample data for display purposes only -->
                                        <tr>
                                            <td><strong>TRX-2025-001</strong></td>
                                            <td>Cash Account</td>
                                            <td>Main Operational</td>
                                            <td>PT Supplier Indonesia</td>
                                            <td class="amount-cell">Rp 5,750,000</td>
                                            <td>Apr 5, 2025</td>
                                            <td>Monthly office supplies payment</td>
                                            <td>
                                                <div class="action-buttons">
                                                    {{-- <a href="{{ route('view-transaction', ['id' => 1]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a> --}}
                                                    {{-- <a href="{{ route('edit-transaction', ['id' => 1]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a> --}}
                                                    <button class="btn btn-sm btn-danger delete-transaction"
                                                        data-id="1">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>TRX-2025-002</strong></td>
                                            <td>Bank Account</td>
                                            <td>Tax Reserves</td>
                                            <td>Tax Office</td>
                                            <td class="amount-cell">Rp 3,250,000</td>
                                            <td>Apr 1, 2025</td>
                                            <td>Quarterly tax payment</td>
                                            <td>
                                                <div class="action-buttons">
                                                    {{-- <a href="{{ route('view-transaction', ['id' => 2]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a> --}}
                                                    {{-- <a href="{{ route('edit-transaction', ['id' => 2]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a> --}}
                                                    <button class="btn btn-sm btn-danger delete-transaction"
                                                        data-id="2">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>TRX-2025-003</strong></td>
                                            <td>Investment Account</td>
                                            <td>Emergency Fund</td>
                                            <td>Internal Transfer</td>
                                            <td class="amount-cell">Rp 10,000,000</td>
                                            <td>Mar 28, 2025</td>
                                            <td>Monthly emergency fund allocation</td>
                                            <td>
                                                <div class="action-buttons">
                                                    {{-- <a href="{{ route('view-transaction', ['id' => 3]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('edit-transaction', ['id' => 3]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a> --}}
                                                    <button class="btn btn-sm btn-danger delete-transaction"
                                                        data-id="3">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>TRX-2025-004</strong></td>
                                            <td>Payroll Account</td>
                                            <td>Employee Benefits</td>
                                            <td>HR Department</td>
                                            <td class="amount-cell">Rp 8,500,000</td>
                                            <td>Mar 25, 2025</td>
                                            <td>Employee health benefits payment</td>
                                            <td>
                                                <div class="action-buttons">
                                                    {{-- <a href="{{ route('view-transaction', ['id' => 4]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('edit-transaction', ['id' => 4]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a> --}}
                                                    <button class="btn btn-sm btn-danger delete-transaction"
                                                        data-id="4">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
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

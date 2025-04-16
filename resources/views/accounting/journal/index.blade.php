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
        /* Statistics Row Styling */
        .stats-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            flex: 1;
            display: flex;
            align-items: center;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            min-width: 220px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            margin-right: 15px;
            font-size: 1.5rem;
        }

        .icon-primary {
            background-color: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }

        .icon-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .icon-warning {
            background-color: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .icon-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        .icon-info {
            background-color: rgba(14, 165, 233, 0.15);
            color: #0ea5e9;
        }

        .stat-content h3 {
            font-size: 1.5rem;
            margin: 0;
            font-weight: 600;
            line-height: 1.2;
        }

        .stat-content p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Filters Row Styling */
        .filters-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-item {
            flex: 1;
            min-width: 180px;
        }

        /* Quick Stats */
        .stats-item {
            flex: 1;
            min-width: 120px;
        }

        .stats-label {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 2px;
        }

        .stats-value {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
        }

        .stats-desc {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
        }

        .divider-vertical {
            width: 1px;
            align-self: stretch;
            background-color: #e2e8f0;
        }

        /* Navigation Tabs */
        .promo-nav {
            margin-bottom: 20px;
        }

        .promo-nav-item {
            display: inline-flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b;
            background-color: #f8fafc;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .promo-nav-item i {
            margin-right: 8px;
        }

        .promo-nav-item:hover {
            background-color: #f1f5f9;
            color: #334155;
        }

        .promo-nav-item.active {
            background-color: #3b82f6;
            color: white;
        }

        /* Journal entry details */
        .journal-details {
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
        }

        /* Activity Timeline */
        .activity-timeline {
            list-style: none;
            padding: 0;
            position: relative;
        }

        .activity-timeline:before {
            content: '';
            position: absolute;
            top: 5px;
            bottom: 0;
            left: 7px;
            width: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .activity-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 20px;
        }

        .activity-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #3b82f6;
            z-index: 1;
        }

        .activity-time {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 3px;
        }

        .activity-title {
            margin: 0 0 5px;
            font-size: 1rem;
        }

        .activity-text {
            margin: 0;
            color: #64748b;
            font-size: 0.875rem;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        /* Badge styles */
        .badge.bg-light-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .badge.bg-light-warning {
            background-color: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .badge.bg-light-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        .badge.bg-light-secondary {
            background-color: rgba(100, 116, 139, 0.15);
            color: #64748b;
        }

        /* Table enhancements */
        .table>thead>tr>th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom-width: 2px;
            background-color: #f8fafc;
        }

        .table .parent-row {
            cursor: pointer;
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
                            <h2 class="mb-3">Journal Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="index.html">Journal</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Journal Entries</li>
                                </ol>
                            </nav>
                        </div>
                     
                    </div>
                </div>

                <section class="section">
                    <!-- Financial Summary -->
                    <div class="stats-row">
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
                    </div>

                    <!-- Journal Quick Stats -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <div class="stats-item text-center">
                                            <span class="stats-label">Today</span>
                                            <h4 class="stats-value">12</h4>
                                            <span class="stats-desc">Entries</span>
                                        </div>
                                        <div class="divider-vertical d-none d-md-block"></div>
                                        <div class="stats-item text-center">
                                            <span class="stats-label">This Week</span>
                                            <h4 class="stats-value">48</h4>
                                            <span class="stats-desc">Entries</span>
                                        </div>
                                        <div class="divider-vertical d-none d-md-block"></div>
                                        <div class="stats-item text-center">
                                            <span class="stats-label">This Month</span>
                                            <h4 class="stats-value">145</h4>
                                            <span class="stats-desc">Entries</span>
                                        </div>
                                        <div class="divider-vertical d-none d-md-block"></div>
                                        <div class="stats-item text-center">
                                            <span class="stats-label">Manual Entries</span>
                                            <h4 class="stats-value">65%</h4>
                                            <span class="stats-desc">Of Total</span>
                                        </div>
                                        <div class="divider-vertical d-none d-md-block"></div>
                                        <div class="stats-item text-center">
                                            <span class="stats-label">Automated Entries</span>
                                            <h4 class="stats-value">35%</h4>
                                            <span class="stats-desc">Of Total</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                        <a href="{{ route('index-journal') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'index-journal' ? 'active' : '' }}">
                            <i class="bi bi-journal-bookmark"></i>Journal Entries
                        </a>
                        {{-- <a href="{{ route('index-chart-accounts') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'index-chart-accounts' ? 'active' : '' }}">
                            <i class="bi bi-diagram-3"></i>Chart of Accounts
                        </a>
                        <a href="{{ route('general-ledger') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'general-ledger' ? 'active' : '' }}">
                            <i class="bi bi-book"></i>General Ledger
                        </a>
                        <a href="{{ route('accounting-reports') }}"
                            class="promo-nav-item {{ Route::currentRouteName() == 'accounting-reports' ? 'active' : '' }}">
                            <i class="bi bi-graph-up"></i>Financial Reports
                        </a> --}}
                    </div>

                    <!-- Filters Row -->
                    <div class="filters-row">
                        <div class="filter-item">
                            <select id="entry-type-filter" class="form-select">
                                <option value="">All Entry Types</option>
                                <option value="Standard">Standard</option>
                                <option value="Adjusting">Adjusting</option>
                                <option value="Recurring">Recurring</option>
                                <option value="Closing">Closing</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <select id="status-filter" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="Posted">Posted</option>
                                <option value="Draft">Draft</option>
                                <option value="Pending Review">Pending Review</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <input type="date" id="date-filter" class="form-control" placeholder="Date Range">
                        </div>
                        <div class="filter-item flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control"
                                    placeholder="Search by description, account, or reference...">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4><i class="bi bi-journal-plus"></i> Journal Entries</h4>
                                </div>
                                <div
                                    class="col-12 col-md-6 d-flex justify-content-md-end align-items-center order-md-2 order-first">
                                    <div class="dropdown me-2">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            type="button" id="exportDropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false">
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
                                    {{-- <a href="{{ route('create-journal') }}" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                        <i class="bi bi-plus-circle me-2"></i>New Journal Entry
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
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
                                    {{-- @foreach ($journals as $journal)
                                        <tr class="parent-row" data-id="{{ $journal->id }}">
                                            <td><strong>JRN-{{ $journal->id }}</strong></td>
                                            <td>{{ $journal->date ? date('M d, Y', strtotime($journal->date)) : '-' }}
                                            </td>
                                            <td>{{ $journal->description ?? 'Monthly Expense Allocation' }}</td>
                                            <td>{{ $journal->reference ?? 'REF-2023/03-124' }}</td>
                                            <td>
                                                <span class="badge bg-light-success">Posted</span>
                                            </td>
                                            <td class="text-end">Rp 5,750,000</td>
                                            <td class="text-end">Rp 5,750,000</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-outline-secondary toggle-details">
                                                        <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                    <a href="{{ route('view-journal', ['id' => $journal->id]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('edit-journal', ['id' => $journal->id]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-danger delete-journal"
                                                        data-id="{{ $journal->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
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
                                                                <td>5100</td>
                                                                <td>Office Rent Expense</td>
                                                                <td>March 2023 Office Rent</td>
                                                                <td class="text-end">Rp 3,500,000</td>
                                                                <td class="text-end">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5200</td>
                                                                <td>Utilities Expense</td>
                                                                <td>March 2023 Utilities</td>
                                                                <td class="text-end">Rp 1,250,000</td>
                                                                <td class="text-end">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5300</td>
                                                                <td>Internet & Phone Expense</td>
                                                                <td>March 2023 Internet & Phone</td>
                                                                <td class="text-end">Rp 1,000,000</td>
                                                                <td class="text-end">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1000</td>
                                                                <td>Cash</td>
                                                                <td>Payment for Monthly Expenses</td>
                                                                <td class="text-end">-</td>
                                                                <td class="text-end">Rp 5,750,000</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="table-light">
                                                                <td colspan="3"><strong>TOTAL</strong></td>
                                                                <td class="text-end"><strong>Rp 5,750,000</strong></td>
                                                                <td class="text-end"><strong>Rp 5,750,000</strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="entry-meta mt-3">
                                                        <span class="badge bg-light-secondary me-2"><i
                                                                class="bi bi-person me-1"></i>Created by: Admin</span>
                                                        <span class="badge bg-light-secondary me-2"><i
                                                                class="bi bi-calendar me-1"></i>Created: Mar 15,
                                                            2023</span>
                                                        <span class="badge bg-light-secondary"><i
                                                                class="bi bi-check-circle me-1"></i>Approved by:
                                                            Finance Manager</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Activity & Quick Stats -->
                    <div class="row mt-4">
                        <!-- Recent Activity -->
                        <div class="col-12 col-lg-8 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><i class="bi bi-activity me-2"></i>Recent Journal Activity
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <ul class="activity-timeline">
                                        <li class="activity-item">
                                            <div class="activity-content">
                                                <span class="activity-time">Today, 10:30 AM</span>
                                                <h6 class="activity-title">New Journal Entry Created</h6>
                                                <p class="activity-text">Journal #JRN-146 was created by
                                                    <strong>Finance Admin</strong>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="activity-item">
                                            <div class="activity-content">
                                                <span class="activity-time">Yesterday, 2:15 PM</span>
                                                <h6 class="activity-title">Journal Entry Approved</h6>
                                                <p class="activity-text">Journal #JRN-145 was approved by
                                                    <strong>Finance Manager</strong>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="activity-item">
                                            <div class="activity-content">
                                                <span class="activity-time">Yesterday, 11:45 AM</span>
                                                <h6 class="activity-title">Journal Entry Modified</h6>
                                                <p class="activity-text">Journal #JRN-144 was modified by
                                                    <strong>Accounting Staff</strong>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="activity-item">
                                            <div class="activity-content">
                                                <span class="activity-time">Mar 14, 2023</span>
                                                <h6 class="activity-title">Month-End Closing Entries</h6>
                                                <p class="activity-text">12 closing entries were posted for February
                                                    2023</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats & Actions -->
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><i class="bi bi-bar-chart me-2"></i>Account Activity</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="account-activity-chart" style="height: 200px;">
                                        <!-- Chart will be rendered here -->
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Most Active Account</span>
                                            <span class="fw-bold">Cash (1000)</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Largest Transaction</span>
                                            <span class="fw-bold">Rp 15,000,000</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Missing Journal Numbers</span>
                                            <span class="badge bg-warning rounded-pill">3</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        {{-- <a href="{{ route('reconciliation') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-check2-square me-2"></i>Start Reconciliation
                                        </a> --}}
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

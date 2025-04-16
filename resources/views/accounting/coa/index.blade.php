<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COA - Glamoire</title>

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
        /* Modern Color Scheme */
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
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
        .stats-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.12);
        }

        .stats-card .card-body {
            padding: 1.5rem;
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
            background: linear-gradient(135deg, #4cc9f0, #4895ef);
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

        /* Main Table Styling */
        .brand-card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table-container {
            padding: 1rem;
            overflow-x: auto;
        }

        .coa-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .coa-table thead th {
            background-color: var(--gray-100);
            padding: 1rem;
            font-weight: 600;
            color: var(--gray-800);
            border-bottom: 2px solid var(--gray-200);
            white-space: nowrap;
        }

        .coa-table tbody tr {
            transition: all 0.2s ease;
        }

        .coa-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .coa-table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-200);
        }

        /* Action Buttons */
        .btn-action {
            padding: 0.35rem 0.6rem;
            /* Reduced padding */
            border-radius: 6px;
            font-size: 0.75rem;
            /* Smaller font size */
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            /* Changed from flex to inline-flex */
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            margin-right: 0.5rem;
            /* Add right margin instead of bottom margin */
            white-space: nowrap;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-action i {
            font-size: 1rem;
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

        /* Category Badges */
        .category-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .category-badge.asset {
            background-color: rgba(72, 149, 239, 0.15);
            color: #4895ef;
        }

        .category-badge.liability {
            background-color: rgba(247, 37, 133, 0.15);
            color: #f72585;
        }

        .category-badge.equity {
            background-color: rgba(58, 12, 163, 0.15);
            color: #3a0ca3;
        }

        .category-badge.revenue {
            background-color: rgba(76, 201, 240, 0.15);
            color: #4cc9f0;
        }

        .category-badge.expense {
            background-color: rgba(230, 57, 70, 0.15);
            color: #e63946;
        }

        /* Heading & Page Title */
        .page-heading {
            margin-bottom: 2rem;
        }

        .page-title h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        /* Search & Filter */
        .search-container {
            position: relative;
        }

        .search-input {
            padding-left: 2.5rem;
            border-radius: 8px;
            border: 1px solid var(--gray-300);
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
            width: 100%;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .filter-dropdown {
            border-radius: 8px;
            border: 1px solid var(--gray-300);
            padding: 0.6rem;
            background-color: white;
        }

        /* Create Button */
        .btn-create {
            padding: 0.5rem 1.2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.25);
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.3);
        }

        /* Account Number Styling */
        .account-number {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: var(--dark);
            padding: 0.3rem 0.6rem;
            background-color: var(--gray-100);
            border-radius: 4px;
            display: inline-block;
        }

        /* COA Name */
        .coa-name {
            font-weight: 500;
            color: var(--dark);
        }

        /* COA Description */
        .coa-description {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.2rem;
            display: block;
        }

        /* Type Badge */
        .type-badge {
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .type-badge.debit {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .type-badge.credit {
            background-color: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        /* Posted Badge */
        .posted-badge {
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .posted-badge.yes {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .posted-badge.no {
            background-color: rgba(107, 114, 128, 0.15);
            color: #6b7280;
        }

        /* Currency formatting */
        .currency {
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }

        .date-display {
            white-space: nowrap;
            font-size: 0.85rem;
        }

        /* Summary section */
        .summary-container {
            background-color: var(--gray-100);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .summary-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .summary-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .summary-label {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .summary-value {
            font-weight: 600;
            margin-left: 0.5rem;
        }

        /* Compact view switch */
        .view-switch {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-switch .form-check-input {
            cursor: pointer;
        }

        .view-switch label {
            margin-bottom: 0;
            cursor: pointer;
            font-size: 0.9rem;
        }

        td .d-flex {
            flex-direction: row !important;
            /* Change from column to row */
            gap: 0.5rem !important;
            /* Add gap between buttons */
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
                            <h2>Chart of Accounts</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/brand-admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chart of Accounts</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="summary-container mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">COA Distribution</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="summary-item">
                                        <div class="summary-color" style="background-color: #4895ef;"></div>
                                        <span class="summary-label">Assets:</span>
                                        <span class="summary-value">30</span>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-color" style="background-color: #f72585;"></div>
                                        <span class="summary-label">Liabilities:</span>
                                        <span class="summary-value">25</span>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-color" style="background-color: #3a0ca3;"></div>
                                        <span class="summary-label">Equity:</span>
                                        <span class="summary-value">10</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="summary-item">
                                        <div class="summary-color" style="background-color: #4cc9f0;"></div>
                                        <span class="summary-label">Revenue:</span>
                                        <span class="summary-value">20</span>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-color" style="background-color: #e63946;"></div>
                                        <span class="summary-label">Expenses:</span>
                                        <span class="summary-value">15</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3">Quick Actions</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('create-chartofaccount') }}" class="btn btn-create mb-2">
                                            <i class="bi bi-plus-circle"></i> New COA
                                        </a>
                                        <button class="btn btn-create mb-2"
                                            style="background: linear-gradient(135deg, #10b981, #059669);">
                                            <i class="bi bi-file-earmark-excel"></i> Export
                                        </button>
                                        <button class="btn btn-create mb-2"
                                            style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                                            <i class="bi bi-file-earmark-arrow-up"></i> Import
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats mb-4">
                    <div class="col-12 col-md-4 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Total COA</p>
                                        <h3 class="stats-value">100</h3>
                                        <p class="stats-trend up">
                                            <i class="bi bi-arrow-up"></i> 5% from last month
                                        </p>
                                    </div>
                                    <div class="stats-icon blue">
                                        <i class="bi bi-journals fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Total Debit</p>
                                        <h3 class="stats-value">Rp 2.5M</h3>
                                        <p class="stats-trend up">
                                            <i class="bi bi-arrow-up"></i> 8% from last month
                                        </p>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-cash-stack fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="stats-label">Total Credit</p>
                                        <h3 class="stats-value">Rp 2.2M</h3>
                                        <p class="stats-trend up">
                                            <i class="bi bi-arrow-up"></i> 6% from last month
                                        </p>
                                    </div>
                                    <div class="stats-icon red">
                                        <i class="bi bi-credit-card fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COA Table Section -->
                <div class="card brand-card">
                    <div class="card-header bg-white py-3">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="mb-0">Chart of Accounts Directory</h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table coa-table" id="table1">
                            <thead>
                                <tr>
                                    <th>Account No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coas as $coa)
                                    <tr id="coa-item-{{ $coa->id }}">
                                        <td>
                                            <span class="account-number">{{ $coa->coa_no }}</span>
                                        </td>
                                        <td>
                                            <span class="coa-name">{{ Str::limit($coa->name, 30, '...') }}</span>

                                        </td>
                                        <td>
                                            @php
                                                $categoryClass = strtolower($coa->category->category_name);
                                                if (
                                                    in_array($categoryClass, [
                                                        'asset',
                                                        'liability',
                                                        'equity',
                                                        'revenue',
                                                        'expense',
                                                    ])
                                                ) {
                                                    $class = $categoryClass;
                                                } else {
                                                    $class = 'asset';
                                                }
                                            @endphp
                                            <span class="category-badge {{ $class }}">
                                                {{ $coa->category->category_name }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($coa->type)
                                                <span class="type-badge {{ strtolower($coa->type) }}">
                                                    {{ $coa->type }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="currency">
                                                @if ($coa->amount)
                                                    Rp {{ number_format($coa->amount, 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-row gap-2">
                                                <!-- Changed from flex-column to flex-row -->
                                                <a href="{{ url('/edit-coa/' . $coa->id) }}" class="btn-action edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="javascript:void(0);" class="btn-action delete delete-coa"
                                                    data-id="{{ $coa->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
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
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

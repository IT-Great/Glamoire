<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier - Glamoire</title>

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
                            <h2 class="mb-3">Supplier Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="index.html">Supplier</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Supplier</li>
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

                    <!-- Filters Row -->
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
                                            <option value="success"
                                                {{ request('status') == 'success' ? 'selected' : '' }}>
                                                Success</option>
                                            <option value="pending"
                                                {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="failed"
                                                {{ request('status') == 'failed' ? 'selected' : '' }}>
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

                    {{-- tabel supplier --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4><i class="bi bi-receipt-cutoff"></i> Supplier List</h4>
                                </div>
                                <div
                                    class="col-12 col-md-6 d-flex justify-content-md-end align-items-center order-md-2 order-first">
                                    <a href="{{ route('create-invoice') }}" type="button"
                                        class="btn btn-sm btn-info d-flex align-items-center me-2">
                                        <i class="bi bi-file-earmark-excel me-2"></i>Export
                                    </a>
                                    <a href="{{ route('create-supplier') }}" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                        <i class="bi bi-plus-circle me-2"></i>Add Supplier
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>NO TELP</th>
                                        <th>EMAIL</th>
                                        <th>ADDRESS</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td><strong>{{ $supplier->name }}</strong></td>
                                            <td>{{ $supplier->no_telp }}</td>
                                            <td class="amount-cell">{{ $supplier->email }}</td>
                                            <td>{{ $supplier->address }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-info view-supplier"
                                                        data-id="{{ $supplier->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    <a href="{{ route('edit-supplier', ['id' => $supplier->id]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm delete-invoice"
                                                        data-id="{{ $supplier->id }}">
                                                        <i class="fa fa-trash"></i>
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

                <!-- Modal -->
                <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Tambahkan modal-dialog-centered -->
                        <div class="modal-content">
                            <div class="modal-header" style="background: #183018; color: white;">
                                <h5 class="modal-title text-white" id="supplierModalLabel">
                                    <i class="fas fa-building me-2"></i>Supplier Details
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row">
                                    <!-- Left column - Contact Information -->
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-id-card me-2"></i>Contact
                                                    Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">

                                                    <h4 id="supplierName" class="mb-0"></h4>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-phone-alt text-primary me-2"></i>
                                                        <strong>Phone:</strong>
                                                    </div>
                                                    <p id="supplierTelp" class="ms-4 mb-0"></p>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-envelope text-primary me-2"></i>
                                                        <strong>Email:</strong>
                                                    </div>
                                                    <p id="supplierEmail" class="ms-4 mb-0"></p>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                        <strong>Address:</strong>
                                                    </div>
                                                    <div class="ms-4">
                                                        <p id="supplierAddress" class="mb-1"></p>
                                                        <div class="d-flex">
                                                            <span id="supplierCity" class="me-1"></span>,
                                                            <span id="supplierProvince" class="mx-1"></span>
                                                            <span id="supplierPostCode" class="ms-1"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right column - Banking & Additional Info -->
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><i class="fas fa-university me-2"></i>Banking
                                                    Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-university text-primary me-2"></i>
                                                        <strong>Bank Name:</strong>
                                                    </div>
                                                    <p id="supplierBankName" class="ms-4 mb-0"></p>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-credit-card text-primary me-2"></i>
                                                        <strong>Account Number:</strong>
                                                    </div>
                                                    <p id="supplierAccountNumber" class="ms-4 mb-0"></p>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-user text-primary me-2"></i>
                                                        <strong>Account Holder:</strong>
                                                    </div>
                                                    <p id="supplierAccountHolder" class="ms-4 mb-0"></p>
                                                </div>

                                                <div class="mt-4">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                                        <strong>Description:</strong>
                                                    </div>
                                                    <div class="p-3 bg-light rounded ms-4">
                                                        <p id="supplierDescription" class="mb-0 fst-italic"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Close
                                </button>
                                <button type="button" class="btn btn-primary" id="editSupplier">
                                    <i class="fas fa-edit me-1"></i>Edit
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


    {{-- modal views supplier --}}
    <script>
        $(document).ready(function() {
            // Handle view supplier button click
            $(document).on('click', '.view-supplier', function() {
                // Get the supplier ID from data attribute
                const supplierId = $(this).data('id');

                // Show loading state
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send AJAX request to get the supplier details
                $.ajax({
                    url: `/supplier-data/${supplierId}`, // Adjust route as needed
                    type: 'GET',
                    success: function(response) {
                        // Close loading indicator
                        Swal.close();

                        // Get initials for the avatar
                        const nameParts = response.name.split(' ');
                        const initials = nameParts.length > 1 ?
                            nameParts[0].charAt(0) + nameParts[1].charAt(0) :
                            nameParts[0].charAt(0);

                        // Populate modal with supplier details
                        $('#supplierInitials').text(initials.toUpperCase());
                        $('#supplierName').text(response.name);
                        $('#supplierTelp').text(response.no_telp || 'N/A');
                        $('#supplierEmail').text(response.email || 'N/A');
                        $('#supplierAddress').text(response.address || 'N/A');
                        $('#supplierCity').text(response.city || 'N/A');
                        $('#supplierProvince').text(response.province || 'N/A');
                        $('#supplierPostCode').text(response.post_code || 'N/A');
                        $('#supplierAccountNumber').text(response.accountnumber || 'N/A');
                        $('#supplierAccountHolder').text(response.accountnumber_holders_name ||
                            'N/A');
                        $('#supplierBankName').text(response.bank_name || 'N/A');
                        $('#supplierDescription').text(response.description ||
                            'No description available');

                        // Store supplier ID for edit button
                        $('#editSupplier').data('id', supplierId);

                        // Show the modal
                        $('#supplierModal').modal('show');
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Failed to load supplier details', 'error');
                    }
                });
            });

            // Handle edit supplier button click (you can implement this functionality)
            $(document).on('click', '#editSupplier', function() {
                const supplierId = $(this).data('id');
                $('#supplierModal').modal('hide');
                // Redirect to edit page or open edit modal
                // window.location.href = `/suppliers/${supplierId}/edit`;
                // Or trigger another modal
                // $('#editSupplierModal').modal('show');
            });
        });
    </script>

    {{-- modal delete --}}
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
                        $.ajax({
                            url: `/invoice-delete-suppliers/${invoiceId}`, // sesuaikan route jika diperlukan
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message ||
                                        'Invoice berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#4A69E2',
                                    timer: 2000,
                                    timerProgressBar: true
                                }).then(() => {
                                    // Reload halaman setelah sukses
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

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

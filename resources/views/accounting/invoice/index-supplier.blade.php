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

        .stats-card-danger {
            background: linear-gradient(135deg, var(--danger-color), #d91f06);
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
                            <h3 class="mb-1">Supplier</h3>
                            <p class="text-muted mb-2">Halaman ini digunakan untuk mengelola data supplier yang
                                terdaftar dalam sistem.</p>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                                            <i class="bi bi-person-lines-fill me-2"></i>Supplier
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Supplier</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <!-- Stats Row -->
                    <div class="row mb-4 slide-in">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="stats-card stats-card-primary">
                                <div class="stats-icon">
                                    <i class="bi bi-person-lines-fill"></i>
                                </div>
                                <div class="stats-title">Total Supplier</div>
                                <h3 class="stats-number">{{ $totalSupplier }}</h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Jumlah supplier yang terdaftar
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <div class="stats-card stats-card-warning">
                                <div class="stats-icon">
                                    <i class="bi bi-exclamation-circle"></i>
                                </div>
                                <div class="stats-title">Invoice Belum Lunas</div>
                                <h3 class="stats-number">{{ $unpaidInvoiceCount }}</h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Invoice yang belum dibayar
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <div class="stats-card stats-card-success">
                                <div class="stats-icon">
                                    <i class="bi bi-person-dash"></i>
                                </div>
                                <div class="stats-title">Supplier Tanpa Invoice</div>
                                <h3 class="stats-number">{{ $supplierWithoutInvoice }}</h3>
                                <div class="mt-3">
                                    <small class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Supplier yang belum memiliki invoice
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Navigation Tabs -->
                    <div class="finance-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                        <a href="{{ route('index-invoice') }}"
                            class="finance-nav-item {{ Route::currentRouteName() == 'index-invoice' ? 'active' : '' }}">
                            <i class="bi bi-receipt"></i>Daftar Invoice
                        </a>
                        <a href="{{ route('index-supplier') }}"
                            class="finance-nav-item {{ Route::currentRouteName() == 'index-supplier' ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill"></i>Daftar Supplier
                        </a>
                    </div>

                    {{-- tabel supplier --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4 class="d-inline-flex align-items-center">
                                        <i class="bi bi-person-lines-fill fs-4 me-3"></i>Daftar Supplier
                                    </h4>

                                </div>
                                <div
                                    class="col-12 col-md-6 d-flex justify-content-md-end align-items-center order-md-2 order-first">
                                    <a href="{{ route('create-supplier') }}" type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                        <i class="bi bi-plus fs-6 me-1"></i>Add Supplier
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
                                                    <a href="#detailsupplier"
                                                        class="btn btn-sm btn-info view-supplier d-flex align-items-center justify-content-center"
                                                        data-id="{{ $supplier->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    <a href="{{ route('edit-supplier', ['id' => $supplier->id]) }}"
                                                        class="btn btn-sm btn-warning d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button
                                                        class="btn btn-danger btn-sm delete-supplier d-flex align-items-center justify-content-center"
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
                                <h5 class="modal-title text-white d-flex align-items-center" id="supplierModalLabel">
                                    <i class="fas fa-id-card me-2"></i>Supplier Details
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
            $(document).on('click', '.delete-supplier', function(e) {
                e.preventDefault();

                const invoiceId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data supplier akan dihapus secara permanen!",
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
                                        'Supplier berhasil dihapus.',
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

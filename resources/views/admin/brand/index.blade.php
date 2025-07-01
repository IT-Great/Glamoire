<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/brand/createbrand.css">

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

        .brand-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .brand-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.1);
        }

        .brand-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .brand-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .modal-body {
            padding: 1.5rem;
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
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3>Brand</h3>
                            <p>Kelola semua data produk yang tersedia pada halaman ini.</p>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-12 col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                        class="d-flex align-items-center"><i
                                            class="bi bi-award-fill me-1"></i>Brand</a></li>
                                <li class="breadcrumb-item active">Semua Brand</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="row mb-4 slide-in">
                <!-- Total Brands -->
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <div class="stats-card stats-card-primary">
                        <div class="stats-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div class="stats-title">Total Brand</div>
                        <h3 class="stats-number">{{ $brands->total() }}</h3>

                        <div class="mt-3">
                            <small class="d-flex align-items-center text-white">
                                <i class="bi bi-building me-1"></i>
                                {{ $brands->count() }} brand terdaftar aktif bulan ini
                            </small>

                        </div>
                    </div>
                </div>

                <!-- Brand Aktif -->
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <div class="stats-card stats-card-warning">
                        <div class="stats-icon">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                        <div class="stats-title">Brand Aktif</div>
                        <h3 class="stats-number">{{ $brands->count() }}</h3>

                        <div class="mt-3">
                            <small class="d-flex align-items-center text-white">
                                <i class="bi bi-broadcast-pin me-1"></i>
                                {{ $brands->count() }} brand sedang aktif
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Total Produk -->
                <div class="col-12 col-md-4">
                    <div class="stats-card stats-card-success">
                        <div class="stats-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="stats-title">Total Produk</div>
                        <h3 class="stats-number">{{ $brands->sum('products_count') }}</h3>

                        <div class="mt-3">
                            <small class="d-flex align-items-center text-white">
                                <i class="bi bi-bag-check-fill me-1"></i>
                                {{ $brands->sum('products_count') }} produk dari semua brand
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brands Table Section -->
            <div class="card brand-card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h4 class="mb-0 d-flex align-items-center"><i class="bi bi-award-fill me-2"></i>Brand
                                Directory</h4>
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                            <a href="{{ route('create-brand-admin') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> Buat Brand
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>Brand Details</th>
                                <th>Total Products</th>
                                <th>Brand Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr id="brand-item-{{ $brand->id }}">
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ Storage::url($brand->brand_logo) }}"
                                                alt="{{ $brand->name }}" class="brand-logo lazyload"
                                                onclick="openImageInNewTab('{{ Storage::url($brand->brand_logo) }}')">

                                            <div class="brand-details">
                                                <span
                                                    class="brand-name">{{ Str::limit($brand->name, 20, '...') }}</span>
                                                <span class="brand-meta">Code: {{ $brand->brand_code }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-success">{{ $brand->products_count }}</span>
                                    </td>
                                    <td>{{ $brand->brand_code }}</td>
                                    <td>
                                        <a href="{{ route('detail-brand-admin', $brand->id) }}"
                                            class="btn btn-sm btn-warning d-inline-flex align-items-center">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>

                                        <a href="#"
                                            class="btn btn-sm btn-info view-brand d-inline-flex align-items-center"
                                            data-id="{{ $brand->id }}">
                                            <i class="bi bi-eye me-1"></i> View
                                        </a>

                                        <a href="javascript:void(0);"
                                            class="btn btn-sm btn-danger delete-brand d-inline-flex align-items-center"
                                            data-id="{{ $brand->id }}">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #183018; color: white;">
                                <h5 class="modal-title text-white" id="brandModalLabel">
                                    <i class="bi bi-tag me-2"></i>Brand Detail
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4" style="background-color: #f3f4f6;">
                                <!-- Main Card -->
                                <div class="card bg-light mb-4">
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <!-- Brand Code Section -->
                                            <div class="col-md-8">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-container me-3">
                                                        <i class="bi bi-tag-fill fs-1 text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-secondary">Brand Code</div>
                                                        <h2 id="modalBrandCode" class="mb-0 fw-bold">-</h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Brand Logo Section -->
                                            <div class="col-md-4 text-end">
                                                <div class="d-flex flex-column align-items-end">
                                                    <div class="text-secondary mb-2">Brand Logo</div>
                                                    <a href="#" id="modalBrandLogoLink" target="_blank">
                                                        <div class="brand-logo-container bg-white rounded p-2"
                                                            style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                                            <img id="modalBrandLogo" src="" alt="Brand Logo"
                                                                style="max-width: 90px; max-height: 90px; object-fit: contain;">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Left Column - Brand Name -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-fonts me-2 text-secondary"></i>
                                                    <div class="text-secondary">Brand Name</div>
                                                </div>
                                                <h3 id="modalBrandName" class="mb-0 fw-bold">-</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Brand Details -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-info-circle me-2 text-secondary"></i>
                                                    <div class="text-secondary">Brand Details</div>
                                                </div>
                                                <div class="py-2">
                                                    <div class="row mb-3">
                                                        <div class="col-5 text-secondary">Created Date</div>
                                                        <div id="modalCreatedDate" class="col-7 fw-medium">-</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5 text-secondary">Updated Date</div>
                                                        <div id="modalUpdatedDate" class="col-7 fw-medium">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Brand Description -->
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-card-text me-2 text-secondary"></i>
                                            <div class="text-secondary">Brand Description</div>
                                        </div>
                                        <p id="modalDescription" class="mb-0">-</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary d-flex align-items-center"
                                    data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i>Close
                                </button>

                                <a id="editBrand" href="{{ route('detail-brand-admin', $brand->id) }}"
                                    class="btn btn-sm btn-warning d-flex align-items-center">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
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
                timer: 1800,
                timerProgressBar: true
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Simple DataTable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);

            // Use event delegation for delete button
            table1.addEventListener('click', function(event) {
                if (event.target.closest('.delete-brand')) {
                    let brandId = event.target.closest('.delete-brand').getAttribute('data-id');

                    // SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send AJAX request to delete brand
                            fetch(`/delete-brand/${brandId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Remove the brand from the page
                                        document.querySelector(`#brand-item-${brandId}`)
                                            .remove();
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            icon: 'success',
                                            timer: 1800,
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 1800,
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                }
            });
        });

        // View brand details
        $(document).on('click', '.view-brand', function(e) {
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
                url: `/brands/${id}`,
                method: 'GET',
                success: function(response) {
                    // Close loading indicator
                    Swal.close();

                    // Populate modal with brand data
                    $('#modalBrandCode').text(response.brand_code || '-');
                    $('#modalBrandName').text(response.name || '-');
                    $('#modalDescription').text(response.description || '-');

                    // Set brand logo if available
                    if (response.brand_logo) {
                        $('#modalBrandLogo').attr('src', response.brand_logo).show();
                        $('#modalBrandLogoLink').attr('href', response.brand_logo);
                        $('.brand-logo-container').css('background-color', '#fff');
                    } else {
                        $('#modalBrandLogo').attr('src', '/placeholder-image.png').show();
                        $('#modalBrandLogoLink').attr('href', '/placeholder-image.png');
                        $('.brand-logo-container').css('background-color', '#f8f9fa');
                    }

                    // Format created date
                    if (response.created_at) {
                        const createdDate = new Date(response.created_at);
                        const formattedCreatedDate = createdDate.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#modalCreatedDate').text(formattedCreatedDate);
                    } else {
                        $('#modalCreatedDate').text('-');
                    }

                    // Format updated date
                    if (response.updated_at) {
                        const updatedDate = new Date(response.updated_at);
                        const formattedUpdatedDate = updatedDate.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#modalUpdatedDate').text(formattedUpdatedDate);
                    } else {
                        $('#modalUpdatedDate').text('-');
                    }

                    // Set edit link
                    $('#editBrand').attr('href', `/edit-brand/${id}`);

                    // Show the modal
                    $('#brandModal').modal('show');
                },
                error: function() {
                    Swal.fire('Error', 'Failed to load brand data.', 'error');
                }
            });
        });

        // Handle print brand button click
        $(document).on('click', '#printBrand', function() {
            const printContent = $('.modal-body').html();
            const originalContent = $('body').html();

            // Create a print window
            $('body').html(`
            <div style="padding: 20px;">
                <h2 style="text-align: center; margin-bottom: 20px;">Brand Details</h2>
                ${printContent}
            </div>
        `);

            // Print
            window.print();

            // Restore original content
            $('body').html(originalContent);

            // Re-initialize Bootstrap elements
            $('#brandModal').modal('show');
        });
    </script>

</body>

</html>

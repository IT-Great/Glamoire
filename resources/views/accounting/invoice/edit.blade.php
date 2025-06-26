<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

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

        /* Styling container Select2 */
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        /* Styling rendered text */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px;
            padding-right: 30px;
        }

        /* Styling arrow position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 6px;
        }

        /* Tambahkan styling untuk dropdown options */
        .select-lg-dropdown .select2-results__option {
            padding: 6px 12px;
        }

        <style>.form-group {
            margin-bottom: 1.5rem;
        }

        .upload-zone {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .upload-zone:hover {
            border-color: #6c757d;
            background-color: #e9ecef;
        }

        .upload-zone.drag-over {
            border-color: #007bff;
            background-color: #e7f3ff;
        }

        .upload-zone.error {
            border-color: #dc3545;
            background-color: #f8d7da;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .upload-prompt {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .upload-hint {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .progress-container {
            width: 100%;
            height: 4px;
            background-color: #e9ecef;
            border-radius: 2px;
            margin-top: 1rem;
            display: none;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #007bff;
            border-radius: 2px;
            transition: width 0.3s ease;
            width: 0%;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            min-height: 1.2rem;
        }

        .upload-preview {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            background-color: #ffffff;
        }

        .preview-header {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #495057;
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .preview-image-container {
            flex-shrink: 0;
        }

        .preview-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }

        .preview-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #dc3545;
        }

        .preview-details {
            flex-grow: 1;
        }

        .preview-filename {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }

        .preview-meta {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .remove-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .remove-button:hover {
            background-color: #fecaca;
        }

        .current-document {
            margin-bottom: 1.5rem;
        }

        .current-document .d-flex {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .current-document img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .current-document .fw-bold {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }

        .required {
            color: #dc3545;
        }
    </style>

</head>

<body>  
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">

                <div class="page-title mb-2">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3 class="mb-3">Update Invoice</h3>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                            class="d-flex align-items-center"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('index-invoice') }}"
                                            class="d-flex align-items-center"><i
                                                class="bi bi-credit-card me-2"></i>Invoice</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Invoice</li>
                                </ol>
                            </nav>
                            <p class="text-subtitle text-muted mt-2">
                                Edit data invoice dan lihat riwayat pembayaran secara lengkap.
                            </p>

                        </div>
                    </div>
                </div>
            </div>


            {{-- bagian invoice --}}
            <section id="multiple-column-form" class="section">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">

                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <div>
                                            <h4 class="d-flex align-items-center">
                                                <i class="bi bi-pencil-square me-2"></i>
                                                Update Invoice
                                            </h4>
                                            <p class="text-muted">Gunakan formulir di bawah ini untuk memperbarui
                                                data invoice yang sudah ada.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('update-invoice') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="invoice-number" class="form-label">No. Invoice
                                                            <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('no_invoice') ? 'is-invalid' : '' }}"
                                                                placeholder="Enter Invoice Number" id="invoice-number"
                                                                name="no_invoice" value="{{ $invoice->no_invoice }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-receipt"></i>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('no_invoice'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('no_invoice') }}</p>
                                                        @endif
                                                        <small class="text-muted">Enter a unique invoice number
                                                            (e.g. INV-2025-001)</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="debit-account" class="form-label">Debit Account
                                                            <span class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control select2-basic-category {{ $errors->has('debit_coa_id') ? 'is-invalid' : '' }}"
                                                            name="debit_coa_id" style="margin-bottom: 10px;">
                                                            <option value="" disabled>Pilih Debit Account
                                                            </option>
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}"
                                                                    {{ $invoice->debit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('debit_coa_id'))
                                                            <p style="color: red">
                                                                {{ $errors->first('debit_coa_id') }}</p>
                                                        @else
                                                            <small class="text-muted">Select the account to be
                                                                debited</small>
                                                        @endif
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="amount" class="form-label">Amount <span
                                                                class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                                                placeholder="Enter Amount" id="amount"
                                                                name="amount" value="{{ $invoice->amount }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-cash"></i>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('amount'))
                                                            <p style="color: red">
                                                                {{ $errors->first('amount') }}</p>
                                                        @else
                                                            <small class="text-muted">Enter the invoice amount in
                                                                IDR</small>
                                                        @endif
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="pph-percentage" class="form-label">PPH
                                                            Percentage </label>
                                                        <div class="position-relative">
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('pph_percentage') ? 'is-invalid' : '' }}"
                                                                placeholder="Enter PPH Percentage" id="pph-percentage"
                                                                name="pph_percentage"
                                                                value="{{ $invoice->pph_percentage ?? '' }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-percent"></i>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('pph_percentage'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('pph_percentage') }}</p>
                                                        @endif
                                                        <small class="text-muted">Enter the PPH percentage (e.g. 10
                                                            for 10%)</small>
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="due-date" class="form-label">Due Date</label>
                                                        <div class="position-relative">
                                                            <input type="date"
                                                                class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}"
                                                                id="due-date" name="due_date"
                                                                value="{{ $invoice->due_date ?? '' }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-calendar"></i>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('due_date'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('due_date') }}
                                                            </p>
                                                        @endif
                                                        <small class="text-muted">Select the invoice due
                                                            date</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="description" class="form-label">Description
                                                        </label>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" placeholder="Enter description" id="description" name="description" rows="4"
                                                                style="height: 100px">{{ $invoice->description ?? '' }}</textarea>
                                                            <label for="description">Description</label>
                                                        </div>
                                                        <small class="text-muted">Enter details about this
                                                            invoice</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="supplier-name" class="form-label">Supplier
                                                            Name <span class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control select2-basic-category {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"
                                                            name="supplier_id" style="margin-bottom: 10px;">
                                                            <option value="" disabled>Pilih Supplier Name
                                                            </option>
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}"
                                                                    {{ $invoice->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                                    {{ $supplier->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('supplier_id'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('supplier_id') }}</p>
                                                        @endif
                                                        <small class="text-muted">Select the supplier for this
                                                            invoice</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="kredit-account" class="form-label">Kredit
                                                            Account <span class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control select2-basic-category {{ $errors->has('kredit_coa_id') ? 'is-invalid' : '' }}"
                                                            name="kredit_coa_id" style="margin-bottom: 10px;">
                                                            <option value="" disabled>Pilih Kredit Account
                                                            </option>
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}"
                                                                    {{ $invoice->kredit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('kredit_coa_id'))
                                                            <p style="color: red">
                                                                {{ $errors->first('kredit_coa_id') }}</p>
                                                        @else
                                                            <small class="text-muted">Select the account to be
                                                                credited</small>
                                                        @endif
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="pph" class="form-label">PPH </label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="PPH Amount (calculated)" id="pph"
                                                                name="pph_amount"
                                                                value="{{ $invoice->pph_amount ?? '' }}" readonly>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-calculator"></i>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Calculated PPH amount based on
                                                            percentage</small>
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="invoice-date" class="form-label">Invoice Date
                                                        </label>
                                                        <div class="position-relative">
                                                            <input type="date"
                                                                class="form-control {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}"
                                                                id="invoice-date" name="invoice_date"
                                                                value="{{ $invoice->invoice_date ?? '' }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-calendar-check"></i>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('invoice_date'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('invoice_date') }}
                                                            </p>
                                                        @endif
                                                        <small class="text-muted">Enter the invoice issue
                                                            date</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <!-- Upload Title -->
                                                        <label class="mb-3">Unggah Dokumen Invoice <span
                                                                style="color: red;">*</span></label>

                                                        <!-- Current Invoice Document (if exists) -->
                                                        @if ($invoice->image_invoice)
                                                            <div class="mb-4">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <a href="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('storage/' . $invoice->image_invoice) }}"
                                                                            alt="Invoice Document"
                                                                            class="rounded shadow-sm"
                                                                            style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                    </a>
                                                                    <div>
                                                                        <p class="mb-1 fw-bold">
                                                                            {{ basename($invoice->image_invoice) }}</p>
                                                                        <small class="text-muted">Dokumen Invoice yang
                                                                            telah diunggah saat ini</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Upload Zone -->
                                                        <div class="upload-zone" id="upload-zone">
                                                            <input type="file" name="image_invoice"
                                                                id="file-input-invoice" class="file-input"
                                                                accept="image/*, application/pdf"
                                                                onchange="handleFileSelect(this)">
                                                            <div class="upload-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="48"
                                                                    height="48" fill="currentColor"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                                    <path
                                                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                                                </svg>
                                                            </div>
                                                            <div class="upload-prompt">Klik untuk memilih file atau
                                                                seret file ke sini</div>
                                                            <div class="upload-hint">Format diterima: JPG, PNG, PDF
                                                                &mdash; Maks. 5MB</div>
                                                            <div class="progress-container"
                                                                id="upload-progress-container">
                                                                <div class="progress-bar" id="upload-progress-bar">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="error-message" id="upload-error">
                                                            @if ($errors->has('image_invoice'))
                                                                {{ $errors->first('image_invoice') }}
                                                            @endif
                                                        </div>

                                                        <!-- Preview of New Upload -->
                                                        <div class="upload-preview" id="upload-preview"
                                                            style="display: none;">
                                                            <div class="preview-header">Preview Dokumen Invoice Baru
                                                            </div>
                                                            <div class="preview-content">
                                                                <div class="preview-image-container">
                                                                    <img class="preview-image" id="preview-image"
                                                                        src="" alt="Preview">
                                                                    <div class="preview-icon" id="preview-icon"
                                                                        style="display: none;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="32" height="32"
                                                                            fill="currentColor" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                            <path
                                                                                d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                                <div class="preview-details">
                                                                    <div class="preview-filename"
                                                                        id="preview-filename">filename.jpg</div>
                                                                    <div class="preview-meta">Dokumen Invoice yang akan
                                                                        diunggah</div>
                                                                </div>
                                                                <button type="button" class="remove-button"
                                                                    onclick="removeUpload()">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                        <path
                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <a href="{{ route('index-invoice') }}" type="button"
                                                        class="btn btn-sm btn-light-secondary me-2 d-flex align-items-center">
                                                        <i class="bi bi-arrow-left-circle me-1"></i>
                                                        Kembali
                                                    </a>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary d-flex align-items-center">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Update Invoice
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            {{-- bagian payment - hanya tampil jika data payment ada --}}
            @if ($payment)
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">

                                    <div class="card-header bg-white">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div>
                                                <h4 class="d-flex align-items-center">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Update Payment Invoice
                                                </h4>
                                                <p class="text-muted">Gunakan formulir di bawah ini untuk memperbarui
                                                    data payment invoice yang sudah ada.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('update-invoice') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                            <input type="hidden" name="is_payment_update" value="1">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="payment_date" class="form-label">Tanggal
                                                            Pembayaran <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <input type="date"
                                                                class="form-control {{ $errors->has('payment_date') ? 'is-invalid' : '' }}"
                                                                id="payment_date" name="payment_date"
                                                                value="{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '' }}"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Tanggal pembayaran wajib diisi
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Tanggal ketika pembayaran
                                                            dilakukan</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="payment_method" class="form-label">Metode
                                                            Pembayaran <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <select
                                                                class="form-select {{ $errors->has('payment_method') ? 'is-invalid' : '' }}"
                                                                id="payment_method" name="payment_method" required>
                                                                <option value="" disabled
                                                                    {{ old('payment_method', $payment->payment_method) ? '' : 'selected' }}>
                                                                    Pilih Metode Pembayaran
                                                                </option>
                                                                <option value="Cash"
                                                                    {{ old('payment_method', $payment->payment_method) == 'Cash' ? 'selected' : '' }}>
                                                                    Tunai
                                                                </option>
                                                                <option value="Bank"
                                                                    {{ old('payment_method', $payment->payment_method) == 'Bank' ? 'selected' : '' }}>
                                                                    Transfer Bank
                                                                </option>
                                                                <option value="Debit"
                                                                    {{ old('payment_method', $payment->payment_method) == 'Debit' ? 'selected' : '' }}>
                                                                    Kartu Debit
                                                                </option>
                                                                <option value="Credit"
                                                                    {{ old('payment_method', $payment->payment_method) == 'Credit' ? 'selected' : '' }}>
                                                                    Kartu Kredit
                                                                </option>
                                                            </select>

                                                            <div class="invalid-feedback">
                                                                Metode pembayaran wajib dipilih
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Metode yang digunakan untuk
                                                            pembayaran</small>
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="reference_number" class="form-label">Nomor
                                                            Referensi Transaksi</label>
                                                        <div class="position-relative">
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('reference_number') ? 'is-invalid' : '' }}"
                                                                id="reference_number" name="reference_number"
                                                                placeholder="Nomor referensi transfer, nomor cek, dll."
                                                                value="{{ $payment->reference_number ?? '' }}">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-hash"></i>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Nomor referensi untuk
                                                            pelacakan
                                                            pembayaran</small>
                                                    </div>

                                                    <div class="form-group has-icon-left mb-4">
                                                        <label for="amount" class="form-label">Jumlah
                                                            Pembayaran
                                                            <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <input type="number"
                                                                class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                                                id="amount" name="amount"
                                                                value="{{ $payment->amount ?? '' }}" required>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-cash"></i>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Jumlah pembayaran wajib diisi
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Masukkan jumlah yang
                                                            dibayarkan</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label for="debit_coa_id" class="form-label">Akun
                                                            Debit
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select
                                                            class="form-control select2-basic-category {{ $errors->has('debit_coa_id') ? 'is-invalid' : '' }}"
                                                            name="debit_coa_id" style="margin-bottom: 10px;">
                                                            <option value="" disabled>Pilih Debit Account
                                                            </option>
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}"
                                                                    {{ $invoice->debit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Akun debit wajib dipilih
                                                        </div>
                                                        <small class="text-muted">Pilih akun yang akan
                                                            didebit</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="kredit_coa_id" class="form-label">Akun
                                                            Kredit
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select
                                                            class="form-control select2-basic-category {{ $errors->has('kredit_coa_id') ? 'is-invalid' : '' }}"
                                                            name="kredit_coa_id" style="margin-bottom: 10px;">
                                                            <option value="" disabled>Pilih Kredit
                                                                Account
                                                            </option>
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}"
                                                                    {{ $invoice->kredit_coa_id == $coa->id ? 'selected' : '' }}>
                                                                    {{ $coa->coa_no }} - {{ $coa->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Akun kredit wajib dipilih
                                                        </div>
                                                        <small class="text-muted">Pilih akun yang akan
                                                            dikredit</small>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="payment_notes" class="form-label">Catatan</label>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" id="payment_notes" name="payment_notes" rows="3"
                                                                placeholder="Informasi tambahan tentang pembayaran" style="height: 100px">{{ old('notes', $payment->notes ?? '') }}</textarea>

                                                            <label for="payment_notes">Catatan Tambahan</label>
                                                        </div>
                                                        <small class="text-muted">Informasi tambahan tentang
                                                            pembayaran ini</small>
                                                    </div>

                                                    <!-- Bukti Pembayaran -->
                                                    <div class="mb-4">
                                                        <div class="form-group mb-4">
                                                            <!-- Upload Title -->
                                                            <label class="mb-3">Unggah Dokumen Bukti Pembayaran
                                                                <span style="color: red;">*</span></label>

                                                            <!-- Current Payment Proof Document (if exists) -->
                                                            @if ($invoice->image_proof)
                                                                <div class="mb-4">
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        @if (Str::endsWith($invoice->image_proof, ['.jpg', '.jpeg', '.png']))
                                                                            <a href="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                                target="_blank">
                                                                                <img src="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                                    alt="Bukti Pembayaran"
                                                                                    class="rounded shadow-sm"
                                                                                    style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ asset('storage/' . $invoice->image_proof) }}"
                                                                                target="_blank"
                                                                                class="btn btn-info">Lihat Dokumen
                                                                                PDF</a>
                                                                        @endif
                                                                        <div>
                                                                            <p class="mb-1 fw-bold">
                                                                                {{ basename($invoice->image_proof) }}
                                                                            </p>
                                                                            <small class="text-muted">Dokumen Bukti
                                                                                Pembayaran yang telah diunggah saat
                                                                                ini</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <!-- Upload Zone -->
                                                            <div class="upload-zone" id="upload-zone-proof">
                                                                <input type="file" name="image_proof"
                                                                    id="file-input-proof" class="file-input"
                                                                    accept="image/*, application/pdf"
                                                                    onchange="handleFileSelectProof(this)">
                                                                <div class="upload-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="48" height="48"
                                                                        fill="currentColor" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                                        <path
                                                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                                                    </svg>
                                                                </div>
                                                                <div class="upload-prompt">Klik untuk memilih file
                                                                    atau seret file ke sini</div>
                                                                <div class="upload-hint">Format diterima: JPG, PNG,
                                                                    PDF &mdash; Maks. 5MB</div>
                                                                <div class="progress-container"
                                                                    id="upload-progress-container-proof">
                                                                    <div class="progress-bar"
                                                                        id="upload-progress-bar-proof"></div>
                                                                </div>
                                                            </div>
                                                            <div class="error-message" id="upload-error-proof">
                                                                @if ($errors->has('image_proof'))
                                                                    {{ $errors->first('image_proof') }}
                                                                @endif
                                                            </div>

                                                            <!-- Preview of New Upload -->
                                                            <div class="upload-preview" id="upload-preview-proof"
                                                                style="display: none;">
                                                                <div class="preview-header">Preview Dokumen Bukti
                                                                    Pembayaran Baru</div>
                                                                <div class="preview-content">
                                                                    <div class="preview-image-container">
                                                                        <img class="preview-image"
                                                                            id="preview-image-proof" src=""
                                                                            alt="Preview">
                                                                        <div class="preview-icon"
                                                                            id="preview-icon-proof"
                                                                            style="display: none;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="32" height="32"
                                                                                fill="currentColor"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                                <path
                                                                                    d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                    <div class="preview-details">
                                                                        <div class="preview-filename"
                                                                            id="preview-filename-proof">
                                                                            filename.jpg</div>
                                                                        <div class="preview-meta">Dokumen Bukti
                                                                            Pembayaran yang akan diunggah</div>
                                                                    </div>
                                                                    <button type="button" class="remove-button"
                                                                        onclick="removeUploadProof()">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                            <path
                                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end mt-3">
                                                <a href="{{ route('index-invoice') }}" type="button"
                                                    class="btn btn-sm btn-light-secondary me-2 d-flex align-items-center">
                                                    <i class="bi bi-arrow-left-circle me-1"></i>
                                                    Kembali
                                                </a>
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Update Payment
                                                </button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                {{-- Section alternatif jika payment tidak ada --}}
                <section id="no-payment-section" class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="py-5">
                                        <i class="bi bi-credit-card-2-back"
                                            style="font-size: 4rem; color: #6c757d;"></i>
                                        <h4 class="mt-3 mb-2">Belum Ada Data Pembayaran</h4>
                                        <p class="text-muted mb-4">Invoice ini belum memiliki data pembayaran.
                                            Silakan buat pembayaran terlebih dahulu.</p>
                                        <a href="{{ route('view-process-payment', $invoice->id) }}" type="button"
                                            class="btn btn-sm btn-primary d-inline-flex align-items-center">
                                            <i class="bi bi-plus fs-6 me-1"></i> Buat Pembayaran
                                        </a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                width: '100%',
                // Gunakan templateResult untuk mengontrol tampilan dropdown items
                templateResult: formatState,
                // Gunakan templateSelection untuk mengontrol selected item
                templateSelection: formatState,
                dropdownCssClass: 'select-lg-dropdown'
            });

            // Fungsi untuk format tampilan item
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                // Buat container dengan style yang mencegah overflow
                var $state = $(
                    '<span style="white-space: normal; word-break: break-word; display: block;">' + state.text +
                    '</span>'
                );

                return $state;
            }
        });
    </script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    {{-- modal pesan error --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            @if ($errors->any())
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: 'Error: {{ $errors->first() }}',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            @endif
        });
    </script>

    {{-- upload file gambar invoice --}}
    <script>
        // Handle file selection
        function handleFileSelect(input) {
            const file = input.files[0];
            if (!file) return;

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            // Reset error
            document.getElementById('upload-error').textContent = '';
            document.getElementById('upload-zone').classList.remove('error');

            // Check file type
            if (!validTypes.includes(file.type)) {
                document.getElementById('upload-error').textContent = 'File harus berformat JPG, PNG, atau PDF.';
                document.getElementById('upload-zone').classList.add('error');
                input.value = '';
                return;
            }

            // Check file size
            if (file.size > maxSize) {
                document.getElementById('upload-error').textContent = 'Ukuran file tidak boleh melebihi 5MB.';
                document.getElementById('upload-zone').classList.add('error');
                input.value = '';
                return;
            }

            // Show progress first
            simulateUploadProgress();

            // Show preview after progress is complete
            setTimeout(() => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('upload-preview');
                    const previewImage = document.getElementById('preview-image');
                    const previewIcon = document.getElementById('preview-icon');
                    const previewFilename = document.getElementById('preview-filename');

                    previewContainer.style.display = 'block';
                    previewFilename.textContent = file.name;

                    if (file.type === 'application/pdf') {
                        previewImage.style.display = 'none';
                        previewIcon.style.display = 'flex';
                    } else {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        previewIcon.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }, 1100); // Show preview after progress completes
        }

        // Remove upload
        function removeUpload() {
            document.getElementById('file-input-invoice').value = '';
            document.getElementById('upload-preview').style.display = 'none';
            document.getElementById('upload-progress-container').style.display = 'none';
            document.getElementById('upload-progress-bar').style.width = '0%';
            document.getElementById('upload-error').textContent = '';
            document.getElementById('upload-zone').classList.remove('error');
        }

        // Simulate upload progress
        function simulateUploadProgress() {
            const progressContainer = document.getElementById('upload-progress-container');
            const progressBar = document.getElementById('upload-progress-bar');

            progressContainer.style.display = 'block';
            progressBar.style.width = '0%';

            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15 + 5; // Random progress between 5-20%
                if (progress > 100) progress = 100;

                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        progressContainer.style.display = 'none';
                        progressBar.style.width = '0%';
                    }, 500);
                }
            }, 100);
        }

        // Drag and drop handling
        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('upload-zone');
            const fileInput = document.getElementById('file-input-invoice');

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');

                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    handleFileSelect(fileInput);
                }
            });

            // Click to upload
            dropZone.addEventListener('click', (e) => {
                if (e.target === fileInput) return;
                fileInput.click();
            });
        });
    </script>

    {{-- upload file gambar payment --}}
    <script>
        // Handle file selection for payment proof
        function handleFileSelectProof(input) {
            const file = input.files[0];
            if (!file) return;

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            // Reset error
            document.getElementById('upload-error-proof').textContent = '';
            document.getElementById('upload-zone-proof').classList.remove('error');

            // Check file type
            if (!validTypes.includes(file.type)) {
                document.getElementById('upload-error-proof').textContent = 'File harus berformat JPG, PNG, atau PDF.';
                document.getElementById('upload-zone-proof').classList.add('error');
                input.value = '';
                return;
            }

            // Check file size
            if (file.size > maxSize) {
                document.getElementById('upload-error-proof').textContent = 'Ukuran file tidak boleh melebihi 5MB.';
                document.getElementById('upload-zone-proof').classList.add('error');
                input.value = '';
                return;
            }

            // Show progress first
            simulateUploadProgressProof();

            // Show preview after progress is complete
            setTimeout(() => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('upload-preview-proof');
                    const previewImage = document.getElementById('preview-image-proof');
                    const previewIcon = document.getElementById('preview-icon-proof');
                    const previewFilename = document.getElementById('preview-filename-proof');

                    previewContainer.style.display = 'block';
                    previewFilename.textContent = file.name;

                    if (file.type === 'application/pdf') {
                        previewImage.style.display = 'none';
                        previewIcon.style.display = 'flex';
                    } else {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        previewIcon.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }, 1100); // Show preview after progress completes
        }

        // Remove upload for payment proof
        function removeUploadProof() {
            document.getElementById('file-input-proof').value = '';
            document.getElementById('upload-preview-proof').style.display = 'none';
            document.getElementById('upload-progress-container-proof').style.display = 'none';
            document.getElementById('upload-progress-bar-proof').style.width = '0%';
            document.getElementById('upload-error-proof').textContent = '';
            document.getElementById('upload-zone-proof').classList.remove('error');
        }

        // Simulate upload progress for payment proof
        function simulateUploadProgressProof() {
            const progressContainer = document.getElementById('upload-progress-container-proof');
            const progressBar = document.getElementById('upload-progress-bar-proof');

            progressContainer.style.display = 'block';
            progressBar.style.width = '0%';

            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15 + 5; // Random progress between 5-20%
                if (progress > 100) progress = 100;

                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        progressContainer.style.display = 'none';
                        progressBar.style.width = '0%';
                    }, 500);
                }
            }, 100);
        }

        // Drag and drop handling for payment proof
        document.addEventListener('DOMContentLoaded', function() {
            const dropZoneProof = document.getElementById('upload-zone-proof');
            const fileInputProof = document.getElementById('file-input-proof');

            if (dropZoneProof && fileInputProof) {
                dropZoneProof.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropZoneProof.classList.add('drag-over');
                });

                dropZoneProof.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    dropZoneProof.classList.remove('drag-over');
                });

                dropZoneProof.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropZoneProof.classList.remove('drag-over');

                    if (e.dataTransfer.files.length) {
                        fileInputProof.files = e.dataTransfer.files;
                        handleFileSelectProof(fileInputProof);
                    }
                });

                // Click to upload
                dropZoneProof.addEventListener('click', (e) => {
                    if (e.target === fileInputProof) return;
                    fileInputProof.click();
                });
            }
        });
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

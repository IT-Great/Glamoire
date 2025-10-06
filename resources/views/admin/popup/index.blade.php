<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop Up - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

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

        /* Upload Zone Styles */
        .upload-container {
            margin-bottom: 20px;
        }

        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            position: relative;
        }

        .upload-zone:hover {
            border-color: #3b82f6;
            background-color: #f0f9ff;
        }

        .upload-zone.drag-over {
            border-color: #3b82f6;
            background-color: #dbeafe;
        }

        .upload-zone.error {
            border-color: #ef4444;
            background-color: #fef2f2;
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
            color: #64748b;
            margin-bottom: 16px;
        }

        .upload-prompt {
            font-size: 16px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 8px;
        }

        .upload-hint {
            font-size: 14px;
            color: #64748b;
        }

        .progress-container {
            margin-top: 20px;
            background-color: #e2e8f0;
            border-radius: 4px;
            height: 4px;
            overflow: hidden;
            display: none;
        }

        .progress-bar {
            height: 100%;
            background-color: #3b82f6;
            transition: width 0.3s ease;
            width: 0%;
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 8px;
            display: block;
        }

        /* Preview Styles */
        .upload-preview {
            margin-top: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .preview-header {
            background-color: #f8fafc;
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 500;
            font-size: 14px;
            color: #475569;
        }

        .preview-content {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
        }

        .preview-image-container {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 6px;
            overflow: hidden;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-icon {
            color: #64748b;
        }

        .preview-details {
            flex-grow: 1;
            min-width: 0;
        }

        .preview-filename {
            font-weight: 500;
            color: #334155;
            font-size: 14px;
            margin-bottom: 4px;
            word-break: break-word;
        }

        .preview-meta {
            color: #64748b;
            font-size: 12px;
        }

        .remove-button {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .remove-button:hover {
            background: #dc2626;
        }

        /* Current Image Display */
        .current-image-container {
            margin-bottom: 20px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
        }

        .current-image-container img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 6px;
        }

        /* Modal Adjustments */
        .modal-dialog {
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        .text-danger {
            color: #ef4444 !important;
        }

        .text-muted {
            color: #64748b !important;
        }

        #popupMedia {
            width: 100%;
            max-width: 400px;
            /* atur lebar maksimum */
            height: 250px;
            /* tinggi tetap seperti preview upload */
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0 auto;
            /* biar posisi center */
            background: #f8f9fa;
        }

        #popupMedia img,
        #popupMedia video {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* biar gambar/video tidak ketarik */
            border-radius: 8px;
        }

        .preview-media-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            width: 100%;
            height: 250px;
            /* tinggi tetap sama dengan container upload */
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
        }

        .preview-media-container img,
        .preview-media-container video {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            /* menjaga aspek rasio */
            border-radius: 6px;
        }

        /* Untuk preview image (bukan di container) */
        .preview-image-container {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 6px;
            overflow: hidden;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Update preview content agar lebih rapi */
        .preview-content {
            padding: 16px;
            display: flex;
            flex-direction: column;
            /* ubah jadi column */
            gap: 12px;
            position: relative;
        }

        .preview-details {
            width: 100%;
            text-align: center;
            /* center align text */
        }

        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .modal-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1.5rem 2rem;
        }

        .modal-header .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
            color: #1f2937;
        }

        .modal-header .btn-close {
            opacity: 0.5;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 2rem;
            background-color: #ffffff;
        }

        /* Simple Info Row */
        .info-row {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .info-content {
            font-size: 0.95rem;
            color: #1f2937;
            line-height: 1.6;
        }

        /* Media Container Simple */
        .media-container {
            background: #f9fafb;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 250px;
            max-height: 400px;
        }

        .media-container img,
        .media-container video {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 6px;
        }

        /* Simple Badge */
        .simple-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .simple-badge.active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .simple-badge.inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .simple-badge.display {
            background-color: #dbeafe;
            color: #1e40af;
        }

        /* Modal Footer */
        .modal-footer {
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            padding: 1.25rem 2rem;
        }

        .modal-footer .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .modal-footer .btn-secondary {
            background-color: #6b7280;
            border: none;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #4b5563;
        }

        /* Empty State Simple */
        .empty-media {
            text-align: center;
            padding: 2rem;
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .modal-body {
                padding: 1.5rem;
            }

            .media-container {
                min-height: 200px;
                max-height: 300px;
            }
        }

        .remove-button {
            position: absolute;
            top: 12px;
            right: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.15);
        }

        .remove-button:hover {
            background-color: #ef4444;
            color: white;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25);
            transform: scale(1.05);
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
                            <h3 class="mb-2">Slider & Pop Up</h3>
                            <p>Halaman ini digunakan untuk mengelola banner informasi slider & pop-up yang akan ditampilkan
                                kepada pengguna, termasuk pengaturan konten, gambar, video, dan periode tayang.</p>
                        </div>
                    </div>
                </div>

                <!-- Navigasi Breadcrumb -->
                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index-user-admin') }}" class="d-flex align-items-center">
                                        <i class="bi bi-image me-1"></i>Slider & Pop Up
                                    </a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Semua Media Slider & Pop up</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row mb-4 slide-in">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-files"></i>
                            </div>
                            <div class="stats-title">Total Media</div>
                            <h3 class="stats-number">{{ $popups->count() }}</h3>
                            <small><i class="bi bi-plus-square me-1"></i> Media yang sudah dibuat</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-success">
                            <div class="stats-icon">
                                <i class="bi bi-toggle-on"></i>
                            </div>
                            <div class="stats-title">Media Aktif</div>
                            <h3 class="stats-number">{{ $popups->where('is_active', true)->count() }}</h3>
                            <small><i class="bi bi-eye me-1"></i> Sedang ditampilkan</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-toggle-off"></i>
                            </div>
                            <div class="stats-title">Media Nonaktif</div>
                            <h3 class="stats-number">{{ $popups->where('is_active', false)->count() }}</h3>
                            <small><i class="bi bi-eye-slash me-1"></i> Tidak ditampilkan</small>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h4 class="mb-0 d-flex align-items-center">
                                        <i class="bi bi-image me-2"></i>Daftar Media Slider & Pop Up
                                    </h4>
                                </div>

                                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#categoryModal">
                                        <i class="fa fa-plus"></i> Add Media
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Type Media</th>
                                        <th>Dibuat pada</th>
                                        <th>Switch Nonaktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($popups as $popup)
                                        <tr>
                                            <td>{{ $popup->name }}</td>
                                            <td>{{ $popup->description }}</td>
                                            <td>
                                                {{ $popup->media_type }}
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($popup->created_at)->translatedFormat('d F Y') }}
                                            </td>

                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input toggle-active" type="checkbox"
                                                        role="switch" data-id="{{ $popup->id }}"
                                                        {{ $popup->is_active ? 'checked' : '' }}>
                                                </div>
                                            </td>

                                            <td>
                                                <button
                                                    class="btn btn-sm btn-primary d-inline-flex align-items-center btn-show-popup"
                                                    data-id="{{ $popup->id }}">
                                                    <i class="bi bi-eye me-1"></i> Lihat
                                                </button>

                                                <a href="javascript:void(0);"
                                                    class="btn btn-sm btn-danger delete-product d-inline-flex align-items-center"
                                                    data-id="{{ $popup->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </section>
            </div>

            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                aria-labelledby="categoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="categoryModalLabel">Tambah Pop Up Baru</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="categoryForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="parent_id" id="parentId">
                            <input type="hidden" name="type" id="categoryType" value="category">
                            <div class="modal-body">
                                <!-- Category Name Input -->
                                <div class="form-group">
                                    <label for="categoryName">Nama Pop Up <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="categoryName" name="name"
                                        placeholder="Masukkan Nama Pop Up" required>
                                    <small class="text-muted" style="font-size: 14px;">
                                        Silakan isi dengan nama Pop Up yang ingin ditampilkan pada halaman
                                    </small>

                                </div>

                                <!-- Category Description Input -->
                                <div class="form-group">
                                    <label for="categoryDescription">Deskripsi</label>
                                    <textarea class="form-control" id="categoryDescription" name="description" rows="3"
                                        placeholder="Masukkan Deskripsi" required></textarea>
                                    <small class="text-muted" style="font-size: 14px;">
                                        Berikan deskripsi yang menjelaskan gambar ini.
                                    </small>
                                </div>

                                <!-- Category Image Upload -->
                                <!-- Media Upload -->
                                <div class="form-group upload-container">
                                    <label for="mediaPopup" class="mb-2">Media Pop Up <span
                                            class="text-danger">*</span></label>

                                    <div class="upload-zone" id="upload-zone">
                                        <input type="file" name="media_popup" id="file-input-media"
                                            class="file-input" accept="image/*,video/mp4"
                                            onchange="handleFileSelect(this)">
                                        <div class="upload-icon">🎬</div>
                                        <div class="upload-prompt">Klik untuk pilih file atau seret file ke sini</div>
                                        <div class="upload-hint">
                                            Format: <strong>JPG, PNG, JPEG, MP4</strong> — Maks.
                                            <strong>2MB</strong><br>
                                            Ukuran disarankan: <strong>1920 x 800 piksel</strong>
                                        </div>
                                        <div class="progress-container" id="upload-progress-container">
                                            <div class="progress-bar" id="upload-progress-bar"></div>
                                        </div>
                                    </div>

                                    <div class="error-message" id="upload-error"></div>

                                    <!-- Preview -->
                                    <div class="upload-preview" id="upload-preview" style="display: none;">
                                        <div class="preview-header">Pratinjau Media</div>
                                        <div class="preview-content">
                                            <div class="preview-media-container" id="preview-container">
                                                <img id="preview-image" class="preview-media"
                                                    style="display: none;" />
                                                <video id="preview-video" class="preview-media" controls
                                                    style="display: none;">
                                                    <source id="preview-video-source" src=""
                                                        type="video/mp4">
                                                    Browser Anda tidak mendukung video.
                                                </video>
                                            </div>
                                            <div class="preview-details">
                                                <div class="preview-filename" id="preview-filename"></div>
                                                <div class="preview-meta">Media pop up yang akan diunggah</div>
                                            </div>
                                            <button type="button" class="remove-button" onclick="removeUpload()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
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


                                <!-- Pilihan Display Type -->
                                <div class="form-group mt-3">
                                    <label for="displayType">Tampilkan di <span class="text-danger">*</span></label>
                                    <select class="form-control" name="display_type" id="displayType" required>
                                        <option value="popup">Hanya Pop Up</option>
                                        <option value="slider">Hanya Slider</option>
                                        <option value="both">Pop Up & Slider</option>
                                    </select>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" class="btn btn-primary">Submit Pop Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="popupModalLabel">Detail Pop Up</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Nama Pop Up -->
                            <div class="info-row">
                                <div class="info-label">Nama Pop Up</div>
                                <div class="info-content" id="popupName"></div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="info-row">
                                <div class="info-label">Deskripsi</div>
                                <div class="info-content" id="popupDescription"></div>
                            </div>

                            <!-- Media -->
                            <div class="info-row">
                                <div class="info-label">Media</div>
                                <div class="media-container" id="popupMedia"></div>
                            </div>

                            <!-- Display Type -->
                            <div class="info-row">
                                <div class="info-label">Display Type</div>
                                <div class="info-content" id="popupDisplayType"></div>
                            </div>

                            <!-- Status -->
                            <div class="info-row">
                                <div class="info-label">Status</div>
                                <div class="info-content" id="popupStatus"></div>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div class="info-row">
                                <div class="info-label">Tanggal Dibuat</div>
                                <div class="info-content" id="popupCreated"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>


            @include('admin.layouts.footer')

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    {{-- HANDLE FILE --}}
    <script>
        function handleFileSelect(input) {
            const file = input.files[0];
            if (!file) return;

            const validTypes = ["image/jpeg", "image/png", "image/jpg", "video/mp4"];
            const maxSize = 10 * 1024 * 1024; // 10MB

            const errorEl = document.getElementById("upload-error");
            const previewContainer = document.getElementById("preview-container");
            errorEl.textContent = "";
            previewContainer.innerHTML = "";

            if (!validTypes.includes(file.type)) {
                errorEl.textContent = "File harus berformat JPG, PNG, JPEG, atau MP4.";
                input.value = "";
                return;
            }

            if (file.size > maxSize) {
                errorEl.textContent = "Ukuran file tidak boleh lebih dari 10MB.";
                input.value = "";
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                if (file.type.startsWith("image/")) {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("preview-image");
                    img.style.maxWidth = "250px";
                    previewContainer.appendChild(img);
                } else if (file.type === "video/mp4") {
                    const video = document.createElement("video");
                    video.src = e.target.result;
                    video.controls = true;
                    video.width = 250;
                    previewContainer.appendChild(video);
                }
            };
            reader.readAsDataURL(file);

            document.getElementById("upload-preview").style.display = "block";
            document.getElementById("preview-filename").innerText = file.name;
        }

        function removeUpload() {
            document.getElementById("file-input-media").value = "";
            document.getElementById("upload-preview").style.display = "none";
            document.getElementById("preview-container").innerHTML = "";
            document.getElementById("upload-error").textContent = "";
        }

        // ✅ Tangani submit form pakai AJAX
        document.getElementById("categoryForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('store-popup-admin') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: "#f9fff9",
                            color: "#183018",
                            iconColor: "#28a745",
                            customClass: {
                                popup: "swal2-rounded swal2-shadow",
                                title: "swal2-title-custom",
                                timerProgressBar: "swal2-progress-custom"
                            },
                            didClose: () => {
                                location.reload();
                            }
                        });

                        this.reset();
                        removeUpload();
                    } else {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Oops...",
                            text: data.message || "Terjadi kesalahan.",
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Error",
                        text: "Gagal mengirim data ke server!",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    console.error(err);
                });
        });
    </script>


    {{-- SWITCH IS ACTIVE --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toggle-active').forEach(switchEl => {
                switchEl.addEventListener('change', () => {
                    const id = switchEl.dataset.id;
                    const isChecked = switchEl.checked;

                    // Step 1: Konfirmasi
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: `Apakah Anda yakin ingin ${isChecked ? 'mengaktifkan' : 'menonaktifkan'} popup ini?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Lanjutkan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            switchEl.checked = !isChecked;
                            return;
                        }

                        // Step 2: tampilkan modal loading
                        Swal.fire({
                            title: 'Memproses...',
                            html: 'Tunggu sebentar, sedang diproses...',
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });

                        const minimalDuration = 1500; // minimal 2 detik
                        const startTime = Date.now();

                        fetch(`/popup/${id}/toggle`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(res => res.json())
                            .then(data => {
                                const elapsed = Date.now() - startTime;
                                const remaining = Math.max(minimalDuration - elapsed,
                                    0);

                                setTimeout(() => {
                                    Swal.close(); // tutup modal loading

                                    if (data.success) {
                                        // Step 3: tampilkan toast
                                        const duration = 3000; // durasi toast

                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: duration,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast
                                                    .addEventListener(
                                                        'mouseenter',
                                                        Swal
                                                        .stopTimer);
                                                toast
                                                    .addEventListener(
                                                        'mouseleave',
                                                        Swal
                                                        .resumeTimer
                                                    );
                                            },
                                            willClose: () => {
                                                location.reload();
                                            }
                                        });

                                        Toast.fire({
                                            icon: 'success',
                                            title: data.message ||
                                                'Status berhasil diubah'
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: data.message ||
                                                'Gagal mengubah status.'
                                        });
                                        switchEl.checked = !
                                            isChecked; // kembalikan switch
                                    }
                                }, remaining);
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.close();

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan.'
                                });
                                switchEl.checked = !isChecked;
                            });
                    });
                });
            });
        });
    </script>


    {{-- MODAL SHOW --}}
    <script>
        $(document).ready(function() {
            $('.btn-show-popup').on('click', function() {
                let popupId = $(this).data('id');

                $.ajax({
                    url: '/popup/' + popupId,
                    method: 'GET',
                    success: function(response) {
                        // isi data ke modal
                        $('#popupName').text(response.name);
                        $('#popupDescription').text(response.description);
                        $('#popupDisplayType').text(response.display_type);

                        // tampilkan status aktif / tidak
                        let status = response.is_active ? 'Aktif' : 'Non Aktif';
                        $('#popupStatus').text(status);

                        // tampilkan tanggal
                        $('#popupCreated').text(response.created_at);

                        // tampilkan media
                        let mediaHtml = '';
                        if (response.media_type === 'image' && response.media_popup) {
                            mediaHtml = `<img src="${response.media_popup}" 
                                    alt="${response.name}" class="img-fluid rounded">`;
                        } else if (response.media_type === 'video' && response.media_popup) {
                            mediaHtml = `<video class="w-100 rounded" controls>
                                    <source src="${response.media_popup}" type="video/mp4">
                                    Browser anda tidak mendukung video.
                                </video>`;
                        } else {
                            mediaHtml = `<p class="text-muted">Tidak ada media</p>`;
                        }
                        $('#popupMedia').html(mediaHtml);

                        // buka modal
                        $('#popupModal').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil data popup');
                    }
                });
            });
        });
    </script>

    {{-- HANDLE DELETE --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete-product').click(function() {
                var id = $(this).data("id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This popup will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('/popup') }}/" + id,
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete popup.',
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong!',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>



    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

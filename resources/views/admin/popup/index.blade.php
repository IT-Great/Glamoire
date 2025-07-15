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
                            <h3 class="mb-2">Pop Up</h3>
                            <p>Halaman ini digunakan untuk mengelola banner informasi pop-up yang akan ditampilkan
                                kepada pengguna, termasuk pengaturan konten, gambar, dan periode tayang.</p>
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
                                        <i class="bi bi-image me-1"></i> Pop Up
                                    </a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">Semua Gambar Pop up</li>
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
                            <div class="stats-title">Total Pop Up</div>
                            <h3 class="stats-number">{{ $popups->count() }}</h3>
                            <small><i class="bi bi-plus-square me-1"></i> Pop up yang sudah dibuat</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-success">
                            <div class="stats-icon">
                                <i class="bi bi-toggle-on"></i>
                            </div>
                            <div class="stats-title">Pop Up Aktif</div>
                            <h3 class="stats-number">{{ $popups->where('is_active', true)->count() }}</h3>
                            <small><i class="bi bi-eye me-1"></i> Sedang ditampilkan</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-toggle-off"></i>
                            </div>
                            <div class="stats-title">Pop Up Nonaktif</div>
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
                                        <i class="bi bi-image me-2"></i>Daftar Pop Up
                                    </h4>
                                </div>

                                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#categoryModal">
                                        <i class="fa fa-plus"></i> Add Pop Up
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
                                        <th>Gambar</th>
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
                                                @if ($popup->image_popup)
                                                    <a href="{{ asset('storage/' . $popup->image_popup) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $popup->image_popup) }}"
                                                            alt="Popup Image" width="100">
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
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
                        <form id="categoryForm">
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
                                <div class="form-group upload-container">
                                    <label for="categoryImage" class="mb-2">Gambar Pop Up <span
                                            class="text-danger">*</span></label>

                                    <!-- Zona Unggah -->
                                    <div class="upload-zone" id="upload-zone">
                                        <input type="file" name="image_popup" id="file-input-image"
                                            class="file-input" accept="image/*" onchange="handleFileSelect(this)">
                                        <div class="upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                <path
                                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                            </svg>
                                        </div>
                                        <div class="upload-prompt">Klik untuk memilih file atau seret file ke sini
                                        </div>
                                        <div class="upload-hint">Format yang diterima: JPG, PNG — Maks. 2MB</div>
                                        <div class="progress-container" id="upload-progress-container">
                                            <div class="progress-bar" id="upload-progress-bar"></div>
                                        </div>
                                    </div>
                                    <div class="error-message" id="upload-error"></div>

                                    <!-- Pratinjau Upload -->
                                    <div class="upload-preview" id="upload-preview" style="display: none;">
                                        <div class="preview-header">Pratinjau Gambar Pop Up</div>
                                        <div class="preview-content">
                                            <div class="preview-image-container">
                                                <img class="preview-image" id="preview-image" src=""
                                                    alt="Pratinjau">
                                                <div class="preview-icon" id="preview-icon" style="display: none;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                        height="32" fill="currentColor" viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="preview-details">
                                                <div class="preview-filename" id="preview-filename">nama_file.jpg
                                                </div>
                                                <div class="preview-meta">Gambar pop up yang akan diunggah</div>
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

            <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Popup</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nama:</strong> <span id="popup-name"></span></p>
                            <p><strong>Deskripsi:</strong> <span id="popup-description"></span></p>
                            <p><strong>Tanggal:</strong> <span id="popup-created-at"></span></p>
                            <p><strong>Gambar:</strong></p>
                            <div id="popup-image"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-show-popup').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.getAttribute('data-id');

                    fetch(`/popup/${id}`)
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('popup-name').textContent = data.name;
                            document.getElementById('popup-description').textContent = data
                                .description;
                            document.getElementById('popup-created-at').textContent = data
                                .created_at;

                            const imageContainer = document.getElementById('popup-image');
                            imageContainer.innerHTML = '';

                            if (data.image_popup) {
                                const link = document.createElement('a');
                                link.href = data.image_popup;
                                link.target = '_blank';

                                const img = document.createElement('img');
                                img.src = data.image_popup;
                                img.width = 150;
                                img.classList.add('img-thumbnail');

                                link.appendChild(img);
                                imageContainer.appendChild(link);
                            } else {
                                imageContainer.textContent = 'Tidak ada gambar';
                            }

                            const modal = new bootstrap.Modal(document.getElementById(
                                'popupModal'));
                            modal.show();
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Gagal mengambil data popup.');
                        });
                });
            });
        });
    </script>


    {{-- HANDLE UPLOAD IMAGE --}}
    <script>
        // Handle file selection
        function handleFileSelect(input) {
            const file = input.files[0];
            if (!file) return;

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            // Reset error
            document.getElementById('upload-error').textContent = '';
            document.getElementById('upload-zone').classList.remove('error');

            // Check file type
            if (!validTypes.includes(file.type)) {
                document.getElementById('upload-error').textContent = 'File must be in JPG or PNG format.';
                document.getElementById('upload-zone').classList.add('error');
                input.value = '';
                return;
            }

            // Check file size
            if (file.size > maxSize) {
                document.getElementById('upload-error').textContent = 'File size must not exceed 2MB.';
                document.getElementById('upload-zone').classList.add('error');
                input.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('upload-preview');
                const previewImage = document.getElementById('preview-image');
                const previewIcon = document.getElementById('preview-icon');
                const previewFilename = document.getElementById('preview-filename');

                previewContainer.style.display = 'block';
                previewFilename.textContent = file.name;

                // Always show image for image files
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                previewIcon.style.display = 'none';

                // Simulate upload progress
                simulateUploadProgress();
            };
            reader.readAsDataURL(file);
        }

        // Remove upload
        function removeUpload() {
            document.getElementById('file-input-image').value = '';
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
                progress += 5;
                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        progressContainer.style.display = 'none';
                    }, 500);
                }
            }, 50);
        }

        // Drag and drop handling
        const dropZone = document.getElementById('upload-zone');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');

            const fileInput = document.getElementById('file-input-image');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect(fileInput);
            }
        });

        // Form submission handler
        // Updated JavaScript untuk form submission
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('categoryName').value;
            const description = document.getElementById('categoryDescription').value;
            const imageFile = document.getElementById('file-input-image').files[0];

            if (!name || !description || !imageFile) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Silakan lengkapi semua field yang diperlukan dan pilih gambar.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Disable submit button dan show loading
            const submitButton = document.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

            // Buat FormData untuk mengirim file
            const formData = new FormData();
            formData.append('name', name);
            formData.append('description', description);
            formData.append('image_popup', imageFile);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            // Kirim data ke server
            fetch('/popup-create-admin', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000, // 3 detik
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            },
                            willClose: () => {
                                // Reset form, tutup modal, reload
                                document.getElementById('categoryForm').reset();
                                removeUpload();
                                const modal = bootstrap.Modal.getInstance(document.getElementById(
                                    'categoryModal'));
                                modal.hide();
                                location.reload();
                            }
                        });

                        Toast.fire({
                            icon: 'success',
                            title: `${data.message} — halaman akan dimuat ulang…`
                        });
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                })
                .finally(() => {
                    // Restore submit button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                });
        });

        // Fungsi untuk validasi real-time
        function validateForm() {
            const name = document.getElementById('categoryName').value.trim();
            const description = document.getElementById('categoryDescription').value.trim();
            const imageFile = document.getElementById('file-input-image').files[0];
            const submitButton = document.querySelector('button[type="submit"]');

            if (name && description && imageFile) {
                submitButton.disabled = false;
                submitButton.classList.remove('btn-secondary');
                submitButton.classList.add('btn-primary');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('btn-primary');
                submitButton.classList.add('btn-secondary');
            }
        }

        // Event listeners untuk validasi real-time
        document.getElementById('categoryName').addEventListener('input', validateForm);
        document.getElementById('categoryDescription').addEventListener('input', validateForm);
        document.getElementById('file-input-image').addEventListener('change', validateForm);

        // Inisialisasi validasi saat modal dibuka
        document.getElementById('categoryModal').addEventListener('shown.bs.modal', function() {
            validateForm();
        });

        // Handle file selection (fungsi yang sudah ada, sedikit dimodifikasi)
        function handleFileSelect(input) {
            const file = input.files[0];
            if (!file) {
                validateForm();
                return;
            }

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            // Reset error
            document.getElementById('upload-error').textContent = '';
            document.getElementById('upload-zone').classList.remove('error');

            // Check file type
            if (!validTypes.includes(file.type)) {
                document.getElementById('upload-error').textContent = 'File harus berformat JPG, PNG, atau JPEG.';
                document.getElementById('upload-zone').classList.add('error');
                input.value = '';
                validateForm();
                return;
            }

            // Check file size
            if (file.size > maxSize) {
                document.getElementById('upload-error').textContent = 'Ukuran file tidak boleh melebihi 2MB.';
                document.getElementById('upload-zone').classList.add('error');
                input.value = '';
                validateForm();
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('upload-preview');
                const previewImage = document.getElementById('preview-image');
                const previewIcon = document.getElementById('preview-icon');
                const previewFilename = document.getElementById('preview-filename');

                previewContainer.style.display = 'block';
                previewFilename.textContent = file.name;

                // Always show image for image files
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                previewIcon.style.display = 'none';

                // Simulate upload progress
                simulateUploadProgress();

                // Validate form after successful file selection
                validateForm();
            };
            reader.readAsDataURL(file);
        }

        // Remove upload (fungsi yang sudah ada, sedikit dimodifikasi)
        function removeUpload() {
            document.getElementById('file-input-image').value = '';
            document.getElementById('upload-preview').style.display = 'none';
            document.getElementById('upload-progress-container').style.display = 'none';
            document.getElementById('upload-progress-bar').style.width = '0%';
            document.getElementById('upload-error').textContent = '';
            document.getElementById('upload-zone').classList.remove('error');

            // Validate form after removing file
            validateForm();
        }

        // Reset form when modal is closed
        document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('categoryForm').reset();
            removeUpload();

            // Reset submit button
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.disabled = false;
            submitButton.innerHTML = 'Submit Pop Up';
            submitButton.classList.remove('btn-secondary');
            submitButton.classList.add('btn-primary');
        });

        // Fungsi untuk menampilkan preview gambar yang sudah ada (jika edit)
        function displayExistingImage(imagePath, fileName) {
            if (imagePath) {
                const previewContainer = document.getElementById('upload-preview');
                const previewImage = document.getElementById('preview-image');
                const previewFilename = document.getElementById('preview-filename');

                previewContainer.style.display = 'block';
                previewImage.src = '/storage/' + imagePath;
                previewImage.style.display = 'block';
                previewFilename.textContent = fileName || 'Gambar saat ini';

                // Update preview header text
                document.querySelector('.preview-header').textContent = 'Gambar Pop Up Saat Ini';
            }
        }

        // Reset form when modal is closed
        document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('categoryForm').reset();
            removeUpload();
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
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

        .upload-container {
            max-width: 500px;
            margin: 0 auto;
            /* padding: 20px; */
        }

        .upload-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 12px;
        }


        .current-logo {
            background-color: white;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .current-logo:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .logo-preview {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-image-container {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
        }

        .logo-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .logo-details {
            flex: 1;
        }

        .logo-filename {
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 250px;
        }

        .logo-meta {
            font-size: 12px;
            color: #64748b;
        }

        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 24px;
            text-align: center;
            background-color: #f8fafc;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .upload-zone:hover {
            border-color: #94a3b8;
            background-color: #f1f5f9;
        }

        .upload-zone.drag-over {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }

        .upload-zone.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .upload-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
            color: #64748b;
        }

        .upload-prompt {
            font-weight: 500;
            margin-bottom: 4px;
            color: #334155;
            font-size: 14px;
        }

        .upload-hint {
            font-size: 12px;
            color: #64748b;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .upload-preview {
            background-color: white;
            border-radius: 10px;
            padding: 16px;
            margin-top: 16px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .preview-header {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .preview-image-container {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
        }

        .preview-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .preview-icon {
            font-size: 2rem;
            color: #64748b;
        }

        .preview-details {
            flex: 1;
        }

        .preview-filename {
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 250px;
        }

        .preview-meta {
            font-size: 12px;
            color: #64748b;
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

        .progress-container {
            height: 4px;
            background-color: #e2e8f0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
            display: none;
        }

        .progress-bar {
            height: 100%;
            background-color: #3b82f6;
            width: 0%;
            transition: width 0.3s ease;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Make design responsive */
        @media (max-width: 640px) {

            .logo-preview,
            .preview-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo-image-container,
            .preview-image-container {
                width: 100%;
                height: 120px;
                margin-bottom: 12px;
            }

            .remove-button {
                margin-top: 12px;
                align-self: flex-end;
            }
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
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="page-title">
                                <h3 class="mb-2">Edit Brand</h3>
                                <p>Edit brand untuk produk Anda di halaman ini.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-brand-admin') }}"
                                            class="d-flex align-items-center"><i
                                                class="bi bi-award-fill me-1"></i>Brand</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Brand</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-header bg-white">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <div>
                                                    <h4 class="mb-2 d-flex align-items-center">
                                                        <i class="bi bi-pencil-square me-2"></i>
                                                        Formulir Edit Brand
                                                    </h4>
                                                    <p class="text-muted mb-0">
                                                        Silakan edit formulir di bawah ini untuk update brand di sistem.
                                                    </p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <form class="form form-vertical"
                                                action="{{ route('update-brand-admin', $brand->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT') <!-- Metode PUT untuk update -->
                                                <div class="form-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group has-icon-left">
                                                                <label for="brand-name" class="mb-2">Brand Name <span
                                                                        style="color: red">*</span></label>
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control"
                                                                        id="brand-name"
                                                                        value="{{ old('name', $brand->name) }}"
                                                                        name="name">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-bag"></i>
                                                                    </div>
                                                                </div>

                                                                @if ($errors->has('name'))
                                                                    <p style="color: red">{{ $errors->first('name') }}
                                                                    </p>
                                                                @else
                                                                    <small class="text-muted" style="font-size: 14px;">
                                                                        Berikan nama yang unik untuk Brand Anda yang
                                                                        akan
                                                                        mudah dikenali oleh pengguna.
                                                                    </small>
                                                                @endif

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="brand-description"
                                                                    class="mb-2">Description <span
                                                                        style="color: red">*</span></label>
                                                                <textarea class="form-control" id="brand-description" rows="3" name="description">{{ old('description', $brand->description) }}</textarea>
                                                                @if ($errors->has('description'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('description') }}</p>
                                                                @else
                                                                    <small class="text-muted" style="font-size: 14px;">
                                                                        Jelaskan apa yang membuat Brand Anda menonjol
                                                                        dan
                                                                        misinya.
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Kolom Kanan -->
                                                        <div class="form-group upload-container">
                                                            <!-- Upload Title -->
                                                            <label for="brand-name" class="mb-2">Brand Logo <span
                                                                    style="color: red">*</span></label>
                                                            <!-- Using exactly your code structure for current logo -->
                                                            @if ($brand->brand_logo)
                                                                <div class="mb-4">
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <a href="{{ asset('storage/' . $brand->brand_logo) }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset('storage/' . $brand->brand_logo) }}"
                                                                                alt="Invoice Document"
                                                                                class="rounded shadow-sm"
                                                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                        </a>
                                                                        <div>
                                                                            <p class="mb-1 fw-bold text-break w-100">
                                                                                {{ basename($brand->brand_logo) }}
                                                                            </p>
                                                                            <small class="text-muted">Brand Logo yang
                                                                                telah diunggah saat ini</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <!-- Upload Zone -->
                                                            <div class="upload-zone" id="upload-zone">
                                                                <input type="file" name="brand_logo"
                                                                    id="file-input-logo" class="file-input"
                                                                    accept="image/*"
                                                                    onchange="handleFileSelect(this)">
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
                                                                <div class="upload-prompt">Klik untuk memilih file atau
                                                                    seret file ke sini</div>
                                                                <div class="upload-hint">Format diterima: JPG, PNG, PDF
                                                                    &mdash; Maks. 2MB</div>
                                                                <div class="progress-container"
                                                                    id="upload-progress-container">
                                                                    <div class="progress-bar"
                                                                        id="upload-progress-bar"></div>
                                                                </div>
                                                            </div>
                                                            <div class="error-message" id="upload-error"></div>

                                                            @error('brand_logo')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror

                                                            <!-- Preview of New Upload -->
                                                            <div class="upload-preview" id="upload-preview"
                                                                style="display: none;">
                                                                <div class="preview-header">Preview Brand Logo Baru
                                                                </div>
                                                                <div class="preview-content">
                                                                    <div class="preview-image-container">
                                                                        <img class="preview-image" id="preview-image"
                                                                            src="" alt="Preview">
                                                                        <div class="preview-icon" id="preview-icon"
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
                                                                            id="preview-filename">filename.jpg</div>
                                                                        <div class="preview-meta">Brand Logo yang akan
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
                                                    <!-- Submit Button -->
                                                    <div class="col-12 d-flex justify-content-end mt-2">
                                                        <a href="{{ route('index-brand-admin') }}"
                                                            class="btn btn-secondary btn-sm me-2"
                                                            style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                                            <i class="bi bi-box-arrow-in-left me-1"></i>
                                                            Kembali
                                                        </a>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1">Submit
                                                            Brand</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- End Formulir -->
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

    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- upload file gambar --}}
    <script>
        // Handle file selection
        function handleFileSelect(input) {
            const file = input.files[0];
            if (!file) return;

            // Validate file
            const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
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

            // Show preview
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
                    previewIcon.style.display = 'block';
                } else {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    previewIcon.style.display = 'none';
                }

                // Simulate upload progress for demonstration
                simulateUploadProgress();
            };
            reader.readAsDataURL(file);
        }

        // Remove upload
        function removeUpload() {
            document.getElementById('file-input-logo').value = '';
            document.getElementById('upload-preview').style.display = 'none';
            document.getElementById('upload-progress-container').style.display = 'none';
            document.getElementById('upload-progress-bar').style.width = '0%';
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

            const fileInput = document.getElementById('file-input-logo');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect(fileInput);
            }
        });

        // Initialize
        window.onload = function() {
            checkCurrentLogo();
        };
    </script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

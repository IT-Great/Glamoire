<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

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
                                <h3 class="mb-2">Tambah Informasi Tentang Kami</h3>
                                <p>Isi informasi tentang perusahaan Anda di halaman ini.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-aboutus-admin') }}"
                                            class="d-flex align-items-center"> <i
                                                class="bi bi-info-circle-fill me-1"></i>Tentang Kami</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Informasi Tentang Kami</li>
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
                                                        Formulir Tambah Informasi Tentang Kami
                                                    </h4>
                                                    <p class="text-muted mb-0">
                                                        Silakan isi formulir di bawah ini untuk menambahan informasi
                                                        pada halaman tentang kami di sistem.
                                                    </p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <form
                                                action="{{ isset($aboutUs) ? route('update-aboutus-admin', $aboutUs->id) : route('store-aboutus-admin') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @if (isset($aboutUs))
                                                    @method('PUT')
                                                @endif

                                                {{-- HERO SECTION --}}
                                                <div class="mb-5">
                                                    <h5>Bagian Hero</h5>

                                                    {{-- Hero Title --}}
                                                    <div class="form-group">
                                                        <label>Judul Hero <small class="text-danger">*</small></label>
                                                        <input type="text" name="hero_title" class="form-control"
                                                            placeholder="Masukkan judul utama untuk bagian Hero"
                                                            value="{{ old('hero_title', $aboutUs->hero_title ?? '') }}">
                                                        <small class="form-text text-muted">
                                                            Wajib diisi. Ini adalah judul utama yang akan tampil pada
                                                            bagian Hero halaman depan.
                                                        </small>
                                                    </div>

                                                    {{-- Hero Description --}}
                                                    <div class="form-group">
                                                        <label>Deskripsi Hero</label>
                                                        <textarea name="hero_description" class="form-control" placeholder="Masukkan deskripsi untuk bagian Hero">{{ old('hero_description', $aboutUs->hero_description ?? '') }}</textarea>
                                                        <small class="form-text text-muted">
                                                            Isi dengan deskripsi untuk bagian Hero. Deskripsi ini akan
                                                            muncul di bawah judul pada bagian Hero halaman depan.
                                                        </small>
                                                    </div>

                                                    {{-- Hero Image --}}
                                                    <div class="form-group">
                                                        <label>Gambar Hero</label>
                                                        <input type="file" name="hero_image"
                                                            class="form-control image-input" data-preview="hero_preview"
                                                            data-progress="hero_progress"
                                                            data-container="hero_container">
                                                        <small class="form-text text-muted">
                                                            Unggah gambar untuk bagian Hero. Gambar ini akan tampil
                                                            sebagai latar belakang atau ilustrasi pada bagian Hero.
                                                            Ukuran maksimal 2MB.
                                                        </small>

                                                        <div id="hero_container" class="mt-2">
                                                            @if (!empty($aboutUs->hero_image))
                                                                <img src="{{ asset('storage/' . $aboutUs->hero_image) }}"
                                                                    alt="" width="100" class="mb-2">
                                                            @endif

                                                            <div class="preview mt-2" id="hero_preview"
                                                                style="display: none;">
                                                                <img src="" width="100">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-btn mt-1">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </div>

                                                            <div class="progress mt-1" id="hero_progress"
                                                                style="display: none; height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>


                                                {{-- INTRO SECTION --}}
                                                <div class="mb-5">
                                                    <h5>Bagian Intro</h5>

                                                    {{-- Intro Title --}}
                                                    <div class="form-group">
                                                        <label>Judul Intro</label>
                                                        <input type="text" name="intro_title" class="form-control"
                                                            placeholder="Masukkan judul untuk bagian Intro (opsional)"
                                                            value="{{ old('intro_title', $aboutUs->intro_title ?? '') }}">
                                                        <small class="form-text text-muted">
                                                            Opsional. Isi dengan judul untuk bagian Intro yang akan
                                                            muncul di bawah bagian Hero.
                                                            Maksimal 255 karakter.
                                                        </small>
                                                    </div>

                                                    {{-- Intro Description --}}
                                                    <div class="form-group">
                                                        <label>Deskripsi Intro</label>
                                                        <textarea name="intro_description" class="form-control"
                                                            placeholder="Masukkan deskripsi untuk bagian Intro (opsional)">{{ old('intro_description', $aboutUs->intro_description ?? '') }}</textarea>
                                                        <small class="form-text text-muted">
                                                            Opsional. Isi dengan deskripsi untuk memperkenalkan
                                                            perusahaan atau situs Anda di bagian Intro.
                                                        </small>
                                                    </div>

                                                    {{-- Intro Image --}}
                                                    <div class="form-group">
                                                        <label>Gambar Intro</label>
                                                        <input type="file" name="intro_image"
                                                            class="form-control image-input"
                                                            data-preview="intro_preview"
                                                            data-progress="intro_progress"
                                                            data-container="intro_container">
                                                        <small class="form-text text-muted">
                                                            Opsional. Unggah gambar untuk bagian Intro yang akan tampil
                                                            di bawah teks Intro. Ukuran maksimal 2MB.
                                                        </small>

                                                        <div id="intro_container" class="mt-2">
                                                            @if (!empty($aboutUs->intro_image))
                                                                <img src="{{ asset('storage/' . $aboutUs->intro_image) }}"
                                                                    alt="" width="100" class="mb-2">
                                                            @endif

                                                            <div class="preview mt-2" id="intro_preview"
                                                                style="display: none;">
                                                                <img src="" width="100">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-btn">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </div>

                                                            <div class="progress mt-1" id="intro_progress"
                                                                style="display: none; height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>


                                                {{-- VISION --}}
                                                <div class="mb-5">
                                                    <h5>Bagian Visi</h5>

                                                    {{-- Vision Title --}}
                                                    <div class="form-group">
                                                        <label>Judul Visi</label>
                                                        <input type="text" name="vision_title"
                                                            class="form-control"
                                                            placeholder="Masukkan judul untuk bagian Visi (opsional)"
                                                            value="{{ old('vision_title', $aboutUs->vision_title ?? '') }}">
                                                        <small class="form-text text-muted">
                                                            Opsional. Judul untuk bagian Visi yang akan tampil di
                                                            halaman Tentang Kami. Maksimal 255 karakter.
                                                        </small>
                                                    </div>

                                                    {{-- Vision Description --}}
                                                    <div class="form-group">
                                                        <label>Deskripsi Visi</label>
                                                        <textarea name="vision_description" class="form-control"
                                                            placeholder="Masukkan deskripsi untuk bagian Visi (opsional)">{{ old('vision_description', $aboutUs->vision_description ?? '') }}</textarea>
                                                        <small class="form-text text-muted">
                                                            Opsional. Isi dengan deskripsi visi perusahaan yang
                                                            menjelaskan tujuan jangka panjang.
                                                        </small>
                                                    </div>

                                                    {{-- Vision Image --}}
                                                    <div class="form-group">
                                                        <label>Gambar Visi</label>
                                                        <input type="file" name="vision_image"
                                                            class="form-control image-input"
                                                            data-preview="vision_preview"
                                                            data-progress="vision_progress"
                                                            data-container="vision_container">
                                                        <small class="form-text text-muted">
                                                            Opsional. Unggah gambar untuk mendukung bagian Visi. Ukuran
                                                            maksimal 2MB.
                                                        </small>

                                                        <div id="vision_container" class="mt-2">
                                                            @if (!empty($aboutUs->vision_image))
                                                                <img src="{{ asset('storage/' . $aboutUs->vision_image) }}"
                                                                    alt="" width="100" class="mb-2">
                                                            @endif
                                                            <div class="preview mt-2" id="vision_preview"
                                                                style="display: none;">
                                                                <img src="" width="100">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-btn mt-1">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                            <div class="progress mt-1" id="vision_progress"
                                                                style="display: none; height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>

                                                {{-- MISSION --}}
                                                <div class="mb-5">
                                                    <h5>Bagian Misi</h5>

                                                    {{-- Mission Title --}}
                                                    <div class="form-group">
                                                        <label>Judul Misi</label>
                                                        <input type="text" name="mission_title"
                                                            class="form-control"
                                                            placeholder="Masukkan judul untuk bagian Misi (opsional)"
                                                            value="{{ old('mission_title', $aboutUs->mission_title ?? '') }}">
                                                        <small class="form-text text-muted">
                                                            Opsional. Judul untuk bagian Misi yang akan tampil di
                                                            halaman Tentang Kami. Maksimal 255 karakter.
                                                        </small>
                                                    </div>

                                                    {{-- Mission Description --}}
                                                    <div class="form-group">
                                                        <label>Deskripsi Misi</label>
                                                        <textarea name="mission_description" class="form-control"
                                                            placeholder="Masukkan deskripsi untuk bagian Misi (opsional)">{{ old('mission_description', $aboutUs->mission_description ?? '') }}</textarea>
                                                        <small class="form-text text-muted">
                                                            Opsional. Isi dengan deskripsi misi perusahaan yang
                                                            menjelaskan langkah-langkah atau cara mencapai visi.
                                                        </small>
                                                    </div>

                                                    {{-- Mission Image --}}
                                                    <div class="form-group">
                                                        <label>Gambar Misi</label>
                                                        <input type="file" name="mission_image"
                                                            class="form-control image-input"
                                                            data-preview="mission_preview"
                                                            data-progress="mission_progress"
                                                            data-container="mission_container">
                                                        <small class="form-text text-muted">
                                                            Opsional. Unggah gambar untuk mendukung bagian Misi. Ukuran
                                                            maksimal 2MB.
                                                        </small>

                                                        <div id="mission_container" class="mt-2">
                                                            @if (!empty($aboutUs->mission_image))
                                                                <img src="{{ asset('storage/' . $aboutUs->mission_image) }}"
                                                                    alt="" width="100" class="mb-2">
                                                            @endif
                                                            <div class="preview mt-2" id="mission_preview"
                                                                style="display: none;">
                                                                <img src="" width="100">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-btn mt-1">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                            <div class="progress mt-1" id="mission_progress"
                                                                style="display: none; height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>


                                                {{-- OUR STORY --}}
                                                <div class="mb-5">
                                                    <h5>Bagian Cerita Kami</h5>

                                                    {{-- Story Title --}}
                                                    <div class="form-group">
                                                        <label>Judul Cerita Kami</label>
                                                        <input type="text" name="story_title" class="form-control"
                                                            placeholder="Masukkan judul untuk bagian Cerita Kami (opsional)"
                                                            value="{{ old('story_title', $aboutUs->story_title ?? '') }}">
                                                        <small class="form-text text-muted">
                                                            Opsional. Judul untuk bagian Cerita Kami yang akan tampil di
                                                            halaman Tentang Kami. Maksimal 255 karakter.
                                                        </small>
                                                    </div>

                                                    {{-- Story Description --}}
                                                    <div class="form-group">
                                                        <label>Deskripsi Cerita Kami</label>
                                                        <textarea name="story_description" class="form-control"
                                                            placeholder="Masukkan deskripsi untuk bagian Cerita Kami (opsional)">{{ old('story_description', $aboutUs->story_description ?? '') }}</textarea>
                                                        <small class="form-text text-muted">
                                                            Opsional. Isi dengan cerita tentang perjalanan atau latar
                                                            belakang perusahaan Anda.
                                                        </small>
                                                    </div>

                                                    {{-- Story Image --}}
                                                    <div class="form-group">
                                                        <label>Gambar Cerita Kami</label>
                                                        <input type="file" name="story_image"
                                                            class="form-control image-input"
                                                            data-preview="story_preview"
                                                            data-progress="story_progress"
                                                            data-container="story_container">
                                                        <small class="form-text text-muted">
                                                            Opsional. Unggah gambar untuk mendukung cerita perusahaan.
                                                            Ukuran maksimal 2MB.
                                                        </small>

                                                        <div id="story_container" class="mt-2">
                                                            @if (!empty($aboutUs->story_image))
                                                                <img src="{{ asset('storage/' . $aboutUs->story_image) }}"
                                                                    alt="" width="100" class="mb-2">
                                                            @endif
                                                            <div class="preview mt-2" id="story_preview"
                                                                style="display: none;">
                                                                <img src="" width="100">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-btn mt-1">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                            <div class="progress mt-1" id="story_progress"
                                                                style="display: none; height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>


                                                {{-- ACHIEVEMENT --}}
                                                <div class="mb-5">
                                                    <h5>Bagian Prestasi/Sertifikasi</h5>

                                                    {{-- Achievement Title --}}
                                                    <div class="form-group">
                                                        <label>Judul Prestasi</label>
                                                        <input type="text" name="achievement_title"
                                                            class="form-control"
                                                            placeholder="Masukkan judul untuk bagian Prestasi (opsional)"
                                                            value="{{ old('achievement_title', $aboutUs->achievement_title ?? '') }}">
                                                        <small class="form-text text-muted">
                                                            Opsional. Judul untuk bagian Prestasi yang akan tampil di
                                                            halaman Tentang Kami. Maksimal 255 karakter.
                                                        </small>
                                                    </div>

                                                    {{-- Achievement Description --}}
                                                    <div class="form-group">
                                                        <label>Deskripsi Prestasi</label>
                                                        <textarea name="achievement_description" class="form-control"
                                                            placeholder="Masukkan deskripsi untuk bagian Prestasi (opsional)">{{ old('achievement_description', $aboutUs->achievement_description ?? '') }}</textarea>
                                                        <small class="form-text text-muted">
                                                            Opsional. Isi dengan deskripsi tentang pencapaian atau
                                                            penghargaan perusahaan Anda.
                                                        </small>
                                                    </div>

                                                    {{-- Achievement Image --}}
                                                    <div class="form-group">
                                                        <label>Gambar Prestasi</label>
                                                        <input type="file" name="achievement_image"
                                                            class="form-control image-input"
                                                            data-preview="achievement_preview"
                                                            data-progress="achievement_progress"
                                                            data-container="achievement_container">
                                                        <small class="form-text text-muted">
                                                            Opsional. Unggah gambar untuk mendukung bagian Prestasi.
                                                            Ukuran maksimal 2MB.
                                                        </small>

                                                        <div id="achievement_container" class="mt-2">
                                                            @if (!empty($aboutUs->achievement_image))
                                                                <img src="{{ asset('storage/' . $aboutUs->achievement_image) }}"
                                                                    alt="" width="100" class="mb-2">
                                                            @endif
                                                            <div class="preview mt-2" id="achievement_preview"
                                                                style="display: none;">
                                                                <img src="" width="100">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-btn mt-1">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                            <div class="progress mt-1" id="achievement_progress"
                                                                style="display: none; height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end mt-2">
                                                    <a href="{{ route('index-aboutus-admin') }}"
                                                        class="btn btn-secondary btn-sm me-2"
                                                        style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                                        <i class="bi bi-box-arrow-in-left me-1"></i>
                                                        Kembali
                                                    </a>

                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        Submit
                                                    </button>

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
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- upload file gambar --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.image-input').forEach(input => {
                input.addEventListener('change', () => handleImageInput(input));
            });

            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-btn')) {
                    const container = e.target.closest('.form-group');
                    const input = container.querySelector('.image-input');
                    const preview = container.querySelector('.preview');
                    const progress = container.querySelector('.progress');

                    input.value = '';
                    preview.style.display = 'none';
                    progress.style.display = 'none';
                    progress.querySelector('.progress-bar').style.width = '0%';
                }
            });
        });

        function handleImageInput(input) {
            const file = input.files[0];
            if (!file) return;

            const previewId = input.dataset.preview;
            const progressId = input.dataset.progress;

            const preview = document.getElementById(previewId);
            const progress = document.getElementById(progressId);

            const img = preview.querySelector('img');
            const progressBar = progress.querySelector('.progress-bar');

            const reader = new FileReader();
            reader.onload = (e) => {
                img.src = e.target.result;
                preview.style.display = 'block';
                simulateProgress(progress, progressBar);
            };
            reader.readAsDataURL(file);
        }

        function simulateProgress(progress, bar) {
            progress.style.display = 'block';
            bar.style.width = '0%';

            let percent = 0;
            const interval = setInterval(() => {
                percent += 10;
                bar.style.width = percent + '%';
                if (percent >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        progress.style.display = 'none';
                    }, 500);
                }
            }, 50);
        }
    </script>


    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

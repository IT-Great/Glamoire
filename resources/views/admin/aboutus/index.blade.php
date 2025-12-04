<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Glamoire</title>

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
                            <h3 class="mb-2">Tentang Kami</h3>
                            <p>Halaman ini berisi informasi mengenai profil perusahaan, tujuan, visi dan misi, serta tim
                                yang terlibat dalam pengelolaan sistem.</p>
                        </div>

                    </div>
                </div>

                <!-- Navigasi Breadcrumb -->
                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index-user-admin') }}"
                                        class="d-flex align-items-center"> <i
                                            class="bi bi-info-circle-fill me-1"></i>Tentang Kami</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Semua Data Tentang Kami</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h4 class="mb-2 d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill me-2"></i>Kelola Data Tentang Kami
                                    </h4>
                                </div>
                                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                    @if (!$aboutUs)
                                        <a href="{{ route('create-aboutus-admin') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus"></i> Tambah Tentang Kami
                                        </a>
                                    @else
                                        <a href="{{ route('edit-aboutus-admin', $aboutUs->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Edit Tentang Kami
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($aboutUs)
                                <table class="table table-bordered">
                                    {{-- HERO --}}
                                    <tr>
                                        <th colspan="3">
                                            <h5 class="d-inline-flex align-items-center">
                                                <i class="bi bi-megaphone text-primary me-2"></i>Hero Section
                                            </h5>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th width="20%">Title</th>
                                        <td width="70%">{{ $aboutUs->hero_title }}</td>
                                        <td width="10%" class="text-center">
                                            @if ($aboutUs->hero_title)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="hero_title" data-section="Hero">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $aboutUs->hero_description }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->hero_description)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="hero_description" data-section="Hero">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($aboutUs->hero_image)
                                                <a href="{{ asset('storage/' . $aboutUs->hero_image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->hero_image) }}"
                                                        width="150">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->hero_image)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="hero_image" data-section="Hero">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- INTRO --}}
                                    <tr>
                                        <th colspan="3">
                                            <h5 class="d-inline-flex align-items-center">
                                                <i class="bi bi-lightbulb text-warning me-2"></i>Intro Section
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $aboutUs->intro_title }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->intro_title)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="intro_title" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $aboutUs->intro_description }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->intro_description)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="intro_description" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($aboutUs->intro_image)
                                                <a href="{{ asset('storage/' . $aboutUs->intro_image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->intro_image) }}"
                                                        width="150">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->intro_image)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="intro_image" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Video/GIF</th>
                                        <td>
                                            @if ($aboutUs->intro_video)
                                                @php
                                                    $fileExtension = pathinfo(
                                                        $aboutUs->intro_video,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                @if (strtolower($fileExtension) === 'gif')
                                                    {{-- Preview GIF --}}
                                                    <img src="{{ asset('storage/' . $aboutUs->intro_video) }}"
                                                        width="400"
                                                        style="max-height: 300px; object-fit: contain; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        alt="Mission GIF">
                                                @else
                                                    {{-- Preview Video --}}
                                                    <video width="400" height="300" controls>
                                                        <source src="{{ asset('storage/' . $aboutUs->intro_video) }}"
                                                            type="video/mp4">
                                                        Browser Anda tidak mendukung tag video.
                                                    </video>
                                                @endif
                                            @else
                                                <span class="text-muted">Tidak ada media</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->intro_video)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="intro_video" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>


                                    {{-- VISION --}}
                                    <tr>
                                        <th colspan="3">
                                            <h5 class="d-inline-flex align-items-center">
                                                <i class="bi bi-eye text-success me-2"></i>Visi
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $aboutUs->vision_title }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->vision_title)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="vision_title" data-section="Visi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $aboutUs->vision_description }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->vision_description)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="vision_description" data-section="Visi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($aboutUs->vision_image)
                                                <a href="{{ asset('storage/' . $aboutUs->vision_image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->vision_image) }}"
                                                        width="150">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->vision_image)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="vision_image" data-section="Visi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Video/GIF</th>
                                        <td>
                                            @if ($aboutUs->vision_video)
                                                @php
                                                    $fileExtension = pathinfo(
                                                        $aboutUs->vision_video,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                @if (strtolower($fileExtension) === 'gif')
                                                    {{-- Preview GIF --}}
                                                    <img src="{{ asset('storage/' . $aboutUs->vision_video) }}"
                                                        width="400"
                                                        style="max-height: 300px; object-fit: contain; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        alt="Mission GIF">
                                                @else
                                                    {{-- Preview Video --}}
                                                    <video width="400" height="300" controls>
                                                        <source src="{{ asset('storage/' . $aboutUs->vision_video) }}"
                                                            type="video/mp4">
                                                        Browser Anda tidak mendukung tag video.
                                                    </video>
                                                @endif
                                            @else
                                                <span class="text-muted">Tidak ada media</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->vision_video)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="vision_video" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- MISSION --}}
                                    <tr>
                                        <th colspan="3">
                                            <h5 class="d-inline-flex align-items-center">
                                                <i class="bi bi-flag text-danger me-2"></i>Misi
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $aboutUs->mission_title }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->mission_title)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="mission_title" data-section="Misi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $aboutUs->mission_description }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->mission_description)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="mission_description" data-section="Misi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($aboutUs->mission_image)
                                                <a href="{{ asset('storage/' . $aboutUs->mission_image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->mission_image) }}"
                                                        width="150">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->mission_image)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="mission_image" data-section="Misi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Video/GIF</th>
                                        <td>
                                            @if ($aboutUs->mission_video)
                                                @php
                                                    $fileExtension = pathinfo(
                                                        $aboutUs->mission_video,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                @if (strtolower($fileExtension) === 'gif')
                                                    {{-- Preview GIF --}}
                                                    <img src="{{ asset('storage/' . $aboutUs->mission_video) }}"
                                                        width="400"
                                                        style="max-height: 300px; object-fit: contain; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        alt="Mission GIF">
                                                @else
                                                    {{-- Preview Video --}}
                                                    <video width="400" height="300" controls>
                                                        <source
                                                            src="{{ asset('storage/' . $aboutUs->mission_video) }}"
                                                            type="video/mp4">
                                                        Browser Anda tidak mendukung tag video.
                                                    </video>
                                                @endif
                                            @else
                                                <span class="text-muted">Tidak ada media</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->mission_video)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="mission_video" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>


                                    {{-- OUR STORY --}}
                                    <tr>
                                        <th colspan="3">
                                            <h5 class="d-inline-flex align-items-center">
                                                <i class="bi bi-book text-info me-2"></i>Cerita Terkini
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $aboutUs->story_title }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->story_title)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="story_title" data-section="Cerita Terkini">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $aboutUs->story_description }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->story_description)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="story_description" data-section="Cerita Terkini">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($aboutUs->story_image)
                                                <a href="{{ asset('storage/' . $aboutUs->story_image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->story_image) }}"
                                                        width="150">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->story_image)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="story_image" data-section="Cerita Terkini">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Video/GIF</th>
                                        <td>
                                            @if ($aboutUs->story_video)
                                                @php
                                                    $fileExtension = pathinfo(
                                                        $aboutUs->story_video,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                @if (strtolower($fileExtension) === 'gif')
                                                    {{-- Preview GIF --}}
                                                    <img src="{{ asset('storage/' . $aboutUs->story_video) }}"
                                                        width="400"
                                                        style="max-height: 300px; object-fit: contain; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        alt="Mission GIF">
                                                @else
                                                    {{-- Preview Video --}}
                                                    <video width="400" height="300" controls>
                                                        <source src="{{ asset('storage/' . $aboutUs->story_video) }}"
                                                            type="video/mp4">
                                                        Browser Anda tidak mendukung tag video.
                                                    </video>
                                                @endif
                                            @else
                                                <span class="text-muted">Tidak ada media</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->story_video)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="story_video" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- ACHIEVEMENT --}}
                                    <tr>
                                        <th colspan="3">
                                            <h5 class="d-inline-flex align-items-center">
                                                <i class="bi bi-trophy text-warning me-2"></i>Sertifikat/Prestasi
                                            </h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $aboutUs->achievement_title }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->achievement_title)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="achievement_title" data-section="Sertifikat/Prestasi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $aboutUs->achievement_description }}</td>
                                        <td class="text-center">
                                            @if ($aboutUs->achievement_description)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="achievement_description"
                                                    data-section="Sertifikat/Prestasi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            @if ($aboutUs->achievement_image)
                                                <a href="{{ asset('storage/' . $aboutUs->achievement_image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $aboutUs->achievement_image) }}"
                                                        width="150">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->achievement_image)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="achievement_image" data-section="Sertifikat/Prestasi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Video/GIF</th>
                                        <td>
                                            @if ($aboutUs->achievement_video)
                                                @php
                                                    $fileExtension = pathinfo(
                                                        $aboutUs->achievement_video,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                @endphp

                                                @if (strtolower($fileExtension) === 'gif')
                                                    {{-- Preview GIF --}}
                                                    <img src="{{ asset('storage/' . $aboutUs->achievement_video) }}"
                                                        width="400"
                                                        style="max-height: 300px; object-fit: contain; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        alt="Mission GIF">
                                                @else
                                                    {{-- Preview Video --}}
                                                    <video width="400" height="300" controls>
                                                        <source src="{{ asset('storage/' . $aboutUs->achievement_video) }}"
                                                            type="video/mp4">
                                                        Browser Anda tidak mendukung tag video.
                                                    </video>
                                                @endif
                                            @else
                                                <span class="text-muted">Tidak ada media</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($aboutUs->achievement_video)
                                                <button class="btn btn-sm btn-danger delete-field"
                                                    data-field="achievement_video" data-section="Intro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>


                                </table>
                            @else
                                <p class="text-center">No About Us data found. Please create it.</p>
                            @endif
                        </div>
                    </div>
                </section>


            </div>
            @include('admin.layouts.footer')

        </div>
    </div>

    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    {{-- Script untuk Delete dengan SweetAlert2 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-field');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const field = this.getAttribute('data-field');
                    const section = this.getAttribute('data-section');
                    const fieldType = field.includes('title') ? 'Title' :
                        field.includes('description') ? 'Description' : 'Image';

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus ${fieldType} dari ${section}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const csrfToken = document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content');

                            // Tampilkan loading
                            Swal.fire({
                                title: 'Menghapus...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            fetch('{{ route('delete-aboutus-field-admin') }}', {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        field: field
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: data.message,
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK',
                                            timer: 3000,
                                            timerProgressBar: true
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: data.message,
                                            icon: 'error',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat menghapus field',
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    });
                                });
                        }
                    });
                });
            });
        });
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

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

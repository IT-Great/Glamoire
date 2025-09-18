<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>COA - Glamoire</title>
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">

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
            background: linear-gradient(135deg, var(--danger-color), #ef4444);
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

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
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
                        <div class="col-12 col-md-6">
                            <h3>Chart of Accounts</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-chartofaccount') }}"
                                            class="d-flex align-items-center"><i
                                                class="bi bi-journal-bookmark-fill me-2"></i>COA</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bua COA Baru</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic form layout section start -->
                <section id="multiple-column-form" class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header bg-white">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div>
                                                <h4 class=" d-flex align-items-center">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                    Buat COA Baru
                                                </h4>

                                                <p class="text-muted">Silahkan isi formulir dibawah ini untuk membuat
                                                    COA baru.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('store-chartofaccount') }}" method="POST"
                                            enctype="multipart/form-data" class="form form-vertical">
                                            @csrf
                                            <div class="form-body">

                                                <div class="row">
                                                    <!-- Brand Name Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="brand-name-icon">Account Number<span
                                                                    style="color: red"> *</span></label>
                                                            <div class="position-relative mt-2 mb-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('coa_no') ? 'is-invalid' : '' }}"
                                                                    placeholder="xxx.xxx" id="brand-name-icon"
                                                                    name="coa_no" value="{{ old('coa_no') }}">
                                                            </div>
                                                            @if ($errors->has('name'))
                                                                <p style="color: red">{{ $errors->first('coa_no') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Berikan Account COA Anda yang akan
                                                                    mudah dikenali oleh pengguna.
                                                                </small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="brand-name-icon"
                                                                style="margin-bottom: 10px;">Category<span
                                                                    style="color: red"> *</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('coa_category_id') ? 'is-invalid' : '' }}"
                                                                name="coa_category_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('coa_category_id') ? '' : 'selected' }}>
                                                                    Pilih Sub Kategori</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('coa_category_id') == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->category_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>


                                                            <!-- Link untuk menambahkan kategori baru -->
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#categoryModal"
                                                                style="display: inline-block; margin-top: 5px; margin-bottom: 5px;">
                                                                <i class="fa fa-plus"></i> Add New Category
                                                            </a>

                                                            <!-- Pesan error atau informasi tambahan -->
                                                            @if ($errors->has('coa_category_id'))
                                                                <p style="color: red; margin-top: 5px;">
                                                                    {{ $errors->first('coa_category_id') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px; display: block;">
                                                                    Pilih Kategori yang sesuai atau tambahkan Kategori
                                                                    yang baru
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="brand-name-icon">Name<span style="color: red">
                                                                    *</span></label>
                                                            <div class="position-relative mt-2 mb-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Nama" id="brand-name-icon"
                                                                    name="name" value="{{ old('name') }}">
                                                            </div>
                                                            @if ($errors->has('name'))
                                                                <p style="color: red">{{ $errors->first('name') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Berikan nama yang unik untuk Anda yang akan
                                                                    mudah dikenali oleh pengguna.
                                                                </small>
                                                            @endif
                                                        </div>

                                                        <!-- Description Section -->
                                                        <div class="form-group">
                                                            <label for="brand-description">Deskripsi</label>
                                                            <textarea class="form-control mt-2 mb-2 {{ $errors->has('description') ? 'is-invalid' : '' }}" id="brand-description"
                                                                rows="10" placeholder="Deskripsi" name="description">{{ old('description') }}</textarea>

                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Berikan sedikit catatan jika ada
                                                                </small>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <a href="{{ route('index-chartofaccount') }}" type="button"
                                                        class="btn btn-sm btn-secondary me-2 d-inline-flex align-items-center">
                                                        <i class="bi bi-arrow-left-circle me-1"></i>
                                                        Kembali
                                                    </a>

                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary d-inline-flex align-items-center">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Submit COA
                                                    </button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- modal add category --}}
                <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                    aria-labelledby="categoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="categoryModalLabel">Add New
                                    Category</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('store-categorycoa') }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" id="parentId">
                                <input type="hidden" name="type" id="categoryType" value="category">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="category_name">Category Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control mb-2 mt-2" id="category_name"
                                            name="category_name" placeholder="Masukan Nama Kategory" required>
                                        <small class="text-muted" style="font-size: 14px;">
                                            Silakan masukkan nama kategori yang unik dan
                                            deskriptif.
                                        </small>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save
                                        Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/n pm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
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

</body>

</html>

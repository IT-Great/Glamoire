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

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f2f7ff;
            color: #333;
            margin: 0;
            padding: 0;
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
            background-color: white;
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
            font-size: 1.25rem;
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
            border: none;
            cursor: pointer;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 3px 10px rgba(67, 94, 190, 0.2);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.3);
        }

        .btn-light-secondary {
            background-color: #e9ecef;
            color: var(--secondary);
            border: 1px solid #dee2e6;
        }

        .btn-light-secondary:hover {
            background-color: #dee2e6;
            transform: translateY(-2px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
            background-color: #fff;
            outline: none;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            color: #495057;
        }

        .form-select {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            width: 100%;
            appearance: auto;
            font-size: 1rem;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 94, 190, 0.25);
            outline: none;
        }

        .position-relative {
            position: relative;
        }

        .form-control-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 12px;
            color: var(--secondary);
        }

        .form-control-icon+.form-control {
            padding-left: 40px;
        }

        .has-icon-left .form-control {
            padding-left: 40px;
        }

        .text-danger {
            color: var(--danger);
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .text-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .page-title h2 {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            margin-bottom: 1rem;
            list-style: none;
            background-color: transparent;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .breadcrumb-item.active {
            color: var(--secondary);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            display: inline-block;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
            color: #6c757d;
            content: "/";
        }

        .bg-light-primary {
            background-color: rgba(67, 94, 190, 0.1) !important;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        #main {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (max-width: 767.98px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .d-flex {
            display: flex;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .justify-content-start {
            justify-content: flex-start;
        }

        .align-items-center {
            align-items: center;
        }

        .gap-3 {
            gap: 1rem;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .py-3 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        /* Form floating styles */
        .form-floating {
            position: relative;
        }

        .form-floating textarea.form-control {
            height: auto;
            min-height: 100px;
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }

        .form-floating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem 0.75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity .1s ease-in-out, transform .1s ease-in-out;
            color: var(--secondary);
        }

        .form-floating textarea.form-control:focus~label,
        .form-floating textarea.form-control:not(:placeholder-shown)~label {
            opacity: .65;
            transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
            background-color: white;
            padding: 0 0.5rem;
            height: auto;
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
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h2 class="mb-3">COA Management</h2>
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('index-chartofaccount') }}">COA</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New COA</li>
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
                                    <div class="card-body">
                                        <form action="{{ route('store-chartofaccount') }}" method="POST"
                                            enctype="multipart/form-data" class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="mb-2">Buat COA Baru</h3>
                                                <p class="text-muted">Silahkan isi dibawah ini untuk membuat COA baru.
                                                </p>
                                                <div class="row">
                                                    <!-- Brand Name Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="brand-name-icon">Account Number<span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2 mb-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('coa_no') ? 'is-invalid' : '' }}"
                                                                    placeholder="xxx.xxx" id="brand-name-icon"
                                                                    name="coa_no">
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
                                                            <label for="brand-name-icon">Category<span
                                                                    style="color: red">*</span></label>
                                                            <select
                                                                class="form-control select2-basic-category {{ $errors->has('coa_category_id') ? 'is-invalid' : '' }}"
                                                                name="coa_category_id" style="margin-bottom: 10px;">
                                                                <option value="" disabled
                                                                    {{ old('coa_category_id') ? '' : 'selected' }}>
                                                                    Pilih Sub Kategori</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
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
                                                            <label for="brand-name-icon">Name<span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2 mb-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Nama" id="brand-name-icon"
                                                                    name="name">
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
                                                                rows="10" placeholder="Deskripsi" name="description"></textarea>
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

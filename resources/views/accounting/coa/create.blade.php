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
        @media (max-width: 768px) {
            .select2-container {
                width: 100% !important;
                max-width: 100%;
            }
        }

        .form-group {
            width: 100%;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            width: 100%;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 38px;
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
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/coa">COA</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add COA</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="multiple-column-form">
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

                                                        <div class="form-group mt-2">
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
                                                                    Jelaskan apa yang membuat Brand Anda menonjol dan
                                                                    misinya.
                                                                </small>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <a href="{{ route('index-chartofaccount') }}" class="btn btn-sm me-1 mb-1 btn-secondary">
                                                        <i class="fa fa-arrow-left"></i> Kembali
                                                    </a>
                                                
                                                    <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">
                                                        <i class="fa fa-check"></i> Submit Brand
                                                    </button>
                                                </div>
                                                
                                            </div>
                                        </form>

                                        {{-- modal add category --}}
                                        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                                            aria-labelledby="categoryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="categoryModalLabel">Add New
                                                            Category</h4>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('store-categorycoa') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="parent_id" id="parentId">
                                                        <input type="hidden" name="type" id="categoryType"
                                                            value="category">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="category_name">Category Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control mb-2 mt-2"
                                                                    id="category_name" name="category_name"
                                                                    placeholder="Masukan Nama Kategory" required>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            @include('admin.layouts.footer')

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/n pm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                placeholder: 'Pilih Kategori',
                width: '100%',
                dropdownAutoWidth: true
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
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif

</body>

</html>

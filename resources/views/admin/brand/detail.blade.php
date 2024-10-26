<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">   
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
                                    <li class="breadcrumb-item"><a href="/brand-admin"
                                            style="text-decoration: none;">Brand</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Brand</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
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
                                                            <label for="brand-name">Brand Name <span
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
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="brand-description">Description <span
                                                                    style="color: red">*</span></label>
                                                            <textarea class="form-control" id="brand-description" rows="3" name="description">{{ old('description', $brand->description) }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Kolom Kanan -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="brand-name">Brand Code <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    id="brand-name"
                                                                    value="{{ old('name', $brand->brand_code) }}"
                                                                    disabled>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-upc"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <label for="brand-logo" class="mb-3">
                                                            Brand Logo <span style="color: red">*</span>
                                                        </label>

                                                        <div class="image-upload-wrap" id="brand-logo-upload-wrap">
                                                            <img src="{{ Storage::url($brand->brand_logo) }}"
                                                                alt="{{ $brand->name }}" class="lazyload"
                                                                style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;"
                                                                onclick="openImageInNewTab('{{ Storage::url($brand->brand_logo) }}')">
                                                        </div>

                                                        @error('brand_logo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                   
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

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Open image in a new tab
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
</body>

</html>

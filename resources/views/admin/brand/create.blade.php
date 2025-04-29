<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/brand/createbrand.css">
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
                                    <li class="breadcrumb-item"><a href="{{ route('index-brand-admin') }}">Brand</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Buat Brand</li>
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
                                        <form action="{{ route('store-brand-admin') }}" method="POST"
                                            enctype="multipart/form-data" class="form form-vertical">
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="mb-2">Buat Brand Baru</h3>
                                                <p class="text-muted">Silahkan isi dibawah ini untuk membuat Brand baru.
                                                </p>
                                                <div class="row">
                                                    <!-- Brand Name Section -->
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left">
                                                            <label for="brand-name-icon">Nama Brand<span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukkan Nama Brand (Contoh : Nike, Adidas)"
                                                                    id="brand-name-icon" name="name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('name'))
                                                                <p style="color: red">{{ $errors->first('name') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Berikan nama yang unik untuk Brand Anda yang akan
                                                                    mudah dikenali oleh pengguna.
                                                                </small>
                                                            @endif
                                                        </div>

                                                        <!-- Description Section -->
                                                        <div class="form-group">
                                                            <label for="brand-description">Deskripsi Brand <span
                                                                    style="color: red">*</span></label>
                                                            <textarea class="form-control mt-2 {{ $errors->has('description') ? 'is-invalid' : '' }}" id="brand-description"
                                                                rows="10" placeholder="Berikan deskripsi singkat tentang Brand, identitasnya, dan apa yang diwakilinya."
                                                                name="description"></textarea>
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

                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <label for="first-name-icon">Brand Logo <span
                                                                    style="color: red">*</span></label>

                                                            <div class="image-upload-wrap mt-2"
                                                                id="single-image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                                <input type="file" name="brand_logo"
                                                                    class="file-upload-input"
                                                                    {{ $errors->has('brand_logo') ? 'is-invalid' : '' }}
                                                                    onchange="readURLSingle(this);" accept="image/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a file or select to add Image</p>
                                                                </div>
                                                            </div>

                                                            <div class="file-upload-content"
                                                                id="single-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Gambar yang diunggah akan ditambahkan di sini -->
                                                            </div>

                                                            @if ($errors->has('brand_logo'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('brand_logo') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Logo Brand Anda harus dalam format gambar (misalnya,
                                                                    JPG, JPEG, PNG) dan tidak boleh melebihi 2MB.
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="reset"
                                                        class="btn btn-sm btn-light-secondary me-3 mb-1">Reset
                                                        Form</button>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary me-1 mb-1">Submit
                                                        Brand</button>
                                                </div>
                                            </div>

                                        </form>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/vendors/toastify/toastify.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

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

    {{-- Upload Single Image --}}
    <script>
        function readURLSingle(input) {
            const singleUploadContent = document.getElementById('single-file-upload-content');
            singleUploadContent.innerHTML = '';

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (!file.type.match('image.*')) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgBox = document.createElement('div');
                    imgBox.classList.add('upload__img-box-single');

                    const imgBg = document.createElement('div');
                    imgBg.classList.add('img-bg');
                    imgBg.style.backgroundImage = `url(${e.target.result})`;

                    const imgClose = document.createElement('div');
                    imgClose.classList.add('upload__img-close');
                    imgClose.onclick = function() {
                        singleUploadContent.innerHTML = '';
                        input.value = '';
                    };

                    imgBg.appendChild(imgClose);
                    imgBox.appendChild(imgBg);
                    singleUploadContent.appendChild(imgBox);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>

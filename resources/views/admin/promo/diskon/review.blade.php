<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Discount - Glamoire</title>

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

    <style>
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .upload__img-box-single,
        .upload__img-box-multiple {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .img-bg-single,
        .img-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .upload__img-close {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 2px;
            cursor: pointer;
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
                            <h3>Detail Product</h3>
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/product-admin"
                                            style="text-decoration: none;">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Product</li>
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
                                        <form class="form form-vertical"
                                            action="{{ route('update-product-admin', $promo->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- Metode PUT untuk update -->
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="product-name">Promo Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    id="product-name"
                                                                    value="{{ $promo->promo_name }}"
                                                                    name="promo_name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group has-icon-left">
                                                            <label for="product-code">Promo Code </label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    id="product-code"
                                                                    value="{{ $promo->promo_code }}"
                                                                    name="promo_code">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-upc"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="first-name-icon">Description <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" cols="30" rows="10">{{ $promo->description }}</textarea>
                                                            </div>
                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @endif
                                                        </div>
                                                                                                                                                                
                                                        <!-- Regular Price -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="regular-price">Sale Price</label>
                                                            <div class="position-relative">
                                                                <input type="text" step="0.01"
                                                                    class="form-control" id="regular-price"
                                                                    name="regular_price"
                                                                    value="Rp. {{ number_format($promo->sale_price, 0, ',', '.') }}"
                                                                    required>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-credit-card-2-front"></i>
                                                                </div>
                                                            </div>
                                                            @error('regular_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Kolom Kanan -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <!-- Main Image Upload with Drag and Drop -->
                                                        <label for="main-image" class="mb-3">Product
                                                            Thumbnail</label>
                                                        <div class="image-upload-wrap" id="single-image-upload-wrap"
                                                            style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                            <input type="file" name="main_image"
                                                                class="file-upload-input"
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
                                                            @if (!empty($promo->image))
                                                                <div class="upload__img-wrap">
                                                                    <div class="upload__img-box-single">
                                                                        <div class="img-bg-single"
                                                                            style="background-image: url('{{ asset($promo->image) }}');"
                                                                            onclick="openImageInNewTab('{{ asset($promo->image) }}')">
                                                                        </div>
                                                                        <div class="upload__img-close"
                                                                            onclick="removeImage('main_image')">
                                                                            <i
                                                                                class="bi bi-x-circle-fill text-danger"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @error('main_image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror                                                
                                                    </div>

                                                    <!-- Tombol Submit -->
                                                    <div class="col-12 d-flex justify-content-end mt-4">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1 mb-1"
                                                            style="border-radius: 8px;">Update</button>
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

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }

        // Fungsi untuk menghapus gambar utama
        function removeImage(field) {
            if (field === 'main_image') {
                document.querySelector('#single-file-upload-content').innerHTML = '';
                // Kirim permintaan AJAX untuk menghapus gambar dari server jika perlu
            } else {
                // Implementasikan penghapusan gambar galeri jika perlu
            }
        }

        // Preview untuk Main Image
        function readURLSingle(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var html = `
            <div class="upload__img-wrap">
                <div class="upload__img-box-single">
                    <div class="img-bg-single" style="background-image: url('${e.target.result}');" onclick="openImageInNewTab('${e.target.result}')"></div>
                    <div class="upload__img-close" onclick="removeImage('main_image')">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                    </div>
                </div>
            </div>
            `;
                    document.querySelector('#single-file-upload-content').innerHTML = html;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Preview untuk Multiple Images
        function handleFiles(files) {
            const fileUploadContent = document.getElementById('file-upload-content');
            const fileErrorMessage = document.getElementById('image-error');
            const fileInput = document.getElementById('images');

            fileUploadContent.innerHTML = ''; // Clear existing previews
            fileErrorMessage.style.display = 'none'; // Hide error message
            fileInput.classList.remove('is-invalid'); // Remove invalid class

            const maxFiles = 6;
            if (files.length > maxFiles) {
                fileErrorMessage.innerHTML = 'You can only upload a maximum of ' + maxFiles + ' images.';
                fileErrorMessage.style.display = 'block'; // Show error message
                fileInput.classList.add('is-invalid'); // Add invalid class
                return;
            }
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.startsWith('image/')) {
                    continue;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const html = `
            <div class="upload__img-box-multiple">
                <div class="img-bg" style="background-image: url('${e.target.result}');" onclick="openImageInNewTab('${e.target.result}')"></div>
                <div class="upload__img-close" onclick="removeUploadedImage(this)">
                    <i class="bi bi-x-circle-fill text-danger"></i>
                </div>
            </div>
            `;
                    fileUploadContent.insertAdjacentHTML('beforeend', html);
                }

                reader.readAsDataURL(file);
            }
        }

        // Menghapus gambar galeri yang diupload (frontend saja)
        function removeUploadedImage(element) {
            element.parentElement.remove();
            // Kirim permintaan AJAX untuk menghapus gambar dari server jika perlu
        }

        function readURLSingle(input) {
            const singleUploadContent = document.getElementById('single-file-upload-content');
            singleUploadContent.innerHTML = ''; // Kosongkan konten jika sudah ada gambar sebelumnya

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Buat elemen gambar
                    const imgBox = document.createElement('div');
                    imgBox.classList.add('upload__img-box-single');

                    const imgBg = document.createElement('div');
                    imgBg.classList.add('img-bg');
                    imgBg.style.backgroundImage = `url(${e.target.result})`;

                    // Tambahkan tombol close
                    const imgClose = document.createElement('div');
                    imgClose.classList.add('upload__img-close');
                    imgClose.onclick = function() {
                        singleUploadContent.innerHTML = ''; // Hapus gambar jika tombol close diklik
                        input.value = ''; // Reset input file
                    };

                    imgBg.appendChild(imgClose);
                    imgBox.appendChild(imgBg);
                    singleUploadContent.appendChild(imgBox);
                };
                reader.readAsDataURL(file);
            }
        }

        let selectedFiles = [];

        function handleFiles(files) {
            const fileUploadContent = document.getElementById('file-upload-content');
            const imageError = document.getElementById('image-error');
            const totalFiles = selectedFiles.length + files.length;

            // Reset pesan error
            imageError.style.display = 'none';
            imageError.textContent = '';

            // Kosongkan konten gambar lama
            fileUploadContent.innerHTML = '';

            // Cek jika jumlah file melebihi 6
            if (totalFiles > 6) {
                imageError.textContent = 'You can upload a maximum of 6 images.';
                imageError.style.display = 'block';
                return;
            }

            // Tambahkan file ke array selectedFiles
            selectedFiles = []; // Reset selectedFiles array
            for (let i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);
            }

            // Tampilkan gambar di form
            Array.from(files).forEach(file => {
                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Buat elemen gambar
                    const imgBox = document.createElement('div');
                    imgBox.classList.add('upload__img-box-multiple');

                    const imgBg = document.createElement('div');
                    imgBg.classList.add('img-bg');
                    imgBg.style.backgroundImage = `url(${e.target.result})`;

                    // Tambahkan tombol close
                    const imgClose = document.createElement('div');
                    imgClose.classList.add('upload__img-close');
                    imgClose.onclick = function() {
                        const index = Array.from(fileUploadContent.children).indexOf(imgBox);
                        selectedFiles.splice(index, 1);
                        fileUploadContent.removeChild(imgBox);
                    };

                    imgBg.appendChild(imgClose);
                    imgBox.appendChild(imgBg);
                    fileUploadContent.appendChild(imgBox);
                };
                reader.readAsDataURL(file);
            });
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('images');
            const dataTransfer = new DataTransfer(); // Digunakan untuk menggabungkan file di input file

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
        });
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

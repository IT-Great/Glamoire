<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

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

        .upload__img-box-single {
            position: relative;
            width: 457px;
            height: 444px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .upload__img-box-multiple {
            position: relative;
            width: 180px;
            height: 180px;
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

        /* Existing styles... */
        .upload__video-box {
            position: relative;
            width: 100%;
            max-width: 457px;
            height: auto;
            aspect-ratio: 16 / 9;
            /* Maintain aspect ratio for video */
        }

        .video-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensure the video covers the container */
        }

        .upload__video-close {
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
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/product-admin"
                                            style="text-decoration: none;">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                                            action="{{ route('update-product-admin', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- Metode PUT untuk update -->
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="product-name">Product Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    id="product-name"
                                                                    value="{{ $product->product_name }}"
                                                                    name="product_name">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group has-icon-left">
                                                            <label for="product-code">Product Code </label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control"
                                                                    id="product-code"
                                                                    value="{{ $product->product_code }}"
                                                                    name="product_code" disabled>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-upc"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="first-name-icon">Description </label>
                                                            <div class="position-relative">
                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" cols="30" rows="10">{{ $product->description }}</textarea>
                                                            </div>
                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="category-product">Category Product </label>
                                                            <div class="position-relative">
                                                                <select class="form-control select2"
                                                                    id="category-product" name="category_product_id"
                                                                    required>
                                                                    <option value="">Select Category</option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            {{ $product->categoryProduct && $product->categoryProduct->id == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <!-- Brand -->
                                                            <label for="brand-name">Brand</label>
                                                            <div class="position-relative">
                                                                <select class="form-control select2" id="brand-name"
                                                                    name="brand_id" required>
                                                                    <option value="">Select Brand</option>
                                                                    @foreach ($brands as $brand)
                                                                        <option value="{{ $brand->id }}"
                                                                            {{ $product->brand && $product->brand->id == $brand->id ? 'selected' : '' }}>
                                                                            {{ $brand->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            @error('brand_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <!-- Stock Quantity -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="stock-quantity">Stock Quantity</label>
                                                            <div class="position-relative">
                                                                <input type="number" class="form-control"
                                                                    id="stock-quantity" name="stock_quantity"
                                                                    value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                                                    required>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cart"></i>
                                                                </div>
                                                            </div>
                                                            @error('stock_quantity')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <!-- Regular Price -->
                                                        <div class="form-group has-icon-left">
                                                            <label for="regular-price">Regular Price</label>
                                                            <div class="position-relative">
                                                                <input type="text" step="0.01"
                                                                    class="form-control" id="regular-price"
                                                                    name="regular_price"
                                                                    value="Rp. {{ number_format($product->regular_price, 0, ',', '.') }}"
                                                                    required>

                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-credit-card-2-front"></i>
                                                                </div>
                                                            </div>
                                                            @error('regular_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="">Weight Product</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="Weight Product" name="weight_product"
                                                                value="{{ $product->weight_product }}">
                                                            <span class="input-group-text"
                                                                id="basic-addon2">gram</span>
                                                        </div>

                                                        <label for="">Dimension Product</label>
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Length" name="length"
                                                                        value="{{ $product->dimensions['length'] }}">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">cm</span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Width" name="width"
                                                                        value="{{ $product->dimensions['width'] }}">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon2">cm</span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Height" name="height"
                                                                        value="{{ $product->dimensions['height'] }}">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon3">cm</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="mt-4">
                                                            <h4 class="card-title">Variant Product</h4>
                                                            <p class="card-subtitle">Add variants so that buyers can
                                                                choose the right product! You can enter up to 2 types of
                                                                variants.</p>
                                                        </div>

                                                        <div class="mt-3">
                                                            <div id="variant-container">
                                                                <div class="variant-type mb-4 p-3 border rounded">
                                                                    <label>Tipe Variant</label>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <select
                                                                            class="select2-add-option form-select me-2"
                                                                            name="variant_type[]">
                                                                            <option value="rasa">Rasa</option>
                                                                            <option value="ukuran">Ukuran</option>
                                                                            <option value="warna">Warna</option>
                                                                        </select>
                                                                    </div>
                                                                    <label class="form-label">Variant Values</label>
                                                                    <div class="variant-values">
                                                                        <select
                                                                            class="select2 form-select multiple-remove"
                                                                            name="variant_values[0][]"
                                                                            multiple="multiple"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Area untuk upload gambar yang tersembunyi awalnya -->
                                                            <div class="variant-images mt-3" style="display: none;">
                                                                <input type="file"
                                                                    class="form-control variant-image-upload"
                                                                    accept="image/*">
                                                            </div>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addVariantType">+ Add Product Variant</button>
                                                        </div> --}}

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
                                                                <p>Drag and drop a file or select to Update Image</p>
                                                            </div>
                                                        </div>

                                                        <div class="file-upload-content"
                                                            id="single-file-upload-content"
                                                            style="display: flex; flex-wrap: wrap;">
                                                            @if (!empty($product->main_image))
                                                                <div class="upload__img-wrap">
                                                                    <div class="upload__img-box-single">
                                                                        <div class="img-bg-single"
                                                                            style="background-image: url('{{ Storage::url($product->main_image) }}');"
                                                                            onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @error('main_image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <!-- Adding margin between Thumbnail and Gallery -->
                                                        <label for="product-gallery" class="mb-3 mt-4">Product
                                                            Gallery</label>
                                                        <div class="image-upload-wrap" id="image-upload-wrap"
                                                            style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                            <input type="file" id="images" name="images[]"
                                                                class="file-upload-input"
                                                                onchange="handleFiles(this.files);" accept="image/*"
                                                                multiple
                                                                style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                            <div class="drag-text"
                                                                style="text-align: center; color: #888;">
                                                                <p>Drag and drop a file or select to Update Image(s)</p>
                                                            </div>
                                                        </div>

                                                        <span id="image-error" class="invalid-feedback"
                                                            style="display: none; color: red;"></span>

                                                        <div class="file-upload-content upload__img-wrap"
                                                            id="file-upload-content"
                                                            style="display: flex; flex-wrap: wrap;">
                                                            @if (!empty($product->images) && is_array($product->images))
                                                                @foreach ($product->images as $image)
                                                                    <div class="upload__img-box-multiple">
                                                                        <div class="img-bg"
                                                                            style="background-image: url('{{ Storage::url($image) }}');"
                                                                            onclick="openImageInNewTab('{{ Storage::url($image) }}')">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>


                                                        @error('images')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <!-- Video Upload -->
                                                        <label for="video-upload" class="mb-3 mt-4">Product
                                                            Video</label>
                                                        <div class="image-upload-wrap" id="video-upload-wrap"
                                                            style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                            <input type="file" name="video"
                                                                class="file-upload-input"
                                                                onchange="handleVideoUpload(this);" accept="video/*"
                                                                style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                            <div class="drag-text"
                                                                style="text-align: center; color: #888;">
                                                                <p>Drag and drop a video or select to Update Video</p>
                                                            </div>
                                                        </div>

                                                        <div class="file-upload-content"
                                                            id="video-file-upload-content"
                                                            style="display: flex; flex-wrap: wrap;">
                                                            @if (!empty($product->video))
                                                                <div class="upload__video-box">
                                                                    <video class="video-bg" controls>
                                                                        <source
                                                                            src="{{ Storage::url($product->video) }}"
                                                                            type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>

                                                                </div>
                                                            @endif
                                                        </div>
                                                        @error('video')
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

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }

        // Fungsi untuk menghapus gambar utama
        function removeImage(field) {
            if (field === 'main_image') {
                document.querySelector('#single-file-upload-content').innerHTML = '';
                // Tambahkan input kembali jika diperlukan
            } else {
                // Implementasikan penghapusan gambar galeri jika perlu
                // Anda mungkin perlu mengirim permintaan AJAX untuk menghapus gambar dari server
                // Atau, gunakan JavaScript untuk menghapus tampilan gambar di frontend
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
                    continue
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
            // Jika Anda ingin menghapus dari server, Anda perlu mengimplementasikan AJAX
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Drag and drop untuk Main Image
            const singleImageUploadWrap = document.getElementById('single-image-upload-wrap');
            singleImageUploadWrap.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                singleImageUploadWrap.style.borderColor = '#3f51b5';
            });

            singleImageUploadWrap.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                singleImageUploadWrap.style.borderColor = '#ddd';
            });

            singleImageUploadWrap.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                singleImageUploadWrap.style.borderColor = '#ddd';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    // Hanya ambil file pertama untuk gambar utama
                    readURLSingle({
                        files: [files[0]]
                    });
                }
            });

            // Drag and drop untuk Gallery Images
            const imageUploadWrap = document.getElementById('image-upload-wrap');
            imageUploadWrap.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                imageUploadWrap.style.borderColor = '#3f51b5';
            });

            imageUploadWrap.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                imageUploadWrap.style.borderColor = '#ddd';
            });

            imageUploadWrap.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                imageUploadWrap.style.borderColor = '#ddd';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFiles(files);
                }
            });
        });
        
    </script>  --}}

    {{-- last update --}}
    {{-- <script>
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
    </script> --}}

    <!-- Include jQuery (if not included already) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Tambahkan titik setiap 3 digit
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        document.getElementById('regular-price').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });
    </script>

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
            }
        }

        // Preview untuk Main Image
        function readURLSingle(input) {
            const singleUploadContent = document.getElementById('single-file-upload-content');
            singleUploadContent.innerHTML = ''; // Kosongkan konten jika sudah ada gambar sebelumnya

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
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
            const maxFiles = 6;

            // Reset pesan error
            imageError.style.display = 'none';
            imageError.textContent = '';

            // Kosongkan konten gambar lama
            fileUploadContent.innerHTML = '';

            // Cek jika jumlah file melebihi 6
            if (files.length > maxFiles) {
                imageError.textContent = 'You can upload a maximum of ' + maxFiles + ' images.';
                imageError.style.display = 'block';
                return;
            }

            // Tampilkan gambar di form
            Array.from(files).forEach(file => {
                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
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

    {{-- hanlde video --}}
    <script>
        function handleVideoUpload(input) {
            const videoUploadContent = document.getElementById('video-file-upload-content');
            if (input.files && input.files[0]) {
                const video = document.createElement('video');
                video.controls = true;
                video.width = 300;
                const source = document.createElement('source');
                source.src = URL.createObjectURL(input.files[0]);
                source.type = input.files[0].type;
                video.appendChild(source);
                videoUploadContent.innerHTML = ''; // Clear previous content
                videoUploadContent.appendChild(video);
            }
        }

        function removeVideo(url) {
            if (confirm('Are you sure you want to remove this video?')) {
                const videoUploadContent = document.getElementById('video-file-upload-content');
                videoUploadContent.innerHTML = '';
                document.querySelector('input[name="video"]').value = ''; // Clear input value
            }
        }
    </script>


    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- toastify -->
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/product/createproduct.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .flatpickr-calendar {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .flatpickr-day.selected {
            background: #3b82f6;
            border-color: #3b82f6;
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
                                    <li class="breadcrumb-item"><a href="/product-admin">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buat Product</li>
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
                                        <form action="{{ route('store-product-admin') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="mb-3">Buat Product Baru</h3>
                                                <p class="text-muted">Silahkan isi detail dibawah ini untuk membuat
                                                    Produk baru</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="first-name-icon">Nama Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukan Nama Produk"
                                                                    id="first-name-icon" name="product_name"
                                                                    value="{{ old('product_name') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('product_name'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('product_name') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Masukkan nama yang unik dan
                                                                    deskriptif untuk produk yang mudah diidentifikasi
                                                                    oleh pelanggan.</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Sub Kategori <span
                                                                    style="color: red">*</span></label>
                                                            <div class="form-group mt-2">
                                                                <select
                                                                    class="form-control select2-basic-category {{ $errors->has('category_product_id') ? 'is-invalid' : '' }}"
                                                                    name="category_product_id">
                                                                    <option value="" disabled
                                                                        {{ old('category_product_id') ? '' : 'selected' }}>
                                                                        Pilih Sub Kategori</option>
                                                                    @foreach ($subcategories as $subcategory)
                                                                        <option value="{{ $subcategory->id }}"
                                                                            {{ old('category_product_id') == $subcategory->id ? 'selected' : '' }}>
                                                                            {{ $subcategory->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('category_product_id'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('category_product_id') }}
                                                                    </p>
                                                                @else
                                                                    <small class="text-muted"
                                                                        style="font-size: 14px;">Pilih Sub Kategori yang
                                                                        sesuai atau tambahkan Sub Kategori yang baru
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="first-name-icon">Brand <span
                                                                    style="color: red">*</span></label>
                                                            <div class="form-group mt-2">
                                                                <select
                                                                    class="form-control select2-basic-brand {{ $errors->has('brand_id') ? 'is-invalid' : '' }}"
                                                                    name="brand_id">
                                                                    <option value="" disabled
                                                                        {{ old('brand_id') ? '' : 'selected' }}>Pilih 
                                                                        Brand</option>
                                                                    @foreach ($brands as $brand)
                                                                        <option value="{{ $brand->id }}"
                                                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                                            {{ $brand->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('brand_id'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('brand_id') }}</p>
                                                                @else
                                                                    <small class="text-muted"
                                                                        style="font-size: 14px;">Pilih Brand yang sesuai
                                                                        atau tambahkan Brand yang baru</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- product code auto --}}
                                                        <input type="hidden" id="product-code-input"
                                                            name="product_code">

                                                        <div class="mb-4">
                                                            <label for="first-name-icon">Deskripsi Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                                            </div>
                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Berikan secara rinci
                                                                    deskripsi produk Anda, dengan fokus pada fitur,
                                                                    manfaat, dan keunikan penjualan poin.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="first-name-icon">Informasi Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <textarea class="form-control {{ $errors->has('information_product') ? 'is-invalid' : '' }}"
                                                                    name="information_product" id="information_product" cols="30" rows="10">{{ old('information_product') }}</textarea>
                                                            </div>
                                                            @if ($errors->has('information_product'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('information_product') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Berikan teknis rinci
                                                                    atau informasi produk tertentu seperti
                                                                    spesifikasi, bahan, garansi, atau penggunaan
                                                                    instruksi.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-4">
                                                            <h4 class="card-title">Variasi Produk</h4>
                                                            <p class="card-subtitle">Tambahkan variasi agar pembeli
                                                                bisa
                                                                memilih produk yang tepat! Anda dapat memasukkan hingga
                                                                2 jenis
                                                                varian.</p>
                                                        </div>

                                                        <div class="mt-3">
                                                            <div id="variant-container">
                                                                <div class="variant-type mb-4 p-3 border rounded">
                                                                    <label>Tipe Variasi</label>
                                                                    <div class="d-flex align-items-center mt-2">
                                                                        <select
                                                                            class="select2-add-option form-select me-2"
                                                                            name="variant_type[]">
                                                                            <option value="warna">Warna</option>
                                                                            <option value="aroma">Aroma</option>
                                                                            <option value="rasa">Rasa</option>
                                                                            <option value="ukuran">Ukuran</option>
                                                                            <option value="bahan">Bahan</option>
                                                                            <option value="tekstur">Tekstur</option>
                                                                            <option value="desain">Desain</option>
                                                                            <option value="durabilitas">Durabilitas</option>
                                                                            <option value="fungsionalitas">Fungsionalitas</option>
                                                                        </select>
                                                                    </div>
                                                                    <small class="text-muted">Pilih jenis variasi atau
                                                                        tambahkan yang baru jika Anda tidak menemukan
                                                                        yang cocok dengan
                                                                        pilihan.</small>

                                                                    <div class="variant-values">
                                                                        <label class="form-label mt-4">Nilai
                                                                            Variasi</label>

                                                                        <select
                                                                            class="select2 form-select multiple-remove"
                                                                            name="variant_values[0][]"
                                                                            multiple="multiple"></select>
                                                                    </div>
                                                                    <small class="text-muted">Pilih nilai varian atau
                                                                        tambahkan yang baru jika menurut Anda tidak
                                                                        cocok dengan
                                                                        pilihan.</small>
                                                                </div>
                                                            </div>
                                                            <!-- Hidden image upload area -->
                                                            <div class="variant-images mt-3" style="display: none;">
                                                                <input type="file"
                                                                    class="form-control variant-image-upload"
                                                                    accept="image/*">
                                                            </div>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="addVariantType">+ Tambah Produk Variasi</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="first-name-icon">Stock Produk <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                                                    placeholder="Masukan Stock Produk"
                                                                    id="first-name-icon" name="stock_quantity"
                                                                    value="{{ old('stock_quantity') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cart"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('stock_quantity'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('stock_quantity') }}</p>
                                                            @else
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Masukkan jumlah total
                                                                    item dalam stok. Hal Ini dapat membantu melacak
                                                                    inventaris
                                                                    tingkat.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="first-name-icon">Regular Price <span
                                                                    style="color: red">*</span></label>
                                                            <div class="input-group mt-2">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('regular_price') ? 'is-invalid' : '' }}"
                                                                    placeholder="x.xxx.xxx" id="regular-price"
                                                                    name="regular_price"
                                                                    value="{{ old('regular_price') }}">

                                                            </div>
                                                            @if ($errors->has('regular_price'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('regular_price') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Mengatur
                                                                    harga jual produk dengan
                                                                    format x.xxx.xxx (Rupiah).</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="">Berat Produk</label>
                                                            <div class="input-group mt-2">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Masukkan Berat Produk" name="weight_product"
                                                                    value="{{ old('weight_product') }}">
                                                                <span class="input-group-text"
                                                                    id="basic-addon2">gram</span>

                                                            </div>
                                                            <small class="form-text text-muted">Tentukan berat
                                                                produk untuk perhitungan pengiriman.</small>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="">Dimensi Produk</label>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Length" name="length"
                                                                            value="{{ old('length') }}">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon1">cm</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Width" name="width"
                                                                            value="{{ old('width') }}">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon2">cm</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Height" name="height"
                                                                            value="{{ old('height') }}">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon3">cm</span>
                                                                    </div>
                                                                </div>
                                                                <small class="form-text text-muted">Masukkan
                                                                    dimensi dari produk untuk perkiraan pengiriman yang
                                                                    akurat.</small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group has-icon-left mb-4">
                                                            <label for="date_expired">Date Expired</label>
                                                            <div class="position-relative mt-2">
                                                                <input type="text"
                                                                    class="datepicker form-control {{ $errors->has('date_expired') ? 'is-invalid' : '' }}"
                                                                    id="date_expired" name="date_expired"
                                                                    placeholder="Masukan Expired Produk" required>
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar"></i>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('date_expired'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('date_expired') }}</p>
                                                            @else
                                                                <small class="form-text text-muted"
                                                                    style="font-size: 14px;">Silakan masukkan
                                                                    tanggal kadaluwarsa produk</small>
                                                            @endif
                                                        </div>

                                                        {{-- single image --}}
                                                        <div class="card">
                                                            <label for="first-name-icon">Product Thumbnail<span
                                                                    style="color: red"> *</span></label>
                                                            <div class="image-upload-wrap mt-2"
                                                                id="single-image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                                <input type="file" name="main_image"
                                                                    class="file-upload-input"
                                                                    onchange="readURLSingle(this);" accept="image/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a file or select to add Image
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <span id="main-image-error"
                                                                style="color: red; display: none;"></span>
                                                            <!-- Unik untuk Single Image -->

                                                            <div class="file-upload-content"
                                                                id="single-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Gambar yang diunggah akan ditambahkan di sini -->
                                                            </div>

                                                            @if ($errors->has('main_image'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('main_image') }}</p>
                                                            @else
                                                                <small class="form-text text-muted">Unggah gambar yang
                                                                    jelas dan berkualitas tinggi yang paling mewakili
                                                                    produk Anda. Gambar ini akan menjadi gambar utama
                                                                    yang ditampilkan dalam hasil pencarian. Gunakan
                                                                    format file JPG, JPEG, atau PNG, dan pastikan ukuran
                                                                    file tidak lebih dari 2MB. Ukuran gambar sebaiknya
                                                                    1024x1024 piksel.</small>
                                                            @endif
                                                        </div>

                                                        {{-- multiple image --}}
                                                        <div class="card">
                                                            <label for="first-name-icon">Product Gallery multiple
                                                                <span style="color: red">*</span></label>
                                                            <div class="image-upload-wrap mt-2" id="image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                                <input type="file" id="images" name="images[]"
                                                                    class="file-upload-input"
                                                                    {{ $errors->has('images[]') ? 'is-invalid' : '' }}
                                                                    onchange="handleFiles(this.files);"
                                                                    accept="image/*" multiple
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop files or select add Image(s)
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- Tempat pesan error -->
                                                            <span id="image-error"
                                                                style="color: red; display: none;"></span>

                                                            <div class="file-upload-content upload__img-wrap"
                                                                id="file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Gambar yang diunggah akan ditambahkan di sini -->
                                                            </div>

                                                            @if ($errors->has('images'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('images') }}</p>
                                                            @else
                                                                <small class="form-text text-muted">Tambahkan gambar
                                                                    tambahan untuk menampilkan sudut atau fitur berbeda
                                                                    dari produk Anda. Anda dapat mengunggah beberapa
                                                                    gambar sekaligus. Gunakan format gambar JPG, JPEG,
                                                                    atau PNG, dengan ukuran file tidak melebihi 2MB.
                                                                    Ukuran gambar sebaiknya 1024x1024 piksel, dan
                                                                    maksimal 6 gambar dapat diunggah.</small>
                                                            @endif
                                                        </div>

                                                        <div class="card">
                                                            <label for="video-upload">Upload Video</label>
                                                            <div class="video-upload-wrap mt-2"
                                                                id="video-upload-wrap">
                                                                <input type="file" id="video" name="video"
                                                                    class="file-upload-input"
                                                                    onchange="readURLVideo(this);" accept="video/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a video file or select to upload
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <span id="video-error"
                                                                style="color: red; display: none;"></span>

                                                            <div class="file-upload-content"
                                                                id="video-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Video that is uploaded will be added here -->
                                                            </div>

                                                            <small class="form-text text-muted">Unggah video singkat
                                                                untuk menunjukkan produk Anda sedang digunakan. Ini
                                                                dapat secara signifikan meningkatkan minat pembeli.
                                                                Format video yang diunggah harus MP4, dan ukuran file
                                                                tidak boleh melebihi 5MB.</small>
                                                        </div>

                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mt-5">
                                                            <h4 class="card-title">Tabel Variasi Produk</h4>
                                                            <p class="card-subtitle">Kelola detail variasi termasuk
                                                                harga, stok, berat, dan status untuk setiap varian.
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered variant-table mt-3">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Image</th>
                                                                            <th>Type Variant</th>
                                                                            <th>Price</th>
                                                                            <th>Stock</th>
                                                                            <th>Weight (grams)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="variant-table-body">
                                                                        <!-- Additional rows will be dynamically added here -->
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end mt-4">
                                                        <button type="reset"
                                                            class="btn btn-sm btn-light-secondary me-2 mb-1"
                                                            style="border-radius: 5px;">Reset Product</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1 mb-1"
                                                            id="submitButton">Submit Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Modal untuk Add New Subcategory -->
                                        <div class="modal fade" id="addSubcategoryModal" tabindex="-1"
                                            aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addSubcategoryModalLabel">Add New
                                                            Subcategory</h5>

                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label>Select Category <span
                                                                    style="color: red">*</span></label>
                                                            <select class="form-control select2-category-modal"
                                                                id="categorySelect">
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            <small class="text-muted" style="font-size: 14px;">
                                                                Please select a category first before adding a
                                                                subcategory.
                                                            </small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Subcategory Name <span
                                                                    style="color: red">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="newSubcategoryName">

                                                            <small class="text-muted" style="font-size: 14px;">
                                                                Please enter a unique Subcategory
                                                                name to help organize your
                                                                products efficiently.
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="saveNewSubcategory">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal untuk Add New Brand -->
                                        <div class="modal fade" id="addBrandModal" tabindex="-1"
                                            aria-labelledby="addBrandModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addBrandModalLabel">Add New Brand
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="brandForm" enctype="multipart/form-data">
                                                            <div class="form-group mb-3">
                                                                <label>Brand Name <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="newBrandName" name="name">
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Give
                                                                    your brand a distinct
                                                                    name that users will recognize.</small>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Description <span
                                                                        style="color: red">*</span></label>
                                                                <textarea class="form-control" id="newBrandDescription" name="description"></textarea>
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Describe what makes your
                                                                    brand
                                                                    stand out and its mission.</small>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Brand Logo <span
                                                                        style="color: red">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    id="newBrandLogo" name="brand_logo"
                                                                    accept="image/*">
                                                                <small class="text-muted" style="font-size: 14px;">
                                                                    Your brand logo should be in image format (e.g.,
                                                                    JPG, JPEG, PNG) and should not exceed 2MB in size.
                                                                </small>
                                                            </div>

                                                            <div id="imagePreview" class="mt-2"
                                                                style="display: none;">
                                                                <img id="preview" src="" alt="Preview"
                                                                    style="max-width: 200px; max-height: 200px;">


                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="saveNewBrand">Save</button>
                                                    </div>
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
    <!-- Include jQuery dan jQuery UI CSS dan JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/product/createproduct.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // handle brand
        $(document).ready(function() {
            // Inisialisasi Select2 untuk brand
            $('.select2-basic-brand').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select a Brand",
                allowClear: true,
                dropdownParent: $('.select2-basic-brand').parent(),
                tags: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");
                    $result.text(data.text);

                    if (data.newOption) {
                        $result.append(" <em>(Press Enter to Add New)</em>");
                    }

                    return $result;
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;

                if (data.newOption) {
                    // Reset selection
                    $('.select2-basic-brand').val(null).trigger('change');

                    // Reset modal form dan error states
                    $('#brandForm')[0].reset();
                    $('#newBrandName').val(data.text);
                    $('#imagePreview').hide();
                    clearErrors();

                    // Show modal
                    $('#addBrandModal').modal('show');
                }
            });

            // Preview image before upload
            $('#newBrandLogo').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                        $('#imagePreview').show();
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Function to clear errors
            function clearErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $('.error-message').remove();
            }

            // Function to show errors
            function showErrors(errors) {
                clearErrors();

                Object.keys(errors).forEach(function(field) {
                    const element = $(`#new${field.charAt(0).toUpperCase() + field.slice(1)}`);
                    const errorMessage = errors[field][0];

                    // Add error class
                    element.addClass('is-invalid');

                    // Add error message
                    element.after(`<div class="invalid-feedback error-message">${errorMessage}</div>`);
                });

                // Show toast message for first error
                const firstError = Object.values(errors)[0][0];
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: `Error: ${firstError}`,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            }

            // Handle save new brand
            $('#saveNewBrand').click(function() {
                clearErrors();

                var formData = new FormData();
                formData.append('name', $('#newBrandName').val());
                formData.append('description', $('#newBrandDescription').val());
                formData.append('brand_logo', $('#newBrandLogo')[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                if (!$('#newBrandName').val() || !$('#newBrandDescription').val() || !$('#newBrandLogo')[0]
                    .files[0]) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: 'Please fill in all required fields',
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('store-brand-admin') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Add new option to select2
                            var newOption = new Option($('#newBrandName').val(), response.data
                                .id, true, true);
                            $('.select2-basic-brand').append(newOption).trigger('change');

                            // Close modal
                            $('#addBrandModal').modal('hide');

                            // Reset form
                            $('#brandForm')[0].reset();
                            $('#imagePreview').hide();
                            clearErrors();

                            // Show success message
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'success',
                                title: 'Brand has been added successfully!',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Validation errors
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            // Other errors
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'error',
                                title: xhr.responseJSON?.message ||
                                    'Failed to add brand',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    }
                });
            });
        });

        // handle category
        $(document).ready(function() {
            // Inisialisasi Select2 untuk category di modal
            $('.select2-category-modal').select2({
                width: '100%',
                dropdownParent: $('#addSubcategoryModal')
            });

            // Function to clear errors
            function clearErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                $('.error-message').remove();
            }

            // Function to show errors
            function showErrors(errors) {
                clearErrors();

                Object.keys(errors).forEach(function(field) {
                    const element = $(`#${field}`);
                    const errorMessage = errors[field][0];

                    // Add error class
                    element.addClass('is-invalid');

                    // Add error message
                    element.after(`<div class="invalid-feedback error-message">${errorMessage}</div>`);
                });

                // Show toast message for first error
                const firstError = Object.values(errors)[0][0];
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: `Error: ${firstError}`,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            }

            // Inisialisasi Select2 untuk subcategory
            $('.select2-basic-category').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select a subcategory",
                allowClear: true,
                dropdownParent: $('.select2-basic-category').parent(),
                tags: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");
                    $result.text(data.text);

                    if (data.newOption) {
                        $result.append(" <em>(Press Enter to Add New)</em>");
                    }

                    return $result;
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;

                if (data.newOption) {
                    // Reset selection
                    $('.select2-basic-category').val(null).trigger('change');

                    // Reset modal form dan error states
                    $('#categorySelect').val('').trigger('change');
                    $('#newSubcategoryName').val(data.text);
                    clearErrors();

                    // Show modal
                    $('#addSubcategoryModal').modal('show');
                }
            });

            // Handle save new subcategory
            $('#saveNewSubcategory').click(function() {
                clearErrors();

                var categoryId = $('#categorySelect').val();
                var subcategoryName = $('#newSubcategoryName').val();

                if (!categoryId || !subcategoryName) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: 'Please fill in all required fields',
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('create-category-product') }}',
                    method: 'POST',
                    data: {
                        name: subcategoryName,
                        parent_id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Add new option to select2
                            var newOption = new Option(subcategoryName, response.data.id, true,
                                true);
                            $('.select2-basic-category').append(newOption).trigger('change');

                            // Close modal
                            $('#addSubcategoryModal').modal('hide');

                            // Reset form
                            $('#categorySelect').val('').trigger('change');
                            $('#newSubcategoryName').val('');
                            clearErrors();

                            // Show success message
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'success',
                                title: 'Subcategory has been added successfully!',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Validation errors
                            showErrors(xhr.responseJSON.errors);
                        } else {
                            // Other errors
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                icon: 'error',
                                title: xhr.responseJSON?.message ||
                                    'Failed to add subcategory',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>

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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/vendors/toastify/toastify.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/product/createproduct.css">

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
                                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
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
                                        <form action="{{ route('store-product-admin') }}" class="form form-vertical"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="mb-3">Create a New Product</h3>
                                                <p class="text-muted">Please fill in the details below to create a new
                                                    product.</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-3">
                                                            <label for="first-name-icon">Product Name <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Product Name"
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
                                                                <small class="text-muted" style="font-size: 14px;">Give
                                                                    your brand a distinct
                                                                    name that users will recognize.</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="first-name-icon">List Sub Category <span
                                                                    style="color: red">*</span></label>
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control select2-basic-category {{ $errors->has('category_product_id') ? 'is-invalid' : '' }}"
                                                                    name="category_product_id">
                                                                    <option value="" disabled
                                                                        {{ old('category_product_id') ? '' : 'selected' }}>
                                                                        Select List Sub Category</option>
                                                                    <!-- Placeholder -->
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
                                                                        style="font-size: 14px;">Select the
                                                                        appropriate sub-category for your
                                                                        product.</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="first-name-icon">Brand <span
                                                                    style="color: red">*</span></label>
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control select2-basic-brand {{ $errors->has('brand_id') ? 'is-invalid' : '' }}"
                                                                    name="brand_id">
                                                                    <option value="" disabled
                                                                        {{ old('brand_id') ? '' : 'selected' }}>Select
                                                                        Brand</option> <!-- Placeholder -->
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
                                                                        style="font-size: 14px;">Choose the brand
                                                                        associated with this product.</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- product code auto --}}
                                                        <input type="hidden" id="product-code-input"
                                                            name="product_code">

                                                        <div class="mb-3">
                                                            <label for="first-name-icon">Description <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                                                    id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                                            </div>
                                                            @if ($errors->has('description'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('description') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Provide a detailed
                                                                    description of your product, focusing on key
                                                                    features, benefits, and unique selling
                                                                    points.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="first-name-icon">Information Product <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <textarea class="form-control {{ $errors->has('information_product') ? 'is-invalid' : '' }}"
                                                                    name="information_product" id="information_product" cols="30" rows="10">{{ old('information_product') }}</textarea>
                                                            </div>
                                                            @if ($errors->has('information_product'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('information_product') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Provide detailed technical
                                                                    or specific product information such as
                                                                    specifications, materials, warranty, or usage
                                                                    instructions.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mt-4">
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
                                                                            <option value="warna">Warna</option>
                                                                            <option value="aroma">Aroma</option>
                                                                            <option value="rasa">Rasa</option>
                                                                            <option value="ukuran">Ukuran</option>
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
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left mb-3">
                                                            <label for="first-name-icon">Stock Quantity <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Stock Quantity"
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
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Give
                                                                    your brand a distinct
                                                                    name that users will recognize.</small>
                                                            @endif
                                                        </div>


                                                        <div class="form-group has-icon-left mb-3">
                                                            <label for="first-name-icon">Regular Price <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('regular_price') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Regular Price"
                                                                    id="regular-price" name="regular_price"
                                                                    value="{{ old('regular_price') }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-cash-stack"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('regular_price'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('regular_price') }}</p>
                                                            @else
                                                                <small class="text-muted"
                                                                    style="font-size: 14px;">Give
                                                                    your brand a distinct
                                                                    name that users will recognize.</small>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Weight Product</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Weight Product" name="weight_product"
                                                                    value="{{ old('weight_product') }}">
                                                                <span class="input-group-text"
                                                                    id="basic-addon2">gram</span>

                                                            </div>
                                                            <small class="form-text text-muted">Specify the weight of
                                                                the product for shipping calculations.</small>
                                                        </div>

                                                        <label for="">Dimension Product</label>
                                                        <div class="row mb-3">
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
                                                            <small class="form-text text-muted">Enter the dimensions of
                                                                your
                                                                product for accurate shipping estimates.</small>
                                                        </div>

                                                        {{-- single image --}}
                                                        <div class="card">
                                                            <label for="first-name-icon">Product Thumbnail<span
                                                                    style="color: red"> *</span></label>
                                                            <div class="image-upload-wrap"
                                                                id="single-image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                                                <input type="file" name="main_image"
                                                                    class="file-upload-input"
                                                                    {{ $errors->has('main_image') ? 'is-invalid' : '' }}
                                                                    onchange="readURLSingle(this);" accept="image/*"
                                                                    style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                                                <div class="drag-text"
                                                                    style="text-align: center; color: #888;">
                                                                    <p>Drag and drop a file or select to add Image
                                                                    </p>
                                                                </div>

                                                            </div>

                                                            <div class="file-upload-content"
                                                                id="single-file-upload-content"
                                                                style="display: flex; flex-wrap: wrap;">
                                                                <!-- Gambar yang diunggah akan ditambahkan di sini -->
                                                            </div>

                                                            @if ($errors->has('main_image'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('main_image') }}</p>
                                                            @else
                                                                <small class="form-text text-muted">Upload a clear,
                                                                    high-quality image that best represents your
                                                                    product. This will be the main image shown in search
                                                                    results. For file formats, please use JPG, JPEG, or
                                                                    PNG, and ensure the size is no more than
                                                                    2MB.</small>
                                                            @endif
                                                        </div>

                                                        {{-- multiple image --}}
                                                        <div class="card">
                                                            <label for="first-name-icon">Product Gallery multiple
                                                                <span style="color: red">*</span></label>
                                                            <div class="image-upload-wrap" id="image-upload-wrap"
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
                                                                <small class="form-text text-muted">Add additional
                                                                    images to showcase different angles or features of
                                                                    your product. You can upload multiple images at
                                                                    once. For image format, use JPG, JPEG, or PNG, with
                                                                    a file size not exceeding 2MB, and a maximum of 6
                                                                    images can be uploaded.</small>
                                                            @endif
                                                        </div>

                                                        <div class="card">
                                                            <label for="video-upload">Upload Video</label>
                                                            <div class="video-upload-wrap" id="video-upload-wrap">
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

                                                            <small class="form-text text-muted">Upload a short video to
                                                                demonstrate your product in action. This can
                                                                significantly increase buyer interest. The uploaded
                                                                video format must be MP4, and the file size should not
                                                                exceed 5MB</small>
                                                        </div>

                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mt-5">
                                                            <h4 class="card-title">Table Variant</h4>
                                                            <p class="card-subtitle">Manage variant details including
                                                                price, stock, weight, and status for each variant.
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered variant-table">
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

                                                    <div class="col-12 d-flex justify-content-end">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/product/createproduct.js"></script>
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

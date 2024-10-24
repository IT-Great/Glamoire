<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Voucher - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/product/createproduct.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box-multiple {
            width: 195px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-box-single {
            width: 175px;
            /* Mengatur lebar sesuai permintaan */
            height: 177px;
            /* Mengatur tinggi sesuai permintaan */
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
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
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo-voucher') }}">Voucher</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Promo Store Voucher
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <h3 class="mb-2">Update Voucher</h3>
                        <p class="mb-3">
                            Update a Store Voucher or Product Voucher now to attract Buyers.
                            <a href="#" class="text-blue">Learn More</a>
                        </p>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('update-promo-brand-voucher', $promo->id) }}"
                                            class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="type" value="brand voucher">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Voucher Name <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                                                                    placeholder="Enter Voucher Name"
                                                                    id="first-name-icon" name="promo_name"
                                                                    value="{{ $promo->promo_name }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-bag"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('promo_name'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('promo_name') }}
                                                                </p>
                                                            @else
                                                                <small class="form-text text-muted"
                                                                    style="font-size: 14px;">Enter the name of
                                                                    the voucher. This will be displayed to
                                                                    users.</small>
                                                            @endif
                                                        </div>

                                                        <div class="form-group has-icon-left">
                                                            <label for="daterange">Date Range <span
                                                                    style="color: red">*</span></label>
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                                                    id="daterange" name="date_range"
                                                                    value="{{ $promo->date_range }}">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-calendar"></i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('date_range'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('date_range') }}
                                                                </p>
                                                            @else
                                                                <small class="form-text text-muted"
                                                                    style="font-size: 14px;">Select the start and
                                                                    end dates for the voucher validity. Use the format:
                                                                    MM/DD/YYYY.</small>
                                                            @endif
                                                        </div>


                                                        <label for="promo_code" class="form-label">Voucher Code <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group input-group-sm mb-3">
                                                            <span class="input-group-text">Glam</span>
                                                            <input type="text" class="form-control"
                                                                id="promo_code" name="promo_code"
                                                                value="{{ $promo->promo_code }}">

                                                            <small class="form-text text-muted"
                                                                style="font-size: 14px;">
                                                                Enter a combination of numbers and letters from 0-9 and
                                                                a-z, and it should only be 5 digits long.
                                                            </small>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <label for="usage_quota">Max Usage Quota <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('usage_quota') ? 'is-invalid' : '' }}"
                                                                    placeholder="e.g., 100 times" name="usage_quota"
                                                                    id="usage_quota" style="margin-bottom: 4px;"
                                                                    value="{{ $promo->usage_quota }}">
                                                                <small class="form-text text-muted">Enter the maximum
                                                                    number of times this item can be used (e.g., 100,
                                                                    200).</small>
                                                                @if ($errors->has('usage_quota'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('usage_quota') }}</p>
                                                                @endif
                                                            </div>

                                                            <div class="col">
                                                                <label for="max_quantity_buyer">Max Quantity Per Buyer
                                                                    <span style="color: red">*</span></label>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('max_quantity_buyer') ? 'is-invalid' : '' }}"
                                                                    placeholder="e.g., 5 items per buyer"
                                                                    name="max_quantity_buyer" id="max_quantity_buyer"
                                                                    style="margin-bottom: 4px;"
                                                                    value="{{ $promo->max_quantity_buyer }}">
                                                                <small class="form-text text-muted">Specify the maximum
                                                                    number of items a single buyer can purchase (e.g.,
                                                                    1, 5, 10).</small>
                                                                @if ($errors->has('max_quantity_buyer'))
                                                                    <p style="color: red">
                                                                        {{ $errors->first('max_quantity_buyer') }}</p>
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
                                                                        {{ old('brand_id') ? '' : 'selected' }}>
                                                                        Select
                                                                        Brand</option>
                                                                    @foreach ($brands as $brand)                                                                    
                                                                        <option value="{{ $brand->id }}"
                                                                            {{ $promo->brand && $promo->brand->id == $brand->id ? 'selected' : '' }}>
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
                                                                        or add
                                                                        new one</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="first-name-icon">Discount <span
                                                                            style="color: red">*</span></label>
                                                                    <div class="position-relative">
                                                                        <input type="text"
                                                                            class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                                                            placeholder="Enter Discount"
                                                                            id="first-name-icon" name="discount"
                                                                            value="{{ $promo->discount }}">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-percent"></i>
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('discount'))
                                                                        <p style="color: red">
                                                                            {{ $errors->first('discount') }}</p>
                                                                    @else
                                                                        <small class="form-text text-muted"
                                                                            style="font-size: 14px;">Enter the
                                                                            discount amount (e.g., 10 for 10%
                                                                            off).</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="form-group has-icon-left">
                                                                    <label for="first-name-icon">Max Discount <span
                                                                            style="color: red">*</span></label>
                                                                    <div class="position-relative">
                                                                        <input type="text"
                                                                            class="form-control {{ $errors->has('max_discount') ? 'is-invalid' : '' }}"
                                                                            placeholder="Enter Max Discount"
                                                                            id="first-name-icon" name="max_discount"
                                                                            value="{{ $promo->max_discount }}">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-percent"></i>
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('max_discount'))
                                                                        <p style="color: red">
                                                                            {{ $errors->first('max_discount') }}</p>
                                                                    @else
                                                                        <small class="form-text text-muted"
                                                                            style="font-size: 14px;">Specify the
                                                                            maximum discount amount that can be applied
                                                                            (e.g., 50).</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="min_transaction">Minimum Transaction <span
                                                                    style="color: red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">Rp.</span>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('min_transaction') ? 'is-invalid' : '' }}"
                                                                    id="min_transaction" placeholder="x.xxx.xxx"
                                                                    name="min_transaction"
                                                                    value="{{ number_format($promo->min_transaction, 0, ',', '.') }}">
                                                                    
                                                            </div>
                                                            @if ($errors->has('min_transaction'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('min_transaction') }}</p>
                                                            @else
                                                                <small class="form-text text-muted"
                                                                    style="font-size: 14px;">Enter the minimum
                                                                    transaction amount required to apply the
                                                                    voucher.</small>
                                                            @endif
                                                        </div>

                                                        <div class="card">
                                                            <label for="first-name-icon">Banner Voucher <span
                                                                    style="color: red">*</span></label>
                                                            <div class="image-upload-wrap"
                                                                id="single-image-upload-wrap"
                                                                style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 8px; height: auto;">
                                                                <input type="file" name="image"
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
                                                                <!-- Gambar yang diunggah akan ditambahkan di sini -->
                                                            </div>

                                                            @if ($errors->has('image'))
                                                                <p style="color: red">
                                                                    {{ $errors->first('image') }}</p>
                                                            @else
                                                                <small class="form-text text-muted">Upload a clear,
                                                                    high-quality image that best represents your
                                                                    product. This will be the main image shown in search
                                                                    results. For file formats, please use JPG, JPEG, or
                                                                    PNG, and ensure the size is no more than
                                                                    2MB.</small>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="reset"
                                                            class="btn btn-sm btn-light-secondary me-3">Reset
                                                            Voucher</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary me-1">Submit Voucher</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        {{-- brand modal --}}
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/product/createproduct.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

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

    <script>
        // HANDLE AUTO FORMAT RUPIAH
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

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }

        // Event listener untuk input min_transaction
        document.getElementById('min_transaction').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });

        // Event listener untuk input max_transaction
        document.getElementById('max_transaction').addEventListener('input', function(e) {
            this.value = formatRupiah(this.value);
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment().startOf('day'), // Default start date
                endDate: moment().endOf('day') // Default end date
            });
        });
    </script>

    <!-- toastify -->
    <script src="assets/vendors/toastify/toastify.js"></script>

    {{-- Upload Single Image --}}
    <script>
        // Fungsi untuk mengunggah satu gambar
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
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

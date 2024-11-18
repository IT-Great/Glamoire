<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/detailproduct.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        .list-group-item {
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            transform: scale(1.02);
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .upload__img-box-single,
        .upload__video-box {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .upload__img-box-single,
        .upload__video-box {
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .upload__img-close,
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
                        <div class="col-12 col-md-6 d-flex">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/product-admin"
                                            style="text-decoration: none;">Affiliate</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Affiliate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                {{-- <section id="multiple-column-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-lg-8 col-12">
                                                        <!-- Personal Information Card -->
                                                        <div class="bg-light p-4 rounded-3 mb-4">
                                                            <h5 class="text-primary mb-4">Personal Information</h5>
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label text-muted">Full
                                                                            Name</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text bg-white">
                                                                                <i
                                                                                    class="bi bi-person text-primary"></i>
                                                                            </span>
                                                                            <input type="text"
                                                                                class="form-control bg-white"
                                                                                value="{{ $partners->fullname }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label text-muted">Company
                                                                            Name</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text bg-white">
                                                                                <i
                                                                                    class="bi bi-building text-primary"></i>
                                                                            </span>
                                                                            <input type="text"
                                                                                class="form-control bg-white"
                                                                                value="{{ $partners->company_name }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Contact Information Card -->
                                                        <div class="bg-light p-4 rounded-3 mb-4">
                                                            <h5 class="text-primary mb-4">Contact Information</h5>
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label text-muted">Phone
                                                                            Number</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text bg-white">
                                                                                <i
                                                                                    class="bi bi-telephone text-primary"></i>
                                                                            </span>
                                                                            <input type="text"
                                                                                class="form-control bg-white"
                                                                                value="{{ $partners->handphone }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label text-muted">Email
                                                                            Address</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text bg-white">
                                                                                <i
                                                                                    class="bi bi-envelope text-primary"></i>
                                                                            </span>
                                                                            <input type="text"
                                                                                class="form-control bg-white"
                                                                                value="{{ $partners->email }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Product Information Card -->
                                                        <div class="bg-light p-4 rounded-3 mb-4">
                                                            <h5 class="text-primary mb-4">Product Information</h5>
                                                            <div class="form-group mb-4">
                                                                <label class="form-label text-muted">Category
                                                                    Product</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="bi bi-tags text-primary"></i>
                                                                    </span>
                                                                    <input type="text"
                                                                        class="form-control bg-white"
                                                                        value="{{ $partners->category_product }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    class="form-label text-muted">Description</label>
                                                                <textarea class="form-control bg-white" rows="6" disabled>{{ $partners->description }}</textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Documents Card -->
                                                        <div class="bg-light p-4 rounded-3 mb-4">
                                                            <h5 class="text-primary mb-4">Documents</h5>
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label text-muted">Company
                                                                            Document</label>
                                                                        <div class="p-3 border rounded bg-white">
                                                                            @if ($partners->fileCompany)
                                                                                <a href="{{ asset('storage/' . $partners->fileCompany->file_path) }}"
                                                                                    class="d-flex align-items-center text-decoration-none">
                                                                                    <i
                                                                                        class="bi bi-file-earmark-text text-primary me-2"></i>
                                                                                    <span>{{ $partners->fileCompany->file_name }}</span>
                                                                                </a>
                                                                            @else
                                                                                <span class="text-muted"><i
                                                                                        class="bi bi-exclamation-circle me-2"></i>No
                                                                                    file uploaded</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label text-muted">BPOM
                                                                            Document</label>
                                                                        <div class="p-3 border rounded bg-white">
                                                                            @if ($partners->fileBpom)
                                                                                <a href="{{ asset('storage/' . $partners->fileBpom->file_path) }}"
                                                                                    class="d-flex align-items-center text-decoration-none">
                                                                                    <i
                                                                                        class="bi bi-file-earmark-text text-primary me-2"></i>
                                                                                    <span>{{ $partners->fileBpom->file_name }}</span>
                                                                                </a>
                                                                            @else
                                                                                <span class="text-muted"><i
                                                                                        class="bi bi-exclamation-circle me-2"></i>No
                                                                                    file uploaded</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Status Information Card -->
                                                        <div class="bg-light p-4 rounded-3">
                                                            <h5 class="text-primary mb-4">Status Information</h5>
                                                            <div class="row g-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label text-muted d-block">BPOM
                                                                            Status</label>
                                                                        <div class="p-3 border rounded bg-white">
                                                                            <div
                                                                                class="form-check form-check-inline mb-0">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    {{ $partners->bpom ? 'checked' : '' }}
                                                                                    disabled>
                                                                                <label
                                                                                    class="form-check-label">Yes</label>
                                                                            </div>
                                                                            <div
                                                                                class="form-check form-check-inline mb-0">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    {{ !$partners->bpom ? 'checked' : '' }}
                                                                                    disabled>
                                                                                <label
                                                                                    class="form-check-label">No</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label text-muted d-block">Official
                                                                            Distributor</label>
                                                                        <div class="p-3 border rounded bg-white">
                                                                            <div
                                                                                class="form-check form-check-inline mb-0">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    {{ $partners->distributor ? 'checked' : '' }}
                                                                                    disabled>
                                                                                <label
                                                                                    class="form-check-label">Yes</label>
                                                                            </div>
                                                                            <div
                                                                                class="form-check form-check-inline mb-0">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    {{ !$partners->distributor ? 'checked' : '' }}
                                                                                    disabled>
                                                                                <label
                                                                                    class="form-check-label">No</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label text-muted d-block">Prior
                                                                            Contact</label>
                                                                        <div class="p-3 border rounded bg-white">
                                                                            <div
                                                                                class="form-check form-check-inline mb-0">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    {{ $partners->reached_email ? 'checked' : '' }}
                                                                                    disabled>
                                                                                <label
                                                                                    class="form-check-label">Yes</label>
                                                                            </div>
                                                                            <div
                                                                                class="form-check form-check-inline mb-0">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    {{ !$partners->reached_email ? 'checked' : '' }}
                                                                                    disabled>
                                                                                <label
                                                                                    class="form-check-label">No</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}

                <section class="section">
                    <div class="container">
                        <div class="card">
                            <div class="card-header text-primary">
                                <h4>Affiliate Detail Information</h4>
                                <p class="text-primary-50">Overview and details of the affiliate partner</p>
                            </div>
                            <div class="card-body">
                                <!-- Personal Information -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Personal Information</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-circle text-primary me-3"
                                                    style="font-size: 24px;"></i>
                                                <div>
                                                    <h6 class="mb-1">Full Name</h6>
                                                    <p class="text-muted">{{ $partners->fullname }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Contact Information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-telephone text-primary me-3"
                                                    style="font-size: 24px;"></i>
                                                <div>
                                                    <h6 class="mb-1">Phone Number</h6>
                                                    <p class="text-muted">{{ $partners->handphone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-envelope text-primary me-3"
                                                    style="font-size: 24px;"></i>
                                                <div>
                                                    <h6 class="mb-1">Email Address</h6>
                                                    <p class="text-muted">{{ $partners->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Information -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Product Information</h5>
                                    <div class="mb-3">
                                        <h6 class="mb-1">Category Product</h6>
                                        <p class="text-muted">{{ $partners->category_product }}</p>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Description</h6>
                                        <p class="text-muted">{{ $partners->description }}</p>
                                    </div>
                                </div>

                                <!-- Documents Section -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Documents</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-1">Company Document</h6>
                                            <div class="p-3 border rounded bg-white">
                                                @if ($partners->fileCompany)
                                                    <a href="{{ asset('storage/' . $partners->fileCompany->file_path) }}"
                                                        class="d-flex align-items-center text-decoration-none">
                                                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                                        <span>{{ $partners->fileCompany->file_name }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-muted"><i
                                                            class="bi bi-exclamation-circle me-2"></i>No file
                                                        uploaded</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="mb-1">BPOM Document</h6>
                                            <div class="p-3 border rounded bg-white">
                                                @if ($partners->fileBpom)
                                                    <a href="{{ asset('storage/' . $partners->fileBpom->file_path) }}"
                                                        class="d-flex align-items-center text-decoration-none">
                                                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                                        <span>{{ $partners->fileBpom->file_name }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-muted"><i
                                                            class="bi bi-exclamation-circle me-2"></i>No
                                                        file uploaded</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Information -->
                                <div class="border-bottom pb-4 mb-4">
                                    <h5 class="text-primary mb-3">Status Information</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="mb-1">BPOM Status</h6>
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ $partners->bpom ? 'checked' : '' }} disabled>
                                                <label class="form-check-label me-3">Yes</label>
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ !$partners->bpom ? 'checked' : '' }} disabled>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">Prior Contact</h6>
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ $partners->reached_email ? 'checked' : '' }} disabled>
                                                <label class="form-check-label me-3">Yes</label>
                                                <input type="radio" class="form-check-input"
                                                    {{ !$partners->reached_email ? 'checked' : '' }} disabled>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">Official Distributor</h6>
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ $partners->distributor ? 'checked' : '' }} disabled>
                                                <label class="form-check-label me-3">Yes</label>
                                                <input type="radio" class="form-check-input me-2"
                                                    {{ !$partners->distributor ? 'checked' : '' }} disabled>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Response Form -->
                                <form action="{{ route('send-response-affiliate', $partners->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="response"><strong>Your Response: <span
                                                    class="text-danger">*</span></strong></label>
                                        <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" id="response" name="response"
                                            rows="5" placeholder="Write your detailed response here..."></textarea>

                                        @if ($errors->has('response'))
                                            <p style="color: red">{{ $errors->first('response') }}</p>
                                        @else
                                            <small class="text-muted" style="font-size: 14px;">
                                                Please provide a comprehensive response addressing the user's query. Be
                                                clear and concise.
                                            </small>
                                        @endif
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary mt-3">
                                        <i class="bi bi-send"></i> Send Response
                                    </button>
                                </form>
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
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>

    <!-- toastify -->
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

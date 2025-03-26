<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/brand/createbrand.css">

    <style>
         .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .brand-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .brand-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.1);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            /* Menyusun tombol secara vertikal */
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 3px;
            transition: all 0.2s ease;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
        }

        .brand-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .brand-meta {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h2>Brand Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/brand-admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Brands</li>
                                </ol>
                            </nav>
                        </div>
                       
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats">
                    <div class="col-12 col-md-4">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Brands</h6>
                                        <h3 class="mb-0">{{ $brands->total() }}</h3>
                                    </div>
                                    <div class="stats-icon blue">
                                        <i class="bi bi-box fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Active Brands</h6>
                                        <h3 class="mb-0">{{ $brands->count() }}</h3>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Products</h6>
                                        <h3 class="mb-0">{{ $brands->sum('products_count') }}</h3>
                                    </div>
                                    <div class="stats-icon red">
                                        <i class="bi bi-percent"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Brands Table Section -->
                <div class="card brand-card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="mb-0">Brand Directory</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                <a href="{{ route('create-brand-admin') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Buat Brand
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Brand Details</th>
                                    <th>Total Products</th>
                                    <th>Brand Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr id="brand-item-{{ $brand->id }}">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ Storage::url($brand->brand_logo) }}"
                                                    alt="{{ $brand->name }}" class="brand-logo lazyload"
                                                    onclick="openImageInNewTab('{{ Storage::url($brand->brand_logo) }}')">
                                                <div class="brand-details">
                                                    <span
                                                        class="brand-name">{{ Str::limit($brand->name, 20, '...') }}</span>
                                                    <span class="brand-meta">Code: {{ $brand->brand_code }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light-success">{{ $brand->products_count }}</span>
                                        </td>
                                        <td>{{ $brand->brand_code }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ url('/detail-brand/' . $brand->id) }}"
                                                    class="badge bg-info mb-2">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ url('/edit-brand/' . $brand->id) }}"
                                                    class="badge bg-warning mb-2">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="javascript:void(0);" class="badge bg-danger delete-brand"
                                                    data-id="{{ $brand->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between mt-4 px-3">
                    <div class="text-muted">
                        Showing {{ $brands->firstItem() }} to {{ $brands->lastItem() }} of {{ $brands->total() }}
                        brands
                    </div>
                    <div class="pagination-container">
                        {{ $brands->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/brand/indexbrand.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4A69E2',
                timer: 1800,
                timerProgressBar: true
            });
        </script>
    @endif

</body>

</html>

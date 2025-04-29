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

        .modal-body {
            padding: 1.5rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .transaction-icon i {
            opacity: 0.8;
        }

        .account-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .account-icon i {
            font-size: 1.2rem;
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
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                                            <a href="{{ route('detail-brand-admin', $brand->id) }}"
                                                class="badge bg-warning mb-2">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>

                                            <a href="#" class="badge bg-info mb-2 view-brand"
                                                data-id="{{ $brand->id }}">
                                                <i class="bi bi-eye"></i> View
                                            </a>

                                            <a href="javascript:void(0);" class="badge bg-danger delete-brand"
                                                data-id="{{ $brand->id }}">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #183018; color: white;">
                                    <h5 class="modal-title text-white" id="brandModalLabel">
                                        <i class="bi bi-tag me-2"></i>Brand Detail
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <!-- Main Card -->
                                    <div class="card bg-light mb-4">
                                        <div class="card-body p-4">
                                            <div class="row">
                                                <!-- Brand Code Section -->
                                                <div class="col-md-8">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="icon-container me-3">
                                                            <i class="bi bi-tag-fill fs-1 text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <div class="text-secondary">Brand Code</div>
                                                            <h2 id="modalBrandCode" class="mb-0 fw-bold">-</h2>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Brand Logo Section -->
                                                <div class="col-md-4 text-end">
                                                    <div class="d-flex flex-column align-items-end">
                                                        <div class="text-secondary mb-2">Brand Logo</div>
                                                        <a href="#" id="modalBrandLogoLink" target="_blank">
                                                            <div class="brand-logo-container bg-white rounded p-2"
                                                                style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                                                <img id="modalBrandLogo" src=""
                                                                    alt="Brand Logo"
                                                                    style="max-width: 90px; max-height: 90px; object-fit: contain;">
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Left Column - Brand Name -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="bi bi-fonts me-2 text-secondary"></i>
                                                        <div class="text-secondary">Brand Name</div>
                                                    </div>
                                                    <h3 id="modalBrandName" class="mb-0 fw-bold">-</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right Column - Brand Details -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="bi bi-info-circle me-2 text-secondary"></i>
                                                        <div class="text-secondary">Brand Details</div>
                                                    </div>
                                                    <div class="py-2">
                                                        <div class="row mb-3">
                                                            <div class="col-5 text-secondary">Created Date</div>
                                                            <div id="modalCreatedDate" class="col-7 fw-medium">-</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5 text-secondary">Updated Date</div>
                                                            <div id="modalUpdatedDate" class="col-7 fw-medium">-</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Brand Description -->
                                    <div class="card border-0 shadow-sm mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-card-text me-2 text-secondary"></i>
                                                <div class="text-secondary">Brand Description</div>
                                            </div>
                                            <p id="modalDescription" class="mb-0">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-2"></i>Close
                                    </button>

                                    <a id="editBrand" href="#" class="btn btn-warning">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>

                                </div>
                            </div>
                        </div>
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
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

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

    <script>
        // View brand details
        $(document).on('click', '.view-brand', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            // Show loading state
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: `/brands/${id}`,
                method: 'GET',
                success: function(response) {
                    // Close loading indicator
                    Swal.close();

                    // Populate modal with brand data
                    $('#modalBrandCode').text(response.brand_code || '-');
                    $('#modalBrandName').text(response.name || '-');
                    $('#modalDescription').text(response.description || '-');

                    // Set brand logo if available
                    if (response.brand_logo) {
                        $('#modalBrandLogo').attr('src', response.brand_logo).show();
                        $('#modalBrandLogoLink').attr('href', response.brand_logo);
                        $('.brand-logo-container').css('background-color', '#fff');
                    } else {
                        $('#modalBrandLogo').attr('src', '/placeholder-image.png').show();
                        $('#modalBrandLogoLink').attr('href', '/placeholder-image.png');
                        $('.brand-logo-container').css('background-color', '#f8f9fa');
                    }

                    // Format created date
                    if (response.created_at) {
                        const createdDate = new Date(response.created_at);
                        const formattedCreatedDate = createdDate.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#modalCreatedDate').text(formattedCreatedDate);
                    } else {
                        $('#modalCreatedDate').text('-');
                    }

                    // Format updated date
                    if (response.updated_at) {
                        const updatedDate = new Date(response.updated_at);
                        const formattedUpdatedDate = updatedDate.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#modalUpdatedDate').text(formattedUpdatedDate);
                    } else {
                        $('#modalUpdatedDate').text('-');
                    }

                    // Set edit link
                    $('#editBrand').attr('href', `/edit-brand/${id}`);

                    // Show the modal
                    $('#brandModal').modal('show');
                },
                error: function() {
                    Swal.fire('Error', 'Failed to load brand data.', 'error');
                }
            });
        });

        // Handle print brand button click
        $(document).on('click', '#printBrand', function() {
            const printContent = $('.modal-body').html();
            const originalContent = $('body').html();

            // Create a print window
            $('body').html(`
                <div style="padding: 20px;">
                    <h2 style="text-align: center; margin-bottom: 20px;">Brand Details</h2>
                    ${printContent}
                </div>
            `);

            // Print
            window.print();

            // Restore original content
            $('body').html(originalContent);

            // Re-initialize Bootstrap elements
            $('#brandModal').modal('show');
        });
    </script>

</body>

</html>

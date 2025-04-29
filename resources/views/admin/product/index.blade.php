<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/product/index.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <style>
        .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .product-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        .stock-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
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

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .product-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
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
                            <h2>Product Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats">
                    <div class="col-12 col-md-3 mb-2">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Products</h6>
                                        <h3 class="mb-0">{{ $products->total() }}</h3>
                                    </div>
                                    <div class="stats-icon purple">
                                        <i class="bi bi-box fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-2">
                        <div class="card stats-card ">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">In Stock</h6>
                                        <h3 class="mb-0">{{ $products->where('stock_quantity', '>', 0)->count() }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-check-circle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-2">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Low Stock</h6>
                                        <h3 class="mb-0">
                                            {{ $products->where('stock_quantity', '<=', 15)->where('stock_quantity', '>', 0)->count() }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon yellow">
                                        <i class="bi bi-exclamation-triangle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-2">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Out of Stock</h6>
                                        <h3 class="mb-0">{{ $products->where('stock_quantity', '=', 0)->count() }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon red">
                                        <i class="bi bi-x-circle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Table Section -->
                <div class="card product-card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4>Product Inventory</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                <a href="{{ route('create-product-admin') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Buat Produk
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Product Details</th>
                                    <th>Stock</th>
                                    <th>Stock Status</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr id="product-item-{{ $item->id }}">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ Storage::url($item->main_image) }}"
                                                    alt="{{ $item->product_name }}" class="product-image lazyload"
                                                    onclick="openImageInNewTab('{{ Storage::url($item->main_image) }}')">
                                                <div class="product-details">
                                                    <span
                                                        class="product-name">{{ $item->brand ? $item->brand->name : 'No Brand' }}
                                                        - {{ Str::limit($item->product_name, 20, '...') }}</span>
                                                    <span class="product-meta">SKU:
                                                        {{ $item->product_code ?: 'N/A' }}</span>
                                                    <span class="product-meta">Category:
                                                        {{ $item->categoryProduct ? $item->categoryProduct->name : 'Uncategorized' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>
                                            @if ($item->stock_quantity > 15)
                                                <span class="stock-badge bg-success text-white">
                                                    <i class="bi bi-check-circle-fill"></i> In Stock
                                                </span>
                                            @elseif($item->stock_quantity > 0)
                                                <span class="stock-badge bg-warning text-dark">
                                                    <i class="bi bi-exclamation-circle-fill"></i> Low Stock
                                                </span>
                                            @else
                                                <span class="stock-badge bg-danger text-white">
                                                    <i class="bi bi-x-circle-fill"></i> Out of Stock
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @php
                                                    $activePromo = $item->promos->first();
                                                    $discountedPrice = $activePromo
                                                        ? $activePromo->pivot->discounted_price
                                                        : null;
                                                @endphp

                                                @if ($discountedPrice && $discountedPrice < $item->regular_price)
                                                    <span class="text-danger fw-bold">
                                                        Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                                    </span>
                                                    <span class="text-muted text-decoration-line-through">
                                                        Rp {{ number_format($item->regular_price, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="fw-bold">
                                                        Rp {{ number_format($item->regular_price, 0, ',', '.') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('detail-product-admin', $item->id) }}"
                                                    class="btn btn-sm btn-primary d-inline-flex align-items-center">
                                                    <i class="bi bi-eye me-1"></i> View
                                                </a>

                                                <a href="{{ route('edit-product-admin', $item->id) }}"
                                                    class="badge bg-warning d-inline-flex align-items-center">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>

                                                <a href="javascript:void(0);"
                                                    class="badge bg-danger delete-product d-inline-flex align-items-center"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                                @if ($item->stock_quantity < 10)
                                                    <a href="javascript:void(0);"
                                                        class="badge bg-primary notify-product d-inline-flex align-items-center"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-bell"></i> Notify
                                                    </a>
                                                @endif
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
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                        {{ $products->total() }} products
                    </div>
                    {{ $products->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
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
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Simple DataTable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);

            // Use event delegation for delete button
            table1.addEventListener('click', function(event) {
                if (event.target.closest('.delete-product')) {
                    let productId = event.target.closest('.delete-product').getAttribute('data-id');

                    // SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send AJAX request to delete product
                            // fetch(`/Glamoire/public/delete-product/${productId}`, {
                            fetch(`/delete-product/${productId}`, {
                                    method: 'POST', // Use POST instead of DELETE
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    },
                                    body: JSON.stringify({
                                        _method: 'DELETE' // Spoof DELETE method
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Remove the product from the page
                                        const productElement = document.querySelector(
                                            `#product-item-${productId}`);
                                        if (productElement) {
                                            productElement.remove();
                                        }

                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            icon: 'success',
                                            timer: 1800,
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 1800,
                                            timerProgressBar: true,
                                            showConfirmButton: true
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Something went wrong while deleting the product.',
                                        icon: 'error'
                                    });
                                });
                        }
                    });
                }

                // Bagian untuk fitur kirim notifikasi
                if (event.target.closest('.notify-product')) {
                    let productId = event.target.closest('.notify-product').getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Send it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/send-notify/${productId}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            'Sent!',
                                            'Notification has been sent successfully.',
                                            'success'
                                        );
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            data.message || 'Failed to send notification.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    console.log('Error:', error);
                                    Swal.fire(
                                        'Error!',
                                        'An error occurred while sending notification.',
                                        'error'
                                    );
                                });
                        }
                    });
                }
            });
        });
    </script>



    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4A69E2', // Mengatur warna tombol OK
                customClass: {
                    icon: 'swal-icon-success'
                },
                timer: 1800, // Mengatur waktu tampilan SweetAlert dalam milidetik (1000 ms = 1 detik)
                timerProgressBar: true, // Menampilkan progress bar timer
                didClose: () => {
                    // Optional: this can be used to trigger any action after the alert is closed
                }
            });
        </script>
    @endif
</body>

</html>

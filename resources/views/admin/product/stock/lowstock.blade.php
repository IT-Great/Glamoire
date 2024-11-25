<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Product - Glamoire</title>
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

        .stock-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stock-card:hover {
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

        .nav-tabs .nav-link.active {
            border-bottom: 2px solid #435ebe;
            border-top: none;
            border-left: none;
            border-right: none;
            color: #435ebe;
            font-weight: 600;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #666;
            padding: 0.8rem 1.5rem;
        }

        .form-check-input:checked {
            background-color: #00C853;
            border-color: #00C853;
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
                            <h2>Stock Management</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/stock-product-admin">Product</a></li>
                                    <li class="breadcrumb-item active">Stock</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="row quick-stats">
                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Products</h6>
                                        <h3 class="mb-0">{{ $products->count() }}</h3>
                                    </div>
                                    <div class="stats-icon purple">
                                        <i class="bi bi-box fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">In Stock</h6>
                                        <h3 class="mb-0">{{ $products->where('stock_quantity', '>', 10)->count() }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon green">
                                        <i class="bi bi-check-circle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Low Stock</h6>
                                        <h3 class="mb-0">
                                            {{ $products->where('stock_quantity', '<=', 10)->where('stock_quantity', '>', 0)->count() }}
                                        </h3>
                                    </div>
                                    <div class="stats-icon yellow">
                                        <i class="bi bi-exclamation-triangle fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
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

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index-stock-product-admin') }}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('outof-stock-product-admin') }}">Stok Habis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('low-stock-product-admin') }}">Stok Rendah</a>
                    </li>
                </ul>

                <!-- Info Alert -->
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi penting tentang manajemen stok:
                    <ul class="mb-0">
                        <li><strong>Lokasi:</strong> Pastikan identifikasi lokasi produk dengan tepat.</li>
                        <li><strong>Batas Stok:</strong> Atur batas stok aman untuk pembaruan tepat waktu.</li>
                        <li><strong>Stok Tersedia:</strong> Jaga jumlah stok yang akurat.</li>
                        <li><strong>Pengaturan Stok:</strong> Sesuaikan pengaturan berdasarkan permintaan produk.</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>

                <!-- Product Table -->
                <div class="card stock-card mt-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Stock Inventory</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Product Details</th>
                                    <th>Total Stock</th>
                                    <th>Stock Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            {{-- data menggunakan stock awal dari stock itu sendiri --}}
                            {{-- <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                    class="product-image"
                                                    onclick="openImageInNewTab('{{ Storage::url($item->main_image) }}')">
                                                <div class="product-details">
                                                    <span class="product-name">{{ $item->product_name }}</span>
                                                    <span class="product-meta">SKU: {{ $item->product_code }}</span>
                                                    <span class="product-meta">Category:
                                                        {{ $item->categoryProduct->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-dark"> Total Stock: {{ $item->total_stock }}</span>
                                        </td>
                                        <td>
                                            @foreach ($item->stocks()->where('quantity', '>', 0)->orderBy('date_expired', 'desc')->get() as $stock)
                                                <div class="stock-batch mb-1">
                                                    <span class="badge bg-info">
                                                        {{ $stock->quantity }} units
                                                    </span>
                                                    <span class="text-muted">
                                                        Exp:
                                                        {{ \Carbon\Carbon::parse($stock->date_expired)->format('d M Y') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($item->total_stock > 15)
                                                <span
                                                    class="badge rounded-pill bg-success d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>In Stock</span>
                                                </span>
                                            @elseif($item->total_stock > 0)
                                                <span
                                                    class="badge rounded-pill bg-warning text-dark d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-exclamation-circle-fill"></i>
                                                    <span>Low Stock</span>
                                                </span>
                                            @else
                                                <span
                                                    class="badge rounded-pill bg-danger text-dark d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                    <span>Out of Stock</span>
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <button
                                                class="btn btn-sm btn-primary update-btn d-inline-flex align-items-center gap-1"
                                                data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                                data-stock="{{ $item->total_stock }}">
                                                <i class="bi bi-pencil"></i> Update
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody> --}}

                            {{-- data menggunakan stock awal dari halaman create product awal --}}
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                    class="product-image"
                                                    onclick="openImageInNewTab('{{ Storage::url($item->main_image) }}')">
                                                <div class="product-details">
                                                    <span class="product-name">{{ $item->product_name }}</span>
                                                    <span class="product-meta">SKU: {{ $item->product_code }}</span>
                                                    <span class="product-meta">Category:
                                                        {{ $item->categoryProduct->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Stock Awal : {{ $item->stock_quantity }}</td>
                                        </td>
                                        <td>
                                            @foreach ($item->stocks as $stock)
                                                <div class="stock-batch mb-1">
                                                    <span class="badge bg-info">
                                                        {{ $stock->quantity }} units
                                                    </span>
                                                    <span class="text-muted">
                                                        Exp:
                                                        {{ \Carbon\Carbon::parse($stock->date_expired)->format('d M Y') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($item->stock_quantity > 15 && $item->total_stock > 15)
                                                <span
                                                    class="badge rounded-pill bg-success d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>In Stock (Stock Awal + Stock Update)</span>
                                                </span>
                                            @elseif ($item->stock_quantity > 15)
                                                <span
                                                    class="badge rounded-pill bg-primary d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>In Stock (Stock Awal)</span>
                                                </span>
                                            @elseif ($item->stock_quantity > 0 || $item->total_stock > 0)
                                                <span
                                                    class="badge rounded-pill bg-warning text-dark d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-exclamation-circle-fill"></i>
                                                    <span>Low Stock</span>
                                                </span>
                                            @else
                                                <span
                                                    class="badge rounded-pill bg-danger text-dark d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                    <span>Out of Stock</span>
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-primary update-btn"
                                                data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                                data-status="{{ $item->stock_quantity > 15 && $item->total_stock <= 15 ? 'stock_awal' : 'stock_update' }}">
                                                <i class="bi bi-pencil"></i> Update
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title">
                            <i class="bi bi-pencil-square"></i> Update Stok Produk
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form id="updateStockForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="product_id" name="product_id">

                            <!-- Informasi Produk -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" readonly>
                            </div>

                            <!-- Tabel Stok Existing -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Detail Stok Saat Ini</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jumlah</th>
                                                <th>Tanggal Kadaluarsa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stockDetailTable"></tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Form Tambah Stok Baru -->
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Tambah Stok Baru <span
                                                class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Tanggal Kadaluarsa <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" id="stock_quantity"
                                            name="stock_quantity" required min="1"
                                            placeholder="Jumlah stok baru">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="date_expired"
                                            name="date_expired" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>

            </div>


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

    {{-- handle modal update stock --}}
    {{-- <script>
        $(document).ready(function() {
            // Pastikan modal didefinisikan dengan benar
            const updateModal = document.getElementById('updateModal');
            const modal = new bootstrap.Modal(updateModal);

            // Fungsi untuk membuka modal
            async function openUpdateModal(button) {
                const productId = $(button).data('id');
                const productName = $(button).data('name');

                // Reset form
                $('#product_id').val(productId);
                $('#product_name').val(productName);
                $('#stock_quantity').val('');
                $('#date_expired').val('');

                // Tampilkan loading
                $('#stockDetailTable').html('<tr><td colspan="2">Loading...</td></tr>');

                // Tampilkan modal sebelum fetch data
                modal.show();

                try {
                    const response = await fetch(`/get-stock-details/${productId}`);
                    const stockDetails = await response.json();

                    let rows = '';
                    stockDetails.forEach(stock => {
                        rows += `
                    <tr>
                        <td>${stock.quantity}</td>
                        <td>${new Date(stock.date_expired).toLocaleDateString('id-ID')}</td>
                    </tr>
                `;
                    });

                    $('#stockDetailTable').html(rows);
                } catch (error) {
                    console.error('Error:', error);
                    $('#stockDetailTable').html('<tr><td colspan="2">Error loading data</td></tr>');
                }
            }

            // Handle form submission
            $('#updateStockForm').on('submit', async function(e) {
                e.preventDefault();

                const productId = $('#product_id').val();
                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(`/update-stock/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        modal.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat memperbarui stok'
                    });
                }
            });

            // Event handler untuk tombol update
            $(document).on('click', '.update-btn', function() {
                openUpdateModal(this);
            });
        });
    </script> --}}

    {{-- update modif by gpt yang sekarang digunakan --}}
    <script>
        $(document).ready(function() {
            const updateModal = document.getElementById('updateModal');
            const modal = new bootstrap.Modal(updateModal);

            // Fungsi untuk membuka modal update
            async function openUpdateModal(button) {
                const productId = $(button).data('id');
                const productName = $(button).data('name');
                const stockStatus = $(button).data('status'); // Ambil status dari data-status pada button

                // Reset form
                $('#product_id').val(productId);
                $('#product_name').val(productName);
                $('#stock_quantity').val('');
                $('#date_expired').val('');

                // Show loading
                $('#stockDetailTable').html('<tr><td colspan="2">Loading...</td></tr>');

                // Show modal before fetching data
                modal.show();

                try {
                    // Jika status adalah "stock_awal", tampilkan pesan khusus dan hentikan proses fetch
                    if (stockStatus === 'stock_awal') {
                        $('#stockDetailTable').html(
                            '<tr><td colspan="2" class="text-center text-primary"><strong>Ini adalah Stock Awal Produk. Belum ada update stok.</strong></td></tr>'
                        );
                        return;
                    }

                    // Fetch data stok jika status bukan "stock_awal"
                    const response = await fetch(`/get-stock-details/${productId}`);
                    const data = await response.json();

                    let rows = '';
                    if (data.mainProduct.length > 0) {
                        data.mainProduct.forEach(stock => {
                            rows += `
                                <tr>
                                    <td>${stock.quantity}</td>
                                    <td>${new Date(stock.date_expired).toLocaleDateString('id-ID')}</td>
                                </tr>
                            `;
                        });
                    }

                    $('#stockDetailTable').html(
                        rows ||
                        '<tr><td colspan="2" class="text-center text-danger"><strong>Stok habis</strong></td></tr>'
                    );
                } catch (error) {
                    // Jika ada error, tampilkan pesan error umum
                    $('#stockDetailTable').html('<tr><td colspan="2">Error loading data</td></tr>');
                }
            }

            // Event handler untuk tombol update
            $(document).on('click', '.update-btn', function() {
                openUpdateModal(this);
            });

            // Handle form submission untuk update stok
            $('#updateStockForm').on('submit', async function(e) {
                e.preventDefault();

                const productId = $('#product_id').val();
                const formData = new FormData(this);

                try {
                    const response = await fetch(`/update-stock/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        body: formData,
                    });

                    const result = await response.json();

                    if (response.ok) {
                        modal.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.message,
                            timer: 1500,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat memperbarui stok',
                    });
                }
            });
        });
    </script>

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
                            fetch(`/delete-product/${productId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Remove the product from the page
                                        document.querySelector(`#product-item-${productId}`)
                                            .remove();
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            icon: 'success',
                                            timer: 1800, // Auto-close alert after 2 seconds
                                            timerProgressBar: true, // Show progress bar
                                            showConfirmButton: true // Show OK button
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error',
                                            timer: 1800, // Auto-close alert after 2 seconds
                                            timerProgressBar: true, // Show progress bar
                                            showConfirmButton: true // Show OK button
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
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

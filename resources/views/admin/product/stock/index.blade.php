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
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card stats-card bg-light-primary">
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
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card stats-card bg-light-success">
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
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card stats-card bg-light-warning">
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
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card stats-card bg-light-danger">
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
                        <a class="nav-link active" href="{{ route('index-stock-product-admin') }}">Semua Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('outof-stock-product-admin') }}">Habis Stok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('low-stock-product-admin') }}">Stok Rendah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Diarsipkan & Diblokir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk Khusus</a>
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


                <!-- Search Filters -->
                <div class="card stock-card mt-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" placeholder="Enter min. 1 word">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Min. Stock</label>
                                <input type="number" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Max. Stock</label>
                                <input type="number" class="form-control" placeholder="Max.">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary me-2">Search</button>
                                <button class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
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
                                    <th>Stock</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                    class="product-image">
                                                <div class="product-details">
                                                    <span class="product-name">{{ $item->product_name }}</span>
                                                    <span class="product-meta">SKU: {{ $item->product_code }}</span>
                                                    <span class="product-meta">Category:
                                                        {{ $item->categoryProduct->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date_expired)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>
                                            @if ($item->stock_quantity > 10)
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
                                            <button class="btn btn-sm btn-primary update-btn"
                                                data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                                data-stock="{{ $item->stock_quantity }}"
                                                data-expired="{{ $item->date_expired }}">
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
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-white text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-pencil-square"></i> Update Stok & Expired Date
                        </h5>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form id="updateStockForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="product_id" name="product_id">

                            <!-- Nama Produk -->
                            <div class="mb-3">
                                <label class="form-label fw-medium" for="product_name">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" readonly>
                            </div>

                            <!-- Stok Saat Ini -->
                            <div class="mb-3">
                                <label class="form-label fw-medium" for="current_stock">Stok Saat Ini</label>
                                <input type="number" class="form-control" id="current_stock" readonly>
                            </div>

                            <!-- Update Stok dengan Dropdown Tipe -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Update Stok</label>


                                <!-- Input Stok -->
                                <input type="number" class="form-control border-start-0" id="stock_quantity"
                                    name="stock_quantity" required placeholder="Masukkan jumlah stok">

                                <small class="form-text text-muted mt-1">
                                    <i class="bi bi-info-circle me-1"></i> Masukkan jumlah stok baru yang ingin
                                    ditambahkan atau dikurangi.
                                </small>
                            </div>

                            <!-- Expired Date -->
                            <div class="mb-3">
                                <label class="form-label fw-medium" for="date_expired">Expired Date</label>
                                <input type="date" class="form-control" id="date_expired" name="date_expired">
                                <small class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih tanggal kedaluwarsa produk.
                                </small>
                            </div>
                        </div>

                        <!-- Modal Footer dengan Tombol -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Fungsi untuk membuka modal
        function openUpdateModal(button) {
            const productId = button.dataset.id;
            const productName = button.dataset.name;
            const productStock = button.dataset.stock;
            const productExpired = button.dataset.expired;

            // Set nilai ke dalam modal
            document.getElementById('product_id').value = productId;
            document.getElementById('product_name').value = productName;
            document.getElementById('current_stock').value = productStock;
            document.getElementById('stock_quantity').value = productStock;
            document.getElementById('date_expired').value = productExpired;

            // Buka modal menggunakan Bootstrap 5
            const modal = new bootstrap.Modal(document.getElementById('updateModal'));
            modal.show();
        }

        // Function untuk increment dan decrement stock
        function incrementStock() {
            const input = document.getElementById('stock_quantity');
            input.value = parseInt(input.value || 0) + 1;
        }

        function decrementStock() {
            const input = document.getElementById('stock_quantity');
            const newValue = parseInt(input.value || 0) - 1;
            input.value = newValue >= 0 ? newValue : 0;
        }

        // Event listener ketika DOM sudah ready
        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation untuk tombol update
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('update-btn')) {
                    openUpdateModal(e.target);
                }
            });

            // Handle form submission
            const updateForm = document.getElementById('updateStockForm');
            updateForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const productId = document.getElementById('product_id').value;
                const formData = new FormData(this);
                const data = {
                    stock_quantity: formData.get('stock_quantity'),
                    date_expired: formData.get('date_expired')
                };

                try {
                    const response = await fetch(`/update-stock/${productId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        // Tutup modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'updateModal'));
                        modal.hide();

                        // Tampilkan notifikasi sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.message || 'Stok berhasil diperbarui!',
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(result.message || 'Gagal memperbarui stok');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.message || 'Terjadi kesalahan saat memperbarui stok!'
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

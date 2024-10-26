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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .nav-tabs .nav-link.active {
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #666;
        }

        .form-check-input:checked {
            background-color: #00C853;
            border-color: #00C853;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .input-group .btn {
            z-index: 0;
        }

        .form-control:read-only {
            background-color: #e9ecef;
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
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h2>Stok Saya</h2>
                        </div>
                        <div class="col-6 text-end">
                            <div class="d-flex justify-content-end align-items-center gap-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Peringatan Stok</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="stockAlert">
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary">
                                    <i class="fa fa-download me-2"></i>Export Semua
                                </button>
                                {{-- <button class="btn btn-danger">
                                    <i class="fa fa-sync me-2"></i>Mass Update
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs mt-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('index-stock-product-admin') }}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('outof-stock-product-admin') }}">Stok Habis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('low-stock-product-admin') }}">Stok Sedikit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Diarsipkan & Diblokir</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk Sesuai Permintaan</a>
                    </li>
                </ul>

                <!-- Info Alert -->
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <i class="fa fa-info-circle me-2"></i>
                    Untuk memfasilitasi Penjual dalam mengatur stok produk, kolom Lokasi akan ditambahkan untuk
                    mengidentifikasi lokasi produk dan kolom Batas Aman Stok akan ditambahkan sebagai pengingat untuk
                    memperbarui stok.
                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>

                <!-- Search Filters -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan min. 2 karakter untuk mencari produk">
                            </div>
                            <div class="col-md-4">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" placeholder="Masukkan min. 1 kata">
                            </div>
                            <div class="col-md-2">
                                <label>Stock Min.</label>
                                <input type="number" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-md-2">
                                <label>Stock Maks.</label>
                                <input type="number" class="form-control" placeholder="Maks.">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-primary me-2">Cari</button>
                                <button class="btn btn-outline-secondary">Atur Ulang</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Header -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>330 Live</div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary">
                            <i class="fa fa-download me-2"></i>Export
                        </button>
                        <button class="btn btn-outline-secondary">
                            Header Tabel
                        </button>
                    </div>
                </div>

                <!-- Product Table -->
                {{-- <div class="card mt-3">
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Keperluan Stok Ulang Produk</th>
                                    <th>Sesuai Permintaan</th>
                                    <th>Rata-rata Penjualan Seminggu</th>
                                    <th>Rata-rata Penjualan Sebulan</th>
                                    <th>Jumlah Hari Ketersediaan Stok</th>
                                    <th>Lokasi</th>
                                    <th>Stok</th>
                                    <th>Stok Dikunci untuk Promosi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                    class="me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-bold">{{ $item->product_name }}</div>
                                                    <div class="text-muted">SKU: {{ $item->product_code }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch">
                                            </div>
                                        </td>
                                        <td>{{ $item->weekly_sales ?? 0 }}</td>
                                        <td>{{ $item->monthly_sales ?? 0 }}</td>
                                        <td>{{ $item->stock_days ?? '-' }}</td>
                                        <td>{{ $item->location ?? '-' }}</td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>{{ $item->locked_stock ?? 0 }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary update-btn"
                                                data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                                data-stock="{{ $item->stock_quantity }}"
                                                data-expired="{{ $item->expired_date }}">
                                                Ubah
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}

                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Stok</th>
                                    <th>Date Expired</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ Storage::url($item->main_image) }}" alt="Product Image"
                                                    class="me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-bold">{{ $item->product_name }}</div>
                                                    <div class="text-muted">SKU: {{ $item->product_code }}</div>
                                                    <div class="text-muted" style="font-size: 12px;">Category:
                                                        {{ $item->categoryProduct->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date_expired)->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary update-btn"
                                                data-id="{{ $item->id }}" data-name="{{ $item->product_name }}"
                                                data-stock="{{ $item->stock_quantity }}"
                                                data-expired="{{ $item->date_expired }}">
                                                Ubah
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="fa fa-chevron-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><span class="page-link">...</span></li>
                            <li class="page-item"><a class="page-link" href="#">33</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </nav>
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
                                <input type="number" class="form-control border-start-0"
                                    id="stock_quantity" name="stock_quantity" required
                                    placeholder="Masukkan jumlah stok">

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

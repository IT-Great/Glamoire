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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs mt-4">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index-stock-product-admin') }}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('outof-stock-product-admin') }}">Stok Habis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('low-stock-product-admin') }}">Stok Sedikit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Diarsipkan & Diblokir</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk Sesuai Permintaan</a>
                    </li>
                </ul>              

                <!-- Search Filters -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row g-3">                           
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

                <!-- Product Table -->
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
                                                data-expired="{{ $item->expired_date }}">
                                                Ubah
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Stok & Expired Date</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="updateStockForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="product_id" name="product_id">

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok Saat Ini</label>
                                <input type="number" class="form-control" id="current_stock" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Update Stok</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="decrementStock()">-</button>
                                    <input type="number" class="form-control text-center" id="stock_quantity"
                                        name="stock_quantity" required>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="incrementStock()">+</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Expired Date</label>
                                <input type="date" class="form-control" id="expired_date" name="expired_date">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
        // Inisialisasi variabel untuk menyimpan data modal
        let currentStock = 0;

        // Function untuk membuka modal
        function openUpdateModal(button) {
            const id = button.dataset.id;
            const name = button.dataset.name;
            const stock = button.dataset.stock;
            const expired = button.dataset.expired;

            // Set nilai ke dalam modal
            document.getElementById('product_id').value = id;
            document.getElementById('product_name').value = name;
            document.getElementById('current_stock').value = stock;
            document.getElementById('stock_quantity').value = stock;
            document.getElementById('expired_date').value = expired;

            currentStock = parseInt(stock);

            // Buka modal
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

        // Event listener untuk tombol update
        document.addEventListener('DOMContentLoaded', function() {
            const updateButtons = document.querySelectorAll('.update-btn');
            updateButtons.forEach(button => {
                button.addEventListener('click', () => openUpdateModal(button));
            });

            // Handle form submission
            const updateForm = document.getElementById('updateStockForm');
            updateForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const productId = document.getElementById('product_id').value;
                const formData = new FormData(this);

                try {
                    const response = await fetch(`/update-stock/${productId}`, {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        const result = await response.json();
                        // Update tampilan tabel tanpa refresh
                        const row = document.querySelector(`tr[data-id="${productId}"]`);
                        if (row) {
                            row.querySelector('.stock-value').textContent = formData.get(
                                'stock_quantity');
                        }

                        // Tutup modal
                        bootstrap.Modal.getInstance(document.getElementById('updateModal')).hide();

                        // Tampilkan notifikasi sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Stok berhasil diperbarui!'
                        });
                    } else {
                        throw new Error('Gagal memperbarui stok');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memperbarui stok!'
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

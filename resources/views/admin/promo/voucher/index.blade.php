<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Voucher - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/css/product/index.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <style>
        .action-buttons a {
            display: block;
            margin-bottom: 5px;
        }

        .stats-card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .promo-nav {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .promo-nav-item {
            padding: 10px 20px;
            border-radius: 8px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .promo-nav-item.active {
            background: #435ebe;
            color: white;
        }

        .promo-nav-item:hover:not(.active) {
            background: #e9ecef;
        }

        .voucher-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }

        .voucher-card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .voucher-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .voucher-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .voucher-image:hover {
            transform: scale(1.1);
        }

        .badge {
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
        }

        .status-active {
            background-color: green;
        }

        .status-expired {
            background-color: #f44336;
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
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Voucher Management</h3>
                            <p class="text-subtitle text-muted">Create and manage your store vouchers effectively</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-12 col-sm-4 mb-3">
                        <div class="card stats-card bg-light-primary">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi bi-ticket-detailed"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Active Vouchers</h6>
                                        <h6 class="font-extrabold mb-0">{{ $activeVouchers ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 mb-3">
                        <div class="card stats-card bg-light-success">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Voucher Usage</h6>
                                        <h6 class="font-extrabold mb-0">{{ $voucherUsage ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 mb-3">
                        <div class="card stats-card bg-light-danger">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Expired Vouchers</h6>
                                        <h6 class="font-extrabold mb-0">{{ $expiredVouchers ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="/promo" class="promo-nav-item {{ Request::is('promo') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill me-2"></i>All Promos
                    </a>
                    <a href="/promo-voucher" class="promo-nav-item {{ Request::is('promo-voucher') ? 'active' : '' }}">
                        <i class="bi bi-receipt-cutoff me-2"></i>Vouchers
                    </a>
                    <a href="/promo-diskon" class="promo-nav-item {{ Request::is('promo-diskon') ? 'active' : '' }}">
                        <i class="bi bi-percent me-2"></i>Discounts
                    </a>
                </div>

                <!-- Voucher Types Grid -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Create New Voucher</h4>
                        <p class="text-muted">Choose the type of voucher you want to create</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">🎫</div>
                                    <h4>Limited Voucher</h4>
                                    <p class="flex-grow-1">Voucher for specific Buyers that can only be shared through a
                                        code</p>
                                    <a href="{{ route('create-promo-voucher') }}"
                                        class="btn btn-primary mt-3">Create</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">🛒</div>
                                    <h4>Brand Voucher</h4>
                                    <p class="flex-grow-1">Voucher for your brand to increase sales</p>
                                    <a href="{{ route('create-promo-brand-voucher') }}"
                                        class="btn btn-primary mt-3">Create</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">📦</div>
                                    <h4>Product Voucher</h4>
                                    <p class="flex-grow-1">Voucher for selected products as part of specific promotions
                                    </p>
                                    <a href="{{ route('create-promo-product-voucher') }}"
                                        class="btn btn-primary mt-3">Create</a>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">🚌</div>
                                    <h4>Shipping Fee Voucher</h4>
                                    <p>Shipping Fee Voucher applicable on selected products as part of specific
                                        promotions
                                    </p>
                                    <a href="{{ route('create-promo-voucher-shippingfee') }}"
                                        class="btn btn-primary">Create</a>
                                </div>
                            </div> --}}
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">👨‍💼</div>
                                    <h4>New User Voucher</h4>
                                    <p>New User Voucher applicable on selected products as part of specific
                                        promotions
                                    </p>
                                    <a href="{{ route('create-promo-voucher-new-user') }}"
                                        class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Voucher List -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Active Vouchers</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Voucher Details</th>
                                        <th>Type</th>
                                        <th>Period</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promo as $item)
                                        <tr id="promo-item-{{ $item->id }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ Storage::url($item->image) }}"
                                                        alt="{{ $item->promo_name }}" class="voucher-image"
                                                        onclick="openImageInNewTab('{{ Storage::url($item->image) }}')">
                                                    <div>
                                                        <h6 class="mb-0">
                                                            {{ Str::limit($item->promo_name, 40, '...') }}</h6>
                                                        <small class="text-muted">Code:
                                                            {{ $item->promo_code }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <div>
                                                    <div class="mb-1">
                                                        <i class="bi bi-calendar-event me-2"></i>
                                                        {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }}
                                                    </div>
                                                    <div>
                                                        <i class="bi bi-calendar-event-fill me-2"></i>
                                                        {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($item->discount_type === 'nominal')
                                                    Rp
                                                    @php
                                                        $discount = str_replace('.', '', $item->discount); // Hapus titik untuk konversi angka
                                                    @endphp
                                                    {{ is_numeric($discount) ? number_format($discount, 0, ',', '.') : '0' }}
                                                @else
                                                    {{ is_numeric($item->discount) ? $item->discount : '0' }}%
                                                @endif
                                            </td>

                                            <td>
                                                @php
                                                    $isActive = \Carbon\Carbon::parse($item->end_date)->isFuture();
                                                @endphp
                                                <span
                                                    class="badge {{ $isActive ? 'status-active' : 'status-expired' }}">
                                                    {{ $isActive ? 'Active' : 'Expired' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ url('edit-promo-voucher/' . $item->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <a href="{{ url('detail-promo-voucher/' . $item->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="badge bg-danger delete-promo"
                                                        data-id="{{ $item->id }}">
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
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            // $('#voucherTable').DataTable();

            // Image preview functionality
            document.querySelectorAll('.voucher-image').forEach(function(img) {
                img.addEventListener('click', function() {
                    window.open(this.src, '_blank');
                });
            });

            // Delete promo functionality
            document.querySelectorAll('.delete-promo').forEach(function(deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this promo?')) {
                        var promoId = this.getAttribute('data-id');
                        // Add your delete logic here, e.g., AJAX call to delete the promo
                        console.log('Deleting promo with ID:', promoId);
                    }
                });
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
                if (event.target.closest('.delete-promo')) {
                    let promoId = event.target.closest('.delete-promo').getAttribute('data-id');

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
                            // Send AJAX request to delete promo
                            fetch(`/delete-promo/${promoId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Remove the promo from the page
                                        let promoRow = document.querySelector(
                                            `#promo-item-${promoId}`);
                                        if (promoRow) {
                                            promoRow.remove();
                                        }
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

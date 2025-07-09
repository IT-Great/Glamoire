<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon - Glamoire</title>
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
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        /* Stats Card Styling */
        .stats-card {
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stats-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .stats-card-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-title {
            font-size: 0.9rem;
            font-weight: 400;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .action-buttons .btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .discount-nav {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .discount-nav-item {
            padding: 10px 20px;
            border-radius: 8px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .discount-nav-item.active {
            background: #435ebe;
            color: white;
        }

        .discount-nav-item:hover:not(.active) {
            background: #e9ecef;
        }

        .discount-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .discount-card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .badge {
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
        }

        .status-active {
            background-color: #4CAF50;
        }

        .status-expired {
            background-color: #f44336;
        }

        .discount-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .discount-tier {
            border-left: 4px solid #435ebe;
            padding-left: 10px;
            margin: 5px 0;
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
            background: white;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <!-- Breadcrumb and Title -->
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Diskon</h3>
                            <p class="text-subtitle text-muted">Kelola semua data diskon Anda dengan efektif</p>
                        </div>
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-promo-diskon') }}" class="d-flex align-items-center">
                                            <i class="bi bi-percent me-1"></i> Diskon
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Semua Diskon</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4 slide-in">
                    <!-- Active Promo -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-gift-fill"></i> <!-- Ganti dari envelope ke gift -->
                            </div>
                            <div class="stats-title">Active Promo</div>
                            <h3 class="mb-0">{{ $activePromos ?? 0 }}</h3>

                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-gift me-1"></i>
                                    Promo spesial yang sedang berjalan
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Active Vouchers -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-success">
                            <div class="stats-icon">
                                <i class="bi bi-tag"></i> <!-- Voucher ikon -->
                            </div>
                            <div class="stats-title">Active Vouchers</div>
                            <h3 class="stats-number">{{ $activeVouchers ?? 0 }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Voucher siap digunakan oleh pelanggan
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Active Discount -->
                    <div class="col-12 col-md-4">
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-percent"></i> <!-- Diskon ikon -->
                            </div>
                            <div class="stats-title">Active Discount</div>
                            <h3 class="stats-number">{{ $activeDiscounts ?? 0 }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-tags me-1"></i>
                                    Diskon menarik untuk produk pilihan
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('index-promo') }}"
                        class="promo-nav-item {{ Request::is('promo') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill me-2"></i>Promo
                    </a>
                    <a href="{{ route('index-promo-voucher') }}"
                        class="promo-nav-item {{ Request::is('promo-voucher') ? 'active' : '' }}">
                        <i class="bi bi-receipt-cutoff me-2"></i>Voucher
                    </a>
                    <a href="{{ route('index-promo-diskon') }}"
                        class="promo-nav-item {{ Request::is('promo-diskon') ? 'active' : '' }}">
                        <i class="bi bi-percent me-2"></i>Diskon
                    </a>
                </div>

                <!-- Main Content -->
                <div class="card discount-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Semua Diskon</h5>
                        <a href="{{ route('create-promo-diskon') }}"
                            class="btn btn-sm btn-primary d-inline-flex align-items-center gap">
                            <i class="bi bi-plus"></i>Buat Diskon
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama Diskon</th>
                                        <th>Periode</th>
                                        <th>Detail Diskon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promodiscount as $item)
                                        <tr id="promo-item-{{ $item->id }}">
                                            <td>
                                                <div class="d-flex flex-column">
                                                    {{-- <h6 class="mb-1">{{ $item->promo_name }}</h6> --}}
                                                    <h6 class="mb-1">
                                                        {{ Str::limit($item->promo_name, 20, '...') }}
                                                    </h6>
                                                    <small class="text-muted">ID: #{{ $item->id }}</small>
                                                </div>
                                            </td>
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
                                                <div class="discount-info">
                                                    {!! $item->all_discount_tiers !!}
                                                </div>
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
                                                    <a href="{{ url('detail-diskon/' . $item->id) }}"
                                                        class="btn btn-sm btn-info d-inline-flex align-items-center">
                                                        <i class="bi bi-eye me-1"></i> View
                                                    </a>
                                                    <button
                                                        class="btn btn-sm btn-danger delete-promo d-inline-flex align-items-center"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash me-1"></i> Delete
                                                    </button>
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

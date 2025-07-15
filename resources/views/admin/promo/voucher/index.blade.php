<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher - Glamoire</title>
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

        .page-title h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: var(--text-secondary);
            margin-bottom: 0;
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

        .action-buttons a {
            display: block;
            margin-bottom: 5px;
        }

        .promo-nav {
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .promo-nav-item {
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: #4a4a4a;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid transparent;
        }

        .promo-nav-item i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .promo-nav-item.active {
            background-color: var(--primary-color);
            /* Make sure --primary-color is defined */
            color: #fff;
            border-color: var(--primary-color);
        }

        .promo-nav-item.active i {
            transform: scale(1.2);
            color: #fff;
        }

        .promo-nav-item:hover:not(.active) {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
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
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Voucher</h3>
                            <p class="text-subtitle text-muted">Buat dan kelola voucher toko Anda dengan efektif</p>
                        </div>
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-promo-voucher') }}" class="d-flex align-items-center">
                                            <i class="bi bi-tag me-1"></i> Voucher
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Semua Voucher</li>
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

                <!-- Voucher Types Grid -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Buat Voucher Baru</h4>
                        {{-- <p class="text-muted">Choose the type of voucher you want to create</p> --}}
                        <p class="text-muted">Pilih type Voucher yang ingin anda buat</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">🎫</div>
                                    <h4>Voucher Terbatas</h4>
                                    <p class="flex-grow-1">Voucher untuk pembeli tertentu yang hanya dapat dibagikan
                                        melalui kode</p>
                                    <a href="{{ route('create-promo-voucher') }}" class="btn btn-primary mt-3">Buat</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">🛒</div>
                                    <h4>Brand Voucher</h4>
                                    <p class="flex-grow-1">Voucher untuk merek Anda guna meningkatkan penjualan</p>
                                    <a href="{{ route('create-promo-brand-voucher') }}"
                                        class="btn btn-primary mt-3">Buat</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">📦</div>
                                    <h4>Voucher Produk</h4>
                                    <p class="flex-grow-1">Voucher untuk produk tertentu sebagai bagian dari promosi
                                        spesifik</p>
                                    <a href="{{ route('create-promo-product-voucher') }}"
                                        class="btn btn-primary mt-3">Buat</a>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="voucher-card">
                                    <div class="voucher-icon">👨‍💼</div>
                                    <h4>Voucher Pengguna Baru</h4>
                                    <p>Voucher Pengguna Baru yang berlaku untuk produk tertentu sebagai bagian dari
                                        promosi spesifik</p>
                                    <a href="{{ route('create-promo-voucher-new-user') }}"
                                        class="btn btn-primary">Buat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Voucher List -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Voucher Aktif</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Detail Voucher</th>
                                        <th>Jenis</th>
                                        <th>Periode</th>
                                        <th>Diskon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promovouchers as $item)
                                        <tr id="promo-item-{{ $item->id }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ Storage::url($item->image) }}"
                                                        alt="{{ $item->promo_name }}" class="voucher-image"
                                                        onclick="openImageInNewTab('{{ Storage::url($item->image) }}')">
                                                    <div>
                                                        <h6 class="mb-0">
                                                            {{ Str::limit($item->promo_name, 40, '...') }}</h6>
                                                        <small class="text-muted">Kode:
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
                                                        $discount = str_replace('.', '', $item->discount);
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
                                                    {{ $isActive ? 'Aktif' : 'Kadaluarsa' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ url('detail-promo-voucher/' . $item->id) }}"
                                                        class="btn btn-sm btn-info d-inline-flex align-items-center">
                                                        <i class="bi bi-eye me-1"></i> View
                                                    </a>
                                                    {{-- <a href="{{ url('edit-promo-voucher/' . $item->id) }}"
                                                        class="btn btn-sm btn-warning d-inline-flex align-items-center">
                                                        <i class="bi bi-pencil me-1"></i> Edit
                                                    </a> --}}
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm btn-danger delete-promo d-inline-flex align-items-center"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash me-1"></i> Delete
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

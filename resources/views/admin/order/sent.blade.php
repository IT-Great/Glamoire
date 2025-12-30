<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
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

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
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

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table> :not(:first-child) {
            border-top: none;
        }

        .table th {
            font-weight: 600;
            color: var(--text-primary);
            background-color: rgba(243, 246, 249, 0.6);
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding: 1.25rem 1.5rem;
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .table>tbody>tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Stock Badge */
        .stock-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .badge.bg-info {
            background-color: var(--info-color) !important;
            color: white;
        }

        .badge.bg-danger {
            background-color: var(--danger-color) !important;
        }

        /* Quick Action Button */
        .quick-action-btn {
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .stats-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .table td {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .product-details {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .d-flex.align-items-center.gap-3 {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .action-buttons .badge {
                display: block;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--secondary-color) !important;
            color: white !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            opacity: 0.5;
            margin-bottom: 1.5rem;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .order-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .order-table img:hover {
            transform: scale(1.1);
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-title">
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3 class="mb-2">Produk Dalam Proses Pengiriman</h3>
                            <p>Kelola pesanan produk pelanggan yang sedang dalam proses pengiriman pada halaman ini</p>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index-admin-order') }}"
                                        class="d-flex align-items-center"><i class="bi bi-envelope me-1"></i>Order</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">List Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>

            <!-- Main Tabs -->
            <div class="border-bottom mb-4">
                <ul class="nav nav-tabs border-0">
                    <li class="nav-item">
                        <a href="{{ route('index-admin-order') }}"
                            class="nav-link {{ request()->get('status') === null ? 'active text-primary' : 'text-secondary' }}">
                            Semua
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index-admin-order-need-sent', ['status' => 'pending']) }}"
                            class="nav-link {{ request()->get('status') === 'pending' ? 'active text-primary' : 'text-secondary' }}">
                            Perlu Dikirim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index-admin-order-sent', ['status' => 'shipping']) }}"
                            class="nav-link {{ request()->get('status') === 'shipping' ? 'active text-primary' : 'text-secondary' }}">
                            Dikirim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index-admin-order-complete-sent', ['status' => 'completed']) }}"
                            class="nav-link {{ request()->get('status') === 'completed' ? 'active text-primary' : 'text-secondary' }}">
                            Selesai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index-admin-order-returned', ['status' => 'returned']) }}"
                            class="nav-link {{ request()->get('status') === 'returned' ? 'active text-primary' : 'text-secondary' }}">
                            Pengembalian/Pembatalan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                <i class="fa fa-info-circle me-2"></i>
                Ini adalah halaman pesanan yang sedang dalam proses pengiriman. Anda dapat memantau status
                pengiriman dan memastikan
                pesanan sampai kepada pelanggan sesuai jadwal.
                <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Orders Table -->
            <div class="card order-table">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Daftar Pesanan</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th style="min-width: 300px">Produk</th>
                                <th style="min-width: 120px">Dibayar</th>
                                <th>Status</th>
                                <th style="min-width: 130px">Jasa Kirim</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <div class="order-header mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="bi bi-person-fill text-secondary"></i>
                                                    <span class="fw-medium">{{ $order->user->fullname }}</span>
                                                </div>
                                                <div class="text-secondary small">
                                                    <i class="bi bi-receipt me-1"></i>
                                                    Invoice : {{ $order->invoice->no_invoice }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-details">
                                            @foreach ($order->orderItems as $item)
                                                <div class="d-flex gap-3 mb-3">
                                                    <img src="{{ Storage::url($item->product->main_image) }}"
                                                        alt="{{ $item->product->product_name }}"
                                                        onclick="openImageInNewTab('{{ Storage::url($item->product->main_image) }}')"
                                                        loading="lazy">
                                                    <div class="product-info">
                                                        <div class="product-name">
                                                            {{ $item->product->product_name }}
                                                        </div>
                                                        <div class="product-meta">
                                                            <i class="bi bi-box me-1"></i>
                                                            Qty: {{ $item->quantity }}
                                                        </div>
                                                        <div class="product-meta">
                                                            <i class="bi bi-upc me-1"></i>
                                                            {{ $item->product->product_code }}
                                                        </div>
                                                        <div class="product-meta">
                                                            <i class="bi bi-tag me-1"></i>
                                                            {{ $item->product->categoryProduct->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">
                                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                        </div>
                                        <div class="text-secondary small mt-1">
                                            <i class="bi bi-credit-card me-1"></i>
                                            {{ $order->payment->method ?? 'Online Payment' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <i class="bi bi-truck d-inline-flex align-items-center"></i>
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>{{ $order->shipping->method ?? 'J&T Express' }}</div>
                                        <div class="text-secondary small">
                                            {{ $order->shippingAddress->province ?? '' }},
                                            {{ $order->shippingAddress->regency ?? '' }},
                                            {{ $order->shippingAddress->district ?? '' }},
                                            {{ $order->shippingAddress->address ?? '' }}
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 me-2"
                                            onclick="confirmCompleteOrder({{ $order->id }})">
                                            <i class="bi bi-bag-check"></i> Selesaikan Pesanan
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        function confirmCompleteOrder(orderId) {
            // Tampilkan modal konfirmasi SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Apakah Anda yakin ingin mengubah status dari delivery ke completed?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim AJAX request untuk update status
                    fetch(`/orders/${orderId}/complete`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 3000, // Auto-close alert after 2 seconds
                                    timerProgressBar: true, // Show progress bar
                                    showConfirmButton: true // Show OK button
                                }).then(() => {
                                    location.reload(); // Refresh halaman atau perbarui UI
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Terjadi Kesalahan!',
                                text: 'Gagal mengubah status pesanan.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        }
    </script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    {{-- JavaScript for image preview --}}
    <script>
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
    </script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

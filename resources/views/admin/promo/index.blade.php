<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Glamoire</title>
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

        .stats-card-danger {
            background: linear-gradient(135deg, var(--danger-color), #ef4444);
            color: white;
        }

        .stats-card-info {
            background: linear-gradient(135deg, var(--info-color), #3b82f6);
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

        .promo-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .promo-card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .promo-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .promo-image:hover {
            transform: scale(1.1);
        }

        .badge {
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
        }


        /* Tambahkan CSS ini untuk kustomisasi tampilan SweetAlert */
        .swal2-popup {
            font-size: 1rem !important;
        }

        .swal-icon-success,
        .swal-icon-error,
        .swal-icon-question {
            border: none !important;
        }

        .swal2-timer-progress-bar {
            background: #4A69E2 !important;
        }

        /* Style untuk badge status */
        .status-active {
            background-color: #4CAF50 !important;
            color: white;
        }

        .status-expired {
            background-color: #f44336 !important;
            color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <!-- Breadcrumb -->
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3>Promo</h3>
                            <p class="text-subtitle text-muted">Kelola semua data promosi Anda pada halaman ini.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-12 col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index-promo') }}" class="d-flex align-items-center">
                                        <i class="bi bi-receipt me-1"></i> Promo
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Semua Promo Event</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row mb-4 slide-in">
                    <!-- Active Promo -->
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-receipt"></i> <!-- Ganti dari envelope ke gift -->
                            </div>
                            <div class="stats-title">Active Promo</div>
                            <h3 class="mb-0">{{ $activePromos ?? 0 }}</h3>

                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-receipt me-1"></i>
                                    Promo spesial yang sedang berjalan
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Active Vouchers -->
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
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
                    <div class="col-12 col-md-3">
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

                    <!-- Active Gift -->
                    <div class="col-12 col-md-3">
                        <div class="stats-card stats-card-info">
                            <div class="stats-icon">
                                <i class="bi bi-gift"></i>
                            </div>
                            <div class="stats-title">Active Gift</div>
                            <h3 class="stats-number">{{ $activeGifts ?? 0 }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-gift me-1"></i>
                                    Hadiah menarik untuk pembelian tertentu
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('index-promo') }}"
                        class="promo-nav-item {{ Request::is('promo') ? 'active' : '' }}">
                        <i class="bi bi-receipt me-2"></i>Promo
                    </a>
                    <a href="{{ route('index-promo-voucher') }}"
                        class="promo-nav-item {{ Request::is('promo-voucher') ? 'active' : '' }}">
                        <i class="bi bi-receipt-cutoff me-2"></i>Voucher
                    </a>
                    <a href="{{ route('index-promo-diskon') }}"
                        class="promo-nav-item {{ Request::is('promo-diskon') ? 'active' : '' }}">
                        <i class="bi bi-percent me-2"></i>Diskon
                    </a>
                    {{-- <a href="{{ route('index-promo-gift') }}"
                        class="promo-nav-item {{ Request::is('promo-gift') ? 'active' : '' }}">
                        <i class="bi bi-gift-fill me-2"></i>Gift
                    </a> --}}
                </div>

                <!-- Main Content -->
                <div class="card promo-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center"><i class="bi bi-receipt me-2"></i>Data Promo</h5>
                        <a href="{{ route('create-promo') }}"
                            class="btn btn-sm btn-primary d-inline-flex align-items-center gap">
                            <i class="fa fa-plus me-2"></i>Buat Promo
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Detail Promo</th>
                                        <th>Periode</th>
                                        <th>Diskon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promo as $item)
                                        <tr id="promo-item-{{ $item->id }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ Storage::url($item->image) }}"
                                                        alt="{{ $item->promo_name }}" class="promo-image"
                                                        onclick="openImageInNewTab('{{ Storage::url($item->image) }}')">
                                                    <div>
                                                        <h6 class="mb-0">
                                                            {{ Str::limit($item->promo_name, 40, '...') }}</h6>
                                                        <small class="text-muted">Code:
                                                            {{ $item->promo_code }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="mb-1">
                                                        <i class="bi bi-calendar-event me-2"></i>
                                                        @if ($item->start_date)
                                                            {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }}
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <i class="bi bi-calendar-event-fill me-2"></i>
                                                        @if ($item->end_date)
                                                            {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge bg-light-primary">
                                                    @if ($item->discount_type === 'nominal')
                                                        Rp {{ number_format($item->discount, 0, ',', '.') }}
                                                    @else
                                                        {{ $item->discount }}%
                                                    @endif
                                                </span>
                                            </td>

                                            <td>
                                                @php
                                                    $isActive = $item->end_date
                                                        ? \Carbon\Carbon::parse($item->end_date)->isFuture()
                                                        : false;
                                                @endphp
                                                <span
                                                    class="badge {{ $isActive ? 'status-active' : 'status-expired' }}">
                                                    {{ $isActive ? 'Active' : 'Expired' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ url('detail-promo/' . $item->id) }}"
                                                        class="btn btn-sm btn-info d-inline-flex align-items-center">
                                                        <i class="bi bi-eye me-1"></i> View
                                                    </a>
                                                    <a href="{{ url('edit-promo/' . $item->id) }}"
                                                        class="btn btn-sm btn-warning d-inline-flex align-items-center">
                                                        <i class="bi bi-pencil me-1"></i> Edit
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm btn-danger delete-promo d-inline-flex align-items-center"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                    <!-- Tambahkan modal konfirmasi ini di bagian bawah view -->
                                    <div class="modal fade" id="toggleStatusModal" tabindex="-1"
                                        aria-labelledby="toggleStatusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="toggleStatusModalLabel">Konfirmasi
                                                        Perubahan Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="toggleStatusMessage">Apakah Anda yakin ingin mengubah status
                                                        promo ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="confirmToggle">Ya, Ubah Status</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

    {{-- handle toggle status --}}
    <script>
        // Tambahkan script ini di bagian bawah view atau dalam file js terpisah
        $(document).ready(function() {
            let toggleTarget = null;
            let originalState = false;

            // Handler untuk toggle switch
            $('.status-toggle').on('change', function(e) {
                e.preventDefault();
                toggleTarget = $(this);
                originalState = !toggleTarget.prop('checked');

                // Tampilkan SweetAlert konfirmasi
                const newStatus = toggleTarget.prop('checked') ? 'Active' : 'Expired';

                Swal.fire({
                    title: 'Konfirmasi Perubahan Status',
                    text: `Apakah Anda yakin ingin mengubah status promo menjadi ${newStatus}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4A69E2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah Status',
                    cancelButtonText: 'Batal',
                    customClass: {
                        icon: 'swal-icon-question'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const promoId = toggleTarget.data('id');
                        const newCheckedState = toggleTarget.prop('checked');

                        $.ajax({
                            url: `/promo/toggle-status/${promoId}`,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Update badge status
                                    const statusBadge = toggleTarget.closest('tr').find(
                                        '.status-badge');
                                    const newStatus = toggleTarget.prop('checked');

                                    if (newStatus) {
                                        statusBadge.removeClass('status-expired')
                                            .addClass('status-active');
                                        statusBadge.text('Active');
                                    } else {
                                        statusBadge.removeClass('status-active')
                                            .addClass('status-expired');
                                        statusBadge.text('Expired');
                                    }

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#4A69E2',
                                        customClass: {
                                            icon: 'swal-icon-success'
                                        },
                                        timer: 1800,
                                        timerProgressBar: true,
                                        didClose: () => {
                                            // Optional: trigger any action after alert closes
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                // Kembalikan toggle ke posisi semula jika terjadi error
                                toggleTarget.prop('checked', originalState);

                                // Tampilkan pesan error
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat mengubah status promo',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#4A69E2',
                                    customClass: {
                                        icon: 'swal-icon-error'
                                    }
                                });
                            }
                        });
                    } else {
                        // Jika user membatalkan, kembalikan toggle ke posisi semula
                        toggleTarget.prop('checked', originalState);
                    }
                });
            });
        });
    </script>

    {{-- handle hapus data --}}
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

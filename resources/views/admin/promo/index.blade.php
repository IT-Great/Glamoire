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

        .action-buttons a {
            display: block;
            /* Set to block so each link appears on a new line */
            margin-bottom: 5px;
            /* Add some space between the buttons */
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Promo Management</h3>
                            <p class="text-subtitle text-muted">Kelola semua data promosi Anda dalam satu tempat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4 slide-in">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-box fs-3"></i>
                            </div>
                            <div class="stats-title">Active Promo</div>
                            <h3 class="mb-0">{{ $activePromos ?? 0 }}</h3>

                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </div>
                            <div class="stats-title">Active Vouchers</div>
                            <h3 class="stats-number">{{ $activeVouchers ?? 0 }}</h3>

                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="stats-card stats-card-success">
                            <div class="stats-icon">
                                <i class="bi bi-percent"></i>
                            </div>
                            <div class="stats-title">Active Discount</div>
                            <h3 class="stats-number">{{ $activeDiscounts ?? 0 }}</h3>

                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="promo-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('index-promo') }}"
                        class="promo-nav-item {{ Request::is('promo') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill me-2"></i>All Promos
                    </a>
                    <a href="{{ route('index-promo-voucher') }}"
                        class="promo-nav-item {{ Request::is('promo-voucher') ? 'active' : '' }}">
                        <i class="bi bi-receipt-cutoff me-2"></i>Vouchers
                    </a>
                    <a href="{{ route('index-promo-diskon') }}"
                        class="promo-nav-item {{ Request::is('promo-diskon') ? 'active' : '' }}">
                        <i class="bi bi-percent me-2"></i>Discounts
                    </a>
                </div>

                <!-- Main Content -->
                <div class="card promo-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Promotional Campaigns</h5>
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
                                        <th>Campaign Details</th>
                                        <th>Period</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        {{-- <th>Is Active</th> --}}
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
                                                <a href="{{ url('detail-promo/' . $item->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ url('edit-promo/' . $item->id) }}"
                                                    class="badge bg-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="javascript:void(0);" class="badge bg-danger delete-promo"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
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

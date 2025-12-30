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
                            <h3 class="mb-2">Produk Perlu Dikirim</h3>
                            <p>Kelola daftar produk yang perlu dikirim kepada pelanggan pada halaman ini</p>
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

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs border-bottom-0 mb-3">
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

            <!-- Info Alert -->
            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                <i class="fa fa-info-circle me-2"></i>
                Halaman ini menampilkan pesanan yang perlu dikirim. Anda dapat melihat detail pesanan yang harus
                segera
                diproses dan dikirimkan kepada pelanggan. Pastikan semua informasi pengiriman sudah lengkap sebelum
                memproses pengiriman.
                <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="card order-table">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Daftar Pesanan</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th style="min-width: 300px">Order Detail</th>
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
                                            @foreach ($order->groupedOrderItems as $item)
                                                <div class="d-flex gap-3 mb-3">
                                                    <img src="{{ Storage::url($item['product']->main_image) }}"
                                                        alt="{{ $item['product']->product_name }}"
                                                        onclick="openImageInNewTab('{{ Storage::url($item['product']->main_image) }}')"
                                                        loading="lazy">
                                                    <div class="product-info">
                                                        <div class="product-name">
                                                            {{ Str::limit($item['product']->product_name, 60, '...') }}
                                                        </div>
                                                        <div class="product-meta">
                                                            <i class="bi bi-box me-1"></i>
                                                            Qty: {{ $item['total_quantity'] }}
                                                        </div>
                                                        <div class="product-meta">
                                                            <i class="bi bi-upc me-1"></i>
                                                            {{ $item['product']->product_code }}
                                                        </div>
                                                        <div class="product-meta">
                                                            <i class="bi bi-tag me-1"></i>
                                                            {{ $item['product']->categoryProduct->name }}
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
                                            {{ $order->payment_method }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            <i class="bi bi-box d-inline-flex align-items-center"></i>
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="shipping-details">
                                        <div class="fw-medium">
                                            {{ $order->kurir ?? 'J&T Express' }} Kirim Ke :
                                            @if ($order->shippingAddress)
                                                {{ $order->shippingAddress->province ?? '' }},
                                                {{ $order->shippingAddress->regency ?? '' }},
                                                {{ $order->shippingAddress->district ?? '' }},
                                                {{ $order->shippingAddress->address ?? '' }}
                                            @else
                                                Alamat tidak tersedia
                                            @endif
                                        </div>
                                        <!-- Display the resi number if it exists -->
                                        @if (!empty($order->resi))
                                            <div class="mt-2">
                                                <span class="badge bg-success">
                                                    <i class="bi bi-truck me-1"></i>
                                                    Resi: {{ $order->resi }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- bikin sendiri --}}
                                    <td>
                                        <!-- Generate Shipping Label Button -->
                                        @if (empty($order->resi))
                                            <a href="{{ route('generate-shipping-label', $order->id) }}"
                                                class="action-button btn btn-danger btn-sm mb-2">
                                                <i class="bi bi-tag-fill me-1"></i>
                                                Generate Label Pengiriman
                                            </a>
                                        @else
                                            <!-- View Shipping Label Button -->
                                            <a href="{{ route('view-shipping-label', $order->id) }}"
                                                class="action-button btn btn-info btn-sm mb-2">
                                                <i class="bi bi-file-earmark-text me-1"></i>
                                                Lihat Label Pengiriman
                                            </a>

                                            <!-- Update to Shipping Status -->
                                            @if ($order->status === 'processing')
                                                <form action="{{ route('update-shipping-status', $order->id) }}"
                                                    method="POST" class="mb-2">
                                                    @csrf
                                                    <button type="submit"
                                                        class="action-button btn btn-primary btn-sm">
                                                        <i class="bi bi-truck me-1"></i>
                                                        Kirim Pesanan
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        <button type="button" class="action-button btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#sentModal-{{ $order->id }}">
                                            <i class="bi bi-gear me-1"></i>
                                            Atur Pengiriman
                                        </button>
                                    </td>

                                    {{-- berdu agregaotr --}}
                                    {{-- <td>
                                            <div class="d-flex flex-column gap-2">
                                                <button type="button"
                                                    class="action-button btn btn-outline-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#sentModal-{{ $order->id }}">
                                                    <i class="bi bi-truck me-1"></i>
                                                    Atur Pengiriman
                                                </button>

                                                <a href="{{ route('admin.generate-label', ['order_id' => $order->id]) }}"
                                                    class="action-button btn btn-outline-success btn-sm">
                                                    <i class="bi bi-printer me-1"></i>
                                                    Generate Label
                                                </a>
                                            </div>
                                        </td> --}}

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

    {{-- berdu agregator --}}
    {{-- <script>
        function toggleResiInput(radioElement) {
            const orderId = radioElement.name.split('_')[2]; // Extract order ID from name
            const resiContainer = document.getElementById(`resiInputContainer-${orderId}`);

            if (radioElement.checked) {
                resiContainer.style.display = 'block';
            }
        }

        // Function to handle shipping confirmation
        function konfirmasiPengiriman(orderId) {
            const selectedMethod = document.querySelector(`input[name="shipping_method_${orderId}"]:checked`);

            if (!selectedMethod) {
                alert('Silakan pilih metode pengiriman terlebih dahulu');
                return;
            }

            const resiNumber = document.getElementById(`resiNumber-${orderId}`).value;

            if (!resiNumber || resiNumber.trim() === '') {
                alert('Silakan masukkan nomor resi terlebih dahulu');
                return;
            }

            // Send AJAX request to update resi and status
            fetch('/admin/orders/update-resi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        resi_number: resiNumber
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pengiriman berhasil dikonfirmasi');

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(`sentModal-${orderId}`));
                        modal.hide();

                        // Reload page to refresh data
                        window.location.reload();
                    } else {
                        alert('Gagal mengkonfirmasi pengiriman: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengkonfirmasi pengiriman');
                });
        }

        // Function to open image in new tab
        function openImageInNewTab(imageUrl) {
            window.open(imageUrl, '_blank');
        }
    </script> --}}


    {{-- bikin sendiri --}}
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show toast message
                const toast = document.createElement('div');
                toast.className =
                    'toast align-items-center bg-success text-white border-0 position-fixed bottom-0 end-0 m-3';
                toast.setAttribute('role', 'alert');
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');
                toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>
                    Nomor resi berhasil disalin!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

                document.body.appendChild(toast);
                const bsToast = new bootstrap.Toast(toast, {
                    autohide: true,
                    delay: 3000
                });
                bsToast.show();

                // Remove the toast element after it's hidden
                toast.addEventListener('hidden.bs.toast', function() {
                    document.body.removeChild(toast);
                });
            }).catch(function(err) {
                console.error('Failed to copy text: ', err);
                alert('Gagal menyalin nomor resi!');
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table = new simpleDatatables.DataTable("#table1", {
                searchable: true,
                fixedHeight: true,
            });
        });


        function toggleResiInput(radioElement) {
            // Get the order ID from the radio button's name
            const orderId = radioElement.getAttribute('name').replace('shipping_method_', '');

            // Find the resi input container
            const resiContainer = document.getElementById(`resiInputContainer-${orderId}`);

            // Show the resi input if a shipping method is selected
            if (radioElement.checked) {
                resiContainer.style.display = 'block';
            } else {
                resiContainer.style.display = 'none';
            }
        }

        function konfirmasiPengiriman(orderId) {
            // Get the selected shipping method
            const shippingMethod = document.querySelector(`input[name="shipping_method_${orderId}"]:checked`);

            if (!shippingMethod) {
                alert('Silakan pilih metode pengiriman');
                return;
            }

            // Get the resi number
            const resiInput = document.getElementById(`resiNumber-${orderId}`);

            if (!resiInput.value.trim()) {
                alert('Silakan masukkan nomor resi');
                return;
            }

            // Prepare the data to send
            const formData = new FormData();
            formData.append('shipping_method', shippingMethod.value);
            formData.append('resi_number', resiInput.value);

            // Send AJAX request
            fetch(`/orders/${orderId}/confirm-shipping`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal after successful confirmation
                        $(`#sentModal-${orderId}`).modal('hide');

                        // Show success message using SweetAlert
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            timer: 3000, // Auto-close alert after 2 seconds
                            timerProgressBar: true, // Show progress bar
                            showConfirmButton: true // Show OK button
                        }).then(() => {
                            // Optionally, refresh the page or update the UI
                            location.reload(); // or use AJAX to update the specific order row
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
                        text: 'Terjadi kesalahan saat mengkonfirmasi pengiriman',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
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

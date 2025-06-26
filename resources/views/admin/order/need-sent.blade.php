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
        /* CSS for toast message and button styling */
        /* Add this to your CSS file or in a style tag in your layout */

        /* Custom styling for toast notifications */
        .toast {
            z-index: 1060;
        }

        /* Styles for the Generate Resi button */
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Style for resi badge */
        .badge.bg-success {
            font-size: 0.85rem;
            padding: 0.35rem 0.65rem;
        }

        /* Animation for copy to clipboard success */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .toast-show {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Make pointer cursor for copyable elements */
        .copyable {
            cursor: pointer;
        }

        /* Responsive styling for mobile devices */
        @media (max-width: 767.98px) {
            td .action-button {
                margin-bottom: 0.5rem;
                display: block;
                width: 100%;
            }
        }

        /* Add some hover effect to the resi badge */
        .badge.bg-success:hover {
            background-color: #1d9238 !important;
            cursor: pointer;
        }


        .order-table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
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

        .order-table th {
            background-color: #f8f9fa;
            padding: 15px;
            font-weight: 600;
            white-space: nowrap;
            border-bottom: 2px solid #dee2e6;
        }

        .order-table td {
            vertical-align: middle;
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
        }

        .order-header {
            padding: 10px 15px;
            background-color: #f8fafc;
            border-bottom: 1px solid #eee;
        }

        .product-details {
            min-width: 250px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .product-name {
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .product-meta {
            color: #718096;
            font-size: 0.85rem;
        }

        .shipping-details {
            min-width: 150px;
            line-height: 1.5;
        }

        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 6px;
        }

        @media (max-width: 991.98px) {
            .order-table td {
                padding: 15px 10px;
            }

            .product-details {
                min-width: 200px;
            }

            .shipping-details {
                min-width: 120px;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/order-sent-admin">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Need Sent</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h4 mb-0">Pesanan Saya</h1>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            Riwayat Download
                        </button>
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
                        <a href="{{ route('index-admin-order-complete-sent', ['status' => 'returned']) }}"
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
                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
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

                                            <button type="button"
                                                class="action-button btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#sentModal-{{ $order->id }}">
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

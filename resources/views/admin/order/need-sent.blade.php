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
                                                {{ $order->shipping_method ?? 'J&T Express' }} Kirim Ke :
                                                @if ($order->shippingAddress)
                                                    {{ $order->shippingAddress->province ?? '' }},
                                                    {{ $order->shippingAddress->regency ?? '' }},
                                                    {{ $order->shippingAddress->district ?? '' }},
                                                    {{ $order->shippingAddress->address ?? '' }}
                                                @else
                                                    Alamat tidak tersedia
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            <button type="button"
                                                class="action-button btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#sentModal-{{ $order->id }}">
                                                <i class="bi bi-truck me-1"></i>
                                                Atur Pengiriman
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal for each order -->
                                    <div class="modal fade" id="sentModal-{{ $order->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">Kirim Pesanan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body pt-0">
                                                    <div class="d-flex align-items-center mb-4">
                                                        <i class="bi bi-arrow-left me-2"></i>
                                                        <span class="text-secondary">
                                                            {{-- {{ $order->invoice->no_invoice }} --}}
                                                        </span>
                                                    </div>
                                                    <div class="row g-4">
                                                        <div class="col-md-6">
                                                            <label
                                                                class="card h-100 border rounded position-relative p-3"
                                                                style="cursor: pointer;">
                                                                <input type="radio"
                                                                    name="shipping_method_{{ $order->id }}"
                                                                    value="counter"
                                                                    class="shipping-method-radio position-absolute"
                                                                    style="top: 10px; right: 10px;"
                                                                    onchange="toggleResiInput(this)">
                                                                <div class="text-center">
                                                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                        style="width: 60px; height: 60px;">
                                                                        <i class="bi bi-shop fs-4"></i>
                                                                    </div>
                                                                    <h6 class="mb-2">Saya Akan Antar Ke Counter</h6>
                                                                    <p class="text-secondary small mb-0">Anda dapat
                                                                        mengirimkan paket Anda di cabang Ekspedisi
                                                                        terdekat di kota Anda</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label
                                                                class="card h-100 border rounded position-relative p-3"
                                                                style="cursor: pointer;">
                                                                <input type="radio"
                                                                    name="shipping_method_{{ $order->id }}"
                                                                    value="pickup"
                                                                    class="shipping-method-radio position-absolute"
                                                                    style="top: 10px; right: 10px;"
                                                                    onchange="toggleResiInput(this)">
                                                                <div class="text-center">
                                                                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                        style="width: 60px; height: 60px;">
                                                                        <i class="bi bi-truck fs-4"></i>
                                                                    </div>
                                                                    <h6 class="mb-2">Saya Akan Gunakan Jasa Pick-up
                                                                        (Jemput)</h6>
                                                                    <p class="text-secondary small mb-0">Tim Ekspedisi
                                                                        akan mengambil paket dari alamat Anda</p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Resi Input Section (Initially Hidden) -->
                                                    <div id="resiInputContainer-{{ $order->id }}" class="row mt-3"
                                                        style="display: none;">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="resiNumber-{{ $order->id }}"
                                                                    class="form-label">Nomor Resi</label>
                                                                <input type="text" class="form-control"
                                                                    id="resiNumber-{{ $order->id }}"
                                                                    name="resi_number_{{ $order->id }}"
                                                                    placeholder="Masukkan Nomor Resi">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-danger px-4"
                                                        onclick="konfirmasiPengiriman({{ $order->id }})">
                                                        Konfirmasi
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

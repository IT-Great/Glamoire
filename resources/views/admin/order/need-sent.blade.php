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
                        <a class="nav-link {{ request()->get('status') === null ? 'active' : '' }}"
                            href="{{ route('index-admin-order') }}">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('status') === 'unpaid' ? 'active' : '' }}"
                            href="{{ route('index-admin-order', ['status' => 'unpaid']) }}">Belum Bayar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('status') === 'pending' ? 'active' : '' }} text-primary"
                            href="{{ route('index-admin-order', ['status' => 'pending']) }}">
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
                        <a class="nav-link {{ request()->get('status') === 'completed' ? 'active' : '' }}"
                            href="{{ route('index-admin-order', ['status' => 'completed']) }}">Selesai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->get('status') === 'returned' ? 'active' : '' }}"
                            href="{{ route('index-admin-order', ['status' => 'returned']) }}">Pengembalian</a>
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


                <!-- Search and Date Filter -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Pesanan">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Waktu Pesanan Dibuat</span>
                                    <input type="date" class="form-control" style="max-width: 150px;">
                                    <span class="mx-2">-</span>
                                    <input type="date" class="form-control" style="max-width: 150px;">
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-box-seam"></i> Pengiriman Massal
                                </button>
                            </div>
                        </div>

                        <!-- Order Status Pills -->
                        <div class="d-flex gap-2 mb-4">
                            <button class="btn btn-sm btn-primary">Semua 3</button>
                            <button class="btn btn-sm btn-outline-secondary">Perlu diproses 3</button>
                            <button class="btn btn-sm btn-outline-secondary">Telah diproses 0</button>
                        </div>

                    </div>
                </div>


                <!-- Orders Card -->
                {{-- <div class="card">
                    <div class="card-header bg-light">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-4">Produk</div>
                            <div class="col-12 col-lg-2">Jumlah Harus Dibayar</div>
                            <div class="col-12 col-lg-2">Status</div>
                            <div class="col-6 col-lg-1">Jasa Kirim</div>
                            <div class="col-12 col-lg-2">Aksi</div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @foreach ($orders as $order)
                            <div class="border-bottom p-3">
                                <!-- Order Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-person-fill"></i>
                                        <span class="fw-medium">{{ $order->user->fullname }}</span>
                                    </div>
                                    <div class="text-secondary">No. Pesanan {{ $order->invoice->no_invoice }}</div>
                                </div>

                                <!-- Order Details -->
                                <div class="row g-3">
                                    <div class="col-12 col-lg-4">
                                        @foreach ($order->orderItems as $item)
                                            <div class="d-flex gap-3 mb-3">
                                                <img src="{{ Storage::url($item->product->main_image) }}"
                                                    alt="{{ $item->product->product_name }}" class="rounded"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-medium">{{ $item->product->product_name }}</div>
                                                    <div class="text-secondary small">x{{ $item->quantity }}</div>
                                                    <div class="text-secondary small">Variasi:
                                                        {{ $item->variant ?? '-' }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-12 col-lg-2">
                                        <div>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <div class="text-secondary small">{{ $order->payment_method }}</div>
                                    </div>

                                    <div class="col-12 col-lg-2">
                                        <span class="badge bg-warning">Perlu Dikirim</span>
                                        <div class="small text-secondary">
                                            Mohon kirim sebelum<br>
                                            {{ \Carbon\Carbon::parse($order->deadline)->format('d-m-Y') }}
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-1">
                                        <div>{{ $order->shipping_method ?? 'J&T Express' }}</div>
                                    </div>

                                    <div class="col-6 col-lg-2">
                                        <a href="#" type="button" class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#sentModal">
                                            <i class="bi bi-truck"></i> Atur Pengiriman
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="sentModal" tabindex="-1" aria-labelledby="sentModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="sentModalLabel">Kirim Pesanan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <!-- Order Number -->
                                        <div class="modal-body pt-0">
                                            <div class="d-flex align-items-center mb-4">
                                                <i class="bi bi-arrow-left me-2"></i>
                                                <span class="text-secondary">{{ $order->invoice->no_invoice }}</span>
                                            </div>

                                            <!-- Shipping Options -->
                                            <div class="row g-4">
                                                <!-- Counter Option -->
                                                <div class="col-md-6">
                                                    <label class="card h-100 border rounded position-relative p-3"
                                                        style="cursor: pointer;">
                                                        <input type="radio" name="shipping_method" value="counter"
                                                            class="position-absolute" style="top: 10px; right: 10px;">
                                                        <div class="text-center">
                                                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                style="width: 60px; height: 60px;">
                                                                <i class="bi bi-shop fs-4"></i>
                                                            </div>
                                                            <h6 class="mb-2">Saya Akan Antar Ke Counter</h6>
                                                            <p class="text-secondary small mb-0">Anda dapat mengirimkan
                                                                paket Anda di
                                                                cabang J&T Express terdekat di kota Anda</p>
                                                        </div>
                                                    </label>
                                                </div>

                                                <!-- Pickup Option -->
                                                <div class="col-md-6">
                                                    <label class="card h-100 border rounded position-relative p-3"
                                                        style="cursor: pointer;">
                                                        <input type="radio" name="shipping_method" value="pickup"
                                                            class="position-absolute" style="top: 10px; right: 10px;">
                                                        <div class="text-center">
                                                            <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                style="width: 60px; height: 60px;">
                                                                <i class="bi bi-truck fs-4"></i>
                                                            </div>
                                                            <h6 class="mb-2">Saya Akan Gunakan Jasa Pick-up (Jemput)
                                                            </h6>
                                                            <p class="text-secondary small mb-0">J&T Express akan
                                                                mengambil paket dari
                                                                alamat Anda</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-danger px-4"
                                                id="konfirmasi">Konfirmasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}

                <div class="card order-table">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Daftar Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="min-width: 300px">Produk</th>
                                    <th style="min-width: 120px">Jumlah Dibayar</th>
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
                                                        {{-- {{ $order->invoice->no_invoice }} --}}
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
                                                                {{ $item['product']->product_name }}</div>
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
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock me-1"></i>
                                                Perlu Dikirim
                                            </span>
                                            <div class="small text-secondary mt-2">
                                                Mohon kirim sebelum<br>
                                                {{ \Carbon\Carbon::parse($order->deadline)->format('d-m-Y') }}
                                            </div>
                                        </td>
                                        <td class="shipping-details">
                                            <div class="fw-medium">{{ $order->shipping_method ?? 'J&T Express' }}
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="action-button btn btn-outline-primary btn-sm" data-bs-toggle="modal"
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
                                                        <span
                                                            class="text-secondary">
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
                                                                    value="counter" class="position-absolute"
                                                                    style="top: 10px; right: 10px;">
                                                                <div class="text-center">
                                                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                        style="width: 60px; height: 60px;">
                                                                        <i class="bi bi-shop fs-4"></i>
                                                                    </div>
                                                                    <h6 class="mb-2">Saya Akan Antar Ke Counter</h6>
                                                                    <p class="text-secondary small mb-0">Anda dapat
                                                                        mengirimkan paket Anda di cabang J&T Express
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
                                                                    value="pickup" class="position-absolute"
                                                                    style="top: 10px; right: 10px;">
                                                                <div class="text-center">
                                                                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                        style="width: 60px; height: 60px;">
                                                                        <i class="bi bi-truck fs-4"></i>
                                                                    </div>
                                                                    <h6 class="mb-2">Saya Akan Gunakan Jasa Pick-up
                                                                        (Jemput)</h6>
                                                                    <p class="text-secondary small mb-0">J&T Express
                                                                        akan mengambil paket dari alamat Anda</p>
                                                                </div>
                                                            </label>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table = new simpleDatatables.DataTable("#table1", {
                searchable: true,
                fixedHeight: true,
            });
        });

        function konfirmasiPengiriman(orderId) {
            // Add your confirmation logic here
            console.log('Konfirmasi pengiriman untuk order ID:', orderId);
            // Close modal after confirmation
            $(`#sentModal-${orderId}`).modal('hide');
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

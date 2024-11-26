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
            border-bottom: 1px solid #eee;
            background-color: #f8fafc;
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

        .action-link {
            color: #4a5568;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .action-link:hover {
            background-color: #f7fafc;
            color: #2d3748;
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
                                    <li class="breadcrumb-item"><a href="/order-admin">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Order</li>
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
                            <a href="{{ route('index-admin-order', ['status' => 'unpaid']) }}"
                                class="nav-link {{ request()->get('status') === 'unpaid' ? 'active text-primary' : 'text-secondary' }}">
                                Belum Bayar
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
                            <a href="{{ route('index-admin-order', ['status' => 'completed']) }}"
                                class="nav-link {{ request()->get('status') === 'completed' ? 'active text-primary' : 'text-secondary' }}">
                                Selesai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index-admin-order', ['status' => 'returned']) }}"
                                class="nav-link {{ request()->get('status') === 'returned' ? 'active text-primary' : 'text-secondary' }}">
                                Pengembalian/Pembatalan
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <i class="fa fa-info-circle me-2"></i>
                    Halaman ini menampilkan semua pesanan yang ada. Anda dapat melihat informasi pesanan lengkap dan
                    statusnya di sini.
                    Silakan perbarui atau atur pesanan sesuai kebutuhan. Fitur tambahan seperti filter atau pencarian
                    juga dapat
                    Anda tambahkan untuk meningkatkan pengalaman penggunaan.
                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>

                <!-- Orders Table -->
                <div class="card order-table">
                    <div class="card-header bg-white">
                        <h4>Order List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="min-width: 300px">Order Details</th>
                                    <th style="min-width: 120px">Total Amount</th>
                                    <th>Status</th>
                                    <th style="min-width: 130px">Pickup Date</th>
                                    <th style="min-width: 150px">Shipping</th>
                                    <th>Actions</th>
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
                                                        Invoice : {{ $order->doku_order_id }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-details">
                                                @if (isset($order->groupedOrderItems) && count($order->groupedOrderItems) > 0)
                                                    @foreach ($order->groupedOrderItems as $item)
                                                        @if (isset($item['product']))
                                                            <div class="d-flex gap-3 mb-3">
                                                                <img src="{{ Storage::url($item['product']->main_image) }}"
                                                                    alt="{{ $item['product']->product_name }}"
                                                                    onclick="openImageInNewTab('{{ Storage::url($item['product']->main_image) }}')"
                                                                    loading="lazy">
                                                                <div class="product-info">
                                                                    <div class="product-name">
                                                                        {{ $item['product']->product_name }}
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
                                                                        {{ $item['product']->categoryProduct->name ?? 'Uncategorized' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="text-muted">No products found</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium">Rp.
                                                {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                            <div class="text-secondary small mt-1">
                                                <i class="bi bi-credit-card me-1"></i>
                                                {{ $order->payment->method ?? 'Online Payment' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($order->status == 1)
                                                <span class="badge bg-success"><i
                                                        class="bi bi-check-circle me-1"></i>Success</span>
                                            @elseif($order->status == 2)
                                                <span class="badge bg-primary"><i
                                                        class="bi bi-truck me-1"></i>Delivered</span>
                                            @elseif($order->status == 3)
                                                <span class="badge bg-danger"><i
                                                        class="bi bi-x-circle me-1"></i>Canceled</span>
                                            @else
                                                <span class="badge bg-warning"><i
                                                        class="bi bi-clock me-1"></i>Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->pickup_date)
                                                <div class="small">
                                                    <i class="bi bi-calendar-event me-1"></i>
                                                    {{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="shipping-details">
                                            @if ($order->shipping)
                                                <div class="fw-medium">{{ $order->shipping->method }}</div>
                                                <div class="text-secondary small mt-1">
                                                    <i class="bi bi-truck me-1"></i>{{ $order->shipping->service }}
                                                </div>
                                                <div class="text-secondary small">
                                                    <i class="bi bi-box-seam me-1"></i>{{ $order->shipping->type }}
                                                </div>
                                                <div class="text-secondary small">
                                                    <i
                                                        class="bi bi-qr-code me-1"></i>{{ $order->shipping->tracking_number }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/order-detail/{{ $order->id }}" class="action-link">
                                                <i class="bi bi-arrow-clockwise me-1"></i>
                                                Atur Ulang Pickup
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

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
                                    <div class="text-secondary">No. Pesanan {{ $order->doku_order_id }}</div>
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

            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
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

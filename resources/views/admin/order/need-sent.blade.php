<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Admin Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <style>
        /* Custom styles for the shipping options */
        .card:hover {
            border-color: #dc3545 !important;
        }

        input[type="radio"]:checked+div .card {
            border-color: #dc3545 !important;
            background-color: #fff1f1;
        }

        .modal-header .btn-close {
            padding: 0.5rem;
            margin: -0.5rem -0.5rem -0.5rem auto;
        }

        .nav-tabs .nav-link {
            border: none;
            padding: 0.5rem 1rem;
            color: #6c757d;
            position: relative;
        }

        .nav-tabs .nav-link.active {
            background: none;
            color: #dc3545;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #dc3545;
        }

        .gap-2 {
            gap: 0.5rem !important;
        }

        .gap-3 {
            gap: 1rem !important;
        }

        @media (max-width: 991.98px) {
            .card-header {
                display: none;
            }

            .card-body [class*="col-"] {
                margin-bottom: 0.5rem;
            }

            .card-body .col-12 {
                border-bottom: 1px solid #dee2e6;
                padding-bottom: 0.5rem;
            }

            .card-body .col-12:last-child {
                border-bottom: none;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="container-fluid p-4">
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
                        <a class="nav-link {{ request()->get('status') === 'pending' ? 'active' : '' }} text-danger"
                            href="{{ route('index-admin-order', ['status' => 'pending']) }}">
                            Perlu Dikirim <span class="badge bg-danger rounded-pill">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index-admin-order-sent', ['status' => 'shipping']) }}"
                            class="nav-link {{ request()->get('status') === 'shipping' ? 'active text-danger' : 'text-secondary' }}">
                            Dikirim <span class="badge bg-secondary rounded-pill ms-1">98</span>
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

                <!-- Search and Date Filter -->
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
                        <button class="btn btn-outline-secondary">
                            Export <i class="bi bi-three-dots-vertical"></i>
                        </button>
                    </div>
                </div>

                <!-- Order Status Pills -->
                <div class="d-flex gap-2 mb-4">
                    <button class="btn btn-danger rounded-pill">Semua 3</button>
                    <button class="btn btn-outline-secondary rounded-pill">Perlu diproses 3</button>
                    <button class="btn btn-outline-secondary rounded-pill">Telah diproses 0</button>
                </div>

                <!-- Order Count and Mass Shipping -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 me-3">3 Pesanan</h5>
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button">
                                Urutkan: Tanggal Pesanan
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-danger">
                        <i class="bi bi-box-seam"></i> Pengiriman Massal
                    </button>
                </div>

                <!-- Orders Card -->
                <div class="card">
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
                </div>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

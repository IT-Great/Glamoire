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
        .nav-tabs .nav-link {
            border: none;
            padding: 0.5rem 1rem;
            color: #6c757d;
            position: relative;
        }

        .nav-tabs .nav-link.active {
            background: none;
            /* color: #dc3545; */
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            /* background-color: #dc3545; */
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
                                class="nav-link {{ request()->get('status') === 'returned' ? 'active text-danger' : 'text-secondary' }}">
                                Pengembalian/Pembatalan
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <i class="fa fa-info-circle me-2"></i>
                    Untuk memfasilitasi Penjual dalam mengatur stok produk, kolom Lokasi akan ditambahkan untuk
                    mengidentifikasi lokasi produk dan kolom Batas Aman Stok akan ditambahkan sebagai pengingat untuk
                    memperbarui stok.
                    <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>

                <!-- Status Filters -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="text-secondary mb-2">Status Pesanan</div>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-primary btn-sm rounded-pill">
                                    Perlu diproses (28)
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill">
                                    Telah diproses (18)
                                </button>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill">
                                    Tertunda (17)
                                </button>
                            </div>
                        </div>


                        <form action="{{ route('index-admin-order') }}" method="GET" class="mb-4">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <div class="input-group">
                                        <select name="search_type" class="form-select" style="max-width: 150px;">
                                            <option value="order_number">No. Pesanan</option>
                                            <option value="product">Produk</option>
                                            <option value="customer">Pelanggan</option>
                                        </select>
                                        <input type="text" name="search" value="{{ request()->get('search') }}"
                                            class="form-control" placeholder="Masukkan no. pesanan">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="d-flex gap-2 flex-wrap">
                                        <select name="shipping_method" class="form-select" style="max-width: 180px;">
                                            <option value="">Semua Jasa Kirim</option>
                                        </select>
                                        <select name="action" class="form-select" style="max-width: 180px;">
                                            <option value="">Semua Tindakan</option>
                                            <option value="process">Proses</option>
                                            <option value="cancel">Batalkan</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Terapkan
                                        </button>
                                        <a href="{{ route('index-admin-order') }}"
                                            class="btn btn-outline-secondary">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Order Count and Actions -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="h5 mb-0">28 Pesanan</div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-down-up me-1"></i> Urutkan
                        </button>
                        <button class="btn btn-primary btn-sm">
                            <i class="bi bi-send me-1"></i> Pengiriman Massal
                        </button>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-4">Produk</div>
                            <div class="col-12 col-lg-2">Harga Total</div>
                            <div class="col-12 col-lg-2">Status</div>
                            <div class="col-12 col-lg-2">Hitungan Mundur</div>
                            <div class="col-6 col-lg-1">Jasa Kirim</div>
                            <div class="col-6 col-lg-1">Aksi</div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @foreach ($orders as $order)
                            <div class="border-bottom p-3">
                                <!-- Order Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-person-fill"></i><span
                                            class="fw-medium">{{ $order->user->fullname }}</span>
                                    </div>
                                    <div class="text-secondary">No. Pesanan {{ $order->order_number }}</div>
                                </div>

                                <!-- Order Details -->
                                <div class="row g-3">
                                    <div class="col-12 col-lg-4">
                                        @foreach ($order->orderItems as $item)
                                            <div class="d-flex gap-3 mb-3">
                                                <img src="{{ Storage::url($item->product->main_image) }}"
                                                    alt="{{ $item->product->product_name }}" class="rounded"
                                                    style="width: 80px; height: 80px; object-fit: cover;"
                                                    onclick="openImageInNewTab('{{ Storage::url($item->product->main_image) }}')">
                                                <div>
                                                    <div class="fw-medium">{{ $item->product->product_name }}
                                                    </div>
                                                    <div class="text-secondary small">x{{ $item->quantity }}</div>
                                                    <div class="text-secondary small">Code:
                                                        {{ $item->product->product_code }}</div>
                                                    <div class="text-secondary small">Category:
                                                        {{ $item->product->categoryProduct->name }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-12 col-lg-2">
                                        <div>Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <div class="text-secondary small">
                                            {{ $order->payment->method ?? 'Online Payment' }}</div>
                                    </div>

                                    <div class="col-12 col-lg-2">
                                        @if ($order->status == 1)
                                            <span class="badge bg-success">Success</span>
                                        @elseif($order->status == 2)
                                            <span class="badge bg-primary">Delivered</span>
                                        @elseif($order->status == 3)
                                            <span class="badge bg-danger">Canceled</span>
                                        @else
                                            {{-- <span class="badge bg-warning">Pending</span> --}}
                                            <span class="badge bg-primary">Delivered</span>
                                        @endif
                                    </div>

                                    <div class="col-12 col-lg-2">
                                        @if ($order->pickup_date)
                                            <div class="small">Paket dipick up pada
                                                {{ \Carbon\Carbon::parse($order->pickup_date)->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-6 col-lg-1">
                                        @if ($order->shipping)
                                            <div>{{ $order->shipping->method }}</div>
                                            <div class="text-secondary small">{{ $order->shipping->service }}
                                            </div>
                                            <div class="text-secondary small">{{ $order->shipping->type }}</div>
                                            <div class="text-secondary small">
                                                {{ $order->shipping->tracking_number }}</div>
                                        @endif
                                    </div>

                                    <div class="col-6 col-lg-1">
                                        <a href="/order-detail/{{ $order->id }}"
                                            class="btn btn-link btn-sm p-0 text-decoration-none">
                                            Atur Ulang Pickup
                                        </a>
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
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

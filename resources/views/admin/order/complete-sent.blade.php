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
                                    <li class="breadcrumb-item"><a href="{{ route('index-admin-order') }}">Order</a>
                                    </li>
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
                                                        Invoice : {{ $order->invoice->no_invoice }}
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
                                                                        {{ Str::limit($item['product']->product_name, 40, '...') }}
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
                                            <span class="badge bg-success d-inline-flex align-items-center">
                                                <i class="bi bi-check d-inline-flex align-items-center"></i>
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <td>
                                            {{-- <a href="/order-detail/{{ $order->id }}" class="badge bg-info d-inline-flex align-items-center mb-2">
                                                <i class="bi bi-arrow-clockwise me-1"></i>
                                                Atur Ulang Pickup
                                            </a> --}}

                                            <a href="/order-detail/{{ $order->id }}"
                                                class="badge bg-primary d-inline-flex align-items-center">
                                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                                Info Detail
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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

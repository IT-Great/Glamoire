{{-- <!DOCTYPE html>
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
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
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
                            <h3 class="mb-2">Pengembalian atau Pembatalan Order Produk</h3>
                            <p>Kelola semua produk yang dibatalkan atau dikembalikan pada halaman ini</p>
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
                        <a href="{{ route('index-admin-order-returned', ['status' => 'returned']) }}"
                            class="nav-link {{ request()->get('status') === 'returned' ? 'active text-primary' : 'text-secondary' }}">
                            Pengembalian/Pembatalan/Paket Rusak
                        </a>
                    </li>
                </ul>
            </div>

            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                <i class="fa fa-info-circle me-2"></i>
                Halaman ini menampilkan semua pesanan yang dibatalkan, dikembalikan oleh kurir, maupun pengajuan retur manual dari pembeli. Anda dapat meninjau alasan, melihat bukti, dan menyetujui pengembalian stok.
                <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="card order-table">
                <div class="card-header bg-white">
                    <h4>Return & Cancelled Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th style="min-width: 300px">Order Detail</th>
                                <th style="min-width: 120px">Total</th>
                                <th>Status</th>
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

                                        @if ($order->return_status !== null)
                                            <div class="alert alert-secondary mt-3 p-3 mb-0" style="border: 1px dashed #6b7280; background: #f9fafb;">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="fw-bold mb-1 text-danger"><i class="bi bi-exclamation-triangle me-1"></i> Request Pengembalian Manual</h6>
                                                        <p class="mb-1 text-dark fs-7"><strong>Alasan:</strong> {{ $order->return_reason }}</p>
                                                    </div>
                                                    @if($order->return_image)
                                                        <a href="{{ Storage::url($order->return_image) }}" target="_blank" class="btn btn-sm btn-outline-dark bg-dark">
                                                            <i class="bi bi-image me-1"></i> Lihat Bukti
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
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
                                        @if($order->return_status !== null)
                                            @if($order->return_status == 'requested')
                                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Menunggu Persetujuan Return</span>
                                            @elseif($order->return_status == 'approved')
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Return Disetujui</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Return Ditolak</span>
                                            @endif
                                        @else
                                            @if ($order->status == 'cancelled')
                                                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Cancelled by System/Kurir</span>
                                            @elseif($order->status == 'returned')
                                                <span class="badge bg-secondary"><i class="bi bi-arrow-return-left me-1"></i>Returned (Kurir)</span>
                                            @elseif($order->status == 'disposed')
                                                <span class="badge bg-dark"><i class="bi bi-trash me-1"></i>Disposed (Paket Rusak)</span>
                                            @elseif($order->status == 'failed')
                                                <span class="badge bg-danger"><i class="bi bi-slash-circle me-1"></i>Payment Failed</span>
                                            @else
                                                <span class="badge bg-light text-dark border"><i class="bi bi-question-circle me-1"></i>Unknown</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <a href="/order-detail/{{ $order->id }}" class="badge bg-primary d-inline-flex align-items-center justify-content-center p-2 text-decoration-none">
                                                <i class="bi bi-box-arrow-in-right me-1"></i> Info Detail
                                            </a>

                                            @if($order->return_status == 'requested')
                                                <button type="button" class="badge bg-success border-0 w-100 d-inline-flex align-items-center justify-content-center p-2" onclick="confirmReturnAction('approve', {{ $order->id }})">
                                                    <i class="bi bi-check-lg me-1"></i> Setujui (Restore Stok)
                                                </button>
                                                <button type="button" class="badge bg-danger border-0 w-100 d-inline-flex align-items-center justify-content-center p-2" onclick="confirmReturnAction('reject', {{ $order->id }})">
                                                    <i class="bi bi-x-lg me-1"></i> Tolak
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }

        // Logic AJAX Approval & Rejection untuk Return
        function confirmReturnAction(action, orderId) {
            let textTitle = action === 'approve' ? 'Setujui Pengembalian?' : 'Tolak Pengembalian?';
            let textDesc = action === 'approve'
                ? 'Stok barang akan otomatis dikembalikan ke gudang dan status pesanan menjadi Returned.'
                : 'Pengajuan pengembalian akan ditolak. Status pesanan akan tetap Completed.';
            let confirmBtnColor = action === 'approve' ? '#10b981' : '#ef4444';
            let routeUrl = action === 'approve'
                ? `/admin/order/return/${orderId}/approve`
                : `/admin/order/return/${orderId}/reject`;

            Swal.fire({
                title: textTitle,
                text: textDesc,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(routeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success){
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    })
                    .catch(err => {
                        Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
                        console.error(err);
                    });
                }
            });
        }
    </script>

    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Glamoire</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Highlight khusus untuk order yang butuh persetujuan */
        .table>tbody>tr.bg-light-warning {
            background-color: rgba(245, 158, 11, 0.05) !important;
            border-left: 4px solid var(--warning-color);
        }

        .table>tbody>tr.bg-light-warning:hover {
            background-color: rgba(245, 158, 11, 0.1) !important;
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
                            <h3 class="mb-2">Pengembalian atau Pembatalan Order Produk</h3>
                            <p>Kelola semua produk yang dibatalkan atau dikembalikan pada halaman ini</p>
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
                        <a href="{{ route('index-admin-order-returned', ['status' => 'returned']) }}"
                            class="nav-link {{ request()->get('status') === 'returned' ? 'active text-primary' : 'text-secondary' }}">
                            Pengembalian/Pembatalan/Paket Rusak
                        </a>
                    </li>
                </ul>
            </div>

            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                <i class="fa fa-info-circle me-2"></i>
                Halaman ini menampilkan semua pesanan yang dibatalkan, dikembalikan oleh kurir, maupun pengajuan retur manual dari pembeli. Anda dapat meninjau alasan, melihat bukti, dan menyetujui pengembalian stok.
                <button type="button" class="btn btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="card order-table">
                <div class="card-header bg-white">
                    <h4>Return & Cancelled Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th style="min-width: 300px">Order Detail</th>
                                <th style="min-width: 120px">Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="{{ $order->return_status == 'requested' ? 'bg-light-warning' : '' }}">
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

                                        @if ($order->return_status !== null)
                                            <div class="alert alert-secondary mt-3 p-3 mb-0" style="border: 1px dashed #6b7280; background: #f9fafb;">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="fw-bold mb-1 text-danger"><i class="bi bi-exclamation-triangle me-1"></i> Request Pengembalian Manual</h6>
                                                        <p class="mb-1 text-dark fs-7"><strong>Alasan:</strong> {{ $order->return_reason }}</p>
                                                    </div>
                                                    @if($order->return_image)
                                                        <a href="{{ Storage::url($order->return_image) }}" target="_blank" class="btn btn-sm btn-outline-dark bg-dark">
                                                            <i class="bi bi-image me-1"></i> Lihat Bukti
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
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
                                        @if($order->return_status !== null)
                                            @if($order->return_status == 'requested')
                                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Menunggu Persetujuan Return</span>
                                            @elseif($order->return_status == 'approved')
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Return Disetujui</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Return Ditolak</span>
                                            @endif
                                        @else
                                            @if ($order->status == 'cancelled')
                                                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Cancelled by System/Kurir</span>
                                            @elseif($order->status == 'returned')
                                                <span class="badge bg-secondary"><i class="bi bi-arrow-return-left me-1"></i>Returned (Kurir)</span>
                                            @elseif($order->status == 'disposed')
                                                <span class="badge bg-dark"><i class="bi bi-trash me-1"></i>Disposed (Paket Rusak)</span>
                                            @elseif($order->status == 'failed')
                                                <span class="badge bg-danger"><i class="bi bi-slash-circle me-1"></i>Payment Failed</span>
                                            @else
                                                <span class="badge bg-light text-dark border"><i class="bi bi-question-circle me-1"></i>Unknown</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <a href="/order-detail/{{ $order->id }}" class="badge bg-primary d-inline-flex align-items-center justify-content-center p-2 text-decoration-none">
                                                <i class="bi bi-box-arrow-in-right me-1"></i> Info Detail
                                            </a>

                                            @if($order->return_status == 'requested')
                                                <button type="button" class="badge bg-success border-0 w-100 d-inline-flex align-items-center justify-content-center p-2" onclick="confirmReturnAction('approve', {{ $order->id }})">
                                                    <i class="bi bi-check-lg me-1"></i> Setujui (Restore Stok)
                                                </button>
                                                <button type="button" class="badge bg-danger border-0 w-100 d-inline-flex align-items-center justify-content-center p-2" onclick="confirmReturnAction('reject', {{ $order->id }})">
                                                    <i class="bi bi-x-lg me-1"></i> Tolak
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        // Nonaktifkan sorting default dari simple-datatables agar urutan dari controller (requested paling atas) tidak rusak
        let dataTable = new simpleDatatables.DataTable(table1, {
            sortable: false
        });

        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }

        // Logic AJAX Approval & Rejection untuk Return
        function confirmReturnAction(action, orderId) {
            let textTitle = action === 'approve' ? 'Setujui Pengembalian?' : 'Tolak Pengembalian?';
            let textDesc = action === 'approve'
                ? 'Stok barang akan otomatis dikembalikan ke gudang, status pesanan menjadi Returned, dan email notifikasi akan dikirim ke pembeli.'
                : 'Pengajuan pengembalian akan ditolak. Status pesanan akan tetap Completed, dan email notifikasi akan dikirim ke pembeli.';
            let confirmBtnColor = action === 'approve' ? '#10b981' : '#ef4444';
            let routeUrl = action === 'approve'
                ? `/admin/order/return/${orderId}/approve`
                : `/admin/order/return/${orderId}/reject`;

            Swal.fire({
                title: textTitle,
                text: textDesc,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu, sedang mengirim email ke pelanggan.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    fetch(routeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success){
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    })
                    .catch(err => {
                        Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
                        console.error(err);
                    });
                }
            });
        }
    </script>

    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

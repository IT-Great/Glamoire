<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Voucher - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product/detailproduct.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* background-color: #f8f9fa; */
        }

        .page-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 2rem 0;
            color: white;
            margin-bottom: 2rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #435ebe;
        }

        .breadcrumb-item a {
            color: #435ebe;
            text-decoration: none;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .status-badge {
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .status-active {
            background-color: #10b981;
            color: white;
        }

        .status-inactive {
            background-color: #ef4444;
            color: white;
        }

        .detail-group {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 500;
        }

        .stats-card {
            background: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
        }

        .stats-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .stats-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .voucher-banner {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.75rem;
        }

        .product-table img {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            object-fit: cover;
        }

        .product-table td {
            vertical-align: middle;
        }

        .product-name {
            font-weight: 500;
            color: #111827;
        }

        .discount-badge {
            background: #fee2e2;
            color: #ef4444;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .progress {
            height: 0.75rem;
            border-radius: 1rem;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo-voucher') }}">Voucher</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Voucher
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Voucher Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-tag me-1"></i> Voucher Name
                                                </div>
                                                <div class="detail-value">{{ $promo->promo_name }}</div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-barcode me-1"></i> Voucher Code
                                                </div>
                                                <div class="detail-value">
                                                    <span
                                                        class="badge bg-light text-dark p-2">{{ $promo->promo_code }}</span>
                                                </div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-calendar me-1"></i> Validity Period
                                                </div>
                                                <div class="detail-value">
                                                    {{ date('d M Y', strtotime($promo->start_date)) }} -
                                                    {{ date('d M Y', strtotime($promo->end_date)) }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-percent me-1"></i> Discount
                                                </div>
                                                <div class="detail-value">
                                                    @if ($promo->discount_type === 'percentage')
                                                        <span class="discount-badge">{{ $promo->discount }}% OFF</span>
                                                    @elseif ($promo->discount_type === 'nominal')
                                                        <span class="discount-badge">Rp.
                                                            {{ number_format($promo->discount, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="discount-badge">-</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-shopping-cart me-1"></i> Minimum Transaction
                                                </div>
                                                <div class="detail-value">
                                                    Rp. {{ number_format($promo->min_transaction, 0, ',', '.') }}
                                                </div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-user me-1"></i> Max Quantity Per Buyer
                                                </div>
                                                <div class="detail-value">{{ $promo->max_quantity_buyer }} items</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Applied Products</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table product-table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Stock</th>
                                                    <th>Regular Price</th>
                                                    <th>Discount Per Product</th>
                                                    <th>Discounted Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($promo->products as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ Storage::url($product->main_image) }}"
                                                                    alt="Product" class="me-3"
                                                                    onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">

                                                                <span
                                                                    class="product-name">{{ Str::limit($product->product_name, 20, '...') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $product->stock_quantity }}</td>

                                                        <td>Rp.
                                                            {{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </td>

                                                        <td>
                                                            @if (isset($product->pivot->discount_product_voucher_item))
                                                                @if ($product->pivot->discount_product_voucher_item >= 1 && $product->pivot->discount_product_voucher_item <= 100)
                                                                    {{ number_format($product->pivot->discount_product_voucher_item, 0, ',', '.') }} %
                                                                @elseif ($product->pivot->discount_product_voucher_item > 100)
                                                                    Rp. {{ number_format($product->pivot->discount_product_voucher_item, 0, ',', '.') }}
                                                                @else
                                                                    -
                                                                @endif
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        

                                                        <td>
                                                            <span class="text-danger">
                                                                Rp.
                                                                @if (isset($product->pivot->discount_product_voucher_item))
                                                                    @if ($product->pivot->discount_product_voucher_item >= 1 && $product->pivot->discount_product_voucher_item <= 100)
                                                                        {{-- Diskon dalam persentase --}}
                                                                        {{ number_format($product->regular_price * (1 - $product->pivot->discount_product_voucher_item / 100), 0, ',', '.') }}
                                                                    @elseif ($product->pivot->discount_product_voucher_item > 100)
                                                                        {{-- Diskon dalam nominal --}}
                                                                        {{ number_format(max(0, $product->regular_price - $product->pivot->discount_product_voucher_item), 0, ',', '.') }}
                                                                    @else
                                                                        {{-- Jika diskon 0 atau tidak valid --}}
                                                                        {{ number_format($product->regular_price, 0, ',', '.') }}
                                                                    @endif
                                                                @else
                                                                    {{-- Menggunakan diskon promo umum --}}
                                                                    @if ($promo->discount_type === 'nominal')
                                                                        {{ number_format(max(0, $product->regular_price - $promo->discount), 0, ',', '.') }}
                                                                    @else
                                                                        {{ number_format($product->regular_price * (1 - $promo->discount / 100), 0, ',', '.') }}
                                                                    @endif
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Promo Banner</h5>
                                </div>
                                <div class="card-body">
                                    <img src="{{ Storage::url($promo->image) }}" alt="Voucher Banner"
                                        class="voucher-banner mb-4"
                                        onclick="openImageInNewTab('{{ Storage::url($promo->image) }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

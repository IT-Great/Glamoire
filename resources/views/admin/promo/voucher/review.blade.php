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

    <style>
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box-multiple {
            width: 195px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-box-single {
            width: 450px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            color: #333;
            margin-bottom: 1rem;
        }

        .voucher-banner {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
        }

        .status-active {
            background-color: #4CAF50;
            color: white;
        }

        .status-inactive {
            background-color: #f44336;
            color: white;
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
                <section class="section">
                    <div class="container">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Voucher Information</h4>
                                <div>
                                    <span
                                        class="status-badge {{ $promo->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $promo->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <div class="detail-label">Voucher Name</div>
                                            <div class="detail-value">{{ $promo->promo_name }}</div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="detail-label">Voucher Code</div>
                                            <div class="detail-value">Glamo{{ $promo->promo_code }}</div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="detail-label">Validity Period</div>
                                            <div class="detail-value">
                                                {{ date('d M Y', strtotime($promo->start_date)) }} -
                                                {{ date('d M Y', strtotime($promo->end_date)) }}
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="detail-label">Usage Quota</div>
                                                <div class="detail-value">{{ $promo->usage_quota }} times</div>
                                            </div>
                                            <div class="col">
                                                <div class="detail-label">Used</div>
                                                <div class="detail-value">{{ $promo->used_quota }} times</div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="detail-label">Max Quantity Per Buyer</div>
                                            <div class="detail-value">{{ $promo->max_quantity_buyer }} items</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="detail-label">Discount</div>
                                                <div class="detail-value">{{ $promo->discount }}%</div>
                                            </div>
                                            <div class="col">
                                                <div class="detail-label">Max Discount</div>
                                                <div class="detail-value">{{ $promo->max_discount }}%</div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="detail-label">Minimum Transaction</div>
                                            <div class="detail-value">Rp.
                                                {{ number_format($promo->min_transaction, 0, ',', '.') }}</div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="detail-label">Banner promo</div>
                                            <img src="{{ Storage::url($promo->image) }}" alt="Voucher Banner"
                                                class="voucher-banner">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>Applied Products</h4>
                            </div>
                            <div class="card-body">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Stock</th>
                                            <th>Regular Price</th>
                                            <th>Discounted Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($promo->products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($product->main_image) }}" 
                                                     alt="Product Image"
                                                     style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                                {{ $product->product_name }}
                                            </td>
                                            <td>{{ $product->stock_quantity }}</td>
                                            <td>Rp. {{ number_format($product->regular_price, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($product->regular_price * (1 - $promo->discount/100), 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    {{-- <a href="{{ route('edit-promo-product-voucher', $promo->id) }}" class="btn btn-primary me-3">
                                        Edit Voucher
                                    </a> --}}
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete({{ $promo->id }})">
                                        Delete Voucher
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            @include('admin.layouts.footer')

        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

</body>

</html>

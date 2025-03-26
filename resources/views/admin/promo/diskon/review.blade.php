<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .upload__img-box-single,
        .upload__img-box-multiple {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .img-bg-single,
        .img-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .upload__img-close {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 2px;
            cursor: pointer;
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
                        <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="/promo" style="text-decoration: none;">Promo</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detail promo Diskon</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="promo-diskon">
                    {{-- Detail Promo --}}
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <!-- Promo Information -->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Promo Name</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $promo->promo_name }}" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Promo Period</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $promo->date_range }}" readonly>
                                                    </div>
                                                </div>

                                                <!-- Discount Tiers -->
                                                <div class="col-md-12 mt-4">
                                                    <h5 class="text-primary">Discount Tiers</h5>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Tier Level</th>
                                                                <th>Minimum Quantity</th>
                                                                <th>Discount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($promo->tiers as $tier)
                                                                <tr>
                                                                    <td>
                                                                        {{ $tier->tier_level }}
                                                                    </td>
                                                                    <td>
                                                                        Minimal Pembelian {{ $tier->min_quantity }}
                                                                        item
                                                                    </td>
                                                                    <td>
                                                                        @switch($tier->discount_type)
                                                                            @case('percentage')
                                                                                {{ $tier->discount_value }}%
                                                                            @break

                                                                            @case('nominal')
                                                                                Rp
                                                                                {{ number_format($tier->discount_value, 0, ',', '.') }}
                                                                            @break

                                                                            @case('package')
                                                                                Rp
                                                                                {{ number_format($tier->package_price, 0, ',', '.') }}
                                                                                / {{ $tier->min_quantity }} items
                                                                            @break

                                                                            @default
                                                                                -
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    <h5 class="text-primary">All Discount Tiers</h5>
                                                    <div class="alert alert-light">
                                                        {!! $promo->all_discount_tiers !!}
                                                    </div>
                                                </div>

                                                <!-- Products Included in the Promo -->
                                                <div class="col-12 mt-4">
                                                    <h5 class="text-primary">Products in the Promo</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Product Name</th>
                                                                    <th>Stock</th>
                                                                    <th>Original Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($promo->products as $product)
                                                                    <tr>
                                                                        <td>
                                                                            <img src="{{ Storage::url($product->main_image) }}"
                                                                                alt="{{ $product->product_name }}"
                                                                                style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;"
                                                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                                        </td>
                                                                        <td>{{ $product->product_name }}</td>
                                                                        <td>{{ $product->stock_quantity }}</td>
                                                                        <td>Rp.
                                                                            {{ number_format($product->regular_price, 0, ',', '.') }}
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4 text-start">
                                            <a href="{{ route('index-promo-diskon') }}" class="btn btn-primary btn-sm" style="border-radius: 8px; font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-box-arrow-in-left me-1"></i> Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </section>


            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
</body>

</html>

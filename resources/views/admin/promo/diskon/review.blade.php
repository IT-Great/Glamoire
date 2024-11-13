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
                                <li class="breadcrumb-item active" aria-current="page">Detail promo</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="promo-detail">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Promo Details</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical"
                                            action="{{ route('update-promo', $promo->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <!-- Promo Information -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="promo_name">Promo Name</label>
                                                            <input type="text" class="form-control" id="promo_name"
                                                                name="promo_name" value="{{ $promo->promo_name }}"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="date_range">Promo Period</label>
                                                            <input type="text" class="form-control" id="date_range"
                                                                name="date_range" value="{{ $promo->date_range }}"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="discount">Discount (%)</label>
                                                            <input type="number" class="form-control" id="discount"
                                                                name="discount" value="{{ $promo->discount }}"
                                                                readonly>
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
                                                                        <th>Price After Discount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($promo->products as $product)
                                                                        <tr>
                                                                            <td class="d-flex align-items-center">
                                                                                <img src="{{ Storage::url($product->main_image) }}"
                                                                                    alt="{{ $product->promo_name }}"
                                                                                    class="lazyload"
                                                                                    style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;"
                                                                                    onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                                            </td>
                                                                            <td>
                                                                                <span>{{ $product->product_name }}</span>
                                                                            </td>
                                                                            <td>{{ $product->stock_quantity }}</td>
                                                                            <td>Rp.
                                                                                {{ number_format($product->regular_price, 0, ',', '.') }}
                                                                            </td>
                                                                            <td>Rp.
                                                                                {{ number_format($product->regular_price * (1 - $promo->discount / 100), 0, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

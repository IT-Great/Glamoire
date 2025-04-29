<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Glamoire</title>
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
        body {
            font-family: 'Inter', sans-serif;
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

        .main-image-container {
            aspect-ratio: 4/3;
            overflow: hidden;
            border-radius: 0.375rem;
        }

        .main-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .main-image-container img:hover {
            transform: scale(1.05);
        }

        .gallery-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-thumbnail:hover {
            transform: scale(1.1);
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
        }

        .discount-badge {
            background: #fee2e2;
            color: #ef4444;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
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

        .variant-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .color-swatch {
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            vertical-align: middle;
            margin-left: 0.5rem;
        }

        .product-video-container {
            max-width: 640px;
            margin: 0 auto;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-video-container .ratio {
            padding-top: 56.25%;
            position: relative;
        }

        .product-video-container .ratio video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
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
                                    <li class="breadcrumb-item"><a href="{{ route('index-product-admin') }}">Product</a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <!-- Left Column - Images -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Product Images</h5>
                                </div>
                                <div class="card-body">
                                    @if (!empty($product->main_image))
                                        <div class="main-image-container mb-3">
                                            <img src="{{ Storage::url($product->main_image) }}"
                                                alt="{{ $product->product_name }}"
                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                        </div>
                                    @endif

                                    <div class="d-flex gap-2 flex-wrap">
                                        @if (!empty($product->images) && is_array($product->images))
                                            @foreach ($product->images as $image)
                                                <img src="{{ Storage::url($image) }}" alt="Gallery image"
                                                    class="gallery-thumbnail"
                                                    onclick="openImageInNewTab('{{ Storage::url($image) }}')">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if (!empty($product->video))
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Product Video</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="product-video-container">
                                            <div class="ratio">
                                                <video controls>
                                                    <source src="{{ Storage::url($product->video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column - Product Info -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Product Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="bi bi-box me-2"></i>Product Name
                                                </div>
                                                <div class="detail-value">{{ $product->product_name }}</div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="bi bi-upc me-2"></i>Product Code
                                                </div>
                                                <div class="detail-value">{{ $product->product_code }}</div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="bi bi-tag me-2"></i>Category
                                                </div>
                                                <div class="detail-value">
                                                    {{ $product->categoryProduct ? $product->categoryProduct->name : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="bi bi-building me-2"></i>Brand
                                                </div>
                                                <div class="detail-value">
                                                    {{ $product->brand ? $product->brand->name : 'N/A' }}</div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="bi bi-box me-2"></i>Stock
                                                </div>
                                                <div class="detail-value">{{ $product->stock_quantity }}
                                                    {{ $product->unit }}</div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="bi bi-currency-dollar me-2"></i>Price
                                                </div>
                                                <div class="detail-value">
                                                    <span class="discount-badge">
                                                        Rp. {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="detail-group">
                                                <div class="detail-label">Product Details</div>
                                                <div class="stats-card">
                                                    <div class="row g-3">
                                                        @if ($product->color || $product->color_text)
                                                            <div class="col-md-4">
                                                                <div class="detail-label">Color</div>
                                                                <div class="detail-value">
                                                                    @if ($product->color_text)
                                                                        {{ $product->color_text }}
                                                                    @else
                                                                        <span class="color-swatch"
                                                                            style="background-color: {{ $product->color }};"></span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-4">
                                                            <div class="detail-label">Weight</div>
                                                            <div class="detail-value">{{ $product->weight_product }}
                                                                gram</div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="detail-label">Dimensions</div>
                                                            <div class="detail-value">
                                                                {{ $product->dimensions['length'] ?? 'N/A' }} x
                                                                {{ $product->dimensions['width'] ?? 'N/A' }} x
                                                                {{ $product->dimensions['height'] ?? 'N/A' }} cm
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($product->productVariations->isNotEmpty())
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Product Variants</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table product-table">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Value</th>
                                                        <th>SKU</th>
                                                        <th>Stock</th>
                                                        <th>Price</th>
                                                        <th>Expired</th>
                                                        <th>Weight</th>
                                                        <th>Image</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product->productVariations as $variant)
                                                        <tr>
                                                            <td>{{ ucfirst($variant->variant_type) }}</td>
                                                            <td>{{ $variant->variant_value }}</td>
                                                            <td>{{ $variant->sku }}</td>
                                                            <td>{{ $variant->variant_stock }}</td>
                                                            <td>{{ $variant->variant_price }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($variant->variant_expired)->format('d M Y') }}
                                                            </td>
                                                            <td>{{ $variant->weight_variant }}</td>
                                                            <td>
                                                                @if ($variant->use_variant_image && $variant->variant_image)
                                                                    <img src="{{ Storage::url($variant->variant_image) }}"
                                                                        alt="{{ $variant->variant_value }}"
                                                                        class="variant-thumbnail"
                                                                        onclick="openImageInNewTab('{{ Storage::url($variant->variant_image) }}')">
                                                                @else
                                                                    <span class="text-muted">No image</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Additional Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="detail-group">
                                        <div class="detail-label">Description</div>
                                        <div class="detail-value">{{ $product->description }}</div>
                                    </div>
                                    <div class="detail-group mb-0">
                                        <div class="detail-label">Additional Information</div>
                                        <div class="detail-value">{{ $product->information_product }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

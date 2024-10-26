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
    <link rel="stylesheet" href="{{ asset('assets/css/product/detailproduct.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="container mb-4">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/product-admin"
                                            style="text-decoration: none;">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Product</li>
                                </ol>
                            </nav>
                        </div>                       
                    </div>
                </div>

                <div class="product-card">
                    <div class="row g-0">
                        <div class="col-md-6" style="padding: 20px;">
                            <div class="product-image-container">
                                @if (!empty($product->main_image))
                                    <img src="{{ Storage::url($product->main_image) }}"
                                        alt="{{ $product->product_name }}" class="product-image"
                                        onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                @endif
                            </div>
                            <div class="gallery-container" style="padding: 10px;">
                                @if (!empty($product->images) && is_array($product->images))
                                    @foreach ($product->images as $image)
                                        <img src="{{ Storage::url($image) }}" alt="Gallery image" class="gallery-image"
                                            onclick="openImageInNewTab('{{ Storage::url($image) }}')">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-info">
                                <h4>{{ $product->product_name }}</h4>
                                <div class="product-meta">
                                    <span class="meta-item"><i class="bi bi-upc"></i>
                                        {{ $product->product_code }}</span>
                                    <span class="meta-item"><i class="bi bi-tag"></i>
                                        {{ $product->categoryProduct ? $product->categoryProduct->name : 'N/A' }}</span>
                                    <span class="meta-item"><i class="bi bi-building"></i>
                                        {{ $product->brand ? $product->brand->name : 'N/A' }}</span>
                                    <span class="meta-item"><i class="bi bi-box"></i> {{ $product->stock_quantity }}
                                        {{ $product->unit }}</span>
                                    <span class="meta-item"><i class="bi bi-currency-dollar"></i> Rp.
                                        {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                </div>
                                @if ($product->color || $product->color_text)
                                    <p>
                                        <strong>Color:</strong>
                                        @if ($product->color_text)
                                            {{ $product->color_text }}
                                        @else
                                            <span class="color-swatch"
                                                style="background-color: {{ $product->color }};"></span>
                                        @endif
                                    </p>
                                @endif
                                <p><strong>Weight : </strong> {{ $product->weight_product }} gram</p>
                                <p><strong>Dimensions : </strong>
                                    {{ $product->dimensions['length'] ?? 'N/A' }} x
                                    {{ $product->dimensions['width'] ?? 'N/A' }} x
                                    {{ $product->dimensions['height'] ?? 'N/A' }} cm
                                </p>
                                <p><strong>Date Expired : </strong>{{ \Carbon\Carbon::parse($product->date_expired)->translatedFormat('d F Y') }}</p> 
                                {{-- <td>{{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }} --}}
                               

                                <!-- Product Variants Section -->
                                @if ($product->productVariations->isNotEmpty())
                                    <h4 class="variant-title">Product Variants</h4>
                                    @php
                                        $groupedVariants = $product->productVariations->groupBy('variant_type');
                                    @endphp
                                    @foreach ($groupedVariants as $variantType => $variants)
                                        <h4 class="variant-type">{{ ucfirst($variantType) }}</h4>
                                        <div class="variants-wrap">
                                            @foreach ($variants as $variant)
                                                <div class="variant-item">
                                                    <!-- Check if the variant has an image or just text -->
                                                    @if ($variant->use_variant_image && $variant->variant_image)
                                                        <!-- Display image if available -->
                                                        <div class="variant-image-container">
                                                            <img src="{{ Storage::url($variant->variant_image) }}"
                                                                alt="{{ $variant->variant_value }}"
                                                                class="variant-image"
                                                                onclick="openImageInNewTab('{{ Storage::url($variant->variant_image) }}')">
                                                        </div>
                                                        <div class="variant-value">{{ $variant->sku }}</div>
                                                    @else
                                                        <!-- Display text like product-meta -->
                                                        <div class="product-variant-meta">
                                                            <span class="meta-item"><i class="bi bi-box"></i>
                                                                {{ $variant->variant_value }}</span>
                                                            <span class="meta-item"><i class="bi bi-upc"></i>
                                                                {{ $variant->sku }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="description-card">
                    <h4>Product Description</h4>
                    <p>{{ $product->description }}</p>
                </div>

                @if (!empty($product->video))
                    <div class="description-card">
                        <h4>Product Video</h4>
                        <div class="video-container">
                            <video controls>
                                <source src="{{ Storage::url($product->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                @endif
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

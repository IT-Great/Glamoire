@extends('user.layouts.master')

@section('content')
    <style>
        /* ==========================================
           PREMIUM PRODUCT DETAIL STYLING
           ========================================== */
        :root {
            --glamoire-dark: #183018;
            --glamoire-light: #F9FAFB;
            --glamoire-accent: #2A4D2A;
            --glamoire-gold: #D4AF37;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --danger-main: #DC2626;
            --border-color: #E5E7EB;
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Premium Breadcrumb --- */
        .premium-breadcrumb {
            background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 2rem;
        }

        .premium-breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .premium-breadcrumb a:hover {
            color: var(--glamoire-dark);
        }

        .premium-breadcrumb span {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0 8px;
        }

        .premium-breadcrumb .active-page {
            color: var(--glamoire-dark);
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* --- Image Gallery (Swiper) --- */
        .gallery-container {
            position: sticky;
            top: 100px;
        }

        .main-image-wrapper {
            border-radius: 16px;
            overflow: hidden;
            background: var(--glamoire-light);
            margin-bottom: 1rem;
            aspect-ratio: 1/1;
            position: relative;
        }

        .main-image-wrapper img,
        .main-image-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: crosshair;
            transition: transform 0.3s ease;
        }

        .thumb-wrapper {
            border-radius: 12px;
            overflow: hidden;
            background: var(--glamoire-light);
            aspect-ratio: 1/1;
            border: 2px solid transparent;
            cursor: pointer;
            transition: var(--transition-smooth);
            padding: 4px;
        }

        .thumb-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .swiper-slide-thumb-active .thumb-wrapper {
            border-color: var(--glamoire-dark);
        }

        .video-badge {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--glamoire-dark);
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            pointer-events: none;
        }

        /* --- Product Info Section --- */
        .product-brand-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-main-title {
            font-family: 'The Seasons', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .product-main-title {
                font-size: 1.6rem;
            }
        }

        .product-meta-row {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .rating-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #F59E0B;
            font-weight: 600;
        }

        .review-count {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 400;
            text-decoration: underline;
            cursor: pointer;
        }

        .sold-count {
            color: var(--danger-main);
            font-size: 0.9rem;
            font-weight: 500;
            background: #FEE2E2;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .product-price-display {
            font-size: 2rem;
            font-weight: 800;
            color: var(--glamoire-dark);
            margin-bottom: 1.5rem;
        }

        /* --- Variants --- */
        .variant-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.8rem;
        }

        .variant-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .variant-btn {
            padding: 0.6rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            background: #FFF;
            color: var(--text-main);
            text-decoration: none;
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .variant-btn:hover {
            border-color: var(--glamoire-dark);
            color: var(--glamoire-dark);
        }

        .variant-btn.active {
            background: var(--glamoire-dark);
            color: #FFF;
            border-color: var(--glamoire-dark);
        }

        /* --- Actions (Quantity & Buttons) --- */
        .action-row {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .qty-selector {
            display: flex;
            align-items: center;
            background: var(--glamoire-light);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 0.25rem;
            height: 50px;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            border: none;
            background: #FFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-main);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: var(--transition-smooth);
        }

        .qty-btn:hover {
            background: var(--border-color);
        }

        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            color: var(--text-main);
            font-size: 1rem;
        }

        .qty-input:focus {
            outline: none;
        }

        /* Hilangkan panah spinner bawaan input number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .btn-cart-premium {
            flex: 1;
            min-width: 150px;
            height: 50px;
            background: #FFF;
            border: 1px solid var(--glamoire-dark);
            color: var(--glamoire-dark);
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition-smooth);
            cursor: pointer;
            text-decoration: none;
        }

        .btn-cart-premium:hover {
            background: rgba(24, 48, 24, 0.05);
            color: var(--glamoire-dark);
        }

        .btn-buy-premium {
            flex: 1;
            min-width: 150px;
            height: 50px;
            background: var(--glamoire-dark);
            border: 1px solid var(--glamoire-dark);
            color: #FFF;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
            cursor: pointer;
            text-decoration: none;
        }

        .btn-buy-premium:hover {
            background: var(--glamoire-accent);
            color: #FFF;
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.2);
        }

        /* Wishlist Heart Icon */
        .btn-wishlist-premium {
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            color: #D1D5DB;
            background: transparent;
            border: none;
            padding: 0;
        }

        .btn-wishlist-premium:hover {
            transform: scale(1.1);
        }

        .btn-wishlist-premium.active {
            color: var(--danger-main);
        }

        /* --- Modern Tabs --- */
        .premium-tabs {
            border-bottom: 1px solid var(--border-color);
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 2px;
        }

        .premium-tabs::-webkit-scrollbar {
            display: none;
        }

        .premium-tabs .nav-link {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 1rem;
            padding: 0.5rem 0 1rem 0;
            border: none;
            background: transparent;
            border-bottom: 2px solid transparent;
            transition: var(--transition-smooth);
            cursor: pointer;
            border-radius: 0;
        }

        .premium-tabs .nav-link:hover {
            color: var(--glamoire-dark);
        }

        .premium-tabs .nav-link.active {
            color: var(--glamoire-dark);
            border-bottom-color: var(--glamoire-dark);
        }

        .tab-content-box {
            color: var(--text-main);
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .tab-content-box h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        /* --- Reviews --- */
        .review-card {
            background: #FFF;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        }

        .reviewer-name {
            font-weight: 600;
            color: var(--text-main);
            font-size: 0.95rem;
        }

        .review-date {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .review-text {
            font-size: 0.9rem;
            line-height: 1.6;
            margin-top: 0.5rem;
        }

        .review-media img,
        .review-media video {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
            border: 1px solid #E5E7EB;
        }

        .review-media img:hover,
        .review-media video:hover {
            transform: scale(1.05);
        }

        /* Mobile Fixed Bottom Nav */
        .mobile-buy-nav {
            background: #FFF;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
            padding: 10px 15px;
            padding-bottom: env(safe-area-inset-bottom, 10px);
            z-index: 1030;
        }

        /* Reusable Product Card */
        .premium-product-card-small {
            background: #FFF;
            border-radius: 12px;
            border: 1px solid #F3F4F6;
            overflow: hidden;
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .premium-product-card-small:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transform: translateY(-4px);
        }
    </style>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4">
        <div class="container-fluid">
            <div class="premium-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                <span>/</span>
                <a href="/shop">Belanja</a>
                <span>/</span>
                <span class="active-page">{{ $product->product_name }}</span>
            </div>
        </div>

        <div class="container-fluid mb-5">
            <div class="row g-4 g-lg-5">

                <div class="col-lg-5">
                    <div class="gallery-container">
                        <div style="--swiper-navigation-color: var(--glamoire-dark); --swiper-pagination-color: var(--glamoire-dark)"
                            class="swiper mySwiperShow main-image-wrapper shadow-sm">
                            <div class="swiper-wrapper">
                                @if ($firstVariant->use_variant_image == 1)
                                    <div class="swiper-slide">
                                        <img class="zoomable-image" src="{{ Storage::url($firstVariant->variant_image) }}"
                                            alt="{{ $product->product_name }}" />
                                    </div>
                                @else
                                    <div class="swiper-slide">
                                        <img class="zoomable-image" src="{{ Storage::url($product->main_image) }}"
                                            alt="{{ $product->product_name }}" />
                                    </div>
                                @endif

                                @if (!empty($firstVariant->main_image))
                                    @foreach ($firstVariant->main_image as $variantImage)
                                        <div class="swiper-slide">
                                            <img class="zoomable-image" src="{{ Storage::url($variantImage) }}"
                                                alt="Variant Image" />
                                        </div>
                                    @endforeach
                                @elseif(!empty($product->images))
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide">
                                            <img class="zoomable-image" src="{{ Storage::url($image) }}" alt="Product Detail" />
                                        </div>
                                    @endforeach
                                @endif

                                @if (!empty($product->video))
                                    <div class="swiper-slide position-relative bg-black">
                                        <video id="mainVideo" controls controlsList="nodownload noplaybackrate">
                                            <source src="{{ Storage::url($product->video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif
                            </div>
                            <div class="swiper-button-next d-none d-md-flex"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                        </div>

                        <div class="swiper mySwiperProduct pb-2">
                            <div class="swiper-wrapper">
                                @if ($firstVariant->use_variant_image == 1)
                                    <div class="swiper-slide" style="width: 20%;">
                                        <div class="thumb-wrapper">
                                            <img src="{{ Storage::url($firstVariant->variant_image) }}" alt="Thumb" />
                                        </div>
                                    </div>
                                @else
                                    <div class="swiper-slide" style="width: 20%;">
                                        <div class="thumb-wrapper">
                                            <img src="{{ Storage::url($product->main_image) }}" alt="Thumb" />
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($product->images))
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide" style="width: 20%;">
                                            <div class="thumb-wrapper">
                                                <img src="{{ Storage::url($image) }}" alt="Thumb" />
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                @if (!empty($product->video))
                                    <div class="swiper-slide" id="videoproduk" style="width: 20%;">
                                        <div class="thumb-wrapper position-relative">
                                            <img src="{{ Storage::url($product->main_image) }}" alt="Video Thumb" />
                                            <div class="video-badge"><i class="fas fa-play"
                                                    style="font-size: 0.8rem; margin-left: 2px;"></i></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="product-brand-title">
                        <a href="/{{ $product->brand->name }}_brand"
                            class="text-decoration-none text-muted hover:text-dark">
                            {{ $product->brand->name }}
                        </a>

                        @php
                            $inWishlist = session('id_user') && collect($wishlists)->contains('product_variant_id', $firstVariant->id);
                        @endphp
                        <button class="btn-wishlist-premium {{ $inWishlist ? 'active' : '' }} d-none d-lg-block"
                            onclick="{{ session('id_user') ? ($inWishlist ? 'removeFromWishlist(' . $product->id . ',' . $firstVariant->id . ')' : 'addToWishlist(' . $product->id . ',' . $firstVariant->id . ')') : 'var myModal = new bootstrap.Modal(document.getElementById(\'loginUser1\')); myModal.show();' }}"
                            title="{{ $inWishlist ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
                            <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                        </button>
                    </div>

                    <h1 class="product-main-title">{{ $product->product_name }}</h1>

                    <div class="product-meta-row">
                        <div class="rating-badge">
                            <i class="fas fa-star"></i> {{ $product->rating ?? '5.0' }}
                        </div>
                        <span class="review-count"
                            onclick="document.getElementById('tab-ulasan').click(); document.getElementById('ulasan-section').scrollIntoView({behavior: 'smooth'});">
                            ({{ $product->rating_and_reviews_count }} Ulasan)
                        </span>
                        @if ($product->sale != 0)
                            <span class="sold-count"><i class="fas fa-fire me-1"></i> Terjual {{ $product->sale }}</span>
                        @endif
                        {{-- <span class="text-muted fs-7 ms-auto">Stok: <strong
                                class="text-dark">{{ $firstVariant->variant_stock }}</strong></span> --}}
                                <span class="text-muted fs-7 ms-auto text-end">
                                    Stok: <strong class="text-dark">{{ $firstVariant->variant_stock }}</strong>
                                    @php
                                        $allVStks = collect();
                                        $upVStk = $firstVariant->stocks ? $firstVariant->stocks->sum('quantity') : 0;
                                        $initVStk = $firstVariant->variant_stock - $upVStk;

                                        if ($initVStk > 0 && !empty($firstVariant->variant_expired)) {
                                            $allVStks->push($firstVariant->variant_expired);
                                        }
                                        if ($firstVariant->stocks) {
                                            foreach($firstVariant->stocks as $st) {
                                                if ($st->quantity > 0 && !empty($st->date_expired)) {
                                                    $allVStks->push($st->date_expired);
                                                }
                                            }
                                        }
                                        $nearestVariantExpired = $allVStks->sortBy(function($d) {
                                            return \Carbon\Carbon::parse($d)->timestamp;
                                        })->first();
                                    @endphp
                                    @if($nearestVariantExpired)
                                        <br>
                                        <span style="font-size: 0.75rem;">
                                            <i class="far fa-calendar-alt"></i> Exp: <span class="{{ \Carbon\Carbon::parse($nearestVariantExpired)->isPast() ? 'text-danger fw-bold' : 'text-dark fw-medium' }}">{{ \Carbon\Carbon::parse($nearestVariantExpired)->format('d M Y') }}</span>
                                        </span>
                                    @endif
                                </span>
                    </div>

                    <div class="product-price-display" id="price-variant">
                        Rp{{ number_format($firstVariant->variant_price, 0, ',', '.') }}
                    </div>

                    <div class="variant-section">
                        <div class="variant-label">Pilih {{ ucwords($variantType) }}:</div>
                        <div class="variant-grid">
                            @foreach ($variant as $varian)
                                <a href="{{ route('detail.product', ['id' => $product->product_code, 'varian' => $varian->sku]) }}"
                                    class="variant-btn {{ $firstVariant->sku == $varian->sku ? 'active' : '' }}">
                                    {{ $varian->variant_value }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if ($firstVariant->variant_stock == 0)
                        <div
                            class="alert alert-danger bg-danger text-white border-0 d-flex align-items-center justify-content-between p-3 rounded-3 mt-4 mb-4">
                            <div>
                                <i class="fas fa-exclamation-circle me-2"></i> Maaf, varian ini sedang kosong.
                            </div>
                            <button class="btn btn-light btn-sm fw-bold" id="notify-me-{{$product->id}}"
                                onclick="notifyMe('{{$product->id}}', '{{$firstVariant->id}}')">
                                Beritahu Saya
                            </button>
                        </div>
                    @else
                        <div class="action-row d-none d-lg-flex">
                            <div class="qty-selector">
                                <button class="qty-btn btn-minus"><i class="fas fa-minus"
                                        style="font-size: 0.7rem;"></i></button>
                                <input type="number" class="qty-input no-spinner" id="total-detail-product-quantity"
                                    data-unify="Quantity" value="1" min="1" max="{{ $firstVariant->variant_stock }}">
                                <button class="qty-btn btn-plus"><i class="fas fa-plus" style="font-size: 0.7rem;"></i></button>
                            </div>

                            @if (session('id_user'))
                                @php $inCart = collect($cartItems)->contains('product_id', $product->id); @endphp

                                @if ($inCart)
                                    <button onclick="window.location.href='/cart'" class="btn-buy-premium w-auto flex-grow-1"
                                        style="background:#10B981; border-color:#10B981;">
                                        <i class="fas fa-check-circle fs-5"></i> Cek Keranjang
                                    </button>
                                @else
                                    <button onclick="addToChartWithQuantityVariant({{ $product->id }}, {{ $firstVariant->id }})"
                                        class="btn-cart-premium">
                                        <i class="fas fa-shopping-cart"></i> Keranjang
                                    </button>
                                    <button onclick="buyNowVariant({{$product->id}}, {{ $firstVariant->id }})" class="btn-buy-premium">
                                        Beli Sekarang
                                    </button>
                                @endif
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-buy-premium w-100">
                                    Login untuk Belanja
                                </button>
                            @endif
                        </div>
                        <p id="quantity-warning" class="text-danger fs-7 d-none mb-3"><i class="fas fa-info-circle"></i> Batas
                            maksimal stok terpenuhi</p>
                    @endif

                </div>
            </div>

            <div class="row mt-5" id="ulasan-section">
                <div class="col-12">
                    <nav class="nav premium-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="tab-deskripsi" data-bs-toggle="tab" data-bs-target="#deskripsi"
                            type="button" role="tab">Deskripsi Produk</button>
                        <button class="nav-link" id="tab-informasi" data-bs-toggle="tab" data-bs-target="#informasi"
                            type="button" role="tab">Informasi Penting</button>
                        <button class="nav-link" id="tab-ulasan" data-bs-toggle="tab" data-bs-target="#ulasan" type="button"
                            role="tab">Ulasan Pembeli ({{ $product->rating_and_reviews_count }})</button>
                    </nav>

                    <div class="tab-content tab-content-box p-2">
                        <div class="tab-pane fade show active" id="deskripsi" role="tabpanel">
                            {!! $product->description !!}
                        </div>

                        <div class="tab-pane fade" id="informasi" role="tabpanel">
                            {!! $product->information_product !!}
                        </div>

                        <div class="tab-pane fade" id="ulasan" role="tabpanel">
                            @if($product->rating_and_reviews_count > 0)
                                <div class="row">
                                    <div class="col-lg-8">
                                        @foreach ($product->ratingAndReviews as $review)
                                            <div class="review-card">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            style="width:35px; height:35px; background:var(--glamoire-sand); border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:bold; color:var(--glamoire-dark);">
                                                            {{ substr($review->user->fullname, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <div class="reviewer-name">{{ $review->user->fullname }}</div>
                                                            <div class="review-date">
                                                                {{ \Carbon\Carbon::parse($review->created_at)->translatedFormat('d F Y') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="rating-badge">
                                                        @for ($star = 1; $star <= 5; $star++)
                                                            <i class="fas fa-star"
                                                                style="color: {{ $star <= $review->rating ? '#F59E0B' : '#E5E7EB' }}; font-size:0.8rem;"></i>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="review-text">{{ $review->description }}</div>

                                                <div class="review-media d-flex gap-2 mt-3 flex-wrap">
                                                    @if ($review->video !== null)
                                                        <div class="position-relative">
                                                            <video class="hover:cursor-pointer"
                                                                style="width:80px; height:80px; object-fit:cover; border-radius:8px; border:1px solid #eee;"
                                                                onclick="openFullscreenModal('{{ Storage::url($review->video) }}', 'video')">
                                                                <source src="{{ Storage::url($review->video) }}" type="video/mp4">
                                                            </video>
                                                            <div class="video-badge" style="width:24px; height:24px; font-size:0.6rem;">
                                                                <i class="fas fa-play"></i></div>
                                                        </div>
                                                    @endif
                                                    @if ($review->images !== null)
                                                        @foreach (json_decode($review->images, true) as $image)
                                                            <img src="{{ Storage::url($image) }}" alt="Review Image"
                                                                onclick="openFullscreenModal('{{ Storage::url($image) }}', 'image')" />
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5 text-muted">
                                    <i class="far fa-comment-dots fs-1 mb-3 opacity-50"></i>
                                    <p>Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mb-5 mt-5 pt-4 border-top">
            <div class="d-flex justify-content-between align-items-end mb-4 px-2">
                <h2 class="m-0"
                    style="font-family: 'The Seasons', serif; font-size: 1.8rem; font-weight:700; color:var(--glamoire-dark);">
                    Mungkin Anda Suka</h2>
            </div>

            <div class="swiper mySwiperDetail">
                <div class="swiper-wrapper pb-4">
                    @if (session('id_user'))
                        @foreach ($youlike as $yl)
                            @php
                                $activePromoYL = $yl->promos->first();
                                $discountedPriceYL = $activePromoYL ? $activePromoYL->pivot->discounted_price : null;
                                $discountPercentYL = ($discountedPriceYL && $yl->regular_price > 0) ? round((($yl->regular_price - $discountedPriceYL) / $yl->regular_price) * 100) : 0;
                                $inWishlistYL = collect($wishlists)->contains('product_id', $yl->id);
                            @endphp
                            <div class="swiper-slide h-auto">
                                <div class="premium-product-card-small"
                                    onclick="window.location.href = '/{{ $yl->product_code }}_product'">
                                    <div class="card-img-box {{ $yl->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                        @if ($discountPercentYL > 0)
                                            <span class="card-badge badge-discount">-{{ $discountPercentYL }}%</span>
                                        @endif

                                        <div class="btn-wishlist {{ $inWishlistYL ? 'active' : '' }}"
                                            onclick="event.stopPropagation(); {{ $inWishlistYL ? 'removeFromWishlist(' . $yl->id . ')' : 'addToWishlist(' . $yl->id . ')' }}">
                                            <i class="{{ $inWishlistYL ? 'fas' : 'far' }} fa-heart"></i>
                                        </div>
                                        <img src="{{ Storage::url($yl->main_image) }}" alt="{{ $yl->product_name }}">
                                    </div>

                                    <div class="card-info p-3">
                                        <div class="rating-box mb-1"><i class="fas fa-star"></i>
                                            <span>{{ $yl->rating ?? '5.0' }}</span></div>
                                        <a href="/{{ $yl->product_code }}_product"
                                            class="product-name fs-6">{{ $yl->product_name }}</a>

                                        <div class="price-box">
                                            @if ($yl->priceVariation !== null)
                                                <span class="price-current fs-6">{{ $yl->priceVariation }}</span>
                                            @else
                                                @if ($discountedPriceYL && $discountedPriceYL < $yl->regular_price)
                                                    <span class="price-strike"
                                                        style="font-size:0.75rem;">Rp{{ number_format($yl->regular_price, 0, ',', '.') }}</span>
                                                    <span
                                                        class="price-current price-discounted fs-6">Rp{{ number_format($discountedPriceYL, 0, ',', '.') }}</span>
                                                @else
                                                    <span
                                                        class="price-current fs-6">Rp{{ number_format($yl->regular_price, 0, ',', '.') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-button-next-other"
                    style="position:absolute; right:10px; top:40%; z-index:10; background:white; width:35px; height:35px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1); cursor:pointer;">
                    <i class="fas fa-chevron-right text-dark"></i></div>
                <div class="swiper-button-prev-other"
                    style="position:absolute; left:10px; top:40%; z-index:10; background:white; width:35px; height:35px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1); cursor:pointer;">
                    <i class="fas fa-chevron-left text-dark"></i></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative text-center">
                    <button type="button" id="btn-close-fullscreen" class="btn-close position-absolute top-0 end-0 m-3 z-3"
                        data-bs-dismiss="modal"
                        style="background-color: white; border-radius: 50%; padding: 0.5rem;"></button>
                    <div id="modalContent" class="shadow-lg rounded-4 overflow-hidden"></div>
                </div>
            </div>
        </div>
    </div>

    @if ($firstVariant->variant_stock > 0)
        <div class="d-lg-none fixed-bottom mobile-buy-nav">
            <div class="d-flex gap-2">
                @if (session('id_user'))
                    @php $inCartMobile = collect($cartItems)->contains('product_id', $product->id); @endphp
                    @if($inCartMobile)
                        <button onclick="window.location.href='/cart'" class="btn-buy-premium w-100"
                            style="background:#10B981; border-color:#10B981; border-radius:12px;">
                            <i class="fas fa-check-circle me-1"></i> Di Keranjang
                        </button>
                    @else
                        <button onclick="addToChartWithQuantityVariant({{$product->id}}, {{ $firstVariant->id }})"
                            class="btn-cart-premium w-50" style="border-radius:12px;">
                            Keranjang
                        </button>
                        <button onclick="buyNowVariant({{$product->id}}, {{ $firstVariant->id }})" class="btn-buy-premium w-50"
                            style="border-radius:12px;">
                            Beli Sekarang
                        </button>
                    @endif
                @else
                    <button data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-buy-premium w-100"
                        style="border-radius:12px;">
                        Login untuk Belanja
                    </button>
                @endif
            </div>
        </div>
    @endif

    @include('spinner')

    <script>
        // Inisialisasi Data dari Server
        let productVariant = {!! json_encode($product) !!};
        let maxQuantity = {{ $firstVariant->variant_stock }};
        const warningMessage = document.getElementById("quantity-warning");

        // AMBIL CONTAINER SELECTOR QUANTITY (MEMPERBAIKI BUG TOMBOL PLUS MINUS)
        const qtySelectors = document.querySelectorAll('.qty-selector');

        // Logic Kuantitas Plus Minus
        qtySelectors.forEach((selector) => {
            const input = selector.querySelector('.qty-input');
            const btnMinus = selector.querySelector('.btn-minus');
            const btnPlus = selector.querySelector('.btn-plus');

            if(input && btnMinus && btnPlus) {
                input.value = 1;

                // Tombol Minus
                btnMinus.addEventListener("click", function (e) {
                    e.preventDefault();
                    let value = parseInt(input.value, 10);
                    if (value > 1) {
                        input.value = value - 1;
                        if(warningMessage) warningMessage.classList.add("d-none");
                    }
                });

                // Tombol Plus
                btnPlus.addEventListener("click", function (e) {
                    e.preventDefault();
                    let value = parseInt(input.value, 10);
                    if (value < maxQuantity) {
                        input.value = value + 1;
                        if(warningMessage) warningMessage.classList.add("d-none");
                    } else {
                        if(warningMessage) warningMessage.classList.remove("d-none");
                    }
                });

                // Input manual keyboard
                input.addEventListener("input", function () {
                    let value = parseInt(input.value, 10);
                    if (isNaN(value) || value < 1) {
                        input.value = 1;
                        if(warningMessage) warningMessage.classList.add("d-none");
                    } else if (value > maxQuantity) {
                        input.value = maxQuantity;
                        if(warningMessage) warningMessage.classList.remove("d-none");
                    } else {
                        if(warningMessage) warningMessage.classList.add("d-none");
                    }
                });
            }
        });

        // Zoom Image Logic
        const imageContainers = document.querySelectorAll('.main-image-wrapper');
        imageContainers.forEach(container => {
            container.addEventListener('mousemove', function (e) {
                const zoomableImage = this.querySelector('.zoomable-image');
                if (zoomableImage) {
                    const rect = this.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width * 100;
                    const y = (e.clientY - rect.top) / rect.height * 100;
                    zoomableImage.style.transformOrigin = `${x}% ${y}%`;
                    zoomableImage.style.transform = 'scale(2)'; // Zoom level
                }
            });
            container.addEventListener('mouseleave', function () {
                const zoomableImage = this.querySelector('.zoomable-image');
                if (zoomableImage) {
                    zoomableImage.style.transform = 'scale(1)';
                }
            });
        });

        // Handle AJAX Add to Cart
        function addToChartWithQuantityVariant(productId, productVariantId) {
            var currentQuantity = parseInt($('#total-detail-product-quantity').val()) || 1; // Default 1 for mobile

            $.ajax({
                url: "{{ route('add.to.chart.with.quantity.variant') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    product_variant_id: productVariantId,
                    quantity: currentQuantity,
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        Swal.fire({ icon: "error", title: "Oops..", text: response.message });
                    }
                },
                error: function () {
                    Swal.fire({ icon: "error", title: "Error", text: "Terjadi kesalahan sistem." });
                }
            });
        }

        // Handle AJAX Buy Now
        function buyNowVariant(productId, productVariantId) {
            var currentQuantity = parseInt($('#total-detail-product-quantity').val()) || 1;

            $.ajax({
                url: "{{ route('add.product.variant.buy.now') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    product_variant_id: productVariantId,
                    quantity: currentQuantity,
                },
                success: function (response) {
                    if (response.success) {
                        window.location.href = "/buy-now";
                    } else {
                        Swal.fire({ icon: "error", title: "Oops..", text: response.message });
                    }
                }
            });
        }

        // Modal Fullscreen
        function openFullscreenModal(source, type) {
            var modalContent = document.getElementById('modalContent');
            if (type === 'image') {
                modalContent.innerHTML = '<img src="' + source + '" class="w-100 rounded-4" style="object-fit: contain; max-height:85vh;">';
            } else if (type === 'video') {
                modalContent.innerHTML = '<video class="w-100 rounded-4" controls autoplay controlsList="nodownload noplaybackrate" style="max-height:85vh;"><source src="' + source + '" type="video/mp4"></video>';
            }
            var fullscreenModal = new bootstrap.Modal(document.getElementById('fullscreenModal'));
            fullscreenModal.show();
        }

        // Initialize Swiper Sliders
        document.addEventListener('DOMContentLoaded', function () {
            // Thumbnail Swiper
            const mySwiperProduct = new Swiper('.mySwiperProduct', {
                slidesPerView: 5,
                spaceBetween: 10,
                watchSlidesProgress: true,
            });

            // Main Image Swiper
            const mySwiperShow = new Swiper('.mySwiperShow', {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: mySwiperProduct,
                },
            });

            // Related Products Swiper
            var swiperDetailProduct = new Swiper(".mySwiperDetail", {
                slidesPerView: 2,
                spaceBetween: 12,
                navigation: {
                    nextEl: ".swiper-button-next-other",
                    prevEl: ".swiper-button-prev-other",
                },
                breakpoints: {
                    576: { slidesPerView: 3, spaceBetween: 15 },
                    768: { slidesPerView: 4, spaceBetween: 15 },
                    992: { slidesPerView: 5, spaceBetween: 20 },
                    1200: { slidesPerView: 6, spaceBetween: 20 }
                },
            });

            // Handle Video Click to slide
            const videoThumb = document.getElementById('videoproduk');
            if (videoThumb) {
                videoThumb.addEventListener('click', function (e) {
                    e.preventDefault();
                    const video = document.getElementById('mainVideo');
                    const videoIndex = Array.from(videoThumb.parentNode.children).indexOf(videoThumb);
                    mySwiperShow.slideTo(videoIndex);
                    setTimeout(() => { if (video) video.play(); }, 300);
                });
            }
        });
    </script>

@endsection

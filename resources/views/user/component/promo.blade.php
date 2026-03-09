@extends('user.layouts.master')

@section('content')

<style>
    /* ----- WORLD CLASS UI/UX STYLING ----- */
    :root {
        --glamoire-dark: #183018;
        --glamoire-light: #F9FAFB;
        --glamoire-accent: #2A4D2A;
        --glamoire-gold: #D4AF37;
        --text-main: #1F2937;
        --text-muted: #6B7280;
        --danger-soft: #FEE2E2;
        --danger-main: #DC2626;
    }

    body {
        background-color: var(--glamoire-light);
    }

    /* Premium Breadcrumb & Page Header */
    .page-header-container {
        background: white;
        padding: 2rem 0 1.5rem 0;
        margin-bottom: 2rem;
        border-bottom: 1px solid #E5E7EB;
    }

    .premium-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(24, 48, 24, 0.04);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .premium-breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.3s;
    }

    .premium-breadcrumb a:hover {
        color: var(--glamoire-dark);
    }

    /* Section Titles */
    .premium-section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.5rem;
    }

    .premium-section-title h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--glamoire-dark);
        margin: 0;
        letter-spacing: -0.5px;
    }

    .premium-section-title .line {
        flex-grow: 1;
        height: 2px;
        background: linear-gradient(to right, rgba(24, 48, 24, 0.1), transparent);
    }

    /* Universal Card Styling */
    .premium-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .premium-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .card-img-wrapper {
        position: relative;
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio by default */
        overflow: hidden;
        background: #f3f4f6;
    }

    .card-img-wrapper.landscape {
        padding-top: 56.25%; /* 16:9 Aspect Ratio for Promos */
    }

    .card-img-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease;
    }

    .premium-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }

    /* Badges */
    .discount-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--danger-main);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
    }

    .wishlist-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        z-index: 2;
        transition: all 0.3s;
        backdrop-filter: blur(4px);
    }

    .wishlist-btn:hover {
        color: var(--danger-main);
        transform: scale(1.1);
    }

    .wishlist-btn.active {
        color: var(--danger-main);
    }

    /* Card Content */
    .card-content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .item-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-decoration: none;
    }

    .premium-card a {
        text-decoration: none;
    }

    .premium-card a:hover .item-title {
        color: var(--glamoire-accent);
    }

    .item-price {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--glamoire-dark);
        margin-bottom: 0.25rem;
    }

    .item-meta {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Buttons */
    .btn-premium {
        width: 100%;
        padding: 0.6rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s;
        margin-top: auto; /* Pushes button to bottom */
        border: none;
    }

    .btn-cart {
        background: white;
        color: var(--glamoire-dark);
        border: 1px solid var(--glamoire-dark);
    }

    .btn-cart:hover {
        background: var(--glamoire-dark);
        color: white;
    }

    .btn-checkout {
        background: var(--glamoire-dark);
        color: white;
    }

    .btn-checkout:hover {
        background: var(--text-main);
        color: white;
    }

    .btn-sold {
        background: var(--danger-soft);
        color: var(--danger-main);
        cursor: not-allowed;
    }

    .btn-sold-notify {
        background: var(--danger-main);
        color: white;
    }

    /* Modal Premium Styling */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: var(--glamoire-dark);
        color: white;
        border-bottom: none;
        padding: 1.25rem 1.5rem;
    }

    .modal-header .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .tnc-box {
        background: rgba(24, 48, 24, 0.04);
        padding: 1rem;
        border-radius: 12px;
        margin-top: 1rem;
    }

    .tnc-box ul {
        margin: 0;
        padding-left: 1.2rem;
    }

    .tnc-box li {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 4px;
    }

    .dark-overlay {
        filter: grayscale(100%) opacity(0.6);
    }

    /* Swiper Adjustments */
    .swiper-pagination-bullet-active {
        background: var(--glamoire-dark) !important;
    }
</style>

<div class="page-header-container">
    <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">
        <div class="premium-breadcrumb">
            <a href="/"><i class="fas fa-home"></i> Beranda</a>
            <span class="text-muted">/</span>
            <span class="text-dark fw-bold">Promo Spesial</span>
        </div>
        <h1 class="mt-3 fw-bolder text-[#183018]">Penawaran Eksklusif Glamoire</h1>
        <p class="text-muted mb-0">Nikmati diskon, voucher, dan promo bundling terbaik untuk kecantikan vegan Anda.</p>
    </div>
</div>

<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pb-5 mb-5">
    <div class="container-fluid p-0" style="min-height:55vh;">

        @if(count($promos) === 0 && count($voucherGlamoire) === 0 && count($brandVouchers) === 0 && count($productVouchers) === 0 && count($promoBundlings) === 0)
            <div class="d-flex flex-column align-items-center justify-content-center py-5 text-center">
                <img src="{{ asset('images/about-1.png') }}" class="img-fluid mb-4" style="max-width: 250px; opacity: 0.8;" alt="Tidak ada promo">
                <h3 class="fw-bold text-[#183018]">Belum Ada Promo Saat Ini</h3>
                <p class="text-muted max-w-md">Kami sedang menyiapkan penawaran menarik untuk Anda. Pastikan untuk mengecek kembali nanti!</p>
            </div>
        @endif

        @if (count($promos) !== 0)
            <div class="premium-section-title mt-4">
                <h2>Event Spesial</h2>
                <div class="line"></div>
            </div>

            <div class="swiper mySwiperCarousel mb-4 rounded-4 overflow-hidden shadow-sm border border-light">
                <div class="swiper-wrapper">
                    @foreach ($promos as $promo)
                        <div class="swiper-slide">
                            <a href="/{{$promo->promo_name}}-detail-promo">
                                <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name}}" class="img-fluid w-100 object-fit-cover" style="max-height: 400px;">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next" style="color: #183018; background: rgba(255,255,255,0.8); padding: 25px; border-radius: 50%;"></div>
                <div class="swiper-button-prev" style="color: #183018; background: rgba(255,255,255,0.8); padding: 25px; border-radius: 50%;"></div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="row g-4 mb-5">
                @foreach ($promos as $promo)
                    @php
                        $dateRange = explode(' - ', $promo->date_range);
                        $startDate = \Carbon\Carbon::parse($dateRange[0])->translatedFormat('d M Y');
                        $endDate = \Carbon\Carbon::parse($dateRange[1])->translatedFormat('d M Y');
                    @endphp
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="premium-card">
                            <a href="/{{$promo->promo_name}}-detail-promo">
                                <div class="card-img-wrapper landscape">
                                    <div class="discount-badge">
                                        @if ($promo->discount <= 100)
                                            Diskon {{ $promo->discount }}%
                                        @else
                                            Potongan Rp{{ number_format($promo->discount, 0, ',', '.') }}
                                        @endif
                                    </div>
                                    <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name }}">
                                </div>
                            </a>
                            <div class="card-content">
                                <a href="/{{$promo->promo_name}}-detail-promo"><h3 class="item-title">{{ $promo->promo_name }}</h3></a>
                                <div class="item-meta">
                                    <i class="far fa-calendar-alt"></i> Berlaku: {{ $startDate }} - {{ $endDate }}
                                </div>
                                <a href="/{{$promo->promo_name}}-detail-promo" class="btn-premium btn-checkout mt-auto">
                                    Lihat Detail Event <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if (count($voucherGlamoire) !== 0)
            <div class="premium-section-title mt-5">
                <h2>Voucher Eksklusif</h2>
                <div class="line"></div>
            </div>
            
            <div class="swiper mySwiperPromo mb-5 pb-4">
                <div class="swiper-wrapper"> 
                    @foreach ($voucherGlamoire as $voucher)
                        <div class="swiper-slide">
                            <div class="premium-card cursor-pointer" 
                                data-bs-toggle="modal" 
                                data-bs-target="#voucherModal" 
                                data-image="{{ Storage::url($voucher->image) }}"
                                data-name="{{ $voucher->promo_name }}"
                                data-discount="{{ $voucher->discount }}"
                                data-max-quantity="{{ $voucher->max_quantity_buyer }}"
                                data-min-transaction="{{ number_format($voucher->min_transaction, 0, ',', '.') }}"
                                data-start-date="{{ \Carbon\Carbon::parse($voucher->start_date)->translatedFormat('d M Y') }}"
                                data-end-date="{{ \Carbon\Carbon::parse($voucher->end_date)->translatedFormat('d M Y') }}">
                                
                                <div class="card-img-wrapper landscape">
                                    <img src="{{ Storage::url($voucher->image) }}" alt="{{ $voucher->promo_name }}">
                                </div>
                                <div class="card-content p-3 text-center">
                                    <h3 class="item-title mb-0 fs-6">{{ $voucher->promo_name }}</h3>
                                    <span class="text-danger fw-bold fs-7 mt-1 text-sm">Klik untuk klaim</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if (count($limitedVouchers) !== 0)
            <div class="premium-section-title mt-5">
                <h2>Diskon Kilat (Limited)</h2>
                <div class="line"></div>
            </div>
            
            <div class="row g-4 mb-5">
                @foreach ($limitedVouchers as $limited)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="premium-card">
                            <div class="card-img-wrapper landscape">
                                <div class="discount-badge bg-warning text-dark">
                                    <i class="fas fa-bolt"></i> Diskon Kilat
                                </div>
                                <img src="{{ Storage::url($limited->image) }}" alt="{{ $limited->promo_name }}">
                            </div>
                            <div class="card-content">
                                <h3 class="item-title">{{ ucwords($limited->promo_name) }}</h3>
                                <div class="item-price text-danger mb-2">
                                    Hemat @if ($limited->discount <= 100) {{ $limited->discount }}% @else Rp{{ number_format($limited->discount, 0, ',', '.') }} @endif
                                </div>
                                
                                <div class="tnc-box mt-0 mb-3">
                                    <strong class="d-block mb-1 fs-7 text-dark"><i class="fas fa-info-circle"></i> S&K Berlaku:</strong>
                                    <ul>
                                        <li>Min. Transaksi Rp{{ number_format($limited->min_transaction, 0, ',', '.') }}</li>
                                        <li>Maks. {{ $limited->max_quantity_buyer }} item/pembeli</li>
                                        <li>Periode: {{ \Carbon\Carbon::parse($limited->start_date)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($limited->end_date)->translatedFormat('d M Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if (count($brandVouchers) !== 0)
            <div class="premium-section-title mt-5">
                <h2>Voucher Brand Terpilih</h2>
                <div class="line"></div>
            </div>

            <div class="row g-4 mb-5">
                @foreach ($brandVouchers as $brand)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="premium-card">
                            <div class="card-img-wrapper landscape cursor-pointer" data-bs-toggle="modal" data-bs-target="#detail-brand-voucher-{{$brand->id}}">
                                <div class="discount-badge bg-primary">Brand Khusus</div>
                                <img src="{{ Storage::url($brand->image) }}" alt="{{ $brand->promo_name }}">
                            </div>
                            <div class="card-content text-center">
                                <h3 class="item-title">{{ ucwords($brand->promo_name) }}</h3>
                                <p class="text-muted mb-3 text-sm">Diskon @if ($brand->discount <= 100) {{ $brand->discount }}% @else Rp{{ number_format($brand->discount, 0, ',', '.') }} @endif</p>
                                <button class="btn-premium btn-cart" data-bs-toggle="modal" data-bs-target="#detail-brand-voucher-{{$brand->id}}">
                                    Lihat Produk Terpilih <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="detail-brand-voucher-{{$brand->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-tag text-warning me-2"></i> {{ ucwords($brand->promo_name) }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 bg-light">
                                        <div class="row g-4">
                                            <div class="col-12 col-lg-4">
                                                <div class="premium-card">
                                                    <div class="card-img-wrapper landscape">
                                                        <img src="{{ Storage::url($brand->image) }}" alt="{{ $brand->promo_name }}">
                                                    </div>
                                                    <div class="card-content">
                                                        <h4 class="fw-bold text-dark fs-5">{{ ucwords($brand->promo_name) }}</h4>
                                                        <div class="tnc-box">
                                                            <strong class="d-block mb-2 text-dark">Syarat & Ketentuan:</strong>
                                                            <ul>
                                                                <li>Maksimal {{ $brand->max_quantity_buyer }} item pembelian</li>
                                                                <li>Min. transaksi Rp{{ number_format($brand->min_transaction, 0, ',', '.') }}</li>
                                                                <li>Berlaku: {{ \Carbon\Carbon::parse($brand->start_date)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($brand->end_date)->translatedFormat('d M Y') }}</li>
                                                            </ul>
                                                            <p class="text-danger mt-3 mb-0 fs-7 text-sm fw-semibold">*Gunakan voucher saat checkout</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-lg-8">
                                                <h5 class="fw-bold mb-3 border-bottom pb-2">Produk Promo</h5>
                                                <div class="row row-cols-2 row-cols-md-3 g-3">
                                                    @foreach ($brand->products as $item)
                                                        @php
                                                            $inWishlist = collect($wishlist)->contains('product_id', $item->id);
                                                            $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $item->id) : false;
                                                        @endphp
                                                        <div class="col">
                                                            <div class="premium-card" onclick="window.location.href = '/{{ $item->product_code }}_product'">
                                                                <div class="card-img-wrapper">
                                                                    <div class="wishlist-btn {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $item->id . ')' : 'addToWishlist(' . $item->id . ')' }}">
                                                                        <i class="fas fa-heart"></i>
                                                                    </div>
                                                                    <img src="{{ Storage::url($item->main_image) }}" class="{{ $item->stock_quantity == 0 ? 'dark-overlay' : '' }}" alt="{{ $item->product_name }}">
                                                                </div>
                                                                
                                                                <div class="card-content p-3">
                                                                    <div class="item-meta mb-1">
                                                                        <span class="text-warning"><i class="fas fa-star"></i> {{ $item->rating }}</span>
                                                                    </div>
                                                                    <a href="/{{ $item->product_code }}_product" class="item-title fs-6">{{ $item->product_name }}</a>
                                                                    
                                                                    @if ($item->priceVariation !== null)
                                                                        <div class="item-price fs-6">{{ $item->priceVariation }}</div>
                                                                    @else
                                                                        <div class="item-price fs-6">Rp{{ number_format($item->regular_price, 0, ',', '.') }}</div>
                                                                    @endif
                                                                    
                                                                    @if (session('id_user'))
                                                                        @if ($item->stock_quantity == 0)
                                                                            <button class="btn-premium btn-sold-notify mt-2" onclick="event.stopPropagation();notifyMe({{$item->id}})" data-bs-toggle="tooltip" title="Beritahu Saya Jika Stok Sudah Ada">
                                                                                <i class="fas fa-bell"></i> Stok Habis
                                                                            </button>
                                                                        @else
                                                                            @if($inCart)
                                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-premium btn-checkout mt-2">
                                                                                    <i class="fas fa-check-circle"></i> Di Keranjang
                                                                                </button>
                                                                            @else
                                                                                <button class="btn-premium btn-cart mt-2" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                                                                    <i class="fas fa-cart-plus"></i> Tambah
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        <button onclick="event.stopPropagation(); window.location.href='/login'" class="btn-premium btn-cart mt-2">
                                                                            Login untuk Beli
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if (count($productVouchers) !== 0 || count($promoBundlings) !== 0)
            <div class="premium-section-title mt-5">
                <h2>Voucher Produk & Bundling</h2>
                <div class="line"></div>
            </div>

            <div class="row g-4 mb-5">
                @foreach ($productVouchers as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="premium-card">
                            <div class="card-img-wrapper landscape cursor-pointer" data-bs-toggle="modal" data-bs-target="#detail-product-voucher-{{$product->id}}">
                                <div class="discount-badge bg-success">Produk Spesial</div>
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->promo_name }}">
                            </div>
                            <div class="card-content text-center">
                                <h3 class="item-title">{{ ucwords($product->promo_name) }}</h3>
                                <button class="btn-premium btn-cart mt-3" data-bs-toggle="modal" data-bs-target="#detail-product-voucher-{{$product->id}}">
                                    Lihat Penawaran <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="detail-product-voucher-{{$product->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-box-open text-warning me-2"></i> {{ ucwords($product->promo_name) }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 bg-light">
                                        <div class="row g-4">
                                            <div class="col-12 col-lg-4">
                                                <div class="premium-card">
                                                    <div class="card-img-wrapper landscape">
                                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->promo_name }}">
                                                    </div>
                                                    <div class="card-content">
                                                        <h4 class="fw-bold text-dark fs-5">{{ ucwords($product->promo_name) }}</h4>
                                                        <div class="tnc-box">
                                                            <strong class="d-block mb-2 text-dark">Syarat & Ketentuan:</strong>
                                                            <ul>
                                                                <li>Maksimal {{ $product->max_quantity_buyer }} item pembelian</li>
                                                                <li>Min. transaksi Rp{{ number_format($product->min_transaction, 0, ',', '.') }}</li>
                                                                <li>Berlaku: {{ \Carbon\Carbon::parse($product->start_date)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($product->end_date)->translatedFormat('d M Y') }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-lg-8">
                                                <h5 class="fw-bold mb-3 border-bottom pb-2">Katalog Promo</h5>
                                                <div class="row row-cols-2 row-cols-md-3 g-3">
                                                    @foreach ($product->products as $item)
                                                        @php
                                                            $inWishlist = collect($wishlist)->contains('product_id', $item->id);
                                                            $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $item->id) : false;
                                                        @endphp
                                                        <div class="col">
                                                            <div class="premium-card" onclick="window.location.href = '/{{ $item->product_code }}_product'">
                                                                <div class="card-img-wrapper">
                                                                    <div class="wishlist-btn {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $item->id . ')' : 'addToWishlist(' . $item->id . ')' }}">
                                                                        <i class="fas fa-heart"></i>
                                                                    </div>
                                                                    <img src="{{ Storage::url($item->main_image) }}" class="{{ $item->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                                </div>
                                                                <div class="card-content p-3">
                                                                    <div class="item-meta mb-1"><span class="text-warning"><i class="fas fa-star"></i> {{ $item->rating }}</span></div>
                                                                    <a href="/{{ $item->product_code }}_product" class="item-title fs-6">{{ $item->product_name }}</a>
                                                                    <div class="item-price fs-6">{{ $item->priceVariation !== null ? $item->priceVariation : 'Rp'.number_format($item->regular_price, 0, ',', '.') }}</div>
                                                                    
                                                                    @if (session('id_user'))
                                                                        @if ($item->stock_quantity == 0)
                                                                            <button class="btn-premium btn-sold-notify mt-2" onclick="event.stopPropagation();notifyMe({{$item->id}})">Stok Habis</button>
                                                                        @else
                                                                            @if($inCart)
                                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-premium btn-checkout mt-2">Di Keranjang</button>
                                                                            @else
                                                                                <button class="btn-premium btn-cart mt-2" onclick="event.stopPropagation();addToCart({{$item->id}})">+ Keranjang</button>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($promoBundlings as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="premium-card">
                            <div class="card-img-wrapper landscape cursor-pointer" data-bs-toggle="modal" data-bs-target="#detail-bundling-{{$product->id}}">
                                <div class="discount-badge bg-dark">Paket Bundling</div>
                                <img src="{{ asset('images/bundling.png') }}" alt="{{ $product->promo_name }}">
                            </div>
                            <div class="card-content text-center">
                                <h3 class="item-title">{{ ucwords($product->promo_name) }}</h3>
                                <button class="btn-premium btn-checkout mt-3" data-bs-toggle="modal" data-bs-target="#detail-bundling-{{$product->id}}">
                                    Beli Paket <i class="fas fa-boxes ms-1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="detail-bundling-{{$product->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-boxes text-warning me-2"></i> {{ ucwords($product->promo_name) }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 bg-light">
                                        <div class="row g-4">
                                            <div class="col-12 col-lg-4">
                                                <div class="premium-card">
                                                    <div class="card-img-wrapper landscape">
                                                        <img src="{{ asset('images/bundling.png') }}" alt="{{ $product->promo_name }}">
                                                    </div>
                                                    <div class="card-content">
                                                        <h4 class="fw-bold text-dark fs-5">{{ ucwords($product->promo_name) }}</h4>
                                                        <div class="tnc-box">
                                                            <strong class="d-block mb-2 text-dark">Rincian Diskon:</strong>
                                                            <div class="fs-7 text-muted">{!! $product->all_discount_tiers !!}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-lg-8">
                                                <h5 class="fw-bold mb-3 border-bottom pb-2">Pilih Item Bundling</h5>
                                                <div class="row row-cols-2 row-cols-md-3 g-3">
                                                    @foreach ($product->products as $item)
                                                        @php
                                                            $inWishlist = collect($wishlist)->contains('product_id', $item->id);
                                                            $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $item->id) : false;
                                                        @endphp
                                                        <div class="col">
                                                            <div class="premium-card" onclick="window.location.href = '/{{ $item->product_code }}_product'">
                                                                <div class="card-img-wrapper">
                                                                    <div class="wishlist-btn {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $item->id . ')' : 'addToWishlist(' . $item->id . ')' }}">
                                                                        <i class="fas fa-heart"></i>
                                                                    </div>
                                                                    <img src="{{ Storage::url($item->main_image) }}" class="{{ $item->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                                </div>
                                                                <div class="card-content p-3">
                                                                    <div class="item-meta mb-1"><span class="text-warning"><i class="fas fa-star"></i> {{ $item->rating }}</span></div>
                                                                    <a href="/{{ $item->product_code }}_product" class="item-title fs-6">{{ $item->product_name }}</a>
                                                                    <div class="item-price fs-6">{{ $item->priceVariation !== null ? $item->priceVariation : 'Rp'.number_format($item->regular_price, 0, ',', '.') }}</div>
                                                                    
                                                                    @if (session('id_user'))
                                                                        @if ($item->stock_quantity == 0)
                                                                            <button class="btn-premium btn-sold-notify mt-2" onclick="event.stopPropagation();notifyMe({{$item->id}})">Stok Habis</button>
                                                                        @else
                                                                            @if($inCart)
                                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-premium btn-checkout mt-2">Di Keranjang</button>
                                                                            @else
                                                                                <button class="btn-premium btn-cart mt-2" onclick="event.stopPropagation();addToCart({{$item->id}})">+ Keranjang</button>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>

<div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="voucherModalLabel">Detail Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-img-wrapper landscape" style="border-radius: 0;">
                    <img id="voucherImage" src="" alt="Voucher Image">
                </div>
                <div class="p-4 bg-white">
                    <div class="text-center mb-3 border-bottom pb-3">
                        <h4 class="text-danger fw-bold mb-1" id="voucherDiscount"></h4>
                        <span class="text-muted fs-7">Gunakan saat checkout</span>
                    </div>
                    <strong class="d-block mb-2 text-dark fs-6"><i class="fas fa-list-ul me-1"></i> Syarat & Ketentuan:</strong>
                    <ul class="text-muted fs-7 ps-3 m-0" style="line-height: 1.6;">
                        <li>Maksimal <strong class="text-dark" id="voucherMaxQuantity"></strong> item.</li>
                        <li>Min. belanja Rp<strong class="text-dark" id="voucherMinTransaction"></strong>.</li>
                        <li>Berlaku: <span id="voucherStartDate"></span> - <span id="voucherEndDate"></span>.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const voucherModal = document.getElementById('voucherModal');
    if(voucherModal) {
        voucherModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            
            const image = button.getAttribute('data-image');
            const name = button.getAttribute('data-name');
            const discount = button.getAttribute('data-discount');
            const maxQuantity = button.getAttribute('data-max-quantity');
            const minTransaction = button.getAttribute('data-min-transaction');
            const startDate = button.getAttribute('data-start-date');
            const endDate = button.getAttribute('data-end-date');

            voucherModal.querySelector('#voucherImage').src = image;
            voucherModal.querySelector('#voucherImage').alt = name;
            voucherModal.querySelector('#voucherModalLabel').textContent = name;
            voucherModal.querySelector('#voucherDiscount').textContent = discount <= 100 ? `Diskon ${discount}%` : `Potongan Rp${discount}`;
            voucherModal.querySelector('#voucherMaxQuantity').textContent = maxQuantity;
            voucherModal.querySelector('#voucherMinTransaction').textContent = minTransaction;
            voucherModal.querySelector('#voucherStartDate').textContent = startDate;
            voucherModal.querySelector('#voucherEndDate').textContent = endDate;
        });
    }
  });
</script>
@endsection
{{-- @extends('user.layouts.master')

@section('content')
  <style>
      /* ==========================================
         WORLD CLASS PROMO DETAIL STYLING
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
      .premium-breadcrumb a { color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); }
      .premium-breadcrumb a:hover { color: var(--glamoire-dark); }
      .premium-breadcrumb span { color: var(--text-muted); font-size: 0.85rem; margin: 0 8px; }
      .premium-breadcrumb .active-page { color: var(--glamoire-dark); font-weight: 600; font-size: 0.85rem; }

      /* --- Promo Hero Banner --- */
      .promo-hero-wrapper {
          position: relative;
          border-radius: 24px;
          overflow: hidden;
          margin-bottom: 4rem;
          background: #000;
          box-shadow: 0 20px 40px rgba(0,0,0,0.1);
      }

      .promo-hero-img {
          width: 100%;
          aspect-ratio: 21/9;
          object-fit: cover;
          opacity: 0.85;
          transition: transform 10s ease;
      }

      .promo-hero-wrapper:hover .promo-hero-img {
          transform: scale(1.05);
      }

      .promo-info-box {
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 50%, transparent 100%);
          padding: 4rem 3rem 2rem;
          color: #FFF;
          display: flex;
          flex-direction: column;
          justify-content: flex-end;
      }

      .promo-title {
          font-family: 'The Seasons', serif;
          font-size: clamp(2rem, 5vw, 3.5rem);
          font-weight: 700;
          margin-bottom: 0.5rem;
          color: var(--glamoire-gold);
          text-shadow: 0 2px 10px rgba(0,0,0,0.5);
      }

      .promo-date {
          display: inline-flex;
          align-items: center;
          gap: 8px;
          background: rgba(255,255,255,0.15);
          backdrop-filter: blur(8px);
          padding: 6px 16px;
          border-radius: 50px;
          font-size: 0.9rem;
          font-weight: 500;
          border: 1px solid rgba(255,255,255,0.2);
          width: fit-content;
      }

      @media (max-width: 768px) {
          .promo-hero-wrapper { border-radius: 16px; margin-bottom: 2.5rem; }
          .promo-hero-img { aspect-ratio: 16/9; }
          .promo-info-box { padding: 3rem 1.5rem 1.5rem; }
      }

      /* --- Universal Product Card --- */
      .catalog-header {
          display: flex; justify-content: space-between; align-items: center;
          margin-bottom: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 1rem;
      }
      .catalog-header h2 {
          font-family: 'The Seasons', serif; font-size: 2rem; font-weight: 700; color: var(--glamoire-dark); margin: 0;
      }

      .product-grid {
          display: grid;
          grid-template-columns: repeat(5, 1fr);
          gap: 1.5rem;
          margin-bottom: 4rem;
      }
      @media (max-width: 1200px) { .product-grid { grid-template-columns: repeat(4, 1fr); } }
      @media (max-width: 991px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
      @media (max-width: 768px) { .product-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; } }

      .premium-product-card {
          background: #FFF; border-radius: 12px; border: 1px solid #F3F4F6;
          overflow: hidden; transition: var(--transition-smooth); height: 100%; display: flex; flex-direction: column; position: relative;
      }
      .premium-product-card:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.06); transform: translateY(-5px); border-color: #E5E7EB; }
      .card-img-box { position: relative; padding-top: 100%; background: #FAFAFA; overflow: hidden; cursor: pointer; }
      .card-img-box img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; }
      .premium-product-card:hover .card-img-box img { transform: scale(1.08); }
      .card-img-box.dark-overlay img { filter: grayscale(100%) opacity(0.7); }

      .card-badge { position: absolute; top: 12px; left: 12px; padding: 4px 10px; border-radius: 4px; font-size: 0.7rem; font-weight: 700; z-index: 2; text-transform: uppercase; }
      .badge-discount { background: var(--danger-main); color: #FFF; box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3); }

      .btn-wishlist {
          position: absolute; top: 12px; right: 12px; width: 34px; height: 34px;
          background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); border-radius: 50%;
          display: flex; align-items: center; justify-content: center; color: #D1D5DB; z-index: 2; cursor: pointer; transition: var(--transition-smooth); box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      }
      .btn-wishlist:hover, .btn-wishlist.active { color: var(--danger-main); transform: scale(1.1); }

      .card-action-area { position: absolute; bottom: 0; left: 0; width: 100%; padding: 1rem; background: linear-gradient(to top, rgba(255,255,255,0.95), transparent); transform: translateY(100%); opacity: 0; transition: var(--transition-smooth); z-index: 3; }
      .premium-product-card:hover .card-action-area { transform: translateY(0); opacity: 1; }

      .btn-action-main { width: 100%; padding: 0.6rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; border: none; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; }
      .btn-add { background: var(--glamoire-dark); color: #FFF; }
      .btn-add:hover { background: var(--glamoire-accent); }
      .btn-added { background: #10B981; color: #FFF; }
      .btn-notify { background: var(--danger-main); color: #FFF; }

      .card-info { padding: 1.25rem; display: flex; flex-direction: column; flex-grow: 1; cursor: pointer; }
      .brand-name { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 0.3rem; }
      .product-name { font-size: 0.95rem; font-weight: 500; color: var(--text-main); margin-bottom: 0.5rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-decoration: none; }
      .premium-product-card:hover .product-name { color: var(--glamoire-gold); }
      .rating-box { display: flex; align-items: center; gap: 4px; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.75rem; }
      .rating-box i { color: #F59E0B; }
      .price-box { margin-top: auto; display: flex; flex-direction: column;}
      .price-current { font-size: 1.1rem; font-weight: 700; color: var(--glamoire-dark); }
      .price-discounted { color: var(--danger-main); }
      .price-strike { font-size: 0.85rem; color: #9CA3AF; text-decoration: line-through; margin-bottom: -2px; }

      /* Skeleton Loading */
      .skeleton-card { background: #FFF; border-radius: 12px; border: 1px solid #F3F4F6; overflow: hidden; height: 350px; display: flex; flex-direction: column; }
      .skeleton-img { width: 100%; height: 200px; background: #E2E8F0; animation: pulse 1.5s infinite ease-in-out; }
      .skeleton-body { padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column; gap: 10px; }
      .skeleton-line { height: 12px; background: #E2E8F0; border-radius: 4px; animation: pulse 1.5s infinite ease-in-out; }
      .skeleton-line.w-50 { width: 50%; }
      .skeleton-line.w-80 { width: 80%; }
      .skeleton-line.h-title { height: 20px; }
      @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }
  </style>

  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

      <div class="container-fluid">
          <div class="premium-breadcrumb">
              <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
              <span>/</span>
              <a href="/promotion">Promo</a>
              <span>/</span>
              <span class="active-page">{{ $promo->first()->promo_name ?? 'Detail Promo' }}</span>
          </div>
      </div>

      <div class="container-fluid">
          @foreach ($promo as $p)
            @php
              $dateRange = explode(' - ', $p->date_range);
              $startDate = \Carbon\Carbon::parse($dateRange[0])->translatedFormat('d F Y');
              $endDate = \Carbon\Carbon::parse($dateRange[1])->translatedFormat('d F Y');
            @endphp
            <div class="promo-hero-wrapper">
                <img src="{{ Storage::url($p->image) }}" class="promo-hero-img" alt="{{ $p->promo_name }}">
                <div class="promo-info-box">
                    <h1 class="promo-title">{{ $p->promo_name }}</h1>
                    <div class="promo-date">
                        <i class="far fa-clock text-warning"></i> Berlaku hingga {{ $endDate }}
                    </div>
                </div>
            </div>
          @endforeach
      </div>

      <div class="container-fluid">
          <div class="catalog-header">
              <h2>Katalog Spesial Promo</h2>
          </div>

          <div class="product-grid" id="skeletonLoader">
              @for ($i = 0; $i < count($promo->first()->products ?? []); $i++)
                <div class="skeleton-card">
                    <div class="skeleton-img"></div>
                    <div class="skeleton-body">
                        <div class="skeleton-line w-50"></div>
                        <div class="skeleton-line h-title w-100"></div>
                        <div class="skeleton-line w-80 mt-auto"></div>
                    </div>
                </div>
              @endfor
          </div>

          <div id="productList" style="display: none;">
              @php $currentPromo = $promo->first(); @endphp

              @if ($currentPromo && count($currentPromo->products) > 0)
                <div class="product-grid">
                    @foreach ($currentPromo->products as $product)
                      @php
                        $activePromo = $product->promos->first();
                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                        $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;

                        $inWishlist = session('id_user') ? collect($wishlists ?? [])->contains('product_id', $product->id) : false;
                        $inCart = session('id_user') ? collect($cartItems ?? [])->contains('product_id', $product->id) : false;
                      @endphp

                      <div class="premium-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                          <div class="card-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                              @if ($discountPercent > 0)
                                <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                              @endif

                              <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ session('id_user') ? ($inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')') : 'var myModal = new bootstrap.Modal(document.getElementById(\'loginUser1\')); myModal.show();' }}">
                                  <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                              </div>

                              <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}" loading="lazy">

                              <div class="card-action-area">
                                  @if (session('id_user'))
                                    @if ($product->stock_quantity == 0)
                                      <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})" class="btn-action-main btn-notify">
                                          <i class="fas fa-bell"></i> Beritahu
                                      </button>
                                    @else
                                      @if($inCart)
                                        <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-action-main btn-added">
                                            <i class="fas fa-check"></i> Keranjang
                                        </button>
                                      @else
                                        <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-action-main btn-add">
                                            <i class="fas fa-shopping-bag"></i> Tambah
                                        </button>
                                      @endif
                                    @endif
                                  @else
                                    <button onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-action-main btn-add">
                                        Login Beli
                                    </button>
                                  @endif
                              </div>
                          </div>

                          <div class="card-info">
                              <div class="brand-name">{{ $product->brand ? $product->brand->name : 'Glamoire' }}</div>
                              <a href="/{{ $product->product_code }}_product" class="product-name">{{ $product->product_name }}</a>

                              <div class="rating-box">
                                  <i class="fas fa-star"></i> <span>{{ $product->rating ?? '5.0' }}</span>
                              </div>

                              <div class="price-box">
                                  @if ($product->priceVariation !== null)
                                    <span class="price-current">{{ $product->priceVariation }}</span>
                                  @else
                                    @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                      <span class="price-strike">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                      <span class="price-current price-discounted">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                    @else
                                      <span class="price-current">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                    @endif
                                  @endif
                              </div>
                              @php
    $allStocks = collect();
    $totalUpdateStock = $product->stocks ? $product->stocks->sum('quantity') : 0;
    $initialStockQty = $product->stock_quantity - $totalUpdateStock;

    if ($initialStockQty > 0 && !empty($product->date_expired)) {
        $allStocks->push($product->date_expired);
    }
    if ($product->stocks) {
        foreach($product->stocks as $st) {
            if ($st->quantity > 0 && !empty($st->date_expired)) {
                $allStocks->push($st->date_expired);
            }
        }
    }
    $nearestExpired = $allStocks->sortBy(function($d) {
        return \Carbon\Carbon::parse($d)->timestamp;
    })->first();
@endphp
@if($nearestExpired)
    <div class="mt-2" style="font-size: 0.75rem; color: var(--text-muted);">
        <i class="far fa-calendar-alt"></i> Expired: <span class="{{ \Carbon\Carbon::parse($nearestExpired)->isPast() ? 'text-danger fw-bold' : 'text-dark fw-medium' }}">{{ \Carbon\Carbon::parse($nearestExpired)->format('d M Y') }}</span>
    </div>
@endif
                          </div>
                      </div>
                    @endforeach
                </div>
              @else
                <div class="text-center py-5">
                    <img src="{{ asset('images/product-empty.png') }}" style="max-width: 200px; opacity: 0.7; margin-bottom: 1rem;" alt="Kosong">
                    <h3 style="font-family: 'The Seasons', serif; color: var(--glamoire-dark);">Belum Ada Produk</h3>
                    <p class="text-muted">Maaf, saat ini belum ada produk yang tergabung dalam promo ini.</p>
                </div>
              @endif
          </div>
      </div>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const skeletonLoader = document.getElementById('skeletonLoader');
          const productList = document.getElementById('productList');

          // Show skeleton loader initially (handled by CSS display property)

          // Simulate loading time for smooth UX
          setTimeout(function() {
              if(skeletonLoader) skeletonLoader.style.display = 'none';
              if(productList) productList.style.display = 'block';
          }, 800);
      });
  </script>

@endsection --}}

@extends('user.layouts.master')

@section('content')
  <style>
      /* ==========================================
         WORLD CLASS PROMO DETAIL STYLING
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
      .premium-breadcrumb a { color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.85rem; transition: var(--transition-smooth); }
      .premium-breadcrumb a:hover { color: var(--glamoire-dark); }
      .premium-breadcrumb span { color: var(--text-muted); font-size: 0.85rem; margin: 0 8px; }
      .premium-breadcrumb .active-page { color: var(--glamoire-dark); font-weight: 600; font-size: 0.85rem; }

      /* --- Promo Hero Banner --- */
      .promo-hero-wrapper {
          position: relative;
          border-radius: 24px;
          overflow: hidden;
          margin-bottom: 4rem;
          background: #000;
          box-shadow: 0 20px 40px rgba(0,0,0,0.1);
      }

      .promo-hero-img {
          width: 100%;
          aspect-ratio: 21/9;
          object-fit: cover;
          opacity: 0.85;
          transition: transform 10s ease;
      }

      .promo-hero-wrapper:hover .promo-hero-img {
          transform: scale(1.05);
      }

      .promo-info-box {
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 50%, transparent 100%);
          padding: 4rem 3rem 2rem;
          color: #FFF;
          display: flex;
          flex-direction: column;
          justify-content: flex-end;
      }

      .promo-title {
          font-family: 'The Seasons', serif;
          font-size: clamp(2rem, 5vw, 3.5rem);
          font-weight: 700;
          margin-bottom: 0.5rem;
          color: var(--glamoire-gold);
          text-shadow: 0 2px 10px rgba(0,0,0,0.5);
      }

      .promo-date {
          display: inline-flex;
          align-items: center;
          gap: 8px;
          background: rgba(255,255,255,0.15);
          backdrop-filter: blur(8px);
          padding: 6px 16px;
          border-radius: 50px;
          font-size: 0.9rem;
          font-weight: 500;
          border: 1px solid rgba(255,255,255,0.2);
          width: fit-content;
      }

      @media (max-width: 768px) {
          .promo-hero-wrapper { border-radius: 16px; margin-bottom: 2.5rem; }
          .promo-hero-img { aspect-ratio: 16/9; }
          .promo-info-box { padding: 3rem 1.5rem 1.5rem; }
      }

      /* --- Universal Product Card --- */
      .catalog-header {
          display: flex; justify-content: space-between; align-items: center;
          margin-bottom: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 1rem;
      }
      .catalog-header h2 {
          font-family: 'The Seasons', serif; font-size: 2rem; font-weight: 700; color: var(--glamoire-dark); margin: 0;
      }

      .product-grid {
          display: grid;
          grid-template-columns: repeat(5, 1fr);
          gap: 1.5rem;
          margin-bottom: 4rem;
      }
      @media (max-width: 1200px) { .product-grid { grid-template-columns: repeat(4, 1fr); } }
      @media (max-width: 991px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
      @media (max-width: 768px) { .product-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; } }

      .premium-product-card {
          background: #FFF; border-radius: 12px; border: 1px solid #F3F4F6;
          overflow: hidden; transition: var(--transition-smooth); height: 100%; display: flex; flex-direction: column; position: relative;
      }
      .premium-product-card:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.06); transform: translateY(-5px); border-color: #E5E7EB; }
      .card-img-box {
            position: relative;
            width: 100%;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            background: #FAFAFA;
            overflow: hidden;
        }

        .card-img-box img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
      .premium-product-card:hover .card-img-box img { transform: scale(1.08); }
      .card-img-box.dark-overlay img { filter: grayscale(100%) opacity(0.7); }

      .card-badge { position: absolute; top: 12px; left: 12px; padding: 4px 10px; border-radius: 4px; font-size: 0.7rem; font-weight: 700; z-index: 2; text-transform: uppercase; }
      .badge-discount { background: var(--danger-main); color: #FFF; box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3); }

      .btn-wishlist {
          position: absolute; top: 12px; right: 12px; width: 34px; height: 34px;
          background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); border-radius: 50%;
          display: flex; align-items: center; justify-content: center; color: #D1D5DB; z-index: 2; cursor: pointer; transition: var(--transition-smooth); box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      }
      .btn-wishlist:hover, .btn-wishlist.active { color: var(--danger-main); transform: scale(1.1); }

      .card-action-area { position: absolute; bottom: 0; left: 0; width: 100%; padding: 1rem; background: linear-gradient(to top, rgba(255,255,255,0.95), transparent); transform: translateY(100%); opacity: 0; transition: var(--transition-smooth); z-index: 3; }
      .premium-product-card:hover .card-action-area { transform: translateY(0); opacity: 1; }

      .btn-action-main { width: 100%; padding: 0.6rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; border: none; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; }
      .btn-add { background: var(--glamoire-dark); color: #FFF; }
      .btn-add:hover { background: var(--glamoire-accent); }
      .btn-added { background: #10B981; color: #FFF; }
      .btn-notify { background: var(--danger-main); color: #FFF; }

      .card-info { padding: 1.25rem; display: flex; flex-direction: column; flex-grow: 1; cursor: pointer; }
      .brand-name { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 0.3rem; }
      .product-name-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: calc(1.4em * 3); /* Menyamakan tinggi agar rapi */
            line-height: 1.4em;
            font-size: 0.9rem;
            text-decoration: none;
            color: var(--text-main);
            transition: color 0.2s;
            margin-bottom: 0.5rem;
        }

        .product-name-clamp:hover {
            color: var(--glamoire-gold);
        }
      .rating-box { display: flex; align-items: center; gap: 4px; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.75rem; }
      .rating-box i { color: #F59E0B; }
      .price-box { margin-top: auto; display: flex; flex-direction: column;}
      .price-current { font-size: 1.1rem; font-weight: 700; color: var(--glamoire-dark); }
      .price-discounted { color: var(--danger-main); }
      .price-strike { font-size: 0.85rem; margin-bottom: -2px; }

      /* Skeleton Loading */
      .skeleton-card { background: #FFF; border-radius: 12px; border: 1px solid #F3F4F6; overflow: hidden; height: 350px; display: flex; flex-direction: column; }
      .skeleton-img { width: 100%; height: 200px; background: #E2E8F0; animation: pulse 1.5s infinite ease-in-out; }
      .skeleton-body { padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column; gap: 10px; }
      .skeleton-line { height: 12px; background: #E2E8F0; border-radius: 4px; animation: pulse 1.5s infinite ease-in-out; }
      .skeleton-line.w-50 { width: 50%; }
      .skeleton-line.w-80 { width: 80%; }
      .skeleton-line.h-title { height: 20px; }
      @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }
  </style>

  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

      <div class="container-fluid">
          <div class="premium-breadcrumb">
              <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
              <span>/</span>
              <a href="/promotion">Promo</a>
              <span>/</span>
              <span class="active-page">{{ $promo->first()->promo_name ?? 'Detail Promo' }}</span>
          </div>
      </div>

      <div class="container-fluid">
          @foreach ($promo as $p)
            @php
              $dateRange = explode(' - ', $p->date_range);
              $startDate = \Carbon\Carbon::parse($dateRange[0])->translatedFormat('d F Y');
              $endDate = \Carbon\Carbon::parse($dateRange[1])->translatedFormat('d F Y');
            @endphp
            <div class="promo-hero-wrapper">
                <img src="{{ Storage::url($p->image) }}" class="promo-hero-img" alt="{{ $p->promo_name }}">
                <div class="promo-info-box">
                    <h1 class="promo-title">{{ $p->promo_name }}</h1>
                    <div class="promo-date">
                        <i class="far fa-clock text-warning"></i> Berlaku hingga {{ $endDate }}
                    </div>
                </div>
            </div>
          @endforeach
      </div>

      <div class="container-fluid">
          <div class="catalog-header">
              <h2>Katalog Spesial Promo</h2>
          </div>

          <div class="product-grid" id="skeletonLoader">
              @for ($i = 0; $i < count($promo->first()->products ?? []); $i++)
                <div class="skeleton-card">
                    <div class="skeleton-img"></div>
                    <div class="skeleton-body">
                        <div class="skeleton-line w-50"></div>
                        <div class="skeleton-line h-title w-100"></div>
                        <div class="skeleton-line w-80 mt-auto"></div>
                    </div>
                </div>
              @endfor
          </div>

          <div id="productList" style="display: none;">
              @php $currentPromo = $promo->first(); @endphp

              @if ($currentPromo && count($currentPromo->products) > 0)
                <div class="product-grid">
                    @foreach ($currentPromo->products as $product)
                      @php
                        $activePromo = $product->promos->first();
                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                        $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;

                        // Null-safe check agar guest tidak error
                        $inWishlist = session('id_user') ? collect($wishlists ?? [])->contains('product_id', $product->id) : false;
                        $inCart = session('id_user') ? collect($cartItems ?? [])->contains('product_id', $product->id) : false;
                      @endphp

                      <div class="premium-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                          <div class="card-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                              @if ($discountPercent > 0)
                                <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                              @endif

                              <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ session('id_user') ? ($inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')') : 'var myModal = new bootstrap.Modal(document.getElementById(\'loginUser1\')); myModal.show();' }}">
                                  <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                              </div>

                              <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}" loading="lazy">

                              <div class="card-action-area">
                                  @if (session('id_user'))
                                    @if ($product->stock_quantity == 0)
                                      <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})" class="btn-action-main btn-notify">
                                          <i class="fas fa-bell"></i> Beritahu
                                      </button>
                                    @else
                                      @if($inCart)
                                        <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-action-main btn-added">
                                            <i class="fas fa-check"></i> Keranjang
                                        </button>
                                      @else
                                        <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-action-main btn-add">
                                            <i class="fas fa-shopping-bag"></i> Tambah
                                        </button>
                                      @endif
                                    @endif
                                  @else
                                    <button onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-action-main btn-add">
                                        Login Beli
                                    </button>
                                  @endif
                              </div>
                          </div>

                          <div class="card-info">
                              <div class="brand-name">{{ $product->brand ? $product->brand->name : 'Glamoire' }}</div>
                              <a href="/{{ $product->product_code }}_product" class="product-name-clamp">{{ $product->product_name }}</a>

                              <div class="rating-box">
                                  <i class="fas fa-star"></i> <span>{{ $product->rating ?? '5.0' }}</span>
                              </div>

                              <div class="price-box">
                                  @if ($product->priceVariation !== null)
                                    <span class="price-current">{{ $product->priceVariation }}</span>
                                  @else
                                    @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                      <span class="price-strike text-decoration-line-through text-muted fs-7">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                      <span class="price-current price-discounted text-danger">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                    @else
                                      <span class="price-current">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                    @endif
                                  @endif
                              </div>
                              @php
                                $allStocks = collect();
                                $totalUpdateStock = $product->stocks ? $product->stocks->sum('quantity') : 0;
                                $initialStockQty = $product->stock_quantity - $totalUpdateStock;

                                if ($initialStockQty > 0 && !empty($product->date_expired)) {
                                    $allStocks->push($product->date_expired);
                                }
                                if ($product->stocks) {
                                    foreach($product->stocks as $st) {
                                        if ($st->quantity > 0 && !empty($st->date_expired)) {
                                            $allStocks->push($st->date_expired);
                                        }
                                    }
                                }
                                $nearestExpired = $allStocks->sortBy(function($d) {
                                    return \Carbon\Carbon::parse($d)->timestamp;
                                })->first();
                            @endphp
                            @if($nearestExpired)
                                <div class="mt-2" style="font-size: 0.75rem; color: var(--text-muted);">
                                    <i class="far fa-calendar-alt"></i> Expired: <span class="{{ \Carbon\Carbon::parse($nearestExpired)->isPast() ? 'text-danger fw-bold' : 'text-dark fw-medium' }}">{{ \Carbon\Carbon::parse($nearestExpired)->format('d M Y') }}</span>
                                </div>
                            @endif
                          </div>
                      </div>
                    @endforeach
                </div>
              @else
                <div class="text-center py-5">
                    <img src="{{ asset('images/product-empty.png') }}" style="max-width: 200px; opacity: 0.7; margin-bottom: 1rem;" alt="Kosong">
                    <h3 style="font-family: 'The Seasons', serif; color: var(--glamoire-dark);">Belum Ada Produk</h3>
                    <p class="text-muted">Maaf, saat ini belum ada produk yang tergabung dalam promo ini.</p>
                </div>
              @endif
          </div>
      </div>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const skeletonLoader = document.getElementById('skeletonLoader');
          const productList = document.getElementById('productList');

          // Show skeleton loader initially (handled by CSS display property)

          // Simulate loading time for smooth UX
          setTimeout(function() {
              if(skeletonLoader) skeletonLoader.style.display = 'none';
              if(productList) productList.style.display = 'block';
          }, 800);
      });
  </script>

@endsection


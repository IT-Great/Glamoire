@extends('user.layouts.master')

@section('content')
  @php use Illuminate\Support\Str; @endphp

  <style>
    /* ==========================================
         WORLD CLASS SHOP CATALOG STYLING
         ========================================== */
    :root {
      --glamoire-dark: #183018;
      --glamoire-light: #F9FAFB;
      --glamoire-accent: #2A4D2A;
      --glamoire-gold: #D4AF37;
      --text-main: #1F2937;
      --text-muted: #6B7280;
      --border-color: #E5E7EB;
      --danger-main: #DC2626;
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

    /* --- Catalog Header --- */
    .catalog-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .catalog-title {
      font-family: 'The Seasons', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 700;
      color: var(--glamoire-dark);
      margin-bottom: 0.5rem;
      text-transform: capitalize;
    }

    .catalog-subtitle {
      color: var(--text-muted);
      font-size: 0.95rem;
    }

    /* --- MODERN TOP FILTER BAR --- */
    .top-filter-bar {
      background: #FFFFFF;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
      padding: 1rem 0;
      margin-bottom: 2.5rem;
      position: sticky;
      top: 70px;
      z-index: 900;
    }

    .filter-group-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .filter-left,
    .filter-right {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .filter-pill {
      background: var(--glamoire-light);
      border: 1px solid var(--border-color);
      color: var(--text-main);
      padding: 0.5rem 1.25rem;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: var(--transition-smooth);
    }

    .filter-pill:hover,
    .filter-pill[aria-expanded="true"] {
      background: #FFF;
      border-color: var(--glamoire-dark);
      color: var(--glamoire-dark);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .filter-pill.active-filter {
      background: var(--glamoire-dark);
      color: #FFF;
      border-color: var(--glamoire-dark);
    }

    .sort-select {
      appearance: none;
      background: transparent;
      border: none;
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--glamoire-dark);
      padding-right: 1.5rem;
      cursor: pointer;
      outline: none;
    }

    /* Dropdowns */
    .filter-dropdown-menu {
      border: none;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      padding: 1.5rem;
      min-width: 280px;
      margin-top: 10px !important;
    }

    .filter-dropdown-title {
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--glamoire-dark);
      margin-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 0.5rem;
    }

    /* Custom Checkbox */
    .custom-check-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      max-height: 300px;
      overflow-y: auto;
      padding-right: 10px;
    }

    .custom-check-group::-webkit-scrollbar {
      width: 4px;
    }

    .custom-check-group::-webkit-scrollbar-thumb {
      background: #CBD5E1;
      border-radius: 4px;
    }

    .modern-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      font-size: 0.85rem;
      color: var(--text-main);
      padding: 4px 0;
      transition: color 0.2s;
      margin: 0;
    }

    .modern-checkbox:hover {
      color: var(--glamoire-dark);
    }

    .modern-checkbox input {
      appearance: none;
      width: 18px;
      height: 18px;
      border: 2px solid #CBD5E1;
      border-radius: 4px;
      cursor: pointer;
      position: relative;
      transition: all 0.2s;
      margin: 0;
    }

    .modern-checkbox input:checked {
      background: var(--glamoire-dark);
      border-color: var(--glamoire-dark);
    }

    .modern-checkbox input:checked::after {
      content: '\f00c';
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      color: white;
      font-size: 10px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    /* Price Range */
    .price-range-wrapper {
      padding: 0.5rem 0;
    }

    .price-inputs {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 1rem;
    }

    .price-input-box {
      flex: 1;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      padding: 0.5rem;
      display: flex;
      align-items: center;
    }

    .price-input-box span {
      color: var(--text-muted);
      font-size: 0.8rem;
      margin-right: 5px;
    }

    .price-input-box input {
      border: none;
      outline: none;
      width: 100%;
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--glamoire-dark);
      background: transparent;
    }

    .filter-actions {
      display: flex;
      gap: 10px;
      margin-top: 1.5rem;
    }

    .btn-apply-filter {
      flex: 1;
      background: var(--glamoire-dark);
      color: #FFF;
      border: none;
      padding: 0.6rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.85rem;
      transition: background 0.3s;
    }

    .btn-apply-filter:hover {
      background: var(--glamoire-accent);
    }

    .btn-reset-filter {
      flex: 1;
      background: #FFF;
      color: var(--text-main);
      border: 1px solid var(--border-color);
      padding: 0.6rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.85rem;
      transition: all 0.3s;
    }

    .btn-reset-filter:hover {
      background: var(--glamoire-light);
      border-color: var(--text-main);
    }

    /* Category Accordion in Dropdown */
    .cat-dropdown-item {
      font-size: 0.9rem;
      color: var(--text-main);
      text-decoration: none;
      display: block;
      padding: 6px 0;
      font-weight: 600;
    }

    .cat-dropdown-item:hover {
      color: var(--glamoire-dark);
    }

    .subcat-list {
      padding-left: 1.2rem;
      margin-top: 4px;
      margin-bottom: 10px;
      border-left: 2px solid var(--glamoire-light);
    }

    .subcat-item {
      display: block;
      font-size: 0.85rem;
      color: var(--text-muted);
      text-decoration: none;
      padding: 4px 0;
      transition: color 0.2s;
    }

    .subcat-item:hover {
      color: var(--glamoire-dark);
      font-weight: 500;
    }

    /* --- Universal Product Card --- */
    .premium-product-card {
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

    .premium-product-card:hover {
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.06);
      transform: translateY(-5px);
      border-color: #E5E7EB;
    }

    .card-img-box {
      position: relative;
      padding-top: 100%;
      background: #FAFAFA;
      overflow: hidden;
      cursor: pointer;
    }

    .card-img-box img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.7s ease;
    }

    .premium-product-card:hover .card-img-box img {
      transform: scale(1.08);
    }

    .card-img-box.dark-overlay img {
      filter: grayscale(100%) opacity(0.7);
    }

    .card-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 0.7rem;
      font-weight: 700;
      z-index: 2;
      text-transform: uppercase;
    }

    .badge-discount {
      background: var(--danger-main);
      color: #FFF;
    }

    .btn-wishlist {
      position: absolute;
      top: 12px;
      right: 12px;
      width: 34px;
      height: 34px;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(4px);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #D1D5DB;
      z-index: 2;
      cursor: pointer;
      transition: var(--transition-smooth);
    }

    .btn-wishlist:hover,
    .btn-wishlist.active {
      color: var(--danger-main);
      transform: scale(1.1);
    }

    .card-action-area {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 1rem;
      background: linear-gradient(to top, rgba(255, 255, 255, 0.95), transparent);
      transform: translateY(100%);
      opacity: 0;
      transition: var(--transition-smooth);
      z-index: 3;
    }

    .premium-product-card:hover .card-action-area {
      transform: translateY(0);
      opacity: 1;
    }

    .btn-action-main {
      width: 100%;
      padding: 0.6rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.85rem;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.3s;
    }

    .btn-add {
      background: var(--glamoire-dark);
      color: #FFF;
    }

    .btn-add:hover {
      background: var(--glamoire-accent);
    }

    .btn-added {
      background: #10B981;
      color: #FFF;
    }

    .btn-notify {
      background: var(--danger-main);
      color: #FFF;
    }

    .card-info {
      padding: 1.25rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
      cursor: pointer;
    }

    .brand-name {
      font-size: 0.7rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 600;
      margin-bottom: 0.3rem;
    }

    .product-name {
      font-size: 0.95rem;
      font-weight: 500;
      color: var(--text-main);
      margin-bottom: 0.5rem;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-decoration: none;
    }

    .premium-product-card:hover .product-name {
      color: var(--glamoire-gold);
    }

    .rating-box {
      display: flex;
      align-items: center;
      gap: 4px;
      font-size: 0.8rem;
      color: var(--text-muted);
      margin-bottom: 0.75rem;
    }

    .rating-box i {
      color: #F59E0B;
    }

    .price-box {
      margin-top: auto;
      display: flex;
      flex-direction: column;
    }

    .price-current {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--glamoire-dark);
    }

    .price-discounted {
      color: var(--danger-main);
    }

    .price-strike {
      font-size: 0.85rem;
      color: #9CA3AF;
      text-decoration: line-through;
      margin-bottom: -2px;
    }

    /* Skeleton Loading */
    .skeleton-card {
      background: #FFF;
      border-radius: 12px;
      border: 1px solid #F3F4F6;
      overflow: hidden;
      height: 350px;
      display: flex;
      flex-direction: column;
    }

    .skeleton-img {
      width: 100%;
      height: 200px;
      background: #E2E8F0;
      animation: pulse 1.5s infinite ease-in-out;
    }

    .skeleton-body {
      padding: 1.25rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .skeleton-line {
      height: 12px;
      background: #E2E8F0;
      border-radius: 4px;
      animation: pulse 1.5s infinite ease-in-out;
    }

    .skeleton-line.w-50 {
      width: 50%;
    }

    .skeleton-line.w-80 {
      width: 80%;
    }

    .skeleton-line.h-title {
      height: 20px;
    }

    @keyframes pulse {
      0% {
        opacity: 1;
      }

      50% {
        opacity: 0.4;
      }

      100% {
        opacity: 1;
      }
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 4rem 1rem;
    }

    .empty-state img {
      max-width: 250px;
      opacity: 0.7;
      margin-bottom: 1.5rem;
    }

    .empty-state h3 {
      font-family: 'The Seasons', serif;
      color: var(--glamoire-dark);
      font-weight: 700;
    }

    .empty-state p {
      color: var(--text-muted);
    }

    /* Pagination */
    .pagination {
      justify-content: center;
      margin-top: 3rem;
    }

    .page-item.active .page-link {
      background-color: var(--glamoire-dark);
      border-color: var(--glamoire-dark);
    }

    .page-link {
      color: var(--glamoire-dark);
      padding: 0.75rem 1rem;
      border-radius: 8px;
      margin: 0 4px;
      border: 1px solid var(--border-color);
    }

    .page-link:hover {
      background-color: var(--glamoire-light);
      color: var(--glamoire-dark);
    }

    /* Mobile Filter Trigger */
    .mobile-filter-trigger {
      position: fixed;
      bottom: 80px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--glamoire-dark);
      color: white;
      padding: 10px 24px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.9rem;
      box-shadow: 0 4px 15px rgba(24, 48, 24, 0.3);
      z-index: 1000;
      display: none;
      align-items: center;
      gap: 8px;
      border: none;
    }

    @media (max-width: 991px) {
      .top-filter-bar {
        display: none;
      }

      .mobile-filter-trigger {
        display: flex;
      }
    }
  </style>

  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

    <div class="container-fluid">
      <div class="premium-breadcrumb">
        <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
        <span>/</span>
        <a href="/shop">Belanja</a>
        <span>/</span>
        <span class="active-page text-capitalize">Semua Katalog</span>
      </div>
    </div>

    <div class="container-fluid catalog-header">
      <h1 class="catalog-title">Eksplorasi Kecantikan</h1>
      <p class="catalog-subtitle">Menampilkan {{ $totalProduct ?? count($products) }} produk terbaik pilihan Glamoire.</p>
    </div>

    <div class="top-filter-bar">
      <div class="container-fluid">
        <form action="{{ route('shop.all') }}" method="GET" id="form-filter">
          <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">

          <div class="filter-group-container">
            <div class="filter-left">
              <span class="text-muted fw-bold me-2" style="font-size: 0.85rem;"><i class="fas fa-filter"></i>
                Filter:</span>

              <div class="dropdown">
                <button class="filter-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                  data-bs-auto-close="outside">
                  Kategori <i class="fas fa-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu filter-dropdown-menu custom-scroll" style="max-height: 400px; overflow-y:auto;">
                  <div class="filter-dropdown-title">Pilih Kategori</div>
                  <div class="custom-check-group" style="max-height: none;">
                    @foreach ($categories as $categoryItem)
                      <a href="/belanja-{{ $categoryItem->name }}"
                        class="cat-dropdown-item">{{ ucwords(strtolower($categoryItem->name)) }}</a>
                      @if(isset($subCategories[$categoryItem->id]))
                        <div class="subcat-list">
                          @foreach ($subCategories[$categoryItem->id] as $subcategoryItem)
                            <a href="/belanja-{{ $categoryItem->name }}-{{ $subcategoryItem->name }}" class="subcat-item">
                              {{ $subcategoryItem->name }}
                            </a>
                          @endforeach
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="dropdown">
                <button class="filter-pill {{ $brandName && $brandName != 'allbrand' ? 'active-filter' : '' }}"
                  type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                  Brand {{ $brandName && $brandName != 'allbrand' ? '(' . $brandName . ')' : '' }} <i
                    class="fas fa-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu filter-dropdown-menu">
                  <div class="filter-dropdown-title">Pilih Brand</div>
                  <div class="custom-check-group">
                    <label class="modern-checkbox">
                      <input type="radio" name="brand" value="allbrand" {{ $brandName === null || $brandName === 'allbrand' ? 'checked' : '' }} onchange="autoSubmitFilter()"> Semua Brand
                    </label>
                    @foreach ($brands as $brand)
                      <label class="modern-checkbox">
                        <input type="radio" name="brand" value="{{ $brand->name }}" {{ $brandName == $brand->name ? 'checked' : '' }} onchange="autoSubmitFilter()"> {{ $brand->name }}
                      </label>
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="dropdown">
                <button class="filter-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                  data-bs-auto-close="outside">
                  Harga <i class="fas fa-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu filter-dropdown-menu" style="min-width: 320px;">
                  <div class="filter-dropdown-title">Rentang Harga</div>
                  <div class="price-range-wrapper">
                    <div class="price-inputs">
                      <div class="price-input-box">
                        <span>Rp</span>
                        <input type="number" name="min_price" id="min-price-desk" value="{{ $minPrice ?? 0 }}" min="0">
                      </div>
                      <span class="price-separator">-</span>
                      <div class="price-input-box">
                        <span>Rp</span>
                        <input type="number" name="max_price" id="max-price-desk" value="{{ $maxPrice ?? 1000000 }}">
                      </div>
                    </div>
                    <div class="filter-actions">
                      <button type="button" class="btn-apply-filter" onclick="autoSubmitFilter()">Terapkan</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="dropdown">
                <button class="filter-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                  data-bs-auto-close="outside">
                  Rating <i class="fas fa-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu filter-dropdown-menu">
                  <div class="filter-dropdown-title">Pilih Rating</div>
                  <div class="custom-check-group">
                    <label class="modern-checkbox">
                      <input type="radio" name="rating" value="all" {{ request('rating') == 'all' || !request('rating') ? 'checked' : '' }} onchange="autoSubmitFilter()"> Semua Rating
                    </label>
                    <label class="modern-checkbox">
                      <input type="radio" name="rating" value="5" {{ request('rating') == '5' ? 'checked' : '' }}
                        onchange="autoSubmitFilter()"> <span class="text-warning"><i class="fas fa-star"></i><i
                          class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                          class="fas fa-star"></i></span>
                    </label>
                    <label class="modern-checkbox">
                      <input type="radio" name="rating" value="4" {{ request('rating') == '4' ? 'checked' : '' }}
                        onchange="autoSubmitFilter()"> <span class="text-warning"><i class="fas fa-star"></i><i
                          class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
                    </label>
                    <label class="modern-checkbox">
                      <input type="radio" name="rating" value="3" {{ request('rating') == '3' ? 'checked' : '' }}
                        onchange="autoSubmitFilter()"> <span class="text-warning"><i class="fas fa-star"></i><i
                          class="fas fa-star"></i><i class="fas fa-star"></i></span>
                    </label>
                  </div>
                </div>
              </div>

              @if($brandName != 'allbrand' || $minPrice != null || request('sort') != null || request('rating') != 'all')
                <button type="button" class="filter-pill text-danger border-0 bg-transparent shadow-none px-2"
                  onclick="resetFilters()" style="text-decoration: underline;">
                  Reset
                </button>
              @endif
            </div>

            <div class="filter-right">
              <span class="text-muted" style="font-size: 0.85rem;">Urutkan:</span>
              <div class="position-relative">
                <select class="sort-select" onchange="setSort(this.value)">
                  <option value="" {{ request('sort') == null ? 'selected' : '' }}>Rekomendasi</option>
                  <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                  <option value="high_price" {{ request('sort') == 'high_price' ? 'selected' : '' }}>Harga Tertinggi
                  </option>
                  <option value="low_price" {{ request('sort') == 'low_price' ? 'selected' : '' }}>Harga Terendah</option>
                </select>
                <i class="fas fa-chevron-down position-absolute text-dark"
                  style="right: 0; top: 50%; transform: translateY(-50%); font-size: 0.6rem; pointer-events: none;"></i>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row g-3 g-lg-4" id="skeletonLoader">
        @for ($i = 0; $i < 8; $i++)
          <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="skeleton-card">
              <div class="skeleton-img"></div>
              <div class="skeleton-body">
                <div class="skeleton-line w-50"></div>
                <div class="skeleton-line h-title w-100"></div>
                <div class="skeleton-line w-80 mt-auto"></div>
              </div>
            </div>
          </div>
        @endfor
      </div>

      <div id="productList" style="display: none;">
        @if (count($products) !== 0)
          <div class="row g-3 g-lg-4 mb-5">
            @foreach ($products as $product)
              @php
                $activePromo = $product->promos->first();
                $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;

                $inWishlist = false;
                $inCart = false;
                if (session('id_user')) {
                  $inWishlist = collect($wishlists ?? [])->contains('product_id', $product->id);
                  $inCart = collect($cartItems ?? [])->contains('product_id', $product->id);
                }
              @endphp

              <div class="col-6 col-md-4 col-lg-3">
                <div class="premium-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                  <div class="card-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                    @if ($discountPercent > 0)
                      <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                    @endif

                    <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}"
                      onclick="event.stopPropagation(); {{ session('id_user') ? ($inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')') : 'var myModal = new bootstrap.Modal(document.getElementById(\'loginUser1\')); myModal.show();' }}">
                      <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                    </div>

                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                    <div class="card-action-area">
                      @if (session('id_user'))
                        @if ($product->stock_quantity == 0)
                          <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})"
                            class="btn-action-main btn-notify">
                            <i class="fas fa-bell"></i> Beritahu
                          </button>
                        @else
                          @if($inCart)
                            <button onclick="event.stopPropagation(); window.location.href='/cart'"
                              class="btn-action-main btn-added">
                              <i class="fas fa-check"></i> Keranjang
                            </button>
                          @else
                            <button onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                              class="btn-action-main btn-add">
                              <i class="fas fa-shopping-bag"></i> Tambah
                            </button>
                          @endif
                        @endif
                      @else
                        <button onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#loginUser1"
                          class="btn-action-main btn-add">
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
                          <span class="price-current price-discounted">Rp
                            {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                        @else
                          <span class="price-current">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                        @endif
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="d-flex justify-content-center">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
          </div>

        @else
          <div class="empty-state">
            <img src="{{ asset('images/product-empty.png') }}" alt="Produk Tidak Ditemukan">
            <h3>Katalog Kosong</h3>
            <p>Maaf, kami tidak menemukan produk berdasarkan filter yang Anda terapkan.</p>
            <button class="btn-apply-filter mt-3 px-4 d-inline-block w-auto" onclick="resetFilters()">Reset Semua
              Filter</button>
          </div>
        @endif
      </div>
    </div>
  </div>

  <button class="mobile-filter-trigger" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilter">
    <i class="fas fa-sliders-h"></i> Filter & Urutkan
  </button>

  <div class="offcanvas offcanvas-bottom rounded-top-4" tabindex="-1" id="mobileFilter" style="height: 85vh;">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title fw-bold text-dark">Filter Produk</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body pb-5 mb-5 custom-scroll">
      <form action="{{ route('shop.all') }}" method="GET" id="form-filter-mobile">

        <div class="mb-4">
          <h6 class="fw-bold mb-3">Urutkan</h6>
          <select name="sort" class="form-select rounded-pill">
            <option value="" {{ request('sort') == null ? 'selected' : '' }}>Rekomendasi</option>
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
            <option value="high_price" {{ request('sort') == 'high_price' ? 'selected' : '' }}>Harga Tertinggi</option>
            <option value="low_price" {{ request('sort') == 'low_price' ? 'selected' : '' }}>Harga Terendah</option>
          </select>
        </div>

        <div class="mb-4">
          <h6 class="fw-bold mb-3">Kategori</h6>
          <div class="accordion accordion-flush border rounded-3" id="accordionCatMobile">
            @foreach ($categories as $index => $categoryItem)
              <div class="accordion-item bg-transparent">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed shadow-none fw-semibold text-dark p-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#cat-mob-{{ $categoryItem->id }}">
                    {{ $categoryItem->name }}
                  </button>
                </h2>
                <div id="cat-mob-{{ $categoryItem->id }}" class="accordion-collapse collapse"
                  data-bs-parent="#accordionCatMobile">
                  <div class="accordion-body bg-light p-2">
                    <a href="/belanja-{{ $categoryItem->name }}"
                      class="d-block p-2 text-decoration-none text-dark fw-bold border-bottom border-secondary-subtle">Semua
                      {{ $categoryItem->name }}</a>
                    @if(isset($subCategories[$categoryItem->id]))
                      @foreach ($subCategories[$categoryItem->id] as $subcategoryItem)
                        <a href="/belanja-{{ $categoryItem->name }}-{{ $subcategoryItem->name }}"
                          class="d-block p-2 text-decoration-none text-muted border-bottom border-secondary-subtle">
                          {{ $subcategoryItem->name }}
                        </a>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="mb-4">
          <h6 class="fw-bold mb-3">Brand</h6>
          <div class="custom-check-group" style="max-height: 200px;">
            <label class="modern-checkbox">
              <input type="radio" name="brand" value="allbrand" {{ $brandName === null || $brandName === 'allbrand' ? 'checked' : '' }}> Semua Brand
            </label>
            @foreach ($brands as $brand)
              <label class="modern-checkbox">
                <input type="radio" name="brand" value="{{ $brand->name }}" {{ $brandName == $brand->name ? 'checked' : '' }}>
                {{ $brand->name }}
              </label>
            @endforeach
          </div>
        </div>

        <div class="mb-4">
          <h6 class="fw-bold mb-3">Rentang Harga</h6>
          <div class="row g-2">
            <div class="col-6">
              <label class="form-label text-muted fs-7">Terendah</label>
              <input type="number" class="form-control" name="min_price" value="{{ $minPrice ?? 0 }}" placeholder="Min">
            </div>
            <div class="col-6">
              <label class="form-label text-muted fs-7">Tertinggi</label>
              <input type="number" class="form-control" name="max_price" value="{{ $maxPrice ?? 1000000 }}"
                placeholder="Max">
            </div>
          </div>
        </div>

        <div class="position-fixed bottom-0 start-0 w-100 p-3 bg-white border-top d-flex gap-2 z-3"
          style="box-shadow: 0 -4px 10px rgba(0,0,0,0.05);">
          <button type="button" class="btn-reset-filter" onclick="resetFilters()">Reset</button>
          <button type="submit" class="btn-apply-filter">Terapkan Filter</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Set Sort Value and Submit (Desktop)
    function setSort(sortValue) {
      document.getElementById('sort-input').value = sortValue;
      document.getElementById('form-filter').submit();
    }

    // Auto submit on radio button change (Desktop Filter)
    function autoSubmitFilter() {
      document.getElementById('form-filter').submit();
    }

    // Reset Filters to basic catalog
    function resetFilters() {
      window.location.href = "{{ route('shop.all') }}";
    }

    // Skeleton Loading Simulation
    document.addEventListener("DOMContentLoaded", function () {
      const skeletonLoader = document.getElementById('skeletonLoader');
      const productList = document.getElementById('productList');

      setTimeout(function () {
        skeletonLoader.style.display = 'none';
        productList.style.display = 'block';
      }, 800);
    });
  </script>

@endsection
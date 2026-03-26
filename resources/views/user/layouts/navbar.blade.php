{{-- <style>
    /* ==========================================
       WORLD CLASS NAVBAR STYLING
       ========================================== */
    :root {
        --nav-bg: #183018; /* Glamoire Dark Green */
        --nav-text: #FFFFFF;
        --nav-hover: #D4AF37; /* Glamoire Gold */
        --dropdown-bg: #FFFFFF;
        --dropdown-text: #1F2937;
        --promo-bg: #F4F1EA; /* Soft Sand/Beige */
        --transition-speed: 0.3s;
    }

    /* ====== 1. TOP PROMO BANNER (Fast Animated Gradient) ====== */
    .top-promo-banner {
        /* Gradient yang akan bertukar warna dengan kontras tinggi */
        background: linear-gradient(
            270deg,
            #F4F1EA, /* Krem Terang */
            #D4AF37, /* Emas Gelap (Hover Gold) */
            #F4F1EA  /* Kembali ke Krem Terang */
        );
        background-size: 200% 200%; /* Dibuat 200% agar perpindahannya lebih cepat terlihat */
        /* Animasi lebih cepat (4 detik) */
        animation: promoGradientFlow 4s ease infinite alternate;

        color: var(--nav-bg);
        padding: 8px 0;
        text-align: center;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        position: relative;
        z-index: 1020;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        box-shadow: inset 0 -1px 3px rgba(0,0,0,0.05);
    }

    /* Keyframes untuk Background Promo */
    @keyframes promoGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    /* Teks Promo yang Warnanya Beralun Mengikuti Background */
    .top-promo-banner p {
        margin: 0;
        text-transform: uppercase;
        font-weight: 800;
        /* Animasi warna teks agar kontras dengan background yang berubah */
        animation: textPromoFlow 4s ease infinite alternate;
    }

    @keyframes textPromoFlow {
        0% { color: #183018; text-shadow: 0 1px 1px rgba(255,255,255,0.8); } /* Teks Gelap saat Background Terang */
        100% { color: #FFFFFF; text-shadow: 0 1px 2px rgba(0,0,0,0.8); }   /* Teks Terang saat Background Gelap */
    }

    /* Hilangkan Highlight statis karena teks utama sudah dianimasikan */
    .top-promo-banner .highlight {
        font-weight: 900;
    }

    .top-promo-banner a {
        color: inherit; /* Mengikuti warna teks paragraf yang teranimasi */
        text-decoration: none;
        border-bottom: 1px solid currentColor;
        padding-bottom: 1px;
        transition: opacity var(--transition-speed);
        font-weight: 700;
    }

    .top-promo-banner a:hover {
        opacity: 0.7;
    }


    /* ====== 2. MAIN NAVBAR (Fast Animated Dark Gradient) ====== */
    .premium-navbar {
        /* Gradient hijau gelap dengan kontras yang lebih terlihat */
        background: linear-gradient(
            270deg,
            #183018, /* Glamoire Dark Green */
            #3A5A3A, /* Hijau Medium */
            #183018  /* Kembali ke Hijau Gelap */
        );
        background-size: 200% 200%;
        /* Animasi lebih cepat (5 detik) */
        animation: navGradientFlow 5s ease infinite alternate;

        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: padding var(--transition-speed);
    }

    /* Keyframes untuk Background Navbar */
    @keyframes navGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    /* Animasi Logo agar sedikit berdenyut mengikuti alunan (Opsional, agar menyatu) */
    .navbar-logo img {
        height: 35px;
        width: auto;
        transition: transform var(--transition-speed);
    }

    .navbar-logo:hover img {
        transform: scale(1.05);
    }


    /* Desktop Navigation Links */
    .nav-links-container {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .nav-link-premium {
        color: var(--nav-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: relative;
        padding: 0.5rem 0;
        transition: color var(--transition-speed);
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    /* Underline Hover Effect */
    .nav-link-premium::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: var(--nav-hover);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        transform: translateX(-50%);
    }

    .nav-link-premium:hover {
        color: var(--nav-hover);
    }

    .nav-link-premium:hover::after,
    .nav-item-dropdown:hover .nav-link-premium::after {
        width: 100%;
    }

    /* ====== 3. MEGA MENU DROPDOWN ====== */
    .nav-item-dropdown {
        position: relative;
    }

    .mega-menu {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(15px);
        background-color: var(--dropdown-bg);
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 1001;
        min-width: 600px;
        padding: 0;
        overflow: hidden;
        border: 1px solid #F3F4F6;
    }

    /* Munculkan mega menu saat hover di Desktop */
    @media (min-width: 992px) {
        .nav-item-dropdown:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* Mega Menu Layout (Belanja) */
    .mega-menu-content {
        display: flex;
        max-height: 60vh;
    }

    .mega-menu-sidebar {
        background-color: #F9FAFB;
        width: 250px;
        border-right: 1px solid #E5E7EB;
        padding: 1.5rem 0;
        overflow-y: auto;
    }

    .mega-menu-tab {
        display: block;
        padding: 0.75rem 1.5rem;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }

    .mega-menu-tab:hover, .mega-menu-tab.active {
        background-color: #FFFFFF;
        color: var(--nav-bg);
        border-left-color: var(--nav-bg);
    }

    .mega-menu-body {
        flex-grow: 1;
        padding: 1.5rem;
        overflow-y: auto;
        background: #FFFFFF;
    }

    .mega-menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .mega-menu-item {
        color: #4B5563;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
        display: flex;
        align-items: center;
    }

    .mega-menu-item::before {
        content: '•';
        color: #D1D5DB;
        margin-right: 8px;
        font-size: 1.2rem;
        line-height: 1;
    }

    .mega-menu-item:hover {
        color: var(--nav-bg);
    }

    /* Simple Dropdown Layout (Brand) */
    .simple-dropdown {
        min-width: 250px;
        padding: 1.5rem;
    }

    .brand-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .brand-item {
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        padding: 8px 10px;
        text-align: center;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    .brand-item:hover {
        background-color: var(--nav-bg);
        color: #FFFFFF;
        border-color: var(--nav-bg);
    }

    /* ====== 4. SEARCH BAR (Premium Input) ====== */
    .premium-search-container {
        flex-grow: 1;
        max-width: 400px;
        margin: 0 2rem;
        position: relative;
    }

    .premium-search-input {
        width: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        border-radius: 50px;
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        font-size: 0.85rem;
        transition: all var(--transition-speed);
    }

    .premium-search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .premium-search-input:focus {
        background-color: #FFFFFF;
        color: var(--dropdown-text);
        outline: none;
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    }

    .premium-search-input:focus::placeholder {
        color: #9CA3AF;
    }

    .search-icon-nav {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
        transition: color var(--transition-speed);
        pointer-events: none;
    }

    .premium-search-input:focus + .search-icon-nav {
        color: var(--nav-bg);
    }

    /* ====== 5. ACTION ICONS (Cart & User) ====== */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .action-icon {
        color: var(--nav-text);
        font-size: 1.2rem;
        position: relative;
        text-decoration: none;
        transition: color var(--transition-speed);
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        display: flex;
    }

    .action-icon:hover {
        color: var(--nav-hover);
    }

    .cart-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: var(--danger-main);
        color: white;
        font-size: 0.65rem;
        font-weight: bold;
        height: 18px;
        min-width: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        border: 2px solid var(--nav-bg);
    }

    /* ====== 6. MOBILE RESPONSIVENESS ====== */
    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 991px) {
        .premium-search-container {
            display: none;
        }

        .desktop-nav-links {
            display: none;
        }

        .mobile-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(270deg, #FFFFFF, #F9FAFB, #F3F4F6, #FFFFFF);
            background-size: 400% 400%;
            animation: gradientLightFlow 10s ease infinite alternate;

            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            z-index: 1020;
            justify-content: space-around;
            padding: 0.5rem 0;
            border-top: 1px solid #E5E7EB;
            padding-bottom: env(safe-area-inset-bottom, 0.5rem);
        }

        @keyframes gradientLightFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #6B7280;
            text-decoration: none;
            font-size: 0.65rem;
            gap: 4px;
            transition: color 0.3s;
        }

        .mobile-nav-item i {
            font-size: 1.2rem;
        }

        .mobile-nav-item.active, .mobile-nav-item:hover {
            color: var(--nav-bg);
        }

        /* Mobile Search Bar */
        .mobile-search-wrapper {
            background: white;
            padding: 10px 15px;
            position: sticky;
            top: 60px;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .mobile-search-input {
            width: 100%;
            background: #F3F4F6;
            border: none;
            border-radius: 8px;
            padding: 10px 15px 10px 35px;
            font-size: 0.9rem;
        }

        .mobile-search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }
    }
</style>

<div class="top-promo-banner">
    <p>
        <span class="highlight">UP TO 70% OFF</span> + VOUCHERS UP TO 550K. FREE SHIPPING NATIONWIDE!
    </p>
    <a href="/promotion">Shop Now</a>
</div>

<nav class="premium-navbar md:px-20 lg:px-24 xl:px-24 2xl:px-48">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="/" class="navbar-logo">
            <img src="{{ asset('images/new-logo.png') }}" alt="Glamoire">
        </a>

        <ul class="nav-links-container desktop-nav-links">

            <li class="nav-item-dropdown">
                <a href="{{ route('shop.all') }}" class="nav-link-premium">
                    Belanja <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </a>

                <div class="mega-menu">
                    <div class="mega-menu-content">
                        <div class="mega-menu-sidebar custom-scroll">
                            @foreach ($categories as $index => $category)
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="mega-menu-tab {{ $index == 0 ? 'active' : '' }}"
                                   data-target="cat-{{ $category->id }}"
                                   onmouseover="switchMegaMenu(this, 'cat-{{ $category->id }}')">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="mega-menu-body custom-scroll">
                            @foreach ($categories as $index => $category)
                                <div id="cat-{{ $category->id }}" class="mega-menu-pane" style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--nav-bg);">{{ $category->name }}</h5>

                                    @php
                                        $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                                    @endphp

                                    @if ($subCategoriesInCategory->isEmpty())
                                        <p class="text-muted text-sm">Lihat semua produk di kategori ini.</p>
                                    @else
                                        <div class="mega-menu-grid">
                                            @foreach ($subCategoriesInCategory as $subCategory)
                                                <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="mega-menu-item">
                                                    {{ $subCategory->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mt-4 pt-3 border-top">
                                        <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="text-decoration-underline text-dark fw-semibold" style="font-size:0.85rem;">Lihat Semua {{ $category->name }} <i class="fas fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item-dropdown">
                <button class="nav-link-premium">
                    Brand <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </button>
                <div class="mega-menu simple-dropdown" style="left: 0; transform: translateX(-20%) translateY(15px);">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Jelajahi Merek</h6>
                    <div class="brand-grid">
                        @foreach ($brands->take(10) as $brand)
                            <a href="/{{ $brand->name }}_brand" class="brand-item">{{ $brand->name }}</a>
                        @endforeach
                    </div>
                    <div class="text-center mt-3 pt-2">
                        <a href="/brands" class="text-decoration-underline text-dark" style="font-size: 0.85rem;">Lihat Semua Merek</a>
                    </div>
                </div>
            </li>

            <li><a href="/promotion" class="nav-link-premium">Promo</a></li>
            <li><a href="/newsletter" class="nav-link-premium">Artikel</a></li>
        </ul>

        <div class="premium-search-container">
            <form method="GET" action="{{ route('search.product') }}">
                <input type="text" name="product_search" class="premium-search-input" placeholder="Cari produk kecantikan...">
                <i class="fas fa-search search-icon-nav"></i>
            </form>
        </div>

        <div class="nav-actions">
            <a href="/cart" class="action-icon" title="Keranjang Belanja">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" id="total_cart_items">0</span>
            </a>

            <div class="nav-item-dropdown">
                @if (session('id_user'))
                    <a href="{{ route('account', ['user' => session('id_user')]) }}" class="action-icon" title="Akun Saya">
                        <i class="far fa-user"></i>
                    </a>
                @else
                    <button class="action-icon" title="Akun Saya" data-bs-toggle="modal" data-bs-target="#loginUser1">
                        <i class="far fa-user"></i>
                    </button>
                @endif

                <div class="mega-menu" style="min-width: 200px; left: auto; right: 0; transform: translateX(0) translateY(15px); padding: 0.5rem 0;">
                    @if (session('id_user'))
                        <div class="px-4 py-3 border-bottom mb-2 bg-light">
                            <p class="mb-0 fs-7 text-muted">Selamat datang,</p>
                            <p class="mb-0 fw-bold text-dark">{{ session('username') ?? 'Pelanggan' }}</p>
                        </div>
                        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="dropdown-item py-2 px-4 text-dark text-sm"><i class="far fa-id-card me-2"></i> Profil Saya</a>
                        <a href="/orders" class="dropdown-item py-2 px-4 text-dark text-sm"><i class="fas fa-box me-2"></i> Pesanan Saya</a>
                        <div class="dropdown-divider my-2"></div>
                        <a href="#" id="logout-link-desktop" class="dropdown-item py-2 px-4 text-danger text-sm"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
                    @else
                        <div class="p-3 text-center">
                            <button class="btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginUser1">Masuk</button>
                            <p class="text-muted fs-7 mb-0">Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerUser1" class="text-dark fw-bold">Daftar</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</nav>

<div class="mobile-search-wrapper d-lg-none">
    <form method="GET" action="{{ route('search.product') }}" class="position-relative">
        <i class="fas fa-search mobile-search-icon"></i>
        <input type="text" name="product_search" class="mobile-search-input" placeholder="Cari skincare, makeup...">
    </form>
</div>

<div class="mobile-bottom-nav d-lg-none">
    <a href="/" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
    </a>

    <a href="#" class="mobile-nav-item" data-bs-toggle="offcanvas" data-bs-target="#mobileCategoryMenu">
        <i class="fas fa-th-large"></i>
        <span>Kategori</span>
    </a>

    <a href="/promotion" class="mobile-nav-item {{ Request::is('promotion') ? 'active' : '' }}">
        <i class="fas fa-tag"></i>
        <span>Promo</span>
    </a>

    <a href="/cart" class="mobile-nav-item position-relative {{ Request::is('cart') ? 'active' : '' }}">
        <i class="fas fa-shopping-bag"></i>
        <span>Keranjang</span>
        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem; padding: 2px 4px;">0</span>
    </a>

    @if (session('id_user'))
        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="mobile-nav-item">
            <i class="far fa-user"></i>
            <span>Profil</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item" data-bs-toggle="modal" data-bs-target="#loginUser1">
            <i class="far fa-user"></i>
            <span>Masuk</span>
        </a>
    @endif
</div>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileCategoryMenu" aria-labelledby="mobileCategoryMenuLabel">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title fw-bold" id="mobileCategoryMenuLabel">Belanja</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="accordion accordion-flush" id="accordionCategories">
            @foreach ($categories as $index => $category)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCat{{ $category->id }}">
                            {{ strtoupper($category->name) }}
                        </button>
                    </h2>
                    <div id="collapseCat{{ $category->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionCategories">
                        <div class="accordion-body bg-light py-2">
                            @php
                                $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                            @endphp

                            @if ($subCategoriesInCategory->isEmpty())
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="d-block py-2 text-decoration-none text-muted">Lihat semua {{ $category->name }}</a>
                            @else
                                @foreach ($subCategoriesInCategory as $subCategory)
                                    <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="d-block py-2 text-decoration-none text-dark border-bottom border-light">
                                        {{ $subCategory->name }}
                                    </a>
                                @endforeach
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="d-block py-2 mt-2 text-decoration-none fw-bold" style="color: var(--nav-bg);">Lihat Semua <i class="fas fa-arrow-right ms-1 text-sm"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="p-3 bg-light mt-3">
                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.8rem;">Top Brands</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($brands->take(6) as $brand)
                        <a href="/{{ $brand->name }}_brand" class="badge bg-white text-dark border p-2 text-decoration-none">{{ $brand->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JS for Mega Menu Hover Logic
    function switchMegaMenu(element, targetId) {
        // Remove active from all tabs
        document.querySelectorAll('.mega-menu-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        // Add active to hovered tab
        element.classList.add('active');

        // Hide all panes
        document.querySelectorAll('.mega-menu-pane').forEach(pane => {
            pane.style.display = 'none';
        });

        // Show target pane
        document.getElementById(targetId).style.display = 'block';
    }

    // Logout Handler for Desktop
    $(document).ready(function() {
        $('#logout-link-desktop').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Keluar?',
                text: "Anda yakin ingin keluar dari akun?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('logout.user') }}",
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "/";
                            }
                        }
                    });
                }
            })
        });
    });
</script> --}}


{{-- NEW --}}
{{-- <style>
    /* ==========================================
       WORLD CLASS NAVBAR STYLING
       ========================================== */
    :root {
        --nav-bg: #183018; /* Glamoire Dark Green */
        --nav-text: #FFFFFF;
        --nav-hover: #D4AF37; /* Glamoire Gold */
        --dropdown-bg: #FFFFFF;
        --dropdown-text: #1F2937;
        --promo-bg: #F4F1EA; /* Soft Sand/Beige */
        --transition-speed: 0.3s;
    }

    /* ====== 1. TOP PROMO BANNER (Fast Animated Gradient) ====== */
    .top-promo-banner {
        /* Gradient yang akan bertukar warna dengan kontras tinggi */
        background: linear-gradient(
            270deg,
            #F4F1EA, /* Krem Terang */
            #D4AF37, /* Emas Gelap (Hover Gold) */
            #F4F1EA  /* Kembali ke Krem Terang */
        );
        background-size: 200% 200%; /* Dibuat 200% agar perpindahannya lebih cepat terlihat */
        /* Animasi lebih cepat (4 detik) */
        animation: promoGradientFlow 4s ease infinite alternate;

        color: var(--nav-bg);
        padding: 8px 0;
        text-align: center;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        position: relative;
        z-index: 1020;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        box-shadow: inset 0 -1px 3px rgba(0,0,0,0.05);
    }

    /* Keyframes untuk Background Promo */
    @keyframes promoGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    /* Teks Promo yang Warnanya Beralun Mengikuti Background */
    .top-promo-banner p {
        margin: 0;
        text-transform: uppercase;
        font-weight: 800;
        /* Animasi warna teks agar kontras dengan background yang berubah */
        animation: textPromoFlow 4s ease infinite alternate;
    }

    @keyframes textPromoFlow {
        0% { color: #183018; text-shadow: 0 1px 1px rgba(255,255,255,0.8); } /* Teks Gelap saat Background Terang */
        100% { color: #FFFFFF; text-shadow: 0 1px 2px rgba(0,0,0,0.8); }   /* Teks Terang saat Background Gelap */
    }

    /* Hilangkan Highlight statis karena teks utama sudah dianimasikan */
    .top-promo-banner .highlight {
        font-weight: 900;
    }

    .top-promo-banner a {
        color: inherit; /* Mengikuti warna teks paragraf yang teranimasi */
        text-decoration: none;
        border-bottom: 1px solid currentColor;
        padding-bottom: 1px;
        transition: opacity var(--transition-speed);
        font-weight: 700;
    }

    .top-promo-banner a:hover {
        opacity: 0.7;
    }


    /* ====== 2. MAIN NAVBAR (Fast Animated Dark Gradient) ====== */
    .premium-navbar {
        /* Gradient hijau gelap dengan kontras yang lebih terlihat */
        background: linear-gradient(
            270deg,
            #183018, /* Glamoire Dark Green */
            #3A5A3A, /* Hijau Medium */
            #183018  /* Kembali ke Hijau Gelap */
        );
        background-size: 200% 200%;
        /* Animasi lebih cepat (5 detik) */
        animation: navGradientFlow 5s ease infinite alternate;

        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: padding var(--transition-speed);
    }

    /* Keyframes untuk Background Navbar */
    @keyframes navGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    /* Animasi Logo agar sedikit berdenyut mengikuti alunan (Opsional, agar menyatu) */
    .navbar-logo img {
        height: 35px;
        width: auto;
        transition: transform var(--transition-speed);
    }

    .navbar-logo:hover img {
        transform: scale(1.05);
    }


    /* Desktop Navigation Links */
    .nav-links-container {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .nav-link-premium {
        color: var(--nav-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: relative;
        padding: 0.5rem 0;
        transition: color var(--transition-speed);
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    /* Underline Hover Effect */
    .nav-link-premium::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: var(--nav-hover);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        transform: translateX(-50%);
    }

    .nav-link-premium:hover {
        color: var(--nav-hover);
    }

    .nav-link-premium:hover::after,
    .nav-item-dropdown:hover .nav-link-premium::after {
        width: 100%;
    }

    /* ====== 3. MEGA MENU DROPDOWN ====== */
    .nav-item-dropdown {
        position: relative;
    }

    .mega-menu {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(15px);
        background-color: var(--dropdown-bg);
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 1001;
        min-width: 600px;
        padding: 0;
        overflow: hidden;
        border: 1px solid #F3F4F6;
    }

    /* Munculkan mega menu saat hover di Desktop */
    @media (min-width: 992px) {
        .nav-item-dropdown:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* Mega Menu Layout (Belanja) */
    .mega-menu-content {
        display: flex;
        max-height: 60vh;
    }

    .mega-menu-sidebar {
        background-color: #F9FAFB;
        width: 250px;
        border-right: 1px solid #E5E7EB;
        padding: 1.5rem 0;
        overflow-y: auto;
    }

    .mega-menu-tab {
        display: block;
        padding: 0.75rem 1.5rem;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }

    .mega-menu-tab:hover, .mega-menu-tab.active {
        background-color: #FFFFFF;
        color: var(--nav-bg);
        border-left-color: var(--nav-bg);
    }

    .mega-menu-body {
        flex-grow: 1;
        padding: 1.5rem;
        overflow-y: auto;
        background: #FFFFFF;
    }

    .mega-menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .mega-menu-item {
        color: #4B5563;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
        display: flex;
        align-items: center;
    }

    .mega-menu-item::before {
        content: '•';
        color: #D1D5DB;
        margin-right: 8px;
        font-size: 1.2rem;
        line-height: 1;
    }

    .mega-menu-item:hover {
        color: var(--nav-bg);
    }

    /* Simple Dropdown Layout (Brand) */
    .simple-dropdown {
        min-width: 250px;
        padding: 1.5rem;
    }

    .brand-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .brand-item {
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        padding: 8px 10px;
        text-align: center;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    .brand-item:hover {
        background-color: var(--nav-bg);
        color: #FFFFFF;
        border-color: var(--nav-bg);
    }

    /* ====== 4. SEARCH BAR (Premium Input) ====== */
    .premium-search-container {
        flex-grow: 1;
        max-width: 400px;
        margin: 0 2rem;
        position: relative;
    }

    .premium-search-input {
        width: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        border-radius: 50px;
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        font-size: 0.85rem;
        transition: all var(--transition-speed);
    }

    .premium-search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .premium-search-input:focus {
        background-color: #FFFFFF;
        color: var(--dropdown-text);
        outline: none;
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    }

    .premium-search-input:focus::placeholder {
        color: #9CA3AF;
    }

    .search-icon-nav {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
        transition: color var(--transition-speed);
        pointer-events: none;
    }

    .premium-search-input:focus + .search-icon-nav {
        color: var(--nav-bg);
    }

    /* ====== 5. ACTION ICONS (Cart & User) ====== */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .action-icon {
        color: var(--nav-text);
        font-size: 1.2rem;
        position: relative;
        text-decoration: none;
        transition: color var(--transition-speed);
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        display: flex;
    }

    .action-icon:hover {
        color: var(--nav-hover);
    }

    .cart-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: var(--danger-main);
        color: white;
        font-size: 0.65rem;
        font-weight: bold;
        height: 18px;
        min-width: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        border: 2px solid var(--nav-bg);
    }

    /* ====== 6. MOBILE RESPONSIVENESS ====== */
    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 991px) {
        .premium-search-container {
            display: none;
        }

        .desktop-nav-links {
            display: none;
        }

        .mobile-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(270deg, #FFFFFF, #F9FAFB, #F3F4F6, #FFFFFF);
            background-size: 400% 400%;
            animation: gradientLightFlow 10s ease infinite alternate;

            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            z-index: 1020;
            justify-content: space-around;
            padding: 0.5rem 0;
            border-top: 1px solid #E5E7EB;
            padding-bottom: env(safe-area-inset-bottom, 0.5rem);
        }

        @keyframes gradientLightFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #6B7280;
            text-decoration: none;
            font-size: 0.65rem;
            gap: 4px;
            transition: color 0.3s;
        }

        .mobile-nav-item i {
            font-size: 1.2rem;
        }

        .mobile-nav-item.active, .mobile-nav-item:hover {
            color: var(--nav-bg);
        }

        /* Mobile Search Bar */
        .mobile-search-wrapper {
            background: white;
            padding: 10px 15px;
            position: sticky;
            top: 60px;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .mobile-search-input {
            width: 100%;
            background: #F3F4F6;
            border: none;
            border-radius: 8px;
            padding: 10px 15px 10px 35px;
            font-size: 0.9rem;
        }

        .mobile-search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }
    }
</style>

<div class="top-promo-banner">
    <p>
        <span class="highlight">UP TO 70% OFF</span> + VOUCHERS UP TO 550K. FREE SHIPPING NATIONWIDE!
    </p>
    @if(session('id_user'))
        <a href="/promotion">Shop Now</a>
    @else
        <a href="#" class="require-login">Shop Now</a>
    @endif
</div>

<nav class="premium-navbar md:px-20 lg:px-24 xl:px-24 2xl:px-48">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="/" class="navbar-logo">
            <img src="{{ asset('images/new-logo.png') }}" alt="Glamoire">
        </a>

        <ul class="nav-links-container desktop-nav-links">

            <li class="nav-item-dropdown">
                <a href="{{ route('shop.all') }}" class="nav-link-premium">
                    Belanja <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </a>

                <div class="mega-menu">
                    <div class="mega-menu-content">
                        <div class="mega-menu-sidebar custom-scroll">
                            @foreach ($categories as $index => $category)
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="mega-menu-tab {{ $index == 0 ? 'active' : '' }}"
                                   data-target="cat-{{ $category->id }}"
                                   onmouseover="switchMegaMenu(this, 'cat-{{ $category->id }}')">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="mega-menu-body custom-scroll">
                            @foreach ($categories as $index => $category)
                                <div id="cat-{{ $category->id }}" class="mega-menu-pane" style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--nav-bg);">{{ $category->name }}</h5>

                                    @php
                                        $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                                    @endphp

                                    @if ($subCategoriesInCategory->isEmpty())
                                        <p class="text-muted text-sm">Lihat semua produk di kategori ini.</p>
                                    @else
                                        <div class="mega-menu-grid">
                                            @foreach ($subCategoriesInCategory as $subCategory)
                                                <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="mega-menu-item">
                                                    {{ $subCategory->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mt-4 pt-3 border-top">
                                        <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="text-decoration-underline text-dark fw-semibold" style="font-size:0.85rem;">Lihat Semua {{ $category->name }} <i class="fas fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item-dropdown">
                <button class="nav-link-premium">
                    Brand <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </button>
                <div class="mega-menu simple-dropdown" style="left: 0; transform: translateX(-20%) translateY(15px);">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Jelajahi Merek</h6>
                    <div class="brand-grid">
                        @foreach ($brands->take(10) as $brand)
                            <a href="/{{ $brand->name }}_brand" class="brand-item">{{ $brand->name }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            @if(session('id_user'))
                <li><a href="/promotion" class="nav-link-premium">Promo</a></li>
            @else
                <li><a href="#" class="nav-link-premium require-login">Promo</a></li>
            @endif

            <li><a href="/newsletter" class="nav-link-premium">Artikel</a></li>
        </ul>

        <div class="premium-search-container">
            <form method="GET" action="{{ route('search.product') }}">
                <input type="text" name="product_search" class="premium-search-input" placeholder="Cari produk kecantikan...">
                <i class="fas fa-search search-icon-nav"></i>
            </form>
        </div>

        <div class="nav-actions">
            <a href="/cart" class="action-icon" title="Keranjang Belanja">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" id="total_cart_items">0</span>
            </a>

            <div class="nav-item-dropdown">
                @if (session('id_user'))
                    <a href="{{ route('account', ['user' => session('id_user')]) }}" class="action-icon" title="Akun Saya">
                        <i class="far fa-user"></i>
                    </a>
                @else
                    <button class="action-icon" title="Akun Saya" data-bs-toggle="modal" data-bs-target="#loginUser1">
                        <i class="far fa-user"></i>
                    </button>
                @endif

                <div class="mega-menu" style="min-width: 200px; left: auto; right: 0; transform: translateX(0) translateY(15px); padding: 0.5rem 0;">
                    @if (session('id_user'))
                        <div class="px-4 py-3 border-bottom mb-2 bg-light">
                            <p class="mb-0 fs-7 text-muted">Selamat datang,</p>
                            <p class="mb-0 fw-bold text-dark">{{ session('username') ?? 'Pelanggan' }}</p>
                        </div>
                        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="dropdown-item py-2 px-4 text-dark text-sm"><i class="far fa-id-card me-2"></i> Profil Saya</a>
                        <div class="dropdown-divider my-2"></div>
                        <a href="#" id="logout-link-desktop" class="dropdown-item py-2 px-4 text-danger text-sm"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
                    @else
                        <div class="p-3 text-center">
                            <button class="btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginUser1">Masuk</button>
                            <p class="text-muted fs-7 mb-0">Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerUser1" class="text-dark fw-bold">Daftar</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</nav>

<div class="mobile-search-wrapper d-lg-none">
    <form method="GET" action="{{ route('search.product') }}" class="position-relative">
        <i class="fas fa-search mobile-search-icon"></i>
        <input type="text" name="product_search" class="mobile-search-input" placeholder="Cari skincare, makeup...">
    </form>
</div>

<div class="mobile-bottom-nav d-lg-none">
    <a href="/" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
    </a>

    <a href="#" class="mobile-nav-item" data-bs-toggle="offcanvas" data-bs-target="#mobileCategoryMenu">
        <i class="fas fa-th-large"></i>
        <span>Kategori</span>
    </a>

    @if(session('id_user'))
        <a href="/promotion" class="mobile-nav-item {{ Request::is('promotion') ? 'active' : '' }}">
            <i class="fas fa-tag"></i>
            <span>Promo</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item require-login">
            <i class="fas fa-tag"></i>
            <span>Promo</span>
        </a>
    @endif

    <a href="/cart" class="mobile-nav-item position-relative {{ Request::is('cart') ? 'active' : '' }}">
        <i class="fas fa-shopping-bag"></i>
        <span>Keranjang</span>
        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem; padding: 2px 4px;">0</span>
    </a>

    @if (session('id_user'))
        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="mobile-nav-item">
            <i class="far fa-user"></i>
            <span>Profil</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item" data-bs-toggle="modal" data-bs-target="#loginUser1">
            <i class="far fa-user"></i>
            <span>Masuk</span>
        </a>
    @endif
</div>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileCategoryMenu" aria-labelledby="mobileCategoryMenuLabel">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title fw-bold" id="mobileCategoryMenuLabel">Belanja</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="accordion accordion-flush" id="accordionCategories">
            @foreach ($categories as $index => $category)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCat{{ $category->id }}">
                            {{ strtoupper($category->name) }}
                        </button>
                    </h2>
                    <div id="collapseCat{{ $category->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionCategories">
                        <div class="accordion-body bg-light py-2">
                            @php
                                $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                            @endphp

                            @if ($subCategoriesInCategory->isEmpty())
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="d-block py-2 text-decoration-none text-muted">Lihat semua {{ $category->name }}</a>
                            @else
                                @foreach ($subCategoriesInCategory as $subCategory)
                                    <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="d-block py-2 text-decoration-none text-dark border-bottom border-light">
                                        {{ $subCategory->name }}
                                    </a>
                                @endforeach
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="d-block py-2 mt-2 text-decoration-none fw-bold" style="color: var(--nav-bg);">Lihat Semua <i class="fas fa-arrow-right ms-1 text-sm"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="p-3 bg-light mt-3">
                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.8rem;">Top Brands</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($brands->take(6) as $brand)
                        <a href="/{{ $brand->name }}_brand" class="badge bg-white text-dark border p-2 text-decoration-none">{{ $brand->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JS for Mega Menu Hover Logic
    function switchMegaMenu(element, targetId) {
        // Remove active from all tabs
        document.querySelectorAll('.mega-menu-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        // Add active to hovered tab
        element.classList.add('active');

        // Hide all panes
        document.querySelectorAll('.mega-menu-pane').forEach(pane => {
            pane.style.display = 'none';
        });

        // Show target pane
        document.getElementById(targetId).style.display = 'block';
    }

    $(document).ready(function() {
        // Notifikasi SweetAlert jika user belum login dan klik promo
        $('.require-login').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Akses Terbatas',
                text: "Silakan masuk/daftar akun terlebih dahulu untuk melihat promo eksklusif kami.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Masuk Sekarang',
                cancelButtonText: 'Nanti Saja'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Membuka modal login (Sesuai dengan id modal loginUser1 di website)
                    var loginModal = new bootstrap.Modal(document.getElementById('loginUser1'));
                    loginModal.show();
                }
            });
        });

        // Logout Handler for Desktop
        $('#logout-link-desktop').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Keluar?',
                text: "Anda yakin ingin keluar dari akun?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('logout.user') }}",
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "/";
                            }
                        }
                    });
                }
            })
        });
    });
</script> --}}

{{-- <style>
    /* ==========================================
       WORLD CLASS NAVBAR STYLING
       ========================================== */
    :root {
        --nav-bg: #183018; /* Glamoire Dark Green */
        --nav-text: #FFFFFF;
        --nav-hover: #D4AF37; /* Glamoire Gold */
        --dropdown-bg: #FFFFFF;
        --dropdown-text: #1F2937;
        --promo-bg: #F4F1EA; /* Soft Sand/Beige */
        --transition-speed: 0.3s;
    }

    /* ====== 1. TOP PROMO BANNER (Fast Animated Gradient) ====== */
    .top-promo-banner {
        background: linear-gradient(270deg, #F4F1EA, #D4AF37, #F4F1EA);
        background-size: 200% 200%;
        animation: promoGradientFlow 4s ease infinite alternate;
        color: var(--nav-bg);
        padding: 8px 0;
        text-align: center;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        position: relative;
        z-index: 1020;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        box-shadow: inset 0 -1px 3px rgba(0,0,0,0.05);
    }

    @keyframes promoGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    .top-promo-banner p {
        margin: 0;
        text-transform: uppercase;
        font-weight: 800;
        animation: textPromoFlow 4s ease infinite alternate;
    }

    @keyframes textPromoFlow {
        0% { color: #183018; text-shadow: 0 1px 1px rgba(255,255,255,0.8); }
        100% { color: #FFFFFF; text-shadow: 0 1px 2px rgba(0,0,0,0.8); }
    }

    .top-promo-banner .highlight {
        font-weight: 900;
    }

    .top-promo-banner a {
        color: inherit;
        text-decoration: none;
        border-bottom: 1px solid currentColor;
        padding-bottom: 1px;
        transition: opacity var(--transition-speed);
        font-weight: 700;
    }

    .top-promo-banner a:hover {
        opacity: 0.7;
    }


    /* ====== 2. MAIN NAVBAR (Fast Animated Dark Gradient) ====== */
    .premium-navbar {
        background: linear-gradient(270deg, #183018, #3A5A3A, #183018);
        background-size: 200% 200%;
        animation: navGradientFlow 5s ease infinite alternate;
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: padding var(--transition-speed);
    }

    @keyframes navGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    .navbar-logo img {
        height: 35px;
        width: auto;
        transition: transform var(--transition-speed);
    }

    .navbar-logo:hover img {
        transform: scale(1.05);
    }

    /* Desktop Navigation Links */
    .nav-links-container {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .nav-link-premium {
        color: var(--nav-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: relative;
        padding: 1rem 0; /* Increased padding to eliminate dead zones */
        transition: color var(--transition-speed);
        cursor: pointer;
        display: flex;
        align-items: center;
        background: transparent;
        border: none;
    }

    .nav-link-premium::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 8px;
        left: 50%;
        background-color: var(--nav-hover);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        transform: translateX(-50%);
    }

    .nav-link-premium:hover, .nav-item-dropdown:hover .nav-link-premium {
        color: var(--nav-hover);
    }

    .nav-link-premium:hover::after,
    .nav-item-dropdown:hover .nav-link-premium::after {
        width: 100%;
    }

    /* ====== 3. MEGA MENU DROPDOWN ====== */
    .nav-item-dropdown {
        position: relative;
    }

    .mega-menu {
        position: absolute;
        top: 100%;
        background-color: var(--dropdown-bg);
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1001;
        margin-top: 15px; /* Creates the slide-up effect without breaking X-axis */
        border: 1px solid #F3F4F6;
    }

    /* INVISIBLE BRIDGE: Prevents the menu from closing when mouse crosses the gap */
    .mega-menu::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 0;
        width: 100%;
        height: 20px;
        background: transparent;
    }

    /* Modifiers for Menu Position */
    .mega-menu.center {
        left: 50%;
        transform: translateX(-50%);
        min-width: 600px;
    }

    .mega-menu.left {
        left: 0;
        min-width: 280px;
    }

    .mega-menu.right {
        right: 0;
        min-width: 220px;
    }

    @media (min-width: 992px) {
        .nav-item-dropdown:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            margin-top: 0; /* Slides up smoothly */
        }
    }

    /* Mega Menu Layout (Belanja) */
    .mega-menu-content {
        display: flex;
        max-height: 60vh;
    }

    .mega-menu-sidebar {
        background-color: #F9FAFB;
        width: 250px;
        border-right: 1px solid #E5E7EB;
        padding: 1.5rem 0;
        overflow-y: auto;
    }

    .mega-menu-tab {
        display: block;
        padding: 0.75rem 1.5rem;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }

    .mega-menu-tab:hover, .mega-menu-tab.active {
        background-color: #FFFFFF;
        color: var(--nav-bg);
        border-left-color: var(--nav-bg);
    }

    .mega-menu-body {
        flex-grow: 1;
        padding: 1.5rem;
        overflow-y: auto;
        background: #FFFFFF;
    }

    .mega-menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .mega-menu-item {
        color: #4B5563;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
        display: flex;
        align-items: center;
    }

    .mega-menu-item::before {
        content: '•';
        color: #D1D5DB;
        margin-right: 8px;
        font-size: 1.2rem;
        line-height: 1;
    }

    .mega-menu-item:hover {
        color: var(--nav-bg);
    }

    /* Simple Dropdown Layout (Brand) */
    .simple-dropdown {
        padding: 1.5rem;
    }

    .brand-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .brand-item {
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        padding: 8px 10px;
        text-align: center;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    .brand-item:hover {
        background-color: var(--nav-bg);
        color: #FFFFFF;
        border-color: var(--nav-bg);
    }

    /* ====== 4. SEARCH BAR (Premium Input) ====== */
    .premium-search-container {
        flex-grow: 1;
        max-width: 400px;
        margin: 0 2rem;
        position: relative;
    }

    .premium-search-input {
        width: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        border-radius: 50px;
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        font-size: 0.85rem;
        transition: all var(--transition-speed);
    }

    .premium-search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .premium-search-input:focus {
        background-color: #FFFFFF;
        color: var(--dropdown-text);
        outline: none;
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    }

    .premium-search-input:focus::placeholder {
        color: #9CA3AF;
    }

    .search-icon-nav {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
        transition: color var(--transition-speed);
        pointer-events: none;
    }

    .premium-search-input:focus + .search-icon-nav {
        color: var(--nav-bg);
    }

    /* ====== 5. ACTION ICONS (Cart & User) ====== */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .action-icon {
        color: var(--nav-text);
        font-size: 1.2rem;
        position: relative;
        text-decoration: none;
        transition: color var(--transition-speed);
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        height: 100%;
    }

    .action-icon:hover {
        color: var(--nav-hover);
    }

    .cart-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: var(--danger-main, #DC2626);
        color: white;
        font-size: 0.65rem;
        font-weight: bold;
        height: 18px;
        min-width: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        border: 2px solid var(--nav-bg);
    }

    /* ====== 6. MOBILE RESPONSIVENESS ====== */
    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 991px) {
        .premium-search-container,
        .desktop-nav-links {
            display: none;
        }

        .mobile-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(270deg, #FFFFFF, #F9FAFB, #F3F4F6, #FFFFFF);
            background-size: 400% 400%;
            animation: gradientLightFlow 10s ease infinite alternate;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            z-index: 1020;
            justify-content: space-around;
            padding: 0.5rem 0;
            border-top: 1px solid #E5E7EB;
            padding-bottom: env(safe-area-inset-bottom, 0.5rem);
        }

        @keyframes gradientLightFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #6B7280;
            text-decoration: none;
            font-size: 0.65rem;
            gap: 4px;
            transition: color 0.3s;
        }

        .mobile-nav-item i {
            font-size: 1.2rem;
        }

        .mobile-nav-item.active, .mobile-nav-item:hover {
            color: var(--nav-bg);
        }

        .mobile-search-wrapper {
            background: white;
            padding: 10px 15px;
            position: sticky;
            top: 60px;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .mobile-search-input {
            width: 100%;
            background: #F3F4F6;
            border: none;
            border-radius: 8px;
            padding: 10px 15px 10px 35px;
            font-size: 0.9rem;
        }

        .mobile-search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }
    }
</style>

<div class="top-promo-banner">
    <p>
        <span class="highlight">UP TO 70% OFF</span> + VOUCHERS UP TO 550K. FREE SHIPPING NATIONWIDE!
    </p>
    @if(session('id_user'))
        <a href="/promotion">Shop Now</a>
    @else
        <a href="#" class="require-login">Shop Now</a>
    @endif
</div>

<nav class="premium-navbar md:px-20 lg:px-24 xl:px-24 2xl:px-48">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="/" class="navbar-logo">
            <img src="{{ asset('images/new-logo.png') }}" alt="Glamoire">
        </a>

        <ul class="nav-links-container desktop-nav-links">

            <li class="nav-item-dropdown">
                <a href="{{ route('shop.all') }}" class="nav-link-premium">
                    Belanja <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </a>

                <div class="mega-menu center">
                    <div class="mega-menu-content">
                        <div class="mega-menu-sidebar custom-scroll">
                            @foreach ($categories as $index => $category)
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="mega-menu-tab {{ $index == 0 ? 'active' : '' }}"
                                   data-target="cat-{{ $category->id }}"
                                   onmouseover="switchMegaMenu(this, 'cat-{{ $category->id }}')">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="mega-menu-body custom-scroll">
                            @foreach ($categories as $index => $category)
                                <div id="cat-{{ $category->id }}" class="mega-menu-pane" style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--nav-bg);">{{ $category->name }}</h5>

                                    @php
                                        $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                                    @endphp

                                    @if ($subCategoriesInCategory->isEmpty())
                                        <p class="text-muted text-sm">Lihat semua produk di kategori ini.</p>
                                    @else
                                        <div class="mega-menu-grid">
                                            @foreach ($subCategoriesInCategory as $subCategory)
                                                <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="mega-menu-item">
                                                    {{ $subCategory->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mt-4 pt-3 border-top">
                                        <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="text-decoration-underline text-dark fw-semibold" style="font-size:0.85rem;">Lihat Semua {{ $category->name }} <i class="fas fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item-dropdown">
                <button class="nav-link-premium">
                    Brand <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </button>

                <div class="mega-menu left simple-dropdown">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Jelajahi Merek</h6>
                    <div class="brand-grid">
                        @foreach ($brands->take(10) as $brand)
                            <a href="/{{ $brand->name }}_brand" class="brand-item">{{ $brand->name }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            @if(session('id_user'))
                <li><a href="/promotion" class="nav-link-premium">Promo</a></li>
            @else
                <li><a href="#" class="nav-link-premium require-login">Promo</a></li>
            @endif

            <li><a href="/newsletter" class="nav-link-premium">Artikel</a></li>
        </ul>

        <div class="premium-search-container">
            <form method="GET" action="{{ route('search.product') }}">
                <input type="text" name="product_search" class="premium-search-input" placeholder="Cari produk kecantikan...">
                <i class="fas fa-search search-icon-nav"></i>
            </form>
        </div>

        <div class="nav-actions">
            <a href="/cart" class="action-icon" title="Keranjang Belanja">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" id="total_cart_items">0</span>
            </a>

            <div class="nav-item-dropdown d-flex align-items-center">
                @if (session('id_user'))
                    <a href="{{ route('account', ['user' => session('id_user')]) }}" class="action-icon" title="Akun Saya">
                        <i class="far fa-user"></i>
                    </a>
                @else
                    <button class="action-icon" title="Akun Saya" data-bs-toggle="modal" data-bs-target="#loginUser1">
                        <i class="far fa-user"></i>
                    </button>
                @endif

                <div class="mega-menu right" style="padding: 0.5rem 0;">
                    @if (session('id_user'))
                        <div class="px-4 py-3 border-bottom mb-2 bg-light">
                            <p class="mb-0 fs-7 text-muted">Selamat datang,</p>
                            <p class="mb-0 fw-bold text-dark">{{ session('username') ?? 'Pelanggan' }}</p>
                        </div>
                        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="dropdown-item py-2 px-4 text-dark text-sm"><i class="far fa-id-card me-2"></i> Profil Saya</a>
                        <div class="dropdown-divider my-2"></div>
                        <a href="#" id="logout-link-desktop" class="dropdown-item py-2 px-4 text-danger text-sm"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
                    @else
                        <div class="p-3 text-center">
                            <button class="btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginUser1">Masuk</button>
                            <p class="text-muted fs-7 mb-0">Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerUser1" class="text-dark fw-bold">Daftar</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</nav>

<div class="mobile-search-wrapper d-lg-none">
    <form method="GET" action="{{ route('search.product') }}" class="position-relative">
        <i class="fas fa-search mobile-search-icon"></i>
        <input type="text" name="product_search" class="mobile-search-input" placeholder="Cari skincare, makeup...">
    </form>
</div>

<div class="mobile-bottom-nav d-lg-none">
    <a href="/" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
    </a>

    <a href="#" class="mobile-nav-item" data-bs-toggle="offcanvas" data-bs-target="#mobileCategoryMenu">
        <i class="fas fa-th-large"></i>
        <span>Kategori</span>
    </a>

    @if(session('id_user'))
        <a href="/promotion" class="mobile-nav-item {{ Request::is('promotion') ? 'active' : '' }}">
            <i class="fas fa-tag"></i>
            <span>Promo</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item require-login">
            <i class="fas fa-tag"></i>
            <span>Promo</span>
        </a>
    @endif

    <a href="/cart" class="mobile-nav-item position-relative {{ Request::is('cart') ? 'active' : '' }}">
        <i class="fas fa-shopping-bag"></i>
        <span>Keranjang</span>
        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem; padding: 2px 4px;">0</span>
    </a>

    @if (session('id_user'))
        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="mobile-nav-item">
            <i class="far fa-user"></i>
            <span>Profil</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item" data-bs-toggle="modal" data-bs-target="#loginUser1">
            <i class="far fa-user"></i>
            <span>Masuk</span>
        </a>
    @endif
</div>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileCategoryMenu" aria-labelledby="mobileCategoryMenuLabel">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title fw-bold" id="mobileCategoryMenuLabel">Belanja</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0" style="overflow-y: auto;">

        <div class="accordion accordion-flush" id="accordionCategories">
            @foreach ($categories as $index => $category)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCat{{ $category->id }}">
                            {{ strtoupper($category->name) }}
                        </button>
                    </h2>
                    <div id="collapseCat{{ $category->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body bg-light py-2">
                            @php
                                $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                            @endphp

                            @if ($subCategoriesInCategory->isEmpty())
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="d-block py-2 text-decoration-none text-muted">Lihat semua {{ $category->name }}</a>
                            @else
                                @foreach ($subCategoriesInCategory as $subCategory)
                                    <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="d-block py-2 text-decoration-none text-dark border-bottom border-light">
                                        {{ $subCategory->name }}
                                    </a>
                                @endforeach
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="d-block py-2 mt-2 text-decoration-none fw-bold" style="color: var(--nav-bg);">Lihat Semua <i class="fas fa-arrow-right ms-1 text-sm"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="p-3 bg-light mt-3">
                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.8rem;">Top Brands</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($brands->take(6) as $brand)
                        <a href="/{{ $brand->name }}_brand" class="badge bg-white text-dark border p-2 text-decoration-none">{{ $brand->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JS for Mega Menu Hover Logic
    function switchMegaMenu(element, targetId) {
        // Remove active from all tabs
        document.querySelectorAll('.mega-menu-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        // Add active to hovered tab
        element.classList.add('active');

        // Hide all panes
        document.querySelectorAll('.mega-menu-pane').forEach(pane => {
            pane.style.display = 'none';
        });

        // Show target pane
        document.getElementById(targetId).style.display = 'block';
    }

    $(document).ready(function() {
        // Notifikasi SweetAlert jika user belum login dan klik promo
        $('.require-login').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Akses Terbatas',
                text: "Silakan masuk/daftar akun terlebih dahulu untuk melihat promo eksklusif kami.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Masuk Sekarang',
                cancelButtonText: 'Nanti Saja'
            }).then((result) => {
                if (result.isConfirmed) {
                    var loginModal = new bootstrap.Modal(document.getElementById('loginUser1'));
                    loginModal.show();
                }
            });
        });

        // Logout Handler for Desktop
        $('#logout-link-desktop').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Keluar?',
                text: "Anda yakin ingin keluar dari akun?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('logout.user') }}",
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "/";
                            }
                        }
                    });
                }
            })
        });
    });
</script> --}}

<style>
    /* ==========================================
       WORLD CLASS NAVBAR STYLING
       ========================================== */
    :root {
        --nav-bg: #183018; /* Glamoire Dark Green */
        --nav-text: #FFFFFF;
        --nav-hover: #D4AF37; /* Glamoire Gold */
        --dropdown-bg: #FFFFFF;
        --dropdown-text: #1F2937;
        --promo-bg: #F4F1EA; /* Soft Sand/Beige */
        --transition-speed: 0.3s;
    }

    /* ====== 1. TOP PROMO BANNER ====== */
    .top-promo-banner {
        background: linear-gradient(270deg, #F4F1EA, #D4AF37, #F4F1EA);
        background-size: 200% 200%;
        animation: promoGradientFlow 4s ease infinite alternate;
        color: var(--nav-bg);
        padding: 8px 0;
        text-align: center;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        position: relative;
        z-index: 1020;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        box-shadow: inset 0 -1px 3px rgba(0,0,0,0.05);
    }

    @keyframes promoGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    .top-promo-banner p {
        margin: 0;
        text-transform: uppercase;
        font-weight: 800;
        animation: textPromoFlow 4s ease infinite alternate;
    }

    @keyframes textPromoFlow {
        0% { color: #183018; text-shadow: 0 1px 1px rgba(255,255,255,0.8); }
        100% { color: #FFFFFF; text-shadow: 0 1px 2px rgba(0,0,0,0.8); }
    }

    .top-promo-banner .highlight { font-weight: 900; }
    .top-promo-banner a {
        color: inherit;
        text-decoration: none;
        border-bottom: 1px solid currentColor;
        padding-bottom: 1px;
        transition: opacity var(--transition-speed);
        font-weight: 700;
    }
    .top-promo-banner a:hover { opacity: 0.7; }

    /* ====== 2. MAIN NAVBAR ====== */
    .premium-navbar {
        background: linear-gradient(270deg, #183018, #3A5A3A, #183018);
        background-size: 200% 200%;
        animation: navGradientFlow 5s ease infinite alternate;
        padding: 0; /* Changed to 0 so nav-links can fill height */
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    @keyframes navGradientFlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    .navbar-logo { padding: 1rem 0; display: flex; align-items: center; }
    .navbar-logo img {
        height: 35px;
        width: auto;
        transition: transform var(--transition-speed);
    }
    .navbar-logo:hover img { transform: scale(1.05); }

    /* Desktop Navigation Links */
    .nav-links-container {
        display: flex;
        align-items: stretch;
        gap: 0; /* Removed gap to make hitboxes touch each other */
        margin: 0;
        padding: 0;
        list-style: none;
        height: 100%;
    }

    .nav-item-dropdown {
        position: relative;
        display: flex;
        align-items: stretch;
    }

    .nav-link-premium {
        color: var(--nav-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: relative;
        padding: 1.5rem 1.2rem; /* Large padding creates a massive hitbox */
        transition: color var(--transition-speed);
        cursor: pointer;
        display: flex;
        align-items: center;
        background: transparent;
        border: none;
        height: 100%;
    }

    .nav-link-premium::after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        bottom: 0; /* Touches the exact bottom of the navbar */
        left: 50%;
        background-color: var(--nav-hover);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        transform: translateX(-50%);
    }

    .nav-link-premium:hover, .nav-item-dropdown:hover .nav-link-premium {
        color: var(--nav-hover);
    }

    .nav-link-premium:hover::after,
    .nav-item-dropdown:hover .nav-link-premium::after {
        width: 100%;
    }

    /* ====== 3. MEGA MENU DROPDOWN ====== */
    .mega-menu {
        position: absolute;
        top: 100%;
        background-color: var(--dropdown-bg);
        border-radius: 0 0 12px 12px; /* Flush against navbar */
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1001;
        margin-top: 10px;
        border: 1px solid #F3F4F6;
        border-top: none;
    }

    /* SOLID BRIDGE: Fills the gap completely so mouse never slips */
    .nav-item-dropdown::before {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 0;
        width: 100%;
        height: 20px;
        background: transparent;
        z-index: 1000;
    }

    .mega-menu.center { left: 50%; transform: translateX(-50%); min-width: 600px; }
    .mega-menu.left { left: 0; min-width: 280px; }
    .mega-menu.right { right: 0; min-width: 220px; }

    @media (min-width: 992px) {
        .nav-item-dropdown:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            margin-top: 0;
        }
    }

    /* Mega Menu Layout (Belanja) */
    .mega-menu-content { display: flex; max-height: 60vh; }
    .mega-menu-sidebar {
        background-color: #F9FAFB;
        width: 250px;
        border-right: 1px solid #E5E7EB;
        padding: 1.5rem 0;
        overflow-y: auto;
    }
    .mega-menu-tab {
        display: block;
        padding: 0.75rem 1.5rem;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }
    .mega-menu-tab:hover, .mega-menu-tab.active {
        background-color: #FFFFFF;
        color: var(--nav-bg);
        border-left-color: var(--nav-bg);
    }
    .mega-menu-body {
        flex-grow: 1;
        padding: 1.5rem;
        overflow-y: auto;
        background: #FFFFFF;
    }
    .mega-menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .mega-menu-item {
        color: #4B5563;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
        display: flex;
        align-items: center;
    }
    .mega-menu-item::before {
        content: '•';
        color: #D1D5DB;
        margin-right: 8px;
        font-size: 1.2rem;
        line-height: 1;
    }
    .mega-menu-item:hover { color: var(--nav-bg); }

    /* Simple Dropdown Layout (Brand) */
    .simple-dropdown { padding: 1.5rem; }
    .brand-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .brand-item {
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        padding: 8px 10px;
        text-align: center;
        color: var(--dropdown-text);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    .brand-item:hover {
        background-color: var(--nav-bg);
        color: #FFFFFF;
        border-color: var(--nav-bg);
    }

    /* ====== 4. SEARCH BAR ====== */
    .premium-search-container {
        flex-grow: 1;
        max-width: 400px;
        margin: 0 2rem;
        position: relative;
    }
    .premium-search-input {
        width: 100%;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        border-radius: 50px;
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        font-size: 0.85rem;
        transition: all var(--transition-speed);
    }
    .premium-search-input::placeholder { color: rgba(255, 255, 255, 0.6); }
    .premium-search-input:focus {
        background-color: #FFFFFF;
        color: var(--dropdown-text);
        outline: none;
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    }
    .premium-search-input:focus::placeholder { color: #9CA3AF; }
    .search-icon-nav {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
        transition: color var(--transition-speed);
        pointer-events: none;
    }
    .premium-search-input:focus + .search-icon-nav { color: var(--nav-bg); }

    /* ====== 5. ACTION ICONS ====== */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        height: 100%;
    }
    .action-icon {
        color: var(--nav-text);
        font-size: 1.2rem;
        position: relative;
        text-decoration: none;
        transition: color var(--transition-speed);
        background: transparent;
        border: none;
        padding: 1.5rem 0; /* Fill navbar height */
        cursor: pointer;
        display: flex;
        align-items: center;
        height: 100%;
    }
    .action-icon:hover { color: var(--nav-hover); }
    .cart-badge {
        position: absolute;
        top: 15px;
        right: -10px;
        background-color: var(--danger-main, #DC2626);
        color: white;
        font-size: 0.65rem;
        font-weight: bold;
        height: 18px;
        min-width: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        border: 2px solid var(--nav-bg);
    }

    /* ====== 6. MOBILE RESPONSIVENESS ====== */
    .mobile-bottom-nav { display: none; }

    @media (max-width: 991px) {
        .premium-navbar { padding: 0.5rem 0; }
        .action-icon { padding: 0; }
        .cart-badge { top: -8px; right: -8px; }

        .premium-search-container, .desktop-nav-links { display: none; }

        .mobile-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(270deg, #FFFFFF, #F9FAFB, #F3F4F6, #FFFFFF);
            background-size: 400% 400%;
            animation: gradientLightFlow 10s ease infinite alternate;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            z-index: 1020;
            justify-content: space-around;
            padding: 0.5rem 0;
            border-top: 1px solid #E5E7EB;
            padding-bottom: env(safe-area-inset-bottom, 0.5rem);
        }

        @keyframes gradientLightFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #6B7280;
            text-decoration: none;
            font-size: 0.65rem;
            gap: 4px;
            transition: color 0.3s;
        }
        .mobile-nav-item i { font-size: 1.2rem; }
        .mobile-nav-item.active, .mobile-nav-item:hover { color: var(--nav-bg); }

        .mobile-search-wrapper {
            background: white;
            padding: 10px 15px;
            position: sticky;
            top: 60px;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .mobile-search-input {
            width: 100%;
            background: #F3F4F6;
            border: none;
            border-radius: 8px;
            padding: 10px 15px 10px 35px;
            font-size: 0.9rem;
        }
        .mobile-search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }
    }

    /* CUSTOM MOBILE CATEGORY MENU UI */
    .mobile-cat-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .mobile-cat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #E5E7EB;
        color: #1F2937;
        font-weight: 600;
        cursor: pointer;
        background: #FFF;
        transition: background 0.2s;
    }
    .mobile-cat-header:active { background: #F3F4F6; }
    .mobile-cat-header i { transition: transform 0.3s ease; color: #9CA3AF; }
    .mobile-cat-header.open i { transform: rotate(180deg); color: var(--nav-bg); }
    .mobile-cat-body {
        display: none; /* Hidden by default for smooth slideToggle */
        background: #F9FAFB;
        border-bottom: 1px solid #E5E7EB;
    }
    .mobile-subcat-link {
        display: block;
        padding: 0.75rem 1.5rem 0.75rem 2.5rem;
        color: #4B5563;
        text-decoration: none;
        border-bottom: 1px solid #F3F4F6;
        font-size: 0.9rem;
    }
    .mobile-subcat-link:last-child { border-bottom: none; }
    .mobile-subcat-link:hover, .mobile-subcat-link:active { color: var(--nav-bg); background: #F3F4F6; }
</style>

<div class="top-promo-banner">
    <p><span class="highlight">UP TO 70% OFF</span> + VOUCHERS UP TO 550K. FREE SHIPPING NATIONWIDE!</p>
    @if(session('id_user'))
        <a href="/promotion">Shop Now</a>
    @else
        <a href="#" class="require-login">Shop Now</a>
    @endif
</div>

<nav class="premium-navbar md:px-20 lg:px-24 xl:px-24 2xl:px-48">
    <div class="container-fluid d-flex align-items-center justify-content-between h-100">

        <a href="/" class="navbar-logo">
            <img src="{{ asset('images/new-logo.png') }}" alt="Glamoire">
        </a>

        <ul class="nav-links-container desktop-nav-links">
            <li class="nav-item-dropdown">
                <a href="{{ route('shop.all') }}" class="nav-link-premium">
                    Belanja <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </a>

                <div class="mega-menu center">
                    <div class="mega-menu-content">
                        <div class="mega-menu-sidebar custom-scroll">
                            @foreach ($categories as $index => $category)
                                <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="mega-menu-tab {{ $index == 0 ? 'active' : '' }}"
                                   data-target="cat-{{ $category->id }}"
                                   onmouseover="switchMegaMenu(this, 'cat-{{ $category->id }}')">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="mega-menu-body custom-scroll">
                            @foreach ($categories as $index => $category)
                                <div id="cat-{{ $category->id }}" class="mega-menu-pane" style="display: {{ $index == 0 ? 'block' : 'none' }};">
                                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--nav-bg);">{{ $category->name }}</h5>

                                    @php
                                        $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                                    @endphp

                                    @if ($subCategoriesInCategory->isEmpty())
                                        <p class="text-muted text-sm">Lihat semua produk di kategori ini.</p>
                                    @else
                                        <div class="mega-menu-grid">
                                            @foreach ($subCategoriesInCategory as $subCategory)
                                                <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="mega-menu-item">
                                                    {{ $subCategory->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mt-4 pt-3 border-top">
                                        <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="text-decoration-underline text-dark fw-semibold" style="font-size:0.85rem;">Lihat Semua {{ $category->name }} <i class="fas fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item-dropdown">
                <button class="nav-link-premium">
                    Brand <i class="fas fa-chevron-down ms-1" style="font-size:0.6rem;"></i>
                </button>

                <div class="mega-menu left simple-dropdown">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Jelajahi Merek</h6>
                    <div class="brand-grid">
                        @foreach ($brands->take(10) as $brand)
                            <a href="/{{ $brand->name }}_brand" class="brand-item">{{ $brand->name }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            @if(session('id_user'))
                <li class="nav-item-dropdown"><a href="/promotion" class="nav-link-premium">Promo</a></li>
            @else
                <li class="nav-item-dropdown"><a href="#" class="nav-link-premium require-login">Promo</a></li>
            @endif

            <li class="nav-item-dropdown"><a href="/newsletter" class="nav-link-premium">Artikel</a></li>
        </ul>

        <div class="premium-search-container">
            <form method="GET" action="{{ route('search.product') }}">
                <input type="text" name="product_search" class="premium-search-input" placeholder="Cari produk kecantikan...">
                <i class="fas fa-search search-icon-nav"></i>
            </form>
        </div>

        <div class="nav-actions">
            <a href="/cart" class="action-icon" title="Keranjang Belanja">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" id="total_cart_items">0</span>
            </a>

            <div class="nav-item-dropdown">
                @if (session('id_user'))
                    <a href="{{ route('account', ['user' => session('id_user')]) }}" class="action-icon" title="Akun Saya">
                        <i class="far fa-user"></i>
                    </a>
                @else
                    <button class="action-icon" title="Akun Saya" data-bs-toggle="modal" data-bs-target="#loginUser1">
                        <i class="far fa-user"></i>
                    </button>
                @endif

                <div class="mega-menu right" style="padding: 0.5rem 0;">
                    @if (session('id_user'))
                        <div class="px-4 py-3 border-bottom mb-2 bg-light">
                            <p class="mb-0 fs-7 text-muted">Selamat datang,</p>
                            <p class="mb-0 fw-bold text-dark">{{ session('username') ?? 'Pelanggan' }}</p>
                        </div>
                        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="dropdown-item py-2 px-4 text-dark text-sm"><i class="far fa-id-card me-2"></i> Profil Saya</a>
                        <div class="dropdown-divider my-2"></div>
                        <a href="#" id="logout-link-desktop" class="dropdown-item py-2 px-4 text-danger text-sm"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
                    @else
                        <div class="p-3 text-center">
                            <button class="btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginUser1">Masuk</button>
                            <p class="text-muted fs-7 mb-0">Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerUser1" class="text-dark fw-bold">Daftar</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</nav>

<div class="mobile-search-wrapper d-lg-none">
    <form method="GET" action="{{ route('search.product') }}" class="position-relative">
        <i class="fas fa-search mobile-search-icon"></i>
        <input type="text" name="product_search" class="mobile-search-input" placeholder="Cari skincare, makeup...">
    </form>
</div>

<div class="mobile-bottom-nav d-lg-none">
    <a href="/" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
    </a>

    <a href="#" class="mobile-nav-item" data-bs-toggle="offcanvas" data-bs-target="#mobileCategoryMenu">
        <i class="fas fa-th-large"></i>
        <span>Kategori</span>
    </a>

    @if(session('id_user'))
        <a href="/promotion" class="mobile-nav-item {{ Request::is('promotion') ? 'active' : '' }}">
            <i class="fas fa-tag"></i>
            <span>Promo</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item require-login">
            <i class="fas fa-tag"></i>
            <span>Promo</span>
        </a>
    @endif

    <a href="/cart" class="mobile-nav-item position-relative {{ Request::is('cart') ? 'active' : '' }}">
        <i class="fas fa-shopping-bag"></i>
        <span>Keranjang</span>
        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem; padding: 2px 4px;">0</span>
    </a>

    @if (session('id_user'))
        <a href="{{ route('account', ['user' => session('id_user')]) }}" class="mobile-nav-item">
            <i class="far fa-user"></i>
            <span>Profil</span>
        </a>
    @else
        <a href="#" class="mobile-nav-item" data-bs-toggle="modal" data-bs-target="#loginUser1">
            <i class="far fa-user"></i>
            <span>Masuk</span>
        </a>
    @endif
</div>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileCategoryMenu" aria-labelledby="mobileCategoryMenuLabel">
    <div class="offcanvas-header bg-dark text-white p-3">
        <h5 class="offcanvas-title fw-bold" id="mobileCategoryMenuLabel">Menu Belanja</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0 custom-scroll" style="overflow-y: auto;">

        <ul class="mobile-cat-list">
            @foreach ($categories as $index => $category)
                <li>
                    <div class="mobile-cat-header">
                        <span>{{ strtoupper($category->name) }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="mobile-cat-body">
                        @php
                            $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                        @endphp

                        @if ($subCategoriesInCategory->isEmpty())
                            <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="mobile-subcat-link fw-bold">
                                Lihat Semua {{ $category->name }}
                            </a>
                        @else
                            @foreach ($subCategoriesInCategory as $subCategory)
                                <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="mobile-subcat-link">
                                    {{ $subCategory->name }}
                                </a>
                            @endforeach
                            <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="mobile-subcat-link fw-bold" style="color: var(--nav-bg);">
                                Lihat Semua Kategori <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="p-4 mt-2">
            <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Top Brands</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($brands->take(8) as $brand)
                    <a href="/{{ $brand->name }}_brand" class="badge bg-light text-dark border p-2 text-decoration-none" style="font-weight: 500;">{{ $brand->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    // JS for Mega Menu Hover Logic (Desktop)
    function switchMegaMenu(element, targetId) {
        document.querySelectorAll('.mega-menu-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        element.classList.add('active');
        document.querySelectorAll('.mega-menu-pane').forEach(pane => {
            pane.style.display = 'none';
        });
        document.getElementById(targetId).style.display = 'block';
    }

    $(document).ready(function() {
        // Custom JS for Mobile Category Accordion (Bulletproof & Smooth)
        $('.mobile-cat-header').on('click', function() {
            // Close other open tabs (optional: remove this block if you want multiple tabs open at once)
            $('.mobile-cat-body').not($(this).next()).slideUp(300);
            $('.mobile-cat-header').not($(this)).removeClass('open');

            // Toggle current tab
            $(this).toggleClass('open');
            $(this).next('.mobile-cat-body').slideToggle(300);
        });

        // Require Login Alert
        $('.require-login').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Akses Terbatas',
                text: "Silakan masuk/daftar akun terlebih dahulu untuk melihat promo eksklusif kami.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Masuk Sekarang',
                cancelButtonText: 'Nanti Saja'
            }).then((result) => {
                if (result.isConfirmed) {
                    var loginModal = new bootstrap.Modal(document.getElementById('loginUser1'));
                    loginModal.show();
                }
            });
        });

        // Logout Handler for Desktop
        $('#logout-link-desktop').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Keluar?',
                text: "Anda yakin ingin keluar dari akun?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#183018',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('logout.user') }}",
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "/";
                            }
                        }
                    });
                }
            })
        });
    });
</script>

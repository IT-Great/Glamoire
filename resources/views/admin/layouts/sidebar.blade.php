<style>
    .sidebar-header {
        background-color: #f8f9fa;
        /* warna latar lebih soft */
        padding: 20px 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .sidebar-header .logo {
        display: block;
        margin: 0 auto;
    }

    .sidebar-header .logo img {
        max-width: 160px;
        height: auto;
        object-fit: contain;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
    }

    .sidebar-header .logo img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .sidebar-header .company-name {
        font-weight: bold;
        font-size: 14px;
        color: #333;
        margin-top: 5px;
        letter-spacing: 0.5px;
    }

    .sidebar-header .tagline {
        font-size: 12px;
        color: #666;
    }
</style>


<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="logo">
                <a href="index.html">
                    <img src="{{ asset('images/new-logo.png') }}" alt="Logo">
                </a>
                <div class="company-name">GLAMOIRE</div>
                <div class="tagline">Indonesia’s First Plant-Based Platform</div>
            </div>
        </div>


        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <!-- Jika User adalah Admin -->
                {{-- @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin') --}}
                @if (in_array(Auth::user()->role, ['admin', 'superadmin', 'accounting']))
                    <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endif

                @if (in_array(Auth::user()->role, ['admin', 'superadmin']))
                    <!-- menu-menu lain hanya untuk admin/superadmin -->
                    <li
                        class="sidebar-item has-sub {{ Request::is('product-admin*') || Request::is('stock-product-admin*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-bag-fill"></i>
                            <span>Produk</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('product-admin') ? 'active' : '' }}">
                                <a href="{{ route('index-product-admin') }}">
                                    Produk
                                </a>
                            </li>
                            <li class="submenu-item {{ Request::is('stock-product*') ? 'active' : '' }}">
                                <a href="{{ route('index-stock-product-admin') }}">
                                    Stok Produk
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ Request::is('order-admin') ? 'active' : '' }}">
                        <a href="{{ route('index-admin-order') }}" class='sidebar-link'>
                            <i class="bi bi-cart-check-fill"></i>
                            <span>Order</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('brand-admin*') ? 'active' : '' }}">
                        <a href="{{ route('index-brand-admin') }}" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Brand</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('category-product') ? 'active' : '' }}">
                        <a href="{{ route('index-category-product') }}" class='sidebar-link'>
                            <i class="bi bi-bookmark-star-fill"></i>
                            <span>Kategori</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item has-sub {{ Request::is('promo*') || Request::is('detail-promo*') || Request::is('detail-promo-voucher*') || Request::is('detail-diskon*') || Request::is('create-promo-diskon') || Request::is('create-promo') || Request::is('create-promo-brand-voucher') || Request::is('create-promo-product-voucher') || Request::is('create-promo-voucher') || Request::is('create-promo-voucher-shippingfee') || Request::is('create-promo-voucher-new-user') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-receipt"></i>
                            <span>Promo</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('promo') ? 'active' : '' }}">
                                <a href="{{ route('index-promo') }}">Promo</a>
                            </li>
                            <li class="submenu-item {{ Request::is('promo-voucher') ? 'active' : '' }}">
                                <a href="{{ route('index-promo-voucher') }}">Voucher</a>
                            </li>
                            <li class="submenu-item {{ Request::is('promo-diskon') ? 'active' : '' }}">
                                <a href="{{ route('index-promo-diskon') }}">Diskon</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ Request::is('article-admin*') ? 'active' : '' }}">
                        <a href="{{ route('index-article') }}" class='sidebar-link'>
                            <i class="bi bi-file-earmark-post"></i>
                            <span>Artikel</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('contact-us-admin*') ? 'active' : '' }}">
                        <a href="{{ route('index-contactus-admin') }}" class='sidebar-link'>
                            <i class="bi bi-telephone-plus-fill"></i>
                            <span>Hubungi Kami</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('affiliate-admin*') ? 'active' : '' }}">
                        <a href="{{ route('index-affiliate-admin') }}" class='sidebar-link'>
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Mitra</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('faq-admin') ? 'active' : '' }}">
                        <a href="{{ route('index-faq-admin') }}" class='sidebar-link'>
                            <i class="bi bi-patch-question-fill"></i>
                            <span>Tanya Jawab</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('user-admin*') ? 'active' : '' }}">
                        <a href="{{ route('index-user-admin') }}" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>User</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('aboutus*') ? 'active' : '' }}">
                        <a href="{{ route('index-aboutus-admin') }}" class='sidebar-link'>
                            <i class="bi bi-info-circle-fill"></i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('popup*') ? 'active' : '' }}">
                        <a href="{{ route('index-popup-admin') }}" class='sidebar-link'>
                            <i class="bi bi-window"></i>
                            <span>Pop up</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('subscribe-admin') ? 'active' : '' }}">
                        <a href="{{ route('index-subscribe-admin') }}" class='sidebar-link'>
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Subscribe</span>
                        </a>
                    </li>

                    {{-- @endif --}}
                @endif

                <!-- Jika User adalah Accounting -->
                @if (Auth::user()->role === 'accounting' || Auth::user()->role === 'superadmin')
                    {{-- ACCOUNTING SIDE --}}
                    <li class="sidebar-title">Accounting</li>

                    <li class="sidebar-item {{ Request::is('coa*') ? 'active' : '' }}">
                        <a href="{{ route('index-chartofaccount') }}" class='sidebar-link'>
                            <i class="bi bi-calculator"></i>
                            <span>COA</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('financial-*') ? 'active' : '' }}">
                        <a href="{{ route('index-financial-income') }}" class='sidebar-link'>
                            <i class="bi bi-cash-stack"></i>
                            <span>Keuangan</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('invoice*') ? 'active' : '' }}">
                        <a href="{{ route('index-invoice') }}" class='sidebar-link'>
                            <i class="bi bi-calendar-month"></i>
                            <span>Tagihan</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('transaction*') ? 'active' : '' }}">
                        <a href="{{ route('index-transaction') }}" class='sidebar-link'>
                            <i class="bi bi-cash"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('journal') ? 'active' : '' }}">
                        <a href="{{ route('index-journal') }}" class='sidebar-link'>
                            <i class="bi bi-journal-check"></i>
                            <span>Jurnal</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

    </div>
</div>

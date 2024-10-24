<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    {{-- <a href="index.html"> <img src="{{ asset('images/glamoire.jpg') }}" alt="Logo">
                    </a> --}}
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <!-- Jika User adalah Admin -->
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
                    <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="/dashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>                

                    <li class="sidebar-item has-sub {{ Request::is('product-admin*') ? 'active' : '' }} ">
                        <a href="/product-admin" class='sidebar-link'>
                            <i class="bi bi-bag-fill"></i>
                            <span>Product</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('product-admin') ? 'active' : '' }}">                                
                                <a href="/product-admin">
                                    Product
                                </a>
                            </li>
                            <li class="submenu-item {{ Request::is('product-admin') ? 'active' : '' }}">
                                <a href="/product-admin">Stock Product</a>
                            </li>                          
                        </ul>

                    </li>

                    <li class="sidebar-item {{ Request::is('order-admin') ? 'active' : '' }}">
                        <a href="/order-admin" class='sidebar-link'>
                            <i class="bi bi-cart-check-fill"></i>
                            <span>Order</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('brand-admin') ? 'active' : '' }}">
                        <a href="/brand-admin" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Brand</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('category-product') ? 'active' : '' }}">
                        <a href="/category-product" class='sidebar-link'>
                            <i class="bi bi-bookmark-star-fill"></i>
                            <span>Category</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub {{ Request::is('promo*') ? 'active' : '' }} ">
                        <a href="/promo" class='sidebar-link'>
                            <i class="bi bi-receipt"></i>
                            <span>Promo</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('promo') ? 'active' : '' }}">
                                <a href="/promo">Promo</a>
                            </li>
                            <li class="submenu-item {{ Request::is('promo-voucher') ? 'active' : '' }}">
                                <a href="/promo-voucher">Voucher</a>
                            </li>
                            <li class="submenu-item {{ Request::is('promo-diskon') ? 'active' : '' }}">
                                <a href="/promo-diskon">Discount</a>
                            </li>
                            <li class="submenu-item {{ Request::is('promo-new-user') ? 'active' : '' }}">
                                <a href="/promo-new-user">Promo New User</a>
                            </li>
                        </ul>

                    </li>

                    <li class="sidebar-item {{ Request::is('article-admin') ? 'active' : '' }}">
                        <a href="/article-admin" class='sidebar-link'>
                            <i class="bi bi-file-earmark-post"></i>
                            <span>Article</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('user-admin') ? 'active' : '' }}">
                        <a href="/user-admin" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>User</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('shipping-fee') ? 'active' : '' }}">
                        <a href="/shipping-fee" class='sidebar-link'>
                            <i class="bi bi-mailbox2"></i>
                            <span>Shipping Fee</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('affiliate-admin') ? 'active' : '' }}">
                        <a href="/affiliate-admin" class='sidebar-link'>
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Affiliate</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('chat-admin') ? 'active' : '' }}">
                        <a href="/chat-admin" class='sidebar-link'>
                            <i class="bi bi-chat-dots-fill"></i>
                            <span>Chat</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('contact-us-admin') ? 'active' : '' }}">
                        <a href="/contact-us-admin" class='sidebar-link'>
                            <i class="bi bi-patch-question"></i>
                            <span>Contact Us</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('subscribe-admin') ? 'active' : '' }}">
                        <a href="/subscribe-admin" class='sidebar-link'>
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Subscribe</span>
                        </a>
                    </li>
                @endif

                <!-- Jika User adalah Accounting -->
                @if (Auth::user()->role === 'accounting' || Auth::user()->role === 'superadmin')
                    <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="/dashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    {{-- ACCOUNTING SIDE --}}
                    <li class="sidebar-title">Accounting</li>

                    <li class="sidebar-item {{ Request::is('coa') ? 'active' : '' }}">
                        <a href="/coa" class='sidebar-link'>
                            <i class="bi bi-calculator"></i>
                            <span>COA</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('invoice') ? 'active' : '' }}">
                        <a href="/affiliate-admin" class='sidebar-link'>
                            <i class="bi bi-cash-stack"></i>
                            <span>Financial</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('invoice') ? 'active' : '' }}">
                        <a href="/invoice" class='sidebar-link'>
                            <i class="bi bi-calendar-month"></i>
                            <span>Invoice</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('') ? 'active' : '' }}">
                        <a href="/affiliate-admin" class='sidebar-link'>
                            <i class="bi bi-cash"></i>
                            <span>Transaction</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('') ? 'active' : '' }}">
                        <a href="/affiliate-admin" class='sidebar-link'>
                            <i class="bi bi-journal-check"></i>
                            <span>Journal</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

    </div>
</div>

@extends('user.layouts.master')
@section('content')

    <style>
        /* ==========================================
           WORLD CLASS CHECKOUT STYLING
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
            background-color: var(--glamoire-light);
            font-family: 'Poppins', sans-serif;
        }

        /* --- Premium Breadcrumb --- */
        .premium-breadcrumb {
            background: transparent;
            padding: 1.5rem 0;
            margin-bottom: 0;
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

        .page-title {
            font-family: 'The Seasons', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
        }

        /* --- Layout Wrappers --- */
        .checkout-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: flex-start;
            margin-bottom: 5rem;
        }

        .checkout-main-section {
            flex: 1 1 60%;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .checkout-summary-section {
            flex: 0 0 380px;
            background: #FFF;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            position: sticky;
            top: 100px;
        }

        @media (max-width: 991px) {
            .checkout-container {
                flex-direction: column;
            }

            .checkout-main-section,
            .checkout-summary-section {
                flex: 1 1 100%;
                width: 100%;
            }

            .checkout-summary-section {
                position: static;
                display: none;
            }
        }

        /* --- Card Styles --- */
        .checkout-card {
            background: #FFF;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        .card-header-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.75rem;
        }

        /* --- Address Section --- */
        .address-info h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .address-info p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 0;
        }

        .badge-utama {
            background: var(--glamoire-light);
            color: var(--glamoire-dark);
            border: 1px solid var(--glamoire-dark);
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .btn-change-address {
            background: transparent;
            color: var(--glamoire-dark);
            border: 1px solid var(--glamoire-dark);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition-smooth);
            cursor: pointer;
            margin-top: 1rem;
        }

        .btn-change-address:hover {
            background: var(--glamoire-light);
        }

        /* --- Product Items --- */
        .checkout-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px dashed var(--border-color);
        }

        .checkout-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .item-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .item-details {
            flex: 1;
        }

        .item-brand {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .item-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }

        .item-variant {
            font-size: 0.8rem;
            background: var(--glamoire-light);
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .item-price-calc {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .item-subtotal {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            text-align: right;
        }

        .promo-tier-text {
            font-size: 0.75rem;
            color: var(--danger-main);
            background: #FEE2E2;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
        }

        /* --- Shipping Selection --- */
        .shipping-route {
            font-size: 0.9rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
        }

        .form-select-premium {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--glamoire-dark);
            font-size: 0.95rem;
            color: var(--text-main);
            background-color: #FFF;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
            transition: var(--transition-smooth);
        }

        .form-select-premium:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(24, 48, 24, 0.1);
        }

        /* --- Summary Section --- */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .summary-row.discount {
            color: var(--danger-main);
            font-weight: 500;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px dashed var(--border-color);
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--glamoire-dark);
        }

        /* Voucher Input */
        .voucher-input-group {
            display: flex;
            gap: 5px;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .voucher-input {
            flex: 1;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
        }

        .voucher-input:focus {
            border-color: var(--glamoire-dark);
            outline: none;
        }

        .btn-apply-voucher {
            background: var(--glamoire-dark);
            color: #FFF;
            border: none;
            border-radius: 8px;
            padding: 0 1rem;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-apply-voucher:hover:not(:disabled) {
            background: var(--glamoire-accent);
        }

        .btn-apply-voucher:disabled {
            background: #D1D5DB;
            cursor: not-allowed;
        }

        .btn-remove-voucher {
            position: absolute;
            right: 80px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--danger-main);
            font-weight: bold;
            font-size: 0.8rem;
            cursor: pointer;
            display: none;
        }

        .btn-pay-now {
            width: 100%;
            background: var(--glamoire-dark);
            color: #FFF;
            border: none;
            padding: 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            margin-top: 1.5rem;
            transition: var(--transition-smooth);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-pay-now:hover:not(:disabled) {
            background: var(--glamoire-accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(24, 48, 24, 0.15);
        }

        /* Modals Custom */
        .modal-content {
            border-radius: 16px;
            border: none;
        }

        .modal-header-premium {
            background: var(--glamoire-dark);
            color: #FFF;
            border-radius: 16px 16px 0 0;
            padding: 1.25rem 1.5rem;
        }

        .modal-header-premium .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        .form-control-modal {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            border: 1px solid var(--border-color);
        }

        .form-control-modal:focus {
            border-color: var(--glamoire-dark);
            outline: none;
            box-shadow: 0 0 0 3px rgba(24, 48, 24, 0.1);
        }

        /* Mobile Fixed Bottom Checkout */
        .mobile-checkout-bar {
            display: none;
            background: #FFF;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
            padding: 15px;
            padding-bottom: env(safe-area-inset-bottom, 15px);
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            border-top: 1px solid var(--border-color);
        }

        @media (max-width: 991px) {
            .mobile-checkout-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }
    </style>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

        <div class="container-fluid">
            <div class="premium-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                <span>/</span>
                <a href="/cart">Keranjang</a>
                <span>/</span>
                <span class="active-page">Pengiriman & Pembayaran</span>
            </div>
            <h1 class="page-title px-md-3">Beli Langsung</h1>
        </div>

        <div class="container-fluid px-0 px-md-3">
            <div class="checkout-container">

                <div class="checkout-main-section">

                    <div class="checkout-card">
                        <div class="card-header-title">
                            <i class="fas fa-map-marker-alt text-muted"></i> Alamat Pengiriman
                        </div>

                        @if (count($data['address']) !== 0)
                            @foreach ($data['address'] as $checkout_address)
                                @if($checkout_address->is_use)
                                    <div class="address-info">
                                        <h6>{{ $checkout_address->recipient_name }} <span
                                                class="badge-utama">{{ $checkout_address->label }}</span></h6>
                                        <p class="mb-1"><i class="fas fa-phone-alt me-2"
                                                style="font-size: 0.8rem;"></i>{{ $checkout_address->handphone }}</p>
                                        <p>{{ $checkout_address->address }}
                                            @if ($checkout_address->benchmark !== null)
                                                <br><em>(Patokan: {{ $checkout_address->benchmark }})</em>
                                            @endif
                                        </p>
                                        <p>{{ ucwords(strtolower($checkout_address->subdistrict)) }},
                                            {{ ucwords(strtolower($checkout_address->district)) }},
                                            {{ ucwords(strtolower($checkout_address->regency)) }},
                                            {{ ucwords(strtolower($checkout_address->province)) }}</p>
                                    </div>
                                    <button type="button" class="btn-change-address" data-bs-toggle="modal"
                                        data-bs-target="#change_address">
                                        Pilih Alamat Lain
                                    </button>
                                @endif
                            @endforeach
                        @else
                            <div class="text-center py-3">
                                <p class="text-muted mb-3">Anda belum memiliki alamat pengiriman.</p>
                                <button type="button" class="btn btn-dark rounded-pill px-4 py-2" data-bs-toggle="modal"
                                    data-bs-target="#form-address-new">
                                    <i class="fas fa-plus me-2"></i> Tambah Alamat Baru
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="checkout-card">
                        <div class="card-header-title">
                            <i class="fas fa-truck text-muted"></i> Opsi Pengiriman
                        </div>

                        <div class="shipping-route">
                            <i class="fas fa-box-open"></i> Dikirim dari Kota Surabaya, Jawa Timur
                        </div>

                        @foreach ($data['address'] as $checkout_address)
                            @if($checkout_address->is_use)
                                <div class="shipping-route mb-3">
                                    <i class="fas fa-home"></i> Menuju {{ ucwords(strtolower($checkout_address->district)) }},
                                    {{ ucwords(strtolower($checkout_address->regency)) }},
                                    {{ ucwords(strtolower($checkout_address->province)) }}
                                </div>
                            @endif
                        @endforeach

                        <div class="shipping-route mb-2 fw-bold text-dark">
                            <i class="fas fa-weight-hanging"></i> Total Berat:
                            @if ($data['weight'] < 1000)
                                {{ $data['weight'] }} gr
                            @else
                                {{ number_format($data['weight'] / 1000, 1) }} kg
                            @endif
                        </div>

                        <select class="form-select-premium" name="shipping_fee" id="choose_shipping_fee">
                            <option value="" selected disabled>Pilih Jasa Pengiriman</option>
                            @foreach ($data['shippingFee'] as $sp)
                                <option value="{{ $sp['id'] }}">{{$sp['name']}} ({{ $sp['description'] }}) -
                                    Rp{{ number_format($sp['value'], 0, ',', '.') }} | Est. {{ $sp['etd'] }} hari</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="checkout-card">
                        <div class="card-header-title">
                            <i class="fas fa-shopping-bag text-muted"></i> Rincian Pesanan ({{ count($data['cartItems']) }}
                            Item)
                        </div>

                        @foreach ($data['cartItems'] as $cart => $product)
                            @php
                                $isVariant = $product->productVariant !== null;
                                $image = $isVariant && $product->productVariant->variant_image ? $product->productVariant->variant_image : $product->product->main_image;
                                $productName = $product->product->product_name;
                                $brandName = $product->product->brand->name;
                                $variantValue = $isVariant ? $product->productVariant->variant_value : null;
                                $price = $product->price;
                                $quantity = $product->quantity;
                                $subtotal = $product->bundle_price !== null ? $product->bundle_price : ($price * $quantity);
                            @endphp

                            <div class="checkout-item">
                                <img src="{{ Storage::url($image) }}" alt="{{ $productName }}" class="item-img">
                                <div class="item-details">
                                    <div class="item-brand">{{ $brandName }}</div>
                                    <div class="item-name">{{ $productName }}</div>
                                    @if($isVariant)
                                        <div class="item-variant">Varian: {{ $variantValue }}</div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="item-price-calc">
                                            @if ($product->bundle_price !== null)
                                                <del>Rp{{ number_format($price * $quantity, 0, ',', '.') }}</del><br>
                                                <span class="fw-bold text-dark">{{ $quantity }}x (Harga Bundle)</span>
                                            @else
                                                {{ $quantity }} x Rp{{ number_format($price, 0, ',', '.') }}
                                            @endif

                                            @if ($product->all_discount_tiers)
                                                <br><span class="promo-tier-text">{!! $product->all_discount_tiers !!}</span>
                                            @endif
                                        </div>
                                        <div class="item-subtotal">
                                            Rp{{ number_format($subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="checkout-summary-section">
                    <h3 class="card-header-title mb-4 border-0 p-0"><i class="fas fa-file-invoice-dollar text-muted"></i>
                        Ringkasan Pembayaran</h3>

                    <div class="voucher-input-group">
                        <input type="text" class="voucher-input" id="code-voucher" name="code_voucher"
                            placeholder="Masukkan kode promo">
                        <button type="button" class="btn-remove-voucher" id="cancelCode" onclick="removeCode()">X</button>
                        <button type="button" class="btn-apply-voucher" id="button-code-voucher" disabled>Pakai</button>
                    </div>
                    <div class="spinner-border text-success" role="status"
                        style="width:15px; height:15px; display:none; position:absolute; right: 80px; top: 35px;"
                        id="voucher-spinner">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div id="validationVoucher" class="text-danger fs-7 mb-3" style="display: none; margin-top: -10px;">
                    </div>

                    <button type="button"
                        class="btn btn-outline-dark w-100 mb-4 rounded-3 d-flex justify-content-between align-items-center p-2"
                        data-bs-toggle="modal" data-bs-target="#promo" id="show-voucher">
                        <span><i class="fas fa-tag text-warning me-2"></i> <span id="choose-voucher">Lihat Voucher
                                Tersedia</span></span>
                        <i class="fas fa-chevron-right text-muted" style="font-size: 0.8rem;"></i>
                    </button>

                    <div class="summary-row">
                        <span>Total Harga ({{ $data['totalProduct'] }} barang)</span>
                        <span class="fw-bold text-dark">Rp{{ number_format($data['totalPrice'], 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row d-none discount" id="discount-use">
                        <span>Diskon Promo</span>
                        <span id="discount">Rp0</span>
                    </div>

                    <div class="summary-row">
                        <span>Biaya Pengiriman</span>
                        <span class="fw-bold text-dark"
                            id="ongkir-user">{{ $data['ongkir'] ? 'Rp' . number_format($data['ongkir'], 0, ',', '.') : '-' }}</span>
                    </div>

                    <div class="summary-row d-none discount" id="ongkir-use">
                        <span>Diskon Ongkir</span>
                        <span id="ongkir">Rp0</span>
                    </div>

                    <div class="summary-total">
                        <span>Total Tagihan</span>
                        <span id="total-shopping">Rp{{ number_format($data['totalPrice'], 0, ',', '.') }}</span>
                    </div>

                    <div class="d-none mt-2 text-center" id="hore">
                        <span class="badge bg-success rounded-pill px-3 py-2 fw-normal"><i class="fas fa-party-horn"></i>
                            Hore! Kamu hemat <strong id="thrifty">Rp0</strong></span>
                    </div>

                    <button class="btn-pay-now" id="paynow" onclick="checkoutAction()">
                        <i class="fas fa-lock"></i> Bayar Sekarang
                    </button>
                    <p class="text-muted fs-7 text-center mt-3 mb-0"><i class="fas fa-shield-check text-success"></i>
                        Transaksi dienkripsi dengan aman</p>
                </div>

            </div>
        </div>

        <div class="mobile-checkout-bar d-lg-none">
            <div>
                <span class="text-muted fs-7 d-block">Total Tagihan</span>
                <span id="totalPriceMobile" class="fw-bold text-dark"
                    style="font-size: 1.25rem;">Rp{{ number_format($data['totalPrice'], 0, ',', '.') }}</span>
            </div>
            <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold" id="paynowmobile" onclick="checkoutAction()">
                Bayar <i class="fas fa-arrow-right ms-1"></i>
            </button>
        </div>
    </div>

    <div class="modal fade" id="change_address" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header-premium">
                    <h5 class="modal-title fw-bold m-0" style="font-family: 'Poppins', sans-serif;"><i
                            class="fas fa-map-marker-alt me-2"></i> Pilih Alamat Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 custom-scroll" style="background: var(--glamoire-light);">
                    <button type="button" class="btn btn-outline-dark w-100 mb-3 rounded-3 py-2 fw-bold bg-white"
                        data-bs-dismiss="modal" id="open-add-address-modal">
                        <i class="fas fa-plus me-1"></i> Tambah Alamat Baru
                    </button>

                    @foreach ($data['address'] as $address)
                        <div class="card mb-3 border-0 shadow-sm {{ $address->is_use ? 'border border-success' : '' }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                    <h6 class="fw-bold m-0 text-dark">{{ $address->label }}</h6>
                                    @if ($address->is_main) <span class="badge bg-light text-dark border">Utama</span> @endif
                                </div>
                                <p class="fw-bold text-dark m-0 fs-6">{{ $address->recipient_name }}</p>
                                <p class="text-muted m-0 fs-7">{{ $address->handphone }}</p>
                                <p class="text-muted m-0 fs-7 lh-sm mt-1">
                                    {{ $address->address }}<br>{{ ucwords(strtolower($address->subdistrict)) }},
                                    {{ ucwords(strtolower($address->district)) }}, {{ ucwords(strtolower($address->regency)) }},
                                    {{ ucwords(strtolower($address->province)) }}</p>

                                @if (!$address->is_use)
                                    <button type="button" class="btn btn-dark w-100 mt-3 rounded-pill py-1 fs-7 fw-bold"
                                        name="useAddress" data-id="{{ $address->id }}">
                                        Gunakan Alamat Ini
                                    </button>
                                @else
                                    <div class="text-success text-center mt-3 fs-7 fw-bold"><i class="fas fa-check-circle"></i>
                                        Sedang Digunakan</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="form-address-new" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header-premium">
                    <h5 class="modal-title fw-bold m-0" style="font-family: 'Poppins', sans-serif;"><i
                            class="fas fa-plus-circle me-2"></i> Tambah Alamat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('add.shipping.address') }}" id="add-address-form-null">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Label Alamat</label>
                                <input type="text" class="form-control form-control-modal" name="label"
                                    placeholder="Cth: Rumah, Kantor" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Nama Penerima</label>
                                <input type="text" class="form-control form-control-modal" name="recipient_name"
                                    placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Nomor Handphone</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>
                                    <input type="number" class="form-control form-control-modal" name="handphone"
                                        placeholder="8123456789" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Provinsi</label>
                                <select class="form-select form-control-modal" name="province" id="checkout_province"
                                    required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <input type="hidden" name="province_name" id="checkout_province_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Kota/Kabupaten</label>
                                <select class="form-select form-control-modal" name="regency" id="checkout_regency"
                                    required>
                                    <option value="">Pilih Kota/Kab</option>
                                </select>
                                <input type="hidden" name="regency_name" id="checkout_regency_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Kecamatan</label>
                                <select class="form-select form-control-modal" name="district" id="checkout_district"
                                    required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <input type="hidden" name="district_name" id="checkout_district_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Desa/Kelurahan</label>
                                <select class="form-select form-control-modal" name="subdistrict" id="checkout_subdistrict"
                                    required>
                                    <option value="">Pilih Desa</option>
                                </select>
                                <input type="hidden" name="subdistrict_name" id="checkout_subdistrict_name">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Alamat Lengkap</label>
                                <textarea class="form-control form-control-modal" name="address" rows="2"
                                    placeholder="Nama Jalan, Gedung, No. Rumah" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted fs-7 fw-bold text-uppercase">Patokan (Opsional)</label>
                                <input type="text" class="form-control form-control-modal" name="benchmark"
                                    placeholder="Cth: Samping minimarket">
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Simpan
                                    Alamat</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="promo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="background: var(--glamoire-light);">
                <div class="modal-header-premium">
                    <h5 class="modal-title fw-bold m-0" style="font-family: 'Poppins', sans-serif;"><i
                            class="fas fa-ticket-alt text-warning me-2"></i> Pilih Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3 custom-scroll">
                    @php
                        $brandIds = $data['cartItems']->pluck('brand_id');
                        $productIds = $data['cartItems']->pluck('product_id');
                        $voucherDisabled = $data['voucherDisabled'];

                        $usableVouchers = $data['vouchers']->filter(function ($voucher) use ($data, $brandIds, $productIds, $voucherDisabled) {
                            if ($voucherDisabled == false) {
                                if ($voucher->type == 'brand voucher') {
                                    return $productIds->intersect($data['brandVoucherIds'])->isNotEmpty() && $data['totalPrice'] >= $voucher->min_transaction && $data['totalItem'] <= $voucher->max_quantity_buyer;
                                } elseif ($voucher->type == 'product voucher') {
                                    return $productIds->intersect($data['productVoucherIds'])->isNotEmpty() && $data['totalPrice'] >= $voucher->min_transaction && $data['totalItem'] <= $voucher->max_quantity_buyer;
                                } else {
                                    return $data['totalPrice'] >= $voucher->min_transaction && $data['totalItem'] <= $voucher->max_quantity_buyer;
                                }
                            } else {
                                if ($voucher->type == 'ongkir voucher') {
                                    return $data['totalPrice'] >= $voucher->min_transaction && $data['totalItem'] <= $voucher->max_quantity_buyer;
                                }
                            }
                        });

                        $unusableVouchers = $data['vouchers']->filter(function ($voucher) use ($data, $brandIds, $productIds, $voucherDisabled) {
                            if ($voucher->type == 'brand voucher') {
                                return $voucherDisabled == true || $productIds->intersect($data['brandVoucherIds'])->isEmpty() || $data['totalPrice'] < $voucher->min_transaction || $data['totalItem'] > $voucher->max_quantity_buyer;
                            } elseif ($voucher->type == 'product voucher') {
                                return $voucherDisabled == true || $productIds->intersect($data['productVoucherIds'])->isEmpty() || $data['totalPrice'] < $voucher->min_transaction || $data['totalItem'] > $voucher->max_quantity_buyer;
                            } elseif ($voucher->type == 'ongkir voucher') {
                                return $data['totalPrice'] < $voucher->min_transaction || $data['totalItem'] > $voucher->max_quantity_buyer;
                            } else {
                                return $voucherDisabled == true || $data['totalPrice'] < $voucher->min_transaction || $data['totalItem'] > $voucher->max_quantity_buyer;
                            }
                        });
                    @endphp

                    @if (count($data['vouchers']) !== 0)
                        @if ($usableVouchers->isNotEmpty())
                            <h6 class="fw-bold text-dark mb-3 px-2">Voucher Tersedia Untukmu</h6>
                            @foreach ($usableVouchers as $voucher)
                                <div class="card border-0 shadow-sm mb-3 promo-item cursor-pointer"
                                    data-code="{{ $voucher->promo_code }}"
                                    onclick="selectPromo(this, '{{ $voucher->promo_code }}', '{{$voucher->type}}')">
                                    <div
                                        class="card-body p-3 position-relative grid border border-transparent rounded-3 transition-smooth">
                                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                            <span class="badge bg-dark">{{ ucwords($voucher->type) }}</span>
                                            <i class="fas fa-check-circle text-success fs-5 hidden"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark m-0">{{ ucwords($voucher->promo_name) }}</h6>

                                        @if ($voucher->discount)
                                            @if ($voucher->discount <= 100)
                                                <p class="text-danger fw-bold m-0 fs-5">Diskon {{ $voucher->discount }}%</p>
                                            @else
                                                <p class="text-danger fw-bold m-0 fs-5">Diskon
                                                    Rp{{ number_format($voucher->discount, 0, ',', '.') }}</p>
                                            @endif
                                        @endif

                                        <p class="text-muted fs-7 m-0 mt-1"><i class="far fa-clock"></i> Berlaku s/d
                                            {{ \Carbon\Carbon::parse(explode(' - ', $voucher->date_range)[1])->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @if ($unusableVouchers->isNotEmpty())
                            <h6 class="fw-bold text-muted mt-4 mb-3 px-2">Voucher Belum Memenuhi Syarat</h6>
                            @foreach ($unusableVouchers as $voucher)
                                <div class="card border-0 shadow-none mb-3 bg-white" style="opacity: 0.6;">
                                    <div class="card-body p-3">
                                        <span class="badge bg-secondary mb-2">{{ ucwords($voucher->type) }}</span>
                                        <h6 class="fw-bold text-dark m-0">{{ ucwords($voucher->promo_name) }}</h6>

                                        <ul class="text-danger fs-7 m-0 mt-2 pl-3">
                                            @if($voucher->type !== 'ongkir voucher' && $data['voucherDisabled'] == true)
                                                <li>Tidak bisa digabung dengan promo produk lain</li>
                                            @endif
                                            @if ($data['totalPrice'] < $voucher->min_transaction)
                                                <li>Kurang belanja
                                                    Rp{{ number_format($voucher->min_transaction - $data['totalPrice'], 0, ',', '.') }} lagi
                                                </li>
                                            @endif
                                            @if ($data['totalItem'] > $voucher->max_quantity_buyer)
                                                <li>Batas maksimal jumlah produk terlampaui</li>
                                            @endif
                                            @if ($voucher->type == 'brand voucher')
                                                <li>Khusus produk brand {{ $voucher->brand_name }}</li>
                                            @endif
                                            @if ($voucher->type == 'product voucher')
                                                <li>Tidak berlaku untuk produk di keranjang Anda</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="text-center py-5">
                            <img src="{{ asset('images/voucher-empty.png') }}"
                                style="max-width: 150px; opacity: 0.5; margin-bottom: 1rem;" alt="Voucher Kosong">
                            <p class="text-muted fw-bold">Belum ada voucher yang tersedia saat ini.</p>
                        </div>
                    @endif
                </div>

                @if (count($data['vouchers']) !== 0)
                    <div class="modal-footer border-0 bg-white" style="box-shadow: 0 -4px 15px rgba(0,0,0,0.05);">
                        <button type="button" class="btn btn-dark w-100 rounded-pill py-2 fw-bold" id="apply-selected-voucher"
                            data-bs-dismiss="modal">Gunakan Voucher</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('spinner')

    <script>
        // --- Inisialisasi Data ---
        let ongkir = null;
        let productItems = {!! json_encode($data['cartItems']) !!};
        let totalPrice = {{ $data['totalPrice'] }};
        let shippingAddressId = {{ $data['shippingAddressId'] ?? 'null' }};
        let totalItem = {{ $data['totalProduct'] }};
        let subTotal = 0;
        let courier = null;
        let description = null;
        let etd = null;

        let selectedPromoCode = null;
        let selectedOngkirCode = null;
        let discountAmount = 0;
        let shippingDiscount = 0;

        let formattedData = {};
        let destinationArea = {!! json_encode($data['destinationArea']) !!};
        let originArea = {!! json_encode($data['originArea']) !!};
        let destinationPostalCode = {!! json_encode($data['destinationPostalCode']) !!};

        productItems.forEach((product, index) => {
            formattedData[index] = {
                product_id: product.product_id,
                quantity: product.quantity,
                price: product.price,
                product_variant_id: product.product_variant_id || null
            };
        });

        // --- Format Rupiah ---
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(number);
        }

        // --- Update Tampilan Ongkir ---
        function updateOngkirDisplay() {
            if (ongkir !== null) {
                $("#ongkir-user").text("Rp" + formatRupiah(ongkir));

                // Hitung subtotal baru
                subTotal = totalPrice + ongkir - discountAmount - shippingDiscount;

                $("#total-shopping").text("Rp" + formatRupiah(subTotal));
                if ($('#totalPriceMobile').length) $('#totalPriceMobile').text("Rp" + formatRupiah(subTotal));

                // Tampilkan baris diskon ongkir jika ada
                if (shippingDiscount > 0) {
                    $("#ongkir").text("-Rp" + formatRupiah(shippingDiscount));
                    $("#ongkir-use").removeClass("d-none").addClass("d-flex");
                } else {
                    $("#ongkir-use").removeClass("d-flex").addClass("d-none");
                }
            } else {
                // Reset ke default jika ongkir null
                subTotal = totalPrice - discountAmount;
                $("#total-shopping").text("Rp" + formatRupiah(subTotal));
                if ($('#totalPriceMobile').length) $('#totalPriceMobile').text("Rp" + formatRupiah(subTotal));
            }

            // Tampilkan Teks Hore Hemat
            let totalSavings = discountAmount + shippingDiscount;
            if (totalSavings > 0) {
                $("#thrifty").text("Rp" + formatRupiah(totalSavings));
                $("#hore").removeClass("d-none").addClass("d-block");
            } else {
                $("#hore").removeClass("d-block").addClass("d-none");
            }
        }

        // --- Handle Pilihan Kurir ---
        $('#choose_shipping_fee').on('change', function () {
            const selectedService = $(this).val().trim();
            if (selectedService) {
                $.ajax({
                    url: '/buy-now',
                    type: 'GET',
                    data: { service: selectedService },
                    beforeSend: function () { $('.loading-container').show(); },
                    success: function (response) {
                        ongkir = response.ongkir;
                        courier = response.courier;
                        description = response.description;
                        etd = response.etd;

                        shippingDiscount = 0; // Reset sementara

                        // Aktifkan input manual voucher
                        $(".voucher-input-group").show();
                        $("#choose-voucher").text("Lihat Voucher Tersedia");

                        // Reset styling di modal voucher
                        $('.promo-item.ongkir-voucher').removeClass('selected').find('.border-dark').removeClass('border-dark');
                        $('.promo-item.ongkir-voucher .fa-check-circle').addClass('hidden');

                        updateOngkirDisplay();
                    },
                    complete: function () { $('.loading-container').hide(); },
                    error: function () { alert("Gagal mengambil data ongkir"); }
                });
            }
        });

        // Jalankan inisialisasi di awal jika kurir sudah terpilih default
        if ($('#choose_shipping_fee').val()) {
            $('#choose_shipping_fee').trigger('change');
        } else {
            updateOngkirDisplay(); // Hitung awal tanpa ongkir
        }

        // --- LOGIKA INPUT MANUAL VOUCHER ---
        $('#code-voucher').on('keyup', function () {
            var code = $(this).val().trim();
            if (code === "") {
                $('#validationVoucher').hide();
                $('#button-code-voucher').prop('disabled', true);
            } else {
                // Tampilkan tombol cancel (X)
                $('#cancelCode').show();
                $('#button-code-voucher').prop('disabled', false);
            }
        });

        function removeCode() {
            $('#code-voucher').val('').prop('disabled', false);
            $('#cancelCode').hide();
            $('#validationVoucher').hide();
            $('#button-code-voucher').text('Pakai').prop('disabled', true);
            $('#show-voucher').prop('disabled', false);
            $("#choose-voucher").text("Lihat Voucher Tersedia");

            discountAmount = 0;
            selectedPromoCode = null;

            // Deselect di dalam modal
            $('.promo-item:not(.ongkir-voucher)').removeClass('selected').find('.border-dark').removeClass('border-dark');
            $('.promo-item:not(.ongkir-voucher) .fa-check-circle').addClass('hidden');

            $("#discount-use").removeClass("d-flex").addClass("d-none");

            updateOngkirDisplay();
        }

        $('#button-code-voucher').on('click', function (e) {
            e.preventDefault();
            var voucherCode = $("#code-voucher").val().trim();
            if (!voucherCode) return;

            var btn = $(this);
            var spinner = $("#voucher-spinner");

            btn.text('').prop('disabled', true);
            spinner.show();

            $.ajax({
                url: "{{ route('apply.voucher.buy.now') }}",
                method: 'POST',
                data: { _token: '{{ csrf_token() }}', code_voucher: voucherCode },
                success: function (response) {
                    spinner.hide();
                    if (response.success) {
                        btn.text('Dipakai');
                        $('#code-voucher').prop('disabled', true);
                        $('#validationVoucher').text("Voucher berhasil diterapkan!").removeClass('text-danger').addClass('text-success').show();
                        $('#show-voucher').prop('disabled', true); // Matikan tombol browse modal

                        discountAmount = response.discountFormatted;
                        selectedPromoCode = voucherCode;

                        $("#discount").text("-Rp" + formatRupiah(discountAmount));
                        $("#discount-use").removeClass("d-none").addClass("d-flex");

                        updateOngkirDisplay();
                    } else {
                        btn.text('Pakai').prop('disabled', false);
                        $('#validationVoucher').text(response.message).removeClass('text-success').addClass('text-danger').show();
                    }
                },
                error: function () {
                    spinner.hide();
                    btn.text('Pakai').prop('disabled', false);
                    $('#validationVoucher').text('Terjadi kesalahan server.').removeClass('text-success').addClass('text-danger').show();
                }
            });
        });

        // --- LOGIKA KLIK VOUCHER DI MODAL ---
        function selectPromo(promoElement, promo_code, voucherType) {
            const isOngkirType = voucherType === 'ongkir voucher';
            let isCurrentlySelected = promoElement.classList.contains('selected');

            // Batal pilih jika di-klik lagi
            if (isCurrentlySelected) {
                promoElement.classList.remove('selected');
                promoElement.querySelector('.grid').classList.remove('border-dark');
                promoElement.querySelector('.fa-check-circle').classList.add('hidden');

                if (isOngkirType) {
                    selectedOngkirCode = null;
                    shippingDiscount = 0;
                } else {
                    selectedPromoCode = null;
                    discountAmount = 0;
                    removeCode(); // Reset input luar
                }
            } else {
                // Bersihkan pilihan sebelumnya di kategori yang sama
                let selectorClass = isOngkirType ? '.promo-item.ongkir-voucher' : '.promo-item:not(.ongkir-voucher)';
                document.querySelectorAll(selectorClass).forEach(el => {
                    el.classList.remove('selected');
                    el.querySelector('.grid').classList.remove('border-dark');
                    el.querySelector('.fa-check-circle').classList.add('hidden');
                });

                // Pilih yang baru
                promoElement.classList.add('selected');
                promoElement.querySelector('.grid').classList.add('border', 'border-dark');
                promoElement.querySelector('.fa-check-circle').classList.remove('hidden');

                if (isOngkirType) {
                    selectedOngkirCode = promo_code;
                } else {
                    selectedPromoCode = promo_code;
                    // Update input luar
                    $('#code-voucher').val(promo_code).prop('disabled', true);
                    $('#cancelCode').show();
                    $('#button-code-voucher').text('Dipakai').prop('disabled', true);
                    $('#validationVoucher').hide();
                    $("#choose-voucher").text("Voucher Terpasang");
                }
            }

            // Tembak AJAX untuk verifikasi validitas voucher gabungan
            $.ajax({
                url: "{{ route('check.apply.voucher.buy.now') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    code_voucher_promo: selectedPromoCode,
                    code_voucher_ongkir: selectedOngkirCode,
                    shipping_cost: ongkir || 0,
                },
                beforeSend: function () { $('.loading-container').show(); },
                success: function (response) {
                    if (response.success) {
                        // Update diskon dari server
                        if (response.discount) discountAmount = parseInt(response.discount.replace(/\./g, ''), 10);
                        if (response.ongkir) shippingDiscount = parseInt(response.ongkir.replace(/\./g, ''), 10);

                        if (discountAmount > 0) {
                            $("#discount").text("-Rp" + formatRupiah(discountAmount));
                            $("#discount-use").removeClass("d-none").addClass("d-flex");
                        }
                        updateOngkirDisplay();
                    } else {
                        // Jika gagal, revert UI modal
                        promoElement.classList.remove('selected');
                        promoElement.querySelector('.grid').classList.remove('border-dark');
                        promoElement.querySelector('.fa-check-circle').classList.add('hidden');
                        if (isOngkirType) selectedOngkirCode = null; else { selectedPromoCode = null; removeCode(); }

                        Swal.fire({ icon: 'error', title: 'Oops', text: response.message, confirmButtonColor: '#183018' });
                    }
                },
                complete: function () { $('.loading-container').hide(); }
            });
        }

        // --- CHECKOUT ACTION (TOMBOL BAYAR) ---
        function checkoutAction() {
            // VALIDASI: Cek apakah user sudah mengisi alamat pengiriman
            if (shippingAddressId == null) {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Silakan isi/pilih alamat pengiriman terlebih dahulu.', confirmButtonColor: '#183018' });
                return;
            }

            // VALIDASI: Cek apakah user sudah memilih kurir pengiriman
            if (ongkir == null) {
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Silakan pilih jasa pengiriman terlebih dahulu.', confirmButtonColor: '#183018' });
                return;
            }

            // Jika lolos validasi, ubah tombol jadi loading
            $('#paynow, #paynowmobile').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

            $.ajax({
                url: '/payment/submit',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    total_amount: subTotal,
                    products: formattedData,
                    subtotal: subTotal,
                    shipping_cost: ongkir,
                    shipping_address_id: shippingAddressId,
                    total_item: totalItem,
                    total_item_price: totalPrice,
                    discount_amount: discountAmount,
                    discount_ongkir: shippingDiscount,
                    voucher_promo: selectedPromoCode,
                    voucher_ongkir: selectedOngkirCode,
                    condition: "buynow", // INI YANG MEMBEDAKAN DENGAN CHECKOUT BIASA
                    destinationArea: destinationArea,
                    originArea: originArea,
                    courier: courier,
                    etd: etd,
                    description: description,
                    destinationPostalCode: destinationPostalCode,
                },
                success: function (response) {
                    if (response.success && response.payment_url) {
                        window.location.href = response.payment_url;
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'URL Pembayaran tidak valid.' });
                        $('#paynow, #paynowmobile').prop('disabled', false).html('<i class="fas fa-lock"></i> Bayar Sekarang');
                    }
                },
                error: function (xhr) {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Kesalahan memproses pesanan.' });
                    $('#paynow, #paynowmobile').prop('disabled', false).html('<i class="fas fa-lock"></i> Bayar Sekarang');
                }
            });
        }

        // Modal Add Address Logic
        $('#open-add-address-modal').on('click', function () {
            setTimeout(function () {
                var addModal = new bootstrap.Modal(document.getElementById('form-address-new'));
                addModal.show();
            }, 500);
        });

        // Use Address logic
        $(document).on('click', 'button[name="useAddress"]', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('use.shipping.address') }}",
                type: 'POST',
                data: { address_id: id, _token: '{{ csrf_token() }}' },
                beforeSend: function () { $('.loading-container').show(); },
                success: function () { location.reload(); }
            });
        });

        // Initial check for Address Modal on empty
        @if(count($data['address']) == 0)
            $(document).ready(function () {
                var myModal = new bootstrap.Modal(document.getElementById('form-address-new'), { backdrop: 'static', keyboard: false });
                myModal.show();
            });
        @endif
    </script>

    <script>
        // Include API Wilayah Script here (Same as original code)
        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then((response) => response.json())
            .then((provinces) => {
                const provinceSelect = document.getElementById("add_checkout_province");
                if (provinceSelect) {
                    provinces.forEach((province) => {
                        let option = document.createElement("option");
                        option.value = province.id;
                        option.text = province.name;
                        provinceSelect.appendChild(option);
                    });
                }
            });

        document.addEventListener('change', function (e) {
            if (e.target && e.target.id === 'add_checkout_province') {
                const provinceId = e.target.value;
                document.getElementById("add_checkout_province_name").value = e.target.options[e.target.selectedIndex].text;
                const regencySelect = document.getElementById("add_checkout_regency");
                regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                document.getElementById("add_checkout_district").innerHTML = '<option value="">Pilih Kecamatan</option>';
                document.getElementById("add_checkout_subdistrict").innerHTML = '<option value="">Pilih Desa</option>';

                if (provinceId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                        .then(res => res.json())
                        .then(regencies => {
                            regencies.forEach(regency => {
                                let option = document.createElement("option");
                                option.value = regency.id; option.text = regency.name;
                                regencySelect.appendChild(option);
                            });
                        });
                }
            } else if (e.target && e.target.id === 'add_checkout_regency') {
                const regencyId = e.target.value;
                document.getElementById("add_checkout_regency_name").value = e.target.options[e.target.selectedIndex].text;
                const distSelect = document.getElementById("add_checkout_district");
                distSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                document.getElementById("add_checkout_subdistrict").innerHTML = '<option value="">Pilih Desa</option>';
                if (regencyId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`)
                        .then(res => res.json())
                        .then(districts => {
                            districts.forEach(dist => {
                                let option = document.createElement("option");
                                option.value = dist.id; option.text = dist.name;
                                distSelect.appendChild(option);
                            });
                        });
                }
            } else if (e.target && e.target.id === 'add_checkout_district') {
                const distId = e.target.value;
                document.getElementById("add_checkout_district_name").value = e.target.options[e.target.selectedIndex].text;
                const subSelect = document.getElementById("add_checkout_subdistrict");
                subSelect.innerHTML = '<option value="">Pilih Desa</option>';
                if (distId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${distId}.json`)
                        .then(res => res.json())
                        .then(subs => {
                            subs.forEach(sub => {
                                let option = document.createElement("option");
                                option.value = sub.id; option.text = sub.name;
                                subSelect.appendChild(option);
                            });
                        });
                }
            } else if (e.target && e.target.id === 'add_checkout_subdistrict') {
                document.getElementById("add_checkout_subdistrict_name").value = e.target.options[e.target.selectedIndex].text;
            }
        });
    </script>

@endsection
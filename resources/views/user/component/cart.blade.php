@extends('user.layouts.master')

@section('content')
    <style>
        /* ==========================================
           WORLD CLASS SHOPPING CART STYLING
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

        /* --- Page Title --- */
        .page-title {
            font-family: 'The Seasons', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 2rem;
        }

        /* --- Layout Wrappers --- */
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: flex-start;
            margin-bottom: 5rem;
        }

        .cart-items-section {
            flex: 1 1 65%;
            background: #FFF;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        .cart-summary-section {
            flex: 0 0 350px;
            background: #FFF;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            position: sticky;
            top: 100px;
        }

        @media (max-width: 991px) {
            .cart-container {
                flex-direction: column;
            }

            .cart-items-section,
            .cart-summary-section {
                flex: 1 1 100%;
                width: 100%;
            }

            .cart-summary-section {
                position: static;
                display: none;
                /* Disembunyikan di mobile, diganti fixed bottom */
            }
        }

        /* --- Custom Checkbox --- */
        .modern-checkbox {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            font-size: 0.95rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .modern-checkbox input {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #CBD5E1;
            border-radius: 6px;
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
            font-size: 11px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* --- Cart Header Actions --- */
        .cart-header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--glamoire-light);
        }

        .btn-delete-all {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete-all:hover {
            color: var(--danger-main);
        }

        /* --- Cart Item Row --- */
        .cart-item {
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition-smooth);
        }

        .cart-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .cart-item.out-of-stock {
            opacity: 0.6;
            background-color: #FAFAFA;
            border-radius: 12px;
            padding: 1.5rem;
        }

        .item-select-col {
            display: flex;
            align-items: center;
        }

        .item-image-col {
            flex: 0 0 100px;
        }

        .item-img-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            cursor: pointer;
        }

        .item-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .item-img-wrapper:hover img {
            transform: scale(1.05);
        }

        .item-details-col {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .item-brand {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .item-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.2rem;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s;
        }

        .item-name:hover {
            color: var(--glamoire-dark);
        }

        .item-variant {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            background: var(--glamoire-light);
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            width: fit-content;
            border: 1px solid var(--border-color);
        }

        .item-price-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 0.5rem;
        }

        .price-strike {
            font-size: 0.85rem;
            color: #9CA3AF;
            text-decoration: line-through;
        }

        .price-current {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--glamoire-dark);
        }

        .promo-tier-text {
            font-size: 0.75rem;
            color: var(--danger-main);
            background: #FEE2E2;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            width: fit-content;
        }

        .item-actions-col {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 1rem;
        }

        /* Modern Qty Selector */
        .qty-selector {
            display: flex;
            align-items: center;
            background: var(--glamoire-light);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 0.2rem;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
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

        .qty-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-input {
            width: 35px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            color: var(--text-main);
            font-size: 0.9rem;
        }

        .qty-input:focus {
            outline: none;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .btn-remove-item {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.1rem;
            cursor: pointer;
            transition: color 0.2s;
            padding: 5px;
        }

        .btn-remove-item:hover {
            color: var(--danger-main);
        }

        /* --- Summary Section --- */
        .summary-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 1rem;
            color: var(--text-muted);
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px dashed var(--border-color);
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--glamoire-dark);
        }

        .btn-checkout {
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
        }

        .btn-checkout:hover:not(:disabled) {
            background: var(--glamoire-accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(24, 48, 24, 0.15);
        }

        .btn-checkout:disabled {
            background: #D1D5DB;
            cursor: not-allowed;
            color: #9CA3AF;
        }

        /* Empty State */
        .empty-state-box {
            text-align: center;
            padding: 4rem 1rem;
            background: #FFF;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .empty-state-box img {
            max-width: 180px;
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        .empty-state-box h4 {
            font-family: 'The Seasons', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state-box p {
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .btn-shop-now {
            display: inline-block;
            background: var(--glamoire-dark);
            color: #FFF;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .btn-shop-now:hover {
            background: var(--glamoire-gold);
            color: #FFF;
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

            .cart-item {
                flex-wrap: wrap;
            }

            .item-details-col {
                flex: 1 1 100%;
            }

            .item-actions-col {
                width: 100%;
                justify-content: space-between;
                border-top: 1px dashed var(--border-color);
                margin-top: 0.5rem;
            }
        }
    </style>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4">

        <div class="container-fluid">
            <div class="premium-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                <span>/</span>
                <span class="active-page">Keranjang Belanja</span>
            </div>
        </div>

        <div class="container-fluid">
            <h1 class="page-title">Keranjang Belanja</h1>

            @if (count($data) !== 0)
                <div class="cart-container">

                    <div class="cart-items-section">

                        <div class="cart-header-actions">
                            <label class="modern-checkbox">
                                <input type="checkbox" id="select-all" onclick="toggleCheckboxes(this)"
                                    onchange="toggleSelectAll()">
                                Pilih Semua Barang
                            </label>
                            <button class="btn-delete-all" name="delete-all-product-cart">
                                <i class="far fa-trash-alt"></i> Hapus Terpilih
                            </button>
                        </div>

                        @foreach ($data as $product)
                            @php
                                $isVariant = $product->product_variant_id !== NULL;
                                $stock = $isVariant ? $product->productVariant->variant_stock : $product->product->stock_quantity;
                                $isOutOfStock = $stock == 0;
                                $image = $isVariant ? ($product->productVariant->variant_image ?? $product->product->main_image) : $product->product->main_image;
                                $price = $isVariant ? $product->productVariant->variant_price : $product->product->regular_price; // Base price for display
                                $sku = $isVariant ? $product->productVariant->sku : null;
                                $productCode = $product->product->product_code;

                                // Promo checking logic
                                $activePromo = $product->product->promos->first();
                                $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                            @endphp

                            <div class="cart-item {{ $isOutOfStock ? 'out-of-stock' : '' }}">

                                <div class="item-select-col">
                                    @if (!$isOutOfStock)
                                        <label class="modern-checkbox">
                                            <input class="item-checkbox" type="checkbox"
                                                id="produk_{{ $isVariant ? $product->product_variant_id : $product->product_id }}"
                                                data-type="{{ $isVariant ? 'variant' : 'product' }}" data-price="{{ $product->price }}"
                                                onchange="calculateTotal()" {{ $product->is_choose ? 'checked' : '' }}>
                                        </label>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </div>

                                <div class="item-image-col">
                                    <div class="item-img-wrapper"
                                        onclick="window.location.href='/{{ $productCode }}_product{{ $sku ? '?varian=' . $sku : '' }}'">
                                        <img src="{{ Storage::url($image) }}" alt="Produk">
                                    </div>
                                </div>

                                <div class="item-details-col">
                                    <div class="item-brand">{{ $product->product->brand->name ?? 'Glamoire' }}</div>
                                    <a href="/{{ $productCode }}_product{{ $sku ? '?varian=' . $sku : '' }}" class="item-name">
                                        {{ $product->product->product_name }}
                                    </a>

                                    @if ($isVariant)
                                        <div class="item-variant">{{ $product->productVariant->variant_value }}</div>
                                    @endif

                                    <div class="item-price-row">
                                        @if ($discountedPrice && $discountedPrice < $product->product->regular_price && !$isVariant)
                                            <span
                                                class="price-strike">Rp{{ number_format($product->product->regular_price, 0, ',', '.') }}</span>
                                            <span class="price-current">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                        @else
                                            <span class="price-current">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>

                                    @if ($product->all_discount_tiers)
                                        <div class="promo-tier-text mt-1">{!! $product->all_discount_tiers !!}</div>
                                    @endif

                                    <div class="item-actions-col">
                                        @if (!$isOutOfStock)
                                            <div class="qty-selector">
                                                <button class="qty-btn btn-minus"
                                                    data-id="{{ $isVariant ? $product->product_variant_id : $product->product_id }}"
                                                    data-type="{{ $isVariant ? 'variant' : 'product' }}">
                                                    <i class="fas fa-minus" style="font-size: 0.6rem;"></i>
                                                </button>
                                                <input type="number" class="qty-input"
                                                    id="product-quantity-{{ $isVariant ? $product->product_variant_id : $product->product_id }}"
                                                    value="{{ $product->quantity }}" min="1" max="{{ $stock }}"
                                                    data-type="{{ $isVariant ? 'variant' : 'product' }}">
                                                <button class="qty-btn btn-plus"
                                                    data-id="{{ $isVariant ? $product->product_variant_id : $product->product_id }}"
                                                    data-type="{{ $isVariant ? 'variant' : 'product' }}" data-max="{{ $stock }}">
                                                    <i class="fas fa-plus" style="font-size: 0.6rem;"></i>
                                                </button>
                                            </div>
                                        @else
                                            <div class="text-danger fw-bold fs-7">Produk ini sudah habis</div>
                                        @endif

                                        <button class="btn-remove-item" name="delete-product-cart"
                                            data-type="{{ $isVariant ? 'variant' : 'product' }}"
                                            data-id="{{ $isVariant ? $product->product_variant_id : $product->product_id }}"
                                            title="Hapus item">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <span
                                        id="quantity-warning-{{ $isVariant ? $product->product_variant_id : $product->product_id }}"
                                        class="text-danger fs-7 mt-1" style="display: none;">Batas maksimal stok tercapai.</span>
                                </div>

                            </div>
                        @endforeach

                    </div>

                    <div class="cart-summary-section">
                        <h3 class="summary-title">Ringkasan Belanja</h3>
                        <div class="summary-row">
                            <span>Total Harga (<span id="summary-count">0</span> barang)</span>
                        </div>
                        <div class="summary-total">
                            <span>Total Tagihan</span>
                            <span id="totalPrice">Rp0</span>
                        </div>
                        <button class="btn-checkout" id="paynow" onclick="checkout()" disabled>
                            Beli Sekarang
                        </button>
                        <p class="text-muted fs-7 text-center mt-3 mb-0"><i class="fas fa-shield-alt me-1"></i> Transaksi Anda
                            aman dan terenkripsi.</p>
                    </div>

                </div>
            @else
                <div class="empty-state-box mb-5">
                    <img src="{{ asset('images/cart-empty.png') }}" alt="Keranjang Kosong">
                    <h4>Keranjang Belanjamu Kosong</h4>
                    <p>Belum ada produk yang kamu masukkan. Yuk, eksplorasi produk kecantikan terbaik kami!</p>
                    <a href="/shop" class="btn-shop-now">Mulai Belanja</a>
                </div>
            @endif
        </div>

        @if (count($data) !== 0)
            <div class="mobile-checkout-bar">
                <div>
                    <span class="text-muted fs-7 d-block">Total Tagihan</span>
                    <span id="totalPriceMobile" class="fw-bold text-dark" style="font-size: 1.25rem;">Rp0</span>
                </div>
                <button class="btn-checkout m-0 w-auto px-4" id="paynowmobile" onclick="checkout()" disabled>
                    Beli Sekarang
                </button>
            </div>
        @endif
    </div>

    <script>
        // Logic untuk redirect ke halaman checkout
        function checkout() {
            window.location.href = '/checkout';
        }

        function detailProduct(productCode) { window.location.href = "/" + productCode + "_product"; }
        function detailProductVariant(productCode, productVariantSku) { window.location.href = "/" + productCode + "_product?varian=" + productVariantSku; }

        // Format Rupiah
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number).replace('Rp', 'Rp ').replace(',00', '');
        }

        // HITUNG TOTAL BELANJA DI CLIENT SIDE
        function calculateTotal() {
            let total = 0;
            let count = 0;
            let hasSelectedProduct = false;

            $('.item-checkbox:checked').each(function () {
                let idAttr = $(this).attr('id').split('_')[1]; // ID unik (Bisa ID produk atau ID varian)
                let quantity = parseInt($('#product-quantity-' + idAttr).val()) || 1;
                let price = parseFloat($(this).data('price')) || 0;

                total += price * quantity;
                count += quantity;
                hasSelectedProduct = true;
            });

            // Update UI Text
            $('#totalPrice').text(formatRupiah(total));
            if ($('#totalPriceMobile').length) $('#totalPriceMobile').text(formatRupiah(total));
            $('#summary-count').text(count);

            // Enable/Disable Checkout Button
            if (hasSelectedProduct) {
                $('#paynow').removeAttr('disabled');
                if ($('#paynowmobile').length) $('#paynowmobile').removeAttr('disabled');
            } else {
                $('#paynow').attr('disabled', 'disabled');
                if ($('#paynowmobile').length) $('#paynowmobile').attr('disabled', 'disabled');
            }

            // Cek status Check All
            let totalCheckboxes = $('.item-checkbox').length;
            let checkedCheckboxes = $('.item-checkbox:checked').length;
            if (totalCheckboxes > 0 && totalCheckboxes === checkedCheckboxes) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        }

        // CHECKBOX SELECT ALL
        function toggleCheckboxes(source) {
            $('.item-checkbox').prop('checked', source.checked);
            calculateTotal();
        }

        function toggleSelectAll() {
            let isChecked = $('#select-all').is(':checked') ? 1 : 0;

            // Panggil AJAX untuk simpan state "Pilih Semua" ke database
            $.ajax({
                url: "{{ route('choose.product.cart') }}",
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', select_all: true, is_choose: isChecked },
                error: function (xhr) { console.log(xhr.responseText); }
            });
        }

        $(document).ready(function () {

            // Initial Calculation saat halaman dimuat
            calculateTotal();

            // Handle Checkbox Individu Change -> Save to DB via AJAX
            $(document).on('change', '.item-checkbox', function () {
                let type = $(this).data('type');
                let id = $(this).attr('id').split('_')[1];
                let isChecked = $(this).is(':checked') ? 1 : 0;
                let urlRoute = type === 'variant' ? "{{ route('choose.product.variant.cart') }}" : "{{ route('choose.product.cart') }}";

                let ajaxData = { _token: '{{ csrf_token() }}', is_choose: isChecked };
                if (type === 'variant') { ajaxData.product_variant_id = id; }
                else { ajaxData.product_id = id; }

                $.ajax({
                    url: urlRoute, type: 'POST', data: ajaxData,
                    error: function (xhr) { console.log(xhr.responseText); }
                });
                calculateTotal();
            });

            // HANDLE QUANTITY (PLUS, MINUS, INPUT)
            function updateQuantityAJAX(id, type, newQty) {
                let urlRoute = type === 'variant' ? "{{ route('update.cart.quantity.variant') }}" : "{{ route('update.cart.quantity') }}";
                let ajaxData = { _token: '{{ csrf_token() }}', quantity: newQty };
                if (type === 'variant') { ajaxData.product_variant_id = id; }
                else { ajaxData.product_id = id; }

                $.ajax({
                    url: urlRoute, type: 'POST', data: ajaxData,
                    error: function (xhr) { console.log("Gagal update qty ke server."); }
                });
            }

            // Tombol Minus
            $(document).on('click', '.btn-minus', function () {
                let id = $(this).data('id');
                let type = $(this).data('type');
                let inputEl = $('#product-quantity-' + id);
                let warnEl = $('#quantity-warning-' + id);

                let currentQty = parseInt(inputEl.val());
                if (currentQty > 1) {
                    let newQty = currentQty - 1;
                    inputEl.val(newQty);
                    warnEl.hide();
                    updateQuantityAJAX(id, type, newQty);
                    calculateTotal();
                }
            });

            // Tombol Plus
            $(document).on('click', '.btn-plus', function () {
                let id = $(this).data('id');
                let type = $(this).data('type');
                let max = parseInt($(this).data('max'));
                let inputEl = $('#product-quantity-' + id);
                let warnEl = $('#quantity-warning-' + id);

                let currentQty = parseInt(inputEl.val());
                if (currentQty < max) {
                    let newQty = currentQty + 1;
                    inputEl.val(newQty);
                    warnEl.hide();
                    updateQuantityAJAX(id, type, newQty);
                    calculateTotal();
                } else {
                    warnEl.show();
                }
            });

            // Manual Input (Ketik angka)
            $(document).on('input blur', '.qty-input', function (e) {
                let id = $(this).attr('id').split('-').pop();
                let type = $(this).data('type');
                let max = parseInt($(this).attr('max'));
                let warnEl = $('#quantity-warning-' + id);

                let val = parseInt($(this).val());

                if (isNaN(val) || val < 1) {
                    if (e.type === 'blur') { $(this).val(1); updateQuantityAJAX(id, type, 1); calculateTotal(); }
                    warnEl.hide();
                } else if (val > max) {
                    $(this).val(max);
                    warnEl.show();
                    updateQuantityAJAX(id, type, max);
                    calculateTotal();
                } else {
                    warnEl.hide();
                    if (e.type === 'blur') { updateQuantityAJAX(id, type, val); calculateTotal(); }
                }
            });

            // HANDLE HAPUS PRODUK
            $(document).on('click', 'button[name="delete-product-cart"]', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let type = $(this).data('type');
                let urlRoute = type === 'variant' ? "{{ route('delete.product.variant.cart') }}" : "{{ route('delete.product.cart') }}";
                let ajaxData = { _token: '{{ csrf_token() }}' };
                if (type === 'variant') { ajaxData.product_variant_id = id; }
                else { ajaxData.product_id = id; }

                Swal.fire({
                    title: 'Hapus Item?', text: "Produk ini akan dihapus dari keranjang Anda.", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#DC2626', cancelButtonColor: '#6B7280', confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: urlRoute, type: 'POST', data: ajaxData,
                            success: function (response) { location.reload(); }
                        });
                    }
                });
            });

            // HANDLE HAPUS SEMUA (PILIHAN)
            $(document).on('click', 'button[name="delete-all-product-cart"]', function (e) {
                e.preventDefault();
                let checkedItems = $('.item-checkbox:checked').length;
                if (checkedItems === 0) {
                    Swal.fire({ icon: 'info', title: 'Pilih Item', text: 'Silakan centang produk yang ingin dihapus terlebih dahulu.', confirmButtonColor: '#183018' });
                    return;
                }

                Swal.fire({
                    title: 'Hapus Item Terpilih?', text: "Semua produk yang dicentang akan dihapus.", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#DC2626', cancelButtonColor: '#6B7280', confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.all.product.cart') }}", type: 'POST', data: { _token: '{{ csrf_token() }}' },
                            success: function (response) { location.reload(); }
                        });
                    }
                });
            });

        });
    </script>

@endsection
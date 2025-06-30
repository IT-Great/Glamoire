@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 mb-12 mb-md-0 py-2">
    <div class="container-fluid px-0 px-md-3">
        <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
            <div class="d-flex gap-1 pl-3">
                <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Keranjang</a>
            </div>
        </div>
    </div>

    <div class="row gap-2 gap-md-0 m-0 p-0 mb-2">
        @if (count($data) !== 0)
            <div class="col-lg-9 grid gap-2 px-0 px-md-3">
                <div class="container border border-[#183018] rounded shadow-md">
                    <div class="flex justify-between items-center py-2 py-md-3 border-bottom border-[#183018]">
                        <!-- Pilih Semua -->
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                value="" 
                                id="select-all" 
                                onclick="toggleCheckboxes(this)" 
                                onchange="toggleSelectAll()"
                            >
                            <label 
                                class="form-check-label text-[10px] text-black md:text-[12px] lg:text-[14px] xl:text-[16px]" 
                                for="select-all"
                            >
                                Pilih Semua
                            </label>
                        </div>
                    
                        <!-- Hapus Semua -->
                        <button 
                            class="btn btn-delete" 
                            name="delete-all-product-cart" 
                            title="Hapus semua produk terpilih dari keranjang" 
                            style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                        > 
                            <i class="fas fa-trash text-[10px] text-black md:text-[12px] lg:text-[14px] xl:text-[16px]"></i>
                        </button>
                    </div>
                    
        
                    @foreach ($data as $product)

                        {{-- TAMPILKAN PRODUCT VARIAN --}}
                        @if($product->product_variant_id !== NULL)
                            <div class="form-check grid border-bottom border-[#183018] py-2 py-md-3 {{ $product->productVariant->variant_stock == 0 ? 'bg-secondary' : ''}}">
                                <div class="d-flex">
                                    <div class="col-lg-2 col-md-4 col-4 pl-1">
                                        @if ($product->productVariant->variant_stock > 0)
                                        <input class="form-check-input item-checkbox" type="checkbox" value="{{ $product->total }}" id="produk_{{$product->product_variant_id}}" data-type="variant"  data-price="{{ $product->price }}" onchange="calculateTotal()" {{ $product->is_choose == TRUE ? "checked" : "" }}>
                                        @else
                                        @endif
                                        <img src="{{ Storage::url($product->productVariant->variant_image) }}" alt="{{$product->product->product_name}}" class="img-fluid w-100 border border-[#183018] rounded-sm">
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-8 p-0 p-md-2 d-flex flex-column">
                                        @if ($product->productVariant->variant_stock == 0)
                                        <p class="text-danger font-semibold text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] hover:cursor-pointer">
                                            Stok Habis
                                        </p>
                                        @endif
                                        <p class="hover:cursor-pointer text-[8px] text-black md:text-[10px] lg:text-[10px] xl:text-[12px] {{ $product->productVariant->variant_stock == 0 ? 'text-primary' : ''}}" onclick="detailProductVariant('{{ $product->product->product_code }}', '{{$product->productVariant->sku}}')">{{ $product->product->product_name }}</p>
                                        <a class="w-fit bg-[#183018] text-white p-1 rounded-sm text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px] text-center">
                                            {{ $product->productVariant->variant_value }}
                                        </a>
                                        
                                        @php
                                            $activePromo = $product->product->promos->first();
                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                        @endphp

                                                <div class="flex gap-1">

                                                    <p
                                                        class="text-decoration-none  text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">
                                                        Rp{{ number_format($product->productVariant->variant_price, 0, ',', '.') }}
                                                    </p>

                                                </div>

                                                <div class="flex gap-1">

                                                    <p
                                                        class="text-decoration-none  text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">
                                                        {!! $product->all_discount_tiers !!}
                                                    </p>

                                                </div>

                                                <!-- BUTTON PLUS & MINUS & DELETE -->
                                                <div class="flex mt-auto bottom">
                                                    <div class="flex ml-auto">
                                                        <button class="btn btn-delete" name="delete-product-cart"
                                                            title="Hapus produk dari keranjang"
                                                            style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                                                            data-type="variant"
                                                            data-id="{{ $product->product_variant_id }}">
                                                            <i
                                                                class="fas fa-trash text-[10px] text-black md:text-[12px] lg:text-[14px] xl:text-[16px]"></i>
                                                        </button>

                                                        @if ($product->productVariant->variant_stock == 0)
                                                            <button
                                                                class="btn btn-danger text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] rounded-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Beritahu Saya Jika Stok Sudah Ada" type="button"
                                                                id="notify-me-{{ $product->productVariant->id }}"
                                                                onclick="notifyMe({{ $product->productVariant->id }})">
                                                                Beritahu Saya
                                                            </button>
                                                        @else
                                                            <div class="input-group quantity-detail-produk-variant rounded-sm shadow-sm"
                                                                style="width: 120px;">
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-minus-variant"
                                                                        data-id="{{ $product->product_variant_id }}"
                                                                        data-quantity="{{ $product->productVariant->variant_stock }}"
                                                                        style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                                                                        id="minus-btn-product-cart-variant-{{ $product->product_variant_id }}">
                                                                        <i class="fa fa-minus text-xs"></i>
                                                                    </button>
                                                                </div>

                                                                <input type="number"
                                                                    id="product-quantity-{{ $product->product_variant_id }}"
                                                                    value="{{ $product->quantity }}"
                                                                    name=""
                                                                    class="text-xs form-control bg-secondary text-center no-spinner"
                                                                    min="1"
                                                                    max="{{ $product->productVariant->variant_stock }}"
                                                                    oninput="validateInput(this, {{ $product->productVariant->variant_stock }})">

                                                    <div class="input-group-btn">
                                                        <button class="btn btn-plus-variant" data-id="{{$product->product_variant_id}}" data-quantity="{{$product->productVariant->variant_stock}}" style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;" id="plus-btn-product-cart-variant-{{$product->product_variant_id}}">
                                                            <i class="fa fa-plus text-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endif
                                            </total_product_variantdiv>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- TAMPILKAN PRODUCT SAJA --}}
                        @else
                            <div class="form-check grid border-bottom border-[#183018] py-2 py-md-3 {{ $product->product->stock_quantity == 0 ? 'bg-secondary' : ''}}">
                                <div class="d-flex">
                                    <div class="col-lg-2 col-md-4 col-4 pl-1">
                                        @if ($product->product->stock_quantity > 0)
                                        <input class="form-check-input item-checkbox" type="checkbox" value="{{ $product->total }}" id="produk_{{ $product->product_id }}" data-type="product"  data-price="{{ $product->price }}" onchange="calculateTotal()" {{ $product->is_choose == TRUE ? "checked" : "" }}>
                                        @else
                                        @endif
                                        <img src="{{ Storage::url($product->product->main_image) }}" alt="nama produk" class="img-fluid w-100 border border-[#183018] rounded-sm">
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-8 p-0 p-md-2 d-flex flex-column">
                                        @if ($product->product->stock_quantity == 0)
                                        <p class="text-danger font-semibold text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] hover:cursor-pointer">
                                            Stok Habis
                                        </p>
                                        @endif
                                        <p class="hover:cursor-pointer text-[8px] text-black md:text-[12px] lg:text-[12px] xl:text-[14px] {{ $product->product->stock_quantity == 0 ? 'text-primary' : ''}}" onclick="detailProduct('{{ $product->product->product_code }}')">{{ $product->product->product_name }}</p>
                                        @php
                                            $activePromo = $product->product->promos->first(); // Mengambil promo pertama yang aktif
                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                        
                                            // Mengambil produk terkait dari promo tier
                                            $promoTiers = $activePromo ? $activePromo->all_discount_tiers : null;
                                        @endphp
                                    
                                        <div class="flex gap-1">
                                            @if ($discountedPrice && $discountedPrice < $product->product->regular_price)
                                            <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                <del>
                                                Rp{{ number_format($product->product->regular_price, 0, ',', '.') }}
                                                </del>
                                            </p>
                                            <p class="text-decoration-none text-[#183018] text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                            @else
                                            <p class="text-decoration-none  text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">
                                                Rp{{ number_format($product->product->regular_price, 0, ',', '.') }}
                                            </p>
                                            @endif
                                        </div>

                                                @if (!empty($promoTiers))
                                                    <div>
                                                        <p class="text-[8px] md:text-[10px] lg:text-[11px] xl:text-[12px]">
                                                            {!! $activePromo->all_discount_tiers !!}
                                                        </p>
                                                        <p
                                                            class="text-danger text-[8px] md:text-[10px] lg:text-[11px] xl:text-[12px]">
                                                            *Tidak bisa digabung dengan voucher diskon lainnya <br>
                                                            *Harga Berubah ketika anda checkout
                                                        </p>

                                                    </div>
                                                @endif

                                                <!-- BUTTON PLUS & MINUS & DELETE -->
                                                <div class="flex mt-auto bottom">
                                                    <div class="flex ml-auto">
                                                        <button class="btn btn-delete" name="delete-product-cart"
                                                            title="Hapus produk dari keranjang"
                                                            style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                                                            data-type="product" data-id="{{ $product->product_id }}">
                                                            <i
                                                                class="fas fa-trash text-[10px] text-black md:text-[12px] lg:text-[14px] xl:text-[16px]"></i>
                                                        </button>

                                                @if ($product->product->stock_quantity == 0)
                                                    <button
                                                        class="btn btn-danger text-[8px] md:text-[12px] lg:text-[12px] xl:text-[14px] rounded-sm" 
                                                        data-bs-toggle="tooltip" 
                                                        data-bs-placement="top" 
                                                        title="Beritahu Saya Jika Stok Sudah Ada" 
                                                        type="button" 
                                                        id="notify-me-{{$product->product->id}}"
                                                        onclick="notifyMe({{$product->product->id}})">
                                                        Beritahu Saya
                                                    </button>   
                                                @else
                                                <div class="input-group quantity-detail-produk rounded-sm shadow-sm" style="width: 120px;">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-minus" data-id="{{$product->product_id}}" data-quantity="{{$product->product->stock_quantity}}" style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;" id="minus-btn-product-cart-{{$product->product_id}}">
                                                            <i class="fa fa-minus text-xs"></i>
                                                        </button>
                                                    </div>

                                                                <input type="number"
                                                                    id="product-quantity-{{ $product->product->id }}"
                                                                    value="{{ $product->quantity }}" name="total_product"
                                                                    class="text-xs form-control bg-secondary text-center no-spinner"
                                                                    min="1"
                                                                    max="{{ $product->product->stock_quantity }}"
                                                                    oninput="validateInput(this, {{ $product->product->stock_quantity }})">


                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-plus"
                                                                        data-id="{{ $product->product_id }}"
                                                                        data-quantity="{{ $product->product->stock_quantity }}"
                                                                        style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                                                                        id="plus-btn-product-cart-{{ $product->product_id }}">
                                                                        <i class="fa fa-plus text-xs"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

            <div class="col-lg-3 pl-0 pl-md-3 pr-0 pr-md-3 pl-lg-0 mt-0 mt-md-2 mt-lg-0 mt-2 mt-md-0 d-none d-lg-block">
                <div class="position-sticky" style="top: 4rem">
                    <div class="mb-3 rounded p-3 bg-white shadow-md border border-[#183018]">
                        <div class="d-flex py-2">
                            <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Total Harga</p>
                            <p id="totalPrice" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto text-black">{{ 'Rp' . number_format(0, 0, ',', '.') }}</p>
                        </div>
                        <div class="border-top border-[#183018] pt-2 mr-2">
                                <button class="hover:cursor-pointer py-2 text-decoration-none rounded-sm hover:bg-neutral-900 shadow-sm px-3 text-white bg-[#183018] w-full text-[10px] md:text-[10px] lg:text-[12px] xl:text-[16px]" id="paynow" onclick="checkout()" disabled>
                                    Beli
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @else
        <div style="min-height:10vh;">
            <div class="flex align-items-center justify-content-center">
                <img src="images/cart-empty.png" class="img-fluid" style="width:20%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
            </div>
            <div class="grid align-items-center justify-content-center">
                <p class="text-danger text-[10px] md:text-[14px] lg:text-[16px] xl:text-[18px">Keranjang belanjamu masih kosong nih</p>
                <button class="btn btn-success rounded-sm w-full text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px    " onclick="location.href='/shop'" >Mulai Belanja</button>
            </div>
        </div>
            
        @endif
    </div>

    <div class="d-lg-none bg-[#183018] fixed-bottom px-0 d-flex justify-content-end align-items-center gap-2" style="width: 100%; box-sizing: border-box;">
        <div class="grid py-2 text-end" style="flex: 1;">
            <p class="text-white text-[12px]">Total</p>
            <p id="totalPriceMobile" class="text-[12px] ml-auto text-white">{{ 'Rp' . number_format(0, 0, ',', '.') }}</p>
        </div>
        <div class="pr-2">
            <button class="btn btn-light w-fit h-fit font-semibold rounded-sm text-[#183018] text-[12px]" type="submit" id="paynowmobile" onclick="checkout()" disabled>
                Beli
            </button>
        </div>
    </div>
</div>



    <!-- DELETE PRODUCT FROM CART -->
    <script>
        $(document).on('click', 'button[name="delete-product-cart"]', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            let type = $(this).data('type');

        if (type === 'variant') {
            $.ajax({
                url: "{{ route('delete.product.variant.cart') }}",
                type: 'POST',
                data: {
                    product_variant_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Toast.fire({
                        icon: "success",
                        text: response.message,
                        willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    }).then(function () {
                        location.reload(); // Redirect ke halaman utama atau halaman lain
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Error occurred!");
                }
            });
        } else if (type === 'product') {
            $.ajax({
                url: "{{ route('delete.product.cart') }}",
                type: 'POST',
                data: {
                    product_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Toast.fire({
                        icon: "success",
                        text: response.message,
                        willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    }).then(function () {
                        location.reload(); // Redirect ke halaman utama atau halaman lain
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Error occurred!");
                }
            });
        }
        
    });

    $(document).on('click', 'button[name="delete-all-product-cart"]', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('delete.all.product.cart') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Toast.fire({
                    icon: "success",
                    text: response.message,
                    willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                }).then(function () {
                    location.reload(); // Redirect ke halaman utama atau halaman lain
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Error occurred!");
            }
        });
    });
</script>


    <!-- FUNCTION FOR DATABASE -->
    <!-- CHOOSE PRODUCT -->
    <script>
        function checkout() {
            window.location.href = '/checkout';
        }

        // Fungsi untuk memeriksa status checkbox "Pilih Semua"
        function updateSelectAllStatus() {
            let totalCheckboxes = $('.item-checkbox').length; // Jumlah semua checkbox item
            let checkedCheckboxes = $('.item-checkbox:checked').length; // Jumlah checkbox item yang dipilih

            // console.log({
            //     totalCheckboxes : totalCheckboxes,
            //     checkedCheckboxes : checkedCheckboxes,
            // });

            if (totalCheckboxes !== 0 && checkedCheckboxes !== 0) {
                if (totalCheckboxes === checkedCheckboxes) {
                    $('#select-all').prop('checked', true); // Pilih Semua jika semua item dipilih
                }
            } else if (totalCheckboxes === 0 && checkedCheckboxes === 0) {
                $('#select-all').prop('checked', false); // Hapus Pilih Semua jika tidak semua item dipilih
            } else {
                $('#select-all').prop('checked', false); // Hapus Pilih Semua jika tidak semua item dipilih
            }
        }

        // Fungsi untuk toggle status Pilih Semua
        function toggleSelectAll() {
            let selectAllChecked = $('#select-all').is(':checked');
            $('.item-checkbox').prop('checked', selectAllChecked);

            // Kirim AJAX request untuk mengupdate semua produk
            $.ajax({
                url: "{{ route('choose.product.cart') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    select_all: true, // Indikator bahwa ini untuk memilih semua
                    is_choose: selectAllChecked ? 1 : 0 // TRUE jika semua dipilih, FALSE jika tidak
                },
                success: function(response) {},
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan.');
                }
            });
        }

        // Fungsi untuk toggle produk varian individu
        function toggleProductSelectionVariant(productVariantId) {

            let isChecked = $('#produk_' + productVariantId).is(':checked');

            // Kirim AJAX request untuk mengupdate produk individu
            $.ajax({
                url: "{{ route('choose.product.variant.cart') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_variant_id: productVariantId,
                    is_choose: isChecked ? 1 : 0
                },
                success: function(response) {},
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan.');
                }
            });

            // Update status checkbox "Pilih Semua"
            updateSelectAllStatus();
        }

        function toggleProductSelection(productId) {

            let isChecked = $('#produk_' + productId).is(':checked');

            // Kirim AJAX request untuk mengupdate produk individu
            $.ajax({
                url: "{{ route('choose.product.cart') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    is_choose: isChecked ? 1 : 0
                },
                success: function(response) {},
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan.');
                }
            });

            // Update status checkbox "Pilih Semua"
            updateSelectAllStatus();
        }

        // Event listener untuk checkbox individu
        $('.item-checkbox').on('change', function() {
            let type = $(this).data('type'); // Ambil tipe dari data-type
            let productId = $(this).attr('id').split('_')[1]; // Ambil ID produk/varian

            if (type === 'variant') {
                console.log('Product Variant clicked:', productId);
                toggleProductSelectionVariant(productId);
            } else if (type === 'product') {
                console.log('Product clicked:', productId);
                toggleProductSelection(productId);
            }

        });

        // Update status "Pilih Semua" ketika halaman dimuat
        $(document).ready(function() {
            updateSelectAllStatus(); // Memastikan status "Pilih Semua" sesuai ketika halaman dimuat
        });

        // Event listener untuk checkbox "Pilih Semua"
        $('#select-all').on('change', function() {
            toggleSelectAll();
        });
    </script>

    <!-- HANDLE QUANTITY -->
    <script>
        $(document).ready(function() {

            // Handle quantity input change (both via plus/minus buttons and manual input)
            $(document).on('input', '[name="total_product"]', function() {
                var productId = $(this).attr('id').split('-').pop(); // Get product ID from input ID
                var newQuantity = parseInt($(this).val());
                var maxQuantity = parseInt($(this).attr('max')); // Get max quantity from input attribute

                // Ensure the quantity is a valid number and greater than 0
                if (!isNaN(newQuantity) && newQuantity > 0) {
                    if(newQuantity > maxQuantity) {
                        $(this).val(maxQuantity); // Reset to max quantity if exceeded
                        updateProductQuantity(productId, $(this).val(maxQuantity));
                    } else {
                        $(this).val(newQuantity); // Set the new valid quantity
                        updateProductQuantity(productId, $(this).val(newQuantity));
                    }
                } else {
                    // alert("Quantity must be a valid number greater than 0");
                    $(this).val(1); // Reset to 1 if the input is invalid
                    updateProductQuantity(productId, 1);
                }
            });

            // Handle minus button click
            $(document).on('click', '.btn-minus', function() {
                var productId = $(this).data('id');
                var currentQuantity = parseInt($('#product-quantity-' + productId).val());

                if (currentQuantity >= 1) {
                    $('#product-quantity-' + productId).val(currentQuantity);
                    updateProductQuantity(productId, currentQuantity);
                }
            });

            // Handle plus button click
            $(document).on('click', '.btn-plus', function() {
                var productId = $(this).data('id');
                var currentQuantity = parseInt($('#product-quantity-' + productId).val());

                $('#product-quantity-' + productId).val(currentQuantity);
                updateProductQuantity(productId, currentQuantity);
            });

            // Function to send AJAX request to update quantity
            function updateProductQuantity(productId, newQuantity) {
                $.ajax({
                    url: "{{ route('update.cart.quantity') }}", // Your route to update quantity
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        quantity: newQuantity
                    },
                    success: function(response) {},
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("An error occurred.");
                    }
                });
            }
        });

        // VARIANT

        // HANDLE FOR VARIANT
        // Handle quantity input change (both via plus/minus buttons and manual input)
        $(document).on('input', '[name="total_product_variant"]', function() {
            var productId = $(this).attr('id').split('-').pop(); // Get product ID from input ID
            var newQuantity = parseInt($(this).val());

            // Ensure the quantity is a valid number and greater than 0
            if (!isNaN(newQuantity) && newQuantity > 0) {
                updateProductQuantityVariant(productId, newQuantity);
            } else {
                // alert("Quantity must be a valid number greater than 0");
                $(this).val(1); // Reset to 1 if the input is invalid
                updateProductQuantityVariant(productId, 1);
            }
        });

        // Handle minus button click
        $(document).on('click', '.btn-minus-variant', function() {

            var productId = $(this).data('id');
            var currentQuantity = parseInt($('#product-quantity-' + productId).val());

            if (currentQuantity >= 1) {
                $('#product-quantity-' + productId).val(currentQuantity);
                updateProductQuantityVariant(productId, currentQuantity);
            }
        });

        // Handle plus button click
        $(document).on('click', '.btn-plus-variant', function() {
            var productId = $(this).data('id');
            var currentQuantity = parseInt($('#product-quantity-' + productId).val());

            // console.log(currentQuantity);
            $('#product-quantity-' + productId).val(currentQuantity);
            updateProductQuantityVariant(productId, currentQuantity);
        });

        // Function to send AJAX request to update quantity
        function updateProductQuantityVariant(productVariantId, newQuantity) {
            // console.log({
            //     variantId: productVariantId,
            //     quantity: newQuantity,
            // });
            $.ajax({
                url: "{{ route('update.cart.quantity.variant') }}", // Your route to update quantity
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_variant_id: productVariantId,
                    quantity: newQuantity
                },
                success: function(response) {
                    console.log(response.message)
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("An error occurred.");
                }
            });
        }
    </script>
    <!-- END FUNCTION FOR DATABASE -->


    <!-- MENGHITUNG TOTAL HARGA -->
    <script>
        // Fungsi untuk menghitung total harga
        function calculateTotal() {
            let total = 0; // Inisialisasi total
            let product = 0;
            let hasSelectedProduct = false; // Flag untuk memeriksa apakah ada produk yang dipilih

            // Loop melalui semua checkbox produk
            $('.item-checkbox:checked').each(function() {
                let productId = $(this).attr('id').split('_')[1]; // Mendapatkan ID produk
                let quantity = parseInt($('#product-quantity-' + productId).val()); // Mendapatkan kuantitas produk

                // Mengambil harga dari elemen yang sesuai
                let price = parseFloat($(this).data('price')); // Mengambil harga dari data atribut

                // Hitung total harga untuk produk ini
                total += price * quantity;

                hasSelectedProduct = true; // Tandai bahwa ada produk yang dipilih
            });

            // Update total harga di tampilan
            $('#totalPrice').text('Rp' + number_format(total, 0, ',', '.'));
            $('#totalPriceMobile').text('Rp' + number_format(total, 0, ',', '.'));

            // Aktifkan atau nonaktifkan tombol "Bayar Sekarang"
            if (hasSelectedProduct) {
                $('#paynow').removeAttr('disabled'); // Aktifkan tombol
                $('#paynowmobile').removeAttr('disabled');

            } else {
                $('#paynow').attr('disabled', 'disabled'); // Nonaktifkan tombol
                $('#paynowmobile').attr('disabled', 'disabled');
            }
        }

        // Fungsi untuk format angka ke format mata uang
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-.]/g, ''); // Menghapus karakter yang tidak diinginkan
            let n = !isFinite(+number) ? 0 : +number; // Memastikan bahwa ini adalah angka
            let prec = !isFinite(+decimals) ? 0 : Math.abs(decimals); // Mengambil angka desimal
            let sep = typeof thousands_sep === 'undefined' ? ',' : thousands_sep; // Pemisah ribuan
            let dec = typeof dec_point === 'undefined' ? '.' : dec_point; // Pemisah desimal
            let toFixedFix = function(n, prec) {
                let k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
            // Mengatur desimal
            let s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            // Mengatur ribuan
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(\d{3})+(?!\d))/g, sep);
            }
            // Menggabungkan kembali
            return s.join(dec);
        }

        $(document).ready(function() {
            // Event listener untuk tombol tambah/kurang kuantitas
            $(document).on('click', '.btn-plus, .btn-minus', function() {
                let productId = $(this).data('id');
                let quantityInput = $('#product-quantity-' + productId);
                let currentQuantity = parseInt(quantityInput.val());

                if ($(this).hasClass('btn-plus')) {
                    quantityInput.val(currentQuantity);
                } else {
                    if (currentQuantity > 1) { // Menghindari kuantitas negatif
                        quantityInput.val(currentQuantity);
                    }
                }

                // Hitung total lagi setelah kuantitas diperbarui
                calculateTotal();
            });

            // Event listener untuk tombol tambah/kurang kuantitas
            $(document).on('click', '.btn-plus-variant, .btn-minus-variant', function() {
                let productId = $(this).data('id');
                let quantityInput = $('#product-quantity-' + productId);
                let currentQuantity = parseInt(quantityInput.val());

                if ($(this).hasClass('btn-plus-variant')) {
                    quantityInput.val(currentQuantity);
                } else {
                    if (currentQuantity > 1) { // Menghindari kuantitas negatif
                        quantityInput.val(currentQuantity);
                    }
                }

                // Hitung total lagi setelah kuantitas diperbarui
                calculateTotal();
            });

            // Event listener untuk input manual kuantitas produk
            $(document).on('change', '.form-control', function() {
                let quantity = $(this).val();
                $(this).val(quantity < 1 ? 1 : quantity); // Pastikan kuantitas minimal 1
                calculateTotal(); // Hitung total saat kuantitas diubah
            });

            // Event listener untuk checkbox produk
            $(document).on('change', '.item-checkbox', function() {
                calculateTotal(); // Hitung total saat checkbox diubah
            });

            // Hitung total saat halaman dimuat
            calculateTotal();
        });


        function toggleCheckboxes(source) {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = source.checked;
            });
            calculateTotal(); // Menghitung total saat checkbox "Pilih Semua" dicentang
        }

        // Product Quantity
        $(".quantity-detail-produk button").on("click", function() {
            var button = $(this);
            var input = button.parent().parent().find("input");
            var oldValue = parseFloat(input.val());
            var maxQuantity = parseFloat(button.data("quantity")); // Ambil nilai max quantity dari data attribute
            var newVal;

            if (button.hasClass("btn-plus")) {
                if (oldValue < maxQuantity) {
                    newVal = oldValue + 1;
                } else {
                    newVal = maxQuantity; // Jika sudah mencapai maksimum, tetap pada max
                }
            } else {
                newVal = (oldValue > 1) ? oldValue - 1 : 1;
            }

            // Set nilai baru ke input field
            input.val(newVal);

            // Panggil checkMaxQuantity untuk memeriksa batas
            checkMaxQuantity(input[0], maxQuantity);
        });

        $(".quantity-detail-produk-variant button").on("click", function() {
            var button = $(this);
            var input = button.parent().parent().find("input");
            var oldValue = parseFloat(input.val());
            var maxQuantity = parseFloat(button.data("quantity")); // Ambil nilai max quantity dari data attribute
            var newVal;

            if (button.hasClass("btn-plus-variant")) {
                if (oldValue < maxQuantity) {
                    newVal = oldValue + 1;
                } else {
                    newVal = maxQuantity; // Jika sudah mencapai maksimum, tetap pada max
                }
            } else {
                newVal = (oldValue > 1) ? oldValue - 1 : 1;
            }

            // Set nilai baru ke input field
            input.val(newVal);

            // Panggil checkMaxQuantity untuk memeriksa batas
            checkMaxQuantityVariant(input[0], maxQuantity);
        });

        // Fungsi untuk memeriksa apakah sudah mencapai max quantity
        function checkMaxQuantity(input, maxQuantity) {
            var value = parseFloat(input.value);
            var warningElement = document.getElementById("quantity-warning-" + input.id.split('-').pop());
            var plusButton = document.getElementById("plus-btn-product-cart-" + input.id.split('-').pop());

            if (value > maxQuantity) {
                if (warningElement) {
                    warningElement.innerText = "Batas untuk pembelian produk terpenuhi";
                }
            } else {
                if (warningElement) {
                    warningElement.innerText = "";
                }
            }
        }

        function checkMaxQuantityVariant(input, maxQuantity) {
            var value = parseFloat(input.value);
            var warningElement = document.getElementById("quantity-warning-variant-" + input.id.split('-').pop());
            var plusButton = document.getElementById("plus-btn-product-cart-variant-" + input.id.split('-').pop());

            if (value > maxQuantity) {
                plusButton.disabled = true; // Disable tombol plus ketika sudah mencapai stok maksimum
                if (warningElement) {
                    warningElement.innerText = "Batas untuk pembelian produk terpenuhi";
                }
            } else {
                plusButton.disabled = false; // Enable tombol plus jika belum mencapai stok maksimum
                if (warningElement) {
                    warningElement.innerText = "";
                }
            }
        }

        function validateInput(input, maxQuantity) {
            var value = parseFloat(input.value);

            if (value > maxQuantity) {
                input.value = maxQuantity; // Jangan biarkan lebih dari stok
            } else if (value < 1) {
                input.value = 1; // Jangan biarkan di bawah 1
            }
            checkMaxQuantity(input, maxQuantity); // Update status tombol
        }
    </script>

    <script>
        function detailProduct(productCode) {
            window.location.href = productCode + "_product";
        }

        function detailProductVariant(productCode, productVariantSku) {
            window.location.href = productCode + "_product?varian=" + productVariantSku;
        }
    </script>

    @if (session('stock_empty'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "error",
                title: "Gagal checkout",
                text: "{{ session('stock_empty') }}", // Pass session message here
                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Change title color
                    if (content) content.style.color = '#ffffff'; // Change content color
                }
            });
        </script>
    @endif




@endsection

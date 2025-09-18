@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 mb-12 mb-md-0 py-2">
    <div class="container-fluid px-0 px-md-3">
        <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
            <div class="d-flex gap-1 pl-3">
                <a href="/" class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px]">Beranda</a>
                <p class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px]"> > </p>
                <a href="#" class="text-black text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px]">Keranjang</a>
            </div>
        </div>
    </div>

    @php
        $totalGuest = collect(session('guest_cart'))->sum('total');
    @endphp

    <div class="row gap-2 gap-md-0 m-0 p-0 mb-2">
        {{-- GUEST --}}
        @if (session('guest_cart'))
            <div class="col-lg-9 grid gap-2 px-0 px-md-3">
                <div class="container border border-[#183018] rounded shadow-md">
                    @foreach (session('guest_cart') as $cart)
                        @if ($cart['product_id'] !== null)
                            <div class="form-check grid border-bottom border-[#183018] py-2 py-md-3 {{  \App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') == 0 ? 'bg-secondary' : ''}}">
                                <div class="d-flex">
                                    <div class="col-lg-2 col-md-4 col-4 pl-1">
                                        <img src="{{ Storage::url(\App\Models\Product::where('id', $cart['product_id'])->value('main_image')) }}" alt="" class="img-fluid w-100 border border-[#183018] rounded-sm">
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-8 p-0 p-md-2 d-flex flex-column">
                                        @if (\App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') == 0)
                                        <p class="text-danger font-semibold text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] hover:cursor-pointer">
                                            Stok Habis
                                        </p>
                                        @endif
                                        <p class="hover:cursor-pointer text-[12px] text-black md:text-[12px] lg:text-[12px] xl:text-[14px] {{ \App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') == 0 ? 'text-primary' : ''}}" onclick="detailProduct('{{ \App\Models\Product::where('id', $cart['product_id'])->value('product_code') }}')">{{ \App\Models\Product::where('id', $cart['product_id'])->value('product_name') }}</p>
                                        
                                        <p class="text-decoration-none text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]" id="total-product-{{$cart['product_id']}}">
                                            Jumlah {{$cart['quantity']}}
                                        </p>

                                        <p class="text-decoration-none text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">
                                            Harga Rp{{ number_format($cart['price'], 0, ',', '.') }}
                                        </p>
                                    
                                        <div class="flex gap-1">
                                            <p class="text-decoration-none  text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px] font-semibold text-[#183018]" id="total-price-product-{{$cart['product_id']}}">
                                            Total Rp{{ number_format($cart['total'], 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <!-- BUTTON PLUS & MINUS & DELETE -->
                                        <div class="flex mt-auto bottom">
                                            <div class="flex ml-auto">
                                                <button class="btn btn-delete" name="delete-product-cart"
                                                    title="Hapus produk dari keranjang"
                                                    style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                                                    data-type="product" data-id="{{ $cart['product_id'] }}">
                                                    <i class="fas fa-trash text-[10px] text-black md:text-[12px] lg:text-[14px] xl:text-[16px]"></i>
                                                </button>
                                            </div>
                                            <div class="input-group quantity-detail-produk rounded-xl shadow-sm" style="width: 120px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-minus" data-id="{{$cart['product_id']}}" data-quantity="{{ \App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') }}" style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;" id="minus-btn-product-cart-{{$cart['product_id']}}">
                                                        <i class="fa fa-minus text-xs"></i>
                                                    </button>
                                                </div>
    
                                                <input type="number"
                                                    id="product-quantity-{{ $cart['product_id'] }}"
                                                    value="{{ $cart['quantity'] }}"
                                                    name="total_product"
                                                    class="text-xs form-control bg-secondary text-center no-spinner"
                                                    min="1"
                                                    max="{{ \App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') }}"
                                                    oninput="checkMaxQuantity(this, {{ \App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') }})">

    
                                                <div class="input-group-btn">
                                                    <button class="btn btn-plus"
                                                        data-id="{{ $cart['product_id'] }}"
                                                        data-quantity="{{ \App\Models\Product::where('id', $cart['product_id'])->value('stock_quantity') }}"
                                                        style="height: 32px; width: 32px; display: flex; justify-content: center; align-items: center;"
                                                        id="plus-btn-product-cart-{{ $cart['product_id'] }}">
                                                        <i class="fa fa-plus text-xs"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <span id="quantity-warning-{{$cart['product_id']}}" class="text-danger justify-content-end" style="display: none;">Batas untuk pembelian produk terpenuhi</span>
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 pl-0 pl-md-3 pr-0 pr-md-3 pl-lg-0 mt-0 mt-md-2 mt-lg-0 mt-2 mt-md-0 d-none d-lg-block">
                <div class="position-sticky" style="top: 4rem">
                    <div class="mb-3 rounded p-3 bg-white shadow-md border border-[#183018]">
                        <div class="d-flex py-2">
                            <p class="text-black text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px]">Total Harga</p>
                            <p class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px] ml-auto text-black" id="total-all-price">{{ 'Rp' . number_format($totalGuest, 0, ',', '.') }}</p>
                        </div>
                        <div class="border-top border-[#183018] pt-2 mr-2">
                                <button class="hover:cursor-pointer py-2 text-decoration-none rounded-sm hover:bg-neutral-900 shadow-sm px-3 text-white bg-[#183018] w-full text-[10px] md:text-[10px] lg:text-[12px] xl:text-[16px]" onclick="checkout()">
                                    Beli Sekarang
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
            <p class="text-white text-[14px]">Total</p>
            <p id="totalPriceMobile" class="text-[14px] ml-auto text-white font-semibold">{{ 'Rp' . number_format($totalGuest, 0, ',', '.') }}</p>
        </div>
        <div class="pr-2">
            <button class="btn btn-light w-fit h-fit font-semibold rounded-xl text-[#183018] text-[22px]" type="submit" id="paynowmobile" onclick="checkout()">
                Beli Sekarang
            </button>
        </div>
    </div>
</div>


<script>
    function checkout() {
        window.location.href = '/checkout';
    }
</script>
<script>
    $(document).on('click', 'button[name="delete-product-cart"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        let type = $(this).data('type');

        if (type === 'variant') {
            $.ajax({
                url: "{{ route('delete.product.variant.cart.guest') }}",
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
                url: "{{ route('delete.product.cart.guest') }}",
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
</script>


<!-- HANDLE QUANTITY -->
<script>
    function number_format(number, decimals = 0, dec_point = ',', thousands_sep = '.') {
        const n = Number(number).toFixed(decimals);
        const parts = n.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
        return parts.join(dec_point);
    }

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
                    updateProductQuantity(productId, maxQuantity);
                } else {
                    $(this).val(newQuantity); // Set the new valid quantity
                    updateProductQuantity(productId, newQuantity);
                }
            } else {
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
                url: "{{ route('update.cart.quantity.guest') }}", // Your route to update quantity
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: newQuantity
                },
                success: function(response) {
                    $(`#total-product-${productId}`).text("Jumlah " + response.newQuantity);
                    $(`#total-price-product-${productId}`).text("Total Rp" + number_format(response.subtotal_item, 0, ',', '.'));
                    $("#total-all-price").text("Rp" + number_format(response.total_price, 0, ',', '.'));
                    $("#totalPriceMobile").text("Rp" + number_format(response.total_price, 0, ',', '.'));
                },
                error: function(xhr) {
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
        var maxQuantity = parseInt($(this).attr('max')); 

        // Ensure the quantity is a valid number and greater than 0
        if (!isNaN(newQuantity) && newQuantity > 0) {
            if(newQuantity > maxQuantity) {
                $(this).val(maxQuantity); // Reset to max quantity if exceeded
                updateProductQuantityVariant(productId, maxQuantity);
            } else {
                $(this).val(newQuantity); // Set the new valid quantity
                updateProductQuantityVariant(productId, newQuantity);
            }
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

    // // Product Quantity
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

    // input.addEventListener("blur", function() {
    //     if (parseInt(this.value) > maxQuantity) {
    //         this.value = maxQuantity;
    //         checkMaxQuantity(this, maxQuantity);
    //     }
    // });

    // Fungsi untuk memeriksa apakah sudah mencapai max quantity
    function checkMaxQuantity(input, maxQuantity) {
        const value = parseFloat(input.value);
        const productId = input.id.split('-').pop(); // Ambil ID produk dari input ID
        const warningElement = document.getElementById("quantity-warning-" + productId);
        const plusButton = document.getElementById("plus-btn-product-cart-" + productId);

        if (value > maxQuantity) {
            if (warningElement) {
                warningElement.style.display = "block";
                warningElement.innerText = "Batas untuk pembelian produk terpenuhi";
            }
            if (plusButton) {
                plusButton.disabled = true;
            }
        } else {
            if (warningElement) {
                warningElement.style.display = "none";
                warningElement.innerText = "";
            }
            if (plusButton) {
                plusButton.disabled = false;
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

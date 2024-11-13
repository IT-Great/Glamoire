@extends('user.layouts.master')

@section('content')

    <div class="md:px-20 lg:px-24 xl:px-24 pt-2">
        <div class="container-fluid">
            <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <a href="/home" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                        <a href="/cart" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Keranjang</a>
                        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                        <a href="#"
                            class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gap-2 gap-md-0 m-0 p-0 mb-4">
            <div class="col-md-8 grid gap-2">
                @if (count($data['address']) !== 0)
                    @foreach ($data['address'] as $checkout_address)
                        @if ($checkout_address->is_use)
                            <div
                                class="col-12 p-0 md:shadow-md md:rounded py-1 py-md-0 p-md-3 border-bottom border-top md:border-none">
                                <h1
                                    class="font-semibold text-black text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] mb-2">
                                    Alamat Pengiriman</h1>
                                <div class="grid gap-1 gap-md-2 mb-md-2">
                                    <div class="d-flex gap-1 gap-md-2 align-items-center">
                                        <i
                                            class="fas fa-location-arrow text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"></i>
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            {{ $checkout_address->label }}</p>
                                        <p
                                            class="font-bold text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            .</p>
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            {{ $checkout_address->recipient_name }}</p>
                                    </div>
                                    <div class="d-flex gap-1 gap-md-2">
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            {{ $checkout_address->address }}</p>
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            ({{ $checkout_address->benchmark }})
                                        </p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            {{ ucwords(strtolower($checkout_address->district)) }},
                                            {{ ucwords(strtolower($checkout_address->regency)) }},
                                            {{ ucwords(strtolower($checkout_address->province)) }}
                                        </p>
                                    </div>
                                    <div class="d-flex">
                                        <button type="button"
                                            class="btn btn-primary rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            data-bs-toggle="modal" data-bs-target="#change_address"
                                            style="background-color: #183018">
                                            Ubah Alamat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <!-- MODAL TAMBAH ALAMAT -->
                    <div class="modal fade" id="form-address-new" tabindex="-1" aria-labelledby="form-address-new"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                                <div class="modal-header" style="background-color: #183018">
                                    <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]"
                                        id="exampleModalLabel">Tambahkan Alamat Baru</h1>
                                </div>

                                <div class="modal-body overflow-y-auto" style="max-height:100vh;">
                                    <form method="POST" action="{{ route('add.shipping.address') }}"
                                        id="add-address-form-null">
                                        @csrf
                                        <div class="grid gap-1 gap-md-2">
                                            <div class="grid md:flex">
                                                <div class="col-md-6">
                                                    <div class="col-12 p-0">
                                                        <label for="label"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Label</label>
                                                        <input type="text"
                                                            class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                            name="label" placeholder="Masukkan Nama Label Untuk Alamatmu"
                                                            required>
                                                    </div>
                                                    <div class="col-12 p-0">
                                                        <label for="receiver"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Nama
                                                            Penerima</label>
                                                        <input type="text"
                                                            class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                            name="recipient_name" placeholder="Masukkan Nama Penerima"
                                                            required>
                                                    </div>
                                                    <div class="col-12 p-0">
                                                        <label for="handphone"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Handphone</label>
                                                        <div class="input-group">
                                                            <span
                                                                class="input-group-text text-red-700 text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                                id="basic-addon1">+62</span>
                                                            <input type="number"
                                                                class="form-control rounded-end text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                                name="handphone" placeholder="Contoh : 8979254301"
                                                                pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
                                                        </div>
                                                    </div>
                                                    <!-- ALAMAT -->
                                                    <div class="col-12 p-0">
                                                        <label for="alamat"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Alamat</label>
                                                        <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="address"
                                                            rows="3" placeholder="Masukkan Alamatmu" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="col-12 p-0">
                                                        <label for="provinsi"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Provinsi</label>
                                                        <select
                                                            class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                            aria-label="Provinsi" name="province" id="checkout_province">
                                                            <option
                                                                class="text-primary text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                                Pilih Provinsi</option>
                                                        </select>
                                                        <input type="hidden" name="province_name"
                                                            id="checkout_province_name">
                                                    </div>

                                                    <div class="col-12 p-0">
                                                        <label for="kabupaten/kota"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kabupaten/Kota</label>
                                                        <select
                                                            class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                            aria-label="Kabupaten/Kota" name="regency"
                                                            id="checkout_regency">
                                                            <option
                                                                class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                                Pilih Kabupaten/Kota</option>
                                                        </select>
                                                        <input type="hidden" name="regency_name"
                                                            id="checkout_regency_name">
                                                    </div>

                                                    <div class="col-12 p-0">
                                                        <label for="kecamatan"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kecamatan</label>
                                                        <select
                                                            class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                            aria-label="Kecamatan" name="district"
                                                            id="checkout_district">
                                                            <option
                                                                class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                                Pilih Kecamatan</option>
                                                        </select>
                                                        <input type="hidden" name="district_name"
                                                            id="checkout_district_name">
                                                    </div>
                                                    <!-- PATOKAN -->
                                                    <div class="col-12 p-0">
                                                        <label for="patokan"
                                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Patokan
                                                            (Opsional)</label>
                                                        <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="benchmark"
                                                            rows="3" placeholder="Contoh : Depan Warung Soto Ayam Jepang"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- BUTTON SUBMIT -->
                                            <div class="col-12 p-0">
                                                <button
                                                    class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                    type="submit" style="background-color: #183018">Tambahkan</button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL TAMBAH ALAMAT -->
                @endif

                <form action="{{ route('order.payment') }}" method="POST" class="grid gap-2">
                    @csrf
                    <div class="col-12 p-0 md:shadow-md md:rounded p-md-3 border-bottom border-top md:border-none">
                        <h1 class="font-semibold text-black text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] mb-2">
                            Rincian Pengiriman</h1>
                        <div class="grid gap-1 gap-md-2 mb-md-2">
                            <div class="flex gap-1 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15";
                                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M256 48c0-26.5 21.5-48 48-48L592 0c26.5 0 48 21.5 48 48l0 416c0 26.5-21.5 48-48 48l-210.7 0c1.8-5 2.7-10.4 2.7-16l0-242.7c18.6-6.6 32-24.4 32-45.3l0-32c0-26.5-21.5-48-48-48l-112 0 0-80zM571.3 347.3c6.2-6.2 6.2-16.4 0-22.6l-64-64c-6.2-6.2-16.4-6.2-22.6 0l-64 64c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L480 310.6 480 432c0 8.8 7.2 16 16 16s16-7.2 16-16l0-121.4 36.7 36.7c6.2 6.2 16.4 6.2 22.6 0zM0 176c0-8.8 7.2-16 16-16l352 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16L16 224c-8.8 0-16-7.2-16-16l0-32zm352 80l0 224c0 17.7-14.3 32-32 32L64 512c-17.7 0-32-14.3-32-32l0-224 320 0zM144 320c-8.8 0-16 7.2-16 16s7.2 16 16 16l96 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0z" />
                                </svg>
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Dikirim
                                    dari Kota Surabaya, Jawa Timur</p>
                            </div>
                            <div class="flex gap-1 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15";
                                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M112 0C85.5 0 64 21.5 64 48l0 48L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 208 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 224l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 288l0 128c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L112 0zM544 237.3l0 18.7-128 0 0-96 50.7 0L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z" />
                                </svg>
                                @foreach ($data['address'] as $checkout_address)
                                    @if ($checkout_address->is_use)
                                        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">
                                            Menuju {{ ucwords(strtolower($checkout_address->district)) }},
                                            {{ ucwords(strtolower($checkout_address->regency)) }},
                                            {{ ucwords(strtolower($checkout_address->province)) }}
                                        </p>
                                        <input type="number" name="shipping_address_id" id="shipping-address-id"
                                            value="{{ $checkout_address->id }}" hidden>
                                        <input type="number" name="shipping_cost" id="shipping-cost" value="20000"
                                            hidden>
                                    @endif
                                @endforeach
                            </div>
                            <div class="flex gap-1 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15";
                                    viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M0 112.5L0 422.3c0 18 10.1 35 27 41.3c87 32.5 174 10.3 261-11.9c79.8-20.3 159.6-40.7 239.3-18.9c23 6.3 48.7-9.5 48.7-33.4l0-309.9c0-18-10.1-35-27-41.3C462 15.9 375 38.1 288 60.3C208.2 80.6 128.4 100.9 48.7 79.1C25.6 72.8 0 88.6 0 112.5zM288 352c-44.2 0-80-43-80-96s35.8-96 80-96s80 43 80 96s-35.8 96-80 96zM64 352c35.3 0 64 28.7 64 64l-64 0 0-64zm64-208c0 35.3-28.7 64-64 64l0-64 64 0zM512 304l0 64-64 0c0-35.3 28.7-64 64-64zM448 96l64 0 0 64c-35.3 0-64-28.7-64-64z" />
                                </svg>
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]"
                                    id="shipping_price" value="20000">Tarif Biaya : Rp20.000</p>
                            </div>
                        </div>
                    </div>

                    @foreach ($data['cartItems'] as $cart => $product)
                        <div
                            class="col-12 p-0 py-1 py-md-0 md:shadow-md md:border border-bottom border-top md:rounded p-md-3">
                            <div class="grid mb-2">
                                <h1
                                    class="text-black font-semibold text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] mb-1 mb-md-2">
                                    Produk - {{ $cart + 1 }}</h1>
                            </div>

                            <div class="flex">
                                <div class="w-[70px] h-[70px] w-md-[110px] h-md-[110px]">
                                    <img src="{{ Storage::url($product->product->main_image) }}" alt="gambar produk"
                                        class="rounded-sm border">
                                </div>
                                <div class="col p-0">
                                    <div class="d-flex col-12 gap-1 gap-md-2 mb-2 h-[20px] h-md-[20px]">
                                        <p
                                            class="font-semibold text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                            {{ $product->product->brand->name }}</p>
                                    </div>
                                    <div class="grid lg:flex">
                                        <div class="col-lg-10">
                                            <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                {{ $product->product->product_name }}</p>
                                        </div>
                                        <div class="col-lg-2 p-lg-0">
                                            <div class="d-flex gap-1 font-semibold">
                                                <p
                                                    class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                    {{ $product->quantity }}</p>
                                                <p
                                                    class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                    X</p>
                                                <p
                                                    class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                    Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="number" name="product[]" id="product-id-{{ $product->product_id }}"
                            value="{{ $product->product_id }}" hidden>
                        <input type="number" name="product_quantity[{{ $product->product_id }}]"
                            id="product-quantity-{{ $product->product_id }}" value="{{ $product->quantity }}" hidden>
                        <input type="number" name="product_price[{{ $product->product_id }}]"
                            id="product-price-{{ $product->product_id }}" value="{{ $product->price }}" hidden>
                    @endforeach
            </div>

            <!-- PERHITUNGAN -->
            <div class="col-md-4 pl-3 pl-md-0">
                <div class="position-sticky" style="top: 4.5rem">
                    <div class="p-3 bg-light rounded shadow-sm border border-[#183018] grid gap-2 gap-md-3">
                        <h1 class="font-semibold text-black text-[14px] md:text-[12px] lg:text-[12px] xl:text-[14px]">
                            Rincian Biaya</h1>

                        <div class="grid">
                            <div class="d-flex">
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Total Harga
                                    ({{ $data['totalProduct'] }} Barang)</p>
                                <input type="number" name="total_item" value="{{ $data['totalProduct'] }}" hidden>
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto">
                                    (Rp{{ number_format($data['totalPrice'], 0, ',', '.') }})</p>
                                <input type="number" name="total_item_price" value="{{ $data['totalPrice'] }}" hidden>
                            </div>
                            <div class="d-none" id="discount-use">
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Diskon</p>
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto"
                                    id="discount"></p>
                                <input type="number" name="discount_amount" id="discount-amount" value="" hidden>
                            </div>
                            <div class="d-flex">
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Ongkos Kirim</p>
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto">Rp20.000</p>
                            </div>
                        </div>
                        <div class="d-flex py-2 border-bottom border-top align-items-center">
                            <p class="text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Total Belanja
                            </p>
                            <p class="text-black font-semibold text-[12px] md:text-[12px] lg:text-[16px] xl:text-[18px] ml-auto"
                                id="total-shopping">Rp{{ number_format($data['totalPrice'] + 20000, 0, ',', '.') }}</p>
                            <input type="number" name="subtotal" id="subtotal-price" value="{{ $data['totalPrice'] }}"
                                hidden>
                        </div>
                        <div>
                            <input type="text" name="code_coupont" id="code-coupont" value="" hidden>

                            <div class="relative flex gap-1 items-center input-code">
                                <div class="cancel-code-voucher text-[#183018] absolute" role="status"
                                    style="display:none;" id="cancel-code-voucher" title="Hapus Kode">
                                    <button type="button" class="btn rounded-sm w-fit font-semibold text-sm text-danger"
                                        onclick="cancelCode()">X</button>
                                </div>
                                <input type="text"
                                    class="form-control pl-5 w-full rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    id="code-voucher" name="code_voucher" placeholder="Masukkan kode promo">
                                <div class="ml-2 spinner-border text-[#183018] absolute" role="status"
                                    style="width:15px; height:15px;display:none;" id="voucher-spinner">
                                    <span class="visually-hidden"></span>
                                </div>
                                <button type="button" id="button-code-voucher"
                                    class="btn border rounded-sm w-fit text-white text-[10px] md:text-[7px] lg:text-[12px] xl:text-[14px] hover-shadow-md"
                                    style="background-color: #183018" disabled>
                                    Pakai
                                </button>
                            </div>
                            <div id="validationVoucher" class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                style="display: none;">
                            </div>
                        </div>
                        <button type="button"
                            class="d-flex align-items-center btn btn-primary rounded-sm text-black text-[6px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                            data-bs-toggle="modal" data-bs-target="#promo" style="background-color: #FFFFFF"
                            id="show-voucher">
                            <i class="fas fa-solid fa-tag mr-2"></i>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Voucher</p>
                            <i class="fas fa-solid fa-arrow-right ml-auto"></i>
                        </button>
                        <button
                            class="btn w-full rounded-sm text-white text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]"
                            style="background-color: #183018" type="submit" id="paynow">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>

    {{-- payment gateway --}}
    <script>
        $(document).ready(function() {
            // Add DOKU payment modal HTML
            $('body').append(`
            <div class="modal fade" id="dokuPaymentModal" tabindex="-1" aria-labelledby="dokuPaymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #183018">
                            <h5 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]" id="dokuPaymentModalLabel">Pembayaran</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="dokuPaymentContainer">
                            <div class="text-center" id="loadingPayment">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Mempersiapkan pembayaran...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

            // Handle payment button click
            $('#paynow').click(function(e) {
                e.preventDefault();

                // Show loading state
                $('#paynow').prop('disabled', true);
                $('#dokuPaymentModal').modal('show');

                // Prepare form data
                const formData = {
                    total_amount: parseInt($('#subtotal-price').val()),
                    shipping_cost: parseInt($('#shipping-cost').val()),
                    shipping_address_id: parseInt($('#shipping-address-id').val()),
                    discount_amount: parseInt($('#discount-amount').val() || 0),
                    products: getProductsData()
                };

                // Make AJAX request
                $.ajax({
                    url: '/initiate-doku-payment',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success && response.payment_url) {
                            // Load DOKU payment iframe
                            $('#dokuPaymentContainer').html(`
                        <iframe 
                            src="${response.payment_url}"
                            frameborder="0"
                            width="100%"
                            height="600px"
                            style="overflow: hidden;">
                        </iframe>
                    `);
                        } else {
                            throw new Error('Invalid payment URL');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        $('#dokuPaymentContainer').html(`
                    <div class="alert alert-danger">
                        <p>Terjadi kesalahan saat memproses pembayaran:</p>
                        <p>${xhr.responseJSON?.message || 'Silakan coba lagi beberapa saat lagi.'}</p>
                    </div>
                `);
                        console.error('Payment error:', error);
                    },
                    complete: function() {
                        $('#paynow').prop('disabled', false);
                    }
                });
            });

            // Helper function to get products data
            function getProductsData() {
                const products = [];
                $('input[name="product[]"]').each(function() {
                    const productId = $(this).val();
                    products.push({
                        product_id: parseInt(productId),
                        quantity: parseInt($(`#product-quantity-${productId}`).val()),
                        price: parseInt($(`#product-price-${productId}`).val())
                    });
                });
                return products;
            }
        });
    </script>


    <!-- MENGGUNAKAN KODE VOUCHER -->


    <!-- JIKA ALAMAT KOSONG FOR API WILAYAH-->
    @if (count($data['address']) !== 0)
    @else
        <script>
            // API WILAYAH FOR ADDRESS
            fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                .then((response) => response.json())
                .then((provinces) => {
                    const provinceSelect = document.getElementById("checkout_province");

                    provinces.forEach((province) => {
                        let option = document.createElement("option");
                        option.value = province.id;
                        option.text = province.name;
                        provinceSelect.appendChild(option);
                    });
                })
                .catch((error) => console.error("Error fetching provinces:", error));

            // Event listener for province selection
            // PILIH PROVINSI
            document
                .getElementById("checkout_province")
                .addEventListener("change", function() {
                    const provinceId = this.value;
                    const provinceName = this.options[this.selectedIndex].text; // Get the name
                    document.getElementById("checkout_province_name").value =
                        provinceName; // Save name in hidden input

                    const regencySelect = document.getElementById("checkout_regency");
                    regencySelect.innerHTML =
                        '<option value="">Pilih Kabupaten/Kota</option>';
                    document.getElementById("checkout_regency_name").value = ""; // Clear previous regency name

                    // GET DATA REGENCIES FROM PROVINCE
                    if (provinceId) {
                        fetch(
                                `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`
                            )
                            .then((response) => response.json())
                            .then((regencies) => {
                                regencies.forEach((regency) => {
                                    let option = document.createElement("option");
                                    option.value = regency.id;
                                    option.text = regency.name;
                                    regencySelect.appendChild(option);
                                });
                            })
                            .catch((error) =>
                                console.error("Error fetching regencies:", error)
                            );
                    }
                });

            document
                .getElementById("checkout_regency")
                .addEventListener("change", function() {
                    const regenciesId = this.value;
                    const regenciesName = this.options[this.selectedIndex].text; // Get the name
                    document.getElementById("checkout_regency_name").value =
                        regenciesName; // Save name in hidden input

                    const districtSelect = document.getElementById("checkout_district");
                    districtSelect.innerHTML =
                        '<option value="">Pilih Kecamatan</option>';
                    document.getElementById("checkout_district_name").value = ""; // Clear previous regency name

                    // GET DATA DISTRICT FROM REGENCY
                    if (regenciesId) {
                        fetch(
                                `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regenciesId}.json`
                            )
                            .then((response) => response.json())
                            .then((districts) => {
                                districts.forEach((district) => {
                                    let option = document.createElement("option");
                                    option.value = district.id;
                                    option.text = district.name;
                                    districtSelect.appendChild(option);
                                });
                            })
                            .catch((error) =>
                                console.error("Error fetching districts:", error)
                            );
                    }
                });

            // Event listener for regency selection
            document
                .getElementById("checkout_regency")
                .addEventListener("change", function() {
                    const regencyName = this.options[this.selectedIndex].text; // Get the name
                    document.getElementById("checkout_regency_name").value = regencyName; // Save name in hidden input
                });

            // Event listener for district selection
            document
                .getElementById("checkout_district")
                .addEventListener("change", function() {
                    const districtName = this.options[this.selectedIndex].text; // Get the name
                    document.getElementById("checkout_district_name").value =
                        districtName; // Save name in hidden input
                });
            // END API WILAYAH REGISTER
        </script>
    @endif

    <!-- JIKA LAMAT KOSONG MENAMPILKAN POP-UP TAMBAH ALAMAT PENGIRIMAN -->
    @if (count($data['address']) == 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('form-address-new'), {
                    backdrop: 'static', // Prevent closing when clicking outside the modal
                    keyboard: false // Prevent closing when pressing Esc
                });
                myModal.show();
            });
        </script>
    @endif

    <!-- MODAL CHANGE ADDRESS -->
    <div class="modal fade" id="change_address" tabindex="-1" aria-labelledby="change_address" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                <div class="modal-header border-none pb-0">
                    <h1 class="modal-title text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                        id="exampleModalLabel">Pilih Alamat Pengiriman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <button type="button" class="btn border btn-light d-flex align-items-center rounded-sm mb-2"
                        data-bs-dismiss="modal" id="open-add-address-modal">
                        <i
                            class="fas fa-thin fa-plus me-2 d-flex align-items-center text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]"></i>
                        <p class="text-black mb-0 text-[10px] md:text-[11px] lg:text-[13px] xl:text-[15px]">Tambahkan
                            Alamat</p>
                    </button>
                    @foreach ($data['address'] as $address)
                        @if ($address->is_use)
                            <div class="col-12 mb-2 p-0 shipping-address" id="shipping-address-{{ $address->id }}"
                                onclick="selectAddress(this)">
                                <div class="p-2 rounded-sm border border-dark">
                                    <div class="d-flex align-items-center">
                                        <p class="text-black mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">
                                            {{ $address->label }}</p>
                                        @if ($address->is_main)
                                            <span
                                                class="badge bg-[#ffffff] text-[#183018] d-flex align-items-center justify-content-center ml-auto
                                text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Utama</span>
                                        @endif
                                    </div>

                                    <div class="flex">
                                        <div class="col-10 p-0">
                                            <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black">
                                                {{ $address->recipient_name }}</p>
                                            <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">
                                                {{ $address->handphone }}</p>
                                            <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">
                                                {{ $address->district }}, {{ $address->regency }},
                                                {{ $address->Province }}</p>
                                            <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">
                                                {{ $address->address }}</p>
                                            @if ($address->benchmark)
                                                <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Patokan
                                                    ({{ $address->benchmark }})
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-2 p-0 d-flex flex-column align-items-start justify-content-center">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 mb-2 p-0 shipping-address" id="shipping-address-{{ $address->id }}"
                                onclick="selectAddress(this)">
                                <div class="p-2 rounded-sm custom-shadow">
                                    <div class="d-flex align-items-center">
                                        <p class="text-black mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">
                                            {{ $address->label }}</p>
                                        @if ($address->is_main)
                                            <span
                                                class="badge bg-[#ffffff] text-[#183018] d-flex align-items-center justify-content-center ml-auto
                            text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Utama</span>
                                        @endif
                                    </div>

                                    <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black">
                                        {{ $address->recipient_name }}</p>
                                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">
                                        {{ $address->handphone }}</p>
                                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">
                                        {{ $address->district }}, {{ $address->regency }}, {{ $address->Province }}</p>
                                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">
                                        {{ $address->address }}</p>
                                    @if ($address->benchmark)
                                        <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Patokan
                                            ({{ $address->benchmark }})</p>
                                    @endif

                                    <div class="d-flex gap-2 input-group-btn mt-2">
                                        <button type="button"
                                            class="bg-white hover:border-dark btn border w-full rounded-sm text-[#183018] text-[10px] md:text-[11px] lg:text-[13px] xl:text-[15px]"
                                            name="useAddress" data-id="{{ $address->id }}">
                                            Gunakan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL CHANGE ADDRESS -->

    <!-- MODAL TAMBAH ADDRESS -->
    <div class="modal fade" id="add_address" tabindex="-1" aria-labelledby="add_address" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                <div class="modal-header border-none pb-0">
                    <h1 class="modal-title text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                        id="exampleModalLabel">Tambahkan Alamat Baru</h1>
                    <button type="button" class="btn-close" id="close-modal-add-address" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body overflow-y-auto" style="max-height:100vh;">
                    <form method="POST" action="{{ route('add.shipping.address') }}" id="add-address-form">
                        @csrf
                        <div class="grid gap-1 gap-md-2">
                            <div class="grid md:flex">
                                <div class="col-md-6">
                                    <div class="col-12 p-0">
                                        <label for="label"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Label</label>
                                        <input type="text"
                                            class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            name="label" placeholder="Masukkan Nama Label Untuk Alamatmu" required>
                                    </div>
                                    <div class="col-12 p-0">
                                        <label for="receiver"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Nama
                                            Penerima</label>
                                        <input type="text"
                                            class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            name="recipient_name" placeholder="Masukkan Nama Penerima" required>
                                    </div>
                                    <div class="col-12 p-0">
                                        <label for="handphone"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Handphone</label>
                                        <div class="input-group">
                                            <span
                                                class="input-group-text text-red-700 text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                id="basic-addon1">+62</span>
                                            <input type="number"
                                                class="form-control rounded-end text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                                name="handphone" placeholder="Contoh : 8979254301"
                                                pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
                                        </div>
                                    </div>
                                    <!-- ALAMAT -->
                                    <div class="col-12 p-0">
                                        <label for="alamat"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Alamat</label>
                                        <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="address"
                                            rows="3" placeholder="Masukkan Alamatmu" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="col-12 p-0">
                                        <label for="provinsi"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Provinsi</label>
                                        <select
                                            class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            aria-label="Provinsi" name="province" id="add_checkout_province">
                                            <option
                                                class="text-primary text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                Pilih Provinsi</option>
                                        </select>
                                        <input type="hidden" name="province_name" id="add_checkout_province_name">
                                    </div>

                                    <div class="col-12 p-0">
                                        <label for="kabupaten/kota"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kabupaten/Kota</label>
                                        <select
                                            class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            aria-label="Kabupaten/Kota" name="regency" id="add_checkout_regency">
                                            <option class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih
                                                Kabupaten/Kota</option>
                                        </select>
                                        <input type="hidden" name="regency_name" id="add_checkout_regency_name">
                                    </div>

                                    <div class="col-12 p-0">
                                        <label for="kecamatan"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kecamatan</label>
                                        <select
                                            class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                            aria-label="Kecamatan" name="district" id="add_checkout_district">
                                            <option class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih
                                                Kecamatan</option>
                                        </select>
                                        <input type="hidden" name="district_name" id="add_checkout_district_name">
                                    </div>
                                    <!-- PATOKAN -->
                                    <div class="col-12 p-0">
                                        <label for="patokan"
                                            class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Patokan
                                            (Opsional)</label>
                                        <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="benchmark"
                                            rows="3" placeholder="Contoh : Depan Warung Soto Ayam Jepang"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- BUTTON SUBMIT -->
                            <div class="col-12 p-0">
                                <button
                                    class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    type="submit" style="background-color: #183018">Tambahkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL USE PROMO -->
    <div class="modal fade" id="promo" tabindex="-1" aria-labelledby="promo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                <div class="modal-header border-none pb-0">
                    <h1 class="modal-title text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                        id="exampleModalLabel">Gunakan Voucher Promo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-1 p-md-3">
                    <div class="col-12 p-0">

                        {{-- @php
                        // Pisahkan voucher berdasarkan kondisi yang bisa digunakan atau tidak
                        $usableVouchers = $data['vouchers']->filter(function ($voucher) use ($data) {
                            return $data['totalPrice'] >= $voucher->min_transaction && $data['totalItem'] <= $voucher->max_quantity_buyer;
                        });
                        $unusableVouchers = $data['vouchers']->filter(function ($voucher) use ($data) {
                            return $data['totalPrice'] < $voucher->min_transaction || $data['totalItem'] > $voucher->max_quantity_buyer;
                        });
                    @endphp --}}

                        @if (count($data['vouchers']) !== 0)
                        @else
                            <div style="display:flex; align-items:center; justify-content:start;">
                                <img src="images/voucher-empty.png" class="img-fluid"
                                    style="width:10%; height:100%; object-fit: cover;" alt=Voucher kosong">
                                <p class="text-danger text-md">Maaf tidak ada voucher tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer flex">
                    <div class="grid">
                        <p class="text-muted text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] d-none"
                            id="hore">Horee.. Kamu hemat,</p>
                        <p class="text-[#183018] text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]" id="thrifty">
                        </p>
                    </div>
                    <div class="ml-auto">
                        <button type="button"
                            class="btn btn-danger w-fit text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px] rounded-sm"
                            onclick="window.location.reload()">Reset Voucher</button>
                        <button type="button"
                            class="btn bg-[#183018] text-white hover:shadow-sm w-fit text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px] rounded-sm"
                            data-bs-dismiss="modal" aria-label="Close">Gunakan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHECK KODE VOUCHER TERSEDIA ATAU TIDAK -->
    <script>
        $('#code-voucher').on('keyup', function() {
            var code = $(this).val();
            if (code) {
                $.ajax({
                    url: "{{ route('check.code.voucher') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        code: code
                    },
                    beforeSend: function() {
                        // Tampilkan spinner sebelum request dimulai
                        $('.spinner-border').show();
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#validationVoucher').text('Kode Voucher Tersedia').addClass(
                                'text-success').show();
                            $('#button-code-voucher').prop('disabled', false);
                            $('.cancel-code-voucher').show();
                        } else {
                            $('#validationVoucher').text('Kode Voucher Tidak Tersedia').addClass(
                                'text-danger').show();
                            $('#button-code-voucher').prop('disabled', true);
                        }
                    },
                    complete: function() {
                        // Sembunyikan spinner setelah request selesai
                        $('.spinner-border').hide();
                    },
                    error: function() {
                        console.log(error);
                        // Jika ada error, tetap sembunyikan spinner
                        $('.spinner-border').hide();
                    }
                });
            }
        });
    </script>

    <!-- GUNAKAN VOUCHER -->
    <script>
        // MEMAKAI INPUT VOUCHER
        $(document).on("click", "#button-code-voucher", function(e) {
            e.preventDefault();
            var voucherCode = $("#code-voucher").val();
            var spinner = $("#voucher-spinner");
            var button = $("#button-code-voucher");

            // Tampilkan spinner dan disable tombol
            spinner.show();
            button.prop('disabled', true);
            console.log(voucherCode);

            $.ajax({
                url: "{{ route('apply.voucher') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    code_voucher: voucherCode
                },
                success: function(response) {
                    spinner.hide();
                    button.prop('disabled', false);

                    if (response.success) {
                        // Update rincian biaya di halaman checkout
                        function formatRupiah(number) {
                            return 'Rp' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        };

                        $("#total-price").text(formatRupiah(response
                            .totalPriceFormatted)); // Mengubah teks total harga ke format Rupiah
                        $("#discount").text("-" + formatRupiah(response
                            .discountFormatted)); // Mengubah teks diskon ke format Rupiah
                        $("#total-shopping").text(formatRupiah(response
                            .totalShoppingFormatted)); // Mengubah teks total belanja ke format Rupiah
                        $("#discount-use").removeClass("d-none").addClass(
                            "d-flex"); // Hapus class d-none dan ubah menjadi d-flex
                        $("#validationVoucher").text("Kode promo berhasil diterapkan.").addClass(
                            'text-success').show();
                        $('#button-code-voucher').prop('disabled', true);
                        $('#show-voucher').prop('disabled', true);
                        $('#discount-amount').prop('value', response.discountFormatted);
                        $("#subtotal-price").prop('value', response.totalShoppingFormatted);
                        console.log(response.request);
                        // $("#subtotalPrice").val(response.totalPriceFormatted);
                    } else {
                        $("#validationVoucher").text(response.message).show();
                    }
                },
                error: function(xhr) {
                    spinner.hide();
                    button.prop('disabled', false);
                    $("#validationVoucher").text("Terjadi kesalahan. Silakan coba lagi.").show();
                }
            });
        });
    </script>

    <script>
        // Function to toggle promo details
        function toggleDetail(event, detailId, link) {
            event.stopPropagation(); // Prevent the click from bubbling up to the promo item
            const detail = document.querySelector(detailId);
            const isVisible = detail.style.display === 'block';

            // Toggle detail visibility
            if (isVisible) {
                detail.style.display = 'none';
                link.textContent = 'S&K';
            } else {
                detail.style.display = 'block';
                link.textContent = 'Tutup Detail';
            }
        }

        // Function to highlight selected promo
        let selectedPromoCode = null;
        let selectedOngkirCode = null;

        function selectPromo(promoElement, promo_code, voucherType) {
            const isPromoType = voucherType === 'voucher';
            const isOngkirType = voucherType === 'product voucher';

            // Check if the voucher being clicked is already selected
            if ((isPromoType && selectedPromoCode === promo_code) || (isOngkirType && selectedOngkirCode === promo_code)) {
                // Deselect the voucher
                promoElement.querySelector('.grid').classList.remove('border-dark');
                promoElement.querySelector('.fas.fa-check').classList.add('hidden');

                if (isPromoType) {
                    selectedPromoCode = null;
                } else if (isOngkirType) {
                    selectedOngkirCode = null;
                }

                // Reset display values (optional)
                resetVoucherDisplay();
                return;
            }

            // Clear previously selected voucher of the same type
            if (isPromoType && selectedPromoCode) {
                document.querySelector(`.promo-item[data-code="${selectedPromoCode}"] .grid`).classList.remove(
                    'border-dark');
                document.querySelector(`.promo-item[data-code="${selectedPromoCode}"] .fas.fa-check`).classList.add(
                    'hidden');
            } else if (isOngkirType && selectedOngkirCode) {
                document.querySelector(`.promo-item[data-code="${selectedOngkirCode}"] .grid`).classList.remove(
                    'border-dark');
                document.querySelector(`.promo-item[data-code="${selectedOngkirCode}"] .fas.fa-check`).classList.add(
                    'hidden');
            }

            // Set the selected voucher
            if (isPromoType) {
                selectedPromoCode = promo_code;
            } else if (isOngkirType) {
                selectedOngkirCode = promo_code;
            }

            // Update UI for the selected voucher
            promoElement.querySelector('.grid').classList.add('border', 'border-dark');
            promoElement.querySelector('.fas.fa-check').classList.remove('hidden');

            // Send AJAX request only if the voucher was selected
            $.ajax({
                url: "{{ route('apply.voucher') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    code_voucher: promo_code
                },
                success: function(response) {
                    if (response.success) {
                        updateVoucherDisplay(response);
                    } else {
                        $("#validationVoucher").text(response.message).show();
                    }
                },
                error: function(xhr) {
                    $("#validationVoucher").text("Terjadi kesalahan. Silakan coba lagi.").show();
                }
            });
        }

        // Helper function to update the display with the selected voucher details
        function updateVoucherDisplay(response) {
            function formatRupiah(number) {
                return 'Rp' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            $(".input-code").addClass("d-none");
            $("#total-price").text(formatRupiah(response.totalPriceFormatted));
            $("#discount").text("-" + formatRupiah(response.discountFormatted));
            $("#total-shopping").text(formatRupiah(response.totalShoppingFormatted));
            $("#discount-use").removeClass("d-none").addClass("d-flex");
            $("#validationVoucher").text("Kode promo berhasil diterapkan.").addClass('text-success').show();
            $('#button-code-voucher').prop('disabled', true);
            $('#show-voucher').prop('disabled', false);
            $('#code-coupont').prop('value', response.code);
            $('#discount-amount').prop('value', response.discountFormatted);
            $("#subtotal-price").prop('value', response.totalShoppingFormatted);
            $("#thrifty").text(formatRupiah(response.discountFormatted));
            $("#hore").removeClass("d-none").addClass("d-flex");
        }

        // Helper function to reset display (if needed)
        function resetVoucherDisplay() {
            $("#total-price").text("");
            $("#discount").text("");
            $("#total-shopping").text("");
            $("#validationVoucher").text("");
            $("#discount-use").removeClass("d-flex").addClass("d-none");
            $('#button-code-voucher').prop('disabled', false);
            $('#show-voucher').prop('disabled', true);
            $('#code-coupont').prop('value', "");
            $('#discount-amount').prop('value', "");
            $("#subtotal-price").prop('value', "");
            $("#thrifty").text("");
            $("#hore").addClass("d-none");
        }


        function selectAddress(addressElement) {
            const allAddress = document.querySelectorAll('.shipping-address');

            allAddress.forEach(address => {
                promo.querySelector('.grid').classList.remove('border-dark');
                promo.querySelector('.fas.fa-check').classList.add('hidden');
            });

            // Add border to the selected promo
            promoElement.querySelector('.grid').classList.add('border', 'border-dark');
            promoElement.querySelector('.fas.fa-check').classList.remove('hidden');
        }

        $(document).on('click', 'button[name="useAddress"]', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('use.shipping.address') }}",
                type: 'POST',
                data: {
                    address_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Toast.fire({
                        icon: "success",
                        text: response.message,
                        title: "Berhasil",
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        }
                    }).then(function() {
                        location.reload(); // Redirect ke halaman utama atau halaman lain
                    });
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: "error",
                        text: "Kesalahan Sistem",
                        title: "Oops..",
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        }
                    });
                }
            });
        });
    </script>

    <!-- MENGATUR POP -->
    <script>
        $('#open-add-address-modal').on('click', function() {
            $('#change_address').modal('toggle'); // Gunakan jQuery untuk menutup modal
            setTimeout(function() {
                $('#add_address').modal('show'); // Tampilkan modal setelah modal pertama tertutup
            }, 500);
        });

        function cancelCode() {
            location.reload();
        }
    </script>

    <!-- API WILAYAH FOR ADDRESS -->
    <script>
        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then((response) => response.json())
            .then((provinces) => {
                const provinceSelect = document.getElementById("add_checkout_province");

                provinces.forEach((province) => {
                    let option = document.createElement("option");
                    option.value = province.id;
                    option.text = province.name;
                    provinceSelect.appendChild(option);
                });
            })
            .catch((error) => console.error("Error fetching provinces:", error));

        // Event listener for province selection
        // PILIH PROVINSI
        document
            .getElementById("add_checkout_province")
            .addEventListener("change", function() {
                const provinceId = this.value;
                const provinceName = this.options[this.selectedIndex].text; // Get the name
                document.getElementById("add_checkout_province_name").value =
                    provinceName; // Save name in hidden input

                const regencySelect = document.getElementById("add_checkout_regency");
                regencySelect.innerHTML =
                    '<option value="">Pilih Kabupaten/Kota</option>';
                document.getElementById("add_checkout_regency_name").value = ""; // Clear previous regency name

                // GET DATA REGENCIES FROM PROVINCE
                if (provinceId) {
                    fetch(
                            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`
                        )
                        .then((response) => response.json())
                        .then((regencies) => {
                            regencies.forEach((regency) => {
                                let option = document.createElement("option");
                                option.value = regency.id;
                                option.text = regency.name;
                                regencySelect.appendChild(option);
                            });
                        })
                        .catch((error) =>
                            console.error("Error fetching regencies:", error)
                        );
                }
            });

        document
            .getElementById("add_checkout_regency")
            .addEventListener("change", function() {
                const regenciesId = this.value;
                const regenciesName = this.options[this.selectedIndex].text; // Get the name
                document.getElementById("add_checkout_regency_name").value =
                    regenciesName; // Save name in hidden input

                const districtSelect = document.getElementById("add_checkout_district");
                districtSelect.innerHTML =
                    '<option value="">Pilih Kecamatan</option>';
                document.getElementById("add_checkout_district_name").value = ""; // Clear previous regency name

                // GET DATA DISTRICT FROM REGENCY
                if (regenciesId) {
                    fetch(
                            `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regenciesId}.json`
                        )
                        .then((response) => response.json())
                        .then((districts) => {
                            districts.forEach((district) => {
                                let option = document.createElement("option");
                                option.value = district.id;
                                option.text = district.name;
                                districtSelect.appendChild(option);
                            });
                        })
                        .catch((error) =>
                            console.error("Error fetching districts:", error)
                        );
                }
            });

        // Event listener for regency selection
        document
            .getElementById("add_checkout_regency")
            .addEventListener("change", function() {
                const regencyName = this.options[this.selectedIndex].text; // Get the name
                document.getElementById("add_checkout_regency_name").value = regencyName; // Save name in hidden input
            });

        // Event listener for district selection
        document
            .getElementById("add_checkout_district")
            .addEventListener("change", function() {
                const districtName = this.options[this.selectedIndex].text; // Get the name
                document.getElementById("add_checkout_district_name").value =
                    districtName; // Save name in hidden input
            });
        // END API WILAYAH REGISTER
    </script>

    @if (session('after_add_address'))
        <script>
            Toast.fire({
                icon: "success",
                text: "Berhasil menambahkan alamat pengiriman",
                title: "Berhasil",
                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        </script>
    @endif
@endsection

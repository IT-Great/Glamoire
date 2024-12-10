@extends('user.layouts.master')

@section('content')

<div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 pt-1 pt-md-2 h-fit">
    <div class="container-fluid px-0 px-md-3">
        <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3 px-0 px-md-3">
            <div class="d-flex gap-1 px-3 px-md-0">
                <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                <a href="/cart" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Keranjang</a>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pembayaran</a>
            </div>
        </div>
    </div>

    <div class="row gap-2 gap-md-0 m-0 p-0 mb-2">
        <div class="col-lg-8 grid gap-2 px-0 px-md-3">
            @if (count($data['address']) !== 0)
                @foreach ($data['address'] as $checkout_address)
                    @if($checkout_address->is_use)
                        <div class="col-12 md:shadow-md md:rounded p-md-3 py-2 py-md-0 border-bottom border-top md:border-none">
                            <h1 class="font-semibold text-black text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] mb-2">Alamat Pengiriman</h1>
                            <div class="grid gap-1 gap-md-2 mb-md-2">
                                <div class="d-flex gap-1 gap-md-2 align-items-center">
                                    <i class="fas fa-location-arrow text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"></i>
                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $checkout_address->label }}</p>
                                    <p class="font-bold text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">.</p>
                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $checkout_address->recipient_name }}</p>
                                </div>
                                <div class="d-flex gap-1 gap-md-2">
                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $checkout_address->address }}</p>
                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">({{ $checkout_address->benchmark }})</p>
                                </div>
                                <div class="d-flex">
                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ ucwords(strtolower($checkout_address->district)) }}, {{ ucwords(strtolower($checkout_address->regency)) }}, {{ ucwords(strtolower($checkout_address->province)) }}
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] bg-[#183018] hover:bg-neutral-900" data-bs-toggle="modal" data-bs-target="#change_address">
                                        Ubah Alamat
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
            <!-- MODAL TAMBAH ALAMAT -->
            <div class="modal fade" id="form-address-new" tabindex="-1" aria-labelledby="form-address-new" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                    <div class="modal-header" style="background-color: #183018">
                        <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]" id="exampleModalLabel">Tambahkan Alamat Baru</h1>
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
                            <button class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] bg-[#183018] hover:bg-neutral-900" type="submit">Tambahkan</button>
                            </div>

                                        </div>
                                    </form>

                    </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL TAMBAH ALAMAT -->
            @endif
            
        <form class="grid gap-2">
                @csrf
                <div class="col-12 md:shadow-md md:rounded border-bottom border-top md:border-none p-md-3 px-3 px-md-0 py-2 py-md-0">
                    <h1 class="font-semibold text-black text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] mb-2">Rincian Pengiriman</h1>
                    <div class="grid gap-1 gap-md-2 mb-md-2">
                        <div class="flex gap-1 align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15"; viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 48c0-26.5 21.5-48 48-48L592 0c26.5 0 48 21.5 48 48l0 416c0 26.5-21.5 48-48 48l-210.7 0c1.8-5 2.7-10.4 2.7-16l0-242.7c18.6-6.6 32-24.4 32-45.3l0-32c0-26.5-21.5-48-48-48l-112 0 0-80zM571.3 347.3c6.2-6.2 6.2-16.4 0-22.6l-64-64c-6.2-6.2-16.4-6.2-22.6 0l-64 64c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L480 310.6 480 432c0 8.8 7.2 16 16 16s16-7.2 16-16l0-121.4 36.7 36.7c6.2 6.2 16.4 6.2 22.6 0zM0 176c0-8.8 7.2-16 16-16l352 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16L16 224c-8.8 0-16-7.2-16-16l0-32zm352 80l0 224c0 17.7-14.3 32-32 32L64 512c-17.7 0-32-14.3-32-32l0-224 320 0zM144 320c-8.8 0-16 7.2-16 16s7.2 16 16 16l96 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-96 0z"/></svg>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Dikirim dari Kota Surabaya, Jawa Timur</p>
                        </div>
                        <div class="flex gap-1 align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15"; viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M112 0C85.5 0 64 21.5 64 48l0 48L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 208 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 224l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 288l0 128c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L112 0zM544 237.3l0 18.7-128 0 0-96 50.7 0L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/>
                            </svg>
                            @foreach ($data['address'] as $checkout_address)
                            @if($checkout_address->is_use)
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Menuju {{ ucwords(strtolower($checkout_address->district)) }}, {{ ucwords(strtolower($checkout_address->regency)) }}, {{ ucwords(strtolower($checkout_address->province)) }}
                                </p>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex gap-1 align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15"; viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M112 0C85.5 0 64 21.5 64 48l0 48L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 208 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 224l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 288l0 128c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L112 0zM544 237.3l0 18.7-128 0 0-96 50.7 0L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/>
                            </svg>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Berat Produk : 
                            @if ($data['weight'] < 1000)
                                {{ $data['weight'] }}gr
                            @else
                                {{ number_format($data['weight'] / 1000, 1) }}kg
                            @endif

                            </p>
                        </div>
                        <div class="flex gap-1 align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15"; height="15"; viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 112.5L0 422.3c0 18 10.1 35 27 41.3c87 32.5 174 10.3 261-11.9c79.8-20.3 159.6-40.7 239.3-18.9c23 6.3 48.7-9.5 48.7-33.4l0-309.9c0-18-10.1-35-27-41.3C462 15.9 375 38.1 288 60.3C208.2 80.6 128.4 100.9 48.7 79.1C25.6 72.8 0 88.6 0 112.5zM288 352c-44.2 0-80-43-80-96s35.8-96 80-96s80 43 80 96s-35.8 96-80 96zM64 352c35.3 0 64 28.7 64 64l-64 0 0-64zm64-208c0 35.3-28.7 64-64 64l0-64 64 0zM512 304l0 64-64 0c0-35.3 28.7-64 64-64zM448 96l64 0 0 64c-35.3 0-64-28.7-64-64z"/></svg>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Tarif Pengiriman :</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]" id="shipping_price"></p>
                        </div>
                        <div id="shipping-fee" class="shipping">
                            <!-- SHIPPING -->
                            <select class="form-select text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="chooseShippingFee" name="shipping_fee" id="choose_shipping_fee">
                                @foreach ($data['shippingFee'] as $sp)
                                    <option value="{{ $sp['id'] }}">{{ $sp['description'] }} - Rp{{ number_format($sp['value'], 0, ',', '.') }} (estimasi {{ $sp['etd'] }} hari)</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        
                @foreach ($data['cartItems'] as $cart => $product)
                <div class="col-12 p-0 md:shadow-md md:border border-bottom border-top md:rounded p-md-3 px-3 px-md-0 py-2 py-md-0">
                    <div class="grid">
                        <h1 class="text-black font-semibold text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] mb-1 mb-md-2">Produk - {{ $cart + 1 }}</h1>
                    </div>  
    
                    {{-- Produk Biasa --}}
                    @if ($product->productVariant == null)
                        <div class="flex">
                            <div class="w-[70px] h-[70px] w-md-[110px] h-md-[110px]">
                                <img src="{{ Storage::url($product->product->main_image) }}" alt="gambar produk" class="rounded-sm border">
                            </div>
                            <div class="col p-0">
                                <div class="flex col-12 gap-1 gap-md-2 pl-1 pl-md-3">
                                    <p class="font-semibold text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $product->product->brand->name }}</p>
                                </div>
                                <div class="grid lg:flex">
                                    <div class="col-lg-9 pl-1 pl-md-3">
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $product->product->product_name }}</p>
                                    </div>
                                    <div class="col-lg-3 p-lg-0 pl-1 pl-md-3">
                                        @if ($product->bundle_price !== null)
                                            <div class="grid gap-1 font-semibold">
                                                <div>
                                                    <del class="d-flex gap-1">
                                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[11px] xl:text-[12px] text-muted">{{ $product->quantity }}</p>
                                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[11px] xl:text-[12px] text-muted">X</p>
                                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[11px] xl:text-[12px] text-muted">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                                    </del>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beli {{ $product->quantity }}</p>
                                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">jadi</p>
                                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($product->bundle_price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex gap-1 font-semibold ml-auto">
                                                <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $product->quantity }}</p>
                                                <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">X</p>
                                                <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    {{-- Produk varian --}}
                    @else
                        <div class="flex">
                            <div class="w-[70px] h-[70px] w-md-[110px] h-md-[110px]">
                                <img src="{{ Storage::url($product->productVariant->variant_image) }}" alt="gambar produk" class="rounded-sm border">
                            </div>
                            <div class="col p-0">
                                <div class="flex col-12 gap-1 gap-md-2 pl-1 pl-md-3">
                                    <p class="font-semibold text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $product->product->brand->name }}</p>
                                </div>
                                <div class="grid lg:flex">
                                    <div class="col-lg-9 pl-1 pl-md-3">
                                        <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $product->product->product_name }}</p>
                                        <span class="w-fit bg-[#183018] text-white py-1 px-2 rounded-sm text-[9px] md:text-[9px] lg:text-[9px] xl:text-[11px] text-center text-decoration-non">
                                            {{ $product->productVariant->variant_value }}
                                        </span>
                                    </div>
                                    <div class="col-lg-3 p-lg-0 pl-1">
                                        <div class="d-flex gap-1 font-semibold">
                                            <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $product->quantity }}</p>
                                            <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">X</p>
                                            <p class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    
        <!-- PERHITUNGAN -->
        <div class="col-lg-4 pl-0 pl-md-3 pr-0 pr-md-3 pl-lg-0 mt-0 mt-md-2 mt-lg-0">
            <div class="position-sticky" style="top: 4.5rem">
                <div class="p-3 bg-light rounded shadow-sm border border-[#183018] grid gap-2 gap-md-2">
                    <h1 class="font-semibold text-black text-[14px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Rincian Biaya</h1>
    
                    <div class="grid gap-1">
                        <div class="d-flex">
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Total Harga ({{ $data['totalProduct'] }} Barang)</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto">Rp{{ number_format($data['totalPrice'], 0, ',', '.') }}</p>
                            </div>
                        <div class="d-none" id="discount-use">
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Diskon</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto" id="discount"></p>
                        </div>
                        <div class="d-flex">
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Ongkos Kirim</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto" id="ongkir-user">{{ $data['ongkir'] }}</p>
                        </div>
                        <div class="d-none" id="ongkir-use">
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Diskon Ongkir</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto" id="ongkir"></p>
                        </div>
                        <div class="d-none" id="ongkir-use-after">
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Ongkir</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] ml-auto" id="ongkir-after"></p>
                        </div>
                    </div>
                    <div class="d-flex py-2 border-bottom border-top align-items-center">
                        <p class="text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Total Belanja</p>
                        <p class="text-black font-semibold text-[12px] md:text-[12px] lg:text-[16px] xl:text-[18px] ml-auto" id="total-shopping">Rp{{ number_format(($data['totalPrice']), 0, ',', '.') }}</p>
                        </div>
                    <div>
                        <div class="relative flex gap-1 items-center input-code">
                            <div class="cancel-code-voucher text-[#183018] absolute" role="status" style="display:none;" id="cancel-code-voucher" title="Hapus Kode">
                                <button type="button" class="btn rounded-sm w-fit font-semibold text-sm text-danger" onclick="removeCode()" id="cancelCode">X</button>
                            </div>
                            <input type="text" class="form-control pl-5 w-full rounded-sm text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="code-voucher" name="code_voucher" placeholder="Masukkan kode promo">
                            <div class="ml-2 spinner-border text-[#183018] absolute" role="status" style="width:15px; height:15px;display:none;" id="voucher-spinner">
                                <span class="visually-hidden"></span>
                            </div>
                            <button type="button" id="button-code-voucher" class="btn border rounded-sm w-fit text-white text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover-shadow-md" style="background-color: #183018" disabled>
                                Pakai
                            </button>
                        </div>
                        <div id="validationVoucher" class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                        </div>
                    </div>
                    <button type="button" class="d-flex align-items-center btn btn-primary rounded-sm text-black text-[6px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-bs-toggle="modal" data-bs-target="#promo" style="background-color: #FFFFFF" id="show-voucher">
                        <i class="fas fa-solid fa-tag mr-2 text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"></i>
                        <p class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="choose-voucher">Pilih Voucher</p>
                        <i class="fas fa-solid fa-arrow-right ml-auto text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]"></i>
                    </button>
                    <button class="hover:cursor-pointer py-2 text-decoration-none rounded-sm hover:bg-neutral-900 shadow-sm px-3 text-white bg-[#183018] w-full text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]" id="paynow">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
        
        </form>
    </div>
</div>

@include('spinner')

<script>    
    let ongkir = null;
    let productItems = {!! json_encode($data['cartItems']) !!};
    let productIds = [];
    let productVariantIds = {};
    let productQuantities = {};
    let productPrices = {};
    let voucher = null;
    let totalPrice = {{ $data['totalPrice'] }};
    let shippingAddressId = {{ $data['shippingAddressId'] }};
    let totalItem = {{ $data['totalProduct'] }};
    let subTotal = 0;
    let totalItemPrice = {{ $data['totalPrice'] }};
    let originalTotalShopping = null;

    // Voucher-related variables
    let selectedPromoCode = null; // Discount voucher code
    let selectedOngkirCode = null; // Shipping voucher code
    let selectedProductCode = null; // Product voucher code
    let selectedBrandCode = null; // Brand voucher code
    let discountAmount = 0; // Discount from promo voucher
    let shippingDiscountAmount = 0; // Diskon Paten
    let shippingDiscount = 0; 

    let formattedData = {}; // Objek hasil akhir

    productItems.forEach((product, index) => {
        formattedData[index] = {
            product_id: product.product_id,
            quantity: product.quantity,
            price: product.price,
            product_variant_id: product.product_variant_id || null // Gunakan null jika product_variant_id tidak ada
        };
    });

    // Output example
    // console.log(formattedData);


    // ONGKIR - Shipping
    const shippingFee = document.getElementById("choose_shipping_fee");

    // Function to fetch and update 'ongkir' based on selected shipping service
    function updateOngkir() {
        const selectedService = shippingFee.value.trim();

        if (selectedService) {
            $.ajax({
                url: '/checkout', 
                type: 'GET',
                data: { service: selectedService },
                beforeSend: function() {
                    $('.loading-container').show();
                },
                success: function(response) {
                    ongkir = response.ongkir;
                    // Update `shippingDiscount` based on current `ongkir` and `shippingDiscountAmount`
                    shippingDiscountAmount = 0;
                    shippingDiscount = Math.min(ongkir, shippingDiscountAmount);

                    // Update displayed prices with the latest values
                    updateOngkirDisplay();
                },
                complete: function() {
                    $('.loading-container').hide();
                },
                error: function(error) {
                    console.error("Failed to fetch ongkir:", error);
                }
            });
        }
    }

    // Function to update display or calculations that use 'ongkir'
    function updateOngkirDisplay() {
        if (ongkir !== null) {
            $("#shipping_price").text("Rp" + formatRupiah(ongkir));
            $("#ongkir-user").text("Rp" + formatRupiah(ongkir));

            // Calculate the subtotal based on `ongkir`, promo discount, and shipping discount
            subTotal = totalPrice + ongkir - discountAmount - shippingDiscount;
            $("#total-shopping").text("Rp" + formatRupiah(subTotal));

            // Display the shipping discount if applied
            if (shippingDiscount > 0) {
                $("#ongkir").text("-Rp" + formatRupiah(shippingDiscount));
                $("#ongkir-use").removeClass("d-none").addClass("d-flex");
            } else {
                $("#ongkir-use").removeClass("d-flex").addClass("d-none");
            }
        }
    }

    // Event listener for shipping option change
    shippingFee.addEventListener("change", function() {
        updateOngkir(); // Update 'ongkir' when shipping option changes
    });

    // Initialize 'ongkir' on page load if an option is selected
    if (shippingFee) {
        updateOngkir();
    }

    // Format numbers to Indonesian Rupiah
    function formatRupiah(number) {
        return 'Rp' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // END ONGKIR

    // ITEM PRODUK
    productItems.forEach(product => {
        productIds.push(product.product_id);
        productQuantities[product.product_id] = product.quantity;
        productPrices[product.product_id] = product.price;
        productVariantIds[product.product_id] = product.product_variant_id;
    });
    // END ITEM PRODUK

    // GUNAKAN VOUCHER 
    $(document).on("click", "#button-code-voucher", function (e) {
        e.preventDefault();
        var voucherCode = $("#code-voucher").val();
        var spinner = $("#voucher-spinner");
        var button = $("#button-code-voucher");
        var cancel = $("#cancelCode");

        spinner.show();
        button.prop('disabled', true);

        $.ajax({
            url: "{{ route('apply.voucher.new.user') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                code_voucher: voucherCode,
            },
            beforeSend: function() {
                $('.loading-container').show(); // Show the spinner
            },
            success: function(response) {
                spinner.hide();
                button.prop('disabled', false);
                
                if (response.success) {
                    console.log(response.discountFormatted);
                    $("#discount").text("-Rp" + formatRupiah(response.discountFormatted));
                    $("#discount-use").removeClass("d-none").addClass("d-flex");
                    $("#choose-voucher").text("Kode promo berhasil diterapkan.").addClass('text-success').show();
                    $('#button-code-voucher').prop('disabled', true);
                    $('#show-voucher').prop('disabled', true);
                    $("#code-voucher").prop('disabled', true);
                    $('#validationVoucher').text("Kode promo berhasil diterapkan.").addClass('text-success').show();
                    
                    subTotal = totalPrice + ongkir - response.discountFormatted;
                    discountAmount = response.discountFormatted;
                    selectedPromoCode = voucherCode;
                    $("#total-shopping").text("Rp"+formatRupiah(subTotal));
                    
                    cancel.show();
                    voucher = response.code;
                } else {
                    $("#validationVoucher").text(response.message).show();
                }
            },
            complete: function() {
                $('.loading-container').hide(); // Show the spinner
            },
            error: function(xhr) {
                spinner.hide();
                button.prop('disabled', false);
                $("#validationVoucher").text("Terjadi kesalahan. Silakan coba lagi.").show();
            }
        });
    });
    // END GUNAKAN VOUCHER
    
    function removeCode() {
        subTotal = totalPrice + ongkir;
        $("#discount-use").removeClass("d-flex").addClass("d-none"); // Hapus class d-none dan ubah menjadi d-flex
        $("#code-voucher").prop('value', "");
        $("#code-voucher").prop('disabled', false);
        $("#total-shopping").text("Rp"+formatRupiah(subTotal));
        $('#button-code-voucher').prop('disabled', true);
        $("#choose-voucher").text("Pilih Voucher").addClass("text-dark").show();
        $("#choose-voucher").removeClass("text-success").addClass("text-dark");
        $('#show-voucher').prop('disabled', false);
        

        discountAmount = 0;
        selectedPromoCode = null;
        var cancel = $("#cancelCode");
        var validation = $("#validationVoucher");
        cancel.hide();
        validation.hide();
    }
    
    $('#code-voucher').on('keyup', function () {
        var code = $(this).val();
        var cancel = $("#cancelCode");
        
        if (code === "") {
            $('#validationVoucher').text("");
        } 
        
        if (code) {
            $.ajax({
                url: "{{ route('check.code.voucher') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    code: code
                },
                beforeSend: function() {
                    cancel.hide();
                    // Tampilkan spinner sebelum request dimulai
                    $('.spinner-border').show();
                },
                success: function (response) {
                    if (response.exists) {
                        $('#validationVoucher').text('Kode Voucher Tersedia').addClass('text-success').show();
                        $('#button-code-voucher').prop('disabled', false);
                        $('.cancel-code-voucher').show();
                    } else {
                        $('#validationVoucher').text('Kode Voucher Tidak Tersedia').addClass('text-danger').show();
                        $('#button-code-voucher').prop('disabled', true);
                    }
                },
                complete: function() {
                    // Sembunyikan spinner setelah request selesai
                    $('.spinner-border').hide();
                },
                error: function() {
                    // console.log(error);
                    // Jika ada error, tetap sembunyikan spinner
                    $('.spinner-border').hide();
                }
            });
        }
    });

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

    function saveOriginalValues(response) {
        // Store the discount amounts from the response
        if (response.discountFormatted !== null) {
            discountAmount = response.discount; // Get discount amount from response
        }
        if (response.ongkir) {
            shippingDiscount = response.ongkir; // Get shipping discount from response
        }
    }

    function selectPromo(promoElement, promo_code, voucherType) {
        // Constants for different voucher types
        const isPromoType = voucherType === 'limited voucher';
        const isOngkirType = voucherType === 'ongkir voucher';
        const isProductType = voucherType === 'product voucher';
        const isBrandType = voucherType === 'brand voucher';

        // Check if the voucher being clicked is already selected
        if ((isPromoType && selectedPromoCode === promo_code) ||
            (isOngkirType && selectedOngkirCode === promo_code) ||
            (isProductType && selectedPromoCode === promo_code) ||
            (isBrandType && selectedPromoCode === promo_code)) {

            // UI Update: Remove border and check icon
            promoElement.querySelector('.grid').classList.remove('border-dark');
            promoElement.querySelector('.fas.fa-check').classList.add('hidden');

            // Reset the appropriate selected code
            if (isPromoType) {
                selectedPromoCode = null;
                discountAmount = 0; // Reset discount
            } else if (isOngkirType) {
                selectedOngkirCode = null;
                shippingDiscount = 0; // Reset shipping discount
            } else if (isProductType) {
                selectedPromoCode = null; // Reset product voucher
                discountAmount = 0;
            } else if (isBrandType) {
                selectedPromoCode = null; // Reset brand voucher
                discountAmount = 0;
            }

            // Restore UI if no discounts are active
            if (shippingDiscount === 0 && discountAmount === 0) {
                $(".input-code").removeClass("d-none");
            }

            restoreOriginalValues(); // Reset calculations
            $("#choose-voucher").text("Pilih Voucher").removeClass("text-success").addClass("text-dark").show();
            return;
        }



        // Ensure only one voucher is selected among limited, brand, and product categories
        if (isPromoType || isProductType || isBrandType) {
            resetAllVouchersExceptOngkir(); // Reset all vouchers in the limited/brand/product categories
        }

        $(".input-code").addClass("d-none");
        $("#choose-voucher").text("Voucher digunakan").removeClass("text-dark").addClass("text-success").show();

        // Set the selected voucher
        if (isPromoType) {
            selectedPromoCode = promo_code;
        } else if (isOngkirType) {
            selectedOngkirCode = promo_code;
        } else if (isProductType) {
            selectedPromoCode = promo_code;
        } else if (isBrandType) {
            selectedPromoCode = promo_code;
        }

        // Update UI for the selected voucher
        promoElement.querySelector('.grid').classList.add('border', 'border-dark');
        promoElement.querySelector('.fas.fa-check').classList.remove('hidden');

        // Make AJAX request to get voucher details
        $.ajax({
            url: "{{ route('check.apply.voucher') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                code_voucher_promo: selectedPromoCode,
                code_voucher_ongkir: selectedOngkirCode,
                shipping_cost: ongkir,
            },
            beforeSend: function () {
                $('.loading-container').show(); // Show the spinner
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.tes);
                    if (shippingDiscountAmount !== 0) {
                        if (shippingDiscountAmount > ongkir) {
                            shippingDiscount = ongkir;
                        }
                        else {
                            shippingDiscount = shippingDiscount;
                        }
                    }
                    saveOriginalValues(response); // Save values for later restoration
                    updateTotals(response); // Update totals based on the response
                    updateThriftyDisplay(response); // Show savings based on the response
                } else {
                    $("#validationVoucher").text(response.message).show();
                }
            },
            complete: function () {
                $('.loading-container').hide(); // Hide the spinner
            },
            error: function (xhr) {
                $("#validationVoucher").text("Terjadi kesalahan. Silakan coba lagi.").show();
            }
        });
    }

    // Fungsi untuk mereset semua voucher selain ongkir
    function resetAllVouchersExceptOngkir() {
        const voucherTypes = ['limited voucher', 'product voucher', 'brand voucher'];
        voucherTypes.forEach(type => {
            let selectedCode = null;
            if (type === 'limited voucher') selectedCode = selectedPromoCode;
            if (type === 'product voucher') selectedCode = selectedProductCode;
            if (type === 'brand voucher') selectedCode = selectedBrandCode;

            if (selectedCode) {
                const prevElement = document.querySelector(`.promo-item[data-code="${selectedCode}"]`);
                if (prevElement) {
                    prevElement.querySelector('.grid').classList.remove('border-dark');
                    prevElement.querySelector('.fas.fa-check').classList.add('hidden');
                }
            }

            // Clear the selected codes
            if (type === 'limited voucher') selectedPromoCode = null;
            if (type === 'product voucher') selectedProductCode = null;
            if (type === 'brand voucher') selectedBrandCode = null;
        });

        // Reset discounts
        discountAmount = 0;
    }


    // Function to update totals based on selected vouchers
    function updateTotals(response) {
        if (response.discount) {
            discountAmount = parseInt(response.discount.replace(/\./g, ''), 10); // Get discount amount from response
            
            if (response.discount !== null) {
                $("#discount").text("-Rp"+formatRupiah(discountAmount));
                $("#discount-use").removeClass("d-none").addClass("d-flex");
                $(".input-code").removeClass("d-flex").addClass("d-done");
            }
        }
        if (response.ongkir) {
            shippingDiscountAmount = parseInt(response.ongkirCalculate.replace(/\./g, ''), 10); // Get shipping discount from response
            shippingDiscount = parseInt(response.ongkir.replace(/\./g, ''), 10); // Get shipping discount from response
            console.log(
                {
                    ongkir: response.ongkir,
                    ongkirCalculate: response.ongkirCalculate,

                }
            )
            if (response.ongkir !== null) {
                $("#ongkir").text("-Rp"+formatRupiah(shippingDiscount));
                // $("#ongkir-after").text("Total setelah diskon :"+formatRupiah(discountOngkirAfter));
                $("#ongkir-use").removeClass("d-none").addClass("d-flex");
                // $("#ongkir-use-after").removeClass("d-none").addClass("d-flex");
                $(".input-code").removeClass("d-flex").addClass("d-done");
            }
        }

        subTotal = totalPrice + ongkir - discountAmount - shippingDiscount;
        // subTotal = response.totalShoppingFormatted;
        
        // Update the display with the new total
        $("#total-shopping").text("Rp"+formatRupiah(subTotal));
    }

    // Restore original values
    function restoreOriginalValues() {
        let newTotal = totalPrice + ongkir - discountAmount - shippingDiscount;
        subTotal = newTotal;
        
        if (discountAmount == 0 || discountAmount == null) {
            $("#discount-use").removeClass("d-flex").addClass("d-none");
        }
        if (shippingDiscount == 0) {
            $("#ongkir-use").removeClass("d-flex").addClass("d-none");
            $("#ongkir-use-after").removeClass("d-flex").addClass("d-none");
        }

        if (shippingDiscount == 0 && discountAmount == 0) {
            $(".input-code").removeClass("d-none").addClass("d-flex");
            $("#choose-voucher").text("Pilih Voucher").addClass("text-dark").show();
            $(".input-code").removeClass("d-none").addClass("d-flex");
        }

        updateThriftyDisplay(newTotal);
        $("#total-shopping").text("Rp"+formatRupiah(subTotal));
    }

    // Function to update the display with the savings
    function updateThriftyDisplay(response) {
        let totalSavings = discountAmount + shippingDiscount; // Calculate total savings
        // console.log(totalSavings);
        if (totalSavings == 0) {
            $("#hore").removeClass("d-flex").addClass("d-none");
            $("#thrifty").addClass("d-none"); 
        }
        else{
            $("#thrifty").text("Rp"+formatRupiah(totalSavings)); // Display total savings
            $("#thrifty").removeClass("d-none"); 
            $("#hore").removeClass("d-none").addClass("d-flex");
            $("#discount").removeClass("d-none").addClass("d-flex");
            $("#ongkir").removeClass("d-none").addClass("d-flex");
        }
    }

    // Function to format number to Rupiah
    function formatRupiah(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
        // console.log(id);
        $.ajax({
            url: "{{ route('use.shipping.address') }}",
            type: 'POST',
            data: {
                address_id: id,
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('.loading-container').show(); // Show the spinner
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
            complete: function() {
                $('.loading-container').hide(); // Show the spinner
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
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                });
            }
        });
    });

    
    // $(document).on('click', '#paynow', function(e) { 
    //     e.preventDefault();
    
    //     $.ajax({
    //         url: "{{ route('order.payment') }}",
    //         type: 'POST',
    //         data: {
    //             products: formattedData,
    //             subtotal: subTotal,          // Removed the colon inside the key
    //             shipping_cost: ongkir,
    //             shipping_address_id: shippingAddressId,
    //             total_item: totalItem,
    //             total_item_price: totalItemPrice,
    //             discount_amount: discountAmount,
    //             discount_ongkir: shippingDiscount,
    //             voucher_promo: selectedPromoCode,
    //             voucher_ongkir: selectedOngkirCode,
    //             _token: '{{ csrf_token() }}'
    //         },
    //         beforeSend: function() {
    //             $('.loading-container').show(); // Show the spinner
    //         },
    //         success: function(response) {
    //             Toast.fire({
    //                 icon: "success",
    //                 text: "Silahkan cek orderanku di bagian profile saya untuk detail orderanmu",
    //                 title: "Pembayaranmu Berhasil",
    //                 willOpen: () => {
    //                     const title = document.querySelector('.swal2-title');
    //                     const content = document.querySelector('.swal2-html-container');
    //                     if (title) title.style.color = '#ffffff'; // Ubah warna judul
    //                     if (content) content.style.color = '#ffffff'; // Ubah warna konten
    //                 }
    //             }).then(function () {
    //                 location.href = response.user_id+"_account"; // Redirect ke halaman utama atau halaman lain
    //             });
    //         },
    //         complete: function() {
    //             $('.loading-container').hide(); // Show the spinner
    //         },
    //         error: function(xhr) {
    //             Toast.fire({
    //                 icon: "error",
    //                 text: "Kesalahan Sistem",
    //                 title: "Oops..",
    //                 willOpen: () => {
    //                     const title = document.querySelector('.swal2-title');
    //                     const content = document.querySelector('.swal2-html-container');
    //                     if (title) title.style.color = '#ffffff'; // Ubah warna judul
    //                     if (content) content.style.color = '#ffffff'; // Ubah warna konten
    //                 }
    //             });
    //         }
    //     });
    // });

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
        // console.log(subTotal);
        e.preventDefault();

        // Show loading state
        $('#paynow').prop('disabled', true);
        $('#dokuPaymentModal').modal('show');

        // Prepare form data
        // const formData = {
        //     total_amount: subTotal,
        // };

        // Make AJAX request
        $.ajax({
            url: '/initiate-doku-payment',
            method: 'POST',
            data: {
                total_amount: subTotal,
                products: formattedData,
                subtotal: subTotal,          // Removed the colon inside the key
                shipping_cost: ongkir,
                shipping_address_id: shippingAddressId,
                total_item: totalItem,
                total_item_price: totalItemPrice,
                discount_amount: discountAmount,
                discount_ongkir: shippingDiscount,
                voucher_promo: selectedPromoCode,
                voucher_ongkir: selectedOngkirCode,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && response.payment_url) {
                    // console.log(response.payment_url);
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

</script>

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

<!-- JIKA ALAMAT KOSONG MENAMPILKAN POP-UP TAMBAH ALAMAT PENGIRIMAN -->
@if(count($data['address']) == 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('form-address-new'), {
                backdrop: 'static', // Prevent closing when clicking outside the modal
                keyboard: false     // Prevent closing when pressing Esc
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
        <h1 class="modal-title text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">Pilih Alamat Pengiriman</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body overflow-y-auto custom-scroll">
        <button type="button" class="btn border btn-light d-flex align-items-center rounded-sm mb-2"  data-bs-dismiss="modal" id="open-add-address-modal">
            <i class="fas fa-thin fa-plus me-2 d-flex align-items-center text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]"></i>
            <p class="text-black mb-0 text-[10px] md:text-[11px] lg:text-[13px] xl:text-[15px]">Tambahkan Alamat</p>
        </button>
        @foreach ($data['address'] as $address)
            @if ($address->is_use)
                <div class="col-12 mb-2 p-0 shipping-address" id="shipping-address-{{ $address->id }}" onclick="selectAddress(this)">
                    <div class="p-2 rounded-sm border border-dark">
                        <div class="d-flex align-items-center">
                            <p class="text-black mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">{{ $address->label }}</p>
                            @if ($address->is_main)
                                <span class="badge bg-[#ffffff] text-[#183018] d-flex align-items-center justify-content-center ml-auto
                                text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Utama</span>
                                        @endif
                                    </div>

                        <div class="flex">
                            <div class="col-10 p-0">
                                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black">{{ $address->recipient_name }}</p>
                                <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">{{ $address->handphone }}</p>
                                <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">{{ $address->district }}, {{ $address->regency }}, {{ $address->province }}</p>
                                <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">{{ $address->address }}</p>
                                @if ($address->benchmark)
                                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Patokan ({{ $address->benchmark }})</p>
                                @endif
                            </div>
                            <div class="col-2 p-0 d-flex flex-column align-items-start justify-content-center">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="col-12 mb-2 p-0 shipping-address" id="shipping-address-{{ $address->id }}" onclick="selectAddress(this)">
                <div class="p-2 rounded-sm custom-shadow">
                    <div class="d-flex align-items-center">
                        <p class="text-black mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">{{ $address->label }}</p>
                        @if ($address->is_main)
                            <span class="badge bg-[#ffffff] text-[#183018] d-flex align-items-center justify-content-center ml-auto
                            text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Utama</span>
                        @endif
                    </div>
                    
                    <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black">{{ $address->recipient_name }}</p>
                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">{{ $address->handphone }}</p>
                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">{{ $address->district }}, {{ $address->regency }}, {{ $address->Province }}</p>
                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">{{ $address->address }}</p>
                    @if ($address->benchmark)
                        <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Patokan ({{ $address->benchmark }})</p>
                    @endif
    
                    <div class="d-flex gap-2 input-group-btn mt-2">
                        <button type="button" class="bg-white hover:border-dark btn border w-full rounded-sm text-[#183018] text-[10px] md:text-[11px] lg:text-[13px] xl:text-[15px]" name="useAddress" data-id="{{ $address->id }}">
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

<!-- MODAL RINCIAN PENGIRIMAN -->
<div class="modal fade" id="shipping_details" tabindex="-1" aria-labelledby="shipping_details" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content overflow-y-auto" style="max-height:90vh;">
      <div class="modal-header border-none pb-0">
        <h1 class="modal-title text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Pengiriman</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @foreach ($data['shippingFee'] as $sp)
            <div class="col-12 mb-2 p-0 shipping-fee-detail" id="shipping-fee-{{ $sp['id'] }}" onclick="selectShipping(this)">
                <div class="p-2 rounded-sm custom-shadow">
                    
                    <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black">{{ $sp['description'] }}</p>
                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($sp['value'], 0, ',', '.') }}</p>
                    <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] ">Estimasi {{ $sp['etd'] }} hari</p>
    
                    <div class="d-flex gap-2 input-group-btn mt-2">
                        <button type="button" class="bg-white hover:border-dark btn border w-full rounded-sm text-[#183018] text-[10px] md:text-[11px] lg:text-[13px] xl:text-[15px]" name="useShipping" data-id="{{ $sp['id'] }}">
                            Gunakan
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    </div>
  </div>
</div>
<!-- END MODAL RINCIAN PENGIRIMAN -->

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
                <button class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] bg-[#183018] hover:bg-neutral-900" type="submit">Tambahkan</button>
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
            <div class="modal-header border-none bg-[#183018]">
                <div class="flex gap-3 justify-content-center align-items-center">
                    <h1 type="button" class="text-white font-semibold" data-bs-dismiss="modal" aria-label="Close">X</h1>
                    <h1 class="modal-title text-white text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Gunakan Voucher Promo</h1>
                </div>
            </div>

            <div class="modal-body p-2 p-md-3 overflow-y-auto custom-scroll">
                <div class="col-12 p-0 gap-1">

                    @php
                        $brandIds = $data['cartItems']->pluck('brand_id'); // Ambil semua brand_id dari cartItems
                        $productIds = $data['cartItems']->pluck('product_id');

                        $voucherDisabled = $data['voucherDisabled'];
                        // Filter voucher berdasarkan kecocokan dengan brand_id di cartItems
                        $usableVouchers = $data['vouchers']->filter(function ($voucher) use ($data, $brandIds, $productIds, $voucherDisabled) {
                            if ($voucherDisabled == false) {
                                if ($voucher->type == 'brand voucher') {
                                    return 
                                        $productIds->intersect($data['brandVoucherIds'])->isNotEmpty() &&
                                        $data['totalPrice'] >= $voucher->min_transaction &&
                                        $data['totalItem'] <= $voucher->max_quantity_buyer;
                                } elseif ($voucher->type == 'product voucher') {
                                    return 
                                        $productIds->intersect($data['productVoucherIds'])->isNotEmpty() &&
                                        $data['totalPrice'] >= $voucher->min_transaction &&
                                        $data['totalItem'] <= $voucher->max_quantity_buyer;
                                } else {
                                    return 
                                        $data['totalPrice'] >= $voucher->min_transaction &&
                                        $data['totalItem'] <= $voucher->max_quantity_buyer;
                                    }
                                }else {
                                    if ($voucher->type == 'ongkir voucher') {
                                        return 
                                            $data['totalPrice'] >= $voucher->min_transaction &&
                                            $data['totalItem'] <= $voucher->max_quantity_buyer;
                                }
                            }
                        });

                        $unusableVouchers = $data['vouchers']->filter(function ($voucher) use ($data, $brandIds, $productIds, $voucherDisabled) {
                                if ($voucher->type == 'brand voucher') {
                                    return
                                        $voucherDisabled == true ||
                                        $productIds->intersect($data['brandVoucherIds'])->isEmpty() ||
                                        $data['totalPrice'] < $voucher->min_transaction ||
                                        $data['totalItem'] > $voucher->max_quantity_buyer;
                                } elseif ($voucher->type == 'product voucher') {
                                    return 
                                        $voucherDisabled == true ||
                                        $productIds->intersect($data['productVoucherIds'])->isEmpty() ||
                                        $data['totalPrice'] < $voucher->min_transaction ||
                                        $data['totalItem'] > $voucher->max_quantity_buyer;
                                } elseif ($voucher->type == 'ongkir voucher') {
                                    return 
                                        $data['totalPrice'] < $voucher->min_transaction ||
                                        $data['totalItem'] > $voucher->max_quantity_buyer;
                                } else {
                                    return 
                                        $voucherDisabled == true ||
                                        $data['totalPrice'] < $voucher->min_transaction ||
                                        $data['totalItem'] > $voucher->max_quantity_buyer;
                                }
                        });


                    @endphp

                    @if (count($data['vouchers']) !== 0)
                    
                        @if ($usableVouchers->isNotEmpty())
                            <h5 class="text-[#183018] text-[10px] md:text-[10px] lg:text-[11px] xl:text-[13px] mt-1 mt-md-0 font-semibold mb-1">Voucher yang bisa digunakan</h5>
                            @foreach ($usableVouchers as $voucher)
                                <div class="col-12 p-1 p-md-2 promo-item" data-code="{{ $voucher->promo_code }}" onclick="selectPromo(this, '{{ $voucher->promo_code }}', '{{$voucher->type}}')">
                                    <div class="grid gap-1 p-2 border rounded-sm bg-light cursor-pointer  custom-shadow">
                                        <div class="flex">
                                            <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($voucher->type) }} - {{ ucwords($voucher->promo_name) }}</p>
                                            <i class="fas fa-check hidden ml-auto"></i>
                                        </div>

                                        <div class="flex">
                                            @if ($voucher->discount)
                                                @if ($voucher->discount >= 0 && $voucher->discount <= 100)
                                                    <p class="text-[10px] md:text-[10px] lg:text-[11px] xl:text-[13px] text-[#183018]">Diskon {{ $voucher->discount }}%</p>
                                                @elseif ($voucher->discount >= 10000 && $voucher->discount <= 1000000)
                                                    <p class="text-[10px] md:text-[10px] lg:text-[11px] xl:text-[13px] text-[#183018]">Diskon Rp{{ number_format($voucher->discount, 0, ',', '.') }}</p>
                                                @else
                                                    <p class="text-danger">Diskon tidak valid</p>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="d-flex gap-1 gap-md-2 align-items-center">
                                            <i class="fas fa-regular fa-clock text-[#183018]"></i>
                                            @php
                                                $endDate = explode(' - ', $voucher->date_range)[1];
                                            @endphp

                                            <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-[#183018]">
                                                Berlaku hingga {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                                            </p>
                                            <a class="ml-auto text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-danger text-decoration-none" onclick="toggleDetail(event, '#detail-promo-{{$voucher->id}}', this)">S&K</a>
                                        </div>

                                        <div class="grid mt-1 mt-md-3 detail-promo" id="detail-promo-{{$voucher->id}}" style="display: none;">
                                            <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black font-semibold">Syarat & Ketentuan</p>
                                            <ol class="list-group-numbered overflow-y-auto custom-scroll" style="max-height:100px;">
                                                <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Minimal transaksi sebesar Rp{{ number_format($voucher->min_transaction, 0, ',', '.') }}</p>
                                                </li>
                                                <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Maksimal pembelian {{ $voucher->max_quantity_buyer }} jenis produk</p>
                                                </li>
                                                @if ($voucher->brand_id !== null)
                                                    <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                        <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Khusus pembelian product brand {{ $voucher->brand_name }}</p>
                                                    </li>
                                                @endif
                                                @if ($voucher->products->first() !== null)
                                                    <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                        <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Khusus pembelian produk :<br> 
                                                            @if ($voucher->products->isNotEmpty())
                                                                @foreach ($voucher->products as $index => $product)
                                                                    - {{ $product->product_name }} <br>
                                                                @endforeach
                                                            @else
                                                                Tidak ada produk khusus.
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                        @if ($unusableVouchers->isNotEmpty())
                            <h5 class="text-[#183018] text-[12px] md:text-[10px] lg:text-[11px] xl:text-[13px] mt-1 mt-md-0 font-semibold mb-1">Voucher tersedia</h5>
                            @foreach ($unusableVouchers as $voucher)
                                <div class="col-12 p-1 p-md-2 promo-item" onclick="event.stopPropagation()">
                                    <div class="grid gap-1 p-2 border rounded-sm bg-light cursor-pointer custom-shadow">
                                        <div class="flex">
                                            <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-muted font-semibold">{{ ucwords($voucher->type) }} - {{ ucwords($voucher->promo_name) }}</p>
                                            <i class="fas fa-check hidden ml-auto"></i>
                                        </div>

                                        <div>
                                        @if ($voucher->discount)
                                            @if ($voucher->discount >= 0 && $voucher->discount <= 100)
                                                {{-- Diskon dalam bentuk persentase --}}
                                                <p class="text-[10px] md:text-[10px] lg:text-[11px] xl:text-[13px]">Diskon {{ $voucher->discount }}%</p>
                                            @elseif ($voucher->discount >= 10000 && $voucher->discount <= 1000000)
                                                {{-- Diskon dalam bentuk nominal --}}
                                                <p class="text-[10px] md:text-[10px] lg:text-[11px] xl:text-[13px]">Diskon Rp{{ number_format($voucher->discount, 0, ',', '.') }}</p>
                                            @else
                                                {{-- Nilai diskon tidak valid --}}
                                                <p class="text-danger">Diskon tidak valid</p>
                                            @endif
                                        @endif
                                        </div>

                                        <div class="d-flex gap-1 gap-md-2 align-items-center">
                                            <i class="fas fa-regular fa-clock"></i>
                                            @php
                                                $endDate = explode(' - ', $voucher->date_range)[1];
                                            @endphp

                                            <p class="text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">
                                                Berlaku hingga {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                                            </p>
                                            <a class="ml-auto text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-danger text-decoration-none" onclick="toggleDetail(event, '#detail-promo-{{$voucher->id}}', this)">S&K</a>
                                        </div>

                                        <div>
                                            @if($voucher->type !== 'ongkir voucher')
                                                @if ($data['voucherDisabled'] == true)
                                                    <p class="text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] text-danger">- Voucher tidak bisa digunakan bersama dengan promo produk lainnya</p>
                                                @endif
                                            @endif

                                            @if ($data['totalPrice'] < $voucher->min_transaction)
                                                <p class="text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] text-danger">- Oops.. Kurang Rp{{ number_format($voucher->min_transaction - $data['totalPrice'], 0, ',', '.') }} lagi</p>
                                            @endif
                                            
                                            @if ($data['totalItem'] > $voucher->max_quantity_buyer)
                                                <p class="text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] text-danger">- Jumlah produk yang kamu beli melebihi S&K voucher ini</p>
                                            @endif
                                            
                                            @if ($voucher->type == 'brand voucher')
                                                <p class="text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] text-danger">- Hanya bisa digunakan untuk produk brand {{ $voucher->brand_name }}</p>
                                            @endif

                                            @if ($voucher->type == 'product voucher')
                                                <p class="text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] text-danger">- Tidak bisa digunakan untuk produk yang kamu beli</p>
                                            @endif
                                        </div>

                                        <div class="grid mt-3 detail-promo" id="detail-promo-{{$voucher->id}}" style="display: none;">
                                            <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-black font-semibold">Syarat & Ketentuan</p>
                                            <ol class="list-group-numbered overflow-y-auto custom-scroll" style="max-height:100px;">
                                                <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Minimal transaksi sebesar Rp{{ number_format($voucher->min_transaction, 0, ',', '.') }}</p>
                                                </li>
                                                <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Maksimal pembelian {{ $voucher->max_quantity_buyer }} jenis produk</p>
                                                </li>
                                                @if ($voucher->brand_id !== null)
                                                    <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                        <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Khusus pembelian product brand {{ $voucher->brand_name }}</p>
                                                    </li>
                                                @endif
                                                @if ($voucher->products->first() !== null)
                                                    <li class="list-group-item p-1 border-none d-flex align-items-start text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px]">
                                                        <p class="ml-2 text-[10px] md:text-[10px] lg:text-[9px] xl:text-[11px] mb-0">Khusus pembelian produk :<br> 
                                                            @if ($voucher->products->isNotEmpty())
                                                                @foreach ($voucher->products as $index => $product)
                                                                    - {{ $product->product_name }} <br>
                                                                @endforeach
                                                            @else
                                                                Tidak ada produk khusus.
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div style="display:flex; align-items:center; justify-content:start;">
                            <img src="images/voucher-empty.png" class="img-fluid" style="width:10%; height:100%; object-fit: cover;" alt=Voucher kosong">
                            <p class="text-danger text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Maaf tidak ada voucher tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
                        

            @if (count($data['vouchers']) !== 0)
                <div class="modal-footer flex">
                    <div class="grid">
                        <p class="text-muted text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] d-none" id="hore">Horee.. Kamu hemat,</p>
                        <p class="text-[#183018] text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]" id="thrifty"></p>
                    </div>
                    <div class="grid">
                        <p class="text-[#183018] text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]" id="discountPrice"></p>
                        <p class="text-[#183018] text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]" id="ongkirPrice"></p>
                    </div>
                    <div class="ml-auto">
                        <!-- <button type="button" class="btn btn-danger rounded-sm text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" onclick="window.location.reload()">Reset Voucher</button> -->
                        <button type="button" class="btn btn-success rounded-sm text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="choose-voucher" data-bs-dismiss="modal">Gunakan</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


<!-- MENGATUR POP -->
<script>
    $('#open-add-address-modal').on('click', function() {
        $('#change_address').modal('toggle');  // Gunakan jQuery untuk menutup modal
        setTimeout(function() {
            $('#add_address').modal('show'); // Tampilkan modal setelah modal pertama tertutup
        }, 500);
    });
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

@if(session('after_add_address'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: "center",
            background: "#183018",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            customClass: {
                popup: "small-swal", // Add custom class
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });
        Toast.fire({
            icon: "success",
            text: "Berhasil menambahkan alamat pengiriman",
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

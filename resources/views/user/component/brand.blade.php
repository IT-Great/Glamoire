
@extends('user.layouts.master')

@section('content')
@php
    foreach($brands as $brand) {
        $brandName = $brand->name;
    }
@endphp
<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-2 p-0">
                <div class="position-sticky mb-3 rounded-md shadow-md p-2 border border-[#183018]" style="top: 4rem">
                <div class="d-flex justify-content-center text-align-center">
                    <p class="font-semibold text-black text-[10px] md:text-[14px] lg:text-[18px] xl:text-[22px]">Deskripsi</p>
                </div>
                @foreach ($brands as $brand)
                <div class="flex md:grid pb-2">
                <img src="images/brand-empty-logo.png" alt="{{ $brand->name }}" title="{{ $brand->name }}" class="img-fluid w-1/2 md:w-full">
                <div>
                    <h1 class="font-semibold text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] py-2">{{ $brand->name }}</h1>
                    <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] text-justify">
                        {{$brand->description}}
                    </p>
                </div>
                </div>
                @endforeach
                </div>
            </div>

            <div class="col-md-10 px-0">
                <div class="col tabbable">
                    <div class="nav nav-tabs justify-content-start border-secondary">
                        <a class="nav-item nav-link active text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#beranda">Beranda</a>
                        <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#allproduct">Semua Produk</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="beranda">
                            <!-- BRAND VOUCHER -->
                            <div class="mt-2 mt-md-3">
                                @if (count($brandVouchers) !== 0)
                                <p class="font-semibold text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-2 pl-1 pr-3 mb-1 mb-md-2" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
                                    Voucher Belanja dari {{ $brandName }}
                                </p>
                                    <div class="swiper mySwiperVoucher">
                                        <div class="swiper-wrapper">
                                            @foreach ($brandVouchers as $voucher)
                                                <div class="swiper-slide p-0">
                                                    <img src="{{ Storage::url($voucher->image) }}" class="hover:cursor-pointer shadow-md rounded-sm product-image-home" title="{{ $voucher->promo_name }}" id="image-voucher-{{ $voucher->id }}" alt="{{ $voucher->promo_name }}" data-bs-toggle="modal" data-bs-target="#voucher-{{ $voucher->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- END BRAND VOUCHER -->
            
                            <!-- PRODUK TERBARU -->
                            <div>
                                <div class="text-center">
                                    <p class="section-title my-3 px-5 text-[14px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terbaru</span></p>
                                </div>
                                @if (count($brand->products) !== 0)
                                    <div class="swiper mySwiperNewest">
                                        <div class="swiper-wrapper">
                                                @if (session('id_user'))
                                                    @foreach ($newest as $product)  
                                                        <div class="swiper-slide p-0">
                                                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                                                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                                                    <img class="img-fluid w-100 product-image-home rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                                </div>
                                                                <div class="grid text-left p-2">
                                                                    <div class="flex gap-1">
                                                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                                        @php
                                                                            $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                                                                        @endphp
                                                                        <i 
                                                                            class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                                            onclick="{{ $inWishlist ? 'event.stopPropagation();removeFromWishlist(' . $product->id . ')' : 'event.stopPropagation();addToWishlist(' . $product->id . ')' }}">
                                                                        </i>
                                                                    </div>
                                                                    <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] overflow-hidden">
                                                                        <a href="/{{ $product->product_code }}_product" 
                                                                        class="text-decoration-none truncate-ellipsis" 
                                                                        data-bs-toggle="tooltip" 
                                                                        data-bs-placement="top" 
                                                                        title="{{ $product->product_name }}">
                                                                            {{ $product->product_name }}
                                                                        </a>
                                                                    </p>
                                                                    <div class="flex justify-content-start gap-1">
                                                                        @php
                                                                            $activePromo = $product->promos->first();
                                                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                                                        @endphp
                
                                                                        @if ($product->priceVariation !== null)
                                                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                {{ $product->priceVariation }}
                                                                            </p>
                                                                        @else
                                                                            @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                            <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                                                <del>
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                                </del>
                                                                            </p>
                                                                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                                            @else
                                                                            <p class="text-decoration-none text-[#183018] text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                            </p>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                    {{-- @if ($product->stock_quantity == 0)
                                                                        <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="top" 
                                                                            title="Beritahu Saya Jika Stok Sudah Ada" 
                                                                            type="button" 
                                                                            style="color:#183018"
                                                                            id="notify-me-{{$product->id}}"
                                                                            onclick="event.stopPropagation();notifyMe({{$product->id}})"
                                                                        >
                                                                            Stok Habis
                                                                        </a>
                                                                    @else
                                                                        @php
                                                                            $inCart = collect($cartItems)->contains('product_id', $product->id);
                                                                        @endphp
            
                                                                        @if($inCart)
                                                                            <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[7px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                                                                                Cek Keranjang
                                                                            </a>
                                                                        @else
                                                                            <a class="py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                                                + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                            </a>
                                                                        @endif
                                                                    @endif --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach ($newest as $product)
                                                        <div class="swiper-slide p-0">
                                                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                                                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                                                    <img class="product-image-home img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                                </div>
                                                                <div class="grid text-left p-2">
                                                                    <div class="flex gap-1">
                                                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                                        <i 
                                                                            class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                                            onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                                                        </i>
                                                                    </div>
                                                                    <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] overflow-hidden">
                                                                        <a href="/{{ $product->product_code }}_product" 
                                                                        class="text-decoration-none truncate-ellipsis" 
                                                                        data-bs-toggle="tooltip" 
                                                                        data-bs-placement="top" 
                                                                        title="{{ $product->product_name }}">
                                                                            {{ $product->product_name }}
                                                                        </a>
                                                                    </p>
                                                                    <div class="flex justify-content-start gap-1">
                                                                        @php
                                                                            $activePromo = $product->promos->first();
                                                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                                                        @endphp

                                                                        @if ($product->priceVariation !== null)
                                                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                {{ $product->priceVariation }}
                                                                            </p>
                                                                        @else
                                                                            @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                            <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                                                <del>
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                                </del>
                                                                            </p>
                                                                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                                            @else
                                                                            <p class="text-decoration-none text-[#183018] text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                            </p>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                    {{-- @if ($product->stock_quantity == 0)
                                                                        <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="top" 
                                                                            title="Beritahu Saya Jika Stok Sudah Ada" 
                                                                            type="button" 
                                                                            style="color:#183018"
                                                                            id="notify-me-{{$product->id}}"
                                                                            onclick="event.stopPropagation();notifyMe({{$product->id}})"
                                                                        >
                                                                            Stok Habis
                                                                        </a>
                                                                    @else
                                                                        <a class="py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                                            + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                        </a>
                                                                    @endif --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <img src="images/product-empty.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                                    </div>
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <p class="text-danger text-md">Maaf belum ada produk di brand ini</p>
                                    </div>  
                                @endif
                            </div>
                            <!-- END PRODUK TERBARU -->
                            
                            <!-- PRODUK TERLARIS -->
                            <div>
                                <div class="text-center">
                                    <p class="section-title my-3 px-5 text-[14px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terlaris</span></p>
                                </div>
                                @if (count($brand->products) !== 0)
                                    <div class="swiper mySwiperTop">
                                        <div class="swiper-wrapper">
                                                @if (session('id_user'))
                                                    @foreach($top as $product)
                                                        <div class="swiper-slide p-0">
                                                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                                                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                                                    <img class="product-image-home img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                                </div>
                                                                <div class="grid text-left p-2">
                                                                    <div class="flex gap-1">
                                                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                                        @php
                                                                            $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                                                                        @endphp
                                                                        <i 
                                                                            class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                                            onclick="{{ $inWishlist ? 'event.stopPropagation();removeFromWishlist(' . $product->id . ')' : 'event.stopPropagation();addToWishlist(' . $product->id . ')' }}">
                                                                        </i>
                                                                    </div>
                                                                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                                                        <a href="/{{ $product->product_code }}_product" 
                                                                        class="text-decoration-none truncate-ellipsis" 
                                                                        data-bs-toggle="tooltip" 
                                                                        data-bs-placement="top" 
                                                                        title="{{ $product->product_name }}">
                                                                            {{ $product->product_name }}
                                                                        </a>
                                                                    </p>
                                                                    <div class="flex justify-content-start gap-1">
                                                                        @php
                                                                            $activePromo = $product->promos->first();
                                                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                                                        @endphp
            
                                                                        @if ($product->priceVariation !== null)
                                                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                {{ $product->priceVariation }}
                                                                            </p>
                                                                        @else
                                                                            @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                            <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                <del>
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                                </del>
                                                                            </p>
                                                                            <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                                            @else
                                                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                            </p>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                    {{-- @if ($product->stock_quantity == 0)
                                                                        <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="top" 
                                                                            title="Beritahu Saya Jika Stok Sudah Ada" 
                                                                            type="button" 
                                                                            style="color:#183018"
                                                                            id="notify-me-{{$product->id}}"
                                                                            onclick="event.stopPropagation();notifyMe({{$product->id}})"
                                                                        >
                                                                            Stok Habis
                                                                        </a>
                                                                    @else
                                                                        @php
                                                                            $inCart = collect($cartItems)->contains('product_id', $product->id);
                                                                        @endphp
            
                                                                        @if($inCart)
                                                                            <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[7px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                                                                                Cek Keranjang
                                                                            </a>
                                                                        @else
                                                                            <a class="py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                                                + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                            </a>
                                                                        @endif
                                                                    @endif --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach ($top as $product)
                                                        <div class="swiper-slide p-0">
                                                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                                                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                                                    <img class="product-image-home img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                                </div>
                                                                <div class="grid text-left p-2">
                                                                    <div class="flex gap-1">
                                                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                                        <i 
                                                                            class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                                            onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                                                        </i>
                                                                    </div>
                                                                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                                                        <a href="/{{ $product->product_code }}_product" 
                                                                        class="text-decoration-none truncate-ellipsis" 
                                                                        data-bs-toggle="tooltip" 
                                                                        data-bs-placement="top" 
                                                                        title="{{ $product->product_name }}">
                                                                            {{ $product->product_name }}
                                                                        </a>
                                                                    </p>
                                                                    <div class="flex justify-content-start gap-1">
                                                                        @php
                                                                            $activePromo = $product->promos->first();
                                                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                                                        @endphp
            
                                                                        @if ($product->priceVariation !== null)
                                                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                {{ $product->priceVariation }}
                                                                            </p>
                                                                        @else
                                                                            @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                            <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                <del>
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                                </del>
                                                                            </p>
                                                                            <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                                            @else
                                                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                            </p>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                    {{-- @if ($product->stock_quantity == 0)
                                                                        <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                                            data-bs-toggle="tooltip" 
                                                                            data-bs-placement="top" 
                                                                            title="Beritahu Saya Jika Stok Sudah Ada" 
                                                                            type="button" 
                                                                            style="color:#183018"
                                                                            id="notify-me-{{$product->id}}"
                                                                            onclick="event.stopPropagation();notifyMe({{$product->id}})"
                                                                        >
                                                                            Stok Habis
                                                                        </a>
                                                                    @else
                                                                        <a class="py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                                            + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                        </a>
                                                                    @endif --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                            @endif
                                        </div>
                                        
                                    </div>
                                @else
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <img src="images/product-empty.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                                    </div>
                                    <div style="display:flex; align-items:center; justify-content:center;">
                                        <p class="text-danger text-md">Maaf belum ada produk di brand ini</p>
                                    </div>  
                                @endif
                            </div>
                            <!-- END PRODUK TERLARIS -->
                        </div>
                        <div class="tab-pane fade" id="allproduct">
                            <!-- SEMUA PRODUK -->
                            <div>
                                <div class="text-center">
                                    <p class="section-title my-3 px-5 text-[14px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Semua Produk</span></p>
                                </div>
                                <div class="row">
                                    <div id="skeletonLoader" class="skeleton-loader">
                                        @for ($i = 0; $i < $countBrand ; $i++) <!-- Adjust the number based on how many you want to show -->
                                        <div class="skeleton-card">
                                            <div class="skeleton-image"></div>
                                            <div class="skeleton-text"></div>
                                            <div class="skeleton-text small"></div>
                                            <div class="skeleton-price"></div>
                                        </div>
                                        @endfor
                                    </div>
            
                                    <!-- Card Items -->
                                    <div id="productList" style="display: none;" class="px-0 px-md-2 mb-12 mb-md-0">
                                        @foreach ($brands as $brands)
                                            @if (session('id_user'))
                                                @if (count($brands->products) !== 0)
                                                    <div class="grid-container-shop" style="min-height:48vh;">
                                                        @foreach ($top as $product)
                                                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                                                            <div class="product-image-container">
                                                                <img class="product-image-home" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                            </div>
                                                            <div class="grid text-left p-1 p-md-2">
                                                                <div class="flex gap-1">
                                                                    <i class="text-decoration-none fas fa-star text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                                    @php
                                                                        $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                                                                    @endphp
                                                                    <i 
                                                                        class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018] hover-red' }} text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between" 
                                                                        onclick="{{ $inWishlist ? 'event.stopPropagation();removeFromWishlist(' . $product->id . ')' : 'event.stopPropagation();addToWishlist(' . $product->id . ')' }}">
                                                                    </i>
                                                                </div>
                                                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                                                    <a href="/{{ $product->product_code }}_product" 
                                                                    class="text-decoration-none truncate-ellipsis" 
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="top" 
                                                                    title="{{ $product->product_name }}">
                                                                        {{ $product->product_name }}
                                                                    </a>
                                                                </p>
                    
                                                                <div class="flex justify-content-start gap-1">
                                                                    @php
                                                                        $activePromo = $product->promos->first();
                                                                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                                                    @endphp

                                                                    @if ($product->priceVariation !== null)
                                                                        <p class="text-decoration-none text-[#183018] text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                                            {{ $product->priceVariation }}
                                                                        </p>
                                                                    @else
                                                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                        <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                            <del>
                                                                            Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                            </del>
                                                                        </p>
                                                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                                        @else
                                                                        <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                            Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                        </p>
                                                                        @endif
                                                                    @endif
                    
                                                                </div>
                                                                
                                                                {{-- @if ($product->stock_quantity == 0)
                                                                    <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                                        data-bs-toggle="tooltip" 
                                                                        data-bs-placement="top" 
                                                                        title="Beritahu Saya Jika Stok Sudah Ada" 
                                                                        type="button" 
                                                                        style="color:#183018"
                                                                        id="notify-me-{{$product->id}}"
                                                                        onclick="event.stopPropagation();notifyMe({{$product->id}})"
                                                                    >
                                                                        Stok Habis
                                                                    </a>
                                                                @else
                                                                    @php
                                                                        $inCart = collect($cartItems)->contains('product_id', $product->id);
                                                                    @endphp
                    
                                                                    @if($inCart)
                                                                        <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                                            Cek Keranjang
                                                                        </a>
                                                                    @else
                                                                        <a class="gap-1 py-1 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                                            + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                        </a>
                                                                    @endif
                                                                @endif --}}
                                                                </div>
                                                            </div>
                                                        @endforeach 
                                                    </div>
                                                @else
                                                    <div style="min-height:48vh;">
                                                        <div style="display:flex; align-items:center; justify-content:center;">
                                                            <img src="images/product-empty.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                                                        </div>
                                                        <div style="display:flex; align-items:center; justify-content:center;">
                                                            <p class="text-danger text-md">Produk yang kamu cari tidak ada</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @else
                                                @if (count($brands->products) !== 0)
                                                    <div class="grid-container-shop">
                                                    @foreach ($top as $product)
                                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                                                        <div class="product-image-container">
                                                            <img class="product-image-home" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                                                        </div>
            
                                                        <div class="grid text-left p-1 p-md-2">
                                                            <div class="flex gap-1">
                                                                <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                                <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                                <i 
                                                                class="fas fa-heart hover:cursor-pointer ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                                onclick="event.stopPropagation();addToWishlist({{$product->id}})">
                                                                </i>
                                                            </div>
            
                                                            <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                                                <a href="/{{ $product->product_code }}_product" 
                                                                class="text-decoration-none truncate-ellipsis" 
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                title="{{ $product->product_name }}">
                                                                    {{ $product->product_name }}
                                                                </a>
                                                            </p>
                                                            
                                                            <div class="flex justify-content-start gap-1">
                                                                @php
                                                                    $activePromo = $product->promos->first();
                                                                    $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                                                @endphp
            
                                                                @if ($product->priceVariation !== null)
                                                                    <p class="text-decoration-none text-[#183018] text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                                        {{ $product->priceVariation }}
                                                                    </p>
                                                                @else
                                                                    @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                    <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                        <del>
                                                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                        </del>
                                                                    </p>
                                                                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                                    @else
                                                                    <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                    </p>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            {{-- @if ($product->stock_quantity == 0)
                                                                <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="top" 
                                                                    title="Beritahu Saya Jika Stok Sudah Ada" 
                                                                    type="button" 
                                                                    style="color:#183018"
                                                                    id="notify-me-{{$product->id}}"
                                                                    onclick="event.stopPropagation();notifyMe({{$product->id}})"
                                                                >
                                                                    Stok Habis
                                                                </a>
                                                            @else
                                                                <a class="py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                                + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                </a>
                                                            @endif --}}
                                                        </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                @else
                                                    <div style="min-height:48vh;">
                                                        <div style="display:flex; align-items:center; justify-content:center;">
                                                            <img src="images/product-empty.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                                                        </div>
                                                        <div style="display:flex; align-items:center; justify-content:center;">
                                                            <p class="text-danger text-md">Produk yang kamu cari tidak ada</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- End Card Items -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL DETAIL VOUCHER -->
    @foreach ($brandVouchers as $voucher)
        <div class="modal fade" id="voucher-{{$voucher->id}}" tabindex="-1" aria-labelledby="voucher-{{$voucher->id}}" aria-hidden="true">
            <div class="modal-dialog modal-md-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title text-[#183018] text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">{{ $voucher->promo_name }}</h1>
                    <button type="button" class="btn-close text-white" style="invert(1)" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body border-top border-1 p-1 p-md-3">
                        <div class="row p-0">
                            <div class="col-6 border-right">
                                <img src="{{ Storage::url($voucher->image) }}" class="img-fluid w-full shadow-md rounded-sm mb-2" title="{{ $voucher->promo_name }}" id="detail-image-voucher-{{ $voucher->id }}" alt="{{ $voucher->promo_name }}">
                                <div class="grid w-full mb-2">
                                <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-[#183018]">Deskripsi</p>
                                <p class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">{{ $voucher->description }}</p>
                                </div>
                                <div class="grid w-full gap-2">
                                <div class="flex">
                                    <div class="col-2 p-0 d-flex align-items-center justify-content-start">
                                    <i class="fas fa-percent fa-sm fa-md-lg" style="color:#183018; width: 100%; height: auto;"></i>
                                    </div>
                                    <div class="col-10 p-0 grid">
                                        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Diskon</p>
                                        <p class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">
                                        @if ($voucher->discount <= 100)
                                            {{ $voucher->discount }} %
                                        @else
                                            Rp{{ number_format($voucher->discount, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="col-2 p-0 d-flex align-items-center justify-content-start">
                                    <i class="fas fa-money-bill fa-sm fa-md-lg" style="color:#183018; width: 100%; height: auto;"></i>
                                    </div>
                                    <div class="col-10 p-0 grid">
                                    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Minimun Transaksi</p>
                                    <p class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Rp{{ number_format($voucher->min_transaction, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex">
                                    <div class="col-2 p-0 flex align-items-center justify-content-start">
                                    <i class="fas fa-regular fa-calendar fa-sm fa-md-lg" style="color:#183018;"></i>
                                    </div>
                                    <div class="col-10 p-0">
                                    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Periode Voucher</p>
                                    <p class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ \Carbon\Carbon::parse($voucher->start_date)->translatedFormat('d F Y') }} hingga {{ \Carbon\Carbon::parse($voucher->end_date)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border-bottom p-0 p-md-2">
                                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Syarat & Ketentuan</p>
                                </div>
                                <div class="overflow-y-auto">
                                    <ol class="list-group-numbered" style="max-height:20vw;">
                                        <li class="list-group-item p-1 border-none d-flex align-items-start text-[6px] md:text-[6px] lg:text-[8px] xl:text-[10px]">
                                            <span class=""></span> <!-- Nomor list -->
                                            <p class="ml-2 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] mb-0">Maksimal {{ $voucher->max_quantity_buyer }} item pembelian</p>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                    <p class="text-danger text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">*Voucher dapat digunakan dihalaman checkout</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MODAL DETAIL VOUCHER -->
    @endforeach
</div>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    const skeletonLoader = document.getElementById('skeletonLoader');
    const productList = document.getElementById('productList');

    // Show skeleton loader initially
    skeletonLoader.style.display = 'flex'; // or 'block'

    // Simulate an API call with setTimeout (replace this with your actual API call)
    setTimeout(function() {
        // Fetch your product data here...

        // Hide skeleton loader and show product list after data is fetched
        skeletonLoader.style.display = 'none';
        productList.style.display = 'block';
    }, 2000); // Simulating a 2-second delay
  });
</script>
@endsection


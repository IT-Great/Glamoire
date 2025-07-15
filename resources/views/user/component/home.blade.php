@extends('user.layouts.master')

@section('content')

@php
    $wishlist = session('id_user') && $data['wishlist'] !== null ? $data['wishlist'] : [];
@endphp

<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
    <!-- PROMO FIRST USER -->
    @if (session('id_user'))
        @if ($data['promoModal'] !== null)
            <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xl  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <!-- Close button at the top right corner -->
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                            <!-- Fullscreen image -->
                            <div class="container-fluid p-0 m-0">
                                <img src="{{ Storage::url($data['promoModal']->image) }}" alt="{{ $data['promoModal']->promo_name }}" title="{{ $data['promoModal']->promo_name }}" class="product-img img-fluid w-auto h-100 hover:cursor-pointer" onclick="location.href='{{$data['promoModal']->promo_name}}-detail-promo'">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if (($data['popup']) !== null)    
            <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <!-- Close button at the top right corner -->
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                            <!-- Fullscreen image -->
                            <div class="container-fluid p-0 m-0">
                                <img src="{{ Storage::url($data['popup']->image_popup) }}" alt="Gambar Subscribe" class="product-img img-fluid w-auto h-100">
                                <div class="d-flex gap-2">
                                    <div class="py-2 flex col-12 align-items-center justify-content-center" style="background-color: #475136">
                                        <div class="col-6 p-0 p-md-2 mb-2 mb-md-0">
                                            <p class="text-white text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $data['popup']->description}}</p>
                                        </div>  
                                        <div class="col-6 m-0 p-0">
                                            <form class="grid gap-1 gap-md-2" id="voucher-form">
                                                @csrf
                                                <div class="relative flex items-center">
                                                    <i class="fas fa-envelope text-gray-400 absolute left-3"></i> <!-- Ikon Email -->
                                                    <input type="email" class="form-control pl-10 pr-10 rounded-md text-[10px] md:text-[9px] lg:text-[10px] xl:text-[11px]" id="voucher_email" placeholder="Masukkan email" required>
                                                    <div class="spinner-border text-[#183018] absolute right-3" role="status" style="width:15px; height:15px;display:none;"> <!-- Spinner -->
                                                        <span class="visually-hidden"></span>
                                                    </div>
                                                </div>
                                                <div id="validationEmailVoucher" class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                                                </div>
                                                <button class="py-2 w-full rounded-md text-white bg-[#183018] hover:bg-neutral-900 text-[10px] md:text-[9px] lg:text-[10px] xl:text-[11px]" type="submit" id="voucher-btn" disabled>Dapatkan Sekarang</button>
                                            </form>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif
    @endif
    <!-- END PROMO FIRST USER-->

    <!-- CAROUSEL -->
    <div class="container-fluid p-0 md:mx-0">
        <div class="swiper mySwiperCarousel">
            <div class="swiper-wrapper">
                @foreach ($data['promos'] as $promo)
                    <div class="swiper-slide">
                        <div class="container-fluid p-0 mx-md-3">
                            <a href="/{{$promo->promo_name}}-detail-promo">
                                <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name}}" title="{{ $promo->promo_name}}" class="product-img img-fluid">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- CAROUSEL END -->

    <!-- TOP SELLING Start -->
    <div class="container-fluid">
        <div class="text-center py-3">
            <h2 class="section-title px-5 text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terlaris</span></h2>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper"> 
                @if (session('id_user'))
                    @foreach ($data['topsell'] as $product)
                        <div class="swiper-slide">
                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                    <div class="product-image-container">
                                        <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                                    </div>

                                    <div class="grid text-left p-1 p-md-2">
                                        <div class="flex gap-1">
                                            <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                            <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                            @php
                                                $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                            @endphp
                                            <i 
                                                class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018] hover-red' }} text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between" 
                                                onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                            </i>
                                        </div>
                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px] overflow-hidden">
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
                                                <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                    {{ $product->priceVariation }}
                                                </p>
                                            @else
                                                @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                    <del>
                                                    Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </del>
                                                </p>
                                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                @else
                                                <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
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
                                                    $inCart = collect($data['cartItems'])->contains('product_id', $product->id);
                                                @endphp
            
                                                @if($inCart)
                                                    <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] hover:bg-neutral-900 text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                        Cek Keranjang
                                                    </a>
                                                @else
                                                    <a class="gap-1 py-1 rounded-sm border border-[#183018] hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                        + <i class="fas fa-shopping-cart"></i> Keranjang
                                                    </a>
                                                @endif
                                            @endif --}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach    

                <!-- MUNCULKAN DATA PRODUK JIKA USER BELUM LOGIN -->
                @else
                    @foreach ($data['topsell'] as $product)
                    <div class="swiper-slide">
                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                            <div class="product-image-container">
                                <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                            </div>

                            <div class="grid text-left p-1 p-md-2">
                                <div class="flex gap-1">
                                    <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                    <i 
                                        class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                        onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                    </i>
                                </div>
                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px] overflow-hidden">
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
                                        <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                            {{ $product->priceVariation }}
                                        </p>
                                    @else
                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                        <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                            <del>
                                            Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                            </del>
                                        </p>
                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                        @else
                                        <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
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
                                    <a class="gap-1 py-1 hover:cursor-pointer rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                        + <i class="fas fa-shopping-cart"></i> Keranjang
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <!-- TOP SELLING End -->
    


    <!-- NEW ARRIVAL Start -->
    <div class="container-fluid">
        <div class="text-center py-3">
            <h2 class="section-title px-5 text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terbaru</span></h2>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper"> 
            @if (session('id_user'))
                @foreach ($data['new'] as $product)
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden h-fit ">
                            <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                <div class="product-image-container">
                                    <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                                </div>

                                <div class="grid text-left p-1 p-md-2">
                                    <div class="flex gap-1">
                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                        @php
                                            $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                        @endphp
                                        <i 
                                            class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                            onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                        </i>
                                    </div>
                                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px] overflow-hidden">
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
                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                {{ $product->priceVariation }}
                                            </p>
                                        @else
                                            @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                            <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                <del>
                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                </del>
                                            </p>
                                            <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                            @else
                                            <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
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
                                            $inCart = collect($data['cartItems'])->contains('product_id', $product->id);
                                        @endphp
    
                                        @if($inCart)
                                            <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] hover:bg-neutral-900 text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                Cek Keranjang
                                            </a>
                                        @else
                                            <a class="gap-1 py-1 hover:cursor-pointer rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                                + <i class="fas fa-shopping-cart"></i> Keranjang
                                            </a>
                                        @endif
                                    @endif --}}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach    

            <!-- MUNCULKAN DATA PRODUK JIKA USER BELUM LOGIN -->
            @else
                @foreach ($data['new'] as $product)
                <div class="swiper-slide">
                    <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                        <div class="product-image-container">
                            <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                        </div>

                        <div class="grid text-left p-1 p-md-2">
                            <div class="flex gap-1">
                                <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                <i 
                                    class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                    onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                </i>
                            </div>
                            <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[13px] overflow-hidden">
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
                                    <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                        {{ $product->priceVariation }}
                                    </p>
                                @else
                                    @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                    <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                        <del>
                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                        </del>
                                    </p>
                                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                    @else
                                    <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
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
                                <a class="gap-1 py-1 hover:cursor-pointe rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                                    + <i class="fas fa-shopping-cart"></i> Keranjang
                                </a>
                            @endif --}}
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <!-- NEW ARRIVAL End -->

    <!-- LANGGANAN INFORMASI/SUBSCRIBE -->
    <div class="container-fluid my-2 my-md-4 my-lg-6 my-xl-8 px-0 px-md-3">
        <div class="d-flex gap-2">
            <div class="py-2 py-md-1 flex col-12 align-items-center justify-content-center rounded-sm" style="background-color: #475136">
                <div class="col-6 col-md-8 mb-2 mb-md-0 p-0 p-md-2">
                    <p class="text-white text-[10px] md:text-[12px] lg:text-[14px] xl:text-[18px]">Langganan Untuk Mendapatkan Informasi Terbaru Dari Kami</p>
                </div>  
                <div class="col-6 col-md-4 p-0 p-md-2">
                    <form class="grid gap-1 gap-md-2 m-0" id="subscribe-form">
                        @csrf
                        <div class="relative flex items-center">
                            <i class="fas fa-envelope text-gray-400 absolute left-3 text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px]"></i> <!-- Ikon Email -->
                            <input type="email" name="emailVoucherNewUser" class="form-control pl-10 pr-10 rounded-sm text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px]" id="subscribe_email" placeholder="Masukkan email" autocomplete="off" required>
                            <div class="spinner-border text-[#183018] absolute right-3" role="status" style="width:15px; height:15px;display:none;"> <!-- Spinner -->
                                <span class="visually-hidden"></span>
                            </div>
                        </div>

                        <div id="validationEmailSubscribe" class="text-[12px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                        </div>
                        <button class="py-2 w-full rounded-sm text-white bg-[#183018] hover:bg-neutral-900 text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px]" type="submit" id="subscribe-btn" disabled>Berlangganan Sekarang</button>
                    </form>
                </div>
            </div>  
        </div>
    </div>
    <!-- END -->

    <!-- KEUNGGULAN -->
    <div class="container-fluid py-4 my-2 my-md-4 my-lg-6 my-xl-8">
        <div class="row px-3">
            <div class="col-4 p-0">
                <h6 class="text-[10px] mb-2 md:text-[14px] lg:text-[16px] xl:text-[18px]">Plant-Based Cruelty-free</h6>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">1st Plant-Based Beauty Commerce in Indonesia</p>
            </div>
            <div class="col-4 px-2">
                <h6 class="text-[10px] mb-2 md:text-[14px] lg:text-[16px] xl:text-[18px]">BPOM Approved</h6>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Belanja produk kecantikan pasti asli dari ratusan brand yang bersertifikasi BPOM.</p>
            </div>
            <div class="col-4 p-0">
                <h6 class="text-[10px] mb-2 md:text-[14px] lg:text-[16px] xl:text-[18px]">Plant-Based Beauty</h6>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">One stop Plant-Based Beauty Beauty, cosmetic & personal care</p>
            </div>
        </div>
    </div>
</div>

<!-- SUBSCRIBE  -->
<script>
    $(document).on("submit", "#subscribe-form", function (e) {
        e.preventDefault();

        let email = $("#subscribe_email").val();

        Swal.fire({
            text: "Mohon tunggu sebentar ...",
            allowOutsideClick: false,
            background: "#183018",
            customClass: {
                popup: "small-swal", // Add custom class
            },
            willOpen: () => {
                const titleLoading = document.querySelector('.swal2-title');
                const contentLoading = document.querySelector('.swal2-html-container');
                if (titleLoading) titleLoading.style.color = '#FFFFFF'; // Ubah warna judul
                if (contentLoading) contentLoading.style.color = '#FFFFFF'; // Ubah warna konten
            },
            didOpen: () => {
            Swal.showLoading();
            }
        });

        $.ajax({
            url: "{{ route('subscribe') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // CSRF token dari Laravel
                email: email,
            },
            success: function (response) {
                if (response.success) {
                    Swal.close();
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
                      window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
                    });
                } else {
                    Swal.close();
                    Toast.fire({
                        icon: "error",
                        text: response.message,
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    });
                }
            },
            error: function (response) {
                Swal.close();
                Toast.fire("Error", "Maaf, Coba Lagi", "error");
            },
        });
    });

    $('#subscribe_email').on('keyup', function () {
        var email = $(this).val();
        if (email) {
            $.ajax({
                url: "{{ route('check.email.subscribe') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email
                },
                beforeSend: function() {
                    // Tampilkan spinner sebelum request dimulai
                    $('.spinner-border').show();
                },
                success: function (response) {
                    if (response.exists) {
                        $('#validationEmailSubscribe').text('Email sudah didaftarkan').addClass('text-white').show();
                        $('#subscribe-btn').prop('disabled', true);
                    } else {
                        $('#validationEmailSubscribe').hide();
                        $('#subscribe-btn').prop('disabled', false);
                    }
                },
                complete: function() {
                    // Sembunyikan spinner setelah request selesai
                    $('.spinner-border').hide();
                },
                error: function() {
                    alert('error');
                    // Jika ada error, tetap sembunyikan spinner
                    $('.spinner-border').hide();
                }
            });
        }
    });

    $('#voucher_email').on('keyup', function () {
        var email = $(this).val();
        if (email) {
            $.ajax({
                url: "{{ route('check.email.voucher') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email
                },
                beforeSend: function() {
                    // Tampilkan spinner sebelum request dimulai
                    $('.spinner-border').show();
                },
                success: function (response) {
                    if (response.exists) {
                        $('#validationEmailVoucher').text('Email sudah didaftarkan').addClass('text-white').show();
                        $('#voucher-btn').prop('disabled', true);
                    } else {
                        $('#validationEmailVoucher').hide();
                        // $('#validationEmailVoucher').text('Kocak').addClass('text-white').show();
                        $('#voucher-btn').prop('disabled', false);
                    }
                },
                complete: function() {
                    // Sembunyikan spinner setelah request selesai
                    $('.spinner-border').hide();
                },
                error: function() {
                    // Jika ada error, tetap sembunyikan spinner
                    $('.spinner-border').hide();
                }
            });
        }
    });
</script>

@if(session('id_user'))
<!-- MENGATUR POP-UP PROMO  -->
 @if ($data['promoModal'] !== null)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('promoModal'));
        myModal.show();
        });
    </script>
 @endif
@else
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('firstUser'));
    myModal.show();
    });
</script>
@endif

<script>
    $(document).on("submit", "#voucher-form", function (e) {
    e.preventDefault();

    let email = $("#voucher_email").val();

    Swal.fire({
        text: "Mohon tunggu sebentar ...",
        allowOutsideClick: false,
        background: "#183018",
        customClass: {
            popup: "small-swal", // Add custom class
        },
        willOpen: () => {
            const titleLoading = document.querySelector('.swal2-title');
            const contentLoading = document.querySelector('.swal2-html-container');
            if (titleLoading) titleLoading.style.color = '#FFFFFF'; // Ubah warna judul
            if (contentLoading) contentLoading.style.color = '#FFFFFF'; // Ubah warna konten
        },
        didOpen: () => {
        Swal.showLoading();
        }
    });

    $.ajax({
        url: "{{ route('voucher.new.user') }}", // Route register di Laravel
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
            email: email,
        },
        success: function (response) {
            Swal.close();
            if (response.success) {
                Toast.fire({
                    icon: "success",
                    text: response.message,
                    title: "Berhasil",
                    willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                }).then(function () {
                    location.reload(); // Redirect ke halaman utama atau halaman lain
                });
            } else {
                let errorMessage = response.message || "Terjadi kesalahan"; // Mengambil pesan error dari response
                Toast.fire({
                    icon: "error",
                    text: errorMessage,
                    title: "Oops..",
                    willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                });
            }
        },
        error: function (response) {
            Swal.close();
            let errorMessage = "";
            
            if (response.responseJSON) {
                if (response.responseJSON.message) {
                    errorMessage = response.responseJSON.message; // Pesan error dari Laravel
                    
            
                } else if (response.responseJSON.errors) {
                    // Jika ada beberapa pesan error, tampilkan semuanya
                    errorMessage = "";
                    $.each(response.responseJSON.errors, function (key, value) {
                        errorMessage += value[0] + "<br>"; // Menggabungkan pesan error
                    });
                    
            
                }
            } else if (response.statusText) {
                // Jika tidak ada response JSON, tampilkan status text dari request
                errorMessage = response.statusText;
            }

            // Tampilkan pesan error dengan SweetAlert
            Toast.fire({
                icon: "error",
                text: errorMessage,
                title: "Oops..",
                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        },
    });
    });
</script>


@endsection
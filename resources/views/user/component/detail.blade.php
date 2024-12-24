@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96">
    <div class="container-fluid px-0 px-md-3">
        <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
            <div class="d-flex gap-1 pl-2">
                <a href="/" class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]"> > </p>
                <a href="/shop" class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Belanja</a>
                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]"> > </p>
                <a href="#" class="text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">{{ $product->product_name }}</a>
            </div>
        </div>
    </div>

    <!-- Shop Detail Start -->
    <div class="container-fluid mt-3 mt-md-0">
        <!-- IMAGE PRODUCT -->
        <div class="row">
            <div class="col-lg-4">
                <div class="position-sticky" style="top: 4rem">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiperShow p-0">
                        <div class="swiper-wrapper">
                            @if (!empty($product->main_image))
                                <div class="swiper-slide">
                                    <div class="image-container border border-b-zinc-700 rounded-sm">
                                        <img class="zoomable-image main-display" src="{{ Storage::url($product->main_image) }}" alt="product Image" />
                                    </div>
                                </div>
                            @endif

                            @if (!empty($product->images))
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide">
                                        <div class="image-container border border-b-zinc-700 rounded-sm">
                                            <img class="zoomable-image main-display" src="{{ Storage::url($image) }}" alt="product Image" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if (!empty($product->video))
                                <div class="swiper-slide" style="max-height: 150px;">
                                    <video class="zoomable-video main-display border-b-zinc-700 rounded-sm" id="mainVideo" controls controlsList="nodownload noplaybackrate h-fit">
                                        <source src="{{ Storage::url($product->video) }}" type="video/mp4">
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="swiper mySwiperProduct p-0">
                        <div class="swiper-wrapper">
                            @if (!empty($product->main_image))
                                <div class="swiper-slide example-product hover:cursor-pointer border-b-zinc-700 rounded-sm" id="main_image">
                                    <a data-src="{{ Storage::url($product->main_image) }}" data-type="image">
                                        <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}" />
                                    </a>
                                </div>
                            @endif

                            @if (!empty($product->images))
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide example-product hover:cursor-pointer border-b-zinc-700 rounded-sm" id="main_image">
                                        <a data-src="{{ Storage::url($image) }}" data-type="image">
                                            <img src="{{ Storage::url($image) }}" alt="{{ $product->product_name }}" />
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            @if (!empty($product->video))
                                <div class="swiper-slide example-product hover:cursor-pointer border-b-zinc-700 rounded-sm" id="videoproduk">
                                    <a data-src="{{ Storage::url($product->video) }}" data-type="video">
                                        <div class="video-thumbnail-wrapper">
                                            <img src="{{ Storage::url($product->main_image) }}" alt="Video Thumbnail" />
                                            <i class="fas fa-play" style="color: #183018;"></i>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid col-lg-8 pl-lg-0 h-fit gap-1">
                <div class="grid gap-1">
                    <div class="d-flex gap-1">
                        <a href="/{{ $product->brand->name }}_brand" class="text-decoration-none font-semibold text-black text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">{{$product->brand->name}}</a> 
                        @if (session('id_user'))
                            @php
                                $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                            @endphp
                            <i 
                                class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] grid align-items-center justify-content-between hover-red hover:cursor-pointer" 
                                onclick="{{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}" 
                                title="{{ $inWishlist ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
                            </i>
                        @else
                            <i 
                                class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] grid align-items-center justify-content-between hover-red hover:cursor-pointer" 
                                onclick="{{ 'addToWishlist(' . $product->id . ')' }}" title="Tambah ke Favorit">
                            </i>
                        @endif
                    </div>
                    <p class="text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] text-black">{{ $product->product_name }}</p>
                </div>

                <div class="d-flex gap-1">
                    <i class="text-decoration-none fas fa-star text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] grid align-items-center justify-content-between" style="color:orange;"></i>
                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[14px] xl:text-[14px] grid align-items-center justify-content-between">{{ $product->rating }}</p>
                    <p class="text-decoration-none text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between">({{ $product->rating_and_reviews_count }} Ulasan)</p>
                </div>

                <div>
                @php
                    $activePromo = $product->promos->first();
                    $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                @endphp
                
                @if ($discountedPrice && $discountedPrice < $product->regular_price)
                    <span class="text-muted text-decoration-line-through font-weight-semi-bold text-black text-[18px] md:text-[18px] lg:text-[20px] xl:text-[24px]">
                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                    </span>
                    <span class="text-[#183018] font-weight-semi-bold text-black text-[18px] md:text-[18px] lg:text-[20px] xl:text-[24px]">
                        Rp{{ number_format($discountedPrice, 0, ',', '.') }}
                    </span>
                @else
                    <span class="font-weight-semi-bold text-black text-[18px] md:text-[18px] lg:text-[20px] xl:text-[24px]">
                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                    </span>
                @endif
                </div>
                
                @if ($product->stock_quantity == 0)
                    <div class="d-lg-flex d-none d-lg-block">
                        <span class="text-danger text-[10px] md:text-[14px] lg:text-[16px] xl:text-[16px]">Stok kosong</span>
                        <span
                            class="text-danger rounded-sm ml-auto text-[10px] md:text-[14px] lg:text-[16px] xl:text-[16px]" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            title="Beritahu Saya Jika Stok Sudah Ada" 
                            type="button" 
                            id="notify-me-{{$product->id}}"
                            onclick="notifyMe({{$product->id}})">
                            Beritahu Saya
                        </span>
                    </div>
                @else
                    @if (session('id_user'))
                        @php
                            $inCart = collect($cartItems)->contains('product_id', $product->id);
                        @endphp

                        @if ($inCart)
                            <button onclick="cart()" class="d-none d-lg-block rounded-sm w-full bg-[#183018] hover:bg-neutral-900 text-white py-1 p-0 text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] flex align-items-center justify-content-center">
                                Cek Keranjangmu
                            </button>
                        @else
                            <div class="grid">
                                <div>
                                    <p class="text-black text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Stok : {{ $product->stock_quantity }}</p>
                                </div>
                                <div class="align-items-center flex gap-2">
                                    <div class="input-group quantity-detail-produk rounded-sm shadow-sm" style="width: 120px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="number" 
                                            class="form-control bg-secondary text-center px-2 no-spinner" 
                                            id="total-detail-product-quantity-{{$product->id}}" 
                                            value="1" 
                                            min="1"
                                            max="{{ $product->stock_quantity }}"
                                            data-unify="Quantity"
                                            oninput="checkMaxQuantity(this, {{ $product->stock_quantity }})"
                                        >
                                        <div class="input-group-btn">
                                            <button class="btn btn-plus" id="btn-plus-{{$product->id}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <a onclick="addCartWithQuantity({{$product->id}})" class="d-none d-lg-block hover:cursor-pointer py-2 hover:bg-gray-100 rounded-sm shadow-sm text-decoration-none px-3 text-black text-[14px] md:text-[12px] lg:text-[16px] xl:text-[16px]"><i class="fa fa-plus mr-1"></i> Keranjang</a>
                                    <a onclick="buyNow({{$product->id}})" class="d-none d-lg-block hover:cursor-pointer py-2 text-decoration-none rounded-sm hover:bg-neutral-900 shadow-sm px-3 text-white bg-[#183018] text-[14px] md:text-[12px] lg:text-[16px] xl:text-[16px]">Beli Sekarang</a>
                                </div>
                                <span id="quantity-warning-{{$product->id}}" class="text-danger" style="display: none;">Batas untuk pembelian produk terpenuhi</span>
                            </div>
                        @endif
                    @else
                        <div class="grid">
                            <div>
                                <p class="text-black text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Stok : {{ $product->stock_quantity }}</p>
                            </div>
                            <div class="align-items-center gap-2 d-none d-lg-flex">
                                <div class="input-group quantity-detail-produk rounded-sm shadow-sm" style="width: 120px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" 
                                        class="form-control bg-secondary text-center px-2  no-spinner" 
                                        id="total-detail-product-quantity-{{$product->id}}" 
                                        value="1" 
                                        min="1"
                                        max="{{ $product->stock_quantity }}"
                                        data-unify="Quantity"
                                        oninput="checkMaxQuantity(this, {{ $product->stock_quantity }})"
                                    >
                                    <div class="input-group-btn">
                                        <button class="btn btn-plus" id="btn-plus-{{$product->id}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <a onclick="addCartWithQuantity({{$product->id}})" class="hover:cursor-pointer py-2 hover:bg-gray-100 rounded-sm shadow-sm text-decoration-none px-3 text-black text-[14px] md:text-[12px] lg:text-[16px] xl:text-[16px]"><i class="fa fa-plus mr-1"></i> Keranjang</a>
                                <a onclick="buyNow({{$product->id}})" class="hover:cursor-pointer text-decoration-none py-2 rounded-sm hover:bg-neutral-900 shadow-sm px-3 text-white bg-[#183018] text-[14px] md:text-[12px] lg:text-[16px] xl:text-[16px]">Beli Sekarang</a>
                            </div>
                            <span id="quantity-warning-{{$product->id}}" class="text-danger" style="display: none;">Batas untuk pembelian produk terpenuhi</span>
                        </div>
                    @endif
                @endif

                {{-- <div class="d-flex pt-2">
                    <p class="text-dark text-[12px] text-black md:text-[14px] lg:text-[16px] xl:text-[18px] font-semibold mb-0 mr-2">Bagikan Produk ke:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2 text-[12px] text-black md:text-[14px] lg:text-[16px] xl:text-[18px]" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2 text-[12px] text-black md:text-[14px] lg:text-[16px] xl:text-[18px]" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2 text-[12px] text-black md:text-[14px] lg:text-[16px] xl:text-[18px]" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div> --}}

                
                {{-- Desc/Inf/Ulasan --}}
                <div class="row">
                    <div class="col tabbable mt-1 mt-md-2 border-bottom mx-3 mx-0 px-0">
                        <div class="nav nav-tabs justify-content-start border-secondary mb-2">
                            <a class="nav-item nav-link active text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#deskripsi">Deskripsi</a>
                            <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#informasi">Informasi</a>
                            <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#ulasan">Ulasan ({{ $product->rating_and_reviews_count }})</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active p-1" id="deskripsi">
                                <h4 class="mb-1 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Deskripsi Produk</h4>
                                <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-black">{{ $product->description }}</p>
                            </div>
                            <div class="tab-pane fade p-1" id="informasi">
                                <h4 class="mb-1 text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Informasi terkait produk</h4>
                                <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-black">{{ $product->information_product }}</p>
                            </div>
                            <div class="tab-pane fade p-1" id="ulasan">
                                <div class="row">
                                    <div class="col-12 overflow-y-auto custom-scroll" style="max-height:60vh;">
                                        <h4 class="mb-2 text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">{{ $product->rating_and_reviews_count }} Ulasan untuk "{{ $product->product_name }}"</h4>
                                        @foreach ($product->ratingAndReviews as $ratingAndReviews)
                                            <div class="comment mb-4">
                                                <div class="media-body grid border border-[#183018] rounded-sm shadow-md p-2">
                                                    <div class="col-12 p-0">
                                                        <div class="grid">
                                                            <div class="flex w-full">
                                                                <div class="grid">
                                                                    <h6 class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]">{{ $ratingAndReviews->user->fullname }}<small> - <i>{{ \Carbon\Carbon::parse($ratingAndReviews->created_at)->format('d F Y') }}</i></small></h6>
                                                                    <div class="mr-2">
                                                                        <small class="fas fa-star text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                                                                        <small class="text-[12px] md:text-[10px] lg:text-[12x] xl:text-[14px] text-black">{{ $ratingAndReviews->rating }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w-full">
                                                                <p class="text-[12px] text-black md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $ratingAndReviews->description }}</p>
                                                            </div>
                                                            <div class="d-flex">
                                                                @if ($ratingAndReviews->video !== null)
                                                                <video class="zoomable-video video-rating-review" id="mainVideo-{{$ratingAndReviews->id}}" controlsList="nodownload noplaybackrate" onclick="openFullscreenModal('{{ Storage::url($ratingAndReviews->video) }}', 'video')">
                                                                    <source src="{{ Storage::url($ratingAndReviews->video) }}" type="video/mp4">
                                                                </video>
                                                                    {{-- <div class="col-3 pr-1 pl-0">
                                                                    </div> --}}
                                                                @endif
                                                                @if ($ratingAndReviews->images !== null)
                                                                    @foreach (json_decode($ratingAndReviews->images, true) as $index => $image)
                                                                        {{-- <div class="col-4 pr-1 pl-0"> --}}
                                                                            <img class="image-rating-review" src="{{ Storage::url($image) }}" title="Gambar ulasan dari pengguna {{$ratingAndReviews->user->fullname}}" style="height: 100%; object-fit: cover; width: auto;" onclick="openFullscreenModal('{{ Storage::url($image) }}', 'image')"/>
                                                                        {{-- </div> --}}
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($product->stock_quantity == 0)
                    <div class="d-lg-none fixed-bottom" style="background-color:#183018;">
                        <div class="container-fluid d-flex gap-2 py-1">
                            <span class="text-danger py-2 text-[14px] md:text-[16px] lg:text-[18px] xl:text-[18px]">Stok kosong</span>
                            <span
                                class="text-light py-2 rounded-sm ml-auto text-[14px] md:text-[16px] lg:text-[18px] xl:text-[18px]" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Beritahu Saya Jika Stok Sudah Ada" 
                                type="button" 
                                id="notify-me-{{$product->id}}"
                                onclick="notifyMe({{$product->id}})">
                                Beritahu Saya
                            </span>
                        </div>
                    </div>
                @else
                    @if (session('id_user'))
                        @php
                            $inCart = collect($cartItems)->contains('product_id', $product->id);
                        @endphp

                        @if ($inCart)
                        <div class="d-lg-none fixed-bottom" style="background-color:#183018;">
                            <div class="container-fluid d-flex gap-2 py-1">
                                <a onclick="cart()" class="btn hover:cursor-pointer rounded-sm shadow-sm w-full bg-transparent text-white border border-white text-[12px]">
                                    Cek Keranjangmu
                                </a>
                            </div>
                        </div>
                        @else
                            <div class="d-lg-none fixed-bottom" style="background-color:#183018;">
                                <div class="container-fluid d-flex gap-2 py-1">
                                    <a onclick="addToCart({{$product->id}})" class="btn hover:cursor-pointer rounded-sm shadow-sm w-full bg-transparent text-white border border-white text-[12px]">
                                        + Keranjang
                                    </a>
                                    <a onclick="buyNow({{$product->id}})" class="btn hover:cursor-pointer btn-light rounded-sm shadow-sm w-full text-[#183018] text-[12px]">
                                        Beli Sekarang
                                    </a>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="d-lg-none fixed-bottom" style="background-color:#183018;">
                            <div class="container-fluid d-flex gap-2 py-1">
                                <a onclick="addToCart({{$product->id}})" class="btn hover:cursor-pointer rounded-sm shadow-sm w-full bg-transparent text-white border border-white text-[12px]">
                                    + Keranjang
                                </a>
                                <a onclick="buyNow({{$product->id}})" class="btn  hover:cursor-pointer btn-light rounded-sm shadow-sm w-full text-[#183018] text-[12px]">
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                
            </div>
        </div>
        <!-- END IMAGE PRODUCT -->

    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid mb-14 mb-lg-0">
        <div class="text-center py-3">
            <h2 class="section-title px-5  text-[12px] md:text-[14px] lg:text-[18px] xl:text-[22px]"><span class="px-2">Produk Lainnya</span></h2>
        </div>

        <div class="swiper mySwiperDetail">
            <div class="swiper-wrapper"> 
                @if (session('id_user'))
                    @foreach ($youlike as $yl)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden h-fit border border-xl">
                                <a href="/{{ $yl->product_code }}_product" class="text-decoration-none">
                                    <div class="product-image-container">
                                        <img class="card-img-top product-image {{ $yl->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($yl->main_image) }}" alt="{{ $yl->product_name }}">
                                    </div>

                                    <div class="grid text-left p-1 p-md-2">
                                        <div class="flex gap-1">
                                            <i class="text-decoration-none fas fa-star text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                            <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $yl->rating }}</p>
                                            @php
                                                $inWishlist = collect($wishlists)->contains('product_id', $yl->id);
                                            @endphp
                                            <i 
                                                class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} text-[9px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $yl->id . ')' : 'addToWishlist(' . $yl->id . ')' }}"
                                                >
                                            </i>
                                        </div>
                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                            <a href="/{{ $yl->product_code }}_product" 
                                            class="text-decoration-none truncate-ellipsis" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ $yl->product_name }}">
                                                {{ $yl->product_name }}
                                            </a>
                                        </p>

                                        <div class="flex justify-content-start gap-1">
                                            @php
                                                $activePromo = $yl->promos->first();
                                                $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                            @endphp

                                            @if ($yl->priceVariation !== null)
                                                <p class="text-decoration-none text-[#183018] text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                    {{ $yl->priceVariation }}
                                                </p>
                                            @else
                                                @if ($discountedPrice && $discountedPrice < $yl->regular_price)
                                                    <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                    <del>
                                                        Rp{{ number_format($yl->regular_price, 0, ',', '.') }}
                                                    </del>
                                                    </p>
                                                    <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                    @else
                                                    <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                        Rp{{ number_format($yl->regular_price, 0, ',', '.') }}
                                                    </p>
                                                @endif
                                            @endif
                                        </div>
                                        
                                        {{-- @if ($yl->stock_quantity == 0)
                                            <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Beritahu Saya Jika Stok Sudah Ada" 
                                                type="button" 
                                                style="color:#183018"
                                                id="notify-me-{{$yl->id}}"
                                                onclick="event.stopPropagation();notifyMe({{$yl->id}})"
                                            >
                                                Stok Habis
                                            </a>
                                        @else
                                            @php
                                                $inCart = collect($cartItems)->contains('product_id', $yl->id);
                                            @endphp
        
                                            @if($inCart)
                                                <a href="/cart" class="py-1 rounded-sm border border-[#183018] hover:bg-neutral-900 shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                    Cek Keranjang
                                                </a>
                                            @else
                                                <a class="gap-1 py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center" onclick="event.stopPropagation();addToCart({{$yl->id}})">
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
                    @foreach ($youlike as $yl)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden h-fit border border-xl">
                                <a href="/{{ $yl->product_code }}_product" class="text-decoration-none">
                                    <div class="product-image-container">
                                        <img class="card-img-top product-image {{ $yl->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($yl->main_image) }}" alt="{{ $yl->product_name }}">
                                    </div>

                                    <div class="grid text-left p-1 p-md-2">
                                        <div class="flex gap-1">
                                            <i class="text-decoration-none fas fa-star text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                            <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $yl->rating }}</p>
                                            <i 
                                                class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[9px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                onclick="event.stopPropagation();addToWishlist({{ $yl->id }})">
                                            </i>
                                        </div>
                                        <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] overflow-hidden">
                                            <a href="/{{ $yl->product_code }}_product" 
                                            class="text-decoration-none truncate-ellipsis" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{ $yl->product_name }}">
                                                {{ $yl->product_name }}
                                            </a>
                                        </p>

                                        <div class="flex justify-content-start gap-1">
                                            @php
                                                $activePromo = $yl->promos->first();
                                                $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                            @endphp

                                            @if ($discountedPrice && $discountedPrice < $yl->regular_price)
                                                <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                <del>
                                                    Rp{{ number_format($yl->regular_price, 0, ',', '.') }}
                                                </del>
                                                </p>
                                                <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                @else
                                                <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                                Rp{{ number_format($yl->regular_price, 0, ',', '.') }}
                                                </p>
                                            @endif
                                        </div>
                                        
                                        {{-- @if ($yl->stock_quantity == 0)
                                            <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Beritahu Saya Jika Stok Sudah Ada" 
                                                type="button" 
                                                style="color:#183018"
                                                id="notify-me-{{$yl->id}}"
                                                onclick="event.stopPropagation();notifyMe({{$yl->id}})"
                                            >
                                                Stok Habis
                                            </a>
                                        @else
                                            <a class="gap-1 py-1 rounded-sm hover:cursor-pointer border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$yl->id}})">
                                                + <i class="fas fa-shopping-cart"></i> Keranjang
                                            </a>
                                        @endif --}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Products End -->
</div>

<!-- Modal untuk gambar/video fullscreen -->
<div class="modal fade" id="fullscreenModal" tabindex="-1" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <!-- Konten gambar atau video akan diubah secara dinamis -->
        <div id="modalContent"></div>
      </div>
      <button type="button" id="btn-close-fullscreen" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>


<!-- UNTUK MENGATUR ZOOM IN GAMBAR PADA HALAMAN DETAIL PRODUK -->
@if (!empty($product->video))
    <script>
        document.getElementById('videoproduk').addEventListener('click', function(e) {
            e.preventDefault();
            // Temukan video berdasarkan ID
            const video = document.getElementById('mainVideo');
            
            // Pastikan video berada di slide yang aktif
            const swiperInstance = document.querySelector('.swiper').swiper;
            swiperInstance.slideTo(6); // Mengarahkan ke slide dengan indeks yang berisi video

            // Tunggu sampai transisi selesai dan kemudian play video
            setTimeout(function() {
                video.play();
            }, 500); // Delay untuk memastikan transisi selesai
        });
    </script>
@endif
<script>
    document.querySelector('.image-container').addEventListener('mousemove', function(e) {
        const zoomableImage = this.querySelector('.zoomable-image');
        const rect = this.getBoundingClientRect();
        const x = e.clientX - rect.left; // Koordinat x kursor relatif terhadap kontainer
        const y = e.clientY - rect.top;  // Koordinat y kursor relatif terhadap kontainer

        // Mengatur transform-origin berdasarkan posisi kursor
        zoomableImage.style.transformOrigin = `${x}px ${y}px`;
    });

    
    function addCartWithQuantity(productId) {
        var currentQuantity = parseInt($('#total-detail-product-quantity-' + productId).val());

        $.ajax({
            url: "{{ route('add.to.chart.with.quantity') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                product_id: productId,
                quantity: currentQuantity,
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                      icon: "success",
                      text: response.message,
                      willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                    })
                    .then(function () {
                        window.location.reload(); // Redirect ke halaman utama atau halaman lain
                        });
                } else {
                    let errors = response.errors;
                    let errorMessages = response.message;
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages += errors[key][0] + "<br>";
                        }
                    }
                    Toast.fire({
                    icon: "error",
                    text: errorMessages,
                    
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
                Toast.fire({
                    icon: "error",
                    text: "Kesalahan Sistem",
                    
                    willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                });
            },
        });
    }

    function buyNow(productId) {
        var currentQuantity = parseInt($('#total-detail-product-quantity-' + productId).val());

        $.ajax({
            url: "{{ route('add.product.buy.now') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                product_id: productId,
                quantity: currentQuantity,
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = "/buy-now";
                } else {
                    let errors = response.errors;
                    let errorMessages = response.message;
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages += errors[key][0] + "<br>";
                        }
                    }
                    Toast.fire({
                    icon: "error",
                    text: errorMessages,
                    
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
                
                Toast.fire({
                    icon: "error",
                    text:  errorMessage,
                    
                    willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                });
            },
        });
    }

    // Product Quantity
    $(".quantity-detail-produk button").on("click", function () {
        var button = $(this);
        var input = button.parent().parent().find("input");
        var oldValue = input.val();
        var maxQuantity = {{ $product->stock_quantity }};

        var newVal;

        if (button.hasClass("btn-plus")) {
            newVal = parseFloat(oldValue) + 1;
        } else {
            newVal = (oldValue > 1) ? parseFloat(oldValue) - 1 : 1;
        }

        // Set the new value to the input
        input.val(newVal);

        checkMaxQuantity(input[0], maxQuantity);
    });

    
    const quantityInput = document.querySelector('input[data-unify="Quantity"]');
    quantityInput.addEventListener('input', () => checkMaxQuantity(quantityInput));
    quantityInput.addEventListener('blur', () => checkMaxQuantity(quantityInput));


    function checkMaxQuantity(input, maxQuantity) {
        var value = parseFloat(input.value);
        var warningElement = document.getElementById("quantity-warning-" + input.id.split('-').pop());
        var plusButton = document.getElementById("btn-plus-" + input.id.split('-').pop());

        if (value >= maxQuantity) {
            warningElement.style.display = "block"; // Show warning
            plusButton.disabled = true; // Disable the plus button
        } else {
            warningElement.style.display = "none"; // Hide warning
            plusButton.disabled = false; // Enable the plus button
        }
    }

    function openFullscreenModal(source, type) {
        var modalContent = document.getElementById('modalContent');

        if (type === 'image') {
            modalContent.innerHTML = '<img src="' + source + '" class="w-100 h-auto" style="object-fit: contain;">';
        } else if (type === 'video') {
            modalContent.innerHTML = '<video class="w-100 h-auto" controls controlsList="nodownload noplaybackrate"><source src="' + source + '" type="video/mp4"></video>';
        }

        // Initialize and show the modal
        var fullscreenModal = new bootstrap.Modal(document.getElementById('fullscreenModal'));
        fullscreenModal.show();
    }

    // Close modal manually without getInstance
    document.getElementById('btn-close-fullscreen').addEventListener('click', function() {
        var fullscreenModalElement = document.getElementById('fullscreenModal');
        var modal = new bootstrap.Modal(fullscreenModalElement); // Recreate the modal
        modal.hide(); // Close the modal
    });


</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    function cart(){
        window.location.href = "/cart";
    }

    var swiperDetailProduct = new Swiper(".mySwiperDetail", {
        slidesPerView: 1,
        spaceBetween: 15,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-next",
          prevEl: ".swiper-prev",
        },
        breakpoints: {
          2560: {
            slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1440: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1024: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          // Tablet
          768: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
          },
          425: {
            slidesPerView: 2, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          375: {
            slidesPerView: 2, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          // Mobile
          320: {
            slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
            spaceBetween: 5,  // Menyusun jarak antar slide
            navigation: false,
          },
        },
    });

    document.addEventListener('DOMContentLoaded', function () {
        const thumbnailLinks = document.querySelectorAll('.swiper.mySwiperProduct .swiper-slide a');
        const mainDisplay = document.querySelector('.swiper.mySwiperShow');
        const mySwiperProduct = new Swiper('.mySwiperProduct', {
            slidesPerView: 'auto',
            spaceBetween: 10,
        });

        const mySwiperShow = new Swiper('.mySwiperShow', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Sync main display when thumbnail is clicked
        thumbnailLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const src = this.getAttribute('data-src');
                const type = this.getAttribute('data-type');

                mainDisplay.innerHTML = '';  // Clear current display

                if (type === 'image') {
                    mainDisplay.innerHTML = `
                        <div class="swiper-slide">
                            <div class="image-container border-b-zinc-700 rounded-sm">
                                <img class="zoomable-image" src="${src}" alt="product Image" />
                            </div>
                        </div>
                    `;
                } else if (type === 'video') {
                    mainDisplay.innerHTML = `
                        <div class="swiper-slide h-fit">
                            <video class="zoomable-video h-fit border-b-zinc-700 rounded-sm" controls controlsList="nodownload noplaybackrate">
                                <source src="${src}" type="video/mp4">
                            </video>
                        </div>
                    `;
                }
            });
        });

        // Sync mySwiperShow with mySwiperProduct when navigating slides
        mySwiperProduct.on('slideChange', function () {
            const activeIndex = mySwiperProduct.activeIndex;
            const activeSlide = mySwiperProduct.slides[activeIndex];

            const src = activeSlide.querySelector('a').getAttribute('data-src');
            const type = activeSlide.querySelector('a').getAttribute('data-type');

            // Update the main display when slide changes
            mainDisplay.innerHTML = '';  // Clear current display

            if (type === 'image') {
                mainDisplay.innerHTML = `
                    <div class="swiper-slide">
                        <div class="image-container border-b-zinc-700 rounded-sm">
                            <img class="zoomable-image" src="${src}" alt="product Image" />
                        </div>
                    </div>
                `;
            } else if (type === 'video') {
                mainDisplay.innerHTML = `
                    <div class="swiper-slide h-fit">
                        <video class="zoomable-video h-fit border-b-zinc-700 rounded-sm" controls controlsList="nodownload noplaybackrate">
                            <source src="${src}" type="video/mp4">
                        </video>
                    </div>
                `;
            }
        });
    });


</script>

@endsection
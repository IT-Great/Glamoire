
@extends('user.layouts.master')

@section('content')
  <div class="md:px-20 lg:px-24 xl:px-24 py-2">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-2">
          <div class="position-sticky mb-3 rounded-md shadow-md p-2 border border-[#183018]" style="top: 4rem">
            <div class="d-flex justify-content-center text-align-center">
              <p class="font-semibold text-black px-5 text-[10px] md:text-[14px] lg:text-[18px] xl:text-[22px]">Deskripsi</p>
            </div>
            @foreach ($brands as $brand)
              <div class="flex md:grid">
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
  
        <div class="col-md-10 col-12 p-md-0">
          <!-- PRODUK TERBARU -->
          <div>
            <div class="text-center">
              <p class="section-title my-3 px-5 text-[10px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terbaru</span></p>
            </div>
    
            @if (count($brand->products) !== 0)
                <div class="swiper mySwiperNewest">
                    <div class="swiper-wrapper">
                            @if (session('id_user'))
                                @foreach ($newest as $product)
                                    <div class="swiper-slide p-0">
                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                            <div class="position-relative overflow-hidden bg-transparent p-0">
                                                <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                            </div>
                                            <div class="grid gap-1 text-left p-2">
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
                                                <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[10px] xl:text-[14px] overflow-hidden">
                                                    <a href="/{{ $product->product_code }}_product" 
                                                    class="text-decoration-none truncate-ellipsis" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="{{ $product->product_name }}">
                                                        {{ $product->product_name }}
                                                    </a>
                                                </p>
                                                <div class="flex justify-content-start gap-1">
                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[10px] xl:text-[14px]">
                                                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                @if ($product->stock_quantity == 0)
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($newest as $product)
                                    <div class="swiper-slide p-0">
                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                            <div class="position-relative overflow-hidden bg-transparent p-0">
                                                <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                            </div>
                                            <div class="grid gap-1 text-left p-2">
                                                <div class="flex gap-1">
                                                    <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                    <i 
                                                        class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                        onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                                    </i>
                                                </div>
                                                <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[10px] xl:text-[14px] overflow-hidden">
                                                    <a href="/{{ $product->product_code }}_product" 
                                                    class="text-decoration-none truncate-ellipsis" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="{{ $product->product_name }}">
                                                        {{ $product->product_name }}
                                                    </a>
                                                </p>
                                                <div class="flex justify-content-start gap-1">
                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[10px] xl:text-[14px]">
                                                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                @if ($product->stock_quantity == 0)
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        @endif
                    </div>
                    
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
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
              <p class="section-title my-3 px-5 text-[10px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terlaris</span></p>
            </div>
    
            @if (count($brand->products) !== 0)
                <div class="swiper mySwiperTop">
                    <div class="swiper-wrapper">
                            @if (session('id_user'))
                                @foreach($top as $product)
                                    <div class="swiper-slide p-0">
                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                            <div class="position-relative overflow-hidden bg-transparent p-0">
                                                <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                            </div>
                                            <div class="grid gap-1 text-left p-2">
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
                                                <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[10px] xl:text-[14px] overflow-hidden">
                                                    <a href="/{{ $product->product_code }}_product" 
                                                    class="text-decoration-none truncate-ellipsis" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="{{ $product->product_name }}">
                                                        {{ $product->product_name }}
                                                    </a>
                                                </p>
                                                <div class="flex justify-content-start gap-1">
                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[10px] xl:text-[14px]">
                                                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                @if ($product->stock_quantity == 0)
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($top as $product)
                                    <div class="swiper-slide p-0">
                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                            <div class="position-relative overflow-hidden bg-transparent p-0">
                                                <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                            </div>
                                            <div class="grid gap-1 text-left p-2">
                                                <div class="flex gap-1">
                                                    <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                                    <i 
                                                        class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                                        onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                                    </i>
                                                </div>
                                                <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[10px] xl:text-[14px] overflow-hidden">
                                                    <a href="/{{ $product->product_code }}_product" 
                                                    class="text-decoration-none truncate-ellipsis" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="{{ $product->product_name }}">
                                                        {{ $product->product_name }}
                                                    </a>
                                                </p>
                                                <div class="flex justify-content-start gap-1">
                                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[10px] xl:text-[14px]">
                                                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                @if ($product->stock_quantity == 0)
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        @endif
                    </div>
                    
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
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

          <!-- SEMUA PRODUK -->
          <div>
            <div class="text-center">
              <p class="section-title my-3 px-5 text-[10px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Semua Produk</span></p>
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
                            @foreach ($brands->products as $product)
                                <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                    <img class="img-fluid w-100 rounded-sm pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                </div>
                                <div class="grid gap-1 text-left p-1 p-md-2">
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
                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] overflow-hidden">
                                        <a href="/{{ $product->product_code }}_product" 
                                        class="text-decoration-none truncate-ellipsis" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="{{ $product->product_name }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </p>
    
                                    <div class="flex justify-content-start gap-1">
                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[10px] xl:text-[14px]">
                                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    
                                    @if ($product->stock_quantity == 0)
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
                                    @endif
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
                            @foreach ($brands->products as $product)
                                <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                <img class="card-img-top" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
    
                                <div class="grid gap-1 text-left p-1 p-md-2">
                                    <div class="flex gap-1">
                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                        <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                        <i 
                                        class="fas fa-heart hover:cursor-pointer ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                        onclick="event.stopPropagation();addToWishlist({{$product->id}})">
                                        </i>
                                    </div>
    
                                    <p class="text-decoration-none text-black text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] overflow-hidden">
                                        <a href="/{{ $product->product_code }}_product" 
                                        class="text-decoration-none truncate-ellipsis" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="{{ $product->product_name }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </p>
                                    
                                    <div class="flex justify-content-start gap-1">
                                        <p class="text-decoration-none text-black text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    @if ($product->stock_quantity == 0)
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
                                    @endif
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
      <!-- TOP SELLING End -->
    </div>
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


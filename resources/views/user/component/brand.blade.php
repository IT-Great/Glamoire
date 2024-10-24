
@extends('user.layouts.master')

@section('content')
  <div class="md:px-20 lg:px-24 xl:px-24 py-2">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-3">
          <div class="position-sticky mb-3 rounded-md shadow-md p-2 border border-[#183018]" style="top: 4rem">
            <div class="d-flex justify-content-center text-align-center">
              <p class="font-semibold text-black px-5 text-[10px] md:text-[14px] lg:text-[18px] xl:text-[22px]">Deskripsi</p>
            </div>
            @foreach ($brands as $brand)
              <div class="d-flex">
                <img src="images/brand-empty-logo.png" alt="{{ $brand->name }}" title="{{ $brand->name }}" class="img-fluid w-1/2 md:w-full">
              </div>
              
              <h1 class="font-semibold text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] py-2">{{ $brand->name }}</h1>
              <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] text-justify">
                {{$brand->description}}
              </p>
            @endforeach
          </div>
        </div>
  
        <div class="col-md-9 col-12 p-md-0">
          <!-- PRODUK TERBARU -->
          <div>
            <div class="text-center">
              <p class="section-title my-3 px-5 text-[10px] md:text-[14px] lg:text-[16px] xl:text-[18px]"><span class="px-2">Produk Terbaru</span></p>
            </div>
    
            @if (count($brand->products) !== 0)
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                            @if (session('id_user'))
                                @foreach($brands as $brand)
                                    @foreach ($brand->products as $product)
                                        <div class="swiper-slide p-0">
                                            <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                                                <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                                    <div class="position-relative overflow-hidden bg-transparent p-0">
                                                        <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                    </div>
                                                    <div class="grid gap-1 text-left p-2">
                                                        <div class="flex">
                                                            <div class="flex gap-1">
                                                                <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                                                <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">5</p>
                                                            </div>
                                                            <div class="ml-auto">
                                                                @php
                                                                    $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                                                                @endphp
                                                                <a href="javascript:void(0);" class="text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" onclick="addToWishlist({{$product->id}})">
                                                                    <i class="fas fa-heart text-center"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[12px]">
                                                            <a href="/{{ $product->product_code }}_product" 
                                                            class="text-decoration-none" 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            title="{{ $product->product_name }}">
                                                                {{ Str::limit($product->product_name, 18) }}
                                                            </a>
                                                        </p>
                                                        <div class="flex justify-content-start gap-1">
                                                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                                                Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-content-between px-2">
                                                        @if ($product->stock_quantity == 0)
                                                            <a class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                                                                Maaf Stok Habis
                                                            </a>
                                                        @else
                                                            @php
                                                                $inCart = collect($cartItems)->contains('product_id', $product->id);
                                                            @endphp

                                                            @if($inCart)
                                                                <a href="/cart" class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[7px] md:text-[10px] lg:text-[10px] xl:text-[10px] flex gap-1 align-items-center justify-content-center hover-red">
                                                                    Cek Keranjang Belanjamu
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0);" class="mb-2 py-2 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="addToCart({{$product->id}})">
                                                                    + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($brand->products as $product)
                                    <div class="swiper-slide p-0">
                                        <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                                            <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                                    <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                </div>
                                                <div class="grid gap-1 text-left p-2">
                                                    <div class="flex">
                                                        <div class="flex gap-1">
                                                            <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                                            <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">5</p>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <a href="javascript:void(0);" class="text-decoration-none text-[#183018] p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" onclick="addToWishlist({{$product->id}})">
                                                                <i class="fas fa-heart text-center"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[12px]">
                                                        <a href="/{{ $product->product_code }}_product" 
                                                        class="text-decoration-none" 
                                                        data-bs-toggle="tooltip" 
                                                        data-bs-placement="top" 
                                                        title="{{ $product->product_name }}">
                                                            {{ Str::limit($product->product_name, 18) }}
                                                        </a>
                                                    </p>
                                                    <div class="flex justify-content-start gap-1">
                                                        <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex justify-content-between px-2">
                                                    @if ($product->stock_quantity == 0)
                                                    <a class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                                                        Maaf Stok Habis
                                                    </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="mb-2 py-2 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="addToCart({{$product->id}})">
                                                            + <i class="fas fa-shopping-cart"></i> Keranjang
                                                        </a>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                        @endif
                    </div>
                    
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination mt-8"></div>
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
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                            @if (session('id_user'))
                                @foreach($brands as $brand)
                                    @foreach ($brand->products as $product)
                                        <div class="swiper-slide p-0">
                                            <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                                                <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                                    <div class="position-relative overflow-hidden bg-transparent p-0">
                                                        <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                    </div>
                                                    <div class="grid gap-1 text-left p-2">
                                                        <div class="flex">
                                                            <div class="flex gap-1">
                                                                <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                                                <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">5</p>
                                                            </div>
                                                            <div class="ml-auto">
                                                                @php
                                                                    $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                                                                @endphp
                                                                <a href="javascript:void(0);" class="text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" onclick="addToWishlist({{$product->id}})">
                                                                    <i class="fas fa-heart text-center"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[12px]">
                                                            <a href="/{{ $product->product_code }}_product" 
                                                            class="text-decoration-none" 
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            title="{{ $product->product_name }}">
                                                                {{ Str::limit($product->product_name, 18) }}
                                                            </a>
                                                        </p>
                                                        <div class="flex justify-content-start gap-1">
                                                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                                                Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-content-between px-2">
                                                        @if ($product->stock_quantity == 0)
                                                            <a class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                                                                Maaf Stok Habis
                                                            </a>
                                                        @else
                                                            @php
                                                                $inCart = collect($cartItems)->contains('product_id', $product->id);
                                                            @endphp

                                                            @if($inCart)
                                                                <a href="/cart" class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[7px] md:text-[10px] lg:text-[10px] xl:text-[10px] flex gap-1 align-items-center justify-content-center hover-red">
                                                                    Cek Keranjang Belanjamu
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0);" class="mb-2 py-2 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="addToCart({{$product->id}})">
                                                                    + <i class="fas fa-shopping-cart"></i> Keranjang
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($brand->products as $product)
                                    <div class="swiper-slide p-0">
                                        <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                                            <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                                    <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                                </div>
                                                <div class="grid gap-1 text-left p-2">
                                                    <div class="flex">
                                                        <div class="flex gap-1">
                                                            <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                                            <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">5</p>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <a href="javascript:void(0);" class="text-decoration-none text-[#183018] p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" onclick="addToWishlist({{$product->id}})">
                                                                <i class="fas fa-heart text-center"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[12px]">
                                                        <a href="/{{ $product->product_code }}_product" 
                                                        class="text-decoration-none" 
                                                        data-bs-toggle="tooltip" 
                                                        data-bs-placement="top" 
                                                        title="{{ $product->product_name }}">
                                                            {{ Str::limit($product->product_name, 18) }}
                                                        </a>
                                                    </p>
                                                    <div class="flex justify-content-start gap-1">
                                                        <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex justify-content-between px-2">
                                                    @if ($product->stock_quantity == 0)
                                                    <a class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                                                        Maaf Stok Habis
                                                    </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="mb-2 py-2 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="addToCart({{$product->id}})">
                                                            + <i class="fas fa-shopping-cart"></i> Keranjang
                                                        </a>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                        @endif
                    </div>
                    
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination mt-8"></div>
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
      </div>
      <!-- TOP SELLING End -->
    </div>
  </div>
@endsection


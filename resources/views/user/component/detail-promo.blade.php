@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-96 py-2">

  <div class="container-fluid py-4">
    @foreach ($promo as $promo)
      <div class="col my-2 p-0">
        <p class="font-semibold text-[14px] md:text-[12px] lg:text-[14px] xl:text-[24px] bg-[#183018] text-white w-fit py-2 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          {{$promo->promo_name}}
        </p>
      </div>
    @endforeach

    <div class="col p-0">
      <img src="{{ Storage::url($promo->image) }}"  class="img-fluid py-1" alt="{{ $promo->promo_name }}" title="{{ $promo->promo_name }}">
    </div>

    <div class="grid-container">
      @if (session('id_user'))
        @foreach ($promo->products as $product)
          <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl" style="min-height:355px; max-height:355px;">
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
                      <div class="grid name-price hover:cursor-pointer">
                        <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            title="{{ $product->product_name }}">

                            <a href="/{{ $product->product_code }}_product" 
                                class="text-decoration-none">
                                {{ Str::limit($product->product_name, 20) }}
                            </a>
                        </p>

                        <div class="flex justify-content-start gap-1">
                          @if ($product->price_after_discount)
                            <p class="text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                              <del>
                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                              </del>
                            </p>
                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($product->price_after_discount, 0, ',', '.') }}</p>
                            @else
                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                              Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                            </p>
                          @endif
                        </div>
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
                      <a href="/cart" class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[10px] flex gap-1 align-items-center justify-content-center hover-red">
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
        @endforeach ($promo->products)
      @else
        @foreach ($promo->products as $product)
          <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
            <img class="card-img-top" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

            <div class="grid text-left content-card px-3 py-2 flex-grow-1">
                <div class="flex rating-wishlist">
                    <div class="flex gap-1">
                        <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                        <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">5</p>
                    </div>

                    <div class="ml-auto">
                        <a title="Tambah ke Favorit" href="javascript:void(0);" class="text-decoration-none text-[#183018] p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" onclick="addToWishlist({{$product->id}})">
                            <i class="fas fa-heart text-center"></i>
                        </a>
                    </div>
                </div>
                
                <div class="grid name-price hover:cursor-pointer">
                    <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]"> 
                        <a href="/{{ $product->product_code }}_product" class="text-decoration-none"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="{{ $product->product_name }}">
                            {{ Str::limit($product->product_name, 24) }}
                        </a>
                    </p>
                    <div class="flex justify-content-start gap-1">
                        @if ($product->price_after_discount)
                          <p class="text-decoration-none text-muted text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                            <del>
                              Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                            </del>
                          </p>
                          <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ number_format($product->price_after_discount, 0, ',', '.') }}</p>
                          @else
                          <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                            Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                          </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="flex justify-content-between px-2 mt-auto add-wishlist">
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
            
          </div>
        @endforeach ($promo->products)
      @endif
    </div>

  </div>
</div>

@endsection

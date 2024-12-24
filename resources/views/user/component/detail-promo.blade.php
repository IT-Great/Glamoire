@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 py-2">

  <div class="container-fluid px-0 px-md-3">
    @foreach ($promo as $promo)
      <div>
        @php
          $dateRange = explode(' - ', $promo->date_range);
          $startDate = \Carbon\Carbon::parse($dateRange[0])->translatedFormat('d F Y');
          $endDate = \Carbon\Carbon::parse($dateRange[1])->translatedFormat('d F Y');
        @endphp
        <p class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] bg-[#183018] text-white w-fit py-2 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          {{ $promo->promo_name }} <br>
          Berlaku hingga {{ $endDate }}
        </p>
      </div>
    @endforeach

    <div class="col p-0">
      <img src="{{ Storage::url($promo->image) }}"  class="w-full py-2  " alt="{{ $promo->promo_name }}" title="{{ $promo->promo_name }}">
    </div>

    <div id="skeletonLoader" class="skeleton-loader px-1">
      @for ($i = 0; $i < count($promo->products); $i++) <!-- Adjust the number based on how many you want to show -->
        <div class="skeleton-card">
          <div class="skeleton-image"></div>
          <div class="skeleton-text"></div>
          <div class="skeleton-text small"></div>
          <div class="skeleton-price"></div>
        </div>
      @endfor
    </div>

    <div id="productList" style="display: none;">                
      <div class="grid-container p-0">
        @if (session('id_user'))
          @foreach ($promo->products as $product)
            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
              <div class="position-relative overflow-hidden bg-transparent p-0">
                  <img class="img-fluid w-100 rounded-sm pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
              </div>
              <div class="grid text-left p-1 p-md-2">
                  <div class="flex gap-1">
                    <i class="text-decoration-none fas fa-star text-[8px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                    <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                    @php
                        $inWishlist = collect($wishlists)->contains('product_id', $product->id);
                    @endphp
                    <i 
                        class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018]' }} text-[8px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
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

                    <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                      <del>
                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                      </del>
                    </p>
                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                    
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
                      <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                          Cek Keranjang
                      </a>
                    @else
                      <a class="py-1 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                          + <i class="fas fa-shopping-cart"></i> Keranjang
                      </a>
                    @endif
                  @endif --}}
              </div>
            </div>
          @endforeach ($promo->products)
        @else
          @foreach ($promo->products as $product)
            <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
              <img class="card-img-top" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

              <div class="grid text-left p-1 p-md-2">
                <div class="flex gap-1">
                  <i class="text-decoration-none fas fa-star text-[8px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                  <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                  <i 
                    class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[8px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
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

                  <p class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                    <del>
                      Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                    </del>
                  </p>
                  <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
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
                    <a class="py-1 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$product->id}})">
                        + <i class="fas fa-shopping-cart"></i> Keranjang
                    </a>
                @endif --}}
              </div>
            </div>
          @endforeach ($promo->products)
        @endif
      </div>
    </div>

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

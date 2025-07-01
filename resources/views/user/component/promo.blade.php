@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2 mb-8">
  <div class="container-fluid p-0 grid gap-2" style="min-height:55vh;">

    @if(count($promos) === 0 && count($voucherGlamoire) === 0 && count($brandVouchers) === 0 && count($productVouchers) === 0 && count($promoBundlings) === 0)
      <div class="container-fluid px-0 px-md-3">
        <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3 px-0 px-md-3">
          <div class="d-flex gap-1 px-3 px-md-0">
            <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Tidak ada promo yang tersedia saat ini.</p>
          </div>
        </div>
      </div>
      <div style="display:flex; align-items:center; justify-content:center;">
        <img src="images/about-1.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
      </div>
    @endif

    @if (count($promos) !== 0)
      <div class="mx-0 mx-md-3 px-0  border-bottom border-dark">
        <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-1 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          Event Glamoire
        </p>
      </div>

      {{-- <div class="grid-container-promo-promos px-3"> --}}
        {{-- @foreach ($promos as $promo)
          @php
            $dateRange = explode(' - ', $promo->date_range);
            $startDate = \Carbon\Carbon::parse($dateRange[0])->translatedFormat('d F Y');
            $endDate = \Carbon\Carbon::parse($dateRange[1])->translatedFormat('d F Y');
          @endphp --}}

          {{-- <div class="col-12 col-md-6 grid">
            <div class="custom-shadow">
              <div class="py-0">
                <a href="/{{$promo->promo_name}}-detail-promo" class="block overflow-hidden hover:shadow-xl">
                  <div class="relative overflow-hidden">
                    <img src="{{ Storage::url($promo->image) }}" 
                        class="w-full py-1 promo-image transform transition-transform duration-300 hover:scale-110 hover:shadow-md" 
                        alt="{{ $promo->promo_name }}" 
                        title="{{ $promo->promo_name }}">
                  </div>
                </a>
              </div>
              <div class="grid">
                <p class="text-[#183018] font-semibold text-[14px] md:text-[12px] lg:text-[12px] xl:text-[14px]">
                  {{ $promo->promo_name }}
                </p>
                <p class="text-[#183018] text-[13px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                  Diskon @if ($promo->discount <= 100)
                    {{ $promo->discount }}%
                  @else
                    Rp{{ number_format($promo->discount, 0, ',', '.') }}
                  @endif 
                </p>
                <p class="text-[11px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                  Berlaku hingga {{ $endDate }}
                </p>
              </div>
            </div>
          </div> --}}
          
          {{-- <div class="bg-white rounded-sm shadow-md overflow-hidden h-fit">
            <div>
              <a href="/{{$promo->promo_name}}-detail-promo" class="block overflow-hidden hover:shadow-xl">
                <div class="relative overflow-hidden">
                  <img src="{{ Storage::url($promo->image) }}" 
                      class="w-full py-1 card-img-top promo-image transform transition-transform duration-300 hover:scale-110 hover:shadow-md" 
                      alt="{{ $promo->promo_name }}" 
                      title="{{ $promo->promo_name }}">
                </div>
              </a>
            </div>
            <div class=" p-2">
              <div class="grid w-full gap-1">
                <div class="flex justify-between items-end text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                  <div>
                    <p class="text-[#183018] font-semibold text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]">
                      {{ $promo->promo_name }}
                    </p>
                    <p>
                      Diskon 
                      @if ($promo->discount <= 100)
                        {{ $promo->discount }}%
                      @else
                        Rp{{ number_format($promo->discount, 0, ',', '.') }}
                      @endif 
                    </p>
                    <p>Berlaku hingga {{ $endDate }}</p>
                  </div>
                  <div class="flex align-items-end">
                    <button class="ml-auto bg-[#183018] text-white py-1 px-2 rounded-sm text-[7px] md:text-[9px] lg:text-[9px] xl:text-[13px]">
                      Lihat Promo
                    </button>
                  </div>
                </div>
              </div>
              
            </div>
          </div> --}}
        {{-- @endforeach --}}
      {{-- </div> --}}

      <div class="swiper mySwiperCarousel">
        <div class="swiper-wrapper">
            @foreach ($promos as $promo)
                <div class="swiper-slide">
                    <div class="container-fluid">
                        <a href="/{{$promo->promo_name}}-detail-promo">
                            <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name}}" title="{{ $promo->promo_name}}" class="img-fluid">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    @endif

    @if (count($voucherGlamoire) !== 0)
      <div class="mx-0 mx-md-3 px-0  border-bottom border-dark">
        <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-1 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          Voucher Glamoire
        </p>
      </div>
      
      <div class="swiper mySwiperPromo px-3">
        <div class="swiper-wrapper overflow-y-hidden "> 
          @foreach ($voucherGlamoire as $voucher)
            <div class="swiper-slide">
              <div class="product-image-container">
                <a class="hover:cursor-pointer" 
                    data-bs-toggle="modal" 
                    data-bs-target="#voucherModal" 
                    data-image="{{ Storage::url($voucher->image) }}"
                    data-name="{{ $voucher->promo_name }}"
                    data-discount="{{ $voucher->discount }}"
                    data-max-quantity="{{ $voucher->max_quantity_buyer }}"
                    data-min-transaction="{{ number_format($voucher->min_transaction, 0, ',', '.') }}"
                    data-start-date="{{ \Carbon\Carbon::parse($voucher->start_date)->translatedFormat('d F Y') }}"
                    data-end-date="{{ \Carbon\Carbon::parse($voucher->end_date)->translatedFormat('d F Y') }}">
                  <img class="card-img-top product-image transform transition-transform duration-300 hover:scale-110" 
                        src="{{ Storage::url($voucher->image) }}" 
                        alt="{{ $voucher->promo_name }}" 
                        title="{{$voucher->promo_name}}">
                </a>
              </div>
            </div>
          @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content" style="max-height:90vh;">
            <div class="modal-body p-0">
              <div class="product-image-container">
                <img id="voucherImage" class="img-fluid card-img-top rounded product-image" src="" alt="Product Image">
              </div>
              <div class="p-2">
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold" id="voucherModalLabel"></p>
                <p class="text-[10px] lg:text-[12px] mb-2">
                  Dapatkan diskon 
                  <span id="voucherDiscount"></span>
                </p>
                <div class="grid">
                  <p class="text-[#183018] text-[10px] lg:text-[12px] font-semibold">Syarat & Ketentuan:</p>
                  <ul class="text-[10px] lg:text-[12px] list-disc ml-4">
                    <li>Maksimal <span id="voucherMaxQuantity"></span> item pembelian.</li>
                    <li>Minimum transaksi Rp<span id="voucherMinTransaction"></span>.</li>
                    <li>Periode voucher <span id="voucherStartDate"></span> hingga <span id="voucherEndDate"></span>.</li>
                  </ul>
                </div>
                <p class="text-[9px] lg:text-[10px] text-danger mt-2">*Gunakan ketika checkout barang</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    
    {{-- @if (count($limitedVouchers) !== 0)
      <div class="mx-0 mx-md-3 px-0  border-bottom border-dark">
        <p class="font-semibold text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-2 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          Voucher Discount
        </p>
      </div>
      <div class="grid-container-promo px-3">
        @foreach ($limitedVouchers as $limited)
          <div class="bg-white rounded-sm shadow-md overflow-hidden h-fit">
            <div class="product-image-container">
                <img class="card-img-top product-image" src="{{ Storage::url($limited->image) }}" alt="{{ $limited->promo_name }}">
            </div>
            <div class=" p-2">
              <div class="grid w-full gap-1">
                <div class="grid">
                  <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($limited->promo_name) }}</p>
                  <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]">Dapatkan diskon
                    @if ($limited->discount <= 100)
                      {{ $limited->discount }}%
                    @else
                      Rp{{ number_format($limited->discount, 0, ',', '.') }}
                    @endif
                    </p>
                </div>

                <div class="grid">
                  <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold mb-1">Syarat & Ketentuan</p>
                  <div class="grid gap-1">
                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">1. Maksimal {{ $limited->max_quantity_buyer }} item pembelian</p>
                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">2. Minimun transaksi Rp{{ number_format($limited->min_transaction, 0, ',', '.') }}
                    <p class="ml-2 text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">3. Periode voucher {{ \Carbon\Carbon::parse($limited->start_date)->translatedFormat('d F Y') }} hingga {{ \Carbon\Carbon::parse($limited->end_date)->translatedFormat('d F Y') }}</p>
                    <p class="ml-2 text-[9px] md:text-[9px] lg:text-[9px] xl:text-[10px] text-danger">*Gunakan ketika checkout barang</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        @endforeach
      </div>
    @endif --}}

    @if (count($brandVouchers) !== 0)
      <div class="mx-0 mx-md-3 px-0  border-bottom border-dark">
        <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-1 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          Voucher Brand
        </p>
      </div>
      <div class="grid-container-promo px-3">
        @foreach ($brandVouchers as $brand)
          {{-- <div class="bg-white rounded-sm shadow-md overflow-hidden h-fit"> --}}
            <div class="product-image-container">
              <img class="product-image transform transition-transform duration-300 hover:scale-110 hover:cursor-pointer" src="{{ Storage::url($brand->image) }}" alt="{{ $brand->promo_name }}" data-bs-toggle="modal" data-bs-target="#detail-brand-voucher-{{$brand->id}}">
            </div>
            {{-- <div class=" p-2">
              <div class="grid w-full gap-1">
                <div class="grid">
                  <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($brand->promo_name) }}</p>
                  <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[13px]">Dapatkan diskon
                    @if ($brand->discount <= 100)
                      {{ $brand->discount }}%
                    @else
                      Rp{{ number_format($brand->discount, 0, ',', '.') }}
                    @endif
                    </p>
                </div>
              </div>

              <div>
                <button class="ml-auto  hover:cursor-pointer bg-[#183018] text-white py-1 px-2 rounded-sm text-[7px] md:text-[9px] lg:text-[9px] xl:text-[11px]" data-bs-toggle="modal" data-bs-target="#detail-brand-voucher-{{$brand->id}}">
                  Lihat Detail Produk
                </button>
              </div> --}}

            {{-- </div> --}}
          {{-- </div> --}}

          <!-- Modal untuk setiap produk -->
          <div class="modal fade" id="detail-brand-voucher-{{$brand->id}}" tabindex="-1" aria-labelledby="detail-product-voucher-{{$brand->id}}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                {{-- <div class="modal-header bg-[#183018]">
                  <h1 class="modal-title text-white text-[12px] lg:text-[16px]">Produk</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                </div> --}}

                <div class="modal-body grid md:flex border-top border-1 p-2 overflow-y-auto custom-scroll">
                  <div class="col-12 col-md-4 p-0">
                    <div class="product-image-container">
                      <img class="product-image" src="{{ Storage::url($brand->image) }}" alt="{{ $brand->promo_name }}" data-bs-toggle="modal" data-bs-target="#detail-brand-voucher-{{$brand->id}}">
                    </div>
                    <div class="grid w-full gap-1">
                      <div class="grid">
                        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($brand->promo_name) }}</p>
                        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[13px]">Dapatkan diskon
                          @if ($brand->discount <= 100)
                            {{ $brand->discount }}%
                          @else
                            Rp{{ number_format($brand->discount, 0, ',', '.') }}
                          @endif
                          </p>
                      </div>
                      <div class="grid">
                        <p class="text-[10px] lg:text-[12px] text-[#183018] font-semibold mb-1">Syarat & Ketentuan</p>
                        <ul class="text-[10px] lg:text-[12px] list-disc ml-4">
                          <li>Maksimal {{ $brand->max_quantity_buyer }} item pembelian</li>
                          <li>Minimum transaksi Rp{{ number_format($brand->min_transaction, 0, ',', '.') }}</li>
                          <li>Periode voucher {{ \Carbon\Carbon::parse($brand->start_date)->translatedFormat('d F Y') }} hingga {{ \Carbon\Carbon::parse($brand->end_date)->translatedFormat('d F Y') }}</li>
                          <li>Hanya berlaku untuk produk tertentu</li>
                        </ul>
                    
                          <p class="ml-2 text-[9px] lg:text-[11px] text-danger">*Gunakan ketika checkout barang</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8 px-0 px-md-3">
                    <div class="grid-container-product-promo">
                      @if (session('id_user'))
                        @foreach ($brand->products as $item)
                        <div onclick="window.location.href = '/{{ $item->product_code }}_product'" class="bg-white rounded-sm custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                            <a href="/{{ $item->product_code }}_product" class="text-decoration-none">
                                <div class="product-image-container">
                                    <img class="card-img-top product-image {{ $item->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($item->main_image) }}" alt="{{ $item->product_name }}">
                                </div>
  
                                <div class="grid text-left p-1 p-md-2">
                                    <div class="flex gap-1">
                                        <i class="text-decoration-none fas fa-star text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                        <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $item->rating }}</p>
                                        @php
                                            $inWishlist = collect($wishlist)->contains('product_id', $item->id);
                                        @endphp
                                        <i 
                                            class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018] hover-red' }} text-[9px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between" 
                                            onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $item->id . ')' : 'addToWishlist(' . $item->id . ')' }}">
                                        </i>
                                    </div>
                                    <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                        <a href="/{{ $item->product_code }}_product" 
                                        class="text-decoration-none truncate-ellipsis" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="{{ $item->product_name }}">
                                            {{ $item->product_name }}
                                        </a>
                                    </p>
  
                                    <div class="flex justify-content-start gap-1">
                                      @if ($item->priceVariation !== null)
                                        <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                            {{ $item->priceVariation }}
                                        </p>
                                      @else
                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($item->regular_price, 0, ',', '.') }}</p>
                                      @endif
                                    </div>
                                    
                                    {{-- @if ($item->stock_quantity == 0)
                                        <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Beritahu Saya Jika Stok Sudah Ada" 
                                            type="button" 
                                            style="color:#183018"
                                            id="notify-me-{{$item->id}}"
                                            onclick="event.stopPropagation();notifyMe({{$item->id}})"
                                        >
                                            Stok Habis
                                        </a>
                                    @else
                                        @php
                                            $inCart = collect($cartItems)->contains('product_id', $item->id);
                                        @endphp
    
                                        @if($inCart)
                                            <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] hover:bg-neutral-900 text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                Cek Keranjang
                                            </a>
                                        @else
                                            <a class="gap-1 py-1 rounded-sm border border-[#183018] hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                                + <i class="fas fa-shopping-cart"></i> Keranjang
                                            </a>
                                        @endif
                                    @endif --}}
                                </div>
                            </a>
                        </div>
                        @endforeach
                      @else
                        @foreach ($brand->products as $item)
                          <div onclick="window.location.href = '/{{ $item->product_code }}_product'" class="bg-white rounded-sm custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                            <div class="position-relative overflow-hidden bg-transparent p-0">
                              <img class="card-img-top" src="{{ Storage::url($item->main_image) }}" alt="{{ $item->product_name }}">
                            </div>
                            <div class="grid text-left p-1 p-md-2">
                              <div class="flex gap-1">
                                <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $item->rating }}</p>
                                <i 
                                  class="fas fa-heart hover:cursor-pointer ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                  onclick="event.stopPropagation();addToWishlist({{$item->id}})">
                                </i>
                              </div>
      
                              <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                <a href="/{{ $item->product_code }}_product" 
                                class="text-decoration-none truncate-ellipsis" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="{{ $item->product_name }}">
                                    {{ $item->product_name }}
                                </a>
                              </p>
      
                              <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                Rp{{ number_format($item->regular_price, 0, ',', '.') }}
                              </p>
      
                              {{-- @if ($item->stock_quantity == 0)
                                <a class="py-1 rounded-sm shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Beritahu Saya Jika Stok Sudah Ada" 
                                    type="button" 
                                    style="color:#183018"
                                    id="notify-me-{{$item->id}}"
                                    onclick="event.stopPropagation();notifyMe({{$item->id}})"
                                >
                                    Stok Habis
                                </a>
                              @else
                                <a class="py-1 rounded-sm hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                  + <i class="fas fa-shopping-cart"></i> Keranjang
                                </a>
                              @endif --}}
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        @endforeach
      </div>
    @endif

    @if (count($productVouchers) !== 0)
      <div class="mx-0 mx-md-3 px-0  border-bottom border-dark">
        <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-1 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          Voucher Product
        </p>
      </div>
      <div class="container">
        <div class="grid-container-promo">
          @foreach ($productVouchers as $product)
            <div class="bg-white rounded-sm shadow-md overflow-hidden h-fit">
              <div class="product-image-container">
                <img class="product-image transform transition-transform duration-300 hover:scale-110 hover:cursor-pointer" src="{{ Storage::url($product->image) }}" alt="{{ $product->promo_name }}" data-bs-toggle="modal" data-bs-target="#detail-product-voucher-{{$product->id}}">
              </div>
              {{-- <div class="p-2">
                <div class="grid w-full gap-1">
                  <div class="grid">
                    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($product->promo_name) }}</p>
                    <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Dapatkan diskon
                      @if ($product->discount <= 100)
                        {{ $product->discount }}%
                      @else
                        Rp{{ number_format($product->discount, 0, ',', '.') }}
                      @endif
                    </p>
                  </div>

                  <div class="grid">
                    <p class="text-[10px] lg:text-[12px] text-[#183018] font-semibold mb-1">Syarat & Ketentuan</p>
                    <div class="grid gap-1">
                      <p class="ml-2 text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">1. Maksimal {{ $product->max_quantity_buyer }} item pembelian</p>
                      <p class="ml-2 text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">2. Minimum transaksi Rp{{ number_format($product->min_transaction, 0, ',', '.') }}</p>
                      <p class="ml-2 text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">3. Periode voucher {{ \Carbon\Carbon::parse($product->start_date)->translatedFormat('d F Y') }} hingga {{ \Carbon\Carbon::parse($product->end_date)->translatedFormat('d F Y') }}</p>
                      <p class="ml-2 text-[9px] lg:text-[10px] text-danger">*Gunakan ketika checkout barang</p>
                    </div>
                  </div>

                  <div>
                    <p class="text-[10px] lg:text-[12px] hover:cursor-pointer" >Lihat Detail Produk</p>
                  </div>
                </div>
              </div> --}}
            </div>

            <!-- Modal untuk setiap produk -->
            <div class="modal fade" id="detail-product-voucher-{{$product->id}}" tabindex="-1" aria-labelledby="detail-product-voucher-{{$product->id}}" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                  {{-- <div class="modal-header bg-[#183018]">
                    <h1 class="modal-title text-white text-[12px] lg:text-[16px]">Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                  </div> --}}

                  <div class="modal-body grid md:flex border-top border-1 p-2 overflow-y-auto custom-scroll">
                    <div class="col-12 col-md-4 p-0">
                      <div class="product-image-container">
                        <img class="product-image" src="{{ Storage::url($product->image) }}" alt="{{ $product->promo_name }}" data-bs-toggle="modal" data-bs-target="#detail-brand-voucher-{{$product->id}}">
                      </div>
                      <div class="grid w-full gap-1">
                        <div class="grid">
                          <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($product->promo_name) }}</p>
                          <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[13px]">Dapatkan diskon
                            @if ($product->discount <= 100)
                              {{ $product->discount }}%
                            @else
                              Rp{{ number_format($product->discount, 0, ',', '.') }}
                            @endif
                            </p>
                        </div>
                        <div class="grid">
                          <p class="text-[10px] lg:text-[12px] text-[#183018] font-semibold mb-1">Syarat & Ketentuan</p>
                          <ul class="text-[10px] lg:text-[12px] list-disc ml-4">
                            <li>Maksimal {{ $product->max_quantity_buyer }} item pembelian</li>
                            <li>Minimum transaksi Rp{{ number_format($product->min_transaction, 0, ',', '.') }}</li>
                            <li>Periode voucher {{ \Carbon\Carbon::parse($product->start_date)->translatedFormat('d F Y') }} hingga {{ \Carbon\Carbon::parse($product->end_date)->translatedFormat('d F Y') }}</li>
                            <li>Hanya berlaku untuk produk tertentu</li>
                          </ul>
                      
                            <p class="ml-2 text-[9px] lg:text-[11px] text-danger">*Gunakan ketika checkout barang</p>
                         </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-8 px-0 px-md-3">
                      <div class="grid-container-product-promo">
                        @if (session('id_user'))
                          @foreach ($product->products as $item)
                          <div onclick="window.location.href = '/{{ $item->product_code }}_product'" class="bg-white rounded-sm custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                              <a href="/{{ $item->product_code }}_product" class="text-decoration-none">
                                  <div class="product-image-container">
                                      <img class="card-img-top product-image {{ $item->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($item->main_image) }}" alt="{{ $item->product_name }}">
                                  </div>
  
                                  <div class="grid text-left p-1 p-md-2">
                                      <div class="flex gap-1">
                                          <i class="text-decoration-none fas fa-star text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                          <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $item->rating }}</p>
                                          @php
                                              $inWishlist = collect($wishlist)->contains('product_id', $item->id);
                                          @endphp
                                          <i 
                                              class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018] hover-red' }} text-[9px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between" 
                                              onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $item->id . ')' : 'addToWishlist(' . $item->id . ')' }}">
                                          </i>
                                      </div>
                                      <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                          <a href="/{{ $item->product_code }}_product" 
                                          class="text-decoration-none truncate-ellipsis" 
                                          data-bs-toggle="tooltip" 
                                          data-bs-placement="top" 
                                          title="{{ $item->product_name }}">
                                              {{ $item->product_name }}
                                          </a>
                                      </p>
  
                                      @if ($item->priceVariation !== null)
                                        <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                            {{ $item->priceVariation }}
                                        </p>
                                      @else
                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($item->regular_price, 0, ',', '.') }}</p>
                                      @endif
                                      
                                      {{-- @if ($item->stock_quantity == 0)
                                          <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                              data-bs-toggle="tooltip" 
                                              data-bs-placement="top" 
                                              title="Beritahu Saya Jika Stok Sudah Ada" 
                                              type="button" 
                                              style="color:#183018"
                                              id="notify-me-{{$item->id}}"
                                              onclick="event.stopPropagation();notifyMe({{$item->id}})"
                                          >
                                              Stok Habis
                                          </a>
                                      @else
                                          @php
                                              $inCart = collect($cartItems)->contains('product_id', $item->id);
                                          @endphp
      
                                          @if($inCart)
                                              <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] hover:bg-neutral-900 text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                  Cek Keranjang
                                              </a>
                                          @else
                                              <a class="gap-1 py-1 rounded-sm border border-[#183018] hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                                  + <i class="fas fa-shopping-cart"></i> Keranjang
                                              </a>
                                          @endif
                                      @endif --}}
                                  </div>
                              </a>
                          </div>
                          @endforeach
                        @else
                          @foreach ($product->products as $item)
                            <div onclick="window.location.href = '/{{ $item->product_code }}_product'" class="bg-white rounded-sm custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                              <div class="position-relative overflow-hidden bg-transparent p-0">
                                <img class="card-img-top" src="{{ Storage::url($item->main_image) }}" alt="{{ $item->product_name }}">
                              </div>
                              <div class="grid text-left p-1 p-md-2">
                                <div class="flex gap-1">
                                  <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                  <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $item->rating }}</p>
                                  <i 
                                    class="fas fa-heart hover:cursor-pointer ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                    onclick="event.stopPropagation();addToWishlist({{$item->id}})">
                                  </i>
                                </div>
        
                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                  <a href="/{{ $item->product_code }}_product" 
                                  class="text-decoration-none truncate-ellipsis" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="{{ $item->product_name }}">
                                      {{ $item->product_name }}
                                  </a>
                                </p>
        
                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                  Rp{{ number_format($item->regular_price, 0, ',', '.') }}
                                </p>
        
                                {{-- @if ($item->stock_quantity == 0)
                                  <a class="py-1 rounded-sm shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                      data-bs-toggle="tooltip" 
                                      data-bs-placement="top" 
                                      title="Beritahu Saya Jika Stok Sudah Ada" 
                                      type="button" 
                                      style="color:#183018"
                                      id="notify-me-{{$item->id}}"
                                      onclick="event.stopPropagation();notifyMe({{$item->id}})"
                                  >
                                      Stok Habis
                                  </a>
                                @else
                                  <a class="py-1 rounded-sm hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                    + <i class="fas fa-shopping-cart"></i> Keranjang
                                  </a>
                                @endif --}}
                              </div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div> 
      </div>
    @endif

    @if (count($promoBundlings) !== 0)
      <div class="mx-0 mx-md-3 px-0  border-bottom border-dark">
        <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] bg-[#183018] text-white w-fit py-1 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
          Promo Bundlings
        </p>
      </div>
      <div class="container">
        <div class="grid-container-promo">
          @foreach ($promoBundlings as $product)
            <div class="bg-white rounded-sm shadow-md overflow-hidden h-fit">
              <div class="product-image-container hover:cursor-pointer" data-bs-toggle="modal" data-bs-target="#detail-product-voucher-{{$product->id}}">
                <img class="card-img-top product-image" src="images/bundling.png" alt="{{ $product->promo_name }}">
                {{-- <p class="text-center text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] text-[#183018]">{{ ucwords($product->promo_name) }}</p> --}}
              </div>
              {{-- <div class="p-2">
                <div class="grid w-full gap-1">
                  <div class="grid">
                    <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{!! $product->all_discount_tiers !!}</p>
                  </div>

                  <div class="grid">
                    <p class="text-[10px] lg:text-[12px] text-[#183018] font-semibold mb-1">Syarat & Ketentuan</p>
                    <div class="grid gap-1">
                      <p class="ml-2 text-[9px] lg:text-[10px] text-danger">*Gunakan ketika checkout barang</p>
                    </div>
                  </div>

                  <div>
                    <p class="text-[10px] lg:text-[12px] hover:cursor-pointer" data-bs-toggle="modal" data-bs-target="#detail-product-voucher-{{$product->id}}">Lihat Detail Produk</p>
                  </div>
                </div>
              </div> --}}
            </div>

            <!-- Modal untuk setiap produk -->
            <div class="modal fade" id="detail-product-voucher-{{$product->id}}" tabindex="-1" aria-labelledby="detail-product-voucher-{{$product->id}}" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content overflow-y-auto" style="max-height:90vh;">
                  {{-- <div class="modal-header bg-[#183018]">
                    <h1 class="modal-title text-white text-[12px] lg:text-[16px]">Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                  </div> --}}

                  <div class="modal-body grid md:flex border-top border-1 p-2 overflow-y-auto custom-scroll">
                    <div class="col-12 col-md-4 p-0">
                      <div class="product-image-container hover:cursor-pointer" data-bs-toggle="modal" data-bs-target="#detail-product-voucher-{{$product->id}}">
                        <img class="card-img-top product-image" src="images/bundling.png" alt="{{ $product->promo_name }}">
                        {{-- <p class="text-center text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] text-[#183018] font-semibold">{{ ucwords($product->promo_name) }}</p> --}}
                      </div>
                      <div class="p-2">
                        <div class="grid w-full gap-1">
                          <div class="grid">
                            <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018] font-semibold">{{ ucwords($product->promo_name) }}</p>
                          </div>
                          
                          <div class="grid">
                            <p class="text-[10px] lg:text-[12px] text-[#183018] font-semibold mb-1">Syarat & Ketentuan :</p>
                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] mb-1">{!! $product->all_discount_tiers !!}</p>
                            <p class="text-[9px] lg:text-[11px] text-danger">*Gunakan ketika checkout barang</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-12 col-md-8 px-0 px-md-3">
                      <div class="grid-container-product-promo">

                        @if (session('id_user'))
                          @foreach ($product->products as $item)
                          <div onclick="window.location.href = '/{{ $item->product_code }}_product'" class="bg-white rounded-sm custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                              <a href="/{{ $item->product_code }}_product" class="text-decoration-none">
                                  <div class="product-image-container">
                                      <img class="card-img-top product-image {{ $item->stock_quantity == 0 ? 'dark-overlay' : '' }}" src="{{ Storage::url($item->main_image) }}" alt="{{ $item->product_name }}">
                                  </div>
  
                                  <div class="grid text-left p-1 p-md-2">
                                      <div class="flex gap-1">
                                          <i class="text-decoration-none fas fa-star text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                          <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $item->rating }}</p>
                                          @php
                                              $inWishlist = collect($wishlist)->contains('product_id', $item->id);
                                          @endphp
                                          <i 
                                              class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018] hover-red' }} text-[9px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between" 
                                              onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $item->id . ')' : 'addToWishlist(' . $item->id . ')' }}">
                                          </i>
                                      </div>
                                      <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                          <a href="/{{ $item->product_code }}_product" 
                                          class="text-decoration-none truncate-ellipsis" 
                                          data-bs-toggle="tooltip" 
                                          data-bs-placement="top" 
                                          title="{{ $item->product_name }}">
                                              {{ $item->product_name }}
                                          </a>
                                      </p>
  
                                      @if ($item->priceVariation !== null)
                                        <p class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                            {{ $item->priceVariation }}
                                        </p>
                                      @else
                                        <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">Rp{{ number_format($item->regular_price, 0, ',', '.') }}</p>
                                      @endif
                                      
                                      {{-- @if ($item->stock_quantity == 0)
                                          <a class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                              data-bs-toggle="tooltip" 
                                              data-bs-placement="top" 
                                              title="Beritahu Saya Jika Stok Sudah Ada" 
                                              type="button" 
                                              style="color:#183018"
                                              id="notify-me-{{$item->id}}"
                                              onclick="event.stopPropagation();notifyMe({{$item->id}})"
                                          >
                                              Stok Habis
                                          </a>
                                      @else
                                          @php
                                              $inCart = collect($cartItems)->contains('product_id', $item->id);
                                          @endphp
      
                                          @if($inCart)
                                              <a href="/cart" class="py-1 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] hover:bg-neutral-900 text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red">
                                                  Cek Keranjang
                                              </a>
                                          @else
                                              <a class="gap-1 py-1 rounded-sm border border-[#183018] hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                                  + <i class="fas fa-shopping-cart"></i> Keranjang
                                              </a>
                                          @endif
                                      @endif --}}
                                  </div>
                              </a>
                          </div>
                          @endforeach
                        @else
                          @foreach ($product->products as $item)
                            <div onclick="window.location.href = '/{{ $item->product_code }}_product'" class="bg-white rounded-sm custom-shadow border border-secondary overflow-hidden h-fit hover:cursor-pointer">
                              <div class="position-relative overflow-hidden bg-transparent p-0">
                                <img class="card-img-top" src="{{ Storage::url($item->main_image) }}" alt="{{ $item->product_name }}">
                              </div>
                              <div class="grid text-left p-1 p-md-2">
                                <div class="flex gap-1">
                                  <i class="text-decoration-none fas fa-star text-[9px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                  <p class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $item->rating }}</p>
                                  <i 
                                    class="fas fa-heart hover:cursor-pointer ml-auto text-decoration-none text-[#183018] text-[9px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red" 
                                    onclick="event.stopPropagation();addToWishlist({{$item->id}})">
                                  </i>
                                </div>
        
                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px] overflow-hidden">
                                  <a href="/{{ $item->product_code }}_product" 
                                  class="text-decoration-none truncate-ellipsis" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="{{ $item->product_name }}">
                                      {{ $item->product_name }}
                                  </a>
                                </p>
        
                                <p class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[11px] xl:text-[13px]">
                                  Rp{{ number_format($item->regular_price, 0, ',', '.') }}
                                </p>
        
                                {{-- @if ($item->stock_quantity == 0)
                                  <a class="py-1 rounded-sm shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex align-items-center justify-content-center"
                                      data-bs-toggle="tooltip" 
                                      data-bs-placement="top" 
                                      title="Beritahu Saya Jika Stok Sudah Ada" 
                                      type="button" 
                                      style="color:#183018"
                                      id="notify-me-{{$item->id}}"
                                      onclick="event.stopPropagation();notifyMe({{$item->id}})"
                                  >
                                      Stok Habis
                                  </a>
                                @else
                                  <a class="py-1 rounded-sm hover:cursor-pointer hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="event.stopPropagation();addToCart({{$item->id}})">
                                    + <i class="fas fa-shopping-cart"></i> Keranjang
                                  </a>
                                @endif --}}
                              </div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div> 
      </div>
    @endif
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const voucherModal = document.getElementById('voucherModal');

    voucherModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Element yang diklik untuk membuka modal
        const modal = voucherModal;

        // Ambil data dari atribut
        const image = button.getAttribute('data-image');
        const name = button.getAttribute('data-name');
        const discount = button.getAttribute('data-discount');
        const maxQuantity = button.getAttribute('data-max-quantity');
        const minTransaction = button.getAttribute('data-min-transaction');
        const startDate = button.getAttribute('data-start-date');
        const endDate = button.getAttribute('data-end-date');

        // Masukkan data ke dalam modal
        modal.querySelector('#voucherImage').src = image;
        modal.querySelector('#voucherImage').alt = name;
        modal.querySelector('#voucherModalLabel').textContent = name;
        modal.querySelector('#voucherDiscount').textContent = discount <= 100 ? `${discount}%` : `Rp${discount}`;
        modal.querySelector('#voucherMaxQuantity').textContent = maxQuantity;
        modal.querySelector('#voucherMinTransaction').textContent = minTransaction;
        modal.querySelector('#voucherStartDate').textContent = startDate;
        modal.querySelector('#voucherEndDate').textContent = endDate;
    });
  });

  var swiperCorousel = new Swiper(".mySwiperCarousel", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoint: {
      320: {
        navigation: false,
      }
    }
  });
</script>
@endsection


@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 pt-2 py-2 mb-4">
  <div class="container-fluid px-0 px-md-3">
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3 px-0 px-md-3">
      <div class="d-flex gap-1 px-3 px-md-0">
        <a href="/" class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Hasil Pencarian "{{ $data['keyword'] }}"</a>
      </div>
    </div>  
  </div>

  <!-- Shop Start -->
  <div class="container-fluid my-2 my-md-8">
    <div class="row">
      <!-- Shop Sidebar Start -->
      <div class="col-lg-2 pr-md-0 col-md-3 d-none d-md-block">
        <!-- Filter Start -->
        <div class="border border-black shadow-md rounded-sm md:mb-0 lg:mb-0 xl:mb-0 py-1 px-3">
          <h5 class="font-weight-semi-bold text-[#183018] my-2">Filter</h5>
          <form action="{{ route('search.product') }}" method="GET" id="form-filter-product">
            <input type="hidden" name="product_search" value="{{ request('product_search', '') }}">
            <!-- Brands Start -->
              <div class="border-bottom mb-4">
                <h5 class="font-weight-semi-bold text-[#183018] my-2">Brand</h5>
                <div class="overflow-y-auto custom-scroll">
                  <div class="form-check ml-2">
                    <input class="form-check-input" type="checkbox" name="brand" id="allbrand" value="allbrand" {{ $data['brand'] === null ||  $data['brand'] === 'allbrand' ? 'checked' : '' }}>
                    <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="allbrand">
                      Semua Brand
                    </label>
                  </div>

                  @foreach ($data['brands'] as $brand)
                    <div class="form-check ml-2">
                      <input class="form-check-input" type="checkbox" 
                      name="brand" 
                      id="{{ $brand->name}}-{{$brand->id}}" 
                      value="{{ $brand->name}}" 
                      {{ $data['brand'] == $brand->name ? 'checked' : '' }}>

                      <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="{{ $brand->name}}-{{$brand->id}}">
                        {{ $brand->name}}
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>
            <!-- Brands End -->
  
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
              <h5 class="font-weight-semi-bold text-[#183018] my-2">Kisaran Harga</h5>
              <div>
                <div class="price-range-container">
                  <div>
                    <label for="min-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Terendah: </label><br>
                    <input class="w-full" type="range" id="min-price" name="min_price" min="0" max="500000" step="10000" 
                      value="{{ $data['minPrice'] !== null ? $data['minPrice'] : 0 }}" 
                      oninput="updatePriceRange()"/>
                    <span id="min-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ $data['minPrice'] !== null ?  number_format($data['minPrice'], 0, ',', '.') : 0 }}</span>
                  </div>
  
                  <div>
                    <label for="max-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Tertinggi: </label><br>
                    <input class="w-full" type="range" id="max-price" name="max_price" min="100000" max="1000000" step="50000" value="{{ $data['minPrice'] !== null ? $data['maxPrice'] : 1000000 }}" oninput="updatePriceRange()"/>
                    <span id="max-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ $data['minPrice'] !== null ?  number_format($data['maxPrice'], 0, ',', '.') : '1.000.000' }}</span>
                  </div>
  
                </div>
              </div>
            </div>
            <!-- Price End -->
  
            <!-- Rating Start -->
            <div class="border-bottom mb-2 mb-md-3">
               <h5 class="font-weight-semi-bold text-[#183018] my-2">Rating {{ $data['rating'] }}</h5>
               <div class="mb-4">
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="allRating" value="all" {{ $data['rating'] === null ||  $data['rating'] === 'allbrand' ? 'checked' : '' }}>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="allRating">All Rating</label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating5" value="5"  {{ $data['rating'] == 5 ? 'checked' : '' }}>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating5">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating4" value="4" {{ $data['rating'] == 4 ? 'checked' : '' }}>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating4">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating3" value="3" {{ $data['rating'] == 3 ? 'checked' : '' }}>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating3">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating2" value="2" {{ $data['rating'] == 2 ? 'checked' : '' }}>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating2">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating1 " value="1" {{ $data['rating'] == 1 ? 'checked' : '' }}>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating1">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
              </div>
            </div>
 
 
            <!-- Rating End -->
  
            <div>
              <button class="btn text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-white border w-full rounded-sm mb-2" type="submit" id="useFilter" style="background-color: #183018">
                Gunakan Filter
              </button>
              <button class="btn btn-danger text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-white border w-full rounded-sm mb-2" type="submit" id="resetFilter">
                Reset Filter
              </button>
            </div>
         
        </div>
        <!-- Filter End -->
      </div>

      <!-- Shop Product Start -->
      <div class="col-lg-10 col-md-9 p-0 mb-4">
        <div class="position-sticky" style="top: 4rem">
          <div class="container-fluid">
              <div class="row">
                <div class="flex w-full align-items-center justify-content-between mb-2 mb-my-4">
                  <div class="flex justify-content-center align-items-center gap-3">
                      <h1 class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] text-[#183018]">"{{$data['keyword']}}"</h1>
                      <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Ditemukan {{ $data['count'] }} Produk</p>
                  </div>
                  <div class="dropdown flex ml-auto"> <!-- Menambahkan inline style -->
                      <input type="hidden" name="sort" id="sort" value="">

                      <button class="btn rounded-sm border text-black dropdown-toggle text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" 
                        type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $data['sort'] !== null ? $data['sort'] : 'Urut Berdasarkan' }}
                      </button>
                      
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" 
                            href="#" onclick="setSort('latest')">Terbaru</a>
                          <!-- <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" 
                            href="#" onclick="setSort('popular')">Terpopuler</a> -->
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" 
                            href="#" onclick="setSort('high_price')">Harga Tertinggi</a>
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" 
                            href="#" onclick="setSort('low_price')">Harga Terendah</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="row">
                <div id="skeletonLoader" class="skeleton-loader">
                  @for ($i = 0; $i < count($data['products']); $i++) <!-- Adjust the number based on how many you want to show -->
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
                  @if (session('id_user'))
                      @if (count($data['products']) !== 0)
                        <div class="grid-container-shop" style="min-height:48vh;">
                        @foreach ($data['products'] as $product)
                          <div onclick="window.location.href = '/{{ $product->product_code }}_product'" class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                            <div class="position-relative overflow-hidden bg-transparent p-0">
                                <img class="img-fluid w-100 rounded-sm pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                            </div>
                            <div class="grid gap-1 text-left p-1 p-md-2">
                                <div class="flex gap-1">
                                    <i class="text-decoration-none fas fa-star text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between" style="color:orange;"></i>
                                    <p class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">{{ $product->rating }}</p>
                                    @php
                                        $inWishlist = collect($data['wishlists'])->contains('product_id', $product->id);
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
                                        $inCart = collect($data['cartItems'])->contains('product_id', $product->id);
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
                    @if (count($data['products']) !== 0)
                      <div class="grid-container-shop">
                        @foreach ($data['products'] as $product)
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
                </div>
                <!-- End Card Items -->
              </div>

              <!-- Repeat this block for each card -->
              <!-- Pagination and Navigation -->
              <!-- <div class="col-12 pt-12">
                  <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center mb-3">
                          <li class="page-item disabled">
                              <a class="page-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" href="#" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Previous</span>
                              </a>
                          </li>
                          <li class="page-item active">
                              <a class="page-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" href="#">1</a>
                          </li>
                          <li class="page-item"><a class="page-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" href="#">2</a></li>
                          <li class="page-item"><a class="page-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" href="#">3</a></li>
                          <li class="page-item">
                              <a class="page-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Next</span>
                              </a>
                          </li>
                      </ul>
                  </nav>
              </div> -->

          </div>
        </div>
      </div>
      <!-- Shop Product End -->
    </div>
  </div>
  <!-- Shop End -->

  <!-- MODAL FILTER -->
  <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filter" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content overflow-y-auto fixed bottom-0 w-full" style="max-height:90vh; z-index: 1050;">
        <div class="modal-header" style="background-color: #183018">
          <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">Form Filter Produk</h1>
          <button type="button" class="btn-close" style="filter:invert(1)" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body overflow-y-auto" style="max-height:100vh;">
          <form action="{{ route('search.product') }}" method="GET" id="form-filter-product-mobile">
            <!-- Brands Start -->
            <div class="border-bottom">
              <h5 class="font-weight-semi-bold my-2">Brand</h5>
              <div class="max-h-[150px] overflow-y-auto custom-scroll">
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="brand" id="allbrand" value="allbrand" {{ $data['brand'] === null ||  $data['brand'] === 'allbrand' ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="allbrand">
                    Semua Brand
                  </label>
                </div>
  
                @foreach ($data['brands'] as $brand)
                  <div class="form-check ml-2">
                    <input class="form-check-input" type="checkbox" 
                      name="brand" 
                      id="{{ $brand->name}}-{{$brand->id}}" 
                      value="{{ $brand->name}}" 
                      {{ $data['brand'] == $brand->name ? 'checked' : '' }}>
  
                    <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="{{ $brand->name}}-{{$brand->id}}">
                      {{ $brand->name}}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- Brands End -->
  
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
              <h5 class="font-weight-semi-bold text-[#183018] my-2">Kisaran Harga</h5>
              <div class="price-range-container">
                <div>
                  <label for="min-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Terendah: </label><br>
                  <input class="w-full" type="range" id="min-price-mobile" name="min_price" min="0" max="500000" step="10000" 
                    value="{{ $data['minPrice'] !== null ? $data['minPrice'] : 0 }}" 
                    oninput="updatePriceRangeMobile()"/>
                  <span id="min-price-value-mobile" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ $data['minPrice'] !== null ?  number_format($data['minPrice'], 0, ',', '.') : 0 }}</span>
                </div>

                <div>
                  <label for="max-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Tertinggi: </label><br>
                  <input class="w-full" type="range" id="max-price-mobile" name="max_price" min="100000" max="1000000" step="50000" value="{{ $data['minPrice'] !== null ? $data['maxPrice'] : 1000000 }}" 
                  oninput="updatePriceRangeMobile()"/>
                  <span id="max-price-value-mobile" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ $data['minPrice'] !== null ?  number_format($data['maxPrice'], 0, ',', '.') : '1.000.000' }}</span>
                </div>

              </div>
            </div>
            <!-- Price End -->
  
            <!-- Rating Start -->
            <div class="border-bottom mb-2 mb-md-3">
              <h5 class="font-weight-semi-bold text-[#183018] my-2">Rating</h5>
              <div class="mb-4">
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="rating" id="allRatingMobile" value="all" {{ $data['rating'] === null ||  $data['rating'] === 'all' ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="allRating">All Rating</label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="rating" id="mobilerating5" value="5" {{ $data['rating'] == 5 ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating5">
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                  </label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="rating" id="mobilerating4" value="4" {{ $data['rating'] == 4 ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating4">
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                  </label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="rating" id="mobilerating3" value="3" {{ $data['rating'] == 3 ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating3">
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                  </label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="rating" id="mobilerating2" value="2" {{ $data['rating'] == 2 ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating2">
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                  </label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="rating" id="mobilwrating1 " value="1" {{ $data['rating'] == 1 ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating1">
                    <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="color:orange;"></small>
                  </label>
                </div>
              </div>
            </div>
            <!-- Rating End -->
  
            <div>
              <button class="btn text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-white border w-full rounded-sm mb-2" type="submit" id="useFilterMobile" style="background-color: #183018">
                Gunakan Filter
              </button>
              <button class="btn btn-danger text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-white border w-full rounded-sm mb-2" type="submit" id="resetFilterMobile">
                Reset Filter
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@if (count($data['products']) !== 0)
<div class="d-flex d-block d-md-none mx-auto justify-content-center rounded-sm w-fit py-2 fixed-bottom mb-12" style="background-color:#183018;">
  <div class="col d-flex justify-content-center gap-1">
    <i class="fas fa-regular fa-filter" style="color: #ffffff;"></i>
    <a class="text-white text-[12px] md:text-[10px] lg:text-[11px] xl:text-[12px]" data-bs-toggle="modal" data-bs-target="#filter">Filter</a>
  </div>
</div>
@endif


<!-- END MODAL FILTER -->

<script>
  document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      if (this.checked) {
        // Deselect other checkboxes with the same name
        document.querySelectorAll('input[name="' + this.name + '"]').forEach(function (otherCheckbox) {
          if (otherCheckbox !== checkbox) {
            otherCheckbox.checked = false;
          }
        });
      }
    });
  });
</script>

<script>
    function setSort(sortValue) {
        document.getElementById('sort').value = sortValue;
        document.getElementById('form-filter-product').submit();
    }
</script>

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


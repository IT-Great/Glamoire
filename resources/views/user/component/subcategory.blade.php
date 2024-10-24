
@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 pt-2 py-2 mb-4">
  <div class="container-fluid">
    <div class="shadow-sm border border-black rounded-md py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-2 pl-2">
        <a href="/" class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="/belanja-{{$category}}" class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ ucwords(strtolower($category)) }}</a>
        <p class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="/belanja-{{$category}}-{{$subcategory}}" class="text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">{{ $subcategory }}</a>
      </div>
    </div>
  </div>

  <!-- Shop Start -->
  <div class="container-fluid">
    <div class="row">
      <!-- Shop Sidebar Start -->
      <div class="col-lg-2 col-md-3 d-none d-md-block">
        <!-- Filter Start -->
        <div class="border border-black shadow-md rounded-md md:mb-0 lg:mb-0 xl:mb-0 py-1 px-3">
          <h5 class="font-weight-semi-bold text-[#183018] my-2">Filter</h5>
          <form action="{{ route('shop.category.sub', ['category' => $category, 'subcategory' => $subcategory]) }}" method="GET" id="form-filter-subcategory">
            <!-- Categories Start -->
            <div class="border-bottom pb-2">
              <h5 class="font-weight-semi-bold text-[#183018] mb-2">{{ ucwords(strtolower($category)) }}</h5>
                @foreach ($subCategories as $subCategory)
                  <a href="{{ route('shop.category.sub', ['category' => $category, 'subcategory' => $subCategory->name]) }}" class="pb-1 text-[7px] md:text-[9px] lg:text-[11px] xl:text-[13px] d-flex align-items-center justify-content-between">
                    {{ $subCategory->name }}
                    <i class="fas fa-chevron-right hover:cursor-pointer"></i>
                  </a>
                @endforeach
            </div>
            <!-- Categories End -->

            <!-- Brands Start -->
             <div class="border-bottom mb-4">
               <h5 class="font-weight-semi-bold text-[#183018] my-4">Brand</h5>
               <div class="max-h-[150px] overflow-y-auto custom-scroll">
 
               <div class="form-check ml-2">
                  <input class="form-check-input" type="checkbox" name="brand" id="allbrand" value="allbrand" {{ $brandName === null ||  $brandName === 'allbrand' ? 'checked' : '' }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="allbrand">
                    Semua Brand
                  </label>
                </div>

                @foreach ($brands as $brand)
                  <div class="form-check ml-2">
                    <input class="form-check-input" type="checkbox" 
                    name="brand" 
                    id="{{ $brand->name}}-{{$brand->id}}" 
                    value="{{ $brand->name}}" 
                    {{ $brandName == $brand->name ? 'checked' : '' }}>

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
              <h5 class="font-weight-semi-bold text-[#183018] my-4">Kisaran Harga</h5>
              <div>
                <div class="price-range-container">
                  <div>
                    <label for="min-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Terendah: </label><br>
                    <input class="w-full" type="range" id="min-price" name="min_price" min="0" max="500000" step="10000" 
                      value="{{ $minPrice !== null ? $minPrice : 0 }}" 
                      oninput="updatePriceRange()"/>
                    <span id="min-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ $minPrice !== null ?  number_format($minPrice, 0, ',', '.') : 0 }}</span>
                  </div>
  
                  <div>
                    <label for="max-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Tertinggi: </label><br>
                    <input class="w-full" type="range" id="max-price" name="max_price" min="100000" max="1000000" step="50000" value="{{ $minPrice !== null ? $maxPrice : 1000000 }}" oninput="updatePriceRange()"/>
                    <span id="max-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp{{ $minPrice !== null ?  number_format($maxPrice, 0, ',', '.') : '1.000.000' }}</span>
                  </div>
  
                </div>
              </div>
            </div>
            <!-- Price End -->
  
            <!-- Rating Start -->
            <div class="border-bottom mb-2 mb-md-3">
               <h5 class="font-weight-semi-bold text-[#183018] my-2">Rating</h5>
               <div class="mb-4">
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="allRating" value="all" checked>
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="allRating">All Rating</label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating5" value="5">
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating5">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating4" value="4">
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating4">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating3" value="3">
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating3">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating2" value="2">
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating2">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
                 <div class="form-check ml-2">
                   <input class="form-check-input" type="checkbox" name="rating" id="rating1" value="1">
                   <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" for="rating1">
                     <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[12px]" style="color:orange;"></small>
                   </label>
                 </div>
              </div>
            </div>
            <!-- Rating End -->
  
            <div>
              <button class="btn text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-white border w-full rounded-md mb-2" type="submit" id="useFilter"  style="background-color: #183018">
                Gunakan Filter
              </button>
            </div>
        </div>
        <!-- Filter End -->
      </div>

      <!-- Shop Product Start -->
      <div class="col-lg-10 col-md-9 p-0">
        <div class="position-sticky" style="top: 4rem">
          <div class="container-fluid">
              <div class="row">
                <div class="flex w-full align-items-center justify-content-between mb-2 mb-my-4">
                  <div class="flex justify-content-center align-items-center">
                    <h1 class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-[#183018] ml-2 ml-md-0">{{ ucwords(strtolower($subcategory)) }} "{{ $totalProduct }} Produk"</h1>
                  </div>

                  <div class="dropdown flex ml-auto">
                    <input type="hidden" name="sort" id="sort" value="">

                    <button class="btn rounded-md border dropdown-toggle text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" 
                      type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ $sort !== null ? $sort : 'Urut Berdasarkan' }}
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
                <!-- Card Items -->
                @if (session('id_user'))
                  @if (count($products) !== 0)
                    <div class="grid-container-shop" style="min-height:48vh;">
                      @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                            <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                <div class="position-relative overflow-hidden bg-transparent p-0">
                                    <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name}}">
                                </div>
                                <div class="grid gap-1 text-left p-2">
                                    <div class="flex">
                                        <div class="flex gap-1">
                                            <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                            <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">{{ number_format($product->rating_and_reviews_avg_rating, 1) }}</p>
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
                                            {{ Str::limit($product->product_name, 20) }}
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
                      @endforeach  
                    </div>
                  @else
                    <div style="min-height:48vh;">
                      <div style="display:flex; align-items:center; justify-content:center;">
                        <img src="images/product-empty.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                      </div>
                      <div style="display:flex; align-items:center; justify-content:center;">
                        <p class="text-danger text-md">Maaf tidak ada produk di subkategori ini</p>
                      </div>
                    </div>
                  @endif

                <!-- MUNCULKAN DATA PRODUK JIKA USER BELUM LOGIN -->
                @else
                  @if (count($products) !== 0)
                    <div class="grid-container-shop" style="min-height:48vh;">
                      @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                            <img class="card-img-top" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                            <div class="grid text-left content-card px-3 py-2 flex-grow-1">
                                <div class="flex rating-wishlist">
                                    <div class="flex gap-1">
                                        <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                        <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">{{ number_format($product->rating_and_reviews_avg_rating, 1) }}</p>
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
                                            {{ Str::limit($product->product_name, 20) }}
                                        </a>
                                    </p>
                                    <div class="flex justify-content-start gap-1">
                                        <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                        </p>
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
                      @endforeach
                    </div>
                  @else
                  <div style="min-height:48vh;">
                    <div style="display:flex; align-items:center; justify-content:center;">
                      <img src="images/product-empty.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                    </div>
                    <div style="display:flex; align-items:center; justify-content:center;">
                      <p class="text-danger text-md">Maaf tidak ada produk di subkategori ini</p>
                    </div>
                  </div>
                  @endif
                @endif
                <!-- End Card Items -->
              </div>

              <!-- Repeat this block for each card -->
              <!-- Pagination and Navigation -->
              <!-- <div class="col-12 pt-12">
                  <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center mb-3">
                          <li class="page-item disabled">
                              <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Previous</span>
                              </a>
                          </li>
                          <li class="page-item active">
                              <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#">1</a>
                          </li>
                          <li class="page-item"><a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#">2</a></li>
                          <li class="page-item"><a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#">3</a></li>
                          <li class="page-item">
                              <a class="page-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Next</span>
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
</div>

@if (count($products) !== 0)
  <div class="d-flex d-block d-md-none mx-auto justify-content-center rounded-md w-fit py-2 fixed-bottom mb-12" style="background-color:#183018;">
  <div class="col d-flex justify-content-center gap-1">
    <i class="fas fa-regular fa-filter" style="color: #ffffff;"></i>
    <a class="text-white text-[12px] md:text-[10px] lg:text-[11px] xl:text-[12px]" data-bs-toggle="modal" data-bs-target="#filter">Filter</a>
  </div>
</div>
@endif

<!-- MODAL FILTER -->
<div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filter" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content overflow-y-auto custom-scroll" style="max-height:90vh;">
      <div class="modal-header" style="background-color: #183018">
        <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px]" id="exampleModalLabel">Form Filter Produk</h1>
        <button type="button" class="btn-close" style="color:#FFFFFF;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body overflow-y-auto custom-scroll" style="max-height:100vh;">
        <form action="" id="form-filter-mobile">
           <!-- Brands Start -->
           <div class="border-bottom">
             <h5 class="font-weight-semi-bold text-[#183018] my-2">Brand</h5>
             <div class="max-h-[150px] overflow-y-auto custom-scroll">

                @for ($j=1;$j <= 8; $j++)
                  <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-1">
                    <input type="checkbox" class="custom-control-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="brand-all-mobile-{{$j}}"/>
                    <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="brand-all">Brand {{ $j }}</label>
                  </div>
                @endfor
               
             </div>
           </div>
           <!-- Brands End -->
 
           <!-- Categories Start -->
           <div class="border-bottom">
             <h5 class="font-weight-semi-bold text-[#183018] my-2">Categories</h5>
             <div class="max-h-[150px] overflow-y-auto custom-scroll pb-2">
              
                @for ($k=1;$k <= 8; $k++)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                  <input type="checkbox" class="custom-control-input" id="categories-{{$k}}"/>
                  <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="makeup">Kategori {{ $k }}</label>
                </div>
                @endfor
             
            </div>
           </div>
           <!-- Categories End -->
 
           <!-- Price Start -->
           <div class="border-bottom">
             <h5 class="font-weight-semi-bold text-[#183018] my-2">Filter by price</h5>
             <div>
               <div class="price-range-container">
                 <div class="grid gap-1">
                   <label for="min-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Terendah: </label>
                   <input class="w-full" type="range" id="min-price-mobile" name="min-price" min="0" max="500000" step="10000" value="0" oninput="updatePriceRange()"/>
                   <span id="min-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp0</span>
                 </div>
 
                 <div class="grid gap-1">
                   <label for="max-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Tertinggi: </label>
                   <input class="w-full" type="range" id="max-price-mobile" name="max-price" min="500000" max="1000000" step="10000" value="1000000" oninput="updatePriceRange()"/>
                   <span id="max-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp1,000,000</span>
                 </div>
 
               </div>
             </div>
           </div>
           <!-- Price End -->
 
           <!-- Rating Start -->
           <div class="border-bottom mb-2">
             <h5 class="font-weight-semi-bold text-[#183018] my-2">Ratings</h5>
             <div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" checked id="all-rating-mobile"/>
                 <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="rating-all">All Rating</label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-5" value="5"/>
                 <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="5">
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small>5</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-4" value="4"/>
                 <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="4">
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small>4</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-3" value="3"/>
                 <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="3">
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small>3</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-2" value="2"/>
                 <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="2">
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small>2</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-1" value="1"/>
                 <label class="custom-control-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="2">
                   <small class="fas fa-star text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="color:orange;"></small>
                   <small>1</small>
                 </label>
               </div>
             </div>
           </div>
           <!-- Rating End -->
 
           <div>
              <button class="btn text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-white border w-full rounded-md mb-2" type="submit" id="useFilterMobile"  style="background-color: #183018">
                Gunakan Filter
              </button>
              <button class="btn text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-white border w-full rounded-md mb-2" type="submit" id="resetFilterMobile"  style="background-color: #183018">
                Reset Filter
              </button>
           </div>
        </form>
      </div>
    </div>
  </div>
</div>
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

  function toggleListSubCategory(event, listSubCategoryId, link) {
    event.preventDefault(); // Prevent default anchor behavior
    const listSubCategory = document.querySelector(listSubCategoryId);
    const isVisible = listSubCategory.style.display === 'block';
    
    // Toggle visibility of the subcategory list
    if (isVisible) {
      listSubCategory.style.display = 'none';
    } else {
      listSubCategory.style.display = 'block';
    }

    // Toggle chevron icons
    const chevronDown = link.querySelector('.fa-chevron-down');
    const chevronUp = link.querySelector('.fa-chevron-up');
    
    if (isVisible) {
      chevronDown.hidden = false;
      chevronUp.hidden = true;
    } else {
      chevronDown.hidden = true;
      chevronUp.hidden = false;
    }
  }
</script>

<script>
    function setSort(sortValue) {
        document.getElementById('sort').value = sortValue;
        document.getElementById('form-filter-subcategory').submit();
    }
</script>

@endsection


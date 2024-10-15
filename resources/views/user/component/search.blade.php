
@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 py-2">
  <div class="container-fluid">
    <div class="shadow-sm border border-black rounded-md py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-2 pl-2">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-decoration-none text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Hasi Pencarian "{{ $data['keyword'] }}"</a>
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
          <form action="{{ route('search.product') }}" method="GET" id="form-filter-product">
            <input type="hidden" name="product_search" value="{{ request('product_search', '') }}">
            <!-- Brands Start -->
             <div class="border-bottom mb-4">
               <h5 class="font-weight-semi-bold text-[#183018] my-4">Brand</h5>
               <div class="max-h-[150px] overflow-y-auto custom-scroll">


                @for ($a = 1; $a <= 19; $a++)
                  <div class="form-check ml-2">
                      <input class="form-check-input" type="checkbox" name="brand[]" id="namebrand-{{$a}}" value="brand-{{$a}}">
                      <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="namebrand-{{$a}}">
                          Brand {{ $a }}
                      </label>
                  </div>
                @endfor

                 
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
                    <input class="w-full" type="range" id="min-price" name="min-price" min="0" max="500000" step="10000" value="0" oninput="updatePriceRange()"/>
                    <span id="min-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp0</span>
                  </div>
  
                  <div>
                    <label for="max-price" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Harga Tertinggi: </label><br>
                    <input class="w-full" type="range" id="max-price" name="max-price" min="500000" max="1000000" step="10000" value="1000000" oninput="updatePriceRange()"/>
                    <span id="max-price-value" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Rp1,000,000</span>
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
                   <input class="form-check-input" type="checkbox" name="rating" id="allRating" value="all">
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
                   <input class="form-check-input" type="checkbox" name="rating" id="rating1 " value="1">
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
          </form>
        </div>
        <!-- Filter End -->
      </div>

      <!-- Shop Product Start -->
      <div class="col-md-10 p-0">
        <div class="position-sticky" style="top: 2rem">
          <div class="container-fluid">
              <div class="row">
                <div class="d-flex w-full align-items-center justify-content-between p-0 m-0 mb-2 mb-my-4">
                  <div class="flex justify-content-center align-items-center gap-3">
                      <h1 class="text-lg text-[#183018]">"{{$data['keyword']}}"</h1>
                      <p class="text-sm">Ditemukan {{ $data['count'] }} Produk</p>
                  </div>
                  <div class="dropdown ml-auto"> <!-- Menambahkan inline style -->
                      <button class="btn rounded-md border dropdown-toggle text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Urut Berdasarkan 
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" href="#">Terbaru</a>
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" href="#">Terpopuler</a>
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" href="#">Harga Tertinggi</a>
                          <a class="dropdown-item text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover:bg-[#183018] hover:text-white" href="#">Harga Terendah</a>
                      </div>
                  </div>
              </div>
              </div>

              <div class="row">
                <!-- Card Items -->
                 <div class="grid-container-shop">
                  @if (session('id_user'))
                    @if (count($data['products']) !== 0)
                      @foreach ($data['products'] as $product)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl" style="min-height:325px; max-height:325px;">
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
                                            $inWishlist = collect($data['wishlists'])->contains('product_id', $product->id);
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
                                          <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                              Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                          </p>
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
                                    $inCart = collect($data['cartItems'])->contains('product_id', $product->id);
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
                      @endforeach
                    @else
                      <p class="text-danger">PRODUK YANG ANDA CARI TIDAK ADA</p>
                    @endif
                  @else
                    @if (count($data['products']) !== 0)
                      @foreach ($data['[products]'] as $product)
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
                    @else
                      <p class="text-danger">PRODUK YANG ANDA CARI TIDAK ADA</p>
                    @endif
                  @endif
                 </div>
                <!-- End Card Items -->
              </div>

              <!-- Repeat this block for each card -->
              <!-- Pagination and Navigation -->
              <div class="col-12 pt-12">
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
              </div>
          </div>
        </div>
      </div>
      <!-- Shop Product End -->
    </div>
  </div>
  <!-- Shop End -->
</div>

<div class="d-flex d-block d-md-none mx-auto justify-content-center rounded-md w-fit py-2 fixed-bottom mb-12" style="background-color:#183018;">
  <div class="col d-flex justify-content-center gap-1">
    <i class="fas fa-regular fa-filter" style="color: #ffffff;"></i>
    <a class="text-white text-[12px] md:text-[10px] lg:text-[11px] xl:text-[12px]" data-bs-toggle="modal" data-bs-target="#filter">Filter</a>
  </div>
</div>

<!-- MODAL FILTER -->
<div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filter" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content overflow-y-auto" style="max-height:90vh;">
      <div class="modal-header" style="background-color: #183018">
        <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">Form Filter Produk</h1>
        <button type="button" class="btn-close" style="color:#FFFFFF;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body overflow-y-auto" style="max-height:100vh;">
        <form action="" id="form-filter-mobile">
           <!-- Brands Start -->
           <div class="border-bottom">
             <h5 class="font-weight-semi-bold my-2">Brand</h5>
             <div class="max-h-[150px] overflow-y-auto">

                @for ($j=1;$j <= 8; $j++)
                  <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-1">
                    <input type="checkbox" class="custom-control-input text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="brand-all-mobile-{{$j}}"/>
                    <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="brand-all">Brand {{ $j }}</label>
                  </div>
                @endfor
               
             </div>
           </div>
           <!-- Brands End -->
 
           <!-- Categories Start -->
           <div class="border-bottom">
             <h5 class="font-weight-semi-bold my-2">Categories</h5>
             <div class="max-h-[150px] overflow-y-auto pb-2">
              
                @for ($k=1;$k <= 8; $k++)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                  <input type="checkbox" class="custom-control-input" id="categories-{{$k}}"/>
                  <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="makeup">Kategori {{ $k }}</label>
                </div>
                @endfor
             
            </div>
           </div>
           <!-- Categories End -->
 
           <!-- Price Start -->
           <div class="border-bottom">
             <h5 class="font-weight-semi-bold my-2">Filter by price</h5>
             <div>
               <div class="price-range-container">
                 <div class="grid gap-1">
                   <label for="min-price" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Harga Terendah: </label>
                   <input class="w-full" type="range" id="min-price-mobile" name="min-price" min="0" max="500000" step="10000" value="0" oninput="updatePriceRange()"/>
                   <span id="min-price-value" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Rp0</span>
                 </div>
 
                 <div class="grid gap-1">
                   <label for="max-price" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Harga Tertinggi: </label>
                   <input class="w-full" type="range" id="max-price-mobile" name="max-price" min="500000" max="1000000" step="10000" value="1000000" oninput="updatePriceRange()"/>
                   <span id="max-price-value" class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Rp1,000,000</span>
                 </div>
 
               </div>
             </div>
           </div>
           <!-- Price End -->
 
           <!-- Rating Start -->
           <div class="border-bottom mb-2">
             <h5 class="font-weight-semi-bold my-2">Ratings</h5>
             <div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" checked id="all-rating-mobile"/>
                 <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="rating-all">All Rating</label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-5" value="5"/>
                 <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="5">
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small>5</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-4" value="4"/>
                 <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="4">
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small>4</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-3" value="3"/>
                 <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="3">
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small>3</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-2" value="2"/>
                 <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="2">
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small>2</small>
                 </label>
               </div>
               <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                 <input type="checkbox" class="custom-control-input" id="mobile-rating-1" value="1"/>
                 <label class="custom-control-label text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" for="2">
                   <small class="fas fa-star text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="color:orange;"></small>
                   <small>1</small>
                 </label>
               </div>
             </div>
           </div>
           <!-- Rating End -->
 
           <div>
              <button class="btn text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-white border w-full rounded-md mb-2" type="submit" id="useFilterMobile"  style="background-color: #183018">
                Gunakan Filter
              </button>
              <button class="btn text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-white border w-full rounded-md mb-2" type="submit" id="resetFilterMobile"  style="background-color: #183018">
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
</script>

@endsection


<div class="py-2 md:px-20 lg:px-24 xl:px-24 2xl:px-96 position-sticky" style="top:-0.1rem;background-color: #183018;z-index: 9;">
  <div class="container-fluid">
    <div class="d-flex w-full align-items-center">
      <!-- IMAGE -->
      <div class="col-lg-1 col-md-2 col-4 p-0 m-0">
        <a href="/">
          <img src="images/l-1.png" class="img-fluid" alt="eCommerce HTML Template">
        </a>
      </div>
      <!--  -->
      
      <div class="col-lg-4 d-none d-lg-block">
        <div class="list-inline-item dropdown">
          <a class="p-1 text-white text-decoration-none text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Belanja</a>
          <ul class="dropdown-menu bg-transparent border-none">
            <div class="flex container mt-3 custom-shadow p-0 bg-white" style="min-height: 60vh; min-width: 77vw;">
              
              <div class="col-2 w-fit px-0 min-h-[77vh] overflow-y-auto custom-scroll max-h-[75vh]">
                <nav class="tabbable border-none">
                  <div class="nav grid nav-tabs border-none mb-2 mb-md-4 w-full" id="nav-tab" role="tablist">
                    @foreach ($categories as $index => $category)
                    <a class="text-decoration-none nav-item flex py-3 gap-1 align-items-center {{ $index == 0 ? 'active' : '' }} categories text-md px-3 text-[#183018] active:font-bold" data-toggle="tab" href="#kategori{{ $category->id }}">
                        <img src="{{ asset('storage/' . $category->image) }}" class="w-5 h-5 rounded-circle" alt="{{ $category->name }}">
                        {{ strtoupper($category->name) }}
                    </a>
                    @endforeach
                  </div>
                </nav>
              </div>
        
              <div class="col-10 px-0 w-full">
                <div class="tab-content p-0">
                  @for ($j=1; $j <= 13; $j++)
                    @if ($j == 1)
                    <div class="tab-pane fade show active categories overflow-hidden min-h-[77vh] py-1 w-full" id="kategori{{ $j }}">
                    @else
                    <div class="tab-pane fade overflow-hidden min-h-[77vh] py-1 w-full" id="kategori{{ $j }}">
                    @endif
                      <div class="container-fluid grid p-3 gap-3 max-h-[75vh] overflow-y-auto">
                        <a class="gap-2 text-lg flex w-fit text-[#183018]" href="{{ route('shop.category', ['category' => 'category' . $j]) }}">
                          <img src="images/produk1.png" class="w-5 h-5 rounded-circle" alt="">
                          KATEGORI {{ $j }}
                        </a>  
                        <div class="flex">
                          <div class="grid-container-category">
                            @for ($k=1; $k <= 7; $k++)
                            <div class="grid gap-1">
                              <a href="/shop" class="text-md text-[#183018] font-semibold poppins-regular">Sub Kategori {{ $k }} </a>
                              <a href="/shop" class="text-xs text-[#183018] poppins-regular">List Sub-kategori {{ $k }}</a>
                              <a href="/shop" class="text-xs text-[#183018] poppins-regular">List Sub-Kategori {{ $k }}</a>
                              <a href="/shop" class="text-xs text-[#183018] poppins-regular">List Sub-Kategori {{ $k }}</a>
                            </div>
                            @endfor
                          </div>
                        </div>
                      </div>
                    </div>
                  @endfor
                </div>
              </div>
            </div>
          </ul>
        </div>

       

        <div class="list-inline-item dropdown">
          <a class="p-1 text-white text-decoration-none text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Brand</a>
          <ul class="dropdown-menu bg-transparent border-none">
            <!-- <div class="container mt-3 p-0 bg-[#183018] shadow-sm rounded">
              <li><a class="text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700" href="/brand">Skintific</a></li>
              <li><a class="text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700" href="/brand">Wardah</a></li>
              <li><a class="text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700" href="/brand">Dove</a></li>
              <li><a class="text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700" href="/brand">Nivea</a></li>
            </div> -->
            <div class="flex container mt-3 p-0 bg-white custom-shadow rounded-md overflow-y-auto custom-scroll border-white border-8" style="min-height: 50vh;max-height:50vh; min-width: 40vw;">
              <div class="grid-container-brands h-fit p-3">
                @foreach ($brands as $brand)
                  <a href="/{{ $brand->name }}_brand" class="py-2 rounded-sm border border-primary  hover:border-white hover:bg-[#183018] hover:text-white text-decoration-none text-center">
                    {{ $brand->name }}
                  </a>
                @endforeach
              </div>
            </div>
          </ul>
        </div>
        
        <div class="list-inline-item dropdown">
          <a class="p-1 text-white text-decoration-none text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" href="/promotion" >Promo</a>
        </div>

        <div class="list-inline-item dropdown">
          <a class="p-1 text-white text-decoration-none text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" href="/newsletter" >Artikel</a>
        </div>
      </div>
      
      <!-- SEARCH -->
      <div class="col-lg-6 col-md-9 d-none d-md-block">
        <form method="GET" action="{{route('search.product')}}" id="search-product-form">
          <div class="input-group">
            <input class="form-control rounded-start text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]" 
              type="text" 
              id="search-product" 
              name="product_search" 
              placeholder="Cari Produk">

              <span class="input-group-append">
                <button class="btn bg-white border border-start-0 rounded-end" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
              </span>
          </div>
        </form>
      </div>
      <!--  -->

      <!-- ICON -->
      <div class="col-lg-1 col-md-1 text-end col-8 p-0 m-0 d-flex justify-content-end align-items-end gap-2">
        
        <div class="list-inline-item p-1 hover:bg-neutral-700">
          <a href="cart" class="text-white position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 576 512">
                  <path fill="#FFFFFF" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
              </svg>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                  <p class="text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]" id="total_cart_items">0</p>
              </span>
          </a>
      </div>

        <div class="list-inline-item dropdown d-none d-lg-block p-1 hover:bg-neutral-700">
          <a class="text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]" href="#" role="button" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
          </a>
          <ul class="dropdown-menu mt-2 akun bg-transparent border-none">
            <div class="mt-2 py-2 bg-[#183018] shadow-sm rounded">
              @if (session('id_user'))
              <li class="text-end w-full hover:cursor-pointer">
                <a class="text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700" href="{{ route('account', ['user' => session('id_user')]) }}">
                  Profil Saya
                </a>
              </li>
              <li class="text-end w-full hover:cursor-pointer">
                <a id="logout-link" class="hover:cursor-pointer text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700">
                Keluar
                </a>  
              </li>
              @else
              <li><a class="text-white dropdown-item hover:cursor-pointer text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" data-bs-toggle="modal" data-bs-target="#login">Masuk</a></li>
              <li><a class="text-white dropdown-item hover:cursor-pointer text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" data-bs-toggle="modal" data-bs-target="#register">Daftar</a></li>
              @endif
            </div>
          </ul>
        </div>

      </div>
      <!--  -->
    </div>
  </div>
</div>



<div class="py-2 md:px-20 lg:px-24 xl:px-24 2xl:px-48 position-sticky" style="top:-0.1rem;background-color: #183018;z-index: 9;">
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
          <a class="p-1 text-white text-decoration-none text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" onclick="window.location.href='/shop'" role="button" data-bs-toggle="dropdown" aria-expanded="false">Belanja</a>
          <ul class="dropdown-menu bg-transparent border-none">
            <div class="flex container mt-2 custom-shadow p-0 bg-white" style="min-height: 60vh; min-width: 77vw;">
              
              <div class="col-2 w-fit px-0 min-h-[77vh] overflow-y-auto custom-scroll max-h-[75vh]">
                <nav class="tabbable border-none">
                  <div class="nav grid nav-tabs border-none mb-2 mb-md-4 w-full" id="nav-tab" role="tablist">
                    @foreach ($categories as $index => $category)
                      <a class="text-decoration-none nav-item flex py-3 gap-1 align-items-center {{ $index == 0 ? 'active' : '' }} categories text-md px-3 text-[#183018] active:font-bold"
                        id="tab-{{ $category->id }}" role="tab" data-bs-toggle="tab" href="#kategori-{{ $category->id }}" aria-controls="kategori-{{ $category->id }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                        {{ strtoupper($category->name) }}
                      </a>
                    @endforeach
                  </div>
                </nav>
              </div>
        
              <div class="col-10 px-0 w-full">
                <div class="tab-content p-0">
                  @foreach ($categories as $index => $category)
                    <!-- Each tab content should have role="tabpanel", aria-labelledby, and a unique id -->
                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }} categories overflow-hidden min-h-[77vh] py-1 w-full"
                        id="kategori-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                      <div class="container-fluid grid p-3 gap-3 max-h-[75vh] overflow-y-auto">
                        <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="text-md text-[#183018] font-semibold poppins-regular">  
                          <h3 class="text-lg text-[#183018]">{{ strtoupper($category->name) }}</h3>
                        </a>
                        @php
                          $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                        @endphp

                        @if ($subCategoriesInCategory->isEmpty())
                          <p class="text-md text-[#183018]">Tidak ada subkategori dalam kategori ini.</p>
                        @else
                          <div class="grid-container-category">
                            @foreach ($subCategoriesInCategory as $subCategory)
                              <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="text-sm text-[#183018] poppins-regular">
                                {{ $subCategory->name }}
                              </a>
                            @endforeach
                          </div>
                        @endif
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </ul>
        </div>

        <div class="list-inline-item dropdown">
          <a class="p-1 text-white text-decoration-none text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Brand</a>
          <ul class="dropdown-menu bg-transparent border-none">
            <div class="flex container mt-2 p-0 bg-white custom-shadow rounded-md overflow-y-auto custom-scroll border-white border-8" style="min-height: fit;max-height:fit; min-width: 30vw;">
              <div class="grid-container-brands h-fit p-3">
                @foreach ($brands as $brand)
                  <a href="/{{ $brand->name }}_brand" class="py-2 px-2 text-sm rounded-sm border border-primary hover:border-dark hover:bg-[#183018] hover:text-white text-decoration-none text-center">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
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
              <li><a class="text-white dropdown-item hover:cursor-pointer text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" data-bs-toggle="modal" data-bs-target="#loginUser1">Masuk</a></li>
              <li><a class="text-white dropdown-item hover:cursor-pointer text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" data-bs-toggle="modal" data-bs-target="#registerUser1">Daftar</a></li>
              @endif
            </div>
          </ul>
        </div>

      </div>
      <!--  -->
    </div>
  </div>

  <div class="container-fluid mt-2 mt-md-0 d-md-none">
    <form method="GET" action="{{route('search.product')}}" id="search-product-form-mobile">
      <div class="input-group">
        <input class="form-control rounded-start text-[12px] md:text-[10px] lg:text-[11px] xl:text-[12px]" 
          type="text" 
          id="search-product-mobile" 
          name="product_search" 
          placeholder="Cari Produk"
          autocomplete="off">

          <span class="input-group-append">
            <button class="btn bg-white border border-start-0 rounded-end" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
          </span>
      </div>
    </form>
  </div>
</div>

@if (!Request::is('cart') && !Request::is('checkout') && !Request::is('buy-now') && !Request::is('detail.product') && !Request::is('detail.product.varian'))  
  <!-- Bottom Navbar for Mobile (Shop, Brand, Newsletter, Promotion) -->
  <div class="d-lg-none fixed-bottom mt-8">
      <div id="categories" class="container d-none w-full h-[83vh] bg-white px-0" style="z-index: 9999 !important;">
        <div class="col-12 px-0 py-2 border-bottom border-secondary">
          <p class="text-[12px] mx-3 text-[#183018] font-semibold">Belanja Berdasarkan Kategori</p>
        </div>
        <div class="flex">
          <div class="col-4 px-0 min-h-[77vh] overflow-y-auto custom-scroll max-h-[75vh] border-right border-secondary">
            <nav class="tabbable border-none">
              <div class="nav grid nav-tabs mb-2 mb-md-4 w-full" id="nav-tab" role="tablist">
                @foreach ($categories as $index => $category)
                  <a class="text-decoration-none border border-secondary nav-item flex py-3 gap-1 align-items-center {{ $index == 0 ? 'active' : '' }} categories text-xs px-3 text-[#183018] active:font-bold"
                    id="tab-mobile-{{ $category->id }}" role="tab" data-bs-toggle="tab" href="#kategori-{{ $category->id }}-mobile" aria-controls="kategori-{{ $category->id }}-mobile" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                    {{ strtoupper($category->name) }}
                  </a>
                @endforeach
              </div>
            </nav>
          </div>
          
          <div class="col-8 px-0 w-full overflow-y-auto custom-scroll ">
            <div class="tab-content p-0">
              @foreach ($categories as $index => $category)
                <!-- Each tab content should have role="tabpanel", aria-labelledby, and a unique id -->
                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }} categories overflow-hidden min-h-[77vh] py-1 w-full"
                    id="kategori-{{ $category->id }}-mobile" role="tabpanel" aria-labelledby="tab-mobile-{{ $category->id }}">
                  <div class="container-fluid grid p-3 gap-3 max-h-[75vh] overflow-y-auto">
                    <a href="{{ route('shop.category', ['category' => $category->name]) }}" class="text-md text-[#183018] font-semibold poppins-regular">  
                      <h3 class="text-md text-[#183018]">{{ strtoupper($category->name) }}</h3>
                    </a>
                    @php
                      $subCategoriesInCategory = $subCategories->where('parent_id', $category->id);
                    @endphp
  
                    @if ($subCategoriesInCategory->isEmpty())
                      <p class="text-xs text-[#183018]">Tidak ada subkategori dalam kategori ini.</p>
                    @else
                      <div class="grid-container-category-mobile">
                        @foreach ($subCategoriesInCategory as $subCategory)
                          <a href="{{ route('shop.category.sub', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}" class="text-xs text-[#183018] poppins-regular">
                            {{ $subCategory->name }}
                          </a>
                        @endforeach
                      </div>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    
      <div id="brands" class="container d-none w-full h-[83vh] bg-white px-0" style="z-index: 9999 !important;">
        <div class="col-12 px-0 py-2">
          <p class="text-[12px] mx-3 text-[#183018] font-semibold">Cari Brand Favoritmu</p>
        </div>
        <!-- Card Items -->
        <div class="grid-container-brands h-fit p-3">
          @foreach ($brands as $brand)
            <a href="/{{ $brand->name }}_brand" class="py-2 text-sm rounded-sm border border-primary hover:border-dark hover:bg-[#183018] hover:text-white text-decoration-none text-center">
              {{ $brand->name }}
            </a>
          @endforeach
        </div>
        <!-- End Card Items -->
      </div>
    
      <div class="container-fluid py-2 md:px-24" style="background-color:#183018;">
        <div class="d-flex text-center text-white justify-content-between">
    
          <!-- NEWSLETTER -->
          <div>
            <a href="/newsletter" class="d-flex flex-column justify-content-center align-items-center p-0 text-decoration-none" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/></svg>
              <p class="p-0 text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]" role="button">Newsletter</p>
            </a>
          </div>
    
          <!-- SHOP -->
          <div class="d-flex flex-column justify-content-center align-items-center p-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 576 512">
              <path fill="#FFFFFF" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
            </svg>
            <a id="shop-link" class="p-0 text-decoration-none text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]" href="#" role="button" aria-expanded="false">Shop</a>
          </div>
          
          <!-- PROMO -->
          <div>
            <a class="d-flex flex-column justify-content-center align-items-center p-0 text-decoration-none" href="/promotion">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M374.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-320 320c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l320-320zM128 128A64 64 0 1 0 0 128a64 64 0 1 0 128 0zM384 384a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>
              <p class="p-0 text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]">Promo</p>
            </a>
          </div>
    
          <!-- BRAND -->
          <div class="d-flex flex-column justify-content-center align-items-center p-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
            <a id="brand-link" class="p-0 text-decoration-none text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]" href="#" role="button" aria-expanded="false">Brand</a>
          </div>
    
          <!-- AKUN -->
          <div class="dropdown-akun">
              <a id="account-link" class="d-flex flex-column justify-content-center align-items-center p-0 text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 448 512">
                      <path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                  </svg>
                  <p class="p-0 text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]">Akun</p>
              </a>
              <ul class="dropdown-menu dropdown-menu-end bg-[#183018]" aria-labelledby="account-link" style="width: auto; min-width: unset;">
                  <div class="shadow-sm rounded">
                      @if (session('id_user'))
                      <li class="text-end w-full hover:cursor-pointer">
                          <a class="text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700" href="{{ route('account', ['user' => session('id_user')]) }}">
                              Profil Saya
                          </a>
                      </li>
                      <li class="text-end w-full hover:cursor-pointer">
                          <a id="logout-link-exc" class="hover:cursor-pointer text-white dropdown-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] hover:bg-neutral-700">
                              Keluar
                          </a>  
                      </li>
                      @else
                      <li><a class="text-white dropdown-item hover:cursor-pointer text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" data-bs-toggle="modal" data-bs-target="#loginUser1">Masuk</a></li>
                      <li><a class="text-white dropdown-item hover:cursor-pointer text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px] hover:bg-neutral-700" data-bs-toggle="modal" data-bs-target="#registerUser1">Daftar</a></li>
                      @endif
                  </div>
              </ul>
          </div>
        
    
        </div>
      </div>
  </div>
@endif

<!-- KATEGORI MOBILE -->
<script>
  if (window.innerWidth <= 455){
    document.getElementById('shop-link').addEventListener('click', function(event) {
      event.preventDefault();
      const categoriesDiv = document.getElementById('categories');
      const brandsDiv = document.getElementById('brands');
      
      // Close the brands section if it's open
      if (!brandsDiv.classList.contains('d-none')) {
        brandsDiv.classList.add('d-none');
      }
  
      const categories = document.getElementById('categories');
      
      // Toggle kelas 'open' untuk mengontrol animasi
      if (categories.classList.contains('open')) {
          categories.classList.remove('open'); // Tutup animasi
      } else {
          categories.classList.add('open'); // Buka animasi
      }
  
      // Toggle the categories section
      categoriesDiv.classList.toggle('d-none');
    });
  }
</script>

<!-- BRAND MOBILE -->
<script>
  if (window.innerWidth <= 455){
    document.getElementById('brand-link').addEventListener('click', function(event) {
      event.preventDefault();
      const brandsDiv = document.getElementById('brands');
      const categoriesDiv = document.getElementById('categories');
  
      // Close the categories section if it's open
      if (!categoriesDiv.classList.contains('d-none')) {
        categoriesDiv.classList.add('d-none');
      }
  
      // Toggle the brands section
      brandsDiv.classList.toggle('d-none');
    });
  }
</script>

<!-- Logout -->
<script>
  $(document).ready(function(){
    // Fungsi logout
    $('#logout-link-exc').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('logout.user') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
              if(response.success) {
                Toast.fire({
                  icon: "success",
                  text: response.message,
                  title: "Berhasil",
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                }).then(function () {
                  window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
                });
              }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat logout, silahkan coba lagi.');
            }
        });
    });
  });
</script>


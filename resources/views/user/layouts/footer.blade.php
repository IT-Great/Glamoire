<footer class="mb-12 mb-lg-0">
  <div class="container-fluid text-dark">
    <div class="row" style="background-color: #183018">
      <div class="col">
        <div class="py-2 flex items-center justify-between w-full md:px-20 lg:px-24 xl:px-24 2xl:px-96">
          <img class="w-1/3" style="max-width:250px;" src="images/l-1.png" alt="Image">
          <p class="text-white text-[10px] md:text-[12px] lg:text-[20px] xl:text-[26px]">
            Toko Kecantikan Berbahan Tumbuhan Pertama di Indonesia
          </p>
        </div>
      </div>
    </div>

    <div class="row md:px-20 lg:px-24 xl:px-24 2xl:px-96 pt-2 md:pt-5 lg:pt-5 xl:pt-5">
      <div class="col col-lg-10 col-md-6 col-md-12 pr-3 pr-xl-5">
        <p class="text-dark text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] mb-2 md:mb-3 lg:mb-3 xl:mb-3">
          Kami berkomitmen untuk menyediakan produk kosmetik nabati berkualitas tinggi. Misi kami adalah memastikan bahwa keindahan tidak mengorbankan lingkungan. Temukan keindahan alam bersama Glamoire.
        </p>
        <div class="d-flex content-start gap-2 text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
          <a href="" title="Facebook Glamoire" target="_blank">
            <i class="fab fa-facebook fa-lg"></i>
          </a>
          <a href="" title="Twitter Glamoire" target="_blank">
            <i class="fab fa-twitter fa-lg"></i>
          </a>
          <a href="https://www.instagram.com/glamoire.idn/" title="Instagram Glamoire" target="_blank">
            <i class="fab fa-instagram fa-lg"></i>
          </a>
        </div>
      </div>
  
      <div class="col-lg-2 text-start">
        <ul id="footer-navigasi" class="decoration-none flex md:grid justify-content-between gap-1">
          <li>
            <a class="text-dark text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="/about">Tentang Glamoire</a>
          </li>
          <li>
            <a class="text-dark text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="/contact">Hubungi</a>
          </li>
          <li>
            <a class="text-dark text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="/privacy">Kebijakan Privasi</a>
          </li>
          <li>
            <a class="text-dark text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="/terms">Syarat & Ketentuan</a>
          </li>
          <li>
            <a class="text-dark text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="/help">Bantuan</a>
          </li>
          <li>
            <a class="text-dark text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]" href="/partner">Mitra Bisnis</a>
          </li>
        </ul>
      </div>
    </div>
  
    <div class="row md:px-20 lg:px-24 xl:px-24 2xl:px-96 pt-2">
      <div class="col">
        <p class="border-top border-dark mb-md-0 text-center text-md-left text-dark text-[10px]  md:text-[10px] lg:text-[12px] xl:text-[14px]">
        &copy;
        <a class="text-dark font-weight-semi-bold text-[10px]  md:text-[10px] lg:text-[12px] xl:text-[14px]" href="#">Glamoire</a>.
        All Rights Reserved.
        </p>
      </div>
      <!-- <div class="col-md-6 text-right">
          <img class="img-fluid payment-method" src="images/payments.png" alt="" />
      </div> -->
    </div>
  </div>
  <a href="#" class="btn back-to-top text-[8px]"style="background-color: #183018"><i class="fa fa-angle-double-up text-white"></i></a>
</footer>

<!-- Bottom Navbar for Mobile (Shop, Brand, Newsletter, Promotion) -->
<div class="d-lg-none fixed-bottom mt-8">
    <div id="categories" class="container d-none w-full h-[83vh] bg-white px-0">
      <div class="col-12 px-0 py-2 border-bottom border-dark">
        <p class="text-[12px] mx-3 text-[#183018] font-semibold">Belanja Berdasarkan Kategori</p>
      </div>
      <div class="flex">
        <div class="col-6 px-0 min-h-[77vh] overflow-y-auto max-h-[75vh]">
          <nav class="tabbable border-none">
            <div class="nav grid nav-tabs border-none mb-2 mb-md-4" id="nav-tab" role="tablist">
              @for ($i=1;$i <= 13;$i++)
                @if ($i == 1)
                  <a class="nav-item flex py-3 gap-1 align-items-center active categories text-decoration-none text-[12px] pl-3" data-toggle="tab" href="#kategori{{$i}}">
                    <img src="images/produk1.png" class="w-5 h-5 rounded-circle" alt="">
                    KATEGORI {{ $i }}
                  </a>  
                @elseif ($i == 13)
                  <a class="nav-item flex py-3 gap-1 align-items-center border-none text-decoration-none text-[12px] pl-3" data-toggle="tab" href="#kategori{{$i}}">
                    <img src="images/produk1.png" class="w-5 h-5 rounded-circle" alt="">
                    KATEGORI {{ $i }}
                  </a>  
                @else
                  <a class="nav-item flex py-3 gap-1 align-items-center border-top border-bottom text-decoration-none text-[12px] pl-3" data-toggle="tab" href="#kategori{{$i}}">
                    <img src="images/produk1.png" class="w-5 h-5 rounded-circle" alt="">
                    KATEGORI {{ $i }}
                  </a>  
                @endif
              @endfor
            </div>
          </nav>
        </div>
  
        <div class="col-6 px-0">
          <div class="tab-content p-0">
            @for ($j=1; $j <= 13; $j++)
            @if ($j == 1)
            <div class="tab-pane fade show active categories overflow-hidden min-h-[77vh] py-1" id="kategori{{ $j }}">
            @else
            <div class="tab-pane fade overflow-hidden min-h-[77vh] py-1" id="kategori{{ $j }}">
            @endif
              <div class="container-fluid grid gap-3 max-h-[75vh] overflow-y-auto">
                <a href="/shop" class="text-[10px]">Lihat Semua Barang {{ $j }}</a>
                @for ($k=1; $k <= 7; $k++)
                <div class="grid gap-1">
                  <a href="/shop" class="text-[10px] font-semibold poppins-regular">Sub Kategori {{ $k }} </a>
                  <a href="/shop" class="text-[10px] poppins-regular">List Sub-kategori {{ $k }}</a>
                  <a href="/shop" class="text-[10px] poppins-regular">List Sub-Kategori {{ $k }}</a>
                  <a href="/shop" class="text-[10px] poppins-regular">List Sub-Kategori {{ $k }}</a>
                </div>
                @endfor
              </div>
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>
  
    <div id="brands" class="container d-none w-full h-[83vh] bg-white px-0">
      <div class="col-12 px-0 py-2">
        <p class="text-[12px] mx-3 text-[#183018] font-semibold">Cari Brand Favoritmu</p>
      </div>
      <!-- Card Items -->
      <div class="container px-3 min-h-[77vh] p-0 overflow-y-auto max-h-[75vh]">
        <div class="row p-0 m-0">
          @for ($i=1;$i <= 18;$i++)
            <div class="col-6 p-1">
              <a href="/brand">
                <div class="bg-white border-secondary rounded-lg shadow-sm overflow-hidden product-item border border-xl">
                  <img src="images/l-1.png" alt="">
                </div>
              </a>
            </div>
          @endfor
        </div>
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
            <a class="d-flex flex-column justify-content-center align-items-center p-0 text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 448 512">
                    <path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                </svg>
                <p class="p-0 text-white text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]">Akun</p>
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
</div>

<!-- KATEGORI MOBILE -->
<script>
  document.getElementById('shop-link').addEventListener('click', function(event) {
    event.preventDefault();
    const categoriesDiv = document.getElementById('categories');
    const brandsDiv = document.getElementById('brands');
    
    // Close the brands section if it's open
    if (!brandsDiv.classList.contains('d-none')) {
      brandsDiv.classList.add('d-none');
    }

    // Toggle the categories section
    categoriesDiv.classList.toggle('d-none');
  });
</script>

<!-- BRAND MOBILE -->
<script>
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


<!DOCTYPE html>
<html lang="en">
  <head>
    @include('user.layouts.header')
  </head>

  <body>
    @if (!Request::routeIs('invoice.user'))
      @include('user.layouts.navbar')
    @endif

    <!-- Modal Login -->
    <div class="modal fade" id="loginUser1" tabindex="-1" aria-labelledby="loginUser" aria-hidden="true" z-index="9999">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #183018">
          <div class="modal-header border-none">
            <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="container-fluid">
              <div class="d-flex justify-content-center align-items-center p-0 p-md-2">
                <img src="images/l-1.png" alt="logo glamoire" class="w-3/4 w-md-full">
              </div>

              <form method="POST" action="" class="mb-2 px-0 px-md-4">
                @csrf
                <div>
                    <label for="login_email" class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Email </label>
                    <input type="email" class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" name="email" id="login_email" placeholder="nama@gmail.com" autocomplete="off" required>
                    <div id="validationEmailLogin" class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                    </div>
                
                    <div class="mb-3">
                    <label for="login_password" class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Kata Sandi </label>
                    <input type="password" name="password" id="login_password" class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" aria-describedby="passwordHelpBlock" placeholder="******" required>
                    <div id="validationPasswordLogin" class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                    </div>
                  </div>
                  <!-- Button with improved hover effect -->
                  <!-- <button type="submit" class="btn btn-light" id="login">Masuk</button> -->
                  <button 
                      class="btn btn-light rounded-lg w-full text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" 
                      type="submit" 
                      id="login">
                      Masuk
                  </button>
                </div>
              </form>

              <div class="grid px-0 px-md-4">
                <a href="#" class="ml-1 text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" data-bs-toggle="modal" data-bs-target="#forgot" data-bs-dismiss="modal">Lupa Password ?</a>
                <p class="text-white text-center py-4 font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Belum Punya Akun ? 
                  <a href="#" class="ml-1 text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" data-bs-toggle="modal" data-bs-target="#registerUser1" data-bs-dismiss="modal">Daftar Sekarang</a>
                </p>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Sign Up -->
    <div class="modal fade" id="registerUser1" tabindex="-1" aria-labelledby="registerUser" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #183018">
          <div class="modal-header border-none">
            <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="container-fluid">
              <div class="d-flex justify-content-center align-items-center text-center">
                <img src="images/l-1.png" alt="logo glamoire" class="w-1/4">
              </div>
              
              <form class="px-0 px-md-4 grid" id="register-user-form">
                @csrf
                <div class="col-12 mb-2">
                  <div>
                      <label for="register_fullname" class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Nama Lengkap </label>
                      <input type="text" class="form-control rounded-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" name="fullname" id="register_fullname" placeholder="Masukkan Nama Lengkap" required>

                      <label for="register_date" class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Tanggal Lahir </label>
                      <input type="date" class="form-control rounded-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" name="date" id="register_date" required>
                  
                      <label for="register_email" class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Email </label>
                      <input type="email" class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" name="email" id="register_email" placeholder="contoh@gmail.com" autocomplete="off" required>
                      <div id="validationEmail" class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                      </div>
                  
                      <label for="register_handphone" class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Handphone </label>
                      <div class="input-group">
                        <span class="input-group-text text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" id="basic-addon1">+62</span>
                        <input type="number" class="form-control rounded-end-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" name="handphone" id="register_handphone" placeholder="Nomor Handphone" pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
                      </div>
                      <div id="validationHandphone" class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" style="display: none;"></div>
                    
                      <label for="register_password" class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Password </label>
                      <input type="password" name="password" id="register_password" class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" aria-describedby="passwordHelpBlock" placeholder="******" required>
                  
                      <label for="register_gender" class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Jenis Kelamin </label>
                      <div id="register_gender">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" type="radio" name="gender" id="register_gender_male" value="male" required>
                          <label class="form-check-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" for="register_gender_male">Pria </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" type="radio" name="gender" id="register_gender_female" value="female" required>
                          <label class="form-check-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" for="register_gender_male">Wanita </label>
                        </div>
                      </div>

                    
                    <div class="form-check">
                      <input class="form-check-input text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" type="checkbox" value="" id="privacy_policy_agreement" required>
                      <label for="privacy_policy" class="form-check-label text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px] text-white">
                        By registering you have agreed to the <a href="/privacy" id="privacy_policy">Privacy Policy</a> and <a href="/terms">Terms of Service</a>
                      </label>
                      <div class="invalid-feedback text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">
                        You must agree before submitting.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <!-- Button with improved hover effect -->
                  <button 
                    class="btn btn-light w-full rounded-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" 
                    type="submit" 
                    id="register">
                    Buat Akun
                  </button>
                  <div class="grid">
                    <p class="text-white text-center py-4 font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Sudah Memiliki Akun ? 
                      <a href="#" class="ml-1 text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" data-bs-toggle="modal" data-bs-target="#loginUser1" data-bs-dismiss="modal">Masuk Sekarang</a>
                    </p>
                  </div>
                </div>
              </form>
              
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal Forgot Password -->
    <div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="forgot" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #183018">
          <div class="modal-header border-none">
            <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="container-fluid">
              <div class="d-flex justify-content-center align-items-center text-center">
                <img src="images/l-1.png" alt="logo glamoire" class="w-1/3">
              </div>
              <form class="px-4 grid" id="forgot-password-form">
                @csrf
                <div class="col-12">
                    <h1 class="text-white text-sm mb-3 text-center pt-4">Lupa Kata Sandi</h1>
                    <p class="text-white text-xs mb-3 text-justify">Gunakan email anda untuk mengatur ulang kata sandi, kami akan mengirimkan link untuk mengubah kata sandi anda</p>
                    <div class="relative flex items-center mb-2">
                        <i class="fas fa-envelope text-gray-400 absolute left-3"></i> <!-- Ikon Email -->
                        <input type="email" class="form-control pl-10 pr-10 rounded-md text-sm" id="forgot_password_email" placeholder="Masukkan email" required>
                        <div class="spinner-border text-[#183018] absolute right-3" role="status" style="width:15px; height:15px;display:none;"> <!-- Spinner -->
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
  
                    <div id="validationEmailForgot" class="text-xs mb-2" style="display: none;">
                    </div>
                    <button class="py-2 w-full rounded-md text-[#183018] bg-white text-sm" type="submit" id="forgot-btn" disabled>Dapatkan Link</button>
                  </div>
                  <div class="col-12">
                    <div class="text-center text-sm">
                        <p class="text-white py-4">Sudah Ingat Akunmu? 
                        <a href="#" class="text-white ml-1" data-bs-toggle="modal" data-bs-target="#loginUser1" data-bs-dismiss="modal">Masuk</a>
                        </p>
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      @yield('content')
    </div>

    @if (!Request::is('cart') && !Request::is('checkout') && !Request::is('buy-now'))  
      <a href="#" class="btn back-to-top text-[8px]" style="background-color: #183018"><i class="fa fa-angle-double-up text-white"></i></a>
    @endif

    @if (
      !Request::is('cart') && !Request::is('checkout') && !Request::is('account') && !Request::is('shop') && !Request::is('detail') 
      && !Request::routeIs('detail.product') && !Request::routeIs('buy.now') && !Request::routeIs('invoice.user')
      && !Request::routeIs('shop.category') && !Request::routeIs('shop.category.sub')
      && !Request::is('search')
      )
      @include('user.layouts.footer')
    @endif

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/easing/easing.min.js"></script>
    

    <!-- UNTUK MENGATUR JUMLAH CARD MENGGUNAKAN SWIPERJS PADA HALAMAN HOME -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 5,
        spaceBetween: 15,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          2560: {
            slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1440: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1024: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          // Tablet
          768: {
            slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
          },
          425: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          375: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          // Mobile
          320: {
            slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
            spaceBetween: 5,  // Menyusun jarak antar slide
            navigation: false,
          },
        },
      });

      var swiperCorousel = new Swiper(".mySwiperCarousel", {
        slidesPerView: 1,
        spaceBetween: 10,
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
      });
      
      var swiperReview = new Swiper(".mySwiperReview", {
        slidesPerView: 2,
        spaceBetween: 5,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
      
      var swiperDetail = new Swiper(".mySwiperProduct", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        
      });
      
      // UNTUK MENGATUR SWIPER CARD PADA HALAMAN DETAIL PRODUCT
      var swiperShow = new Swiper('.mySwiperShow', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: true,
      });

      var swiperNewest = new Swiper(".mySwiperNewest", {
        slidesPerView: 5,
        spaceBetween: 15,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          2560: {
            slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1440: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1024: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          // Tablet
          768: {
            slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
          },
          425: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          375: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          // Mobile
          320: {
            slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
            spaceBetween: 5,  // Menyusun jarak antar slide
            navigation: false,
          },
        },
      });

      var swiperTop = new Swiper(".mySwiperTop", {
        slidesPerView: 5,
        spaceBetween: 15,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          2560: {
            slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1440: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1024: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          // Tablet
          768: {
            slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
          },
          425: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          375: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          // Mobile
          320: {
            slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
            spaceBetween: 5,  // Menyusun jarak antar slide
            navigation: false,
          },
        },
      });
      
      var swiperVoucher = new Swiper(".mySwiperVoucher", {
        slidesPerView: 5,
        spaceBetween: 15,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          2560: {
            slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1440: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1024: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          // Tablet
          768: {
            slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
          },
          425: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          375: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          // Mobile
          320: {
            slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
            spaceBetween: 5,  // Menyusun jarak antar slide
            navigation: false,
          },
        },
      });
      
      var swiperPromo = new Swiper(".mySwiperPromo", {
        slidesPerView: 5,
        spaceBetween: 15,
        cssMode: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          2560: {
            slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1440: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          1024: {
            slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 10, // Menyusun jarak antar slide
          },
          // Tablet
          768: {
            slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
          },
          425: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          375: {
            slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
            spaceBetween: 5, // Menyusun jarak antar slide
            navigation: false,
          },
          // Mobile
          320: {
            slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
            spaceBetween: 5,  // Menyusun jarak antar slide
            navigation: false,
          },
        },
      });
    </script>

    <!-- UNTUK MENGATUR RANGE DI FILTER SHOP -->
    <script>
      function updatePriceRange() {
        const minPrice = document.getElementById("min-price").value;
        const maxPrice = document.getElementById("max-price").value;

        document.getElementById("min-price-value").textContent = `Rp${formatRupiah(minPrice)}`;
        document.getElementById("max-price-value").textContent = `Rp${formatRupiah(maxPrice)}`;
      }

      function updatePriceRangeMobile() {
        const minPrice = document.getElementById("min-price-mobile").value;
        const maxPrice = document.getElementById("max-price-mobile").value;

        document.getElementById("min-price-value-mobile").textContent = `Rp${formatRupiah(minPrice)}`;
        document.getElementById("max-price-value-mobile").textContent = `Rp${formatRupiah(maxPrice)}`;
      }

      function formatRupiah(value) {
        // Format the price as Indonesian Rupiah (e.g., Rp10,000)
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }

    </script>

    <!-- UNTUK MENGATUR SAAT CARD DIKLIK DI DETAIL HALAMAN -->
    <script>
      document.querySelectorAll('.example-product').forEach(slide => {
        slide.addEventListener('click', function() {
            // Remove 'active' class from all slides
            document.querySelectorAll('.example-product').forEach(s => s.classList.remove('active'));
            // Add 'active' class to the clicked slide
            this.classList.add('active');
        });
      });
    </script>

    <!-- Pilih all item di keranjang -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const checkAll = document.getElementById("checkAll");
        if (checkAll) {
            checkAll.addEventListener("change", function () {
                const checkboxes = document.querySelectorAll(".item-checkbox");
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });
        }
      });
    </script>

    <!-- ADD TO CART & ADD TO WHISLIST -->
    <script>
      // Function for adding to cart
      function addToCart(produkId) {
        $.ajax({
            url: "{{ route('add.to.chart') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                product_id: produkId,
            },
            success: function (response) {
              if (response.success) {
                Toast.fire({
                  icon: "success",
                  text: response.message,
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                }).then(function () {
                  window.location.reload(); // Redirect ke halaman utama atau halaman lain
                });
              } else {
                let errors = response.errors;
                let errorMessages = response.message;
                for (const key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += errors[key][0] + "<br>";
                    }
                }
                Toast.fire({
                  icon: "error",
                  text: errorMessages,
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                });
              }
            },
            error: function (response) {
              Toast.fire({
                icon: "error",
                text: "Kesalahan Sistem",
                willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
              });
            },
        });
      }

      // Function for adding to wishlist
      function addToWishlist(produkId) {        
        $.ajax({
            url: "{{ route('add.to.wishlist') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                product_id: produkId,
            },
            success: function (response) {
                if (response.success) {
                  Toast.fire({
                    icon: "success",
                    text: response.message,
                    willOpen: () => {
                      const title = document.querySelector('.swal2-title');
                      const content = document.querySelector('.swal2-html-container');
                      if (title) title.style.color = '#ffffff'; // Ubah warna judul
                      if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                  }).then(function () {
                    window.location.reload(); // Redirect ke halaman utama atau halaman lain
                  });
                } else {
                    let errors = response.errors;
                    let errorMessages = response.message;
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages += errors[key][0] + "<br>";
                        }
                    }
                    Toast.fire({
                      icon: "error",
                      text: response.message,
                      
                      willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                    });
                }
            },
            error: function (response) {
              Toast.fire({
                icon: "error",
                text: "Kesalahan Sistem",
                
                willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
              });
            },
        });
      }

      function removeFromWishlist(produkId) {        
        $.ajax({
            url: "{{ route('remove.from.wishlist') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                product_id: produkId,
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                      icon: "success",
                      text: response.message,
                      
                      willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                    }).then(function () {
                      window.location.reload(); // Redirect ke halaman utama atau halaman lain
                    });
                } else {
                    let errors = response.errors;
                    let errorMessages = response.message;
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages += errors[key][0] + "<br>";
                        }
                    }
                    Toast.fire({
                      icon: "error",
                      text: response.message,
                      
                      willOpen: () => {
                        const title = document.querySelector('.swal2-title');
                        const content = document.querySelector('.swal2-html-container');
                        if (title) title.style.color = '#ffffff'; // Ubah warna judul
                        if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                    });
                }
            },
            error: function (response) {
              Toast.fire({
                icon: "error",
                text: "Kesalahan Sistem",
                
                willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
              });
          },
        });
      }
    </script>

    <!-- STYLE POP-UP -->
    <script>
      const style = document.createElement('style');
      style.innerHTML = `
          .toast-title {
              color: #ffffff !important; /* Mengatur warna judul */
          }
          .toast-content {
              text-color: #ffffff !important; /* Mengatur warna konten */
          }
      `;
      document.head.appendChild(style);
    </script>

    <!-- Register -->
    <script>
      $(document).on("submit", "#registerUser1", function (e) {
        e.preventDefault();

        let fullname = $("#register_fullname").val();
        let email = $("#register_email").val();
        let password = $("#register_password").val();
        let handphone = $("#register_handphone").val();
        let gender = $('input[name="gender"]:checked').val();
        let date = $('#register_date').val()

        let label = $("#label").val();
        let recipient_name = $("#recipient_name").val();
        let addressHandphone = $("#address_handphone").val();
        let address = $("#address").val();
        let province = $("#province_name").val();
        let regency = $("#regency_name").val();
        let district = $("#district_name").val();
        let benchmark = $("#benchmark").val();

        // console.log({province,regency,district,date});
        Swal.fire({
          text: "Akun Anda Sedang Kami Proses ...",
          allowOutsideClick: false,
          showConfirmButton: false,
          toast: true,
          position: "center",
          background: "#183018",
          customClass: {
            popup: "small-swal", // Add custom class
          },
          didOpen: () => {
            Swal.showLoading();
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });

        $.ajax({
            url: "{{ route('register.user') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                fullname: fullname,
                email: email,
                password: password,
                handphone: handphone,
                date: date,
                gender: gender,
                label : label,
                recipient_name : recipient_name,
                addressHandphone : addressHandphone,
                address : address,
                province : province,
                regency : regency,
                district : district,
                benchmark : benchmark,
            },
            success: function (response) {
              Swal.close();
              if (response.success) {
                Toast.fire({
                  icon: "success",
                  text: response.message,
                  
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                }).then(function () {
                  window.location.href = "/email-verify"; // Redirect ke halaman utama atau halaman lain
                });
              } else {
                let errorMessage = response.message || "Terjadi kesalahan"; // Mengambil pesan error dari response
                Toast.fire({
                  icon: "error",
                  text: errorMessage,
                  
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
            error: function (response) {
                Toast.close();
                let errorMessage = "";
                
                if (response.responseJSON) {
                    if (response.responseJSON.message) {
                      errorMessage = response.responseJSON.message; // Pesan error dari Laravel
                    } else if (response.responseJSON.errors) {
                      // Jika ada beberapa pesan error, tampilkan semuanya
                      errorMessage = "";
                      $.each(response.responseJSON.errors, function (key, value) {
                          errorMessage += value[0] + "<br>"; // Menggabungkan pesan error
                      });
                    }
                } else if (response.statusText) {
                  errorMessage = response.statusText;
                }
                // Tampilkan pesan error dengan SweetAlert
                Toast.fire({
                  icon: "error",
                  text: errorMessage,
                  
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                }).then(function () {
                  window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
                });
            },
        });
      });
    </script>

    <!-- Login -->
    <script>
      $(document).on("submit", "#loginUser1", function (e) {
        e.preventDefault();

        let email = $("#login_email").val();
        let password = $("#login_password").val();

        Toast.fire({
          text: "Mohon tunggu sebentar ...",
          allowOutsideClick: false,
          didOpen: () => {
            Toast.showLoading();
            $("#loginUser1").hide();

            const content = document.querySelector('.swal2-html-container');
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
        // console.log({email, password});

        $.ajax({
            url: "{{ route('login.user') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                email: email,
                password: password,
            },
            success: function (response) {
              Toast.close();
                if (response.success) {
                  Toast.fire({
                    icon: "success",
                    text: response.message,
                    
                    willOpen: () => {
                      const title = document.querySelector('.swal2-title');
                      const content = document.querySelector('.swal2-html-container');
                      if (title) title.style.color = '#ffffff'; // Ubah warna judul
                      if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                  }).then(function () {
                      window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
                  });
                } else {
                  let errors = response.errors;
                  let errorMessages = response.message;
                  for (const key in errors) {
                      if (errors.hasOwnProperty(key)) {
                          errorMessages += errors[key][0] + "<br>";
                      }
                  }
                  Toast.fire({
                    icon: "error",
                    text: response.message,
                    
                    willOpen: () => {
                      const title = document.querySelector('.swal2-title');
                      const content = document.querySelector('.swal2-html-container');
                      if (title) title.style.color = '#ffffff'; // Ubah warna judul
                      if (content) content.style.color = '#ffffff'; // Ubah warna konten
                    }
                  }).then(function () {
                    $("#loginUser1").show(); // Redirect ke halaman utama atau halaman lain
                  });
                }
            },
            error: function (response) {
              Swal.close();
              Toast.fire({
                icon: "error",
                text: "Kesalahan Sistem",
                
                willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
                },
              }).then(function () {
                window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
              });
            },
        });
      });
    </script>

    <!-- CHECK EMAIL & HANDPHONE REGISTER -->
    <script>
      $(document).ready(function () {
          // Cek email
          $('#register_email').on('blur', function () {
              var email = $(this).val();
              if (email) {
                  $.ajax({
                      url: "{{ route('check.email') }}",
                      method: "POST",
                      data: {
                          "_token": "{{ csrf_token() }}",
                          email: email
                      },
                      success: function (response) {
                          if (response.exists) {
                              $('#validationEmail').text('Email sudah didaftarkan').addClass('text-danger').show();
                          } else {
                              $('#validationEmail').hide();
                          }
                      }
                  });
              }
          });

          // Cek handphone
          $('#register_handphone').on('blur', function () {
              var handphone = $(this).val();
              if (handphone) {
                  $.ajax({
                      url: "{{ route('check.handphone') }}",
                      method: "POST",
                      data: {
                          "_token": "{{ csrf_token() }}",
                          handphone: handphone
                      },
                      success: function (response) {
                          if (response.exists) {
                              $('#validationHandphone').text('Nomor handphone sudah didaftarkan').addClass('text-danger').show();
                          } else {
                              $('#validationHandphone').hide();
                          }
                      }
                  });
              }
          });
      });
    </script>

    <!-- CHECK EMAIL FORGOT PASSWORD -->
    <script>
      $('#forgot_password_email').on('keyup', function () {
        var email = $(this).val();
        if (email) {
            $.ajax({
                url: "{{ route('check.email.voucher') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email
                },
                beforeSend: function() {
                    // Tampilkan spinner sebelum request dimulai
                    $('.spinner-border').show();
                },
                success: function (response) {
                    if (response.exists) {
                        $('#validationEmailForgot').text('Email Anda Terdaftar').addClass('text-white').show();
                        $('#forgot-btn').prop('disabled', false);
                    } else {
                        $('#validationEmailForgot').text('Oops, Email Anda Belum Terdaftar').addClass('text-white').show();
                        $('#forgot-btn').prop('disabled', true);
                    }
                },
                complete: function() {
                    // Sembunyikan spinner setelah request selesai
                    $('.spinner-border').hide();
                },
                error: function() {
                    // Jika ada error, tetap sembunyikan spinner
                    $('.spinner-border').hide();
                }
            });
        }
      });

      // ACTION DAPATKAN LINK LUPA PASSWORD
      $(document).on("submit", "#forgot-password-form", function (e) {
          e.preventDefault();

          let email = $("#forgot_password_email").val();

          Swal.fire({
            toast: true,
            position: "center",
            background: "#183018",
            title: "Sedang mengirim token verifikasi ke emailmu",
            text: "Mohon tunggu sebentar ...",
            allowOutsideClick: false,
            showConfirmButton: false,
            customClass: {
              popup: "small-swal", // Add custom class
            },
            didOpen: () => {
              Swal.showLoading();
              const title = document.querySelector('.swal2-title');
              const content = document.querySelector('.swal2-html-container');
              if (title) title.style.color = '#ffffff'; // Ubah warna judul
              if (content) content.style.color = '#ffffff'; // Ubah warna konten
            }
          });

          $.ajax({
              url: "{{ route('forgot.password.link') }}", // Route forgot password di Laravel
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}", // CSRF token dari Laravel
                  email: email,
              },
              success: function (response) {
                  Swal.close();

                  if (response.success) {
                      Toast.fire({
                          icon: "success",
                          text: response.message,
                          
                          willOpen: () => {
                              const title = document.querySelector('.swal2-title');
                              const content = document.querySelector('.swal2-html-container');
                              if (title) title.style.color = '#ffffff'; // Ubah warna judul
                              if (content) content.style.color = '#ffffff'; // Ubah warna konten
                          }
                      }).then(function (result) {
                          if (result.isConfirmed) {
                              window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
                          }
                      });
                  } else {
                      let errorMessage = response.message; // Inisialisasi errorMessage sebelum digunakan
                      if (response.responseJSON) {
                          if (response.responseJSON.message) {
                              errorMessage = response.responseJSON.message; // Pesan error dari Laravel
                          } else if (response.responseJSON.errors) {
                              // Jika ada beberapa pesan error, tampilkan semuanya
                              $.each(response.responseJSON.errors, function (key, value) {
                                  errorMessage += value[0] + "<br>"; // Menggabungkan pesan error
                              });
                          }
                      } else if (response.statusText) {
                          // Jika tidak ada response JSON, tampilkan status text dari request
                          errorMessage = response.statusText;
                      }

                      // Tampilkan pesan error dengan SweetAlert
                      Toast.fire({
                          icon: "error",
                          text: errorMessage,
                          
                          willOpen: () => {
                              const title = document.querySelector('.swal2-title');
                              const content = document.querySelector('.swal2-html-container');
                              if (title) title.style.color = '#ffffff'; // Ubah warna judul
                              if (content) content.style.color = '#ffffff'; // Ubah warna konten
                          }
                      });
                  }
              },
              error: function (response) {
                  Swal.close();
                  let errorMessage = "Maaf, terjadi kesalahan."; // Definisikan errorMessage di awal

                  // Cek apakah ada response JSON dari server
                  if (response.responseJSON) {
                      if (response.responseJSON.message) {
                          errorMessage = response.responseJSON.message; // Pesan error dari Laravel
                      } else if (response.responseJSON.errors) {
                          // Jika ada beberapa pesan error, tampilkan semuanya
                          errorMessage = "";
                          $.each(response.responseJSON.errors, function (key, value) {
                              errorMessage += value[0] + "<br>"; // Menggabungkan pesan error
                          });
                      }
                  } else if (response.statusText) {
                      // Jika tidak ada response JSON, tampilkan status text dari request
                      errorMessage = response.statusText;
                  }

                  // Tampilkan pesan error dengan SweetAlert
                  Toast.fire({
                      icon: "error",
                      text: errorMessage,
                      
                      willOpen: () => {
                          const title = document.querySelector('.swal2-title');
                          const content = document.querySelector('.swal2-html-container');
                          if (title) title.style.color = '#ffffff'; // Ubah warna judul
                          if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                  });
              },
          });
      });

    </script>

    <!-- Logout -->
    <script>
      $(document).ready(function(){
        // Fungsi logout
        $('#logout-link').on('click', function(e) {
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

    <!-- NOITFY ME -->
    <script>
      function notifyMe(produkId, productVariantId) {
        $.ajax({
            url: "{{ route('notify.me') }}", // Route register di Laravel
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                product_id: produkId,
                product_variant_id: productVariantId
            },
            success: function (response) {
              if (response.success) {
                Toast.fire({
                  icon: "success",
                  text: response.message,
                  
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                }).then(function () {
                  window.location.reload(); // Redirect ke halaman utama atau halaman lain
                });
              } else {
                let errors = response.errors;
                let errorMessages = response.message;
                for (const key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages += errors[key][0] + "<br>";
                    }
                }
                Toast.fire({
                  icon: "error",
                  text: errorMessages,
                  
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                });
              }
            },
            error: function (response) {
              Toast.fire({
                icon: "error",
                text: "Kesalahan Sistem",
                
                willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
              });
            },
        });
      }
    </script>

    <!-- Reset Form Masuk & Daftar -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Tangkap modal elemen
        const loginModal = document.getElementById('loginUser1');
        const registerModal = document.getElementById('registerUser1');
        
        // Deteksi saat modal ditutup
        loginModal.addEventListener('hidden.bs.modal', function () {
          // Reset form input saat modal ditutup
          loginModal.querySelector('form').reset();
        });
        registerModal.addEventListener('hidden.bs.modal', function () {
          // Reset form input saat modal ditutup
          registerModal.querySelector('form').reset();
        });
      });
    </script>

    <!-- AMBIL TOTAL CART ITEMS -->
    @php
      $user = session('id_user');
      $cartGuest = session('guest_cart', []); // Ambil cart dari session
      $totalItem = collect($cartGuest)->sum('quantity'); // Jumlah semua qty
    @endphp

    @if ($user !== null)
      <script>
        $(document).ready(function() {
          $.ajax({
              url: "{{ route('get.total.cart') }}",
              type: 'GET',
              success: function(data) {
                  // Update jumlah cart items di dalam elemen dengan ID total_cart_items
                  $('#total_cart_items').text(data);
              },
              error: function(error) {
                  console.error('Error fetching total cart items:', error);
              }
          });
        });
      </script>
    @else
      <script>
        $(document).ready(function() {
          // Update jumlah cart items di dalam elemen dengan ID total_cart_items
          let totalItem = {{ $totalItem }};
    
          $('#total_cart_items').text(totalItem);;
          console.log($totalItem);
        });
      </script>
    @endif

    @if (session('register_or_login_first'))
      <script>
        var Toast = Swal.mixin({
          toast: true,
          position: "center",
          background: "#183018",
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
          customClass: {
            popup: "small-swal", // Add custom class
          },
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });

        Toast.fire({
          icon: "error",
          text: "Masuk/Daftar terlebih dahulu yaa",
          
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
      </script>
    @endif

    @if (session('after_reset_password'))
      <script>
        var Toast = Swal.mixin({
            toast: true,
            position: "center",
            background: "#183018",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            customClass: {
              popup: "small-swal", // Add custom class
            },
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            },
        });
        Toast.fire({
          icon: "success",
          text: "Kata sandi anda berhasil diubah",
          
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
      </script>
    @endif

    @if (session('failed_reset_password'))
      <script>
        var Toast = Swal.mixin({
            toast: true,
            position: "center",
            background: "#183018",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            customClass: {
              popup: "small-swal", // Add custom class
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });
        Toast.fire({
          icon: "error",
          text: "Kata sandi anda gagal diperbarui",
          
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
      </script>
    @endif

    @if (session('success_verification_email'))
      <script>
        var Toast = Swal.mixin({
            toast: true,
            position: "center",
            background: "#183018",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            customClass: {
              popup: "small-swal", // Add custom class
            },
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            },
        });
        Toast.fire({
          icon: "success",
          text: "Yeey emailmu berhasil diverifikasi",
          
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
      </script>
    @endif

    @if (session('voucher_new_user'))
      <script>
        var Toast = Swal.mixin({
            toast: true,
            position: "center",
            background: "#183018",
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            customClass: {
              popup: "small-swal", // Add custom class
            },
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            },
        });
        Toast.fire({
          icon: "success",
          text: "Silahkan cek kode promo di emailmu",
          title: "Selamat",
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
      </script>
    @endif
    
  </body>
</html>
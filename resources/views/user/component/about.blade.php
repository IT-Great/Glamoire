@extends('user.layouts.master')

@section('content')

<div class="container-fluid md:px-20 lg:px-24 xl:px-24 h-[40vh] md:h-[50vh] lg:h-[80vh] xl:h-[100vh]  d-flex justify-content-center align-items-center" style="background-image: url('images/bg.png');background-size: cover; background-position: center;">
  
  <div class="p-1 p-md-3 p-lg-4 p-xl-4">
    <div class="mb-2 mb-md-4 mb-lg-6 mb-xl-8">
      <div class="d-flex gap-2">
        <a href="/" class="text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[7px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Tentang</a>
      </div>
    </div>  
    
    <div class="grid gap-1 gap-md-3 p-0 col-8 col-md-6">
      <p class="text-[#CE8B50] text-[10px] md:text-[20px] lg:text-[40px] xl:text-[54px] aclonica-regular" style="line-height: 1.1;">Temukan Kecantikan Sejati Anda dengan Glamoire</p>
      <div>
        <p class="text-[5px] md:text-[8px] lg:text-[12px] xl:text-[14px]">
        Jelajahi berbagai kosmetik mewah kami yang dirancang untuk meningkatkan kecantikan alami Anda. Dari lipstik yang berani hingga alas bedak yang bercahaya, setiap produk dibuat untuk menonjolkan versi terbaik dari Anda.
        </p>
      </div>
      
      <div class="col">
        <div class="row">
          <div class="col-md-3 col-4 grid p-0">
            <p class="text-black font-semibold text-[6px] md:text-[12px] lg:text-[18px] xl:text-[24px]">19+</p>
            <p class="text-[5px] md:text-[7px] lg:text-[12px] xl:text-[14px]">Brand</p>
          </div>
          <div class="col-md-3 col-4 grid p-0">
            <p class="text-black font-semibold text-[6px] md:text-[12px] lg:text-[18px] xl:text-[24px]">200+</p>
            <p class="text-[5px] md:text-[7px] lg:text-[12px] xl:text-[14px]">Pengguna Aktif</p>
          </div>
          <div class="col-md-6 col-12 grid p-0 mt-1 mt-md-0">
            <p class="text-black font-semibold text-[6px] md:text-[12px] lg:text-[18px] xl:text-[24px]">100+</p>
            <p class="text-[5px] md:text-[7px] lg:text-[12px] xl:text-[14px]">Produk Berkualitas</p>
          </div>
        </div>
      </div>

      <div>
        <a href="/shop" class="btn rounded-md w-1/2 w-md-1/4 text-white text-[6px] md:text-[7px] lg:text-[8px] xl:text-[14px]" style="background-color: #183018">Belanja Sekarang</a>
      </div>

    </div>
  </div>

</div>

<div class="container-fluid my-2 my-md-4 grid gap-2 gap-md-4 px-8 md:px-24 ">
  <div class="d-flex">
    <div class="col-6 col-md-6 p-0">
      <div class="d-flex justify-content-center align-items-center">
        <img src="images/about-1.png" class="img-fluid" alt="">
      </div>
    </div>

    <div class="col-6 col-md-6 px-md-12 d-flex justify-content-center align-items-center">
      <div class="grid gap-1 gap-md-2">
        <h1 class="font-semibold text-[8px] md:text-[20px] lg:text-[24px] xl:text-[28px]">Glamoire</h1>
        <p class="text-justify text-black text-[5px] md:text-[10px] lg:text-[16px] xl:text-[18px]">E-commerce yang berkomitmen untuk menyediakan produk kosmetik berkualitas tinggi yang berbahan dasar tanaman. 
        Kami percaya bahwa kecantikan tidak harus mengorbankan kesejahteraan lingkungan.</p>
      </div>
    </div>
  </div>

  <div class="d-flex">
    <div class="col-6 col-md-6 px-md-12 d-flex justify-content-center align-items-center">
      <div class="grid gap-1 gap-md-2">
        <h1 class="text-end font-semibold text-[8px] md:text-[20px] lg:text-[24px] xl:text-[28px]">Our Vision</h1>
        <p class="text-end text-black text-[5px] md:text-[10px] lg:text-[16px] xl:text-[18px]">E-commerce yang berkomitmen untuk menyediakan produk kosmetik berkualitas tinggi yang berbahan dasar tanaman. 
        Kami percaya bahwa kecantikan tidak harus mengorbankan kesejahteraan lingkungan.</p>
      </div>
    </div>
  
    <div class="col-6 col-md-6 p-0">
      <div class="d-flex justify-content-center align-items-center">
        <img src="images/about-2.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>

  <div class="d-flex">
    <div class="col-6 col-md-6 p-0">
      <div class="d-flex justify-content-center align-items-center">
        <img src="images/about-3.png" class="img-fluid" alt="">
      </div>
    </div>
  
    <div class="col-6 col-md-6 px-md-12 d-flex justify-content-center align-items-center">
      <div class="grid gap-1 gap-md-2">
        <h1 class="font-semibold text-[8px] md:text-[20px] lg:text-[24px] xl:text-[28px]">Glamoire</h1>
        <p class="text-justify text-black text-[5px] md:text-[10px] lg:text-[16px] xl:text-[18px]">E-commerce yang berkomitmen untuk menyediakan produk kosmetik berkualitas tinggi yang berbahan dasar tanaman. 
        Kami percaya bahwa kecantikan tidak harus mengorbankan kesejahteraan lingkungan.</p>
      </div>
    </div>
  </div>
</div>

@endsection
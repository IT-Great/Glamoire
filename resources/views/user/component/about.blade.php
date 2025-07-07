@extends('user.layouts.master')

@section('content')

{{-- HERO SECTION --}}
<div class="container-fluid md:px-20 lg:px-24 xl:px-24 2xl:px-48 h-[40vh] md:h-[50vh] lg:h-[80vh] xl:h-[100vh] d-flex justify-content-center align-items-center" style="background-image: url('{{ Storage::url($data['hero_image']) }}');background-size: cover; background-position: center;">
  <div class="p-1 p-md-3 p-lg-4 p-xl-4">
    <div class="mb-2 mb-md-4 mb-lg-6 mb-xl-8">
      <div class="d-flex gap-2">
        <a href="/" class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Tentang</a>
      </div>
    </div>  
    
    <div class="grid gap-1 gap-md-3 p-0 col-8 col-md-6">
      <p class="text-[#CE8B50] text-[14px] md:text-[20px] lg:text-[40px] xl:text-[54px] aclonica-regular" style="line-height: 1.1;">
        {{ $data['hero_title']}}
        {{-- Temukan Kecantikan Sejati Anda dengan Glamoire --}}
      </p>
      <div>
        <p class="text-[7px] md:text-[8px] lg:text-[12px] xl:text-[14px]">
          {{ $data['hero_description']}}
        </p>
      </div>
      
      <div class="col">
        <div class="row">
          <div class="col-md-3 col-4 grid p-0">
            <p class="text-black font-semibold text-[8px] md:text-[12px] lg:text-[18px] xl:text-[24px]">19+</p>
            <p class="text-[7px] md:text-[7px] lg:text-[12px] xl:text-[14px]">Brand</p>
          </div>
          <div class="col-md-3 col-4 grid p-0">
            <p class="text-black font-semibold text-[8px] md:text-[12px] lg:text-[18px] xl:text-[24px]">200+</p>
            <p class="text-[7px] md:text-[7px] lg:text-[12px] xl:text-[14px]">Pengguna Aktif</p>
          </div>
          <div class="col-md-6 col-12 grid p-0 mt-1 mt-md-0">
            <p class="text-black font-semibold text-[8px] md:text-[12px] lg:text-[18px] xl:text-[24px]">100+</p>
            <p class="text-[7px] md:text-[7px] lg:text-[12px] xl:text-[14px]">Produk Berkualitas</p>
          </div>
        </div>
      </div>

      <div>
        <a href="/shop" class="btn rounded-sm w-fit text-white text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" style="background-color: #183018">Belanja Sekarang</a>
      </div>

    </div>
  </div>
</div>
{{-- END HERO SECTION --}}



<div class="container-fluid my-2 my-md-4 grid gap-2 gap-md-4 md:px-20 lg:px-24 xl:px-24 2xl:px-48">
  {{-- INTRO --}}
  <div class="grid md:flex">
    <div class="col-8 col-md-6 p-0">
      <div class="d-flex justify-content-center align-items-center">
        <img src="{{ Storage::url($data['intro_image']) }}" class="img-fluid" alt="">
      </div>
    </div>

    <div class="col-12 col-md-6 px-md-12 flex justify-content-center align-items-center px-0 px-md-2">
      <div class="grid gap-1 gap-md-2">
        <h1 class="font-semibold text-[12px] md:text-[20px] lg:text-[24px] xl:text-[28px]">{{$data['intro_title']}}</h1>
        <p class="text-start md:text-justify text-black text-[10px] md:text-[10px] lg:text-[16px] xl:text-[18px]">{{$data['intro_description']}}</p>
      </div>
    </div>
  </div>
  {{-- END INTRO --}}

  {{-- VISION --}}
  <div class="grid md:flex flex-col-reverse md:flex-row">
    <div class="col-8 col-md-6 p-0">
      <div class="d-flex justify-content-center align-items-center">
        <img src="{{ Storage::url($data['vision_image']) }}" class="img-fluid" alt="">
      </div>
    </div>

    <div class="col-12 col-md-6 px-md-12 flex justify-content-center align-items-center px-0 px-md-2">
      <div class="grid gap-1 gap-md-2">
        <h1 class="text-end font-semibold text-[12px] md:text-[20px] lg:text-[24px] xl:text-[28px]">{{ $data['vision_title']}}</h1>
        <p class="text-end text-black text-[10px] md:text-[10px] lg:text-[16px] xl:text-[18px]">
          {{ $data['vision_description']}}
        </p>
      </div>
    </div>
  </div>
  {{-- END VISION --}}

  {{-- MISSION --}}
  <div class="grid md:flex">
    <div class="col-8 col-md-6 p-0">
      <div class="d-flex justify-content-center align-items-center">
        <img src="{{ Storage::url($data['mission_image']) }}" class="img-fluid" alt="">
      </div>
    </div>
  
    <div class="col-12 col-md-6 px-md-12 flex justify-content-center align-items-center px-0 px-md-2">
      <div class="grid gap-1 gap-md-2">
        <h1 class="text-start font-semibold text-[12px] md:text-[20px] lg:text-[24px] xl:text-[28px]">{{$data['mission_title']}}</h1>
        <p class="text-start md:text-justify text-black text-[10px] md:text-[10px] lg:text-[16px] xl:text-[18px]">{{ $data['mission_description']}}</p>
      </div>
    </div>
  </div>
  {{-- END MISSION --}}

</div>

@endsection
@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-2 py-2">
  <div class="container-fluid"> 
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-2 pl-2">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Artikel</a>
      </div>
    </div>  
  </div>

  <div class="container-fluid p-0 mt-3 mt-md-0">
    <div class="col">
      <nav class="tabbable custom-scroll">
        <div class="nav nav-tabs mb-2 mb-md-4" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#all">All</a>
          @foreach ($categoryArticles as $category)
          <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#{{ Str::slug($category->name) }}">{{ $category->name }}</a>  
          @endforeach</div>
      </nav>

      <div class="tab-content p-1 md:p-4 lg:md-4 xl:md-4 m-0">
        <div class="tab-pane fade show active" id="all" style="min-height:48vh;">
          <div class="container-fluid">
            <div class="row">
              <!-- Card Items -->
              @if (count($articles) !== 0)
                @foreach ($articles as $article)
                <div class="col-md-4 col-lg-3 p-1 p-md-2 gap-1 col-6">
                  <div class="border border-[#183018] rounded-sm">
                    <a href="/{{ $article->title }}_detailnewsletter">
                      <div class="bg-white">
                        <div class="position-relative bg-transparent p-0">
                          <img class="img-fluid w-100 rounded-top" src="{{ Storage::url($article->image) }}" alt="{{$article->title}}">
                        </div>
                        <div class="text-left p-1">
                          <p class="text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $article->categoryArticle->name }}</p>
                          <p class="text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</p>
                          <h1 class="text-black font-bold text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px] py-1">{{ $article->title }}</h1>
                          <p class="text-decoration-none text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Admin Glamoire</p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              @else
                <div style="display:flex; align-items:center; justify-content:center;">
                  <img src="images/about-1.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                </div>
                <div style="display:flex; align-items:center; justify-content:center;">
                  <p class="text-danger text-md">Maaf belum ada artikel tersedia</p>
                </div>
              @endif
              <!-- End Card Items -->
            </div>
          </div>
        </div>

        @foreach ($categoryArticles as $category)
        <div class="tab-pane fade" id="{{ Str::slug($category->name) }}" style="min-height:48vh;">
          <div class="container-fluid">
            <div class="row">
                <!-- Card Items -->
                  @if (count($category->articles) !== 0)
                    @foreach ($category->articles as $article)
                    <div class="col-6 col-md-4 col-lg-3 gap-1 p-1 p-md-2">
                      <div class="border border-[#183018] rounded-sm">
                        <a href="/{{ $article->title }}_detailnewsletter">
                          <div class="bg-white">
                            <div class="position-relative bg-transparent p-0">
                              <img class="img-fluid w-full rounded-sm" src="{{ Storage::url($article->image) }}" alt="{{$article->title}}">
                            </div>
                            <div class="text-left p-1">
                              <p class="text-[8px] md:text-[12px] lg:text-[10px] xl:text-[12px]">{{ $article->categoryArticle->name }}</p>
                              <p class="text-[8px] md:text-[12px] lg:text-[10px] xl:text-[12px]">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</p>
                              <h1 class="text-black font-bold text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px] py-1">{{ $article->title }}</h1>
                              <p class="text-decoration-none text-[8px] md:text-[12px] lg:text-[10px] xl:text-[12px]">Admin Glamoire</p>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  @else
                    <div style="display:flex; align-items:center; justify-content:center;">
                      <img src="images/about-1.png" class="img-fluid" style="width:50%; height:100%; object-fit: cover;" alt="Produk Tidak Ditemukan">
                    </div>
                    <div style="display:flex; align-items:center; justify-content:center;">
                      <p class="text-danger text-md">Maaf belum ada artikel tersedia</p>
                    </div>
                  @endif
                <!-- End Card Items -->
              </div>
            </div>
          </div>  
        @endforeach
      </div>
    </div>

  </div>

  <!-- SUBSCRIBE NEWSLETTER -->
  <!-- <div class="container-fluid my-8">
    <div class="d-flex gap-2">
      <div class="py-3 grid md:flex col-12 align-items-center justify-content-center rounded-sm" style="background-color: #475136">
        <div class="col-12 col-md-8 mb-2 mb-md-0">
          <p class="text-white text-[10px] md:text-[10px] lg:text-[14px] xl:text-[24px]">Ikuti Tren Seputar Kecantikan dengan Berlangganan Artikel Kami</p>
        </div>  
        <div class="col-12 col-md-4">
          <form class="grid gap-1 gap-md-2 m-0" id="subscribe-form">
            @csrf
            <input type="email" class="form-control rounded-sm text-[10px] md:text-[12px] lg:text-[14px] xl:text-[14px]" id="subscribe_email" placeholder="Masukkan Email" required>
            <button class="hover:text-white py-2 hover:bg-neutral-900 font-italic w-full rounded-sm text-white bg-[#183018] text-[10px] md:text-[12px] lg:text-[14px] xl:text-[14px]" type="submit">Subscribe Artikel</button>
          </form>
        </div>
      </div>  
    </div>
  </div> -->
</div>

@endsection

{{-- @extends('user.layouts.master')

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
  <div class="container-fluid my-8">
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
  </div> 
</div>

@endsection --}}

@extends('user.layouts.master')

@section('content')

  <style>
    /* Premium Typography & Colors */
    :root {
      --glamoire-dark: #183018;
      --glamoire-light: #F9FAFB;
      --glamoire-accent: #2A4D2A;
      --text-muted: #6B7280;
    }

    /* Breadcrumb Styling */
    .premium-breadcrumb {
      background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
      border-radius: 12px;
      padding: 1rem 1.5rem;
    }

    .premium-breadcrumb a {
      color: var(--text-muted);
      text-decoration: none;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .premium-breadcrumb a:hover {
      color: var(--glamoire-dark);
    }

    .premium-breadcrumb .active-page {
      color: var(--glamoire-dark);
      font-weight: 600;
    }

    /* Modern Tabs Styling */
    .premium-tabs-wrapper {
      position: relative;
      margin-bottom: 2.5rem;
    }

    .premium-tabs {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      border-bottom: 2px solid #E5E7EB;
      padding-bottom: 2px;
      scrollbar-width: none;
      /* Firefox */
    }

    .premium-tabs::-webkit-scrollbar {
      display: none;
      /* Chrome, Safari, Edge */
    }

    .premium-tabs .nav-link {
      color: var(--text-muted);
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.75rem 1.5rem;
      border: none;
      background: transparent;
      white-space: nowrap;
      position: relative;
      transition: all 0.3s ease;
    }

    .premium-tabs .nav-link:hover {
      color: var(--glamoire-dark);
    }

    .premium-tabs .nav-link.active {
      color: var(--glamoire-dark);
      background: transparent;
    }

    .premium-tabs .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      /* Match the wrapper border bottom */
      left: 0;
      width: 100%;
      height: 2px;
      background-color: var(--glamoire-dark);
      border-radius: 2px 2px 0 0;
    }

    /* Article Card Premium Styling */
    .article-card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
      transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .article-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .article-img-wrapper {
      position: relative;
      padding-top: 65%;
      /* Aspect ratio for images */
      overflow: hidden;
    }

    .article-img-wrapper img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.7s ease;
    }

    .article-card:hover .article-img-wrapper img {
      transform: scale(1.05);
    }

    .article-category-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(4px);
      color: var(--glamoire-dark);
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      z-index: 2;
    }

    .article-content {
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .article-meta {
      font-size: 0.8rem;
      color: var(--text-muted);
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 0.75rem;
    }

    .article-meta i {
      font-size: 0.9rem;
    }

    .article-title {
      font-size: 1.15rem;
      line-height: 1.4;
      font-weight: 700;
      color: #111827;
      margin-bottom: 1rem;
      /* Truncate text to 2 lines */
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      transition: color 0.3s ease;
    }

    .article-card:hover .article-title {
      color: var(--glamoire-accent);
    }

    .article-footer {
      margin-top: auto;
      /* Pushes footer to bottom */
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid #F3F4F6;
      padding-top: 1rem;
    }

    .article-author {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--glamoire-dark);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .author-avatar {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background-color: var(--glamoire-dark);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.6rem;
    }

    .read-more {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--glamoire-accent);
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .read-more i {
      transition: transform 0.3s ease;
    }

    .article-card:hover .read-more i {
      transform: translateX(4px);
    }

    /* Empty State Styling */
    .empty-state-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 4rem 2rem;
      text-align: center;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .empty-state-img {
      max-width: 250px;
      margin-bottom: 1.5rem;
      opacity: 0.8;
    }

    /* Fade In Animation for Tabs */
    .tab-pane {
      opacity: 0;
      transition: opacity 0.4s ease-in-out;
    }

    .tab-pane.active.show {
      opacity: 1;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .article-content {
        padding: 1rem;
      }

      .article-title {
        font-size: 0.95rem;
      }

      .article-category-badge {
        font-size: 0.65rem;
        padding: 3px 8px;
      }
    }
  </style>

  {{-- bagian atas --}}
  <div class="bg-white">
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-2">
      <div class="container-fluid">
        {{-- title --}}
        <div class="text-center mb-4">
          <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-[#183018] mb-3">Jurnal Glamoire</h1>
          <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-base">Temukan wawasan terbaru, tips kecantikan vegan,
            dan berita terkini dari dunia Glamoire.</p>
        </div>

        {{-- untuk kembali ke beranda/home --}}
        <div class="premium-breadcrumb d-flex align-items-center justify-content-center gap-3 mb-5">
          <a href="/" class="text-xs md:text-sm"><i class="fas fa-home mr-1"></i> Beranda</a>
          <span class="text-gray-400 text-xs md:text-sm">/</span>
          <span class="text-xs md:text-sm active-page">Artikel</span>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-[#F9FAFB] pb-12">
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4">
      <div class="container-fluid p-0">

        {{-- untuk melihat tab per-tipe artikel --}}
        <div class="premium-tabs-wrapper">
          <nav class="premium-tabs nav" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" data-bs-toggle="tab" href="#all" role="tab" aria-selected="true">Semua
              Artikel</a>
            @foreach ($categoryArticles as $category)
              <a class="nav-item nav-link" data-bs-toggle="tab" href="#{{ Str::slug($category->name) }}" role="tab"
                aria-selected="false">
                {{ $category->name }}
              </a>
            @endforeach
          </nav>
        </div>

        <div class="tab-content" id="nav-tabContent">

          {{-- isi dari konten tiap artikel --}}
          <div class="tab-pane fade show active" id="all" role="tabpanel" style="min-height: 50vh;">
            @if (count($articles) !== 0)
              <div class="row g-4">
                @foreach ($articles as $article)
                  <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <a href="/{{ $article->title }}_detailnewsletter" class="text-decoration-none">
                      <div class="article-card">
                        <div class="article-img-wrapper">
                          <span class="article-category-badge">{{ $article->categoryArticle->name }}</span>
                          <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" loading="lazy">
                        </div>

                        <div class="article-content">
                          <div class="article-meta">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') }}</span>
                          </div>

                          <h3 class="article-title">{{ $article->title }}</h3>

                          <div class="article-footer">
                            <div class="article-author">
                              <div class="author-avatar">G</div>
                              <span>Admin Glamoire</span>
                            </div>
                            <div class="read-more">
                              Baca <i class="fas fa-arrow-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            @else
              <div class="empty-state-wrapper">
                <img src="{{ asset('images/about-1.png') }}" class="empty-state-img" alt="Belum ada artikel">
                <h4 class="text-xl font-bold text-[#183018] mb-2">Belum Ada Artikel</h4>
                <p class="text-gray-500 text-sm max-w-md">Tim redaksi kami sedang menyiapkan konten menarik untuk Anda.
                  Silakan kembali lagi nanti.</p>
              </div>
            @endif
          </div>

          {{-- untuk menampilkan data artikel kategori --}}
          @foreach ($categoryArticles as $category)
            <div class="tab-pane fade" id="{{ Str::slug($category->name) }}" role="tabpanel" style="min-height: 50vh;">
              @if (count($category->articles) !== 0)
                <div class="row g-4">
                  @foreach ($category->articles as $article)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                      <a href="/{{ $article->title }}_detailnewsletter" class="text-decoration-none">
                        <div class="article-card">
                          <div class="article-img-wrapper">
                            <span class="article-category-badge">{{ $article->categoryArticle->name }}</span>
                            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" loading="lazy">
                          </div>

                          <div class="article-content">
                            <div class="article-meta">
                              <i class="far fa-calendar-alt"></i>
                              <span>{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') }}</span>
                            </div>

                            <h3 class="article-title">{{ $article->title }}</h3>

                            <div class="article-footer">
                              <div class="article-author">
                                <div class="author-avatar">G</div>
                                <span>Admin Glamoire</span>
                              </div>
                              <div class="read-more">
                                Baca <i class="fas fa-arrow-right"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  @endforeach
                </div>
              @else
                <div class="empty-state-wrapper">
                  <img src="{{ asset('images/about-1.png') }}" class="empty-state-img" alt="Kategori kosong">
                  <h4 class="text-xl font-bold text-[#183018] mb-2">Belum Ada Artikel di Kategori Ini</h4>
                  <p class="text-gray-500 text-sm max-w-md">Kami belum memublikasikan artikel untuk kategori
                    "{{ $category->name }}".</p>
                </div>
              @endif
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>

@endsection
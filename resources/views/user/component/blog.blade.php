{{-- @extends('user.layouts.master')

@section('content')

  <style>
    /* ==========================================
         WORLD CLASS EDITORIAL BLOG STYLING
         ========================================== */
    :root {
      --glamoire-dark: #183018;
      --glamoire-light: #F9FAFB;
      --glamoire-accent: #2A4D2A;
      --glamoire-gold: #D4AF37;
      --text-main: #1F2937;
      --text-muted: #6B7280;
      --border-color: #E5E7EB;
      --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      background-color: #FFFFFF;
      font-family: 'Poppins', sans-serif;
    }

    /* --- Premium Breadcrumb --- */
    .premium-breadcrumb {
      background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
      border-radius: 12px;
      padding: 0.75rem 1.5rem;
      margin-bottom: 2rem;
    }

    .premium-breadcrumb a {
      color: var(--text-muted);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.85rem;
      transition: var(--transition-smooth);
    }

    .premium-breadcrumb a:hover {
      color: var(--glamoire-dark);
    }

    .premium-breadcrumb span {
      color: var(--text-muted);
      font-size: 0.85rem;
      margin: 0 8px;
    }

    .premium-breadcrumb .active-page {
      color: var(--glamoire-dark);
      font-weight: 600;
      font-size: 0.85rem;
    }

    /* --- Main Article Area --- */
    .article-container {
      display: flex;
      gap: 3rem;
      align-items: flex-start;
    }

    .article-main-content {
      flex: 1;
      min-width: 0;
    }

    /* Article Header */
    .article-meta-top {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 1rem;
    }

    .article-category-badge {
      background: var(--glamoire-dark);
      color: #FFF;
      padding: 4px 12px;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .article-date {
      color: var(--text-muted);
      font-size: 0.9rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .article-title {
      font-family: 'The Seasons', serif;
      font-size: clamp(2rem, 4vw, 3.5rem);
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
      margin-bottom: 1.5rem;
    }

    .article-author {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 2.5rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid var(--border-color);
    }

    .author-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: var(--glamoire-sand);
      color: var(--glamoire-dark);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      font-weight: 700;
      font-family: 'The Seasons', serif;
    }

    .author-info h6 {
      margin: 0;
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-main);
      font-family: 'Poppins', sans-serif;
    }

    .author-info p {
      margin: 0;
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    /* Article Body */
    .article-hero-image {
      width: 100%;
      border-radius: 16px;
      margin-bottom: 2.5rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      aspect-ratio: 16/9;
      object-fit: cover;
    }

    .blog-post-content {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #374151;
      margin-bottom: 3rem;
    }

    .blog-post-content p {
      margin-bottom: 1.5rem;
    }

    .blog-post-content h2,
    .blog-post-content h3,
    .blog-post-content h4 {
      font-family: 'The Seasons', serif;
      color: var(--glamoire-dark);
      margin-top: 2.5rem;
      margin-bottom: 1rem;
      font-weight: 700;
    }

    .blog-post-content img {
      border-radius: 12px;
      margin: 2rem 0;
      width: 100%;
      height: auto;
    }

    /* Share Section */
    .article-share {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 2rem 0;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }

    .share-text {
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-main);
      margin: 0;
    }

    .share-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--glamoire-light);
      color: var(--text-main);
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      transition: var(--transition-smooth);
      font-size: 1.1rem;
    }

    .share-btn:hover {
      background: var(--glamoire-dark);
      color: #FFF;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(24, 48, 24, 0.2);
    }

    /* --- Sidebar (Related Articles) --- */
    .article-sidebar {
      flex: 0 0 350px;
      position: sticky;
      top: 100px;
    }

    @media (max-width: 991px) {
      .article-container {
        flex-direction: column;
      }

      .article-sidebar {
        flex: 1;
        width: 100%;
        position: static;
        margin-top: 2rem;
      }
    }

    .sidebar-widget {
      background: #FFF;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
      border: 1px solid #F3F4F6;
    }

    .widget-title {
      font-family: 'The Seasons', serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--glamoire-dark);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Scrollable Tabs in Sidebar */
    .sidebar-tabs {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      gap: 10px;
      margin-bottom: 1.5rem;
      padding-bottom: 5px;
    }

    .sidebar-tabs::-webkit-scrollbar {
      display: none;
    }

    .sidebar-tab-btn {
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 500;
      color: var(--text-muted);
      background: var(--glamoire-light);
      border: 1px solid transparent;
      white-space: nowrap;
      transition: var(--transition-smooth);
      text-decoration: none;
      cursor: pointer;
    }

    .sidebar-tab-btn:hover,
    .sidebar-tab-btn.active {
      background: var(--glamoire-dark);
      color: #FFF;
      border-color: var(--glamoire-dark);
    }

    /* Small Article Cards in Sidebar */
    .side-article-card {
      display: flex;
      gap: 15px;
      margin-bottom: 1.5rem;
      text-decoration: none;
      transition: var(--transition-smooth);
      padding: 10px;
      border-radius: 12px;
      border: 1px solid transparent;
    }

    .side-article-card:last-child {
      margin-bottom: 0;
    }

    .side-article-card:hover {
      background: var(--glamoire-light);
      border-color: var(--border-color);
      transform: translateX(5px);
    }

    .side-article-img {
      width: 90px;
      height: 90px;
      border-radius: 8px;
      flex-shrink: 0;
      overflow: hidden;
    }

    .side-article-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .side-article-info {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .side-article-cat {
      font-size: 0.7rem;
      color: var(--glamoire-gold);
      text-transform: uppercase;
      font-weight: 700;
      margin-bottom: 0.3rem;
    }

    .side-article-title {
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-main);
      line-height: 1.4;
      margin-bottom: 0.3rem;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
    }

    .side-article-date {
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    /* Empty State Sidebar */
    .empty-sidebar {
      text-align: center;
      padding: 2rem 0;
      opacity: 0.7;
    }

    .empty-sidebar img {
      width: 120px;
      margin-bottom: 1rem;
    }

    .empty-sidebar p {
      font-size: 0.9rem;
      color: var(--text-muted);
      margin: 0;
    }
  </style>

  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

    <div class="container-fluid">
      <div class="premium-breadcrumb">
        <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
        <span>/</span>
        <a href="/newsletter">Jurnal</a>
        <span>/</span>
        <a href="#">{{ $article->categoryArticle->name }}</a>
        <span>/</span>
        <span class="active-page d-inline-block text-truncate"
          style="max-width: 200px; vertical-align: bottom;">{{ $article->title }}</span>
      </div>
    </div>

    <div class="container-fluid">
      <div class="article-container">

        <div class="article-main-content">

          <div class="article-meta-top">
            <span class="article-category-badge">{{ $article->categoryArticle->name }}</span>
            <span class="article-date"><i class="far fa-calendar-alt"></i>
              {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span>
          </div>

          <h1 class="article-title">{{ $article->title }}</h1>

          <div class="article-author">
            <div class="author-avatar">G</div>
            <div class="author-info">
              <h6>Admin Glamoire</h6>
              <p>Beauty & Wellness Editor</p>
            </div>
          </div>

          <article>
            @if($article->image)
              <img class="article-hero-image" src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
            @endif

            <div class="blog-post-content">
              {!! $article->content !!}
            </div>
          </article>

          <div class="article-share">
            <p class="share-text">Bagikan artikel ini:</p>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
              title="Share on Facebook" target="_blank" class="share-btn">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
              title="Share on Twitter" target="_blank" class="share-btn">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
              title="Share on WhatsApp" target="_blank" class="share-btn" style="color:#25D366;">
              <i class="fab fa-whatsapp"></i>
            </a>
          </div>

        </div>

        <div class="article-sidebar">
          <div class="sidebar-widget">
            <h3 class="widget-title"><i class="fas fa-book-open"></i> Baca Juga</h3>

            <nav class="sidebar-tabs nav" id="nav-tab" role="tablist">
              <a class="sidebar-tab-btn active" data-bs-toggle="tab" href="#all-articles" role="tab"
                aria-selected="true">Semua</a>
              @foreach ($categoryArticles as $category)
                <a class="sidebar-tab-btn" data-bs-toggle="tab" href="#cat-{{ Str::slug($category->name) }}" role="tab"
                  aria-selected="false">
                  {{ $category->name }}
                </a>
              @endforeach
            </nav>

            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="all-articles" role="tabpanel">
                @if (count($articles) > 0)
                  @foreach ($articles->take(5) as $sideArticle) <a href="/{{ $sideArticle->title }}_detailnewsletter"
                      class="side-article-card">
                      <div class="side-article-img">
                        <img
                          src="{{ $sideArticle->image ? Storage::url($sideArticle->image) : asset('images/no-image.png') }}"
                          alt="{{ $sideArticle->title }}">
                      </div>
                      <div class="side-article-info">
                        <span class="side-article-cat">{{ optional($sideArticle->categoryArticle)->name ?? 'Artikel' }}</span>
                        <h4 class="side-article-title">{{ $sideArticle->title }}</h4>
                        <span
                          class="side-article-date">{{ \Carbon\Carbon::parse($sideArticle->created_at)->translatedFormat('d M Y') }}</span>
                      </div>
                    </a>
                  @endforeach
                @else
                  <div class="empty-sidebar">
                    <img src="{{ asset('images/about-1.png') }}" alt="Kosong">
                    <p>Belum ada artikel terbaru.</p>
                  </div>
                @endif
              </div>

              @foreach ($categoryArticles as $category)
                <div class="tab-pane fade" id="cat-{{ Str::slug($category->name) }}" role="tabpanel">
                  @if (count($category->articles) > 0)
                    @foreach ($category->articles->take(5) as $sideArticleCat)
                      <a href="/{{ $sideArticleCat->title }}_detailnewsletter" class="side-article-card">
                        <div class="side-article-img">
                          <img
                            src="{{ $sideArticleCat->image ? Storage::url($sideArticleCat->image) : asset('images/no-image.png') }}"
                            alt="{{ $sideArticleCat->title }}">
                        </div>
                        <div class="side-article-info">
                          <span class="side-article-cat">{{ $category->name }}</span>
                          <h4 class="side-article-title">{{ $sideArticleCat->title }}</h4>
                          <span
                            class="side-article-date">{{ \Carbon\Carbon::parse($sideArticleCat->created_at)->translatedFormat('d M Y') }}</span>
                        </div>
                      </a>
                    @endforeach
                  @else
                    <div class="empty-sidebar">
                      <img src="{{ asset('images/about-1.png') }}" alt="Kosong">
                      <p>Belum ada artikel di kategori ini.</p>
                    </div>
                  @endif
                </div>
              @endforeach

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection --}}

@extends('user.layouts.master')

@section('content')

  <style>
    /* ==========================================
         WORLD CLASS EDITORIAL BLOG STYLING
         ========================================== */
    :root {
      --glamoire-dark: #183018;
      --glamoire-light: #F9FAFB;
      --glamoire-accent: #2A4D2A;
      --glamoire-gold: #D4AF37;
      --glamoire-sand: #F4F1EA;
      --text-main: #1F2937;
      --text-muted: #6B7280;
      --border-color: #E5E7EB;
      --transition-smooth: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      background-color: #FFFFFF;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    /* --- SCROLL REVEAL ANIMATION CLASSES --- */
    .reveal-on-scroll {
      opacity: 0;
      transform: translateY(40px);
      transition: opacity 0.8s ease-out, transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      will-change: opacity, transform, visibility;
    }

    .reveal-on-scroll.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Penundaan (delay) bertingkat untuk elemen yang berdekatan */
    .delay-100 { transition-delay: 0.1s; }
    .delay-200 { transition-delay: 0.2s; }
    .delay-300 { transition-delay: 0.3s; }

    /* --- Premium Breadcrumb --- */
    .premium-breadcrumb {
      background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
      border-radius: 12px;
      padding: 0.75rem 1.5rem;
      margin-bottom: 2rem;
    }

    .premium-breadcrumb a {
      color: var(--text-muted);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.85rem;
      transition: var(--transition-smooth);
    }

    .premium-breadcrumb a:hover {
      color: var(--glamoire-dark);
    }

    .premium-breadcrumb span {
      color: var(--text-muted);
      font-size: 0.85rem;
      margin: 0 8px;
    }

    .premium-breadcrumb .active-page {
      color: var(--glamoire-dark);
      font-weight: 600;
      font-size: 0.85rem;
    }

    /* --- Main Article Area --- */
    .article-container {
      display: flex;
      gap: 3rem;
      align-items: flex-start; /* Mencegah sidebar meregang mengikuti tinggi konten */
    }

    .article-main-content {
      flex: 1;
      min-width: 0;
    }

    /* --- Sidebar (Related Articles) --- */
    .article-sidebar {
      flex: 0 0 350px; /* Sidebar tetap di 350px secara presisi */
      max-width: 350px;
      position: sticky;
      top: 100px;
    }

    /* Kalkulasi ruang sisa untuk artikel agar tidak didominasi sidebar */
    @media (min-width: 992px) {
      .article-main-content {
        max-width: calc(100% - 350px - 3rem);
      }
    }

    @media (max-width: 991px) {
      .article-container {
        flex-direction: column;
      }
      .article-main-content, .article-sidebar {
        max-width: 100%;
        flex: 1 1 100%;
      }
      .article-sidebar {
        position: static;
        margin-top: 1rem;
      }
    }

    /* Article Header */
    .article-meta-top {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 1rem;
    }

    .article-category-badge {
      background: var(--glamoire-dark);
      color: #FFF;
      padding: 4px 12px;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .article-date {
      color: var(--text-muted);
      font-size: 0.9rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .article-title {
      font-family: 'The Seasons', serif;
      font-size: clamp(2rem, 4vw, 3.5rem);
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
      margin-bottom: 1.5rem;
    }

    .article-author {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 2.5rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid var(--border-color);
    }

    .author-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: var(--glamoire-sand);
      color: var(--glamoire-dark);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      font-weight: 700;
      font-family: 'The Seasons', serif;
    }

    .author-info h6 {
      margin: 0;
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-main);
      font-family: 'Poppins', sans-serif;
    }

    .author-info p {
      margin: 0;
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    /* Article Body - PERBAIKAN IMAGE */
    .article-hero-image {
      width: 100%;
      height: auto;
      max-height: 70vh; /* Agar gambar vertikal tidak menutupi seluruh layar */
      border-radius: 16px;
      margin-bottom: 2.5rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      object-fit: contain; /* Menggunakan contain agar tidak ada yang terpotong */
      background-color: var(--glamoire-light); /* Latar estetik jika gambar aslinya kecil */
    }

    .blog-post-content {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #374151;
      margin-bottom: 3rem;
    }

    .blog-post-content p {
      margin-bottom: 1.5rem;
    }

    .blog-post-content h2,
    .blog-post-content h3,
    .blog-post-content h4 {
      font-family: 'The Seasons', serif;
      color: var(--glamoire-dark);
      margin-top: 2.5rem;
      margin-bottom: 1rem;
      font-weight: 700;
    }

    /* Support image dalam body artikel */
    .blog-post-content img {
      border-radius: 12px;
      margin: 2rem auto;
      display: block;
      width: 100%;
      height: auto;
      max-height: 600px;
      object-fit: contain;
    }

    /* Share Section */
    .article-share {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 2rem 0;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }

    .share-text {
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-main);
      margin: 0;
    }

    .share-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--glamoire-light);
      color: var(--text-main);
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      transition: var(--transition-smooth);
      font-size: 1.1rem;
    }

    .share-btn:hover {
      background: var(--glamoire-dark);
      color: #FFF;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(24, 48, 24, 0.2);
    }

    /* --- Sidebar Widgets --- */
    .sidebar-widget {
      background: #FFF;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
      border: 1px solid #F3F4F6;
      overflow: hidden; /* Mencegah elemen anak luber */
    }

    .widget-title {
      font-family: 'The Seasons', serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--glamoire-dark);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Scrollable Tabs in Sidebar */
    .sidebar-tabs {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      gap: 10px;
      margin-bottom: 1.5rem;
      padding-bottom: 5px;
    }

    .sidebar-tabs::-webkit-scrollbar {
      display: none;
    }

    .sidebar-tab-btn {
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 500;
      color: var(--text-muted);
      background: var(--glamoire-light);
      border: 1px solid transparent;
      white-space: nowrap;
      transition: var(--transition-smooth);
      text-decoration: none;
      cursor: pointer;
    }

    .sidebar-tab-btn:hover,
    .sidebar-tab-btn.active {
      background: var(--glamoire-dark);
      color: #FFF;
      border-color: var(--glamoire-dark);
    }

    /* Small Article Cards in Sidebar (Refined for better UX) */
    .side-article-card {
      display: flex;
      gap: 15px;
      margin-bottom: 1rem;
      text-decoration: none;
      transition: var(--transition-smooth);
      padding: 10px;
      border-radius: 12px;
      border: 1px solid #F9FAFB;
      background: #FFF;
    }

    .side-article-card:last-child {
      margin-bottom: 0;
    }

    .side-article-card:hover {
      background: var(--glamoire-light);
      border-color: var(--glamoire-gold);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .side-article-img {
      width: 85px;
      height: 85px;
      border-radius: 8px;
      flex-shrink: 0;
      overflow: hidden;
      background: var(--glamoire-light);
    }

    .side-article-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .side-article-info {
      display: flex;
      flex-direction: column;
      justify-content: center;
      flex: 1;
      min-width: 0; /* Penting agar text-truncate bekerja di flexbox */
    }

    .side-article-cat {
      font-size: 0.7rem;
      color: var(--glamoire-gold);
      text-transform: uppercase;
      font-weight: 700;
      margin-bottom: 0.3rem;
    }

    .side-article-title {
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-main);
      line-height: 1.4;
      margin-bottom: 0.3rem;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
    }

    .side-article-date {
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    /* Empty State Sidebar */
    .empty-sidebar {
      text-align: center;
      padding: 2rem 0;
      opacity: 0.7;
    }

    .empty-sidebar img {
      width: 120px;
      margin-bottom: 1rem;
    }

    .empty-sidebar p {
      font-size: 0.9rem;
      color: var(--text-muted);
      margin: 0;
    }
  </style>

  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

    <div class="container-fluid reveal-on-scroll">
      <div class="premium-breadcrumb">
        <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
        <span>/</span>
        <a href="/newsletter">Jurnal</a>
        <span>/</span>
        <a href="#">{{ $article->categoryArticle->name }}</a>
        <span>/</span>
        <span class="active-page d-inline-block text-truncate"
          style="max-width: 200px; vertical-align: bottom;">{{ $article->title }}</span>
      </div>
    </div>

    <div class="container-fluid">
      <div class="article-container">

        <div class="article-main-content">

          <div class="article-meta-top reveal-on-scroll delay-100">
            <span class="article-category-badge">{{ $article->categoryArticle->name }}</span>
            <span class="article-date"><i class="far fa-calendar-alt"></i>
              {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span>
          </div>

          <h1 class="article-title reveal-on-scroll delay-200">{{ $article->title }}</h1>

          <div class="article-author reveal-on-scroll delay-300">
            <div class="author-avatar">G</div>
            <div class="author-info">
              <h6>Admin Glamoire</h6>
              <p>Beauty & Wellness Editor</p>
            </div>
          </div>

          <article class="reveal-on-scroll">
            @if($article->image)
              <img class="article-hero-image" src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}">
            @endif

            <div class="blog-post-content reveal-on-scroll delay-100">
              {!! $article->content !!}
            </div>
          </article>

          <div class="article-share reveal-on-scroll delay-200">
            <p class="share-text">Bagikan artikel ini:</p>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
              title="Share on Facebook" target="_blank" class="share-btn">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
              title="Share on Twitter" target="_blank" class="share-btn">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
              title="Share on WhatsApp" target="_blank" class="share-btn" style="color:#25D366;">
              <i class="fab fa-whatsapp"></i>
            </a>
          </div>

        </div>

        <div class="article-sidebar reveal-on-scroll delay-200">
          <div class="sidebar-widget">
            <h3 class="widget-title"><i class="fas fa-book-open"></i> Baca Juga</h3>

            <nav class="sidebar-tabs nav" id="nav-tab" role="tablist">
              <a class="sidebar-tab-btn active" data-bs-toggle="tab" href="#all-articles" role="tab"
                aria-selected="true">Semua</a>
              @foreach ($categoryArticles as $category)
                <a class="sidebar-tab-btn" data-bs-toggle="tab" href="#cat-{{ Str::slug($category->name) }}" role="tab"
                  aria-selected="false">
                  {{ $category->name }}
                </a>
              @endforeach
            </nav>

            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="all-articles" role="tabpanel">
                @if (count($articles) > 0)
                  @foreach ($articles->take(5) as $sideArticle)
                    <a href="/{{ $sideArticle->title }}_detailnewsletter" class="side-article-card">
                      <div class="side-article-img">
                        <img
                          src="{{ $sideArticle->image ? Storage::url($sideArticle->image) : asset('images/no-image.png') }}"
                          alt="{{ $sideArticle->title }}">
                      </div>
                      <div class="side-article-info">
                        <span class="side-article-cat">{{ optional($sideArticle->categoryArticle)->name ?? 'Artikel' }}</span>
                        <h4 class="side-article-title">{{ $sideArticle->title }}</h4>
                        <span
                          class="side-article-date">{{ \Carbon\Carbon::parse($sideArticle->created_at)->translatedFormat('d M Y') }}</span>
                      </div>
                    </a>
                  @endforeach
                @else
                  <div class="empty-sidebar">
                    <img src="{{ asset('images/about-1.png') }}" alt="Kosong">
                    <p>Belum ada artikel terbaru.</p>
                  </div>
                @endif
              </div>

              @foreach ($categoryArticles as $category)
                <div class="tab-pane fade" id="cat-{{ Str::slug($category->name) }}" role="tabpanel">
                  @if (count($category->articles) > 0)
                    @foreach ($category->articles->take(5) as $sideArticleCat)
                      <a href="/{{ $sideArticleCat->title }}_detailnewsletter" class="side-article-card">
                        <div class="side-article-img">
                          <img
                            src="{{ $sideArticleCat->image ? Storage::url($sideArticleCat->image) : asset('images/no-image.png') }}"
                            alt="{{ $sideArticleCat->title }}">
                        </div>
                        <div class="side-article-info">
                          <span class="side-article-cat">{{ $category->name }}</span>
                          <h4 class="side-article-title">{{ $sideArticleCat->title }}</h4>
                          <span
                            class="side-article-date">{{ \Carbon\Carbon::parse($sideArticleCat->created_at)->translatedFormat('d M Y') }}</span>
                        </div>
                      </a>
                    @endforeach
                  @else
                    <div class="empty-sidebar">
                      <img src="{{ asset('images/about-1.png') }}" alt="Kosong">
                      <p>Belum ada artikel di kategori ini.</p>
                    </div>
                  @endif
                </div>
              @endforeach

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const observerOptions = {
              root: null,
              rootMargin: '0px',
              threshold: 0.1 // Elemen muncul saat 10% terlihat di layar
          };

          const observer = new IntersectionObserver((entries, observer) => {
              entries.forEach(entry => {
                  if (entry.isIntersecting) {
                      entry.target.classList.add('is-visible');
                      observer.unobserve(entry.target); // Memastikan animasi hanya berjalan 1x
                  }
              });
          }, observerOptions);

          document.querySelectorAll('.reveal-on-scroll').forEach(el => {
              observer.observe(el);
          });
      });
  </script>

@endsection

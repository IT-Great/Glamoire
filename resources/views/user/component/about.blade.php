{{-- @extends('user.layouts.master')

@section('content')
    <style>
        /* ==========================================
           WORLD CLASS ABOUT US STYLING
           ========================================== */
        :root {
            --glamoire-dark: #183018;
            --glamoire-light: #F9FAFB;
            --glamoire-accent: #2A4D2A;
            --glamoire-gold: #D4AF37;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --transition-smooth: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Hero Section Cinematic --- */
        .about-hero {
            position: relative;
            height: 70vh;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Parallax effect */
            color: #FFF;
            margin-bottom: 5rem;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(24,48,24,0.7) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-title {
            font-family: 'The Seasons', serif;
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            letter-spacing: 1px;
        }

        .hero-desc {
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 300;
            line-height: 1.8;
            opacity: 0.9;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        /* --- Content Sections (Z-Pattern Layout) --- */
        .story-section {
            padding: 5rem 0;
        }

        .story-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 4rem;
            margin-bottom: 6rem;
        }
        .story-row:last-child {
            margin-bottom: 0;
        }

        /* Reverse order for alternating layout */
        .story-row.reverse {
            flex-direction: row-reverse;
        }

        .story-media {
            flex: 1 1 45%;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .story-media::after {
            content: '';
            display: block;
            padding-bottom: 100%; /* 1:1 Aspect ratio default */
        }

        .story-media img, .story-media video {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }
        .story-media:hover img {
            transform: scale(1.05);
        }

        .story-text {
            flex: 1 1 45%;
            padding: 2rem 0;
        }

        .section-label {
            color: var(--glamoire-gold);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: block;
        }

        .story-title {
            font-family: 'The Seasons', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .story-desc {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--text-muted);
            text-align: justify;
        }

        /* --- Call to Action Footer --- */
        .cta-section {
            background: linear-gradient(135deg, var(--glamoire-light) 0%, #eef5eb 100%);
            padding: 6rem 2rem;
            text-align: center;
            margin-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .cta-title {
            font-family: 'The Seasons', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1rem;
        }

        .cta-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-premium {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary-dark {
            background: var(--glamoire-dark);
            color: #FFF;
            border: 2px solid var(--glamoire-dark);
        }
        .btn-primary-dark:hover {
            background: var(--glamoire-gold);
            border-color: var(--glamoire-gold);
            color: #FFF;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
        }

        .btn-outline-dark {
            background: transparent;
            color: var(--glamoire-dark);
            border: 2px solid var(--glamoire-dark);
        }
        .btn-outline-dark:hover {
            background: var(--glamoire-dark);
            color: #FFF;
            transform: translateY(-3px);
        }

        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .story-row { gap: 2rem; }
            .story-media, .story-text { flex: 1 1 100%; }
            .story-row.reverse { flex-direction: column; }
            .story-media::after { padding-bottom: 60%; /* Taller ratio for mobile */ }
        }
    </style>

    <div class="about-hero" style="background-image: url('{{ Storage::url($data['hero_image'] ?? 'images/bg-mitra-new.png') }}');">
        <div class="hero-content">
            <h1 class="text-white hero-title">{{ $data['hero_title'] ?? 'Tentang Glamoire' }}</h1>
            <p class="hero-desc">{{ $data['hero_description'] ?? 'Temukan kisah di balik dedikasi kami untuk menghadirkan kecantikan vegan alami yang ramah lingkungan dan berkualitas tinggi.' }}</p>
        </div>
    </div>

    <div class="container pb-5 md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <div class="story-section">

            @if ($data->intro_title || $data->intro_description || $data->intro_image || $data->intro_video)
                <div class="story-row">
                    @if ($data->intro_image || $data->intro_video)
                        <div class="story-media">
                            @if ($data->intro_video)
                                @php $fileExt = pathinfo($data->intro_video, PATHINFO_EXTENSION); @endphp
                                @if (strtolower($fileExt) === 'gif')
                                    <img src="{{ asset('storage/' . $data->intro_video) }}" alt="Intro GIF">
                                @else
                                    <video controls autoplay muted loop playsinline>
                                        <source src="{{ asset('storage/' . $data->intro_video) }}" type="video/mp4">
                                    </video>
                                @endif
                            @elseif ($data->intro_image)
                                <img src="{{ Storage::url($data->intro_image) }}" alt="Introduction">
                            @endif
                        </div>
                    @endif

                    <div class="story-text">
                        <span class="section-label">Awal Mula</span>
                        @if ($data->intro_title)
                            <h2 class="story-title">{{ $data->intro_title }}</h2>
                        @endif
                        @if ($data->intro_description)
                            <p class="story-desc">{!! nl2br(e($data->intro_description)) !!}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($data->vision_title || $data->vision_description || $data->vision_image || $data->vision_video)
                <div class="story-row reverse">
                    @if ($data->vision_image || $data->vision_video)
                        <div class="story-media">
                            @if ($data->vision_video)
                                @php $fileExt = pathinfo($data->vision_video, PATHINFO_EXTENSION); @endphp
                                @if (strtolower($fileExt) === 'gif')
                                    <img src="{{ asset('storage/' . $data->vision_video) }}" alt="Vision GIF">
                                @else
                                    <video controls autoplay muted loop playsinline>
                                        <source src="{{ asset('storage/' . $data->vision_video) }}" type="video/mp4">
                                    </video>
                                @endif
                            @elseif ($data->vision_image)
                                <img src="{{ Storage::url($data->vision_image) }}" alt="Our Vision">
                            @endif
                        </div>
                    @endif

                    <div class="story-text">
                        <span class="section-label">Visi Kami</span>
                        @if ($data->vision_title)
                            <h2 class="story-title">{{ $data->vision_title }}</h2>
                        @endif
                        @if ($data->vision_description)
                            <p class="story-desc">{!! nl2br(e($data->vision_description)) !!}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($data->mission_title || $data->mission_description || $data->mission_image || $data->mission_video)
                <div class="story-row">
                    @if ($data->mission_image || $data->mission_video)
                        <div class="story-media">
                            @if ($data->mission_video)
                                @php $fileExt = pathinfo($data->mission_video, PATHINFO_EXTENSION); @endphp
                                @if (strtolower($fileExt) === 'gif')
                                    <img src="{{ asset('storage/' . $data->mission_video) }}" alt="Mission GIF">
                                @else
                                    <video controls autoplay muted loop playsinline>
                                        <source src="{{ asset('storage/' . $data->mission_video) }}" type="video/mp4">
                                    </video>
                                @endif
                            @elseif ($data->mission_image)
                                <img src="{{ Storage::url($data->mission_image) }}" alt="Our Mission">
                            @endif
                        </div>
                    @endif

                    <div class="story-text">
                        <span class="section-label">Misi Kami</span>
                        @if ($data->mission_title)
                            <h2 class="story-title">{{ $data->mission_title }}</h2>
                        @endif
                        @if ($data->mission_description)
                            <p class="story-desc">{!! nl2br(e($data->mission_description)) !!}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($data->story_title || $data->story_description || $data->story_image || $data->story_video)
                <div class="story-row reverse">
                    @if ($data->story_image || $data->story_video)
                        <div class="story-media">
                            @if ($data->story_video)
                                @php $fileExt = pathinfo($data->story_video, PATHINFO_EXTENSION); @endphp
                                @if (strtolower($fileExt) === 'gif')
                                    <img src="{{ asset('storage/' . $data->story_video) }}" alt="Story GIF">
                                @else
                                    <video controls autoplay muted loop playsinline>
                                        <source src="{{ asset('storage/' . $data->story_video) }}" type="video/mp4">
                                    </video>
                                @endif
                            @elseif ($data->story_image)
                                <img src="{{ Storage::url($data->story_image) }}" alt="Our Story">
                            @endif
                        </div>
                    @endif

                    <div class="story-text">
                        <span class="section-label">Perjalanan</span>
                        @if ($data->story_title)
                            <h2 class="story-title">{{ $data->story_title }}</h2>
                        @endif
                        @if ($data->story_description)
                            <p class="story-desc">{!! nl2br(e($data->story_description)) !!}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($data->achievement_title || $data->achievement_description || $data->achievement_image || $data->achievement_video)
                <div class="story-row">
                    @if ($data->achievement_image || $data->achievement_video)
                        <div class="story-media">
                            @if ($data->achievement_video)
                                @php $fileExt = pathinfo($data->achievement_video, PATHINFO_EXTENSION); @endphp
                                @if (strtolower($fileExt) === 'gif')
                                    <img src="{{ asset('storage/' . $data->achievement_video) }}" alt="Achievement GIF">
                                @else
                                    <video controls autoplay muted loop playsinline>
                                        <source src="{{ asset('storage/' . $data->achievement_video) }}" type="video/mp4">
                                    </video>
                                @endif
                            @elseif ($data->achievement_image)
                                <img src="{{ Storage::url($data->achievement_image) }}" alt="Our Achievement">
                            @endif
                        </div>
                    @endif

                    <div class="story-text">
                        <span class="section-label">Pencapaian</span>
                        @if ($data->achievement_title)
                            <h2 class="story-title">{{ $data->achievement_title }}</h2>
                        @endif
                        @if ($data->achievement_description)
                            <p class="story-desc">{!! nl2br(e($data->achievement_description)) !!}</p>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>

    <section class="cta-section">
        <div class="container">
            <h3 class="cta-title">Tumbuh Bersama Glamoire</h3>
            <p class="cta-desc">Kami percaya bahwa kecantikan sejati dimulai dari langkah-langkah kecil yang berdampak besar. Baik Anda seorang pelanggan yang mencari produk vegan berkualitas, maupun pebisnis yang ingin menjadi mitra, kami siap menyambut Anda.</p>
            <div class="btn-cta-group">
                <a href="/shop" class="btn-premium btn-primary-dark">
                    <i class="fas fa-shopping-bag"></i> Mulai Belanja
                </a>
                <a href="/partner" class="btn-premium btn-outline-dark">
                    <i class="fas fa-handshake"></i> Gabung Kemitraan
                </a>
            </div>
        </div>
    </section>

@endsection --}}

@extends('user.layouts.master')

@section('content')
    <style>
        /* ==========================================
           WORLD CLASS ABOUT US STYLING (UI/UX REVAMP)
           ========================================== */
        :root {
            --glamoire-dark: #183018;
            --glamoire-light: #F9FAFB;
            --glamoire-accent: #2A4D2A;
            --glamoire-gold: #D4AF37;
            --glamoire-sand: #F7F5F0;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --transition-smooth: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cormorant Garamond', 'The Seasons', serif;
        }

        /* --- Scroll Reveal Animations --- */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .section-label {
            color: var(--glamoire-gold);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 0.75rem;
            margin-bottom: 1rem;
            display: block;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .section-title-editorial {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            color: var(--glamoire-dark);
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        /* --- Hero Section Cinematic --- */
        .about-hero {
            position: relative;
            height: 60vh;
            min-height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #FFF;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(24,48,24,0.8) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-title {
            font-size: clamp(3.5rem, 6vw, 5.5rem);
            font-weight: 600;
            margin-bottom: 1rem;
            line-height: 1.1;
            letter-spacing: 1px;
        }

        /* --- 1. OUR STORY & TIMELINE --- */
        .story-section {
            padding: 7rem 0;
            background-color: #FFF;
        }

        .story-content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 5rem;
            align-items: center;
        }

        .story-text-area {
            flex: 1 1 50%;
            min-width: 300px;
        }

        .story-text-area p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .story-text-area blockquote {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-style: italic;
            color: var(--glamoire-dark);
            border-left: 2px solid var(--glamoire-gold);
            padding-left: 1.5rem;
            margin: 2rem 0;
            line-height: 1.4;
        }

        .timeline-area {
            flex: 1 1 35%;
            min-width: 300px;
            background: var(--glamoire-sand);
            padding: 4rem 3rem;
            border-radius: 24px;
        }

        .timeline-item {
            position: relative;
            padding-left: 2.5rem;
            margin-bottom: 3rem;
        }
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--glamoire-gold);
            z-index: 2;
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 15px;
            bottom: -3rem;
            width: 2px;
            background: rgba(212, 175, 55, 0.3);
            z-index: 1;
        }
        .timeline-item:last-child::after {
            display: none;
        }

        .timeline-year {
            font-size: 1.4rem;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 0.3rem;
            line-height: 1;
        }
        .timeline-desc {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin: 0;
        }

        /* --- 2. VISION & MISSION SECTION --- */
        .purpose-section {
            padding: 7rem 0;
            background-color: var(--glamoire-dark);
            color: #FFF;
            text-align: center;
        }

        .purpose-vision {
            max-width: 800px;
            margin: 0 auto 5rem;
        }

        .purpose-vision h3 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 400;
            line-height: 1.5;
            color: #FFF;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: left;
        }

        .mission-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2.5rem 2rem;
            border-radius: 20px;
            transition: var(--transition-smooth);
        }
        .mission-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .mission-icon {
            font-size: 2.5rem;
            color: var(--glamoire-gold);
            margin-bottom: 1.5rem;
        }
        .mission-title {
            font-size: 1.25rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #FFF;
        }
        .mission-desc {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 1200px) {
            .mission-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 576px) {
            .mission-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .mission-card { padding: 2rem 1.5rem; text-align: center; }
            .mission-title { font-size: 1.15rem; }
        }

        /* --- 3. DISCOVER BEAUTY (SHOP/CATEGORIES) --- */
        .discover-section {
            padding: 7rem 0;
            background: #FFF;
        }

        .discover-header {
            max-width: 600px;
            margin-bottom: 4rem;
        }

        .discover-header p {
            font-size: 1.05rem;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .category-showcase-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .cat-showcase-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/5;
            cursor: pointer;
            background: var(--glamoire-sand);
        }

        .cat-showcase-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.5s ease;
        }

        .cat-showcase-card:hover img {
            transform: scale(1.05);
        }

        .cat-showcase-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem 1.5rem;
            z-index: 2;
        }

        .cat-showcase-title {
            color: #FFF;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-family: 'Cormorant Garamond', serif;
        }

        .cat-showcase-tagline {
            color: var(--glamoire-gold);
            font-size: 0.85rem;
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s ease;
        }

        .cat-showcase-card:hover .cat-showcase-tagline {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 991px) {
            .category-showcase-grid { grid-template-columns: repeat(2, 1fr); }
            .cat-showcase-tagline { opacity: 1; transform: none; } /* Always show on mobile */
        }
        @media (max-width: 576px) {
            .category-showcase-grid { gap: 1rem; }
            .cat-showcase-overlay { padding: 1.5rem 1rem; }
            .cat-showcase-title { font-size: 1.3rem; }
        }

        /* --- 4. WHY GLAMOIRE SECTION --- */
        .why-section {
            padding: 7rem 0;
            background: var(--glamoire-sand);
        }

        .why-wrapper {
            display: flex;
            align-items: center;
            gap: 6rem;
        }

        .why-image-area {
            flex: 0 0 45%;
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 4/5;
        }

        .why-image-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .why-content-area {
            flex: 1;
        }

        .why-list {
            list-style: none;
            padding: 0;
            margin: 0;
            margin-top: 3rem;
        }

        .why-item {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .why-item:last-child { margin-bottom: 0; }

        .why-item-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--glamoire-dark);
            color: var(--glamoire-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .why-item-content h4 {
            font-size: 1.2rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 0.5rem;
        }

        .why-item-content p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin: 0;
        }

        @media (max-width: 991px) {
            .why-wrapper { flex-direction: column; gap: 3rem; }
            .why-image-area { width: 100%; aspect-ratio: 16/9; }
        }

        /* --- 5. COMMUNITY CTA SECTION --- */
        .community-section {
            padding: 8rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, #FFFFFF 0%, #F4F7F4 100%);
            border-top: 1px solid var(--border-color);
        }

        .community-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .community-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            color: var(--glamoire-dark);
            font-weight: 600;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .community-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 3rem;
        }

        .btn-cta-primary {
            background: var(--glamoire-dark);
            color: #FFF;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-decoration: none;
            transition: var(--transition-smooth);
            display: inline-block;
        }
        .btn-cta-primary:hover {
            background: var(--glamoire-gold);
            color: var(--glamoire-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

    </style>

    <!-- HERO SECTION -->
    <div class="about-hero" style="background-image: url('{{ Storage::url($data['hero_image'] ?? 'images/bg-mitra-new.png') }}');">
        <div class="hero-content reveal active">
            <span class="mb-3 text-white section-label d-block" style="letter-spacing: 3px;">About Us</span>
            <h1 class="text-white hero-title">Our Story</h1>
        </div>
    </div>

    <!-- 1. OUR STORY & TIMELINE -->
    <section class="story-section reveal">
        <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">
            <div class="story-content-wrapper">
                <div class="story-text-area">
                    <span class="section-label">Our Journey</span>
                    <h2 class="section-title-editorial">Our Journey</h2>

                    <blockquote>
                        “Why isn’t there a trusted space in Indonesia where beauty and sustainability truly come together?”
                    </blockquote>

                    <p>
                        Glamoire began with that simple question. More people are becoming mindful of the products they use every day — not only for their skin, but also for the impact they leave on the world around them. Yet finding beauty products that are plant-based, cruelty-free, and genuinely trustworthy still feels overwhelming.
                    </p>
                    <p>
                        That’s where Glamoire started.
                    </p>
                    <p>
                        Glamoire was created to become a thoughtful destination for vegan beauty in Indonesia — curating skincare and beauty essentials that align with a more mindful lifestyle, from plant-based ingredients and cruelty-free products to brands that share the same sustainability values. We believe beauty should feel gentle, intentional, and in harmony with nature. Because every small choice in your everyday beauty ritual can contribute to a more beautiful and sustainable future.
                    </p>
                </div>

                <div class="timeline-area">
                    <div class="timeline-item">
                        <div class="timeline-year">2021</div>
                        <p class="timeline-desc">The Idea Was Born.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2022–2024</div>
                        <p class="timeline-desc">Building Curated Vegan Marketplace & Local Bazaar Events.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2025</div>
                        <p class="timeline-desc">First Glamoire Pop-Up Store in Surabaya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. VISION & MISSION -->
    <section class="purpose-section reveal">
        <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">

            <div class="purpose-vision">
                <span class="section-label" style="color: var(--glamoire-gold-light);">Our Purpose</span>
                <h2 class="mb-4 text-white section-title-editorial">Vision</h2>
                <h3>To redefine beauty in Indonesia by creating a more mindful, sustainable, and empowering beauty experience for everyone.</h3>
            </div>

            <div class="mission-grid">
                <div class="mission-card">
                    <i class="fas fa-leaf mission-icon"></i>
                    <h4 class="mission-title">Thoughtfully Curated Beauty</h4>
                    <p class="mission-desc">Curating plant-based and cruelty-free beauty products that feel gentler for both skin and the environment.</p>
                </div>
                <div class="mission-card">
                    <i class="fas fa-users mission-icon"></i>
                    <h4 class="mission-title">Conscious Beauty Community</h4>
                    <p class="mission-desc">Building a community of beauty lovers who believe beauty and sustainability can coexist beautifully.</p>
                </div>
                <div class="mission-card">
                    <i class="fas fa-spa mission-icon"></i>
                    <h4 class="mission-title">Mindful Self-Care</h4>
                    <p class="mission-desc">Inspiring women to embrace healthier, more confident, and more intentional self-care through conscious beauty choices.</p>
                </div>
                <div class="mission-card">
                    <i class="fas fa-globe-asia mission-icon"></i>
                    <h4 class="mission-title">Sustainable Innovation</h4>
                    <p class="mission-desc">Continuously evolving to create a more modern, elegant, and eco-conscious beauty retail experience in Indonesia.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. SHOP / CATEGORIES SHOWCASE -->
    <section class="discover-section reveal">
        <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">
            <div class="discover-header">
                <span class="section-label">Categories</span>
                <h2 class="section-title-editorial">Discover Beauty with Purpose</h2>
                <p>Every product at Glamoire is more than just beauty — it’s part of a more mindful, comforting, and meaningful self-care ritual. We thoughtfully curate beauty essentials designed to elevate everyday routines with formulas that feel gentle, aesthetic, and intentionally selected.</p>
            </div>

            <!-- Anda bisa mengganti static image url di bawah ini menggunakan asset atau relasi data kategori -->
            <div class="category-showcase-grid">
                <div class="cat-showcase-card" onclick="window.location.href='/shop'">
                    <img src="{{ asset('images/dummy-skincare.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=600&auto=format&fit=crop'" alt="Skincare">
                    <div class="cat-showcase-overlay">
                        <h4 class="cat-showcase-title">Skincare</h4>
                        <span class="cat-showcase-tagline">"Healthy glow for everyday skin."</span>
                    </div>
                </div>
                <div class="cat-showcase-card" onclick="window.location.href='/shop'">
                    <img src="{{ asset('images/dummy-haircare.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1522337660859-02fbefca4702?q=80&w=600&auto=format&fit=crop'" alt="Haircare">
                    <div class="cat-showcase-overlay">
                        <h4 class="cat-showcase-title">Haircare</h4>
                        <span class="cat-showcase-tagline">"Frizz-free hair in seconds."</span>
                    </div>
                </div>
                <div class="cat-showcase-card" onclick="window.location.href='/shop'">
                    <img src="{{ asset('images/dummy-bodycare.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?q=80&w=600&auto=format&fit=crop'" alt="Bodycare">
                    <div class="cat-showcase-overlay">
                        <h4 class="cat-showcase-title">Bodycare</h4>
                        <span class="cat-showcase-tagline">"Gentle care for your daily ritual."</span>
                    </div>
                </div>
                <div class="cat-showcase-card" onclick="window.location.href='/shop'">
                    <img src="{{ asset('images/dummy-accessories.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1596462502278-27bf85033e5a?q=80&w=600&auto=format&fit=crop'" alt="Beauty Accessories">
                    <div class="cat-showcase-overlay">
                        <h4 class="cat-showcase-title">Accessories</h4>
                        <span class="cat-showcase-tagline">"Aesthetic essentials for mindful living."</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. WHY GLAMOIRE -->
    <section class="why-section reveal">
        <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">
            <div class="why-wrapper">

                <div class="why-image-area">
                    <!-- Gunakan dynamic image dari database jika tersedia, fallback ke dummy Unsplash -->
                    <img src="{{ isset($data->intro_image) ? Storage::url($data->intro_image) : 'https://images.unsplash.com/photo-1556228720-1c2f6bb47306?q=80&w=800&auto=format&fit=crop' }}" alt="Why Glamoire">
                </div>

                <div class="why-content-area">
                    <span class="section-label">Value</span>
                    <h2 class="section-title-editorial">Why Choose Glamoire?</h2>

                    <ul class="why-list">
                        <li class="why-item">
                            <div class="why-item-icon"><i class="fas fa-seedling"></i></div>
                            <div class="why-item-content">
                                <h4>Plant-Based & Cruelty-Free</h4>
                                <p>Thoughtfully selected beauty products with gentle formulas that are kinder to your skin and the environment.</p>
                            </div>
                        </li>
                        <li class="why-item">
                            <div class="why-item-icon"><i class="fas fa-recycle"></i></div>
                            <div class="why-item-content">
                                <h4>Eco-Conscious Beauty</h4>
                                <p>Supporting beauty brands that embrace more sustainable and mindful practices.</p>
                            </div>
                        </li>
                        <li class="why-item">
                            <div class="why-item-icon"><i class="fas fa-gem"></i></div>
                            <div class="why-item-content">
                                <h4>Curated With Care</h4>
                                <p>Every product and brand is carefully selected to create a more elevated and trustworthy beauty shopping experience.</p>
                            </div>
                        </li>
                        <li class="why-item">
                            <div class="why-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="why-item-content">
                                <h4>Indonesia’s Vegan Beauty Destination</h4>
                                <p>A growing destination for vegan and conscious beauty lovers in Indonesia.</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. COMMUNITY CTA -->
    <section class="community-section reveal">
        <div class="container">
            <div class="community-content">
                <span class="text-center section-label">Community</span>
                <h2 class="community-title">More than Beauty — A Movement</h2>
                <p class="community-desc">
                    At Glamoire, beauty is more than appearance — it’s about caring for yourself, the environment, and the people around you. More than just a beauty store, Glamoire is building a conscious beauty community through education, meaningful campaigns, and stories about self-care, sustainability, and mindful living. Because every small step toward better beauty choices can also become part of a bigger change.
                </p>
                <a href="/register" class="btn-cta-primary">Join Our Community</a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for Reveal Animation
            const revealElements = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            });

            revealElements.forEach(el => revealObserver.observe(el));
        });
    </script>
@endsection

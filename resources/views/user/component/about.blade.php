@extends('user.layouts.master')

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
            <h1 class="hero-title text-white">{{ $data['hero_title'] ?? 'Tentang Glamoire' }}</h1>
            <p class="hero-desc">{{ $data['hero_description'] ?? 'Temukan kisah di balik dedikasi kami untuk menghadirkan kecantikan vegan alami yang ramah lingkungan dan berkualitas tinggi.' }}</p>
        </div>
    </div>

    <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48 pb-5">

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

@endsection
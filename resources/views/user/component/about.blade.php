@extends('user.layouts.master')

@section('content')
    <style>
        .about-section {
            position: relative;
            overflow: hidden;
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(24, 48, 24, 0.2), transparent);
            margin: 60px 0;
        }

        .elegant-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            text-align: justify;
        }

        .elegant-card .about-section-title {
            text-align: center;
            display: block;
        }

        .elegant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Green card for Vision and Story sections */
        .elegant-card-green {
            background: linear-gradient(135deg, #183018, #2d5a2d);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            text-align: justify;
            color: white;
        }

        .elegant-card-green .about-section-title {
            text-align: center;
            display: block;
            color: white;
        }

        .elegant-card-green .about-section-title::after {
            background: linear-gradient(90deg, #a8d5a8, #76fb76);
        }

        .elegant-card-green:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .elegant-card-green .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .elegant-card-green .feature-icon {
            background: white;
            display: flex;
            /* gunakan flexbox untuk center */
            align-items: center;
            /* vertical center */
            justify-content: center;
            /* horizontal center */
            border-radius: 50%;
            margin: 0 auto;
            /* center lingkaran di parent */
        }

        .elegant-card-green .feature-icon i {
            color: #183018;
            /* hijau untuk icon */
            font-size: 30px;
            /* bisa sesuaikan ukuran icon */
        }


        .image-container {
            position: relative;
            overflow: hidden;
        }

        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(24, 48, 24, 0.1), transparent);
            z-index: 1;
        }

        .image-container img {
            transition: transform 0.3s ease;
        }

        .image-container:hover img {
            transform: scale(1.05);
        }

        .content-overlay {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(243, 247, 242, 0.9));
            backdrop-filter: blur(10px);
        }

        .about-section-title {
            position: relative;
            display: inline-block;
            font-weight: 700;
            font-size: 28px;
            color: #183018;
            margin-bottom: 20px;
            max-width: 100%;
            word-wrap: break-word;
            text-align: center;
        }

        .about-section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #183018, #4a7c59);
            border-radius: 2px;
        }

        /* Hero Section Styles */
        .breadcrumb-item a {
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: #76fb76c0 !important;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            border-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #183018, #4a7c59);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
        }

        .stats-section {
            background: linear-gradient(135deg, #183018, #2d5a2d);
            border-radius: 20px;
            color: white;
            padding: 60px 0;
            margin: 80px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #a8d5a8;
            display: block;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .hero-section {
                height: 80vh !important;
            }
        }
    </style>

    <!-- Hero Section with Background Image -->
    <div class="hero-section position-relative text-white"
        style="background-image: url('{{ Storage::url($data['hero_image']) }}'); background-size: cover; background-position: center; height: 100vh;">

        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.0);"></div>

        <div class="container position-relative z-1 h-100 d-flex align-items-center">
            <div class="col-lg-8">

                {{-- Title --}}
                <h1 class="mb-3"
                    style="font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 500; letter-spacing: 0.5px; background: linear-gradient(180deg, #eaa11b 0%, #dea63d 100%); -webkit-background-clip: text; color: transparent; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);">
                    {{ $data['hero_title'] }}
                </h1>

                {{-- Konten --}}
                <div class="p-4 shadow" style="background-color: rgba(215, 226, 201, 0.6); border-radius: 1rem;">
                    {{-- Description --}}
                    <p class="mb-4"
                        style="
                        font-size: 1rem; 
                        line-height: 1.6; 
                        color: #2e7d32; 
                        font-weight: 700;
                        text-align: justify;">
                        {{ $data['hero_description'] }}
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="container my-5">
        <!-- Intro Section -->
        @if ($data->intro_title || $data->intro_description || $data->intro_image || $data->intro_video)
            <section class="about-section mb-5">
                <div class="row align-items-center">
                    @if ($data->intro_image || $data->intro_video)
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            @if ($data->intro_video)
                                <div class="shadow">
                                    @php
                                        $fileExtension = pathinfo($data->intro_video, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (strtolower($fileExtension) === 'gif')
                                        {{-- Tampilkan GIF --}}
                                        <img src="{{ asset('storage/' . $data->intro_video) }}" class="img-fluid"
                                            alt="Intro GIF"
                                            style="border-radius: 2px; max-height: 500px; width: 100%; object-fit: cover;">
                                    @else
                                        {{-- Tampilkan Video --}}
                                        <video width="100%" height="auto" controls autoplay muted loop playsinline
                                            style="border-radius: 2px; max-height: 500px; object-fit: cover;">
                                            <source src="{{ asset('storage/' . $data->intro_video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                            @elseif ($data->intro_image)
                                <div class="image-container shadow">
                                    <img src="{{ Storage::url($data->intro_image) }}" class="img-fluid" alt="Intro">
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="col-lg-{{ $data->intro_image || $data->intro_video ? '6' : '12' }}">
                        @if ($data->intro_title)
                            <h2 class="mb-2"
                                style="font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 500; letter-spacing: 0.5px; background: linear-gradient(180deg, #eaa11b 0%, #dea63d 100%); -webkit-background-clip: text; color: transparent; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15); text-align: center;">
                                {{ $data->intro_title }}
                            </h2>
                        @endif

                        @if ($data->intro_description)
                            <p class="mb-4"
                                style="font-size: 1rem; line-height: 1.9; color: #4a7c68; font-weight: 550; font-family: 'Inter', sans-serif; text-align: justify;">
                                {{ $data->intro_description }}
                            </p>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if (
            ($data->intro_title || $data->intro_description || $data->intro_image || $data->intro_video) &&
                ($data->vision_title || $data->vision_description || $data->vision_image || $data->vision_video))
            <div class="section-divider"></div>
        @endif


        <!-- Vision Section -->
        @if ($data->vision_title || $data->vision_description || $data->vision_image || $data->vision_video)
            <section class="about-section mb-5">
                <div class="row align-items-center">
                    @if ($data->vision_image || $data->vision_video)
                        <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                            @if ($data->vision_video)
                                <div class="shadow">
                                    @php
                                        $fileExtension = pathinfo($data->vision_video, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (strtolower($fileExtension) === 'gif')
                                        <img src="{{ asset('storage/' . $data->vision_video) }}" class="img-fluid"
                                            alt="Vision GIF"
                                            style="border-radius: 2px; max-height: 500px; width: 100%; object-fit: cover;">
                                    @else
                                        <video width="100%" height="auto" controls autoplay muted loop playsinline
                                            style="border-radius: 2px; max-height: 500px; object-fit: cover;">
                                            <source src="{{ asset('storage/' . $data->vision_video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                            @elseif ($data->vision_image)
                                <div class="image-container shadow">
                                    <img src="{{ Storage::url($data->vision_image) }}" class="img-fluid" alt="Vision">
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="col-lg-{{ $data->vision_image || $data->vision_video ? '6' : '12' }} order-lg-1">
                        @if ($data->vision_title)
                            <h2 class="mb-2"
                                style="font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 500; letter-spacing: 0.5px; background: linear-gradient(180deg, #eaa11b 0%, #dea63d 100%); -webkit-background-clip: text; color: transparent; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15); text-align: center;">
                                {{ $data->vision_title }}
                            </h2>
                        @endif
                        @if ($data->vision_description)
                            <div>
                                <p class="mb-4"
                                    style="font-size: 1rem; line-height: 1.6; color: #4a7c68; font-weight: 550; font-family: 'Inter', sans-serif; text-align: justify;">
                                    {{ $data->vision_description }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if (
            ($data->vision_title || $data->vision_description || $data->vision_image || $data->vision_video) &&
                ($data->mission_title || $data->mission_description || $data->mission_image || $data->mission_video))
            <div class="section-divider"></div>
        @endif

        <!-- Mission Section -->
        @if ($data->mission_title || $data->mission_description || $data->mission_image || $data->mission_video)
            <section class="about-section mb-5">
                <div class="row align-items-center">
                    @if ($data->mission_image || $data->mission_video)
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            @if ($data->mission_video)
                                <div class="shadow">
                                    @php
                                        $fileExtension = pathinfo($data->mission_video, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (strtolower($fileExtension) === 'gif')
                                        <img src="{{ asset('storage/' . $data->mission_video) }}" class="img-fluid"
                                            alt="Mission GIF"
                                            style="border-radius: 2px; max-height: 500px; width: 100%; object-fit: cover;">
                                    @else
                                        <video width="100%" height="auto" controls autoplay muted loop playsinline
                                            style="border-radius: 2px; max-height: 500px; object-fit: cover;">
                                            <source src="{{ asset('storage/' . $data->mission_video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                            @elseif ($data->mission_image)
                                <div class="image-container shadow">
                                    <img src="{{ Storage::url($data->mission_image) }}" class="img-fluid" alt="Mission">
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="col-lg-{{ $data->mission_image || $data->mission_video ? '6' : '12' }}">
                        @if ($data->mission_title)
                            <h2 class="mb-2"
                                style="font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 500; letter-spacing: 0.5px; background: linear-gradient(180deg, #eaa11b 0%, #dea63d 100%); -webkit-background-clip: text; color: transparent; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15); text-align: center;">
                                {{ $data->mission_title }}
                            </h2>
                        @endif
                        @if ($data->mission_description)
                            <p class="mb-4"
                                style="font-size: 1rem; line-height: 1.6; color: #4a7c68; font-weight: 550; font-family: 'Inter', sans-serif; text-align: justify;">
                                {{ $data->mission_description }}
                            </p>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if (
            ($data->mission_title || $data->mission_description || $data->mission_image || $data->mission_video) &&
                ($data->story_title || $data->story_description || $data->story_image || $data->story_video))
            <div class="section-divider"></div>
        @endif

        <!-- Story Section -->
        @if ($data->story_title || $data->story_description || $data->story_image || $data->story_video)
            <section class="about-section mb-5">
                <div class="row align-items-center">
                    @if ($data->story_image || $data->story_video)
                        <div class="col-lg-6 order-lg-2 mb-lg-0">
                            @if ($data->story_video)
                                <div class="shadow">
                                    @php
                                        $fileExtension = pathinfo($data->story_video, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (strtolower($fileExtension) === 'gif')
                                        <img src="{{ asset('storage/' . $data->story_video) }}" class="img-fluid"
                                            alt="Story GIF"
                                            style="border-radius: 2px; max-height: 500px; width: 100%; object-fit: cover;">
                                    @else
                                        <video width="100%" height="auto" controls autoplay muted loop playsinline
                                            style="border-radius: 2px; max-height: 500px; object-fit: cover;">
                                            <source src="{{ asset('storage/' . $data->story_video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                            @elseif ($data->story_image)
                                <div class="image-container shadow">
                                    <img src="{{ Storage::url($data->story_image) }}" class="img-fluid" alt="Story">
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="col-lg-{{ $data->story_image || $data->story_video ? '6' : '12' }} order-lg-1">
                        @if ($data->story_title)
                            <h2 class="mb-2"
                                style="font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 500; letter-spacing: 0.5px; background: linear-gradient(180deg, #eaa11b 0%, #dea63d 100%); -webkit-background-clip: text; color: transparent; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15); text-align: center;">
                                {{ $data->story_title }}
                            </h2>
                        @endif
                        @if ($data->story_description)
                            <div class="timeline-item">
                                <div class="d-flex align-items-start">
                                    <div>
                                        <p class="mb-4"
                                            style="font-size: 1rem; line-height: 1.6; color: #4a7c68; font-weight: 550; font-family: 'Inter', sans-serif; text-align: justify;">
                                            {{ $data->story_description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if (
            ($data->story_title || $data->story_description || $data->story_image || $data->story_video) &&
                ($data->achievement_title ||
                    $data->achievement_description ||
                    $data->achievement_image ||
                    $data->achievement_video))
            <div class="section-divider"></div>
        @endif

        <!-- Achievement Section -->
        @if ($data->achievement_title || $data->achievement_description || $data->achievement_image || $data->achievement_video)
            <section class="about-section mb-5">
                <div class="row align-items-center">
                    @if ($data->achievement_image || $data->achievement_video)
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            @if ($data->achievement_video)
                                <div class="shadow">
                                    @php
                                        $fileExtension = pathinfo($data->achievement_video, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (strtolower($fileExtension) === 'gif')
                                        <img src="{{ asset('storage/' . $data->achievement_video) }}" class="img-fluid"
                                            alt="Achievement GIF"
                                            style="border-radius: 2px; max-height: 500px; width: 100%; object-fit: cover;">
                                    @else
                                        <video width="100%" height="auto" controls autoplay muted loop playsinline
                                            style="border-radius: 2px; max-height: 500px; object-fit: cover;">
                                            <source src="{{ asset('storage/' . $data->achievement_video) }}"
                                                type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                            @elseif ($data->achievement_image)
                                <div class="image-container shadow">
                                    <img src="{{ Storage::url($data->achievement_image) }}" class="img-fluid"
                                        alt="Achievement">
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="col-lg-{{ $data->achievement_image || $data->achievement_video ? '6' : '12' }}">
                        @if ($data->achievement_title)
                            <h2 class="mb-2"
                                style="font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 500; letter-spacing: 0.5px; background: linear-gradient(180deg, #eaa11b 0%, #dea63d 100%); -webkit-background-clip: text; color: transparent; text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15); text-align: center;">
                                {{ $data->achievement_title }}
                            </h2>
                        @endif
                        @if ($data->achievement_description)
                            <p class="mb-4"
                                style="font-size: 1rem; line-height: 1.6; color: #4a7c68; font-weight: 550; font-family: 'Inter', sans-serif; text-align: justify;">
                                {{ $data->achievement_description }}
                            </p>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    </div>

    <!-- Call to Action -->
    <section class="py-5" style="background: linear-gradient(135deg, #f3f7f2, #eef5eb);">
        <div class="container text-center">
            <h3 class="fw-bold mb-3" style="color: #183018;">Siap Berkolaborasi dengan Kami?</h3>
            <p class="text-muted mb-4">Mari wujudkan visi bersama untuk masa depan yang lebih baik</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="/contact" class="btn btn-lg px-4 py-3 rounded-pill"
                    style="background: #183018; color: white; border: none;">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
                <a href="/partner" class="btn btn-outline-dark btn-lg px-4 py-3 rounded-pill">
                    <i class="fas fa-envelope me-2"></i>Gabung Mitra
                </a>
            </div>
        </div>
    </section>
@endsection

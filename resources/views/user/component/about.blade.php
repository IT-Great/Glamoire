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
        .hero-section {
            margin-bottom: 80px;
        }

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

        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.495);"></div>

        <div class="container position-relative z-1 h-100 d-flex align-items-center">
            <div class="col-lg-8">

                {{-- Konten --}}
                <div class="p-4 shadow" style="background-color: rgba(0, 0, 0, 0.283); border-radius: 1rem;">
                    {{-- Title --}}
                    <h1 class="fw-bold mb-3"
                        style="
                          font-size: 2rem; 
                          color: #4a7c59;
                          ">
                        {{ $data['hero_title'] }}
                    </h1>

                    {{-- Description --}}
                    <p class="mb-4"
                        style="
                        font-size: 1rem; 
                        line-height: 1.6;">
                        {{ $data['hero_description'] }}
                    </p>

                    <div class="mt-4">
                        <a href="/shop" class="btn btn-lg px-4 py-2"
                            style="background-color: #4a7c59; color: #fff; font-weight: 600; border-radius: 0.75rem; letter-spacing: 0.3px; text-decoration: none; display: inline-block; transition: background-color 0.3s ease; "
                            onmouseenter="this.style.backgroundColor='#3a6247'"
                            onmouseleave="this.style.backgroundColor='#4a7c59'">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Belanja Sekarang
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container my-5">
        <!-- Intro Section -->
        <section class="about-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="image-container rounded-3 shadow">
                        <img src="{{ Storage::url($data['intro_image']) }}" class="img-fluid rounded-3" alt="Achievement">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="elegant-card rounded-3 p-4 p-lg-5">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-hands"></i>
                        </div>
                        <h2 class="about-section-title">{{ $data->intro_title }}
                        </h2>
                        <p class="text-muted mb-4" style="line-height: 1.7; font-size: 15px;">
                            {{ $data->intro_description }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-lightbulb text-warning me-1"></i>
                                Innovation
                            </span>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-handshake text-primary me-1"></i>
                                Trust & Professionalism
                            </span>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-gem text-info me-1"></i>
                                Quality
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section class="about-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <div class="image-container rounded-3 shadow">
                        <img src="{{ Storage::url($data['vision_image']) }}" class="img-fluid rounded-3" alt="Vision">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="elegant-card rounded-3 p-4 p-lg-5">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h2 class="about-section-title">{{ $data->vision_title }}</h2>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div
                                    style="width: 4px; height: 40px; background: linear-gradient(to bottom, #183018, #4a7c59); border-radius: 2px;">
                                </div>
                            </div>
                            <div>
                                <small class="text-muted font-weight-bold"> {{ $data->vision_description }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="section-divider"></div>

        <!-- Mission Section -->
        <section class="about-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="image-container rounded-3 shadow">
                        <img src="{{ Storage::url($data['mission_image']) }}" class="img-fluid rounded-3" alt="Mission">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="elegant-card rounded-3 p-4 p-lg-5">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h2 class="about-section-title">{{ $data->mission_title }}</h2>
                        <p class="text-muted mb-4" style="line-height: 1.7; font-size: 15px;">
                            {{ $data->mission_description }}
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small class="text-muted">Kualitas Terjamin</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small class="text-muted">Layanan Terbaik</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="section-divider"></div>

        <!-- Story Section -->
        <section class="about-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <div class="image-container rounded-3 shadow">
                        <img src="{{ Storage::url($data['story_image']) }}" class="img-fluid rounded-3" alt="Story">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="elegant-card rounded-3 p-4 p-lg-5">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h2 class="about-section-title">{{ $data->story_title }}</h2>

                        <div class="timeline-item mt-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div
                                        style="width: 12px; height: 12px; background: #4a7c59; border-radius: 50%; margin-top: 4px;">
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Perjalanan Kami</h6>
                                    <small class="text-muted"> {{ $data->story_description }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="section-divider"></div>

        <!-- Achievement Section -->
        <section class="about-section mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="image-container rounded-3 shadow">
                        <img src="{{ Storage::url($data['achievement_image']) }}" class="img-fluid rounded-3"
                            alt="Achievement">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="elegant-card rounded-3 p-4 p-lg-5">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h2 class="about-section-title">{{ $data->achievement_title }}</h2>
                        <p class="text-muted mb-4" style="line-height: 1.7; font-size: 15px;">
                            {{ $data->achievement_description }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-medal text-warning me-1"></i>
                                Excellence Award
                            </span>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-star text-warning me-1"></i>
                                Top Performer
                            </span>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-certificate text-warning me-1"></i>
                                Certified Quality
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

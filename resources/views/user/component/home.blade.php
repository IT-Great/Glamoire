@extends('user.layouts.master')

@section('content')

    @php
        $wishlist = session('id_user') && $data['wishlist'] !== null ? $data['wishlist'] : [];
    @endphp

    <style>
        /* Custom Carousel Styles */
        .carousel-container {
            width: 100%;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            max-height: 600px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .mySwiperCarousel {
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        .mySwiperCarousel .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: auto;
            max-height: 600px;
            overflow: hidden;
        }

        .mySwiperCarousel .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center;
            transition: transform 0.3s ease;
            display: block;
        }

        .mySwiperCarousel .swiper-slide:hover img {
            transform: scale(1.02);
        }

        /* Navigation Buttons */
        .mySwiperCarousel .swiper-button-next,
        .mySwiperCarousel .swiper-button-prev {
            color: #fff;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-top: -25px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .mySwiperCarousel .swiper-button-next:hover,
        .mySwiperCarousel .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.7);
            transform: scale(1.1);
        }

        .mySwiperCarousel .swiper-button-next:after,
        .mySwiperCarousel .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }

        /* Pagination */
        .mySwiperCarousel .swiper-pagination {
            bottom: 20px;
        }

        .mySwiperCarousel .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .mySwiperCarousel .swiper-pagination-bullet-active {
            background: #fff;
            transform: scale(1.2);
        }

        /* Layout 2 Kolom - PENTING */
        .section-wrapper {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 2rem;
            width: 100%;
            padding: 1.5rem 0;
        }

        .section-left {
            flex: 0 0 20%;
            max-width: 250px;
            min-width: 200px;
        }

        .section-right {
            flex: 1;
            min-width: 0;
        }

        /* Swiper untuk Product Cards - TOP SELLING */
        .mySwiper {
            width: 100%;
            padding: 0;
        }

        .mySwiper .swiper-slide {
            height: auto;
            box-sizing: border-box;
        }

        .mySwiper .swiper-button-next,
        .mySwiper .swiper-button-prev {
            color: #183018;
            background: white;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            transition: all 0.3s ease;
        }

        .mySwiper .swiper-button-next:after,
        .mySwiper .swiper-button-prev:after {
            font-size: 16px;
            font-weight: bold;
        }

        .mySwiper .swiper-button-next:hover,
        .mySwiper .swiper-button-prev:hover {
            background: #183018;
            color: white;
            border-color: #183018;
        }

        /* Product Card Styling - HANYA UNTUK TOP SELLING */
        .section-wrapper .product-card {
            width: 100%;
            height: 100%;
        }

        .section-wrapper .product-image-container {
            position: relative;
            width: 100%;
            padding-top: 100%;
            overflow: hidden;
            background: #f8f8f8;
        }

        .section-wrapper .product-image-home {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* CATEGORY SECTION - SLIDER STYLE */
        .category-slider-section .mySwiper {
            width: 100%;
            padding: 0;
        }

        .category-slider-section .swiper-slide {
            height: auto;
            box-sizing: border-box;
        }

        .category-slider-section .swiper-button-next,
        .category-slider-section .swiper-button-prev {
            color: #183018;
            background: white;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            transition: all 0.3s ease;
        }

        .category-slider-section .swiper-button-next:after,
        .category-slider-section .swiper-button-prev:after {
            font-size: 16px;
            font-weight: bold;
        }

        .category-slider-section .swiper-button-next:hover,
        .category-slider-section .swiper-button-prev:hover {
            background: #183018;
            color: white;
            border-color: #183018;
        }

        /* Category Card Styling */
        .category-card {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            background: transparent;
            height: 100%;
        }

        .category-card:hover {
            opacity: 0.85;
        }

        .category-image-container {
            position: relative;
            width: 100%;
            padding-top: 120%;
            overflow: hidden;
            background: #f5f5f5;
            border-radius: 4px;
        }

        .category-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.03);
        }

        .category-info {
            padding: 0.75rem 0;
            text-align: center;
            background: transparent;
        }

        .category-title {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            margin-bottom: 0.25rem;
            letter-spacing: 0;
            line-height: 1.3;
        }

        .category-description {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
            font-weight: 400;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .section-wrapper {
                flex-direction: column;
                gap: 1.5rem;
            }

            .section-left {
                flex: 0 0 auto;
                max-width: 100%;
                min-width: auto;
                margin-bottom: 0;
            }

            .section-right {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .section-wrapper {
                padding: 1rem 0;
            }

            .mySwiperCarousel {
                max-height: 400px;
            }

            .mySwiperCarousel .swiper-slide {
                max-height: 400px;
            }

            .mySwiperCarousel .swiper-slide img {
                max-height: 400px;
            }

            .mySwiperCarousel .swiper-button-next,
            .mySwiperCarousel .swiper-button-prev {
                width: 40px;
                height: 40px;
                margin-top: -20px;
            }

            .mySwiperCarousel .swiper-button-next:after,
            .mySwiperCarousel .swiper-button-prev:after {
                font-size: 16px;
            }

            .mySwiper .swiper-button-next,
            .mySwiper .swiper-button-prev,
            .category-slider-section .swiper-button-next,
            .category-slider-section .swiper-button-prev {
                width: 32px;
                height: 32px;
            }

            .mySwiper .swiper-button-next:after,
            .mySwiper .swiper-button-prev:after,
            .category-slider-section .swiper-button-next:after,
            .category-slider-section .swiper-button-prev:after {
                font-size: 14px;
            }

            .category-title {
                font-size: 15px;
            }

            .category-description {
                font-size: 12px;
            }

            .category-info {
                padding: 1rem 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .mySwiperCarousel {
                max-height: 300px;
            }

            .mySwiperCarousel .swiper-slide {
                max-height: 300px;
            }

            .mySwiperCarousel .swiper-slide img {
                max-height: 300px;
            }

            .mySwiperCarousel .swiper-button-next,
            .mySwiperCarousel .swiper-button-prev {
                display: none;
            }

            .mySwiper .swiper-button-next,
            .mySwiper .swiper-button-prev,
            .category-slider-section .swiper-button-next,
            .category-slider-section .swiper-button-prev {
                display: none;
            }

            .category-card {
                border-radius: 10px;
            }
        }

        /* Loading state */
        .swiper-slide img {
            background: #f0f0f0;
            background-image: linear-gradient(45deg, transparent 35%, rgba(255, 255, 255, 0.5) 50%, transparent 65%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .swiper-slide img[src] {
            background: none;
            animation: none;
        }

        .mySwiperCarousel .swiper-slide video {
            width: 100%;
            height: auto;
            object-fit: contain;
            background: #000;
            max-height: 600px;
        }

        @media (max-width: 768px) {
            .mySwiperCarousel .swiper-slide video {
                max-height: 400px;
            }
        }

        @media (max-width: 480px) {
            .mySwiperCarousel .swiper-slide video {
                max-height: 300px;
            }
        }

        /* Promo Section Container */
        .promo-section {
            width: 100%;
            margin: 3rem auto;
            padding: 0 1rem;
        }

        .promo-section-header {
            margin-bottom: 2rem;
        }

        .promo-section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -1px;
        }

        /* Main Container - Two Column Layout */
        .promo-main-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: stretch;
        }

        /* Left Side - Promo Diskon (Product Cards) */
        .promo-left {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Right Side - Promo Banner */
        .promo-right {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Promo Card - Left (Product Cards) */
        .promo-card-left {
            position: relative;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .promo-card-left:hover {
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        /* Promo Card - Right (Banner) */
        .promo-card-right {
            position: relative;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .promo-card-right:hover {
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.12);
        }

        /* Banner Image Container */
        .promo-banner-container {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f5f5 0%, #ebebeb 100%);
        }

        .promo-banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .promo-card-right:hover .promo-banner-image {
            transform: scale(1.05);
        }

        /* Content Right - Banner Text */
        .promo-content-right {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .promo-label {
            font-size: 0.75rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .promo-title-right {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 0.75rem 0;
            line-height: 1.2;
        }

        .promo-desc-right {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.5;
            margin: 0 0 1rem 0;
        }

        .promo-cta-right {
            display: inline-block;
            font-size: 0.9rem;
            color: #000;
            font-weight: 600;
            text-decoration: underline;
            transition: color 0.2s ease;
            width: fit-content;
        }

        .promo-cta-right:hover {
            color: #666;
        }

        /* Promo Header Left */
        .promo-header-left {
            padding: 1.5rem;
            background: #f9f9f9;
        }

        .promo-title-left {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 0.5rem 0;
            line-height: 1.3;
        }

        .promo-desc-left {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.4;
            margin: 0;
        }

        /* Discount Badge */
        .discount-badge-left {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.3);
            text-align: center;
        }

        .discount-badge-left .amount {
            display: block;
            font-size: 1.3rem;
            font-weight: 800;
            line-height: 1;
        }

        .discount-badge-left .label {
            display: block;
            font-size: 0.7rem;
            opacity: 0.9;
        }

        /* Products Grid */
        .promo-products-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            padding: 0 1.5rem 1.5rem;
        }

        .product-item-mini {
            display: flex;
            flex-direction: column;
        }

        .product-image-mini-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: #f5f5f5;
            border-radius: 6px;
            margin-bottom: 0.75rem;
        }

        .product-image-mini {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .product-image-mini:hover {
            transform: scale(1.05);
        }

        .product-stock-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            z-index: 5;
        }

        .product-stock-badge.limited {
            background: #fbbf24;
            color: #78350f;
        }

        .product-stock-badge.out-of-stock {
            background: #ef4444;
            color: white;
        }

        .product-info-mini {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name-mini {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 0.5rem 0;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .price-mini {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .original-price-mini {
            font-size: 0.8rem;
            color: #999;
            text-decoration: line-through;
        }

        .discount-price-mini {
            font-size: 0.95rem;
            font-weight: 700;
            color: #dc2626;
        }

        .discount-percent-mini {
            font-size: 0.75rem;
            color: #dc2626;
            font-weight: 600;
        }

        /* Empty State */
        .empty-promo {
            padding: 2rem;
            text-align: center;
            color: #999;
            font-size: 0.95rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .promo-main-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .promo-section-header h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .promo-section {
                margin: 2rem auto;
                padding: 0 0.75rem;
            }

            .promo-section-header h2 {
                font-size: 1.75rem;
            }

            .promo-banner-container {
                aspect-ratio: 4 / 3;
            }

            .promo-title-right {
                font-size: 1.25rem;
            }

            .promo-desc-right {
                font-size: 0.85rem;
            }

            .promo-products-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .promo-section {
                margin: 1.5rem auto;
                padding: 0 0.5rem;
            }

            .promo-section-header h2 {
                font-size: 1.5rem;
            }

            .promo-main-container {
                gap: 1rem;
            }

            .promo-banner-container {
                aspect-ratio: 1 / 1;
            }

            .promo-content-right {
                padding: 1rem;
            }

            .promo-title-right {
                font-size: 1.1rem;
            }

            .promo-desc-right {
                font-size: 0.8rem;
            }

            .promo-header-left {
                padding: 1rem;
            }

            .promo-products-grid {
                padding: 0 1rem 1rem;
                gap: 0.75rem;
            }
        }
    </style>

    <!-- PROMO FIRST USER -->
    @if (session('id_user'))
        @if ($data['promoModal'] !== null)
            <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog modal-xl  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <!-- Close button at the top right corner -->
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                            <!-- Fullscreen image -->
                            <div class="container-fluid p-0 m-0">
                                <img src="{{ Storage::url($data['promoModal']->image) }}"
                                    alt="{{ $data['promoModal']->promo_name }}"
                                    title="{{ $data['promoModal']->promo_name }}"
                                    class="product-img img-fluid w-auto h-100 hover:cursor-pointer"
                                    onclick="location.href='{{ $data['promoModal']->promo_name }}-detail-promo'">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if ($data['popups']->isNotEmpty())
            @foreach ($data['popups'] as $popup)
                @if ($popup->display_type === 'popup' || $popup->display_type === 'both')
                    <div class="modal fade" id="popupModal{{ $loop->index }}" tabindex="-1" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <!-- Tombol close di kanan atas -->
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2"
                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                    <!-- Konten utama popup -->
                                    <div class="container-fluid p-0 m-0">
                                        {{-- Media: gambar atau video --}}
                                        @if ($popup->media_type === 'video')
                                            <video class="w-100" controls autoplay muted loop>
                                                <source src="{{ Storage::url($popup->media_popup) }}" type="video/mp4">
                                                Browser Anda tidak mendukung video.
                                            </video>
                                        @else
                                            <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}"
                                                class="img-fluid w-auto h-100">
                                        @endif

                                        {{-- Deskripsi dan form voucher --}}
                                        <div class="d-flex gap-2">
                                            <div class="py-2 grid md:flex col-12 align-items-center justify-content-center"
                                                style="background-color: #475136">
                                                <div class="col-12 col-md-6 p-0 p-md-2 mb-2 mb-md-0">
                                                    <p
                                                        class="text-white text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">
                                                        {{ $popup->description ?? 'Dapatkan Kode Voucher Gratis Khusus Pengguna Baru' }}
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6 m-0 p-0">
                                                    <form id="voucher-form" class="grid gap-1">
                                                        @csrf
                                                        <div class="position-relative mb-1">
                                                            {{-- Ikon email --}}
                                                            <i class="fas fa-envelope text-gray-400 position-absolute top-50 translate-middle-y"
                                                                style="left: 12px; font-size: 13px;"></i>

                                                            {{-- Input email --}}
                                                            <input type="email" id="voucher_email"
                                                                placeholder="Masukkan email" required
                                                                class="form-control py-2 w-full rounded-sm text-gray-700 bg-white text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px] focus:border-[#183018] focus:ring-2 focus:ring-[#183018]/40 transition-all duration-200"
                                                                style="padding-left: 38px; padding-right: 38px; height: 34px; border-radius: 0;">

                                                            {{-- Spinner --}}
                                                            <div class="spinner-border text-[#183018] position-absolute top-50 translate-middle-y"
                                                                style="right: 12px; width:15px; height:15px; display:none;"
                                                                role="status">
                                                                <span class="visually-hidden"></span>
                                                            </div>
                                                        </div>

                                                        <div id="validationEmailVoucher"
                                                            class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] text-danger"
                                                            style="display: none;">
                                                        </div>

                                                        {{-- Tombol Submit --}}
                                                        <button type="submit" id="voucher-btn" disabled
                                                            class="py-2 w-full rounded-sm text-white bg-[#183018] hover:bg-neutral-900 text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px]"
                                                            style="border-radius: 0;">
                                                            Dapatkan Sekarang
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir konten utama -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

    @endif
    <!-- END PROMO FIRST USER-->


    <!-- CAROUSEL -->
    <div class="carousel-container">
        <div class="swiper mySwiperCarousel">
            <div class="swiper-wrapper">

                {{-- PROMO --}}
                @foreach ($data['promos'] as $promo)
                    <div class="swiper-slide">
                        <a href="/{{ $promo->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name }}"
                                title="{{ $promo->promo_name }}" loading="lazy">
                        </a>
                    </div>
                @endforeach

                {{-- POPUPS --}}
                @foreach ($data['popups'] as $popup)
                    <div class="swiper-slide">
                        @if ($popup->media_type === 'image')
                            <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}"
                                title="{{ $popup->description }}" loading="lazy">
                        @elseif($popup->media_type === 'video')
                            <video class="w-full h-full" controls playsinline
                                @if ($loop->first) autoplay muted @endif>
                                <source src="{{ Storage::url($popup->media_popup) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                @endforeach

            </div>

            {{-- Swiper navigation --}}
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- CAROUSEL END -->

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">

        <!-- TOP SELLING Start -->
        <div class="container-fluid">
            <!-- Wrapper untuk layout 2 kolom dengan CSS FLEX -->
            <div class="section-wrapper">

                <!-- Kolom Kiri: Judul dan Deskripsi -->
                <div class="section-left">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                        New Beauty<br>Thrills
                    </h2>
                    <p class="text-sm md:text-base text-gray-700 mb-6 leading-relaxed">
                        Meet the latest limited-edition launches getting the party started.
                    </p>
                    <a href="#" class="text-sm md:text-base font-medium underline hover:no-underline inline-block">
                        Shop now
                    </a>
                </div>

                <!-- Kolom Kanan: Swiper Carousel -->
                <div class="section-right">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @if (session('id_user'))
                                @foreach ($data['topsell'] as $product)
                                    <div class="swiper-slide">
                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'"
                                            class="product-card bg-white shadow-sm overflow-hidden hover:cursor-pointer">
                                            <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                                <div class="product-image-container">
                                                    <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                        src="{{ Storage::url($product->main_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                </div>

                                                <div class="grid text-left p-1 p-md-2">
                                                    <div class="flex gap-1">
                                                        <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between"
                                                            style="color:orange;"></i>
                                                        <p
                                                            class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                                            {{ $product->rating }}</p>
                                                        @php
                                                            $inWishlist = collect($wishlist)->contains(
                                                                'product_id',
                                                                $product->id,
                                                            );
                                                        @endphp
                                                        <i class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000] hover-primary' : 'text-[#183018] hover-red' }} text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between"
                                                            onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                        </i>
                                                    </div>
                                                    <p
                                                        class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px] overflow-hidden">
                                                        <a href="/{{ $product->product_code }}_product"
                                                            class="text-decoration-none truncate-ellipsis"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="{{ $product->product_name }}">
                                                            {{ $product->product_name }}
                                                        </a>
                                                    </p>

                                                    <div class="flex justify-content-start gap-1">
                                                        @php
                                                            $activePromo = $product->promos->first();
                                                            $discountedPrice = $activePromo
                                                                ? $activePromo->pivot->discounted_price
                                                                : null;
                                                        @endphp

                                                        @if ($product->priceVariation !== null)
                                                            <p
                                                                class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                {{ $product->priceVariation }}
                                                            </p>
                                                        @else
                                                            @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                <p
                                                                    class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                    <del>
                                                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                    </del>
                                                                </p>
                                                                <p
                                                                    class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                    Rp{{ number_format($discountedPrice, 0, ',', '.') }}
                                                                </p>
                                                            @else
                                                                <p
                                                                    class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                    Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                </p>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($data['topsell'] as $product)
                                    <div class="swiper-slide">
                                        <div onclick="window.location.href = '/{{ $product->product_code }}_product'"
                                            class="product-card bg-white rounded-lg shadow-sm overflow-hidden hover:cursor-pointer">
                                            <div class="product-image-container">
                                                <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                    src="{{ Storage::url($product->main_image) }}"
                                                    alt="{{ $product->product_name }}">
                                            </div>

                                            <div class="grid text-left p-1 p-md-2">
                                                <div class="flex gap-1">
                                                    <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between"
                                                        style="color:orange;"></i>
                                                    <p
                                                        class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                                        {{ $product->rating }}</p>
                                                    <i class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red"
                                                        onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                                    </i>
                                                </div>
                                                <p
                                                    class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px] overflow-hidden">
                                                    <a href="/{{ $product->product_code }}_product"
                                                        class="text-decoration-none truncate-ellipsis"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $product->product_name }}">
                                                        {{ $product->product_name }}
                                                    </a>
                                                </p>

                                                <div class="flex justify-content-start gap-1">
                                                    @php
                                                        $activePromo = $product->promos->first();
                                                        $discountedPrice = $activePromo
                                                            ? $activePromo->pivot->discounted_price
                                                            : null;
                                                    @endphp

                                                    @if ($product->priceVariation !== null)
                                                        <p
                                                            class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                            {{ $product->priceVariation }}
                                                        </p>
                                                    @else
                                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                            <p
                                                                class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                <del>
                                                                    Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                                </del>
                                                            </p>
                                                            <p
                                                                class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                        @else
                                                            <p
                                                                class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                            </p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TOP SELLING End -->

        <!-- PROMO SECTION -->
        {{-- kiri diskon kanan promo --}}
        {{-- <div class="promo-section">
            <div class="promo-section-header">
                <h2>Special Offers For You</h2>
            </div>

            <div class="promo-main-container">
                <!-- LEFT SIDE - PROMO DISKON (PRODUCT CARDS) -->
                <div class="promo-left">
                    @forelse ($data['promosDiskon'] as $promo)
                        <div class="promo-card-left">
                            <!-- Header Promo -->
                            <div class="promo-header-left">
                                <h3 class="promo-title-left">{{ $promo->promo_name }}</h3>
                                <p class="promo-desc-left">{{ $promo->description ?? 'Limited time offer' }}</p>

                                @if ($promo->discount)
                                    <div class="discount-badge-left">
                                        <span class="amount">
                                            @if ($promo->discount_type === 'percentage')
                                                {{ $promo->discount }}%
                                            @else
                                                Rp{{ number_format($promo->discount / 1000, 0, ',', '.') }}K
                                            @endif
                                        </span>
                                        <span class="label">OFF</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Grid -->
                            <div class="promo-products-grid">
                                @forelse ($promo->products as $product)
                                    <div class="product-item-mini">
                                        <div class="product-image-mini-container">
                                            <img class="product-image-mini"
                                                src="{{ Storage::url($product->main_image) }}"
                                                alt="{{ $product->product_name }}"
                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">

                                            @if ($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                                                <div class="product-stock-badge limited">Stok Terbatas</div>
                                            @elseif($product->stock_quantity == 0)
                                                <div class="product-stock-badge out-of-stock">Habis</div>
                                            @endif
                                        </div>

                                        <div class="product-info-mini">
                                            <h5 class="product-name-mini">{{ $product->product_name }}</h5>

                                            <div class="price-mini">
                                                <span class="original-price-mini">
                                                    Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                </span>

                                                @php
                                                    $discountedPrice = 0;
                                                    if ($promo->discount_type === 'percentage') {
                                                        $discountedPrice =
                                                            $product->regular_price * (1 - $promo->discount / 100);
                                                    } elseif ($promo->discount_type === 'nominal') {
                                                        $discountedPrice = $product->regular_price - $promo->discount;
                                                    }
                                                    $discountedPrice = max(0, $discountedPrice);
                                                    $savingsPercentage =
                                                        (($product->regular_price - $discountedPrice) /
                                                            $product->regular_price) *
                                                        100;
                                                @endphp

                                                <span class="discount-price-mini">
                                                    Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                                </span>
                                                <span
                                                    class="discount-percent-mini">-{{ round($savingsPercentage) }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p style="grid-column: 1/-1; text-align: center; color: #999; padding: 1rem;">
                                        Tidak ada produk tersedia
                                    </p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <div class="empty-promo">Tidak ada promo diskon tersedia</div>
                    @endforelse
                </div>

                <!-- RIGHT SIDE - PROMO BANNER -->
                <div class="promo-right">
                    @forelse ($data['promosBanner'] as $promo)
                        <div class="promo-card-right" onclick="window.location.href='/promo/{{ $promo->id }}'">
                            <!-- Banner Image -->
                            <div class="promo-banner-container">
                                <img class="promo-banner-image"
                                    src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}"
                                    alt="{{ $promo->promo_name }}">
                            </div>

                            <!-- Banner Info -->
                            <div class="promo-content-right">
                                <p class="promo-label">{{ $promo->type }}</p>
                                <h3 class="promo-title-right">{{ $promo->promo_name }}</h3>
                                <p class="promo-desc-right">
                                    {{ $promo->description ?? 'Limited time offer' }}
                                </p>
                                <a href="/promo/{{ $promo->id }}" class="promo-cta-right">Shop now</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-promo">Tidak ada promo banner tersedia</div>
                    @endforelse
                </div>
            </div>
        </div> --}}

        <div class="promo-section">
            {{-- <div class="promo-section-header">
                <h2>Special Offers For You</h2>
            </div> --}}

            <div class="promo-main-container">
                <!-- LEFT SIDE - PROMO DISKON (PRODUCT CARDS) -->
                <div class="promo-right">
                    @forelse ($data['promosBanner'] as $promo)
                        <div class="promo-card-right" onclick="window.location.href='/promo/{{ $promo->id }}'">
                            <!-- Banner Image -->
                            <div class="promo-banner-container">
                                <img class="promo-banner-image"
                                    src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}"
                                    alt="{{ $promo->promo_name }}">
                            </div>

                            <!-- Banner Info -->
                            <div class="promo-content-right">
                                <p class="promo-label">{{ $promo->type }}</p>
                                <h3 class="promo-title-right">{{ $promo->promo_name }}</h3>
                                <a href="/promo/{{ $promo->id }}" class="promo-cta-right">Shop now</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-promo">Tidak ada promo banner tersedia</div>
                    @endforelse
                </div>

                <!-- RIGHT SIDE - PROMO BANNER -->
                <div class="promo-right">
                    @forelse ($data['promosBanner'] as $promo)
                        <div class="promo-card-right" onclick="window.location.href='/promo/{{ $promo->id }}'">
                            <!-- Banner Image -->
                            <div class="promo-banner-container">
                                <img class="promo-banner-image"
                                    src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}"
                                    alt="{{ $promo->promo_name }}">
                            </div>

                            <!-- Banner Info -->
                            <div class="promo-content-right">
                                <p class="promo-label">{{ $promo->type }}</p>
                                <h3 class="promo-title-right">{{ $promo->promo_name }}</h3>
                                <a href="/promo/{{ $promo->id }}" class="promo-cta-right">Shop now</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-promo">Tidak ada promo banner tersedia</div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- PROMO SECTION -->

    </div>

    {{-- SECTION CATEGORY --}}
    <div class="container-fluid new-arrival-section">

        <div class="section-left">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                Shop By Category
            </h2>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($data['categories'] as $category)
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer"
                            onclick="window.location.href = '/category/{{ $category->id }}'">

                            @if ($category->products->isNotEmpty())
                                @php
                                    $firstProduct = $category->products->first();
                                @endphp

                                <div class="product-image-container">
                                    <img class="product-img card-img-top product-image-home"
                                        src="{{ Storage::url($firstProduct->main_image) }}" alt="{{ $category->name }}">
                                </div>

                                <div class="grid text-left p-2 p-md-3">
                                    <p
                                        class="text-decoration-none text-black font-semibold text-[11px] md:text-[13px] lg:text-[14px] xl:text-[15px] mb-1">
                                        {{ $category->name }}
                                    </p>

                                    <p
                                        class="text-decoration-none text-muted text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]">
                                        {{ $category->products->count() }} Produk
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    {{-- SECTION CATEGORY --}}

    <!-- curated for you -->
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
        <div class="container-fluid new-arrival-section">
            <div class="section-left">
                <h4 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                    Curated For You
                </h4>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @if (session('id_user'))
                        @foreach ($data['new'] as $product)
                            <div class="swiper-slide">
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden h-fit ">
                                    <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                        <div class="product-image-container">
                                            <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                src="{{ Storage::url($product->main_image) }}"
                                                alt="{{ $product->product_name }}">
                                        </div>

                                        <div class="grid text-left p-1 p-md-2">
                                            <div class="flex gap-1">
                                                <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between"
                                                    style="color:orange;"></i>
                                                <p
                                                    class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                                    {{ $product->rating }}</p>
                                                @php
                                                    $inWishlist = collect($wishlist)->contains(
                                                        'product_id',
                                                        $product->id,
                                                    );
                                                @endphp
                                                <i class="fas fa-heart ml-auto text-decoration-none {{ $inWishlist ? 'text-[#FF0000]' : 'text-[#183018]' }} text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red"
                                                    onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                </i>
                                            </div>
                                            <p
                                                class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px] overflow-hidden">
                                                <a href="/{{ $product->product_code }}_product"
                                                    class="text-decoration-none truncate-ellipsis"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $product->product_name }}">
                                                    {{ $product->product_name }}
                                                </a>
                                            </p>

                                            <div class="flex justify-content-start gap-1">
                                                @php
                                                    $activePromo = $product->promos->first();
                                                    $discountedPrice = $activePromo
                                                        ? $activePromo->pivot->discounted_price
                                                        : null;
                                                @endphp

                                                @if ($product->priceVariation !== null)
                                                    <p
                                                        class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                        {{ $product->priceVariation }}
                                                    </p>
                                                @else
                                                    @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                        <p
                                                            class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                            <del>
                                                                Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                            </del>
                                                        </p>
                                                        <p
                                                            class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                            Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                    @else
                                                        <p
                                                            class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                            Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </p>
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <!-- MUNCULKAN DATA PRODUK JIKA USER BELUM LOGIN -->
                    @else
                        @foreach ($data['new'] as $product)
                            <div class="swiper-slide">
                                <div onclick="window.location.href = '/{{ $product->product_code }}_product'"
                                    class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer">
                                    <div class="product-image-container">
                                        <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                            src="{{ Storage::url($product->main_image) }}"
                                            alt="{{ $product->product_name }}">
                                    </div>

                                    <div class="grid text-left p-1 p-md-2">
                                        <div class="flex gap-1">
                                            <i class="text-decoration-none fas fa-star text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px] grid align-items-center justify-content-between"
                                                style="color:orange;"></i>
                                            <p
                                                class="text-decoration-none text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[12px]">
                                                {{ $product->rating }}</p>
                                            <i class="fas fa-heart ml-auto text-decoration-none text-[#183018] text-[12px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid align-items-center justify-content-between hover-red"
                                                onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                            </i>
                                        </div>
                                        <p
                                            class="text-decoration-none text-black text-[9px] md:text-[12px] lg:text-[12px] xl:text-[13px] overflow-hidden">
                                            <a href="/{{ $product->product_code }}_product"
                                                class="text-decoration-none truncate-ellipsis" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="{{ $product->product_name }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </p>

                                        <div class="flex justify-content-start gap-1">
                                            @php
                                                $activePromo = $product->promos->first();
                                                $discountedPrice = $activePromo
                                                    ? $activePromo->pivot->discounted_price
                                                    : null;
                                            @endphp

                                            @if ($product->priceVariation !== null)
                                                <p
                                                    class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                    {{ $product->priceVariation }}
                                                </p>
                                            @else
                                                @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                    <p
                                                        class="flex justify-content-center text-align-center text-decoration-none text-muted text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                        <del>
                                                            Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </del>
                                                    </p>
                                                    <p
                                                        class="text-decoration-none text-black text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                        Rp{{ number_format($discountedPrice, 0, ',', '.') }}</p>
                                                @else
                                                    <p
                                                        class="text-decoration-none text-[#183018] text-[9px] md:text-[11px] lg:text-[12px] xl:text-[13px]">
                                                        Rp{{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- curated for you End -->

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
        {{-- articles --}}
        <div class="container-fluid new-arrival-section">
            <div class="section-left">
                <h4 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                    Articles For You
                </h4>
            </div>

            {{-- Featured Article Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-2">
                {{-- Featured Large Article (Left) --}}
                @if (isset($data['articles'][0]))
                    <div class="md:col-span-2 hover:cursor-pointer"
                        onclick="window.location.href='/article/{{ $data['articles'][0]->id }}'">
                        <div class="relative overflow-hidden rounded-lg h-80 md:h-96">
                            <img class="w-full h-full object-cover"
                                src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}"
                                alt="{{ $data['articles'][0]->title }}">
                        </div>
                    </div>
                @endif

                {{-- Featured Article Info (Right) --}}
                @if (isset($data['articles'][0]))
                    <div class="flex flex-col justify-end bg-red-500 rounded-lg p-6 md:p-8 text-white hover:cursor-pointer hover:bg-red-600 transition-colors"
                        onclick="window.location.href='/article/{{ $data['articles'][0]->id }}'">
                        <h3 class="text-lg md:text-xl lg:text-2xl font-bold mb-2 leading-tight line-clamp-3">
                            {{ $data['articles'][0]->title }}
                        </h3>
                        <p class="text-xs md:text-sm mb-6 opacity-90 text-dark">
                            {{ \Carbon\Carbon::parse($data['articles'][0]->created_at)->format('F j Y') }} • 5 minute read
                        </p>
                    </div>
                @endif
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($data['articles'] as $article)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden h-fit hover:cursor-pointer"
                                onclick="window.location.href='/article/{{ $article->id }}'">
                                <div class="product-image-container">
                                    <img class="product-img card-img-top object-cover w-full h-48"
                                        src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}"
                                        alt="{{ $article->title }}">
                                </div>
                                <div class="p-3 text-left">
                                    <p class="text-[11px] md:text-[12px] text-gray-500 mb-1">
                                        {{ optional($article->categoryArticle)->name ?? 'Uncategorized' }}
                                    </p>
                                    <h5 class="font-semibold text-[13px] md:text-[15px] truncate mb-1">
                                        {{ $article->title }}
                                    </h5>
                                    <p class="text-[11px] text-gray-600 line-clamp-2">
                                        {{ Str::limit(strip_tags($article->content), 80) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        {{-- articles --}}
    </div>

    <!-- LANGGANAN INFORMASI/SUBSCRIBE -->
    {{-- <div class="container-fluid my-2 my-md-4 my-lg-6 my-xl-8 px-0 px-md-3">
        <div class="d-flex gap-2">
            <div class="py-2 py-md-1 flex col-12 align-items-center justify-content-center rounded-sm"
                style="background-color: #475136">
                <div class="col-6 col-md-8 mb-2 mb-md-0 p-0 p-md-2">
                    <p class="text-white text-[10px] md:text-[12px] lg:text-[14px] xl:text-[18px]">Langganan Untuk
                        Mendapatkan Informasi Terbaru Dari Kami</p>
                </div>
                <div class="col-6 col-md-4 p-0 p-md-2">
                    <form class="grid gap-1 gap-md-2 m-0" id="subscribe-form">
                        @csrf
                        <div class="relative flex items-center">
                            <i
                                class="fas fa-envelope text-gray-400 absolute left-3 text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px]"></i>
                            <!-- Ikon Email -->
                            <input type="email" name="emailVoucherNewUser" id="subscribe_email"
                                placeholder="Masukkan email" autocomplete="off" required
                                class="form-control py-2 w-full rounded-sm text-gray-700 bg-white text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px] focus:border-[#183018] focus:ring-2 focus:ring-[#183018]/40 transition-all duration-200"
                                style="padding-left: 38px; padding-right: 38px; height: 34px; border-radius: 0;">

                            <div class="spinner-border text-[#183018] absolute right-3" role="status"
                                style="width:15px; height:15px;display:none;"> <!-- Spinner -->
                                <span class="visually-hidden"></span>
                            </div>
                        </div>

                        <div id="validationEmailSubscribe"
                            class="text-[12px] md:text-[10px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                        </div>
                        <button
                            class="py-2 w-full rounded-sm text-white bg-[#183018] hover:bg-neutral-900 text-[10px] md:text-[9px] lg:text-[10px] xl:text-[12px]"
                            type="submit" id="subscribe-btn" disabled>Berlangganan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END -->

    <!-- KEUNGGULAN -->
    {{-- <div class="container-fluid py-4 my-2 my-md-4 my-lg-6 my-xl-8">
        <div class="row px-3">
            <div class="col-4 p-0">
                <h6 class="text-[10px] mb-2 md:text-[14px] lg:text-[16px] xl:text-[18px]">Plant-Based Cruelty-free</h6>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">1st Plant-Based Beauty Commerce in
                    Indonesia</p>
            </div>
            <div class="col-4 px-2">
                <h6 class="text-[10px] mb-2 md:text-[14px] lg:text-[16px] xl:text-[18px]">BPOM Approved</h6>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Belanja produk kecantikan pasti
                    asli dari ratusan brand yang bersertifikasi BPOM.</p>
            </div>
            <div class="col-4 p-0">
                <h6 class="text-[10px] mb-2 md:text-[14px] lg:text-[16px] xl:text-[18px]">Plant-Based Beauty</h6>
                <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">One stop Plant-Based Beauty Beauty,
                    cosmetic & personal care</p>
            </div>
        </div>
    </div> --}}
    {{-- </div> --}}




    <script>
        // Initialize Swiper untuk Product Carousel
        document.addEventListener('DOMContentLoaded', function() {
            var productSwiper = new Swiper(".mySwiper", {
                slidesPerView: 1.5,
                spaceBetween: 12,
                navigation: {
                    nextEl: ".mySwiper .swiper-button-next",
                    prevEl: ".mySwiper .swiper-button-prev",
                },
                breakpoints: {
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 12,
                    },
                    640: {
                        slidesPerView: 2.5,
                        spaceBetween: 16,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 16,
                    },
                    1024: {
                        slidesPerView: 3.5,
                        spaceBetween: 20,
                    },
                    1280: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    },
                },
            });
        });
    </script>

    {{-- untuk modal pop up --}}
    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const popups = document.querySelectorAll('[id^="popupModal"]');
                if (popups.length > 0) {
                    const modal = new bootstrap.Modal(popups[0]);
                    modal.show();

                    popups.forEach((popup, index) => {
                        popup.addEventListener('hidden.bs.modal', function() {
                            const nextModal = popups[index + 1];
                            if (nextModal) {
                                const next = new bootstrap.Modal(nextModal);
                                next.show();
                            }
                        });
                    });
                }
            });
        </script>
    @endif




    <!-- SUBSCRIBE  -->
    <script>
        $(document).on("submit", "#subscribe-form", function(e) {
            e.preventDefault();

            let email = $("#subscribe_email").val();

            Swal.fire({
                text: "Mohon tunggu sebentar ...",
                allowOutsideClick: false,
                background: "#183018",
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                willOpen: () => {
                    const titleLoading = document.querySelector('.swal2-title');
                    const contentLoading = document.querySelector('.swal2-html-container');
                    if (titleLoading) titleLoading.style.color = '#FFFFFF'; // Ubah warna judul
                    if (contentLoading) contentLoading.style.color = '#FFFFFF'; // Ubah warna konten
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('subscribe') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token dari Laravel
                    email: email,
                },
                success: function(response) {
                    if (response.success) {
                        Swal.close();
                        Toast.fire({
                            icon: "success",
                            text: response.message,
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.href =
                                "/"; // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        Swal.close();
                        Toast.fire({
                            icon: "error",
                            text: response.message,
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Swal.close();
                    Toast.fire("Error", "Maaf, Coba Lagi", "error");
                },
            });
        });

        $('#subscribe_email').on('keyup', function() {
            var email = $(this).val();
            if (email) {
                $.ajax({
                    url: "{{ route('check.email.subscribe') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        email: email
                    },
                    beforeSend: function() {
                        // Tampilkan spinner sebelum request dimulai
                        $('.spinner-border').show();
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#validationEmailSubscribe').text('Email sudah didaftarkan').addClass(
                                'text-white').show();
                            $('#subscribe-btn').prop('disabled', true);
                        } else {
                            $('#validationEmailSubscribe').hide();
                            $('#subscribe-btn').prop('disabled', false);
                        }
                    },
                    complete: function() {
                        // Sembunyikan spinner setelah request selesai
                        $('.spinner-border').hide();
                    },
                    error: function() {
                        alert('error');
                        // Jika ada error, tetap sembunyikan spinner
                        $('.spinner-border').hide();
                    }
                });
            }
        });

        $('#voucher_email').on('keyup', function() {
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
                    success: function(response) {
                        if (response.exists) {
                            $('#validationEmailVoucher').text('Email sudah didaftarkan').addClass(
                                'text-white').show();
                            $('#voucher-btn').prop('disabled', true);
                        } else {
                            $('#validationEmailVoucher').hide();
                            // $('#validationEmailVoucher').text('Kocak').addClass('text-white').show();
                            $('#voucher-btn').prop('disabled', false);
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
    </script>

    @if (session('id_user'))
        <!-- MENGATUR POP-UP PROMO  -->
        @if ($data['promoModal'] !== null)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('promoModal'));
                    myModal.show();
                });
            </script>
        @endif
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('firstUser'));
                myModal.show();
            });
        </script>
    @endif

    <script>
        $(document).on("submit", "#voucher-form", function(e) {
            e.preventDefault();

            let email = $("#voucher_email").val();

            Swal.fire({
                text: "Mohon tunggu sebentar ...",
                allowOutsideClick: false,
                background: "#183018",
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                willOpen: () => {
                    const titleLoading = document.querySelector('.swal2-title');
                    const contentLoading = document.querySelector('.swal2-html-container');
                    if (titleLoading) titleLoading.style.color = '#FFFFFF'; // Ubah warna judul
                    if (contentLoading) contentLoading.style.color = '#FFFFFF'; // Ubah warna konten
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('voucher.new.user') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    email: email,
                },
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,
                            title: "Berhasil",
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            location.reload(); // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errorMessage = response.message ||
                            "Terjadi kesalahan"; // Mengambil pesan error dari response
                        Toast.fire({
                            icon: "error",
                            text: errorMessage,
                            title: "Oops..",
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Swal.close();
                    let errorMessage = "";

                    if (response.responseJSON) {
                        if (response.responseJSON.message) {
                            errorMessage = response.responseJSON.message; // Pesan error dari Laravel


                        } else if (response.responseJSON.errors) {
                            // Jika ada beberapa pesan error, tampilkan semuanya
                            errorMessage = "";
                            $.each(response.responseJSON.errors, function(key, value) {
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
                        title: "Oops..",
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        }
                    });
                },
            });
        });
    </script>


@endsection

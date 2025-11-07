@extends('user.layouts.master')

@section('content')

    @php
        $wishlist = session('id_user') && $data['wishlist'] !== null ? $data['wishlist'] : [];
    @endphp

    <style>
        .popup-banner-container {
            /* aspect-ratio: 970 / 700; */
            /* Rasio gambar */
            overflow: hidden;
            position: relative;
            /* border-radius: 0.75rem; */
            /* optional: biar rounded sedikit */
            min-height: 250px;
        }

        .popup-banner-container img,
        .popup-banner-container video {
            transition: transform 0.8s ease, filter 0.8s ease;
            transform-origin: center center;
        }

        .group:hover .popup-banner-container img,
        .group:hover .popup-banner-container video {
            transform: scale(1.1);
            /* Zoom lebih terasa */
            filter: brightness(1.05);
            /* Sedikit lebih terang saat hover */
        }

        /* Tambahkan jarak bawah untuk konten popup di mobile */
        .popup-content-wrapper {
            margin-bottom: 1rem;
            /* Jarak bawah default untuk mobile */
        }


        /* Responsive tinggi minimum */
        @media (min-width: 640px) {
            .popup-banner-container {
                min-height: 300px;
            }

            .popup-content-wrapper {
                margin-bottom: 1.5rem;
            }
        }

        @media (min-width: 768px) {
            .popup-banner-container {
                min-height: 350px;
            }

            .popup-content-wrapper {
                margin-bottom: 0;
                /* Hapus margin di tablet ke atas */
            }
        }

        @media (min-width: 1024px) {
            .popup-banner-container {
                min-height: 400px;
            }
        }

        @media (min-width: 1280px) {
            .popup-banner-container {
                min-height: 450px;
            }
        }

        @media (min-width: 1536px) {
            .popup-banner-container {
                min-height: 500px;
            }
        }

        .product-image-container img:hover {
            transform: scale(1.05);
        }

        .dark-overlay {
            filter: brightness(0.6);
        }

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
            font-family: "Playfair Display", serif;
        }

        .section-left h2 {
            font-family: 'The Seasons', serif;
        }

        .section-left p,
        .section-left a {
            font-family: 'Poppins', sans-serif;
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
        .promo-section-wrapper {
            width: 100%;
            padding: 0;
            margin: 0;
            background: #fff;
            overflow: hidden;
        }

        .promo-section {
            width: 100%;
            max-width: 100%;
            margin: 1.5rem auto;
            padding: 0;
        }

        .promo-section-header {
            margin-bottom: 1.5rem;
            text-align: center;
            padding: 0 1rem;
        }

        /* Swiper Container untuk Promo */
        .myPromoSwiper {
            width: 100%;
            padding: 0 2rem;
        }

        .myPromoSwiper .swiper-slide {
            height: auto;
            box-sizing: border-box;
        }

        /* CRITICAL: Override global swiper img untuk promo slider ONLY */
        .myPromoSwiper .swiper-slide .promo-banner-image {
            width: 100% !important;
            height: auto !important;
            object-fit: contain !important;
            display: block !important;
            transition: transform 0.4s ease;
            max-height: none !important;
            background: none !important;
        }

        /* Navigation Buttons untuk Promo Slider */
        .myPromoSwiper .swiper-button-next,
        .myPromoSwiper .swiper-button-prev {
            color: #183018;
            background: white;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .myPromoSwiper .swiper-button-next:after,
        .myPromoSwiper .swiper-button-prev:after {
            font-size: 18px;
            font-weight: bold;
        }

        .myPromoSwiper .swiper-button-next:hover,
        .myPromoSwiper .swiper-button-prev:hover {
            background: #183018;
            color: white;
            border-color: #183018;
            box-shadow: 0 4px 12px rgba(24, 48, 24, 0.2);
        }

        /* Pagination untuk Promo Slider */
        .myPromoSwiper .swiper-pagination {
            bottom: 0;
        }

        .myPromoSwiper .swiper-pagination-bullet {
            background: #183018;
            opacity: 0.3;
            transition: all 0.3s ease;
        }

        .myPromoSwiper .swiper-pagination-bullet-active {
            opacity: 1;
            transform: scale(1.2);
        }

        /* Promo Card Styling */
        .promo-card-slider {
            position: relative;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .promo-card-slider:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .promo-banner-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
        }

        /* Style khusus untuk promo banner image - TIDAK TERPENGARUH GLOBAL */
        .promo-banner-image {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.4s ease;
            display: block;
        }

        .promo-card-slider:hover .promo-banner-image {
            transform: scale(1.02);
        }

        .promo-content-slider {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .promo-label {
            font-size: 0.7rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.4rem;
            display: block;
        }

        .promo-title-slider {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 0.6rem 0;
            line-height: 1.3;
        }

        .promo-desc-slider {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.5;
            margin: 0 0 1rem 0;
            flex: 1;
        }

        .promo-cta-slider {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            color: white !important;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
            transition: all 0.3s ease;
        }

        .promo-cta-slider:hover {
            background: linear-gradient(135deg, #388e3c, #81c784);
            box-shadow: 0 6px 16px rgba(46, 125, 50, 0.4);
            transform: translateY(-2px);
        }

        .promo-cta-slider i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .promo-cta-slider:hover i {
            transform: translateX(4px);
        }

        .empty-promo {
            padding: 3rem 1.5rem;
            text-align: center;
            color: #999;
            font-size: 0.9rem;
        }

        /* === Responsif untuk mobile === */
        @media (max-width: 768px) {
            .promo-period {
                font-size: 0.75rem;
            }

            .promo-cta-slider {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .promo-period {
                font-size: 0.7rem;
            }

            .promo-cta-slider {
                padding: 0.45rem 0.9rem;
                font-size: 0.8rem;
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .myPromoSwiper {
                padding: 0 2rem 2rem 2rem;
            }

            .promo-title-slider {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 768px) {
            .promo-section {
                margin: 1rem auto;
            }

            .myPromoSwiper {
                padding: 0 1.5rem 1.5rem 1.5rem;
            }

            .myPromoSwiper .swiper-button-next,
            .myPromoSwiper .swiper-button-prev {
                width: 36px;
                height: 36px;
            }

            .myPromoSwiper .swiper-button-next:after,
            .myPromoSwiper .swiper-button-prev:after {
                font-size: 14px;
            }

            .promo-content-slider {
                padding: 1rem;
            }

            .promo-title-slider {
                font-size: 1.1rem;
            }

            .promo-desc-slider {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .myPromoSwiper {
                padding: 0 0.5rem 1rem 0.5rem;
            }

            .myPromoSwiper .swiper-button-next,
            .myPromoSwiper .swiper-button-prev {
                display: none;
            }

            .promo-content-slider {
                padding: 0.85rem;
            }

            .promo-title-slider {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }

            .promo-desc-slider {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
            }

            .promo-label {
                font-size: 0.65rem;
            }

            .promo-cta-slider {
                font-size: 0.8rem;
            }
        }

        /* === Default (Desktop) === */
        .promo-section-header h2 {
            font-family: 'The Seasons', serif;
            font-size: 1.9rem;
            color: #2e7d32;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .promo-section-header p {
            font-size: 1rem;
            color: #555;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* === Responsif: Tablet & Mobile === */
        @media (max-width: 768px) {
            .promo-section-header {
                padding: 0 1.5rem;
            }

            .promo-section-header h2 {
                font-size: 1.5rem;
                /* sedikit lebih kecil */
                line-height: 1.3;
            }

            .promo-section-header p {
                font-size: 0.9rem;
                line-height: 1.5;
            }
        }

        /* === Responsif: Mobile Kecil (≤480px) === */
        @media (max-width: 480px) {
            .promo-section-header {
                padding: 0 1rem;
            }

            .promo-section-header h2 {
                font-size: 1.3rem;
            }

            .promo-section-header p {
                font-size: 0.85rem;
            }
        }

        .promo-link-slider {
            color: #2e7d32;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .promo-link-slider:hover {
            color: #1b5e20;
            text-decoration: underline;
        }

        .promo-link-slider i {
            font-size: 0.95rem;
            transition: transform 0.3s ease;
        }

        .promo-link-slider:hover i {
            transform: translateX(4px);
        }

        /* Responsif kecil */
        @media (max-width: 480px) {
            .promo-link-slider {
                font-size: 0.85rem;
            }
        }


        /* untuk bagian category  */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .category-card {
            border: 1px solid rgba(0, 0, 0, 0.05);
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 991px) {
            .category-card {
                min-height: 130px;
            }
        }

        @media (max-width: 768px) {
            .category-card {
                min-height: 120px;
            }

            .category-icon {
                width: 50px !important;
                height: 50px !important;
            }

            .category-icon svg {
                width: 32px !important;
                height: 32px !important;
            }
        }

        /* FLASH SALE */
        .swiper-slide-flash-sale {
            width: 180px !important;
            /* Sesuaikan dengan lebar card */
            margin-right: 12px !important;
            /* Jarak antar card */
        }

        /* Atau hapus margin auto pada card */
        .swiper-slide>div {
            margin: 0 !important;
            /* Hapus margin: 0 auto */
        }

        /* Responsive Flash Sale Image */
        .flash-sale-img {
            height: 80px;
            /* Mobile */
        }

        /* Timer Box Responsive */
        .timer-box {
            padding: 8px 12px;
            /* Mobile */
        }

        /* Live Badge */
        .live-badge {
            padding: 2px 8px;
            font-size: 8px;
            margin-bottom: 2px;
        }

        .ends-text {
            font-size: 8px;
        }

        /* Timer Digits */
        .timer-digit {
            padding: 4px 6px;
            font-size: 12px;
            min-width: 28px;
        }

        .timer-label {
            font-size: 7px;
            margin-top: 2px;
        }

        .timer-colon {
            font-size: 14px;
            margin: 0 2px;
        }

        /* Timer Divider */
        .timer-divider {
            height: 30px;
        }

        .flash-sale-img {
            margin-bottom: 20px;
        }

        .timer-box {
            margin-bottom: 20px;
        }

        /* Small Mobile (< 375px) */
        @media (max-width: 374px) {
            .flash-sale-img {
                height: 60px;
            }

            .timer-digit {
                padding: 3px 5px;
                font-size: 10px;
                min-width: 24px;
            }

            .timer-colon {
                font-size: 12px;
            }
        }

        /* Tablet */
        @media (min-width: 768px) {
            .flash-sale-img {
                height: 120px;
            }

            .timer-box {
                padding: 10px 18px;
            }

            .live-badge {
                padding: 3px 10px;
                font-size: 10px;
                margin-bottom: 3px;
            }

            .ends-text {
                font-size: 10px;
            }

            .timer-digit {
                padding: 6px 10px;
                font-size: 16px;
                min-width: 40px;
            }

            .timer-label {
                font-size: 9px;
                margin-top: 3px;
            }

            .timer-colon {
                font-size: 18px;
                margin: 0 3px;
            }

            .timer-divider {
                height: 35px;
            }
        }

        /* Desktop */
        @media (min-width: 992px) {
            .flash-sale-img {
                height: 160px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .flash-sale-img {
                height: 190px;
            }
        }

        /* Extra Large Desktop */
        @media (min-width: 1400px) {
            .flash-sale-img {
                height: 200px;
            }
        }

        /* Default (Desktop) — tanpa jarak berlebih */
        .flash-sale-img,
        .timer-box {
            margin-bottom: 8px;
        }

        /* Mobile only: tambahkan jarak ekstra agar tidak terlalu rapat */
        @media (max-width: 768px) {

            .flash-sale-img,
            .timer-box {
                margin-bottom: 18px !important;
            }
        }

        /* Perbesar gambar Flash Sale khusus di mobile */
        @media (max-width: 768px) {
            .flash-sale-header img.flash-sale-img {
                width: 150px !important;
                /* perbesar dari ukuran default */
                height: auto !important;
                transform: scale(1.1);
                transition: transform 0.3s ease;
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


    <!-- CAROUSEL SLIDER PROMO HERO SECTION DAN POP UP PROMO-->
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

    <!-- TOP SELLING -->
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
        <!-- TOP SELLING Start -->
        <div class="container-fluid">
            <!-- Wrapper untuk layout 2 kolom dengan CSS FLEX -->
            <div class="section-wrapper">

                <!-- Kolom Kiri: Judul dan Deskripsi -->
                <div class="section-left">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight text-success flex items-center gap-2 mb-2"
                        style="">
                        <img src="{{ asset('images/WEBSITE PRODUK (1).png') }}" alt="Icon"
                            class="w-6 h-6 md:w-8 md:h-8 inline-block">
                        <span>Produk Terlaris</span>
                    </h2>
                    <p class="text-sm md:text-base text-gray-700 mb-6 leading-relaxed mb-2">
                        Produk favorit yang paling diminati pelanggan. Jangan sampai kehabisan!
                    </p>
                    <a href="#"
                        class="text-sm md:text-base font-medium underline hover:no-underline inline-block text-success">
                        Belanja Sekarang
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
                                                {{-- <div class="product-image-container">
                                                    <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                        src="{{ Storage::url($product->main_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                </div> --}}

                                                <div class="product-image-container relative">
                                                    {{-- @if ($product->is_gift ?? false) --}}
                                                    @if ($product->is_gift)
                                                        <span
                                                            class="absolute top-2 left-2 bg-[#FF4081] text-white text-[10px] md:text-[12px] font-semibold px-2 py-1 rounded-full shadow">
                                                            🎁 Free Gift
                                                        </span>
                                                    @endif
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
                                            {{-- <div class="product-image-container">
                                                <img class="product-img card-img-top product-image-home {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                    src="{{ Storage::url($product->main_image) }}"
                                                    alt="{{ $product->product_name }}">
                                            </div> --}}

                                            <div class="product-image-container relative">
                                                {{-- @if ($product->is_gift ?? false) --}}
                                                @if ($product->is_gift)
                                                    <span
                                                        class="absolute top-2 left-2 bg-[#FF4081] text-white text-[10px] md:text-[12px] font-semibold px-2 py-1 rounded-full shadow">
                                                        🎁 Free Gift
                                                    </span>
                                                @endif
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
    </div>
    <!-- TOP SELLING END-->

    {{-- BANNER PROMO --}}
    <div class="px-4 sm:px-8 md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-8 sm:py-12 md:py-16 lg:py-24 mt-4">
        <div class="container-fluid">
            <!-- Two-Column Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 md:gap-10">
                @foreach ($data['popupsBanner'] as $popup)
                    <div class="group cursor-pointer popup-content-wrapper">
                        <div class="popup-banner-container">
                            @if ($popup->media_type === 'image')
                                <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}"
                                    class="absolute top-0 left-0 w-full h-full object-cover">
                            @elseif ($popup->media_type === 'video')
                                <video class="absolute top-0 left-0 w-full h-full object-cover" autoplay loop muted
                                    playsinline>
                                    <source src="{{ Storage::url($popup->media_popup) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                        <div class="mt-4 sm:mt-5 md:mt-6 pb-4 sm:pb-0">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-1"
                                style="font-family: 'The Seasons', serif;">
                                {{ $popup->name ?? 'Untitled Popup' }}
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 mb-2 line-clamp-2"
                                style="font-family: 'Poppins', sans-serif;">
                                {{ $popup->description ?? 'No description available.' }}
                            </p>
                            <a href="#" class="text-xs sm:text-sm font-semibold hover:underline inline-block"
                                style="color: #000; text-decoration: underline;">
                                Shop now
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- BANNER PROMO --}}

    <!-- FLASH SALE -->
    <div class="container-fluid px-0"
        style="position: relative; overflow: hidden; padding: 20px 0 0 0; margin-bottom: 0;"> <!-- padding bawah 0 -->

        <!-- Decorative Grass/Nature Elements at Bottom -->
        <div
            style="position: absolute; bottom: 0; left: 0; width: 100%; height: 80px; background: linear-gradient(to top, rgba(76, 175, 80, 0.3) 0%, transparent 100%);">
        </div>

        <!-- Subtle Cloud/Mist Effects -->
        <div
            style="position: absolute; top: 20%; left: 5%; width: 150px; height: 80px; background: radial-gradient(ellipse, rgba(255,255,255,0.6) 0%, transparent 70%); border-radius: 50%;">
        </div>
        <div
            style="position: absolute; top: 30%; right: 10%; width: 120px; height: 60px; background: radial-gradient(ellipse, rgba(255,255,255,0.5) 0%, transparent 70%); border-radius: 50%;">
        </div>

        <div class="d-flex justify-content-between align-items-center px-2 px-md-4 position-relative" style="z-index: 2;">
            <!-- Left Side: Flash Sale Badge & Timer -->
            <div class="d-flex align-items-center gap-2 gap-md-3 flex-wrap">
                <!-- Flash Sale Logo -->
                <div class="flash-sale-header">
                    <img src="{{ asset('images/flash-sale.png') }}" alt="Flash Sale" class="flash-sale-img"
                        style="width: auto; object-fit: contain; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.2));">
                </div>

                <!-- Status & Timer Box -->
                <div class="timer-box"
                    style="background: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.15);">
                    <div class="d-flex align-items-center gap-2 gap-md-3 flex-wrap flex-md-nowrap">

                        <!-- Now Live Badge -->
                        <div class="live-badge-section">
                            <div class="live-badge"
                                style="background: #C62828; color: white; border-radius: 5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                Now Live
                            </div>
                            <div class="ends-text" style="color: #666; font-weight: 500;">
                                Ends in <span style="color: #C62828; font-weight: 700;">11:44:56</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="timer-divider d-none d-md-block" style="width: 1px; background: #E0E0E0;"></div>

                        <!-- Timer Display -->
                        <div class="d-flex align-items-center gap-1 gap-md-2">
                            <div class="text-center">
                                <div class="timer-digit"
                                    style="background: #B71C1C; color: white; border-radius: 6px; font-weight: 700; box-shadow: 0 2px 5px rgba(183,28,28,0.25);">
                                    00
                                </div>
                                <div class="timer-label" style="color: #999; font-weight: 600;">HOUR</div>
                            </div>
                            <span class="timer-colon" style="color: #B71C1C; font-weight: bold;">:</span>
                            <div class="text-center">
                                <div class="timer-digit"
                                    style="background: #C62828; color: white; border-radius: 6px; font-weight: 700; box-shadow: 0 2px 5px rgba(198,40,40,0.3);">
                                    12
                                </div>
                                <div class="timer-label" style="color: #999; font-weight: 600;">MIN</div>
                            </div>
                            <span class="timer-colon" style="color: #B71C1C; font-weight: bold;">:</span>
                            <div class="text-center">
                                <div class="timer-digit"
                                    style="background: #C62828; color: white; border-radius: 6px; font-weight: 700; box-shadow: 0 2px 5px rgba(198,40,40,0.3);">
                                    00
                                </div>
                                <div class="timer-label" style="color: #999; font-weight: 600;">SEC</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Flash Sale Products Section -->
    <div class="container-fluid flash-sale-section position-relative"
        style="background-image: url('{{ asset('images/bg-flash-sale.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 20px 20px 35px 20px; overflow: hidden; margin-top: -15px; position: relative;">

        <!-- OVERLAY DIHAPUS - Background natural tanpa overlay putih -->

        <!-- Products Slider -->
        <div class="swiper mySwiper position-relative" style="z-index: 2;">
            <div class="swiper-wrapper">
                @if (session('id_user'))
                    @foreach ($data['new'] as $product)
                        <div class="swiper-slide-flash-sale">
                            <!-- CARD DIPERBAIKI - Border radius lebih melengkung -->
                            <div class="rounded-4 overflow-hidden h-fit position-relative"
                                style="background: white; border: none; transition: all 0.3s ease; width: 180px; margin: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 10px !important;"
                                @php
$activePromo = $product->promos->first();
                                    $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                    $discountPercent = 0;
                                    if ($discountedPrice && $product->regular_price > 0) {
                                        $discountPercent = round(
                                            (($product->regular_price - $discountedPrice) / $product->regular_price) *
                                                100,
                                        );
                                    }
                                    $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                    // Tentukan status badge
                                    $statusBadge = '';
                                    $statusColor = '';
                                    $statusBgColor = '';
                                    if ($product->stock_quantity == 0) {
                                        $statusBadge = 'Sold Out';
                                        $statusColor = 'white';
                                        $statusBgColor = '#E91E63';
                                    } elseif ($product->stock_quantity < 100) {
                                        $statusBadge = 'Limited Stock';
                                        $statusColor = 'white';
                                        $statusBgColor = '#2E7D32';
                                    } else {
                                        $statusBadge = 'Available';
                                        $statusColor = 'white';
                                        $statusBgColor = '#4CAF50';
                                    } @endphp
                                <!-- Discount Badge - Border radius lebih melengkung -->
                                @if ($discountPercent > 0)
                                    <div class="position-absolute"
                                        style="top: 10px; left: 10px; background: #4CAF50; color: white; border-radius: 8px; padding: 3px 8px; font-weight: bold; font-size: 11px; z-index: 10;">
                                        {{ $discountPercent }}%
                                    </div>
                                @endif
                                <!-- Wishlist Heart -->
                                <i class="fas fa-heart position-absolute {{ $inWishlist ? 'text-danger' : 'text-dark' }}"
                                    style="top: 10px; right: 10px; font-size: 16px; z-index: 10; cursor: pointer;"
                                    onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                </i>
                                <a href="/{{ $product->product_code }}_product" class="text-decoration-none">
                                    <!-- Product Image - Border radius top lebih melengkung -->
                                    <div class="product-image-container position-relative"
                                        style="height: 200px; overflow: hidden; background: white; padding: 15px; border-radius: 16px 16px 0 0;">
                                        <img class="w-100 h-100 object-fit-contain {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                            src="{{ Storage::url($product->main_image) }}"
                                            alt="{{ $product->product_name }}" style="transition: transform 0.3s ease;">
                                    </div>
                                    <!-- Product Details - Layout sesuai gambar referensi -->
                                    <div class="p-3" style="background: white; border-radius: 0 0 16px 16px;">
                                        <!-- Brand/Category -->
                                        <p class="text-muted mb-2"
                                            style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">
                                            FROM THIS ISLAND
                                        </p>
                                        <!-- Product Name -->
                                        <p class="mb-2"
                                            style="font-size: 13px; color: #333; line-height: 1.4; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-weight: 500;">
                                            {{ $product->product_name }}
                                        </p>
                                        <!-- Pricing -->
                                        <div class="mb-0">
                                            @if ($product->priceVariation !== null)
                                                <p class="m-0"
                                                    style="font-size: 13px; font-weight: 700; color: #E91E63;">
                                                    ⚡ {{ $product->priceVariation }}
                                                </p>
                                            @else
                                                <div class="d-flex align-items-center gap-1 flex-wrap">
                                                    @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                        <!-- Harga normal dicoret -->
                                                        <p class="m-0 text-decoration-line-through"
                                                            style="font-size: 12px; color: #999;">
                                                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </p>

                                                        <!-- Harga promo -->
                                                        <p class="m-0 fw-bold d-flex align-items-center"
                                                            style="font-size: 13px; color: #E91E63;">
                                                            <i class="fas fa-bolt me-1"
                                                                style="color: #FFC107; font-size: 12px;"></i>
                                                            Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                                        </p>
                                                    @else
                                                        <!-- Harga normal (tanpa promo) -->
                                                        <p class="m-0 fw-bold d-flex align-items-center"
                                                            style="font-size: 13px; color: #E91E63;">
                                                            <i class="fas fa-bolt me-1"
                                                                style="color: #FFC107; font-size: 12px;"></i>
                                                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Logged Out View -->
                    @foreach ($data['new'] as $product)
                        <div class="swiper-slide-flash-sale">
                            <div onclick="window.location.href = '/{{ $product->product_code }}_product'"
                                class="bg-white rounded-4 overflow-hidden h-fit hover:cursor-pointer position-relative"
                                style="background: white; border: none; transition: all 0.3s ease; width: 180px; margin: 0 auto; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 10px !important;">
                                @php
                                    $activePromo = $product->promos->first();
                                    $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                    $discountPercent = 0;
                                    if ($discountedPrice && $product->regular_price > 0) {
                                        $discountPercent = round(
                                            (($product->regular_price - $discountedPrice) / $product->regular_price) *
                                                100,
                                        );
                                    }
                                    $statusBadge = '';
                                    $statusColor = '';
                                    $statusBgColor = '';
                                    if ($product->stock_quantity == 0) {
                                        $statusBadge = 'Sold Out';
                                        $statusColor = 'white';
                                        $statusBgColor = '#E91E63';
                                    } elseif ($product->stock_quantity < 100) {
                                        $statusBadge = 'Limited Stock';
                                        $statusColor = 'white';
                                        $statusBgColor = '#2E7D32';
                                    } else {
                                        $statusBadge = 'Available';
                                        $statusColor = 'white';
                                        $statusBgColor = '#4CAF50';
                                    }
                                @endphp
                                @if ($discountPercent > 0)
                                    <div class="position-absolute"
                                        style="top: 10px; left: 10px; background: #4CAF50; color: white; border-radius: 8px; padding: 3px 8px; font-weight: bold; font-size: 11px; z-index: 10;">
                                        {{ $discountPercent }}%
                                    </div>
                                @endif
                                <i class="fas fa-heart position-absolute text-dark"
                                    style="top: 10px; right: 10px; font-size: 16px; z-index: 10; cursor: pointer;"
                                    onclick="event.stopPropagation(); addToWishlist({{ $product->id }})">
                                </i>
                                <div class="product-image-container position-relative"
                                    style="height: 200px; overflow: hidden; background: white; padding: 15px; border-radius: 16px 16px 0 0;">
                                    <img class="w-100 h-100 object-fit-contain {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                        src="{{ Storage::url($product->main_image) }}"
                                        alt="{{ $product->product_name }}" style="transition: transform 0.3s ease;">
                                </div>
                                <div class="p-3" style="background: white; border-radius: 0 0 16px 16px;">
                                    <p class="text-muted mb-2"
                                        style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">
                                        {{ strtoupper($product->brand ? $product->brand->name : 'NO BRAND') }}
                                    </p>

                                    <p class="mb-2"
                                        style="font-size: 13px; color: #333; line-height: 1.4; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-weight: 500;">
                                        {{ $product->product_name }}
                                    </p>
                                    <!-- Pricing -->
                                    <div class="mb-0">
                                        @if ($product->priceVariation !== null)
                                            <p class="m-0" style="font-size: 13px; font-weight: 700; color: #E91E63;">
                                                ⚡ {{ $product->priceVariation }}
                                            </p>
                                        @else
                                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                                @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                    <!-- Harga normal dicoret -->
                                                    <p class="m-0 text-decoration-line-through"
                                                        style="font-size: 12px; color: #999;">
                                                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>

                                                    <!-- Harga promo -->
                                                    <p class="m-0 fw-bold d-flex align-items-center"
                                                        style="font-size: 13px; color: #E91E63;">
                                                        <i class="fas fa-bolt me-1"
                                                            style="color: #FFC107; font-size: 12px;"></i>
                                                        Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                                    </p>
                                                @else
                                                    <!-- Harga normal (tanpa promo) -->
                                                    <p class="m-0 fw-bold d-flex align-items-center"
                                                        style="font-size: 13px; color: #E91E63;">
                                                        <i class="fas fa-bolt me-1"
                                                            style="color: #FFC107; font-size: 12px;"></i>
                                                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Navigation Buttons -->
            <div class="swiper-button-next"
                style="color: white; background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%); width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 3px 10px rgba(46,125,50,0.3);">
            </div>
            <div class="swiper-button-prev"
                style="color: white; background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%); width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 3px 10px rgba(46,125,50,0.3);">
            </div>
        </div>

    </div>
    <!-- FLASH SALE -->

    <!-- PROMO SECTION -->
    <div class="promo-section-wrapper" style="padding: 12px 0; background-color: #f9f9f9;">
        <div class="promo-section container">
            <div class="promo-section-header text-center mb-4">
                <h2 class="fw-bold">
                    Promo Spesial untuk Kamu 🌿
                </h2>
                <p style="font-family: 'Poppins', sans-serif; color: #555; max-width: 900px; margin: 0 auto;">
                    Dapatkan promo menarik untuk melengkapi gaya hidupmu!
                </p>
            </div>


            @if ($data['promos']->count() > 0)
                <!-- Swiper untuk Promo -->
                <div class="swiper myPromoSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($data['promos']->sortByDesc('created_at') as $promo)
                            <div class="swiper-slide">
                                <div class="promo-card-slider"
                                    onclick="window.location.href='/promo/{{ $promo->id }}'">

                                    <div class="promo-banner-container">
                                        <img class="promo-banner-image"
                                            src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}"
                                            alt="{{ $promo->promo_name }}" loading="lazy"
                                            style="width: 100%; object-fit: cover;">
                                    </div>

                                    <div class="promo-content-slider p-3 text-center">
                                        <p class="promo-label text-uppercase text-success fw-bold mb-1"
                                            style="font-size: 0.8rem;">
                                            {{ $promo->type }}
                                        </p>

                                        <h3 class="promo-title-slider fw-semibold"
                                            style="font-size: 1.1rem; color: #333;">
                                            {{ $promo->promo_name }}
                                        </h3>

                                        <!-- Periode Promo -->
                                        <div class="promo-period mb-2 text-muted" style="font-size: 0.8rem;">
                                            <i class="bi bi-calendar-event me-1 text-success"></i>
                                            @if ($promo->start_date)
                                                {{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d M Y') }}
                                            @endif
                                            -
                                            @if ($promo->end_date)
                                                {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                                            @endif
                                        </div>

                                        <p class="promo-desc-slider text-muted" style="font-size: 0.9rem;">
                                            {{ $promo->description }}
                                        </p>
                                        <!-- Ubah tombol menjadi teks -->
                                        <a href="/promo/{{ $promo->id }}"
                                            class="promo-link-slider mt-2 d-inline-flex align-items-center justify-content-center"
                                            onclick="event.stopPropagation()">
                                            <span>Lihat Detail</span>
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <!-- Navigation buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            @else
                <div class="empty-promo text-center text-muted py-4">Tidak ada promo banner tersedia</div>
            @endif

        </div>
    </div>
    <!-- PROMO SECTION END-->

    <!-- BRAND SECTION Start -->
    <div class="container-fluid">
        <div class="section-wrapper">
            <!-- Kolom Kiri: Judul dan Deskripsi -->
            <!-- Kolom Kiri: Judul dan Deskripsi -->
            <div class="section-left">
                <h2
                    class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight text-success flex items-center gap-2 mb-2">
                    <img src="{{ asset('images/WEBSITE PRODUK (1).png') }}" alt="Icon"
                        class="w-6 h-6 md:w-8 md:h-8 inline-block">
                    <span>Top Brand</span>
                </h2>
                <p class="text-sm md:text-base text-gray-700 mb-6 leading-relaxed mb-2">
                    Temukan <span class="font-semibold text-success">brand</span> kecantikan terbaik, dari merek ternama
                    hingga favorit terkini.
                </p>

                <a href="#"
                    class="text-sm md:text-base font-medium underline hover:no-underline inline-block text-success">
                    Lihat Koleksi Brand
                </a>
            </div>

            <!-- Kolom Kanan: Swiper Carousel -->
            <div class="section-right">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($data['brands'] as $brand)
                            <div class="swiper-slide">
                                <div onclick="window.location.href = '/brand/{{ $brand->id }}'"
                                    class="product-card bg-white shadow-sm overflow-hidden hover:cursor-pointer">

                                    <div class="product-image-container relative">
                                        <img class="product-img card-img-top product-image-home"
                                            src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : '/images/no-brand.png' }}"
                                            alt="{{ $brand->name }}">
                                    </div>

                                    <div class="grid text-left p-1 p-md-2">
                                        <p
                                            class="text-decoration-none text-black font-semibold text-[11px] md:text-[13px] lg:text-[14px] xl:text-[15px] mb-1 truncate">
                                            {{ $brand->name }}
                                        </p>
                                        <p
                                            class="text-decoration-none text-muted text-[9px] md:text-[10px] lg:text-[11px] xl:text-[12px]">
                                            {{ $brand->brand_code }}
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
        </div>
    </div>
    <!-- BRAND SECTION End -->

    <!-- curated for you -->
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
        <div class="container-fluid new-arrival-section">
            <div class="promo-section-header text-center mb-4">
                <h2 class="fw-bold">
                    Produk Spesial yang cocok untuk Kamu 🌿
                </h2>

                <p style="font-family: 'Poppins', sans-serif; color: #555; max-width: 900px; margin: 0 auto;">
                    Temukan produk pilihan terbaik yang sesuai dengan gaya dan kebutuhanmu.
                </p>

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

    {{-- CATEGORY --}}
    <div class="container-fluid py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="container">
            <div class="row g-3 g-md-4 align-items-stretch">
                {{-- Title --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="d-flex flex-column justify-content-center h-100 pe-lg-4">
                        <h2 class="d-flex align-items-center gap-2 font-bold leading-tight text-success mb-2"
                            style="font-size: clamp(1.5rem, 3vw, 2.25rem); font-family: 'The Seasons', serif;">

                            <img src="{{ asset('images/WEBSITE PRODUK (1).png') }}" alt="Ikon" class="img-fluid"
                                style="width: 35px; height: 35px; margin-right: 7px;">

                            <span>Kategori Unggulan</span>
                        </h2>

                        <p class="text-muted mb-0"
                            style="font-size: clamp(0.875rem, 1.5vw, 1rem); font-family: 'Poppins', sans-serif;">
                            Dari perawatan rambut hingga wewangian, dan segala sesuatu di antaranya.
                        </p>
                    </div>
                </div>


                {{-- Show only 6 newest categories --}}
                @foreach ($data['categories']->sortByDesc('created_at')->take(5) as $index => $category)
                    @php
                        $colors = ['#FFF5F5', '#F0FFF4', '#FFF9E6', '#F0F9FF', '#FFF0F8', '#FAF5FF'];
                        $iconColors = ['#EF4444', '#10B981', '#F59E0B', '#3B82F6', '#EC4899', '#8B5CF6'];
                        $icons = [
                            'bi bi-brush', // Kosmetik
                            'bi bi-droplet', // Perawatan rambut
                            'bi bi-heart', // Perawatan kulit
                            'bi bi-bag-heart', // Parfum
                            'bi bi-flower3', // Default
                        ];
                        $bgColor = $colors[$index % count($colors)];
                        $iconColor = $iconColors[$index % count($iconColors)];
                        $iconClass = $icons[$index % count($icons)];
                    @endphp

                    <div class="col-6 col-md-3 col-lg-auto flex-lg-fill">
                        <div class="category-card h-100 rounded-3 p-3 p-md-4 text-center position-relative overflow-hidden"
                            style="background-color: {{ $bgColor }}; cursor: pointer; transition: all 0.3s ease;"
                            onclick="window.location.href='/category/{{ $category->id }}'">

                            {{-- Icon --}}
                            <div class="mb-3">
                                <i class="{{ $iconClass }}"
                                    style="font-size: 2rem; color: {{ $iconColor }};"></i>
                            </div>

                            {{-- Category Name --}}
                            <h6 class="fw-semibold mb-0"
                                style="font-size: clamp(0.8rem, 1.2vw, 0.95rem); color: #1a1a1a;">
                                {{ $category->name }}
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- CATEGORY --}}

    {{-- articles --}}
    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 py-2">
        <div class="container-fluid new-arrival-section">
            <div class="promo-section-header text-center mb-4">
                <h2 class="fw-bold" style="font-family: 'The Seasons', serif;">
                    Artikel & Berita untuk Kamu 🌿
                </h2>
                <p style="font-family: 'Poppins', sans-serif; color: #555; max-width: 900px; margin: 0 auto;">
                    Kumpulan artikel dan berita terbaru seputar tren kecantikan serta inspirasi gaya hidup untukmu.
                </p>
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
    </div>
    {{-- articles --}}

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

    {{-- promo swiper --}}
    <script>
        // Initialize Promo Swiper
        document.addEventListener('DOMContentLoaded', function() {
            const promoSwiper = new Swiper('.myPromoSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.myPromoSwiper .swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.myPromoSwiper .swiper-button-next',
                    prevEl: '.myPromoSwiper .swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 25,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                },
            });
        });
    </script>

    {{-- product swiper --}}
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

@extends('user.layouts.master')

@section('content')

    @php
        $wishlist = session('id_user') && $data['wishlist'] !== null ? $data['wishlist'] : [];
    @endphp

    <style>
        /* ==========================================
               WORLD CLASS HOME STYLING (LUXURY GLAMOIRE)
               ========================================== */
        :root {
            --glamoire-dark: #122212;
            --glamoire-light: #FDFDFD;
            --glamoire-accent: #1E3B1E;
            --glamoire-gold: #D4AF37;
            --glamoire-gold-light: #F9E596;
            --glamoire-sand: #F7F5F0;
            --text-main: #1C2321;
            --text-muted: #6B7280;
            --danger-main: #E11D48;
            --success-main: #10B981;
            --transition-smooth: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        body {
            background-color: var(--glamoire-light);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            color: var(--text-main);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'The Seasons', serif;
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

        /* --- Global Utilities --- */
        .section-padding {
            padding: 6rem 0;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: 4rem 0;
            }
        }

        /* --- Modal Perfect Centering Fix --- */
        .modal {
            padding: 0 !important;
            /* Mencegah bootstrap menambahkan padding-right yang membuat modal bergeser ke kiri */
        }

        .modal-dialog.modal-dialog-centered {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto !important;
            min-height: 100vh !important;
            /* Memaksa modal penuh 100% layar secara vertikal */
        }

        .modal-dialog.modal-dialog-centered .modal-content {
            margin: auto !important;
        }

        /* --- Hero Carousel Immersive (PERBAIKAN GAMBAR TERPOTONG) --- */
        .hero-carousel-wrapper {
            width: 100%;
            position: relative;
            background: var(--glamoire-dark);
        }

        .hero-swiper {
            width: 100%;
            height: auto;
        }

        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-swiper img,
        .hero-swiper video {
            width: 100%;
            height: auto;
            max-height: 80vh;
            object-fit: contain;
            object-position: center;
            transition: transform 12s ease;
            transform: scale(1.02);
        }

        .hero-swiper .swiper-slide-active img {
            transform: scale(1);
        }

        .hero-swiper .swiper-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 0%, transparent 35%);
            pointer-events: none;
        }

        .hero-swiper .swiper-pagination-bullet {
            background: #FFF;
            opacity: 0.5;
            width: 40px;
            height: 3px;
            border-radius: 0;
            transition: var(--transition-smooth);
        }

        .hero-swiper .swiper-pagination-bullet-active {
            background: var(--glamoire-gold) !important;
            opacity: 1;
            width: 80px;
        }

        /* --- Floating Trust Badges --- */
        .trust-floating-wrapper {
            position: relative;
            z-index: 10;
            margin-top: -50px;
            padding: 0 15px;
        }

        .trust-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            padding: 2rem 1rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .trust-item {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1rem;
            transition: var(--transition-smooth);
        }

        .trust-item:hover {
            transform: translateY(-5px);
        }

        .trust-icon {
            width: 60px;
            height: 60px;
            background: var(--glamoire-sand);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.5rem;
            box-shadow: inset 0 0 0 1px rgba(212, 175, 55, 0.3);
        }

        .trust-text h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            color: var(--glamoire-dark);
        }

        .trust-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 768px) {
            .trust-floating-wrapper {
                margin-top: -30px;
            }

            .trust-bar {
                padding: 1.5rem 1rem;
                gap: 1.5rem;
            }

            .trust-item {
                min-width: 140px;
            }

            .trust-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .trust-text h4 {
                font-size: 0.95rem;
            }
        }

        /* --- Custom Split Layout --- */
        .split-section-wrapper {
            display: flex;
            align-items: flex-end;
            gap: 4rem;
            width: 100%;
            margin-bottom: 2rem;
        }

        .split-section-left {
            flex: 0 0 350px;
        }

        .split-section-right {
            flex: 1;
            min-width: 0;
        }

        @media (max-width: 991px) {
            .split-section-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 2rem;
            }

            .split-section-left {
                flex: 0 0 auto;
                max-width: 100%;
            }
        }

        .section-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            line-height: 1.05;
            margin-bottom: 1.5rem;
        }

        .section-desc {
            font-size: clamp(1rem, 1.5vw, 1.1rem);
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .link-gold {
            color: var(--glamoire-dark);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
        }

        .link-gold:hover {
            color: var(--glamoire-gold);
            gap: 1.2rem;
        }

        /* --- Full Width Header --- */
        .full-section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .full-section-header h2 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1rem;
        }

        .full-section-header p {
            font-size: clamp(1rem, 1.5vw, 1.1rem);
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            width: 55px !important;
            height: 55px !important;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: var(--glamoire-dark);
            transform: scale(1.1);
            color: var(--glamoire-gold) !important;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.3rem !important;
            font-weight: 900;
        }

        @media (max-width: 768px) {

            .swiper-button-next,
            .swiper-button-prev {
                display: none !important;
            }
        }

        /* --- Luxury Product Card --- */
        .luxury-product-card {
            background: #FFF;
            border-radius: 20px;
            overflow: hidden;
            transition: var(--transition-bounce);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.03);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
        }

        .luxury-product-card:hover {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .lpc-img-box {
            position: relative;
            padding-top: 130%;
            /* Very tall, editorial aspect ratio */
            background: #FAFAFA;
            overflow: hidden;
            cursor: pointer;
        }

        .lpc-img-box img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .luxury-product-card:hover .lpc-img-box img {
            transform: scale(1.1);
        }

        .lpc-img-box.dark-overlay img {
            filter: grayscale(100%) opacity(0.7);
        }

        .lpc-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .badge-discount {
            background: var(--danger-main);
            color: #FFF;
        }

        .badge-gift {
            background: #000;
            color: var(--glamoire-gold);
        }

        .lpc-wishlist {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9CA3AF;
            z-index: 2;
            cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            padding: 0;
        }

        .lpc-wishlist:hover,
        .lpc-wishlist.active {
            color: var(--danger-main);
            transform: scale(1.15);
        }

        .lpc-action-area {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2rem 1.5rem 1.5rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 30%, rgba(255, 255, 255, 0.9) 60%, transparent);
            transform: translateY(100%);
            opacity: 0;
            transition: var(--transition-smooth);
            z-index: 3;
        }

        @media (min-width: 992px) {
            .luxury-product-card:hover .lpc-action-area {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 991px) {
            .lpc-action-area {
                position: static;
                transform: none;
                opacity: 1;
                background: transparent;
                padding: 0 1rem 1rem 1rem;
                margin-top: auto;
            }
        }

        .btn-lpc-action {
            width: 100%;
            padding: 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition-smooth);
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .btn-lpc-add {
            background: var(--glamoire-dark);
            color: #FFF;
        }

        .btn-lpc-add:hover {
            background: var(--glamoire-gold);
            color: var(--glamoire-dark);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-lpc-added {
            background: var(--success-main);
            color: #FFF;
        }

        .btn-lpc-notify {
            background: var(--text-main);
            color: #FFF;
        }

        .lpc-info {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            cursor: pointer;
            text-align: center;
        }

        .lpc-brand {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 700;
            margin-bottom: 0.8rem;
        }

        .lpc-title {
            font-size: 1.15rem;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.3s;
        }

        .luxury-product-card:hover .lpc-title {
            color: var(--glamoire-gold);
        }

        .lpc-price-box {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .lpc-price-current {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            font-family: 'Poppins', sans-serif;
        }

        .lpc-price-discounted {
            color: var(--danger-main);
        }

        .lpc-price-strike {
            font-size: 0.9rem;
            color: #9CA3AF;
            text-decoration: line-through;
        }

        /* --- BRAND MESSAGE SECTION (UI/UX Clean Elegance) --- */
        .brand-statement-section {
            background: linear-gradient(135deg, #FFFFFF 0%, #F4F7F4 100%);
            padding: 8rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            border-top: 1px solid rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }
        .brand-statement-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            color: var(--glamoire-dark);
            font-weight: 500;
            line-height: 1.2;
            max-width: 900px;
            margin: 0 auto 1.5rem;
            text-shadow: none; /* Memastikan tidak ada shadow sesuai catatan UI/UX */
        }
        .brand-statement-text i {
            font-style: italic;
            color: var(--glamoire-gold);
        }
        .brand-statement-subtext {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(0.95rem, 1.5vw, 1.1rem);
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.8;
            font-weight: 400;
        }
        .btn-clean-outline {
            background: transparent;
            color: var(--glamoire-dark);
            border: 1px solid var(--glamoire-dark);
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-clean-outline:hover {
            background: var(--glamoire-dark);
            color: #FFF;
        }

        /* --- Elegant Flash Sale (UI/UX Revision) --- */
        .flash-sale-wrapper {
            background-color: var(--glamoire-sand);
            padding: 5rem 0;
            border-top: 1px solid #E5E7EB;
            border-bottom: 1px solid #E5E7EB;
            position: relative;
            overflow: hidden;
            border-radius: 0;
            box-shadow: none;
        }

        .flash-header {
            position: relative;
            z-index: 2;
        }

        .flash-title {
            font-size: clamp(3rem, 5vw, 4.5rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .timer-flex {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        .timer-block {
            background: #FFF;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 1rem 1.2rem;
            text-align: center;
            min-width: 85px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        .timer-val {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1;
            color: var(--glamoire-dark);
            font-family: 'Poppins', monospace;
        }

        .timer-lbl {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-top: 8px;
        }

        @media (max-width: 991px) {
            .flash-sale-wrapper {
                padding: 3rem 0;
            }

            .flash-header {
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 3rem;
            }
        }

        /* --- Promo Grid Banners --- */
        /* .promo-grid-banner {
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            cursor: pointer;
            background: #000;
        }

        .promo-grid-banner:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .promo-grid-banner img,
        .promo-grid-banner video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.85;
            transition: transform 1.5s ease, opacity 0.5s;
        }

        .promo-grid-banner:hover img,
        .promo-grid-banner:hover video {
            opacity: 1;
            transform: scale(1.08);
        } */

        /* --- 4. PROMO GRID BANNERS (Storytelling / Campaign Revamp) --- */
        .promo-grid-banner {
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 4/3; /* Rasio yang lebih baik untuk mobile agar teks muat */
            display: block;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            transition: var(--transition-bounce);
            cursor: pointer;
            background: var(--glamoire-dark);
            text-align: left;
        }

        @media (min-width: 992px) {
            .promo-grid-banner {
                aspect-ratio: 16/9; /* Kembali ke landscape untuk desktop */
            }
        }

        .promo-grid-banner:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .promo-grid-banner img,
        .promo-grid-banner video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.5s ease;
            z-index: 1;
        }

        .promo-grid-banner:hover img,
        .promo-grid-banner:hover video {
            transform: scale(1.05);
        }

        /* Overlay Gradasi Hitam Transparan Agar Teks Terbaca */
        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            z-index: 2;
        }

        .banner-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2.5rem;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .banner-title {
            font-family: 'Cormorant Garamond', 'The Seasons', serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            color: #FFF;
            font-weight: 600;
            line-height: 1.2;
            margin-bottom: 0.8rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .banner-subtitle {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 1.5rem;
            max-width: 90%;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        .btn-banner-cta {
            background: #FFF;
            color: var(--glamoire-dark);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .promo-grid-banner:hover .btn-banner-cta {
            background: var(--glamoire-gold);
            color: var(--glamoire-dark);
        }

        /* --- Event Cards --- */
        .promo-event-card {
            background: #FFF;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.02);
            transition: var(--transition-bounce);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .promo-event-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .promo-event-img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
        }

        .promo-event-body {
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            align-items: center;
            text-align: center;
            background: #FFF;
        }

        .promo-event-type {
            font-size: 0.8rem;
            color: var(--glamoire-gold);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }

        .promo-event-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1.2rem;
            line-height: 1.3;
            font-family: 'The Seasons', serif;
        }

        .promo-event-date {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-family: 'Poppins', sans-serif;
        }

        /* --- 7. BRAND DIRECTORY (UI/UX Revamp - Marquee Style) --- */
        .brand-section-wrapper {
            background-color: #FFF; /* Memberikan whitespace yang clean */
            padding: 5rem 0;
            border-top: 1px solid rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.03);
            text-align: center;
        }

        .brand-section-header {
            margin-bottom: 3.5rem;
        }

        .brand-section-header h2 {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            color: var(--glamoire-dark);
            font-weight: 700;
        }

        .brand-card-clean {
            background: transparent;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 120px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 16px;
        }

        /* Hover interaction sederhana sesuai catatan UI/UX */
        .brand-card-clean:hover {
            background: var(--glamoire-sand);
            transform: translateY(-5px);
        }

        .brand-logo-clean {
            max-width: 100%;
            max-height: 65px; /* Menjaga ukuran logo tetap konsisten */
            object-fit: contain;
            transition: transform 0.3s ease;
            /* Grayscale dihilangkan agar tampil dengan warna original */
        }

        .brand-card-clean:hover .brand-logo-clean {
            transform: scale(1.08);
        }

        /* Trik agar Swiper berjalan mulus tanpa jeda (Efek Marquee) */
        .brand-slider .swiper-wrapper {
            transition-timing-function: linear !important;
        }

        /* --- Category Section --- */
        /* .category-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 2rem;
        }

        @media (max-width: 1200px) {
            .category-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .cat-card-premium {
            background: #FFF;
            border-radius: 24px;
            padding: 3rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-bounce);
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .cat-card-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--glamoire-dark);
            z-index: -1;
            transform: translateY(100%);
            transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .cat-card-premium:hover {
            border-color: var(--glamoire-dark);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .cat-card-premium:hover::before {
            transform: translateY(0);
        }

        .cat-icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--glamoire-sand);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: var(--transition-smooth);
            font-size: 2rem;
        }

        .cat-card-premium:hover .cat-icon-wrapper {
            background: #FFF;
            transform: scale(1.15) rotate(5deg);
        }

        .cat-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
            transition: color 0.4s;
            font-family: 'Poppins', sans-serif;
        }

        .cat-card-premium:hover .cat-name {
            color: var(--glamoire-gold);
        } */

        /* --- 9. CATEGORY SECTION (UI/UX Revamp - Consistent & Light Hover) --- */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 2rem;
        }

        @media (max-width: 1200px) {
            .category-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        }
        @media (max-width: 768px) {
            .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        }
        @media (max-width: 480px) {
            .category-grid { grid-template-columns: repeat(2, 1fr); }
        }

        .cat-card-premium {
            background: transparent;
            text-align: center;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
        }

        .cat-img-wrapper {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #FFF;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.02);
            transition: var(--transition-smooth);
        }

        .cat-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        /* Hover Interaction Ringan (Sesuai Catatan UI/UX) */
        .cat-card-premium:hover .cat-img-wrapper {
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.15); /* Soft gold shadow */
            transform: translateY(-6px); /* Mengambang ringan ke atas */
            border-color: rgba(212, 175, 55, 0.3);
        }

        .cat-card-premium:hover .cat-img-wrapper img {
            transform: scale(1.08); /* Zoom-in gambar sangat halus */
        }

        .cat-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
            transition: color 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .cat-card-premium:hover .cat-name {
            color: var(--glamoire-gold);
        }

        /* --- 10. EDITORIAL JOURNAL SECTION (UI/UX Revamp) --- */
        .editorial-article-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            cursor: pointer;
        }

        .editorial-img-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 4/5; /* Rasio gambar ala majalah/editorial */
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            background: var(--glamoire-sand);
        }

        .editorial-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .editorial-article-card:hover .editorial-img-wrapper img {
            transform: scale(1.05);
        }

        .editorial-category {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .editorial-content {
            padding: 0 0.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .editorial-meta {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 0.8rem;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .editorial-title {
            font-family: 'Cormorant Garamond', 'The Seasons', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.3;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s;
        }

        .editorial-article-card:hover .editorial-title {
            color: var(--glamoire-gold);
        }

        .editorial-excerpt {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.8rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .editorial-readmore {
            margin-top: auto;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--glamoire-dark);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            display: inline-block;
            align-self: flex-start;
            padding-bottom: 4px;
        }

        .editorial-readmore::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--glamoire-dark);
            transition: width 0.3s ease;
        }

        .editorial-article-card:hover .editorial-readmore::after {
            width: 100%;
        }

        /* --- Editorial Newsletter Section --- */
        /* .newsletter-premium {
            background: var(--glamoire-dark);
            border-radius: 40px;
            padding: 7rem 2rem;
            text-align: center;
            color: #FFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(24, 48, 24, 0.3);
            margin-top: 2rem;
        }

        .newsletter-premium::before {
            content: '';
            position: absolute;
            left: -10%;
            top: -50%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
        }

        .newsletter-premium::after {
            content: '';
            position: absolute;
            right: -5%;
            bottom: -30%;
            width: 300px;
            height: 300px;
            background: url('{{ asset('images/pattern-right.png') }}') no-repeat center;
            background-size: contain;
            opacity: 0.05;
            transform: rotate(-15deg);
        }

        .nl-title {
            font-size: clamp(3rem, 5vw, 4.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
            position: relative;
            z-index: 2;
        }

        .nl-desc {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto 3.5rem;
            line-height: 1.8;
            font-family: 'Poppins', sans-serif;
            position: relative;
            z-index: 2;
        }

        .nl-form {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .nl-input-group {
            display: flex;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nl-input {
            border: none;
            background: transparent;
            padding: 1.2rem 2rem;
            width: 100%;
            font-size: 1.05rem;
            color: #FFF;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }

        .nl-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .nl-btn {
            background: var(--glamoire-gold);
            color: var(--glamoire-dark);
            border: none;
            padding: 0 3rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: var(--transition-bounce);
            cursor: pointer;
            white-space: nowrap;
            font-size: 0.9rem;
        }

        .nl-btn:hover {
            background: #FFF;
            transform: scale(1.05);
        }

        @media (max-width: 576px) {
            .nl-input-group {
                flex-direction: column;
                background: transparent;
                box-shadow: none;
                gap: 15px;
                border: none;
                padding: 0;
            }

            .nl-input {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 50px;
                padding: 1.2rem;
                text-align: center;
            }

            .nl-btn {
                padding: 1.2rem;
                width: 100%;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
        } */

        /* --- 11. EDITORIAL NEWSLETTER SECTION (UI/UX Revamp) --- */
        .newsletter-premium {
            background: var(--glamoire-dark);
            border-radius: 24px; /* Sudut lebih modern, tidak terlalu membulat */
            padding: 6rem 2rem;
            text-align: center;
            color: #FFF;
            position: relative;
            overflow: hidden;
            /* Box-shadow tebal Dihapus sesuai instruksi UI/UX */
            margin-top: 2rem;
        }

        .newsletter-premium::before {
            content: '';
            position: absolute;
            left: -10%;
            top: -50%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
        }

        .newsletter-premium::after {
            content: '';
            position: absolute;
            right: -5%;
            bottom: -30%;
            width: 300px;
            height: 300px;
            background: url('{{ asset('images/pattern-right.png') }}') no-repeat center;
            background-size: contain;
            opacity: 0.05;
            transform: rotate(-15deg);
        }

        .nl-title {
            font-size: clamp(3rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
            position: relative;
            z-index: 2;
        }

        .nl-desc {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto 1.5rem; /* Margin disesuaikan untuk list benefit */
            line-height: 1.8;
            font-family: 'Poppins', sans-serif;
            position: relative;
            z-index: 2;
        }

        /* Tambahan CSS Untuk Benefit List */
        .nl-benefits {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 3rem;
            position: relative;
            z-index: 2;
        }

        .nl-benefits span {
            font-size: 0.9rem;
            color: #FFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .nl-benefits span i {
            color: var(--glamoire-gold);
            font-size: 1.2rem;
        }

        .nl-form {
            max-width: 650px; /* Form dibuat lebih lebar */
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .nl-input-group {
            display: flex;
            background: #FFF; /* Background solid, tanpa border & shadow */
            border-radius: 50px;
            padding: 0.4rem;
        }

        .nl-input {
            border: none;
            background: transparent;
            padding: 1.2rem 2rem;
            width: 100%;
            font-size: 1.1rem; /* Text di dalam input lebih besar */
            color: var(--glamoire-dark);
            outline: none;
            font-family: 'Poppins', sans-serif;
        }

        .nl-input::placeholder {
            color: #9CA3AF;
        }

        .nl-btn {
            background: var(--glamoire-gold);
            color: var(--glamoire-dark);
            border: none;
            padding: 0 3rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: var(--transition-smooth);
            cursor: pointer;
            white-space: nowrap;
            font-size: 0.95rem; /* Text button lebih besar */
        }

        .nl-btn:hover {
            background: var(--glamoire-dark);
            color: var(--glamoire-gold);
        }

        @media (max-width: 576px) {
            .nl-benefits {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
            .nl-input-group {
                flex-direction: column;
                background: transparent;
                padding: 0;
                gap: 12px;
            }
            .nl-input {
                background: #FFF;
                border-radius: 50px;
                text-align: center;
            }
            .nl-btn {
                padding: 1.2rem;
                width: 100%;
            }
        }

        /* --- 2. CORE MESSAGE SECTION (TRUST INDICATORS) --- */
        .core-message-section {
            background-color: #F4F7F4;
            /* Very soft green sesuai arahan UI/UX */
            padding: 4.5rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .core-message-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            align-items: start;
        }

        .core-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.2rem;
            transition: transform 0.3s ease;
        }

        .core-item:hover {
            transform: translateY(-5px);
        }

        .core-icon {
            font-size: 2.2rem;
            /* Trik CSS membuat icon solid menjadi minimal outline style */
            color: transparent;
            -webkit-text-stroke: 1.2px var(--glamoire-dark);
            opacity: 0.8;
        }

        .core-text {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--glamoire-dark);
            line-height: 1.5;
            letter-spacing: 0.5px;
        }

        @media (max-width: 991px) {
            .core-message-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 3rem 2rem;
            }
        }

        @media (max-width: 576px) {
            .core-message-section {
                padding: 3rem 0;
            }

            .core-icon {
                font-size: 1.8rem;
                -webkit-text-stroke: 1px var(--glamoire-dark);
            }

            .core-text {
                font-size: 0.85rem;
            }
        }

        /* CSS Khusus Overrides untuk Premium Product Card sesuai UI/UX Notes */
        .luxury-product-card {
            background: transparent;
            border: none;
            box-shadow: none;
            display: flex;
            flex-direction: column;
            height: 100%;
            cursor: pointer;
        }

        .luxury-product-card:hover {
            transform: none;
            box-shadow: none;
        }

        .lpc-visual {
            position: relative;
            width: 100%;
            aspect-ratio: 4/5;
            /* Membuat gambar lebih besar dan proporsional */
            background-color: var(--glamoire-sand);
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .lpc-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .luxury-product-card:hover .lpc-visual img {
            transform: scale(1.05);
            /* Simple hover interaction */
        }

        /* Minimal Badge & Wishlist */
        .lpc-minimal-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--glamoire-dark);
            color: #FFF;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 2;
        }

        .lpc-wishlist-icon {
            position: absolute;
            top: 12px;
            right: 12px;
            color: var(--text-muted);
            font-size: 1.2rem;
            z-index: 2;
            background: none;
            border: none;
            transition: color 0.3s;
        }

        .lpc-wishlist-icon:hover,
        .lpc-wishlist-icon.active {
            color: var(--danger-main);
        }

        /* Simple Hover CTA Layer */
        .lpc-simple-cta-layer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 0.95) 0%, transparent 100%);
            transform: translateY(10px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 3;
        }

        @media (min-width: 992px) {
            .luxury-product-card:hover .lpc-simple-cta-layer {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 991px) {
            .lpc-simple-cta-layer {
                display: none;
                /* Hide hover layer on mobile, rely on full card click */
            }
        }

        .btn-clean-cta {
            width: 100%;
            background: var(--glamoire-dark);
            color: #FFF;
            border: none;
            padding: 0.8rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.3s;
        }

        .btn-clean-cta:hover {
            background: var(--glamoire-gold);
            color: var(--glamoire-dark);
        }

        /* Text Whitespace & Hierarchy */
        .lpc-details {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 0 0.5rem;
            /* Memberikan whitespace */
        }

        .lpc-clean-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.3rem;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .lpc-clean-benefit {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.8rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .lpc-clean-price {
            margin-top: auto;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--glamoire-dark);
        }

        .lpc-clean-price-strike {
            font-size: 0.8rem;
            color: #9CA3AF;
            text-decoration: line-through;
            margin-right: 8px;
            font-weight: 400;
        }

        .lpc-clean-price-discount {
            color: var(--danger-main);
        }
    </style>

    <!-- Welcome Modal PERBAIKAN UKURAN (Tambahan scrollable & resize image) -->
    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="mx-auto modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 500px;">
                <div class="overflow-hidden border-0 modal-content"
                    style="border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
                    <div class="p-0 modal-body position-relative">
                        <button type="button" class="top-0 m-3 btn-close position-absolute end-0 z-3"
                            data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="h-auto w-100"
                                style="object-fit: cover; max-height: 280px;">
                        @endif
                        <div class="p-4 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="mb-2 fw-bold"
                                style="font-family: 'The Seasons', serif; color: var(--glamoire-gold); font-size: 1.7rem;">
                                {{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-3 opacity-85"
                                style="font-size: 0.9rem; line-height: 1.5; color: rgba(255,255,255,0.8);">
                                {{ $data['popups'][0]->description ?? 'Dapatkan penawaran eksklusif khusus pendaftaran pertama Anda hari ini.' }}
                            </p>
                            <a href="/login" class="px-4 py-2 btn btn-light rounded-pill fw-bold w-100"
                                style="font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                onmouseover="this.style.background='var(--glamoire-gold)'; this.style.color='var(--glamoire-dark)';"
                                onmouseout="this.style.background='white'; this.style.color='black';">Daftar & Klaim
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Promo Modal PERBAIKAN UKURAN -->
    @if (session('id_user') && $data['promoModal'] !== null)
        <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
            <div class="mx-auto modal-dialog modal-lg modal-dialog-centered">
                <div class="bg-transparent border-0 modal-content" style="max-width: 600px;">
                    <div class="p-0 text-center modal-body position-relative">
                        <button type="button" class="top-0 m-3 btn-close position-absolute end-0 z-3"
                            data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="shadow-lg cursor-pointer img-fluid rounded-4"
                                style="max-height: 80vh; object-fit: contain; transition: transform 0.4s;"
                                onmouseover="this.style.transform='scale(1.02)'"
                                onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- 1. HERO SECTION -->
    {{-- <div class="hero-carousel-wrapper reveal">
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                @foreach ($data['promos'] as $promo)
                    <div class="swiper-slide" onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
                        <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name }}" loading="lazy">
                    </div>
                @endforeach
                @foreach ($data['popups'] as $popup)
                    @if ($popup->media_type === 'image' && $popup->display_type !== 'popup')
                        <div class="swiper-slide">
                            <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}" loading="lazy">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-button-next d-none d-md-flex"></div>
            <div class="swiper-button-prev d-none d-md-flex"></div>
            <div class="mb-3 swiper-pagination"></div>
        </div>
    </div> --}}

    <!-- 1. HERO SECTION (Proportional & Premium Assets) -->
    <div class="hero-carousel-wrapper reveal">
        <style>
            /* Sedikit penyesuaian agar tag picture tampil penuh menyesuaikan aspect-ratio */
            .hero-swiper picture {
                width: 100%;
                height: 100%;
                display: block;
            }
        </style>
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">

                <!-- SLIDE 1: Premium Campaign (Dari Asset) -->
                <div class="swiper-slide" onclick="window.location.href='/shop'">
                    <picture>
                        <!-- Gambar proporsional khusus Desktop (Saran ukuran: 1920 x 820 px) -->
                        <img src="{{ asset('images/glamoirebanner.jpg') }}" alt="Discover Glamoire Cosmetics"
                            loading="lazy">
                    </picture>
                </div>

                <!-- SLIDE 2: Seasonal / Special Promo (Dari Asset) -->
                {{-- <div class="swiper-slide" onclick="window.location.href='/promotion'">
                    <picture>
                        <img src="{{ asset('images/banner-desktop-2.jpg') }}" alt="New Arrival Plant-Based Skincare" loading="lazy">
                    </picture>
                </div> --}}

                <!-- SLIDE 3: Seasonal / Special Promo (Dari Asset) -->
                {{-- <div class="swiper-slide" onclick="window.location.href='/promotion'">
                    <picture>
                        <img src="{{ asset('images/banner-desktop-3.jpg') }}" alt="New Arrival Plant-Based Skincare" loading="lazy">
                    </picture>
                </div> --}}

                <!-- SLIDE 4: Seasonal / Special Promo (Dari Asset) -->
                {{-- <div class="swiper-slide" onclick="window.location.href='/promotion'">
                    <picture>
                        <img src="{{ asset('images/banner-desktop-4.jpg') }}" alt="New Arrival Plant-Based Skincare" loading="lazy">
                    </picture>
                </div> --}}

                <!-- SLIDE 3: Dynamic Promos (Tetap memanggil data dari database agar fitur Admin tidak mati) -->
                {{-- @foreach ($data['promos'] as $promo)
                    <div class="swiper-slide" onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
                        <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->promo_name }}" loading="lazy">
                    </div>
                @endforeach --}}

            </div>
            <!-- Navigasi Slider -->
            <div class="swiper-button-next d-none d-md-flex"></div>
            <div class="swiper-button-prev d-none d-md-flex"></div>
            <div class="mb-3 swiper-pagination"></div>
        </div>
    </div>

    <!-- 2. THE GLAMOIRE PROMISE (Scrolling Marquee) -->
    {{-- <div class="glamoire-promise-bar reveal">
        <div class="promise-track">
            <!-- Repeated for seamless loop -->
            <span class="promise-item"><i class="fas fa-leaf"></i> 100% Plant-Based</span>
            <span class="promise-item"><i class="fas fa-check-circle"></i> BPOM Approved</span>
            <span class="promise-item"><i class="fas fa-gem"></i> Guaranteed Authentic</span>
            <span class="promise-item"><i class="fas fa-paw"></i> Cruelty Free</span>

            <span class="promise-item"><i class="fas fa-leaf"></i> 100% Plant-Based</span>
            <span class="promise-item"><i class="fas fa-check-circle"></i> BPOM Approved</span>
            <span class="promise-item"><i class="fas fa-gem"></i> Guaranteed Authentic</span>
            <span class="promise-item"><i class="fas fa-paw"></i> Cruelty Free</span>
        </div>
    </div> --}}

    <!-- 2. CORE MESSAGE SECTION -->
    <section class="core-message-section reveal">
        <div class="container-fluid md:px-20 lg:px-24 xl:px-24 2xl:px-48">
            <div class="core-message-grid">
                <div class="core-item">
                    <i class="fas fa-leaf core-icon"></i>
                    <span class="core-text">Plant-Based<br>Ingredients</span>
                </div>
                <div class="core-item">
                    <i class="fas fa-certificate core-icon"></i>
                    <span class="core-text">BPOM<br>Certified</span>
                </div>
                <div class="core-item">
                    <i class="fas fa-paw core-icon"></i>
                    <span class="core-text">Cruelty-Free<br>Products</span>
                </div>
                <div class="core-item">
                    <i class="fas fa-shield-alt core-icon"></i>
                    <span class="core-text">Authentic<br>Products</span>
                </div>
            </div>
        </div>
    </section>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <!-- 3. TOP SELLING -->
        {{-- <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="section-title">Best<br><span style="color: var(--glamoire-gold); font-style:italic;">Sellers.</span></h2>
                        <p class="section-desc">Koleksi mahakarya yang paling dicintai. Elevasi rutinitas kecantikan Anda dengan produk ikonis Glamoire.</p>
                        <a href="/shop" class="link-gold">Shop The Collection <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right">
                        <div class="swiper top-selling-slider product-slider" style="padding-bottom: 3rem; padding-top: 1rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['topsell'] as $product)
                                    @php
                                        $activePromo = $product->promos->first();
                                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                        $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
                                        $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                        $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                                    @endphp

                                    <div class="h-auto swiper-slide">
                                        <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                            <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                @if ($product->is_gift ?? false)
                                                    <span class="lpc-badge badge-gift"><i class="fas fa-gift me-1"></i> Gift</span>
                                                @elseif ($discountPercent > 0)
                                                    <span class="lpc-badge badge-discount">-{{ $discountPercent }}%</span>
                                                @endif

                                                <button class="lpc-wishlist {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                                </button>

                                                <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                                                <div class="lpc-action-area">
                                                    @if (session('id_user'))
                                                        @if ($product->stock_quantity == 0)
                                                            <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})" class="btn-lpc-action btn-lpc-notify">
                                                                <i class="fas fa-bell"></i> Notify Me
                                                            </button>
                                                        @else
                                                            @if ($inCart)
                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-lpc-action btn-lpc-added">
                                                                    <i class="fas fa-check"></i> In Cart
                                                                </button>
                                                            @else
                                                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-lpc-action btn-lpc-add">
                                                                    <i class="fas fa-shopping-bag"></i> Add to Cart
                                                                </button>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <button onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-lpc-action btn-lpc-add">
                                                            Login to Buy
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="lpc-info">
                                                <div class="lpc-brand">{{ $product->brand ? $product->brand->name : 'Glamoire' }}</div>
                                                <a href="/{{ $product->product_code }}_product" class="lpc-title">{{ $product->product_name }}</a>
                                                <div class="lpc-price-box">
                                                    @if ($product->priceVariation !== null)
                                                        <span class="lpc-price-current">{{ $product->priceVariation }}</span>
                                                    @else
                                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                            <span class="lpc-price-strike">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                            <span class="lpc-price-current lpc-price-discounted">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                        @else
                                                            <span class="lpc-price-current">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next d-none d-md-flex"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="section-title">Best<br><span
                                style="color: var(--glamoire-gold); font-style:italic;">Sellers.</span></h2>
                        <p class="section-desc">Koleksi mahakarya yang paling dicintai. Elevasi rutinitas kecantikan Anda
                            dengan produk ikonis Glamoire.</p>
                        <a href="/shop" class="link-gold">Shop The Collection <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right">
                        <div class="swiper top-selling-slider product-slider"
                            style="padding-bottom: 3rem; padding-top: 1rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['topsell'] as $product)
                                    @php
                                        $activePromo = $product->promos->first();
                                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                        $discountPercent =
                                            $discountedPrice && $product->regular_price > 0
                                                ? round(
                                                    (($product->regular_price - $discountedPrice) /
                                                        $product->regular_price) *
                                                        100,
                                                )
                                                : 0;
                                        $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                        $inCart = isset($cartItems)
                                            ? collect($cartItems)->contains('product_id', $product->id)
                                            : false;
                                    @endphp

                                    <div class="h-auto swiper-slide">
                                        <!-- Product Card Ideal Structure -->
                                        <div class="luxury-product-card"
                                            onclick="window.location.href = '/{{ $product->product_code }}_product'">

                                            <!-- Product Image -->
                                            <div
                                                class="lpc-visual {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                <!-- Maksimal 1 Badge -->
                                                @if ($discountPercent > 0)
                                                    <span class="lpc-minimal-badge">-{{ $discountPercent }}%</span>
                                                @elseif ($product->is_gift ?? false)
                                                    <span class="lpc-minimal-badge"
                                                        style="background:#000; color:var(--glamoire-gold);">Gift</span>
                                                @endif

                                                <button class="lpc-wishlist-icon {{ $inWishlist ? 'active' : '' }}"
                                                    onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                                </button>

                                                <img src="{{ Storage::url($product->main_image) }}"
                                                    alt="{{ $product->product_name }}">

                                                <!-- CTA Button (Sederhana via hover) -->
                                                <div class="lpc-simple-cta-layer">
                                                    @if (session('id_user'))
                                                        @if ($product->stock_quantity == 0)
                                                            <button
                                                                onclick="event.stopPropagation(); notifyMe({{ $product->id }})"
                                                                class="btn-clean-cta"
                                                                style="background:var(--text-muted);">Notify Me</button>
                                                        @else
                                                            @if ($inCart)
                                                                <button
                                                                    onclick="event.stopPropagation(); window.location.href='/cart'"
                                                                    class="btn-clean-cta"
                                                                    style="background:var(--success-main);">In
                                                                    Cart</button>
                                                            @else
                                                                <button
                                                                    onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                                                                    class="btn-clean-cta">Add to Cart</button>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <button onclick="event.stopPropagation();" data-bs-toggle="modal"
                                                            data-bs-target="#loginUser1" class="btn-clean-cta">Login to
                                                            Buy</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="lpc-details">
                                                <!-- Product Name -->
                                                <h3 class="lpc-clean-title">{{ $product->product_name }}</h3>

                                                <!-- Short Benefit -->
                                                <p class="lpc-clean-benefit">
                                                    {{ $product->short_description ?? 'Formulated for your natural beauty and daily skin glow.' }}
                                                </p>

                                                <!-- Price -->
                                                <div class="lpc-clean-price">
                                                    @if ($product->priceVariation !== null)
                                                        <span>{{ $product->priceVariation }}</span>
                                                    @else
                                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                            <span class="lpc-clean-price-strike">Rp
                                                                {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                            <span class="lpc-clean-price-discount">Rp
                                                                {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                        @else
                                                            <span>Rp
                                                                {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next d-none d-md-flex"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- 3. TOP SELLING -->
        <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="section-title">Best<br><span style="color: var(--glamoire-gold); font-style:italic;">Sellers.</span></h2>
                        <p class="section-desc">Koleksi mahakarya yang paling dicintai. Elevasi rutinitas kecantikan Anda dengan produk ikonis Glamoire.</p>
                        <a href="/shop" class="link-gold">Shop The Collection <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right">
                        <div class="swiper top-selling-slider product-slider" style="padding-bottom: 3rem; padding-top: 1rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['topsell'] as $product)
                                    @php
                                        $activePromo = $product->promos->first();
                                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                        $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
                                        $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                        $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                                    @endphp

                                    <div class="h-auto swiper-slide">
                                        <!-- Product Card Ideal Structure -->
                                        <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">

                                            <!-- Product Image -->
                                            <div class="lpc-visual {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                <!-- Maksimal 1 Badge -->
                                                @if ($discountPercent > 0)
                                                    <span class="lpc-minimal-badge">-{{ $discountPercent }}%</span>
                                                @elseif ($product->is_gift ?? false)
                                                    <span class="lpc-minimal-badge" style="background:#000; color:var(--glamoire-gold);">Gift</span>
                                                @endif

                                                <button class="lpc-wishlist-icon {{ $inWishlist ? 'active' : '' }}" onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                                </button>

                                                <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                                                <!-- CTA Button (Sederhana via hover) -->
                                                <div class="lpc-simple-cta-layer">
                                                    @if (session('id_user'))
                                                        @if ($product->stock_quantity == 0)
                                                            <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})" class="btn-clean-cta" style="background:var(--text-muted);">Notify Me</button>
                                                        @else
                                                            @if($inCart)
                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-clean-cta" style="background:var(--success-main);">In Cart</button>
                                                            @else
                                                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-clean-cta">Add to Cart</button>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <button onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-clean-cta">Login to Buy</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="lpc-details">
                                                <!-- Product Name -->
                                                <h3 class="lpc-clean-title">{{ $product->product_name }}</h3>

                                                <!-- Short Benefit -->
                                                <p class="lpc-clean-benefit">
                                                    {{ $product->short_description ?? 'Formulated for your natural beauty and daily skin glow.' }}
                                                </p>

                                                <!-- Price (DIPERBAIKI: Menggunakan d-flex column agar tersusun vertikal & tanpa enter/spasi) -->
                                                <div class="mt-auto lpc-clean-price d-flex flex-column align-items-center justify-content-center">
                                                    @if ($product->priceVariation !== null)
                                                        <span>{{ $product->priceVariation }}</span>
                                                    @else
                                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                            <span class="lpc-clean-price-strike" style="margin-right:0; margin-bottom:2px;">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                            <span class="lpc-clean-price-discount text-danger fw-bold">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                        @else
                                                            <span class="fw-bold" style="color: var(--glamoire-dark);">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next d-none d-md-flex"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. BANNER PROMO GRID -->
        {{-- @if (count($data['popupsBanner']) > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="row g-4">
                        @foreach ($data['popupsBanner'] as $index => $popup)
                            <div class="col-12 col-md-6">
                                <div class="promo-grid-banner">
                                    @if ($popup->media_type === 'image')
                                        <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}">
                                    @elseif ($popup->media_type === 'video')
                                        <video autoplay loop muted playsinline>
                                            <source src="{{ Storage::url($popup->media_popup) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif --}}

        @if (count($data['popupsBanner']) > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="mb-5 full-section-header">
                        <h2>Our Campaigns</h2>
                    </div>

                    <div class="row g-4">
                        @foreach ($data['popupsBanner'] as $index => $popup)
                            <div class="col-12 col-md-6">
                                <div class="promo-grid-banner" onclick="window.location.href='/shop'">

                                    @if ($popup->media_type === 'image')
                                        <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}">
                                    @elseif ($popup->media_type === 'video')
                                        <video autoplay loop muted playsinline>
                                            <source src="{{ Storage::url($popup->media_popup) }}" type="video/mp4">
                                        </video>
                                    @endif

                                    <div class="banner-overlay"></div>
                                    <div class="banner-content">
                                        <h3 class="banner-title">{{ $popup->name ?? 'Beauty That Respects Nature.' }}</h3>
                                        <p class="banner-subtitle">{{ $popup->description ?? 'Your skin deserves gentle ingredients. Minimal ingredients, maximum confidence.' }}</p>
                                        <button class="btn-banner-cta">Explore Campaign <i class="fas fa-arrow-right"></i></button>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </div> <!-- Close Container for full width parallax -->

    <!-- NEW: PARALLAX CAMPAIGN DIVIDER -->
    {{-- <div class="campaign-parallax reveal">
        <!-- Using a placeholder luxury beauty video. Replace src with your actual campaign video url -->
        <video autoplay loop muted playsinline>
            <source
                src="https://cdn.pixabay.com/vimeo/74735398/makeup-131102.mp4?width=1280&hash=8b584d4367c30d310e53cd270e599b531475759e"
                type="video/mp4">
        </video>
        <div class="campaign-content">
            <h2>Discover Your Radiance</h2>
            <p class="text-black">Memadukan kemurnian alam dengan inovasi sains. Glamoire menghadirkan perawatan kulit yang
                mentransformasi kecantikan sejati Anda.</p>
            <a href="/about" class="btn-campaign">Our Story</a>
        </div>
    </div> --}}

    <!-- BRAND MESSAGE SECTION (Revisi Quote Section) -->
    <section class="brand-statement-section reveal">
        <h2 class="brand-statement-text">
            "Rooted in Nature,<br><i>Designed for Your Everyday Glow.</i>"
        </h2>
        <p class="brand-statement-subtext">
            Memadukan kemurnian alam dengan inovasi sains. Glamoire menghadirkan perawatan kulit yang mentransformasi kecantikan sejati Anda.
        </p>
        <a href="/about" class="btn-clean-outline">Our Story</a>
    </section>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <!-- 5. FLASH SALE (Cinematic) -->
        {{-- <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="flash-sale-wrapper">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-4 flash-header">
                            <h2 class="flash-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
                            <p class="mb-0" style="font-size: 1.1rem; opacity:0.8; font-family:'Poppins', sans-serif;">
                                Penawaran super kilat eksklusif. Kesempatan terbatas untuk mengoleksi produk impian Anda.
                            </p>
                            <div class="timer-flex">
                                <div class="timer-block">
                                    <div class="timer-val">08</div>
                                    <div class="timer-lbl">Hours</div>
                                </div>
                                <span class="fs-2 fw-bold" style="color: var(--glamoire-gold);">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">45</div>
                                    <div class="timer-lbl">Mins</div>
                                </div>
                                <span class="fs-2 fw-bold" style="color: var(--glamoire-gold);">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">12</div>
                                    <div class="timer-lbl">Secs</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 col-12 col-xl-8 mt-xl-0">
                            <div class="pb-0 swiper flash-sale-slider product-slider"
                                style="padding-top: 1rem; padding-bottom: 2rem;">
                                <div class="swiper-wrapper">
                                    @foreach ($data['new']->take(6) as $product)
                                        @php
                                            $activePromo = $product->promos->first();
                                            $discountedPrice = $activePromo
                                                ? $activePromo->pivot->discounted_price
                                                : $product->regular_price * 0.75; // Mock flash discount
                                            $discountPercent = round(
                                                (($product->regular_price - $discountedPrice) /
                                                    $product->regular_price) *
                                                    100,
                                            );
                                        @endphp
                                        <div class="h-auto swiper-slide">
                                            <div class="luxury-product-card"
                                                onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                <div
                                                    class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                    <span class="lpc-badge bg-warning text-dark"><i
                                                            class="fas fa-bolt me-1"></i> {{ $discountPercent }}%</span>
                                                    <img src="{{ Storage::url($product->main_image) }}"
                                                        alt="{{ $product->product_name }}">

                                                    <!-- Stock Progress Bar -->
                                                    <div class="bottom-0 px-4 pb-4 position-absolute start-0 w-100 z-3">
                                                        <div
                                                            class="mb-2 d-flex justify-content-between align-items-center">
                                                            <span class="text-danger fw-bold"
                                                                style="font-size: 0.75rem; background: rgba(255,255,255,0.95); padding: 4px 12px; border-radius: 50px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">Hampir
                                                                Habis!</span>
                                                        </div>
                                                        <div class="progress"
                                                            style="height: 6px; background: rgba(0,0,0,0.4); border-radius: 10px; backdrop-filter:blur(4px);">
                                                            <div class="progress-bar bg-danger"
                                                                style="width: 85%; border-radius: 10px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pb-4 text-center lpc-info">
                                                    <div class="lpc-price-box">
                                                        <span class="lpc-price-strike" style="font-size:0.95rem;">Rp
                                                            {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        <span class="lpc-price-current lpc-price-discounted"
                                                            style="font-size: 1.5rem;">Rp
                                                            {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- 5. FLASH SALE (UI/UX Elegant & Realtime) -->
        @if(isset($data['flashSaleProducts']) && count($data['flashSaleProducts']) > 0)
        <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="flash-sale-wrapper" style="background-color: var(--glamoire-sand); padding: 5rem 0; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB;">
                    <!-- Data attribut untuk javascript timer -->
                    <div class="row align-items-center" id="flash-sale-container" data-endtime="{{ $data['flashSaleEndTime'] }}">

                        <!-- Header & Timer -->
                        <div class="col-12 col-xl-3 flash-header ps-xl-5">
                            <h2 class="flash-title" style="font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 600; color: var(--glamoire-dark); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 15px;">
                                Flash Sale.
                            </h2>
                            <p class="mb-0" style="font-size: 0.95rem; color: var(--text-muted); line-height: 1.6;">Penawaran eksklusif. Kesempatan terbatas untuk mengoleksi produk impian Anda.</p>

                            <div class="timer-flex" style="display: flex; align-items: center; gap: 0.8rem; margin-top: 2rem;">
                                <div class="timer-block" style="background: #FFF; border: 1px solid #E5E7EB; padding: 0.8rem 1rem; text-align: center; min-width: 70px;">
                                    <div class="timer-val" id="fs-hours" style="font-size: 1.8rem; font-weight: 600; line-height: 1; color: var(--glamoire-dark); font-family: 'Plus Jakarta Sans', monospace;">00</div>
                                    <div class="timer-lbl" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-top: 5px;">Hours</div>
                                </div>
                                <span class="fs-4 text-muted">:</span>
                                <div class="timer-block" style="background: #FFF; border: 1px solid #E5E7EB; padding: 0.8rem 1rem; text-align: center; min-width: 70px;">
                                    <div class="timer-val" id="fs-mins" style="font-size: 1.8rem; font-weight: 600; line-height: 1; color: var(--glamoire-dark); font-family: 'Plus Jakarta Sans', monospace;">00</div>
                                    <div class="timer-lbl" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-top: 5px;">Mins</div>
                                </div>
                                <span class="fs-4 text-muted">:</span>
                                <div class="timer-block" style="background: #FFF; border: 1px solid #E5E7EB; padding: 0.8rem 1rem; text-align: center; min-width: 70px;">
                                    <div class="timer-val" id="fs-secs" style="font-size: 1.8rem; font-weight: 600; line-height: 1; color: var(--danger-main); font-family: 'Plus Jakarta Sans', monospace;">00</div>
                                    <div class="timer-lbl" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-top: 5px;">Secs</div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Slider (Maks 3.5 Card Desktop) -->
                        <div class="mt-5 col-12 col-xl-9 mt-xl-0">
                            <div class="swiper flash-sale-slider product-slider" style="padding-bottom: 2rem;">
                                <div class="swiper-wrapper">
                                    @foreach ($data['flashSaleProducts'] as $fsProduct)
                                        @php
                                            $discountPercent = round((($fsProduct->regular_price - $fsProduct->flash_sale_price) / $fsProduct->regular_price) * 100);
                                            // Asumsi logika sisa stock (bisa disesuaikan dengan limit flash sale Anda)
                                            $stockLeft = $fsProduct->stock_quantity;
                                            // Simulasi bar progress: Anggap batas flash sale adalah 50 pcs (Ubah angka 50 sesuai logic bisnis Anda)
                                            $stockPercent = ($stockLeft / 50) * 100;
                                            if($stockPercent > 100) $stockPercent = 100;
                                        @endphp
                                        <div class="h-auto swiper-slide">
                                            <div class="luxury-product-card" style="background: transparent; border: none; box-shadow: none;" onclick="window.location.href = '/{{ $fsProduct->product_code }}_product'">
                                                <div class="lpc-visual" style="position: relative; aspect-ratio: 4/5; overflow: hidden; background: #FFF; border: 1px solid #E5E7EB;">
                                                    <span class="lpc-minimal-badge" style="background: var(--danger-main); color: #FFF; position: absolute; top: 12px; left: 12px; font-size: 0.7rem; font-weight: 600; padding: 4px 10px; z-index: 2;">-{{ $discountPercent }}%</span>

                                                    <img src="{{ Storage::url($fsProduct->main_image) }}" alt="{{ $fsProduct->product_name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                                                </div>

                                                <div class="lpc-details" style="padding: 0.5rem;">
                                                    <h3 class="lpc-clean-title" style="font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; font-weight: 600; margin-bottom: 0.3rem;">{{ $fsProduct->product_name }}</h3>

                                                    <div class="mt-2 lpc-clean-price d-flex flex-column align-items-start">
                                                        <span class="lpc-clean-price-strike" style="font-size: 0.8rem; color: #9CA3AF; text-decoration: line-through;">Rp {{ number_format($fsProduct->regular_price, 0, ',', '.') }}</span>
                                                        <span class="lpc-clean-price-discount fw-bold text-danger" style="font-size: 1.1rem;">Rp {{ number_format($fsProduct->flash_sale_price, 0, ',', '.') }}</span>
                                                    </div>

                                                    <!-- Elegant Stock Indicator -->
                                                    <div class="mt-3 w-100">
                                                        <div style="height: 4px; background: #E5E7EB; width: 100%; border-radius: 4px; overflow: hidden;">
                                                            <div style="height: 100%; background: var(--glamoire-dark); width: {{ $stockPercent }}%;"></div>
                                                        </div>
                                                        <span style="font-size: 0.75rem; color: var(--danger-main); margin-top: 6px; font-weight: 600; display: block; font-family: 'Plus Jakarta Sans', sans-serif;">
                                                            🔥 Tersisa {{ $stockLeft }} item
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Navigation -->
                                <div class="swiper-button-next d-none d-md-flex" style="right: 10px;"></div>
                                <div class="swiper-button-prev d-none d-md-flex" style="left: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Javascript Untuk Timer Flash Sale Realtime -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fsContainer = document.getElementById('flash-sale-container');
                if(!fsContainer) return;

                const endTimeString = fsContainer.getAttribute('data-endtime');
                if(!endTimeString) return;

                const countDownDate = new Date(endTimeString).getTime();

                const timerInterval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countDownDate - now;

                    if (distance < 0) {
                        clearInterval(timerInterval);
                        document.getElementById("fs-hours").innerHTML = "00";
                        document.getElementById("fs-mins").innerHTML = "00";
                        document.getElementById("fs-secs").innerHTML = "00";
                        return;
                    }

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("fs-hours").innerHTML = hours < 10 ? "0" + hours : hours;
                    document.getElementById("fs-mins").innerHTML = minutes < 10 ? "0" + minutes : minutes;
                    document.getElementById("fs-secs").innerHTML = seconds < 10 ? "0" + seconds : seconds;
                }, 1000);
            });
        </script>
        @endif

        <!-- 6. PROMO EVENT -->
        @if ($data['promos']->count() > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="full-section-header">
                        <h2>Exclusive Offers</h2>
                        <p>Dapatkan voucher dan penawaran spesial untuk melengkapi ritual kecantikan harian Anda.</p>
                    </div>

                    <div class="swiper promo-special-slider product-slider"
                        style="padding-top: 1rem; padding-bottom: 3rem;">
                        <div class="swiper-wrapper">
                            @foreach ($data['promos']->sortByDesc('created_at') as $promo)
                                <div class="h-auto swiper-slide">
                                    <div class="promo-event-card"
                                        onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
                                        <img class="promo-event-img"
                                            src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}"
                                            alt="{{ $promo->promo_name }}">
                                        <div class="promo-event-body">
                                            <span class="promo-event-type">{{ $promo->type }}</span>
                                            <h3 class="promo-event-title">{{ $promo->promo_name }}</h3>
                                            <div class="promo-event-date">
                                                <i class="far fa-calendar-alt" style="color:var(--glamoire-gold);"></i>
                                                @if ($promo->start_date && $promo->end_date)
                                                    {{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d M') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                                                @endif
                                            </div>
                                            <span class="w-auto px-5 mt-auto btn-lpc-action btn-lpc-add">Eksplor
                                                Penawaran</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next d-none d-md-flex"></div>
                        <div class="swiper-button-prev d-none d-md-flex"></div>
                    </div>
                </div>
            </section>
        @endif

        <!-- 7. BRAND DIRECTORY -->
        {{-- <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="split-section-wrapper" style="align-items: center;">
                    <div class="split-section-left">
                        <h2 class="section-title" style="font-size: 3.5rem;">The <br><span
                                style="color:var(--glamoire-gold); font-style:italic;">Brands.</span></h2>
                        <p class="section-desc">Koleksi eksklusif dari merek kecantikan ternama yang dikurasi khusus untuk
                            memenuhi standar Anda.</p>
                    </div>
                    <div class="split-section-right">
                        <div class="swiper brand-slider product-slider"
                            style="padding-top: 1.5rem; padding-bottom: 2.5rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['brands'] as $brand)
                                    <div class="h-auto pb-3 swiper-slide">
                                        <div class="brand-card"
                                            onclick="window.location.href = '/{{ $brand->name }}_brand'">
                                            <div class="brand-logo-box">
                                                <img src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : asset('images/no-brand.png') }}"
                                                    alt="{{ $brand->name }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next d-none d-md-flex"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- 7. BRAND DIRECTORY -->
        <section class="brand-section-wrapper reveal">
            <div class="p-0 container-fluid">
                <div class="brand-section-header">
                    <h2 class="section-title">The <span style="color:var(--glamoire-gold); font-style:italic;">Brands.</span></h2>
                    <p class="mx-auto section-desc" style="max-width: 600px;">Koleksi eksklusif dari merek kecantikan ternama yang dikurasi khusus untuk memenuhi standar Anda.</p>
                </div>

                <!-- Marquee Brand Slider -->
                <div class="swiper brand-slider">
                    <div class="swiper-wrapper align-items-center">
                        @foreach ($data['brands'] as $brand)
                            <div class="swiper-slide">
                                <div class="brand-card-clean" onclick="window.location.href = '/{{ $brand->name }}_brand'">
                                    <img class="brand-logo-clean"
                                         src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : asset('images/no-brand.png') }}"
                                         alt="{{ $brand->name }}" loading="lazy">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. RECOMMENDED (COCOK UNTUK KAMU) -->
        {{-- <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="full-section-header">
                    <h2>Curated For You</h2>
                    <p>Rekomendasi personal berdasarkan preferensi dan gaya kecantikan elegan Anda.</p>
                </div>

                <div class="swiper curated-slider product-slider" style="padding-top: 1rem; padding-bottom: 3rem;">
                    <div class="swiper-wrapper">
                        @foreach ($data['new'] as $product)
                            @php
                                $activePromo = $product->promos->first();
                                $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                $discountPercent =
                                    $discountedPrice && $product->regular_price > 0
                                        ? round(
                                            (($product->regular_price - $discountedPrice) / $product->regular_price) *
                                                100,
                                        )
                                        : 0;
                                $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                $inCart = isset($cartItems)
                                    ? collect($cartItems)->contains('product_id', $product->id)
                                    : false;
                            @endphp

                            <div class="h-auto swiper-slide">
                                <div class="luxury-product-card"
                                    onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                    <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                        @if ($product->is_gift ?? false)
                                            <span class="lpc-badge badge-gift"><i class="fas fa-gift me-1"></i>
                                                Gift</span>
                                        @elseif ($discountPercent > 0)
                                            <span class="lpc-badge badge-discount">-{{ $discountPercent }}%</span>
                                        @endif

                                        <button class="lpc-wishlist {{ $inWishlist ? 'active' : '' }}"
                                            onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                            <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                        </button>

                                        <img src="{{ Storage::url($product->main_image) }}"
                                            alt="{{ $product->product_name }}">

                                        <div class="lpc-action-area">
                                            @if (session('id_user'))
                                                @if ($product->stock_quantity == 0)
                                                    <button
                                                        onclick="event.stopPropagation(); notifyMe({{ $product->id }})"
                                                        class="btn-lpc-action btn-lpc-notify">
                                                        <i class="fas fa-bell"></i> Notify Me
                                                    </button>
                                                @else
                                                    @if ($inCart)
                                                        <button
                                                            onclick="event.stopPropagation(); window.location.href='/cart'"
                                                            class="btn-lpc-action btn-lpc-added">
                                                            <i class="fas fa-check"></i> In Cart
                                                        </button>
                                                    @else
                                                        <button
                                                            onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                                                            class="btn-lpc-action btn-lpc-add">
                                                            <i class="fas fa-shopping-bag"></i> Add to Cart
                                                        </button>
                                                    @endif
                                                @endif
                                            @else
                                                <button onclick="event.stopPropagation();" data-bs-toggle="modal"
                                                    data-bs-target="#loginUser1" class="btn-lpc-action btn-lpc-add">
                                                    Login to Buy
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="lpc-info">
                                        <div class="lpc-brand">{{ $product->brand ? $product->brand->name : 'Glamoire' }}
                                        </div>
                                        <a href="/{{ $product->product_code }}_product"
                                            class="lpc-title">{{ $product->product_name }}</a>
                                        <div class="lpc-price-box">
                                            @if ($product->priceVariation !== null)
                                                <span class="lpc-price-current">{{ $product->priceVariation }}</span>
                                            @else
                                                @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                    <span class="lpc-price-strike">Rp
                                                        {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                    <span class="lpc-price-current lpc-price-discounted">Rp
                                                        {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                @else
                                                    <span class="lpc-price-current">Rp
                                                        {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next d-none d-md-flex"></div>
                    <div class="swiper-button-prev d-none d-md-flex"></div>
                </div>
            </div>
        </section> --}}

        <!-- 9. CATEGORIES -->
        {{-- <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="mb-5 full-section-header">
                    <h2>Shop by Category</h2>
                </div>

                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $index => $category)
                        @php
                            // Premium muted colors for luxury feel
                            $iconColors = ['#D4AF37', '#607D8B', '#9CA3AF', '#1E3B1E', '#D97706', '#4B5563'];
                            $icons = [
                                'bi-stars',
                                'bi-droplet-half',
                                'bi-magic',
                                'bi-flower1',
                                'bi-palette',
                                'bi-suit-heart',
                            ];
                            $iconColor = $iconColors[$index % 6];
                            $iconClass = $icons[$index % 6];
                        @endphp
                        <div class="cat-card-premium" onclick="window.location.href='/belanja-{{ $category->name }}'">
                            <div class="cat-icon-wrapper"
                                style="color: {{ $iconColor }}; box-shadow: inset 0 0 0 1px {{ $iconColor }}40;">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section> --}}

        <!-- 9. CATEGORIES -->
        <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="mb-5 full-section-header">
                    <h2>Shop by Category</h2>
                </div>

                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $category)
                        @php
                            // Mengambil gambar produk pertama di kategori ini sebagai thumbnail representatif
                            $catImage = null;
                            if ($category->products->isNotEmpty() && $category->products->first()->main_image) {
                                $catImage = Storage::url($category->products->first()->main_image);
                            }
                        @endphp

                        <div class="cat-card-premium" onclick="window.location.href='/belanja-{{ $category->name }}'">
                            <div class="cat-img-wrapper">
                                @if($catImage)
                                    <img src="{{ $catImage }}" alt="{{ $category->name }}" loading="lazy">
                                @else
                                    <!-- Fallback jika kategori tidak memiliki produk/gambar -->
                                    <i class="bi bi-stars" style="font-size: 2.5rem; color: var(--glamoire-gold);"></i>
                                @endif
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 10. ARTICLES / JOURNAL -->
        {{-- @if (count($data['articles']) > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="full-section-header">
                        <h2>The Glamoire Journal</h2>
                        <a href="/newsletter" class="mx-auto mt-2 link-gold">Baca Semua Jurnal <i
                                class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-7">
                            <div class="article-highlight"
                                onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}"
                                    alt="{{ $data['articles'][0]->title }}">
                                <div class="article-overlay">
                                    <p>{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty & Lifestyle' }}
                                    </p>
                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="gap-4 d-flex flex-column h-100 justify-content-between">
                                @foreach ($data['articles']->skip(1)->take(3) as $article)
                                    <div class="article-list-item"
                                        onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
                                        <div class="article-list-img">
                                            <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}"
                                                alt="{{ $article->title }}">
                                        </div>
                                        <div class="article-list-content">
                                            <div class="mb-2 meta">
                                                {{ optional($article->categoryArticle)->name ?? 'Tips' }} •
                                                {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</div>
                                            <h4>{{ $article->title }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif --}}

        <!-- 10. ARTICLES / JOURNAL -->
        @if (count($data['articles']) > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">

                    <!-- Header dengan layout sejajar agar lebih editorial -->
                    <div class="split-section-wrapper" style="align-items: flex-end; margin-bottom: 3rem;">
                        <div class="split-section-left" style="flex: 1;">
                            <h2 class="section-title">The Glamoire <br><span style="color:var(--glamoire-gold); font-style:italic;">Journal.</span></h2>
                            <p class="mb-0 section-desc">Eksplorasi tren kecantikan, edukasi skincare, dan wawasan plant-based beauty.</p>
                        </div>
                        <div class="split-section-right text-md-end">
                            <a href="/newsletter" class="link-gold">Baca Semua Jurnal <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Grid 3 Kolom Sesuai Revisi UI/UX (Lebih lega dan tidak padat) -->
                    <div class="row g-4">
                        {{-- Dibatasi maksimal 3 artikel (take(3)) --}}
                        @foreach ($data['articles']->take(3) as $article)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="editorial-article-card"
                                    onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">

                                    <div class="editorial-img-wrapper">
                                        <span class="editorial-category">
                                            {{ optional($article->categoryArticle)->name ?? 'Beauty & Lifestyle' }}
                                        </span>
                                        <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}"
                                            alt="{{ $article->title }}">
                                    </div>

                                    <div class="editorial-content">
                                        <div class="editorial-meta">
                                            {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}
                                        </div>
                                        <h3 class="editorial-title">{{ $article->title }}</h3>

                                        <!-- Penambahan Short Excerpt menggunakan deskripsi / konten artikel -->
                                        <p class="editorial-excerpt">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($article->description ?? $article->content ?? 'Pelajari lebih lanjut tentang wawasan perawatan kulit eksklusif dari Glamoire pada jurnal edisi kali ini.'), 120, '...') }}
                                        </p>

                                        <span class="editorial-readmore">Read Article</span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        <!-- 11. NEWSLETTER -->
        {{-- <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Stay Glamorous.</h2>
                    <p class="nl-desc">Daftarkan email Anda untuk menerima akses eksklusif ke rilis produk baru, promo
                        rahasia, dan jurnal kecantikan langsung di kotak masuk Anda.</p>

                    <form id="subscribe-form" class="nl-form">
                        @csrf
                        <div class="nl-input-group">
                            <input type="email" id="subscribe_email" class="nl-input"
                                placeholder="Masukkan alamat email Anda..." required autocomplete="off">
                            <button type="submit" id="subscribe-btn" class="nl-btn">Subscribe</button>
                        </div>
                        <div id="validationEmailSubscribe" class="mt-3 text-center text-danger fw-semibold"
                            style="display: none; font-size:0.9rem;"></div>
                    </form>
                </div>
            </div>
        </section> --}}

        <!-- 11. NEWSLETTER -->
        <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Stay Glamorous.</h2>
                    <p class="nl-desc">Daftarkan email Anda untuk menerima pembaruan dari jurnal kecantikan kami langsung di kotak masuk Anda.</p>

                    <!-- List Benefit Tambahan -->
                    <div class="nl-benefits">
                        <span><i class="bi bi-check2-circle"></i> Exclusive Promo</span>
                        <span><i class="bi bi-check2-circle"></i> Early Access</span>
                        <span><i class="bi bi-check2-circle"></i> Beauty Tips</span>
                    </div>

                    <form id="subscribe-form" class="nl-form">
                        @csrf
                        <div class="nl-input-group">
                            <input type="email" id="subscribe_email" class="nl-input"
                                placeholder="Masukkan alamat email Anda..." required autocomplete="off">
                            <button type="submit" id="subscribe-btn" class="nl-btn">Subscribe</button>
                        </div>
                        <div id="validationEmailSubscribe" class="mt-3 text-center text-danger fw-semibold"
                            style="display: none; font-size:0.9rem;"></div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- SCRIPT LOGIC -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Intersection Observer for Reveal Animation (The "Wah" entrance effect)
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

            // Parallax Effect for Campaign Video
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxVideo = document.querySelector('.campaign-parallax video');
                if (parallaxVideo) {
                    parallaxVideo.style.transform = `translateY(${scrolled * 0.3}px)`;
                }
            });

            // Swiper Initializations
            new Swiper('.hero-swiper', {
                slidesPerView: 1,
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.hero-swiper .swiper-pagination',
                    clickable: true
                },
            });

            new Swiper(".top-selling-slider", {
                slidesPerView: 1.5,
                spaceBetween: 20,
                navigation: {
                    nextEl: ".top-selling-slider .swiper-button-next",
                    prevEl: ".top-selling-slider .swiper-button-prev"
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2.2,
                        spaceBetween: 24
                    },
                    768: {
                        slidesPerView: 2.5,
                        spaceBetween: 24
                    },
                    992: {
                        slidesPerView: 3.5,
                        spaceBetween: 30
                    },
                    1200: {
                        slidesPerView: 4.5,
                        spaceBetween: 30
                    }
                }
            });

            // new Swiper(".flash-sale-slider", {
            //     slidesPerView: 1.5,
            //     spaceBetween: 20,
            //     navigation: {
            //         nextEl: ".flash-sale-slider .swiper-button-next",
            //         prevEl: ".flash-sale-slider .swiper-button-prev"
            //     },
            //     breakpoints: {
            //         576: {
            //             slidesPerView: 2.2,
            //             spaceBetween: 24
            //         },
            //         768: {
            //             slidesPerView: 2.5,
            //             spaceBetween: 24
            //         },
            //         992: {
            //             slidesPerView: 3.5,
            //             spaceBetween: 20
            //         },
            //         1200: {
            //             slidesPerView: 4.5,
            //             spaceBetween: 24
            //         }
            //     }
            // });

            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5,
                spaceBetween: 16,
                navigation: {
                    nextEl: ".flash-sale-slider .swiper-button-next",
                    prevEl: ".flash-sale-slider .swiper-button-prev"
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2.5,
                        spaceBetween: 24
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 24
                    },
                    1200: {
                        slidesPerView: 3, /* <-- UBAH KE 3 AGAR CARD BESAR DAN PREMIUM */
                        spaceBetween: 30
                    }
                }
            });

            new Swiper(".promo-special-slider", {
                slidesPerView: 1.2,
                spaceBetween: 20,
                navigation: {
                    nextEl: ".promo-special-slider .swiper-button-next",
                    prevEl: ".promo-special-slider .swiper-button-prev"
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 2.5
                    },
                    992: {
                        slidesPerView: 3
                    },
                    1200: {
                        slidesPerView: 4
                    }
                }
            });

            // new Swiper(".brand-slider", {
            //     slidesPerView: 2.5,
            //     spaceBetween: 20,
            //     navigation: {
            //         nextEl: ".brand-slider .swiper-button-next",
            //         prevEl: ".brand-slider .swiper-button-prev"
            //     },
            //     breakpoints: {
            //         576: {
            //             slidesPerView: 3.5
            //         },
            //         768: {
            //             slidesPerView: 4.5
            //         },
            //         992: {
            //             slidesPerView: 5.5
            //         },
            //         1200: {
            //             slidesPerView: 6.5
            //         }
            //     }
            // });

            new Swiper(".brand-slider", {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                speed: 4000, // Kecepatan linear marquee
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                },
                allowTouchMove: true, // Memungkinkan user untuk menggeser secara manual
                breakpoints: {
                    576: { slidesPerView: 4, spaceBetween: 40 },
                    768: { slidesPerView: 5, spaceBetween: 40 },
                    992: { slidesPerView: 6, spaceBetween: 50 },
                    1200: { slidesPerView: 7, spaceBetween: 50 }
                }
            });

            new Swiper(".curated-slider", {
                slidesPerView: 1.5,
                spaceBetween: 20,
                navigation: {
                    nextEl: ".curated-slider .swiper-button-next",
                    prevEl: ".curated-slider .swiper-button-prev"
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2.2,
                        spaceBetween: 24
                    },
                    768: {
                        slidesPerView: 3.2,
                        spaceBetween: 24
                    },
                    992: {
                        slidesPerView: 4.5,
                        spaceBetween: 30
                    },
                    1200: {
                        slidesPerView: 5.5,
                        spaceBetween: 30
                    }
                }
            });

            // Modals Auto Show Logic
            @if (!session('id_user') && $data['popups']->isNotEmpty())
                var myModal = new bootstrap.Modal(document.getElementById('firstUser'));
                myModal.show();
            @endif

            @if (session('id_user') && $data['promoModal'] !== null)
                var promoModal = new bootstrap.Modal(document.getElementById('promoModal'));
                promoModal.show();
            @endif
        });

        // AJAX Subscribe Logic
        $(document).ready(function() {
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
                        success: function(response) {
                            if (response.exists) {
                                $('#validationEmailSubscribe').html(
                                    '<i class="fas fa-exclamation-circle"></i> Email ini sudah terdaftar.'
                                    ).show();
                                $('#subscribe-btn').prop('disabled', true).css('opacity',
                                '0.5');
                            } else {
                                $('#validationEmailSubscribe').hide();
                                $('#subscribe-btn').prop('disabled', false).css('opacity', '1');
                            }
                        }
                    });
                } else {
                    $('#validationEmailSubscribe').hide();
                }
            });

            $("#subscribe-form").on("submit", function(e) {
                e.preventDefault();
                let email = $("#subscribe_email").val();
                let btn = $('#subscribe-btn');

                btn.html('<i class="fas fa-spinner fa-spin"></i> Proses...');
                btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('subscribe') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    success: function(response) {
                        btn.html('Subscribe').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Welcome to Glamoire!",
                                text: response.message,
                                confirmButtonColor: "#183018"
                            });
                            $("#subscribe_email").val('');
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops!",
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        btn.html('Subscribe').prop('disabled', false);
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan sistem, coba lagi nanti."
                        });
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Hancurkan instance lama jika ada, lalu buat ulang dengan settingan UI/UX baru
            if (window.topSellingSwiper) window.topSellingSwiper.destroy(true, true);

            window.topSellingSwiper = new Swiper(".top-selling-slider", {
                slidesPerView: 1.5,
                spaceBetween: 16, // Space dilebarkan sedikit di mobile
                navigation: {
                    nextEl: ".top-selling-slider .swiper-button-next",
                    prevEl: ".top-selling-slider .swiper-button-prev"
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2.5,
                        spaceBetween: 24
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    // MAX 4 PRODUCT CARD PER ROW DESKTOP
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    }
                }
            });
        });
    </script>

@endsection

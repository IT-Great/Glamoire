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

        /* [FIX] Prevent horizontal scroll globally */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        body {
            background-color: var(--glamoire-light);
            font-family: 'Poppins', sans-serif;
            color: var(--text-main);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'The Seasons', serif;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        img, video, canvas, svg {
            max-width: 100%;
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
        .section-padding { padding: 6rem 0; }

        @media (max-width: 991px) { .section-padding { padding: 4rem 0; } }
        @media (max-width: 767px) { .section-padding { padding: 3rem 0; } }
        @media (max-width: 575px) { .section-padding { padding: 2.5rem 0; } }

        /* --- Modal Perfect Centering Fix --- */
        .modal { padding: 0 !important; }
        .modal-dialog.modal-dialog-centered {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto !important;
            min-height: 100vh !important;
        }
        .modal-dialog.modal-dialog-centered .modal-content { margin: auto !important; }

        /* [FIX] Modal tidak keluar layar di HP */
        @media (max-width: 575px) {
            #firstUser .modal-dialog,
            #promoModal .modal-dialog {
                margin: 1rem !important;
                max-width: calc(100vw - 2rem) !important;
            }
            #firstUser .modal-content { border-radius: 16px !important; }
            #firstUser h3 { font-size: 1.4rem !important; }
            #firstUser p { font-size: 0.85rem !important; }
            #promoModal img { max-height: 70vh !important; }
        }

        /* ============================================================
           HERO CAROUSEL
        ============================================================ */
        .hero-carousel-wrapper {
            width: 100%;
            position: relative;
            background: var(--glamoire-dark);
        }

        .hero-swiper { width: 100%; }

        /* [FIX] Slide pakai tinggi tetap + aspect ratio di mobile */
        /* .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            position: relative;
            display: block;
            height: 55vh;
            min-height: 300px;
        } */

        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 767px) {
            .hero-swiper .swiper-slide {
                height: auto;
                min-height: unset;
                aspect-ratio: 4 / 3;
            }
        }

        @media (max-width: 480px) {
            .hero-swiper .swiper-slide {
                aspect-ratio: 3 / 2;
            }
        }

        /* [FIX] object-fit:cover agar gambar penuh, tidak ada void hitam */
        .hero-swiper img,
        .hero-swiper video {
            width: 100%;
            height: 100%;
            max-height: none;
            object-fit: cover;
            object-position: center top;
            display: block;
            transition: transform 12s ease;
            transform: scale(1.02);
        }

        .hero-swiper .swiper-slide-active img { transform: scale(1); }
        .hero-swiper picture { width: 100%; height: 100%; display: block; }

        .hero-swiper .swiper-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 35%);
            pointer-events: none;
        }

        .hero-swiper .swiper-pagination-bullet {
            background: #FFF; opacity: 0.5;
            width: 40px; height: 3px;
            border-radius: 0;
            transition: var(--transition-smooth);
        }
        .hero-swiper .swiper-pagination-bullet-active {
            background: var(--glamoire-gold) !important;
            opacity: 1; width: 80px;
        }

        @media (max-width: 767px) {
            .hero-swiper .swiper-pagination-bullet { width: 24px; }
            .hero-swiper .swiper-pagination-bullet-active { width: 48px; }
            .hero-swiper .swiper-pagination { bottom: 8px; }
        }

        /* ============================================================
           TRUST BAR
        ============================================================ */
        .trust-floating-wrapper {
            position: relative; z-index: 10;
            margin-top: -50px; padding: 0 15px;
        }
        .trust-bar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            padding: 2rem 1rem;
            display: flex; justify-content: center;
            gap: 2rem; flex-wrap: wrap;
            border: 1px solid rgba(255,255,255,0.5);
        }
        .trust-item {
            flex: 1; min-width: 200px;
            display: flex; flex-direction: column;
            align-items: center; text-align: center;
            gap: 1rem; transition: var(--transition-smooth);
        }
        .trust-item:hover { transform: translateY(-5px); }
        .trust-icon {
            width: 60px; height: 60px;
            background: var(--glamoire-sand);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--glamoire-gold); font-size: 1.5rem;
            box-shadow: inset 0 0 0 1px rgba(212,175,55,0.3);
        }
        .trust-text h4 { font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--glamoire-dark); }
        .trust-text p { font-size: 0.85rem; color: var(--text-muted); margin: 0; font-family: 'Poppins', sans-serif; }

        @media (max-width: 767px) {
            .trust-floating-wrapper { margin-top: -30px; }
            .trust-bar { padding: 1.5rem 1rem; gap: 1.5rem; }
            .trust-item { min-width: 140px; }
            .trust-icon { width: 50px; height: 50px; font-size: 1.2rem; }
            .trust-text h4 { font-size: 0.95rem; }
        }

        /* [FIX] Mobile kecil: grid 2x2 */
        @media (max-width: 575px) {
            .trust-floating-wrapper { margin-top: -20px; padding: 0 0.75rem; }
            .trust-bar {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 1rem; padding: 1.2rem;
                border-radius: 14px;
            }
            .trust-item { min-width: unset; gap: 0.5rem; }
            .trust-icon { width: 42px; height: 42px; font-size: 1rem; }
            .trust-text h4 { font-size: 0.82rem; }
            .trust-text p { font-size: 0.72rem; }
        }

        /* ============================================================
           SPLIT SECTION (Best Sellers header)
        ============================================================ */
        .split-section-wrapper {
            display: flex; align-items: flex-end;
            gap: 4rem; width: 100%; margin-bottom: 2rem;
        }
        .split-section-left { flex: 0 0 350px; }
        .split-section-right { flex: 1; min-width: 0; overflow: hidden; }

        @media (max-width: 991px) {
            .split-section-wrapper {
                flex-direction: column;
                align-items: center; text-align: center;
                gap: 1.5rem;
            }
            .split-section-left { flex: 0 0 auto; max-width: 100%; width: 100%; }
            .split-section-right { width: 100%; }
            .link-gold { justify-content: center; }
        }

        .section-title {
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 700; color: var(--glamoire-dark);
            line-height: 1.1; margin-bottom: 1.5rem;
        }
        .section-desc {
            font-size: clamp(0.9rem, 1.5vw, 1.1rem);
            color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem;
        }
        .link-gold {
            color: var(--glamoire-dark); font-weight: 600;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem;
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 6px;
            text-transform: uppercase; letter-spacing: 1.5px;
            font-size: 0.9rem; transition: var(--transition-smooth);
        }
        .link-gold:hover { color: var(--glamoire-gold); gap: 1.2rem; }

        @media (max-width: 575px) {
            .section-title { font-size: 2rem; line-height: 1.15; margin-bottom: 1rem; }
            .section-desc { font-size: 0.9rem; margin-bottom: 1.5rem; }
        }

        /* --- Full Width Header --- */
        .full-section-header { text-align: center; margin-bottom: 3rem; }
        .full-section-header h2 {
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 700; color: var(--glamoire-dark); margin-bottom: 0.8rem;
        }
        .full-section-header p {
            font-size: clamp(0.9rem, 1.5vw, 1.1rem);
            color: var(--text-muted); max-width: 700px;
            margin: 0 auto; line-height: 1.8;
        }

        @media (max-width: 767px) {
            .full-section-header { margin-bottom: 2rem; }
            .full-section-header h2 { font-size: clamp(1.8rem, 7vw, 3rem); }
            .full-section-header p { font-size: 0.9rem; }
        }

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next, .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            width: 55px !important; height: 55px !important;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: var(--glamoire-dark);
            transform: scale(1.1);
            color: var(--glamoire-gold) !important;
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 1.3rem !important; font-weight: 900;
        }
        @media (max-width: 767px) {
            .swiper-button-next, .swiper-button-prev { display: none !important; }
        }

        /* ============================================================
           LUXURY PRODUCT CARD (Revamped Clean Version)
        ============================================================ */
        .luxury-product-card {
            background: transparent; border: none; box-shadow: none;
            display: flex; flex-direction: column;
            height: 100%; cursor: pointer;
        }
        .luxury-product-card:hover { transform: none; box-shadow: none; }

        .lpc-visual {
            position: relative; width: 100%;
            aspect-ratio: 4 / 5;
            background-color: var(--glamoire-sand);
            overflow: hidden; margin-bottom: 1.25rem;
        }

        @media (max-width: 575px) {
            .lpc-visual { aspect-ratio: 3 / 4; margin-bottom: 0.8rem; }
        }

        .lpc-visual img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .luxury-product-card:hover .lpc-visual img { transform: scale(1.05); }

        .lpc-minimal-badge {
            position: absolute; top: 12px; left: 12px;
            background: var(--glamoire-dark); color: #FFF;
            font-size: 0.7rem; font-weight: 600;
            padding: 4px 10px; letter-spacing: 1px;
            text-transform: uppercase; z-index: 2;
        }
        .lpc-wishlist-icon {
            position: absolute; top: 12px; right: 12px;
            color: var(--text-muted); font-size: 1.2rem;
            z-index: 2; background: none; border: none;
            transition: color 0.3s; cursor: pointer;
        }
        .lpc-wishlist-icon:hover, .lpc-wishlist-icon.active { color: var(--danger-main); }

        .lpc-simple-cta-layer {
            position: absolute; bottom: 0; left: 0;
            width: 100%; padding: 1rem;
            background: linear-gradient(to top, rgba(255,255,255,0.95) 0%, transparent 100%);
            transform: translateY(10px); opacity: 0;
            transition: all 0.3s ease; z-index: 3;
        }
        @media (min-width: 992px) {
            .luxury-product-card:hover .lpc-simple-cta-layer {
                transform: translateY(0); opacity: 1;
            }
        }
        @media (max-width: 991px) { .lpc-simple-cta-layer { display: none; } }

        .btn-clean-cta {
            width: 100%; background: var(--glamoire-dark); color: #FFF;
            border: none; padding: 0.8rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600; font-size: 0.85rem;
            text-transform: uppercase; letter-spacing: 1px;
            transition: background 0.3s; cursor: pointer;
        }
        .btn-clean-cta:hover { background: var(--glamoire-gold); color: var(--glamoire-dark); }

        .lpc-details {
            display: flex; flex-direction: column;
            flex-grow: 1; padding: 0 0.25rem;
        }
        .lpc-clean-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem; font-weight: 600;
            color: var(--text-main); margin-bottom: 0.3rem;
            line-height: 1.3;
            display: -webkit-box; -webkit-line-clamp: 1;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .lpc-clean-benefit {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.8rem; color: var(--text-muted);
            margin-bottom: 0.8rem; line-height: 1.4;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .lpc-clean-price {
            margin-top: auto;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1rem; font-weight: 600;
            color: var(--glamoire-dark);
        }
        .lpc-clean-price-strike {
            font-size: 0.78rem; color: #9CA3AF;
            text-decoration: line-through; font-weight: 400;
        }
        .lpc-clean-price-discount { color: var(--danger-main); }

        /* [FIX] Sembunyikan benefit di mobile agar card tidak terlalu panjang */
        @media (max-width: 575px) {
            .lpc-clean-benefit { display: none !important; }
            .lpc-clean-title { font-size: 0.95rem; }
            .lpc-clean-price { font-size: 0.9rem; }
        }

        /* ============================================================
           BRAND STATEMENT SECTION
        ============================================================ */
        .brand-statement-section {
            background: linear-gradient(135deg, #FFFFFF 0%, #F4F7F4 100%);
            padding: 8rem 2rem; text-align: center;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            position: relative;
            border-top: 1px solid rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }

        @media (max-width: 767px) {
            .brand-statement-section { padding: 4rem 1.5rem; }
        }

        @media (max-width: 575px) {
            .brand-statement-section { padding: 3rem 1.2rem; }
        }

        .brand-statement-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.8rem, 5vw, 4.5rem);
            color: var(--glamoire-dark); font-weight: 500;
            line-height: 1.25; max-width: 900px;
            margin: 0 auto 1.5rem;
        }
        .brand-statement-text i { font-style: italic; color: var(--glamoire-gold); }
        .brand-statement-subtext {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(0.88rem, 1.5vw, 1.1rem);
            color: var(--text-muted); max-width: 600px;
            margin: 0 auto 2rem; line-height: 1.8;
        }
        .btn-clean-outline {
            background: transparent; color: var(--glamoire-dark);
            border: 1px solid var(--glamoire-dark);
            padding: 0.8rem 2.5rem; border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-transform: uppercase; letter-spacing: 1.5px;
            font-weight: 600; font-size: 0.85rem;
            transition: all 0.3s ease; text-decoration: none;
        }
        .btn-clean-outline:hover { background: var(--glamoire-dark); color: #FFF; }

        @media (max-width: 575px) {
            .btn-clean-outline { padding: 0.7rem 2rem; font-size: 0.8rem; }
        }

        /* ============================================================
           FLASH SALE SECTION
        ============================================================ */
        .flash-sale-wrapper {
            background-color: var(--glamoire-sand);
            padding: 5rem 0;
            border-top: 1px solid #E5E7EB;
            border-bottom: 1px solid #E5E7EB;
            position: relative; overflow: hidden;
        }
        .flash-header { position: relative; z-index: 2; }
        .flash-title {
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 700; color: var(--glamoire-dark);
            margin-bottom: 0.5rem;
            display: flex; align-items: center; gap: 15px;
        }
        .timer-flex {
            display: flex; align-items: center;
            gap: 0.8rem; margin-top: 2rem;
            flex-wrap: nowrap; max-width: 100%;
        }
        .timer-block {
            background: #FFF; border: 1px solid #E5E7EB;
            border-radius: 12px; padding: 0.8rem 1rem;
            text-align: center; min-width: 70px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .timer-val {
            font-size: 1.8rem; font-weight: 700;
            line-height: 1; color: var(--glamoire-dark);
            font-family: 'Plus Jakarta Sans', monospace;
        }
        .timer-lbl {
            font-size: 0.65rem; text-transform: uppercase;
            letter-spacing: 1px; color: var(--text-muted); margin-top: 6px;
        }

        @media (max-width: 991px) {
            .flash-sale-wrapper { padding: 3rem 0; }
            .flash-header {
                text-align: center;
                display: flex; flex-direction: column; align-items: center;
                padding: 0 1rem; margin-bottom: 2.5rem;
            }
            .timer-flex { justify-content: center; }
        }

        /* [FIX] Timer tidak overflow di HP kecil */
        @media (max-width: 575px) {
            .flash-title { font-size: 1.8rem; justify-content: center; }
            .timer-flex { gap: 0.4rem; margin-top: 1.2rem; }
            .timer-block { min-width: 54px; padding: 0.5rem 0.55rem; border-radius: 8px; }
            .timer-val { font-size: 1.25rem; }
            .timer-lbl { font-size: 0.56rem; }
        }

        /* ============================================================
           PROMO GRID BANNERS
        ============================================================ */
        .promo-grid-banner {
            border-radius: 24px; overflow: hidden;
            position: relative; aspect-ratio: 4 / 3;
            display: block;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            transition: var(--transition-bounce);
            cursor: pointer; background: var(--glamoire-dark);
            text-align: left;
        }
        @media (min-width: 992px) { .promo-grid-banner { aspect-ratio: 16 / 9; } }
        .promo-grid-banner:hover { transform: translateY(-8px); box-shadow: 0 25px 50px rgba(0,0,0,0.15); }
        .promo-grid-banner img, .promo-grid-banner video {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.5s ease; z-index: 1;
        }
        .promo-grid-banner:hover img, .promo-grid-banner:hover video { transform: scale(1.05); }

        .banner-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            z-index: 2;
        }
        .banner-content {
            position: absolute; bottom: 0; left: 0;
            width: 100%; padding: 2.5rem; z-index: 3;
            display: flex; flex-direction: column; align-items: flex-start;
        }
        .banner-title {
            font-family: 'Cormorant Garamond', 'The Seasons', serif;
            font-size: clamp(1.5rem, 3vw, 2.5rem);
            color: #FFF; font-weight: 600; line-height: 1.2;
            margin-bottom: 0.8rem;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .banner-subtitle {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            font-size: 0.95rem; color: rgba(255,255,255,0.85);
            margin-bottom: 1.5rem; max-width: 90%;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .btn-banner-cta {
            background: #FFF; color: var(--glamoire-dark);
            padding: 0.6rem 1.5rem; border-radius: 50px;
            font-size: 0.85rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px;
            transition: var(--transition-smooth);
            display: inline-flex; align-items: center; gap: 8px; border: none;
        }
        .promo-grid-banner:hover .btn-banner-cta { background: var(--glamoire-gold); color: var(--glamoire-dark); }

        /* [FIX] Banner content di mobile */
        @media (max-width: 767px) {
            .banner-content { padding: 1.25rem 1.25rem 1.5rem; }
            .banner-title { font-size: 1.3rem; margin-bottom: 0.4rem; }
            .banner-subtitle { font-size: 0.8rem; margin-bottom: 0.8rem; }
            .btn-banner-cta { padding: 0.45rem 1rem; font-size: 0.72rem; gap: 5px; }
        }
        @media (max-width: 480px) {
            .banner-subtitle { display: none; }
            .banner-title { font-size: 1.1rem; }
        }

        /* ============================================================
           PROMO EVENT CARDS
        ============================================================ */
        .promo-event-card {
            background: #FFF; border-radius: 24px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.02);
            transition: var(--transition-bounce); cursor: pointer;
            height: 100%; display: flex; flex-direction: column;
        }
        .promo-event-card:hover { transform: translateY(-12px); box-shadow: 0 25px 50px rgba(0,0,0,0.1); }
        .promo-event-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; }
        .promo-event-body {
            padding: 2rem 1.5rem;
            display: flex; flex-direction: column;
            flex-grow: 1; align-items: center;
            text-align: center; background: #FFF;
        }
        .promo-event-type {
            font-size: 0.8rem; color: var(--glamoire-gold);
            text-transform: uppercase; font-weight: 700;
            letter-spacing: 2px; margin-bottom: 0.8rem;
        }
        .promo-event-title {
            font-size: 1.4rem; font-weight: 700;
            color: var(--glamoire-dark); margin-bottom: 1rem;
            line-height: 1.3; font-family: 'The Seasons', serif;
        }
        .promo-event-date {
            font-size: 0.9rem; color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        @media (max-width: 575px) {
            .promo-event-body { padding: 1.5rem 1rem; }
            .promo-event-title { font-size: 1.1rem; }
            .promo-event-img { aspect-ratio: 3 / 2; }
        }

        /* ============================================================
           BRAND SECTION
        ============================================================ */
        .brand-section-wrapper {
            background-color: #FFF; padding: 5rem 0;
            border-top: 1px solid rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.03);
            text-align: center;
        }
        .brand-section-header { margin-bottom: 3rem; }
        .brand-section-header h2 {
            font-size: clamp(1.8rem, 4vw, 3.5rem);
            color: var(--glamoire-dark); font-weight: 700;
        }
        .brand-card-clean {
            background: transparent; padding: 1.5rem;
            display: flex; align-items: center; justify-content: center;
            height: 110px; cursor: pointer;
            transition: all 0.3s ease; border-radius: 16px;
        }
        .brand-card-clean:hover { background: var(--glamoire-sand); transform: translateY(-5px); }
        .brand-logo-clean {
            max-width: 100%; max-height: 60px;
            object-fit: contain; transition: transform 0.3s ease;
        }
        .brand-card-clean:hover .brand-logo-clean { transform: scale(1.08); }
        .brand-slider .swiper-wrapper { transition-timing-function: linear !important; }

        @media (max-width: 575px) {
            .brand-section-wrapper { padding: 3rem 0; }
            .brand-card-clean { height: 80px; padding: 0.8rem; }
            .brand-logo-clean { max-height: 45px; }
        }

        /* ============================================================
           CATEGORY SECTION
        ============================================================ */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 2rem;
        }
        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem; } }
        @media (max-width: 767px)  { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px)  { .category-grid { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; } }

        .cat-card-premium {
            background: transparent; text-align: center; cursor: pointer;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            transition: var(--transition-smooth);
            padding: 0.5rem;
        }
        .cat-img-wrapper {
            width: 110px; height: 110px; border-radius: 50%;
            background: #FFF; margin-bottom: 1rem;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.02);
            transition: var(--transition-smooth);
        }
        .cat-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
        .cat-card-premium:hover .cat-img-wrapper {
            box-shadow: 0 15px 30px rgba(212,175,55,0.15);
            transform: translateY(-6px);
            border-color: rgba(212,175,55,0.3);
        }
        .cat-card-premium:hover .cat-img-wrapper img { transform: scale(1.08); }
        .cat-name {
            font-size: 1rem; font-weight: 600; color: var(--text-main);
            margin: 0; transition: color 0.3s; font-family: 'Poppins', sans-serif;
            line-height: 1.3;
        }
        .cat-card-premium:hover .cat-name { color: var(--glamoire-gold); }

        /* [FIX] Kategori di mobile kecil */
        @media (max-width: 575px) {
            .cat-img-wrapper { width: 72px; height: 72px; margin-bottom: 0.7rem; }
            .cat-name { font-size: 0.78rem; }
        }

        /* ============================================================
           EDITORIAL JOURNAL
        ============================================================ */
        .editorial-article-card { display: flex; flex-direction: column; height: 100%; cursor: pointer; }
        .editorial-img-wrapper {
            position: relative; width: 100%;
            aspect-ratio: 4 / 5;
            border-radius: 16px; overflow: hidden;
            margin-bottom: 1.5rem; background: var(--glamoire-sand);
        }

        /* [FIX] Aspect ratio lebih pendek di mobile */
        @media (max-width: 767px) {
            .editorial-img-wrapper { aspect-ratio: 16 / 9; border-radius: 12px; margin-bottom: 1rem; }
        }
        @media (max-width: 575px) {
            .editorial-img-wrapper { aspect-ratio: 4 / 3; }
        }

        .editorial-img-wrapper img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .editorial-article-card:hover .editorial-img-wrapper img { transform: scale(1.05); }
        .editorial-category {
            position: absolute; top: 15px; left: 15px;
            background: rgba(255,255,255,0.95); backdrop-filter: blur(5px);
            padding: 6px 16px; border-radius: 30px;
            font-size: 0.75rem; font-weight: 700;
            color: var(--glamoire-dark);
            text-transform: uppercase; letter-spacing: 1.5px; z-index: 2;
        }
        .editorial-content {
            padding: 0 0.25rem;
            display: flex; flex-direction: column; flex-grow: 1;
        }
        .editorial-meta {
            font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.7rem;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase; letter-spacing: 1px; font-weight: 500;
        }
        .editorial-title {
            font-family: 'Cormorant Garamond', 'The Seasons', serif;
            font-size: clamp(1.3rem, 2vw, 1.6rem);
            font-weight: 600; color: var(--text-main);
            line-height: 1.3; margin-bottom: 0.8rem;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
            transition: color 0.3s;
        }
        .editorial-article-card:hover .editorial-title { color: var(--glamoire-gold); }
        .editorial-excerpt {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            font-size: 0.92rem; color: var(--text-muted);
            line-height: 1.6; margin-bottom: 1.5rem;
            display: -webkit-box; -webkit-line-clamp: 3;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .editorial-readmore {
            margin-top: auto; font-size: 0.85rem; font-weight: 600;
            color: var(--glamoire-dark); text-transform: uppercase;
            letter-spacing: 1.5px; position: relative;
            display: inline-block; align-self: flex-start; padding-bottom: 4px;
        }
        .editorial-readmore::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 1px; background: var(--glamoire-dark);
            transition: width 0.3s ease;
        }
        .editorial-article-card:hover .editorial-readmore::after { width: 100%; }

        /* ============================================================
           NEWSLETTER SECTION
        ============================================================ */
        .newsletter-premium {
            background: var(--glamoire-dark);
            border-radius: 24px; padding: 6rem 2rem;
            text-align: center; color: #FFF;
            position: relative; overflow: hidden; margin-top: 2rem;
        }
        .newsletter-premium::before {
            content: ''; position: absolute; left: -10%; top: -50%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%);
        }

        @media (max-width: 767px) {
            .newsletter-premium { padding: 3.5rem 1.5rem; border-radius: 20px; }
        }
        @media (max-width: 575px) {
            .newsletter-premium { padding: 3rem 1rem; border-radius: 16px; }
        }

        .nl-title {
            font-size: clamp(1.8rem, 5vw, 4rem);
            font-weight: 700; margin-bottom: 1rem;
            color: var(--glamoire-gold); position: relative; z-index: 2;
        }
        .nl-desc {
            font-size: clamp(0.88rem, 1.5vw, 1.1rem);
            color: rgba(255,255,255,0.8); max-width: 600px;
            margin: 0 auto 1.5rem; line-height: 1.8;
            font-family: 'Poppins', sans-serif; position: relative; z-index: 2;
        }
        .nl-benefits {
            display: flex; justify-content: center;
            flex-wrap: wrap; gap: 2rem; margin-bottom: 3rem;
            position: relative; z-index: 2;
        }
        .nl-benefits span {
            font-size: 0.9rem; color: #FFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex; align-items: center; gap: 8px;
            text-transform: uppercase; letter-spacing: 1px; font-weight: 500;
        }
        .nl-benefits span i { color: var(--glamoire-gold); font-size: 1.2rem; }
        .nl-form { max-width: 650px; margin: 0 auto; position: relative; z-index: 2; }
        .nl-input-group {
            display: flex; background: #FFF;
            border-radius: 50px; padding: 0.4rem;
        }
        .nl-input {
            border: none; background: transparent;
            padding: 1.2rem 2rem; width: 100%;
            font-size: 1rem; color: var(--glamoire-dark);
            outline: none; font-family: 'Poppins', sans-serif;
        }
        .nl-input::placeholder { color: #9CA3AF; }
        .nl-btn {
            background: var(--glamoire-gold); color: var(--glamoire-dark);
            border: none; padding: 0 2.5rem; border-radius: 50px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;
            transition: var(--transition-smooth); cursor: pointer;
            white-space: nowrap; font-size: 0.95rem;
        }
        .nl-btn:hover { background: var(--glamoire-dark); color: var(--glamoire-gold); }

        /* [FIX] Newsletter form jadi stacked di mobile */
        @media (max-width: 575px) {
            .nl-benefits { gap: 0.7rem; margin-bottom: 1.5rem; flex-direction: column; align-items: center; }
            .nl-benefits span { font-size: 0.78rem; }
            .nl-input-group {
                flex-direction: column; background: transparent;
                padding: 0; border-radius: 0; gap: 10px;
            }
            .nl-input {
                background: #FFF; border-radius: 50px;
                padding: 1rem 1.5rem; text-align: center;
            }
            .nl-btn { width: 100%; padding: 1rem; border-radius: 50px; font-size: 0.9rem; }
        }

        /* ============================================================
           CORE MESSAGE SECTION
        ============================================================ */
        .core-message-section {
            background-color: #F4F7F4; padding: 4.5rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }
        .core-message-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 2rem; align-items: start;
        }
        .core-item {
            display: flex; flex-direction: column;
            align-items: center; text-align: center;
            gap: 1.2rem; transition: transform 0.3s ease;
        }
        .core-item:hover { transform: translateY(-5px); }
        .core-icon {
            font-size: 2.2rem; color: transparent;
            -webkit-text-stroke: 1.2px var(--glamoire-dark); opacity: 0.8;
        }
        .core-text {
            font-size: 0.95rem; font-weight: 600;
            color: var(--glamoire-dark); line-height: 1.5; letter-spacing: 0.5px;
        }

        /* [FIX] 2 kolom di tablet, 2x2 di mobile */
        @media (max-width: 991px) {
            .core-message-grid { grid-template-columns: repeat(2, 1fr); gap: 2.5rem 2rem; }
        }
        @media (max-width: 575px) {
            .core-message-section { padding: 3rem 0; }
            .core-message-grid { grid-template-columns: repeat(2, 1fr); gap: 1.8rem 1rem; }
            .core-icon { font-size: 1.6rem; -webkit-text-stroke: 1px var(--glamoire-dark); }
            .core-text { font-size: 0.82rem; }
        }

        /* Lpc action button (shared) */
        .btn-lpc-action {
            width: 100%; padding: 0.9rem; border-radius: 50px;
            font-weight: 700; font-size: 0.9rem; border: none;
            display: flex; align-items: center; justify-content: center;
            gap: 8px; transition: var(--transition-smooth);
            text-transform: uppercase; letter-spacing: 1px; cursor: pointer;
        }
        .btn-lpc-add { background: var(--glamoire-dark); color: #FFF; }
        .btn-lpc-add:hover { background: var(--glamoire-gold); color: var(--glamoire-dark); }
        .btn-lpc-added { background: var(--success-main); color: #FFF; }
        .btn-lpc-notify { background: var(--text-main); color: #FFF; }

        @media (max-width: 575px) {
            .btn-lpc-action { padding: 0.75rem; font-size: 0.78rem; }
        }
    </style>

    <!-- ============================================================
         WELCOME MODAL (Guest)
    ============================================================ -->
    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="mx-auto modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 500px;">
                <div class="overflow-hidden border-0 modal-content" style="border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
                    <div class="p-0 modal-body position-relative">
                        <button type="button" class="top-0 m-3 btn-close position-absolute end-0 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="h-auto w-100"
                                style="object-fit: cover; max-height: 280px;">
                        @endif
                        <div class="p-4 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="mb-2 fw-bold" style="font-family: 'The Seasons', serif; color: var(--glamoire-gold);">
                                {{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-3" style="font-size: 0.9rem; line-height: 1.5; color: rgba(255,255,255,0.8);">
                                {{ $data['popups'][0]->description ?? 'Dapatkan penawaran eksklusif khusus pendaftaran pertama Anda hari ini.' }}
                            </p>
                            <a href="/login"
                                class="px-4 py-2 btn btn-light rounded-pill fw-bold w-100"
                                style="font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                onmouseover="this.style.background='var(--glamoire-gold)'; this.style.color='var(--glamoire-dark)';"
                                onmouseout="this.style.background='white'; this.style.color='black';">
                                Daftar & Klaim Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ============================================================
         PROMO MODAL (Logged-in User)
    ============================================================ -->
    @if (session('id_user') && $data['promoModal'] !== null)
        <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
            <div class="mx-auto modal-dialog modal-lg modal-dialog-centered">
                <div class="bg-transparent border-0 modal-content" style="max-width: 600px;">
                    <div class="p-0 text-center modal-body position-relative">
                        <button type="button" class="top-0 m-3 btn-close position-absolute end-0 z-3" data-bs-dismiss="modal"
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

    {{-- [FIX] Outer wrapper prevent horizontal scroll --}}
    <div style="overflow-x: hidden; width: 100%; max-width: 100%;">

    <!-- ============================================================
         1. HERO SECTION
    ============================================================ -->
    {{-- <div class="hero-carousel-wrapper reveal">
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" onclick="window.location.href='/shop'">
                    <picture>
                        <img src="{{ asset('images/glamoirebanner.jpg') }}" alt="Discover Glamoire Cosmetics" loading="lazy">
                    </picture>
                </div>
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

    <!-- ============================================================
         2. CORE MESSAGE SECTION
    ============================================================ -->
    <section class="core-message-section reveal">
        <div class="px-3 container-fluid px-md-4 px-lg-5">
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

    {{-- Wrapper konten utama dengan padding responsif --}}
    <div class="px-3 px-md-4 px-lg-5">

        <!-- ============================================================
             3. BEST SELLERS
        ============================================================ -->
        <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="section-title">Best<br><span style="color: var(--glamoire-gold); font-style:italic;">Sellers.</span></h2>
                        <p class="section-desc">Koleksi mahakarya yang paling dicintai. Elevasi rutinitas kecantikan Anda dengan produk ikonis Glamoire.</p>
                        <a href="/shop" class="link-gold">Shop The Collection <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="split-section-right">
                        {{-- [FIX] overflow:hidden agar swiper tidak meluap ke tepi --}}
                        <div style="overflow: hidden; width: 100%;">
                            <div class="swiper top-selling-slider product-slider" style="padding-bottom: 2rem; padding-top: 0.5rem;">
                                <div class="swiper-wrapper">
                                    @foreach ($data['topsell'] as $product)
                                        @php
                                            $activePromo = $product->promos->first();
                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                            $discountPercent = ($discountedPrice && $product->regular_price > 0)
                                                ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
                                            $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                            $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                                        @endphp
                                        <div class="h-auto swiper-slide">
                                            <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                <div class="lpc-visual {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                    @if ($discountPercent > 0)
                                                        <span class="lpc-minimal-badge">-{{ $discountPercent }}%</span>
                                                    @elseif ($product->is_gift ?? false)
                                                        <span class="lpc-minimal-badge" style="background:#000; color:var(--glamoire-gold);">Gift</span>
                                                    @endif
                                                    <button class="lpc-wishlist-icon {{ $inWishlist ? 'active' : '' }}"
                                                        onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                        <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                                    </button>
                                                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                                                    <div class="lpc-simple-cta-layer">
                                                        @if (session('id_user'))
                                                            @if ($product->stock_quantity == 0)
                                                                <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})" class="btn-clean-cta" style="background:var(--text-muted);">Notify Me</button>
                                                            @elseif($inCart)
                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-clean-cta" style="background:var(--success-main);">In Cart</button>
                                                            @else
                                                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-clean-cta">Add to Cart</button>
                                                            @endif
                                                        @else
                                                            <button onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#loginUser1" class="btn-clean-cta">Login to Buy</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="lpc-details">
                                                    <h3 class="lpc-clean-title">{{ $product->product_name }}</h3>
                                                    <p class="lpc-clean-benefit">{{ $product->short_description ?? 'Formulated for your natural beauty and daily skin glow.' }}</p>
                                                    <div class="mt-auto lpc-clean-price d-flex flex-column align-items-center justify-content-center">
                                                        @if ($product->priceVariation !== null)
                                                            <span>{{ $product->priceVariation }}</span>
                                                        @elseif ($discountedPrice && $discountedPrice < $product->regular_price)
                                                            <span class="lpc-clean-price-strike">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                            <span class="lpc-clean-price-discount fw-bold">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                        @else
                                                            <span class="fw-bold">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
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
            </div>
        </section>

        <!-- ============================================================
             4. BANNER PROMO GRID
        ============================================================ -->
        @if (count($data['popupsBanner']) > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="mb-4 mb-md-5 full-section-header">
                        <h2>Our Campaigns</h2>
                    </div>
                    <div class="row g-3 g-md-4">
                        @foreach ($data['popupsBanner'] as $popup)
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
                                        <p class="banner-subtitle">{{ $popup->description ?? 'Your skin deserves gentle ingredients.' }}</p>
                                        <button class="btn-banner-cta">Explore Campaign <i class="fas fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </div> {{-- /px-3 wrapper --}}

    <!-- ============================================================
         BRAND STATEMENT SECTION (Full Width)
    ============================================================ -->
    <section class="brand-statement-section reveal">
        <h2 class="brand-statement-text">
            "Rooted in Nature,<br><i>Designed for Your Everyday Glow.</i>"
        </h2>
        <p class="brand-statement-subtext">
            Memadukan kemurnian alam dengan inovasi sains. Glamoire menghadirkan perawatan kulit yang mentransformasi kecantikan sejati Anda.
        </p>
        <a href="/about" class="btn-clean-outline">Our Story</a>
    </section>

    {{-- Wrapper konten utama dengan padding responsif --}}
    <div class="px-3 px-md-4 px-lg-5">

        <!-- ============================================================
             5. FLASH SALE
        ============================================================ -->
        @if(isset($data['flashSaleProducts']) && count($data['flashSaleProducts']) > 0)
        <section class="section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="px-3 flash-sale-wrapper px-md-4 px-lg-5">
                    <div class="row align-items-center" id="flash-sale-container" data-endtime="{{ $data['flashSaleEndTime'] }}">

                        <!-- Header & Timer -->
                        <div class="col-12 col-xl-3 flash-header">
                            <h2 class="flash-title">Flash Sale.</h2>
                            <p style="font-size: 0.95rem; color: var(--text-muted); line-height: 1.6; margin: 0;">
                                Penawaran eksklusif. Kesempatan terbatas untuk mengoleksi produk impian Anda.
                            </p>
                            <div class="timer-flex">
                                <div class="timer-block">
                                    <div class="timer-val" id="fs-hours">00</div>
                                    <div class="timer-lbl">Hours</div>
                                </div>
                                <span class="fs-4 fw-bold" style="color:var(--glamoire-gold);">:</span>
                                <div class="timer-block">
                                    <div class="timer-val" id="fs-mins">00</div>
                                    <div class="timer-lbl">Mins</div>
                                </div>
                                <span class="fs-4 fw-bold" style="color:var(--glamoire-gold);">:</span>
                                <div class="timer-block">
                                    <div class="timer-val" id="fs-secs" style="color: var(--danger-main);">00</div>
                                    <div class="timer-lbl">Secs</div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Slider -->
                        <div class="mt-4 mt-xl-0 col-12 col-xl-9">
                            <div style="overflow: hidden; width: 100%;">
                                <div class="swiper flash-sale-slider product-slider" style="padding-bottom: 2rem;">
                                    <div class="swiper-wrapper">
                                        @foreach ($data['flashSaleProducts'] as $fsProduct)
                                            @php
                                                $discountPercent = round((($fsProduct->regular_price - $fsProduct->flash_sale_price) / $fsProduct->regular_price) * 100);
                                                $stockLeft = $fsProduct->stock_quantity;
                                                $stockPercent = min(($stockLeft / 50) * 100, 100);
                                            @endphp
                                            <div class="h-auto swiper-slide">
                                                <div class="luxury-product-card" onclick="window.location.href = '/{{ $fsProduct->product_code }}_product'">
                                                    <div class="lpc-visual" style="background: #FFF; border: 1px solid #E5E7EB;">
                                                        <span class="lpc-minimal-badge" style="background: var(--danger-main); color: #FFF;">-{{ $discountPercent }}%</span>
                                                        <img src="{{ Storage::url($fsProduct->main_image) }}" alt="{{ $fsProduct->product_name }}">
                                                    </div>
                                                    <div class="lpc-details" style="padding: 0 0.25rem;">
                                                        <h3 class="lpc-clean-title">{{ $fsProduct->product_name }}</h3>
                                                        <div class="mt-1 lpc-clean-price d-flex flex-column align-items-start">
                                                            <span class="lpc-clean-price-strike">Rp {{ number_format($fsProduct->regular_price, 0, ',', '.') }}</span>
                                                            <span class="lpc-clean-price-discount fw-bold" style="font-size: 1.05rem;">Rp {{ number_format($fsProduct->flash_sale_price, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div class="mt-2 w-100">
                                                            <div style="height: 4px; background: #E5E7EB; width: 100%; border-radius: 4px; overflow: hidden;">
                                                                <div style="height: 100%; background: var(--glamoire-dark); width: {{ $stockPercent }}%;"></div>
                                                            </div>
                                                            <span style="font-size: 0.72rem; color: var(--danger-main); margin-top: 5px; font-weight: 600; display: block;">
                                                                🔥 Tersisa {{ $stockLeft }} item
                                                            </span>
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
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fsContainer = document.getElementById('flash-sale-container');
                if (!fsContainer) return;
                const endTimeString = fsContainer.getAttribute('data-endtime');
                if (!endTimeString) return;
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
                    const h = Math.floor((distance % (1000*60*60*24)) / (1000*60*60));
                    const m = Math.floor((distance % (1000*60*60)) / (1000*60));
                    const s = Math.floor((distance % (1000*60)) / 1000);
                    document.getElementById("fs-hours").innerHTML = h < 10 ? "0"+h : h;
                    document.getElementById("fs-mins").innerHTML  = m < 10 ? "0"+m : m;
                    document.getElementById("fs-secs").innerHTML  = s < 10 ? "0"+s : s;
                }, 1000);
            });
        </script>
        @endif

        <!-- ============================================================
             6. EXCLUSIVE OFFERS / PROMO EVENT
        ============================================================ -->
        @if ($data['promos']->count() > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="full-section-header">
                        <h2>Exclusive Offers</h2>
                        <p>Dapatkan voucher dan penawaran spesial untuk melengkapi ritual kecantikan harian Anda.</p>
                    </div>
                    <div style="overflow: hidden; width: 100%;">
                        <div class="swiper promo-special-slider product-slider" style="padding-top: 0.5rem; padding-bottom: 2.5rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['promos']->sortByDesc('created_at') as $promo)
                                    <div class="h-auto swiper-slide">
                                        <div class="promo-event-card" onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
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
                                                        - {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                                                    @endif
                                                </div>
                                                <button class="mt-auto w-100 btn-lpc-action btn-lpc-add">Eksplor Penawaran</button>
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
            </section>
        @endif

        <!-- ============================================================
             7. BRAND DIRECTORY
        ============================================================ -->
        <section class="brand-section-wrapper reveal">
            <div class="p-0 container-fluid">
                <div class="brand-section-header">
                    <h2 class="section-title">The <span style="color:var(--glamoire-gold); font-style:italic;">Brands.</span></h2>
                    <p class="mx-auto section-desc" style="max-width: 600px;">Koleksi eksklusif dari merek kecantikan ternama yang dikurasi khusus untuk memenuhi standar Anda.</p>
                </div>
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

        <!-- ============================================================
             9. SHOP BY CATEGORY
        ============================================================ -->
        <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="mb-4 mb-md-5 full-section-header">
                    <h2>Shop by Category</h2>
                </div>
                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $category)
                        @php
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
                                    <i class="bi bi-stars" style="font-size: 2rem; color: var(--glamoire-gold);"></i>
                                @endif
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============================================================
             10. THE GLAMOIRE JOURNAL
        ============================================================ -->
        @if (count($data['articles']) > 0)
            <section class="pt-0 section-padding reveal">
                <div class="p-0 container-fluid">
                    <div class="mb-4 split-section-wrapper mb-md-5" style="align-items: flex-end;">
                        <div style="flex: 1; min-width: 0;">
                            <h2 class="section-title">The Glamoire <br><span style="color:var(--glamoire-gold); font-style:italic;">Journal.</span></h2>
                            <p class="mb-0 section-desc">Eksplorasi tren kecantikan, edukasi skincare, dan wawasan plant-based beauty.</p>
                        </div>
                        <div class="text-start text-md-end" style="flex-shrink: 0;">
                            <a href="/newsletter" class="link-gold">Baca Semua Jurnal <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach ($data['articles']->take(3) as $article)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="editorial-article-card" onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
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
                                        <p class="editorial-excerpt">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($article->description ?? $article->content ?? 'Pelajari lebih lanjut tentang wawasan perawatan kulit eksklusif dari Glamoire.'), 120, '...') }}
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

        <!-- ============================================================
             11. NEWSLETTER
        ============================================================ -->
        <section class="pt-0 section-padding reveal">
            <div class="p-0 container-fluid">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Stay Glamorous.</h2>
                    <p class="nl-desc">Daftarkan email Anda untuk menerima pembaruan dari jurnal kecantikan kami langsung di kotak masuk Anda.</p>
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
                            style="display: none; font-size: 0.9rem;"></div>
                    </form>
                </div>
            </div>
        </section>

    </div> {{-- /px-3 wrapper --}}

    </div> {{-- /overflow-x:hidden outer wrapper --}}

    <!-- ============================================================
         SCRIPTS
    ============================================================ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- Intersection Observer (Reveal Animation) ---
            const revealElements = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, { root: null, rootMargin: '0px', threshold: 0.1 });
            revealElements.forEach(el => revealObserver.observe(el));

            // --- HERO SWIPER ---
            new Swiper('.hero-swiper', {
                slidesPerView: 1, loop: true,
                effect: 'fade', fadeEffect: { crossFade: true },
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
            });

            // --- TOP SELLING / BEST SELLERS ---
            // [FIX] grabCursor + slidesPerView lebih proporsional
            new Swiper(".top-selling-slider", {
                slidesPerView: 1.8,
                spaceBetween: 14,
                grabCursor: true,
                navigation: {
                    nextEl: ".top-selling-slider .swiper-button-next",
                    prevEl: ".top-selling-slider .swiper-button-prev"
                },
                breakpoints: {
                    400:  { slidesPerView: 2,   spaceBetween: 14 },
                    576:  { slidesPerView: 2.2,  spaceBetween: 18 },
                    768:  { slidesPerView: 2.8,  spaceBetween: 22 },
                    992:  { slidesPerView: 3,    spaceBetween: 26 },
                    1200: { slidesPerView: 4,    spaceBetween: 28 }
                }
            });

            // --- FLASH SALE SLIDER ---
            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.6,
                spaceBetween: 12,
                grabCursor: true,
                navigation: {
                    nextEl: ".flash-sale-slider .swiper-button-next",
                    prevEl: ".flash-sale-slider .swiper-button-prev"
                },
                breakpoints: {
                    400:  { slidesPerView: 2,    spaceBetween: 12 },
                    576:  { slidesPerView: 2.2,  spaceBetween: 16 },
                    768:  { slidesPerView: 2.5,  spaceBetween: 20 },
                    992:  { slidesPerView: 3,    spaceBetween: 22 },
                    1200: { slidesPerView: 3,    spaceBetween: 26 }
                }
            });

            // --- PROMO SPECIAL / EXCLUSIVE OFFERS ---
            new Swiper(".promo-special-slider", {
                slidesPerView: 1.15,
                spaceBetween: 14,
                grabCursor: true,
                navigation: {
                    nextEl: ".promo-special-slider .swiper-button-next",
                    prevEl: ".promo-special-slider .swiper-button-prev"
                },
                breakpoints: {
                    400:  { slidesPerView: 1.4,  spaceBetween: 14 },
                    576:  { slidesPerView: 2,    spaceBetween: 18 },
                    768:  { slidesPerView: 2.5,  spaceBetween: 20 },
                    992:  { slidesPerView: 3,    spaceBetween: 22 },
                    1200: { slidesPerView: 4,    spaceBetween: 26 }
                }
            });

            // --- BRAND MARQUEE SLIDER ---
            new Swiper(".brand-slider", {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: true,
                speed: 4000,
                autoplay: { delay: 0, disableOnInteraction: false },
                allowTouchMove: true,
                grabCursor: true,
                breakpoints: {
                    480:  { slidesPerView: 4,  spaceBetween: 24 },
                    576:  { slidesPerView: 4,  spaceBetween: 28 },
                    768:  { slidesPerView: 5,  spaceBetween: 34 },
                    992:  { slidesPerView: 6,  spaceBetween: 42 },
                    1200: { slidesPerView: 7,  spaceBetween: 48 }
                }
            });

            // --- MODAL AUTO SHOW ---
            @if (!session('id_user') && $data['popups']->isNotEmpty())
                var myModal = new bootstrap.Modal(document.getElementById('firstUser'));
                myModal.show();
            @endif

            @if (session('id_user') && $data['promoModal'] !== null)
                var promoModal = new bootstrap.Modal(document.getElementById('promoModal'));
                promoModal.show();
            @endif
        });

        // --- AJAX SUBSCRIBE ---
        $(document).ready(function() {
            $('#subscribe_email').on('keyup', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: "{{ route('check.email.subscribe') }}",
                        method: "POST",
                        data: { "_token": "{{ csrf_token() }}", email: email },
                        success: function(response) {
                            if (response.exists) {
                                $('#validationEmailSubscribe').html('<i class="fas fa-exclamation-circle"></i> Email ini sudah terdaftar.').show();
                                $('#subscribe-btn').prop('disabled', true).css('opacity', '0.5');
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
                    data: { _token: "{{ csrf_token() }}", email: email },
                    success: function(response) {
                        btn.html('Subscribe').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Welcome to Glamoire!", text: response.message, confirmButtonColor: "#183018" });
                            $("#subscribe_email").val('');
                        } else {
                            Swal.fire({ icon: "error", title: "Oops!", text: response.message });
                        }
                    },
                    error: function() {
                        btn.html('Subscribe').prop('disabled', false);
                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan sistem, coba lagi nanti." });
                    }
                });
            });
        });
    </script>

@endsection

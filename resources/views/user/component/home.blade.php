@extends('user.layouts.master')

@section('content')

                    @php
    $wishlist = session('id_user') && $data['wishlist'] !== null ? $data['wishlist'] : [];
                    @endphp

                    <style>
                        /* ==========================================
                               WORLD CLASS HOME STYLING (Glamoire Premium)
                               ========================================== */
                        :root {
                            --glamoire-dark: #183018;
                            --glamoire-light: #F9FAFB;
                            --glamoire-accent: #2A4D2A;
                            --glamoire-gold: #D4AF37;
                            --glamoire-sand: #F4F1EA;
                            --text-main: #1F2937;
                            --text-muted: #6B7280;
                            --danger-main: #DC2626;
                            --transition-smooth: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                        }

                        body {
                            background-color: #FFFFFF;
                            font-family: 'Poppins', sans-serif;
                            overflow-x: hidden;
                        }

                        h1,
                        h2,
                        h3,
                        h4,
                        h5,
                        h6 {
                            font-family: 'The Seasons', serif;
                        }

                        /* --- Global Utilities --- */
                        .section-padding {
                            padding: 4rem 0;
                        }

                        @media (max-width: 768px) {
                            .section-padding {
                                padding: 2.5rem 0;
                            }
                        }

                        /* --- Custom Split Layout (Left Title, Right Slider) --- */
                        .split-section-wrapper {
                            display: flex;
                            flex-direction: row;
                            align-items: flex-start;
                            gap: 2rem;
                            width: 100%;
                        }

                        .split-section-left {
                            flex: 0 0 25%;
                            max-width: 300px;
                            min-width: 220px;
                            position: sticky;
                            top: 100px;
                        }

                        .split-section-right {
                            flex: 1;
                            min-width: 0;
                            /* Penting agar swiper tidak overflow */
                        }

                        @media (max-width: 991px) {
                            .split-section-wrapper {
                                flex-direction: column;
                                gap: 1.5rem;
                            }

                            .split-section-left {
                                flex: 0 0 auto;
                                max-width: 100%;
                                position: static;
                            }
                        }

                        .split-title {
                            font-size: clamp(1.8rem, 3vw, 2.5rem);
                            font-weight: 700;
                            color: var(--glamoire-dark);
                            line-height: 1.2;
                            margin-bottom: 1rem;
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                        }

                        .split-desc {
                            font-size: 0.95rem;
                            color: var(--text-muted);
                            line-height: 1.6;
                            margin-bottom: 1.5rem;
                        }

                        .split-link {
                            color: var(--glamoire-dark);
                            font-weight: 600;
                            text-decoration: none;
                            display: inline-flex;
                            align-items: center;
                            gap: 0.5rem;
                            transition: var(--transition-smooth);
                            border-bottom: 1px solid var(--glamoire-dark);
                            padding-bottom: 2px;
                        }

                        .split-link:hover {
                            color: var(--glamoire-gold);
                            border-color: var(--glamoire-gold);
                            gap: 0.8rem;
                        }

                        /* --- Full Width Header --- */
                        .full-section-header {
                            text-align: center;
                            margin-bottom: 2.5rem;
                        }

                        .full-section-header h2 {
                            font-size: clamp(2rem, 4vw, 2.8rem);
                            font-weight: 700;
                            color: var(--glamoire-dark);
                            margin-bottom: 0.5rem;
                        }

                        .full-section-header p {
                            font-size: 1rem;
                            color: var(--text-muted);
                            max-width: 600px;
                            margin: 0 auto;
                        }

                        /* --- Universal Swiper Navigation --- */
                        .swiper-button-next,
                        .swiper-button-prev {
                            color: var(--glamoire-dark) !important;
                            background: rgba(255, 255, 255, 0.9);
                            backdrop-filter: blur(4px);
                            width: 44px !important;
                            height: 44px !important;
                            border-radius: 50%;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                            transition: var(--transition-smooth);
                        }

                        .swiper-button-next:hover,
                        .swiper-button-prev:hover {
                            background: #FFF;
                            transform: scale(1.1);
                        }

                        .swiper-button-next::after,
                        .swiper-button-prev::after {
                            font-size: 1.2rem !important;
                            font-weight: bold;
                        }

                        @media (max-width: 768px) {

                            .swiper-button-next,
                            .swiper-button-prev {
                                display: none !important;
                            }
                        }

                        /* --- Hero Carousel --- */
                        .hero-carousel-wrapper {
                            width: 100%;
                            background: var(--glamoire-sand);
                        }

                        .hero-swiper .swiper-slide {
                            aspect-ratio: 21/9;
                            overflow: hidden;
                            cursor: pointer;
                        }

                        @media (max-width: 991px) {
                            .hero-swiper .swiper-slide {
                                aspect-ratio: 16/9;
                            }
                        }

                        @media (max-width: 576px) {
                            .hero-swiper .swiper-slide {
                                aspect-ratio: 4/3;
                            }
                        }

                        .hero-swiper img,
                        .hero-swiper video {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            transition: transform 8s ease;
                            transform: scale(1.03);
                        }

                        .hero-swiper .swiper-slide-active img {
                            transform: scale(1);
                        }

                        .hero-swiper .swiper-pagination-bullet-active {
                            background: var(--glamoire-dark) !important;
                            transform: scale(1.2);
                        }

                        /* --- Trust Badges --- */
                        .trust-section {
                            background: #FFF;
                            border-bottom: 1px solid #F3F4F6;
                            padding: 1.5rem 0;
                        }

                        .trust-item {
                            text-align: center;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 0.5rem;
                        }

                        .trust-icon {
                            width: 45px;
                            height: 45px;
                            background: var(--glamoire-sand);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: var(--glamoire-dark);
                            font-size: 1.2rem;
                        }

                        .trust-text h4 {
                            font-size: 0.95rem;
                            font-weight: 700;
                            margin: 0;
                            color: var(--text-main);
                            font-family: 'Poppins', sans-serif;
                        }

                        /* --- Universal Product Card --- */
                        .premium-product-card {
                            background: #FFF;
                            border-radius: 16px;
                            border: 1px solid #F3F4F6;
                            overflow: hidden;
                            transition: var(--transition-smooth);
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                            position: relative;
                        }

                        .premium-product-card:hover {
                            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.06);
                            transform: translateY(-5px);
                            border-color: #E5E7EB;
                        }

                        .card-img-box {
                            position: relative;
                            padding-top: 100%;
                            background: #FAFAFA;
                            overflow: hidden;
                            cursor: pointer;
                        }

                        .card-img-box img {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            transition: transform 0.7s ease;
                        }

                        .premium-product-card:hover .card-img-box img {
                            transform: scale(1.08);
                        }

                        .card-img-box.dark-overlay img {
                            filter: grayscale(100%) opacity(0.7);
                        }

                        .card-badge {
                            position: absolute;
                            top: 12px;
                            left: 12px;
                            padding: 4px 10px;
                            border-radius: 4px;
                            font-size: 0.7rem;
                            font-weight: 700;
                            z-index: 2;
                            text-transform: uppercase;
                        }

                        .badge-discount {
                            background: var(--danger-main);
                            color: #FFF;
                        }

                        .badge-gift {
                            background: #EC4899;
                            color: #FFF;
                        }

                        .btn-wishlist {
                            position: absolute;
                            top: 12px;
                            right: 12px;
                            width: 34px;
                            height: 34px;
                            background: rgba(255, 255, 255, 0.9);
                            backdrop-filter: blur(4px);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #D1D5DB;
                            z-index: 2;
                            cursor: pointer;
                            transition: var(--transition-smooth);
                        }

                        .btn-wishlist:hover,
                        .btn-wishlist.active {
                            color: var(--danger-main);
                            transform: scale(1.1);
                        }

                        .card-action-area {
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            width: 100%;
                            padding: 1rem;
                            background: linear-gradient(to top, rgba(255, 255, 255, 0.95), transparent);
                            transform: translateY(100%);
                            opacity: 0;
                            transition: var(--transition-smooth);
                            z-index: 3;
                        }

                        .premium-product-card:hover .card-action-area {
                            transform: translateY(0);
                            opacity: 1;
                        }

                        .btn-action-main {
                            width: 100%;
                            padding: 0.6rem;
                            border-radius: 50px;
                            font-weight: 600;
                            font-size: 0.85rem;
                            border: none;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                            transition: all 0.3s;
                        }

                        .btn-add {
                            background: var(--glamoire-dark);
                            color: #FFF;
                        }

                        .btn-add:hover {
                            background: var(--glamoire-accent);
                        }

                        .btn-added {
                            background: #10B981;
                            color: #FFF;
                        }

                        .btn-notify {
                            background: var(--danger-main);
                            color: #FFF;
                        }

                        .card-info {
                            padding: 1.25rem;
                            display: flex;
                            flex-direction: column;
                            flex-grow: 1;
                            cursor: pointer;
                        }

                        .brand-name {
                            font-size: 0.7rem;
                            color: var(--text-muted);
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            font-weight: 600;
                            margin-bottom: 0.3rem;
                        }

                        .product-name {
                            font-size: 0.95rem;
                            font-weight: 500;
                            color: var(--text-main);
                            margin-bottom: 0.5rem;
                            line-height: 1.4;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-decoration: none;
                        }

                        .premium-product-card:hover .product-name {
                            color: var(--glamoire-gold);
                        }

                        .rating-box {
                            display: flex;
                            align-items: center;
                            gap: 4px;
                            font-size: 0.8rem;
                            color: var(--text-muted);
                            margin-bottom: 0.75rem;
                        }

                        .rating-box i {
                            color: #F59E0B;
                        }

                        .price-box {
                            margin-top: auto;
                            display: flex;
                            flex-direction: column;
                        }

                        .price-current {
                            font-size: 1.1rem;
                            font-weight: 700;
                            color: var(--glamoire-dark);
                        }

                        .price-discounted {
                            color: var(--danger-main);
                        }

                        .price-strike {
                            font-size: 0.85rem;
                            color: #9CA3AF;
                            text-decoration: line-through;
                            margin-bottom: -2px;
                        }

                        /* --- Banner Promo Grid (2 Columns) --- */
                        .promo-grid-banner {
                            border-radius: 16px;
                            overflow: hidden;
                            position: relative;
                            aspect-ratio: 16/9;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                            transition: var(--transition-smooth);
                            cursor: pointer;
                            background: #000;
                        }

                        .promo-grid-banner:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
                        }

                        .promo-grid-banner img,
                        .promo-grid-banner video {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            opacity: 0.85;
                            transition: var(--transition-smooth);
                        }

                        .promo-grid-banner:hover img,
                        .promo-grid-banner:hover video {
                            opacity: 1;
                            transform: scale(1.05);
                        }

                        .promo-grid-content {
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            width: 100%;
                            padding: 2rem;
                            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
                            color: #FFF;
                            pointer-events: none;
                        }

                        .promo-grid-content h3 {
                            font-size: 1.8rem;
                            font-weight: 700;
                            margin-bottom: 0.5rem;
                        }

                        .promo-grid-content p {
                            font-size: 0.95rem;
                            opacity: 0.9;
                            margin-bottom: 1rem;
                            font-family: 'Poppins', sans-serif;
                        }

                        .btn-shop-white {
                            display: inline-block;
                            padding: 0.5rem 1.5rem;
                            background: #FFF;
                            color: #000;
                            border-radius: 50px;
                            font-weight: 600;
                            font-size: 0.85rem;
                            font-family: 'Poppins', sans-serif;
                        }

                        /* --- Flash Sale Section --- */
                        .flash-sale-wrapper {
                            background: linear-gradient(135deg, #111827 0%, #1F2937 100%);
                            border-radius: 24px;
                            padding: 3rem;
                            margin: 2rem 0;
                            color: #FFF;
                            position: relative;
                            overflow: hidden;
                            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                        }

                        .flash-sale-wrapper::before {
                            content: '';
                            position: absolute;
                            top: -50%;
                            left: -10%;
                            width: 50%;
                            height: 200%;
                            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
                        }

                        .flash-header {
                            position: relative;
                            z-index: 2;
                        }

                        .flash-title {
                            font-size: 2.5rem;
                            font-weight: 800;
                            color: var(--glamoire-gold);
                            margin-bottom: 0.5rem;
                            display: flex;
                            align-items: center;
                            gap: 10px;
                        }

                        .timer-flex {
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                            margin-top: 1.5rem;
                        }

                        .timer-block {
                            background: rgba(255, 255, 255, 0.1);
                            backdrop-filter: blur(8px);
                            border: 1px solid rgba(255, 255, 255, 0.2);
                            border-radius: 8px;
                            padding: 0.5rem 0.8rem;
                            text-align: center;
                            min-width: 65px;
                        }

                        .timer-val {
                            font-size: 1.5rem;
                            font-weight: 700;
                            line-height: 1;
                        }

                        .timer-lbl {
                            font-size: 0.65rem;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            opacity: 0.8;
                            margin-top: 2px;
                        }

                        /* --- Promo Cards (Events/Vouchers) --- */
                        .promo-event-card {
                            background: #FFF;
                            border-radius: 16px;
                            overflow: hidden;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
                            border: 1px solid #F3F4F6;
                            transition: var(--transition-smooth);
                            cursor: pointer;
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                        }

                        .promo-event-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
                            border-color: var(--glamoire-dark);
                        }

                        .promo-event-img {
                            width: 100%;
                            aspect-ratio: 16/9;
                            object-fit: cover;
                        }

                        .promo-event-body {
                            padding: 1.5rem;
                            display: flex;
                            flex-direction: column;
                            flex-grow: 1;
                            text-align: center;
                            align-items: center;
                        }

                        .promo-event-type {
                            font-size: 0.75rem;
                            color: var(--glamoire-gold);
                            text-transform: uppercase;
                            font-weight: 700;
                            letter-spacing: 1px;
                            margin-bottom: 0.5rem;
                        }

                        .promo-event-title {
                            font-size: 1.25rem;
                            font-weight: 700;
                            color: var(--text-main);
                            margin-bottom: 0.5rem;
                            line-height: 1.3;
                        }

                        .promo-event-date {
                            font-size: 0.85rem;
                            color: var(--text-muted);
                            margin-bottom: 1rem;
                            display: flex;
                            align-items: center;
                            gap: 5px;
                        }

                        /* --- Brand Directory --- */
                        .brand-card {
                            background: #FFF;
                            border-radius: 12px;
                            border: 1px solid #F3F4F6;
                            padding: 1.5rem;
                            text-align: center;
                            transition: var(--transition-smooth);
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            height: 100%;
                            cursor: pointer;
                        }

                        .brand-card:hover {
                            background: var(--glamoire-dark);
                            border-color: var(--glamoire-dark);
                            transform: translateY(-5px);
                        }

                        .brand-logo-box {
                            width: 80px;
                            height: 80px;
                            margin-bottom: 1rem;
                            background: #FFF;
                            border-radius: 50%;
                            padding: 10px;
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                        }

                        .brand-logo-box img {
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                        }

                        .brand-name-txt {
                            font-size: 1rem;
                            font-weight: 600;
                            color: var(--text-main);
                            margin: 0;
                            font-family: 'Poppins', sans-serif;
                            transition: color 0.3s;
                        }

                        .brand-card:hover .brand-name-txt {
                            color: #FFF;
                        }

                        /* --- Category Section --- */
                        .category-grid {
                            display: grid;
                            grid-template-columns: repeat(6, 1fr);
                            gap: 1.5rem;
                        }

                        @media (max-width: 1200px) {
                            .category-grid {
                                grid-template-columns: repeat(4, 1fr);
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
                            border-radius: 16px;
                            padding: 2rem 1rem;
                            text-align: center;
                            cursor: pointer;
                            transition: var(--transition-smooth);
                            border: 1px solid #F3F4F6;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                        }

                        .cat-card-premium:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
                            border-color: var(--glamoire-gold);
                        }

                        .cat-icon-wrapper {
                            width: 60px;
                            height: 60px;
                            border-radius: 50%;
                            background: var(--glamoire-sand);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 1rem;
                            transition: var(--transition-smooth);
                            font-size: 1.5rem;
                        }

                        .cat-card-premium:hover .cat-icon-wrapper {
                            background: var(--glamoire-dark);
                            color: #FFF !important;
                        }

                        .cat-name {
                            font-size: 0.95rem;
                            font-weight: 600;
                            color: var(--text-main);
                            margin: 0;
                            font-family: 'Poppins', sans-serif;
                        }

                        /* --- Article Section --- */
                        .article-highlight {
                            position: relative;
                            border-radius: 16px;
                            overflow: hidden;
                            cursor: pointer;
                            height: 400px;
                        }

                        .article-highlight img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            transition: transform 0.8s ease;
                        }

                        .article-highlight:hover img {
                            transform: scale(1.05);
                        }

                        .article-overlay {
                            position: absolute;
                            inset: 0;
                            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
                            display: flex;
                            flex-direction: column;
                            justify-content: flex-end;
                            padding: 2.5rem;
                        }

                        .article-overlay h3 {
                            color: #FFF;
                            font-size: 2rem;
                            font-weight: 700;
                            margin-bottom: 0.5rem;
                        }

                        .article-overlay p {
                            color: rgba(255, 255, 255, 0.8);
                            font-size: 0.9rem;
                        }

                        .article-list-item {
                            display: flex;
                            gap: 1.5rem;
                            align-items: center;
                            cursor: pointer;
                            padding: 1rem;
                            border-radius: 12px;
                            transition: var(--transition-smooth);
                            border: 1px solid transparent;
                        }

                        .article-list-item:hover {
                            background: #FFF;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                            border-color: #F3F4F6;
                        }

                        .article-list-img {
                            width: 120px;
                            height: 120px;
                            border-radius: 12px;
                            overflow: hidden;
                            flex-shrink: 0;
                        }

                        .article-list-img img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }

                        .article-list-content h4 {
                            font-size: 1.1rem;
                            font-weight: 600;
                            color: var(--text-main);
                            margin-bottom: 0.5rem;
                            line-height: 1.4;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            font-family: 'Poppins', sans-serif;
                        }

                        .article-list-content .meta {
                            font-size: 0.8rem;
                            color: var(--text-muted);
                        }

                        /* --- Newsletter Section --- */
                        .newsletter-premium {
                            background: var(--glamoire-dark);
                            border-radius: 24px;
                            padding: 5rem 2rem;
                            text-align: center;
                            color: #FFF;
                            margin: 2rem 0;
                            position: relative;
                            overflow: hidden;
                        }

                        .newsletter-premium::after {
                            content: '';
                            position: absolute;
                            right: -5%;
                            top: -20%;
                            width: 300px;
                            height: 300px;
                            background: url('{{ asset('images/pattern-right.png') }}') no-repeat center;
                            background-size: contain;
                            opacity: 0.1;
                            transform: rotate(-15deg);
                        }

                        .nl-title {
                            font-size: 2.5rem;
                            font-weight: 700;
                            margin-bottom: 1rem;
                            color: var(--glamoire-gold);
                        }

                        .nl-desc {
                            font-size: 1.1rem;
                            opacity: 0.9;
                            max-width: 600px;
                            margin: 0 auto 2.5rem;
                        }

                        .nl-form {
                            max-width: 550px;
                            margin: 0 auto;
                            position: relative;
                            z-index: 2;
                        }

                        .nl-input-group {
                            display: flex;
                            background: #FFF;
                            border-radius: 50px;
                            padding: 0.5rem;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                        }

                        .nl-input {
                            border: none;
                            background: transparent;
                            padding: 0.8rem 1.5rem;
                            width: 100%;
                            font-size: 1rem;
                            color: var(--text-main);
                            outline: none;
                        }

                        .nl-btn {
                            background: var(--glamoire-gold);
                            color: var(--glamoire-dark);
                            border: none;
                            padding: 0 2rem;
                            border-radius: 50px;
                            font-weight: 700;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            transition: var(--transition-smooth);
                            cursor: pointer;
                            white-space: nowrap;
                        }

                        .nl-btn:hover {
                            background: #FFF;
                        }

                        @media (max-width: 576px) {
                            .nl-input-group {
                                flex-direction: column;
                                background: transparent;
                                box-shadow: none;
                                gap: 10px;
                                padding: 0;
                            }

                            .nl-input {
                                background: #FFF;
                                border-radius: 50px;
                                padding: 1rem;
                            }

                            .nl-btn {
                                padding: 1rem;
                                width: 100%;
                            }
                        }
                    </style>

                    @if (!session('id_user') && $data['popups']->isNotEmpty())
                        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 overflow-hidden" style="border-radius: 16px;">
                                    <div class="modal-body p-0 position-relative">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                                            style="background-color: white; border-radius: 50%; padding: 0.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.2);"></button>
                                        @if ($data['popups'][0]->media_type === 'image')
                                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto">
                                        @endif
                                        <div class="p-4 text-center" style="background: var(--glamoire-dark); color: white;">
                                            <h4 class="fw-bold mb-2">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h4>
                                            <p class="mb-4 opacity-75" style="font-size: 0.9rem;">
                                                {{ $data['popups'][0]->description ?? 'Dapatkan promo spesial untuk pendaftaran pertama Anda.' }}
                                            </p>
                                            <a href="/login" class="btn btn-light rounded-pill px-5 py-2 fw-bold w-100">Daftar Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('id_user') && $data['promoModal'] !== null)
                        <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 bg-transparent">
                                    <div class="modal-body p-0 position-relative text-center">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                                            style="background-color: white; border-radius: 50%; padding: 0.5rem;"></button>
                                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                                alt="{{ $data['promoModal']->promo_name }}"
                                                class="img-fluid rounded-4 shadow-lg cursor-pointer">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="hero-carousel-wrapper">
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
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="trust-section">
                        <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">
                            <div class="row g-3 justify-content-center">
                                <div class="col-4 col-md-4">
                                    <div class="trust-item">
                                        <div class="trust-icon"><i class="fas fa-leaf"></i></div>
                                        <div class="trust-text">
                                            <h4>Plant-Based</h4>
                                            <p class="d-none d-md-block">100% bahan alami & cruelty-free</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4">
                                    <div class="trust-item">
                                        <div class="trust-icon"><i class="fas fa-check-circle"></i></div>
                                        <div class="trust-text">
                                            <h4>BPOM Approved</h4>
                                            <p class="d-none d-md-block">Terjamin aman & tersertifikasi</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4">
                                    <div class="trust-item">
                                        <div class="trust-icon"><i class="fas fa-box-open"></i></div>
                                        <div class="trust-text">
                                            <h4>Pasti Asli</h4>
                                            <p class="d-none d-md-block">Garansi original produk</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

                        <section class="section-padding">
                            <div class="container-fluid p-0">
                                <div class="split-section-wrapper">
                                    <div class="split-section-left">
                                        <h2 class="split-title"><img src="{{ asset('images/bundling.png') }}"
                                                style="width: 40px; height: 40px;"> Produk Terlaris</h2>
                                        <p class="split-desc">Produk favorit yang paling diminati pelanggan Glamoire. Sempurnakan rutinitas
                                            kecantikan Anda.</p>
                                        <a href="/shop" class="split-link">Belanja Sekarang <i class="fas fa-arrow-right"></i></a>
                                    </div>

                                    <div class="split-section-right">
                                        <div class="swiper top-selling-slider product-slider">
                                            <div class="swiper-wrapper">
                                                @foreach ($data['topsell'] as $product)
                                                    @php
        $activePromo = $product->promos->first();
        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
        $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
        $inWishlist = collect($wishlist)->contains('product_id', $product->id);
        $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                                                    @endphp

                                                    <div class="swiper-slide h-auto">
                                                        <div class="premium-product-card">
                                                            <div class="card-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                                onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                                @if ($product->is_gift ?? false)
                                                                    <span class="card-badge badge-gift"><i class="fas fa-gift"></i> Free Gift</span>
                                                                @elseif ($discountPercent > 0)
                                                                    <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                                                                @endif

                                                                <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}"
                                                                    onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                                                </div>

                                                                <img src="{{ Storage::url($product->main_image) }}"
                                                                    alt="{{ $product->product_name }}">

                                                                <div class="card-action-area">
                                                                    @if (session('id_user'))
                                                                        @if ($product->stock_quantity == 0)
                                                                            <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})"
                                                                                class="btn-action-main btn-notify">
                                                                                <i class="fas fa-bell"></i> Beritahu Saya
                                                                            </button>
                                                                        @else
                                                                            @if($inCart)
                                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'"
                                                                                    class="btn-action-main btn-added">
                                                                                    <i class="fas fa-check"></i> Di Keranjang
                                                                                </button>
                                                                            @else
                                                                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                                                                                    class="btn-action-main btn-add">
                                                                                    <i class="fas fa-shopping-bag"></i> Tambah
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        <button onclick="event.stopPropagation();" data-bs-toggle="modal"
                                                                            data-bs-target="#loginUser1" class="btn-action-main btn-add">
                                                                            Login untuk Beli
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="card-info"
                                                                onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                                <div class="brand-name">
                                                                    {{ $product->brand ? $product->brand->name : 'Glamoire' }}</div>
                                                                <a href="/{{ $product->product_code }}_product"
                                                                    class="product-name">{{ $product->product_name }}</a>
                                                                <div class="rating-box"><i class="fas fa-star"></i>
                                                                    <span>{{ $product->rating ?? '5.0' }}</span></div>
                                                                <div class="price-box">
                                                                    @if ($product->priceVariation !== null)
                                                                        <span class="price-current">{{ $product->priceVariation }}</span>
                                                                    @else
                                                                        @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                            <span class="price-strike">Rp
                                                                                {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                                            <span class="price-current price-discounted">Rp
                                                                                {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                                        @else
                                                                            <span class="price-current">Rp
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
                        </section>

                        @if(count($data['popupsBanner']) > 0)
                            <section class="section-padding pt-0">
                                <div class="container-fluid p-0">
                                    <div class="row g-4">
                                        @foreach ($data['popupsBanner'] as $popup)
                                            <div class="col-12 col-md-6">
                                                <div class="promo-grid-banner">
                                                    @if ($popup->media_type === 'image')
                                                        <img src="{{ Storage::url($popup->media_popup) }}" alt="{{ $popup->name }}">
                                                    @elseif ($popup->media_type === 'video')
                                                        <video autoplay loop muted playsinline>
                                                            <source src="{{ Storage::url($popup->media_popup) }}" type="video/mp4">
                                                        </video>
                                                    @endif
                                                    {{-- <div class="promo-grid-content">
                                                        <h3 class="text-white">{{ $popup->name ?? 'Special Offer' }}</h3>
                                                        <p>{{ $popup->description ?? 'Discover our exclusive collection.' }}</p>
                                                        <span class="btn-shop-white">Shop Now</span>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        @endif

                        <section class="section-padding pt-0">
                            <div class="container-fluid p-0">
                                <div class="flash-sale-wrapper">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-xl-3 mb-4 mb-xl-0 flash-header">
                                            <h2 class="flash-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
                                            <p class="mb-0" style="font-size: 1.1rem;">Penawaran super kilat. Jangan sampai terlewatkan!</p>
                                            <div class="timer-flex">
                                                <div class="timer-block">
                                                    <div class="timer-val">08</div>
                                                    <div class="timer-lbl">Jam</div>
                                                </div>
                                                <span class="timer-sep">:</span>
                                                <div class="timer-block">
                                                    <div class="timer-val">45</div>
                                                    <div class="timer-lbl">Mnt</div>
                                                </div>
                                                <span class="timer-sep">:</span>
                                                <div class="timer-block">
                                                    <div class="timer-val">12</div>
                                                    <div class="timer-lbl">Dtk</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-9">
                                            <div class="swiper flash-sale-slider product-slider pb-0">
                                                <div class="swiper-wrapper">
                                                    @foreach ($data['new']->take(6) as $product)
                                                        @php
        $activePromo = $product->promos->first();
        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : ($product->regular_price * 0.75);
        $discountPercent = round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100);
                                                        @endphp
                                                        <div class="swiper-slide h-auto">
                                                            <div class="premium-product-card"
                                                                onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                                <div class="card-img-box">
                                                                    <span class="card-badge bg-warning text-dark"><i class="fas fa-bolt"></i>
                                                                        {{ $discountPercent }}%</span>
                                                                    <img src="{{ Storage::url($product->main_image) }}"
                                                                        alt="{{ $product->product_name }}">
                                                                    <div class="position-absolute bottom-0 start-0 w-100 px-3 pb-3 z-3">
                                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                                            <span class="text-danger fw-bold"
                                                                                style="font-size: 0.7rem; background: rgba(255,255,255,0.9); padding: 2px 6px; border-radius: 4px;">Sisa
                                                                                Sedikit!</span>
                                                                        </div>
                                                                        <div class="progress" style="height: 6px; background: rgba(0,0,0,0.1);">
                                                                            <div class="progress-bar bg-danger" style="width: 85%;"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-info text-center py-3">
                                                                    <div class="price-box mt-0">
                                                                        <span class="price-strike mx-auto">Rp
                                                                            {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                                        <span class="price-current price-discounted fs-5">Rp
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
                        </section>

                        @if ($data['promos']->count() > 0)
                            <section class="section-padding pt-0">
                                <div class="container-fluid p-0">
                                    <div class="full-section-header">
                                        <h2>Promo Spesial Untuk Kamu</h2>
                                        <p>Dapatkan voucher dan penawaran menarik untuk melengkapi gaya hidupmu!</p>
                                    </div>

                                    <div class="swiper promo-special-slider product-slider">
                                        <div class="swiper-wrapper">
                                            @foreach ($data['promos']->sortByDesc('created_at') as $promo)
                                                <div class="swiper-slide h-auto">
                                                    <div class="promo-event-card" onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
                                                        <img class="promo-event-img"
                                                            src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}"
                                                            alt="{{ $promo->promo_name }}">
                                                        <div class="promo-event-body">
                                                            <span class="promo-event-type">{{ $promo->type }}</span>
                                                            <h3 class="promo-event-title">{{ $promo->promo_name }}</h3>
                                                            <div class="promo-event-date mx-auto">
                                                                <i class="far fa-calendar-alt text-success"></i>
                                                                @if($promo->start_date && $promo->end_date)
                                                                    {{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d M') }} -
                                                                    {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                                                                @endif
                                                            </div>
                                                            <span class="btn-action-main btn-add mt-auto"
                                                                style="width: auto; padding: 0.5rem 1.5rem;">Lihat Detail</span>
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

                        <section class="section-padding pt-0">
                            <div class="container-fluid p-0">
                                <div class="split-section-wrapper">
                                    <div class="split-section-left">
                                        <h2 class="split-title">Brand Pilihan</h2>
                                        <p class="split-desc">Temukan koleksi eksklusif dari merek kecantikan ternama yang telah dikurasi
                                            khusus untuk Anda.</p>
                                        {{-- <a href="/brands" class="split-link">Eksplor Brand <i class="fas fa-arrow-right"></i></a> --}}
                                    </div>
                                    <div class="split-section-right">
                                        <div class="swiper brand-slider product-slider">
                                            <div class="swiper-wrapper">
                                                @foreach ($data['brands'] as $brand)
                                                    <div class="swiper-slide h-auto">
                                                        <div class="brand-card" onclick="window.location.href = '/{{ $brand->name }}_brand'">
                                                            <div class="brand-logo-box">
                                                                <img src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : asset('images/no-brand.png') }}"
                                                                    alt="{{ $brand->name }}">
                                                            </div>
                                                            <h4 class="brand-name-txt">{{ $brand->name }}</h4>
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

                        <section class="section-padding pt-0">
                            <div class="container-fluid p-0">
                                <div class="full-section-header">
                                    <h2>Cocok Untuk Kamu</h2>
                                    <p>Rekomendasi personal berdasarkan preferensi dan gaya kecantikanmu.</p>
                                </div>

                                <div class="swiper curated-slider product-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($data['new'] as $product)
                                            @php
        $activePromo = $product->promos->first();
        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
        $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
        $inWishlist = collect($wishlist)->contains('product_id', $product->id);
        $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                                            @endphp

                                            <div class="swiper-slide h-auto">
                                                <div class="premium-product-card">
                                                    <div class="card-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}"
                                                        onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                        @if ($product->is_gift ?? false)
                                                            <span class="card-badge badge-gift"><i class="fas fa-gift"></i> Free Gift</span>
                                                        @elseif ($discountPercent > 0)
                                                            <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                                                        @endif

                                                        <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}"
                                                            onclick="event.stopPropagation(); {{ $inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')' }}">
                                                            <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                                        </div>

                                                        <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                                                        <div class="card-action-area">
                                                            @if (session('id_user'))
                                                                @if ($product->stock_quantity == 0)
                                                                    <button onclick="event.stopPropagation(); notifyMe({{ $product->id }})"
                                                                        class="btn-action-main btn-notify">
                                                                        <i class="fas fa-bell"></i> Beritahu
                                                                    </button>
                                                                @else
                                                                    @if($inCart)
                                                                        <button onclick="event.stopPropagation(); window.location.href='/cart'"
                                                                            class="btn-action-main btn-added">
                                                                            <i class="fas fa-check"></i> Keranjang
                                                                        </button>
                                                                    @else
                                                                        <button onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                                                                            class="btn-action-main btn-add">
                                                                            <i class="fas fa-shopping-bag"></i> Tambah
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                <button onclick="event.stopPropagation();" data-bs-toggle="modal"
                                                                    data-bs-target="#loginUser1" class="btn-action-main btn-add">
                                                                    Login Beli
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="card-info"
                                                        onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                        <div class="brand-name">{{ $product->brand ? $product->brand->name : 'Glamoire' }}</div>
                                                        <a href="/{{ $product->product_code }}_product"
                                                            class="product-name">{{ $product->product_name }}</a>
                                                        <div class="rating-box"><i class="fas fa-star"></i>
                                                            <span>{{ $product->rating ?? '5.0' }}</span></div>
                                                        <div class="price-box">
                                                            @if ($product->priceVariation !== null)
                                                                <span class="price-current">{{ $product->priceVariation }}</span>
                                                            @else
                                                                @if ($discountedPrice && $discountedPrice < $product->regular_price)
                                                                    <span class="price-strike">Rp
                                                                        {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                                    <span class="price-current price-discounted">Rp
                                                                        {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                                @else
                                                                    <span class="price-current">Rp
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
                        </section>

                        <section class="section-padding pt-0">
                            <div class="container-fluid p-0">
                                <div class="section-title-wrapper">
                                    <h2><i class="fas fa-layer-group text-success"></i> Kategori Unggulan</h2>
                                    <a href="/shop" class="view-all-link d-none d-md-flex">Jelajahi <i class="fas fa-arrow-right"></i></a>
                                </div>

                                <div class="category-grid">
                                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $index => $category)
                                                                @php
        $iconColors = ['#EF4444', '#10B981', '#F59E0B', '#3B82F6', '#EC4899', '#8B5CF6'];
        $icons = ['bi-brush', 'bi-droplet', 'bi-heart', 'bi-bag-heart', 'bi-stars', 'bi-flower3'];
        $iconColor = $iconColors[$index % 6];
        $iconClass = $icons[$index % 6];
                                                                @endphp
                                                                <div class="cat-card-premium" onclick="window.location.href='/belanja-{{ $category->name }}'">
                                                                    <div class="cat-icon-wrapper" style="color: {{ $iconColor }};">
                                                                        <i class="bi {{ $iconClass }}"></i>
                                                                    </div>
                                                                    <h3 class="cat-name">{{ $category->name }}</h3>
                                                                </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @if (count($data['articles']) > 0)
                            <section class="section-padding pt-0">
                                <div class="container-fluid p-0">
                                    <div class="section-title-wrapper">
                                        <h2><i class="fas fa-book-open text-info"></i> Jurnal Glamoire</h2>
                                        <a href="/newsletter" class="view-all-link d-none d-md-flex">Baca Semua <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-12 col-lg-7">
                                            <div class="article-highlight"
                                                onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}"
                                                    alt="{{ $data['articles'][0]->title }}">
                                                <div class="article-overlay">
                                                    <span class="badge bg-light text-dark mb-3 w-auto align-self-start"
                                                        style="font-family: 'Poppins', sans-serif;">{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty' }}</span>
                                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                                    <p><i
                                                            class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($data['articles'][0]->created_at)->format('d F Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-5">
                                            <div class="d-flex flex-column gap-3 h-100 justify-content-between">
                                                @foreach ($data['articles']->skip(1)->take(3) as $article)
                                                    <div class="article-list-item" onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
                                                        <div class="article-list-img">
                                                            <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}"
                                                                alt="{{ $article->title }}">
                                                        </div>
                                                        <div class="article-list-content">
                                                            <span
                                                                class="badge bg-success bg-opacity-10 text-success mb-2 border-0">{{ optional($article->categoryArticle)->name ?? 'Tips' }}</span>
                                                            <h4>{{ $article->title }}</h4>
                                                            <div class="meta"><i class="far fa-calendar-alt me-1"></i>
                                                                {{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif

                        <section class="section-padding pt-0">
                            <div class="container-fluid p-0">
                                <div class="newsletter-premium shadow-lg">
                                    <h2 class="nl-title">Jadilah yang Pertama Tahu</h2>
                                    <p class="nl-desc">Daftarkan email Anda untuk menerima informasi eksklusif tentang produk baru, promo
                                        rahasia, dan tips kecantikan vegan langsung di inbox Anda.</p>

                                    <form id="subscribe-form" class="nl-form">
                                        @csrf
                                        <div class="nl-input-group">
                                            <input type="email" id="subscribe_email" class="nl-input"
                                                placeholder="Masukkan alamat email Anda..." required autocomplete="off">
                                            <button type="submit" id="subscribe-btn" class="nl-btn">Langganan</button>
                                        </div>
                                        <div id="validationEmailSubscribe" class="text-warning mt-2 fw-semibold text-start px-4"
                                            style="display: none; font-size:0.9rem;"></div>
                                    </form>
                                </div>
                            </div>
                        </section>

                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // 1. Hero Swiper
                            new Swiper('.hero-swiper', {
                                slidesPerView: 1, loop: true, effect: 'fade', fadeEffect: { crossFade: true },
                                autoplay: { delay: 6000, disableOnInteraction: false },
                                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
                                navigation: { nextEl: '.hero-swiper .swiper-button-next', prevEl: '.hero-swiper .swiper-button-prev' },
                            });

                            // 2. Top Selling Swiper
                            new Swiper(".top-selling-slider", {
                                slidesPerView: 1.5, spaceBetween: 15,
                                navigation: { nextEl: ".top-selling-slider .swiper-button-next", prevEl: ".top-selling-slider .swiper-button-prev" },
                                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3, spaceBetween: 24 }, 1200: { slidesPerView: 4, spaceBetween: 24 } }
                            });

                            // 3. Flash Sale Swiper
                            new Swiper(".flash-sale-slider", {
                                slidesPerView: 2, spaceBetween: 16,
                                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                                breakpoints: { 576: { slidesPerView: 2.5 }, 768: { slidesPerView: 3 }, 992: { slidesPerView: 4 }, 1200: { slidesPerView: 4.5 } }
                            });

                            // 4. Promo Special Swiper
                            new Swiper(".promo-special-slider", {
                                slidesPerView: 1.2, spaceBetween: 16,
                                navigation: { nextEl: ".promo-special-slider .swiper-button-next", prevEl: ".promo-special-slider .swiper-button-prev" },
                                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 } }
                            });

                            // 5. Brand Slider
                            new Swiper(".brand-slider", {
                                slidesPerView: 2, spaceBetween: 15,
                                navigation: { nextEl: ".brand-slider .swiper-button-next", prevEl: ".brand-slider .swiper-button-prev" },
                                breakpoints: { 576: { slidesPerView: 3 }, 768: { slidesPerView: 4 }, 992: { slidesPerView: 4.5 }, 1200: { slidesPerView: 5 } }
                            });

                            // 6. Curated Slider
                            new Swiper(".curated-slider", {
                                slidesPerView: 2, spaceBetween: 16,
                                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
                                breakpoints: { 576: { slidesPerView: 3 }, 768: { slidesPerView: 4 }, 992: { slidesPerView: 5 }, 1200: { slidesPerView: 6 } }
                            });

                            // Auto Show First User Modal
                            @if (!session('id_user') && $data['popups']->isNotEmpty())
                                var myModal = new bootstrap.Modal(document.getElementById('firstUser'));
                                myModal.show();
                            @endif

                                // Auto Show Promo Modal (Logged In)
                                @if (session('id_user') && $data['promoModal'] !== null)
                                    var promoModal = new bootstrap.Modal(document.getElementById('promoModal'));
                                    promoModal.show();
                                @endif
                            });

                        // AJAX Subscribe Handling
                        $(document).ready(function () {
                            $('#subscribe_email').on('keyup', function () {
                                var email = $(this).val();
                                if (email) {
                                    $.ajax({
                                        url: "{{ route('check.email.subscribe') }}",
                                        method: "POST",
                                        data: { "_token": "{{ csrf_token() }}", email: email },
                                        success: function (response) {
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

                            $("#subscribe-form").on("submit", function (e) {
                                e.preventDefault();
                                let email = $("#subscribe_email").val();
                                let btn = $('#subscribe-btn');

                                btn.html('<i class="fas fa-spinner fa-spin"></i> Proses...');
                                btn.prop('disabled', true);

                                $.ajax({
                                    url: "{{ route('subscribe') }}",
                                    type: "POST",
                                    data: { _token: "{{ csrf_token() }}", email: email },
                                    success: function (response) {
                                        btn.html('Langganan').prop('disabled', false);
                                        if (response.success) {
                                            Swal.fire({ icon: "success", title: "Berhasil!", text: response.message, confirmButtonColor: "#183018" });
                                            $("#subscribe_email").val('');
                                        } else {
                                            Swal.fire({ icon: "error", title: "Oops!", text: response.message });
                                        }
                                    },
                                    error: function () {
                                        btn.html('Langganan').prop('disabled', false);
                                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan sistem, coba lagi nanti." });
                                    }
                                });
                            });
                        });
                    </script>

@endsection

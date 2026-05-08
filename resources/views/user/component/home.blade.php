{{-- @extends('user.layouts.master')

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

@endsection --}}

{{-- @extends('user.layouts.master')

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

        h1, h2, h3, h4, h5, h6 {
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

        /* --- SCROLL REVEAL ANIMATION CLASSES --- */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.8s ease-out, transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity, visibility;
        }

        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
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

        /* --- Hero Carousel PERBAIKAN --- */
        .hero-carousel-wrapper {
            width: 100%;
            background: var(--glamoire-sand);
        }

        /* Menghapus aspect-ratio agar gambar bisa mekar sempurna */
        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--glamoire-sand);
        }

        .hero-swiper img,
        .hero-swiper video {
            width: 100%;
            height: auto; /* Membiarkan gambar menentukan tinggi aslinya */
            max-height: 85vh; /* Batas aman agar tidak terlalu tinggi di monitor besar */
            object-fit: contain; /* Memastikan tidak ada bagian yang terpotong */
            transition: transform 8s ease;
            transform: scale(1.02);
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

        /* --- Banner Promo Grid --- */
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

    <div class="trust-section reveal-on-scroll">
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

        <section class="section-padding reveal-on-scroll">
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
            <section class="section-padding pt-0 reveal-on-scroll">
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="section-padding pt-0 reveal-on-scroll">
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
            <section class="section-padding pt-0 reveal-on-scroll">
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

        <section class="section-padding pt-0 reveal-on-scroll">
            <div class="container-fluid p-0">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="split-title">Brand Pilihan</h2>
                        <p class="split-desc">Temukan koleksi eksklusif dari merek kecantikan ternama yang telah dikurasi
                            khusus untuk Anda.</p>
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

        <section class="section-padding pt-0 reveal-on-scroll">
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

        <section class="section-padding pt-0 reveal-on-scroll">
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
            <section class="section-padding pt-0 reveal-on-scroll">
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

        <section class="section-padding pt-0 reveal-on-scroll">
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
        // LOGIKA SCROLL REVEAL ANIMATION
        document.addEventListener("DOMContentLoaded", function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 // Animasi berjalan saat 15% elemen terlihat di layar
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target); // Hanya dijalankan sekali
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });

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

@endsection --}}

{{-- @extends('user.layouts.master')

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
            --success-main: #10B981;
            --transition-smooth: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'The Seasons', serif;
        }

        /* --- Global Utilities --- */
        .section-padding {
            padding: 5rem 0;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: 3rem 0;
            }
        }

        /* --- SCROLL REVEAL ANIMATION (Staggered Waterfall) --- */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px) scale(0.98);
            transition: opacity 0.8s ease-out, transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity, transform, visibility;
        }

        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Delay classes for staggered loading */
        .delay-100 { transition-delay: 0.1s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }
        .delay-400 { transition-delay: 0.4s; }

        /* --- Custom Split Layout --- */
        .split-section-wrapper {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 2rem;
            width: 100%;
        }

        .split-section-left {
            flex: 0 0 25%;
            max-width: 320px;
            min-width: 250px;
            position: sticky;
            top: 120px;
        }

        .split-section-right {
            flex: 1;
            min-width: 0;
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
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }

        /* Fluid Typography using Clamp */
        .split-title {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            line-height: 1.1;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .split-desc {
            font-size: clamp(0.9rem, 1.5vw, 1rem);
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .split-link {
            color: var(--glamoire-dark);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .split-link:hover {
            color: var(--glamoire-gold);
            gap: 1rem;
        }

        /* --- Full Width Header --- */
        .full-section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .full-section-header h2 {
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 0.5rem;
        }

        .full-section-header p {
            font-size: clamp(0.95rem, 1.5vw, 1.1rem);
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            width: 48px !important;
            height: 48px !important;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #FFF;
            transform: scale(1.15);
            color: var(--glamoire-gold) !important;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.2rem !important;
            font-weight: 900;
        }

        @media (max-width: 768px) {
            .swiper-button-next,
            .swiper-button-prev {
                display: none !important;
            }
        }

        /* --- Hero Carousel PERBAIKAN --- */
        .hero-carousel-wrapper {
            width: 100%;
            background: var(--glamoire-sand);
            position: relative;
        }

        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--glamoire-sand);
        }

        .hero-swiper img,
        .hero-swiper video {
            width: 100%;
            height: auto;
            max-height: 85vh;
            object-fit: contain;
            transition: transform 10s ease;
            transform: scale(1.02);
        }

        .hero-swiper .swiper-slide-active img {
            transform: scale(1);
        }

        .hero-swiper .swiper-pagination-bullet {
            background: #9CA3AF;
            opacity: 0.6;
            width: 10px;
            height: 10px;
            transition: var(--transition-bounce);
        }

        .hero-swiper .swiper-pagination-bullet-active {
            background: var(--glamoire-dark) !important;
            opacity: 1;
            width: 25px;
            border-radius: 10px;
        }

        /* --- Trust Badges --- */
        .trust-section {
            background: #FFF;
            border-bottom: 1px solid #F3F4F6;
            padding: 2rem 0;
        }

        .trust-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
            transition: var(--transition-smooth);
        }

        .trust-item:hover {
            transform: translateY(-5px);
        }

        .trust-icon {
            width: 55px;
            height: 55px;
            background: var(--glamoire-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.1);
        }

        .trust-text h4 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
        }

        .trust-text p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* --- Universal Product Card (Highly Responsive) --- */
        .premium-product-card {
            background: #FFF;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
            transition: var(--transition-bounce);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .premium-product-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-8px);
            border-color: rgba(0,0,0,0.08);
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
            transition: transform 0.8s ease;
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
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 800;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9CA3AF;
            z-index: 2;
            cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .btn-wishlist:hover,
        .btn-wishlist.active {
            color: var(--danger-main);
            transform: scale(1.15);
        }

        .card-action-area {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 20%, transparent);
            transform: translateY(100%);
            opacity: 0;
            transition: var(--transition-smooth);
            z-index: 3;
        }

        @media (min-width: 992px) {
            .premium-product-card:hover .card-action-area {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Always show action area on mobile for better UX */
        @media (max-width: 991px) {
            .card-action-area {
                position: static;
                transform: none;
                opacity: 1;
                background: transparent;
                padding: 0 1rem 1rem 1rem;
                margin-top: auto; /* Push to bottom */
            }
        }

        .btn-action-main {
            width: 100%;
            padding: 0.7rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition-bounce);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-add {
            background: var(--glamoire-dark);
            color: #FFF;
        }

        .btn-add:hover {
            background: var(--glamoire-accent);
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.3);
        }

        .btn-added {
            background: var(--success-main);
            color: #FFF;
        }

        .btn-notify {
            background: var(--danger-main);
            color: #FFF;
        }

        .card-info {
            padding: 1.25rem 1rem;
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
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.2s;
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
            font-weight: 500;
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
            font-size: 1.15rem;
            font-weight: 800;
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
            font-weight: 500;
        }

        /* Mobile specific card tweaks */
        @media (max-width: 576px) {
            .card-info { padding: 1rem 0.8rem; }
            .product-name { font-size: 0.85rem; }
            .price-current { font-size: 1rem; }
            .btn-action-main { padding: 0.6rem; font-size: 0.75rem; }
        }

        /* --- Banner Promo Grid --- */
        .promo-grid-banner {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: var(--transition-bounce);
            cursor: pointer;
            background: #000;
        }

        .promo-grid-banner:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .promo-grid-banner img,
        .promo-grid-banner video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
            transition: transform 0.8s ease;
        }

        .promo-grid-banner:hover img,
        .promo-grid-banner:hover video {
            opacity: 1;
            transform: scale(1.05);
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
            font-size: clamp(2rem, 4vw, 2.5rem);
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .timer-val {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            font-family: monospace;
        }

        .timer-lbl {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-top: 2px;
        }

        @media (max-width: 991px) {
            .flash-sale-wrapper { padding: 2rem 1.5rem; }
            .flash-header { text-align: center; display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem;}
        }

        /* --- Promo Cards (Events) --- */
        .promo-event-card {
            background: #FFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #F3F4F6;
            transition: var(--transition-bounce);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .promo-event-card:hover {
            transform: translateY(-8px);
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
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .promo-event-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.8rem;
            line-height: 1.3;
            font-family: 'Poppins', sans-serif;
        }

        .promo-event-date {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        /* --- Brand Directory --- */
        .brand-card {
            background: #FFF;
            border-radius: 16px;
            border: 1px solid #F3F4F6;
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition-bounce);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .brand-card:hover {
            background: var(--glamoire-dark);
            border-color: var(--glamoire-dark);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .brand-logo-box {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            background: #FFF;
            border-radius: 50%;
            padding: 12px;
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

        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }

        .cat-card-premium {
            background: #FFF;
            border-radius: 16px;
            padding: 2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-bounce);
            border: 1px solid #F3F4F6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .cat-card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border-color: var(--glamoire-gold);
        }

        .cat-icon-wrapper {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: var(--glamoire-sand);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: var(--transition-smooth);
            font-size: 1.8rem;
        }

        .cat-card-premium:hover .cat-icon-wrapper {
            background: var(--glamoire-dark);
            color: #FFF !important;
            transform: scale(1.1);
        }

        .cat-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Article Section --- */
        .article-highlight {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            height: 450px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
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
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2.5rem;
        }

        .article-overlay h3 {
            color: #FFF;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .article-overlay p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .article-list-item {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            cursor: pointer;
            padding: 1rem;
            border-radius: 16px;
            transition: var(--transition-bounce);
            border: 1px solid transparent;
            background: #FFF;
        }

        .article-list-item:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border-color: #F3F4F6;
            transform: translateX(5px);
        }

        .article-list-img {
            width: 130px;
            height: 130px;
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
            font-weight: 700;
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
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
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
            box-shadow: 0 20px 40px rgba(24,48,24,0.2);
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
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
        }

        .nl-desc {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.6;
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
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
            padding: 0 2.5rem;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition-bounce);
            cursor: pointer;
            white-space: nowrap;
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
                gap: 12px;
                padding: 0;
            }
            .nl-input {
                background: #FFF;
                border-radius: 50px;
                padding: 1.2rem;
                text-align: center;
            }
            .nl-btn {
                padding: 1.2rem;
                width: 100%;
            }
        }
    </style>

    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.3);">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto" style="object-fit: cover; max-height: 400px;">
                        @endif
                        <div class="p-5 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="fw-bold mb-3" style="font-family: 'The Seasons', serif; color: var(--glamoire-gold);">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-4 opacity-85" style="font-size: 0.95rem; line-height: 1.6;">
                                {{ $data['popups'][0]->description ?? 'Dapatkan promo spesial untuk pendaftaran pertama Anda.' }}
                            </p>
                            <a href="/login" class="btn btn-light rounded-pill px-5 py-3 fw-bold w-100" style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Daftar Sekarang</a>
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
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="img-fluid rounded-4 shadow-lg cursor-pointer" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
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
            <div class="swiper-pagination mb-2"></div>
        </div>
    </div>

    <div class="trust-section reveal-on-scroll">
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
                    <div class="split-section-left reveal-on-scroll delay-100">
                        <h2 class="split-title"><img src="{{ asset('images/bundling.png') }}"
                                style="width: 45px; height: 45px; object-fit:contain;"> Produk Terlaris</h2>
                        <p class="split-desc">Produk favorit yang paling diminati pelanggan Glamoire. Sempurnakan rutinitas
                            kecantikan Anda hari ini.</p>
                        <a href="/shop" class="split-link">Belanja Sekarang <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right reveal-on-scroll delay-200">
                        <div class="swiper top-selling-slider product-slider" style="padding-bottom: 2rem; padding-top: 1rem;">
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
                                                    <span class="card-badge badge-gift"><i class="fas fa-gift me-1"></i> Free Gift</span>
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
                        @foreach ($data['popupsBanner'] as $index => $popup)
                            <div class="col-12 col-md-6 reveal-on-scroll {{ $index % 2 == 0 ? 'delay-100' : 'delay-200' }}">
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
        @endif

        <section class="section-padding pt-0 reveal-on-scroll">
            <div class="container-fluid p-0">
                <div class="flash-sale-wrapper">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-3 mb-4 mb-xl-0 flash-header reveal-on-scroll delay-100">
                            <h2 class="flash-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
                            <p class="mb-0" style="font-size: 1.1rem;">Penawaran super kilat. Jangan sampai terlewatkan!</p>
                            <div class="timer-flex">
                                <div class="timer-block">
                                    <div class="timer-val">08</div>
                                    <div class="timer-lbl">Jam</div>
                                </div>
                                <span class="timer-sep fs-3 fw-bold">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">45</div>
                                    <div class="timer-lbl">Mnt</div>
                                </div>
                                <span class="timer-sep fs-3 fw-bold">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">12</div>
                                    <div class="timer-lbl">Dtk</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-9 reveal-on-scroll delay-300">
                            <div class="swiper flash-sale-slider product-slider pb-0" style="padding-top: 1rem; padding-bottom: 1rem;">
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
                                                    <span class="card-badge bg-warning text-dark"><i class="fas fa-bolt me-1"></i>
                                                        {{ $discountPercent }}%</span>
                                                    <img src="{{ Storage::url($product->main_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                    <div class="position-absolute bottom-0 start-0 w-100 px-3 pb-3 z-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="text-danger fw-bold shadow-sm"
                                                                style="font-size: 0.7rem; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px;">Sisa Sedikit!</span>
                                                        </div>
                                                        <div class="progress" style="height: 8px; background: rgba(0,0,0,0.2); border-radius: 4px;">
                                                            <div class="progress-bar bg-danger" style="width: 85%; border-radius: 4px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-info text-center py-3">
                                                    <div class="price-box mt-0">
                                                        <span class="price-strike mx-auto">Rp
                                                            {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        <span class="price-current price-discounted">Rp
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
                    <div class="full-section-header reveal-on-scroll">
                        <h2>Promo Spesial Untuk Kamu</h2>
                        <p>Dapatkan voucher dan penawaran menarik untuk melengkapi gaya hidupmu!</p>
                    </div>

                    <div class="swiper promo-special-slider product-slider reveal-on-scroll delay-200" style="padding-top: 1rem; padding-bottom: 2rem;">
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
                                                style="width: auto; padding: 0.6rem 2rem; border-radius: 50px;">Lihat Detail</span>
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
                    <div class="split-section-left reveal-on-scroll delay-100">
                        <h2 class="split-title">Brand Pilihan</h2>
                        <p class="split-desc">Temukan koleksi eksklusif dari merek kecantikan ternama yang telah dikurasi
                            khusus untuk Anda.</p>
                    </div>
                    <div class="split-section-right reveal-on-scroll delay-300">
                        <div class="swiper brand-slider product-slider" style="padding-top: 1rem; padding-bottom: 2rem;">
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
                <div class="full-section-header reveal-on-scroll">
                    <h2>Cocok Untuk Kamu</h2>
                    <p>Rekomendasi personal berdasarkan preferensi dan gaya kecantikanmu.</p>
                </div>

                <div class="swiper curated-slider product-slider reveal-on-scroll delay-200" style="padding-top: 1rem; padding-bottom: 2rem;">
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
                                            <span class="card-badge badge-gift"><i class="fas fa-gift me-1"></i> Free Gift</span>
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

        <section class="section-padding pt-0 reveal-on-scroll">
            <div class="container-fluid p-0">
                <div class="full-section-header mb-4">
                    <h2 class="d-flex align-items-center justify-content-center gap-3"><i class="fas fa-layer-group text-success"></i> Kategori Unggulan</h2>
                    <a href="/shop" class="split-link mx-auto mt-2">Jelajahi <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $index => $category)
                        @php
                            $iconColors = ['#EF4444', '#10B981', '#F59E0B', '#3B82F6', '#EC4899', '#8B5CF6'];
                            $icons = ['bi-brush', 'bi-droplet', 'bi-heart', 'bi-bag-heart', 'bi-stars', 'bi-flower3'];
                            $iconColor = $iconColors[$index % 6];
                            $iconClass = $icons[$index % 6];
                        @endphp
                        <div class="cat-card-premium reveal-on-scroll delay-{{ ($index % 3 + 1) * 100 }}" onclick="window.location.href='/belanja-{{ $category->name }}'">
                            <div class="cat-icon-wrapper" style="color: {{ $iconColor }}; box-shadow: 0 4px 15px {{ $iconColor }}20;">
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
                    <div class="full-section-header reveal-on-scroll">
                        <h2><i class="fas fa-book-open text-info me-2"></i> Jurnal Glamoire</h2>
                        <a href="/newsletter" class="split-link mx-auto mt-2">Baca Semua <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-7 reveal-on-scroll delay-100">
                            <div class="article-highlight"
                                onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}"
                                    alt="{{ $data['articles'][0]->title }}">
                                <div class="article-overlay">
                                    <span class="badge bg-light text-dark mb-3 w-auto align-self-start px-3 py-2"
                                        style="font-family: 'Poppins', sans-serif; font-weight: 700; letter-spacing: 0.5px;">{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty' }}</span>
                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                    <p><i class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($data['articles'][0]->created_at)->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5 reveal-on-scroll delay-300">
                            <div class="d-flex flex-column gap-3 h-100 justify-content-between">
                                @foreach ($data['articles']->skip(1)->take(3) as $article)
                                    <div class="article-list-item" onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
                                        <div class="article-list-img">
                                            <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}"
                                                alt="{{ $article->title }}">
                                        </div>
                                        <div class="article-list-content">
                                            <span class="badge bg-success bg-opacity-10 text-success mb-2 border-0 px-2 py-1">{{ optional($article->categoryArticle)->name ?? 'Tips' }}</span>
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

        <section class="section-padding pt-0 reveal-on-scroll">
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
        // LOGIKA SCROLL REVEAL ANIMATION
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
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3.5, spaceBetween: 24 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            // 3. Flash Sale Swiper
            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5, spaceBetween: 15,
                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3.5, spaceBetween: 20 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            // 4. Promo Special Swiper
            new Swiper(".promo-special-slider", {
                slidesPerView: 1.2, spaceBetween: 16,
                navigation: { nextEl: ".promo-special-slider .swiper-button-next", prevEl: ".promo-special-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 } }
            });

            // 5. Brand Slider
            new Swiper(".brand-slider", {
                slidesPerView: 2.2, spaceBetween: 15,
                navigation: { nextEl: ".brand-slider .swiper-button-next", prevEl: ".brand-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 3.2 }, 768: { slidesPerView: 4.5 }, 992: { slidesPerView: 5.5 }, 1200: { slidesPerView: 6.5 } }
            });

            // 6. Curated Slider
            new Swiper(".curated-slider", {
                slidesPerView: 1.5, spaceBetween: 15,
                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 3.2, spaceBetween: 20 }, 992: { slidesPerView: 4.5, spaceBetween: 24 }, 1200: { slidesPerView: 5.5, spaceBetween: 24 } }
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

@endsection --}}

{{-- @extends('user.layouts.master')

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
            --success-main: #10B981;
            --transition-smooth: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'The Seasons', serif;
        }

        /* --- Global Utilities --- */
        .section-padding {
            padding: 5rem 0;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: 3rem 0;
            }
        }

        /* --- Custom Split Layout --- */
        .split-section-wrapper {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 2rem;
            width: 100%;
        }

        .split-section-left {
            flex: 0 0 25%;
            max-width: 320px;
            min-width: 250px;
            position: sticky;
            top: 120px;
        }

        .split-section-right {
            flex: 1;
            min-width: 0;
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
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }

        /* Fluid Typography using Clamp */
        .split-title {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            line-height: 1.1;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .split-desc {
            font-size: clamp(0.9rem, 1.5vw, 1rem);
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .split-link {
            color: var(--glamoire-dark);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .split-link:hover {
            color: var(--glamoire-gold);
            gap: 1rem;
        }

        /* --- Full Width Header --- */
        .full-section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .full-section-header h2 {
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 0.5rem;
        }

        .full-section-header p {
            font-size: clamp(0.95rem, 1.5vw, 1.1rem);
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            width: 48px !important;
            height: 48px !important;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #FFF;
            transform: scale(1.15);
            color: var(--glamoire-gold) !important;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.2rem !important;
            font-weight: 900;
        }

        @media (max-width: 768px) {
            .swiper-button-next,
            .swiper-button-prev {
                display: none !important;
            }
        }

        /* --- Hero Carousel PERBAIKAN --- */
        .hero-carousel-wrapper {
            width: 100%;
            background: var(--glamoire-sand);
            position: relative;
        }

        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--glamoire-sand);
        }

        .hero-swiper img,
        .hero-swiper video {
            width: 100%;
            height: auto;
            max-height: 85vh;
            object-fit: contain;
            transition: transform 10s ease;
            transform: scale(1.02);
        }

        .hero-swiper .swiper-slide-active img {
            transform: scale(1);
        }

        .hero-swiper .swiper-pagination-bullet {
            background: #9CA3AF;
            opacity: 0.6;
            width: 10px;
            height: 10px;
            transition: var(--transition-bounce);
        }

        .hero-swiper .swiper-pagination-bullet-active {
            background: var(--glamoire-dark) !important;
            opacity: 1;
            width: 25px;
            border-radius: 10px;
        }

        /* --- Trust Badges --- */
        .trust-section {
            background: #FFF;
            border-bottom: 1px solid #F3F4F6;
            padding: 2rem 0;
        }

        .trust-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
            transition: var(--transition-smooth);
        }

        .trust-item:hover {
            transform: translateY(-5px);
        }

        .trust-icon {
            width: 55px;
            height: 55px;
            background: var(--glamoire-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.1);
        }

        .trust-text h4 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
        }

        .trust-text p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* --- Universal Product Card (Highly Responsive) --- */
        .premium-product-card {
            background: #FFF;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
            transition: var(--transition-bounce);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .premium-product-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-8px);
            border-color: rgba(0,0,0,0.08);
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
            transition: transform 0.8s ease;
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
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 800;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9CA3AF;
            z-index: 2;
            cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .btn-wishlist:hover,
        .btn-wishlist.active {
            color: var(--danger-main);
            transform: scale(1.15);
        }

        .card-action-area {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 20%, transparent);
            transform: translateY(100%);
            opacity: 0;
            transition: var(--transition-smooth);
            z-index: 3;
        }

        @media (min-width: 992px) {
            .premium-product-card:hover .card-action-area {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Always show action area on mobile for better UX */
        @media (max-width: 991px) {
            .card-action-area {
                position: static;
                transform: none;
                opacity: 1;
                background: transparent;
                padding: 0 1rem 1rem 1rem;
                margin-top: auto; /* Push to bottom */
            }
        }

        .btn-action-main {
            width: 100%;
            padding: 0.7rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition-bounce);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-add {
            background: var(--glamoire-dark);
            color: #FFF;
        }

        .btn-add:hover {
            background: var(--glamoire-accent);
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.3);
        }

        .btn-added {
            background: var(--success-main);
            color: #FFF;
        }

        .btn-notify {
            background: var(--danger-main);
            color: #FFF;
        }

        .card-info {
            padding: 1.25rem 1rem;
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
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.2s;
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
            font-weight: 500;
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
            font-size: 1.15rem;
            font-weight: 800;
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
            font-weight: 500;
        }

        /* Mobile specific card tweaks */
        @media (max-width: 576px) {
            .card-info { padding: 1rem 0.8rem; }
            .product-name { font-size: 0.85rem; }
            .price-current { font-size: 1rem; }
            .btn-action-main { padding: 0.6rem; font-size: 0.75rem; }
        }

        /* --- Banner Promo Grid --- */
        .promo-grid-banner {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: var(--transition-bounce);
            cursor: pointer;
            background: #000;
        }

        .promo-grid-banner:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .promo-grid-banner img,
        .promo-grid-banner video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
            transition: transform 0.8s ease;
        }

        .promo-grid-banner:hover img,
        .promo-grid-banner:hover video {
            opacity: 1;
            transform: scale(1.05);
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
            font-size: clamp(2rem, 4vw, 2.5rem);
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .timer-val {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            font-family: monospace;
        }

        .timer-lbl {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-top: 2px;
        }

        @media (max-width: 991px) {
            .flash-sale-wrapper { padding: 2rem 1.5rem; }
            .flash-header { text-align: center; display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem;}
        }

        /* --- Promo Cards (Events) --- */
        .promo-event-card {
            background: #FFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #F3F4F6;
            transition: var(--transition-bounce);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .promo-event-card:hover {
            transform: translateY(-8px);
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
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .promo-event-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.8rem;
            line-height: 1.3;
            font-family: 'Poppins', sans-serif;
        }

        .promo-event-date {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        /* --- Brand Directory --- */
        .brand-card {
            background: #FFF;
            border-radius: 16px;
            border: 1px solid #F3F4F6;
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition-bounce);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .brand-card:hover {
            background: var(--glamoire-dark);
            border-color: var(--glamoire-dark);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .brand-logo-box {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            background: #FFF;
            border-radius: 50%;
            padding: 12px;
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

        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }

        .cat-card-premium {
            background: #FFF;
            border-radius: 16px;
            padding: 2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-bounce);
            border: 1px solid #F3F4F6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .cat-card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border-color: var(--glamoire-gold);
        }

        .cat-icon-wrapper {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: var(--glamoire-sand);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: var(--transition-smooth);
            font-size: 1.8rem;
        }

        .cat-card-premium:hover .cat-icon-wrapper {
            background: var(--glamoire-dark);
            color: #FFF !important;
            transform: scale(1.1);
        }

        .cat-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Article Section --- */
        .article-highlight {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            height: 450px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
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
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2.5rem;
        }

        .article-overlay h3 {
            color: #FFF;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .article-overlay p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .article-list-item {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            cursor: pointer;
            padding: 1rem;
            border-radius: 16px;
            transition: var(--transition-bounce);
            border: 1px solid transparent;
            background: #FFF;
        }

        .article-list-item:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border-color: #F3F4F6;
            transform: translateX(5px);
        }

        .article-list-img {
            width: 130px;
            height: 130px;
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
            font-weight: 700;
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
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
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
            box-shadow: 0 20px 40px rgba(24,48,24,0.2);
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
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
        }

        .nl-desc {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.6;
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
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
            padding: 0 2.5rem;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition-bounce);
            cursor: pointer;
            white-space: nowrap;
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
                gap: 12px;
                padding: 0;
            }
            .nl-input {
                background: #FFF;
                border-radius: 50px;
                padding: 1.2rem;
                text-align: center;
            }
            .nl-btn {
                padding: 1.2rem;
                width: 100%;
            }
        }
    </style>

    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.3);">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto" style="object-fit: cover; max-height: 400px;">
                        @endif
                        <div class="p-5 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="fw-bold mb-3" style="font-family: 'The Seasons', serif; color: var(--glamoire-gold);">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-4 opacity-85" style="font-size: 0.95rem; line-height: 1.6;">
                                {{ $data['popups'][0]->description ?? 'Dapatkan promo spesial untuk pendaftaran pertama Anda.' }}
                            </p>
                            <a href="/login" class="btn btn-light rounded-pill px-5 py-3 fw-bold w-100" style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Daftar Sekarang</a>
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
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="img-fluid rounded-4 shadow-lg cursor-pointer" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
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
            <div class="swiper-pagination mb-2"></div>
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
                                style="width: 45px; height: 45px; object-fit:contain;"> Produk Terlaris</h2>
                        <p class="split-desc">Produk favorit yang paling diminati pelanggan Glamoire. Sempurnakan rutinitas
                            kecantikan Anda hari ini.</p>
                        <a href="/shop" class="split-link">Belanja Sekarang <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right">
                        <div class="swiper top-selling-slider product-slider" style="padding-bottom: 2rem; padding-top: 1rem;">
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
                                                    <span class="card-badge badge-gift"><i class="fas fa-gift me-1"></i> Free Gift</span>
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
                                <span class="timer-sep fs-3 fw-bold">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">45</div>
                                    <div class="timer-lbl">Mnt</div>
                                </div>
                                <span class="timer-sep fs-3 fw-bold">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">12</div>
                                    <div class="timer-lbl">Dtk</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-9">
                            <div class="swiper flash-sale-slider product-slider pb-0" style="padding-top: 1rem; padding-bottom: 1rem;">
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
                                                    <span class="card-badge bg-warning text-dark"><i class="fas fa-bolt me-1"></i>
                                                        {{ $discountPercent }}%</span>
                                                    <img src="{{ Storage::url($product->main_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                    <div class="position-absolute bottom-0 start-0 w-100 px-3 pb-3 z-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="text-danger fw-bold shadow-sm"
                                                                style="font-size: 0.7rem; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px;">Sisa Sedikit!</span>
                                                        </div>
                                                        <div class="progress" style="height: 8px; background: rgba(0,0,0,0.2); border-radius: 4px;">
                                                            <div class="progress-bar bg-danger" style="width: 85%; border-radius: 4px;"></div>
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

                    <div class="swiper promo-special-slider product-slider" style="padding-top: 1rem; padding-bottom: 2rem;">
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
                                                style="width: auto; padding: 0.6rem 2rem; border-radius: 50px;">Lihat Detail</span>
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
                    </div>
                    <div class="split-section-right">
                        <div class="swiper brand-slider product-slider" style="padding-top: 1rem; padding-bottom: 2rem;">
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

                <div class="swiper curated-slider product-slider" style="padding-top: 1rem; padding-bottom: 2rem;">
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
                                            <span class="card-badge badge-gift"><i class="fas fa-gift me-1"></i> Free Gift</span>
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
                <div class="full-section-header mb-4">
                    <h2 class="d-flex align-items-center justify-content-center gap-3"><i class="fas fa-layer-group text-success"></i> Kategori Unggulan</h2>
                    <a href="/shop" class="split-link mx-auto mt-2">Jelajahi <i class="fas fa-arrow-right"></i></a>
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
                            <div class="cat-icon-wrapper" style="color: {{ $iconColor }}; box-shadow: 0 4px 15px {{ $iconColor }}20;">
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
                    <div class="full-section-header">
                        <h2><i class="fas fa-book-open text-info me-2"></i> Jurnal Glamoire</h2>
                        <a href="/newsletter" class="split-link mx-auto mt-2">Baca Semua <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-7">
                            <div class="article-highlight"
                                onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}"
                                    alt="{{ $data['articles'][0]->title }}">
                                <div class="article-overlay">
                                    <span class="badge bg-light text-dark mb-3 w-auto align-self-start px-3 py-2"
                                        style="font-family: 'Poppins', sans-serif; font-weight: 700; letter-spacing: 0.5px;">{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty' }}</span>
                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                    <p><i class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($data['articles'][0]->created_at)->format('d F Y') }}</p>
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
                                            <span class="badge bg-success bg-opacity-10 text-success mb-2 border-0 px-2 py-1">{{ optional($article->categoryArticle)->name ?? 'Tips' }}</span>
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
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3.5, spaceBetween: 24 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            // 3. Flash Sale Swiper
            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5, spaceBetween: 15,
                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3.5, spaceBetween: 20 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            // 4. Promo Special Swiper
            new Swiper(".promo-special-slider", {
                slidesPerView: 1.2, spaceBetween: 16,
                navigation: { nextEl: ".promo-special-slider .swiper-button-next", prevEl: ".promo-special-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 } }
            });

            // 5. Brand Slider
            new Swiper(".brand-slider", {
                slidesPerView: 2.2, spaceBetween: 15,
                navigation: { nextEl: ".brand-slider .swiper-button-next", prevEl: ".brand-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 3.2 }, 768: { slidesPerView: 4.5 }, 992: { slidesPerView: 5.5 }, 1200: { slidesPerView: 6.5 } }
            });

            // 6. Curated Slider
            new Swiper(".curated-slider", {
                slidesPerView: 1.5, spaceBetween: 15,
                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 3.2, spaceBetween: 20 }, 992: { slidesPerView: 4.5, spaceBetween: 24 }, 1200: { slidesPerView: 5.5, spaceBetween: 24 } }
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

@endsection --}}

{{-- @extends('user.layouts.master')

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
            --success-main: #10B981;
            --transition-smooth: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'The Seasons', serif;
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

        /* --- Custom Split Layout --- */
        .split-section-wrapper {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 3rem;
            width: 100%;
        }

        .split-section-left {
            flex: 0 0 28%;
            max-width: 350px;
            min-width: 280px;
            position: sticky;
            top: 120px;
        }

        .split-section-right {
            flex: 1;
            min-width: 0;
        }

        @media (max-width: 991px) {
            .split-section-wrapper {
                flex-direction: column;
                gap: 2rem;
            }
            .split-section-left {
                flex: 0 0 auto;
                max-width: 100%;
                position: static;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }

        /* Fluid Typography */
        .split-title {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            line-height: 1.1;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .split-desc {
            font-size: clamp(0.95rem, 1.5vw, 1.05rem);
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .split-link {
            color: var(--glamoire-dark);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
        }

        .split-link:hover {
            color: var(--glamoire-gold);
            gap: 1rem;
        }

        /* --- Full Width Header --- */
        .full-section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .full-section-header h2 {
            font-size: clamp(2.4rem, 4vw, 3.2rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1rem;
        }

        .full-section-header p {
            font-size: clamp(0.95rem, 1.5vw, 1.1rem);
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #FFF;
            transform: scale(1.1);
            color: var(--glamoire-gold) !important;
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.2);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.2rem !important;
            font-weight: 900;
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
            position: relative;
        }

        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--glamoire-sand);
        }

        .hero-swiper img,
        .hero-swiper video {
            width: 100%;
            height: auto;
            max-height: 85vh;
            object-fit: contain;
            transition: transform 10s ease;
            transform: scale(1.02);
        }

        .hero-swiper .swiper-slide-active img {
            transform: scale(1);
        }

        .hero-swiper .swiper-pagination-bullet {
            background: #9CA3AF;
            opacity: 0.5;
            width: 8px;
            height: 8px;
            transition: var(--transition-bounce);
        }

        .hero-swiper .swiper-pagination-bullet-active {
            background: var(--glamoire-dark) !important;
            opacity: 1;
            width: 24px;
            border-radius: 10px;
        }

        /* --- Trust Badges --- */
        .trust-section {
            background: #FFF;
            border-bottom: 1px solid #F3F4F6;
            padding: 3rem 0;
        }

        .trust-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            transition: var(--transition-smooth);
        }

        .trust-item:hover {
            transform: translateY(-5px);
        }

        .trust-icon {
            width: 60px;
            height: 60px;
            background: var(--glamoire-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.6rem;
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.12);
        }

        .trust-text h4 {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
        }

        .trust-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* --- Universal Product Card (Highly Responsive) --- */
        .premium-product-card {
            background: #FFF;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        .premium-product-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.3); /* Subtle gold border on hover */
        }

        .card-img-box {
            position: relative;
            padding-top: 110%; /* Slightly taller image for elegance */
            background: var(--glamoire-light);
            overflow: hidden;
            cursor: pointer;
            border-bottom: 1px solid rgba(0,0,0,0.02);
        }

        .card-img-box img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .premium-product-card:hover .card-img-box img {
            transform: scale(1.08);
        }

        .card-img-box.dark-overlay img {
            filter: grayscale(100%) opacity(0.7);
        }

        .card-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 800;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .badge-discount { background: var(--danger-main); color: #FFF; }
        .badge-gift { background: #EC4899; color: #FFF; }

        .btn-wishlist {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9CA3AF;
            z-index: 2;
            cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .btn-wishlist:hover,
        .btn-wishlist.active {
            color: var(--danger-main);
            transform: scale(1.1);
            background: #FFF;
        }

        .card-action-area {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem 1rem 1rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 40%, rgba(255,255,255,0) 100%);
            transform: translateY(100%);
            opacity: 0;
            transition: var(--transition-smooth);
            z-index: 3;
        }

        @media (min-width: 992px) {
            .premium-product-card:hover .card-action-area {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 991px) {
            .card-action-area {
                position: static;
                transform: none;
                opacity: 1;
                background: transparent;
                padding: 0 1rem 1rem 1rem;
                margin-top: auto;
            }
        }

        .btn-action-main {
            width: 100%;
            padding: 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition-smooth);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-add { background: var(--glamoire-dark); color: #FFF; }
        .btn-add:hover { background: var(--glamoire-gold); box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3); color:#FFF;}
        .btn-added { background: var(--success-main); color: #FFF; }
        .btn-notify { background: var(--danger-main); color: #FFF; }

        .card-info {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            cursor: pointer;
            text-align: center; /* Center align for elegance */
        }

        .brand-name {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .product-name {
            font-family: 'The Seasons', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.8rem;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.2s;
        }

        .premium-product-card:hover .product-name {
            color: var(--glamoire-gold);
        }

        .rating-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .rating-box i { color: #F59E0B; }

        .price-box {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .price-current {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--glamoire-dark);
        }

        .price-discounted { color: var(--danger-main); }
        .price-strike {
            font-size: 0.85rem;
            color: #9CA3AF;
            text-decoration: line-through;
            margin-bottom: 2px;
            font-weight: 500;
        }

        /* Mobile specific card tweaks */
        @media (max-width: 576px) {
            .card-info { padding: 1rem; }
            .product-name { font-size: 1rem; }
            .price-current { font-size: 1.1rem; }
            .btn-action-main { padding: 0.7rem; font-size: 0.75rem; }
        }

        /* --- Banner Promo Grid --- */
        .promo-grid-banner {
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: var(--transition-bounce);
            cursor: pointer;
            background: var(--glamoire-light);
        }

        .promo-grid-banner:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .promo-grid-banner img,
        .promo-grid-banner video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.95;
            transition: transform 0.8s ease;
        }

        .promo-grid-banner:hover img,
        .promo-grid-banner:hover video {
            opacity: 1;
            transform: scale(1.05);
        }

        /* --- Flash Sale Section --- */
        .flash-sale-wrapper {
            background: linear-gradient(135deg, var(--glamoire-dark) 0%, #0f1d0f 100%);
            border-radius: 30px;
            padding: 4rem;
            margin: 3rem 0;
            color: #FFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(24, 48, 24, 0.2);
        }

        .flash-sale-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
        }

        .flash-header {
            position: relative;
            z-index: 2;
        }

        .flash-title {
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--glamoire-gold);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'The Seasons', serif;
        }

        .timer-flex {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-top: 2rem;
        }

        .timer-block {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            text-align: center;
            min-width: 75px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .timer-val {
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1;
            font-family: 'Poppins', monospace;
        }

        .timer-lbl {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-top: 4px;
        }

        @media (max-width: 991px) {
            .flash-sale-wrapper { padding: 3rem 1.5rem; border-radius: 20px; }
            .flash-header { text-align: center; display: flex; flex-direction: column; align-items: center; margin-bottom: 3rem;}
        }

        /* --- Promo Cards (Events) --- */
        .promo-event-card {
            background: #FFF;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #F3F4F6;
            transition: var(--transition-bounce);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .promo-event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--glamoire-gold);
        }

        .promo-event-img {
            width: 100%;
            aspect-ratio: 16/10;
            object-fit: cover;
        }

        .promo-event-body {
            padding: 2rem 1.5rem;
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
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 0.8rem;
            background: rgba(212, 175, 55, 0.1);
            padding: 4px 12px;
            border-radius: 50px;
        }

        .promo-event-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
            line-height: 1.4;
            font-family: 'The Seasons', serif;
        }

        .promo-event-date {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        /* --- Brand Directory --- */
        .brand-card {
            background: #FFF;
            border-radius: 20px;
            border: 1px solid #F3F4F6;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: var(--transition-bounce);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .brand-card:hover {
            background: var(--glamoire-dark);
            border-color: var(--glamoire-dark);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(24, 48, 24, 0.15);
        }

        .brand-logo-box {
            width: 85px;
            height: 85px;
            margin-bottom: 1.5rem;
            background: #FFF;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: var(--transition-smooth);
        }

        .brand-card:hover .brand-logo-box {
            transform: scale(1.1);
        }

        .brand-logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-name-txt {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
            font-family: 'Poppins', sans-serif;
            transition: color 0.3s;
        }

        .brand-card:hover .brand-name-txt {
            color: var(--glamoire-gold);
        }

        /* --- Category Section --- */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 2rem;
        }

        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem; } }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px) { .category-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem;} }

        .cat-card-premium {
            background: #FFF;
            border-radius: 24px;
            padding: 2.5rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-bounce);
            border: 1px solid #F3F4F6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .cat-card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: var(--glamoire-gold);
            background: var(--glamoire-light);
        }

        .cat-icon-wrapper {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #FFF;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: var(--transition-smooth);
            font-size: 2rem;
        }

        .cat-card-premium:hover .cat-icon-wrapper {
            background: var(--glamoire-dark);
            color: var(--glamoire-gold) !important;
            transform: scale(1.1) rotate(5deg);
        }

        .cat-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            font-family: 'The Seasons', serif;
        }

        /* --- Article Section --- */
        .article-highlight {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            cursor: pointer;
            height: 500px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .article-highlight img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s ease;
        }

        .article-highlight:hover img {
            transform: scale(1.08);
        }

        .article-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0,0,0,0.2) 50%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
        }

        .article-overlay h3 {
            color: #FFF;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
            font-family: 'The Seasons', serif;
        }

        .article-overlay p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            font-weight: 400;
        }

        .article-list-item {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            cursor: pointer;
            padding: 1.5rem;
            border-radius: 20px;
            transition: var(--transition-bounce);
            border: 1px solid #F3F4F6;
            background: #FFF;
        }

        .article-list-item:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            border-color: var(--glamoire-gold);
            transform: translateX(8px);
        }

        .article-list-img {
            width: 140px;
            height: 140px;
            border-radius: 16px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .article-list-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-list-item:hover .article-list-img img {
            transform: scale(1.1);
        }

        .article-list-content h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.8rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-family: 'The Seasons', serif;
        }

        .article-list-content .meta {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        @media (max-width: 576px) {
            .article-overlay { padding: 1.5rem; }
            .article-list-item { padding: 1rem; flex-direction: column; align-items: flex-start;}
            .article-list-img { width: 100%; height: 200px; }
        }

        /* --- Newsletter VIP Section --- */
        .newsletter-premium {
            background: linear-gradient(135deg, var(--glamoire-dark) 0%, #0f1d0f 100%);
            border-radius: 30px;
            padding: 6rem 2rem;
            text-align: center;
            color: #FFF;
            margin: 4rem 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(24,48,24,0.25);
        }

        .newsletter-premium::before {
            content: '';
            position: absolute;
            left: -10%;
            top: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .nl-title {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
            font-family: 'The Seasons', serif;
            position: relative;
            z-index: 2;
        }

        .nl-desc {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 3rem;
            line-height: 1.7;
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
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .nl-input {
            border: none;
            background: transparent;
            padding: 1rem 1.5rem;
            width: 100%;
            font-size: 1.05rem;
            color: #FFF;
            outline: none;
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
            letter-spacing: 1.5px;
            transition: var(--transition-bounce);
            cursor: pointer;
            white-space: nowrap;
            font-size: 0.9rem;
        }

        .nl-btn:hover {
            background: #FFF;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(255,255,255,0.2);
        }

        @media (max-width: 576px) {
            .newsletter-premium { padding: 4rem 1.5rem; border-radius: 20px;}
            .nl-input-group {
                flex-direction: column;
                background: transparent;
                box-shadow: none;
                gap: 15px;
                padding: 0;
                border: none;
            }
            .nl-input {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255,255,255,0.2);
                border-radius: 50px;
                padding: 1.2rem;
                text-align: center;
            }
            .nl-btn {
                padding: 1.2rem;
                width: 100%;
            }
        }
    </style>

    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 24px; box-shadow: 0 30px 60px rgba(0,0,0,0.4);">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto" style="object-fit: cover; max-height: 450px;">
                        @endif
                        <div class="p-5 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="fw-bold mb-3" style="font-family: 'The Seasons', serif; color: var(--glamoire-gold); font-size: 2.2rem;">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-4 opacity-85" style="font-size: 1rem; line-height: 1.6;">
                                {{ $data['popups'][0]->description ?? 'Dapatkan promo spesial untuk pendaftaran pertama Anda.' }}
                            </p>
                            <a href="/login" class="btn btn-light rounded-pill px-5 py-3 fw-bold w-100" style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1.5px; transition: all 0.3s;" onmouseover="this.style.background='var(--glamoire-gold)'; this.style.color='var(--glamoire-dark)';" onmouseout="this.style.background='white'; this.style.color='black';">Daftar Sekarang</a>
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
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="img-fluid rounded-4 shadow-lg cursor-pointer" style="transition: transform 0.4s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- HERO CAROUSEL -->
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
            <div class="swiper-pagination mb-3"></div>
        </div>
    </div>

    <!-- TRUST BADGES -->
    <div class="trust-section">
        <div class="container md:px-20 lg:px-24 xl:px-24 2xl:px-48">
            <div class="row g-4 justify-content-center">
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

        <!-- PRODUK TERLARIS -->
        <section class="section-padding">
            <div class="container-fluid p-0">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="split-title"><img src="{{ asset('images/bundling.png') }}"
                                style="width: 55px; height: 55px; object-fit:contain;"> Terlaris</h2>
                        <p class="split-desc">Produk favorit yang paling diminati pelanggan Glamoire. Sempurnakan rutinitas
                            kecantikan Anda hari ini dengan koleksi terbaik kami.</p>
                        <a href="/shop" class="split-link">Belanja Sekarang <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right">
                        <div class="swiper top-selling-slider product-slider" style="padding-bottom: 2.5rem; padding-top: 1rem;">
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
                                                    <span class="card-badge badge-gift"><i class="fas fa-gift me-1"></i> Free Gift</span>
                                                @elseif ($discountPercent > 0)
                                                    <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                                                @endif

                                                <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}"
                                                    onclick="event.stopPropagation(); {{ session('id_user') ? ($inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')') : 'var myModal = new bootstrap.Modal(document.getElementById(\'loginUser1\')); myModal.show();' }}">
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
                                                            Login untuk Beli
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
                </div>
            </div>
        </section>

        <!-- PROMO BANNERS GRID -->
        @if(count($data['popupsBanner']) > 0)
            <section class="section-padding pt-0">
                <div class="container-fluid p-0">
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
        @endif

        <!-- FLASH SALE -->
        <section class="section-padding pt-0">
            <div class="container-fluid p-0">
                <div class="flash-sale-wrapper">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-3 mb-4 mb-xl-0 flash-header">
                            <h2 class="flash-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
                            <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">Penawaran super kilat eksklusif. Jangan sampai terlewatkan!</p>
                            <div class="timer-flex">
                                <div class="timer-block">
                                    <div class="timer-val">08</div>
                                    <div class="timer-lbl">Jam</div>
                                </div>
                                <span class="timer-sep fs-3 fw-bold">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">45</div>
                                    <div class="timer-lbl">Mnt</div>
                                </div>
                                <span class="timer-sep fs-3 fw-bold">:</span>
                                <div class="timer-block">
                                    <div class="timer-val">12</div>
                                    <div class="timer-lbl">Dtk</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-9">
                            <div class="swiper flash-sale-slider product-slider pb-0" style="padding-top: 1rem; padding-bottom: 2rem;">
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
                                                    <span class="card-badge bg-warning text-dark"><i class="fas fa-bolt me-1"></i>
                                                        {{ $discountPercent }}%</span>
                                                    <img src="{{ Storage::url($product->main_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                    <div class="position-absolute bottom-0 start-0 w-100 px-3 pb-3 z-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="text-danger fw-bold shadow-sm"
                                                                style="font-size: 0.7rem; background: rgba(255,255,255,0.95); padding: 4px 10px; border-radius: 8px;">Sisa Sedikit!</span>
                                                        </div>
                                                        <div class="progress" style="height: 6px; background: rgba(0,0,0,0.3); border-radius: 4px;">
                                                            <div class="progress-bar bg-danger" style="width: 85%; border-radius: 4px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-info text-center py-4">
                                                    <div class="price-box mt-0">
                                                        <span class="price-strike mx-auto" style="font-size:0.9rem;">Rp
                                                            {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        <span class="price-current price-discounted fs-4">Rp
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

        <!-- PROMO SPESIAL -->
        @if ($data['promos']->count() > 0)
            <section class="section-padding pt-0">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2>Promo Spesial Untuk Kamu</h2>
                        <p>Dapatkan voucher eksklusif dan penawaran menarik untuk melengkapi gaya hidupmu!</p>
                    </div>

                    <div class="swiper promo-special-slider product-slider" style="padding-top: 1rem; padding-bottom: 2.5rem;">
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
                                                style="width: auto; padding: 0.7rem 2.5rem; border-radius: 50px;">Lihat Detail</span>
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

        <!-- BRAND DIRECTORY -->
        <section class="section-padding pt-0">
            <div class="container-fluid p-0">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="split-title">Brand Pilihan</h2>
                        <p class="split-desc">Temukan koleksi eksklusif dari merek kecantikan ternama yang telah dikurasi
                            khusus untuk memberikan hasil terbaik bagi Anda.</p>
                    </div>
                    <div class="split-section-right">
                        <div class="swiper brand-slider product-slider" style="padding-top: 1rem; padding-bottom: 2.5rem;">
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

        <!-- COCOK UNTUK KAMU -->
        <section class="section-padding pt-0">
            <div class="container-fluid p-0">
                <div class="full-section-header">
                    <h2>Cocok Untuk Kamu</h2>
                    <p>Rekomendasi personal berdasarkan preferensi dan gaya kecantikanmu.</p>
                </div>

                <div class="swiper curated-slider product-slider" style="padding-top: 1rem; padding-bottom: 2.5rem;">
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
                                            <span class="card-badge badge-gift"><i class="fas fa-gift me-1"></i> Free Gift</span>
                                        @elseif ($discountPercent > 0)
                                            <span class="card-badge badge-discount">-{{ $discountPercent }}%</span>
                                        @endif

                                        <div class="btn-wishlist {{ $inWishlist ? 'active' : '' }}"
                                            onclick="event.stopPropagation(); {{ session('id_user') ? ($inWishlist ? 'removeFromWishlist(' . $product->id . ')' : 'addToWishlist(' . $product->id . ')') : 'var myModal = new bootstrap.Modal(document.getElementById(\'loginUser1\')); myModal.show();' }}">
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
                                        <a href="/{{ $product->product_code }}_product" class="product-name">{{ $product->product_name }}</a>
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

        <!-- KATEGORI UNGGULAN -->
        <section class="section-padding pt-0">
            <div class="container-fluid p-0">
                <div class="full-section-header mb-5">
                    <h2 class="d-flex align-items-center justify-content-center gap-3"><i class="fas fa-layer-group text-success fs-3"></i> Kategori Unggulan</h2>
                    <a href="/shop" class="split-link mx-auto mt-3">Jelajahi Semua <i class="fas fa-arrow-right"></i></a>
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
                            <div class="cat-icon-wrapper" style="color: {{ $iconColor }}; box-shadow: 0 8px 25px {{ $iconColor }}20;">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- JURNAL GLAMOIRE -->
        @if (count($data['articles']) > 0)
            <section class="section-padding pt-0">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2><i class="fas fa-book-open text-info me-2"></i> Jurnal Glamoire</h2>
                        <a href="/newsletter" class="split-link mx-auto mt-2">Baca Semua Artikel <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-7">
                            <div class="article-highlight"
                                onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}"
                                    alt="{{ $data['articles'][0]->title }}">
                                <div class="article-overlay">
                                    <span class="badge bg-light text-dark mb-3 w-auto align-self-start px-4 py-2 rounded-pill"
                                        style="font-family: 'Poppins', sans-serif; font-weight: 700; letter-spacing: 1px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty' }}</span>
                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                    <p><i class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($data['articles'][0]->created_at)->translatedFormat('d F Y') }}</p>
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
                                            <span class="badge bg-success bg-opacity-10 text-success mb-2 border-0 px-3 py-1 rounded-pill">{{ optional($article->categoryArticle)->name ?? 'Tips' }}</span>
                                            <h4>{{ $article->title }}</h4>
                                            <div class="meta"><i class="far fa-calendar-alt me-1"></i>
                                                {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- NEWSLETTER VIP -->
        <section class="section-padding pt-0">
            <div class="container-fluid p-0">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Jadilah yang Pertama Tahu</h2>
                    <p class="nl-desc">Bergabunglah dengan klub eksklusif kami. Dapatkan informasi awal tentang peluncuran produk baru, promo rahasia, dan tips kecantikan premium langsung di kotak masuk Anda.</p>

                    <form id="subscribe-form" class="nl-form">
                        @csrf
                        <div class="nl-input-group">
                            <input type="email" id="subscribe_email" class="nl-input"
                                placeholder="Masukkan alamat email eksklusif Anda..." required autocomplete="off">
                            <button type="submit" id="subscribe-btn" class="nl-btn">Daftar Sekarang</button>
                        </div>
                        <div id="validationEmailSubscribe" class="text-warning mt-3 fw-semibold text-center"
                            style="display: none; font-size:0.95rem;"></div>
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
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3.5, spaceBetween: 24 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            // 3. Flash Sale Swiper
            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5, spaceBetween: 15,
                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 2.5, spaceBetween: 20 }, 992: { slidesPerView: 3.5, spaceBetween: 20 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            // 4. Promo Special Swiper
            new Swiper(".promo-special-slider", {
                slidesPerView: 1.2, spaceBetween: 16,
                navigation: { nextEl: ".promo-special-slider .swiper-button-next", prevEl: ".promo-special-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 3.5 } }
            });

            // 5. Brand Slider
            new Swiper(".brand-slider", {
                slidesPerView: 2.2, spaceBetween: 15,
                navigation: { nextEl: ".brand-slider .swiper-button-next", prevEl: ".brand-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 3.2 }, 768: { slidesPerView: 4.5 }, 992: { slidesPerView: 5.5 }, 1200: { slidesPerView: 6.5 } }
            });

            // 6. Curated Slider
            new Swiper(".curated-slider", {
                slidesPerView: 1.5, spaceBetween: 15,
                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 20 }, 768: { slidesPerView: 3.2, spaceBetween: 20 }, 992: { slidesPerView: 4.5, spaceBetween: 24 }, 1200: { slidesPerView: 5.5, spaceBetween: 24 } }
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
                        btn.html('Daftar Sekarang').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Berhasil!", text: response.message, confirmButtonColor: "#183018" });
                            $("#subscribe_email").val('');
                        } else {
                            Swal.fire({ icon: "error", title: "Oops!", text: response.message });
                        }
                    },
                    error: function () {
                        btn.html('Daftar Sekarang').prop('disabled', false);
                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan sistem, coba lagi nanti." });
                    }
                });
            });
        });
    </script>

@endsection --}}

{{-- @extends('user.layouts.master')

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

        h1, h2, h3, h4, h5, h6 {
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
        .section-padding { padding: 6rem 0; }
        @media (max-width: 768px) { .section-padding { padding: 4rem 0; } }

        /* --- Hero Carousel Immersive (PERBAIKAN GAMBAR TERPOTONG) --- */
        .hero-carousel-wrapper {
            width: 100%;
            position: relative;
            background: var(--glamoire-dark); /* Background gelap agar saat contain tetap elegan */
        }
        .hero-swiper {
            width: 100%;
            height: auto; /* Membiarkan tinggi menyesuaikan gambar otomatis */
        }
        .hero-swiper .swiper-slide {
            overflow: hidden;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-swiper img, .hero-swiper video {
            width: 100%;
            height: auto;
            max-height: 80vh; /* Batasi maksimal 80% tinggi layar laptop agar tidak kebesaran */
            object-fit: contain; /* Mengubah dari cover menjadi contain agar TIDAK TERPOTONG */
            object-position: center;
            transition: transform 12s ease;
            transform: scale(1.02); /* Scale sangat tipis agar tidak merusak sisi gambar */
        }
        .hero-swiper .swiper-slide-active img {
            transform: scale(1);
        }
        .hero-swiper .swiper-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 35%);
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
            border: 1px solid rgba(255,255,255,0.5);
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
        .trust-item:hover { transform: translateY(-5px); }
        .trust-icon {
            width: 60px; height: 60px;
            background: var(--glamoire-sand);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.5rem;
            box-shadow: inset 0 0 0 1px rgba(212, 175, 55, 0.3);
        }
        .trust-text h4 { font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--glamoire-dark); }
        .trust-text p { font-size: 0.85rem; color: var(--text-muted); margin: 0; font-family: 'Poppins', sans-serif;}

        @media (max-width: 768px) {
            .trust-floating-wrapper { margin-top: -30px; }
            .trust-bar { padding: 1.5rem 1rem; gap: 1.5rem;}
            .trust-item { min-width: 140px; }
            .trust-icon { width: 50px; height: 50px; font-size: 1.2rem;}
            .trust-text h4 { font-size: 0.95rem; }
        }

        /* --- Custom Split Layout --- */
        .split-section-wrapper { display: flex; align-items: flex-end; gap: 4rem; width: 100%; margin-bottom: 2rem;}
        .split-section-left { flex: 0 0 350px; }
        .split-section-right { flex: 1; min-width: 0; }
        @media (max-width: 991px) {
            .split-section-wrapper { flex-direction: column; align-items: center; text-align: center; gap: 2rem; }
            .split-section-left { flex: 0 0 auto; max-width: 100%; }
        }

        .section-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            line-height: 1.05;
            margin-bottom: 1.5rem;
        }
        .section-desc { font-size: clamp(1rem, 1.5vw, 1.1rem); color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem; }
        .link-gold {
            color: var(--glamoire-dark);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem;
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 6px; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.9rem;
            transition: var(--transition-smooth);
        }
        .link-gold:hover { color: var(--glamoire-gold); gap: 1.2rem; }

        /* --- Full Width Header --- */
        .full-section-header { text-align: center; margin-bottom: 4rem; }
        .full-section-header h2 { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; color: var(--glamoire-dark); margin-bottom: 1rem; }
        .full-section-header p { font-size: clamp(1rem, 1.5vw, 1.1rem); color: var(--text-muted); max-width: 700px; margin: 0 auto; line-height: 1.8;}

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next, .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            width: 55px !important; height: 55px !important;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: var(--glamoire-dark);
            transform: scale(1.1);
            color: var(--glamoire-gold) !important;
        }
        .swiper-button-next::after, .swiper-button-prev::after { font-size: 1.3rem !important; font-weight: 900; }
        @media (max-width: 768px) { .swiper-button-next, .swiper-button-prev { display: none !important; } }

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
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: 0 5px 20px rgba(0,0,0,0.02);
        }
        .luxury-product-card:hover {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
        }
        .lpc-img-box {
            position: relative;
            padding-top: 130%;
            background: #FAFAFA;
            overflow: hidden;
            cursor: pointer;
        }
        .lpc-img-box img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .luxury-product-card:hover .lpc-img-box img { transform: scale(1.1); }
        .lpc-img-box.dark-overlay img { filter: grayscale(100%) opacity(0.7); }

        .lpc-badge {
            position: absolute; top: 15px; left: 15px;
            padding: 6px 14px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 800; z-index: 2;
            text-transform: uppercase; letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .badge-discount { background: var(--danger-main); color: #FFF; }
        .badge-gift { background: #000; color: var(--glamoire-gold); }

        .lpc-wishlist {
            position: absolute; top: 15px; right: 15px;
            width: 40px; height: 40px;
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(5px);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: #9CA3AF; z-index: 2; cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: none; padding: 0;
        }
        .lpc-wishlist:hover, .lpc-wishlist.active { color: var(--danger-main); transform: scale(1.15); }

        .lpc-action-area {
            position: absolute; bottom: 0; left: 0; width: 100%;
            padding: 2rem 1.5rem 1.5rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 30%, rgba(255,255,255,0.9) 60%, transparent);
            transform: translateY(100%); opacity: 0;
            transition: var(--transition-smooth); z-index: 3;
        }
        @media (min-width: 992px) {
            .luxury-product-card:hover .lpc-action-area { transform: translateY(0); opacity: 1; }
        }
        @media (max-width: 991px) {
            .lpc-action-area {
                position: static; transform: none; opacity: 1;
                background: transparent; padding: 0 1rem 1rem 1rem; margin-top: auto;
            }
        }

        .btn-lpc-action {
            width: 100%; padding: 1rem; border-radius: 50px;
            font-weight: 700; font-size: 0.9rem; border: none;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: var(--transition-smooth); text-transform: uppercase; letter-spacing: 1px;
            cursor: pointer;
        }
        .btn-lpc-add { background: var(--glamoire-dark); color: #FFF; }
        .btn-lpc-add:hover { background: var(--glamoire-gold); color: var(--glamoire-dark); box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4); }
        .btn-lpc-added { background: var(--success-main); color: #FFF; }
        .btn-lpc-notify { background: var(--text-main); color: #FFF; }

        .lpc-info { padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; cursor: pointer; text-align: center;}
        .lpc-brand { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 2.5px; font-weight: 700; margin-bottom: 0.8rem; }
        .lpc-title {
            font-size: 1.15rem; font-weight: 500; color: var(--text-main);
            margin-bottom: 1rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-decoration: none; transition: color 0.3s;
        }
        .luxury-product-card:hover .lpc-title { color: var(--glamoire-gold); }

        .lpc-price-box { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 4px;}
        .lpc-price-current { font-size: 1.25rem; font-weight: 700; color: var(--glamoire-dark); font-family: 'Poppins', sans-serif;}
        .lpc-price-discounted { color: var(--danger-main); }
        .lpc-price-strike { font-size: 0.9rem; color: #9CA3AF; text-decoration: line-through; }

        /* --- PARALLAX CAMPAIGN DIVIDER --- */
        .campaign-parallax {
            height: 70vh;
            min-height: 400px;
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            clip-path: inset(0);
        }
        .campaign-parallax video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: brightness(0.6);
        }
        .campaign-content {
            text-align: center;
            color: white;
            z-index: 2;
            padding: 2rem;
            max-width: 800px;
        }
        .campaign-content h2 {
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .campaign-content p {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }
        .btn-campaign {
            background: transparent;
            color: #FFF;
            border: 1px solid #FFF;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-block;
        }
        .btn-campaign:hover {
            background: #FFF;
            color: var(--glamoire-dark);
        }

        /* --- Cinematic Flash Sale --- */
        .flash-sale-wrapper {
            background: linear-gradient(145deg, #050A05 0%, #183018 100%);
            border-radius: 40px;
            padding: 5rem 4rem;
            color: #FFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.3);
        }
        .flash-sale-wrapper::before {
            content: ''; position: absolute; top: -50%; right: -20%; width: 70%; height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }
        .flash-header { position: relative; z-index: 2; }
        .flash-title { font-size: clamp(3rem, 5vw, 4.5rem); font-weight: 700; color: var(--glamoire-gold); margin-bottom: 1rem; display: flex; align-items: center; gap: 15px; }
        .timer-flex { display: flex; align-items: center; gap: 1rem; margin-top: 2.5rem; }
        .timer-block {
            background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px);
            border: 1px solid rgba(212, 175, 55, 0.4); border-radius: 16px;
            padding: 1rem 1.2rem; text-align: center; min-width: 85px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .timer-val { font-size: 2.2rem; font-weight: 700; line-height: 1; color: #FFF; font-family: 'Poppins', monospace;}
        .timer-lbl { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; color: var(--glamoire-gold); margin-top: 8px; }
        @media (max-width: 991px) {
            .flash-sale-wrapper { padding: 3rem 1.5rem; border-radius: 24px;}
            .flash-header { text-align: center; display: flex; flex-direction: column; align-items: center; margin-bottom: 3rem;}
        }

        /* --- Promo Grid Banners --- */
        .promo-grid-banner {
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            cursor: pointer; background: #000;
        }
        .promo-grid-banner:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2); }
        .promo-grid-banner img, .promo-grid-banner video {
            width: 100%; height: 100%; object-fit: cover; opacity: 0.85; transition: transform 1.5s ease, opacity 0.5s;
        }
        .promo-grid-banner:hover img, .promo-grid-banner:hover video { opacity: 1; transform: scale(1.08); }

        /* --- Event Cards --- */
        .promo-event-card {
            background: #FFF; border-radius: 24px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); border: 1px solid rgba(0,0,0,0.02);
            transition: var(--transition-bounce); cursor: pointer; height: 100%; display: flex; flex-direction: column;
        }
        .promo-event-card:hover { transform: translateY(-12px); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1); }
        .promo-event-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; }
        .promo-event-body { padding: 2.5rem 2rem; display: flex; flex-direction: column; flex-grow: 1; align-items: center; text-align: center; background: #FFF;}
        .promo-event-type { font-size: 0.8rem; color: var(--glamoire-gold); text-transform: uppercase; font-weight: 700; letter-spacing: 2px; margin-bottom: 1rem; }
        .promo-event-title { font-size: 1.5rem; font-weight: 700; color: var(--glamoire-dark); margin-bottom: 1.2rem; line-height: 1.3; font-family: 'The Seasons', serif;}
        .promo-event-date { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 2rem; font-family: 'Poppins', sans-serif;}

        /* --- Brand Directory --- */
        .brand-card {
            background: #FFF; border-radius: 50%; border: 1px solid #F3F4F6;
            width: 160px; height: 160px; margin: 0 auto;
            transition: var(--transition-bounce); display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
            position: relative; overflow: hidden;
        }
        .brand-card:hover {
            border-color: var(--glamoire-gold);
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.2);
        }
        .brand-logo-box { width: 75%; height: 75%; display: flex; align-items: center; justify-content: center; }
        .brand-logo-box img { width: 100%; height: 100%; object-fit: contain; filter: grayscale(100%); transition: filter 0.4s; }
        .brand-card:hover .brand-logo-box img { filter: grayscale(0%); }

        /* --- Category Section --- */
        .category-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 2rem; }
        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem;} }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }

        .cat-card-premium {
            background: #FFF; border-radius: 24px; padding: 3rem 1.5rem; text-align: center; cursor: pointer; transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column; align-items: center; justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02); position: relative; overflow: hidden; z-index: 1;
        }
        .cat-card-premium::before {
            content: ''; position: absolute; inset: 0; background: var(--glamoire-dark); z-index: -1;
            transform: translateY(100%); transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .cat-card-premium:hover { border-color: var(--glamoire-dark); transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .cat-card-premium:hover::before { transform: translateY(0); }
        .cat-icon-wrapper {
            width: 80px; height: 80px; border-radius: 50%; background: var(--glamoire-sand);
            display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;
            transition: var(--transition-smooth); font-size: 2rem;
        }
        .cat-card-premium:hover .cat-icon-wrapper { background: #FFF; transform: scale(1.15) rotate(5deg); }
        .cat-name { font-size: 1.05rem; font-weight: 600; color: var(--text-main); margin: 0; transition: color 0.4s; font-family: 'Poppins', sans-serif;}
        .cat-card-premium:hover .cat-name { color: var(--glamoire-gold); }

        /* --- Article Section (Editorial Vogue Style) --- */
        .article-highlight {
            position: relative; border-radius: 30px; overflow: hidden; cursor: pointer; height: 550px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        .article-highlight img { width: 100%; height: 100%; object-fit: cover; transition: transform 1.5s ease; }
        .article-highlight:hover img { transform: scale(1.08); }
        .article-overlay {
            position: absolute; inset: 0; background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            display: flex; flex-direction: column; justify-content: flex-end; padding: 4rem;
        }
        .article-overlay h3 { color: #FFF; font-size: clamp(2rem, 3vw, 3rem); font-weight: 700; margin-bottom: 1rem; line-height: 1.2; font-family: 'The Seasons', serif;}
        .article-overlay p { color: var(--glamoire-gold); font-size: 1rem; font-weight: 500; font-family: 'Poppins', sans-serif; letter-spacing: 2px; text-transform: uppercase;}

        .article-list-item {
            display: flex; gap: 2rem; align-items: center; cursor: pointer; padding: 1.5rem; border-radius: 24px;
            transition: var(--transition-bounce); border: 1px solid transparent; background: #FFF; box-shadow: 0 5px 20px rgba(0,0,0,0.02);
            height: 100%;
        }
        .article-list-item:hover { box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); border-color: #F3F4F6; transform: translateX(10px); }
        .article-list-img { width: 140px; height: 140px; border-radius: 16px; overflow: hidden; flex-shrink: 0; }
        .article-list-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s;}
        .article-list-item:hover .article-list-img img { transform: scale(1.15); }
        .article-list-content h4 { font-size: 1.2rem; font-weight: 600; color: var(--glamoire-dark); margin-bottom: 1rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: 'Poppins', sans-serif; transition: color 0.3s;}
        .article-list-item:hover .article-list-content h4 { color: var(--glamoire-gold); }
        .article-list-content .meta { font-size: 0.85rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;}
        @media (max-width: 576px) { .article-overlay { padding: 2rem; } .article-list-item { flex-direction: column; align-items: flex-start;} .article-list-img { width: 100%; height: 200px;} }

        /* --- Editorial Newsletter Section --- */
        .newsletter-premium {
            background: var(--glamoire-dark); border-radius: 40px; padding: 7rem 2rem; text-align: center; color: #FFF;
            position: relative; overflow: hidden; box-shadow: 0 30px 60px rgba(24,48,24,0.3); margin-top: 2rem;
        }
        .newsletter-premium::before {
            content: ''; position: absolute; left: -10%; top: -50%; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(212,175,55,0.2) 0%, transparent 70%);
        }
        .newsletter-premium::after {
            content: ''; position: absolute; right: -5%; bottom: -30%; width: 300px; height: 300px;
            background: url('{{ asset('images/pattern-right.png') }}') no-repeat center; background-size: contain; opacity: 0.05; transform: rotate(-15deg);
        }
        .nl-title { font-size: clamp(3rem, 5vw, 4.5rem); font-weight: 700; margin-bottom: 1rem; color: var(--glamoire-gold); position: relative; z-index: 2;}
        .nl-desc { font-size: 1.1rem; color: rgba(255,255,255,0.8); max-width: 600px; margin: 0 auto 3.5rem; line-height: 1.8; font-family: 'Poppins', sans-serif; position: relative; z-index: 2;}

        .nl-form { max-width: 600px; margin: 0 auto; position: relative; z-index: 2; }
        .nl-input-group {
            display: flex; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50px; padding: 0.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); border: 1px solid rgba(255,255,255,0.2);
        }
        .nl-input { border: none; background: transparent; padding: 1.2rem 2rem; width: 100%; font-size: 1.05rem; color: #FFF; outline: none; font-family: 'Poppins', sans-serif;}
        .nl-input::placeholder { color: rgba(255,255,255,0.6); }
        .nl-btn {
            background: var(--glamoire-gold); color: var(--glamoire-dark); border: none; padding: 0 3rem; border-radius: 50px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 2px; transition: var(--transition-bounce); cursor: pointer; white-space: nowrap; font-size: 0.9rem;
        }
        .nl-btn:hover { background: #FFF; transform: scale(1.05); }
        @media (max-width: 576px) {
            .nl-input-group { flex-direction: column; background: transparent; box-shadow: none; gap: 15px; border: none; padding: 0;}
            .nl-input { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 50px; padding: 1.2rem; text-align: center;}
            .nl-btn { padding: 1.2rem; width: 100%; box-shadow: 0 10px 20px rgba(0,0,0,0.2);}
        }
    </style>

    <!-- Welcome Modal PERBAIKAN UKURAN (Tambahan scrollable & resize image) -->
    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto" style="object-fit: cover; max-height: 280px;">
                        @endif
                        <div class="p-4 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="fw-bold mb-2" style="font-family: 'The Seasons', serif; color: var(--glamoire-gold); font-size: 1.7rem;">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-3 opacity-85" style="font-size: 0.9rem; line-height: 1.5; color: rgba(255,255,255,0.8);">
                                {{ $data['popups'][0]->description ?? 'Dapatkan penawaran eksklusif khusus pendaftaran pertama Anda hari ini.' }}
                            </p>
                            <a href="/login" class="btn btn-light rounded-pill px-4 py-2 fw-bold w-100" style="font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;" onmouseover="this.style.background='var(--glamoire-gold)'; this.style.color='var(--glamoire-dark)';" onmouseout="this.style.background='white'; this.style.color='black';">Daftar & Klaim Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Promo Modal PERBAIKAN UKURAN -->
    @if (session('id_user') && $data['promoModal'] !== null)
        <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 bg-transparent">
                    <div class="modal-body p-0 position-relative text-center">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="img-fluid rounded-4 shadow-lg cursor-pointer" style="max-height: 85vh; object-fit: contain; transition: transform 0.4s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- 1. HERO SECTION -->
    <div class="hero-carousel-wrapper reveal">
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
            <div class="swiper-pagination mb-3"></div>
        </div>
    </div>

    <!-- 2. THE GLAMOIRE PROMISE (Scrolling Marquee) -->
    <div class="glamoire-promise-bar reveal">
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
    </div>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <!-- 3. TOP SELLING -->
        <section class="section-padding reveal">
            <div class="container-fluid p-0">
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

                                    <div class="swiper-slide h-auto">
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
                                                            @if($inCart)
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
        </section>

        <!-- 4. BANNER PROMO GRID -->
        @if(count($data['popupsBanner']) > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
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
        @endif

    </div> <!-- Close Container for full width parallax -->

    <!-- NEW: PARALLAX CAMPAIGN DIVIDER -->
    <div class="campaign-parallax reveal">
        <!-- Using a placeholder luxury beauty video. Replace src with your actual campaign video url -->
        <video autoplay loop muted playsinline>
            <source src="https://cdn.pixabay.com/vimeo/74735398/makeup-131102.mp4?width=1280&hash=8b584d4367c30d310e53cd270e599b531475759e" type="video/mp4">
        </video>
        <div class="campaign-content">
            <h2>Discover Your Radiance</h2>
            <p class="text-black">Memadukan kemurnian alam dengan inovasi sains. Glamoire menghadirkan perawatan kulit yang mentransformasi kecantikan sejati Anda.</p>
            <a href="/about" class="btn-campaign">Our Story</a>
        </div>
    </div>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <!-- 5. FLASH SALE (Cinematic) -->
        <section class="section-padding reveal">
            <div class="container-fluid p-0">
                <div class="flash-sale-wrapper">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-4 flash-header">
                            <h2 class="flash-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
                            <p class="mb-0" style="font-size: 1.1rem; opacity:0.8; font-family:'Poppins', sans-serif;">Penawaran super kilat eksklusif. Kesempatan terbatas untuk mengoleksi produk impian Anda.</p>
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

                        <div class="col-12 col-xl-8 mt-5 mt-xl-0">
                            <div class="swiper flash-sale-slider product-slider pb-0" style="padding-top: 1rem; padding-bottom: 2rem;">
                                <div class="swiper-wrapper">
                                    @foreach ($data['new']->take(6) as $product)
                                        @php
                                            $activePromo = $product->promos->first();
                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : ($product->regular_price * 0.75); // Mock flash discount
                                            $discountPercent = round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100);
                                        @endphp
                                        <div class="swiper-slide h-auto">
                                            <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                    <span class="lpc-badge bg-warning text-dark"><i class="fas fa-bolt me-1"></i> {{ $discountPercent }}%</span>
                                                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                                                    <!-- Stock Progress Bar -->
                                                    <div class="position-absolute bottom-0 start-0 w-100 px-4 pb-4 z-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="text-danger fw-bold" style="font-size: 0.75rem; background: rgba(255,255,255,0.95); padding: 4px 12px; border-radius: 50px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">Hampir Habis!</span>
                                                        </div>
                                                        <div class="progress" style="height: 6px; background: rgba(0,0,0,0.4); border-radius: 10px; backdrop-filter:blur(4px);">
                                                            <div class="progress-bar bg-danger" style="width: 85%; border-radius: 10px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lpc-info pb-4 text-center">
                                                    <div class="lpc-price-box">
                                                        <span class="lpc-price-strike" style="font-size:0.95rem;">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        <span class="lpc-price-current lpc-price-discounted" style="font-size: 1.5rem;">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
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

        <!-- 6. PROMO EVENT -->
        @if ($data['promos']->count() > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2>Exclusive Offers</h2>
                        <p>Dapatkan voucher dan penawaran spesial untuk melengkapi ritual kecantikan harian Anda.</p>
                    </div>

                    <div class="swiper promo-special-slider product-slider" style="padding-top: 1rem; padding-bottom: 3rem;">
                        <div class="swiper-wrapper">
                            @foreach ($data['promos']->sortByDesc('created_at') as $promo)
                                <div class="swiper-slide h-auto">
                                    <div class="promo-event-card" onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
                                        <img class="promo-event-img" src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}" alt="{{ $promo->promo_name }}">
                                        <div class="promo-event-body">
                                            <span class="promo-event-type">{{ $promo->type }}</span>
                                            <h3 class="promo-event-title">{{ $promo->promo_name }}</h3>
                                            <div class="promo-event-date">
                                                <i class="far fa-calendar-alt" style="color:var(--glamoire-gold);"></i>
                                                @if($promo->start_date && $promo->end_date)
                                                    {{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                                                @endif
                                            </div>
                                            <span class="btn-lpc-action btn-lpc-add mt-auto px-5 w-auto">Eksplor Penawaran</span>
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
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="split-section-wrapper" style="align-items: center;">
                    <div class="split-section-left">
                        <h2 class="section-title" style="font-size: 3.5rem;">The <br><span style="color:var(--glamoire-gold); font-style:italic;">Brands.</span></h2>
                        <p class="section-desc">Koleksi eksklusif dari merek kecantikan ternama yang dikurasi khusus untuk memenuhi standar Anda.</p>
                    </div>
                    <div class="split-section-right">
                        <div class="swiper brand-slider product-slider" style="padding-top: 1.5rem; padding-bottom: 2.5rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['brands'] as $brand)
                                    <div class="swiper-slide h-auto pb-3">
                                        <div class="brand-card" onclick="window.location.href = '/{{ $brand->name }}_brand'">
                                            <div class="brand-logo-box">
                                                <img src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : asset('images/no-brand.png') }}" alt="{{ $brand->name }}">
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

        <!-- 8. RECOMMENDED (COCOK UNTUK KAMU) -->
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
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
                                $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
                                $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                            @endphp

                            <div class="swiper-slide h-auto">
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
                                                    @if($inCart)
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
        </section>

        <!-- 9. CATEGORIES -->
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="full-section-header mb-5">
                    <h2>Shop by Category</h2>
                </div>

                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $index => $category)
                        @php
                            // Premium muted colors for luxury feel
                            $iconColors = ['#D4AF37', '#607D8B', '#9CA3AF', '#1E3B1E', '#D97706', '#4B5563'];
                            $icons = ['bi-stars', 'bi-droplet-half', 'bi-magic', 'bi-flower1', 'bi-palette', 'bi-suit-heart'];
                            $iconColor = $iconColors[$index % 6];
                            $iconClass = $icons[$index % 6];
                        @endphp
                        <div class="cat-card-premium" onclick="window.location.href='/belanja-{{ $category->name }}'">
                            <div class="cat-icon-wrapper" style="color: {{ $iconColor }}; box-shadow: inset 0 0 0 1px {{ $iconColor }}40;">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 10. ARTICLES / JOURNAL -->
        @if (count($data['articles']) > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2>The Glamoire Journal</h2>
                        <a href="/newsletter" class="link-gold mx-auto mt-2">Baca Semua Jurnal <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-7">
                            <div class="article-highlight" onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}" alt="{{ $data['articles'][0]->title }}">
                                <div class="article-overlay">
                                    <p>{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty & Lifestyle' }}</p>
                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="d-flex flex-column gap-4 h-100 justify-content-between">
                                @foreach ($data['articles']->skip(1)->take(3) as $article)
                                    <div class="article-list-item" onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
                                        <div class="article-list-img">
                                            <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="article-list-content">
                                            <div class="meta mb-2">{{ optional($article->categoryArticle)->name ?? 'Tips' }} • {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</div>
                                            <h4>{{ $article->title }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- 11. NEWSLETTER -->
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Stay Glamorous.</h2>
                    <p class="nl-desc">Daftarkan email Anda untuk menerima akses eksklusif ke rilis produk baru, promo rahasia, dan jurnal kecantikan langsung di kotak masuk Anda.</p>

                    <form id="subscribe-form" class="nl-form">
                        @csrf
                        <div class="nl-input-group">
                            <input type="email" id="subscribe_email" class="nl-input" placeholder="Masukkan alamat email Anda..." required autocomplete="off">
                            <button type="submit" id="subscribe-btn" class="nl-btn">Subscribe</button>
                        </div>
                        <div id="validationEmailSubscribe" class="text-danger mt-3 fw-semibold text-center" style="display: none; font-size:0.9rem;"></div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- SCRIPT LOGIC -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Intersection Observer for Reveal Animation (The "Wah" entrance effect)
            const revealElements = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, { root: null, rootMargin: '0px', threshold: 0.15 });

            revealElements.forEach(el => revealObserver.observe(el));

            // Parallax Effect for Campaign Video
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxVideo = document.querySelector('.campaign-parallax video');
                if(parallaxVideo) {
                    parallaxVideo.style.transform = `translateY(${scrolled * 0.3}px)`;
                }
            });

            // Swiper Initializations
            new Swiper('.hero-swiper', {
                slidesPerView: 1, loop: true, effect: 'fade', fadeEffect: { crossFade: true },
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
            });

            new Swiper(".top-selling-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".top-selling-slider .swiper-button-next", prevEl: ".top-selling-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 2.5, spaceBetween: 24 }, 992: { slidesPerView: 3.5, spaceBetween: 30 }, 1200: { slidesPerView: 4.5, spaceBetween: 30 } }
            });

            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 2.5, spaceBetween: 24 }, 992: { slidesPerView: 3.5, spaceBetween: 20 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            new Swiper(".promo-special-slider", {
                slidesPerView: 1.2, spaceBetween: 20,
                navigation: { nextEl: ".promo-special-slider .swiper-button-next", prevEl: ".promo-special-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 } }
            });

            new Swiper(".brand-slider", {
                slidesPerView: 2.5, spaceBetween: 20,
                navigation: { nextEl: ".brand-slider .swiper-button-next", prevEl: ".brand-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 3.5 }, 768: { slidesPerView: 4.5 }, 992: { slidesPerView: 5.5 }, 1200: { slidesPerView: 6.5 } }
            });

            new Swiper(".curated-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 3.2, spaceBetween: 24 }, 992: { slidesPerView: 4.5, spaceBetween: 30 }, 1200: { slidesPerView: 5.5, spaceBetween: 30 } }
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
                        btn.html('Subscribe').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Welcome to Glamoire!", text: response.message, confirmButtonColor: "#183018" });
                            $("#subscribe_email").val('');
                        } else {
                            Swal.fire({ icon: "error", title: "Oops!", text: response.message });
                        }
                    },
                    error: function () {
                        btn.html('Subscribe').prop('disabled', false);
                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan sistem, coba lagi nanti." });
                    }
                });
            });
        });
    </script>

@endsection --}}

{{-- @extends('user.layouts.master')

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

        h1, h2, h3, h4, h5, h6 {
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
        .section-padding { padding: 6rem 0; }
        @media (max-width: 768px) { .section-padding { padding: 4rem 0; } }

        /* --- Modal Perfect Centering Fix --- */
        .modal {
            padding: 0 !important; /* Mencegah bootstrap menambahkan padding-right yang membuat modal bergeser ke kiri */
        }
        .modal-dialog.modal-dialog-centered {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto !important;
            min-height: 100vh !important; /* Memaksa modal penuh 100% layar secara vertikal */
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
        .hero-swiper img, .hero-swiper video {
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
            background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 35%);
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
            border: 1px solid rgba(255,255,255,0.5);
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
        .trust-item:hover { transform: translateY(-5px); }
        .trust-icon {
            width: 60px; height: 60px;
            background: var(--glamoire-sand);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.5rem;
            box-shadow: inset 0 0 0 1px rgba(212, 175, 55, 0.3);
        }
        .trust-text h4 { font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--glamoire-dark); }
        .trust-text p { font-size: 0.85rem; color: var(--text-muted); margin: 0; font-family: 'Poppins', sans-serif;}

        @media (max-width: 768px) {
            .trust-floating-wrapper { margin-top: -30px; }
            .trust-bar { padding: 1.5rem 1rem; gap: 1.5rem;}
            .trust-item { min-width: 140px; }
            .trust-icon { width: 50px; height: 50px; font-size: 1.2rem;}
            .trust-text h4 { font-size: 0.95rem; }
        }

        /* --- Custom Split Layout --- */
        .split-section-wrapper { display: flex; align-items: flex-end; gap: 4rem; width: 100%; margin-bottom: 2rem;}
        .split-section-left { flex: 0 0 350px; }
        .split-section-right { flex: 1; min-width: 0; }
        @media (max-width: 991px) {
            .split-section-wrapper { flex-direction: column; align-items: center; text-align: center; gap: 2rem; }
            .split-section-left { flex: 0 0 auto; max-width: 100%; }
        }

        .section-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            line-height: 1.05;
            margin-bottom: 1.5rem;
        }
        .section-desc { font-size: clamp(1rem, 1.5vw, 1.1rem); color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem; }
        .link-gold {
            color: var(--glamoire-dark);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.5rem;
            border-bottom: 2px solid var(--glamoire-gold);
            padding-bottom: 6px; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.9rem;
            transition: var(--transition-smooth);
        }
        .link-gold:hover { color: var(--glamoire-gold); gap: 1.2rem; }

        /* --- Full Width Header --- */
        .full-section-header { text-align: center; margin-bottom: 4rem; }
        .full-section-header h2 { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; color: var(--glamoire-dark); margin-bottom: 1rem; }
        .full-section-header p { font-size: clamp(1rem, 1.5vw, 1.1rem); color: var(--text-muted); max-width: 700px; margin: 0 auto; line-height: 1.8;}

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next, .swiper-button-prev {
            color: var(--glamoire-dark) !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            width: 55px !important; height: 55px !important;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: var(--glamoire-dark);
            transform: scale(1.1);
            color: var(--glamoire-gold) !important;
        }
        .swiper-button-next::after, .swiper-button-prev::after { font-size: 1.3rem !important; font-weight: 900; }
        @media (max-width: 768px) { .swiper-button-next, .swiper-button-prev { display: none !important; } }

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
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: 0 5px 20px rgba(0,0,0,0.02);
        }
        .luxury-product-card:hover {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
        }
        .lpc-img-box {
            position: relative;
            padding-top: 130%; /* Very tall, editorial aspect ratio */
            background: #FAFAFA;
            overflow: hidden;
            cursor: pointer;
        }
        .lpc-img-box img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .luxury-product-card:hover .lpc-img-box img { transform: scale(1.1); }
        .lpc-img-box.dark-overlay img { filter: grayscale(100%) opacity(0.7); }

        .lpc-badge {
            position: absolute; top: 15px; left: 15px;
            padding: 6px 14px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 800; z-index: 2;
            text-transform: uppercase; letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .badge-discount { background: var(--danger-main); color: #FFF; }
        .badge-gift { background: #000; color: var(--glamoire-gold); }

        .lpc-wishlist {
            position: absolute; top: 15px; right: 15px;
            width: 40px; height: 40px;
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(5px);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: #9CA3AF; z-index: 2; cursor: pointer;
            transition: var(--transition-bounce);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: none; padding: 0;
        }
        .lpc-wishlist:hover, .lpc-wishlist.active { color: var(--danger-main); transform: scale(1.15); }

        .lpc-action-area {
            position: absolute; bottom: 0; left: 0; width: 100%;
            padding: 2rem 1.5rem 1.5rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 30%, rgba(255,255,255,0.9) 60%, transparent);
            transform: translateY(100%); opacity: 0;
            transition: var(--transition-smooth); z-index: 3;
        }
        @media (min-width: 992px) {
            .luxury-product-card:hover .lpc-action-area { transform: translateY(0); opacity: 1; }
        }
        @media (max-width: 991px) {
            .lpc-action-area {
                position: static; transform: none; opacity: 1;
                background: transparent; padding: 0 1rem 1rem 1rem; margin-top: auto;
            }
        }

        .btn-lpc-action {
            width: 100%; padding: 1rem; border-radius: 50px;
            font-weight: 700; font-size: 0.9rem; border: none;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: var(--transition-smooth); text-transform: uppercase; letter-spacing: 1px;
            cursor: pointer;
        }
        .btn-lpc-add { background: var(--glamoire-dark); color: #FFF; }
        .btn-lpc-add:hover { background: var(--glamoire-gold); color: var(--glamoire-dark); box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4); }
        .btn-lpc-added { background: var(--success-main); color: #FFF; }
        .btn-lpc-notify { background: var(--text-main); color: #FFF; }

        .lpc-info { padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; cursor: pointer; text-align: center;}
        .lpc-brand { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 2.5px; font-weight: 700; margin-bottom: 0.8rem; }
        .lpc-title {
            font-size: 1.15rem; font-weight: 500; color: var(--text-main);
            margin-bottom: 1rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-decoration: none; transition: color 0.3s;
        }
        .luxury-product-card:hover .lpc-title { color: var(--glamoire-gold); }

        .lpc-price-box { margin-top: auto; display: flex; flex-direction: column; align-items: center; gap: 4px;}
        .lpc-price-current { font-size: 1.25rem; font-weight: 700; color: var(--glamoire-dark); font-family: 'Poppins', sans-serif;}
        .lpc-price-discounted { color: var(--danger-main); }
        .lpc-price-strike { font-size: 0.9rem; color: #9CA3AF; text-decoration: line-through; }

        /* --- PARALLAX CAMPAIGN DIVIDER --- */
        .campaign-parallax {
            height: 70vh;
            min-height: 400px;
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            clip-path: inset(0); /* Crucial for parallax effect */
        }
        .campaign-parallax video {
            position: fixed; /* Parallax magic */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: brightness(0.6);
        }
        .campaign-content {
            text-align: center;
            color: white;
            z-index: 2;
            padding: 2rem;
            max-width: 800px;
        }
        .campaign-content h2 {
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--glamoire-gold);
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .campaign-content p {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }
        .btn-campaign {
            background: transparent;
            color: #FFF;
            border: 1px solid #FFF;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-block;
        }
        .btn-campaign:hover {
            background: #FFF;
            color: var(--glamoire-dark);
        }

        /* --- Cinematic Flash Sale --- */
        .flash-sale-wrapper {
            background: linear-gradient(145deg, #050A05 0%, #183018 100%);
            border-radius: 40px;
            padding: 5rem 4rem;
            color: #FFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.3);
        }
        .flash-sale-wrapper::before {
            content: ''; position: absolute; top: -50%; right: -20%; width: 70%; height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }
        .flash-header { position: relative; z-index: 2; }
        .flash-title { font-size: clamp(3rem, 5vw, 4.5rem); font-weight: 700; color: var(--glamoire-gold); margin-bottom: 1rem; display: flex; align-items: center; gap: 15px; }
        .timer-flex { display: flex; align-items: center; gap: 1rem; margin-top: 2.5rem; }
        .timer-block {
            background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px);
            border: 1px solid rgba(212, 175, 55, 0.4); border-radius: 16px;
            padding: 1rem 1.2rem; text-align: center; min-width: 85px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .timer-val { font-size: 2.2rem; font-weight: 700; line-height: 1; color: #FFF; font-family: 'Poppins', monospace;}
        .timer-lbl { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; color: var(--glamoire-gold); margin-top: 8px; }
        @media (max-width: 991px) {
            .flash-sale-wrapper { padding: 3rem 1.5rem; border-radius: 24px;}
            .flash-header { text-align: center; display: flex; flex-direction: column; align-items: center; margin-bottom: 3rem;}
        }

        /* --- Promo Grid Banners --- */
        .promo-grid-banner {
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: var(--transition-bounce);
            cursor: pointer; background: #000;
        }
        .promo-grid-banner:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2); }
        .promo-grid-banner img, .promo-grid-banner video {
            width: 100%; height: 100%; object-fit: cover; opacity: 0.85; transition: transform 1.5s ease, opacity 0.5s;
        }
        .promo-grid-banner:hover img, .promo-grid-banner:hover video { opacity: 1; transform: scale(1.08); }

        /* --- Event Cards --- */
        .promo-event-card {
            background: #FFF; border-radius: 24px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); border: 1px solid rgba(0,0,0,0.02);
            transition: var(--transition-bounce); cursor: pointer; height: 100%; display: flex; flex-direction: column;
        }
        .promo-event-card:hover { transform: translateY(-12px); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1); }
        .promo-event-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; }
        .promo-event-body { padding: 2.5rem 2rem; display: flex; flex-direction: column; flex-grow: 1; align-items: center; text-align: center; background: #FFF;}
        .promo-event-type { font-size: 0.8rem; color: var(--glamoire-gold); text-transform: uppercase; font-weight: 700; letter-spacing: 2px; margin-bottom: 1rem; }
        .promo-event-title { font-size: 1.5rem; font-weight: 700; color: var(--glamoire-dark); margin-bottom: 1.2rem; line-height: 1.3; font-family: 'The Seasons', serif;}
        .promo-event-date { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 2rem; font-family: 'Poppins', sans-serif;}

        /* --- Brand Directory --- */
        .brand-card {
            background: #FFF; border-radius: 50%; border: 1px solid #F3F4F6;
            width: 160px; height: 160px; margin: 0 auto;
            transition: var(--transition-bounce); display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
            position: relative; overflow: hidden;
        }
        .brand-card:hover {
            border-color: var(--glamoire-gold);
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.2);
        }
        .brand-logo-box { width: 75%; height: 75%; display: flex; align-items: center; justify-content: center; }
        .brand-logo-box img { width: 100%; height: 100%; object-fit: contain; filter: grayscale(100%); transition: filter 0.4s; }
        .brand-card:hover .brand-logo-box img { filter: grayscale(0%); }

        /* --- Category Section --- */
        .category-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 2rem; }
        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem;} }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }

        .cat-card-premium {
            background: #FFF; border-radius: 24px; padding: 3rem 1.5rem; text-align: center; cursor: pointer; transition: var(--transition-bounce);
            border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column; align-items: center; justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02); position: relative; overflow: hidden; z-index: 1;
        }
        .cat-card-premium::before {
            content: ''; position: absolute; inset: 0; background: var(--glamoire-dark); z-index: -1;
            transform: translateY(100%); transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .cat-card-premium:hover { border-color: var(--glamoire-dark); transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .cat-card-premium:hover::before { transform: translateY(0); }
        .cat-icon-wrapper {
            width: 80px; height: 80px; border-radius: 50%; background: var(--glamoire-sand);
            display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;
            transition: var(--transition-smooth); font-size: 2rem;
        }
        .cat-card-premium:hover .cat-icon-wrapper { background: #FFF; transform: scale(1.15) rotate(5deg); }
        .cat-name { font-size: 1.05rem; font-weight: 600; color: var(--text-main); margin: 0; transition: color 0.4s; font-family: 'Poppins', sans-serif;}
        .cat-card-premium:hover .cat-name { color: var(--glamoire-gold); }

        /* --- Article Section (Editorial Vogue Style) --- */
        .article-highlight {
            position: relative; border-radius: 30px; overflow: hidden; cursor: pointer; height: 550px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        .article-highlight img { width: 100%; height: 100%; object-fit: cover; transition: transform 1.5s ease; }
        .article-highlight:hover img { transform: scale(1.08); }
        .article-overlay {
            position: absolute; inset: 0; background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            display: flex; flex-direction: column; justify-content: flex-end; padding: 4rem;
        }
        .article-overlay h3 { color: #FFF; font-size: clamp(2rem, 3vw, 3rem); font-weight: 700; margin-bottom: 1rem; line-height: 1.2; font-family: 'The Seasons', serif;}
        .article-overlay p { color: var(--glamoire-gold); font-size: 1rem; font-weight: 500; font-family: 'Poppins', sans-serif; letter-spacing: 2px; text-transform: uppercase;}

        .article-list-item {
            display: flex; gap: 2rem; align-items: center; cursor: pointer; padding: 1.5rem; border-radius: 24px;
            transition: var(--transition-bounce); border: 1px solid transparent; background: #FFF; box-shadow: 0 5px 20px rgba(0,0,0,0.02);
            height: 100%;
        }
        .article-list-item:hover { box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); border-color: #F3F4F6; transform: translateX(10px); }
        .article-list-img { width: 140px; height: 140px; border-radius: 16px; overflow: hidden; flex-shrink: 0; }
        .article-list-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s;}
        .article-list-item:hover .article-list-img img { transform: scale(1.15); }
        .article-list-content h4 { font-size: 1.2rem; font-weight: 600; color: var(--glamoire-dark); margin-bottom: 1rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: 'Poppins', sans-serif; transition: color 0.3s;}
        .article-list-item:hover .article-list-content h4 { color: var(--glamoire-gold); }
        .article-list-content .meta { font-size: 0.85rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;}
        @media (max-width: 576px) { .article-overlay { padding: 2rem; } .article-list-item { flex-direction: column; align-items: flex-start;} .article-list-img { width: 100%; height: 200px;} }

        /* --- Editorial Newsletter Section --- */
        .newsletter-premium {
            background: var(--glamoire-dark); border-radius: 40px; padding: 7rem 2rem; text-align: center; color: #FFF;
            position: relative; overflow: hidden; box-shadow: 0 30px 60px rgba(24,48,24,0.3); margin-top: 2rem;
        }
        .newsletter-premium::before {
            content: ''; position: absolute; left: -10%; top: -50%; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(212,175,55,0.2) 0%, transparent 70%);
        }
        .newsletter-premium::after {
            content: ''; position: absolute; right: -5%; bottom: -30%; width: 300px; height: 300px;
            background: url('{{ asset('images/pattern-right.png') }}') no-repeat center; background-size: contain; opacity: 0.05; transform: rotate(-15deg);
        }
        .nl-title { font-size: clamp(3rem, 5vw, 4.5rem); font-weight: 700; margin-bottom: 1rem; color: var(--glamoire-gold); position: relative; z-index: 2;}
        .nl-desc { font-size: 1.1rem; color: rgba(255,255,255,0.8); max-width: 600px; margin: 0 auto 3.5rem; line-height: 1.8; font-family: 'Poppins', sans-serif; position: relative; z-index: 2;}

        .nl-form { max-width: 600px; margin: 0 auto; position: relative; z-index: 2; }
        .nl-input-group {
            display: flex; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50px; padding: 0.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); border: 1px solid rgba(255,255,255,0.2);
        }
        .nl-input { border: none; background: transparent; padding: 1.2rem 2rem; width: 100%; font-size: 1.05rem; color: #FFF; outline: none; font-family: 'Poppins', sans-serif;}
        .nl-input::placeholder { color: rgba(255,255,255,0.6); }
        .nl-btn {
            background: var(--glamoire-gold); color: var(--glamoire-dark); border: none; padding: 0 3rem; border-radius: 50px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 2px; transition: var(--transition-bounce); cursor: pointer; white-space: nowrap; font-size: 0.9rem;
        }
        .nl-btn:hover { background: #FFF; transform: scale(1.05); }
        @media (max-width: 576px) {
            .nl-input-group { flex-direction: column; background: transparent; box-shadow: none; gap: 15px; border: none; padding: 0;}
            .nl-input { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 50px; padding: 1.2rem; text-align: center;}
            .nl-btn { padding: 1.2rem; width: 100%; box-shadow: 0 10px 20px rgba(0,0,0,0.2);}
        }
    </style>

    <!-- Welcome Modal PERBAIKAN UKURAN (Tambahan scrollable & resize image) -->
    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mx-auto" style="max-width: 500px;">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto" style="object-fit: cover; max-height: 280px;">
                        @endif
                        <div class="p-4 text-center" style="background: var(--glamoire-dark); color: white;">
                            <h3 class="fw-bold mb-2" style="font-family: 'The Seasons', serif; color: var(--glamoire-gold); font-size: 1.7rem;">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-3 opacity-85" style="font-size: 0.9rem; line-height: 1.5; color: rgba(255,255,255,0.8);">
                                {{ $data['popups'][0]->description ?? 'Dapatkan penawaran eksklusif khusus pendaftaran pertama Anda hari ini.' }}
                            </p>
                            <a href="/login" class="btn btn-light rounded-pill px-4 py-2 fw-bold w-100" style="font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;" onmouseover="this.style.background='var(--glamoire-gold)'; this.style.color='var(--glamoire-dark)';" onmouseout="this.style.background='white'; this.style.color='black';">Daftar & Klaim Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Promo Modal PERBAIKAN UKURAN -->
    @if (session('id_user') && $data['promoModal'] !== null)
        <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered mx-auto">
                <div class="modal-content border-0 bg-transparent" style="max-width: 600px;">
                    <div class="modal-body p-0 position-relative text-center">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="img-fluid rounded-4 shadow-lg cursor-pointer" style="max-height: 80vh; object-fit: contain; transition: transform 0.4s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- 1. HERO SECTION -->
    <div class="hero-carousel-wrapper reveal">
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
            <div class="swiper-pagination mb-3"></div>
        </div>
    </div>

    <!-- 2. THE GLAMOIRE PROMISE (Scrolling Marquee) -->
    <div class="glamoire-promise-bar reveal">
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
    </div>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <!-- 3. TOP SELLING -->
        <section class="section-padding reveal">
            <div class="container-fluid p-0">
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

                                    <div class="swiper-slide h-auto">
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
                                                            @if($inCart)
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
        </section>

        <!-- 4. BANNER PROMO GRID -->
        @if(count($data['popupsBanner']) > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
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
        @endif

    </div> <!-- Close Container for full width parallax -->

    <!-- NEW: PARALLAX CAMPAIGN DIVIDER -->
    <div class="campaign-parallax reveal">
        <!-- Using a placeholder luxury beauty video. Replace src with your actual campaign video url -->
        <video autoplay loop muted playsinline>
            <source src="https://cdn.pixabay.com/vimeo/74735398/makeup-131102.mp4?width=1280&hash=8b584d4367c30d310e53cd270e599b531475759e" type="video/mp4">
        </video>
        <div class="campaign-content">
            <h2>Discover Your Radiance</h2>
            <p class="text-black">Memadukan kemurnian alam dengan inovasi sains. Glamoire menghadirkan perawatan kulit yang mentransformasi kecantikan sejati Anda.</p>
            <a href="/about" class="btn-campaign">Our Story</a>
        </div>
    </div>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <!-- 5. FLASH SALE (Cinematic) -->
        <section class="section-padding reveal">
            <div class="container-fluid p-0">
                <div class="flash-sale-wrapper">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-4 flash-header">
                            <h2 class="flash-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
                            <p class="mb-0" style="font-size: 1.1rem; opacity:0.8; font-family:'Poppins', sans-serif;">Penawaran super kilat eksklusif. Kesempatan terbatas untuk mengoleksi produk impian Anda.</p>
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

                        <div class="col-12 col-xl-8 mt-5 mt-xl-0">
                            <div class="swiper flash-sale-slider product-slider pb-0" style="padding-top: 1rem; padding-bottom: 2rem;">
                                <div class="swiper-wrapper">
                                    @foreach ($data['new']->take(6) as $product)
                                        @php
                                            $activePromo = $product->promos->first();
                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : ($product->regular_price * 0.75); // Mock flash discount
                                            $discountPercent = round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100);
                                        @endphp
                                        <div class="swiper-slide h-auto">
                                            <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                                <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                    <span class="lpc-badge bg-warning text-dark"><i class="fas fa-bolt me-1"></i> {{ $discountPercent }}%</span>
                                                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">

                                                    <!-- Stock Progress Bar -->
                                                    <div class="position-absolute bottom-0 start-0 w-100 px-4 pb-4 z-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="text-danger fw-bold" style="font-size: 0.75rem; background: rgba(255,255,255,0.95); padding: 4px 12px; border-radius: 50px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">Hampir Habis!</span>
                                                        </div>
                                                        <div class="progress" style="height: 6px; background: rgba(0,0,0,0.4); border-radius: 10px; backdrop-filter:blur(4px);">
                                                            <div class="progress-bar bg-danger" style="width: 85%; border-radius: 10px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lpc-info pb-4 text-center">
                                                    <div class="lpc-price-box">
                                                        <span class="lpc-price-strike" style="font-size:0.95rem;">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                        <span class="lpc-price-current lpc-price-discounted" style="font-size: 1.5rem;">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
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

        <!-- 6. PROMO EVENT -->
        @if ($data['promos']->count() > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2>Exclusive Offers</h2>
                        <p>Dapatkan voucher dan penawaran spesial untuk melengkapi ritual kecantikan harian Anda.</p>
                    </div>

                    <div class="swiper promo-special-slider product-slider" style="padding-top: 1rem; padding-bottom: 3rem;">
                        <div class="swiper-wrapper">
                            @foreach ($data['promos']->sortByDesc('created_at') as $promo)
                                <div class="swiper-slide h-auto">
                                    <div class="promo-event-card" onclick="window.location.href='/{{ $promo->promo_name }}-detail-promo'">
                                        <img class="promo-event-img" src="{{ $promo->image ? Storage::url($promo->image) : asset('images/no-image.png') }}" alt="{{ $promo->promo_name }}">
                                        <div class="promo-event-body">
                                            <span class="promo-event-type">{{ $promo->type }}</span>
                                            <h3 class="promo-event-title">{{ $promo->promo_name }}</h3>
                                            <div class="promo-event-date">
                                                <i class="far fa-calendar-alt" style="color:var(--glamoire-gold);"></i>
                                                @if($promo->start_date && $promo->end_date)
                                                    {{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d M Y') }}
                                                @endif
                                            </div>
                                            <span class="btn-lpc-action btn-lpc-add mt-auto px-5 w-auto">Eksplor Penawaran</span>
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
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="split-section-wrapper" style="align-items: center;">
                    <div class="split-section-left">
                        <h2 class="section-title" style="font-size: 3.5rem;">The <br><span style="color:var(--glamoire-gold); font-style:italic;">Brands.</span></h2>
                        <p class="section-desc">Koleksi eksklusif dari merek kecantikan ternama yang dikurasi khusus untuk memenuhi standar Anda.</p>
                    </div>
                    <div class="split-section-right">
                        <div class="swiper brand-slider product-slider" style="padding-top: 1.5rem; padding-bottom: 2.5rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['brands'] as $brand)
                                    <div class="swiper-slide h-auto pb-3">
                                        <div class="brand-card" onclick="window.location.href = '/{{ $brand->name }}_brand'">
                                            <div class="brand-logo-box">
                                                <img src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : asset('images/no-brand.png') }}" alt="{{ $brand->name }}">
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

        <!-- 8. RECOMMENDED (COCOK UNTUK KAMU) -->
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
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
                                $discountPercent = ($discountedPrice && $product->regular_price > 0) ? round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100) : 0;
                                $inWishlist = collect($wishlist)->contains('product_id', $product->id);
                                $inCart = isset($cartItems) ? collect($cartItems)->contains('product_id', $product->id) : false;
                            @endphp

                            <div class="swiper-slide h-auto">
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
                                                    @if($inCart)
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
        </section>

        <!-- 9. CATEGORIES -->
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="full-section-header mb-5">
                    <h2>Shop by Category</h2>
                </div>

                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $index => $category)
                        @php
                            // Premium muted colors for luxury feel
                            $iconColors = ['#D4AF37', '#607D8B', '#9CA3AF', '#1E3B1E', '#D97706', '#4B5563'];
                            $icons = ['bi-stars', 'bi-droplet-half', 'bi-magic', 'bi-flower1', 'bi-palette', 'bi-suit-heart'];
                            $iconColor = $iconColors[$index % 6];
                            $iconClass = $icons[$index % 6];
                        @endphp
                        <div class="cat-card-premium" onclick="window.location.href='/belanja-{{ $category->name }}'">
                            <div class="cat-icon-wrapper" style="color: {{ $iconColor }}; box-shadow: inset 0 0 0 1px {{ $iconColor }}40;">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 10. ARTICLES / JOURNAL -->
        @if (count($data['articles']) > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2>The Glamoire Journal</h2>
                        <a href="/newsletter" class="link-gold mx-auto mt-2">Baca Semua Jurnal <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-7">
                            <div class="article-highlight" onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}" alt="{{ $data['articles'][0]->title }}">
                                <div class="article-overlay">
                                    <p>{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty & Lifestyle' }}</p>
                                    <h3>{{ $data['articles'][0]->title }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="d-flex flex-column gap-4 h-100 justify-content-between">
                                @foreach ($data['articles']->skip(1)->take(3) as $article)
                                    <div class="article-list-item" onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
                                        <div class="article-list-img">
                                            <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="article-list-content">
                                            <div class="meta mb-2">{{ optional($article->categoryArticle)->name ?? 'Tips' }} • {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</div>
                                            <h4>{{ $article->title }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- 11. NEWSLETTER -->
        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Stay Glamorous.</h2>
                    <p class="nl-desc">Daftarkan email Anda untuk menerima akses eksklusif ke rilis produk baru, promo rahasia, dan jurnal kecantikan langsung di kotak masuk Anda.</p>

                    <form id="subscribe-form" class="nl-form">
                        @csrf
                        <div class="nl-input-group">
                            <input type="email" id="subscribe_email" class="nl-input" placeholder="Masukkan alamat email Anda..." required autocomplete="off">
                            <button type="submit" id="subscribe-btn" class="nl-btn">Subscribe</button>
                        </div>
                        <div id="validationEmailSubscribe" class="text-danger mt-3 fw-semibold text-center" style="display: none; font-size:0.9rem;"></div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- SCRIPT LOGIC -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Intersection Observer for Reveal Animation (The "Wah" entrance effect)
            const revealElements = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, { root: null, rootMargin: '0px', threshold: 0.15 });

            revealElements.forEach(el => revealObserver.observe(el));

            // Parallax Effect for Campaign Video
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxVideo = document.querySelector('.campaign-parallax video');
                if(parallaxVideo) {
                    parallaxVideo.style.transform = `translateY(${scrolled * 0.3}px)`;
                }
            });

            // Swiper Initializations
            new Swiper('.hero-swiper', {
                slidesPerView: 1, loop: true, effect: 'fade', fadeEffect: { crossFade: true },
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
            });

            new Swiper(".top-selling-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".top-selling-slider .swiper-button-next", prevEl: ".top-selling-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 2.5, spaceBetween: 24 }, 992: { slidesPerView: 3.5, spaceBetween: 30 }, 1200: { slidesPerView: 4.5, spaceBetween: 30 } }
            });

            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 2.5, spaceBetween: 24 }, 992: { slidesPerView: 3.5, spaceBetween: 20 }, 1200: { slidesPerView: 4.5, spaceBetween: 24 } }
            });

            new Swiper(".promo-special-slider", {
                slidesPerView: 1.2, spaceBetween: 20,
                navigation: { nextEl: ".promo-special-slider .swiper-button-next", prevEl: ".promo-special-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 } }
            });

            new Swiper(".brand-slider", {
                slidesPerView: 2.5, spaceBetween: 20,
                navigation: { nextEl: ".brand-slider .swiper-button-next", prevEl: ".brand-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 3.5 }, 768: { slidesPerView: 4.5 }, 992: { slidesPerView: 5.5 }, 1200: { slidesPerView: 6.5 } }
            });

            new Swiper(".curated-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 3.2, spaceBetween: 24 }, 992: { slidesPerView: 4.5, spaceBetween: 30 }, 1200: { slidesPerView: 5.5, spaceBetween: 30 } }
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
                        btn.html('Subscribe').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Welcome to Glamoire!", text: response.message, confirmButtonColor: "#183018" });
                            $("#subscribe_email").val('');
                        } else {
                            Swal.fire({ icon: "error", title: "Oops!", text: response.message });
                        }
                    },
                    error: function () {
                        btn.html('Subscribe').prop('disabled', false);
                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan sistem, coba lagi nanti." });
                    }
                });
            });
        });
    </script>

@endsection --}}

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
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            overflow-x: hidden;
            color: var(--text-main);
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

        /* --- Global Utilities --- */
        .section-padding { padding: 6rem 0; }
        @media (max-width: 768px) { .section-padding { padding: 4rem 0; } }

        /* --- Hero Carousel Immersive --- */
        .hero-carousel-wrapper {
            width: 100%;
            position: relative;
            background: var(--glamoire-sand); /* Soft bg for proportion */
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
            aspect-ratio: 21/9; /* Memaksa proporsi layar lebar yang rapi */
        }
        @media (max-width: 768px) {
            .hero-swiper .swiper-slide { aspect-ratio: 4/5; } /* Proporsi ideal untuk mobile */
        }
        .hero-swiper img, .hero-swiper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 12s ease;
            transform: scale(1.02);
        }
        .hero-swiper .swiper-slide-active img {
            transform: scale(1);
        }
        .hero-swiper .swiper-pagination-bullet {
            background: #FFF;
            opacity: 0.6;
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

        /* --- CORE MESSAGE SECTION (TRUST INDICATORS) --- */
        .core-message-section {
            background-color: var(--glamoire-light);
            padding: 4rem 0;
            border-bottom: 1px solid #E5E7EB;
        }
        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }
        .trust-icon-box {
            font-size: 2rem;
            color: var(--glamoire-dark);
            margin-bottom: 1rem;
            font-weight: 300; /* Minimal style */
        }
        .trust-text {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        @media (max-width: 991px) {
            .trust-grid { grid-template-columns: repeat(2, 1fr); gap: 2.5rem 1rem; }
            .trust-icon-box { font-size: 1.8rem; margin-bottom: 0.8rem;}
            .trust-text { font-size: 0.75rem; letter-spacing: 1px;}
        }

        /* --- Section Headers --- */
        .full-section-header { text-align: center; margin-bottom: 3.5rem; }
        .full-section-header h2 { font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 600; color: var(--glamoire-dark); margin-bottom: 1rem; }
        .full-section-header p { font-size: 1rem; color: var(--text-muted); max-width: 600px; margin: 0 auto; line-height: 1.8; font-family: 'Plus Jakarta Sans', sans-serif;}

        .split-section-wrapper { display: flex; align-items: flex-end; gap: 4rem; width: 100%; margin-bottom: 2rem;}
        .split-section-left { flex: 0 0 300px; } /* Dipersempit agar area produk lebih luas */
        .split-section-right { flex: 1; min-width: 0; }
        .section-title { font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 600; color: var(--glamoire-dark); line-height: 1.1; margin-bottom: 1.5rem; }
        .section-desc { font-size: 1rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem; }
        .link-gold {
            color: var(--glamoire-dark); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
            border-bottom: 1px solid var(--glamoire-dark); padding-bottom: 4px; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; transition: var(--transition-smooth);
        }
        .link-gold:hover { color: var(--glamoire-gold); border-color: var(--glamoire-gold); gap: 1rem; }

        @media (max-width: 991px) {
            .split-section-wrapper { flex-direction: column; align-items: center; text-align: center; gap: 2rem; }
            .split-section-left { flex: 0 0 auto; max-width: 100%; }
        }

        /* --- Universal Swiper Navigation --- */
        .swiper-button-next, .swiper-button-prev {
            color: var(--glamoire-dark) !important; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(5px);
            width: 50px !important; height: 50px !important; border-radius: 50%; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); transition: var(--transition-bounce);
        }
        .swiper-button-next:hover, .swiper-button-prev:hover { background: var(--glamoire-dark); color: #FFF !important; transform: scale(1.1); }
        .swiper-button-next::after, .swiper-button-prev::after { font-size: 1.2rem !important; font-weight: 400; }
        @media (max-width: 768px) { .swiper-button-next, .swiper-button-prev { display: none !important; } }

        /* --- Luxury Product Card (Lebih Besar & Elegan) --- */
        .luxury-product-card {
            background: #FFF;
            transition: var(--transition-bounce);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            /* Dihilangkan shadow berlebih dan border radius besar agar lebih editorial */
            border: 1px solid transparent;
        }
        .luxury-product-card:hover {
            transform: translateY(-8px);
        }
        .lpc-img-box {
            position: relative;
            padding-top: 135%; /* Proporsi memanjang elegan */
            background: var(--glamoire-sand);
            overflow: hidden;
            cursor: pointer;
        }
        .lpc-img-box img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; transition: transform 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .luxury-product-card:hover .lpc-img-box img { transform: scale(1.05); }
        .lpc-img-box.dark-overlay img { filter: grayscale(100%) opacity(0.7); }

        .lpc-badge {
            position: absolute; top: 15px; left: 15px;
            padding: 4px 12px; background: #FFF; color: var(--glamoire-dark);
            font-size: 0.7rem; font-weight: 600; z-index: 2;
            text-transform: uppercase; letter-spacing: 1px;
            border: 1px solid #E5E7EB;
        }
        .badge-discount { background: var(--glamoire-dark); color: #FFF; border:none;}

        .lpc-wishlist {
            position: absolute; top: 15px; right: 15px;
            width: 35px; height: 35px;
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(5px);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: #9CA3AF; z-index: 2; cursor: pointer; transition: var(--transition-bounce); border: none; padding: 0;
        }
        .lpc-wishlist:hover, .lpc-wishlist.active { color: var(--danger-main); transform: scale(1.1); }

        .lpc-action-area {
            position: absolute; bottom: 0; left: 0; width: 100%; padding: 1.5rem;
            transform: translateY(10px); opacity: 0; transition: var(--transition-smooth); z-index: 3;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 20%, transparent);
        }
        @media (min-width: 992px) {
            .luxury-product-card:hover .lpc-action-area { transform: translateY(0); opacity: 1; }
        }
        @media (max-width: 991px) {
            .lpc-action-area { position: static; transform: none; opacity: 1; background: transparent; padding: 0 0 1rem 0; margin-top: auto; }
        }

        .btn-lpc-action {
            width: 100%; padding: 0.8rem; border-radius: 4px; font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600; font-size: 0.85rem; border: 1px solid var(--glamoire-dark);
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: var(--transition-smooth); text-transform: uppercase; letter-spacing: 1px; cursor: pointer;
        }
        .btn-lpc-add { background: transparent; color: var(--glamoire-dark); }
        .btn-lpc-add:hover { background: var(--glamoire-dark); color: #FFF; }
        .btn-lpc-added { background: var(--success-main); color: #FFF; border-color: var(--success-main); }
        .btn-lpc-notify { background: var(--text-muted); color: #FFF; border-color: var(--text-muted); }

        .lpc-info { padding: 1.5rem 0; display: flex; flex-direction: column; flex-grow: 1; cursor: pointer; text-align: left;}
        .lpc-brand { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; margin-bottom: 0.5rem; }
        .lpc-title {
            font-size: 1rem; font-weight: 500; color: var(--text-main); font-family: 'Cormorant Garamond', serif;
            margin-bottom: 0.5rem; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-decoration: none;
        }
        .lpc-short-desc { font-size: 0.75rem; color: #9CA3AF; margin-bottom: 1rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;}
        .lpc-price-box { margin-top: auto; display: flex; align-items: center; gap: 10px;}
        .lpc-price-current { font-size: 1rem; font-weight: 600; color: var(--glamoire-dark); font-family: 'Plus Jakarta Sans', sans-serif;}
        .lpc-price-discounted { color: var(--danger-main); }
        .lpc-price-strike { font-size: 0.85rem; color: #9CA3AF; text-decoration: line-through; }

        /* --- Brand Statement Section (Clean Typography) --- */
        .brand-statement-section {
            background-color: var(--glamoire-sand);
            padding: 8rem 2rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-statement-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 5vw, 4rem);
            color: var(--glamoire-dark);
            font-weight: 500;
            line-height: 1.3;
            max-width: 900px;
            margin: 0;
            /* Dihilangkan shadow yang norak */
        }
        .brand-statement-text i { color: var(--glamoire-gold); font-size: 0.8em;}

        /* --- PARALLAX CAMPAIGN DIVIDER (Storytelling) --- */
        .campaign-parallax {
            height: 80vh;
            min-height: 500px;
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            clip-path: inset(0);
        }
        .campaign-parallax img, .campaign-parallax video {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;
            /* Tidak terlalu gelap, agar elemen visual produk/model tetap menonjol */
            filter: brightness(0.75);
        }
        .campaign-content { text-align: center; color: white; z-index: 2; padding: 2rem; max-width: 800px; }
        .campaign-content h2 { font-size: clamp(3rem, 6vw, 4.5rem); font-weight: 500; margin-bottom: 1.5rem; letter-spacing: 1px;}
        .btn-campaign {
            background: #FFF; color: var(--glamoire-dark); border: none; padding: 1rem 3rem; border-radius: 4px;
            font-family: 'Plus Jakarta Sans', sans-serif; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 600; font-size: 0.85rem;
            transition: var(--transition-smooth); text-decoration: none; display: inline-block;
        }
        .btn-campaign:hover { background: var(--glamoire-gold); color: #FFF; }

        /* --- Flash Sale (Elegant) --- */
        .flash-sale-wrapper {
            background-color: var(--glamoire-sand); /* Diganti dari gradien mencolok ke soft sand */
            padding: 5rem 0;
            border-top: 1px solid #E5E7EB;
            border-bottom: 1px solid #E5E7EB;
        }
        .flash-header { position: relative; z-index: 2; }
        .flash-title { font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 600; color: var(--glamoire-dark); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 15px; }
        .timer-flex { display: flex; align-items: center; gap: 1rem; margin-top: 2rem; }
        .timer-block {
            background: #FFF; border: 1px solid #E5E7EB;
            padding: 0.8rem 1rem; text-align: center; min-width: 75px;
        }
        .timer-val { font-size: 1.8rem; font-weight: 600; line-height: 1; color: var(--glamoire-dark); font-family: 'Plus Jakarta Sans', monospace;}
        .timer-lbl { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-top: 5px; }
        @media (max-width: 991px) {
            .flash-header { text-align: center; display: flex; flex-direction: column; align-items: center; margin-bottom: 3rem;}
        }
        .stock-indicator-bar { height: 4px; background: #E5E7EB; width: 100%; margin-top: 10px; position: relative;}
        .stock-indicator-fill { height: 100%; background: var(--glamoire-dark); position: absolute; left:0; top:0;}
        .stock-text { font-size: 0.75rem; color: var(--text-muted); margin-top: 5px; font-weight: 600; display: block;}

        /* --- Exclusive Offers --- */
        .promo-grid-banner {
            position: relative; overflow: hidden; background: var(--glamoire-sand);
            display: flex; align-items: center; justify-content: center;
            transition: var(--transition-bounce); cursor: pointer; padding: 3rem; text-align: center;
            border: 1px solid #E5E7EB; height: 100%;
        }
        .promo-grid-banner:hover { border-color: var(--glamoire-gold); background: #FFF; transform: translateY(-5px);}
        .promo-grid-icon { font-size: 2.5rem; color: var(--glamoire-dark); margin-bottom: 1.5rem; font-weight: 300;}
        .promo-grid-title { font-size: 1.25rem; font-weight: 600; color: var(--glamoire-dark); font-family: 'Cormorant Garamond', serif; margin-bottom: 0.5rem;}
        .promo-grid-desc { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6;}
        .promo-grid-link { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--glamoire-gold); text-decoration: none;}

        /* --- Brand Directory (Warna Asli) --- */
        .brand-card {
            background: transparent; border: none;
            width: 140px; height: 140px; margin: 0 auto;
            transition: var(--transition-bounce); display: flex; align-items: center; justify-content: center; cursor: pointer;
        }
        .brand-card:hover { transform: scale(1.1); }
        .brand-logo-box { width: 80%; height: 80%; display: flex; align-items: center; justify-content: center; }
        /* PERBAIKAN: Menghapus filter grayscale agar logo original berwarna */
        .brand-logo-box img { width: 100%; height: 100%; object-fit: contain; filter: none; }

        /* --- Category Section --- */
        .category-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 1.5rem; }
        @media (max-width: 1200px) { .category-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 768px) { .category-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; } }
        @media (max-width: 480px) { .category-grid { grid-template-columns: repeat(2, 1fr); } }

        .cat-card-premium {
            background: transparent; text-align: center; cursor: pointer; padding: 1.5rem 0;
        }
        .cat-img-wrapper {
            width: 100px; height: 100px; border-radius: 50%; background: var(--glamoire-sand);
            display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem;
            transition: var(--transition-smooth); border: 1px solid #E5E7EB;
        }
        .cat-card-premium:hover .cat-img-wrapper { border-color: var(--glamoire-dark); transform: scale(1.05); }
        .cat-name { font-size: 0.85rem; font-weight: 600; color: var(--text-main); margin: 0; text-transform: uppercase; letter-spacing: 1px;}

        /* --- Article Section (Editorial Vogue Style) --- */
        .article-card {
            background: transparent; border: none; cursor: pointer; transition: var(--transition-smooth);
        }
        .article-card:hover .article-img img { transform: scale(1.05); }
        .article-img {
            width: 100%; aspect-ratio: 3/4; overflow: hidden; background: #FAFAFA; margin-bottom: 1.5rem; position: relative;
        }
        .article-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 1.5s ease; }
        .article-meta { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-muted); margin-bottom: 0.8rem; font-weight: 600;}
        .article-title { font-size: 1.5rem; font-weight: 500; color: var(--glamoire-dark); font-family: 'Cormorant Garamond', serif; line-height: 1.3; margin-bottom: 1rem;}
        .article-excerpt { font-size: 0.9rem; color: var(--text-muted); line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;}

        /* --- Editorial Newsletter Section --- */
        .newsletter-premium {
            background: var(--glamoire-sand); padding: 6rem 2rem; text-align: center; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB;
        }
        .nl-title { font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 500; margin-bottom: 1rem; color: var(--glamoire-dark); font-family: 'Cormorant Garamond', serif;}
        .nl-desc { font-size: 0.95rem; color: var(--text-muted); max-width: 500px; margin: 0 auto 3rem; line-height: 1.8;}

        .nl-form { max-width: 500px; margin: 0 auto; position: relative; }
        .nl-input-group {
            display: flex; border-bottom: 1px solid var(--glamoire-dark); padding-bottom: 5px;
        }
        .nl-input { border: none; background: transparent; padding: 0.8rem 1rem 0.8rem 0; width: 100%; font-size: 0.95rem; color: var(--glamoire-dark); outline: none;}
        .nl-input::placeholder { color: #9CA3AF; }
        .nl-btn {
            background: transparent; color: var(--glamoire-dark); border: none; padding: 0 1rem;
            font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: color 0.3s; cursor: pointer; font-size: 0.85rem;
        }
        .nl-btn:hover { color: var(--glamoire-gold); }
    </style>

    @if (!session('id_user') && $data['popups']->isNotEmpty())
        <div class="modal fade" id="firstUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mx-auto" style="max-width: 500px;">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 0;">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"></button>
                        @if ($data['popups'][0]->media_type === 'image')
                            <img src="{{ Storage::url($data['popups'][0]->media_popup) }}" class="w-100 h-auto" style="object-fit: cover; max-height: 350px;">
                        @endif
                        <div class="p-5 text-center bg-white">
                            <h3 class="fw-bold mb-3" style="font-family: 'Cormorant Garamond', serif; color: var(--glamoire-dark); font-size: 2rem;">{{ $data['popups'][0]->name ?? 'Welcome to Glamoire' }}</h3>
                            <p class="mb-4 text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                                {{ $data['popups'][0]->description ?? 'Dapatkan penawaran eksklusif khusus pendaftaran pertama Anda hari ini.' }}
                            </p>
                            <a href="/login" class="btn-glamoire w-100" style="background:var(--glamoire-dark); color:white; padding:1rem; text-decoration:none; display:block; border-radius:4px; font-weight:600; text-transform:uppercase; letter-spacing:1px; font-size:0.85rem;">Daftar & Klaim</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('id_user') && $data['promoModal'] !== null)
        <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered mx-auto">
                <div class="modal-content border-0 bg-transparent" style="max-width: 600px;">
                    <div class="modal-body p-0 position-relative text-center">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"
                            style="background-color: white; border-radius: 50%; padding: 0.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);"></button>
                        <a href="/{{ $data['promoModal']->promo_name }}-detail-promo">
                            <img src="{{ Storage::url($data['promoModal']->image) }}"
                                alt="{{ $data['promoModal']->promo_name }}"
                                class="img-fluid rounded-0 shadow-lg cursor-pointer" style="max-height: 80vh; object-fit: contain; transition: transform 0.4s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="hero-carousel-wrapper reveal">
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
            <div class="swiper-pagination mb-3"></div>
        </div>
    </div>

    <section class="core-message-section reveal">
        <div class="container-fluid md:px-20 lg:px-24 xl:px-24 2xl:px-48">
            <div class="trust-grid">
                <div class="trust-item">
                    <div class="trust-icon-box"><i class="far fa-leaf"></i></div>
                    <div class="trust-text">Plant-Based Ingredients</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon-box"><i class="far fa-check-circle"></i></div>
                    <div class="trust-text">BPOM Certified</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon-box"><i class="far fa-paw"></i></div>
                    <div class="trust-text">Cruelty-Free</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon-box"><i class="far fa-gem"></i></div>
                    <div class="trust-text">Authentic Products</div>
                </div>
            </div>
        </div>
    </section>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">
        <section class="section-padding reveal">
            <div class="container-fluid p-0">
                <div class="split-section-wrapper">
                    <div class="split-section-left">
                        <h2 class="section-title">Best<br>Sellers.</h2>
                        <p class="section-desc">Koleksi mahakarya yang paling dicintai. Elevasi rutinitas kecantikan Anda dengan produk ikonis dari Glamoire.</p>
                        <a href="/shop" class="link-gold">Shop The Collection <i class="far fa-arrow-right"></i></a>
                    </div>

                    <div class="split-section-right">
                        <div class="swiper top-selling-slider product-slider" style="padding-bottom: 2rem;">
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
                                        <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                            <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                @if ($product->is_gift ?? false)
                                                    <span class="lpc-badge">Gift</span>
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
                                                                Notify Me
                                                            </button>
                                                        @else
                                                            @if($inCart)
                                                                <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-lpc-action btn-lpc-added">
                                                                    In Cart
                                                                </button>
                                                            @else
                                                                <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-lpc-action btn-lpc-add">
                                                                    Add to Cart
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

                                                <p class="lpc-short-desc">{{ $product->short_description ?? 'Formulated for your natural beauty and glow.' }}</p>

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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="campaign-parallax reveal">
        <img src="https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=2000&auto=format&fit=crop" alt="Beauty Campaign">
        <div class="campaign-content">
            <h2>Beauty That Respects Nature.</h2>
            <p>Memadukan kemurnian bahan nabati dengan inovasi sains. Glamoire menghadirkan perawatan kulit yang mentransformasi kecantikan sejati Anda tanpa kompromi.</p>
            <a href="/about" class="btn-campaign">Discover Our Story</a>
        </div>
    </div>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <section class="section-padding reveal">
            <div class="container-fluid p-0">
                <div class="full-section-header">
                    <h2>New Arrivals</h2>
                    <p>Temukan inovasi terbaru kami. Formulasinya dirancang khusus untuk memberikan hasil maksimal pada ritual kecantikan Anda.</p>
                </div>

                <div class="swiper curated-slider product-slider" style="padding-bottom: 2rem;">
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
                                <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                    <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                        @if ($product->is_gift ?? false)
                                            <span class="lpc-badge badge-gift">Gift</span>
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
                                                        Notify Me
                                                    </button>
                                                @else
                                                    @if($inCart)
                                                        <button onclick="event.stopPropagation(); window.location.href='/cart'" class="btn-lpc-action btn-lpc-added">
                                                            In Cart
                                                        </button>
                                                    @else
                                                        <button onclick="event.stopPropagation(); addToCart({{ $product->id }})" class="btn-lpc-action btn-lpc-add">
                                                            Add to Cart
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
                                        <p class="lpc-short-desc">{{ $product->short_description ?? 'Formulated for your natural beauty and glow.' }}</p>

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
        </section>
    </div> <section class="brand-statement-section reveal">
        <div class="container-fluid">
            <h2 class="brand-statement-text">
                "Rooted in Nature,<br><i>Designed for Your Everyday Glow.</i>"
            </h2>
        </div>
    </section>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48">

        <section class="flash-sale-wrapper reveal my-5">
            <div class="container-fluid p-0">
                <div class="row align-items-center">
                    <div class="col-12 col-xl-4 flash-header">
                        <h2 class="flash-title">Flash Sale.</h2>
                        <p class="mb-0" style="font-size: 1rem; color: var(--text-muted);">Penawaran super kilat eksklusif. Kesempatan terbatas untuk mengoleksi produk impian Anda.</p>
                        <div class="timer-flex">
                            <div class="timer-block">
                                <div class="timer-val">08</div>
                                <div class="timer-lbl">Hours</div>
                            </div>
                            <span class="fs-4 text-muted">:</span>
                            <div class="timer-block">
                                <div class="timer-val">45</div>
                                <div class="timer-lbl">Mins</div>
                            </div>
                            <span class="fs-4 text-muted">:</span>
                            <div class="timer-block">
                                <div class="timer-val">12</div>
                                <div class="timer-lbl">Secs</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-8 mt-5 mt-xl-0">
                        <div class="swiper flash-sale-slider product-slider" style="padding-bottom: 2rem;">
                            <div class="swiper-wrapper">
                                @foreach ($data['new']->take(6) as $product)
                                    @php
                                        $activePromo = $product->promos->first();
                                        $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : ($product->regular_price * 0.75); // Mock flash discount
                                        $discountPercent = round((($product->regular_price - $discountedPrice) / $product->regular_price) * 100);
                                        // Mock stock logic for visual representation
                                        $stockLeft = rand(10, 40);
                                    @endphp
                                    <div class="swiper-slide h-auto">
                                        <div class="luxury-product-card" onclick="window.location.href = '/{{ $product->product_code }}_product'">
                                            <div class="lpc-img-box {{ $product->stock_quantity == 0 ? 'dark-overlay' : '' }}">
                                                <span class="lpc-badge badge-discount">-{{ $discountPercent }}%</span>
                                                <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->product_name }}">
                                            </div>
                                            <div class="lpc-info pb-3 text-left">
                                                <a href="/{{ $product->product_code }}_product" class="lpc-title">{{ $product->product_name }}</a>
                                                <div class="lpc-price-box mb-3">
                                                    <span class="lpc-price-current lpc-price-discounted">Rp {{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                    <span class="lpc-price-strike">Rp {{ number_format($product->regular_price, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="w-100 mt-auto">
                                                    <div class="stock-indicator-bar">
                                                        <div class="stock-indicator-fill" style="width: {{ $stockLeft }}%;"></div>
                                                    </div>
                                                    <span class="stock-text">Sisa {{ $stockLeft }} item</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next d-none d-md-flex" style="right:0;"></div>
                            <div class="swiper-button-prev d-none d-md-flex" style="left:0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding reveal">
            <div class="container-fluid p-0">
                <div class="full-section-header mb-5">
                    <h2>Exclusive Offers</h2>
                    <p>Temukan voucher hemat dan benefit khusus yang disiapkan eksklusif untuk Anda.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="promo-grid-banner">
                            <div>
                                <i class="far fa-gift promo-grid-icon"></i>
                                <h3 class="promo-grid-title">First Purchase</h3>
                                <p class="promo-grid-desc">Diskon 10% untuk pesanan pertama Anda bersama Glamoire.</p>
                                <a href="/login" class="promo-grid-link">Klaim Sekarang <i class="far fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="promo-grid-banner">
                            <div>
                                <i class="far fa-truck promo-grid-icon"></i>
                                <h3 class="promo-grid-title">Free Shipping</h3>
                                <p class="promo-grid-desc">Gratis ongkos kirim ke seluruh Indonesia tanpa minimum belanja.</p>
                                <a href="/shop" class="promo-grid-link">Belanja Sekarang <i class="far fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="promo-grid-banner">
                            <div>
                                <i class="far fa-box-open promo-grid-icon"></i>
                                <h3 class="promo-grid-title">Bundle & Save</h3>
                                <p class="promo-grid-desc">Beli paket hemat skincare routine dan simpan hingga 20%.</p>
                                <a href="/promotion" class="promo-grid-link">Lihat Bundle <i class="far fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0 text-center">
                <h2 class="section-title mb-5">The Brands.</h2>

                <div class="swiper brand-slider product-slider" style="padding-bottom: 2rem;">
                    <div class="swiper-wrapper">
                        @foreach ($data['brands'] as $brand)
                            <div class="swiper-slide h-auto pb-3">
                                <div class="brand-card" onclick="window.location.href = '/{{ $brand->name }}_brand'">
                                    <div class="brand-logo-box">
                                        <img src="{{ $brand->brand_logo ? Storage::url($brand->brand_logo) : asset('images/no-brand.png') }}" alt="{{ $brand->name }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="full-section-header mb-5">
                    <h2>Shop by Category</h2>
                </div>

                <div class="category-grid">
                    @foreach ($data['categories']->sortByDesc('created_at')->take(6) as $index => $category)
                        <div class="cat-card-premium" onclick="window.location.href='/belanja-{{ $category->name }}'">
                            <div class="cat-img-wrapper">
                                <i class="far fa-star text-muted" style="font-size: 2rem;"></i>
                            </div>
                            <h3 class="cat-name">{{ $category->name }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if (count($data['articles']) > 0)
            <section class="section-padding pt-0 reveal">
                <div class="container-fluid p-0">
                    <div class="full-section-header">
                        <h2>The Glamoire Journal</h2>
                        <a href="/newsletter" class="link-gold mx-auto mt-2">Discover All Articles <i class="far fa-arrow-right"></i></a>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="article-card" onclick="window.location.href='/{{ $data['articles'][0]->title }}_detailnewsletter'">
                                <div class="article-img" style="aspect-ratio: 4/5;">
                                    <img src="{{ $data['articles'][0]->image ? Storage::url($data['articles'][0]->image) : asset('images/no-image.png') }}" alt="{{ $data['articles'][0]->title }}">
                                </div>
                                <div class="article-meta">{{ optional($data['articles'][0]->categoryArticle)->name ?? 'Beauty & Lifestyle' }} • {{ \Carbon\Carbon::parse($data['articles'][0]->created_at)->format('F d, Y') }}</div>
                                <h3 class="article-title" style="font-size: 2rem;">{{ $data['articles'][0]->title }}</h3>
                                <p class="article-excerpt">Temukan wawasan terbaru dari ahli kulit kami mengenai pentingnya bahan dasar tanaman untuk mencerahkan hari Anda...</p>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row g-4">
                                @foreach ($data['articles']->skip(1)->take(2) as $article)
                                    <div class="col-12 col-sm-6 col-lg-12">
                                        <div class="article-card d-lg-flex gap-4 align-items-center" onclick="window.location.href='/{{ $article->title }}_detailnewsletter'">
                                            <div class="article-img mb-3 mb-lg-0" style="width: 100%; max-width: 250px; aspect-ratio: 1/1; flex-shrink: 0;">
                                                <img src="{{ $article->image ? Storage::url($article->image) : asset('images/no-image.png') }}" alt="{{ $article->title }}">
                                            </div>
                                            <div>
                                                <div class="article-meta">{{ optional($article->categoryArticle)->name ?? 'Tips' }} • {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</div>
                                                <h3 class="article-title" style="font-size: 1.3rem;">{{ $article->title }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="section-padding pt-0 reveal">
            <div class="container-fluid p-0">
                <div class="newsletter-premium">
                    <h2 class="nl-title">Stay Glamorous.</h2>
                    <p class="nl-desc">Daftarkan email Anda untuk menerima akses awal promo eksklusif, tips kecantikan, dan rilis produk terbaru.</p>

                    <form id="subscribe-form" class="nl-form">
                        @csrf
                        <div class="nl-input-group">
                            <input type="email" id="subscribe_email" class="nl-input" placeholder="Enter your email address" required autocomplete="off">
                            <button type="submit" id="subscribe-btn" class="nl-btn">Subscribe</button>
                        </div>
                        <div id="validationEmailSubscribe" class="text-danger mt-3 fw-semibold text-center" style="display: none; font-size:0.9rem;"></div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Intersection Observer for Reveal Animation
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

            // Parallax Effect for Campaign Video/Image
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxImg = document.querySelector('.campaign-parallax img');
                if(parallaxImg) {
                    parallaxImg.style.transform = `translateY(${scrolled * 0.25}px)`;
                }
            });

            // Swiper Initializations
            new Swiper('.hero-swiper', {
                slidesPerView: 1, loop: true, effect: 'fade', fadeEffect: { crossFade: true },
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
            });

            // UPDATE: Maksimal 4 Product Card Per Row Desktop sesuai instruksi UI/UX
            const productSliderConfig = {
                slidesPerView: 1.5, spaceBetween: 20,
                breakpoints: { 576: { slidesPerView: 2.2, spaceBetween: 24 }, 768: { slidesPerView: 3, spaceBetween: 24 }, 992: { slidesPerView: 3.5, spaceBetween: 30 }, 1200: { slidesPerView: 4, spaceBetween: 30 } }
            };

            new Swiper(".top-selling-slider", {
                ...productSliderConfig,
                navigation: { nextEl: ".top-selling-slider .swiper-button-next", prevEl: ".top-selling-slider .swiper-button-prev" },
            });

            new Swiper(".curated-slider", {
                ...productSliderConfig,
                navigation: { nextEl: ".curated-slider .swiper-button-next", prevEl: ".curated-slider .swiper-button-prev" },
            });

            // Flash Sale maks 3.5 untuk memberikan kesan limit
            new Swiper(".flash-sale-slider", {
                slidesPerView: 1.5, spaceBetween: 20,
                navigation: { nextEl: ".flash-sale-slider .swiper-button-next", prevEl: ".flash-sale-slider .swiper-button-prev" },
                breakpoints: { 576: { slidesPerView: 2 }, 768: { slidesPerView: 2.5 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 3.5 } }
            });

            new Swiper(".brand-slider", {
                slidesPerView: 3, spaceBetween: 30,
                breakpoints: { 576: { slidesPerView: 4 }, 768: { slidesPerView: 5 }, 992: { slidesPerView: 6 }, 1200: { slidesPerView: 7 } },
                autoplay: { delay: 3000, disableOnInteraction: false }, loop: true
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
                        btn.html('Subscribe').prop('disabled', false);
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Welcome to Glamoire!", text: response.message, confirmButtonColor: "#122212" });
                            $("#subscribe_email").val('');
                        } else {
                            Swal.fire({ icon: "error", title: "Oops!", text: response.message });
                        }
                    },
                    error: function () {
                        btn.html('Subscribe').prop('disabled', false);
                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan sistem, coba lagi nanti." });
                    }
                });
            });
        });
    </script>

@endsection

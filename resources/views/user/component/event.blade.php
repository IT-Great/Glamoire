@extends('user.layouts.master')

@section('content')

<!-- ======================================================== -->
<!-- SAFETY SHIELD: PENANGKAL ERROR JS DARI NAVBAR/MASTER     -->
<!-- ======================================================== -->
<div id="notif-badge-stock" style="display: none;">0</div>
<div id="notif-badge-contact" style="display: none;">0</div>
<div id="low-stock-alert" style="display: none;"></div>
<div id="out-of-stock-alert" style="display: none;"></div>
<div id="stock-update-time" style="display: none;"></div>
<script>
    if (typeof window.updateContactUsNotifications !== 'function') {
        window.updateContactUsNotifications = function() { return true; };
    }
    if (typeof window.updateStockAlerts !== 'function') {
        window.updateStockAlerts = function() { return true; };
    }
</script>

<!-- WAJIB ADA: Swiper CSS untuk fungsionalitas Slider -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<style>
    /* ==========================================
       GLAMOIRE EVENT EDITORIAL STYLING
       ========================================== */
    :root {
        --glamoire-dark: #122212;
        --glamoire-gold: #D4AF37;
        --glamoire-sand: #F7F5F0;
        --text-main: #1C2321;
        --text-muted: #6B7280;
        --transition-smooth: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    body {
        background-color: #FFFFFF;
        font-family: 'Poppins', sans-serif;
    }

    h1, h2, h3, h4, .editorial-font {
        font-family: 'The Seasons', serif;
    }

    /* --- Hero Header Event --- */
    .event-hero {
        background: linear-gradient(135deg, var(--glamoire-dark) 0%, #000000 100%);
        padding: 8rem 2rem 5rem;
        text-align: center;
        color: #FFF;
        position: relative;
        overflow: hidden;
    }
    .event-hero::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2000&auto=format&fit=crop') no-repeat center;
        background-size: cover; opacity: 0.2; mix-blend-mode: overlay;
    }
    .event-hero h1 {
        font-size: clamp(3rem, 6vw, 5.5rem);
        color: var(--glamoire-gold);
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }
    .event-hero p {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        color: rgba(255,255,255,0.8);
        position: relative;
        z-index: 2;
        line-height: 1.8;
    }

    /* --- Editorial Timeline Layout --- */
    .event-container {
        padding: 5rem 0;
        max-width: 1100px; /* Sedikit dikecilkan agar lebih proporsional */
        margin: 0 auto;
    }

    .event-card {
        display: flex;
        align-items: center;
        margin-bottom: 8rem;
        gap: 5rem; /* Jarak antara gambar dan teks diperlebar */
        opacity: 0;
        transform: translateY(50px);
        transition: var(--transition-smooth);
    }
    .event-card.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Alternate layout: Even items reverse direction */
    .event-card:nth-child(even) {
        flex-direction: row-reverse;
    }

    .event-gallery {
        flex: 0 0 40%; /* PERBAIKAN: Dari 55% diperkecil menjadi 40% */
        max-width: 480px; /* Batas maksimal lebar gambar di layar besar */
        position: relative;
    }

    /* --- RESPONSIVE SWIPER IMAGE --- */
    .event-swiper {
        width: 100%;
        border-radius: 20px; /* Ujung gambar sedikit lebih halus */
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);

        /* PERBAIKAN: Rasio gambar lebih proporsional dan dibatasi tingginya */
        aspect-ratio: 3/4;
        max-height: 550px;
    }

    .event-swiper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Efek Zoom Lembut saat Card di-hover */
    .event-card:hover .event-swiper img {
        transform: scale(1.05);
    }

    .swiper-pagination-bullet {
        background: #FFF;
        opacity: 0.7;
        width: 8px;
        height: 8px;
    }
    .swiper-pagination-bullet-active {
        background: var(--glamoire-gold);
        opacity: 1;
        width: 20px;
        border-radius: 10px;
    }

    .event-content {
        flex: 1;
        padding: 2rem 0;
    }
    .event-season {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        color: var(--glamoire-gold);
        font-weight: 700;
        margin-bottom: 1rem;
        display: inline-block;
        background: rgba(212, 175, 55, 0.1);
        padding: 5px 14px;
        border-radius: 50px;
    }
    .event-title {
        font-size: clamp(2rem, 3vw, 3rem);
        color: var(--glamoire-dark);
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    .event-date {
        font-size: 0.95rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        padding-bottom: 1rem;
        border-bottom: 1px solid #F3F4F6;
    }
    .event-date i { color: var(--glamoire-dark); font-size: 1.1rem; }
    .event-desc {
        color: var(--text-main);
        line-height: 1.8;
        font-size: 1rem;
        opacity: 0.9;
    }

    /* --- RESPONSIVE BREAKPOINTS --- */
    @media (max-width: 991px) {
        .event-card, .event-card:nth-child(even) {
            flex-direction: column;
            gap: 2.5rem;
            margin-bottom: 6rem;
            padding: 0 1rem;
        }
        .event-gallery {
            flex: 1;
            width: 100%;
            max-width: 100%;
        }
        /* Tablet: Ubah rasio jadi kotak agar tidak terlalu panjang ke bawah */
        .event-swiper {
            aspect-ratio: 1 / 1;
            max-height: none;
        }
        .event-content {
            text-align: center;
            padding: 0 1rem;
        }
        .event-date {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        /* Mobile: Ubah rasio jadi memanjang horizontal (Landscape) seperti TV */
        .event-swiper {
            aspect-ratio: 4 / 3;
            border-radius: 16px;
        }
        .event-title {
            font-size: 1.8rem;
        }
        .event-desc {
            font-size: 0.95rem;
        }
    }

    .empty-event {
        text-align: center;
        padding: 5rem 1rem;
    }
    .empty-event i {
        font-size: 4rem;
        color: #D1D5DB;
        margin-bottom: 1rem;
    }
</style>

<div class="event-hero">
    <h1 class="editorial-font">Moments of Glamoire</h1>
    <p>Jejak perjalanan, eksibisi kecantikan, dan perayaan inovasi kami. Menyatukan komunitas, sains, dan keanggunan dalam satu ruang waktu.</p>
</div>

<div class="container event-container">
    @if($events->count() > 0)
        @foreach($events as $event)
            <div class="event-card fade-up">
                <div class="event-gallery">
                    @if(!empty($event->images))
                        <div class="swiper event-swiper event-swiper-{{ $event->id }}">
                            <div class="swiper-wrapper">
                                @foreach($event->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ Storage::url($image) }}" alt="{{ $event->title }}" loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    @else
                        <div class="event-swiper d-flex align-items-center justify-content-center" style="background: var(--glamoire-sand);">
                            <img src="{{ asset('images/logo.png') }}" style="width: 150px; height:auto; opacity:0.2; object-fit:contain;" alt="No Image">
                        </div>
                    @endif
                </div>

                <div class="event-content">
                    @if($event->season)
                        <span class="event-season">{{ $event->season }}</span>
                    @endif
                    <h2 class="event-title editorial-font">{{ $event->title }}</h2>
                    <div class="event-date">
                        <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                    </div>
                    <div class="event-desc">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-event fade-up">
            <i class="fas fa-glass-cheers"></i>
            <h3 class="editorial-font" style="color: var(--glamoire-dark);">Menanti Kisah Berikutnya</h3>
            <p class="text-muted">Saat ini belum ada acara yang ditampilkan. Terus ikuti kami untuk pembaruan eksklusif.</p>
        </div>
    @endif
</div>

<!-- Include Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Initialize swiper for each event gallery dynamically
        const swipers = document.querySelectorAll('.event-swiper');
        swipers.forEach(function(swiperElement) {
            new Swiper(swiperElement, {
                slidesPerView: 1,
                loop: true,
                effect: "fade",
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: swiperElement.querySelector('.swiper-pagination'),
                    clickable: true,
                },
            });
        });

        // 2. Scroll Reveal Animation (Fade Up)
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });
    });
</script>

@endsection

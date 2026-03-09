@extends('user.layouts.master')

@section('content')

    <style>
        /* ==========================================
           WORLD CLASS HELP CENTER STYLING
           ========================================== */
        :root {
            --glamoire-dark: #183018;
            --glamoire-light: #F9FAFB;
            --glamoire-accent: #2A4D2A;
            --glamoire-gold: #D4AF37;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Premium Breadcrumb --- */
        .premium-breadcrumb {
            background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 2rem;
        }

        .premium-breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .premium-breadcrumb a:hover {
            color: var(--glamoire-dark);
        }

        .premium-breadcrumb span {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0 8px;
        }

        .premium-breadcrumb .active-page {
            color: var(--glamoire-dark);
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* --- Help Header --- */
        .help-header {
            background: var(--glamoire-sand);
            border-radius: 24px;
            padding: 4rem 2rem;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        /* Subtle decorative elements */
        .help-header::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
            border-radius: 50%;
        }

        .help-title {
            font-family: 'The Seasons', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .help-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* --- Modern Tabs (Pill Style) --- */
        .help-tabs-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
        }

        .premium-tabs {
            display: inline-flex;
            background: var(--glamoire-light);
            padding: 6px;
            border-radius: 50px;
            gap: 5px;
            border: 1px solid var(--border-color);
            overflow-x: auto;
            max-width: 100%;
        }

        .premium-tabs::-webkit-scrollbar {
            display: none;
        }

        .tab-pill {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            border: none;
            background: transparent;
            white-space: nowrap;
            cursor: pointer;
        }

        .tab-pill:hover {
            color: var(--glamoire-dark);
        }

        .tab-pill.active {
            background: var(--glamoire-dark);
            color: #FFF;
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.2);
        }

        /* ==========================================
           TAILWIND VS BOOTSTRAP CONFLICT FIX
           (Mencegah Accordion Hilang/Tertutup Otomatis)
           ========================================== */
        .accordion-collapse.collapse:not(.show) {
            display: none !important;
        }

        .accordion-collapse.collapse.show {
            visibility: visible !important;
            display: block !important;
        }

        .accordion-collapse.collapsing {
            visibility: visible !important;
        }

        /* --- Accordion FAQ Style --- */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-category-title {
            font-family: 'The Seasons', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 2rem;
            text-align: center;
        }

        .accordion-item {
            background: #FFF;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: var(--transition-smooth);
        }

        .accordion-item:hover {
            border-color: var(--glamoire-dark);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .accordion-button {
            padding: 1.25rem 1.5rem;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-main);
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: none !important;
            font-family: 'Poppins', sans-serif;
        }

        /* Menghilangkan border biru bawaan Bootstrap saat tombol diklik */
        .accordion-button:focus {
            outline: none;
            box-shadow: none !important;
            background-color: rgba(24, 48, 24, 0.02);
        }

        .accordion-button:not(.collapsed) {
            color: var(--glamoire-dark);
            background-color: rgba(24, 48, 24, 0.02);
        }

        /* Custom Chevron for Accordion */
        .accordion-button::after {
            content: '\f078';
            /* FontAwesome Chevron Down */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            background-image: none;
            transition: transform 0.3s ease;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .accordion-button:not(.collapsed)::after {
            transform: rotate(-180deg);
            color: var(--glamoire-dark);
        }

        .accordion-body {
            padding: 0 1.5rem 1.5rem 1.5rem;
            color: #4B5563;
            line-height: 1.7;
            font-size: 0.95rem;
            border-top: none;
        }

        /* --- Contact Support Box --- */
        .support-box {
            background: linear-gradient(135deg, #183018 0%, #2A4D2A 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            color: #FFF;
            margin-top: 5rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 20px 40px rgba(24, 48, 24, 0.15);
        }

        .support-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--glamoire-gold);
            margin: 0 auto 1.5rem;
        }

        .support-box h3 {
            font-family: 'The Seasons', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .support-box p {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .btn-support {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #FFF;
            color: var(--glamoire-dark);
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .btn-support:hover {
            background: var(--glamoire-gold);
            color: #FFF;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .help-header {
                padding: 3rem 1.5rem;
            }

            .support-box {
                padding: 2rem 1.5rem;
                margin-top: 3rem;
            }

            .premium-tabs {
                width: 100%;
                border-radius: 12px;
                padding: 4px;
            }

            .tab-pill {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
                text-align: center;
            }
        }
    </style>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

        <div class="container-fluid">
            <div class="premium-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                <span>/</span>
                <span class="active-page">Pusat Bantuan</span>
            </div>
        </div>

        <div class="container-fluid">
            <div class="help-header">
                <h1 class="help-title">Pusat Bantuan Glamoire</h1>
                <p class="help-subtitle">Temukan jawaban atas pertanyaan Anda seputar pesanan, pengiriman, hingga produk
                    kosmetik kami.</p>
            </div>
        </div>

        <div class="container-fluid px-0 px-md-3">

            @php
                $categories = $faqsByCategory->keys();
            @endphp

            <div class="help-tabs-wrapper">
                <nav class="nav premium-tabs" id="nav-tab" role="tablist">
                    @foreach ($categories as $index => $category)
                        <button class="tab-pill {{ $index === 0 ? 'active' : '' }}" id="tab-{{ Str::slug($category) }}"
                            data-bs-toggle="tab" data-bs-target="#content-{{ Str::slug($category) }}" type="button" role="tab">
                            {{ ucfirst($category) }}
                        </button>
                    @endforeach
                </nav>
            </div>

            <div class="tab-content" id="nav-tabContent">
                @foreach ($categories as $index => $category)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content-{{ Str::slug($category) }}"
                        role="tabpanel" aria-labelledby="tab-{{ Str::slug($category) }}">

                        <div class="faq-container">
                            <h2 class="faq-category-title">Topik: {{ ucfirst($category) }}</h2>

                            <div class="accordion" id="accordion-{{ Str::slug($category) }}">
                                @foreach ($faqsByCategory[$category] as $faqIndex => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-{{ Str::slug($category) }}-{{ $faqIndex }}">
                                            <button class="accordion-button collapsed shadow-none" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ Str::slug($category) }}-{{ $faqIndex }}"
                                                aria-expanded="false"
                                                aria-controls="collapse-{{ Str::slug($category) }}-{{ $faqIndex }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ Str::slug($category) }}-{{ $faqIndex }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="heading-{{ Str::slug($category) }}-{{ $faqIndex }}"
                                            data-bs-parent="#accordion-{{ Str::slug($category) }}">
                                            <div class="accordion-body">
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="support-box">
                <div class="support-icon">
                    <i class="far fa-envelope"></i>
                </div>
                <h3 class="text-white">Masih Butuh Bantuan?</h3>
                <p>Tidak menemukan jawaban yang Anda cari? Tim Customer Service kami siap membantu Anda dengan senang hati.
                </p>
                <a href="/contact" class="btn-support">
                    <i class="fas fa-headset"></i> Hubungi Customer Service
                </a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Logika untuk memastikan tab pill berjalan mulus jika diklik
            var triggerTabList = [].slice.call(document.querySelectorAll('#nav-tab button'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    tabTrigger.show();
                })
            });
        });
    </script>

@endsection
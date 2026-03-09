<style>
    /* ==========================================
       WORLD CLASS FOOTER STYLING
       ========================================== */
    .premium-footer {
        background-color: #F9FAFB;
        border-top: 1px solid #E5E7EB;
        position: relative;
        overflow: hidden;
    }

    /* Tagline Banner (Top Section) */
    .footer-brand-banner {
        background-color: #183018;
        padding: 2.5rem 0;
        position: relative;
    }

    /* Motif daun transparan di background banner (Optional for premium feel) */
    .footer-brand-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    .footer-tagline {
        color: #ffffff;
        font-family: 'The Seasons', serif;
        font-size: clamp(1.2rem, 3vw, 2.5rem);
        font-weight: 400;
        letter-spacing: 1px;
        text-align: center;
        margin: 0;
        line-height: 1.4;
    }

    .footer-tagline span {
        font-style: italic;
        color: #D4AF37;
        /* Glamoire Gold */
    }

    /* Main Footer Content */
    .footer-main {
        padding: 4rem 0 3rem;
    }

    .footer-brand-name {
        font-family: 'The Seasons', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #183018;
        margin-bottom: 1.25rem;
        letter-spacing: -0.5px;
    }

    .footer-description {
        color: #4B5563;
        font-size: 0.95rem;
        line-height: 1.8;
        margin-bottom: 2rem;
        max-width: 90%;
    }

    /* Social Icons */
    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ffffff;
        color: #183018;
        font-size: 1.1rem;
        border: 1px solid #E5E7EB;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    .social-icon:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(24, 48, 24, 0.1);
        color: #ffffff;
        background-color: #183018;
        border-color: #183018;
    }

    .social-icon.whatsapp:hover {
        background-color: #25D366;
        border-color: #25D366;
        box-shadow: 0 10px 15px rgba(37, 211, 102, 0.2);
    }

    /* Footer Navigation Columns */
    .footer-nav-title {
        color: #111827;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .footer-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-nav-list li {
        margin-bottom: 1rem;
    }

    .footer-nav-list a {
        color: #4B5563;
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .footer-nav-list a:hover {
        color: #183018;
        padding-left: 5px;
        font-weight: 500;
    }

    /* Footer Bottom (Copyright & Payments) */
    .footer-bottom {
        border-top: 1px solid #E5E7EB;
        padding: 1.5rem 0;
        background-color: #ffffff;
    }

    .copyright-text {
        color: #6B7280;
        font-size: 0.85rem;
        margin: 0;
    }

    .copyright-text a {
        color: #183018;
        font-weight: 600;
        text-decoration: none;
    }

    .payment-methods {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0.7;
        filter: grayscale(100%);
        transition: all 0.3s ease;
    }

    .payment-methods:hover {
        opacity: 1;
        filter: grayscale(0%);
    }

    .payment-icon {
        height: 24px;
        width: auto;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .footer-main {
            padding: 3rem 0;
        }

        .footer-nav-title {
            margin-top: 2rem;
        }
    }

    @media (max-width: 767.98px) {
        .footer-tagline {
            font-size: 1.5rem;
            padding: 0 1rem;
        }

        .footer-bottom-flex {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .payment-methods {
            justify-content: center;
        }

        .footer-description {
            max-width: 100%;
        }

        .social-links {
            justify-content: flex-start;
        }
    }
</style>

<footer class="premium-footer mb-12 mb-lg-0">

    <div class="footer-brand-banner">
        <div class="container">
            <h2 class="footer-tagline">
                The First <span>Plant-Based</span> Beauty Store in Indonesia
            </h2>
        </div>
    </div>

    <div class="footer-main md:px-20 lg:px-24 xl:px-24 2xl:px-48">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-5 mb-4 mb-lg-0 pe-lg-5">
                    <div class="footer-brand-name">Glamoire</div>

                    <p class="footer-description">
                        Kami berkomitmen menyediakan kosmetik nabati berkualitas tinggi. Keindahan sejati tidak harus
                        mengorbankan lingkungan. Temukan pesona alami Anda bersama Glamoire.
                    </p>

                    <div class="social-links mt-4">
                        <a href="https://www.facebook.com/" class="social-icon" title="Facebook Glamoire"
                            target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/" class="social-icon" title="Twitter Glamoire" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://www.instagram.com/glamoire.idn/" class="social-icon" title="Instagram Glamoire"
                            target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6282273736200?text=Halo%20Glamoire,%20saya%20ingin%20bertanya..."
                            class="social-icon whatsapp" title="Chat via WhatsApp" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-1 d-none d-lg-block"></div>

                <div class="col-6 col-md-4 col-lg-3">
                    <h4 class="footer-nav-title">Perusahaan</h4>
                    <ul class="footer-nav-list">
                        <li><a href="/about">Tentang Kami</a></li>
                        <li><a href="/newsletter">Jurnal / Blog</a></li>
                        <li><a href="/partner">Mitra Glamoire</a></li>
                        <li><a href="/contact">Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <h4 class="footer-nav-title">Bantuan & Legal</h4>
                    <ul class="footer-nav-list">
                        <li><a href="/help">Pusat Bantuan (FAQ)</a></li>
                        <li><a href="/terms">Syarat & Ketentuan</a></li>
                        <li><a href="/privacy">Kebijakan Privasi</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom md:px-20 lg:px-24 xl:px-24 2xl:px-48">
        <div class="container-fluid">
            <div class="d-flex footer-bottom-flex justify-content-between align-items-center">

                <div class="copyright-text">
                    &copy; {{ date('Y') }} <a href="/">Glamoire</a>. All Rights Reserved.
                </div>

                <div class="payment-methods mt-3 mt-md-0">
                    <span style="font-size: 0.8rem; color: #9CA3AF; margin-right: 8px;">Secure Payment</span>
                    <i class="fab fa-cc-visa fa-2x text-muted mx-1 hover:text-[#1A1F71] transition-colors"></i>
                    <i class="fab fa-cc-mastercard fa-2x text-muted mx-1 hover:text-[#EB001B] transition-colors"></i>
                    <i
                        class="fas fa-money-bill-transfer fa-2x text-muted mx-1 hover:text-success transition-colors"></i>
                </div>

            </div>
        </div>
    </div>

</footer>
{{-- @extends('user.layouts.master')

@section('content')
  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-2 py-2">
    <div class="container-fluid px-0 px-md-3">
      <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
        <div class="d-flex gap-1 pl-3">
          <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
          <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
          <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>

    <div class="container-fluid grid gap-md-2">
      <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-black text-justify">
        Welcome to Glamoire! By accessing and using our website, you agree to comply with and be bound by the following terms and conditions. Please read them carefully.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">1. Introduction</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        Glamoire is an e-commerce platform committed to providing high-quality, plant-based cosmetic products. We believe that beauty should not come at the expense of environmental well-being. By accessing our website and purchasing our products, you agree to be bound by these Terms & Conditions.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">2. Eligibility</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        You must be at least 18 years old to use our website. By using Glamoire, you represent and warrant that you have the right, authority, and capacity to enter into these Terms & Conditions and to abide by all of the terms and conditions.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">3. Account Registration</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        To make a purchase, you may need to create an account. You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">4. Product Information</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        We strive to ensure that the information about our products is accurate and up to date. However, we do not warrant that product descriptions or other content on the site are accurate, complete, reliable, current, or error-free.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">5. Pricing and Payment</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        All prices listed on our website are in [Currency] and are subject to change without notice. Payment must be made at the time of purchase. We accept [list of payment methods]. All transactions are securely processed.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">6. Shipping and Delivery</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        We will make every effort to deliver your order within the estimated timeframe. However, delivery times are not guaranteed and may be subject to delays. Glamoire is not responsible for any delays caused by the carrier or other factors beyond our control.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">7. Returns and Refunds</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        We want you to be completely satisfied with your purchase. If you are not satisfied, you may return the product in accordance with our Return Policy. Please refer to our Return Policy for details on how to return a product and receive a refund.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">8. Intellectual Property</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        All content on the Glamoire website, including text, graphics, logos, images, and software, is the property of Glamoire and is protected by copyright, trademark, and other intellectual property laws. You may not reproduce, distribute, or otherwise use any of the content without our express written consent.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">9. User Conduct</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        You agree not to use the Glamoire website for any unlawful purpose or in any way that could harm Glamoire, its users, or any third party. You may not use our website to transmit any harmful, threatening, abusive, or otherwise objectionable material.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">10. Privacy</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        We respect your privacy and are committed to protecting your personal information. Please refer to our Privacy Policy for details on how we collect, use, and disclose your personal information.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">11. Limitation of Liability</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        Glamoire is not liable for any direct, indirect, incidental, consequential, or punitive damages arising out of your use of our website or products. This includes, but is not limited to, damages for loss of profits, goodwill, use, data, or other intangible losses.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">12. Governing Law</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        These Terms & Conditions are governed by and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law principles.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">13. Changes to Terms & Conditions</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        We reserve the right to update or modify these Terms & Conditions at any time without prior notice. Your continued use of the website following any changes constitutes your acceptance of the new terms.
      </p>

      <p><strong class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">14. Contact Information</strong></p>
      <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
        If you have any questions or concerns about these Terms & Conditions, please contact us at [Your Contact Information].
      </p>
    </div>
  </div>
@endsection --}}

@extends('user.layouts.master')

@section('content')

  <style>
    /* Styling untuk halaman dokumen legal */
    :root {
      --text-primary: #1F2937;
      --text-secondary: #4B5563;
      --accent-green: #183018;
      --bg-gray: #F9FAFB;
    }

    body {
      background-color: var(--bg-gray);
    }

    /* Premium Breadcrumb */
    .premium-breadcrumb {
      background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
      border-radius: 12px;
      padding: 0.75rem 1.5rem;
    }

    .premium-breadcrumb a {
      color: var(--text-secondary);
      text-decoration: none;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .premium-breadcrumb a:hover {
      color: var(--accent-green);
    }

    /* Header Styling */
    .legal-header {
      text-align: center;
      padding: 3rem 0;
      border-bottom: 1px solid #E5E7EB;
      margin-bottom: 2rem;
    }

    .legal-header h1 {
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--accent-green);
      margin-bottom: 1rem;
    }

    .legal-header p {
      color: var(--text-secondary);
      font-size: 1.1rem;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Sticky Sidebar Navigation */
    .toc-sidebar {
      position: sticky;
      top: 100px;
      background: white;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .toc-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--accent-green);
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .toc-nav {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .toc-nav li {
      margin-bottom: 0.5rem;
    }

    .toc-nav a {
      display: block;
      color: var(--text-secondary);
      text-decoration: none;
      font-size: 0.9rem;
      padding: 0.5rem 0.75rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .toc-nav a:hover,
    .toc-nav a.active {
      background-color: rgba(24, 48, 24, 0.05);
      color: var(--accent-green);
      font-weight: 600;
      transform: translateX(5px);
    }

    /* Content Area */
    .legal-content {
      background: white;
      border-radius: 16px;
      padding: 2.5rem 3rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .legal-section {
      margin-bottom: 2.5rem;
    }

    .legal-section h2 {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--accent-green);
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #F3F4F6;
      scroll-margin-top: 100px;
      /* Offset for sticky header when scrolling */
    }

    .legal-section p {
      color: var(--text-primary);
      font-size: 1rem;
      line-height: 1.7;
      text-align: justify;
      margin-bottom: 1rem;
    }

    /* Info Box */
    .info-box {
      background-color: rgba(24, 48, 24, 0.05);
      border-left: 4px solid var(--accent-green);
      padding: 1.25rem;
      border-radius: 0 8px 8px 0;
      margin-bottom: 2rem;
    }

    .info-box p {
      margin: 0;
      color: var(--text-primary);
      font-weight: 500;
    }

    @media (max-width: 991px) {
      .toc-sidebar {
        display: none;
        /* Hide sidebar on mobile/tablet */
      }

      .legal-content {
        padding: 1.5rem;
      }

      .legal-header h1 {
        font-size: 2rem;
      }
    }
  </style>

  <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-12">

    <div class="container-fluid mb-4">
      <div class="premium-breadcrumb d-flex align-items-center gap-2">
        <a href="/" class="text-xs md:text-sm"><i class="fas fa-home mr-1"></i> Beranda</a>
        <span class="text-gray-400 text-xs md:text-sm">/</span>
        <span class="text-xs md:text-sm font-semibold text-[#183018]">Syarat & Ketentuan</span>
      </div>
    </div>

    <div class="container-fluid">
      <div class="legal-header">
        <h1>Syarat & Ketentuan</h1>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-3">
          <div class="toc-sidebar">
            <div class="toc-title">Daftar Isi</div>
            <ul class="toc-nav">
              <li><a href="#intro">1. Introduction</a></li>
              <li><a href="#eligibility">2. Eligibility</a></li>
              <li><a href="#account">3. Account Registration</a></li>
              <li><a href="#product">4. Product Information</a></li>
              <li><a href="#pricing">5. Pricing & Payment</a></li>
              <li><a href="#shipping">6. Shipping & Delivery</a></li>
              <li><a href="#returns">7. Returns & Refunds</a></li>
              <li><a href="#intellectual">8. Intellectual Property</a></li>
              <li><a href="#conduct">9. User Conduct</a></li>
              <li><a href="#privacy">10. Privacy</a></li>
              <li><a href="#liability">11. Limitation of Liability</a></li>
              <li><a href="#law">12. Governing Law</a></li>
              <li><a href="#changes">13. Changes to Terms</a></li>
              <li><a href="#contact">14. Contact Information</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-9">
          <div class="legal-content">

            <div class="info-box">
              <p>Welcome to Glamoire! By accessing and using our website, you agree to comply with and be bound by the
                following terms and conditions. Please read them carefully.</p>
            </div>

            <div id="intro" class="legal-section">
              <h2>1. Introduction</h2>
              <p>Glamoire is an e-commerce platform committed to providing high-quality, plant-based cosmetic products. We
                believe that beauty should not come at the expense of environmental well-being. By accessing our website
                and purchasing our products, you agree to be bound by these Terms & Conditions.</p>
            </div>

            <div id="eligibility" class="legal-section">
              <h2>2. Eligibility</h2>
              <p>You must be at least 18 years old to use our website. By using Glamoire, you represent and warrant that
                you have the right, authority, and capacity to enter into these Terms & Conditions and to abide by all of
                the terms and conditions.</p>
            </div>

            <div id="account" class="legal-section">
              <h2>3. Account Registration</h2>
              <p>To make a purchase, you may need to create an account. You are responsible for maintaining the
                confidentiality of your account and password. You agree to accept responsibility for all activities that
                occur under your account.</p>
            </div>

            <div id="product" class="legal-section">
              <h2>4. Product Information</h2>
              <p>We strive to ensure that the information about our products is accurate and up to date. However, we do
                not warrant that product descriptions or other content on the site are accurate, complete, reliable,
                current, or error-free.</p>
            </div>

            <div id="pricing" class="legal-section">
              <h2>5. Pricing and Payment</h2>
              <p>All prices listed on our website are in [Currency] and are subject to change without notice. Payment must
                be made at the time of purchase. We accept [list of payment methods]. All transactions are securely
                processed.</p>
            </div>

            <div id="shipping" class="legal-section">
              <h2>6. Shipping and Delivery</h2>
              <p>We will make every effort to deliver your order within the estimated timeframe. However, delivery times
                are not guaranteed and may be subject to delays. Glamoire is not responsible for any delays caused by the
                carrier or other factors beyond our control.</p>
            </div>

            <div id="returns" class="legal-section">
              <h2>7. Returns and Refunds</h2>
              <p>We want you to be completely satisfied with your purchase. If you are not satisfied, you may return the
                product in accordance with our Return Policy. Please refer to our Return Policy for details on how to
                return a product and receive a refund.</p>
            </div>

            <div id="intellectual" class="legal-section">
              <h2>8. Intellectual Property</h2>
              <p>All content on the Glamoire website, including text, graphics, logos, images, and software, is the
                property of Glamoire and is protected by copyright, trademark, and other intellectual property laws. You
                may not reproduce, distribute, or otherwise use any of the content without our express written consent.
              </p>
            </div>

            <div id="conduct" class="legal-section">
              <h2>9. User Conduct</h2>
              <p>You agree not to use the Glamoire website for any unlawful purpose or in any way that could harm
                Glamoire, its users, or any third party. You may not use our website to transmit any harmful, threatening,
                abusive, or otherwise objectionable material.</p>
            </div>

            <div id="privacy" class="legal-section">
              <h2>10. Privacy</h2>
              <p>We respect your privacy and are committed to protecting your personal information. Please refer to our
                Privacy Policy for details on how we collect, use, and disclose your personal information.</p>
            </div>

            <div id="liability" class="legal-section">
              <h2>11. Limitation of Liability</h2>
              <p>Glamoire is not liable for any direct, indirect, incidental, consequential, or punitive damages arising
                out of your use of our website or products. This includes, but is not limited to, damages for loss of
                profits, goodwill, use, data, or other intangible losses.</p>
            </div>

            <div id="law" class="legal-section">
              <h2>12. Governing Law</h2>
              <p>These Terms & Conditions are governed by and construed in accordance with the laws of Indonesia, without
                regard to its conflict of law principles.</p>
            </div>

            <div id="changes" class="legal-section">
              <h2>13. Changes to Terms & Conditions</h2>
              <p>We reserve the right to update or modify these Terms & Conditions at any time without prior notice. Your
                continued use of the website following any changes constitutes your acceptance of the new terms.</p>
            </div>

            <div id="contact" class="legal-section">
              <h2>14. Contact Information</h2>
              <p>If you have any questions or concerns about these Terms & Conditions, please contact us at <a
                  href="mailto:glamoirevegan.id@gmail.com"
                  class="text-[#183018] font-semibold text-decoration-none">glamoirevegan.id@gmail.com</a>.</p>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.toc-nav a').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();

        // Remove active class from all
        document.querySelectorAll('.toc-nav a').forEach(el => el.classList.remove('active'));
        // Add active class to clicked
        this.classList.add('active');

        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  </script>

@endsection
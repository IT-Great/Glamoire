{{-- @extends('user.layouts.master')

@section('content')
<section class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-2 py-2">
  <div class="container-fluid px-0 px-md-3">
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-1 pl-3">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-decoration-none text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kebijakan Privasi</a>
      </div>
    </div>
  </div>

  <div class="container-fluid grid gap-1 gap-md-2">
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-black text-justify">
      Welcome to Glamoire! We are dedicated to offering high-quality, plant-based cosmetic products that enhance your beauty while respecting the environment. Your privacy is important to us, and we are committed to protecting it through our compliance with this Privacy Policy.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">1. Information We Collect</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      <strong class="text-black font-normal">Personal Information:</strong> When you register on our website, place an order, or interact with us, we may collect personal information such as your name, email address, shipping address, and payment details.
      <br>
      <strong class="text-black font-normal">Non-Personal Information:</strong> We may collect non-personal information, such as your IP address, browser type, and browsing behavior, to improve your experience on our site.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">2. How We Use Your Information</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      <strong class="text-black font-normal">To Process Transactions:</strong> We use your information to process orders, deliver products, and manage payments.
      <br>
      <strong class="text-black font-normal">To Improve Customer Service:</strong> Your information helps us respond more effectively to your customer service requests and support needs.
      <br>
      <strong class="text-black font-normal">To Send Periodic Emails:</strong> With your consent, we may send you emails about new products, special offers, or other updates.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">3. How We Protect Your Information</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      We implement a variety of security measures to maintain the safety of your personal information. Your data is stored on secure servers and is accessible only to authorized personnel who are required to keep the information confidential.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">4. Sharing Your Information</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      We do not sell, trade, or otherwise transfer your personal information to outside parties, except as necessary to fulfill your orders (e.g., with payment processors or shipping companies) or as required by law.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">5. Cookies</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      Our website uses cookies to enhance your browsing experience, such as remembering your preferences and tracking your use of the site. You can choose to disable cookies through your browser settings, but this may limit your ability to use certain features of our site.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">6. Third-Party Links</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      Occasionally, we may include links to third-party websites on our site. These third-party sites have their own privacy policies, and we are not responsible for the content or activities of these linked sites.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">7. Your Consent</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      By using our site, you consent to our Privacy Policy.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">8. Changes to Our Privacy Policy</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      Glamoire reserves the right to update this Privacy Policy at any time. Any changes will be posted on this page with the updated date. We encourage you to review this policy periodically to stay informed about how we are protecting your information.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">9. Contact Us</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
      If you have any questions about this Privacy Policy, please contact us at [Insert Contact Information].
      <br>
      This policy can be customized further based on specific legal requirements or practices.
    </p>
  </div>
</section>
@endsection --}}

@extends('user.layouts.master')

@section('content')

  <style>
    /* Styling konsisten dengan halaman Terms & Conditions */
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
    }

    .legal-section p {
      color: var(--text-primary);
      font-size: 1rem;
      line-height: 1.7;
      text-align: justify;
      margin-bottom: 1rem;
    }

    .legal-section ul {
      color: var(--text-primary);
      font-size: 1rem;
      line-height: 1.7;
      margin-bottom: 1rem;
      padding-left: 1.5rem;
    }

    .legal-section li {
      margin-bottom: 0.5rem;
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
        <span class="text-xs md:text-sm font-semibold text-[#183018]">Kebijakan Privasi</span>
      </div>
    </div>

    <div class="container-fluid">
      <div class="legal-header">
        <h1>Kebijakan Privasi</h1>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-3">
          <div class="toc-sidebar">
            <div class="toc-title">Daftar Isi</div>
            <ul class="toc-nav">
              <li><a href="#collect">1. Information We Collect</a></li>
              <li><a href="#use">2. How We Use Your Information</a></li>
              <li><a href="#protect">3. How We Protect Your Info</a></li>
              <li><a href="#sharing">4. Sharing Your Information</a></li>
              <li><a href="#cookies">5. Cookies</a></li>
              <li><a href="#links">6. Third-Party Links</a></li>
              <li><a href="#consent">7. Your Consent</a></li>
              <li><a href="#changes">8. Changes to Privacy Policy</a></li>
              <li><a href="#contact">9. Contact Us</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-9">
          <div class="legal-content">

            <div class="info-box">
              <p>Welcome to Glamoire! We are dedicated to offering high-quality, plant-based cosmetic products that
                enhance your beauty while respecting the environment. Your privacy is important to us, and we are
                committed to protecting it through our compliance with this Privacy Policy.</p>
            </div>

            <div id="collect" class="legal-section">
              <h2>1. Information We Collect</h2>
              <ul>
                <li><strong>Personal Information:</strong> When you register on our website, place an order, or interact
                  with us, we may collect personal information such as your name, email address, shipping address, and
                  payment details.</li>
                <li><strong>Non-Personal Information:</strong> We may collect non-personal information, such as your IP
                  address, browser type, and browsing behavior, to improve your experience on our site.</li>
              </ul>
            </div>

            <div id="use" class="legal-section">
              <h2>2. How We Use Your Information</h2>
              <ul>
                <li><strong>To Process Transactions:</strong> We use your information to process orders, deliver products,
                  and manage payments.</li>
                <li><strong>To Improve Customer Service:</strong> Your information helps us respond more effectively to
                  your customer service requests and support needs.</li>
                <li><strong>To Send Periodic Emails:</strong> With your consent, we may send you emails about new
                  products, special offers, or other updates.</li>
              </ul>
            </div>

            <div id="protect" class="legal-section">
              <h2>3. How We Protect Your Information</h2>
              <p>We implement a variety of security measures to maintain the safety of your personal information. Your
                data is stored on secure servers and is accessible only to authorized personnel who are required to keep
                the information confidential.</p>
            </div>

            <div id="sharing" class="legal-section">
              <h2>4. Sharing Your Information</h2>
              <p>We do not sell, trade, or otherwise transfer your personal information to outside parties, except as
                necessary to fulfill your orders (e.g., with payment processors or shipping companies) or as required by
                law.</p>
            </div>

            <div id="cookies" class="legal-section">
              <h2>5. Cookies</h2>
              <p>Our website uses cookies to enhance your browsing experience, such as remembering your preferences and
                tracking your use of the site. You can choose to disable cookies through your browser settings, but this
                may limit your ability to use certain features of our site.</p>
            </div>

            <div id="links" class="legal-section">
              <h2>6. Third-Party Links</h2>
              <p>Occasionally, we may include links to third-party websites on our site. These third-party sites have
                their own privacy policies, and we are not responsible for the content or activities of these linked
                sites.</p>
            </div>

            <div id="consent" class="legal-section">
              <h2>7. Your Consent</h2>
              <p>By using our site, you consent to our Privacy Policy.</p>
            </div>

            <div id="changes" class="legal-section">
              <h2>8. Changes to Our Privacy Policy</h2>
              <p>Glamoire reserves the right to update this Privacy Policy at any time. Any changes will be posted on this
                page with the updated date. We encourage you to review this policy periodically to stay informed about how
                we are protecting your information.</p>
            </div>

            <div id="contact" class="legal-section">
              <h2>9. Contact Us</h2>
              <p>If you have any questions about this Privacy Policy, please contact us at <a
                  href="mailto:glamoirevegan.id@gmail.com"
                  class="text-[#183018] font-semibold text-decoration-none">glamoirevegan.id@gmail.com</a>.</p>
              <p class="text-sm text-gray-500 mt-2"><em>This policy can be customized further based on specific legal
                  requirements or practices.</em></p>
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
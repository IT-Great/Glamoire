@extends('user.layouts.master')

@section('content')
<section class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 pt-2 py-2">
  <div class="container-fluid">
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-2 pl-2">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Syarat & Ketentuan</a>
      </div>
    </div>
  </div>

  <div class="container-fluid grid gap-1 gap-md-2">
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-black text-justify">
      Welcome to Glamoire! By accessing and using our website, you agree to comply with and be bound by the following terms and conditions. Please read them carefully.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">1. Introduction</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      Glamoire is an e-commerce platform committed to providing high-quality, plant-based cosmetic products. We believe that beauty should not come at the expense of environmental well-being. By accessing our website and purchasing our products, you agree to be bound by these Terms & Conditions.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">2. Eligibility</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      You must be at least 18 years old to use our website. By using Glamoire, you represent and warrant that you have the right, authority, and capacity to enter into these Terms & Conditions and to abide by all of the terms and conditions.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">3. Account Registration</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      To make a purchase, you may need to create an account. You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">4. Product Information</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      We strive to ensure that the information about our products is accurate and up to date. However, we do not warrant that product descriptions or other content on the site are accurate, complete, reliable, current, or error-free.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">5. Pricing and Payment</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      All prices listed on our website are in [Currency] and are subject to change without notice. Payment must be made at the time of purchase. We accept [list of payment methods]. All transactions are securely processed.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">6. Shipping and Delivery</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      We will make every effort to deliver your order within the estimated timeframe. However, delivery times are not guaranteed and may be subject to delays. Glamoire is not responsible for any delays caused by the carrier or other factors beyond our control.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">7. Returns and Refunds</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      We want you to be completely satisfied with your purchase. If you are not satisfied, you may return the product in accordance with our Return Policy. Please refer to our Return Policy for details on how to return a product and receive a refund.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">8. Intellectual Property</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      All content on the Glamoire website, including text, graphics, logos, images, and software, is the property of Glamoire and is protected by copyright, trademark, and other intellectual property laws. You may not reproduce, distribute, or otherwise use any of the content without our express written consent.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">9. User Conduct</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      You agree not to use the Glamoire website for any unlawful purpose or in any way that could harm Glamoire, its users, or any third party. You may not use our website to transmit any harmful, threatening, abusive, or otherwise objectionable material.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">10. Privacy</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      We respect your privacy and are committed to protecting your personal information. Please refer to our Privacy Policy for details on how we collect, use, and disclose your personal information.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">11. Limitation of Liability</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      Glamoire is not liable for any direct, indirect, incidental, consequential, or punitive damages arising out of your use of our website or products. This includes, but is not limited to, damages for loss of profits, goodwill, use, data, or other intangible losses.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">12. Governing Law</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      These Terms & Conditions are governed by and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law principles.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">13. Changes to Terms & Conditions</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      We reserve the right to update or modify these Terms & Conditions at any time without prior notice. Your continued use of the website following any changes constitutes your acceptance of the new terms.
    </p>

    <p><strong class="text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px] font-semibold text-black">14. Contact Information</strong></p>
    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-justify text-black">
      If you have any questions or concerns about these Terms & Conditions, please contact us at [Your Contact Information].
    </p>
  </div>
</section>
@endsection

@extends('user.layouts.master')

@section('content')
<section class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 pt-2 py-2">
  <div class="container-fluid px-0 px-md-3">
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-1 pl-3">
        <a href="/home" class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Pusat Bantuan</a>
      </div>
    </div>
  </div>

  <div class="container-fluid px-0 px-md-3">
    <nav class="tabbable">
      <div class="nav nav-tabs border-secondary mb-4">
          <a class="nav-item nav-link active text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#akun">Akun</a>
          <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#order">Pembelian</a>
          <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#payment">Pembayaran</a>
          <a class="nav-item nav-link text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]" data-bs-toggle="tab" href="#shipping">Pengiriman</a>
      </div>
    </nav>

    <div class="tab-content">
      <div class="tab-pane active" id="akun">
        <div class="container mt-2 mt-md-5">
          <div class="faq-title text-center text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">Hal yang sering ditanyakan terkait akun</div>

                            <div class="row">
                                <div class="col-md-12">
                                    @foreach ($faqsByCategory[$category] as $faq)
                                        <div class="faq-item text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
                                            <h5>{{ $faq->question }}</h5>
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="contact-info text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">
                                <p>Have a different question and can't find the answer you're looking for? Reach out to our
                                    support team by <a href="/contact">sending us an email</a> and we'll get back to you as
                                    soon as we can.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>
@endsection

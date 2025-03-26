@extends('user.layouts.master')

@section('content')
    <section class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 pt-2 py-2">
        <!-- Existing breadcrumb code -->

        <div class="container-fluid">
            <nav class="tabbable">
                <div class="nav nav-tabs border-secondary mb-4">
                    @php
                        $categories = $faqsByCategory->keys();
                    @endphp

                    @foreach ($categories as $index => $category)
                        <a class="nav-item nav-link {{ $index === 0 ? 'active' : '' }} text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]"
                            data-bs-toggle="tab" href="#{{ Str::slug($category) }}">
                            {{ ucfirst($category) }}
                        </a>
                    @endforeach
                </div>
            </nav>

            <div class="tab-content">
                @foreach ($categories as $index => $category)
                    <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="{{ Str::slug($category) }}">
                        <div class="container mt-5">
                            <div class="faq-title text-center text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px]">
                                Hal yang sering ditanyakan terkait {{ strtolower($category) }}
                            </div>

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

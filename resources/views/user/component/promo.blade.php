@extends('user.layouts.master')

@section('content')
<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-96 py-2 mb-8">
  <div class="container-fluid p-0 py-4" style="min-height:55vh;">
    <div class="col mb-2">
      <p class="font-semibold text-[14px] md:text-[12px] lg:text-[14px] xl:text-[24px] bg-[#183018] text-white w-fit py-2 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
        Makin Hemat dengan Voucher
      </p>
    </div>

    <div class="col mb-2">
      <div class="d-flex overflow-x-auto max-w-fit-content custom-scroll gap-2 border-top border-bottom py-2" style="max-height: 20vh; max-width: 100%;">
        @if (count($vouchers) !== 0)
          @foreach ($vouchers as $voucher)
            <img src="{{ Storage::url($voucher->image) }}" class="img-fluid shadow-md rounded-sm" title="{{ $voucher->promo_name }}" id="image-voucher-{{ $voucher->id }}" alt="{{ $voucher->promo_name }}" data-bs-toggle="modal" data-bs-target="#voucher-{{ $voucher->id }}"  style="max-width: 20vh;">
            <!-- MODAL DETAIL VOUCHER -->
            <div class="modal fade" id="voucher-{{$voucher->id}}" tabindex="-1" aria-labelledby="voucher-{{$voucher->id}}" aria-hidden="true">
                <div class="modal-dialog modal-md-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #183018">
                          <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">{{ $voucher->promo_name }}</h1>
                          <button type="button" class="btn-close text-white" style="color:#FFFFFF;" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body border-top border-1 p-1 p-md-3">
                            <div class="row p-0">
                                <div class="col-6 border-right">
                                    <img src="{{ Storage::url($voucher->image) }}" class="img-fluid w-full shadow-md rounded-sm mb-2" title="{{ $voucher->promo_name }}" id="detail-image-voucher-{{ $voucher->id }}" alt="{{ $voucher->promo_name }}">
                                    <div class="grid w-full mb-2">
                                      <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-[#183018]">Deskripsi</p>
                                      <p class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">{{ $voucher->description }}</p>
                                    </div>
                                    <div class="grid w-full gap-2">
                                      <div class="flex">
                                        <div class="col-2 p-0 d-flex align-items-center justify-content-start">
                                        <i class="fas fa-money-bill fa-sm fa-md-lg" style="color:#183018; width: 100%; height: auto;"></i>
                                        </div>
                                        <div class="col-10 p-0 grid">
                                          <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Minimun Transaksi</p>
                                          <p class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Rp{{ number_format($voucher->min_transaction, 0, ',', '.') }}</p>
                                        </div>
                                      </div>
                                      
                                      <div class="flex">
                                        <div class="col-2 p-0 flex align-items-center justify-content-start">
                                          <i class="fas fa-regular fa-calendar fa-sm fa-md-lg" style="color:#183018;"></i>
                                        </div>
                                        <div class="col-10 p-0">
                                          <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Periode Voucher</p>
                                          <p class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ \Carbon\Carbon::parse($voucher->start_date)->translatedFormat('d F Y') }} hingga {{ \Carbon\Carbon::parse($voucher->end_date)->translatedFormat('d F Y') }}</p>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom p-0 p-md-2">
                                      <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-[#183018]">Syarat & Ketentuan</p>
                                    </div>
                                    <div class="overflow-y-auto">
                                        <ol class="list-group-numbered" style="max-height:20vw;">
                                            <li class="list-group-item p-1 border-none d-flex align-items-start text-[6px] md:text-[6px] lg:text-[8px] xl:text-[10px]">
                                                <span class=""></span> <!-- Nomor list -->
                                                <p class="ml-2 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px] mb-0">{{ $voucher->terms_conditions }}</p>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL DETAIL VOUCHER -->
          @endforeach
        @else
          <div style="display:flex; align-items:center; justify-content:start;">
            <img src="images/voucher-empty.png" class="img-fluid" style="width:10%; height:100%; object-fit: cover;" alt=Voucher kosong">
            <p class="text-danger text-md">Maaf tidak ada voucher tersedia</p>
          </div>
        @endif
      </div>
    </div>


    @if (count($promos) !== 0)
      @foreach ($promos as $promo)
        <div class="col flex mb-2 mt-8">
          <p class="font-semibold text-[14px] md:text-[12px] lg:text-[14px] xl:text-[24px] bg-[#183018] text-white w-fit py-2 pl-1 pr-3" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
            {{ $promo->promo_name }}
          </p>
          @php
            $dateRange = explode(' - ', $promo->date_range);
            $startDate = \Carbon\Carbon::parse($dateRange[0])->translatedFormat('d F Y');
            $endDate = \Carbon\Carbon::parse($dateRange[1])->translatedFormat('d F Y');
          @endphp
          <p class="flex justify-content-center align-items-center ml-auto font-semibold text-[14px] md:text-[12px] lg:text-[14px] xl:text-[24px] bg-[#183018] text-white w-fit py-2 pr-1 pl-3" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
            {{ $startDate }} sampa {{ $endDate }}
          </p>
        </div>
        
        <div class="col">
          <a href="/{{$promo->promo_name}}-detail-promo" class="hover:shadow-xl">
            <img src="{{ Storage::url($promo->image) }}" class="img-fluid py-1 hover:scale-105 transition-transform duration-300 hover:shadow-md" alt="{{ $promo->promo_name }}" title="{{ $promo->promo_name }}">
          </a>
        </div>
      @endforeach
    @else
      <div style="display:flex; align-items:center; justify-content:center;">
        <img src="images/event-empty.png" class="img-fluid" style="width:20%; height:100%; object-fit: cover;" alt=Voucher kosong">
      </div>
      <div style="display:flex; align-items:center; justify-content:center;">
        <p class="text-danger text-md">Maaf tidak ada promo tersedia</p>
      </div>
    @endif
  </div>
</div>




@endsection

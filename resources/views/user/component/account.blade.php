
@extends('user.layouts.master')

@section('content')

@php
  $shippingAddresses = $profile->shippingAddress;
  $wishlist          = $profile->wishlist;
@endphp

<div class="md:px-20 lg:px-24 xl:px-24 py-2">
  <div class="container-fluid">
    <div class="shadow-sm border border-black rounded-md py-2 py-md-3 my-2 my-md-3">
      <div class="d-flex gap-2 pl-2">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Profil Saya</a>
      </div>
    </div>
  </div>

  <div class="container-fluid pb-2 pb-md-4">
    <nav class="tabbable">
      <div class="nav nav-tabs border-secondary mb-2">
          @if (empty(session('activeTab')))
          <a class="nav-item active nav-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#my-profile">Profilku</a>
          @else
          <a class="nav-item nav-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#my-profile">Profilku</a>
          @endif
          <a class="nav-item nav-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#shipping-address">Alamat Pengiriman</a>
          <a class="nav-item nav-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#my-order">Orderanku</a>
          <a class="nav-item nav-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#my-wishlist">Produk Favorit</a>
          <a class="nav-item nav-link text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#payment-waiting">Menunggu Pembayaran</a>
      </div>
    </nav>

    <div class="tab-content">
      <!-- PROFILE -->
      <div class="tab-pane fade px-2" id="my-profile" style="min-height:80vh;">
        @if($profile->email_verified_at == NULL)
          <p class="text-danger text-sm">Oops, Anda Belum Melakukan Verifikasi Email.</p>
          <form class="d-inline" id="email-verify-form">
              @csrf
              <button type="submit" class="text-sm text-danger btn btn-link p-0 m-0 align-baseline text-[#183018]">{{ __('Kirim Email Verifikasi ') }}</button>.
          </form>
        @else
        @endif
        @if (session('id_user'))
          <form class="row" id="profileForm" method="POST" action="{{route('edit.account')}}">
            @csrf
            @method('PUT')
            <div class="col-12">
              <label for="name" class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Nama Lengkap</label>
              <input type="text" class="form-control text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="inputName" name="fullname" placeholder="Enter your fullname" value="{{ $profile->fullname ? $profile->fullname : '' }}" {{ $profile->email_verified_at == NULL ? "disabled" : "" }}>
            </div>
            <div class="col-12">
              <label for="handphone" class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Handphone</label>
              <div class="input-group">
                <span class="input-group-text text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="basic-addon1">+62</span>
                <input type="number" class="form-control text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="inputHandphone" placeholder="Enter your phone number" pattern="[0]{1}[8]{1}[0-9]{9,10}" name="handphone" value="{{ $profile->handphone ? $profile->handphone : '' }}" {{ $profile->email_verified_at == NULL ? "disabled" : "" }}>
              </div>
            </div>
            <div class="col-12">
              <label for="email" class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Email</label>
              <input type="email" class="form-control text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="inputEmail" placeholder="Enter your email" value="{{ $profile->email ? $profile->email : '' }}" name="email" {{ $profile->email_verified_at == NULL ? "disabled" : "" }}>
            </div>
            <div class="col-12">
              <label for="Gender" class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Jenis Kelamin</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" type="radio" id="inputMale" name="gender" value="male" {{ $profile->gender == "male" ? "checked" : ""}} {{ $profile->email_verified_at == NULL ? "disabled" : "" }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="inputMale">Pria</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" type="radio" id="inputFemale" name="gender" value="female" {{ $profile->gender == "female" ? "checked" : ""}} {{ $profile->email_verified_at == NULL ? "disabled" : "" }}>
                  <label class="form-check-label text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" for="inputFemale">Wanita</label>
                </div>
              </div>
            </div>

            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-primary text-white w-full rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="background-color: #183018" id="submitBtn" disabled>
                Ubah Profil
              </button>
            </div>
          </form>
        @else    
        @endif
      </div>

      <!-- END PROFILE -->

      <!-- SHIPPING ADDRESS -->
      <div class="tab-pane fade" id="shipping-address" style="min-height:80vh;"> 
        <div class="col-12">
          <div class="row">
            <div class="col-12 p-0">
                <div class="d-flex align-items-center justify-content-end px-2">
                  <button type="button" class="btn border btn-light d-flex align-items-center rounded-sm mb-2" data-bs-toggle="modal" data-bs-target="#form-address">
                    <i class="fas fa-thin fa-plus me-2 d-flex align-items-center text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]"></i>
                    <p class="text-black mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">Tambahkan Alamat</p>
                  </button>
                </div>
            </div>
          </div>

          <div class="row"> 
            
            @foreach ($shippingAddresses as $sa)
              @if ($sa->is_main)
                <!-- ALAMAT UTAMA -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-2">
                  <div class="p-2 rounded-sm custom-shadow bg-[#183018]">
                    <div class="d-flex align-items-center">
                      <p class="text-white mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">{{ $sa->label }}</p>
                      <span class="badge bg-[#ffffff] text-[#183018] d-flex align-items-center justify-content-center ml-auto
                      text-[10px] md:text-[9px] lg:text-[11px] xl:text-[13px]">Utama</span>
                    </div>
                    
                    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-white">{{ $sa->recipient_name }}</p>
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-primary">{{ $sa->handphone }}</p>
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-primary">{{ $sa->district }}, {{ $sa->regency }}, {{ $sa->province }} (61258)</p>
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-primary">{{ $sa->address }}</p>
                    @if ($sa->benchmark)
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px] text-primary">({{ $sa->benchmark }})</p>
                    @endif

      
                    <div class="input-group-btn mt-2">
                      <button type="button" class="btn border text-[#183018] bg-light w-full rounded-sm text-[10px] md:text-[10px] lg:text-[13px] xl:text-[15px]"
                        data-bs-toggle="modal" data-bs-target="#form-edit-address"
                        data-id="{{ $sa->id }}"
                        data-label="{{ $sa->label }}"
                        data-recipient_name="{{ $sa->recipient_name }}"
                        data-handphone="{{ $sa->handphone }}"
                        data-province="{{ $sa->province }}"
                        data-regency="{{ $sa->regency }}"
                        data-district="{{ $sa->district }}"
                        data-address="{{ $sa->address }}"
                        data-benchmark="{{ $sa->benchmark }}"
                        >
                        Ubah Alamat
                      </button>
                    </div>
                  </div>
                </div>
                <!-- END ALAMAT UTAMA -->
              @else
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-2">
                  <div class="p-2 rounded-sm custom-shadow">
                    <div class="d-flex align-items-center">
                      <p class="text-black mb-0 text-[10px] md:text-11px] lg:text-[13px] xl:text-[15px]">{{ $sa->label }}</p>
                    </div>
                    
                    <p class="text-[9px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-black">{{ $sa->recipient_name }}</p>
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px]">{{ $sa->handphone }}</p>
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px]">{{ $sa->district }}, {{ $sa->regency }}, {{ $sa->province }} (61258)</p>
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px]">{{ $sa->address }}</p>
                    @if ($sa->benchmark)
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px]">({{ $sa->benchmark }})</p>
                    @else
                    <p class="text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px]">(Patokan Belum Ditambahkan)</p>
                    @endif
      
                    <div class="d-flex gap-2 input-group-btn mt-2">
                      <button type="button" class="btn border text-[#183018] bg-light w-full rounded-sm text-[10px] md:text-[10px] lg:text-[13px] xl:text-[15px]"
                              data-bs-toggle="modal" data-bs-target="#form-edit-address"
                              data-id="{{ $sa->id }}"
                              data-label="{{ $sa->label }}"
                              data-recipient_name="{{ $sa->recipient_name }}"
                              data-handphone="{{ $sa->handphone }}"
                              data-province="{{ $sa->province }}"
                              data-regency="{{ $sa->regency }}"
                              data-district="{{ $sa->district }}"
                              data-address="{{ $sa->address }}"
                              data-benchmark="{{ $sa->benchmark }}"
                              >
                        Ubah Alamat
                      </button>

                      <button data-id="{{ $sa->id }}" type="button" name="setMainAddress" class="btn border text-white bg-dark w-full rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px] hover-shadow-md" style="background-color: #183018">
                        Jadikan Alamat Utama
                      </button>

                      <button data-id="{{ $sa-> id }}" name="deleteAddress" type="button" class="btn border w-fit rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="background-color: #ffffff">
                          <i aria-hidden="true" class="fas fa-solid fa-trash" title="Hapus Alamat"></i>
                      </button>
                      
                    
                      <!-- <button data-id="{{ $sa->id }}" name="deleteAddress" type="submit" class="btn border w-fit rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" style="background-color: #ffffff">
                        <i aria-hidden="true" class="fas fa-solid fa-trash" title="Hapus Alamat"></i>
                      </button> -->
                    </div>
                  </div>
                </div>
              @endif
            @endforeach

          </div>
        </div>
      </div>
      <!-- END SHIPPING ADDRESS -->

      <!-- MY ORDER -->
      <div class="tab-pane fade p-0 m-0" id="my-order" style="min-height:80vh;">
        <!-- <nav class="tabbable">
          <div class="nav nav-tabs border-secondary mb-2 text-center">
            <a class="nav-item nav-link text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#all">All</a>
            <a class="nav-item nav-link text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#waiting">Waiting</a>
            <a class="nav-item nav-link text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#proses">Proses</a>
            <a class="nav-item nav-link text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#send">Send</a>
            <a class="nav-item nav-link text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" data-toggle="tab" href="#done">Done</a>
          </div>
        </nav> -->

        <div class="tab-pane p-0 m-0" id="all">
          <!-- CARD -->
          <div class="grid gap-2 p-0 m-0">

            @foreach ($profile->orders as $order)
              <!-- DONE -->
              <div class="col-12 p-0">
                <div class="p-3 custom-shadow">
                  <div class="d-flex align-items-center mb-2">
                    <svg class="d-flex align-items-center justify-content-center" xmlns="http://www.w3.org/2000/svg" width="15" height="15" 
                      viewBox="0 0 448 512">
                      <path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64l0 48-128 0 0-48zm-48 48l-64 0c-26.5 0-48 21.5-48 48L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-208c0-26.5-21.5-48-48-48l-64 0 0-48C336 50.1 285.9 0 224 0S112 50.1 112 112l0 48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/>
                    </svg>
                    <p class="font-semibold text-black mb-0 text-[9px] md:text-[11px] lg:text-[13px] xl:text-[15px] mx-2">Belanja</p>
                    <p class="text-black mb-0 text-[9px] md:text-[11px] lg:text-[13px] xl:text-[15px]">{{ \Carbon\Carbon::parse($order->date)->translatedFormat('d F Y') }}</p>
                    <span class="badge 
                        @if($order->status == 'done') badge-success
                        @elseif($order->status == 'waiting confirm') badge-secondary
                        @elseif($order->status == 'in process') badge-info
                        @elseif($order->status == 'in delivery') badge-warning
                        @endif
                        d-flex align-items-center justify-content-center text-[9px] md:text-[9px] lg:text-[11px] xl:text-[13px] mx-2">
                        {{
                            $order->status == 'done' ? 'Selesai' :
                            ($order->status == 'waiting confirm' ? 'Menunggu Konfirmasi' :
                            ($order->status == 'in process' ? 'Sedang Diproses' :
                            ($order->status == 'in delivery' ? 'Dalam Pengiriman' : 'Unknown')))
                        }}
                    </span>
                    <p class="text-primary mb-0 text-[9px] md:text-[11px] lg:text-[13px] xl:text-[15px] d-none d-md-block">
                      {{ $order->invoice->no_invoice }}
                    </p>
                  </div>

                  @foreach ($order->items as $item)
                    
                    <div class="d-flex mb-2 md:mb-4 lg:md-4 xl:md-4">
                      <div class="col-2 col-md-1 p-0 m-0">
                        <img class="border border-[#183018] rounded-md" src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->product_name }}">    
                      </div>
                      <div class="col-6 col-md-8 gap-4">
                        <p class="font-semibold text-black mb-0 text-[8px] md:text-10px] lg:text-[10px] xl:text-[12px]">{{ $item->product->brand->name }}</p>
                        <p class="text-black text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $item->product->product_name }}</p>
                        <p class="text-[7px] md:text-[9px] lg:text-[11px] xl:text-[13px]">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                      </div>
                      <div class="col-4 col-md-3 d-flex flex-column align-items-start justify-content-center border-left">
                        <p class="text-black font-semibold text-[8px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Total Belanja</p>
                        <p class="text-black text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>  
                      </div>
                    </div>
                  @endforeach
                  

                  <div class="d-flex justify-content-end input-group-btn mt-2">
                    <div class="col-12 d-flex p-0 justify-content-end gap-2">
                      <div class="d-flex align-items-center justify-content-center">
                        <a class="hover:cursor-pointer text-[9px] md:text-[11px] lg:text-[13px] xl:text-[15px] text-red-700 font-semibold" data-bs-toggle="modal" data-bs-target="#transaction-detail-{{$order->invoice->no_invoice}}">
                          Lihat Detail Transaksi
                        </a>
                      </div>
                      @if ($order->status == 'done')
                        <button type="submit" class="btn border rounded-sm w-fit text-[#183018] text-[9px] md:text-[11px] lg:text-[13px] xl:text-[15px] hover-shadow-md" data-bs-toggle="modal" data-bs-target="#form-rating-review-{{$order->id}}" style="background-color: #ffffff">
                          Rating & Review
                        </button>
                        <button type="submit" class="btn border rounded-sm w-fit text-white text-[9px] md:text-[11px] lg:text-[13px] xl:text-[15px] hover-shadow-md" style="background-color: #183018">
                          Beli Lagi
                        </button>
                      @endif
                    </div>
                  </div>

                </div>
              </div>
              <!-- END DONE -->
              
              <!-- DETAIL TRANSAKSI -->
              <div class="modal fade" id="transaction-detail-{{ $order->invoice->no_invoice }}" tabindex="-1" aria-labelledby="transaction-detail-{{ $order->invoice->no_invoice }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content overflow-y-auto" style="max-height:90vh;">

                    <div class="modal-body overflow-y-auto" style="max-height:100vh;">
                      <div class="row gap-2 gap-lg-0">
                        <div class="col-12 col-lg-5 pl-lg-0 d-lg-none d-block">
                          <div class="grid p-1 p-md-2 p-lg-3 custom-shadow rounded-sm position-sticky" style="top: 0.1rem;">
                            <div class="col-12 p-0 border-bottom">
                              <p class="text-black text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">Riwayat Pengiriman</p>
                              <div class="track">
                                <div class="step {{ $order->status == 'waiting confirm' || $order->status == 'in process' || $order->status == 'in delivery' || $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-check"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Pesanan Dikonfirmasi</span>
                                </div>
                                <div class="step {{ $order->status == 'in delivery' || $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-user"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Pesanan Diambil Kurir</span>
                                </div>
                                <div class="step {{ $order->status == 'in delivery' || $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-truck"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Dalam Pengiriman</span>
                                </div>
                                <div class="step {{ $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-box"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Pesanan Selesai</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-lg-7">
                          <div class="grid p-3 custom-shadow rounded-sm">
                            <div class="col-12 p-0 pb-2 border-bottom">
                              <div class="d-flex">
                                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">No. Invoice</p>
                                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] ml-auto">{{ $order->invoice->no_invoice }}</p>
                              </div>
                              <div class="d-flex">
                                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Tanggal Pembelian</p>
                                <p class="text-[10px] md:text-[12px] lg:text-[12px] xl:text-[14px] ml-auto">{{ $order->created_at->format('d F Y, H:i') }}</p>
                              </div>
                            </div>
                            <div class="col-12 p-0 border-bottom">
                              <p class="text-black text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] mb-2 mb-md-3 pt-2 pt-md-3">Detail Produk</p>
                              
                              @foreach ($order->items as $item)
                                <div class="d-flex mb-2 md:mb-4 lg:md-4 xl:md-4">
                                  <div class="col-2 col-md-2 p-0 m-0">
                                    <img class="border" src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->product_name }}">    
                                  </div>
                                  <div class="col-6 col-md-7 gap-4">
                                    <div class="d-flex align-items-center mb-2 gap-1 max-w-[40px] max-w-md-[50px]">
                                      
                                      <p class="text-black mb-0 text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $item->product->brand->name }}</p>
                                    </div>
                                    <p class="text-black text-[8px] md:text-[8px] lg:text-[10px] xl:text-[12px]">{{ $item->product->product_name }}</p>
                                    <p class="text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                  </div>
                                  <div class="col-4 col-md-3 d-flex flex-column align-items-start justify-content-center border-left">
                                    <p class="text-black font-semibold text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Total Harga</p>
                                    <p class="text-black text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>  
                                  </div>
                                </div>
                              @endforeach

                            </div>

                            <!-- INFO PENGIRIMAN -->
                            <div class="col-12 p-0 border-bottom">
                              <p class="text-black text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] mb-2 mb-md-3 pt-2 pt-md-3">Info Pengiriman</p>
                              <div class="d-flex mb-1 mb-md-2">
                                <p class="col-2 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Kurir</p>
                                <p class="col-1 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">:</p>
                                <p class="text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">JNE</p>
                              </div>
                              <div class="d-flex mb-1 mb-md-2">
                                <p class="col-2 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">No.Resi</p>
                                <p class="col-1 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">:</p>
                                <p class="text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">082723615</p>
                              </div>
                              <div class="d-flex mb-1 mb-md-2">
                                <p class="col-2 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Alamat</p>
                                <p class="col-1 text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">:</p>
                                  <div class="grid gap-1">
                                    <p class="font-semibold text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $order->shippingAddress->label }}</p>
                                    <p class="text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Penerima : {{ $order->shippingAddress->recipient_name }}</p>
                                    <p class="text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $order->shippingAddress->handhphone }}</p>
                                    <p class="text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $order->shippingAddress->address }} 
                                      @if ($order->shippingAddress->benchmark !== NULL)
                                        ({{ $order->shippingAddress->benchmark }})
                                      @endif
                                    </p>
                                    <p class="text-[9px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{  ucwords(strtolower($order->shippingAddress->province)) }}, {{  ucwords(strtolower($order->shippingAddress->regency)) }}, {{  ucwords(strtolower($order->shippingAddress->district)) }}</p>
                                  </div>
                              </div>
                            </div>
                            <!--  -->

                            <!-- RINCIAN PEMBAYARAN -->
                            <div class="col-12 p-0">
                              <p class="text-black text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px] pt-2 pt-md-3">Rincian Pembayaran</p>
                                <div class="p-3 bg-light grid gap-2 gap-md-3">
                                    <div class="grid">
                                        <div class="d-flex">
                                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Total Harga ({{ count($order->items) }} Barang)</p>
                                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] ml-auto">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                        </div>
                                        @if ($order->voucher_promo !== NULL)
                                        <div class="d-flex">
                                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Total Diskon</p>
                                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] ml-auto">-Rp{{ number_format($order->discount_amount, 0, ',', '.') }}</p>
                                        </div>
                                        @endif
                                        <div class="d-flex">
                                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Total Ongkos Kirim</p>
                                            <p class="text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px] ml-auto">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex py-2 border-bottom border-top align-items-center">
                                        <p class="text-black text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Total Belanja</p>
                                        <p class="text-black font-semibold text-[12px] md:text-[12px] lg:text-[14px] xl:text-[14px] ml-auto">Rp{{ number_format(($order->total_amount+$order->shipping_cost), 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-lg-5 pl-lg-0 d-none d-lg-block">
                          <div class="grid p-1 p-md-2 p-lg-3 custom-shadow rounded-sm position-sticky" style="top: 0.1rem;">
                            <div class="col-12 p-0 border-bottom">
                              <p class="text-black text-[12px] md:text-[14px] lg:text-[16px] xl:text-[18px]">Riwayat Pengiriman</p>
                              <div class="track">
                                <div class="step {{ $order->status == 'waiting confirm' || $order->status == 'in process' || $order->status == 'in delivery' || $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-check"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Pesanan Dikonfirmasi</span>
                                </div>
                                <div class="step {{ $order->status == 'in delivery' || $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-user"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Pesanan Diambil Kurir</span>
                                </div>
                                <div class="step {{ $order->status == 'in delivery' || $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-truck"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Dalam Pengiriman</span>
                                </div>
                                <div class="step {{ $order->status == 'done' ? 'active' : '' }}">
                                    <span class="icon"> <i class="fa fa-box"></i> </span>
                                    <span class="text text-[10px] md:text-[12px] lg:text-[9px] xl:text-[10px]">Pesanan Selesai</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- END DETAIL TRANSAKSI -->

              @if ($order->status == 'done')
              <!-- RATING & REVIEW -->
              <div class="modal fade" id="form-rating-review-{{$order->id}}" tabindex="-1" aria-labelledby="form-rating-review-{{$order->id}}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content overflow-y-auto custom-scroll" style="max-height:90vh;">
                    <div class="modal-header pb-0 border-none">
                      <h1 class="modal-title text-[#183018]" id="exampleModalLabel">Ulasan Produk</h1>
                      <button type="button" class="btn-close" style="color:#183018;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body overflow-y-auto" style="max-height:100vh;">
                      <div class="col-12 p-0">
                        <form action="{{ route('rating.and.review') }}" method="POST" id="review-and-rating-form-{{$item->product->id}}" multiple accept="image/*,video/*">
                        @csrf
                          @foreach ($order->items as $item)
                          <input type="number" name="ratingReviewOrderId" value="{{ $order->id }}" hidden>
                          <input type="number" name="ratingReviewProductId[]" id="productId-{{$order->id}}-{{$item->product->id}}" value="{{ $item->product->id }}" hidden>
                          <div class="grid pb-4">
                            <div class="d-flex mb-1">
                              <div class="col-2 col-md-2 p-0 m-0">
                                <img class="border" src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->product_name }}">    
                              </div>
                              <div class="col-10">
                                <div class="d-flex align-items-center mb-2 gap-1 max-w-[40px] max-w-md-[50px]">
                                  <p class="font-semibold text-black mb-0 text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $item->product->brand->name }}</p>
                                </div>
                                <p class="text-black text-[8px] md:text-[10px] lg:text-[10px] xl:text-[12px]">{{ $item->product->product_name }}</p>
                                <div>
                                  <p class="text-[12px] md:text-[10px] lg:text-[10px] xl:text-[12px] mb-1">Berikan ulasan untuk produk ini</p>
                                  <div class="grid gap-1">
                                    <!-- RATING -->
                                    <div class="d-flex align-items-center p-0 gap-2">
                                      @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star" id="star-{{ $i }}-{{ $item->product->id }}-{{$order->id}}" style="width:20px;height:20px;">
                                        </i>
                                      @endfor
                                      <input type="number" name="star[{{$item->product->id}}]" id="star-product-{{$item->product->id}}-{{$order->id}}" value="">
                                    </div>
                        
                                    <!-- REVIEW -->
                                    <div class="col-12 p-0">
                                      <textarea name="description[{{$item->product->id}}]" class="form-control rounded-lg border border-[#183018] text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" name="address" rows="3"  autocomplete="off"  placeholder="Ceritakan Pengalamanmu Tentang Produk ini" required></textarea>
                                    </div>
    
                                    <p class="text-[12px] md:text-[10px] lg:text-[10px] xl:text-[12px]">Bagikan foto-foto dari produk yang Anda terima</p>
                                    
                                    <!-- UPLOAD IMAGE -->
                                    <div>
                                      <div id="mediaPreview-{{$order->id}}-{{$item->product->product_name}}" class="media-preview flex">
                                          <!-- Previews will be inserted here -->
                                      </div>
                                      <div data-mdb-ripple-init class="btn btn-primary w-max-[50px]">
                                          <label class="form-label text-white text-xs hover:cursor-pointer" for="customFile-{{ $order->id }}-{{$item->product->product_name}}">Upload Gambar</label>
                                          <!-- <input type="file"  id="customFile-{{ $order->id }}-{{$item->product->product_name}}" name="upload[{{$item->product->id}}][]" multiple 
                                          onchange="displaySelectedMedia(event, 'mediaPreview-{{$order->id}}-{{$item->product->product_name}}')" /> -->
                                          <input type="file" name="upload[{{$item->product->id}}][]" multiple accept="image/*,video/*" class="form-control d-none" onchange="displaySelectedMedia(event, 'mediaPreview-{{$order->id}}-{{$item->product->product_name}}')" id="customFile-{{ $order->id }}-{{$item->product->product_name}}">

                                        </div>
                                        <input type="file" name="test_file[]" id="tes-{{$item->product->id}}">
                                    </div>
                        
                                    <!-- BUTTON SUBMIT -->
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                          @endforeach
                          <div class="col-12 p-0">
                            <button class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[10px] xl:text-[12px]" type="submit"  style="background-color: #183018">Selesai</button>
                          </div>
                        </form>
                      </div>



                    </div>
                  </div>
                </div>
              </div>
              <!-- END RATING & REVIEW -->
              @endif


              @endforeach

          </div>
          <!-- CARD -->
        </div>
      </div>
      <!-- END MY ORDER -->

      <!-- WHISHLIST -->
      <div class="tab-pane fade" id="my-wishlist" style="min-height:80vh;">
        <div class="col-12">
          <div class="row">
            @foreach ($profile->wishlist as $wp)
            <div class="col-lg-2 col-md-3 col-6 p-1">
              <div class="bg-white rounded-lg shadow-sm overflow-hidden product-item border border-xl" style="min-height:325px; max-height:325px;">
                <a href="/{{ $wp->product->product_code }}_product" class="text-decoration-none">
                    <div class="position-relative overflow-hidden bg-transparent p-0">
                        <img class="img-fluid w-100 rounded-md pb-1 md:pb-2 lg:pb-2 xl:pb-2" src="{{ Storage::url($wp->product->main_image) }}" alt="{{ $wp->product->product_name}}">
                    </div>
                    <div class="grid gap-1 text-left p-2">
                        <div class="flex">
                            <div class="flex gap-1">
                                <i class="text-decoration-none fas fa-star text-[8px] md:text-[14px] lg:text-[16px] xl:text-[16px]" style="color:orange;"></i>
                                <p class="text-decoration-none text-black text-[8px] md:text-[12px] lg:text-[14px] xl:text-[14px]">5</p>
                            </div>
                            <div class="ml-auto">
                              <a href="javascript:void(0);" class="col-4 text-decoration-none text-[#183018] p-0 text-[10px] md:text-[12px] lg:text-[10px] xl:text-[12px] grid hover-[#183018] text-center" onclick="removeFromWishlist({{$wp->product->id}})">
                                <i class="fas fa-heart"></i> Hapus
                              </a>
                            </div>
                        </div>
                          <div class="grid name-price hover:cursor-pointer">
                            <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="{{ $wp->product->product_name }}">

                                <a href="/{{ $wp->product->product_code }}_product" 
                                    class="text-decoration-none">
                                    {{ Str::limit($wp->product->product_name, 20) }}
                                </a>
                            </p>

                            <div class="flex justify-content-start gap-1">
                                <p class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px] text-primary">
                                    Rp {{ number_format($wp->product->regular_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-content-between px-2">
                      @if ($wp->product->stock_quantity == 0)
                        <a class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-danger text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red">
                          Maaf Stok Habis
                        </a>
                      @else
                        @php
                          $inCart = collect($profile->cartItems)->contains('product_id', $wp->product->id);
                        @endphp
                        @if($inCart)
                          <a href="/cart" class="mb-2 py-2 rounded-sm border border-[#183018] shadow-sm w-full bg-[#183018] text-decoration-none text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[10px] flex gap-1 align-items-center justify-content-center hover-red">
                              Cek Keranjang Belanjamu
                          </a>
                        @else
                          <a href="javascript:void(0);" class="mb-2 py-2 rounded-sm border border-[#183018] hover:border-white shadow-sm w-full hover:bg-[#183018] text-decoration-none text-[#183018] hover:text-white p-0 text-[7px] md:text-[12px] lg:text-[10px] xl:text-[12px] flex gap-1 align-items-center justify-content-center hover-red" onclick="addToCart({{$wp->product->id}})">
                              + <i class="fas fa-shopping-cart"></i> Keranjang
                          </a>
                        @endif
                      @endif
                    </div>
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- END WHISLIST -->

      <!-- PAYMENT WAITING -->
      <div class="tab-pane fade" id="payment-waiting" style="min-height:80vh;">
        <div class="col-12 p-2">
          <div class="p-2 p-md-3 p-lg-3 p-xl-3 rounded-sm custom-shadow">
              <div class="row align-items-center mb-2 mb-md-3 border-bottom pb-2 pb-md-3">
                <div class="col-md-6 col-12">
                  <p class="text-black mb-0 text-[7px] md:text-[11px] lg:text-[13px] xl:text-[15px]">Belanja - 2 September</p>
                </div>
                <div class="col-md-6 col-12 text-start text-md-end  text-lg-end  text-xl-end text-red-800">
                  <p class="text-[7px] md:text-[11px] lg:text-[13px] xl:text-[15px]">Bayar Sebelum, 3 September 2024 17:00 WIB</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 col-8">
                  <div class="d-flex align-items-center gap-2">
                    <p class="text-black mb-0 text-[7px] md:text-[9px] lg:text-[13px] xl:text-[15px]">Nama Barang </p>
                    <p class="text-black mb-0 text-[7px] md:text-[9px] lg:text-[13px] xl:text-[15px]">| 2 Pcs</p>
                  </div>
                </div>

                <div class="row col-md-8 col-4 p-0 gap-2 gap-md-0 gap-lg-0 gap-xl-0">
                  <div class="col-md-4 col-12 p-0">
                    <div class="grid align-items-center">
                      <p class="text-black font-semibold mb-0 text-[6px] md:text-[9px] lg:text-[13px] xl:text-[15px]">Payment Method</p>
                      <p class="text-black mb-0 text-[6px] md:text-[9px] lg:text-[13px] xl:text-[15px]">BCA Virtual Account</p>
                    </div>
                  </div>

                  <div class="col-md-4 col-12 p-0">
                    <div class="grid align-items-center">
                      <p class="text-black font-semibold mb-0 text-[7px] md:text-[9px] lg:text-[13px] xl:text-[15px]">Virtual Account Number</p>
                      <p class="text-black mb-0 text-[7px] md:text-[9px] lg:text-[13px] xl:text-[15px]">8077708979243010</p>
                    </div>
                  </div>

                  <div class="col-md-4 col-12 p-0">
                    <div class="grid align-items-center">
                      <p class="text-black font-semibold mb-0 text-[7px] md:text-[9px] lg:text-[13px] xl:text-[15px]">Total Price</p>
                      <p class="text-black mb-0 text-[7px] md:text-[9px] lg:text-[13px] xl:text-[15px]">Rp45.000</p>
                    </div>
                  </div>
                </div>
  
              </div>

          </div>
        </div>
      </div>
      <!-- END PAYMENT WAITING -->
    </div>
  </div>
</div>

<!-- MODAL TAMBAH ALAMAT -->
<div class="modal fade" id="form-address" tabindex="-1" aria-labelledby="form-address" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content overflow-y-auto" style="max-height:90vh;">
      <div class="modal-header" style="background-color: #183018">
        <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">Tambahkan Alamat Baru</h1>
        <button type="button" class="btn-close" style="color:#FFFFFF;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body overflow-y-auto" style="max-height:100vh;">
        <form method="POST" action="{{ route('add.shipping.address')}}" id="add-address-form">
          @csrf
          <div class="grid gap-1 gap-md-2">
            <div class="col-12 p-0">
              <label for="label" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Label</label>
              <input type="text" class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="label" placeholder="Masukkan Nama Label Untuk Alamatmu" required>
            </div>
            <div class="col-12 p-0">
              <label for="receiver" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Nama Penerima</label>
              <input type="text" class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"  name="recipient_name" placeholder="Masukkan Nama Penerima" required>
            </div>
            <div class="col-12 p-0">
              <label for="handphone" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Handphone</label>
              <div class="input-group">
                <span class="input-group-text text-red-700 text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="basic-addon1">+62</span>
                <input type="number" class="form-control rounded-end text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="handphone" placeholder="Contoh : 8979254301" pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
              </div>
            </div>

            <div class="col-12 p-0">
              <label for="provinsi" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Provinsi</label>
              <select class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="Provinsi" name="province" id="address_province">
                <option class="text-primary text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Provinsi</option>
              </select>
              <input type="hidden" name="province_name" id="address_province_name">
            </div>

            <div class="col-12 p-0">
              <label for="kabupaten/kota" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kabupaten/Kota</label>
              <select class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="Kabupaten/Kota" name="regency" id="address_regency">
                <option class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Kabupaten/Kota</option>
              </select>
              <input type="hidden" name="regency_name" id="address_regency_name">
            </div>

            <div class="col-12 p-0">
              <label for="kecamatan" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kecamatan</label>
              <select class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="Kecamatan" name="district" id="address_district">
                <option class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Kecamatan</option>
              </select>
              <input type="hidden" name="district_name" id="address_district_name">
            </div>

            <!-- ALAMAT -->
            <div class="col-12 p-0">
              <label for="alamat" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Alamat</label>
              <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="address" rows="3" placeholder="Masukkan Alamatmu" required></textarea>
            </div>

            <!-- PATOKAN -->
            <div class="col-12 p-0">
              <label for="patokan" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Patokan (Opsional)</label>
              <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="benchmark" rows="3" placeholder="Contoh : Depan Warung Soto Ayam Jepang"></textarea>
            </div>
           
            <!-- BUTTON SUBMIT -->
            <div class="col-12 p-0">
              <button class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" type="submit"  style="background-color: #183018">Tambahkan</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- END MODAL TAMBAH ALAMAT -->

<!-- MODAL EDIT ALAMAT -->
<div class="modal fade" id="form-edit-address" tabindex="-1" aria-labelledby="form-edit-address" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content overflow-y-auto" style="max-height:90vh;">
      <div class="modal-header" style="background-color: #183018">
        <h1 class="modal-title text-white text-[12px] md:text-[12px] lg:text-[14px] xl:text-[16px]" id="exampleModalLabel">Ubah Data Alamatmu</h1>
        <button type="button" class="btn-close" style="color:#FFFFFF;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body overflow-y-auto" style="max-height:100vh;">
        <form id="editShippingAddressForm" method="POST" action="{{route('edit.shipping.address')}}">
          @csrf
          @method('PUT')
          <input type="number" class="form-control d-none rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="address-id">
          <div class="grid gap-1 gap-md-2">
            <div class="col-12 p-0">
              <label for="label" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Label</label>
              <input type="text" class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" placeholder="Masukkan Nama Label Untuk Alamatmu" name="label">
            </div>
            <div class="col-12 p-0">
              <label for="receiver" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Nama Penerima</label>
              <input type="text" class="form-control rounded-sm text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"  placeholder="Masukkan Nama Penerima" name="recipient_name">
            </div>
            <div class="col-12 p-0">
              <label for="handphone" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Handphone</label>
              <div class="input-group">
                <span class="input-group-text text-red-700 text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" id="basic-addon1">+62</span>
                <input type="number" class="form-control rounded-end text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" placeholder="Contoh : 8979254301" pattern="[0]{1}[8]{1}[0-9]{9,10}" name="handphone">
              </div>
            </div>

            <div class="col-12 p-0">
              <label for="provinsi" class="form-label text-black text-[12px] md:text-[12px] lg:text-[12px] xl:text-[14px]">Provinsi</label>
              <select class="form-select text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="Provinsi" name="province">
                <option class="text-primary text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Provinsi</option>
                <option value="Jawa Barat" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Jawa Barat</option>
                <option value="Jawa Tengah" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Jawa Tengah</option>
                <option value="Jawa Timur" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Jawa Timur</option>
              </select>
            </div>

            <div class="col-12 p-0">
              <label for="kabupaten/kota" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kabupaten/Kota</label>
              <select class="form-select text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="Kabupaten/Kota" name="regency">
                <option class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Kabupaten/Kota</option>
                <option value="Sidoarjo" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Sidoarjo</option>
                <option value="Surabaya" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Surabaya</option>
                <option value="Krian" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Krian</option>
              </select>
            </div>

            <div class="col-12 p-0">
              <label for="kecamatan" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kecamatan</label>
              <select class="form-select text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]" aria-label="Kecamatan" name="district">
                <option class="text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pilih Kecamatan</option>
                <option value="Sukodono" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Sukodono</option>
                <option value="Medaeng" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Medaeng</option>
                <option value="Taman"  class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Taman</option>
              </select>
            </div>

            <!-- ALAMAT -->
            <div class="col-12 p-0">
              <label for="alamat" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Alamat</label>
              <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="address" rows="3" placeholder="Masukkan Alamatmu"></textarea>
            </div>

            <!-- PATOKAN -->
            <div class="col-12 p-0">
              <label for="patokan" class="form-label text-black text-[12px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Patokan (Opsional)</label>
              <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="benchmark" rows="3" placeholder="Contoh : Depan Warung Soto Ayam Jepang"></textarea>
            </div>
           
            <!-- BUTTON SUBMIT -->
            <div class="col-12 p-0">
              <button class="btn btn-primary w-full rounded-sm text-white text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" type="submit" style="background-color: #183018">Perbarui</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- END MODAL EDIT ALAMAT -->

  @if(!Auth::check())
    <script>
        $(document).ready(function(){
            $('#login').modal('show');
        });
    </script>
  @endif

<!-- IMAGE HANDLER FOR RATING & REVIEW -->
<script>
  function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
  }

  function displaySelectedMedia(event, previewContainerId) {
    const previewContainer = document.getElementById(previewContainerId);
    const fileInput = event.target;
    const files = fileInput.files;
    
    const maxImages = 2;
    const maxVideos = 1;
    let imageCount = 0;
    let videoCount = 0;

    // Clear previous previews
    previewContainer.innerHTML = '';

    // Iterate through selected files
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileType = file.type;

        // Check if the file is an image
        if (fileType.startsWith('image/')) {
            if (imageCount >= maxImages) {
                // alert('You can only upload up to 2 images.');
                Toast.fire({
                  icon: "error",
                  text: "Anda hanya bisa mengupload 2 gambar ",
                  title: "Oops..",
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                });
                break;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-preview');
                img.style.maxWidth = '150px'; // Set image size
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
            imageCount++;
        }
        // Check if the file is a video
        else if (fileType.startsWith('video/')) {
            if (videoCount >= maxVideos) {
                alert('You can only upload 1 video.');
                Toast.fire({
                  icon: "error",
                  text: "Kamu hanya bisa mengupload 1 video",
                  title: "Oops..",
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                });
                break;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const video = document.createElement('video');
                video.src = e.target.result;
                video.controls = true;
                video.style.maxWidth = '150px'; // Set video size
                previewContainer.appendChild(video);
            };
            reader.readAsDataURL(file);
            videoCount++;
        }
        else {
            Toast.fire({
              icon: "error",
              text: "Kamu hanya bisa mengupload gambar dan video saja.",
              title: "Oops..",
              willOpen: () => {
                const title = document.querySelector('.swal2-title');
                const content = document.querySelector('.swal2-html-container');
                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
            });
        }
    }

    if (imageCount === 0 && videoCount === 0) {
        Toast.fire({
          icon: "error",
          text: "Masukkan minimal 1 review berupa foto atau video produk",
          title: "Oops..",
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
    }
  }

</script>

  <!-- LOGIC PROFILE FORM -->
  <script>
    $(document).ready(function() {
        let initialData = $('#profileForm').serialize();
        // console.log('Initial data:', initialData);

        $('#profileForm').on('input change', function() {
            let currentData = $(this).serialize();
            // console.log('Current data:', currentData);

            if (currentData !== initialData) {
                $('#submitBtn').prop('disabled', false);
                // console.log('Button enabled');
            } else {
                $('#submitBtn').prop('disabled', true);
                // console.log('Button disabled');
            }
        });
    });

  </script>

  <!-- EDIT FORM ADDRESS -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var editAddressModal = document.getElementById('form-edit-address');
      editAddressModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Tombol yang mengaktifkan modal
        var id = button.getAttribute('data-id');
        var label = button.getAttribute('data-label');
        var recipientName = button.getAttribute('data-recipient_name');
        var handphone = button.getAttribute('data-handphone');
        var province = button.getAttribute('data-province');
        var regency = button.getAttribute('data-regency');
        var district = button.getAttribute('data-district');
        var address = button.getAttribute('data-address');
        var benchmark = button.getAttribute('data-benchmark') == null ? "" : button.getAttribute('data-benchmark');

        var modalBody = editAddressModal.querySelector('.modal-body');

        modalBody.querySelector('[name="label"]').value = label;
        modalBody.querySelector('[name="recipient_name"]').value = recipientName;
        modalBody.querySelector('[name="handphone"]').value = handphone;
        modalBody.querySelector('[name="province"]').value = province;
        modalBody.querySelector('[name="regency"]').value = regency;
        modalBody.querySelector('[name="district"]').value = district;
        modalBody.querySelector('[name="address"]').value = address;
        modalBody.querySelector('[name="benchmark"]').value = benchmark;
        modalBody.querySelector('[name="address-id"]').value = id;
      });
    });
  </script>

  <!-- PERBARUI ALAMAT -->
  <!-- <script>
    document.getElementById('edit-address-form').addEventListener('submit', function (event) {
      event.preventDefault(); // Mencegah form dari submit default
      
      var formData = new FormData(this);
      var id = document.querySelector('[name="address-id"]').value;
      console.log(id);

      $.ajax({
          url: "{{ route('edit.shipping.address') }}",
          type: "PUT",
          data: {
            formData,
            _token: "{{ csrf_token() }}",
          },
          success: function (response) {
              if (response.success) {
                  Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                  }).then(function () {
                      window.location.href = "/"; // Redirect ke halaman utama atau halaman lain
                  });
              } else {
                  let errors = response.errors;
                  let errorMessages = response.message;
                  for (const key in errors) {
                      if (errors.hasOwnProperty(key)) {
                          errorMessages += errors[key][0] + "<br>";
                      }
                  }
                  Swal.fire("Error", errorMessages, "error");
              }
          },
          error: function (response) {
              Swal.fire("Error", "Failed to register", "error");
          },
      });


      
    });

  </script> -->

<!-- DELETE ADDRESS -->
<script>
  $(document).on('click', 'button[name="deleteAddress"]', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      
      $.ajax({
          url: "{{ route('delete.shipping.address') }}",
          type: 'POST',
          data: {
              address_id: id,
              _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            Toast.fire({
              icon: "success",
              text: response.message,
              title: "Berhasil",
              willOpen: () => {
                const title = document.querySelector('.swal2-title');
                const content = document.querySelector('.swal2-html-container');
                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
            }).then(function () {
              location.reload(); // Redirect ke halaman utama atau halaman lain
            });
          },
          error: function(xhr) {
            Toast.fire({
              icon: "error",
              text: "Kesalahan Sistem",
              title: "Oops..",
              willOpen: () => {
                const title = document.querySelector('.swal2-title');
                const content = document.querySelector('.swal2-html-container');
                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
            });
          }
      });
  });
</script>

<!-- SET MAIN ADDRESS -->
<script>
  $(document).on('click', 'button[name="setMainAddress"]', function(e) {
      e.preventDefault();
      var id = $(this).data('id'); // Ambil ID dari tombol yang diklik

      $.ajax({
          url: "{{ route('main.shipping.address') }}",  // Pastikan route ini di-render dengan benar
          type: 'POST',
          data: {
              address_id: id,  // Sesuaikan dengan request di controller
              _token: '{{ csrf_token() }}'  // Kirim token CSRF untuk keamanan
          },
          success: function(response) {
              if (response.success) {
                Toast.fire({
                  icon: "success",
                  text: response.message,
                  title: "Berhasil",
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                }).then(function () {
                  location.reload(); // Redirect ke halaman utama atau halaman lain
                });
              } else {
                Toast.fire({
                  icon: "error",
                  text: response.message,
                  title: "Oops..",
                  willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
                });
              }
          },
          error: function(xhr, status, error) {
            Toast.fire({
              icon: "error",
              text: "Gagal Mengubah Alamat",
              title: "Oops..",
              willOpen: () => {
                const title = document.querySelector('.swal2-title');
                const content = document.querySelector('.swal2-html-container');
                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
            });
          }
      });
  });
</script>

@if(session('after_add_address'))
<script>
  Toast.fire({
    icon: "success",
    text: "Berhasil menambahkan alamat pengiriman baru",
    title: "Berhasil",
    willOpen: () => {
      const title = document.querySelector('.swal2-title');
      const content = document.querySelector('.swal2-html-container');
      if (title) title.style.color = '#ffffff'; // Ubah warna judul
      if (content) content.style.color = '#ffffff'; // Ubah warna konten
    }
  });
</script>  
@endif


<!-- 
@if(session('after_update_address'))
  <script>
    Swal.fire({
      title: "Success",
      text: "Berhasil Mengubah Data Alamat Pengiriman",
      icon: "success",
    });
</script>  
@endif

@if(session('after_delete_address'))
  <script>
    Swal.fire({
      title: "Success",
      text: "Berhasil Menghapus Data Alamat Pengiriman",
      icon: "success",
    });
</script>  
@endif

-->
@if(session('after_update_profile'))
<script>
  Toast.fire({
    icon: "success",
    text: "Profilmu berhasil diubah",
    title: "Berhasil",
    willOpen: () => {
      const title = document.querySelector('.swal2-title');
      const content = document.querySelector('.swal2-html-container');
      if (title) title.style.color = '#ffffff'; // Ubah warna judul
      if (content) content.style.color = '#ffffff'; // Ubah warna konten
    }
  });
</script>  
@endif 

@if(session('success_send_email'))
<script>
    Toast.fire({
      icon: "success",
      text: "Link verifikasi email berhasil dikirim. Cek kotak emailmu sekarang",
      title: "Berhasil",
      willOpen: () => {
        const title = document.querySelector('.swal2-title');
        const content = document.querySelector('.swal2-html-container');
        if (title) title.style.color = '#ffffff'; // Ubah warna judul
        if (content) content.style.color = '#ffffff'; // Ubah warna konten
      }
    });
</script>  
@endif 

<!-- VERIFICATION EMAIL -->
<script>
  $(document).on("submit", "#email-verify-form", function (e) {
    e.preventDefault(); // Mencegah form dari submit secara default

    // Tampilkan loading
    Swal.fire({
      title: "Mengirim Email...",
      text: "Mohon tunggu sebentar.",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    $.ajax({
      url: "{{ route('verification.send') }}", // Route register di Laravel
      type: "POST",
      data: {
          _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
      },
      success: function (response) {
          Swal.close(); // Tutup loading

          if (response.success) {
            Toast.fire({
              icon: "success",
              text: response.message,
              title: "Berhasil",
              willOpen: () => {
                const title = document.querySelector('.swal2-title');
                const content = document.querySelector('.swal2-html-container');
                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
            });
          } else {
            let errors = response.errors;
            let errorMessages = "Email gagal dikirim. Coba lagi<br>";
            for (const key in errors) {
                if (errors.hasOwnProperty(key)) {
                    errorMessages += errors[key][0] + "<br>";
                }
            }
            Toast.fire({
              icon: "error",
              text: errorMessages,
              title: "Oops..",
              willOpen: () => {
                const title = document.querySelector('.swal2-title');
                const content = document.querySelector('.swal2-html-container');
                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
            });
          }
      },
      error: function (response) {
        Swal.close(); // Tutup loading

        Toast.fire({
          icon: "error",
          text: "Kesalahan Sistem",
          title: "Oops..",
          willOpen: () => {
            const title = document.querySelector('.swal2-title');
            const content = document.querySelector('.swal2-html-container');
            if (title) title.style.color = '#ffffff'; // Ubah warna judul
            if (content) content.style.color = '#ffffff'; // Ubah warna konten
          }
        });
      },
    });
  });
</script>


<!-- UNTUK CEK TAB ACCOUNT -->
<script>
  $(document).ready(function() {
    // Saat halaman dimuat, cek session untuk tab yang aktif terakhir
    $.ajax({
      url: "{{ route('get.active.tab') }}",
      type: 'GET',
      success: function(response) {
        if (response.activeTab) {
          // Jika ada, aktifkan tab tersebut
          $('.nav-tabs a[href="' + response.activeTab + '"]').addClass('active').tab('show');
          $(response.activeTab).addClass('active show');
        } else {
          // Jika tidak ada, secara default aktifkan tab pertama (My Profile)
          $('.nav-tabs a:first').addClass('active').tab('show');
          $('#my-profile').addClass('active show');
        }
      }
    });

    // Saat user klik tab, simpan ID tab ke session
    $('.nav-tabs a').on('click', function(e) {
      e.preventDefault();
      var tabId = $(this).attr('href');
      
      // Aktifkan tab yang diklik
      $(this).tab('show');

      // Simpan ke session
      $.ajax({
        url: "{{ route('set.active.tab') }}",
        type: 'POST',
        data: {
          tab_id: tabId,
          _token: '{{ csrf_token() }}'
        }
      });
    });
  });
</script>

<!-- API WILAYAH FOR ADDRESS -->
<script>
  fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
        .then((response) => response.json())
        .then((provinces) => {
            const provinceSelect = document.getElementById("address_province");

            provinces.forEach((province) => {
                let option = document.createElement("option");
                option.value = province.id;
                option.text = province.name;
                provinceSelect.appendChild(option);
            });
        })
        .catch((error) => console.error("Error fetching provinces:", error));

    // Event listener for province selection
    // PILIH PROVINSI
    document
        .getElementById("address_province")
        .addEventListener("change", function () {
            const provinceId = this.value;
            const provinceName = this.options[this.selectedIndex].text; // Get the name
            document.getElementById("address_province_name").value =
                provinceName; // Save name in hidden input

            const regencySelect = document.getElementById("address_regency");
            regencySelect.innerHTML =
                '<option value="">Pilih Kabupaten/Kota</option>';
            document.getElementById("address_regency_name").value = ""; // Clear previous regency name

            // GET DATA REGENCIES FROM PROVINCE
            if (provinceId) {
                fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`
                )
                    .then((response) => response.json())
                    .then((regencies) => {
                        regencies.forEach((regency) => {
                            let option = document.createElement("option");
                            option.value = regency.id;
                            option.text = regency.name;
                            regencySelect.appendChild(option);
                        });
                    })
                    .catch((error) =>
                        console.error("Error fetching regencies:", error)
                    );
            }
        });

    document
        .getElementById("address_regency")
        .addEventListener("change", function () {
            const regenciesId = this.value;
            const regenciesName = this.options[this.selectedIndex].text; // Get the name
            document.getElementById("address_regency_name").value =
                regenciesName; // Save name in hidden input

            const districtSelect = document.getElementById("address_district");
            districtSelect.innerHTML =
                '<option value="">Pilih Kecamatan</option>';
            document.getElementById("address_district_name").value = ""; // Clear previous regency name

            // GET DATA DISTRICT FROM REGENCY
            if (regenciesId) {
                fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regenciesId}.json`
                )
                    .then((response) => response.json())
                    .then((districts) => {
                        districts.forEach((district) => {
                            let option = document.createElement("option");
                            option.value = district.id;
                            option.text = district.name;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch((error) =>
                        console.error("Error fetching districts:", error)
                    );
            }
        });

    // Event listener for regency selection
    document
        .getElementById("address_regency")
        .addEventListener("change", function () {
            const regencyName = this.options[this.selectedIndex].text; // Get the name
            document.getElementById("address_regency_name").value = regencyName; // Save name in hidden input
        });

    // Event listener for district selection
    document
        .getElementById("address_district")
        .addEventListener("change", function () {
            const districtName = this.options[this.selectedIndex].text; // Get the name
            document.getElementById("address_district_name").value =
                districtName; // Save name in hidden input
        });
    // END API WILAYAH REGISTER
</script>

<!-- RATING STAR -->
<script>
  document.querySelectorAll('.fa-star').forEach(star => {
    let clickedStars = {}; // Object to store the last clicked star for each product
    
    star.addEventListener('click', function() {
        const starId = this.id.split('-');
        const clickedStar = parseInt(starId[1]);  // Get the star number
        const productId = starId[2];  // Get the product ID
        const orderId = starId[3];

        // Store the clicked star for this product
        clickedStars[productId] = clickedStar;
        console.log({
          'clickedStar' : clickedStar,
          'orderId'     : orderId, 
          'productId'   : productId,
        });

        $(`#star-product-${productId}-${orderId}`).val(clickedStar);

        // Change star color for the clicked product
        for (let i = 1; i <= 5; i++) {
            const currentStar = document.getElementById(`star-${i}-${productId}-${orderId}`);
            let valueStar = document.getElementById
            if (i <= clickedStar) {
                currentStar.style.color = 'orange';
            } else {
                currentStar.style.color = '';
            }
        }
    });
    
    // Handle hover logic
    star.addEventListener('mouseover', function() {
        const starId = this.id.split('-');
        const hoverStar = parseInt(starId[1]);  // Get the star number
        const productId = starId[2];  // Get the product ID
        const orderId = starId[3];

        // Change star color while hovering
        for (let i = 1; i <= 5; i++) {
            const currentStar = document.getElementById(`star-${i}-${productId}-${orderId}`);
            if (i <= hoverStar) {
                currentStar.style.color = 'orange';
            } else {
                currentStar.style.color = '';
            }
        }
    });

    // Reset star colors when the mouse leaves the star area
    star.addEventListener('mouseout', function() {
        const starId = this.id.split('-');
        const productId = starId[2];  // Get the product ID
        const orderId = starId[3];

        // Get the last clicked star for this product
        const lastClicked = clickedStars[productId] || 0;  // Default to 0 if none clicked

        for (let i = 1; i <= 5; i++) {
            const currentStar = document.getElementById(`star-${i}-${productId}-${orderId}`);
            if (i <= lastClicked) {
                currentStar.style.color = 'orange';  // Maintain color for previously clicked stars
            } else {
                currentStar.style.color = '';  // Reset color for stars that weren't clicked
            }
        }
    });
  });
</script>

@endsection


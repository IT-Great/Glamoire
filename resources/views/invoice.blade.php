@extends('user.layouts.master')

@section('content')
<style>
  @media print {
    .invoice {
      width: 210mm; /* A4 width */
      min-height: 297mm; /* A4 height */
      margin: 0 auto;
      padding: 20mm; /* Optional: add padding for print */
      box-shadow: none; /* Remove shadow on print */
    }

    /* Additional styles for print */
    .custom-shadow {
      box-shadow: none !important;
    }

    /* Hide elements you don’t want to show on print */
    .no-print {
      display: none !important;
    }
  }

  /* Ensure the invoice container does not overflow */
  .invoice {
    overflow: hidden; /* Optional: prevents content overflow */
  }

  .stamp {
    position: absolute;
    opacity: 0.1; /* Light opacity for a stamp effect */
    width: 840px; /* Adjust stamp size */
    height: auto;
  }
</style>

<div class="w-full flex align-items-end py-2 px-4 custom-shadow position-sticky" style="top:-0.1rem;background-color: #ffffff;z-index: 9;">
    <button class="ml-auto py-1 px-2 bg-[#183018] text-white rounded-md" onclick="printInvoice()">Cetak</button>
</div>

<div class="invoice flex justify-content-center align-items-center mt-4">
    <img src="images/stempel.png" alt="Lunas" class="stamp ">
    <div style="width:838px;min-height: 100vh;">
        <!-- HEADER -->
        <div class="flex">
            <div class="col-6 p-0">
                <img src="images/l-1.png" class="img-fluid" style="width: 138px; height: 56px;" alt="Logo Glamoire">
            </div>
            <div class="col-6 p-0 grid text-end">
                <p class="font-bold text-black text-lg p-0">INVOICE</p>
                <p class="text-xs text-danger p-0">{{ $invoice }}</p>
            </div>
        </div>

        <!-- INFO PEMBELI -->
        <div class="flex mt-8">
            <div class="col-5 p-0">
                <p class="text-xs text-black font-semibold">DITERBITKAN ATAS NAMA</p>
            </div>
            <div class="col-7 p-0">
                <p class="text-xs text-black font-semibold">UNTUK</p>
            </div>
        </div>

        <div class="flex">
            <div class="col-5 p-0 flex">
                <p class="text-xs pt-1">Penjual :</p>
                <p class="text-xs pt-1 text-black pl-1 font-semibold">Glamoire</p>
            </div>
            <div class="col-7 p-0">
                <div class="grid pt-1 gap-1">
                    <div class="flex">
                        <div class="col-4 p-0">
                            <p class="text-xs">Pembeli</p>
                        </div>
                        <div class="col-8 p-0">
                            <p class="text-xs text-black font-semibold">: {{ $order->user->fullname }}</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="col-4 p-0">
                            <p class="text-xs">Tanggal Pembelian</p>
                        </div>
                        <div class="col-8 p-0">
                            <p class="text-xs text-black font-semibold">: {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="col-4 p-0">
                            <p class="text-xs">Alamat Pengiriman </p>
                        </div>
                        <div class="col-8 p-0">
                            <p class="text-xs text-black font-semibold">:
                                {{ $order->shippingAddress->recipient_name }} ({{ $order->shippingAddress->handphone }})
                            </p>
                            <p class="text-xs text-black">
                                {{ $order->shippingAddress->address }}
                            </p>
                            @if ($order->shippingAddress->benchmark)
                            <p class="text-xs text-black">
                                ({{ $order->shippingAddress->benchmark }})
                            </p>
                            @endif
                            <p class="text-xs text-black">
                                {{ $order->shippingAddress->district }},
                                {{ $order->shippingAddress->regency }},
                                {{ $order->shippingAddress->province }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ITEMS -->
        <div class="mt-8">
            <div class="flex border-2 border-start-0 border-end-0 border-dark">
                <div class="col-7">
                    <p class="text-xs text-black font-semibold py-3">INFO PRODUK</p>
                </div>
                <div class="col-1 text-center p-0">
                    <p class="text-xs text-black font-semibold py-3">JUMLAH</p>
                </div>
                <div class="col-2 text-center p-0">
                    <p class="text-xs text-black font-semibold py-3">HARGA SATUAN</p>
                </div>
                <div class="col-2 text-end p-0">
                    <p class="text-xs text-black font-semibold py-3">TOTAL HARGA</p>
                </div>
            </div>
        </div>

        <div class="grid border-2 border-start-0 border-top-0 border-end-0">
            @foreach ($orderItem as $index => $item)
            <div class="flex">
                <div class="col-7 grid">
                    @if ($item->product_variant_id !== null)
                        <div>
                            <p class="text-xs text-black font-semibold pt-2">{{ $item->product->product_name }}</p>
                            <p class="text-xs text-black font-semibold">Varian {{ $item->productVariant->variant_value }}</p>
                        </div>
                        @else
                        <p class="text-xs text-black font-semibold py-3">{{ $item->product->product_name }}</p>
                    @endif
                </div>
                <div class="col-1 p-0 text-center">
                    <p class="text-xs text-black font-semibold py-3">{{ $item->quantity }}</p>
                </div>
                <div class="col-2 p-0 text-center">
                    <p class="text-xs text-black font-semibold py-3">Rp{{ number_format($item->price) }}</p>
                </div>
                <div class="col-2 p-0 text-end">
                    <p class="text-xs text-black font-semibold py-3">Rp{{ number_format($item->subtotal) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <!-- END ITEMS -->

        <!-- RINCIAN BIAYA -->
        <div class="mt-4 pb-3 border-2 border-start-0 border-top-0 border-end-0 border-dark">
            <div class="col-5 p-0 ml-auto grid gap-2">
                <div class="flex border-bottom-dashed pb-1">
                    <p class="text-xs font-semibold text-black">TOTAL HARGA ({{ $order->total_item }} BARANG)</p>
                    <p class="text-xs ml-auto text-black font-semibold">Rp{{ number_format($order->total_item_price) }}</p>
                </div>
                <div class="flex">
                    <p class="text-xs text-black">Total Ongkos Kirim</p>
                    <p class="text-xs ml-auto text-black">Rp{{ number_format($order->shipping_cost) }}</p>
                </div>
                @if ($order->discount_amount !== 0)
                <div class="flex">
                    <p class="text-xs text-black">Total Diskon Barang</p>
                    <p class="text-xs ml-auto text-black">-Rp{{ number_format($order->discount_amount) }}</p>
                </div>
                @endif
                @if ($order->discount_ongkir !== NULL)
                <div class="flex">
                    <p class="text-xs text-black">Total Diskon Ongkos Kirim</p>
                    <p class="text-xs ml-auto text-black">-Rp{{ number_format($order->discount_ongkir) }}</p>
                </div>
                @endif
                <div class="flex border-top-dashed pt-1">
                    <p class="text-xs font-semibold text-black">TOTAL BELANJA</p>
                    <p class="text-xs ml-auto text-black font-semibold">Rp{{ number_format($order->total_amount) }}</p>
                </div>
            </div>
        </div>

        <!-- METODE PEMBAYARAN -->
        <div class="grid">
            <p class="text-xs">Metode Pembayaran :</p>
            <p class="text-xs font-semibold text-black">{{ $payment->payment_method }}</p>
        </div>

        <!-- FOOTER -->
        <div class="flex flex-col mt-8">
            <p class="text-xs text-black">Invoice ini sah dan diproses oleh komputer� <br>Silakan hubungi Admin Glamoire apabila kamu membutuhkan bantuan.</p>
            <p class="text-xs text-black font-italic ml-auto mt-auto">Terakhir diupdate: {{ \Carbon\Carbon::parse($order->updated_at)->format('d F Y') }}</p>
        </div>
    </div>
</div>

<script>
    function printInvoice() {
        window.print(); // Trigger the browser's print dialog
    }
</script>
@endsection
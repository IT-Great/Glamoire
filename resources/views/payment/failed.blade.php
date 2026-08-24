@extends('user.layouts.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="text-center p-5 shadow-sm bg-white border" style="border-radius: 16px; max-width: 500px; width: 100%;">
            <div class="mb-4">
                <i class="fas fa-times-circle text-danger" style="font-size: 80px;"></i>
            </div>
            <h2 class="fw-bold mb-2" style="font-family: 'The Seasons', 'Poppins', serif; color: #DC2626;">Pembayaran Gagal
            </h2>
            <p class="text-muted mb-4">Maaf, pembayaran untuk pesanan
                <strong>{{ $order->invoice->no_invoice ?? 'Anda' }}</strong> gagal diproses, dibatalkan, atau waktu telah
                habis.</p>

            <div class="d-flex flex-column gap-3">
                <a href="/cart" class="btn btn-danger py-2 fw-bold" style="border-radius: 50px;">
                    <i class="fas fa-redo me-1"></i> Coba Belanja Lagi
                </a>
                <a href="/" class="btn btn-outline-dark py-2 fw-bold" style="border-radius: 50px;">
                    <i class="fas fa-home me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection

@extends('user.layouts.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="text-center p-5 shadow-sm bg-white border" style="border-radius: 16px; max-width: 500px; width: 100%;">
            <div class="mb-4">
                <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
            </div>
            <h2 class="fw-bold mb-2" style="font-family: 'The Seasons', 'Poppins', serif; color: #183018;">Pembayaran
                Berhasil!</h2>
            <p class="text-muted mb-4">Terima kasih! Pembayaran untuk pesanan
                <strong>{{ $order->invoice->no_invoice ?? 'Anda' }}</strong> telah kami terima dan pesanan akan segera
                diproses.</p>

            <div class="d-flex flex-column gap-3">
                <a href="/account" class="btn text-white py-2 fw-bold"
                    style="background-color: #183018; border-radius: 50px;">
                    <i class="fas fa-box-open me-1"></i> Lihat Pesanan Saya
                </a>
                <a href="/" class="btn btn-outline-dark py-2 fw-bold" style="border-radius: 50px;">
                    <i class="fas fa-home me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection

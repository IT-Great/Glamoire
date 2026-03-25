<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Retur Pesanan</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background-color: #183018; padding: 30px 20px; text-align: center; color: #D4AF37; }
        .header h1 { margin: 0; font-size: 24px; letter-spacing: 2px; text-transform: uppercase; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; font-size: 16px; }
        .content p { margin-bottom: 20px; }
        .status-box { padding: 15px; border-radius: 8px; font-weight: bold; text-align: center; margin-bottom: 20px; }
        .box-success { background-color: #D1FAE5; color: #065F46; border: 1px solid #10B981; }
        .box-danger { background-color: #FEE2E2; color: #991B1B; border: 1px solid #DC2626; }
        .order-info { background-color: #f3f4f6; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .footer { background-color: #f3f4f6; padding: 20px; text-align: center; color: #6b7280; font-size: 12px; border-top: 1px solid #e5e7eb;}
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Glamoire</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $order->user->fullname ?? 'Pelanggan Glamoire' }}</strong>,</p>

            <p>Berikut adalah informasi terbaru mengenai pengajuan pengembalian (retur) pesanan Anda.</p>

            @if($statusAction == 'approved')
                <div class="status-box box-success">
                    ✓ Pengajuan Retur Anda Telah DISETUJUI
                </div>
                <p>Tim kami telah memvalidasi bukti yang Anda lampirkan. Proses pengembalian dana atau penggantian barang akan segera diproses sesuai dengan kebijakan Glamoire. Mohon tunggu informasi selanjutnya dari tim Admin kami.</p>
            @else
                <div class="status-box box-danger">
                    ✕ Pengajuan Retur Anda DITOLAK
                </div>
                <p>Mohon maaf, setelah melakukan validasi, tim kami menolak pengajuan retur Anda karena tidak memenuhi syarat dan ketentuan pengembalian barang Glamoire. Status pesanan Anda saat ini tetap dianggap Selesai (Completed).</p>
            @endif

            <div class="order-info">
                <strong>Detail Pesanan:</strong><br>
                No. Invoice: {{ $order->invoice->no_invoice ?? '-' }}<br>
                Alasan Retur: <em>"{{ $order->return_reason }}"</em>
            </div>

            <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk membalas email ini atau menghubungi layanan pelanggan kami.</p>

            <p>Terima kasih,<br><strong>Tim Glamoire</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Glamoire. All rights reserved.
        </div>
    </div>
</body>
</html>

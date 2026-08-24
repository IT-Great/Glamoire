@extends('user.layouts.master')

@section('content')
<style>
    :root {
        --glamoire-dark: #183018;
        --glamoire-light: #F9FAFB;
        --text-main: #1F2937;
        --text-muted: #6B7280;
        --border-color: #E5E7EB;
        --danger-main: #DC2626;
        --transition-smooth: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    body { background-color: var(--glamoire-light); font-family: 'Poppins', sans-serif; }

    .premium-breadcrumb {
        background: #FFF; border-radius: 12px; padding: 0.75rem 1.5rem; margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .premium-breadcrumb a { color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.85rem; }
    .premium-breadcrumb .active-page { color: var(--glamoire-dark); font-weight: 600; font-size: 0.85rem; }

    /* Filter Tabs */
    .order-filter-wrapper {
        background: #FFF;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        margin-bottom: 1.5rem;
        overflow-x: auto;
        white-space: nowrap;
        border: 1px solid var(--border-color);
    }
    .order-filter-tabs {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .filter-tab-item {
        padding: 1rem 1.5rem;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: var(--transition-smooth);
    }
    .filter-tab-item:hover { color: var(--glamoire-dark); }
    .filter-tab-item.active {
        color: var(--glamoire-dark);
        border-bottom-color: var(--glamoire-dark);
    }

    /* Search Bar */
    .search-wrapper { margin-bottom: 1.5rem; position: relative; }
    .search-wrapper input {
        width: 100%; border-radius: 50px; padding: 0.8rem 1.5rem 0.8rem 3rem;
        border: 1px solid var(--border-color); font-size: 0.95rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .search-wrapper input:focus { border-color: var(--glamoire-dark); outline: none; box-shadow: 0 0 0 3px rgba(24,48,24,0.1); }
    .search-wrapper i { position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); }

    /* Order Card (Diambil dari yang lama) */
    .order-card { border: 1px solid var(--border-color); border-radius: 16px; margin-bottom: 1.5rem; background: #FFF; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); }
    .order-header { padding: 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .order-meta { display: flex; gap: 1.5rem; align-items: center; flex-wrap: wrap; }
    .order-meta-item span { display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600; margin-bottom: 2px; }
    .order-meta-item strong { font-size: 0.95rem; color: var(--text-main); }

    .order-status-badge { padding: 6px 16px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; white-space: nowrap; }
    .status-completed { background: #D1FAE5; color: #065F46; border: 1px solid #34D399; }
    .status-pending { background: #FEF3C7; color: #92400E; border: 1px solid #FBBF24; }
    .status-processing { background: #DBEAFE; color: #1E40AF; border: 1px solid #60A5FA; }
    .status-delivery { background: #E0E7FF; color: #3730A3; border: 1px solid #818CF8; }

    .order-body { padding: 1.5rem; }
    .order-item-row { display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px dashed var(--border-color); align-items: center; }
    .order-item-row:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
    .order-item-img { width: 90px; height: 90px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border-color); cursor: pointer; }
    .order-item-info { flex: 1; min-width: 200px; }
    .order-item-brand { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; }
    .order-item-name { font-size: 1.05rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.2rem; }
    .order-item-variant { font-size: 0.85rem; color: var(--text-muted); background: var(--glamoire-light); padding: 2px 8px; border-radius: 4px; display: inline-block; }
    .order-item-qty { font-size: 0.9rem; color: var(--text-main); font-weight: 500; }
    .order-item-price { text-align: right; min-width: 120px; }
    .order-item-price span { display: block; font-size: 0.8rem; color: var(--text-muted); }
    .order-item-price strong { font-size: 1.15rem; color: var(--text-main); }

    .order-footer { background: #FAFAFA; padding: 1.5rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
    .order-total-box span { font-size: 0.9rem; color: var(--text-muted); font-weight: 500; margin-right: 10px;}
    .order-total-box strong { font-size: 1.4rem; color: var(--danger-main); }

    .btn-glamoire { background: var(--glamoire-dark); color: #FFF; border: none; padding: 0.75rem 2rem; border-radius: 50px; font-weight: 600; font-size: 0.95rem; }
    .btn-outline-glamoire { background: transparent; color: var(--glamoire-dark); border: 1px solid var(--glamoire-dark); padding: 0.6rem 1.5rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-decoration: none;}
</style>

<div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">
    <div class="container-fluid">
        <div class="premium-breadcrumb">
            <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
            <span>/</span>
            <a href="/account">Profil Saya</a>
            <span>/</span>
            <span class="active-page">Riwayat Pesanan</span>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: var(--text-main); margin: 0;">Riwayat Pesanan</h2>
        </div>

        <!-- SEARCH BAR -->
        <form action="{{ route('user.orders') }}" method="GET" class="search-wrapper">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="Cari berdasarkan No. Invoice atau Nama Produk..." value="{{ request('search') }}">
        </form>

        <!-- FILTER TABS -->
        <div class="order-filter-wrapper">
            <ul class="order-filter-tabs">
                <li><a href="{{ route('user.orders', ['search' => request('search')]) }}" class="filter-tab-item {{ request('status') == '' ? 'active' : '' }}">Semua</a></li>
                <li><a href="{{ route('user.orders', ['status' => 'pending', 'search' => request('search')]) }}" class="filter-tab-item {{ request('status') == 'pending' ? 'active' : '' }}">Belum Dibayar</a></li>
                <li><a href="{{ route('user.orders', ['status' => 'processing', 'search' => request('search')]) }}" class="filter-tab-item {{ request('status') == 'processing' ? 'active' : '' }}">Diproses</a></li>
                <li><a href="{{ route('user.orders', ['status' => 'delivery', 'search' => request('search')]) }}" class="filter-tab-item {{ request('status') == 'delivery' ? 'active' : '' }}">Dikirim</a></li>
                <li><a href="{{ route('user.orders', ['status' => 'completed', 'search' => request('search')]) }}" class="filter-tab-item {{ request('status') == 'completed' ? 'active' : '' }}">Selesai</a></li>
                <li><a href="{{ route('user.orders', ['status' => 'cancelled', 'search' => request('search')]) }}" class="filter-tab-item {{ request('status') == 'cancelled' ? 'active' : '' }}">Dibatalkan</a></li>
                <li><a href="{{ route('user.orders', ['status' => 'returned', 'search' => request('search')]) }}" class="filter-tab-item {{ request('status') == 'returned' ? 'active' : '' }}">Retur/Gagal</a></li>
            </ul>
        </div>

        <!-- ORDER LIST -->
        @if ($orders->count() > 0)
            @foreach ($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-meta">
                            <div class="order-meta-item d-none d-md-block">
                                <span>Tanggal Pesanan</span>
                                <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong>
                            </div>
                            <div class="order-meta-item">
                                <span>No. Invoice</span>
                                <strong class="text-danger" style="cursor: pointer; text-decoration: underline;" onclick="invoice('{{ str_replace('/', '', $order->invoice->no_invoice) }}')">{{ $order->invoice->no_invoice }}</strong>
                            </div>
                        </div>
                        <div>
                            @php
                                $statusText = '';
                                $statusClass = '';
                                if ($order->return_status !== null) {
                                    if ($order->return_status == 'requested') {
                                        $statusText = 'Menunggu Validasi Retur';
                                        $statusClass = 'bg-warning text-dark';
                                    } elseif ($order->return_status == 'approved') {
                                        $statusText = 'Retur Disetujui';
                                        $statusClass = 'bg-success text-white';
                                    } elseif ($order->return_status == 'rejected') {
                                        $statusText = 'Retur Ditolak';
                                        $statusClass = 'bg-danger text-white';
                                    }
                                } else {
                                    switch ($order->status) {
                                        case 'completed': $statusText = 'Selesai'; $statusClass = 'status-completed'; break;
                                        case 'pending': $statusText = 'Menunggu Pembayaran'; $statusClass = 'status-pending'; break;
                                        case 'processing': $statusText = 'Sedang Diproses'; $statusClass = 'status-processing'; break;
                                        case 'delivery': $statusText = 'Dalam Pengiriman'; $statusClass = 'status-delivery'; break;
                                        case 'cancelled': $statusText = 'Dibatalkan'; $statusClass = 'bg-danger text-white'; break;
                                        case 'returned': $statusText = 'Dikembalikan'; $statusClass = 'bg-warning text-dark'; break;
                                        case 'failed': $statusText = 'Pembayaran Gagal'; $statusClass = 'bg-danger text-white'; break;
                                        default: $statusText = 'Unknown'; $statusClass = 'bg-secondary text-white';
                                    }
                                }
                            @endphp
                            <span class="order-status-badge {{ $statusClass }}">{{ $statusText }}</span>
                        </div>
                    </div>

                    <div class="order-body">
                        @foreach ($order->items as $item)
                            @if ($item->product)
                                <div class="order-item-row" onclick="{{ $item->product_variant_id ? "detailProductVariant('{$item->product->product_code}', '{$item->productVariant->sku}')" : "detailProduct('{$item->product->product_code}')" }}">
                                    @php
                                        $imageUrl = $item->product->main_image;
                                        if ($item->product_variant_id && $item->productVariant && !empty($item->productVariant->variant_image)) {
                                            $imageUrl = $item->productVariant->variant_image;
                                        }
                                    @endphp
                                    <img class="order-item-img" src="{{ Storage::url($imageUrl) }}" alt="Product Image">
                                    <div class="order-item-info">
                                        <div class="order-item-brand">{{ $item->product->brand->name ?? 'Glamoire' }}</div>
                                        <div class="order-item-name">{{ $item->product->product_name }}</div>
                                        @if ($item->product_variant_id && $item->productVariant)
                                            <div class="order-item-variant">Varian: {{ $item->productVariant->variant_value }}</div>
                                        @endif
                                        <div class="order-item-qty">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="order-item-price">
                                        <span>Total Harga Item</span>
                                        <strong>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="order-footer">
                        <div class="order-total-box">
                            <span>Total Belanja:</span>
                            <strong>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                        </div>
                        <div class="order-actions d-flex gap-2 flex-wrap">
                            @if ($order->tracking !== null)
                                <a href="{{ $order->tracking }}" target="_blank" class="btn-outline-glamoire"><i class="fas fa-truck me-1"></i> Lacak Paket</a>
                            @endif

                            @if ($order->status == 'pending')
                                @php
                                    $expiryTime = \Carbon\Carbon::parse($order->created_at)->addMinutes(60);
                                    $isExpired = now()->greaterThan($expiryTime);
                                    $paymentUrl = session('payment_url_' . $order->id) ?? '#';
                                @endphp

                                @if (!$isExpired)
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge bg-warning text-dark countdown-timer" data-expiry="{{ $expiryTime->timestamp * 1000 }}" style="font-size: 0.9rem; padding: 0.5rem 1rem; border-radius: 50px;">
                                            <i class="far fa-clock"></i> <span class="time-left">Menghitung...</span>
                                        </span>
                                        <button class="btn btn-outline-danger" style="border-radius: 50px; font-weight: 600; font-size: 0.85rem;" onclick="cancelOrder('{{ $order->id }}')"><i class="fas fa-times me-1"></i> Batal</button>
                                        @if ($paymentUrl != '#')
                                            <a href="{{ $paymentUrl }}" class="btn-glamoire text-decoration-none" style="padding: 0.6rem 1.5rem;"><i class="fas fa-wallet me-1"></i> Bayar</a>
                                        @endif
                                    </div>
                                @else
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge bg-danger" style="padding: 0.5rem 1rem; border-radius: 50px;">Kadaluarsa</span>
                                        <button class="btn btn-outline-danger" style="border-radius: 50px; font-weight: 600; font-size: 0.85rem;" onclick="cancelOrder('{{ $order->id }}')"><i class="fas fa-times me-1"></i> Batalkan</button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- PAGINATION -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->withQueryString()->links() }}
            </div>

        @else
            <div class="order-card p-5 text-center border-0" style="background: transparent;">
                <img src="{{ asset('images/cart-empty.png') }}" alt="Kosong" style="width: 150px; opacity: 0.7; margin-bottom: 1rem;">
                <h4 style="font-weight: 700; color: var(--text-main);">Pesanan Tidak Ditemukan</h4>
                <p class="text-muted">Mungkin Anda belum melakukan pesanan atau gunakan kata kunci lain.</p>
                <a href="/shop" class="btn-glamoire mt-3 text-decoration-none">Mulai Belanja</a>
            </div>
        @endif

    </div>
</div>

<script>
    function invoice(invoiceId) { window.location.href = "/invoice-user_" + invoiceId; }
    function detailProduct(productCode) { window.location.href = "/" + productCode + "_product"; }
    function detailProductVariant(productCode, variantCode) { window.location.href = "/" + productCode + "_product?varian=" + variantCode; }

    function updateTimers() {
        $('.countdown-timer').each(function() {
            let expiryData = parseInt($(this).data('expiry'), 10);
            if (!expiryData) return;

            let distance = expiryData - new Date().getTime();
            if (distance < 0) {
                $(this).removeClass('bg-warning text-dark').addClass('bg-danger text-white').html('<i class="fas fa-times-circle"></i> Kadaluarsa');
                $(this).closest('div').find('.btn-glamoire').hide();
            } else {
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                $(this).find('.time-left').text((minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds));
            }
        });
    }
    setInterval(updateTimers, 1000);
    updateTimers();

    function cancelOrder(orderId) {
        Swal.fire({
            title: 'Batalkan Pesanan?',
            text: "Tindakan ini tidak dapat diurungkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DC2626',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }});
                $.ajax({
                    url: `/order/cancel/${orderId}`, type: 'POST', data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', response.message, 'error');
                        }
                    },
                    error: function() { Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error'); }
                });
            }
        });
    }
</script>
@endsection

@extends('user.layouts.master')

@section('content')
    @php
        $shippingAddresses = $profile->shippingAddress;
        $wishlist = $profile->wishlist;
    @endphp

    <style>
        /* ==========================================
               WORLD CLASS ACCOUNT DASHBOARD STYLING
               ========================================== */
        :root {
            --glamoire-dark: #183018;
            --glamoire-light: #F9FAFB;
            --glamoire-accent: #2A4D2A;
            --glamoire-gold: #D4AF37;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --danger-main: #DC2626;
            --success-main: #10B981;
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: var(--glamoire-light);
            font-family: 'Poppins', sans-serif;
        }

        /* --- Premium Breadcrumb --- */
        .premium-breadcrumb {
            background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 2rem;
            background-color: #FFF;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        }

        .premium-breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .premium-breadcrumb a:hover {
            color: var(--glamoire-dark);
        }

        .premium-breadcrumb span {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0 8px;
        }

        .premium-breadcrumb .active-page {
            color: var(--glamoire-dark);
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* --- Dashboard Layout --- */
        .account-wrapper {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        /* --- Sidebar Navigation (Desktop) --- */
        .account-sidebar {
            flex: 0 0 280px;
            background: #FFF;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 1.5rem 0;
            position: sticky;
            top: 90px;
        }

        .sidebar-user-info {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            background: var(--glamoire-sand);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            font-family: 'The Seasons', serif;
        }

        .user-details h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .user-details p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        .account-nav-tabs {
            display: flex;
            flex-direction: column;
            border: none;
        }

        .account-nav-tabs .nav-link {
            text-align: left;
            border: none;
            border-radius: 0;
            padding: 1rem 1.5rem;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            border-left: 3px solid transparent;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 12px;
            background: transparent;
        }

        .account-nav-tabs .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .account-nav-tabs .nav-link:hover {
            background: rgba(24, 48, 24, 0.03);
            color: var(--glamoire-dark);
        }

        .account-nav-tabs .nav-link.active {
            background: rgba(24, 48, 24, 0.05);
            color: var(--glamoire-dark);
            border-left-color: var(--glamoire-dark);
            font-weight: 600;
        }

        /* Mobile Tabs */
        @media (max-width: 991px) {
            .account-wrapper {
                flex-direction: column;
            }

            .account-sidebar {
                flex: 1;
                width: 100%;
                position: static;
                padding: 1rem 0;
            }

            .sidebar-user-info {
                display: none;
            }

            /* Sembunyikan avatar di mobile agar hemat tempat */
            .account-nav-tabs {
                flex-direction: row;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
                border-bottom: 1px solid var(--border-color);
            }

            .account-nav-tabs::-webkit-scrollbar {
                display: none;
            }

            .account-nav-tabs .nav-link {
                border-left: none;
                border-bottom: 2px solid transparent;
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }

            .account-nav-tabs .nav-link.active {
                border-left-color: transparent;
                border-bottom-color: var(--glamoire-dark);
                background: transparent;
            }
        }

        /* --- Content Area --- */
        .account-content {
            flex: 1;
            min-width: 0;
        }

        .dashboard-card {
            background: #FFF;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 2rem;
            margin-bottom: 1.5rem;
            border: 1px solid #FFF;
            /* Untuk transisi */
        }

        .dashboard-card-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-card-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Forms & Inputs --- */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #D1D5DB;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: var(--text-main);
            background: #FFF;
            transition: var(--transition-smooth);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--glamoire-dark);
            box-shadow: 0 0 0 3px rgba(24, 48, 24, 0.1);
            outline: none;
        }

        .input-group-text {
            background: var(--glamoire-light);
            border-color: #D1D5DB;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px 0 0 8px;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: var(--glamoire-light);
            opacity: 0.8;
            cursor: not-allowed;
        }

        .btn-glamoire {
            background: var(--glamoire-dark);
            color: #FFF;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-glamoire:hover:not(:disabled) {
            background: var(--glamoire-accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.2);
        }

        .btn-glamoire:disabled {
            background: #D1D5DB;
            cursor: not-allowed;
        }

        .btn-outline-glamoire {
            background: transparent;
            color: var(--glamoire-dark);
            border: 1px solid var(--glamoire-dark);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
        }

        .btn-outline-glamoire:hover {
            background: var(--glamoire-light);
        }

        /* --- Address Cards --- */
        .address-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .address-card:hover {
            border-color: var(--glamoire-dark);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04);
        }

        .address-card.is-main {
            border-color: var(--glamoire-dark);
            background: rgba(24, 48, 24, 0.02);
        }

        .address-badge {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: var(--glamoire-dark);
            color: #FFF;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .address-label {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .address-name {
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .address-phone {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .address-detail {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .address-actions {
            margin-top: auto;
            display: flex;
            gap: 10px;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }

        .btn-address-action {
            font-size: 0.85rem;
            font-weight: 600;
            background: transparent;
            border: none;
            padding: 0;
            color: var(--text-muted);
            transition: color 0.2s;
        }

        .btn-address-action:hover {
            color: var(--glamoire-dark);
        }

        .btn-address-delete:hover {
            color: var(--danger-main);
        }

        /* --- Order History Cards --- */
        .order-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .order-header {
            background: var(--glamoire-light);
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-meta {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .order-meta-item span {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
        }

        .order-meta-item strong {
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .order-status-badge {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .status-completed {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .status-processing {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .status-delivery {
            background: #E0E7FF;
            color: #3730A3;
        }

        .order-body {
            padding: 1.5rem;
        }

        .order-item-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px dashed var(--border-color);
        }

        .order-item-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .order-item-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .order-item-img:hover {
            transform: scale(1.05);
        }

        .order-item-info {
            flex-grow: 1;
            cursor: pointer;
        }

        .order-item-brand {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
        }

        .order-item-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.2rem;
        }

        .order-item-variant {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .order-item-qty {
            font-size: 0.85rem;
            color: var(--text-main);
            font-weight: 500;
        }

        .order-item-price {
            text-align: right;
        }

        .order-item-price span {
            display: block;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .order-item-price strong {
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .order-footer {
            background: #FAFAFA;
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .order-total-box span {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .order-total-box strong {
            font-size: 1.25rem;
            color: var(--danger-main);
            margin-left: 10px;
        }

        .order-actions {
            display: flex;
            gap: 10px;
        }

        /* Wishlist Grid (Reusing from Shop) */
        .premium-product-card {
            background: #FFF;
            border-radius: 12px;
            border: 1px solid #F3F4F6;
            overflow: hidden;
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .premium-product-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.06);
            transform: translateY(-5px);
            border-color: #E5E7EB;
        }

        .card-img-box {
            position: relative;
            padding-top: 100%;
            background: #FAFAFA;
            overflow: hidden;
            cursor: pointer;
        }

        .card-img-box img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .premium-product-card:hover .card-img-box img {
            transform: scale(1.08);
        }

        .card-info {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            cursor: pointer;
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
        }

        .price-current {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-top: auto;
        }

        .btn-remove-wishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--danger-main);
            z-index: 2;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-remove-wishlist:hover {
            background: var(--danger-main);
            color: #FFF;
            transform: scale(1.1);
        }

        /* Empty States */
        .empty-state-box {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-box img {
            max-width: 200px;
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        .empty-state-box h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .empty-state-box p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4 pb-5">

        <div class="container-fluid">
            <div class="premium-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                <span>/</span>
                <span class="active-page">Profil Saya</span>
            </div>
        </div>

        <div class="container-fluid">
            <div class="account-wrapper">

                <div class="account-sidebar">
                    <div class="sidebar-user-info">
                        <div class="user-avatar">
                            {{ strtoupper(substr($profile->fullname ?? $profile->name, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <h4>{{ $profile->fullname ?? $profile->name }}</h4>
                            <p>{{ $profile->email }}</p>
                        </div>
                    </div>

                    <div class="nav nav-tabs account-nav-tabs" role="tablist">
                        <a class="nav-link {{ empty(session('activeTab')) || session('activeTab') == '#my-profile' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#my-profile" role="tab">
                            <i class="far fa-user"></i> Data Diri
                        </a>
                        <a class="nav-link {{ session('activeTab') == '#shipping-address' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#shipping-address" role="tab">
                            <i class="fas fa-map-marker-alt"></i> Alamat Pengiriman
                        </a>
                        <a class="nav-link {{ session('activeTab') == '#my-order' ? 'active' : '' }}" data-bs-toggle="tab"
                            href="#my-order" role="tab">
                            <i class="fas fa-shopping-bag"></i> Riwayat Pesanan
                        </a>
                        <a class="nav-link {{ session('activeTab') == '#my-wishlist' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#my-wishlist" role="tab">
                            <i class="far fa-heart"></i> Produk Favorit
                        </a>
                    </div>
                </div>

                <div class="account-content tab-content">

                    <div class="tab-pane fade {{ empty(session('activeTab')) || session('activeTab') == '#my-profile' ? 'show active' : '' }}"
                        id="my-profile" role="tabpanel">
                        <div class="dashboard-card">
                            <div class="dashboard-card-header">
                                <h2>Informasi Data Diri</h2>
                            </div>

                            @if ($profile->email_verified_at == null)
                                <div class="alert alert-warning d-flex align-items-center justify-content-between p-3 rounded-3 mb-4 border-0"
                                    style="background-color: #FEF3C7; color: #92400E;">
                                    <div><i class="fas fa-exclamation-triangle me-2"></i> Email Anda belum diverifikasi.
                                        Verifikasi sekarang untuk mengubah data diri.</div>
                                    <form class="m-0 p-0" id="email-verify-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-dark fw-bold rounded-pill px-3">Kirim
                                            Link</button>
                                    </form>
                                </div>
                            @endif

                            <form id="profileForm" method="POST" action="{{ route('edit.account') }}">
                                @csrf
                                @method('PUT')
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="fullname"
                                            value="{{ $profile->fullname ?? $profile->name }}" {{ $profile->email_verified_at == null ? 'disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $profile->email }}" disabled
                                            readonly style="background-color: #F3F4F6;">
                                        <small class="text-muted" style="font-size: 0.75rem;"><i
                                                class="fas fa-lock me-1"></i> Email tidak dapat diubah</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nomor Handphone</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input type="tel" class="form-control" name="handphone"
                                                value="{{ $profile->handphone }}" pattern="[0]{1}[8]{1}[0-9]{9,10}"
                                                placeholder="08123456789" {{ $profile->email_verified_at == null ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label d-block">Jenis Kelamin</label>
                                        <div class="d-flex gap-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                                    value="male" {{ $profile->gender == 'male' ? 'checked' : '' }} {{ $profile->email_verified_at == null ? 'disabled' : '' }}>
                                                <label class="form-check-label" for="genderMale">Pria</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                                    value="female" {{ $profile->gender == 'female' ? 'checked' : '' }} {{ $profile->email_verified_at == null ? 'disabled' : '' }}>
                                                <label class="form-check-label" for="genderFemale">Wanita</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 pt-3 border-top">
                                        <button type="submit" class="btn-glamoire px-5" id="submitBtn" disabled>Simpan
                                            Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade {{ session('activeTab') == '#shipping-address' ? 'show active' : '' }}"
                        id="shipping-address" role="tabpanel">
                        <div class="dashboard-card">
                            <div class="dashboard-card-header">
                                <h2>Alamat Pengiriman</h2>
                                <button type="button" class="btn-glamoire py-2 px-3" style="font-size: 0.85rem;"
                                    data-bs-toggle="modal" data-bs-target="#form-address">
                                    <i class="fas fa-plus"></i> Tambah Alamat
                                </button>
                            </div>

                            @if (count($shippingAddresses) > 0)
                                <div class="row g-4">
                                    @foreach ($shippingAddresses as $sa)
                                        <div class="col-md-6">
                                            <div class="address-card {{ $sa->is_main ? 'is-main' : '' }}">
                                                @if ($sa->is_main)
                                                    <span class="address-badge">Utama</span>
                                                @endif

                                                <div class="address-label">{{ $sa->label }}</div>
                                                <div class="address-name">{{ $sa->recipient_name }}</div>
                                                <div class="address-phone"><i
                                                        class="fas fa-phone-alt me-2 text-muted"></i>{{ $sa->handphone }}</div>
                                                <div class="address-detail mt-2">
                                                    {{ $sa->address }}<br>
                                                    {{ ucwords(strtolower($sa->subdistrict)) }},
                                                    {{ ucwords(strtolower($sa->district)) }}<br>
                                                    {{ ucwords(strtolower($sa->regency)) }},
                                                    {{ ucwords(strtolower($sa->province)) }}
                                                    @if ($sa->benchmark)
                                                        <br><span class="text-muted fst-italic">(Patokan: {{ $sa->benchmark }})</span>
                                                    @endif
                                                </div>

                                                <div class="address-actions mt-3">
                                                    <button type="button" class="btn-address-action text-dark"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#form-edit-address-{{ $sa->id }}">Ubah</button>
                                                    <span class="text-muted mx-1">|</span>
                                                    @if (!$sa->is_main)
                                                        <button type="button" class="btn-address-action text-success"
                                                            name="setMainAddress" data-id="{{ $sa->id }}">Jadikan Utama</button>
                                                        <span class="text-muted mx-1">|</span>
                                                    @endif
                                                    <button type="button" class="btn-address-action btn-address-delete"
                                                        name="deleteAddress" data-id="{{ $sa->id }}">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state-box">
                                    <img src="{{ asset('images/about-2.png') }}" alt="Tidak ada alamat">
                                    <h4>Belum Ada Alamat</h4>
                                    <p>Tambahkan alamat pengiriman agar proses checkout lebih cepat.</p>
                                    <button type="button" class="btn-glamoire" data-bs-toggle="modal"
                                        data-bs-target="#form-address">Tambah Alamat Baru</button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade {{ session('activeTab') == '#my-order' ? 'show active' : '' }}" id="my-order"
                        role="tabpanel">
                        <div class="dashboard-card"
                            style="background: transparent; box-shadow: none; padding: 0; border: none;">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2
                                    style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin: 0;">
                                    Riwayat Pesanan</h2>
                            </div>

                            @if (count($profile->orders) > 0)
                                @foreach ($profile->orders->sortByDesc('created_at') as $order)
                                    <div class="order-card">
                                        <div class="order-header">
                                            <div class="order-meta">
                                                <div class="order-meta-item d-none d-md-block">
                                                    <span>Tanggal Pesanan</span>
                                                    <strong>{{ $order->created_at->format('d M Y, H:i') }}</strong>
                                                </div>
                                                <div class="order-meta-item">
                                                    <span>No. Invoice</span>
                                                    <strong class="text-danger" style="cursor: pointer; text-decoration: underline;"
                                                        onclick="invoice('{{ str_replace('/', '', $order->invoice->no_invoice) }}')">{{ $order->invoice->no_invoice }}</strong>
                                                </div>
                                            </div>
                                            <div>
                                                @php
                                                    $statusText = '';
                                                    $statusClass = '';
                                                    switch ($order->status) {
                                                        case 'completed':
                                                            $statusText = 'Selesai';
                                                            $statusClass = 'status-completed';
                                                            break;
                                                        case 'pending':
                                                            $statusText = 'Menunggu Konfirmasi';
                                                            $statusClass = 'status-pending';
                                                            break;
                                                        case 'processing':
                                                            $statusText = 'Sedang Diproses';
                                                            $statusClass = 'status-processing';
                                                            break;
                                                        case 'delivery':
                                                            $statusText = 'Dalam Pengiriman';
                                                            $statusClass = 'status-delivery';
                                                            break;
                                                        default:
                                                            $statusText = 'Unknown';
                                                            $statusClass = 'bg-secondary text-white';
                                                    }
                                                @endphp
                                                <span class="order-status-badge {{ $statusClass }}">{{ $statusText }}</span>
                                            </div>
                                        </div>

                                        <div class="order-body">
                                            @foreach ($order->items as $item)
                                                <div class="order-item-row"
                                                    onclick="{{ $item->product_variant_id ? "detailProductVariant('" . $item->product->product_code . "', '" . $item->productVariant->sku . "')" : "detailProduct('" . $item->product->product_code . "')" }}">
                                                    <img class="order-item-img"
                                                        src="{{ Storage::url($item->product_variant_id ? $item->productVariant->variant_image : $item->product->main_image) }}"
                                                        alt="Product Image">
                                                    <div class="order-item-info">
                                                        <div class="order-item-brand">{{ $item->product->brand->name }}</div>
                                                        <div class="order-item-name">{{ $item->product->product_name }}</div>
                                                        @if ($item->product_variant_id)
                                                            <div class="order-item-variant">Varian:
                                                                {{ $item->productVariant->variant_value }}</div>
                                                        @endif
                                                        <div class="order-item-qty">{{ $item->quantity }} x
                                                            Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                                                    </div>
                                                    <div class="order-item-price d-none d-md-block">
                                                        <span>Total Harga Item</span>
                                                        <strong>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="order-footer">
                                            <div class="order-total-box">
                                                <span>Total Belanja:</span>
                                                <strong>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="order-actions">
                                                @if ($order->tracking !== null)
                                                    <a href="{{ $order->tracking }}" target="_blank"
                                                        class="btn-outline-glamoire text-decoration-none">
                                                        <i class="fas fa-truck me-1"></i> Lacak Paket
                                                    </a>
                                                @endif

                                                @if ($order->status == 'completed')
                                                    @if (count($order->ratingAndReviews) == 0)
                                                        <button class="btn-outline-glamoire" data-bs-toggle="modal"
                                                            data-bs-target="#form-rating-review-{{ $order->id }}">Beri Ulasan</button>
                                                    @endif
                                                    <button class="btn-glamoire py-2 px-4" data-product-ids="{{ $order->id }}">Beli
                                                        Lagi</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="dashboard-card mt-0">
                                    <div class="empty-state-box">
                                        <img src="{{ asset('images/cart-empty.png') }}" alt="Belum ada pesanan"
                                            style="max-width: 150px;">
                                        <h4>Belum Ada Pesanan</h4>
                                        <p>Anda belum melakukan transaksi apapun. Yuk, mulai belanja sekarang!</p>
                                        <button class="btn-glamoire" onclick="location.href='/shop'">Mulai Belanja</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade {{ session('activeTab') == '#my-wishlist' ? 'show active' : '' }}"
                        id="my-wishlist" role="tabpanel">
                        <div class="dashboard-card"
                            style="background: transparent; box-shadow: none; padding: 0; border: none;">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2
                                    style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin: 0;">
                                    Produk Favorit</h2>
                            </div>

                            @if (count($wishlists) > 0)
                                <div class="row g-3 g-lg-4">
                                    @foreach ($wishlists as $wp)
                                        @php
                                            $activePromo = $wp->promos->first();
                                            $discountedPrice = $activePromo ? $activePromo->pivot->discounted_price : null;
                                        @endphp
                                        <div class="col-6 col-md-4 col-xl-3">
                                            <div class="premium-product-card"
                                                onclick="window.location.href = '/{{ $wp->product_code }}_product'">
                                                <div class="card-img-box">
                                                    <div class="btn-remove-wishlist" title="Hapus dari Favorit"
                                                        onclick="event.stopPropagation(); removeFromWishlist('{{$wp->id}}');">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </div>
                                                    <img src="{{ Storage::url($wp->main_image) }}" alt="{{ $wp->product_name }}">
                                                </div>
                                                <div class="card-info p-3">
                                                    <div class="rating-box mb-1"><i class="fas fa-star"></i>
                                                        <span>{{ $wp->rating ?? '5.0' }}</span></div>
                                                    <a href="/{{ $wp->product_code }}_product"
                                                        class="product-name fs-6">{{ $wp->product_name }}</a>
                                                    <div class="price-box">
                                                        @if ($wp->priceVariation !== null)
                                                            <span class="price-current fs-6">{{ $wp->priceVariation }}</span>
                                                        @else
                                                            @if ($discountedPrice && $discountedPrice < $wp->regular_price)
                                                                <span class="price-strike"
                                                                    style="font-size:0.75rem;">Rp{{ number_format($wp->regular_price, 0, ',', '.') }}</span>
                                                                <span
                                                                    class="price-current price-discounted fs-6">Rp{{ number_format($discountedPrice, 0, ',', '.') }}</span>
                                                            @else
                                                                <span
                                                                    class="price-current fs-6">Rp{{ number_format($wp->regular_price, 0, ',', '.') }}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="dashboard-card mt-0">
                                    <div class="empty-state-box">
                                        <i class="far fa-heart mb-3" style="font-size: 4rem; color: #D1D5DB;"></i>
                                        <h4>Wishlist Kosong</h4>
                                        <p>Anda belum menambahkan produk ke daftar favorit. Simpan produk incaran Anda di sini.
                                        </p>
                                        <button class="btn-glamoire" onclick="location.href='/shop'">Cari Produk</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="form-address" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header"
                    style="background: var(--glamoire-dark); color: white; border-radius: 16px 16px 0 0; padding: 1.25rem 1.5rem;">
                    <h5 class="modal-title fw-bold m-0" style="font-family: 'Poppins', sans-serif; font-size: 1.1rem;"><i
                            class="fas fa-map-marker-alt me-2"></i> Tambah Alamat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: invert(1); opacity: 0.8;"></button>
                </div>
                <div class="modal-body p-4 custom-scroll" style="max-height: 75vh; overflow-y: auto;">
                    <form method="POST" action="{{ route('add.shipping.address') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-dark">Label Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="label" placeholder="Cth: Rumah, Kantor, Kos"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark">Nama Penerima <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="recipient_name"
                                    placeholder="Nama lengkap penerima" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark">No. Handphone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-dark fw-normal">+62</span>
                                    <input type="number" class="form-control" name="handphone" placeholder="8123456789"
                                        pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark">Provinsi <span class="text-danger">*</span></label>
                                <select class="form-select" name="province" id="address_province" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <input type="hidden" name="province_name" id="address_province_name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark">Kota/Kabupaten <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="regency" id="address_regency" required>
                                    <option value="">Pilih Kota/Kab</< /option>
                                </select>
                                <input type="hidden" name="regency_name" id="address_regency_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select" name="district" id="address_district" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <input type="hidden" name="district_name" id="address_district_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark">Desa/Kelurahan <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="subdistrict" id="address_subdistrict" required>
                                    <option value="">Pilih Desa</option>
                                </select>
                                <input type="hidden" name="subdistrict_name" id="address_subdistrict_name">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark">Alamat Lengkap <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="3"
                                    placeholder="Nama jalan, gedung, no. rumah" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark">Patokan (Opsional)</label>
                                <input type="text" class="form-control" name="benchmark"
                                    placeholder="Cth: Samping minimarket">
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-glamoire w-100">Simpan Alamat</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($shippingAddresses as $sa)
        <div class="modal fade" id="form-edit-address-{{ $sa->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 16px; border: none;">
                    <div class="modal-header"
                        style="background: var(--glamoire-dark); color: white; border-radius: 16px 16px 0 0; padding: 1.25rem 1.5rem;">
                        <h5 class="modal-title fw-bold m-0" style="font-family: 'Poppins', sans-serif; font-size: 1.1rem;"><i
                                class="fas fa-edit me-2"></i> Ubah Alamat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            style="filter: invert(1); opacity: 0.8;"></button>
                    </div>
                    <div class="modal-body p-4 custom-scroll" style="max-height: 75vh; overflow-y: auto;">
                        <form method="POST" action="{{ route('edit.shipping.address') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="address-id" value="{{ $sa->id }}">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label text-dark">Label Alamat</label>
                                    <input type="text" class="form-control" name="label" value="{{ $sa->label }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-dark">Nama Penerima</label>
                                    <input type="text" class="form-control" name="recipient_name"
                                        value="{{ $sa->recipient_name }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-dark">No. Handphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-dark fw-normal">+62</span>
                                        <input type="number" class="form-control" name="handphone" value="{{ $sa->handphone }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Provinsi</label>
                                    <select class="form-select" name="province_change" id="province_change_{{ $sa->id }}"
                                        required>
                                        <option value="{{ $sa->id_province }}" selected>{{ $sa->province }}</option>
                                    </select>
                                    <input type="hidden" name="province_name" id="change_province_name_{{$sa->id}}"
                                        value="{{ $sa->province }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Kota/Kabupaten</label>
                                    <select class="form-select" name="regency_change" id="regency_change_{{ $sa->id }}"
                                        required>
                                        <option value="{{ $sa->regency }}" selected>{{ $sa->regency }}</option>
                                    </select>
                                    <input type="hidden" name="regency_name" id="change_regency_name_{{$sa->id}}"
                                        value="{{ $sa->regency }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Kecamatan</label>
                                    <select class="form-select" name="district_change" id="district_change_{{ $sa->id }}"
                                        required>
                                        <option value="{{ $sa->district }}" selected>{{ $sa->district }}</option>
                                    </select>
                                    <input type="hidden" name="district_name" id="change_district_name_{{$sa->id}}"
                                        value="{{ $sa->district }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Desa/Kelurahan</label>
                                    <select class="form-select" name="subdistrict_change" id="subdistrict_change_{{ $sa->id }}"
                                        required>
                                        <option value="{{ $sa->subdistrict }}" selected>{{ $sa->subdistrict }}</option>
                                    </select>
                                    <input type="hidden" name="subdistrict_name" id="change_subdistrict_name_{{$sa->id}}"
                                        value="{{ $sa->subdistrict }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-dark">Alamat Lengkap</label>
                                    <textarea class="form-control" name="address" rows="3"
                                        required>{{ $sa->address }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-dark">Patokan (Opsional)</label>
                                    <input type="text" class="form-control" name="benchmark" value="{{ $sa->benchmark }}">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn-glamoire w-100">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        $(document).ready(function () {
            // Form Profile Button State
            let initialData = $('#profileForm').serialize();
            $('#profileForm').on('input change', function () {
                let currentData = $(this).serialize();
                if (currentData !== initialData) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });

            // Tab State Management
            $.ajax({
                url: "{{ route('get.active.tab') }}",
                type: 'GET',
                success: function (response) {
                    if (response.activeTab) {
                        $('.account-nav-tabs a[href="' + response.activeTab + '"]').tab('show');
                    } else {
                        $('.account-nav-tabs a:first').tab('show');
                    }
                }
            });

            $('.account-nav-tabs a').on('click', function (e) {
                var tabId = $(this).attr('href');
                $.ajax({
                    url: "{{ route('set.active.tab') }}",
                    type: 'POST',
                    data: { tab_id: tabId, _token: '{{ csrf_token() }}' }
                });
            });

            // Delete Address
            $('button[name="deleteAddress"]').on('click', function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Alamat?',
                    text: "Alamat ini akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DC2626',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.shipping.address') }}",
                            type: 'POST',
                            data: { address_id: id, _token: '{{ csrf_token() }}' },
                            success: function (response) {
                                location.reload();
                            }
                        });
                    }
                });
            });

            // Set Main Address
            $('button[name="setMainAddress"]').on('click', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('main.shipping.address') }}",
                    type: 'POST',
                    data: { address_id: id, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        location.reload();
                    }
                });
            });
        });

        function detailProduct(productCode) { window.location.href = "/" + productCode + "_product"; }
        function detailProductVariant(productCode, variantCode) { window.location.href = "/" + productCode + "_product?varian=" + variantCode; }
        function invoice(invoiceId) { window.location.href = "/invoice-user_" + invoiceId; }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Logic Add Address API Wilayah
            fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                .then(res => res.json())
                .then(provinces => {
                    const provSelect = document.getElementById("address_province");
                    provinces.forEach(p => {
                        provSelect.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                    });
                });

            document.getElementById("address_province").addEventListener("change", function () {
                document.getElementById("address_province_name").value = this.options[this.selectedIndex].text;
                const regencySelect = document.getElementById("address_regency");
                regencySelect.innerHTML = '<option value="">Pilih Kota/Kab</option>';
                if (this.value) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`)
                        .then(res => res.json())
                        .then(data => data.forEach(r => regencySelect.innerHTML += `<option value="${r.id}">${r.name}</option>`));
                }
            });

            document.getElementById("address_regency").addEventListener("change", function () {
                document.getElementById("address_regency_name").value = this.options[this.selectedIndex].text;
                const distSelect = document.getElementById("address_district");
                distSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                if (this.value) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.value}.json`)
                        .then(res => res.json())
                        .then(data => data.forEach(d => distSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`));
                }
            });

            document.getElementById("address_district").addEventListener("change", function () {
                document.getElementById("address_district_name").value = this.options[this.selectedIndex].text;
                const subSelect = document.getElementById("address_subdistrict");
                subSelect.innerHTML = '<option value="">Pilih Desa</option>';
                if (this.value) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${this.value}.json`)
                        .then(res => res.json())
                        .then(data => data.forEach(v => subSelect.innerHTML += `<option value="${v.id}">${v.name}</option>`));
                }
            });

            document.getElementById("address_subdistrict").addEventListener("change", function () {
                document.getElementById("address_subdistrict_name").value = this.options[this.selectedIndex].text;
            });
        });
    </script>

@endsection
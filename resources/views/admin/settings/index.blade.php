<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Sistem - Glamoire Admin</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .page-title h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem 1.75rem;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-body {
            padding: 1.75rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        /* Nav Pills Styling untuk Menu Pengaturan */
        .nav-pills .nav-link {
            color: var(--text-secondary);
            border-radius: 10px;
            padding: 0.85rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .nav-pills .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(99, 102, 241, 0.05);
            color: var(--primary-color);
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }

        /* Form Styling */
        .form-label {
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            background-color: #fdfdfd;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.25rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .input-hint {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3 class="mb-2">Pengaturan Sistem</h3>
                            <p>Kelola preferensi toko, email, pembayaran, dan sistem secara keseluruhan</p>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                                        <i class="bi bi-grid-fill me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row slide-in">
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-general" type="button" role="tab"
                                        aria-controls="v-pills-general" aria-selected="true">
                                        <i class="bi bi-shop"></i> Umum & Toko
                                    </button>
                                    <button class="nav-link" id="v-pills-email-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-email" type="button" role="tab"
                                        aria-controls="v-pills-email" aria-selected="false">
                                        <i class="bi bi-envelope-paper"></i> Konfigurasi Email
                                    </button>
                                    <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-payment" type="button" role="tab"
                                        aria-controls="v-pills-payment" aria-selected="false">
                                        <i class="bi bi-credit-card"></i> Pembayaran (Prisma)
                                    </button>
                                    <button class="nav-link" id="v-pills-system-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-system" type="button" role="tab"
                                        aria-controls="v-pills-system" aria-selected="false">
                                        <i class="bi bi-shield-check"></i> Sistem & Keamanan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                        aria-labelledby="v-pills-general-tab">
                                        <h4 class="section-title">Informasi Umum Toko</h4>
                                        <form action="{{ route('admin.settings.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Toko/Website</label>
                                                    <input type="text" class="form-control" name="site_name"
                                                        value="{{ $settings['site_name'] ?? '' }}"
                                                        placeholder="Contoh: Glamoire Official">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Slogan (Tagline)</label>
                                                    <input type="text" class="form-control" name="site_tagline"
                                                        value="{{ $settings['site_tagline'] ?? '' }}"
                                                        placeholder="Slogan toko">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email Kontak Utama</label>
                                                    <input type="email" class="form-control" name="contact_email"
                                                        value="{{ $settings['contact_email'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nomor Telepon/WhatsApp</label>
                                                    <input type="text" class="form-control" name="contact_phone"
                                                        value="{{ $settings['contact_phone'] ?? '' }}">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Alamat Lengkap Toko</label>
                                                    <textarea class="form-control" name="store_address"
                                                        rows="3">{{ $settings['store_address'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Logo Website</label>
                                                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                                                        <div class="mb-2">
                                                            <img src="{{ asset($settings['site_logo']) }}" alt="Logo"
                                                                style="max-height: 50px; background: #eee; padding:5px; border-radius:5px;">
                                                        </div>
                                                    @endif
                                                    <input class="form-control" type="file" id="site_logo"
                                                        name="site_logo">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                        logo.</small>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-save me-1"></i> Simpan Pengaturan Umum</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-email" role="tabpanel"
                                        aria-labelledby="v-pills-email-tab">
                                        <h4 class="section-title">Konfigurasi SMTP (Pengiriman Email)</h4>
                                        <form action="{{ route('admin.settings.update') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mail Host</label>
                                                    <input type="text" class="form-control" name="mail_host"
                                                        value="{{ $settings['mail_host'] ?? '' }}"
                                                        placeholder="smtp.gmail.com">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mail Port</label>
                                                    <input type="text" class="form-control" name="mail_port"
                                                        value="{{ $settings['mail_port'] ?? '' }}" placeholder="587">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mail Username</label>
                                                    <input type="email" class="form-control" name="mail_username"
                                                        value="{{ $settings['mail_username'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mail Password (App Password)</label>
                                                    <input type="password" class="form-control" name="mail_password"
                                                        placeholder="Biarkan kosong jika tidak diubah">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mail Encryption</label>
                                                    <select class="form-select" name="mail_encryption">
                                                        <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                                        <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Pengirim (Mail From Name)</label>
                                                    <input type="text" class="form-control" name="mail_from_name"
                                                        value="{{ $settings['mail_from_name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-save me-1"></i> Simpan Konfigurasi Email</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                        aria-labelledby="v-pills-payment-tab">
                                        <h4 class="section-title">Kredensial Prisma Link Payment Gateway</h4>
                                        <form action="{{ route('admin.settings.update') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Mode Pembayaran</label>
                                                    <select class="form-select" name="prismalink_mode">
                                                        <option value="sandbox" {{ ($settings['prismalink_mode'] ?? '') == 'sandbox' ? 'selected' : '' }}>Sandbox (Testing)
                                                        </option>
                                                        <option value="production" {{ ($settings['prismalink_mode'] ?? '') == 'production' ? 'selected' : '' }}>Production (Live)
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Base URL (API Endpoint)</label>
                                                    <input type="text" class="form-control" name="prismalink_base_url"
                                                        value="{{ $settings['prismalink_base_url'] ?? 'https://sandbox.prismalink.co.id/api' }}">
                                                    <div class="input-hint">PRISMALINK_BASE_URL</div>
                                                </div>

                                                <hr class="mt-2 mb-4">

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Merchant ID</label>
                                                    <input type="text" class="form-control" name="prismalink_merch_id"
                                                        value="{{ $settings['prismalink_merch_id'] ?? '' }}">
                                                    <div class="input-hint">PRISMALINK_MERCH_ID</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Merchant Key ID</label>
                                                    <input type="text" class="form-control"
                                                        name="prismalink_merch_key_id"
                                                        value="{{ $settings['prismalink_merch_key_id'] ?? '' }}">
                                                    <div class="input-hint">PRISMALINK_MERCH_KEY_ID</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Secret Key</label>
                                                    <input type="password" class="form-control"
                                                        name="prismalink_secret_key"
                                                        placeholder="Biarkan kosong jika tidak diubah">
                                                    <div class="input-hint">PRISMALINK_SECRET_KEY</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">MAC</label>
                                                    <input type="text" class="form-control" name="prismalink_mac"
                                                        value="{{ $settings['prismalink_mac'] ?? '' }}">
                                                    <div class="input-hint">PRISMALINK_MAC</div>
                                                </div>

                                                <hr class="mt-2 mb-4">

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Transaction API Path</label>
                                                    <input type="text" class="form-control"
                                                        name="prismalink_transaction_api"
                                                        value="{{ $settings['prismalink_transaction_api'] ?? '/v1/transaction' }}">
                                                    <div class="input-hint">PRISMALINK_TRANSACTION_API</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Frontend Callback URL</label>
                                                    <input type="text" class="form-control"
                                                        name="prismalink_frontend_callback"
                                                        value="{{ $settings['prismalink_frontend_callback'] ?? '' }}">
                                                    <div class="input-hint">PRISMALINK_FRONTEND_CALLBACK</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Backend Callback URL (Webhook)</label>
                                                    <input type="text" class="form-control"
                                                        name="prismalink_backend_callback"
                                                        value="{{ $settings['prismalink_backend_callback'] ?? '' }}">
                                                    <div class="input-hint">PRISMALINK_BACKEND_CALLBACK</div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-save me-1"></i> Simpan Konfigurasi Prisma</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-system" role="tabpanel"
                                        aria-labelledby="v-pills-system-tab">
                                        <h4 class="section-title">Sistem & Preferensi</h4>
                                        <form action="{{ route('admin.settings.update') }}" method="POST">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label fw-bold d-block">Mode Perbaikan (Maintenance
                                                    Mode)</label>
                                                <div class="form-check form-switch fs-5">
                                                    <input type="hidden" name="maintenance_mode" value="0">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="maintenance_mode" name="maintenance_mode" value="1" {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label fs-6 mt-1 ms-2"
                                                        for="maintenance_mode">Aktifkan mode perbaikan (Website tidak
                                                        bisa diakses pelanggan)</label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row mt-4">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Zona Waktu (Timezone)</label>
                                                    <select class="form-select" name="timezone">
                                                        <option value="Asia/Jakarta" {{ ($settings['timezone'] ?? '') == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (WIB)
                                                        </option>
                                                        <option value="Asia/Makassar" {{ ($settings['timezone'] ?? '') == 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar
                                                            (WITA)</option>
                                                        <option value="Asia/Jayapura" {{ ($settings['timezone'] ?? '') == 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura
                                                            (WIT)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Format Tanggal Bawaan</label>
                                                    <select class="form-select" name="date_format">
                                                        <option value="d-m-Y" {{ ($settings['date_format'] ?? '') == 'd-m-Y' ? 'selected' : '' }}>DD-MM-YYYY (Contoh:
                                                            31-12-2026)</option>
                                                        <option value="Y-m-d" {{ ($settings['date_format'] ?? '') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD (Contoh:
                                                            2026-12-31)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-save me-1"></i> Simpan Pengaturan Sistem</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.layouts.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function () {
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil Disimpan!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
</body>

</html>
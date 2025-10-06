@extends('user.layouts.master')

@section('content')
    <style>
        /* Menetralkan padding yang diterapkan secara global pada body atau container utama */
        body {
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            overflow-x: hidden;
            /* Mencegah horizontal scroll */
        }

        /* Jika ada wrapper atau container utama yang memberikan padding */
        .main-wrapper,
        .page-wrapper,
        .content-wrapper {
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Untuk framework seperti Bootstrap yang mungkin memberikan container padding */
        .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Reset untuk elemen yang mungkin memiliki max-width atau margin auto */
        html,
        body {
            width: 100%;
            max-width: none !important;
        }

        /* Alternatif: Targeting specific elements yang mungkin memberi spacing */
        main,
        .main-content,
        #main {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Jika menggunakan CSS Grid atau Flexbox di level atas */
        .app-container,
        .layout-container {
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Override untuk Tailwind atau utility classes */
        .px-0 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Pastikan form section tetap memiliki padding yang diinginkan */
        .form-section {
            /* Tetap gunakan padding yang sudah ada untuk form */
            margin-left: auto;
            margin-right: auto;
        }

        .benefits-section {
            /* Tetap gunakan padding yang sudah ada untuk benefits */
            margin-left: auto;
            margin-right: auto;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .step-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(24, 48, 24, 0.2);
        }

        .step-card.active {
            border-color: #183018;
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
        }

        .step-card.active h3,
        .step-card.active p {
            color: white !important;
        }

        .benefit-card {
            transition: all 0.3s ease;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .benefit-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(24, 48, 24, 0.2);
        }

        .benefit-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 1rem;
        }

        .join-btn {
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            border: none;
            padding: 12px 32px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.3);
        }

        .join-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(24, 48, 24, 0.4);
            color: white;
        }

        .sparkle {
            position: absolute;
            color: #22c55e;
            font-size: 1.2rem;
            animation: sparkle 2s infinite ease-in-out;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        /* Benefits Section - Full Width */
        .benefits-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }

        .benefits-inner {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Updated Form Styles - Full Width */
        .form-section {
            background: linear-gradient(135deg, #f5f7f5 0%, #edf2ed 100%);
            position: relative;
            overflow: hidden;
            min-height: auto;
            z-index: 1;
            margin-top: 80px;
            padding: 4rem 0;
            /* Remove horizontal padding */
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(24, 48, 24, 0.1) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite reverse;
            z-index: 1;
        }

        .form-inner {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 10;
        }

        /* Fix for Bootstrap row and col alignment */
        .row {
            margin: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .col-lg-4,
        .col-lg-8,
        .col-12 {
            padding-left: 15px;
            padding-right: 15px;
        }

        .form-title {
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            margin-bottom: 1rem;

            /* SOLUSI 1: Pastikan line-height cukup untuk mencegah terpotong */
            line-height: 1.3;

            /* SOLUSI 2: Tambahkan padding atas dan bawah */
            padding: 0.2em 0;

            /* SOLUSI 3: Pastikan display block untuk elemen heading */
            display: block;

            /* SOLUSI 4: Tambahkan box-decoration-break untuk multiline text */
            -webkit-box-decoration-break: clone;
            box-decoration-break: clone;
        }

        .form-title-alt {
            color: #183018;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
            padding: 0.2em 0;
            /* Menggunakan color solid sebagai fallback */
        }

        .form-subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .info-card {
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(24, 48, 24, 0.3);
            z-index: 2;
            height: fit-content;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 10s ease-in-out infinite;
        }

        .info-card-content {
            position: relative;
            z-index: 2;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(24, 48, 24, 0.1);
            position: relative;
            z-index: 2;
            height: fit-content;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #183018;
            box-shadow: 0 0 0 3px rgba(24, 48, 24, 0.1);
            outline: none;
        }

        .form-control:hover {
            border-color: #1a3c1a;
        }

        /* Input Group Styling - FIXED VERSION */
        .input-group {
            display: flex;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .input-group-text {
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            color: white;
            border: 2px solid #183018;
            border-right: none;
            font-weight: 600;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            font-size: 14px;
            min-width: 60px;
            justify-content: center;
        }

        .input-group .form-control {
            border: 2px solid #e5e7eb;
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .input-group .form-control:focus {
            border-color: #183018;
            box-shadow: 0 0 0 3px rgba(24, 48, 24, 0.1);
            outline: none;
            z-index: 3;
        }

        .input-group .form-control:hover {
            border-color: #1a3c1a;
        }

        /* File Input Styling - UNTUK FILE UPLOAD */
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
            opacity: 0;
        }

        .file-input-label {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            background: white;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #6b7280;
            min-height: 48px;
        }

        .file-input-label:hover {
            border-color: #1a3c1a;
            background: #f9fafb;
        }

        .file-input-label.has-file {
            border-color: #183018;
            color: #374151;
            background: #f0f9f4;
        }

        .file-input-icon {
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            color: white;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
            flex-shrink: 0;
        }

        .file-input-text {
            flex: 1;
            margin-right: 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .form-check-input:checked {
            background-color: #183018;
            border-color: #183018;
        }

        .form-check-input:focus {
            border-color: #183018;
            box-shadow: 0 0 0 0.25rem rgba(24, 48, 24, 0.25);
        }

        .radio-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .form-check-label {
            font-weight: 500;
            color: #374151;
        }

        .submit-btn {
            background: linear-gradient(135deg, #183018 0%, #1a3c1a 100%);
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(24, 48, 24, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(24, 48, 24, 0.4);
            color: white;
        }

        .info-card img {
            border-radius: 12px;
            margin: 1rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {

            .form-card,
            .info-card {
                padding: 1.5rem;
                border-radius: 16px;
            }

            .form-title {
                font-size: 1.5rem;
                line-height: 1.4;
                /* Sedikit lebih besar untuk mobile */
            }

            .col-lg-4,
            .col-lg-8 {
                margin-bottom: 1rem;
            }

            .row {
                flex-direction: column;
            }

            .benefits-inner,
            .form-inner {
                padding: 0 1rem;
            }
        }

        /* Ensure proper clearfix for floating elements */
        .row::after {
            content: "";
            display: table;
            clear: both;
        }


        .small-swal-popup {
            font-size: 0.85rem !important;
            padding: 1rem !important;
            border-radius: 12px !important;
        }
    </style>

    <!-- Benefits Section -->
    <div class="benefits-section">
        <div class="benefits-inner">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-4">
                100% Full Support and Rewards for Every Stockist
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
                <!-- Benefit 1 -->
                <div class="benefit-card p-6 text-center">
                    <div class="benefit-icon mx-auto">
                        📈
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Materi Posting Lengkap</h3>
                    <p class="text-gray-600 text-sm">Kamu tinggal post foto dan edukasinya doang. DIJAMIN SIAP JUALAN!</p>
                </div>

                <!-- Benefit 2 -->
                <div class="benefit-card p-6 text-center">
                    <div class="benefit-icon mx-auto">
                        💰
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Harga Stabil di Pasaran</h3>
                    <p class="text-gray-600 text-sm">Sistem kami akan melakukan punishment jika ada stockist yang menjual
                        harga di bawah pasar.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="benefit-card p-6 text-center">
                    <div class="benefit-icon mx-auto">
                        🎁
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Cashback & Reward</h3>
                    <p class="text-gray-600 text-sm">Untuk Stockist yang paling aktif berjualan akan mendapatkan Cashback &
                        hadiah menarik dari SOMETHING.</p>
                </div>

                <!-- Benefit 4 -->
                <div class="benefit-card p-6 text-center">
                    <div class="benefit-icon mx-auto">
                        🏆
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">BPOM & Halal Certified</h3>
                    <p class="text-gray-600 text-sm">BUKAN PRODUK ABAL2. Kualitas Somethinc gak bercanda. Seluruh produk
                        SOMETHING sudah melalui uji klinis lab.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Updated Form Section -->
    <div class="form-section">
        <div class="form-inner">
            <div class="text-center mb-8">
                <h2 class="form-title text-3xl md:text-4xl font-bold">
                    Kembangkan Brand Anda bersama kami
                </h2>
                <p class="form-subtitle text-lg">
                    Glamoire telah menjadi inkubator industri kecantikan dan perawatan pribadi terbaik di Indonesia,
                    oleh karena itu, kami siap membantu mengembangkan brand Anda!
                </p>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="info-card h-100">
                        <div class="info-card-content">
                            <h3 class="h4 font-bold mb-3 text-white">Siap mengembangkan bisnis Anda?</h3>
                            <img src="images/new-logo2-cut.png" alt="glamoire" class="w-100">
                            <p class="mb-0">Silakan isi formulir ini, tim kami akan segera menghubungi Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="form-card">
                        <form action="{{ route('partnership') }}" id="business-partner-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="partner_fullname" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="partner_fullname"
                                            name="partner_fullname" placeholder="Masukkan Nama Pengirim" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="partner_handphone" class="form-label">No. Handphone</label>
                                        <input type="number" class="form-control" id="partner_handphone"
                                            name="partner_handphone" placeholder="Masukkan No Handphone" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="partner_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="partner_email" name="partner_email"
                                            placeholder="Masukkan Alamat Email" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="company" class="form-label">Nama Perusahaan/Brand</label>
                                        <input type="text" class="form-control" id="company" name="company"
                                            placeholder="Masukkan Nama PT/CV/Brand" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            placeholder="Jelaskan singkat mengenai anda" required></textarea>
                                    </div>
                                </div>

                                <div class="file-input-wrapper">
                                    <input type="file" id="file_company" name="file_company" accept=".pdf" required>
                                    <label for="file_company" class="file-input-label" id="fileLabel">
                                        <span class="file-input-text">Pilih file PDF profil perusahaan</span>
                                        <span class="file-input-icon">📁 Browse</span>
                                    </label>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Ada distributor resmi di Indonesia?</label>
                                        <div class="radio-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="distributor"
                                                    id="distributor_yes" value="yes" required>
                                                <label class="form-check-label" for="distributor_yes">Ada</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="distributor"
                                                    id="distributor_no" value="no" required>
                                                <label class="form-check-label" for="distributor_no">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Apakah Anda pernah menghubungi Glamoire melalui
                                            email sebelumnya?</label>
                                        <div class="radio-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="receive_email"
                                                    id="receive_email_yes" value="yes" required>
                                                <label class="form-check-label" for="receive_email_yes">Pernah</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="receive_email"
                                                    id="receive_email_no" value="no" required>
                                                <label class="form-check-label" for="receive_email_no">Belum</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="category_product" class="form-label">Kategori Produkmu</label>
                                        <input type="text" class="form-control" id="category_product"
                                            name="category_product"
                                            placeholder="Skincare / Alat Make Up dan lain sebagainya">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="submit-btn" type="submit">
                                        Kirim Formulir ✨
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil ✨',
                text: '{{ session('success') }}',
                confirmButtonColor: '#183018', // tombol hijau tua
                background: '#ffffff',
                color: '#183018',
                width: '350px',
                timer: 3000, // auto close 3 detik
                timerProgressBar: true, // tampilkan progress bar
                showConfirmButton: false, // hilangkan tombol biar auto close
                customClass: {
                    popup: 'small-swal-popup'
                }
            });
        </script>
    @endif




    <script>
        // File input functionality
        document.getElementById('file_company').addEventListener('change', function(e) {
            const fileLabel = document.getElementById('fileLabel');
            const fileText = fileLabel.querySelector('.file-input-text');

            if (e.target.files.length > 0) {
                const fileName = e.target.files[0].name;
                const fileSize = (e.target.files[0].size / 1024 / 1024).toFixed(2);

                fileText.textContent = `${fileName} (${fileSize} MB)`;
                fileLabel.classList.add('has-file');
            } else {
                fileText.textContent = 'Pilih file PDF profil perusahaan';
                fileLabel.classList.remove('has-file');
            }
        });

        // Phone number formatting
        document.getElementById('partner_handphone').addEventListener('input', function(e) {
            // Remove any non-digit characters except for initial formatting
            let value = e.target.value.replace(/[^\d]/g, '');

            // Ensure it doesn't start with 0 (since we have +62 prefix)
            if (value.startsWith('0')) {
                value = value.substring(1);
            }

            e.target.value = value;
        });
    </script>
@endsection

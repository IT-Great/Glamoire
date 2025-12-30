@extends('user.layouts.master')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .hero-section {
            background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.1)), url('images/bg-mitra-new.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 3rem 1rem;
        }

        .hero-header {
            text-align: center;
            color: white;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 500;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-primary-custom {
            background-color: #1a4d2e;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #15402a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(26, 77, 46, 0.4);
        }

        .btn-secondary-custom {
            background-color: white;
            color: #1a4d2e;
        }

        .btn-secondary-custom:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            width: 100%;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1a4d2e;
            box-shadow: 0 0 0 3px rgba(26, 77, 46, 0.1);
            outline: none;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .file-input-label {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            background: white;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .file-input-label:hover {
            border-color: #1a4d2e;
            background: #f9fafb;
        }

        .file-input-label.has-file {
            border-color: #1a4d2e;
            background: #f0f9f4;
        }

        .file-input-icon {
            background: #1a4d2e;
            color: white;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .file-input-text {
            flex: 1;
            color: #666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-input-label.has-file .file-input-text {
            color: #333;
        }

        .radio-group {
            display: flex;
            gap: 2rem;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #1a4d2e;
            border-color: #1a4d2e;
        }

        .form-check-label {
            cursor: pointer;
            font-weight: 500;
            color: #333;
        }

        .submit-btn {
            background: #1a4d2e;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #15402a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(26, 77, 46, 0.4);
        }

        .footer-text {
            text-align: center;
            color: white;
            margin-top: 3rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .stats-container {
                gap: 1.5rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .form-container {
                padding: 1.5rem;
                border-radius: 15px;
            }

            .radio-group {
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                padding: 2rem 0.75rem;
            }

            .stats-container {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                width: 100%;
                max-width: 300px;
                margin-left: auto;
                margin-right: auto;
            }

            .cta-btn {
                width: 100%;
            }
        }
    </style>

    <div class="hero-section">
        <div class="hero-header">
            <h1 class="hero-title">Grow Your Business With Us</h1>
            <p class="hero-subtitle">Bersama kami, mengembangkan bisnis jadi lebih mudah dan terarah</p>

            <div class="cta-buttons">
                <button class="cta-btn btn-primary-custom" onclick="scrollToForm()">Daftar Brand Anda</button>
                <button class="cta-btn btn-secondary-custom" onclick="showTerms()">Syarat & Ketentuan</button>
            </div>
        </div>

        <div class="form-container">
            <form id="business-partner-form" action="{{ route('partnership') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="partner_fullname" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="partner_fullname" name="partner_fullname"
                        placeholder="Masukkan Nama Pengirim" required>
                </div>

                <div class="form-group">
                    <label for="partner_handphone" class="form-label">No. Handphone</label>
                    <input type="tel" class="form-control" id="partner_handphone" name="partner_handphone"
                        placeholder="Masukkan No Handphone" required>
                </div>

                <div class="form-group">
                    <label for="partner_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="partner_email" name="partner_email"
                        placeholder="Masukkan Alamat Email" required>
                </div>

                <div class="form-group">
                    <label for="company" class="form-label">Nama Perusahaan/Brand</label>
                    <input type="text" class="form-control" id="company" name="company"
                        placeholder="Masukkan Nama PT/CV/Brand" required>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Jelaskan singkat mengenai anda"
                        required></textarea>
                </div>

                <div class="file-input-wrapper">
                    <input type="file" id="file_company" name="file_company" accept=".pdf" required
                        onchange="updateFileName(this)">
                    <label for="file_company" class="file-input-label" id="fileLabel">
                        <span class="file-input-text">File file PDF profil perusahaan</span>
                        <span class="file-input-icon">📁 Browse</span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">Ada distributor resmi di Indonesia?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="distributor" id="distributor_yes"
                                value="yes" required>
                            <label class="form-check-label" for="distributor_yes">Ada</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="distributor" id="distributor_no"
                                value="no" required>
                            <label class="form-check-label" for="distributor_no">Tidak</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Apakah Anda pernah menghubungi Glamoire melalui email sebelumnya?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="receive_email" id="receive_email_yes"
                                value="yes" required>
                            <label class="form-check-label" for="receive_email_yes">Pernah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="receive_email" id="receive_email_no"
                                value="no" required>
                            <label class="form-check-label" for="receive_email_no">Belum</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category_product" class="form-label">Kategori Produkmu</label>
                    <input type="text" class="form-control" id="category_product" name="category_product"
                        placeholder="Skincare / Alat Make Up dan lain sebagainya">
                </div>

                <button class="submit-btn" type="submit">
                    Kirim Formulir ✨
                </button>
            </form>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateFileName(input) {
            const label = document.getElementById('fileLabel');
            const text = label.querySelector('.file-input-text');

            if (input.files.length > 0) {
                text.textContent = input.files[0].name;
                label.classList.add('has-file');
            } else {
                text.textContent = 'File PDF profil perusahaan';
                label.classList.remove('has-file');
            }
        }

        document.getElementById('partner_handphone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) value = value.substring(1);
            e.target.value = value;
        });
    </script>


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

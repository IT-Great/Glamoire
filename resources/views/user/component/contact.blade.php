@extends('user.layouts.master')

@section('content')

    <style>
        /* ==========================================
           WORLD CLASS CONTACT US STYLING
           ========================================== */
        :root {
            --glamoire-dark: #183018;
            --glamoire-light: #F9FAFB;
            --glamoire-accent: #2A4D2A;
            --glamoire-gold: #D4AF37;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        /* --- Premium Breadcrumb --- */
        .premium-breadcrumb {
            background: linear-gradient(to right, rgba(24, 48, 24, 0.03), transparent);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 2rem;
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

        /* --- Page Header --- */
        .contact-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .contact-title {
            font-family: 'The Seasons', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--glamoire-dark);
            margin-bottom: 0.5rem;
        }

        .contact-subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- Layout Wrapper --- */
        .contact-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 3rem;
            margin-bottom: 5rem;
        }

        /* --- Form Section (Left) --- */
        .contact-form-section {
            flex: 1 1 55%;
            background: #FFF;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid #F3F4F6;
        }

        .form-label-premium {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control-premium {
            width: 100%;
            padding: 0.8rem 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            color: var(--text-main);
            background: #FAFAFA;
            transition: var(--transition-smooth);
            margin-bottom: 1.5rem;
        }

        .form-control-premium:focus {
            background: #FFF;
            border-color: var(--glamoire-dark);
            outline: none;
            box-shadow: 0 0 0 4px rgba(24, 48, 24, 0.05);
        }

        .form-control-premium::placeholder {
            color: #9CA3AF;
        }

        textarea.form-control-premium {
            min-height: 120px;
            resize: vertical;
        }

        /* Modern Upload Box */
        .upload-area {
            border: 2px dashed #CBD5E1;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: #FAFAFA;
            position: relative;
            transition: var(--transition-smooth);
            margin-bottom: 0.5rem;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--glamoire-dark);
            background: rgba(24, 48, 24, 0.02);
        }

        .upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .upload-icon {
            font-size: 2rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            transition: var(--transition-smooth);
        }

        .upload-area:hover .upload-icon {
            color: var(--glamoire-dark);
        }

        .upload-text {
            font-size: 0.9rem;
            color: var(--text-main);
            font-weight: 500;
            margin: 0;
        }

        .upload-subtext {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* Upload Previews */
        .file-upload-content {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }

        .upload-preview-box {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .upload-preview-box img,
        .upload-preview-box video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: #000;
        }

        .btn-remove-preview {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 24px;
            height: 24px;
            background: rgba(220, 38, 38, 0.9);
            color: #FFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            cursor: pointer;
            z-index: 5;
            transition: transform 0.2s;
        }

        .btn-remove-preview:hover {
            transform: scale(1.1);
        }

        /* Submit Button */
        .btn-submit-premium {
            background: var(--glamoire-dark);
            color: #FFF;
            border: none;
            width: 100%;
            padding: 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: var(--transition-smooth);
            margin-top: 1rem;
        }

        .btn-submit-premium:hover {
            background: var(--glamoire-accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(24, 48, 24, 0.15);
        }

        /* --- Info Section (Right) --- */
        .contact-info-section {
            flex: 1 1 35%;
        }

        .info-card {
            background: linear-gradient(135deg, #183018 0%, #2A4D2A 100%);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            color: #FFF;
            box-shadow: 0 20px 40px rgba(24, 48, 24, 0.15);
            position: sticky;
            top: 100px;
        }

        .info-card h3 {
            font-family: 'The Seasons', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--glamoire-gold);
        }

        .info-desc {
            font-size: 0.95rem;
            line-height: 1.7;
            opacity: 0.9;
            margin-bottom: 2.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--glamoire-gold);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .info-text h6 {
            margin: 0 0 0.25rem 0;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            font-family: 'Poppins', sans-serif;
        }

        .info-text p {
            margin: 0;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .contact-wrapper {
                flex-direction: column;
                gap: 2rem;
            }

            .contact-form-section {
                padding: 2rem 1.5rem;
                order: 2;
            }

            .contact-info-section {
                order: 1;
            }

            .info-card {
                padding: 2rem;
                position: static;
            }
        }
    </style>

    <div class="md:px-20 lg:px-24 xl:px-24 2xl:px-48 pt-4">

        <div class="container-fluid">
            <div class="premium-breadcrumb">
                <a href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                <span>/</span>
                <span class="active-page">Hubungi Kami</span>
            </div>
        </div>

        <div class="container-fluid">
            <div class="contact-header">
                <h1 class="contact-title">Kami Siap Membantu</h1>
                <p class="contact-subtitle">Punya pertanyaan tentang produk, pesanan, atau kolaborasi? Jangan ragu untuk
                    mengirimkan pesan kepada tim kami.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="contact-wrapper">

                <div class="contact-form-section">
                    <form id="question-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="contact_fullname" class="form-label-premium">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="contact_fullname" name="fullname" class="form-control-premium"
                                    placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_email" class="form-label-premium">Alamat Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" id="contact_email" name="email" class="form-control-premium"
                                    placeholder="nama@email.com" required>
                            </div>
                        </div>

                        <label for="contact_description" class="form-label-premium">Pertanyaan Anda <span
                                class="text-danger">*</span></label>
                        <textarea id="contact_description" name="question" class="form-control-premium"
                            placeholder="Jelaskan pertanyaan atau kendala Anda secara detail..." required></textarea>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label-premium">Unggah Gambar (Opsional)</label>
                                <div class="upload-area">
                                    <input type="file" name="response_image" class="upload-input" accept="image/*"
                                        onchange="readURLSingle(this);">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <p class="upload-text">Tarik & Lepas gambar di sini</p>
                                    <p class="upload-subtext">Atau klik untuk memilih file (Maks 2MB, JPG/PNG)</p>
                                </div>
                                <div class="file-upload-content" id="single-file-upload-content" style="display: none;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-premium">Unggah Video (Opsional)</label>
                                <div class="upload-area">
                                    <input type="file" name="response_video" id="response_video" class="upload-input"
                                        accept="video/*" onchange="readURLVideo(this);">
                                    <i class="fas fa-video upload-icon"></i>
                                    <p class="upload-text">Tarik & Lepas video di sini</p>
                                    <p class="upload-subtext">Atau klik untuk memilih file (Maks 10MB, MP4)</p>
                                </div>
                                <span id="video-error" class="text-danger fs-7 fw-bold mt-1" style="display: none;"></span>
                                <div class="file-upload-content" id="video-file-upload-content" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="question-btn" class="btn-submit-premium">
                            Kirim Pesan <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </form>
                </div>

                <div class="contact-info-section">
                    <div class="info-card">
                        <h3>Informasi Kontak</h3>
                        <p class="info-desc">Kami ingin mendengar dari Anda! Apakah Anda memiliki pertanyaan tentang produk,
                            memerlukan bantuan pesanan, atau ingin membagikan pemikiran Anda.</p>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="info-text">
                                <h6>Kantor Pusat</h6>
                                <p>Jl. Wijaya Kusuma No. 57, Surabaya, Jawa Timur, Indonesia</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div class="info-text">
                                <h6>Email</h6>
                                <p>glamoirevegan.id@gmail.com</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="info-text">
                                <h6>WhatsApp / Telepon</h6>
                                <p>+62 822-7373-6200</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fab fa-instagram"></i></div>
                            <div class="info-text">
                                <h6>Instagram</h6>
                                <p>@glamoire.idn</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // --- Image Upload Preview ---
        function readURLSingle(input) {
            if (input.files && input.files[0]) {
                var file = input.files[0];

                // Validate File Size (Max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({ icon: 'error', title: 'Oops', text: 'Ukuran gambar maksimal 2MB' });
                    input.value = '';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function (e) {
                    var imgContent = `
                        <div class="upload-preview-box">
                            <img src="${e.target.result}" alt="Preview">
                            <div class="btn-remove-preview" onclick="removeSingleImage()"><i class="fas fa-times"></i></div>
                        </div>
                    `;
                    document.getElementById('single-file-upload-content').innerHTML = imgContent;
                    document.getElementById('single-file-upload-content').style.display = 'flex';
                }
                reader.readAsDataURL(file);
            }
        }

        function removeSingleImage() {
            document.getElementById('single-file-upload-content').innerHTML = '';
            document.getElementById('single-file-upload-content').style.display = 'none';
            document.querySelector('input[name="response_image"]').value = '';
        }

        // --- Video Upload Preview ---
        function readURLVideo(input) {
            if (input.files && input.files[0]) {
                var videoFile = input.files[0];

                // Validate File Size (Max 10MB)
                if (videoFile.size > 10 * 1024 * 1024) {
                    document.getElementById('video-error').textContent = 'Ukuran video maksimal 10MB';
                    document.getElementById('video-error').style.display = 'block';
                    input.value = '';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function (e) {
                    var videoContent = `
                        <div class="upload-preview-box" style="width: 100%; aspect-ratio: 16/9; height: auto;">
                            <video controls>
                                <source src="${e.target.result}" type="${videoFile.type}">
                                Browser Anda tidak mendukung video.
                            </video>
                            <div class="btn-remove-preview" onclick="removeVideo()"><i class="fas fa-times"></i></div>
                        </div>
                    `;
                    var videoContainer = document.getElementById('video-file-upload-content');
                    videoContainer.innerHTML = videoContent;
                    videoContainer.style.display = 'flex';
                    document.getElementById('video-error').style.display = 'none';
                }
                reader.readAsDataURL(videoFile);
            }
        }

        function removeVideo() {
            document.getElementById('video-file-upload-content').innerHTML = '';
            document.getElementById('video-file-upload-content').style.display = 'none';
            document.getElementById('response_video').value = '';
        }

        // --- Form Submit AJAX ---
        $(document).ready(function () {
            $("#question-form").on("submit", function (e) {
                e.preventDefault();

                let btn = $('#question-btn');
                btn.html('<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...');
                btn.prop('disabled', true);

                let formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('fullname', $("#contact_fullname").val());
                formData.append('email', $("#contact_email").val());
                formData.append('question', $("#contact_description").val());

                const imageInput = document.querySelector('input[name="response_image"]');
                if (imageInput.files[0]) formData.append('response_image', imageInput.files[0]);

                const videoInput = document.querySelector('input[name="response_video"]');
                if (videoInput.files[0]) formData.append('response_video', videoInput.files[0]);

                $.ajax({
                    url: "{{ route('send.question') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        btn.html('Kirim Pesan <i class="fas fa-paper-plane ms-2"></i>').prop('disabled', false);

                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Terkirim!",
                                text: "Pesan Anda berhasil dikirim. Tim kami akan segera merespons melalui email.",
                                confirmButtonColor: '#183018'
                            }).then(() => location.reload());
                        } else {
                            let errors = response.errors;
                            let errorMessages = response.message || "Gagal mengirim pesan.<br>";
                            if (errors) {
                                for (const key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessages += errors[key][0] + "<br>";
                                    }
                                }
                            }
                            Swal.fire({ icon: "error", title: "Oops..", html: errorMessages, confirmButtonColor: '#183018' });
                        }
                    },
                    error: function () {
                        btn.html('Kirim Pesan <i class="fas fa-paper-plane ms-2"></i>').prop('disabled', false);
                        Swal.fire({ icon: "error", title: "Gagal", text: "Terjadi kesalahan server, silakan coba lagi nanti.", confirmButtonColor: '#183018' });
                    }
                });
            });
        });
    </script>

@endsection
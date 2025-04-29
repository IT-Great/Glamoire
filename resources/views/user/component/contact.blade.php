@extends('user.layouts.master')

<style>
    :root {
        --primary-color: #183018;
        --secondary-color: #4a6741;
        --accent-color: #8ba683;
        --light-color: #f4f7f4;
        --dark-color: #333;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .contact-section {
        padding: 3rem 0;
        background-color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .contact-card {
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        background: #fff;
    }

    .form-section {
        padding: 2rem;
        background-color: #fff;
    }

    .info-section {
        padding: 2rem;
        background-color: var(--light-color);
        color: var(--dark-color);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--accent-color);
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.2rem rgba(139, 166, 131, 0.25);
        outline: none;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
        color: var(--dark-color);
    }

    .required-mark {
        color: #dc3545;
        margin-left: 2px;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .contact-info-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--accent-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
    }

    .contact-info-text {
        font-size: 0.95rem;
    }

    .contact-info-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: var(--primary-color);
    }

    /* Upload styles */
    .file-upload-area {
        border: 2px dashed #ddd;
        border-radius: var(--border-radius);
        padding: 2rem 1.5rem;
        text-align: center;
        background-color: #f9f9f9;
        transition: var(--transition);
        position: relative;
        margin-bottom: 1.5rem;
        cursor: pointer;
    }

    .file-upload-area:hover {
        border-color: var(--accent-color);
        background-color: #f0f4f0;
    }

    .file-upload-icon {
        font-size: 2.5rem;
        color: var(--secondary-color);
        margin-bottom: 1rem;
    }

    .file-upload-text {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .file-upload-hint {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .file-preview-container {
        background-color: #f9f9f9;
        border-radius: var(--border-radius);
        border: 1px solid #e0e0e0;
        padding: 1rem;
        margin-top: 1rem;
        display: flex;
        align-items: center;
    }

    .file-preview-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 1rem;
    }

    .file-preview-info {
        flex-grow: 1;
    }

    .file-preview-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: var(--dark-color);
    }

    .file-preview-size {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .file-remove-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .file-remove-btn:hover {
        background-color: #c82333;
    }

    .video-upload-area {
        border: 2px dashed #ddd;
        border-radius: var(--border-radius);
        padding: 2rem 1.5rem;
        text-align: center;
        background-color: #f9f9f9;
        transition: var(--transition);
        position: relative;
        margin-bottom: 1.5rem;
        cursor: pointer;
    }

    .video-upload-area:hover {
        border-color: var(--accent-color);
        background-color: #f0f4f0;
    }

    .video-preview {
        width: 100%;
        max-width: 640px;
        margin: 0 auto;
        background-color: #f9f9f9;
        border-radius: var(--border-radius);
        overflow: hidden;
    }

    .video-preview video {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .video-info {
        padding: 1rem;
        background-color: #f9f9f9;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }

    .error-message {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: none;
    }

    .submit-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        padding: 0.85rem 1.5rem;
        font-weight: 500;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        background-color: var(--secondary-color);
    }

    .contact-description {
        line-height: 1.6;
        margin-bottom: 2rem;
        color: #555;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease;
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .info-section {
            margin-top: 2rem;
        }
    }
</style>

@section('content')
    <div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 py-2 mb-4">
        <div class="container-fluid px-0 px-md-3">
            <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-1 my-md-3">
                <div class="d-flex gap-1 pl-3">
                    <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                    <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                    <a href="#"
                        class="text-decoration-none text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kontak
                        Kami</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 p-0">
                    <form class="grid" id="question-form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-2">
                            <div>
                                <label for="name"
                                    class="form-label text-[#183018] text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                    Nama Lengkap
                                </label>
                                <input type="text"
                                    class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    name="fullname" id="contact_fullname" placeholder="Masukkan Nama Lengkap" required>

                                <label for="email"
                                    class="form-label text-[#183018] text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                    Email
                                </label>
                                <input type="email"
                                    class="form-control rounded-lg text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    name="email" id="contact_email" placeholder="contoh@gmail.com" required>

                                <label for="description"
                                    class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">
                                    Pertanyaan
                                </label>
                                <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="question"
                                    id="contact_description" rows="3" placeholder="Apa yang ada tanyakan?" required></textarea>

                                <div class="upload-section mb-4">
                                    <h5 class="upload-title mb-3">
                                        <i class="bi bi-image me-2"></i>Upload Gambar
                                    </h5>

                                    <div class="file-preview-container fade-in mb-3" id="file-upload-content-response"
                                        style="display: none;">
                                        <img class="file-preview-image" id="file-upload-image-response" src="#"
                                            alt="Preview">
                                        <div class="file-preview-info">
                                            <p class="file-preview-name" id="image-file-name-response">File Name</p>
                                            <p class="file-preview-size">Gambar akan diunggah saat formulir dikirim</p>
                                        </div>
                                        <button type="button" class="file-remove-btn" onclick="removeUpload('response')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <div class="file-upload-area" id="image-upload-area">
                                        <input type="file" name="upload[]" id="file-input-response"
                                            class="file-upload-input" onchange="previewFile(this, 'response')"
                                            accept="image/*" style="display: none;">
                                        <div class="file-upload-icon">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>
                                        <p class="file-upload-text">Klik untuk pilih atau tarik & letakkan gambar di sini
                                        </p>
                                        <p class="file-upload-hint">Format yang diterima: JPG, PNG, GIF — Maks. 2MB</p>
                                    </div>

                                    <div class="error-message" id="image-error"></div>
                                </div>

                                <div class="upload-section mb-4">
                                    <h5 class="upload-title mb-3">
                                        <i class="bi bi-camera-video me-2"></i>Upload Video
                                    </h5>


                                    <div class="video-preview fade-in mb-3" id="video-file-upload-content"
                                        style="display: none;"></div>

                                    <div class="video-upload-area" id="video-upload-wrap">
                                        <input type="file" id="video-input" name="upload[]" class="file-upload-input"
                                            onchange="readURLVideo(this);" accept="video/*" style="display: none;">
                                        <div class="file-upload-icon">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <p class="file-upload-text">Klik untuk pilih atau tarik & letakkan video di sini</p>
                                        <p class="file-upload-hint">Format yang diterima: MP4, MOV, AVI — Maks. 5MB</p>
                                    </div>


                                    <div class="error-message" id="video-error"></div>
                                </div>
                                <button
                                    class="mt-2 py-2 w-full rounded-md text-white bg-[#183018] text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    type="submit" id="question-btn">Kirim Pertanyaan Kamu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <h5 class="font-weight-semi-bold mb-3">Hubungi Kami</h5>
                    <p class="text-[10px] md:text-[12px] lg:text-[14px] xl:text-[16px] text-justify">
                        Kami ingin mendengar dari Anda! Apakah Anda memiliki pertanyaan tentang produk kami, memerlukan
                        bantuan dengan pesanan Anda, atau hanya ingin membagikan pemikiran Anda, kami siap membantu.
                    </p>
                    <div class="d-flex flex-column mt-4">
                        <p class="mb-2 text-[12px] md:text-[14px] lg:text-[14px] xl:text-[16px]">
                            <i class="fa fa-map-marker-alt text-primary mr-3 h-4 w-4"></i>Jl Wijaya Kusuma no. 57, Surabaya
                        </p>
                        <p class="mb-2 text-[12px] md:text-[14px] lg:text-[14px] xl:text-[16px]">
                            <i class="fa fa-envelope text-primary mr-3 h-4 w-4"></i>glamoirevegan.id@gmail.com
                        </p>
                        <p class="mb-2 text-[12px] md:text-[14px] lg:text-[14px] xl:text-[16px]">
                            <i class="fa fa-phone-alt text-primary mr-3 h-4 w-4"></i>+62 822-7373-6200
                        </p>
                        <p class="mb-2 text-[12px] md:text-[14px] lg:text-[14px] xl:text-[16px]">
                            <i class="fab fa-instagram text-primary mr-3 h-4 w-4"></i>glamoire.idn
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup image upload area
            const imageUploadArea = document.getElementById('image-upload-area');
            const fileInput = document.getElementById('file-input-response');

            imageUploadArea.addEventListener('click', function() {
                fileInput.click();
            });

            setupDragAndDrop(imageUploadArea, fileInput, 'response');

            // Setup video upload area
            const videoUploadArea = document.getElementById('video-upload-wrap');
            const videoInput = document.getElementById('video-input');

            videoUploadArea.addEventListener('click', function() {
                videoInput.click();
            });

            setupDragAndDrop(videoUploadArea, videoInput, 'video');

            // Form submission
            $("#question-form").on("submit", function(e) {
                e.preventDefault();

                // Show loading state
                const submitBtn = document.getElementById('question-btn');
                const originalBtnText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
                submitBtn.disabled = true;

                // Create FormData object to handle file uploads
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('send.question') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        // Reset button state
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;

                        if (response.success) {
                            Toast.fire({
                                icon: "success",
                                text: response.message,
                                title: "Berhasil",
                                willOpen: () => {
                                    const title = document.querySelector(
                                        '.swal2-title');
                                    const content = document.querySelector(
                                        '.swal2-html-container');
                                    if (title) title.style.color = '#ffffff';
                                    if (content) content.style.color = '#ffffff';
                                }
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            let errors = response.errors;
                            let errorMessages = response.message;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + "<br>";
                                }
                            }
                            Toast.fire({
                                icon: "error",
                                text: errorMessages,
                                title: "Oops..",
                                willOpen: () => {
                                    const title = document.querySelector(
                                        '.swal2-title');
                                    const content = document.querySelector(
                                        '.swal2-html-container');
                                    if (title) title.style.color = '#ffffff';
                                    if (content) content.style.color = '#ffffff';
                                }
                            });
                        }
                    },
                    error: function(response) {
                        // Reset button state
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;

                        Toast.fire({
                            icon: "error",
                            text: "Maaf, terjadi kesalahan. Silakan coba lagi.",
                            title: "Oops..",
                            willOpen: () => {
                                const title = document.querySelector(
                                    '.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color = '#ffffff';
                                if (content) content.style.color = '#ffffff';
                            }
                        });
                    },
                });
            });
        });

        function setupDragAndDrop(dropArea, inputElement, type) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => {
                    dropArea.style.borderColor = '#4a6741';
                    dropArea.style.backgroundColor = '#f0f4f0';
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => {
                    dropArea.style.borderColor = '#ddd';
                    dropArea.style.backgroundColor = '#f9f9f9';
                }, false);
            });

            dropArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    inputElement.files = files;
                    if (type === 'response') {
                        previewFile(inputElement, type);
                    } else if (type === 'video') {
                        readURLVideo(inputElement);
                    }
                }
            }, false);
        }

        function previewFile(input, type) {
            const maxFileSize = 2 * 1024 * 1024; // 2MB
            const errorElement = document.getElementById('image-error');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Check file size
                if (file.size > maxFileSize) {
                    errorElement.textContent = "Ukuran file melebihi batas 2MB";
                    errorElement.style.display = "block";
                    input.value = '';
                    return;
                }

                // Check file type
                if (!file.type.match('image.*')) {
                    errorElement.textContent = "Hanya file gambar yang diperbolehkan";
                    errorElement.style.display = "block";
                    input.value = '';
                    return;
                }

                // Hide error message if all checks pass
                errorElement.style.display = "none";

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('file-upload-content-' + type).style.display = 'flex';
                    document.getElementById('file-upload-image-' + type).src = e.target.result;
                    document.getElementById('image-file-name-' + type).innerText = file.name;
                };
                reader.readAsDataURL(file);
            }
        }

        function removeUpload(type) {
            const fileInput = document.querySelector('#file-input-' + type);
            fileInput.value = '';
            document.getElementById('file-upload-content-' + type).style.display = 'none';
            document.getElementById('image-error').style.display = "none";
        }

        function readURLVideo(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const maxSize = 5 * 1024 * 1024; // 5MB
                const errorElement = document.getElementById('video-error');

                // Check if file is a video
                if (!file.type.startsWith('video/')) {
                    errorElement.textContent = 'Mohon pilih file video yang valid';
                    errorElement.style.display = 'block';
                    input.value = '';
                    return;
                }

                // Check file size
                if (file.size > maxSize) {
                    errorElement.textContent = 'Ukuran video melebihi batas 5MB';
                    errorElement.style.display = 'block';
                    input.value = '';
                    return;
                }

                // Hide any previous errors
                errorElement.style.display = 'none';

                // Create video preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.getElementById('video-file-upload-content');
                    container.style.display = 'block';
                    container.innerHTML = `
                        <div class="video-preview fade-in mb-3">
                            <video controls style="width: 100%; border-radius: 8px;">
                                <source src="${e.target.result}" type="${file.type}">
                                Browser Anda tidak mendukung pratinjau video.
                            </video>
                            <div class="video-info d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 fw-bold">${file.name}</p>
                                    <small class="text-muted">${(file.size / (1024 * 1024)).toFixed(2)} MB</small>
                                </div>
                                <button type="button" class="file-remove-btn" onclick="removeVideo()">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        }

        function removeVideo() {
            document.getElementById('video-input').value = '';
            document.getElementById('video-file-upload-content').innerHTML = '';
            document.getElementById('video-file-upload-content').style.display = 'none';
            document.getElementById('video-error').style.display = 'none';
        }
    </script>
@endsection

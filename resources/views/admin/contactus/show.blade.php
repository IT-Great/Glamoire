<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-Us - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        /* Card & Container Styles */
        .contact-detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);
            background: white;
            transition: all 0.3s ease;
        }

        .contact-detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px 0 rgba(0, 0, 0, 0.1);
        }


        /* User Info Section */
        .user-info-container {
            background: rgba(103, 119, 239, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border: 3px solid white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .user-details {
            padding-left: 1.5rem;
        }

        .user-name {
            color: #2c3e50;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .user-email {
            color: #6777ef;
            font-weight: 500;
        }

        .timestamp {
            color: #95a5a6;
            font-size: 0.9rem;
        }

        /* Message Section */
        .message-container {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid #6777ef;
            margin-bottom: 2rem;
        }

        .message-header {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .message-content {
            color: #34495e;
            line-height: 1.6;
        }

        /* Media Display Section */
        .media-container {
            margin: 2rem 0;
            background: rgba(103, 119, 239, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
        }

        .media-box {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .media-header {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f1f1;
        }

        .media-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }

        .uploaded-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .uploaded-image:hover {
            transform: scale(1.05);
        }

        .video-container {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f4f4;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 300px;
            /* Default height */
        }

        .video-player {
            width: auto;
            height: 100%;
            object-fit: cover;
        }

        /* Response Form */
        .response-form {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .form-label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6777ef;
            box-shadow: 0 0 0 0.2rem rgba(103, 119, 239, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, #6777ef 0%, #3ae2f0 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(103, 119, 239, 0.4);
        } */

        /* Modal Styles */
        .image-modal {
            background: rgba(0, 0, 0, 0.9);
        }

        .image-modal .modal-content {
            background: transparent;
            border: none;
        }

        .image-modal .modal-header {
            border: none;
            padding: 1rem;
        }

        .image-modal .close {
            color: white;
            opacity: 1;
        }

        .image-modal img {
            max-height: 80vh;
            object-fit: contain;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')


        <div id="main">
            <div class="page-heading">
                <div class="container-fluid">
                    <!-- Judul Halaman -->
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="mb-2">Contact Us</h3>
                                <p>Tinjau dan tanggapi semua pertanyaan pelanggan di satu tempat</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigasi Breadcrumb -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('index-contactus-admin') }}"
                                            class="d-flex align-items-center">
                                            <i class="bi bi-envelope me-1"></i>Contact Us
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">All Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="contact-detail-card">
                        <div class="card-header">
                            <h4>Detail Pesan Kontak dan Formulir Tanggapan</h4>
                            <p class="text-muted">Tinjau detail pesan kontak dan berikan tanggapan yang jelas dan
                                bermanfaat.</p>
                        </div>

                        <div class="card-body p-4">
                            <!-- User Info Section -->
                            <div class="user-info-container">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Foto Pengguna"
                                        class="user-avatar rounded-circle">
                                    <div class="user-details">
                                        <h5 class="user-name">{{ $contact->fullname }}</h5>
                                        <p class="user-email mb-2">
                                            <i class="bi bi-envelope"></i> {{ $contact->email }}
                                        </p>
                                        <p class="timestamp">
                                            <i class="bi bi-clock"></i>
                                            {{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Message Section -->
                            <div class="message-container">
                                <h6 class="message-header">
                                    <i class="bi bi-chat-text"></i> Isi Pesan
                                </h6>
                                <div class="message-content">
                                    {{ $contact->question }}
                                </div>
                            </div>

                            <!-- Media Section -->
                            <div class="media-container">
                                <div class="row">
                                    <!-- Image Display -->
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <div class="media-box">
                                            <h6 class="media-header">
                                                <i class="bi bi-image"></i> Gambar Terlampir
                                            </h6>
                                            <div class="media-content">
                                                @if ($contact->response_image)
                                                    <a href="{{ asset('storage/' . $contact->response_image) }}"
                                                        target="_blank" rel="noopener">
                                                        <img src="{{ asset('storage/' . $contact->response_image) }}"
                                                            alt="Gambar Terunggah" class="uploaded-image"
                                                            style="cursor: pointer; max-width: 100%; height: auto;">
                                                    </a>
                                                @else
                                                    <p class="text-muted">Tidak ada gambar terlampir</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Video Display -->
                                    <div class="col-md-6">
                                        <div class="media-box">
                                            <h6 class="media-header">
                                                <i class="bi bi-camera-video"></i> Video Terlampir
                                            </h6>
                                            <div class="video-container">
                                                @if ($contact->response_video)
                                                    <video controls class="video-player"
                                                        style="max-width: 100%; height: auto;">
                                                        <source
                                                            src="{{ asset('storage/' . $contact->response_video) }}"
                                                            type="video/mp4">
                                                        Browser Anda tidak mendukung pemutaran video.
                                                    </video>
                                                @else
                                                    <p class="text-muted">Tidak ada video terlampir</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Response Form -->
                            <form action="{{ route('send-response', $contact->id) }}" method="POST"
                                class="response-form">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="form-label">
                                        <i class="bi bi-reply"></i> Tanggapan Anda
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" name="response" rows="5"
                                        placeholder="Ketik tanggapan Anda di sini..."></textarea>
                                    @error('response')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('index-contactus-admin') }}"
                                        class="btn btn-secondary btn-sm me-2"
                                        style="font-weight: bold; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-box-arrow-in-left me-1"></i>
                                        Kembali
                                    </a>

                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-send"></i> Kirim Tanggapan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            @if ($errors->any())
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    icon: 'error',
                    title: 'Error: {{ $errors->first() }}',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            @endif
        });
    </script>

</body>

</html>

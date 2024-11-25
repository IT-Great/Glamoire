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

    {{-- <style>
        .list-group-item {
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
            /* Menunjukkan bahwa item dapat diklik */
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            /* Ganti warna latar belakang saat hover */
            transform: scale(1.02);
            /* Sedikit memperbesar item saat hover */
        }

        /* Existing CSS yang Anda berikan */
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box-multiple {
            width: 150px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-box-single {
            width: 150px;
            padding: 0 10px;
            margin-bottom: 12px;
            position: relative;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 6px;
            right: 6px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .video-upload-wrap {
            border: 2px dashed #ddd;
            border-radius: 4px;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
            background: #f8f8f8;
            margin-bottom: 15px;
            height: auto;
        }

        .file-upload-content {
            display: flex;
            flex-wrap: wrap;
        }

        .upload__video-box {
            position: relative;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            padding: 5px;
            width: 320px;
            height: 240px;
        }

        .upload__video-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__video-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }
    </style> --}}

    <style>
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

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(103, 119, 239, 0.4);
        }

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

        {{-- <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-contactus-admin') }}">Contact
                                            Us</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Message Details and Response Form</h4>
                            <p class="text-muted">Review the details of the contact message and provide a clear, helpful
                                response.</p>
                        </div>
                        <div class="card-body">
                            <!-- Contact Details -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="border rounded p-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Image"
                                                class="rounded-circle"
                                                style="width: 60px; height: 60px; margin-right: 15px;">
                                            <div>
                                                <h5 class="mb-1">Name: {{ $contact->fullname }}</h5>
                                                <p class="text-muted mb-1">Email: {{ $contact->email }}</p>
                                                <small>Message Sent on:
                                                    {{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y H:i') }}</small>
                                            </div>
                                        </div>

                                        <!-- Message Content -->
                                        <div class="border-top pt-3">
                                            <h6>Message:</h6>
                                            <p class="text-muted"><strong>{{ $contact->question }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Response Form -->
                            <form action="{{ route('send-response', $contact->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="response"><strong>Your Response : <span
                                                class="text-danger">*</span></strong></label>
                                    <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" id="response" name="response"
                                        rows="5" placeholder="Write your detailed response here..."></textarea>
                                    @if ($errors->has('response'))
                                        <p style="color: red">{{ $errors->first('response') }}</p>
                                    @endif
                                </div>

                                <div class="row">
                                    <!-- Display Uploaded Images -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong>Uploaded Image</strong>
                                            </div>
                                            <div class="card-body">
                                                @if ($contact->image)
                                                    <div class="upload__img-wrap">
                                                        <div class="upload__img-box-single">
                                                            <img src="{{ asset('storage/' . $contact->image) }}"
                                                                alt="Uploaded Image" class="img-fluid img-thumbnail"
                                                                style="max-width: 150px;">

                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="text-muted">No image uploaded for this contact.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Display Uploaded Videos -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <strong>Uploaded Video</strong>
                                            </div>
                                            <div class="card-body">
                                                @if ($contact->video)
                                                    <div class="upload__video-box">
                                                        <video controls style="width: 100%; height: auto;">
                                                            <source src="{{ asset('storage/' . $contact->video) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                @else
                                                    <p class="text-muted">No video uploaded for this contact.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="bi bi-send"></i> Send Response
                                </button>
                            </form>

                        </div>
                    </div>
                </section>
            </div>
        </div> --}}

        <div id="main">
            <div class="page-heading">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="breadcrumb-header mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index-contactus-admin') }}">Contact Us</a></li>
                        <li class="breadcrumb-item active">Message Details</li>
                    </ol>
                </nav>

                <!-- Main Content -->
                <div class="contact-detail-card">

                    {{-- <h4><i class="bi bi-envelope-paper"></i> Contact Message Details</h4>
                    <p>Review and respond to customer inquiry</p> --}}

                    <div class="card-header">
                        <h4>Contact Message Details and Response Form</h4>
                        <p class="text-muted">Review the details of the contact message and provide a clear, helpful
                            response.</p>
                    </div>

                    <div class="card-body p-4">
                        <!-- User Info Section -->
                        <div class="user-info-container">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Avatar"
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
                                <i class="bi bi-chat-text"></i> Message Content
                            </h6>
                            <div class="message-content">
                                {{ $contact->question }}
                            </div>
                        </div>

                        <!-- Media Section -->
                        <!-- Media Section -->
                        <div class="media-container">
                            <div class="row">
                                <!-- Image Display -->
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <div class="media-box">
                                        <h6 class="media-header">
                                            <i class="bi bi-image"></i> Attached Image
                                        </h6>
                                        <div class="media-content">
                                            @if ($contact->image)
                                                <img src="{{ asset('storage/' . $contact->image) }}"
                                                    alt="Uploaded Image" class="uploaded-image"
                                                    onclick="openImageModal(this.src)">
                                            @else
                                                <p class="text-muted">No image attached</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Video Display -->
                                <div class="col-md-6">
                                    <div class="media-box">
                                        <h6 class="media-header">
                                            <i class="bi bi-camera-video"></i> Attached Video
                                        </h6>
                                        <div class="video-container">
                                            @if ($contact->video)
                                                <video controls class="video-player">
                                                    <source src="{{ asset('storage/' . $contact->video) }}"
                                                        type="video/mp4">
                                                    Your browser does not support video playback.
                                                </video>
                                            @else
                                                <p class="text-muted">No video attached</p>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Response Form -->
                        <form action="{{ route('send-response', $contact->id) }}" method="POST" class="response-form">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="form-label">
                                    <i class="bi bi-reply"></i> Your Response
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" name="response" rows="5"
                                    placeholder="Type your response here..."></textarea>
                                @error('response')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-send"></i> Send Response
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')

        </div>

        <!-- Image Modal -->
        <div class="modal fade image-modal" id="imageModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" alt="Full size image">
                    </div>
                </div>
            </div>
        </div>

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
        document.addEventListener("DOMContentLoaded", function() {
            const videos = document.querySelectorAll(".video-player");

            videos.forEach((video) => {
                video.addEventListener("loadedmetadata", function() {
                    const aspectRatio = this.videoWidth / this.videoHeight;

                    if (aspectRatio > 1) {
                        // Landscape
                        this.style.width = "100%";
                        this.style.height = "auto";
                    } else {
                        // Portrait
                        this.style.width = "auto";
                        this.style.height = "100%";
                    }
                });
            });
        });
    </script>


    <script>
        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            $('#imageModal').modal('show');
        }

        // Optional: Add smooth scroll to top when modal closes
        $('#imageModal').on('hidden.bs.modal', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    <script>
        // Handle Single Image Upload
        function readURLSingle(input) {
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgContent = `
                        <div class="upload__img-box-single">
                            <div class="img-bg" style="background-image: url('${e.target.result}')">
                                <div class="upload__img-close" onclick="removeSingleImage(this)"></div>
                            </div>
                        </div>
                    `;
                    document.getElementById('single-file-upload-content').innerHTML = imgContent;
                    document.getElementById('single-file-upload-content').style.display = 'flex';
                }

                reader.readAsDataURL(file);
            }
        }

        function removeSingleImage(element) {
            var imgContent = document.getElementById('single-file-upload-content');
            imgContent.innerHTML = '';
            imgContent.style.display = 'none';
            document.querySelector('input[name="response_image"]').value = '';
        }

        // Handle Video Upload
        function readURLVideo(input) {
            if (input.files && input.files[0]) {
                var videoFile = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var videoContent = `
                        <div class="upload__video-box">
                            <video width="320" height="240" controls>
                                <source src="${e.target.result}" type="${videoFile.type}">
                                Your browser does not support the video tag.
                            </video>
                            <div class="upload__video-close" onclick="removeVideo(this)"></div>
                        </div>
                    `;
                    document.getElementById('video-file-upload-content').innerHTML = videoContent;
                    document.getElementById('video-file-upload-content').style.display = 'flex';
                }

                reader.readAsDataURL(videoFile);
            }
        }

        function removeVideo(element) {
            var videoContent = document.getElementById('video-file-upload-content');
            videoContent.innerHTML = '';
            videoContent.style.display = 'none';
            document.getElementById('response_video').value = '';
        }

        // Form Validation
        document.querySelector('form').addEventListener('submit', function(event) {
            var response = document.getElementById('response').value;
            if (response.length < 10) {
                event.preventDefault();
                alert('Response must be at least 10 characters long.');
                return;
            }
        });
    </script>

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

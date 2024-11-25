@extends('user.layouts.master')

<style>
    /* Existing CSS yang Anda berikan */
    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
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
    }

    .file-upload-content {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }

    .upload__video-box {
        position: relative;
        margin: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        padding: 5px;
        width: 100%;
        max-width: 640px;
        height: auto;
        aspect-ratio: 16 / 9;
    }

    .upload__video-box video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #000;
    }


    .upload__video-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.7);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .upload__video-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }

    .upload__video-close:hover {
        background-color: rgba(0, 0, 0, 0.9);
    }
</style>

@section('content')
    <div class="md:px-20 lg:px-24 xl:px-24 py-2 py-md-3 mb-4">
        <div class="container-fluid">
            <div class="shadow-sm border border-black rounded-md py-2 py-md-3 my-1 my-md-3">
                <div class="d-flex gap-2 pl-2">
                    <a href="/" class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
                    <p class="text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
                    <a href="#"
                        class="text-decoration-none text-black text-[8px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kontak
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
                                    class="form-label text-[#183018] text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Nama
                                    Lengkap </label>
                                <input type="text"
                                    class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    name="fullname" id="contact_fullname" placeholder="Masukkan Nama Lengkap" required>

                                <label for="email"
                                    class="form-label text-[#183018] text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Email
                                </label>
                                <input type="email"
                                    class="form-control rounded-lg text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"
                                    name="email" id="contact_email" placeholder="contoh@gmail.com" required>

                                <label for="description"
                                    class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Pertanyaan</label>
                                <textarea class="form-control rounded-lg text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]" name="question"
                                    id="contact_description" rows="3" placeholder="Apa yang ada tanyakan?" required></textarea>

                                <div class="mt-2">
                                    <label for="description"
                                        class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Image</label>
                                    <div class="image-upload-wrap mt-2" id="single-image-upload-wrap"
                                        style="border: 2px dashed #ddd; border-radius: 4px; padding: 20px; width: 100%; box-sizing: border-box; position: relative; background: #f8f8f8; margin-bottom: 15px; height: auto;">
                                        <input type="file" name="image" class="file-upload-input"
                                            onchange="readURLSingle(this);" accept="image/*"
                                            style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                        <div class="drag-text" style="text-align: center; color: #888;">
                                            <p>Drag and drop a file or select to add Image</p>
                                        </div>
                                    </div>

                                    <span id="image-error" style="color: red; display: none;"></span>

                                    <div class="file-upload-content" id="single-file-upload-content"
                                        style="display: flex; flex-wrap: wrap;">
                                        <!-- Uploaded image will be added here -->
                                    </div>

                                    @if ($errors->has('response_image'))
                                        <p style="color: red">{{ $errors->first('response_image') }}</p>
                                    @else
                                        <small class="form-text text-muted">Upload a clear image to support your
                                            response. Allowed formats: JPG, JPEG, PNG, GIF (max 2MB)</small>
                                    @endif
                                </div>

                                <div class="mt-2">
                                    <label for="description"
                                        class="form-label text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Video</label>
                                    <div class="video-upload-wrap mt-2" id="video-upload-wrap">
                                        <input type="file" id="response_video" name="video" class="file-upload-input"
                                            onchange="readURLVideo(this);" accept="video/*"
                                            style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                        <div class="drag-text" style="text-align: center; color: #888;">
                                            <p>Drag and drop a video file or select to upload</p>
                                        </div>
                                    </div>

                                    <span id="video-error" style="color: red; display: none;"></span>

                                    <div class="file-upload-content" id="video-file-upload-content"
                                        style="display: flex; flex-wrap: wrap;">
                                        <!-- Uploaded video will be added here -->
                                    </div>

                                    @if ($errors->has('response_video'))
                                        <p style="color: red">{{ $errors->first('response_video') }}</p>
                                    @else
                                        <small class="form-text text-muted">Upload a video to better explain
                                            your
                                            response. Allowed formats: MP4, MOV, AVI (max 5MB)</small>
                                    @endif
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

    {{-- <script>
        $(document).on("submit", "#question-form", function(e) {
            e.preventDefault();

            let formData = new FormData(this); // Ambil semua data dari form, termasuk file

            let fullname = $("#contact_fullname").val();
            let email = $("#contact_email").val();
            let question = $("#contact_description").val();

            console.log({
                fullname,
                email,
                question,
            });

            $.ajax({
                url: "{{ route('send.question') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    fullname: fullname,
                    email: email,
                    question: question,
                },
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,
                            title: "Berhasil",
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.refresh(); // Redirect ke halaman utama atau halaman lain
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
                            text: errorMessahes,
                            title: "Oops..",
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: "error",
                        text: "Maaf Coba Lagi",
                        title: "Oops..",
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        }
                    });
                },
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

                // Validate file size (10MB limit)
                if (videoFile.size > 10 * 1024 * 1024) {
                    document.getElementById('video-error').textContent = 'Video size must be less than 10MB';
                    document.getElementById('video-error').style.display = 'block';
                    input.value = '';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    var videoContent = `
                <div class="upload__video-box">
                    <video controls>
                        <source src="${e.target.result}" type="${videoFile.type}">
                        Your browser does not support the video tag.
                    </video>
                    <div class="upload__video-close" onclick="removeVideo(this)"></div>
                </div>
            `;
                    var videoContainer = document.getElementById('video-file-upload-content');
                    videoContainer.innerHTML = videoContent;
                    videoContainer.style.display = 'flex';

                    // Hide error message if it was previously shown
                    document.getElementById('video-error').style.display = 'none';
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
    </script> --}}

    <script>
        $(document).on("submit", "#question-form", function(e) {
            e.preventDefault();

            // Create FormData object
            let formData = new FormData();

            // Add text fields
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('fullname', $("#contact_fullname").val());
            formData.append('email', $("#contact_email").val());
            formData.append('question', $("#contact_description").val());

            // Add image file if exists
            const imageInput = document.querySelector('input[name="image"]');
            if (imageInput.files[0]) {
                formData.append('image', imageInput.files[0]);
            }

            // Add video file if exists
            const videoInput = document.querySelector('input[name="video"]');
            if (videoInput.files[0]) {
                formData.append('video', videoInput.files[0]);
            }

            $.ajax({
                url: "{{ route('send.question') }}",
                type: "POST",
                data: formData,
                processData: false, // Important for FormData
                contentType: false, // Important for FormData
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,
                            title: "Berhasil",
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color = '#ffffff';
                                if (content) content.style.color = '#ffffff';
                            }
                        }).then(function() {
                            location
                                .reload(); // Use location.reload() instead of window.refresh()
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
                            text: errorMessages, // Fixed typo in variable name
                            title: "Oops..",
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color = '#ffffff';
                                if (content) content.style.color = '#ffffff';
                            }
                        });
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: "error",
                        text: "Maaf Coba Lagi",
                        title: "Oops..",
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff';
                            if (content) content.style.color = '#ffffff';
                        }
                    });
                },
            });
        });

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

                // Validate file size (10MB limit)
                if (videoFile.size > 10 * 1024 * 1024) {
                    document.getElementById('video-error').textContent = 'Video size must be less than 10MB';
                    document.getElementById('video-error').style.display = 'block';
                    input.value = '';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    var videoContent = `
                <div class="upload__video-box">
                    <video controls>
                        <source src="${e.target.result}" type="${videoFile.type}">
                        Your browser does not support the video tag.
                    </video>
                    <div class="upload__video-close" onclick="removeVideo(this)"></div>
                </div>
            `;
                    var videoContainer = document.getElementById('video-file-upload-content');
                    videoContainer.innerHTML = videoContent;
                    videoContainer.style.display = 'flex';

                    // Hide error message if it was previously shown
                    document.getElementById('video-error').style.display = 'none';
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
    </script>
@endsection

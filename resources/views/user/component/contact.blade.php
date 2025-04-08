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
<div class="md:px-20 lg:px-24 xl:px-48 2xl:px-96 py-2 mb-4">
  <div class="container-fluid px-0 px-md-3">
    <div class="shadow-sm border border-black rounded-sm py-2 py-md-3 my-1 my-md-3">
      <div class="d-flex gap-1 pl-3">
        <a href="/" class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Beranda</a>
        <p class="text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]"> > </p>
        <a href="#" class="text-decoration-none text-black text-[10px] md:text-[10px] lg:text-[12px] xl:text-[14px]">Kontak Kami</a>
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
                                        <input type="file" name="response_image" class="file-upload-input"
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
                                        <input type="file" id="response_video" name="response_video" class="file-upload-input"
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

<script>
  // $(document).on("submit", "#question-form", function (e) {
  //   e.preventDefault();

  //   let fullname = $("#contact_fullname").val();
  //   let email    = $("#contact_email").val();
  //   let question = $("#contact_description").val();

  //   $.ajax({
  //       url: "{{ route('send.question') }}",
  //       type: "POST",
  //       data: {
  //           _token: "{{ csrf_token() }}",
  //           fullname: fullname,
  //           email: email,
  //           question: question,
  //       },
  //       success: function (response) {
  //           if (response.success) {
  //               Toast.fire({
  //                 icon: "success",
  //                 text: response.message,
  //                 title: "Berhasil",
  //                 willOpen: () => {
  //                   const title = document.querySelector('.swal2-title');
  //                   const content = document.querySelector('.swal2-html-container');
  //                   if (title) title.style.color = '#ffffff'; // Ubah warna judul
  //                   if (content) content.style.color = '#ffffff'; // Ubah warna konten
  //                 }
  //               }).then(function () {
  //                 location.reload(); // Redirect ke halaman utama atau halaman lain
  //               });
  //           } else {
  //             let errors = response.errors;
  //             let errorMessages = response.message;
  //             for (const key in errors) {
  //                 if (errors.hasOwnProperty(key)) {
  //                     errorMessages += errors[key][0] + "<br>";
  //                 }
  //             }
  //             Toast.fire({
  //               icon: "error",
  //               text: errorMessahes,
  //               title: "Oops..",
  //               willOpen: () => {
  //                 const title = document.querySelector('.swal2-title');
  //                 const content = document.querySelector('.swal2-html-container');
  //                 if (title) title.style.color = '#ffffff'; // Ubah warna judul
  //                 if (content) content.style.color = '#ffffff'; // Ubah warna konten
  //               }
  //             });
  //           }
  //       },
  //       error: function (response) {
  //         Toast.fire({
  //           icon: "error",
  //           text: "Maaf Coba Lagi",
  //           title: "Oops..",
  //           willOpen: () => {
  //             const title = document.querySelector('.swal2-title');
  //             const content = document.querySelector('.swal2-html-container');
  //             if (title) title.style.color = '#ffffff'; // Ubah warna judul
  //             if (content) content.style.color = '#ffffff'; // Ubah warna konten
  //           }
  //         });
  //       },
  //   });
  // });

  function displaySelectedMedia(event, previewContainerId) {
      const previewContainer = document.getElementById(previewContainerId);
      const fileInput = event.target;
      const files = fileInput.files;

      const maxImages = 2;
      const maxVideos = 1;
      let imageCount = 0;
      let videoCount = 0;

      // Clear previous previews
      previewContainer.innerHTML = '';

      // Iterate through selected files
      for (let i = 0; i < files.length; i++) {
          const file = files[i];
          const fileType = file.type;

          // Check if the file is an image
          if (fileType.startsWith('image/')) {
              if (imageCount >= maxImages) {
                  // alert('You can only upload up to 2 images.');
                  Toast.fire({
                      icon: "error",
                      text: "Anda hanya bisa mengupload 2 gambar ",
                      title: "Oops..",
                      willOpen: () => {
                          const title = document.querySelector('.swal2-title');
                          const content = document.querySelector('.swal2-html-container');
                          if (title) title.style.color = '#ffffff'; // Ubah warna judul
                          if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                  });
                  break;
              }

              const reader = new FileReader();
              reader.onload = function(e) {
                  const img = document.createElement('img');
                  img.src = e.target.result;
                  img.classList.add('img-preview');
                  img.style.maxWidth = '150px'; // Set image size
                  previewContainer.appendChild(img);
              };
              reader.readAsDataURL(file);
              imageCount++;
          }
          // Check if the file is a video
          else if (fileType.startsWith('video/')) {
              if (videoCount >= maxVideos) {
                  alert('You can only upload 1 video.');
                  Toast.fire({
                      icon: "error",
                      text: "Kamu hanya bisa mengupload 1 video",
                      title: "Oops..",
                      willOpen: () => {
                          const title = document.querySelector('.swal2-title');
                          const content = document.querySelector('.swal2-html-container');
                          if (title) title.style.color = '#ffffff'; // Ubah warna judul
                          if (content) content.style.color = '#ffffff'; // Ubah warna konten
                      }
                  });
                  break;
              }

              const reader = new FileReader();
              reader.onload = function(e) {
                  const video = document.createElement('video');
                  video.src = e.target.result;
                  video.controls = true;
                  video.style.maxWidth = '150px'; // Set video size
                  previewContainer.appendChild(video);
              };
              reader.readAsDataURL(file);
              videoCount++;
          } else {
              Toast.fire({
                  icon: "error",
                  text: "Kamu hanya bisa mengupload gambar dan video saja.",
                  title: "Oops..",
                  willOpen: () => {
                      const title = document.querySelector('.swal2-title');
                      const content = document.querySelector('.swal2-html-container');
                      if (title) title.style.color = '#ffffff'; // Ubah warna judul
                      if (content) content.style.color = '#ffffff'; // Ubah warna konten
                  }
              });
          }
      }

      if (imageCount === 0 && videoCount === 0) {
          Toast.fire({
              icon: "error",
              text: "Masukkan minimal 1 review berupa foto atau video produk",
              title: "Oops..",
              willOpen: () => {
                  const title = document.querySelector('.swal2-title');
                  const content = document.querySelector('.swal2-html-container');
                  if (title) title.style.color = '#ffffff'; // Ubah warna judul
                  if (content) content.style.color = '#ffffff'; // Ubah warna konten
              }
          });
      }
  }
</script>
@endsection

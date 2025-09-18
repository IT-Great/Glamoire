<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Glamoire</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="assets/vendors/summernote/summernote-lite.min.css">
    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        /* Form styling improvements */
        label {
            margin-bottom: 0.5rem;
        }

        /* Image upload styling */
        .image-upload-wrap {
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            position: relative;
            background: #f8f9fa;
            transition: all 0.2s ease;
            cursor: pointer;
            min-height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-upload-wrap:hover {
            background: #fff;
            border-color: #adb5bd;
        }

        .file-upload-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .file-upload-content {
            display: none;
            text-align: center;
            position: relative;
        }

        /* Preview image styling */
        .upload__img-box-single {
            width: 100%;
            margin-bottom: 1rem;
            position: relative;
        }

        .upload__img-close {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 26px;
            z-index: 1;
            cursor: pointer;
            color: white;
            font-size: 14px;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Select2 improvements */
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px;
            padding-right: 30px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 6px;
        }

        /* Card improvements */
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        /* Summernote improvements */
        .note-editor.note-frame {
            border-radius: 0.25rem;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="mb-2">Buat Artikel</h3>
                                <p>Buat artikel/konten Anda pada halaman ini</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-article') }}" class="d-inline-flex align-items-center"><i
                                                class="bi bi-file-richtext me-1"></i>Artikel</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buat Artikel</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main card with shadow and rounded corners -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0"><i class="bi bi-file-earmark-plus me-2"></i>Buat Artikel Baru</h4>
                    <p class="text-muted small mb-0">Isi formulir di bawah ini untuk membuat artikel baru</p>
                </div>

                <div class="card-body">
                    <form class="form" action="{{ route('store-article') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom kiri -->
                            <div class="col-lg-8">
                                <!-- Input Judul Artikel dengan penghitung karakter -->
                                <div class="form-group mb-4">
                                    <label for="article-title" class="form-label fw-bold">
                                        <i class="bi bi-type me-1"></i>Judul Artikel <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                        <input type="text" class="form-control" name="title" id="article-title"
                                            placeholder="Masukkan judul yang menarik" required>
                                    </div>
                                    <small class="text-muted mt-1">Judul yang menarik meningkatkan keterlibatan
                                        pembaca (0/100 karakter)</small>
                                </div>

                                <!-- Editor Konten -->
                                <div class="form-group mb-4">
                                    <label for="summernote" class="form-label fw-bold">
                                        <i class="bi bi-file-richtext me-1"></i>Konten Artikel <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted small">Format konten artikel Anda dengan
                                                    editor di bawah ini</span>

                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <textarea id="summernote" name="content" class="form-control"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Kolom kanan (sidebar) -->
                            <div class="col-lg-4">
                                <!-- Kartu Pengaturan Artikel -->
                                <div class="card mb-4 border-light shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-gear me-1"></i>Pengaturan Artikel
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Dropdown Kategori -->
                                        <div class="form-group mb-4">
                                            <label for="category-select" class="form-label fw-bold">
                                                <i class="bi bi-tag me-1"></i>Kategori <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <select class="form-select select2-basic-category" id="category-select"
                                                name="category_article_id" required>
                                                <option value="" disabled selected>Pilih kategori
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Pilih kategori yang paling
                                                relevan</small>
                                        </div>

                                        <!-- Upload Gambar -->
                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="bi bi-image me-1"></i>Gambar Unggulan <span
                                                    class="text-danger">*</span>
                                            </label>

                                            <div class="image-upload-container">
                                                <!-- Area Upload -->
                                                <div class="image-upload-wrap" id="single-image-upload-wrap">
                                                    <input type="file" name="image" class="file-upload-input"
                                                        onchange="readURLSingle(this);" accept="image/*">
                                                    <div class="drag-text text-center p-4">
                                                        <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                                                        <p class="mb-0">Seret dan lepas atau klik untuk
                                                            mengunggah</p>
                                                        <small class="text-muted">Rekomendasi: 1200×628px,
                                                            maksimal 2MB</small>
                                                    </div>
                                                </div>

                                                <!-- Pratinjau -->
                                                <div class="file-upload-content" id="single-file-upload-content">
                                                </div>
                                            </div>

                                            @if ($errors->has('image'))
                                                <p style="color: red" class="mt-2">
                                                    {{ $errors->first('image') }}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 justify-content-end mt-4 border-top pt-4">
                            <a href="{{ route('index-article') }}"
                                class="btn btn-outline-secondary d-inline-flex align-items-center">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>Posting Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/vendors/select2.js"></script>
    <!-- toastify -->
    <script src="assets/vendors/toastify/toastify.js"></script>
    <!-- summernote -->
    <script src="assets/vendors/summernote/summernote-lite.min.js"></script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('.select2-basic-category').select2({
                width: '100%',
                // Gunakan templateResult untuk mengontrol tampilan dropdown items
                templateResult: formatState,
                // Gunakan templateSelection untuk mengontrol selected item
                templateSelection: formatState,
                dropdownCssClass: 'select-lg-dropdown'
            });

            // Fungsi untuk format tampilan item
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                // Buat container dengan style yang mencegah overflow
                var $state = $(
                    '<span style="white-space: normal; word-break: break-word; display: block;">' + state.text +
                    '</span>'
                );

                return $state;
            }
        });
    </script>

    {{-- summernote --}}
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
        })
        $("#hint").summernote({
            height: 100,
            toolbar: false,
            placeholder: 'type with apple, orange, watermelon and lemon',
            hint: {
                words: ['apple', 'orange', 'watermelon', 'lemon'],
                match: /\b(\w{1,})$/,
                search: function(keyword, callback) {
                    callback($.grep(this.words, function(item) {
                        return item.indexOf(keyword) === 0;
                    }));
                }
            }
        });
    </script>

    {{-- untuk upload image --}}
    <script>
        function readURLSingle(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#single-image-upload-wrap').hide();

                    $('#single-file-upload-content').html(`
                    <div class="upload__img-box-single">
                        <div class="upload__img-close" onclick="removeImageSingle()">×</div>
                        <div class="img-bg" style="background-image: url('${e.target.result}')"></div>
                        <p class="text-muted small mt-2">Click the × to remove the image</p>
                    </div>
                `);

                    $('#single-file-upload-content').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImageSingle() {
            $('.file-upload-input').val('');
            $('#single-file-upload-content').hide();
            $('#single-file-upload-content').html('');
            $('#single-image-upload-wrap').show();
        }

        // Character counter for title
        $(document).ready(function() {
            $('#article-title').on('input', function() {
                const maxLength = 100;
                const currentLength = $(this).val().length;
                $('small:contains("characters")').text(
                    `A compelling title improves reader engagement (${currentLength}/${maxLength} characters)`
                );

                if (currentLength > maxLength) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>

</body>

</html>

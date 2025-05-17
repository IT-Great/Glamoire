<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article - Glamoire</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }


        /* Styling container Select2 */
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        /* Styling rendered text */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px;
            padding-right: 30px;
        }

        /* Styling arrow position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 6px;
        }

        /* Tambahkan styling untuk dropdown options */
        .select-lg-dropdown .select2-results__option {
            padding: 6px 12px;
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
                                <h3 class="mb-2">Article Management</h3>
                                <p>Tinjau dan update semua artikel anda</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-article') }}"
                                            style="text-decoration: none;">Article</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Article</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Horizontal form layout section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('update-article', $article->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <!-- Kolom Kiri -->
                                                <div class="col-lg-8">
                                                    <!-- Input Judul Artikel dengan Hitung Karakter -->
                                                    <div class="form-group mb-4">
                                                        <label for="article-title" class="form-label fw-bold">
                                                            <i class="bi bi-type me-1"></i>Judul Artikel <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="bi bi-pencil"></i></span>
                                                            <input type="text" class="form-control" name="title"
                                                                id="article-title"
                                                                placeholder="Masukkan judul artikel yang menarik"
                                                                value="{{ $article->title }}" required>
                                                        </div>
                                                        <small class="text-muted mt-1">
                                                            Judul menarik meningkatkan keterlibatan pembaca
                                                            ({{ strlen($article->title) }}/100 karakter)
                                                        </small>
                                                    </div>

                                                    <!-- Editor Konten Artikel -->
                                                    <div class="form-group mb-4">
                                                        <label for="summernote" class="form-label fw-bold">
                                                            <i class="bi bi-file-richtext me-1"></i>Konten Artikel <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <div class="card">
                                                            <div class="card-header bg-light py-2">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <span class="text-muted small">
                                                                        Format konten artikel menggunakan editor berikut
                                                                    </span>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-secondary"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Perbesar Editor">
                                                                        <i class="bi bi-arrows-fullscreen"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body p-0">
                                                                <textarea id="summernote" name="content" class="form-control">{{ $article->content }}</textarea>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted mt-1">Gunakan media dan format yang
                                                            tersedia dalam editor</small>
                                                    </div>
                                                </div>

                                                <!-- Kolom Kanan -->
                                                <div class="col-lg-4">
                                                    <!-- Kartu Pengaturan Artikel -->
                                                    <div class="card mb-4 border-light shadow-sm">
                                                        <div class="card-header bg-light">
                                                            <h5 class="mb-0"><i class="bi bi-gear me-1"></i>Pengaturan
                                                                Artikel</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <!-- Dropdown Kategori -->
                                                            <div class="form-group mb-4">
                                                                <label for="category-select" class="form-label fw-bold">
                                                                    <i class="bi bi-tag me-1"></i>Kategori <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select select2-basic-category"
                                                                    id="category-select" name="category_article_id"
                                                                    required>
                                                                    <option value="" disabled>Pilih kategori
                                                                    </option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            {{ $article->category_article_id == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <small class="text-muted">Pilih kategori yang paling
                                                                    relevan untuk artikel ini</small>
                                                            </div>

                                                            <!-- Upload Gambar -->
                                                            <div class="mb-4">
                                                                <div class="card-header bg-light">
                                                                    <h5 class="mb-0"><i
                                                                            class="bi bi-image me-1"></i>Gambar
                                                                        Unggulan</h5>
                                                                </div>
                                                                <div class="">
                                                                    @if ($article->image)
                                                                        <div class="mb-4 mt-2">
                                                                            <label
                                                                                class="form-label fw-semibold">Gambar
                                                                                Saat Ini</label>
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <a href="{{ Storage::url($article->image) }}"
                                                                                    target="_blank">
                                                                                    <img src="{{ Storage::url($article->image) }}"
                                                                                        alt="{{ $article->title }}"
                                                                                        class="rounded shadow-sm"
                                                                                        style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                                </a>
                                                                                <div>
                                                                                    <p class="mb-1 fw-bold">
                                                                                        {{ basename($article->image) }}
                                                                                    </p>
                                                                                    <small class="text-muted">Gambar
                                                                                        unggulan yang diunggah
                                                                                        sebelumnya</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <div class="mb-3">
                                                                        <label for="file-input-article"
                                                                            class="form-label fw-semibold">
                                                                            Unggah Gambar Unggulan Baru (Opsional)
                                                                        </label>
                                                                        <div class="border rounded p-4 text-center position-relative {{ $errors->has('image') ? 'border-danger' : 'border-secondary-subtle' }}"
                                                                            style="background-color: #f9f9f9;">
                                                                            <input type="file" name="image"
                                                                                id="file-input-article"
                                                                                class="form-control d-none file-upload-input"
                                                                                onchange="previewFile(this, 'article')"
                                                                                accept="image/*">
                                                                            <label for="file-input-article"
                                                                                class="cursor-pointer">
                                                                                <i class="bi bi-cloud-arrow-up"
                                                                                    style="font-size: 2.5rem; color: #6c757d;"></i>
                                                                                <p class="mt-2 mb-1 fw-medium">Klik
                                                                                    untuk memilih file</p>
                                                                                <small
                                                                                    class="text-muted d-block">Format
                                                                                    diterima: JPG, PNG — Maks.
                                                                                    2MB</small>
                                                                            </label>
                                                                        </div>
                                                                        @if ($errors->has('image'))
                                                                            <div class="text-danger mt-2 small">
                                                                                {{ $errors->first('image') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <div class="file-upload-content mt-3 d-none"
                                                                        id="file-upload-content-article">
                                                                        <label class="form-label fw-semibold">Pratinjau
                                                                            Gambar Unggulan Baru</label>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <a href="#"
                                                                                id="file-preview-link-article"
                                                                                target="_blank">
                                                                                <img class="file-upload-image rounded shadow-sm d-none"
                                                                                    id="file-upload-image-article"
                                                                                    src="#" alt="Preview"
                                                                                    style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                                <i id="file-upload-icon-article"
                                                                                    class="bi bi-file-earmark-pdf d-none"
                                                                                    style="font-size: 2.5rem;"></i>
                                                                            </a>
                                                                            <div class="flex-grow-1">
                                                                                <div class="fw-bold"
                                                                                    id="image-file-name-article">Nama
                                                                                    File</div>
                                                                                <small class="text-muted">Gambar
                                                                                    unggulan yang akan diunggah</small>
                                                                            </div>
                                                                            <button type="button"
                                                                                onclick="removeUpload('article')"
                                                                                class="btn btn-sm btn-outline-danger">
                                                                                <i class="bi bi-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tombol Aksi -->
                                            <div class="d-flex gap-2 justify-content-end mt-4 border-top pt-4">
                                                <a href="{{ route('index-article') }}" class="btn btn-secondary">
                                                    <i class="bi bi-x-lg me-1"></i>Batal
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-save me-1"></i>Perbarui Artikel
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2.js') }}"></script>
    <!-- toastify -->
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2-basic-category').select2({
                width: '100%',
                templateResult: formatState,
                templateSelection: formatState,
                dropdownCssClass: 'select-lg-dropdown'
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                var $state = $(
                    '<span style="white-space: normal; word-break: break-word; display: block;">' + state.text +
                    '</span>'
                );

                return $state;
            }

            // Initialize Summernote
            $('#summernote').summernote({
                tabsize: 2,
                height: 300,
            });

            // Character counter for title
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

        // Image preview functions
        function previewFile(input, type) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('file-upload-content-' + type).classList.remove('d-none');
                    document.getElementById('file-upload-image-' + type).src = e.target.result;
                    document.getElementById('file-preview-link-' + type).href = e.target.result;
                    document.getElementById('image-file-name-' + type).innerText = input.files[0].name;
                    if (input.files[0].type === 'application/pdf') {
                        document.getElementById('file-upload-icon-' + type).classList.remove('d-none');
                        document.getElementById('file-upload-image-' + type).classList.add('d-none');
                    } else {
                        document.getElementById('file-upload-icon-' + type).classList.add('d-none');
                        document.getElementById('file-upload-image-' + type).classList.remove('d-none');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeUpload(type) {
            const fileInput = document.querySelector('#file-input-' + type);
            fileInput.value = '';
            document.getElementById('file-upload-content-' + type).classList.add('d-none');
        }
    </script>
</body>

</html>

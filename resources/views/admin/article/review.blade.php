<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        /* Article preview styling */
        .article-preview {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .featured-image-container {
            position: relative;
            height: 0;
            padding-bottom: 40%;
            overflow: hidden;
        }

        .featured-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #343a40;
        }

        .article-content {
            font-size: 1rem;
            line-height: 1.6;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.25rem;
            margin: 1rem 0;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .article-content p {
            margin-bottom: 1rem;
        }

        .article-content blockquote {
            border-left: 4px solid #dee2e6;
            padding-left: 1rem;
            font-style: italic;
            margin-left: 0;
        }

        .article-content ul,
        .article-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .article-content a {
            color: #0d6efd;
            text-decoration: none;
        }

        .article-content a:hover {
            text-decoration: underline;
        }

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Status styling */
        .status-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 193, 7, 0.1);
        }

        /* Card improvements */
        .card {
            border: none;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        /* Badge styling */
        .badge {
            padding: 0.4rem 0.6rem;
            font-weight: 500;
        }

        /* Better buttons */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* List group styling */
        .list-group-item {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            border-color: #e9ecef;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')
        <div id="main">
            <div class="page-heading">
                <!-- Header area with improved styling -->
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="page-title mb-0">
                                <i class="bi bi-file-earmark-text me-2"></i>Article Preview
                            </h2>
                            <p class="text-muted">Tinjau Article anda</p>
                        </div>
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-article') }}"><i
                                                class="bi bi-journal-text me-1"></i>Article</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Review Article</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Article info card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Article Information</h5>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="article-title mb-1">{{ $article->title }}</h5>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-light text-primary me-2">
                                            <i class="bi bi-tag-fill me-1"></i>{{ $article->categoryArticle->name }}
                                        </span>
                                        <span class="text-muted small">
                                            <i class="bi bi-calendar3 me-1"></i>Created:
                                            {{ $article->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article content preview -->
                    <div class="row">
                        <!-- Main content area -->
                        <div class="col-lg-9">
                            <div class="card shadow-sm article-preview mb-4">
                                <!-- Featured image with improved display -->
                                <div class="featured-image-container">
                                    <a href="{{ asset('storage/' . $article->image) }}" target="_blank"
                                        title="Buka gambar di tab baru">
                                        <img src="{{ asset('storage/' . $article->image) }}"
                                            alt="{{ $article->title }}" class="img-fluid featured-image">
                                    </a>
                                </div>

                                <!-- Article content with improved styling -->
                                <div class="card-body article-content p-4">
                                    <div class="content-wrapper">
                                        {!! $article->content !!}
                                    </div>
                                </div>

                                <!-- Article footer with meta information -->
                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="text-muted small">
                                                <i class="bi bi-person me-1"></i>Author:
                                                {{ $article->user->name ?? 'Admin' }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i>Reading time:
                                                {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar with additional information -->
                        <div class="col-lg-3">
                            <!-- Article status card - removed publish status -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="bi bi-activity me-2"></i>Article Status</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="status-icon me-3">
                                            <i class="bi bi-file-text text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Article</h6>
                                            <span class="text-muted small">Last updated:
                                                {{ $article->updated_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions card -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="bi bi-tools me-2"></i>Actions</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('edit-article', $article->id) }}"
                                            class="btn btn-outline-primary">
                                            <i class="bi bi-pencil me-1"></i>Edit Article
                                        </a>

                                        <a href="{{ route('index-article') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-1"></i>Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    <script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .page-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 2rem 0;
            color: white;
            margin-bottom: 2rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #435ebe;
        }

        .breadcrumb-item a {
            color: #435ebe;
            text-decoration: none;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .detail-group {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 500;
        }

        .stats-card {
            background: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
        }

        .stats-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .stats-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .promo-banner {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.75rem;
        }

        .product-table img {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            object-fit: cover;
        }

        .product-table td {
            vertical-align: middle;
        }

        .product-name {
            font-weight: 500;
            color: #111827;
        }

        .discount-badge {
            background: #fee2e2;
            color: #ef4444;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
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

                    <h3 class="mb-2">Buat Promo</h3>
                    <p class="mb-3">
                        Buat Promo sekarang untuk menarik Pembeli.
                    </p>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-promo') }}">Promo
                                        </a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Promo
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Promo Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="fas fa-tag me-1"></i> Promo Name
                                            </div>
                                            <div class="detail-value">{{ $promo->promo_name }}</div>
                                        </div>

                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="fas fa-calendar me-1"></i> Promo Period
                                            </div>
                                            <div class="mb-1">
                                                <i class="bi bi-calendar-event me-2"></i>
                                                @if ($promo->start_date)
                                                    {{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d F Y') }}
                                                @endif
                                            </div>
                                            <div>
                                                <i class="bi bi-calendar-event-fill me-2"></i>
                                                @if ($promo->end_date)
                                                    {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d F Y') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-group">
                                            <div class="detail-label">
                                                <i class="fas fa-percent me-1"></i> Discount
                                            </div>
                                            <div class="detail-value">
                                                <span class="discount-badge">
                                                    @if ($promo->discount_type === 'nominal')
                                                        Rp {{ number_format($promo->discount, 0, ',', '.') }}
                                                    @else
                                                        {{ $promo->discount }}%
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Products in Promo</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Stock</th>
                                                <th>Limit Stock</th>
                                                <th>Regular Price</th>
                                                <th>Discounted Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($promo->products as $product)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ Storage::url($product->main_image) }}"
                                                                alt="Product" class="me-3"
                                                                onclick="openImageInNewTab('{{ Storage::url($product->main_image) }}')">
                                                            <span
                                                                class="product-name">{{ Str::limit($product->product_name, 20, '...') }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $product->stock_quantity }}</td>
                                                    <td>
                                                        @if ($product->pivot->limit_stock)
                                                            <span class="badge bg-info">
                                                                {{ $product->pivot->limit_stock }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary">
                                                                Unlimited
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>Rp.
                                                        {{ number_format($product->regular_price, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <span class="text-danger">
                                                            Rp.
                                                            @if ($promo->discount_type === 'nominal')
                                                                {{ number_format($product->regular_price - $promo->discount, 0, ',', '.') }}
                                                            @else
                                                                {{ number_format($product->regular_price * (1 - $promo->discount / 100), 0, ',', '.') }}
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Promo Banner</h5>
                            </div>
                            <div class="card-body">
                                @if ($promo->image)
                                    <img src="{{ Storage::url($promo->image) }}" alt="Promo Banner"
                                        class="promo-banner mb-4"
                                        onclick="openImageInNewTab('{{ Storage::url($promo->image) }}')">
                                @else
                                    <p>No banner uploaded</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.layouts.footer')
        </div>

    </div>

    <script>
        // Fungsi untuk membuka gambar di tab baru
        function openImageInNewTab(url) {
            window.open(url, '_blank');
        }

        // Fungsi untuk menghapus gambar utama
        function removeImage(field) {
            if (field === 'main_image') {
                document.querySelector('#single-file-upload-content').innerHTML = '';
                // Kirim permintaan AJAX untuk menghapus gambar dari server jika perlu
            } else {
                // Implementasikan penghapusan gambar galeri jika perlu
            }
        }

        // Preview untuk Main Image
        function readURLSingle(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var html = `
            <div class="upload__img-wrap">
                <div class="upload__img-box-single">
                    <div class="img-bg-single" style="background-image: url('${e.target.result}');" onclick="openImageInNewTab('${e.target.result}')"></div>
                    <div class="upload__img-close" onclick="removeImage('main_image')">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                    </div>
                </div>
            </div>
            `;
                    document.querySelector('#single-file-upload-content').innerHTML = html;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Preview untuk Multiple Images
        function handleFiles(files) {
            const fileUploadContent = document.getElementById('file-upload-content');
            const fileErrorMessage = document.getElementById('image-error');
            const fileInput = document.getElementById('images');

            fileUploadContent.innerHTML = ''; // Clear existing previews
            fileErrorMessage.style.display = 'none'; // Hide error message
            fileInput.classList.remove('is-invalid'); // Remove invalid class

            const maxFiles = 6;
            if (files.length > maxFiles) {
                fileErrorMessage.innerHTML = 'You can only upload a maximum of ' + maxFiles + ' images.';
                fileErrorMessage.style.display = 'block'; // Show error message
                fileInput.classList.add('is-invalid'); // Add invalid class
                return;
            }
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.startsWith('image/')) {
                    continue;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const html = `
            <div class="upload__img-box-multiple">
                <div class="img-bg" style="background-image: url('${e.target.result}');" onclick="openImageInNewTab('${e.target.result}')"></div>
                <div class="upload__img-close" onclick="removeUploadedImage(this)">
                    <i class="bi bi-x-circle-fill text-danger"></i>
                </div>
            </div>
            `;
                    fileUploadContent.insertAdjacentHTML('beforeend', html);
                }

                reader.readAsDataURL(file);
            }
        }

        // Menghapus gambar galeri yang diupload (frontend saja)
        function removeUploadedImage(element) {
            element.parentElement.remove();
            // Kirim permintaan AJAX untuk menghapus gambar dari server jika perlu
        }

        function readURLSingle(input) {
            const singleUploadContent = document.getElementById('single-file-upload-content');
            singleUploadContent.innerHTML = ''; // Kosongkan konten jika sudah ada gambar sebelumnya

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Buat elemen gambar
                    const imgBox = document.createElement('div');
                    imgBox.classList.add('upload__img-box-single');

                    const imgBg = document.createElement('div');
                    imgBg.classList.add('img-bg');
                    imgBg.style.backgroundImage = `url(${e.target.result})`;

                    // Tambahkan tombol close
                    const imgClose = document.createElement('div');
                    imgClose.classList.add('upload__img-close');
                    imgClose.onclick = function() {
                        singleUploadContent.innerHTML = ''; // Hapus gambar jika tombol close diklik
                        input.value = ''; // Reset input file
                    };

                    imgBg.appendChild(imgClose);
                    imgBox.appendChild(imgBg);
                    singleUploadContent.appendChild(imgBox);
                };
                reader.readAsDataURL(file);
            }
        }

        let selectedFiles = [];

        function handleFiles(files) {
            const fileUploadContent = document.getElementById('file-upload-content');
            const imageError = document.getElementById('image-error');
            const totalFiles = selectedFiles.length + files.length;

            // Reset pesan error
            imageError.style.display = 'none';
            imageError.textContent = '';

            // Kosongkan konten gambar lama
            fileUploadContent.innerHTML = '';

            // Cek jika jumlah file melebihi 6
            if (totalFiles > 6) {
                imageError.textContent = 'You can upload a maximum of 6 images.';
                imageError.style.display = 'block';
                return;
            }

            // Tambahkan file ke array selectedFiles
            selectedFiles = []; // Reset selectedFiles array
            for (let i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);
            }

            // Tampilkan gambar di form
            Array.from(files).forEach(file => {
                if (!file.type.match('image.*')) return; // Hanya file gambar

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Buat elemen gambar
                    const imgBox = document.createElement('div');
                    imgBox.classList.add('upload__img-box-multiple');

                    const imgBg = document.createElement('div');
                    imgBg.classList.add('img-bg');
                    imgBg.style.backgroundImage = `url(${e.target.result})`;

                    // Tambahkan tombol close
                    const imgClose = document.createElement('div');
                    imgClose.classList.add('upload__img-close');
                    imgClose.onclick = function() {
                        const index = Array.from(fileUploadContent.children).indexOf(imgBox);
                        selectedFiles.splice(index, 1);
                        fileUploadContent.removeChild(imgBox);
                    };

                    imgBg.appendChild(imgClose);
                    imgBox.appendChild(imgBg);
                    fileUploadContent.appendChild(imgBox);
                };
                reader.readAsDataURL(file);
            });
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('images');
            const dataTransfer = new DataTransfer(); // Digunakan untuk menggabungkan file di input file

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
        });
    </script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanya Jawab - Glamoire</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        .page-title h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: var(--text-secondary);
            margin-bottom: 0;
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

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Stats Card Styling */
        .stats-card {
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stats-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .stats-card-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-title {
            font-size: 0.9rem;
            font-weight: 400;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Product Card Styling */
        .product-card {
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table> :not(:first-child) {
            border-top: none;
        }

        .table th {
            font-weight: 600;
            color: var(--text-primary);
            background-color: rgba(243, 246, 249, 0.6);
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding: 1.25rem 1.5rem;
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .table>tbody>tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table>tbody>tr:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }

        /* Product Image */
        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        /* Product Details */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .product-meta {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* Message Preview */
        .message-preview {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Stock Badge */
        .stock-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .badge {
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-buttons .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .badge.bg-info {
            background-color: var(--info-color) !important;
            color: white;
        }

        .badge.bg-danger {
            background-color: var(--danger-color) !important;
        }

        /* Search and Filter Container */
        .search-filter-container {
            margin-bottom: 1.5rem;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-input {
            border-radius: 10px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .filter-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            font-size: 0.95rem;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .filter-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        /* Quick Action Button */
        .quick-action-btn {
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .stats-card {
                margin-bottom: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .table td {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .product-details {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .d-flex.align-items-center.gap-3 {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .action-buttons .badge {
                display: block;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--secondary-color) !important;
            color: white !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Empty state */
        .empty-state {
            padding: 3rem;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            opacity: 0.5;
            margin-bottom: 1.5rem;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <!-- Judul Halaman -->
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3 class="mb-2">Tanya Jawab </h3>
                            <p>Buat dan atur tanya jawab untuk mempermudah pengguna memahami penggunaan aplikasi</p>
                        </div>
                    </div>
                </div>

                <!-- Navigasi Breadcrumb -->
                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index-contactus-admin') }}" class="d-flex align-items-center">
                                        <i class="bi bi-envelope me-1"></i>Tanya Jawab
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Tanya Jawab</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row mb-4 slide-in">
                    <!-- Total FAQ -->
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <div class="stats-card stats-card-primary">
                            <div class="stats-icon">
                                <i class="bi bi-question-circle-fill"></i>
                            </div>
                            <div class="stats-title">Total Tanya Jawab</div>
                            <h3 class="stats-number">{{ $totalFaq }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Total pertanyaan yang tersedia
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Total Kategori FAQ -->
                    <div class="col-12 col-md-6">
                        <div class="stats-card stats-card-warning">
                            <div class="stats-icon">
                                <i class="bi bi-tags-fill"></i>
                            </div>
                            <div class="stats-title">Total Kategori Tanya Jawab</div>
                            <h3 class="stats-number">{{ $totalCategory }}</h3>
                            <div class="mt-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-folder me-1"></i>
                                    Jumlah kategori unik
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Table Section -->
                <div class="card category-card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4>Daftar Tanya Jawab</h4>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#faqModal">
                                    <i class="fa fa-plus"></i> Buat Tanya Jawab
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Total Tanya Jawab</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqsByCategory as $category => $faqList)
                                        <tr>
                                            <td>
                                                <div class="category-name">{{ $category }}</div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $faqList->count() }} Tanya Jawab</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary d-inline-flex align-items-center"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#faq-{{ Str::slug($category) }}"
                                                    aria-expanded="false">
                                                    <i class="bi bi-eye me-1"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="faq-{{ Str::slug($category) }}">
                                            <td colspan="3">
                                                <ul>
                                                    @foreach ($faqList as $faq)
                                                        <li>
                                                            <strong>{{ $faq->question }}</strong>
                                                            <p>{{ $faq->answer }}</p>
                                                            <button class="btn btn-sm btn-danger mb-2"
                                                                onclick="deleteFaq({{ $faq->id }})">Delete</button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <!-- Add FAQ Modal -->
                    <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-white">
                                    <h5 class="modal-title">
                                        <i class="bi bi-plus-square"></i> Tambah Tanya Jawab
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form id="faqForm">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Form FAQ -->
                                        <div class="mb-3">
                                            <label for="category" class="form-label fw-medium">Kategori <span
                                                    style="color: red">*</span></label>

                                            <select class="form-select select2 me-2" name="category">
                                                <option value="Account">Account</option>
                                                <option value="My Order">My Order</option>
                                                <option value="Payment">Payment</option>
                                                <option value="Shipping">Shipping</option>
                                                <option value="Refund & Return Policy">Refund & Return Policy</option>
                                                <option value="Scam Alert">Scam Alert</option>
                                            </select>

                                            <small class="text-muted" style="font-size: 14px;">
                                                Silakan masukkan nama kategori yang unik dan deskriptif.
                                            </small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="question" class="form-label fw-medium">Pertanyaan <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="question"
                                                name="question" required>

                                            <small class="text-muted" style="font-size: 14px;">
                                                Silakan masukkan nama kategori yang unik dan deskriptif.
                                            </small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="answer" class="form-label fw-medium">Jawaban <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>

                                            <small class="text-muted" style="font-size: 14px;">
                                                Silakan masukkan nama kategori yang unik dan deskriptif.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="bi bi-x-lg"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                                            <i class="bi bi-save me-1"></i> Save Tanya Jawab
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
    </div>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="assets/vendors/fontawesome/all.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 when modal is shown
            $('#faqModal').on('shown.bs.modal', function() {
                $('.select2').select2({
                    dropdownParent: $('#faqModal') // Important for modal
                });
            });

            // Handle FAQ form submission
            $('#faqForm').on('submit', function(e) {
                e.preventDefault();
                submitFaqForm($(this), '#faqModal');
            });

            // Function to submit the FAQ form
            function submitFaqForm(form, modalId) {
                $.ajax({
                    url: "{{ route('faqs.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Close modal
                            const faqModal = new bootstrap.Modal(document.getElementById('faqModal'));
                            faqModal.hide();

                            // Reset form
                            form[0].reset();

                            // Show success message with timer and progress bar
                            let timerInterval;
                            Swal.fire({
                                title: 'Success!',
                                text: 'FAQ has been successfully added.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#4A69E2',
                                didOpen: () => {
                                    // Initialize timer
                                    const content = Swal.getHtmlContainer();
                                    const $ = Swal.getPopup().querySelector.bind(Swal
                                        .getPopup());

                                    // Add timer text
                                    const timerElement = document.createElement('div');
                                    timerElement.textContent = 'Auto-closing in 2s';
                                    timerElement.style.marginTop = '10px';
                                    timerElement.style.fontSize = '0.8em';
                                    timerElement.style.color = '#666';
                                    timerElement.id = 'swal-timer-text';

                                    if (content) {
                                        content.appendChild(timerElement);
                                    }

                                    timerInterval = setInterval(() => {
                                        const timeLeft = Math.ceil(Swal
                                            .getTimerLeft() / 1000);
                                        if (document.getElementById(
                                                'swal-timer-text')) {
                                            document.getElementById(
                                                    'swal-timer-text').textContent =
                                                `Auto-closing in ${timeLeft}s`;
                                        }
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                }
                            }).then((result) => {
                                // Reload page after alert is closed
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle server errors
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to add FAQ. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33',
                        });
                    }
                });
            }

            // Handle FAQ deletion
            function deleteFaq(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/faqs/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Show success message with timer and progress bar
                                    let timerInterval;
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'FAQ has been deleted.',
                                        icon: 'success',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#4A69E2',
                                        didOpen: () => {
                                            // Initialize timer
                                            const content = Swal.getHtmlContainer();
                                            const $ = Swal.getPopup().querySelector
                                                .bind(Swal.getPopup());

                                            // Add timer text
                                            const timerElement = document
                                                .createElement('div');
                                            timerElement.textContent =
                                                'Auto-closing in 2s';
                                            timerElement.style.marginTop = '10px';
                                            timerElement.style.fontSize = '0.8em';
                                            timerElement.style.color = '#666';
                                            timerElement.id = 'swal-timer-text';

                                            if (content) {
                                                content.appendChild(timerElement);
                                            }

                                            timerInterval = setInterval(() => {
                                                const timeLeft = Math.ceil(
                                                    Swal
                                                    .getTimerLeft() /
                                                    1000);
                                                if (document.getElementById(
                                                        'swal-timer-text'
                                                    )) {
                                                    document.getElementById(
                                                            'swal-timer-text'
                                                        ).textContent =
                                                        `Auto-closing in ${timeLeft}s`;
                                                }
                                            }, 100);
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval);
                                        }
                                    }).then((result) => {
                                        // Reload page after alert is closed
                                        location.reload();
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to delete FAQ.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#d33',
                                });
                            }
                        });
                    }
                });
            }

            // Attach the delete function to the delete buttons
            window.deleteFaq = deleteFaq;
        });
    </script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

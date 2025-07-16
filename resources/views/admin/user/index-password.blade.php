<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna - Glamoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

        .user-nav {
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .user-nav-item {
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: #4a4a4a;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid transparent;
        }

        .user-nav-item i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .user-nav-item.active {
            background-color: var(--primary-color);
            /* Make sure --primary-color is defined */
            color: #fff;
            border-color: var(--primary-color);
        }

        .user-nav-item.active i {
            transform: scale(1.2);
            color: #fff;
        }

        .user-nav-item:hover:not(.active) {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
        }
    </style>

</head>

<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.navbar')

        <div id="main">
            <div class="page-heading">
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="page-title">
                            <h3 class="mb-2">Pengguna</h3>
                            <p>
                                Halaman ini digunakan untuk <strong>mengelola password pengguna</strong> dalam sistem.
                                Anda dapat melihat daftar semua pengguna, termasuk informasi peran serta melakukan perubahan password jika diperlukan.
                            </p>
                        </div>
                    </div>
                </div>


                <!-- Navigasi Breadcrumb -->
                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index-user-admin') }}" class="d-inline-flex align-items-center"><i class="bi bi-people me-1"></i>Pengguna</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="user-nav d-flex justify-content-start align-items-center gap-3 flex-wrap">
                    <a href="{{ route('index-user-admin') }}"
                        class="user-nav-item {{ Route::currentRouteName() == 'index-user-admin' ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Daftar Pengguna
                    </a>
                    <a href="{{ route('password-user-admin') }}"
                        class="user-nav-item {{ Route::currentRouteName() == 'password-user-admin' ? 'active' : '' }}">
                        <i class="bi bi-key"></i> Kelola Password
                    </a>
                </div>


                <div class="page-heading">
                    <h3 class="mb-4">Kelola Password Pengguna</h3>

                    {{-- SECTION: Admins --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Admin, Super Admin, Accounting, Admin Gudang</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm d-inline-flex align-items-center"
                                                    onclick="openChangePasswordModal('{{ $user->id }}', '{{ addslashes($user->fullname) }}', '{{ addslashes($user->email) }}')">
                                                    <i class="bi bi-key me-1"></i> Change Password
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- SECTION: Users --}}
                    <div class="card">
                        <div class="card-header">
                            <h5>Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($normalUsers as $user)
                                        <tr>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center"
                                                    onclick="openChangePasswordModal('{{ $user->id }}', '{{ addslashes($user->fullname) }}', '{{ addslashes($user->email) }}')">
                                                    <i class="bi bi-key me-1"></i> Change Password
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            @include('admin.layouts.footer')
        </div>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> {{-- modal-dialog-centered untuk posisi tengah --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="changePasswordForm">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="modal_user_id">

                            <p><strong>Full Name:</strong> <span id="modal_fullname"></span></p>
                            <p><strong>Email:</strong> <span id="modal_email"></span></p>

                            <div class="mb-3 position-relative">
                                <label>New Password</label>
                                <div class="input-group">
                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                        required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="new_password">
                                        <i class="bi bi-eye-slash"></i> <!-- default: dicoret -->
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3 position-relative">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="new_password_confirmation"
                                        id="new_password_confirmation" class="form-control" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button"
                                        data-target="new_password_confirmation">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="password_error" class="alert alert-danger d-none"></div>
                            <div id="password_success" class="alert alert-success d-none"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalElement = document.getElementById('changePasswordModal');
            const passwordForm = document.getElementById('changePasswordForm');
            const passwordError = document.getElementById('password_error');
            const passwordSuccess = document.getElementById('password_success');
            const modalInstance = new bootstrap.Modal(modalElement);

            // buka modal
            window.openChangePasswordModal = (userId, fullname, email) => {
                // set data
                document.getElementById('modal_user_id').value = userId;
                document.getElementById('modal_fullname').textContent = fullname;
                document.getElementById('modal_email').textContent = email;

                // reset form & pesan
                passwordForm.reset();
                passwordError.textContent = '';
                passwordError.classList.add('d-none');
                passwordSuccess.textContent = '';
                passwordSuccess.classList.add('d-none');

                modalInstance.show();
            };

            // toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(btn => {
                btn.addEventListener('click', () => {
                    const targetId = btn.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = btn.querySelector('i');

                    if (input.type === 'password') {
                        // ubah jadi terlihat
                        input.type = 'text';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    } else {
                        // ubah jadi disembunyikan
                        input.type = 'password';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    }
                });
            });


            // submit
            passwordForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const formData = new FormData(passwordForm);

                // clear alerts
                passwordError.textContent = '';
                passwordError.classList.add('d-none');
                passwordSuccess.textContent = '';
                passwordSuccess.classList.add('d-none');

                fetch("{{ route('change-password-user-admin') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // SweetAlert sukses
                            let timerInterval;
                            Swal.fire({
                                title: 'Password Updated!',
                                text: data.message || 'Password has been successfully updated.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6',
                                didOpen: () => {
                                    const b = Swal.getHtmlContainer().querySelector('b');
                                    timerInterval = setInterval(() => {}, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('Closed by timer');
                                }
                            });

                            // reset form
                            passwordForm.reset();
                            document.getElementById('modal_user_id').value = formData.get('user_id');

                            // tutup modal
                            setTimeout(() => {
                                modalInstance.hide();
                            }, 1000);
                        } else {
                            passwordError.textContent = data.message || 'An error occurred';
                            passwordError.classList.remove('d-none');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        passwordError.textContent = 'Error updating password';
                        passwordError.classList.remove('d-none');
                    });
            });
        });
    </script>




</body>

</html>

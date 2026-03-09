<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Glamoire Admin</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

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
            padding: 1.5rem 1.75rem;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-body {
            padding: 1.75rem;
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

        /* Profile Specific Styles */
        .profile-avatar-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-role-badge {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 10px rgba(99, 102, 241, 0.3);
            text-transform: uppercase;
        }

        .info-list .list-group-item {
            border: none;
            padding: 1rem 0;
            border-bottom: 1px dashed var(--border-color);
            background: transparent;
        }

        .info-list .list-group-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 35px;
            height: 35px;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            background-color: #fdfdfd;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-warning {
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
            color: #fff;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
            color: #fff;
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
                            <h3 class="mb-2">My Profile</h3>
                            <p>Kelola informasi profil dan pengaturan keamanan akun Anda</p>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                                        <i class="bi bi-grid-fill me-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm slide-in" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row slide-in">
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="profile-avatar-wrapper mt-3">
                                    <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Avatar" class="profile-avatar">
                                </div>
                                <h4 class="mb-2 text-capitalize fw-bold">{{ $user->fullname ?? $user->name }}</h4>
                                <div class="mb-4">
                                    <span class="profile-role-badge">{{ $user->role }}</span>
                                </div>
                                
                                <hr class="my-4" style="border-color: var(--border-color)">
                                
                                <ul class="list-group list-group-flush text-start info-list w-100">
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="info-icon"><i class="bi bi-person-badge"></i></div>
                                        <div>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">Username</small>
                                            <span class="fw-medium">{{ $user->name }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="info-icon"><i class="bi bi-envelope"></i></div>
                                        <div>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">Email Address</small>
                                            <span class="fw-medium">{{ $user->email }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="info-icon"><i class="bi bi-telephone"></i></div>
                                        <div>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">No. Handphone</small>
                                            <span class="fw-medium">{{ $user->handphone ?? 'Belum diatur' }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5><i class="bi bi-person-lines-fill me-2 text-primary"></i> Detail Profil</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label fw-medium">Username <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control text-black" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="fullname" class="form-label fw-medium">Nama Lengkap</label>
                                            <input type="text" class="form-control text-black" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" placeholder="Masukkan nama lengkap">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control text-black" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="handphone" class="form-label fw-medium">Nomor Handphone</label>
                                            <input type="text" class="form-control text-black" id="handphone" name="handphone" value="{{ old('handphone', $user->handphone) }}" placeholder="Contoh: 08123456789">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="gender" class="form-label fw-medium">Jenis Kelamin</label>
                                            <select class="form-select text-black" id="gender" name="gender">
                                                <option value="" disabled {{ is_null($user->gender) ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="date" class="form-label fw-medium">Tanggal Lahir</label>
                                            <input type="date" class="form-control text-black" id="date" name="date" value="{{ old('date', $user->date) }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                                            <i class="bi bi-save me-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5><i class="bi bi-shield-lock-fill me-2 text-warning"></i> Ganti Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.password') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="current_password" class="form-label fw-medium">Password Saat Ini <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="bi bi-key"></i></span>
                                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Masukkan password Anda saat ini" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="new_password" class="form-label fw-medium">Password Baru <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Minimal 8 karakter" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="new_password_confirmation" class="form-label fw-medium">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Ulangi password baru" required>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-warning d-inline-flex align-items-center">
                                            <i class="bi bi-check2-circle me-2"></i> Update Password
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

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if(session('success_password'))
                Swal.fire({
                    title: 'Aman!',
                    text: "{{ session('success_password') }}",
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif
        });
    </script>
</body>

</html>
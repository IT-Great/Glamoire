<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Glamoire</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --secondary-color: #818cf8;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
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
            font-size: 0.95rem;
        }

        .breadcrumb-header {
            margin-bottom: 1.5rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-hover);
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
            font-weight: 400;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            overflow: hidden;
            background-color: white;
        }

        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h5 {
            font-weight: 600;
            margin-bottom: 0;
            color: var(--text-primary);
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1.75rem;
        }

        /* User Profile Card */
        .profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 2rem 1rem;
        }

        .profile-wrapper {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .profile {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .status-indicator {
            position: absolute;
            width: 22px;
            height: 22px;
            background-color: var(--success-color);
            border-radius: 50%;
            bottom: 12px;
            right: 12px;
            border: 3px solid white;
        }

        .user-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .user-role {
            padding: 0.5rem 1rem;
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .user-email {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .user-stats {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 1rem;
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            flex: 1;
            padding: 1rem 0;
            border-radius: 12px;
            background-color: #f9fafb;
            transition: all 0.2s;
        }

        .stat-item:hover {
            background-color: #f3f4f6;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Detail Information */
        .info-card {
            margin-bottom: 1.5rem;
        }

        .info-card-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-card-header h5 {
            margin-bottom: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-primary);
        }

        .info-card-header h5 i {
            color: var(--primary-color);
        }

        .info-card-body {
            padding: 1.75rem;
        }

        .detail-group {
            margin-bottom: 1.5rem;
        }

        .detail-group:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .detail-label i {
            color: var(--primary-color);
            font-size: 0.95rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: #f9fafb;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            border-color: var(--primary-color);
        }

        .form-control:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
            color: var(--text-secondary);
        }

        .form-select {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: #f9fafb;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-select:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
            color: var(--text-secondary);
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-outline-secondary:hover {
            background-color: #f3f4f6;
            color: var(--text-primary);
        }

        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 1.25rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .page-container {
                padding: 1rem 0;
            }

            .card-body {
                padding: 1.25rem;
            }

            .user-stats {
                flex-wrap: wrap;
            }

            .stat-item {
                flex: 0 0 calc(50% - 0.5rem);
                width: calc(50% - 0.5rem);
            }
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .page-title h3 {
                font-size: 1.5rem;
            }

            .avatar {
                width: 100px;
                height: 100px;
            }

            .user-name {
                font-size: 1.25rem;
            }

            .stat-item {
                flex: 0 0 100%;
                width: 100%;
                margin-bottom: 0.5rem;
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
                            <h3 class="mb-2">User Management</h3>
                            <p>Daftar semua pengguna dalam sistem, termasuk informasi peran, status, dan aktivitas
                                terakhir.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigasi Breadcrumb -->
                <div class="row mb-2">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index-user-admin') }}">User</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="User Avatar"
                                            class="rounded-circle shadow"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                    <h4 class="mb-1">{{ $user->name }}</h4>
                                    <p class="text-muted mb-2">{{ $user->role }}</p>
                                    <p class="text-secondary small">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">User Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-user me-1"></i> Full Name
                                                </div>
                                                <div class="detail-value">
                                                    <input type="text" name="fullname" id="fullname"
                                                        class="form-control @error('fullname') is-invalid @enderror"
                                                        value="{{ old('fullname', $user->fullname) }}"
                                                        placeholder="Enter full name" disabled>
                                                    @error('fullname')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-envelope me-1"></i> Email
                                                </div>
                                                <div class="detail-value">
                                                    <input type="email" name="email" id="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $user->email) }}"
                                                        placeholder="Enter email" disabled>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-phone me-1"></i> Phone Number
                                                </div>
                                                <div class="detail-value">
                                                    <input type="text" name="handphone" id="handphone"
                                                        class="form-control @error('handphone') is-invalid @enderror"
                                                        value="{{ old('handphone', $user->handphone) }}"
                                                        placeholder="Enter phone number" disabled>
                                                    @error('handphone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-calendar me-1"></i> Birth Date
                                                </div>
                                                <div class="detail-value">
                                                    <input type="text" name="handphone" id="handphone"
                                                        class="form-control @error('handphone') is-invalid @enderror"
                                                        value="{{ \Carbon\Carbon::parse($user->date)->translatedFormat('d F Y') }}"
                                                        placeholder="Enter phone number" disabled>

                                                    @error('date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-venus-mars me-1"></i> Gender
                                                </div>
                                                <div class="detail-value">
                                                    <select name="gender" id="gender"
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        disabled>
                                                        <option value="">Select Gender</option>
                                                        <option value="male"
                                                            {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                                            Male
                                                        </option>
                                                        <option value="female"
                                                            {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                                            Female
                                                        </option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="detail-group">
                                                <div class="detail-label">
                                                    <i class="fas fa-user-tag me-1"></i> Role
                                                </div>
                                                <div class="detail-value">
                                                    <input type="text" name="role" id="role"
                                                        class="form-control" value="{{ $user->role }}" readonly>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <style>
        body {
            font-family: 'Inter', sans-serif;
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

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 0.625rem 0.75rem;
        }

        .form-control:disabled {
            background-color: #f9fafb;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .invalid-feedback {
            color: #ef4444;
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
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header" style="margin-bottom: 20px;">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('index-user-admin') }}">User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Detail</li>
                                </ol>
                            </nav>
                        </div>
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

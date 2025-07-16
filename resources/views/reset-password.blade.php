<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Glamoire</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">

    <style>
        .input-group .toggle-password {
            background-color: transparent;
            border-left: none;
            border: none;
            padding: 0 0.75rem;
            display: flex;
            align-items: center;
            font-size: 1.2rem;
            color: #6b7280;
        }

        .input-group .toggle-password:hover {
            color: #111827;
            background-color: transparent;
        }

        .input-group-text {
            border: none;
            background: transparent;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 1.25rem;
            transform: translateY(-2%);
            cursor: pointer;
            font-size: 1.25rem;
            color: #6b7280;
            z-index: 5;
            line-height: 1;
            display: flex;
            align-items: center;
        }

        .form-control {
            padding-right: 2.75rem !important;
            /* beri ruang agar teks tidak tabrak icon */
        }
    </style>
</head>

<body>
    <div id="auth">
        <div class="auth-container">
            <div class="auth-logo text-center">
                <h4>Glamoire</h4>
            </div>
            <h1 class="auth-title">Reset Kata Sandi</h1>
            <p class="auth-subtitle mb-5">Masukkan password baru untuk akun Anda.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('reset.password.admin') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                        id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group position-relative mb-4">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                        id="password" name="password" placeholder="Password baru" required>

                    <span class="toggle-password" toggle="#password">
                        <i class="bi bi-eye-slash"></i>
                    </span>

                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group position-relative mb-4">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control form-control-xl" id="password_confirmation"
                        name="password_confirmation" placeholder="Konfirmasi password baru" required>

                    <span class="toggle-password" toggle="#password_confirmation">
                        <i class="bi bi-eye-slash"></i>
                    </span>
                </div>



                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ubah Password</button>
            </form>

            <div class="text-center mt-5 text-lg fs-4">
                <p><a class="font-bold" href="{{ route('login-admin') }}">Kembali ke Halaman Login</a></p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                icon: 'error',
                title: 'Error {{ $errors->first() }}',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.toggle-password').forEach(el => {
            el.addEventListener('click', function() {
                const target = document.querySelector(this.getAttribute('toggle'));
                const icon = this.querySelector('i');
                const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
                target.setAttribute('type', type);
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        });
    </script>




</body>

</html>

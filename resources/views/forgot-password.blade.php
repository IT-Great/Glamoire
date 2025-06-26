<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Glamoire</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">
        <div class="auth-container">
            <div class="auth-logo text-center">
                <h4>Glamoire</h4>
            </div>
            <h1 class="auth-title">Lupa Kata Sandi</h1>
            <p class="auth-subtitle mb-5">Masukkan email akun anda, kami akan mengirimkan link ubah kata sandi.</p>

            <form action="{{ route('send.reset.link') }}" method="POST">
                @csrf
                <input type="hidden" name="token">
                <div class="form-group position-relative has-icon-left mb-4">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control form-control-xl" id="password" name="password" placeholder="Password baru" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control form-control-xl" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ubah Password</button>
            </form>

            <div class="text-center mt-5 text-lg fs-4">
                <p><a class="font-bold" href="/login-admin">Kembali ke Halaman Login</a></p>
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
</body>

</html>

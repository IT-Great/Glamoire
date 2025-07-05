<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Glamoire</title>
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
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Masukkan Username dan Password untuk masuk ke halaman Dashboard</p>

            <form action="{{ route('login-admin') }}" method="POST">
                @csrf
                <div class="form-group position-relative mb-4">
                    <label for="name">Username</label>
                    <input type="text" name="name"
                        class="form-control form-control-xl @error('name') is-invalid @enderror mt-2" id="name"
                        placeholder="Masukkan username Anda" required value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group position-relative mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password"
                        class="form-control form-control-xl @error('password') is-invalid @enderror mt-2" id="password"
                        placeholder="Password" required>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>

            <div class="text-center mt-5 text-lg fs-4">
                <p><a class="font-bold" href="/forgot-password">Forgot password?</a></p>
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

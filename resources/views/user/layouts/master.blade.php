<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.header')

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: none;
            padding: 30px 30px 0;
            position: relative;
        }

        .btn-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2rem;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .modal-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        .modal-subtitle {
            text-align: center;
            color: #666;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .benefits-section {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        .benefit-item {
            text-align: center;
            flex: 1;
            max-width: 120px;
        }

        .benefit-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .benefit-text {
            font-size: 0.85rem;
            color: #333;
            line-height: 1.3;
            font-weight: 500;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: #fff;
        }

        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
        }

        .input-group .form-control {
            border-right: none;
            border-radius: 12px 0 0 12px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
            padding: 12px 16px;
            font-weight: 600;
            color: #666;
        }

        .password-container {
            position: relative;
        }

        .password-container .form-control {
            padding-right: 45px;
        }

        .password-toggle-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .password-toggle-icon:hover {
            color: #333;
        }

        .btn-primary {
            background: #183018;
            border: none;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .btn-primary:hover {
            background: #145015;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .social-login {
            margin-top: 25px;
            text-align: center;
        }

        .social-divider {
            color: #999;
            font-size: 0.9rem;
            margin: 20px 0;
            position: relative;
        }

        .social-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e9ecef;
            z-index: 1;
        }

        .social-divider span {
            background-color: white;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .social-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-social {
            flex: 1;
            max-width: 150px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            background-color: white;
            color: #333;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-social:hover {
            border-color: #ff6b6b;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-social i {
            font-size: 1.1rem;
        }

        .btn-social.facebook i {
            color: #4267B2;
        }

        .btn-social.google i {
            color: #EA4335;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .terms-text {
            font-size: 0.8rem;
            color: #999;
            text-align: center;
            margin-top: 20px;
            line-height: 1.4;
        }

        .terms-text a {
            color: #ff6b6b;
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        .modal-dialog {
            width: 90%;
            max-width: 400px;
            margin: 1.75rem auto;
        }

        @media (min-width: 768px) {
            .modal-dialog {
                max-width: 500px;
            }
        }

        @media (min-width: 1200px) {
            .modal-dialog {
                max-width: 600px;
            }
        }


        @media (max-width: 768px) {
            .benefits-section {
                flex-direction: column;
                gap: 20px;
                align-items: center;
            }

            .benefit-item {
                max-width: 200px;
            }

            .social-buttons {
                flex-direction: column;
            }

            .btn-social {
                max-width: none;
            }
        }
    </style>
</head>

<body>
    @if (!Request::routeIs('invoice.user'))
        @include('user.layouts.navbar')
    @endif

    <!-- Modal Login -->
    {{-- <div class="modal fade" id="loginUser1" tabindex="-1" aria-labelledby="loginUser" aria-hidden="true" z-index="9999">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #183018">
                <div class="modal-header border-none">
                    <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center align-items-center p-0 p-md-2">
                        <img src="images/l-1.png" alt="logo glamoire" class="w-3/4 w-md-full">
                    </div>

                    <form method="POST" action="" class="mb-2 px-0 px-md-4">
                        @csrf
                        <div>
                            <label for="login_email"
                                class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Email
                            </label>
                            <input type="email"
                                class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                name="email" id="login_email" placeholder="nama@gmail.com" autocomplete="off"
                                required>
                            <div id="validationEmailLogin"
                                class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]" style="display: none;">
                            </div>

                            <div class="mb-3">
                                <label for="login_password"
                                    class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Kata
                                    Sandi </label>
                                <input type="password" name="password" id="login_password"
                                    class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    aria-describedby="passwordHelpBlock" placeholder="******" required>
                                <div id="validationPasswordLogin"
                                    class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    style="display: none;">
                                </div>
                            </div>
                            <!-- Button with improved hover effect -->
                            <!-- <button type="submit" class="btn btn-light" id="login">Masuk</button> -->
                            <button
                                class="btn btn-light rounded-lg w-full text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                type="submit" id="login">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <div class="grid px-0 px-md-4">
                        <a href="#"
                            class="ml-1 text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                            data-bs-toggle="modal" data-bs-target="#forgot" data-bs-dismiss="modal">Lupa Password ?</a>
                        <p
                            class="text-white text-center py-4 font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">
                            Belum Punya Akun ?
                            <a href="#" class="ml-1 text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                data-bs-toggle="modal" data-bs-target="#registerUser1" data-bs-dismiss="modal">Daftar
                                Sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- MODAL LOGIN BARU --}}
    <div class="modal fade" id="loginUser1" tabindex="-1" aria-labelledby="loginUser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body px-4 pb-4">
                    <!-- Logo -->
                    <h4 class="modal-title text-center">Masuk atau Buat Akun</h4>
                    <p class="modal-subtitle text-center text-muted">Masukkan email dan password Anda untuk memulai</p>

                    <form method="POST" action="" class="mb-4" id="login-user-form">
                        @csrf
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="login_email" class="form-label">Email <span style="color: red">*</span></label>
                            <input type="email" class="form-control" name="email" id="login_email"
                                placeholder="nama@gmail.com" autocomplete="off" required>
                            <div id="validationEmailLogin" class="form-text text-danger" style="display: none;"></div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="login_password" class="form-label">Kata Sandi <span
                                    style="color: red">*</span></label>
                            <div class="password-container">
                                <input type="password" name="password" id="login_password" class="form-control"
                                    placeholder="******" required>
                                <i class="fa fa-eye-slash password-toggle-icon" data-target="login_password"></i>
                            </div>
                            <div id="validationPasswordLogin" class="form-text text-danger" style="display: none;">
                            </div>
                        </div>


                        <!-- Tombol Masuk -->
                        <button class="btn btn-primary w-100" type="submit" id="login">
                            Masuk
                        </button>
                    </form>

                    <!-- Login Sosial -->
                    <div class="social-login mt-4">
                        <div class="social-divider text-center my-2">
                            <span>ATAU LANJUTKAN DENGAN</span>
                        </div>

                        <div class="social-buttons d-flex gap-2 justify-content-center">
                            <button type="button" class="btn btn-social google">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                                    style="height:20px; vertical-align:middle; margin-right:8px;">
                                Google
                            </button>
                        </div>
                    </div>

                    <!-- Lupa Password -->
                    <div class="text-start mt-3">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgot"
                            data-bs-dismiss="modal" style="color: #183018; font-weight: bold">Lupa Kata Sandi?</a>
                    </div>

                    <!-- Belum punya akun -->
                    <p class="text-center mt-3 text-muted">
                        Belum punya akun?
                        <a href="#" class="ms-1 switch-to-register"
                            style="color: #183018; font-weight: bold">Daftar Sekarang</a>
                    </p>

                    <!-- Syarat & Ketentuan -->
                    <div class="terms-text mt-3 text-center text-muted text-sm">
                        Dengan menekan button "Masuk" atau Google, saya menyatakan bahwa saya telah membaca dan
                        menyetujui
                        <a href="#" class="terms-link" style="color: #183018; font-weight: bold">Syarat &
                            Ketentuan</a> serta
                        <a href="#" class="privacy-link" style="color: #183018; font-weight: bold">Kebijakan
                            Privasi</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sign Up -->
    {{-- <div class="modal fade" id="registerUser1" tabindex="-1" aria-labelledby="registerUser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #183018">
                <div class="modal-header border-none">
                    <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="container-fluid">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <img src="images/l-1.png" alt="logo glamoire" class="w-1/4">
                    </div>

                    <form class="px-0 px-md-4 grid" id="register-user-form">
                        @csrf
                        <div class="col-12 mb-2">
                            <div>
                                <label for="register_fullname"
                                    class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Nama
                                    Lengkap </label>
                                <input type="text"
                                    class="form-control rounded-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    name="fullname" id="register_fullname" placeholder="Masukkan Nama Lengkap" required>

                                <label for="register_date"
                                    class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Tanggal
                                    Lahir </label>
                                <input type="date"
                                    class="form-control rounded-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    name="date" id="register_date" required>

                                <label for="register_email"
                                    class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Email
                                </label>
                                <input type="email"
                                    class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    name="email" id="register_email" placeholder="contoh@gmail.com"
                                    autocomplete="off" required>
                                <div id="validationEmail"
                                    class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    style="display: none;">
                                </div>

                                <label for="register_handphone"
                                    class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Handphone
                                </label>
                                <div class="input-group">
                                    <span
                                        class="input-group-text text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                        id="basic-addon1">+62</span>
                                    <input type="number"
                                        class="form-control rounded-end-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                        name="handphone" id="register_handphone" placeholder="Nomor Handphone"
                                        pattern="[0]{1}[8]{1}[0-9]{9,10}" required>
                                </div>
                                <div id="validationHandphone"
                                    class="text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    style="display: none;"></div>

                                <label for="register_password"
                                    class="form-label text-white font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Password
                                </label>
                                <input type="password" name="password" id="register_password"
                                    class="form-control rounded-lg text-black text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                    aria-describedby="passwordHelpBlock" placeholder="******" required>

                                <label for="register_gender"
                                    class="form-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">Jenis
                                    Kelamin </label>
                                <div id="register_gender">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                            type="radio" name="gender" id="register_gender_male" value="male"
                                            required>
                                        <label
                                            class="form-check-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                            for="register_gender_male">Pria </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                            type="radio" name="gender" id="register_gender_female" value="female"
                                            required>
                                        <label
                                            class="form-check-label text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                            for="register_gender_male">Wanita </label>
                                    </div>
                                </div>


                                <div class="form-check">
                                    <input
                                        class="form-check-input text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                        type="checkbox" value="" id="privacy_policy_agreement" required>
                                    <label for="privacy_policy"
                                        class="form-check-label text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px] text-white">
                                        By registering you have agreed to the <a href="/privacy"
                                            id="privacy_policy">Privacy Policy</a> and <a href="/terms">Terms of
                                            Service</a>
                                    </label>
                                    <div
                                        class="invalid-feedback text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Button with improved hover effect -->
                            <button
                                class="btn btn-light w-full rounded-lg text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                type="submit" id="register">
                                Buat Akun
                            </button>
                            <div class="grid">
                                <p
                                    class="text-white text-center py-4 font-light text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]">
                                    Sudah Memiliki Akun ?
                                    <a href="#"
                                        class="ml-1 text-[10px] md:text-[8px] lg:text-[10px] xl:text-[12px]"
                                        data-bs-toggle="modal" data-bs-target="#loginUser1"
                                        data-bs-dismiss="modal">Masuk Sekarang</a>
                                </p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div> --}}

    {{-- MODAL SIGN UP BARU --}}
    <div class="modal fade" id="registerUser1" tabindex="-1" aria-labelledby="registerUser" aria-hidden="true">
        {{-- <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> --}}
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <h2 class="modal-title">Masuk atau Buat Akun</h2>

                <div class="modal-body px-4 pb-6">
                    <p class="modal-subtitle">Masukkan nama, email, dan kata sandi untuk daftar akun</p>
                    <form id="register-user-form">
                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="register_fullname" class="form-label">Nama Lengkap <span
                                    style="color: red">*</span></label>
                            <input type="text" class="form-control" name="fullname" id="register_fullname"
                                placeholder="Masukkan nama lengkap" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="register_email" class="form-label">Email <span
                                    style="color: red">*</span></label>
                            <input type="email" class="form-control" name="email" id="register_email"
                                placeholder="Masukkan email" required>
                        </div>

                        <!-- Kata Sandi -->
                        <div class="mb-4">
                            <label for="register_password" class="form-label">Kata Sandi <span
                                    style="color: red">*</span></label>
                            <div class="password-container">
                                <input type="password" name="password" id="register_password" class="form-control"
                                    placeholder="Masukkan kata sandi" required>
                                <i class="fa fa-eye-slash password-toggle-icon" data-target="register_password"></i>
                            </div>
                            <div id="validationPasswordRegister" class="form-text text-danger"
                                style="display: none;"></div>
                        </div>

                        <!-- Bagian tambahan -->
                        <div class="benefits text-center mb-4">
                            <h3 style="font-weight: 600; font-size: 1.5rem; margin-bottom: 0.5rem;">Buat Akun</h3>
                            <p style="color: #555; margin-bottom: 1rem;">
                                Anda dapat melacak pesanan, mengedit info pengiriman, mendapatkan penawaran eksklusif,
                                dan masih banyak lagi!
                            </p>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div style="color: #a855f7; font-size: 2rem; margin-bottom: 0.25rem;">🎟️</div>
                                    <div style="font-weight: 600;">Diskon 10% untuk pesanan pertama</div>
                                </div>
                                <div class="col-6">
                                    <div style="color: #a855f7; font-size: 2rem; margin-bottom: 0.25rem;">🚚</div>
                                    <div style="font-weight: 600;">Lacak pesanan Anda</div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <button class="btn btn-primary w-100" type="submit" id="register">
                            Selanjutnya
                        </button>
                    </form>

                    <!-- Sudah punya akun -->
                    <div class="text-center mt-3">
                        <span>Sudah Memiliki Akun? </span>
                        <a href="#" class="switch-to-login" style="color: #183018; font-weight: bold">Masuk
                            Sekarang</a>
                    </div>

                    <!-- Login Sosial -->
                    <div class="social-login mt-3">
                        <div class="social-divider">
                            <span>ATAU LANJUTKAN DENGAN</span>
                        </div>

                        <div class="social-buttons">
                            <button type="button" class="btn btn-social google">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                                    style="height:20px; vertical-align:middle;">
                                Google
                            </button>
                        </div>
                    </div>

                    <!-- Syarat dan Ketentuan -->
                    <div class="terms-text mt-3 mb-3">
                        Dengan menekan button "Selanjutnya" atau Google, saya menyatakan bahwa saya telah membaca dan
                        menyetujui
                        <a href="#" class="terms-link" style="color: #183018; font-weight: bold">Syarat &
                            Ketentuan</a> serta
                        <a href="#" class="privacy-link" style="color: #183018; font-weight: bold">Kebijakan
                            Privasi</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Forgot Password -->
    {{-- <div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="forgot" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #183018">
                <div class="modal-header border-none">
                    <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <img src="images/l-1.png" alt="logo glamoire" class="w-1/3">
                    </div>
                    <form class="px-4 grid" id="forgot-password-form">
                        @csrf
                        <div class="col-12">
                            <h1 class="text-white text-sm mb-3 text-center pt-4">Lupa Kata Sandi</h1>
                            <p class="text-white text-xs mb-3 text-justify">Gunakan email anda untuk mengatur ulang
                                kata sandi, kami akan mengirimkan link untuk mengubah kata sandi anda</p>
                            <div class="relative flex items-center mb-2">
                                <i class="fas fa-envelope text-gray-400 absolute left-3"></i> <!-- Ikon Email -->
                                <input type="email" class="form-control pl-10 pr-10 rounded-md text-sm"
                                    id="forgot_password_email" placeholder="Masukkan email" required>
                                <div class="spinner-border text-[#183018] absolute right-3" role="status"
                                    style="width:15px; height:15px;display:none;"> <!-- Spinner -->
                                    <span class="visually-hidden"></span>
                                </div>
                            </div>

                            <div id="validationEmailForgot" class="text-xs mb-2" style="display: none;">
                            </div>
                            <button class="py-2 w-full rounded-md text-[#183018] bg-white text-sm" type="submit"
                                id="forgot-btn" disabled>Dapatkan Link</button>
                        </div>
                        <div class="col-12">
                            <div class="text-center text-sm">
                                <p class="text-white py-4">Sudah Ingat Akunmu?
                                    <a href="#" class="text-white ml-1" data-bs-toggle="modal"
                                        data-bs-target="#loginUser1" data-bs-dismiss="modal">Masuk</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="forgot" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <h2 class="modal-title">Lupa Kata Sandi</h2>

                <div class="modal-body px-4 pb-4">
                    <p class="modal-subtitle">
                        Masukkan email Anda untuk menerima link pengaturan ulang kata sandi.
                    </p>

                    <form class="px-2" id="forgot-password-form">
                        @csrf
                        <div class="mb-3">
                            <label for="forgot_password_email" class="form-label">Email <span
                                    style="color:red;">*</span></label>
                            <input type="email" class="form-control" id="forgot_password_email"
                                placeholder="Masukkan email" required>
                            <div id="validationEmailForgot" class="form-text text-danger" style="display:none;">
                            </div>
                        </div>

                        <button class="btn btn-primary w-100" type="submit" id="forgot-btn">
                            Dapatkan Link
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <span>Sudah ingat akunmu? </span>
                        <a href="#" class="switch-to-login" data-bs-toggle="modal"
                            data-bs-target="#loginUser1" data-bs-dismiss="modal"
                            style="color: #183018; font-weight: bold">
                            Masuk Sekarang
                        </a>
                    </div>

                    <div class="terms-text mt-3 mb-3">
                        Dengan menekan tombol <b>Dapatkan Link</b>, saya menyatakan bahwa saya telah membaca dan
                        menyetujui
                        <a href="#" class="terms-link" style="color: #183018; font-weight: bold">Syarat &
                            Ketentuan</a> serta
                        <a href="#" class="privacy-link" style="color: #183018; font-weight: bold">Kebijakan
                            Privasi</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        @yield('content')
    </div>

    @if (!Request::is('cart') && !Request::is('checkout') && !Request::is('buy-now'))
        <a href="#" class="btn back-to-top text-[8px]" style="background-color: #183018"><i
                class="fa fa-angle-double-up text-white"></i></a>
    @endif

    @if (
        !Request::is('cart') &&
            !Request::is('checkout') &&
            !Request::is('account') &&
            !Request::is('shop') &&
            !Request::is('detail') &&
            !Request::routeIs('detail.product') &&
            !Request::routeIs('buy.now') &&
            !Request::routeIs('invoice.user') &&
            !Request::routeIs('shop.category') &&
            !Request::routeIs('shop.category.sub') &&
            !Request::is('search'))
        @include('user.layouts.footer')
    @endif

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/easing/easing.min.js"></script>

    {{-- UNTUK SCROLLLBAR MODAL LOGIN DAN REGISTER --}}
    <script>
        // Tambahkan setelah script jQuery yang sudah ada
        $(document).ready(function() {
            // Reset body style ketika modal ditutup
            $('#loginUser1, #registerUser1').on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');
            });

            // Reset body style ketika modal dibuka
            $('#loginUser1, #registerUser1').on('shown.bs.modal', function() {
                $('body').addClass('modal-open');
            });
        });

        $(document).ready(function() {
            // Switch dari login ke register
            $('.switch-to-register').on('click', function(e) {
                e.preventDefault();
                $('#loginUser1').modal('hide');
                setTimeout(function() {
                    $('#registerUser1').modal('show');
                }, 300);
            });

            // Switch dari register ke login
            $('.switch-to-login').on('click', function(e) {
                e.preventDefault();
                $('#registerUser1').modal('hide');
                setTimeout(function() {
                    $('#loginUser1').modal('show');
                }, 300);
            });
        });

        function resetScrollbar() {
            // Force reset scrollbar
            $('html').css('overflow', 'auto');
            $('body').css('overflow', 'auto');
            $('body').css('padding-right', '0');
            $('body').removeClass('modal-open');

            // Trigger resize untuk memastikan scrollbar ter-recalculate
            $(window).trigger('resize');
        }

        // Panggil fungsi ini setelah modal transition
        $('#loginUser1, #registerUser1').on('hidden.bs.modal', function() {
            setTimeout(resetScrollbar, 100);
        });
    </script>


    {{-- UNTUK BUKA DAN SEMBUNYIKAN INPUT PASSWORD LOGIN DAN REGISTER --}}
    <script>
        // Toggle Password Visibility
        document.querySelectorAll('.password-toggle-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                const targetId = icon.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    // ubah jadi terlihat
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    // ubah jadi disembunyikan
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
    </script>

    <!-- UNTUK MENGATUR JUMLAH CARD MENGGUNAKAN SWIPERJS PADA HALAMAN HOME -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 5,
            spaceBetween: 15,
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                2560: {
                    slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1440: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1024: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                // Tablet
                768: {
                    slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                },
                425: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                375: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                // Mobile
                320: {
                    slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
            },
        });

        var swiperCorousel = new Swiper(".mySwiperCarousel", {
            slidesPerView: 1,
            spaceBetween: 10,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var swiperReview = new Swiper(".mySwiperReview", {
            slidesPerView: 2,
            spaceBetween: 5,
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var swiperDetail = new Swiper(".mySwiperProduct", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

        });

        // UNTUK MENGATUR SWIPER CARD PADA HALAMAN DETAIL PRODUCT
        var swiperShow = new Swiper('.mySwiperShow', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
        });

        var swiperNewest = new Swiper(".mySwiperNewest", {
            slidesPerView: 5,
            spaceBetween: 15,
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                2560: {
                    slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1440: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1024: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                // Tablet
                768: {
                    slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                },
                425: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                375: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                // Mobile
                320: {
                    slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
            },
        });

        var swiperTop = new Swiper(".mySwiperTop", {
            slidesPerView: 5,
            spaceBetween: 15,
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                2560: {
                    slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1440: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1024: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                // Tablet
                768: {
                    slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                },
                425: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                375: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                // Mobile
                320: {
                    slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
            },
        });

        var swiperVoucher = new Swiper(".mySwiperVoucher", {
            slidesPerView: 5,
            spaceBetween: 15,
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                2560: {
                    slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1440: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1024: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                // Tablet
                768: {
                    slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                },
                425: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                375: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                // Mobile
                320: {
                    slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
            },
        });

        var swiperPromo = new Swiper(".mySwiperPromo", {
            slidesPerView: 5,
            spaceBetween: 15,
            cssMode: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                2560: {
                    slidesPerView: 6, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1440: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                1024: {
                    slidesPerView: 5, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 10, // Menyusun jarak antar slide
                },
                // Tablet
                768: {
                    slidesPerView: 4, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                },
                425: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                375: {
                    slidesPerView: 3, // Untuk layar dengan lebar 768px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
                // Mobile
                320: {
                    slidesPerView: 2, // Untuk layar dengan lebar 480px atau lebih besar
                    spaceBetween: 5, // Menyusun jarak antar slide
                    navigation: false,
                },
            },
        });
    </script>

    <!-- UNTUK MENGATUR RANGE DI FILTER SHOP -->
    <script>
        function updatePriceRange() {
            const minPrice = document.getElementById("min-price").value;
            const maxPrice = document.getElementById("max-price").value;

            document.getElementById("min-price-value").textContent = `Rp${formatRupiah(minPrice)}`;
            document.getElementById("max-price-value").textContent = `Rp${formatRupiah(maxPrice)}`;
        }

        function updatePriceRangeMobile() {
            const minPrice = document.getElementById("min-price-mobile").value;
            const maxPrice = document.getElementById("max-price-mobile").value;

            document.getElementById("min-price-value-mobile").textContent = `Rp${formatRupiah(minPrice)}`;
            document.getElementById("max-price-value-mobile").textContent = `Rp${formatRupiah(maxPrice)}`;
        }

        function formatRupiah(value) {
            // Format the price as Indonesian Rupiah (e.g., Rp10,000)
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

    <!-- UNTUK MENGATUR SAAT CARD DIKLIK DI DETAIL HALAMAN -->
    <script>
        document.querySelectorAll('.example-product').forEach(slide => {
            slide.addEventListener('click', function() {
                // Remove 'active' class from all slides
                document.querySelectorAll('.example-product').forEach(s => s.classList.remove('active'));
                // Add 'active' class to the clicked slide
                this.classList.add('active');
            });
        });
    </script>

    <!-- Pilih all item di keranjang -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkAll = document.getElementById("checkAll");
            if (checkAll) {
                checkAll.addEventListener("change", function() {
                    const checkboxes = document.querySelectorAll(".item-checkbox");
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = this.checked;
                    });
                });
            }
        });
    </script>

    <!-- ADD TO CART & ADD TO WHISLIST -->
    <script>
        // Function for adding to cart
        function addToCart(produkId) {
            $.ajax({
                url: "{{ route('add.to.chart') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    product_id: produkId,
                },
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.reload(); // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errors = response.errors;
                        let errorMessages = response.message;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key][0] + "<br>";
                            }
                        }
                        Toast.fire({
                            icon: "error",
                            text: errorMessages,
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: "error",
                        text: "Kesalahan Sistem",
                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    });
                },
            });
        }

        // Function for adding to wishlist
        function addToWishlist(produkId) {
            $.ajax({
                url: "{{ route('add.to.wishlist') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    product_id: produkId,
                },
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,
                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.reload(); // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errors = response.errors;
                        let errorMessages = response.message;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key][0] + "<br>";
                            }
                        }
                        Toast.fire({
                            icon: "error",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: "error",
                        text: "Kesalahan Sistem",

                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    });
                },
            });
        }

        function removeFromWishlist(produkId) {
            $.ajax({
                url: "{{ route('remove.from.wishlist') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    product_id: produkId,
                },
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.reload(); // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errors = response.errors;
                        let errorMessages = response.message;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key][0] + "<br>";
                            }
                        }
                        Toast.fire({
                            icon: "error",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: "error",
                        text: "Kesalahan Sistem",

                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    });
                },
            });
        }
    </script>

    <!-- STYLE POP-UP -->
    <script>
        const style = document.createElement('style');
        style.innerHTML = `
          .toast-title {
              color: #ffffff !important; /* Mengatur warna judul */
          }
          .toast-content {
              text-color: #ffffff !important; /* Mengatur warna konten */
          }
      `;
        document.head.appendChild(style);
    </script>

    <!-- Register -->
    <script>
        $(document).on("submit", "#registerUser1", function(e) {
            e.preventDefault();

            let fullname = $("#register_fullname").val();
            let email = $("#register_email").val();
            let password = $("#register_password").val();
            let handphone = $("#register_handphone").val();
            let gender = $('input[name="gender"]:checked').val();
            let date = $('#register_date').val()

            let label = $("#label").val();
            let recipient_name = $("#recipient_name").val();
            let addressHandphone = $("#address_handphone").val();
            let address = $("#address").val();
            let province = $("#province_name").val();
            let regency = $("#regency_name").val();
            let district = $("#district_name").val();
            let benchmark = $("#benchmark").val();

            // console.log({province,regency,district,date});
            Swal.fire({
                text: "Akun Anda Sedang Kami Proses ...",
                allowOutsideClick: false,
                showConfirmButton: false,
                toast: true,
                position: "center",
                background: "#183018",
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: () => {
                    Swal.showLoading();
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });

            $.ajax({
                url: "{{ route('register.user') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    fullname: fullname,
                    email: email,
                    password: password,
                    handphone: handphone,
                    date: date,
                    gender: gender,
                    label: label,
                    recipient_name: recipient_name,
                    addressHandphone: addressHandphone,
                    address: address,
                    province: province,
                    regency: regency,
                    district: district,
                    benchmark: benchmark,
                },
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.href =
                                "/email-verify"; // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errorMessage = response.message ||
                            "Terjadi kesalahan"; // Mengambil pesan error dari response
                        Toast.fire({
                            icon: "error",
                            text: errorMessage,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.href =
                                "/"; // Redirect ke halaman utama atau halaman lain
                        });
                    }
                },
                error: function(response) {
                    Toast.close();
                    let errorMessage = "";

                    if (response.responseJSON) {
                        if (response.responseJSON.message) {
                            errorMessage = response.responseJSON.message; // Pesan error dari Laravel
                        } else if (response.responseJSON.errors) {
                            // Jika ada beberapa pesan error, tampilkan semuanya
                            errorMessage = "";
                            $.each(response.responseJSON.errors, function(key, value) {
                                errorMessage += value[0] + "<br>"; // Menggabungkan pesan error
                            });
                        }
                    } else if (response.statusText) {
                        errorMessage = response.statusText;
                    }
                    // Tampilkan pesan error dengan SweetAlert
                    Toast.fire({
                        icon: "error",
                        text: errorMessage,

                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        }
                    }).then(function() {
                        window.location.href =
                            "/"; // Redirect ke halaman utama atau halaman lain
                    });
                },
            });
        });
    </script>

    <!-- Login -->
    <script>
        $(document).on("submit", "#loginUser1", function(e) {
            e.preventDefault();

            let email = $("#login_email").val();
            let password = $("#login_password").val();

            Toast.fire({
                text: "Mohon tunggu sebentar ...",
                allowOutsideClick: false,
                didOpen: () => {
                    Toast.showLoading();
                    $("#loginUser1").hide();

                    const content = document.querySelector('.swal2-html-container');
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
            // console.log({email, password});

            $.ajax({
                url: "{{ route('login.user') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    email: email,
                    password: password,
                },
                success: function(response) {
                    Toast.close();
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.href =
                                "/"; // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errors = response.errors;
                        let errorMessages = response.message;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key][0] + "<br>";
                            }
                        }
                        Toast.fire({
                            icon: "error",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            $("#loginUser1")
                                .show(); // Redirect ke halaman utama atau halaman lain
                        });
                    }
                },
                error: function(response) {
                    Swal.close();
                    Toast.fire({
                        icon: "error",
                        text: "Kesalahan Sistem",

                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        },
                    }).then(function() {
                        window.location.href =
                            "/"; // Redirect ke halaman utama atau halaman lain
                    });
                },
            });
        });
    </script>

    <!-- CHECK EMAIL & HANDPHONE REGISTER -->
    <script>
        $(document).ready(function() {
            // Cek email
            $('#register_email').on('blur', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: "{{ route('check.email') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            email: email
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#validationEmail').text('Email sudah didaftarkan').addClass(
                                    'text-danger').show();
                            } else {
                                $('#validationEmail').hide();
                            }
                        }
                    });
                }
            });

            // Cek handphone
            $('#register_handphone').on('blur', function() {
                var handphone = $(this).val();
                if (handphone) {
                    $.ajax({
                        url: "{{ route('check.handphone') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            handphone: handphone
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#validationHandphone').text(
                                    'Nomor handphone sudah didaftarkan').addClass(
                                    'text-danger').show();
                            } else {
                                $('#validationHandphone').hide();
                            }
                        }
                    });
                }
            });
        });
    </script>

    <!-- CHECK EMAIL FORGOT PASSWORD -->
    <script>
        $('#forgot_password_email').on('keyup', function() {
            var email = $(this).val();
            if (email) {
                $.ajax({
                    url: "{{ route('check.email.voucher') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        email: email
                    },
                    beforeSend: function() {
                        // Tampilkan spinner sebelum request dimulai
                        $('.spinner-border').show();
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#validationEmailForgot').text('Email Anda Terdaftar').addClass(
                                'text-white').show();
                            $('#forgot-btn').prop('disabled', false);
                        } else {
                            $('#validationEmailForgot').text('Oops, Email Anda Belum Terdaftar')
                                .addClass('text-white').show();
                            $('#forgot-btn').prop('disabled', true);
                        }
                    },
                    complete: function() {
                        // Sembunyikan spinner setelah request selesai
                        $('.spinner-border').hide();
                    },
                    error: function() {
                        // Jika ada error, tetap sembunyikan spinner
                        $('.spinner-border').hide();
                    }
                });
            }
        });

        // ACTION DAPATKAN LINK LUPA PASSWORD
        $(document).on("submit", "#forgot-password-form", function(e) {
            e.preventDefault();

            let email = $("#forgot_password_email").val();

            Swal.fire({
                toast: true,
                position: "center",
                background: "#183018",
                title: "Sedang mengirim token verifikasi ke emailmu",
                text: "Mohon tunggu sebentar ...",
                allowOutsideClick: false,
                showConfirmButton: false,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: () => {
                    Swal.showLoading();
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });

            $.ajax({
                url: "{{ route('forgot.password.link') }}", // Route forgot password di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token dari Laravel
                    email: email,
                },
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "/"; // Redirect ke halaman utama atau halaman lain
                            }
                        });
                    } else {
                        let errorMessage = response
                            .message; // Inisialisasi errorMessage sebelum digunakan
                        if (response.responseJSON) {
                            if (response.responseJSON.message) {
                                errorMessage = response.responseJSON
                                    .message; // Pesan error dari Laravel
                            } else if (response.responseJSON.errors) {
                                // Jika ada beberapa pesan error, tampilkan semuanya
                                $.each(response.responseJSON.errors, function(key, value) {
                                    errorMessage += value[0] +
                                        "<br>"; // Menggabungkan pesan error
                                });
                            }
                        } else if (response.statusText) {
                            // Jika tidak ada response JSON, tampilkan status text dari request
                            errorMessage = response.statusText;
                        }

                        // Tampilkan pesan error dengan SweetAlert
                        Toast.fire({
                            icon: "error",
                            text: errorMessage,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector(
                                    '.swal2-html-container');
                                if (title) title.style.color =
                                    '#ffffff'; // Ubah warna judul
                                if (content) content.style.color =
                                    '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Swal.close();
                    let errorMessage = "Maaf, terjadi kesalahan."; // Definisikan errorMessage di awal

                    // Cek apakah ada response JSON dari server
                    if (response.responseJSON) {
                        if (response.responseJSON.message) {
                            errorMessage = response.responseJSON.message; // Pesan error dari Laravel
                        } else if (response.responseJSON.errors) {
                            // Jika ada beberapa pesan error, tampilkan semuanya
                            errorMessage = "";
                            $.each(response.responseJSON.errors, function(key, value) {
                                errorMessage += value[0] + "<br>"; // Menggabungkan pesan error
                            });
                        }
                    } else if (response.statusText) {
                        // Jika tidak ada response JSON, tampilkan status text dari request
                        errorMessage = response.statusText;
                    }

                    // Tampilkan pesan error dengan SweetAlert
                    Toast.fire({
                        icon: "error",
                        text: errorMessage,

                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color =
                                '#ffffff'; // Ubah warna konten
                        }
                    });
                },
            });
        });
    </script>

    <!-- Logout -->
    <script>
        $(document).ready(function() {
            // Fungsi logout
            $('#logout-link').on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('logout.user') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Toast.fire({
                                icon: "success",
                                text: response.message,

                                willOpen: () => {
                                    const title = document.querySelector(
                                        '.swal2-title');
                                    const content = document.querySelector(
                                        '.swal2-html-container');
                                    if (title) title.style.color =
                                        '#ffffff'; // Ubah warna judul
                                    if (content) content.style.color =
                                        '#ffffff'; // Ubah warna konten
                                }
                            }).then(function() {
                                window.location.href =
                                    "/"; // Redirect ke halaman utama atau halaman lain
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat logout, silahkan coba lagi.');
                    }
                });
            });
        });
    </script>

    <!-- NOITFY ME -->
    <script>
        function notifyMe(produkId, productVariantId) {
            $.ajax({
                url: "{{ route('notify.me') }}", // Route register di Laravel
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Token CSRF untuk Laravel
                    product_id: produkId,
                    product_variant_id: productVariantId
                },
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            text: response.message,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        }).then(function() {
                            window.location.reload(); // Redirect ke halaman utama atau halaman lain
                        });
                    } else {
                        let errors = response.errors;
                        let errorMessages = response.message;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key][0] + "<br>";
                            }
                        }
                        Toast.fire({
                            icon: "error",
                            text: errorMessages,

                            willOpen: () => {
                                const title = document.querySelector('.swal2-title');
                                const content = document.querySelector('.swal2-html-container');
                                if (title) title.style.color = '#ffffff'; // Ubah warna judul
                                if (content) content.style.color = '#ffffff'; // Ubah warna konten
                            }
                        });
                    }
                },
                error: function(response) {
                    Toast.fire({
                        icon: "error",
                        text: "Kesalahan Sistem",

                        willOpen: () => {
                            const title = document.querySelector('.swal2-title');
                            const content = document.querySelector('.swal2-html-container');
                            if (title) title.style.color = '#ffffff'; // Ubah warna judul
                            if (content) content.style.color = '#ffffff'; // Ubah warna konten
                        }
                    });
                },
            });
        }
    </script>

    <!-- Reset Form Masuk & Daftar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap modal elemen
            const loginModal = document.getElementById('loginUser1');
            const registerModal = document.getElementById('registerUser1');

            // Deteksi saat modal ditutup
            loginModal.addEventListener('hidden.bs.modal', function() {
                // Reset form input saat modal ditutup
                loginModal.querySelector('form').reset();
            });
            registerModal.addEventListener('hidden.bs.modal', function() {
                // Reset form input saat modal ditutup
                registerModal.querySelector('form').reset();
            });
        });
    </script>

    <!-- AMBIL TOTAL CART ITEMS -->
    @php
      $user = session('id_user');
    //   $cartGuest = session('guest_cart', []); // Ambil cart dari session
    //   $totalItem = collect($cartGuest)->sum('quantity'); // Jumlah semua qty
    @endphp

    @if ($user !== null)
      <script>
        $(document).ready(function() {
          $.ajax({
              url: "{{ route('get.total.cart') }}",
              type: 'GET',
              success: function(data) {
                  // Update jumlah cart items di dalam elemen dengan ID total_cart_items
                  $('#total_cart_items').text(data);
              },
              error: function(error) {
                  console.error('Error fetching total cart items:', error);
              }
          });
        });
      </script>
    {{-- @else
      <script>
        $(document).ready(function() {
          // Update jumlah cart items di dalam elemen dengan ID total_cart_items
          let totalItem = {{ $totalItem }};
    
          $('#total_cart_items').text(totalItem);
        });
      </script> --}}
    @endif

    @if (session('register_or_login_first'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });

            Toast.fire({
                icon: "error",
                text: "Masuk/Daftar terlebih dahulu yaa",

                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        </script>
    @endif

    @if (session('after_reset_password'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "success",
                text: "Kata sandi anda berhasil diubah",

                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        </script>
    @endif

    @if (session('failed_reset_password'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "error",
                text: "Kata sandi anda gagal diperbarui",

                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        </script>
    @endif

    @if (session('success_verification_email'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "success",
                text: "Yeey emailmu berhasil diverifikasi",

                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        </script>
    @endif

    @if (session('voucher_new_user'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: "center",
                background: "#183018",
                showConfirmButton: false,
                timer: 4500,
                timerProgressBar: true,
                customClass: {
                    popup: "small-swal", // Add custom class
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "success",
                text: "Silahkan cek kode promo di emailmu",
                title: "Selamat",
                willOpen: () => {
                    const title = document.querySelector('.swal2-title');
                    const content = document.querySelector('.swal2-html-container');
                    if (title) title.style.color = '#ffffff'; // Ubah warna judul
                    if (content) content.style.color = '#ffffff'; // Ubah warna konten
                }
            });
        </script>
    @endif

</body>

</html>

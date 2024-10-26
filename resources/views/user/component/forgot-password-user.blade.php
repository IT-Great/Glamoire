<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamoire | Forgot Password</title>

    <!-- JQUERY -->
    <script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
    <!-- SWEET ALERT -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Favicon -->
    <link href="{{ asset('logo.png') }}" rel="icon" type="image/x-icon"/>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- SWIPER -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- CSS -->
    <link href="css/app.css" rel="stylesheet">
    <!-- TAILWIND -->
    @vite('resources/css/app.css')
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="rounded-md shadow-xl border border-[#183018] bg-[#183018] p-8 width min-w-[80vh]">
          <div class="auth-logo text-center flex justify-content-center text-align-center">
                <img src="/images/l-1.png" alt="logo glamoire">
              <!-- <h4 class="text-2xl md:text-2xl lg:text-3xl text-[#183018] mb-3">Glamoire</h4> -->
          </div>
          <h1 class="text-sm text-white mb-3">Atur Ulang Kata Sandi Baru</h1>
          <form action="{{ route('reset.password') }}" method="POST">
              @csrf
              <div class="form-group mb-3 text-sm">
                  <input type="hidden" name="token" value="{{ encrypt($token) }}">
                  <input type="hidden" name="email" value="{{ encrypt($email) }}">
                  <label for="password" class="text-white">Password Baru</label>
                  <input type="password" class="form-control text-sm" id="password" name="password" placeholder="Password baru" required>
              </div>
              <button class="py-2 btn btn-light w-full rounded-md text-[#183018]" type="submit" id="forgot-btn">Ubah Password</button>
          </form>
      </div>
  </div>
</body>


</html>

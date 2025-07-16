<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamoire - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('/assets/images/bg/bg-login-light.png') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background overlay */
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.1);
        }

        .bg-decoration::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        .bg-decoration::after {
            content: '';
            position: absolute;
            bottom: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
            animation: float 25s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        #auth {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            max-width: 450px;
            width: 100%;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 8px 32px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.4);
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .auth-container:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.2),
                0 12px 40px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.5);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo h4 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #183018 0%, #2d4f2d 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .auth-title {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
            color: #2d3748;
        }

        .auth-subtitle {
            font-size: 1rem;
            line-height: 1.6;
            color: #718096;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.2rem;
            font-size: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #183018;
            box-shadow: 0 0 0 3px rgba(24, 48, 24, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .form-control.is-invalid {
            border-color: #e53e3e;
        }

        .password-container {
            position: relative;
        }

        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            transition: color 0.3s ease;
        }

        .password-toggle-icon:hover {
            color: #183018;
        }

        .btn-primary {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            background: linear-gradient(135deg, #183018 0%, #2d4f2d 100%);
            border: none;
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(24, 48, 24, 0.3);
            background: linear-gradient(135deg, #1a3a1a 0%, #2a4a2a 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 2rem;
        }

        .forgot-password a {
            color: #183018;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #1a3a1a;
            text-decoration: underline;
        }

        .invalid-feedback {
            display: block;
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #auth {
                padding: 1rem;
            }
            
            .auth-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .auth-logo h4 {
                font-size: 2rem;
            }
            
            .auth-title {
                font-size: 1.8rem;
            }
        }

        /* Loading animation */
        .btn-primary.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-primary.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Input focus effects */
        .form-group {
            position: relative;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            transform: translateY(-25px) scale(0.8);
            color: #183018;
        }

        .floating-label {
            position: absolute;
            top: 1rem;
            left: 1.2rem;
            background: white;
            padding: 0 0.5rem;
            color: #a0aec0;
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="bg-decoration"></div>
    
    <div id="auth">
        <div class="auth-container">
            <div class="auth-logo">
                <h4>Glamoire</h4>
            </div>
            
            <h1 class="auth-title">Selamat Datang</h1>
            <p class="auth-subtitle">Masukkan kredensial Anda untuk mengakses dashboard admin</p>
            
            <form id="loginForm" action="{{ route('login-admin') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" 
                           name="name"
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name"
                           placeholder="Masukkan username Anda" 
                           required 
                           value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" 
                               name="password"
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               placeholder="Masukkan password Anda" 
                               required>
                        <i class="bi bi-eye-slash password-toggle-icon" 
                           data-target="password"></i>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary" id="loginBtn">
                    <span class="btn-text">Masuk ke Dashboard</span>
                </button>
            </form>
            
            <div class="forgot-password">
                <p><a href="/forgot-password">Lupa password?</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.querySelector('.password-toggle-icon');
            const passwordInput = document.getElementById('password');
            
            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                if (type === 'password') {
                    passwordToggle.classList.remove('bi-eye');
                    passwordToggle.classList.add('bi-eye-slash');
                } else {
                    passwordToggle.classList.remove('bi-eye-slash');
                    passwordToggle.classList.add('bi-eye');
                }
            });
            
            // Add loading state to button
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            
            loginForm.addEventListener('submit', function() {
                loginBtn.classList.add('loading');
                loginBtn.innerHTML = '<span>Memproses...</span>';
            });
            
            // Input focus effects
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</body>
</html>
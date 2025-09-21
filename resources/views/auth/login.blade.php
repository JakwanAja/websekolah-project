<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMA Negeri Unggulan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            position: relative;
            z-index: 2;
        }
        
        .login-left {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover no-repeat;
            opacity: 0.2;
            z-index: -1;
        }
        
        .login-right {
            padding: 3rem;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }
        
        .school-logo {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 3rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .form-floating label {
            color: #6c757d;
        }
        
        .form-floating input {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }
        
        .form-floating input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        /* Floating particles effect */
        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .particle:nth-child(1) { width: 10px; height: 10px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 15px; height: 15px; left: 20%; animation-delay: -2s; }
        .particle:nth-child(3) { width: 20px; height: 20px; left: 60%; animation-delay: -4s; }
        .particle:nth-child(4) { width: 12px; height: 12px; left: 80%; animation-delay: -1s; }
        .particle:nth-child(5) { width: 8px; height: 8px; left: 90%; animation-delay: -3s; }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-100px) rotate(180deg);
                opacity: 0.8;
            }
        }
        
        /* Welcome text animation */
        .welcome-text {
            animation: slideInFromTop 1s ease-out;
        }
        
        @keyframes slideInFromTop {
            0% {
                transform: translateY(-30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* Form animation */
        .login-form {
            animation: slideInFromBottom 1s ease-out 0.3s both;
        }
        
        @keyframes slideInFromBottom {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @media (max-width: 768px) {
            .login-left {
                padding: 2rem;
            }
            .login-right {
                padding: 2rem;
            }
            .school-logo {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
            
            body {
                background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                            url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover no-repeat fixed;
            }
        }
    </style>
</head>
<body>
    <!-- Floating particles -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-card">
                        <div class="row g-0">
                            <!-- Left Panel -->
                            <div class="col-lg-5">
                                <div class="login-left">
                                    <div class="school-logo">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <h2 class="mb-3">SMA Negeri Unggulan</h2>
                                    <p class="mb-4">Sistem Informasi Manajemen Sekolah</p>
                                    <div class="mt-4">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Panel - Login Form -->
                            <div class="col-lg-7">
                                <div class="login-right">
                                    <div class="text-center mb-4 welcome-text">
                                        <h3 class="fw-bold text-dark mb-2">Selamat Datang!</h3>
                                        <p class="text-muted">Silakan masuk ke akun Anda</p>
                                    </div>

                                    <!-- Alert Messages -->
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <!-- Login Form -->
                                    <form method="POST" action="{{ route('login') }}" class="login-form">
                                        @csrf
                                        
                                        <!-- Email Input -->
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="floatingEmail" name="email" placeholder="name@example.com" 
                                                   value="{{ old('email') }}" required>
                                            <label for="floatingEmail">
                                                <i class="fas fa-envelope me-2"></i>Email
                                            </label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password Input -->
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="floatingPassword" name="password" placeholder="Password" required>
                                            <label for="floatingPassword">
                                                <i class="fas fa-lock me-2"></i>Password
                                            </label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                            <label class="form-check-label text-muted" for="remember">
                                                Ingat saya
                                            </label>
                                        </div>

                                        <!-- Login Button -->
                                        <div class="d-grid mb-4">
                                            <button type="submit" class="btn btn-primary btn-lg btn-login">
                                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                            </button>
                                        </div>

                                        <!-- Back to Home Link -->
                                        <div class="text-center">
                                            <a href="{{ route('home') }}" class="text-decoration-none">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus/blur effects to form inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                    this.parentElement.style.transition = 'transform 0.2s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Add loading effect to login button
            const loginBtn = document.querySelector('.btn-login');
            loginBtn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            });
        });
    </script>
</body>
</html>
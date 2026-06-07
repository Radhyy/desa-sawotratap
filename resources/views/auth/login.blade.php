<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desa Sawotratap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #2E7D32;
            --secondary-green: #4CAF50;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 15px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(46, 125, 50, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .auth-logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
            margin-bottom: 1rem;
        }

        .auth-title {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.2rem;
            font-size: 1.8rem;
        }

        .auth-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .form-floating > .form-control {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding-left: 1rem;
        }
        
        .form-floating > .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.1);
        }

        .form-floating > label {
            padding-left: 1rem;
            color: #64748b;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
            color: white;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .back-link:hover {
            color: var(--primary-green);
        }

        .register-link {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
        }
        
        .register-link:hover {
            text-decoration: underline;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Back to Home -->
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <div class="auth-card">
            <!-- Logo & Title -->
            <div class="text-center">
                <div class="auth-logo">
                    <img src="{{ asset('Logo/IMG_1650.GIF') }}" alt="Logo Sawotratap">
                </div>
                <h2 class="auth-title">Selamat Datang</h2>
                <p class="auth-subtitle">Silakan masuk ke akun Anda</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 12px; font-size: 0.9rem;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 0.8rem;"></button>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                    <label for="email"><i class="bi bi-envelope me-2"></i>Alamat Email</label>
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                    <label for="password"><i class="bi bi-lock me-2"></i>Kata Sandi</label>
                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 text-muted" onclick="togglePassword('password', this)" style="z-index: 10; border: none; background: transparent;">
                        <i class="bi bi-eye-slash fs-5"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember" style="font-size: 0.9rem;">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#" class="text-decoration-none" style="font-size: 0.9rem; color: var(--primary-green);">Lupa sandi?</a>
                </div>

                <button type="submit" class="btn btn-login w-100 mb-4">
                    Masuk Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </button>

                <div class="text-center">
                    <p class="mb-0 text-muted" style="font-size: 0.95rem;">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="register-link">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>

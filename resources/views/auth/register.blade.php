@extends('layouts.app')

@section('title', 'Daftar - Desa Sawotratap')

@section('content')
<div class="auth-container" style="margin-top: 100px; min-height: calc(100vh - 200px);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card">
                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="auth-logo mb-3">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h2 class="auth-title">Daftar</h2>
                        <p class="text-muted">Buat akun baru untuk mengakses layanan</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Oops!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Register Form -->
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}"
                                        placeholder="Nama lengkap Anda"
                                        required 
                                        autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}"
                                        placeholder="nama@email.com"
                                        required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Minimal 8 karakter"
                                        required>
                            </div>
                            <small class="text-muted">Password minimal 8 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" 
                                        class="form-control" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        placeholder="Ulangi password"
                                        required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                            <i class="bi bi-person-plus me-2"></i>Daftar
                        </button>

                        <div class="text-center">
                            <p class="mb-0">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                    Masuk sekarang
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 1px solid #e0e0e0;
    }

    .auth-logo {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
    }

    .auth-title {
        font-family: 'Sora', sans-serif;
        font-weight: 700;
        color: var(--primary-green);
        margin-bottom: 0.5rem;
    }

    .input-group-text {
        background: #f8f9fa;
        border-right: none;
        color: var(--primary-green);
    }

    .form-control {
        border-left: none;
        padding: 0.75rem;
    }

    .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.2rem rgba(45, 80, 22, 0.1);
    }

    .input-group-text,
    .form-control {
        border-color: #dee2e6;
    }

    .form-control:focus + .input-group-text,
    .input-group:focus-within .input-group-text {
        border-color: var(--primary-green);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
        border: none;
        font-weight: 600;
        font-size: 1.05rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(45, 80, 22, 0.3);
    }
</style>
@endsection

@extends('layouts.app')

@section('title', 'Reset Password - Desa Sawotratap')

@section('styles')
<style>
    * {
        --primary-green: #2d8659;
    }

    .reset-container {
        padding-top: 100px;
        padding-bottom: 50px;
        background: #f8f9fa;
    }

    .reset-card {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0f0f0;
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #f5f5f5;
    }

    .card-header-icon {
        width: 50px;
        height: 50px;
        background: rgba(220, 53, 69, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #dc3545;
    }

    .card-header h1 {
        margin: 0;
        color: #dc3545;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .card-header p {
        margin: 0.5rem 0 0 0;
        color: #666;
        margin-left: 60px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da, #fff0f1);
        border: 2px solid #f5c6cb;
        color: #721c24;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .alert-danger strong {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert-danger li {
        margin-bottom: 0.5rem;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff3cd, #fffbea);
        border: 2px solid #ffeeba;
        color: #856404;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .alert-warning i {
        font-size: 1.3rem;
        flex-shrink: 0;
        margin-top: 0.25rem;
    }

    .alert-warning p {
        margin: 0;
        font-weight: 600;
    }

    .requirements-box {
        background: linear-gradient(135deg, #e7f3ff, #f0f8ff);
        border: 2px solid #b3d9f2;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .requirements-box p {
        margin: 0 0 0.75rem 0;
        color: #004085;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .requirements-box p i {
        font-size: 1.2rem;
    }

    .requirements-box ul {
        margin: 0.75rem 0 0 0;
        padding-left: 1.5rem;
        color: #004085;
    }

    .requirements-box li {
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: var(--primary-green);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .password-toggle {
        position: relative;
    }

    .form-group input {
        width: 100%;
        padding: 0.875rem 2.5rem 0.875rem 0.875rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .password-toggle input {
        padding-right: 0.875rem;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 4px rgba(45, 134, 89, 0.1);
        background-color: #fafafa;
    }

    .form-error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group.has-error input {
        border-color: #dc3545;
    }

    .toggle-btn {
        position: absolute;
        right: 12px;
        top: 39px;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--primary-green);
        font-size: 1.2rem;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .toggle-btn:hover {
        color: #1b7d52;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 2px solid #f0f0f0;
    }

    .btn-submit {
        background: var(--primary-green);
        color: white;
        padding: 0.875rem 2.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .btn-submit:hover {
        background: #1b7d52;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(45, 134, 89, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
        padding: 0.875rem 2.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .btn-cancel:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    @media (max-width: 768px) {
        .reset-card {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            justify-content: center;
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="reset-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="reset-card">
                    <div class="card-header">
                        <div class="card-header-icon">
                            <i class="bi bi-key"></i>
                        </div>
                        <div>
                            <h1>Reset Password</h1>
                            <p>Ubah password Anda dengan password baru yang lebih aman</p>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert-danger">
                        <strong><i class="bi bi-exclamation-circle-fill"></i> Terjadi Kesalahan!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="alert-warning">
                        <i class="bi bi-shield-exclamation"></i>
                        <div>
                            <p>Keamanan Akun Anda</p>
                            <p style="font-weight: normal; margin-top: 0.5rem;">Pastikan password baru Anda kuat dan tidak mudah ditebak. Jangan bagikan password Anda kepada siapa pun.</p>
                        </div>
                    </div>

                    <div class="requirements-box">
                        <p><i class="bi bi-exclamation-triangle-fill"></i> Persyaratan Password</p>
                        <ul>
                            <li><strong>Minimal 8 karakter</strong> - Semakin panjang semakin aman</li>
                            <li><strong>Kombinasi huruf besar dan kecil</strong> - Contoh: AaBbCc</li>
                            <li><strong>Kombinasi angka</strong> - Tambahkan angka untuk keamanan lebih</li>
                            <li><strong>Hindari informasi pribadi</strong> - Jangan gunakan nama atau tanggal lahir</li>
                        </ul>
                    </div>

                    <form action="{{ route('profile.reset-password.update') }}" method="POST" id="resetForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group @error('current_password') has-error @enderror">
                            <label for="current_password">
                                <i class="bi bi-lock"></i> Password Saat Ini
                            </label>
                            <div class="password-toggle">
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password" 
                                    placeholder="Masukkan password saat ini"
                                    required
                                >
                                <button type="button" class="toggle-btn" onclick="togglePassword('current_password')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('current_password')
                            <div class="form-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group @error('new_password') has-error @enderror">
                            <label for="new_password">
                                <i class="bi bi-lock-fill"></i> Password Baru
                            </label>
                            <div class="password-toggle">
                                <input 
                                    type="password" 
                                    id="new_password" 
                                    name="new_password" 
                                    placeholder="Masukkan password baru"
                                    required
                                    minlength="8"
                                >
                                <button type="button" class="toggle-btn" onclick="togglePassword('new_password')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('new_password')
                            <div class="form-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group @error('new_password_confirmation') has-error @enderror">
                            <label for="new_password_confirmation">
                                <i class="bi bi-lock-fill"></i> Konfirmasi Password Baru
                            </label>
                            <div class="password-toggle">
                                <input 
                                    type="password" 
                                    id="new_password_confirmation" 
                                    name="new_password_confirmation" 
                                    placeholder="Konfirmasi password baru Anda"
                                    required
                                    minlength="8"
                                >
                                <button type="button" class="toggle-btn" onclick="togglePassword('new_password_confirmation')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('new_password_confirmation')
                            <div class="form-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-lg"></i> Ubah Password
                            </button>
                            <a href="{{ route('profile.index') }}" class="btn-cancel">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = event.target.closest('.toggle-btn');
    
    if (field.type === 'password') {
        field.type = 'text';
        button.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        field.type = 'password';
        button.innerHTML = '<i class="bi bi-eye"></i>';
    }
}
</script>
@endsection

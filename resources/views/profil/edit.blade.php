@extends('layouts.app')

@section('title', 'Edit Profil - Desa Sawotratap')

@section('styles')
<style>
    * {
        --primary-green: #2d8659;
    }

    .edit-container {
        padding-top: 100px;
        padding-bottom: 50px;
        background: #f8f9fa;
    }

    .edit-card {
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
        background: rgba(45, 134, 89, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--primary-green);
    }

    .card-header h1 {
        margin: 0;
        color: var(--primary-green);
        font-size: 1.8rem;
        font-weight: 700;
    }

    .card-header p {
        margin: 0.5rem 0 0 0;
        color: #666;
        margin-left: 60px;
    }

    .form-section {
        margin-bottom: 2.5rem;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-green);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f0f0;
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

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 4px rgba(45, 134, 89, 0.1);
        background-color: #fafafa;
    }

    .form-group input:disabled,
    .form-group textarea:disabled {
        background-color: #f5f5f5;
        color: #999;
        cursor: not-allowed;
    }

    .form-error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group.has-error input,
    .form-group.has-error textarea {
        border-color: #dc3545;
    }

    .form-hint {
        color: #666;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    .change-avatar {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 8px;
        border: 2px dashed var(--primary-green);
        margin-bottom: 2rem;
    }

    .change-avatar-icon {
        width: 60px;
        height: 60px;
        background: rgba(45, 134, 89, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--primary-green);
    }

    .change-avatar-text p {
        margin: 0;
    }

    .change-avatar-text strong {
        color: var(--primary-green);
    }

    @media (max-width: 768px) {
        .edit-card {
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

        .change-avatar {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="edit-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="edit-card">
                    <div class="card-header">
                        <div class="card-header-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <h1>Edit Profil</h1>
                            <p>Perbarui informasi profil Anda dengan data terbaru</p>
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
                        <i class="bi bi-info-circle"></i>
                        <p><strong>Catatan:</strong> Email dan Role tidak dapat diubah. Hubungi administrator jika ingin mengubah data tersebut.</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Avatar Section -->
                        <div class="change-avatar">
                            <div class="change-avatar-icon">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="change-avatar-text">
                                <p><strong>Profil Anda</strong></p>
                                <p style="color: #666; font-size: 0.9rem; margin-top: 0.25rem;">{{ $user->name }} • {{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- Informasi Dasar -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-person-badge"></i> Informasi Dasar
                            </div>

                            <div class="form-group @error('name') has-error @enderror">
                                <label for="name">
                                    <i class="bi bi-person"></i> Nama Lengkap
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan nama lengkap Anda"
                                    required
                                    maxlength="255"
                                >
                                @error('name')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                                @else
                                <div class="form-hint">
                                    <i class="bi bi-info-circle"></i>
                                    Maksimal 255 karakter
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Akun -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-lock"></i> Data Akun (Tidak Dapat Diubah)
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    <i class="bi bi-envelope"></i> Email
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ $user->email }}"
                                    disabled
                                >
                                <div class="form-hint">
                                    <i class="bi bi-lock-fill"></i>
                                    Email tidak dapat diubah melalui profil
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">
                                    <i class="bi bi-shield-check"></i> Role / Status
                                </label>
                                <input 
                                    type="text" 
                                    id="role" 
                                    name="role" 
                                    value="{{ ucfirst($user->role) }}"
                                    disabled
                                >
                                <div class="form-hint">
                                    <i class="bi bi-lock-fill"></i>
                                    Role hanya dapat diubah oleh administrator
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-lg"></i> Simpan Perubahan
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
@endsection

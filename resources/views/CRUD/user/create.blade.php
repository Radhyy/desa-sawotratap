@extends('CRUD.layouts.admin')

@section('title', 'Tambah Pengguna - Admin Desa Sawotratap')
@section('page-title', 'Tambah Pengguna')
@section('page-description', 'Buat pengguna baru untuk sistem')

@push('styles')
<style>
    .form-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    .form-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 1.25rem;
        padding-bottom: 0.6rem;
        border-bottom: 1px dashed #e5e7eb;
    }
    .form-label {
        font-weight: 600;
        font-size: 0.87rem;
        color: #374151;
        margin-bottom: 0.4rem;
    }
    .form-control, .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        font-size: 0.9rem;
        color: #111827;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fafafa;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2d5016;
        box-shadow: 0 0 0 3px rgba(45,80,22,0.1);
        background: #fff;
    }
    .form-control::placeholder { color: #c4c9d4; }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #ef4444; }

    /* Buttons */
    .btn-submit {
        background: #152c0a;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-submit:hover { background: #2d5016; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(21,44,10,0.25); }

    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.3rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #111827; }
</style>
@endpush

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="form-card">
                <div class="form-section-title">Informasi Akun</div>
                        
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: user@desa.id" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang password" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="role" class="form-label">Hak Akses (Role) <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="" disabled selected>-- Pilih Hak Akses --</option>
                                <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                                <option value="kades" {{ old('role') == 'kades' ? 'selected' : '' }}>Kepala Desa (Kades)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center gap-3 border-top pt-4 mt-4">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-lg"></i> Simpan Pengguna
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                        </div>
            </div>
        </form>
    </div>
</div>
@endsection

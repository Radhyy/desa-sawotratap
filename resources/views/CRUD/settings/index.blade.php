@extends('CRUD.layouts.admin')

@section('title', 'Pengaturan Website - Admin Desa Sawotratap')
@section('page-title', 'Pengaturan Website')
@section('page-description', 'Ubah informasi kontak, sosial media, dan identitas website')

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

    .input-group-text {
        background: #f3f4f6;
        border: 1.5px solid #e5e7eb;
        border-right: none;
        color: #6b7280;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .input-group .form-control {
        border-left: none;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .input-group:focus-within .input-group-text {
        border-color: #2d5016;
        background: #fff;
    }
</style>
@endpush

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border:none; background:#dcfce7; color:#15803d; font-weight:500;">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-card">
                <div class="form-section-title">Informasi Utama</div>
                
                <div class="mb-4">
                    <label for="site_name" class="form-label">Nama Website / Organisasi</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}">
                </div>

                <div class="mb-4">
                    <label for="site_description" class="form-label">Deskripsi Singkat (Footer)</label>
                    <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-card">
                <div class="form-section-title">Kontak & Alamat</div>
                
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="contact_email" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="contact_phone" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="mb-0">
                    <label for="contact_address" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="contact_address" name="contact_address" rows="2">{{ $settings['contact_address'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-card">
                <div class="form-section-title">Media Sosial</div>
                
                <div class="mb-4">
                    <label for="facebook_url" class="form-label">Facebook URL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-facebook text-primary"></i></span>
                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}" placeholder="https://facebook.com/...">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="instagram_url" class="form-label">Instagram URL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-instagram text-danger"></i></span>
                        <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/...">
                    </div>
                </div>

                <div class="mb-0">
                    <label for="youtube_url" class="form-label">YouTube URL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-youtube text-danger"></i></span>
                        <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ $settings['youtube_url'] ?? '' }}" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center mb-5">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-save"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
    
    <div class="col-lg-4">
        <div class="form-card" style="background: #f8fafc; border-color: #e2e8f0;">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #dbeafe; color: #1e3a8a; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <h6 class="mb-0 fw-bold" style="color: #1e293b;">Informasi</h6>
            </div>
            <p style="font-size: 0.85rem; color: #475569; line-height: 1.6; margin-bottom: 0;">
                Data yang diubah pada halaman ini akan langsung berdampak pada seluruh halaman website desa yang dapat dilihat oleh publik. Pastikan URL media sosial dan kontak valid agar warga mudah menghubungi.
            </p>
        </div>
    </div>
</div>
@endsection

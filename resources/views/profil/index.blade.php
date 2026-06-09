@extends('layouts.app')

@section('title', 'Profil Saya - Desa Sawotratap')

@section('styles')
<style>
    .profile-page {
        padding: 100px 0 60px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }
    
    .profile-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #198754, #157347);
        padding: 40px 30px;
        color: white;
        text-align: center;
        position: relative;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(5px);
        border: 4px solid rgba(255,255,255,0.8);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-role {
        font-size: 0.9rem;
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
        backdrop-filter: blur(5px);
    }

    .profile-body {
        padding: 30px;
    }

    .info-group {
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #f1f1f1;
    }

    .info-group:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    .info-value {
        font-size: 1.05rem;
        color: #212529;
        font-weight: 500;
    }

    .action-btn {
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        margin-bottom: 12px;
    }

    .action-btn:last-child {
        margin-bottom: 0;
    }

    .btn-edit {
        background: #198754;
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background: #157347;
        color: white;
        transform: translateY(-2px);
    }

    .btn-reset {
        background: #fff;
        color: #198754;
        border: 1px solid #198754;
    }

    .btn-reset:hover {
        background: #f8f9fa;
        color: #157347;
        transform: translateY(-2px);
    }

    .btn-logout {
        background: #fff;
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    .btn-logout:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
    }

    .timeline {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        padding-left: 50px;
        margin-bottom: 25px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: absolute;
        left: 6px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #198754;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        box-shadow: 0 0 0 4px #fff;
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .timeline-title {
        font-weight: 600;
        color: #212529;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    .timeline-time {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .timeline-desc {
        font-size: 0.85rem;
        color: #495057;
        margin: 0;
    }
</style>
@endsection

@php
    // Logika sederhana untuk menentukan gender berdasarkan nama
    $nameLower = strtolower($user->name);
    $emailLower = strtolower($user->email);
    $stringToCheck = $nameLower . ' ' . $emailLower;
    
    $femaleKeywords = ['putri', 'dewi', 'ayu', 'sri', 'nur', 'siti', 'indah', 'wati', 'sari', 'diana', 'ratna', 'nisa', 'aulia', 'zahra'];
    $maleKeywords = ['putra', 'mas ', 'bagus', 'budi', 'joko', 'eko', 'agus', 'ari', 'wan', 'udin', 'anto', 'andi', 'kades'];
    
    $isFemale = false;
    foreach($femaleKeywords as $kw) {
        if (strpos($stringToCheck, $kw) !== false) {
            $isFemale = true;
            break;
        }
    }
    
    // Jika tidak kedeteksi cewe, cek cowo
    $isMale = false;
    if (!$isFemale) {
        foreach($maleKeywords as $kw) {
            if (strpos($stringToCheck, $kw) !== false) {
                $isMale = true;
                break;
            }
        }
    }
    
    // Gunakan seed khusus untuk men-trigger style laki/perempuan di Dicebear 
    // Dicebear Adventurer cenderung merespon pada seed tertentu.
    $seed = urlencode($user->name);
    if ($isFemale) {
        $seed .= '-girl';
    } elseif ($isMale) {
        $seed .= '-boy';
    }
@endphp

@section('content')
<div class="profile-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ $seed }}&backgroundColor=b6e3f4" alt="Avatar">
                        </div>
                        <h1 class="profile-name">{{ $user->name }}</h1>
                        <div class="profile-role">
                            <i class="bi bi-shield-check me-1"></i> {{ ucfirst($user->role) }}
                        </div>
                    </div>
                    
                    <div class="profile-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="info-group">
                                    <span class="info-label"><i class="bi bi-envelope me-1"></i> Email</span>
                                    <div class="info-value">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-group">
                                    <span class="info-label"><i class="bi bi-at me-1"></i> Username</span>
                                    <div class="info-value">{{ explode('@', $user->email)[0] }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-group">
                                    <span class="info-label"><i class="bi bi-calendar3 me-1"></i> Terdaftar Pada</span>
                                    <div class="info-value">{{ $user->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-group">
                                    <span class="info-label"><i class="bi bi-geo-alt me-1"></i> Alamat</span>
                                    <div class="info-value">Sawotratap, Sidoarjo</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" style="border-color: #eee;">

                        <h6 class="mb-4 fw-bold text-success"><i class="bi bi-clock-history me-2"></i>Riwayat Aktivitas</h6>
                        <ul class="timeline mb-4">
                            <li class="timeline-item">
                                <div class="timeline-icon bg-success">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Akun Dibuat</div>
                                    <div class="timeline-time">{{ $user->created_at->format('d M Y, H:i') }}</div>
                                    <p class="timeline-desc">Registrasi akun berhasil dilakukan ke dalam sistem desa.</p>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-icon bg-primary">
                                    <i class="bi bi-pencil-fill"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Profil Diperbarui</div>
                                    <div class="timeline-time">{{ $user->updated_at->format('d M Y, H:i') }}</div>
                                    <p class="timeline-desc">Informasi atau data profil akun terakhir kali diubah.</p>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-icon bg-warning text-dark">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Login Aktif</div>
                                    <div class="timeline-time">{{ now()->format('d M Y, H:i') }}</div>
                                    <p class="timeline-desc">Sesi login Anda sedang aktif saat ini.</p>
                                </div>
                            </li>
                        </ul>

                        <hr class="my-4" style="border-color: #eee;">

                        <div class="row g-2">
                            <div class="col-sm-6">
                                <a href="{{ route('profile.edit') }}" class="action-btn btn-edit text-decoration-none">
                                    <i class="bi bi-pencil-square"></i> Edit Profil
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('profile.reset-password') }}" class="action-btn btn-reset text-decoration-none">
                                    <i class="bi bi-key"></i> Ganti Password
                                </a>
                            </div>
                            <div class="col-12 mt-2">
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="action-btn btn-logout w-100">
                                        <i class="bi bi-box-arrow-right"></i> Keluar / Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

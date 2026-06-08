@extends('layouts.app')

@section('title', 'Semua Pengumuman - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .announcement-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        font-family: 'Inter', sans-serif;
    }

    .announcement-breadcrumb {
        margin-top: 60px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .announcement-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .announcement-header .container {
        padding-top: 24px;
        padding-bottom: 34px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
    }

    .announcement-hero-title {
        font-size: 2.5rem;
        line-height: 1.15;
        margin-bottom: 6px;
    }

    .hero-subtitle {
        color: #5e6d64 !important;
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400 !important;
        margin-top: 0.25rem;
    }

    .announcement-stats {
        margin-top: 28px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .announcement-stat-box {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #dde7d6;
        box-shadow: 0 6px 18px rgba(45, 80, 22, 0.06);
        text-align: center;
    }

    .announcement-stat-icon {
        font-size: 2rem;
        margin-bottom: 8px;
        display: block;
        color: var(--primary-green);
    }

    .announcement-stat-number {
        font-size: 1.9rem;
        font-weight: 800;
        display: block;
        color: #22331d;
        line-height: 1.1;
    }

    .announcement-stat-label {
        font-size: 0.88rem;
        margin-top: 5px;
        color: #5e6d64;
        font-weight: 500;
    }

    .announcement-grid-shell {
        position: relative;
        z-index: 1;
    }

    .announcement-filter-bar {
        margin-top: 12px;
    }

    .announcement-chip {
        padding: 10px 24px;
        border: 2px solid var(--primary-green);
        background: white;
        color: var(--primary-green);
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        margin: 5px;
        font-size: 0.9rem;
    }

    .announcement-chip.active {
        background: var(--primary-green);
        color: white;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
    }

    .announcement-chip:hover {
        background: var(--primary-green);
        color: white;
        transform: translateY(-2px);
    }

    .announcement-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .announcement-card {
        height: 100%;
    }

    .announcement-card-title {
        margin-bottom: 0.8rem;
    }

    .announcement-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #edf2ea;
        flex-wrap: wrap;
    }

    .announcement-footer-cta {
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: #fff;
        padding: 28px;
        box-shadow: 0 18px 40px rgba(45, 80, 22, 0.22);
    }

    .announcement-footer-cta p {
        color: rgba(255, 255, 255, 0.92);
        max-width: 720px;
        margin: 0 auto 16px;
    }

    .announcement-footer-cta .btn {
        border-radius: 999px;
        font-weight: 700;
        padding: 0.65rem 1.1rem;
    }

    @media (max-width: 1199.98px) {
        .announcement-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .announcement-page {
            padding-bottom: 40px;
        }

        .announcement-header .container {
            padding-top: 34px;
            padding-bottom: 34px;
        }

        .announcement-hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 0.97rem;
            line-height: 1.62;
        }

        .announcement-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="announcement-page">
    <div class="announcement-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="announcement-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center announcement-hero-title">Pengumuman Desa</h1>
                <p class="hero-subtitle">
                    Semua informasi dan pengumuman resmi dari Desa Sawotratap disajikan dalam tampilan yang rapi, elegan, dan mudah dibaca.
                </p>
            </div>

            <div class="announcement-stats">
                <div class="announcement-stat-box">
                    <i class="bi bi-megaphone announcement-stat-icon"></i>
                    <span class="announcement-stat-number">{{ $announcements->count() }}</span>
                    <span class="announcement-stat-label">Pengumuman Aktif</span>
                </div>
                <div class="announcement-stat-box">
                    <i class="bi bi-file-earmark-text announcement-stat-icon"></i>
                    <span class="announcement-stat-number">{{ $announcements->hasPages() ? 'Berkala' : 'Terbaru' }}</span>
                    <span class="announcement-stat-label">Pembaruan Informasi</span>
                </div>
                <div class="announcement-stat-box">
                    <i class="bi bi-calendar3 announcement-stat-icon"></i>
                    <span class="announcement-stat-number">{{ now()->format('Y') }}</span>
                    <span class="announcement-stat-label">Tahun Berjalan</span>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 bg-white announcement-filter-bar">
        <div class="container">
            <div class="text-center">
                <a href="{{ route('announcements') }}" class="announcement-chip active text-decoration-none">
                    <i class="bi bi-grid-3x3-gap"></i> Semua Pengumuman
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container announcement-grid-shell">
            <div class="row g-4">
                @forelse($announcements as $announcement)
                    <div class="col-md-6">
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="announcement-card-link">
                            <div class="announcement-card h-100">
                                @if($announcement->image)
                                    <div class="announcement-card-img-wrapper">
                                        <img src="{{ asset('storage/' . $announcement->image) }}"
                                             class="announcement-card-img"
                                             alt="{{ $announcement->title }}"
                                             loading="lazy">
                                    </div>
                                @endif
                                <div class="announcement-card-body d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar3 text-success me-2"></i>
                                            <small class="text-muted">{{ $announcement->date->format('d F Y') }}</small>
                                        </div>
                                        <span class="badge bg-success rounded-pill px-3 py-2">{{ ucfirst($announcement->status) }}</span>
                                    </div>

                                    <h4 class="announcement-card-title">
                                        {{ $announcement->title }}
                                    </h4>

                                    <p class="text-muted mb-3">{{ $announcement->description }}</p>

                                    @if($announcement->content)
                                        <div class="announcement-content mb-3">
                                            <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.7;">
                                                {{ Str::limit($announcement->content, 150) }}
                                            </p>
                                        </div>
                                    @endif

                                    <div class="announcement-card-meta mt-auto">
                                        <span class="text-success fw-semibold">
                                            Selengkapnya <i class="bi bi-arrow-right"></i>
                                        </span>
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $announcement->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                            <h4 class="mt-3 text-muted">Belum ada pengumuman</h4>
                            <p class="text-muted">Pengumuman akan muncul di sini</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($announcements->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <nav aria-label="Page navigation">
                        {{ $announcements->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            @endif

            <div class="announcement-footer-cta text-center mt-5">
                <i class="bi bi-bell-fill" style="font-size: 3rem; margin-bottom: 16px; display: block;"></i>
                <h3 class="mb-3">Ingin Mendapatkan Notifikasi Pengumuman?</h3>
                <p>
                    Daftarkan email Anda untuk mendapatkan pengumuman terbaru dari desa secara lebih cepat.
                </p>
                <a href="{{ route('home') }}" class="btn btn-light fw-bold rounded-pill px-4">
                    <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Semua Pengumuman - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="bg-light py-3" style="margin-top: 80px;">
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

<!-- Hero Section for Announcements -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title-center" style="font-size: 2.5rem;">Pengumuman Desa</h1>
            <p class="text-muted mt-3" style="font-size: 1.1rem; font-weight: 400;">
                Semua informasi dan pengumuman resmi dari Desa Sawotratap
            </p>
        </div>
    </div>
</section>

<!-- All Announcements Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($announcements as $announcement)
            <div class="col-md-6 mb-4">
                <div class="announcement-card h-100">
                    @if($announcement->image)
                    <div class="announcement-card-img-wrapper">
                        <img src="{{ asset('storage/' . $announcement->image) }}" 
                                class="announcement-card-img" 
                                alt="{{ $announcement->title }}">
                    </div>
                    @endif
                    <div class="announcement-card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 text-success me-2"></i>
                                <small class="text-muted">{{ $announcement->date->format('d F Y') }}</small>
                            </div>
                            <span class="badge bg-success">{{ ucfirst($announcement->status) }}</span>
                        </div>
                        <h4 class="announcement-card-title mb-3">
                            <a href="{{ route('announcements.show', $announcement->id) }}" class="text-decoration-none text-dark">
                                {{ $announcement->title }}
                            </a>
                        </h4>
                        <p class="text-muted mb-3">{{ $announcement->description }}</p>
                        
                        @if($announcement->content)
                        <div class="announcement-content mb-3">
                            <p class="text-secondary" style="font-size: 0.95rem; line-height: 1.7;">
                                {{ Str::limit($announcement->content, 150) }}
                            </p>
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('announcements.show', $announcement->id) }}" class="text-decoration-none fw-semibold text-success">
                                Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>
                                {{ $announcement->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
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

        <!-- Pagination -->
        @if($announcements->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                {{ $announcements->links('pagination::bootstrap-5') }}
            </nav>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="mb-2" style="color: var(--primary-green); font-family: 'Sora', sans-serif; font-weight: 700;">
                    <i class="bi bi-bell-fill me-2"></i>Ingin Mendapatkan Notifikasi Pengumuman?
                </h3>
                <p class="text-muted mb-0">
                    Daftarkan email Anda untuk mendapatkan notifikasi pengumuman terbaru dari desa
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="#" class="shiny-button" style="text-decoration: none; display: inline-block;">
                    <span class="button-text">
                        Berlangganan Notifikasi
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

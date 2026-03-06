@extends('layouts.app')

@section('title', $announcement->title . ' - Desa Sawotratap')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="announcement-detail-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('announcements') }}" class="text-decoration-none" style="color: var(--primary-green);">
                        <i class="bi bi-megaphone"></i> Pengumuman
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($announcement->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Announcement Detail -->
<section class="py-5" style="margin-top: -30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="announcement-detail-content">
                    <!-- Badge -->
                    <span class="badge bg-success mb-3" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                        <i class="bi bi-megaphone-fill me-2"></i>{{ ucfirst($announcement->status) }}
                    </span>
                    <!-- Title -->
                    <h1 class="announcement-detail-title">{{ $announcement->title }}</h1>

                    <!-- Meta Information -->
                    <div class="announcement-meta">
                        <div class="announcement-meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ $announcement->date->format('d F Y') }}</span>
                        </div>
                        <div class="announcement-meta-item">
                            <i class="bi bi-clock"></i>
                            <span>{{ $announcement->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="announcement-meta-item">
                            <i class="bi bi-eye"></i>
                            <span>Dibaca {{ rand(50, 500) }} kali</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($announcement->image)
                    <img src="{{ asset('storage/' . $announcement->image) }}" 
                            alt="{{ $announcement->title }}"
                            class="announcement-detail-image">
                    @endif

                    <!-- Description -->
                    <div class="announcement-detail-text">
                        <p class="lead" style="font-size: 1.2rem; font-weight: 500; color: #555;">
                            {{ $announcement->description }}
                        </p>
                    </div>

                    <!-- Full Content -->
                    @if($announcement->content)
                    <div class="announcement-detail-text">
                        {!! nl2br(e($announcement->content)) !!}
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <span style="color: #6c757d; font-weight: 600; margin-right: 0.5rem;">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                            target="_blank" 
                            class="share-btn share-btn-facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($announcement->title) }}" 
                            target="_blank" 
                            class="share-btn share-btn-twitter">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($announcement->title . ' - ' . url()->current()) }}" 
                            target="_blank" 
                            class="share-btn share-btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <button onclick="copyLink()" class="share-btn share-btn-copy">
                            <i class="bi bi-link-45deg"></i> Salin Link
                        </button>
                    </div>

                    <!-- Related Announcements -->
                    @if($relatedAnnouncements->count() > 0)
                    <div class="related-announcements">
                        <h3><i class="bi bi-bookmark-star me-2"></i>Pengumuman Terkait</h3>
                        <div class="row">
                            @foreach($relatedAnnouncements as $related)
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('announcements.show', $related->id) }}" class="related-card">
                                    <div class="related-card-body">
                                        <div class="related-card-icon mb-3">
                                            <i class="bi bi-megaphone-fill"></i>
                                        </div>
                                        <h5 class="related-card-title">{{ $related->title }}</h5>
                                        <p class="related-card-description text-muted mb-2">
                                            {{ Str::limit($related->description, 80) }}
                                        </p>
                                        <div class="related-card-date">
                                            <i class="bi bi-calendar3"></i>
                                            {{ $related->date->format('d M Y') }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(function() {
        alert('Link berhasil disalin!');
    }, function() {
        alert('Gagal menyalin link');
    });
}
</script>
@endsection

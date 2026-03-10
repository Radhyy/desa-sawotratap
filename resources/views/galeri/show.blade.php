@extends('layouts.app')

@section('title', $gallery['title'] . ' - Galeri Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .gallery-detail-header {
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        padding: 25px 0;
        margin-top: 76px;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.1);
    }

    .gallery-detail-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .gallery-detail-header .breadcrumb-item a {
        color: white !important;
        font-weight: 500;
    }

    .gallery-detail-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.8);
    }

    .gallery-detail-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }

    .gallery-detail-content {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-top: 30px;
    }

    .gallery-category-badge-detail {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 10px 24px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
    }

    .gallery-detail-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2d5016;
        line-height: 1.3;
        margin-bottom: 25px;
        font-family: 'Sora', sans-serif;
    }

    .gallery-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 2px solid #f0f0f0;
    }

    .gallery-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #666;
        font-size: 0.95rem;
    }

    .gallery-meta-item i {
        color: var(--primary-green);
        font-size: 1.2rem;
    }

    .gallery-detail-image {
        width: 100%;
        height: auto;
        border-radius: 16px;
        margin-bottom: 35px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        cursor: zoom-in;
    }

    .gallery-detail-text {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #444;
        margin-bottom: 30px;
        text-align: justify;
    }

    .gallery-detail-text p {
        margin-bottom: 20px;
    }

    .share-buttons {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 30px 0;
        border-top: 2px solid #f0f0f0;
        border-bottom: 2px solid #f0f0f0;
        margin: 30px 0;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .share-btn-facebook {
        background: #1877f2;
        color: white;
    }

    .share-btn-facebook:hover {
        background: #0d65d9;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
    }

    .share-btn-twitter {
        background: #1da1f2;
        color: white;
    }

    .share-btn-twitter:hover {
        background: #0c90e0;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(29, 161, 242, 0.3);
    }

    .share-btn-whatsapp {
        background: #25d366;
        color: white;
    }

    .share-btn-whatsapp:hover {
        background: #1ebe57;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }

    .share-btn-download {
        background: #6c757d;
        color: white;
    }

    .share-btn-download:hover {
        background: #545b62;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .related-gallery {
        margin-top: 50px;
        padding-top: 40px;
        border-top: 2px solid #f0f0f0;
    }

    .related-gallery h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d5016;
        margin-bottom: 30px;
        font-family: 'Sora', sans-serif;
    }

    .related-card {
        display: block;
        text-decoration: none;
        background: white;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .related-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.15);
    }

    .related-card-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .related-card-body {
        padding: 20px;
    }

    .related-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d5016;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .related-card-description {
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 12px;
        color: #666;
    }

    .related-card-date {
        font-size: 0.85rem;
        color: #999;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 28px;
        background: var(--primary-green);
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }

    .back-button:hover {
        background: var(--light-green);
        color: white;
        transform: translateX(-5px);
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
    }

    @media (max-width: 768px) {
        .gallery-detail-title {
            font-size: 1.8rem;
        }

        .gallery-detail-content {
            padding: 25px;
        }

        .gallery-meta {
            gap: 15px;
        }

        .share-buttons {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="gallery-detail-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('galeri') }}" class="text-decoration-none">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($gallery['title'], 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Gallery Detail -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <a href="{{ route('galeri') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Galeri
                </a>

                <div class="gallery-detail-content">
                    <!-- Category Badge -->
                    <span class="gallery-category-badge-detail">
                        @if($gallery['category'] === 'Alam')
                            <i class="bi bi-tree me-2"></i>
                        @elseif($gallery['category'] === 'Fasilitas')
                            <i class="bi bi-building me-2"></i>
                        @elseif($gallery['category'] === 'Wisata')
                            <i class="bi bi-signpost me-2"></i>
                        @elseif($gallery['category'] === 'UMKM')
                            <i class="bi bi-shop me-2"></i>
                        @elseif($gallery['category'] === 'Kegiatan')
                            <i class="bi bi-people me-2"></i>
                        @else
                            <i class="bi bi-bookmark me-2"></i>
                        @endif
                        {{ $gallery['category'] }}
                    </span>

                    <!-- Title -->
                    <h1 class="gallery-detail-title">{{ $gallery['title'] }}</h1>

                    <!-- Meta Information -->
                    <div class="gallery-meta">
                        <div class="gallery-meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ date('d F Y', strtotime($gallery['date'])) }}</span>
                        </div>
                        <div class="gallery-meta-item">
                            <i class="bi bi-camera"></i>
                            <span>{{ $gallery['photographer'] }}</span>
                        </div>
                        <div class="gallery-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $gallery['location'] }}</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <img src="{{ $gallery['image'] }}" 
                         alt="{{ $gallery['title'] }}"
                         class="gallery-detail-image"
                         onclick="window.open(this.src, '_blank')"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/1200x800?text=Galeri+Desa';">

                    <!-- Description -->
                    <div class="gallery-detail-text">
                        <p>
                            {{ $gallery['full_description'] ?? $gallery['description'] }}
                        </p>
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <span style="color: #6c757d; font-weight: 600;">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                            target="_blank" 
                            class="share-btn share-btn-facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($gallery['title']) }}" 
                            target="_blank" 
                            class="share-btn share-btn-twitter">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($gallery['title'] . ' - ' . url()->current()) }}" 
                            target="_blank" 
                            class="share-btn share-btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="{{ $gallery['image'] }}" download class="share-btn share-btn-download">
                            <i class="bi bi-download"></i> Unduh Foto
                        </a>
                    </div>

                    <!-- Related Galleries -->
                    @if($relatedGalleries->count() > 0)
                    <div class="related-gallery">
                        <h3><i class="bi bi-images me-2"></i>Galeri Terkait</h3>
                        <div class="row">
                            @foreach($relatedGalleries as $related)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('galeri.show', $related['id']) }}" class="related-card">
                                    <img src="{{ $related['image'] }}" 
                                         class="related-card-img" 
                                         alt="{{ $related['title'] }}"
                                         onerror="this.onerror=null;this.src='https://via.placeholder.com/600x400?text=Galeri';">
                                    <div class="related-card-body">
                                        <h5 class="related-card-title">{{ $related['title'] }}</h5>
                                        <p class="related-card-description">
                                            {{ Str::limit($related['description'], 70) }}
                                        </p>
                                        <div class="related-card-date">
                                            <i class="bi bi-calendar3"></i>
                                            {{ date('d M Y', strtotime($related['date'])) }}
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

@endsection

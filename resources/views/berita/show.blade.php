@extends('layouts.app')

@section('title', $news['title'] . ' - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .berita-detail-header {
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        padding: 25px 0;
        margin-top: 76px;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.1);
    }

    .berita-detail-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .berita-detail-header .breadcrumb-item a {
        color: white !important;
        font-weight: 500;
    }

    .berita-detail-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.8);
    }

    .berita-detail-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }

    .berita-detail-content {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-top: 30px;
    }

    .berita-category-badge {
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

    .trending-badge-detail {
        display: inline-block;
        background: linear-gradient(135deg, #ff6b6b, #ff8e53);
        color: white;
        padding: 10px 24px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        margin-left: 10px;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.2);
    }

    .berita-detail-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2d5016;
        line-height: 1.3;
        margin-bottom: 25px;
        font-family: 'Sora', sans-serif;
    }

    .berita-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 2px solid #f0f0f0;
    }

    .berita-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #666;
        font-size: 0.95rem;
    }

    .berita-meta-item i {
        color: var(--primary-green);
        font-size: 1.2rem;
    }

    .berita-detail-image {
        width: 100%;
        height: auto;
        border-radius: 16px;
        margin-bottom: 35px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .berita-detail-text {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #444;
        margin-bottom: 30px;
        text-align: justify;
    }

    .berita-detail-text p.lead {
        font-size: 1.25rem !important;
        font-weight: 500 !important;
        color: #555 !important;
        line-height: 1.8;
        margin-bottom: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-left: 4px solid var(--primary-green);
        border-radius: 8px;
    }

    .berita-detail-text p {
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

    .share-btn-copy {
        background: #6c757d;
        color: white;
    }

    .share-btn-copy:hover {
        background: #545b62;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .related-berita {
        margin-top: 50px;
        padding-top: 40px;
        border-top: 2px solid #f0f0f0;
    }

    .related-berita h3 {
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
        padding: 25px;
        transition: all 0.3s ease;
        height: 100%;
    }

    .related-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.15);
    }

    .related-card-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .related-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d5016;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .related-card-description {
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 15px;
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
        .berita-detail-title {
            font-size: 1.8rem;
        }

        .berita-detail-content {
            padding: 25px;
        }

        .berita-meta {
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
<div class="berita-detail-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('berita') }}" class="text-decoration-none">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news['title'], 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- News Detail -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <a href="{{ route('berita') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Berita
                </a>

                <div class="berita-detail-content">
                    <!-- Category Badge -->
                    <span class="berita-category-badge">
                        @if($news['category'] === 'Sosial')
                            <i class="bi bi-people me-2"></i>
                        @elseif($news['category'] === 'Budaya')
                            <i class="bi bi-mortarboard me-2"></i>
                        @elseif($news['category'] === 'Ekonomi')
                            <i class="bi bi-currency-dollar me-2"></i>
                        @elseif($news['category'] === 'Pembangunan')
                            <i class="bi bi-building me-2"></i>
                        @elseif($news['category'] === 'Program')
                            <i class="bi bi-clipboard-check me-2"></i>
                        @else
                            <i class="bi bi-bookmark me-2"></i>
                        @endif
                        {{ $news['category'] }}
                    </span>
                    
                    @if($news['trending'] ?? false)
                    <span class="trending-badge-detail">
                        <i class="bi bi-fire me-2"></i>Trending
                    </span>
                    @endif

                    <!-- Title -->
                    <h1 class="berita-detail-title">{{ $news['title'] }}</h1>

                    <!-- Meta Information -->
                    <div class="berita-meta">
                        <div class="berita-meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ date('d F Y', strtotime($news['date'])) }}</span>
                        </div>
                        <div class="berita-meta-item">
                            <i class="bi bi-clock"></i>
                            <span>{{ $news['read_time'] ?? '5 menit' }} baca</span>
                        </div>
                        <div class="berita-meta-item">
                            <i class="bi bi-eye"></i>
                            <span>{{ $news['views'] ?? rand(100, 500) }} views</span>
                        </div>
                        <div class="berita-meta-item">
                            <i class="bi bi-person"></i>
                            <span>{{ $news['author'] ?? 'Admin Desa' }}</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <img src="{{ $news['image'] }}" 
                         alt="{{ $news['title'] }}"
                         class="berita-detail-image">

                    <!-- Excerpt/Lead -->
                    <div class="berita-detail-text">
                        <p class="lead">
                            {{ $news['excerpt'] }}
                        </p>
                    </div>

                    <!-- Full Content -->
                    <div class="berita-detail-text">
                        {!! nl2br(e($news['content'])) !!}
                    </div>

                    <!-- Tags -->
                    @if(isset($news['tags']))
                    <div class="mb-4">
                        <strong style="color: #666; margin-right: 10px;">
                            <i class="bi bi-tags me-2"></i>Tags:
                        </strong>
                        @foreach($news['tags'] as $tag)
                        <span class="badge bg-light text-dark" style="font-size: 0.85rem; padding: 6px 12px; margin-right: 5px;">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <span style="color: #6c757d; font-weight: 600;">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                            target="_blank" 
                            class="share-btn share-btn-facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news['title']) }}" 
                            target="_blank" 
                            class="share-btn share-btn-twitter">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($news['title'] . ' - ' . url()->current()) }}" 
                            target="_blank" 
                            class="share-btn share-btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <button onclick="copyLink()" class="share-btn share-btn-copy">
                            <i class="bi bi-link-45deg"></i> Salin Link
                        </button>
                    </div>

                    <!-- Related News -->
                    @if(count($relatedNews) > 0)
                    <div class="related-berita">
                        <h3><i class="bi bi-newspaper me-2"></i>Berita Terkait</h3>
                        <div class="row">
                            @foreach($relatedNews as $related)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('berita.show', $related['id']) }}" class="related-card">
                                    <div class="related-card-body">
                                        <div class="related-card-icon mb-3">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                        <h5 class="related-card-title">{{ $related['title'] }}</h5>
                                        <p class="related-card-description text-muted mb-2">
                                            {{ Str::limit($related['excerpt'], 80) }}
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

@extends('layouts.app')

@section('title', 'Berita Terkini - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .news-card-enhanced {
        transition: all 0.3s ease;
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: white;
    }

    .news-card-enhanced:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .news-card-image {
        height: 280px;
        object-fit: cover;
        width: 100%;
    }

    .news-category-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
    }

    .news-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .news-stat-box {
        text-align: center;
        padding: 25px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
    }

    .news-stat-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(45, 80, 22, 0.3);
    }

    .news-stat-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
        display: block;
    }

    .news-stat-number {
        font-size: 2rem;
        font-weight: bold;
        display: block;
    }

    .news-stat-label {
        font-size: 0.95rem;
        margin-top: 5px;
        color: white;
        opacity: 0.95;
    }

    .filter-category-btn {
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

    .filter-category-btn.active {
        background: var(--primary-green);
        color: white;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
    }

    .filter-category-btn:hover {
        background: var(--primary-green);
        color: white;
        transform: translateY(-2px);
    }

    .news-date-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .news-date-info i {
        color: var(--primary-green);
    }

    .news-title-enhanced {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d5016;
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-excerpt {
        color: #666;
        line-height: 1.7;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-green);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        gap: 12px;
        color: var(--light-green);
    }

    .news-meta-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }

    .trending-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #ff6b6b, #ff8e53);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .trending-badge {
        animation: pulse 2s infinite;
    }
</style>
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
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Hero Section for News -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title-center" style="font-size: 2.5rem;">Berita Terkini</h1>
            <p class="text-muted mt-3" style="font-size: 1.1rem; font-weight: 400;">
                Informasi terbaru dan kegiatan masyarakat Desa Sawotratap
            </p>
        </div>

        <!-- News Statistics -->
        <div class="news-stats">
            <div class="news-stat-box">
                <i class="bi bi-newspaper news-stat-icon"></i>
                <span class="news-stat-number">{{ count($allNews) }}</span>
                <span class="news-stat-label">Total Berita</span>
            </div>
            <div class="news-stat-box">
                <i class="bi bi-fire news-stat-icon"></i>
                <span class="news-stat-number">{{ collect($allNews)->where('trending', true)->count() }}</span>
                <span class="news-stat-label">Berita Trending</span>
            </div>
            <div class="news-stat-box">
                <i class="bi bi-tags news-stat-icon"></i>
                <span class="news-stat-number">{{ collect($allNews)->pluck('category')->unique()->count() }}</span>
                <span class="news-stat-label">Kategori</span>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 bg-white">
    <div class="container">
        <div class="text-center">
            <button class="filter-category-btn active" onclick="filterNewsByCategory('all')">
                <i class="bi bi-grid-3x3-gap"></i> Semua Berita
            </button>
            @php
                $categories = collect($allNews)->pluck('category')->unique()->values();
            @endphp
            @foreach($categories as $category)
            <button class="filter-category-btn" onclick="filterNewsByCategory('{{ $category }}')">
                @if($category === 'Sosial')
                    <i class="bi bi-people"></i>
                @elseif($category === 'Budaya')
                    <i class="bi bi-mortarboard"></i>
                @elseif($category === 'Ekonomi')
                    <i class="bi bi-currency-dollar"></i>
                @elseif($category === 'Pembangunan')
                    <i class="bi bi-building"></i>
                @elseif($category === 'Program')
                    <i class="bi bi-clipboard-check"></i>
                @else
                    <i class="bi bi-bookmark"></i>
                @endif
                {{ $category }}
            </button>
            @endforeach
        </div>
    </div>
</section>

<!-- All News Section -->
<section class="py-5">
    <div class="container">
        <div class="row" id="newsContainer">
            @forelse($allNews as $news)
            <div class="col-md-6 col-lg-4 mb-4 news-item" data-category="{{ $news['category'] }}">
                <div class="card news-card-enhanced h-100">
                    <div class="position-relative">
                        <img src="{{ $news['image'] }}" 
                             class="news-card-image" 
                             alt="{{ $news['title'] }}">
                        <span class="news-category-badge">{{ $news['category'] }}</span>
                        @if($news['trending'] ?? false)
                        <span class="trending-badge">
                            <i class="bi bi-fire"></i> Trending
                        </span>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="news-date-info">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2"></i>
                                <small class="text-muted">{{ date('d F Y', strtotime($news['date'])) }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock me-2"></i>
                                <small class="text-muted">{{ $news['read_time'] ?? '5 menit' }}</small>
                            </div>
                        </div>

                        <h5 class="news-title-enhanced">{{ $news['title'] }}</h5>
                        
                        <p class="news-excerpt flex-grow-1">
                            {{ $news['excerpt'] }}
                        </p>

                        <a href="#" class="read-more-btn">
                            Baca Selengkapnya 
                            <i class="bi bi-arrow-right"></i>
                        </a>

                        <div class="news-meta-info">
                            <small class="text-muted">
                                <i class="bi bi-eye me-1"></i>
                                {{ $news['views'] ?? rand(100, 500) }} views
                            </small>
                            <small class="text-muted">
                                <i class="bi bi-person me-1"></i>
                                {{ $news['author'] ?? 'Admin' }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-newspaper" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">Belum ada berita</h4>
                    <p class="text-muted">Berita akan ditampilkan di sini</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-green), var(--light-green)); color: white;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <i class="bi bi-envelope-paper" style="font-size: 3rem; margin-bottom: 20px; display: block;"></i>
                <h2 class="mb-3">Berlangganan Newsletter Kami</h2>
                <p class="mb-4" style="font-size: 1.1rem;">
                    Dapatkan berita terbaru dan informasi penting langsung ke email Anda
                </p>
                <div class="input-group mb-3" style="max-width: 500px; margin: 0 auto;">
                    <input type="email" class="form-control" placeholder="Masukkan email Anda" style="padding: 12px 20px; border: none; border-radius: 25px 0 0 25px;">
                    <button class="btn btn-light fw-bold" type="button" style="padding: 12px 30px; border-radius: 0 25px 25px 0;">
                        <i class="bi bi-send"></i> Berlangganan
                    </button>
                </div>
                <small style="opacity: 0.9;">* Kami menghargai privasi Anda dan tidak akan membagikan email Anda</small>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function filterNewsByCategory(category) {
    const newsItems = document.querySelectorAll('.news-item');
    const buttons = document.querySelectorAll('.filter-category-btn');

    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    // Filter news
    newsItems.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'scale(1)';
            }, 10);
        } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.9)';
            setTimeout(() => {
                item.style.display = 'none';
            }, 300);
        }
    });
}

// Smooth transition effect
document.querySelectorAll('.news-item').forEach(item => {
    item.style.transition = 'all 0.3s ease';
});
</script>
@endpush

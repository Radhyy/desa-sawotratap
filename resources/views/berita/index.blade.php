@extends('layouts.app')

@section('title', 'Berita Terkini - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .news-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
    }

    .news-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .news-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .news-header .container {
        padding-top: 44px;
        padding-bottom: 44px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        color: #6c757d;
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400;
    }

    .news-stats {
        margin-top: 28px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .news-stat-box {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #dde7d6;
        box-shadow: 0 6px 18px rgba(45, 80, 22, 0.06);
        text-align: center;
    }

    .news-stat-icon {
        font-size: 2rem;
        margin-bottom: 8px;
        display: block;
        color: var(--primary-green);
    }

    .news-stat-number {
        font-size: 1.9rem;
        font-weight: 800;
        display: block;
        color: #22331d;
        line-height: 1.1;
    }

    .news-stat-label {
        font-size: 0.88rem;
        margin-top: 5px;
        color: #5e6d64;
        font-weight: 500;
    }

    .news-shell {
        position: relative;
        z-index: 1;
    }

    .featured-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .featured-image {
        width: 100%;
        height: 100%;
        min-height: 360px;
        object-fit: cover;
    }

    .featured-content {
        padding: 24px;
    }

    .section-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #eef5e8;
        color: #355027;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .featured-title {
        font-size: 1.75rem;
        line-height: 1.3;
        color: #22331d;
        margin-bottom: 12px;
        font-weight: 800;
        font-family: 'Sora', sans-serif;
    }

    .featured-excerpt {
        color: #5c6a62;
        line-height: 1.8;
        margin-bottom: 18px;
        font-size: 0.98rem;
    }

    .mini-info-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-bottom: 18px;
    }

    .mini-info-box {
        border-radius: 12px;
        border: 1px solid #dce9d2;
        background: #f7fbf3;
        padding: 10px 12px;
    }

    .mini-info-label {
        display: block;
        font-size: 0.74rem;
        font-weight: 700;
        color: #355027;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 3px;
    }

    .mini-info-value {
        display: block;
        color: #22331d;
        font-size: 0.88rem;
        font-weight: 700;
    }

    .news-summary-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
        height: 100%;
    }

    .news-summary-card .head {
        padding: 20px 22px;
        background: linear-gradient(135deg, rgba(74, 124, 36, 0.12), rgba(45, 80, 22, 0.08));
        border-bottom: 1px solid #e9f0e3;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .news-summary-card .head h2 {
        font-size: 1.08rem;
        font-weight: 700;
        color: #24381f;
        margin: 0;
    }

    .news-summary-body {
        padding: 18px 22px 22px;
    }

    .highlight-list {
        display: grid;
        gap: 12px;
    }

    .highlight-item {
        border: 1px solid #e5ece0;
        border-radius: 14px;
        padding: 14px;
        background: #fff;
        transition: all 0.25s ease;
    }

    .highlight-item:hover {
        transform: translateY(-3px);
        border-color: #b6d0a3;
        box-shadow: 0 10px 20px rgba(45, 80, 22, 0.1);
    }

    .highlight-item h3 {
        margin: 0 0 0.35rem;
        font-size: 0.98rem;
        font-weight: 700;
        color: #22331d;
    }

    .highlight-item p {
        margin: 0;
        color: #5c6a62;
        font-size: 0.88rem;
        line-height: 1.55;
    }

    .filter-shell {
        margin-top: 12px;
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

    .news-card-enhanced {
        transition: all 0.3s ease;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
        background: white;
    }

    .news-card-enhanced:hover {
        transform: translateY(-8px);
        box-shadow: 0 14px 28px rgba(45, 80, 22, 0.14);
    }

    .news-card-image {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .news-category-badge {
        position: absolute;
        top: 18px;
        left: 18px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 8px 18px;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.26);
    }

    .trending-badge {
        position: absolute;
        top: 18px;
        right: 18px;
        background: linear-gradient(135deg, #ff6b6b, #ff8e53);
        color: white;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.25);
        display: flex;
        align-items: center;
        gap: 5px;
        animation: pulse 2s infinite;
    }

    .news-date-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #edf2ea;
        flex-wrap: wrap;
    }

    .news-date-info i {
        color: var(--primary-green);
    }

    .news-title-enhanced {
        font-size: 1.2rem;
        font-weight: 800;
        color: #22331d;
        margin-bottom: 12px;
        line-height: 1.45;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-excerpt {
        color: #5c6a62;
        line-height: 1.75;
        margin-bottom: 18px;
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
        font-weight: 700;
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
        border-top: 1px solid #edf2ea;
    }

    .news-footer-cta {
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: #fff;
        padding: 28px;
        box-shadow: 0 18px 40px rgba(45, 80, 22, 0.22);
    }

    .news-footer-cta p {
        color: rgba(255, 255, 255, 0.92);
        max-width: 720px;
        margin: 0 auto 16px;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @media (max-width: 1199.98px) {
        .news-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .mini-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .news-page {
            padding-bottom: 40px;
        }

        .news-header .container {
            padding-top: 34px;
            padding-bottom: 34px;
        }

        .hero-title {
            font-size: 2rem;
            line-height: 1.24;
            margin-bottom: 10px;
        }

        .hero-subtitle {
            font-size: 0.97rem;
            line-height: 1.62;
        }

        .news-stats {
            grid-template-columns: 1fr;
        }

        .featured-content,
        .news-summary-body {
            padding: 18px;
        }

        .news-card-image {
            height: 220px;
        }

        .news-meta-info {
            gap: 8px;
        }
    }
</style>
@endsection

@section('content')
@php
    $newsCollection = collect($allNews);
    $featuredNews = $newsCollection->first();
    $spotlightNews = $newsCollection->skip(1)->take(3);
    $categories = $newsCollection->pluck('category')->unique()->values();
    $latestNews = $newsCollection->take(3);
@endphp

<div class="news-page">
    <div class="news-breadcrumb py-3">
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

    <section class="news-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Berita Terkini</h1>
                <p class="hero-subtitle">
                    Informasi terbaru, kegiatan masyarakat, dan kabar penting dari Desa Sawotratap dalam satu halaman yang mudah dibaca.
                </p>
            </div>

            <div class="news-stats">
                <div class="news-stat-box">
                    <i class="bi bi-newspaper news-stat-icon"></i>
                    <span class="news-stat-number">{{ $newsCollection->count() }}</span>
                    <span class="news-stat-label">Total Berita</span>
                </div>
                <div class="news-stat-box">
                    <i class="bi bi-fire news-stat-icon"></i>
                    <span class="news-stat-number">{{ $newsCollection->where('trending', true)->count() }}</span>
                    <span class="news-stat-label">Trending</span>
                </div>
                <div class="news-stat-box">
                    <i class="bi bi-tags news-stat-icon"></i>
                    <span class="news-stat-number">{{ $categories->count() }}</span>
                    <span class="news-stat-label">Kategori</span>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-4">
        <div class="container news-shell">
            @if($featuredNews)
                @php
                    $featuredImage = Str::startsWith($featuredNews->image, ['http://', 'https://']) ? $featuredNews->image : asset('storage/' . $featuredNews->image);
                @endphp
                <div class="row g-4 align-items-stretch mb-4">
                    <div class="col-lg-7">
                        <a href="{{ route('berita.show', $featuredNews->id) }}" class="d-block h-100 text-decoration-none text-reset">
                            <div class="featured-card h-100">
                                <div class="row g-0 h-100">
                                    <div class="col-md-5">
                                        <img src="{{ $featuredImage }}" class="featured-image" alt="{{ $featuredNews->title }}">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="featured-content h-100 d-flex flex-column justify-content-center">
                                            <span class="section-kicker">
                                                <i class="bi bi-stars"></i> Berita Unggulan
                                            </span>
                                            <h2 class="featured-title">{{ $featuredNews->title }}</h2>
                                            <div class="news-date-info">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-calendar3 me-2"></i>
                                                    <small class="text-muted">{{ $featuredNews->date->format('d F Y') }}</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-clock me-2"></i>
                                                    <small class="text-muted">{{ $featuredNews->read_time ?? '5 menit' }}</small>
                                                </div>
                                            </div>
                                            <p class="featured-excerpt">{{ $featuredNews->excerpt }}</p>
                                            <div class="mini-info-grid">
                                                <div class="mini-info-box">
                                                    <span class="mini-info-label">Kategori</span>
                                                    <span class="mini-info-value">{{ $featuredNews->category }}</span>
                                                </div>
                                                <div class="mini-info-box">
                                                    <span class="mini-info-label">Penulis</span>
                                                    <span class="mini-info-value">{{ $featuredNews->author ?? 'Admin' }}</span>
                                                </div>
                                                <div class="mini-info-box">
                                                    <span class="mini-info-label">Dilihat</span>
                                                    <span class="mini-info-value">{{ $featuredNews->views ?? 0 }} views</span>
                                                </div>
                                            </div>
                                            <span class="read-more-btn mt-auto">
                                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-5">
                        <div class="news-summary-card h-100">
                            <div class="head">
                                <i class="bi bi-lightning-charge"></i>
                                <h2>Sorotan Cepat</h2>
                            </div>
                            <div class="news-summary-body">
                                <div class="highlight-list">
                                    @forelse($spotlightNews as $item)
                                        <a href="{{ route('berita.show', $item->id) }}" class="text-decoration-none text-reset">
                                            <article class="highlight-item">
                                                <h3>{{ $item->title }}</h3>
                                                <p>{{ $item->excerpt }}</p>
                                            </article>
                                        </a>
                                    @empty
                                        <div class="highlight-item">
                                            <h3>Belum ada berita lain</h3>
                                            <p>Tambahkan berita baru untuk mengisi sorotan berikutnya.</p>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="agenda-note mt-3" style="border-radius: 16px; border: 1px solid #dce9d2; background: linear-gradient(135deg, #f7fbf3, #eef5e8); padding: 1rem;">
                                    <h3 style="margin: 0 0 0.25rem; color: #22331d; font-size: 1rem; font-weight: 700;">Update rutin</h3>
                                    <p style="margin: 0 0 0.8rem; color: #4b5563; font-size: 0.9rem;">Berita desa diperbarui untuk kegiatan pemerintah, sosial, pembangunan, dan ekonomi warga.</p>
                                    <a href="#news-grid" class="btn btn-success rounded-pill px-4 fw-bold">
                                        <i class="bi bi-arrow-down-circle me-1"></i> Lihat Semua Berita
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <section class="py-4 bg-white rounded-4 shadow-sm filter-shell">
                <div class="container">
                    <div class="text-center">
                        <button class="filter-category-btn active" onclick="filterNewsByCategory('all', this)">
                            <i class="bi bi-grid-3x3-gap"></i> Semua Berita
                        </button>
                        @foreach($categories as $category)
                            <button class="filter-category-btn" onclick="filterNewsByCategory('{{ $category }}', this)">
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

            <section id="news-grid" class="py-5">
                <div class="row" id="newsContainer">
                    @forelse($allNews as $news)
                        @php
                            $newsImage = Str::startsWith($news->image, ['http://', 'https://']) ? $news->image : asset('storage/' . $news->image);
                        @endphp
                        <div class="col-md-6 col-lg-4 mb-4 news-item" data-category="{{ $news->category }}">
                            <div class="card news-card-enhanced h-100">
                                <div class="position-relative">
                                    <img src="{{ $newsImage }}" class="news-card-image" alt="{{ $news->title }}">
                                    <span class="news-category-badge">{{ $news->category }}</span>
                                    @if($news->trending)
                                        <span class="trending-badge">
                                            <i class="bi bi-fire"></i> Trending
                                        </span>
                                    @endif
                                </div>

                                <div class="card-body d-flex flex-column p-4">
                                    <div class="news-date-info">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            <small class="text-muted">{{ $news->date->format('d F Y') }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock me-2"></i>
                                            <small class="text-muted">{{ $news->read_time ?? '5 menit' }}</small>
                                        </div>
                                    </div>

                                    <h5 class="news-title-enhanced">{{ $news->title }}</h5>

                                    <p class="news-excerpt flex-grow-1">{{ $news->excerpt }}</p>

                                    <a href="{{ route('berita.show', $news->id) }}" class="read-more-btn">
                                        Baca Selengkapnya
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                    <div class="news-meta-info">
                                        <small class="text-muted">
                                            <i class="bi bi-eye me-1"></i>
                                            {{ $news->views ?? rand(100, 500) }} views
                                        </small>
                                        <small class="text-muted">
                                            <i class="bi bi-person me-1"></i>
                                            {{ $news->author ?? 'Admin' }}
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
            </section>

            <section class="news-footer-cta text-center">
                <i class="bi bi-envelope-paper" style="font-size: 3rem; margin-bottom: 16px; display: block;"></i>
                <h2 class="mb-3">Ikuti Update Desa</h2>
                <p>
                    Dapatkan berita terbaru dan informasi penting dari Desa Sawotratap dalam tampilan yang lebih mudah dibaca.
                </p>
                <a href="{{ route('home') }}" class="btn btn-light fw-bold rounded-pill px-4">
                    <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                </a>
            </section>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
function filterNewsByCategory(category, button) {
    const newsItems = document.querySelectorAll('.news-item');
    const buttons = document.querySelectorAll('.filter-category-btn');

    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    if (button) {
        button.classList.add('active');
    }

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

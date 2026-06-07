@extends('layouts.app')

@section('title', 'Galeri Desa - Desa Sawotratap')

@section('styles')
<style>
    .gallery-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
    }

    .gallery-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .gallery-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .gallery-header .container {
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

    .gallery-stats {
        margin-top: 28px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .gallery-stat-box {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #dde7d6;
        box-shadow: 0 6px 18px rgba(45, 80, 22, 0.06);
        text-align: center;
    }

    .gallery-stat-icon {
        font-size: 2rem;
        margin-bottom: 8px;
        display: block;
        color: var(--primary-green);
    }

    .gallery-stat-number {
        font-size: 1.9rem;
        font-weight: 800;
        display: block;
        color: #22331d;
        line-height: 1.1;
    }

    .gallery-stat-label {
        font-size: 0.88rem;
        margin-top: 5px;
        color: #5e6d64;
        font-weight: 500;
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

    .gallery-card {
        transition: all 0.3s ease;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
        height: 100%;
        background: white;
    }

    .gallery-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 14px 28px rgba(45, 80, 22, 0.14);
    }

    .gallery-media {
        position: relative;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: linear-gradient(135deg, #eef5e8, #f7fbf3);
    }

    .gallery-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        cursor: pointer;
        transition: transform 0.4s ease;
    }

    .gallery-card:hover .gallery-card-img {
        transform: scale(1.04);
    }

    .gallery-media::after {
        content: '';
        position: absolute;
        inset: auto 0 0 0;
        height: 38%;
        background: linear-gradient(to top, rgba(14, 37, 12, 0.45), transparent);
        pointer-events: none;
    }

    .gallery-category-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 8px 18px;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.24);
        z-index: 2;
    }

    .gallery-info {
        padding: 22px;
    }

    .gallery-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #22331d;
        margin-bottom: 10px;
        line-height: 1.45;
    }

    .gallery-description {
        color: #5c6a62;
        line-height: 1.7;
        margin-bottom: 16px;
        font-size: 0.95rem;
    }

    .gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding-top: 15px;
        border-top: 1px solid #edf2ea;
        font-size: 0.86rem;
        color: #6b7280;
        flex-wrap: wrap;
    }

    .gallery-date {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .gallery-date i {
        color: var(--primary-green);
    }

    .view-detail-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-green);
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    .view-detail-btn:hover {
        gap: 12px;
        color: var(--light-green);
    }

    .gallery-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    @media (max-width: 1199.98px) {
        .gallery-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .gallery-page {
            padding-bottom: 40px;
        }

        .gallery-header .container {
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

        .gallery-stats {
            grid-template-columns: 1fr;
        }

        .gallery-info {
            padding: 18px;
        }
    }
</style>
@endsection

@section('content')
@php
    $categories = $galleries->pluck('category')->unique()->values();
@endphp

<div class="gallery-page">
    <div class="gallery-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="gallery-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Galeri Desa</h1>
                <p class="hero-subtitle">
                    Dokumentasi kegiatan dan keindahan Desa Sawotratap dalam tampilan yang lebih rapi, nyaman, dan mudah dijelajahi.
                </p>
            </div>

            <div class="gallery-stats">
                <div class="gallery-stat-box">
                    <i class="bi bi-camera gallery-stat-icon"></i>
                    <span class="gallery-stat-number">{{ count($galleries) }}</span>
                    <span class="gallery-stat-label">Total Foto</span>
                </div>
                <div class="gallery-stat-box">
                    <i class="bi bi-grid gallery-stat-icon"></i>
                    <span class="gallery-stat-number">{{ $categories->count() }}</span>
                    <span class="gallery-stat-label">Kategori</span>
                </div>
                <div class="gallery-stat-box">
                    <i class="bi bi-calendar3 gallery-stat-icon"></i>
                    <span class="gallery-stat-number">{{ date('Y') }}</span>
                    <span class="gallery-stat-label">Tahun Aktif</span>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 bg-white filter-shell">
        <div class="container">
            <div class="text-center">
                <button class="filter-category-btn active" onclick="filterGallery('all', this)">
                    <i class="bi bi-grid-3x3-gap"></i> Semua Kategori
                </button>
                @foreach($categories as $category)
                    <button class="filter-category-btn" onclick="filterGallery('{{ $category }}', this)">
                        @if($category === 'Alam')
                            <i class="bi bi-tree"></i>
                        @elseif($category === 'Fasilitas')
                            <i class="bi bi-building"></i>
                        @elseif($category === 'Wisata')
                            <i class="bi bi-signpost"></i>
                        @elseif($category === 'UMKM')
                            <i class="bi bi-shop"></i>
                        @elseif($category === 'Kegiatan')
                            <i class="bi bi-people"></i>
                        @else
                            <i class="bi bi-bookmark"></i>
                        @endif
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row" id="galleryContainer">
                @forelse($galleries as $gallery)
                    @php
                        $galleryImage = $gallery['image'] ?? '';
                    @endphp
                    <div class="col-md-6 col-lg-4 mb-4 gallery-item" data-category="{{ $gallery['category'] }}">
                        <a href="{{ route('galeri.show', $gallery['id']) }}" class="gallery-card-link h-100">
                            <div class="card gallery-card h-100">
                                <div class="gallery-media">
                                    <img src="{{ $galleryImage }}"
                                         class="gallery-card-img"
                                         alt="{{ $gallery['title'] }}"
                                         loading="lazy"
                                         onerror="this.onerror=null;this.src='https://via.placeholder.com/800x600?text=Galeri+Desa';">
                                    <span class="gallery-category-badge">{{ $gallery['category'] }}</span>
                                </div>

                                <div class="gallery-info d-flex flex-column">
                                    <h5 class="gallery-title">
                                        {{ $gallery['title'] }}
                                    </h5>

                                    <p class="gallery-description">
                                        {{ $gallery['description'] }}
                                    </p>

                                    <span class="view-detail-btn mt-auto">
                                        Lihat Selengkapnya
                                        <i class="bi bi-arrow-right"></i>
                                    </span>

                                    <div class="gallery-meta">
                                        <div class="gallery-date">
                                            <i class="bi bi-calendar3"></i>
                                            <span>{{ date('d F Y', strtotime($gallery['date'])) }}</span>
                                        </div>
                                        <div>
                                            <i class="bi bi-camera me-1"></i>
                                            {{ $gallery['photographer'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-images" style="font-size: 4rem; color: #ccc;"></i>
                            <h4 class="mt-3 text-muted">Belum ada galeri</h4>
                            <p class="text-muted">Foto akan ditampilkan di sini</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
function filterGallery(category, buttonElement) {
    const galleries = document.querySelectorAll('.gallery-item');
    const buttons = document.querySelectorAll('.filter-category-btn');

    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    if (buttonElement) {
        buttonElement.classList.add('active');
    }

    // Filter galleries
    galleries.forEach(gallery => {
        if (category === 'all' || gallery.dataset.category === category) {
            gallery.style.display = 'block';
            setTimeout(() => {
                gallery.style.opacity = '1';
                gallery.style.transform = 'scale(1)';
            }, 10);
        } else {
            gallery.style.opacity = '0';
            gallery.style.transform = 'scale(0.9)';
            setTimeout(() => {
                gallery.style.display = 'none';
            }, 300);
        }
    });
}

// Smooth transition effect
document.querySelectorAll('.gallery-item').forEach(item => {
    item.style.transition = 'all 0.3s ease';
});
</script>
@endpush

@extends('layouts.app')

@section('title', 'Galeri Desa - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .gallery-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        height: 100%;
    }

    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .gallery-card-img {
        height: 280px;
        object-fit: cover;
        width: 100%;
        cursor: pointer;
    }

    .gallery-category-badge {
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

    .gallery-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .gallery-stat-box {
        text-align: center;
        padding: 25px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
    }

    .gallery-stat-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(45, 80, 22, 0.3);
    }

    .gallery-stat-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
        display: block;
    }

    .gallery-stat-number {
        font-size: 2rem;
        font-weight: bold;
        display: block;
    }

    .gallery-stat-label {
        font-size: 0.95rem;
        margin-top: 5px;
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

    .gallery-info {
        padding: 20px;
    }

    .gallery-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d5016;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .gallery-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #eee;
        font-size: 0.875rem;
        color: #999;
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
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .view-detail-btn:hover {
        gap: 12px;
        color: var(--light-green);
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
                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Hero Section for Gallery -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title-center" style="font-size: 2.5rem;">Galeri Desa</h1>
            <p class="text-muted mt-3" style="font-size: 1.1rem; font-weight: 400;">
                Dokumentasi kegiatan dan keindahan Desa Sawotratap
            </p>
        </div>

        <!-- Gallery Statistics -->
        <div class="gallery-stats">
            <div class="gallery-stat-box">
                <i class="bi bi-camera gallery-stat-icon"></i>
                <span class="gallery-stat-number">{{ count($galleries) }}</span>
                <span class="gallery-stat-label">Total Foto</span>
            </div>
            <div class="gallery-stat-box">
                <i class="bi bi-grid gallery-stat-icon"></i>
                <span class="gallery-stat-number">{{ $galleries->pluck('category')->unique()->count() }}</span>
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

<!-- Filter Section -->
<section class="py-4 bg-white">
    <div class="container">
        <div class="text-center">
            <button class="filter-category-btn active" onclick="filterGallery('all', this)">
                <i class="bi bi-grid-3x3-gap"></i> Semua Kategori
            </button>
            @php
                $categories = $galleries->pluck('category')->unique()->values();
            @endphp
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

<!-- Gallery Grid -->
<section class="py-5">
    <div class="container">
        <div class="row" id="galleryContainer">
            @forelse($galleries as $gallery)
            <div class="col-md-6 col-lg-4 mb-4 gallery-item" data-category="{{ $gallery['category'] }}">
                <div class="card gallery-card">
                    <div class="position-relative">
                        <a href="{{ route('galeri.show', $gallery['id']) }}">
                            <img src="{{ $gallery['image'] }}" 
                                 class="gallery-card-img" 
                                 alt="{{ $gallery['title'] }}"
                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/800x600?text=Galeri+Desa';">
                        </a>
                        <span class="gallery-category-badge">{{ $gallery['category'] }}</span>
                    </div>
                    
                    <div class="gallery-info">
                        <h5 class="gallery-title">
                            <a href="{{ route('galeri.show', $gallery['id']) }}" class="text-decoration-none text-dark">
                                {{ $gallery['title'] }}
                            </a>
                        </h5>
                        
                        <p class="gallery-description">
                            {{ $gallery['description'] }}
                        </p>

                        <a href="{{ route('galeri.show', $gallery['id']) }}" class="view-detail-btn">
                            Lihat Selengkapnya 
                            <i class="bi bi-arrow-right"></i>
                        </a>

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

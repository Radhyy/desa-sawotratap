@extends('layouts.app')

@section('title', 'UMKM Sawotratap - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .umkm-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(34, 60, 20, 0.08);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        background: #ffffff;
    }

    .umkm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(34, 60, 20, 0.14);
    }

    .umkm-card-img {
        height: 260px;
        object-fit: cover;
        width: 100%;
        display: block;
    }

    .umkm-price {
        font-size: 1.25rem;
        color: var(--primary-green);
        font-weight: 800;
    }

    .umkm-category {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 7px 16px;
        border-radius: 999px;
        font-size: 0.82rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }

    .filter-btn {
        padding: 8px 20px;
        border: 2px solid var(--primary-green);
        background: white;
        color: var(--primary-green);
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        margin: 5px;
    }

    .filter-btn.active {
        background: var(--primary-green);
        color: white;
    }

    .filter-btn:hover {
        background: var(--primary-green);
        color: white;
    }

    .umkm-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-box {
        text-align: center;
        padding: 24px 15px;
        background: #fff;
        color: #2d5016;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(0,0,0,0.03);
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(45, 80, 22, 0.1);
        border-color: rgba(45, 80, 22, 0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        display: block;
        color: #2d5016;
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 0.95rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .umkm-stats {
            gap: 10px;
        }
        .stat-box {
            padding: 15px 10px;
            border-radius: 12px;
        }
        .stat-number {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 0.65rem;
            letter-spacing: 0;
        }
    }

    .umkm-actions {
        margin-top: auto;
    }

    .umkm-detail-btn {
        border-radius: 8px;
        padding: 10px;
        font-weight: 600;
    }

    .umkm-cta-section {
        background: white;
        color: #1d3620;
        border-radius: 24px;
        box-shadow: 0 18px 40px rgba(25, 60, 20, 0.08);
        padding: 4rem 2rem;
    }

    .umkm-cta-section h2,
    .umkm-cta-section p {
        color: #1d3620;
    }

    .umkm-cta-section .btn-cta {
        background: var(--primary-green);
        color: white;
        padding: 12px 40px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        box-shadow: 0 10px 25px rgba(44, 105, 36, 0.16);
    }

    .umkm-cta-section .btn-cta:hover {
        background: #1b5c2b;
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
                <li class="breadcrumb-item active" aria-current="page">UMKM</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Hero Section for UMKM -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">UMKM Sawotratap</h2>
            <p class="text-muted mt-3 mb-4" style="font-size: 1.1rem; font-weight: 400;">
                Dukung produk lokal desa kami untuk kesejahteraan bersama masyarakat
            </p>
            
        </div>

        <!-- Statistics -->
        <div class="umkm-stats">
            <div class="stat-box">
                <span class="stat-number">{{ count($products) }}</span>
                <span class="stat-label">Produk Aktif</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $products->where('stock', '>', 0)->count() }}</span>
                <span class="stat-label">Tersedia Sekarang</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $products->pluck('kategori_umkm_id')->unique()->count() }}</span>
                <span class="stat-label">Kategori Produk</span>
            </div>
        </div>
    </div>
</section>

<!-- All UMKM Products Section -->
<section class="py-5">
    <div class="container">
        <!-- Filter Categories -->
        <div class="text-center mb-5">
            <button class="filter-btn active" onclick="filterProducts('all', this)">
                <i class="bi bi-funnel"></i> Semua Kategori
            </button>
            @php
                $categories = $products->pluck('kategori.name')->unique()->values();
            @endphp
            @foreach($categories as $category)
            <button class="filter-btn" onclick="filterProducts('{{ $category }}', this)">
                {{ $category }}
            </button>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="row g-4" id="productsContainer">
            @forelse($products as $product)
            <div class="col-md-6 col-lg-4 product-item" data-category="{{ $product->kategori->name ?? 'Tanpa Kategori' }}">
                <div class="card umkm-card h-100">
                    <div class="position-relative">
                        <a href="{{ route('umkm.show', $product->id) }}" class="d-block">
                        <img src="{{ Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}"
                             class="card-img-top umkm-card-img" 
                            alt="{{ $product->name }}"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/800x500?text=Produk+UMKM';">
                        </a>
                        @if($product->stock <= 0)
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="background: rgba(0,0,0,0.6);">
                            <span class="text-white fw-bold" style="font-size: 1.2rem;">Stok Habis</span>
                        </div>
                        @else
                        <span class="position-absolute top-0 end-0 badge bg-success m-3">
                            Stok: {{ $product->stock }}
                        </span>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <span class="umkm-category">{{ $product->kategori->name ?? 'Tanpa Kategori' }}</span>
                        
                        <h5 class="card-title fw-bold mb-2" style="min-height: 3.4rem; line-height: 1.2;">
                            <a href="{{ route('umkm.show', $product->id) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        
                        <p class="card-text text-muted small flex-grow-1" style="min-height: 4.6rem;">
                            {{ $product->description }}
                        </p>

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <i class="bi bi-shop text-success me-2"></i>
                            <small class="text-muted">{{ $product->seller }}</small>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-geo-alt text-success me-2"></i>
                            <small class="text-muted">{{ $product->location }}</small>
                        </div>

                        <hr class="my-3">

                        <div class="umkm-actions mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="umkm-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <a href="{{ route('umkm.show', $product->id) }}" class="btn btn-outline-success w-100 umkm-detail-btn mb-2">
                                <i class="bi bi-eye"></i> Lihat Selengkapnya
                            </a>

                            @if($product->stock > 0)
                            <button class="btn btn-success w-100 fw-semibold umkm-detail-btn">
                                <i class="bi bi-cart-plus"></i> Pesan Sekarang
                            </button>
                            @else
                            <button class="btn btn-secondary w-100 fw-semibold umkm-detail-btn" disabled>
                                <i class="bi bi-x-circle"></i> Tidak Tersedia
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-shop" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">Belum ada produk UMKM</h4>
                    <p class="text-muted">Produk akan ditampilkan di sini</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 umkm-cta-section">
    <div class="container text-center">
        <h2 class="mb-4">Ingin Menjual Produk Anda?</h2>
        <p class="mb-4" style="font-size: 1.1rem;">Bergabunglah dengan UMKM Sawotratap untuk menjual produk Anda dan dukung ekonomi desa.</p>
        <a href="{{ route('umkm.create') }}" class="btn btn-cta text-decoration-none d-inline-block">
            <i class="bi bi-shop-window"></i> Daftarkan UMKM
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
function filterProducts(category, buttonElement) {
    const products = document.querySelectorAll('.product-item');
    const buttons = document.querySelectorAll('.filter-btn');

    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    if (buttonElement) {
        buttonElement.classList.add('active');
    }

    // Filter products
    products.forEach(product => {
        if (category === 'all' || product.dataset.category === category) {
            product.style.display = 'block';
            setTimeout(() => {
                product.style.opacity = '1';
            }, 10);
        } else {
            product.style.display = 'none';
        }
    });
}
</script>
@endpush

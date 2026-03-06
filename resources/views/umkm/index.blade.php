@extends('layouts.app')

@section('title', 'UMKM Sawotratap - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .umkm-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .umkm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .umkm-card-img {
        height: 250px;
        object-fit: cover;
    }

    .umkm-price {
        font-size: 1.3rem;
        color: var(--primary-green);
        font-weight: bold;
    }

    .umkm-category {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 1rem;
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
        padding: 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
    }

    .stat-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(45, 80, 22, 0.3);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        display: block;
        color: white;
    }

    .stat-label {
        font-size: 0.95rem;
        margin-top: 8px;
        color: white;
        font-weight: 500;
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
            <h1 class="section-title-center" style="font-size: 2.5rem;">UMKM Sawotratap</h1>
            <p class="text-muted mt-3" style="font-size: 1.1rem; font-weight: 400;">
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
                <span class="stat-number">{{ $products->pluck('category')->unique()->count() }}</span>
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
            <button class="filter-btn active" onclick="filterProducts('all')">
                <i class="bi bi-funnel"></i> Semua Kategori
            </button>
            @php
                $categories = $products->pluck('category')->unique()->values();
            @endphp
            @foreach($categories as $category)
            <button class="filter-btn" onclick="filterProducts('{{ $category }}')">
                {{ $category }}
            </button>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="row" id="productsContainer">
            @forelse($products as $product)
            <div class="col-md-6 col-lg-4 mb-4 product-item" data-category="{{ $product['category'] }}">
                <div class="card umkm-card h-100">
                    <div class="position-relative">
                        <img src="{{ $product['image'] }}" 
                             class="card-img-top umkm-card-img" 
                             alt="{{ $product['name'] }}">
                        @if($product['stock'] <= 0)
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="background: rgba(0,0,0,0.6);">
                            <span class="text-white fw-bold" style="font-size: 1.2rem;">Stok Habis</span>
                        </div>
                        @else
                        <span class="position-absolute top-0 end-0 badge bg-success m-3">
                            Stok: {{ $product['stock'] }}
                        </span>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <span class="umkm-category">{{ $product['category'] }}</span>
                        
                        <h5 class="card-title fw-bold mb-2">{{ $product['name'] }}</h5>
                        
                        <p class="card-text text-muted small flex-grow-1">
                            {{ $product['description'] }}
                        </p>

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <i class="bi bi-shop text-success me-2"></i>
                            <small class="text-muted">{{ $product['seller'] }}</small>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-geo-alt text-success me-2"></i>
                            <small class="text-muted">{{ $product['location'] }}</small>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="umkm-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                        </div>

                        @if($product['stock'] > 0)
                        <button class="btn btn-success w-100 fw-semibold" style="border-radius: 8px; padding: 10px;">
                            <i class="bi bi-cart-plus"></i> Pesan Sekarang
                        </button>
                        @else
                        <button class="btn btn-secondary w-100 fw-semibold" style="border-radius: 8px; padding: 10px;" disabled>
                            <i class="bi bi-x-circle"></i> Tidak Tersedia
                        </button>
                        @endif
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
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-green), var(--light-green)); color: white;">
    <div class="container text-center">
        <h2 class="mb-4">Ingin Menjual Produk Anda?</h2>
        <p class="mb-4" style="font-size: 1.1rem;">Bergabunglah dengan UMKM Sawotratap dan perluas jangkauan produk Anda</p>
        <button class="btn btn-light fw-bold" style="padding: 12px 40px; border-radius: 8px;">
            <i class="bi bi-person-plus"></i> Daftar Sebagai Penjual
        </button>
    </div>
</section>

@endsection

@push('scripts')
<script>
function filterProducts(category) {
    const products = document.querySelectorAll('.product-item');
    const buttons = document.querySelectorAll('.filter-btn');

    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

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

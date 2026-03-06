@extends('layouts.app')

@section('title', $product->name . ' - UMKM Sawotratap')

@section('styles')
<style>
    .product-detail-header {
        margin-top: 80px;
        background: white;
        padding: 1.5rem 0;
        border-bottom: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .product-detail-container {
        padding: 3rem 0;
    }

    .product-image-main {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    }

    .product-badge {
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .product-title {
        font-family: 'Sora', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .product-description {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 2rem;
    }

    .product-price {
        font-family: 'Sora', sans-serif;
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-green);
        margin-bottom: 2rem;
    }

    .product-info-box {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .product-info-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .product-info-item:last-child {
        border-bottom: none;
    }

    .product-info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .product-info-label {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
    }

    .product-info-value {
        font-size: 1.1rem;
        color: #2c3e50;
        font-weight: 600;
    }

    .stock-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .stock-available {
        background: #d4edda;
        color: #155724;
    }

    .stock-limited {
        background: #fff3cd;
        color: #856404;
    }

    .whatsapp-button {
        background: #25D366;
        color: white;
        padding: 1rem 3rem;
        border: none;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    }

    .whatsapp-button:hover {
        background: #128C7E;
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(37, 211, 102, 0.4);
        color: white;
    }

    .whatsapp-button i {
        font-size: 1.8rem;
    }

    .related-products {
        padding: 3rem 0;
        background: #f8f9fa;
    }

    .related-product-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        height: 100%;
        text-decoration: none;
        display: block;
    }

    .related-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .related-product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .related-product-body {
        padding: 1.5rem;
    }

    .related-product-title {
        font-family: 'Sora', sans-serif;
        font-weight: 600;
        font-size: 1.1rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .related-product-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-green);
    }

    @media (max-width: 768px) {
        .product-title {
            font-size: 1.8rem;
        }

        .product-price {
            font-size: 2rem;
        }

        .product-image-main {
            height: 300px;
        }
    }
</style>
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="product-detail-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('umkm') }}" class="text-decoration-none" style="color: var(--primary-green);">
                        <i class="bi bi-shop"></i> UMKM
                    </a>
                </li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->name, 40) }}</li>
        </ol>
    </nav>
</div>
</div>

<!-- Product Detail -->
<section class="product-detail-container">
<div class="container">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            @if($product->image)
                @if(str_starts_with($product->image, 'http'))
                <img src="{{ $product->image }}" 
                     alt="{{ $product->name }}"
                     class="product-image-main">
                @else
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}"
                     class="product-image-main">
                @endif
            @else
                <img src="https://via.placeholder.com/800x600?text=No+Image" 
                     alt="{{ $product->name }}"
                     class="product-image-main">
            @endif
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <!-- Category Badge -->
            <span class="product-badge">
                <i class="bi bi-tag-fill me-2"></i>{{ $product->category }}
            </span>

            <!-- Product Title -->
            <h1 class="product-title">{{ $product->name }}</h1>

            <!-- Stock Badge -->
            <div class="stock-badge {{ $product->stock > 10 ? 'stock-available' : 'stock-limited' }}">
                <i class="bi bi-box-seam me-2"></i>
                Stok: {{ $product->stock }} {{ $product->stock > 10 ? 'Unit Tersedia' : 'Terbatas!' }}
            </div>

            <!-- Description -->
            <p class="product-description">{{ $product->description }}</p>

            <!-- Price -->
            <div class="product-price">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <!-- Product Info Box -->
            <div class="product-info-box">
                <div class="product-info-item">
                    <div class="product-info-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div>
                        <div class="product-info-label">Penjual</div>
                        <div class="product-info-value">{{ $product->seller }}</div>
                    </div>
                </div>
                <div class="product-info-item">
                    <div class="product-info-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <div class="product-info-label">Lokasi</div>
                        <div class="product-info-value">{{ $product->location }}</div>

                <!-- WhatsApp Button -->
                <div class="text-center mt-4">
                    <a href="{{ $whatsappUrl }}" 
                       target="_blank"
                       class="whatsapp-button">
                        <i class="bi bi-whatsapp"></i>
                        <span>Pesan Sekarang</span>
                    </a>
                </div>

                <p class="text-center text-muted mt-3">
                    <i class="bi bi-info-circle me-2"></i>
                    Klik tombol di atas untuk memesan via WhatsApp
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="related-products">
    <div class="container">
        <h3 class="text-center mb-5" style="font-family: 'Sora', sans-serif; font-weight: 700; color: var(--primary-green);">
            <i class="bi bi-box-seam me-2"></i>Produk UMKM Lainnya
        </h3>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-md-3 mb-4">
                <a href="{{ route('umkm.show', $related->id) }}" class="related-product-card">
                    @if($related->image)
                        @if(str_starts_with($related->image, 'http'))
                        <img src="{{ $related->image }}" alt="{{ $related->name }}" class="related-product-img">
                        @else
                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="related-product-img">
                        @endif
                    @else
                        <img src="https://via.placeholder.com/400x300?text=No+Image" alt="{{ $related->name }}" class="related-product-img">
                    @endif
                    <div class="related-product-body">
                        <span class="badge" style="background: var(--primary-green); margin-bottom: 0.5rem;">
                            {{ $related->category }}
                        </span>
                        <h5 class="related-product-title">{{ $related->name }}</h5>
                        <p class="related-product-price">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

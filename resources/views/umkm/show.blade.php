@extends('layouts.app')

@section('title', $product['name'] . ' - UMKM Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .umkm-detail-header {
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        padding: 24px 0;
        margin-top: 76px;
    }

    .umkm-detail-header .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }

    .umkm-detail-header .breadcrumb-item a {
        color: #fff;
        text-decoration: none;
    }

    .umkm-detail-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.85);
    }

    .umkm-detail-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.65);
    }

    .umkm-detail-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .umkm-detail-image {
        width: 100%;
        height: 100%;
        max-height: 480px;
        object-fit: cover;
    }

    .umkm-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: #fff;
        padding: 8px 18px;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .umkm-price {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-green);
        margin-bottom: 12px;
    }

    .stock-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #e8f5e9;
        color: #2e7d32;
        border-radius: 999px;
        padding: 8px 14px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .umkm-meta {
        border-top: 1px solid #ececec;
        border-bottom: 1px solid #ececec;
        padding: 16px 0;
        margin: 18px 0;
    }

    .umkm-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #5f6368;
        margin-bottom: 8px;
    }

    .umkm-meta-item i {
        color: var(--primary-green);
    }

    .related-product-card {
        border: 1px solid #ececec;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s ease;
        height: 100%;
    }

    .related-product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
    }

    .related-product-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .umkm-price {
            font-size: 1.6rem;
        }
    }
</style>
@endsection

@section('content')
<div class="umkm-detail-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('umkm') }}"><i class="bi bi-shop"></i> UMKM</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product['name'], 32) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('umkm') }}" class="btn btn-outline-success rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali ke UMKM
            </a>
        </div>

        <div class="umkm-detail-card p-3 p-lg-4 mb-5">
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <img src="{{ $product['image'] }}"
                         alt="{{ $product['name'] }}"
                         class="umkm-detail-image rounded-3"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/900x600?text=Produk+UMKM';">
                </div>
                <div class="col-lg-6">
                    <span class="umkm-badge">{{ $product['category'] }}</span>
                    <h1 class="mb-3" style="color: #264d1f; font-weight: 800;">{{ $product['name'] }}</h1>
                    <div class="umkm-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>

                    @if($product['stock'] > 0)
                    <div class="stock-pill">
                        <i class="bi bi-check-circle"></i> Stok tersedia: {{ $product['stock'] }}
                    </div>
                    @else
                    <div class="stock-pill" style="background: #ffebee; color: #c62828;">
                        <i class="bi bi-x-circle"></i> Stok habis
                    </div>
                    @endif

                    <p class="text-muted" style="line-height: 1.8;">
                        {{ $product['full_description'] ?? $product['description'] }}
                    </p>

                    <div class="umkm-meta">
                        <div class="umkm-meta-item">
                            <i class="bi bi-shop"></i>
                            <span>Penjual: {{ $product['seller'] }}</span>
                        </div>
                        <div class="umkm-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Lokasi: {{ $product['location'] }}</span>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-success px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-cart-plus"></i> Pesan Sekarang
                        </a>
                        <a href="{{ route('umkm') }}" class="btn btn-outline-success px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-grid"></i> Lihat Produk Lain
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
        <div>
            <h3 class="mb-4" style="color: #264d1f; font-weight: 700;">Produk Terkait</h3>
            <div class="row">
                @foreach($relatedProducts as $related)
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="{{ route('umkm.show', $related['id']) }}" class="text-decoration-none text-dark">
                        <div class="related-product-card">
                            <img src="{{ $related['image'] }}"
                                 class="related-product-image"
                                 alt="{{ $related['name'] }}"
                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/700x450?text=Produk+UMKM';">
                            <div class="p-3">
                                <span class="badge bg-success mb-2">{{ $related['category'] }}</span>
                                <h5 class="fw-bold mb-2">{{ $related['name'] }}</h5>
                                <p class="text-muted small mb-2">{{ Str::limit($related['description'], 70) }}</p>
                                <div class="fw-bold" style="color: var(--primary-green);">
                                    Rp {{ number_format($related['price'], 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

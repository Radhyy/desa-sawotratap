@extends('layouts.app')

@section('title', $announcement->title . ' - Desa Sawotratap')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .announcement-detail-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        font-family: 'Inter', sans-serif;
    }

    .announcement-detail-shell {
        position: relative;
        z-index: 1;
    }

    .announcement-detail-hero {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .announcement-detail-hero .container {
        padding-top: 32px;
        padding-bottom: 32px;
    }

    .announcement-detail-headline {
        max-width: 940px;
        margin: 0 auto;
        text-align: center;
    }

    .announcement-detail-kicker {
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

    .announcement-detail-title {
        font-size: 2.45rem;
        line-height: 1.22;
        color: #22331d;
        margin-bottom: 12px;
    }

    .announcement-detail-subtitle {
        color: #6c757d;
        font-size: 1.05rem;
        line-height: 1.7;
        max-width: 760px;
        margin: 0 auto;
    }

    .announcement-detail-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 10px 26px rgba(45, 80, 22, 0.08);
        border: 1px solid #e4ecdf;
        padding: 2rem;
        position: relative;
        z-index: 10;
    }

    .announcement-detail-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .announcement-detail-meta-item {
        border: 1px solid #dce9d2;
        background: #f7fbf3;
        border-radius: 14px;
        padding: 14px;
    }

    .announcement-detail-meta-item .label {
        display: block;
        font-size: 0.74rem;
        color: #355027;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.3rem;
    }

    .announcement-detail-meta-item .value {
        display: block;
        color: #22331d;
        font-weight: 700;
        line-height: 1.45;
    }

    .announcement-detail-image {
        width: 100%;
        height: 460px;
        object-fit: cover;
        border-radius: 16px;
        margin-bottom: 28px;
        box-shadow: 0 10px 28px rgba(45, 80, 22, 0.12);
    }

    .announcement-detail-text {
        font-size: 1.05rem;
        line-height: 1.95;
        color: #444;
        margin-bottom: 1.5rem;
    }

    .announcement-detail-lead {
        border-left: 3px solid var(--primary-green);
        padding: 16px 16px 16px 18px;
        background: #f7fbf3;
        border-radius: 12px;
        font-size: 1.08rem;
        color: #3f4b42;
    }

    .announcement-detail-side {
        margin-top: 1.5rem;
        border-radius: 16px;
        border: 1px solid #dce9d2;
        background: linear-gradient(135deg, #f7fbf3, #eef5e8);
        padding: 1rem;
    }

    .announcement-detail-side h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #22331d;
        margin-bottom: 0.4rem;
    }

    .announcement-detail-side p {
        margin: 0;
        color: #4b5563;
        line-height: 1.6;
        font-size: 0.92rem;
    }

    @media (max-width: 991.98px) {
        .announcement-detail-meta-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .announcement-detail-title {
            font-size: 1.8rem;
        }

        .announcement-detail-image {
            height: 260px;
        }

        .announcement-detail-card {
            padding: 1.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="announcement-detail-page">
    <div class="announcement-detail-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('announcements') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-megaphone"></i> Pengumuman
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($announcement->title, 50) }}</li>
                </ol>
            </nav>

            <div class="announcement-detail-headline">
                <span class="announcement-detail-kicker">
                    <i class="bi bi-megaphone-fill"></i> Pengumuman Resmi
                </span>
                <h1 class="section-title-center announcement-detail-title">{{ $announcement->title }}</h1>
                <p class="announcement-detail-subtitle">
                    Informasi resmi dari Desa Sawotratap yang disusun dalam tampilan lebih bersih, elegan, dan nyaman dibaca.
                </p>
            </div>
        </div>
    </div>

    <section class="py-5">
        <div class="container announcement-detail-shell">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="announcement-detail-card">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                <i class="bi bi-megaphone-fill me-2"></i>{{ ucfirst($announcement->status) }}
                            </span>
                            <span class="text-muted small">
                                <i class="bi bi-eye me-1"></i>Dibaca {{ rand(50, 500) }} kali
                            </span>
                        </div>

                        <div class="announcement-detail-meta-grid">
                            <div class="announcement-detail-meta-item">
                                <span class="label">Tanggal</span>
                                <span class="value">{{ $announcement->date->format('d F Y') }}</span>
                            </div>
                            <div class="announcement-detail-meta-item">
                                <span class="label">Diterbitkan</span>
                                <span class="value">{{ $announcement->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="announcement-detail-meta-item">
                                <span class="label">Kategori</span>
                                <span class="value">Pengumuman Desa</span>
                            </div>
                        </div>

                        @if($announcement->image)
                            <img src="{{ asset('storage/' . $announcement->image) }}"
                                 alt="{{ $announcement->title }}"
                                 class="announcement-detail-image"
                                 loading="lazy">
                        @endif

                        <div class="announcement-detail-text">
                            <p class="announcement-detail-lead mb-0">
                                {{ $announcement->description }}
                            </p>
                        </div>

                        @if($announcement->content)
                            <div class="announcement-detail-text">
                                {!! nl2br(e($announcement->content)) !!}
                            </div>
                        @endif

                        <div class="share-buttons">
                            <span style="color: #6c757d; font-weight: 600; margin-right: 0.5rem;">Bagikan:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="share-btn share-btn-facebook">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($announcement->title) }}"
                               target="_blank"
                               class="share-btn share-btn-twitter">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($announcement->title . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="share-btn share-btn-whatsapp">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="copyLink()" class="share-btn share-btn-copy">
                                <i class="bi bi-link-45deg"></i> Salin Link
                            </button>
                        </div>

                        <div class="announcement-detail-side">
                            <h3>Informasi Singkat</h3>
                            <p>Bagikan pengumuman ini ke warga lain agar informasi desa tersebar lebih cepat dan rapi.</p>
                        </div>

                        @if($relatedAnnouncements->count() > 0)
                            <div class="related-announcements">
                                <h3><i class="bi bi-bookmark-star me-2"></i>Pengumuman Terkait</h3>
                                <div class="row g-3">
                                    @foreach($relatedAnnouncements as $related)
                                        <div class="col-md-4">
                                            <a href="{{ route('announcements.show', $related->id) }}" class="related-card">
                                                <div class="related-card-body">
                                                    <div class="related-card-icon mb-3">
                                                        <i class="bi bi-megaphone-fill"></i>
                                                    </div>
                                                    <h5 class="related-card-title">{{ $related->title }}</h5>
                                                    <p class="related-card-description text-muted mb-2">
                                                        {{ Str::limit($related->description, 80) }}
                                                    </p>
                                                    <div class="related-card-date">
                                                        <i class="bi bi-calendar3"></i>
                                                        {{ $related->date->format('d M Y') }}
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
</div>

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

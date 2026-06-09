@extends('layouts.app')

@section('title', $village_name . ' - Menuju Digitalisasi')

@push('styles')
<style>
    /* ===== HERO SLIDER ===== */
    .hero-slider {
        position: relative;
        height: 100vh;
        min-height: 620px;
        overflow: hidden;
        margin-top: 0;
        padding: 0;
    }

    /* Slides */
    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
        z-index: 0;
    }
    .hero-slide.active {
        opacity: 1;
        z-index: 1;
    }

    /* Background images — no zoom */
    .hero-slide-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .slide-bg-1 { background-image: url('/hero/desa.jpg'); }
    .slide-bg-2 { background-image: url('/hero/desa2.JPG'); }
    .slide-bg-3 { background-image: url('/hero/desa3.jpg'); }

    /* Dark overlay per slide */
    .hero-slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,0.25) 0%,
            rgba(0,0,0,0.60) 60%,
            rgba(0,0,0,0.72) 100%
        );
    }

    /* Content area */
    .hero-slide-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 80px;
    }
    .hero-text-wrap {
        text-align: center;
        max-width: 860px;
        padding: 0 20px;
    }

    /* Badge pill */
    .hero-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.14);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.25);
        padding: 7px 22px;
        border-radius: 50px;
        color: #fff;
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        font-weight: 500;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        margin-bottom: 22px;
    }
    .hero-badge-pill .badge-dot {
        width: 7px; height: 7px;
        background: #7fda4f;
        border-radius: 50%;
        animation: dotPulse 2s ease-in-out infinite;
    }
    @keyframes dotPulse {
        0%,100% { opacity: 1; transform: scale(1); }
        50%      { opacity: 0.5; transform: scale(1.4); }
    }

    /* Headings */
    .hero-kicker {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2rem, 4.5vw, 3.8rem);
        font-weight: 700;
        color: #ffffff;
        line-height: 1.1;
        margin: 0 0 6px 0;
        text-shadow: 0 2px 18px rgba(0,0,0,0.45);
        letter-spacing: -0.5px;
    }
    .hero-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2.4rem, 5.5vw, 4.8rem);
        font-weight: 800;
        color: #ffffff;
        line-height: 1.05;
        margin: 0 0 22px 0;
        text-shadow: 0 3px 22px rgba(0,0,0,0.5);
        letter-spacing: -1px;
    }

    /* Paragraph */
    .hero-desc {
        font-family: 'Inter', sans-serif;
        font-size: clamp(0.95rem, 1.6vw, 1.15rem);
        font-weight: 400;
        color: rgba(255,255,255,0.88);
        line-height: 1.75;
        max-width: 680px;
        margin: 0 auto 36px auto;
        text-shadow: 0 1px 6px rgba(0,0,0,0.4);
    }

    /* Buttons */
    .hero-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
    .hero-btn-primary {
        display: inline-flex; align-items: center; gap: 8px;
        background: #2d5016;
        color: #fff;
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 50px;
        text-decoration: none;
        border: 2px solid #2d5016;
        transition: all 0.3s ease;
        letter-spacing: 0.2px;
    }
    .hero-btn-primary:hover {
        background: #3d6b1f;
        border-color: #3d6b1f;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(45,80,22,0.45);
    }
    .hero-btn-outline {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,0.12);
        color: #fff;
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 50px;
        text-decoration: none;
        border: 2px solid rgba(255,255,255,0.55);
        backdrop-filter: blur(6px);
        transition: all 0.3s ease;
        letter-spacing: 0.2px;
    }
    .hero-btn-outline:hover {
        background: rgba(255,255,255,0.22);
        color: #fff;
        border-color: rgba(255,255,255,0.85);
        transform: translateY(-2px);
    }

    /* Slide indicators */
    .hero-indicators {
        position: absolute;
        bottom: 32px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }
    .hero-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        border: 2px solid rgba(255,255,255,0.6);
        cursor: pointer;
        transition: all 0.35s ease;
    }
    .hero-dot.active {
        background: #fff;
        transform: scale(1.3);
        border-color: #fff;
    }

    /* Progress bar at bottom of slide */
    .hero-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, #4a7c24, #7fda4f);
        z-index: 10;
        width: 0%;
        animation: progressBar 5s linear infinite;
    }
    @keyframes progressBar {
        0%   { width: 0%; }
        100% { width: 100%; }
    }

    /* Navbar stays white */
    .navbar {
        background-color: rgba(255,255,255,0.97) !important;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    /* ===== LAYANAN DESA ===== */
    #layanan {
        background: linear-gradient(180deg, #fefefe 0%, #f4f9f4 100%);
        position: relative;
    }
    .modern-service-card {
        border-radius: 18px;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        padding: 35px 25px;
        position: relative;
        overflow: hidden;
        text-align: center;
        z-index: 1;
        display: block;
        text-decoration: none;
        color: inherit;
    }
    .modern-service-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(45,80,22,0.02) 0%, rgba(127,218,79,0.02) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }
    .modern-service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(45,80,22,0.08);
        border-color: rgba(45,80,22,0.15);
    }
    .modern-service-card:hover::before {
        opacity: 1;
    }
    .modern-service-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: 0 auto 24px;
        transition: all 0.4s ease;
    }
    .icon-green { background: rgba(45,80,22,0.1); color: #2d5016; }
    .icon-blue { background: rgba(13,110,253,0.1); color: #0d6efd; }
    .icon-orange { background: rgba(253,126,20,0.1); color: #fd7e14; }
    .icon-purple { background: rgba(111,66,193,0.1); color: #6f42c1; }
    
    .modern-service-card:hover .modern-service-icon {
        transform: scale(1.1) rotate(5deg);
    }
    .modern-service-card h5 {
        font-weight: 700;
        font-size: 1.15rem;
        margin-bottom: 12px;
        color: #212529;
    }
    .modern-service-card p {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Responsive tweaks for Layanan cards (2 per row on mobile) */
    @media (max-width: 576px) {
        .modern-service-card {
            padding: 24px 15px;
        }
        .modern-service-icon {
            width: 55px;
            height: 55px;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .modern-service-card h5 {
            font-size: 1.05rem;
            margin-bottom: 10px;
        }
        .modern-service-card p {
            font-size: 0.85rem;
            line-height: 1.5;
            -webkit-line-clamp: 4;
        }
    }

    /* Container for forms and recent complaints */
    .layanan-panel {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .layanan-panel-header {
        background: #2d5016;
        color: #fff;
        padding: 20px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }
    .layanan-form-control {
        border-radius: 10px;
        padding: 12px 16px;
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
        transition: all 0.2s;
    }
    .layanan-form-control:focus {
        background-color: #fff;
        border-color: #7fda4f;
        box-shadow: 0 0 0 0.25rem rgba(127, 218, 79, 0.15);
    }
    .btn-layanan {
        background: #2d5016;
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .btn-layanan:hover {
        background: #1e360f;
        transform: translateY(-2px);
    }
    .complaint-item {
        padding: 16px 20px;
        border-radius: 12px;
        transition: background-color 0.2s;
    }
    .complaint-item:hover {
        background-color: #f8f9fa;
    }

    /* ===== PENGUMUMAN DESA ===== */
    #pengumuman {
        background-color: #ffffff;
        position: relative;
    }
    .modern-announcement-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .modern-announcement-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 4px; height: 100%;
        background: linear-gradient(180deg, #4a7c24, #7fda4f);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .modern-announcement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(45,80,22,0.08);
        border-color: rgba(45,80,22,0.1);
    }
    .modern-announcement-card:hover::before {
        opacity: 1;
    }
    .modern-announcement-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(45,80,22,0.06);
        color: #2d5016;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 18px;
    }
    .modern-announcement-title {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 12px;
        color: #212529;
    }
    .modern-announcement-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }
    .modern-announcement-title a:hover {
        color: #2d5016;
    }
    .modern-announcement-desc {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 24px;
        flex-grow: 1;
    }
    .modern-announcement-link {
        font-weight: 600;
        color: #2d5016;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        transition: gap 0.2s, color 0.2s;
    }
    .modern-announcement-link:hover {
        color: #1e360f;
        gap: 12px;
    }
    
    .modern-btn-all {
        background: transparent;
        color: #2d5016;
        border: 2px solid #2d5016;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
    }
    .modern-btn-all:hover {
        background: #2d5016;
        color: #fff;
    }

    /* ===== UMKM DESA ===== */
    .modern-product-card {
        border-radius: 18px;
        border: none;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .modern-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(45,80,22,0.1);
    }
    .modern-product-img-wrapper {
        position: relative;
        padding-top: 65%; /* rasio aspek */
        overflow: hidden;
    }
    .modern-product-img {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .modern-product-card:hover .modern-product-img {
        transform: scale(1.08);
    }
    .modern-product-category {
        position: absolute;
        top: 15px; left: 15px;
        background: rgba(45,80,22,0.85);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
    }
    .modern-product-body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .modern-product-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .modern-product-title a {
        color: #212529;
        text-decoration: none;
        transition: color 0.2s;
    }
    .modern-product-title a:hover {
        color: #2d5016;
    }
    .modern-product-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #2d5016;
        margin-bottom: 20px;
    }
    .modern-btn-product {
        background: #2d5016;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 10px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: background 0.3s, transform 0.2s;
        width: 100%;
        display: block;
        margin-top: auto;
    }
    .modern-btn-product:hover {
        background: #1e360f;
        color: #fff;
        transform: translateY(-2px);
    }
    
    /* Responsive tweaks for UMKM cards (2 per row on mobile) */
    @media (max-width: 576px) {
        .modern-product-body {
            padding: 12px 10px;
        }
        .modern-product-title {
            font-size: 0.95rem;
            margin-bottom: 6px;
        }
        .modern-product-price {
            font-size: 1.05rem;
            margin-bottom: 12px;
        }
        .modern-product-category {
            font-size: 0.65rem;
            padding: 4px 10px;
            top: 10px;
            left: 10px;
        }
        .modern-btn-product {
            padding: 8px;
            font-size: 0.8rem;
        }
        .modern-product-card p.small {
            font-size: 0.8rem;
            margin-bottom: 8px !important;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }

    /* ===== STATS & APBDES ===== */
    .modern-stats-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .modern-stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 45px rgba(45,80,22,0.08);
    }
    .modern-stats-card h5 {
        font-weight: 700;
        color: #2d5016;
        margin-bottom: 24px;
        font-size: 1.25rem;
    }
    .modern-progress-wrap {
        background: #f1f5f1;
        border-radius: 50px;
        height: 16px;
        overflow: hidden;
        margin-top: 8px;
    }
    .modern-progress-bar {
        height: 100%;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 10px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #fff;
    }
    .text-target { color: #495057; font-weight: 600; font-size: 0.95rem; }
    .val-target { font-weight: 800; color: #212529; font-size: 1.05rem; }
</style>
@endpush

@section('content')
<!-- ===== HERO SLIDER ===== -->
<section class="hero-slider" id="home">

    <!-- Slide 1 -->
    <div class="hero-slide active" id="slide-1">
        <div class="hero-slide-bg slide-bg-1"></div>
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content">
            <div class="hero-text-wrap">
                <div class="hero-badge-pill mb-3"><span class="badge-dot"></span> Website Resmi Desa Sawotratap</div>
                <p class="hero-kicker">Selamat Datang di</p>
                <h1 class="hero-title">Desa Sawotratap</h1>
                <p class="hero-desc">Desa yang indah dengan hamparan sawah hijau dan alam yang asri, menuju masa depan yang berkelanjutan bersama warganya.</p>
                <div class="hero-btns">
                    <a href="#profil" class="hero-btn-primary"><i class="bi bi-info-circle"></i> Tentang Desa</a>
                    <a href="#footer" class="hero-btn-outline"><i class="bi bi-telephone"></i> Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide 2 -->
    <div class="hero-slide" id="slide-2">
        <div class="hero-slide-bg slide-bg-2"></div>
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content">
            <div class="hero-text-wrap">
                <div class="hero-badge-pill mb-3"><span class="badge-dot"></span> Ekonomi & UMKM Lokal</div>
                <p class="hero-kicker">Dukung Produk Lokal</p>
                <h1 class="hero-title">UMKM Sawotratap</h1>
                <p class="hero-desc">Ribuan warga aktif berdaya melalui usaha mikro kecil dan menengah. Bersama kita wujudkan desa yang mandiri dan sejahtera.</p>
                <div class="hero-btns">
                    <a href="#umkm" class="hero-btn-primary"><i class="bi bi-shop"></i> Lihat UMKM</a>
                    <a href="{{ route('perizinan.index') }}" class="hero-btn-outline"><i class="bi bi-file-earmark-text"></i> Perizinan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide 3 -->
    <div class="hero-slide" id="slide-3">
        <div class="hero-slide-bg slide-bg-3"></div>
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content">
            <div class="hero-text-wrap">
                <div class="hero-badge-pill mb-3"><span class="badge-dot"></span> Gotong Royong & Tradisi</div>
                <p class="hero-kicker">Bersatu Membangun</p>
                <h1 class="hero-title">Semangat Komunitas</h1>
                <p class="hero-desc">Dengan semangat gotong royong yang kuat, masyarakat Sawotratap terus bergerak bersama menjaga tradisi dan membangun desa digital.</p>
                <div class="hero-btns">
                    <a href="#layanan" class="hero-btn-primary"><i class="bi bi-lightning-charge"></i> Layanan Warga</a>
                    <a href="{{ route('pengaduan.index') }}" class="hero-btn-outline"><i class="bi bi-megaphone"></i> Pengaduan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicators -->
    <div class="hero-indicators">
        <div class="hero-dot active" onclick="goToSlide(0)"></div>
        <div class="hero-dot" onclick="goToSlide(1)"></div>
        <div class="hero-dot" onclick="goToSlide(2)"></div>
    </div>

    <!-- Progress bar -->
    <div class="hero-progress" id="heroProgress"></div>
</section>

@push('scripts')
<script>
(function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    const bar    = document.getElementById('heroProgress');
    let current  = 0;
    let timer;

    function goToSlide(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
        // reset progress bar
        bar.style.animation = 'none';
        void bar.offsetWidth; // reflow
        bar.style.animation = 'progressBar 5s linear';
    }
    window.goToSlide = goToSlide;

    function startAuto() {
        timer = setInterval(() => goToSlide(current + 1), 5000);
    }
    startAuto();
})();
</script>
@endpush


<!-- Pengumuman Desa -->
<section class="py-5" id="pengumuman">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Pengumuman Desa</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px; font-size: 1.05rem; line-height: 1.6;">
                Dapatkan informasi resmi terbaru dan pemberitahuan penting langsung dari pemerintah desa.
            </p>
        </div>
        <div class="row g-4">
            @foreach($announcements->take(4) ?? $announcements as $announcement)
            <div class="col-md-6 mb-2">
                <div class="modern-announcement-card">
                    <div class="d-flex align-items-start flex-column">
                        <div class="modern-announcement-date">
                            <i class="bi bi-calendar3"></i>
                            {{ $announcement->date->format('d F Y') }}
                        </div>
                        <h5 class="modern-announcement-title">
                            <a href="{{ route('announcements.show', $announcement->id) }}">
                                {{ $announcement->title }}
                            </a>
                        </h5>
                        <p class="modern-announcement-desc">{{ Str::limit($announcement->description, 120) }}</p>
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="modern-announcement-link mt-auto">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5 pt-2">
            <a href="{{ route('announcements') }}" class="modern-btn-all">
                Lihat Semua Pengumuman <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- UMKM Sawotratap -->
<section class="py-5 bg-light" id="umkm">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">UMKM Produk Desa</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px; font-size: 1.05rem; line-height: 1.6;">
                Dukung produk lokal buatan warga desa kami untuk meningkatkan perekonomian dan kesejahteraan bersama.
            </p>
        </div>
        <div class="row g-3 g-md-4">
            @foreach($umkm as $product)
            <div class="col-6 col-md-6 col-lg-3">
                <div class="modern-product-card">
                    <a href="{{ route('umkm.show', $product->id) }}" class="modern-product-img-wrapper">
                        @if($product->image)
                            @if(str_starts_with($product->image, 'http'))
                            <img src="{{ $product->image }}" class="modern-product-img" alt="{{ $product->name }}">
                            @else
                            <img src="{{ asset('storage/' . $product->image) }}" class="modern-product-img" alt="{{ $product->name }}">
                            @endif
                        @else
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&q=80" class="modern-product-img" alt="Placeholder">
                        @endif
                        <span class="modern-product-category">{{ $product->category ?? 'Produk Lokal' }}</span>
                    </a>
                    <div class="modern-product-body">
                        <h5 class="modern-product-title">
                            <a href="{{ route('umkm.show', $product->id) }}">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="text-muted small mb-3">{{ Str::limit($product->description, 60) }}</p>
                        <div class="modern-product-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                        <a href="{{ route('umkm.show', $product->id) }}" class="modern-btn-product">
                            <i class="bi bi-cart2 me-1"></i> Beli Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5 pt-2">
            <a href="{{ route('umkm') }}" class="modern-btn-all">
                Jelajahi Semua Produk <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Layanan Desa -->
<section class="py-5" id="layanan">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Layanan Masyarakat</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px; font-size: 1.05rem; line-height: 1.6;">
                Berbagai layanan digital terpadu untuk memudahkan warga desa mengakses administrasi dan menyampaikan aspirasi.
            </p>
        </div>
        
        <div class="row justify-content-center g-3 g-md-4 mb-5">
            <!-- 3 Layanan Utama (Pengajuan Surat, Pengaduan, Perizinan) -->
            <div class="col-12 col-md-4 col-lg-4 d-flex">
                <a href="{{ route('pengajuan-surat.index') ?? '#' }}" class="modern-service-card w-100 flex-fill">
                    <div class="modern-service-icon icon-green">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5>Pengajuan Surat</h5>
                    <p>Ajukan berbagai jenis surat keterangan secara online tanpa harus antre di balai desa.</p>
                </a>
            </div>
            
            <div class="col-12 col-md-4 col-lg-4 d-flex">
                <a href="{{ route('pengaduan.index') ?? '#' }}" class="modern-service-card w-100 flex-fill">
                    <div class="modern-service-icon icon-blue">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <h5>Aspirasi & Pengaduan</h5>
                    <p>Sampaikan saran, masukan, dan kritik membangun untuk perbaikan layanan desa.</p>
                </a>
            </div>

            <div class="col-12 col-md-4 col-lg-4 d-flex">
                <a href="{{ route('perizinan.index') ?? '#' }}" class="modern-service-card w-100 flex-fill">
                    <div class="modern-service-icon icon-orange">
                        <i class="bi bi-file-earmark-check"></i>
                    </div>
                    <h5>Layanan Perizinan</h5>
                    <p>Kumpulan form dan urus dokumen perizinan usaha dan hajatan secara mandiri.</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- APBDes 2026 -->
<section class="py-5 bg-light">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">APBDes {{ $apbdes['year'] }}</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px; font-size: 1.05rem; line-height: 1.6;">
                Transparansi laporan realisasi Anggaran Pendapatan dan Belanja Desa untuk masyarakat.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="modern-stats-card">
                    <h5><i class="bi bi-pie-chart-fill me-2" style="color: #7fda4f;"></i> Total Anggaran</h5>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-target">Target</span>
                            <span class="val-target">Rp {{ number_format($apbdesObj->target_amount, 0, ',', '.') }}</span>
                        </div>
                        @php 
                            $targetPercent = $apbdesObj->target_amount > 0 ? min(100, round(($apbdesObj->target_amount / max($apbdesObj->target_amount, $apbdesObj->realization_amount)) * 100)) : 0; 
                        @endphp
                        <div class="modern-progress-wrap">
                            <div class="modern-progress-bar bg-success" style="width: {{ $targetPercent }}%; background: linear-gradient(90deg, #2d5016, #4a7c24) !important;">{{ $targetPercent }}%</div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-target">Realisasi</span>
                            <span class="val-target">Rp {{ number_format($apbdesObj->realization_amount, 0, ',', '.') }}</span>
                        </div>
                        @php 
                            $realPercent = $apbdesObj->target_amount > 0 ? min(100, round(($apbdesObj->realization_amount / $apbdesObj->target_amount) * 100)) : 0; 
                        @endphp
                        <div class="modern-progress-wrap">
                            <div class="modern-progress-bar" style="width: {{ $realPercent }}%; background: linear-gradient(90deg, #7fda4f, #a3f47c) !important; color: #2d5016;">{{ $realPercent }}%</div>
                        </div>
                    </div>
                    
                    <div class="chart-container mt-4 pt-2 border-top" style="height: 240px; position: relative;">
                        <canvas id="budgetChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="modern-stats-card">
                    <h5><i class="bi bi-bar-chart-line-fill me-2" style="color: #7fda4f;"></i> Penyerapan & Sisa Anggaran</h5>
                    <div class="chart-container" style="height: 400px; position: relative; margin-top: 20px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini -->
<section class="py-5" id="berita" style="background: #fafafa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Berita Terkini</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Update Informasi dan Kegiatan Terbaru</p>
        </div>

        @if($news->count() > 0)
        <div class="row g-4 align-items-stretch">

            {{-- Featured / Card Pertama (Besar) --}}
            @php $featured = $news->first(); @endphp
            <div class="col-lg-6">
                <a href="{{ route('berita.show', $featured->id) }}" class="text-decoration-none d-block h-100" style="border-radius:20px; overflow:hidden; position:relative;">
                    <div style="position:relative; height:100%; min-height:380px; border-radius:20px; overflow:hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.12);">
                        @if($featured->image)
                            <img src="{{ Str::startsWith($featured->image, ['http://', 'https://']) ? $featured->image : asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}"
                                 style="width:100%; height:100%; object-fit:cover; position:absolute; inset:0; transition:transform 0.5s ease;">
                        @else
                            <div style="width:100%; height:100%; background: linear-gradient(135deg,#2d5016,#4a7c24); position:absolute; inset:0;"></div>
                        @endif
                        {{-- Dark gradient overlay --}}
                        <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.82) 0%, rgba(0,0,0,0.35) 55%, transparent 100%);"></div>

                        {{-- Content --}}
                        <div style="position:absolute; bottom:0; left:0; right:0; padding:2rem;">
                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                <span style="background:#2d5016; color:#fff; font-size:0.7rem; font-weight:700; padding:3px 12px; border-radius:99px; letter-spacing:0.5px; text-transform:uppercase;">{{ $featured->category }}</span>
                                @if($featured->trending)
                                <span style="background:#ea580c; color:#fff; font-size:0.7rem; font-weight:700; padding:3px 10px; border-radius:99px;">🔥 Trending</span>
                                @endif
                            </div>
                            <h3 style="color:#fff; font-family:'Sora',sans-serif; font-weight:700; font-size:1.35rem; line-height:1.3; margin-bottom:0.75rem;">
                                {{ $featured->title }}
                            </h3>
                            <p style="color:rgba(255,255,255,0.75); font-size:0.88rem; line-height:1.5; margin-bottom:1rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                {{ $featured->excerpt }}
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3" style="color:rgba(255,255,255,0.6); font-size:0.78rem;">
                                    <span><i class="bi bi-calendar3 me-1"></i>{{ $featured->date->format('d M Y') }}</span>
                                    @if($featured->author)
                                    <span><i class="bi bi-person me-1"></i>{{ $featured->author }}</span>
                                    @endif
                                    @if($featured->read_time)
                                    <span><i class="bi bi-clock me-1"></i>{{ $featured->read_time }}</span>
                                    @endif
                                </div>
                                <span style="color:#fff; font-size:0.82rem; font-weight:600;">Baca →</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 2 Card Kecil --}}
            <div class="col-lg-6">
                <div class="d-flex flex-column gap-4 h-100">
                    @foreach($news->skip(1) as $item)
                    <a href="{{ route('berita.show', $item->id) }}" class="text-decoration-none" style="flex:1;">
                        <div class="d-flex gap-0 h-100" style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.07); transition:all 0.25s; border:1px solid rgba(0,0,0,0.05);"
                             onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'"
                             onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.07)'">

                            {{-- Thumbnail --}}
                            <div style="width:160px; flex-shrink:0; position:relative; overflow:hidden;">
                                @if($item->image)
                                    <img src="{{ Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                         style="width:100%; height:100%; object-fit:cover;">
                                @else
                                    <div style="width:100%; height:100%; background:linear-gradient(135deg,#e9f5e1,#c8e6b2); display:flex; align-items:center; justify-content:center;">
                                        <i class="bi bi-newspaper" style="font-size:2rem; color:#2d5016; opacity:0.4;"></i>
                                    </div>
                                @endif
                                {{-- Category overlay --}}
                                <div style="position:absolute; top:10px; left:10px;">
                                    <span style="background:rgba(45,80,22,0.9); color:#fff; font-size:0.65rem; font-weight:700; padding:2px 8px; border-radius:99px; letter-spacing:0.4px; text-transform:uppercase;">{{ $item->category }}</span>
                                </div>
                                @if($item->trending)
                                <div style="position:absolute; bottom:10px; left:10px;">
                                    <span style="background:rgba(234,88,12,0.9); color:#fff; font-size:0.63rem; font-weight:700; padding:2px 8px; border-radius:99px;">🔥 Trending</span>
                                </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div style="padding:1.1rem 1.25rem; display:flex; flex-direction:column; justify-content:space-between; flex:1; min-width:0;">
                                <div>
                                    <h5 style="font-family:'Sora',sans-serif; font-weight:700; font-size:0.95rem; color:#111827; line-height:1.35; margin-bottom:0.5rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                        {{ $item->title }}
                                    </h5>
                                    <p style="font-size:0.82rem; color:#6b7280; line-height:1.5; margin-bottom:0; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                        {{ $item->excerpt }}
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-2">
                                    <div style="font-size:0.75rem; color:#9ca3af;">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $item->date->format('d M Y') }}
                                        @if($item->author)
                                        &nbsp;·&nbsp;<i class="bi bi-person me-1"></i>{{ $item->author }}
                                        @endif
                                    </div>
                                    <span style="color:#2d5016; font-size:0.78rem; font-weight:700;">Baca →</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <i class="bi bi-newspaper" style="font-size:3rem; color:#d1d5db;"></i>
            <p class="text-muted mt-3">Belum ada berita tersedia.</p>
        </div>
        @endif

        <div class="text-center mt-5 pt-2">
            <a href="{{ route('berita') }}" class="modern-btn-all">
                Lihat Semua Berita <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Galeri Desa -->
<section class="py-5 bg-light" id="galeri">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Galeri Desa</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px; font-size: 1.05rem; line-height: 1.6;">Dokumentasi Kegiatan dan Keindahan Desa</p>
        </div>
        <div class="row g-4">
            @if($gallery->count() > 0)
            <div class="col-md-6">
                <div class="gallery-item gallery-item-large" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <img src="{{ Str::startsWith($gallery[0]->image, ['http://', 'https://']) ? $gallery[0]->image : asset('storage/' . $gallery[0]->image) }}" 
                         alt="{{ $gallery[0]->title }}" style="transition: transform 0.5s ease;">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title" style="font-family: 'Playfair Display', serif;">{{ $gallery[0]->title }}</h5>
                            <p class="gallery-desc">{{ Str::limit($gallery[0]->description, 50) }}</p>
                            <a href="{{ route('galeri.show', $gallery[0]->id) }}" class="gallery-btn" style="text-decoration: none; display: inline-block;"><i class="bi bi-eye"></i> Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($gallery->count() > 1)
            <div class="col-md-3">
                @foreach($gallery->slice(1, 2) as $item)
                <div class="gallery-item gallery-item-medium {{ $loop->first ? 'mb-4' : '' }}" style="border-radius: 16px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.06);">
                    <img src="{{ Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}" style="transition: transform 0.5s ease;">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title" style="font-size: 1.1rem; font-family: 'Playfair Display', serif;">{{ $item->title }}</h5>
                            <p class="gallery-desc" style="font-size: 0.85rem;">{{ Str::limit($item->description, 30) }}</p>
                            <a href="{{ route('galeri.show', $item->id) }}" class="gallery-btn" style="text-decoration: none; display: inline-block; padding: 6px 16px; font-size: 0.85rem;"><i class="bi bi-eye"></i> Lihat</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($gallery->count() > 3)
            <div class="col-md-3">
                @foreach($gallery->slice(3, 1) as $item)
                <div class="gallery-item gallery-item-medium" style="border-radius: 16px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.06);">
                    <img src="{{ Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}" style="transition: transform 0.5s ease;">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title" style="font-size: 1.1rem; font-family: 'Playfair Display', serif;">{{ $item->title }}</h5>
                            <p class="gallery-desc" style="font-size: 0.85rem;">{{ Str::limit($item->description, 30) }}</p>
                            <a href="{{ route('galeri.show', $item->id) }}" class="gallery-btn" style="text-decoration: none; display: inline-block; padding: 6px 16px; font-size: 0.85rem;"><i class="bi bi-eye"></i> Lihat</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="text-center mt-5 pt-2">
            <a href="{{ route('galeri') }}" class="modern-btn-all">
                Lihat Semua Galeri <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Demografi Desa -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Demografi Desa</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px; font-size: 1.05rem; line-height: 1.6;">Data Kependudukan dan Peta Wilayah</p>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="demographic-card p-4" style="height: 800px;">
                    <h5 class="demographic-card-title mb-4">
                        <i class="bi bi-people-fill me-2" style="color: var(--primary-green);"></i>
                        Berdasarkan Jenis Kelamin
                    </h5>
                    <div class="demographic-item">
                        <div class="demographic-label">
                            <i class="bi bi-gender-male text-primary fs-4"></i>
                            <span class="ms-2">Laki-laki</span>
                        </div>
                        <span class="demographic-value">{{ number_format($demographics['male']) }}</span>
                    </div>
                    <div class="demographic-item">
                        <div class="demographic-label">
                            <i class="bi bi-gender-female text-danger fs-4"></i>
                            <span class="ms-2">Perempuan</span>
                        </div>
                        <span class="demographic-value">{{ number_format($demographics['female']) }}</span>
                    </div>
                    <div class="demographic-item demographic-item-total">
                        <div class="demographic-label">
                            <i class="bi bi-people-fill fs-4" style="color: white;"></i>
                            <span class="ms-2 fw-bold">Total</span>
                        </div>
                        <span class="demographic-value fw-bold">{{ number_format($demographics['total']) }}</span>
                    </div>

                    <hr class="my-4" style="border-color: #e0e0e0;">

                    <h5 class="demographic-card-title mb-4">
                        <i class="bi bi-bar-chart-fill me-2" style="color: var(--primary-green);"></i>
                        Rentang Usia
                    </h5>
                    <div style="max-height: 420px; overflow-y: auto; padding-right: 5px;">
                        @foreach($demographics['age_groups'] as $group)
                        <div class="demographic-item">
                            <span class="demographic-label">{{ $group['range'] }} Tahun</span>
                            <span class="demographic-value">{{ number_format($group['count']) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="demographic-card map-card p-4" style="height: 800px;">
                    <h5 class="demographic-card-title mb-4">
                        <i class="bi bi-geo-alt-fill me-2" style="color: var(--primary-green);"></i>
                        Peta Desa Sawotratap
                    </h5>
                    <div class="map-container" style="height: calc(100% - 60px);">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11616.9548051795!2d112.7299005261466!3d-7.3695107493137435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e495b3986b59%3A0x88b42aee982571fd!2sSawotratap%2C%20Kec.%20Gedangan%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1772784335202!5m2!1sid!2sid"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Budget Pie Chart
const budgetCtx = document.getElementById('budgetChart').getContext('2d');
new Chart(budgetCtx, {
    type: 'doughnut',
    data: {
        labels: ['Belanja', 'Pendapatan', 'Pembiayaan'],
        datasets: [{
            data: [{{ $apbdesObj->pie_belanja }}, {{ $apbdesObj->pie_pendapatan }}, {{ $apbdesObj->pie_pembiayaan }}],
            backgroundColor: ['#2d5016', '#4a7c24', '#6b9c3d'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Monthly Bar Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
new Chart(monthlyCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($apbdesObj->chart_months) !!},
        datasets: [
            {
                label: 'Pendapatan',
                data: {!! json_encode($apbdesObj->chart_pendapatan) !!},
                backgroundColor: '#2d5016'
            },
            {
                label: 'Belanja',
                data: {!! json_encode($apbdesObj->chart_belanja) !!},
                backgroundColor: '#4a7c24'
            },
            {
                label: 'Surplus',
                data: {!! json_encode($apbdesObj->chart_surplus) !!},
                backgroundColor: '#6b9c3d'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value + 'M';
                    }
                }
            }
        },
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>
@endpush

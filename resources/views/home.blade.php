@extends('layouts.app')

@section('title', $village_name . ' - Menuju Digitalisasi')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="home">
    <!-- Animated Background Elements -->
    <div class="hero-mesh-gradient"></div>
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>
    
    <div class="container position-relative">
        <div class="row align-items-center min-vh-90">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="hero-content">
                    <!-- Badge with Glow -->
                    <div class="mb-4 animate-fade-in">
                        <div class="hero-badge-premium">
                            <span class="badge-glow"></span>
                            <span class="badge-dot-animated"></span>
                            <span class="badge-text-premium">🏆 Portal Digital Resmi</span>
                            <span class="badge-shimmer"></span>
                        </div>
                    </div>
                    
                    <!-- Animated Title -->
                    <div class="hero-title-wrapper">
                        <h1 class="hero-title-premium animate-slide-up">
                            <span class="title-line">{{ $village_name }}</span>
                        </h1>
                        <h1 class="hero-subtitle-premium animate-slide-up-delay">
                            <span class="gradient-text-animated">Menuju Digitalisasi</span>
                        </h1>
                    </div>
                    
                    <!-- Description with Typing Effect Visual -->
                    <p class="hero-description-premium animate-fade-in-delay">
                        <span class="text-highlight">Transparansi, inovasi, dan pemberdayaan</span> masyarakat melalui teknologi digital. 
                        Bergabunglah dalam transformasi desa modern yang tetap berakar pada nilai budaya lokal.
                    </p>
                    
                    <!-- Premium Buttons Group -->
                    <div class="hero-buttons-group animate-fade-in-delay-2">
                        <button class="magic-button magic-button-primary" onclick="window.location.href='#layanan'">
                            <span class="magic-button-content">
                                <span class="magic-icon">⚡</span>
                                <span>Layanan Warga</span>
                                <i class="bi bi-arrow-right magic-arrow"></i>
                            </span>
                            <span class="magic-button-shine"></span>
                            <span class="magic-button-glow"></span>
                        </button>
                        
                        <button class="magic-button magic-button-secondary" onclick="window.location.href='#demografi'">
                            <span class="magic-button-content">
                                <i class="bi bi-map magic-icon-left"></i>
                                <span>Peta Desa</span>
                            </span>
                            <span class="magic-button-border"></span>
                        </button>
                    </div>
                    
                    <!-- Enhanced Stats Cards -->
                    <div class="hero-stats-grid animate-fade-in-delay-3">
                        <div class="stat-card-premium stat-card-1">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number-premium" data-target="{{ $statistics['population'] }}">0</div>
                                <div class="stat-label-premium">Penduduk</div>
                                <div class="stat-trend">+2.3% <i class="bi bi-arrow-up-short"></i></div>
                            </div>
                        </div>
                        
                        <div class="stat-card-premium stat-card-2">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="bi bi-shop"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number-premium" data-target="127">0</div>
                                <div class="stat-label-premium">UMKM Aktif</div>
                                <div class="stat-trend">+5.1% <i class="bi bi-arrow-up-short"></i></div>
                            </div>
                        </div>
                        
                        <div class="stat-card-premium stat-card-3">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon-bg"></div>
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number-premium">15+</div>
                                <div class="stat-label-premium">Layanan Digital</div>
                                <div class="stat-trend">Aktif <i class="bi bi-check-circle-fill"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="hero-visual-wrapper animate-fade-in-delay">
                    <!-- 3D Card Container -->
                    <div class="hero-image-3d-container">
                        <!-- Decorative Elements -->
                        <div class="orbit-ring orbit-ring-1"></div>
                        <div class="orbit-ring orbit-ring-2"></div>
                        <div class="glow-orb glow-orb-1"></div>
                        <div class="glow-orb glow-orb-2"></div>
                        <div class="glow-orb glow-orb-3"></div>
                        
                        <!-- Main Image Card -->
                        <div class="hero-image-card">
                            <div class="image-card-glow"></div>
                            <div class="image-border-animated"></div>
                            <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1200" 
                                 class="hero-image-premium" 
                                 alt="Sawah Desa Sawotratap">
                            <div class="image-overlay-gradient"></div>
                        </div>
                        
                        <!-- Floating Info Cards -->
                        <div class="floating-info-card floating-card-top">
                            <div class="info-card-inner">
                                <div class="info-icon info-icon-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Status Desa</div>
                                    <div class="info-value">Maju & Berkembang</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="floating-info-card floating-card-bottom">
                            <div class="info-card-inner">
                                <div class="info-icon info-icon-chart">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Indeks Desa</div>
                                    <div class="info-value">87.4 <span class="value-badge">+3.2%</span></div>
                                </div>
                                <div class="mini-chart">
                                    <div class="chart-bar" style="--height: 60%"></div>
                                    <div class="chart-bar" style="--height: 75%"></div>
                                    <div class="chart-bar" style="--height: 85%"></div>
                                    <div class="chart-bar" style="--height: 90%"></div>
                                    <div class="chart-bar" style="--height: 100%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="floating-info-card floating-card-left">
                            <div class="info-card-inner info-card-compact">
                                <div class="compact-icon">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div class="compact-text">Top 10 Desa Digital</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengumuman Desa -->
<section class="py-5" id="pengumuman">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">Pengumuman Desa</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Kumpulan Informasi Desa</p>
        </div>
        <div class="row">
            @foreach($announcements as $announcement)
            <div class="col-md-6 mb-4">
                <div class="announcement-card h-100">
                    @if(isset($announcement['image']))
                    @endif
                    <div class="announcement-card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-calendar3 text-success me-2"></i>
                            <small class="text-muted">{{ $announcement->date->format('d F Y') }}</small>
                        </div>
                        <h5 class="announcement-card-title">
                            <a href="{{ route('announcements.show', $announcement->id) }}" class="text-decoration-none text-dark">
                                {{ $announcement->title }}
                            </a>
                        </h5>
                        <p class="text-muted mb-3">{{ $announcement->description }}</p>
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="text-decoration-none fw-semibold text-success">
                            Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('announcements') }}" class="shiny-button" style="text-decoration: none; display: inline-block;">
                <span class="button-text">
                    Lihat Semua Pengumuman
                    <i class="bi bi-arrow-right"></i>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- UMKM Sawotratap -->
<section class="py-5 bg-light" id="umkm">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">UMKM Sawotratap</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Dukung produk lokal desa kami untuk kesejahteraan bersama</p>
        </div>
        <div class="row">
            @foreach($umkm as $product)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <a href="{{ route('umkm.show', $product->id) }}">
                        @if($product->image)
                            @if(str_starts_with($product->image, 'http'))
                            <img src="{{ $product->image }}" 
                                 class="card-img-top" alt="{{ $product->name }}">
                            @else
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="card-img-top" alt="{{ $product->name }}">
                            @endif
                        @else
                            <img src="https://via.placeholder.com/400x300?text=No+Image" 
                                 class="card-img-top" alt="{{ $product->name }}">
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('umkm.show', $product->id) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 mb-0 text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('umkm.show', $product->id) }}" class="btn btn-primary w-100 text-decoration-none">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <a href="{{ route('umkm.show', 3) }}">
                        <img src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=400" 
                             class="card-img-top" alt="Batik Tulis">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('umkm.show', 3) }}" class="text-decoration-none text-dark">
                                Batik Tulis Khas Desa
                            </a>
                        </h5>
                        <p class="card-text text-muted small">Batik tulis dengan motif khas</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 mb-0 text-success">Rp 150.000</span>
                            </div>
                            <a href="{{ route('umkm.show', 3) }}" class="btn btn-primary w-100 text-decoration-none">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <a href="{{ route('umkm.show', 4) }}">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400" 
                             class="card-img-top" alt="Kerajinan">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('umkm.show', 4) }}" class="text-decoration-none text-dark">
                                Anyaman Bambu
                            </a>
                        </h5>
                        <p class="card-text text-muted small">Kerajinan anyaman tangan</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 mb-0 text-success">Rp 35.000</span>
                            </div>
                            <a href="{{ route('umkm.show', 4) }}" class="btn btn-primary w-100 text-decoration-none">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('umkm') }}" class="shiny-button" style="text-decoration: none; display: inline-block;">
                <span class="button-text">
                    LIHAT SEMUA UMKM
                    <i class="bi bi-arrow-right"></i>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- Layanan Pengaduan -->
<section class="py-5" id="layanan">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">Layanan Pengaduan</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Sampaikan aspirasi dan pengaduan Anda untuk pelayanan yang lebih baik</p>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="service-box text-center">
                    <div class="service-icon mx-auto mb-3">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Pengajuan Surat</h5>
                    <p class="small text-muted">Ajukan berbagai jenis surat online</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-box text-center">
                    <div class="service-icon mx-auto mb-3">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Aspirasi Warga</h5>
                    <p class="small text-muted">Sampaikan saran dan masukan</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-box text-center">
                    <div class="service-icon mx-auto mb-3">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Laporan Kejadian</h5>
                    <p class="small text-muted">Laporkan kejadian di lingkungan</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-box text-center">
                    <div class="service-icon mx-auto mb-3">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Live Chat</h5>
                    <p class="small text-muted">Hubungi perangkat desa</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card p-4 h-100 border-0 shadow-sm">
                    <h5 class="mb-4 d-flex align-items-center">
                        <i class="bi bi-chat-left-text me-2" style="color: var(--primary-green);"></i> 
                        <span class="fw-bold">Form Pengaduan</span>
                    </h5>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" style="border-radius: 8px; padding: 12px;">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" style="border-radius: 8px; padding: 12px;">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" style="border-radius: 8px; padding: 12px;">
                                <option>Pilih Jenis Pengaduan</option>
                                <option>Infrastruktur</option>
                                <option>Pelayanan</option>
                                <option>Sosial</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control" rows="4" placeholder="Tulis pengaduan Anda..." style="border-radius: 8px; padding: 12px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px; padding: 12px; font-weight: 600;">
                            <i class="bi bi-send me-2"></i> Kirim Pengaduan
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card p-4 h-100 border-0 shadow-sm">
                    <h5 class="mb-4 d-flex align-items-center">
                        <i class="bi bi-clock-history me-2" style="color: var(--primary-green);"></i>
                        <span class="fw-bold">Pengaduan Terbaru</span>
                    </h5>
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 45px; height: 45px;">
                                    <i class="bi bi-person text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-bold">Ahmad Rizki</h6>
                                <p class="mb-1 small text-muted">Jalan rusak di RT 05 - <span class="text-warning fw-semibold">Sedang diproses</span></p>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i>2 jam yang lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 45px; height: 45px;">
                                    <i class="bi bi-person text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-bold">Siti Fatimah</h6>
                                <p class="mb-1 small text-muted">Lampu jalan mati - <span class="text-success fw-semibold">Selesai</span></p>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i>1 hari yang lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 45px; height: 45px;">
                                    <i class="bi bi-person text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-bold">Budi Santoso</h6>
                                <p class="mb-1 small text-muted">Saluran air tersumbat - <span class="text-info fw-semibold">Menunggu</span></p>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i>3 hari yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- APBDes 2026 -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">APBDes {{ $apbdes['year'] }}</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Laporan keuangan dan realisasi APBDes transparansi untuk masyarakat</p>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card p-4 mb-4">
                    <h5 class="mb-4">Total Anggaran</h5>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Target</span>
                            <span class="fw-bold">Rp {{ number_format($apbdes['target']) }}</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" style="width: 54%">54%</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Realisasi</span>
                            <span class="fw-bold">Rp {{ number_format($apbdes['realization']) }}</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" style="width: 46%; background-color: var(--light-green)">46%</div>
                        </div>
                    </div>
                    <div class="chart-container mt-4" style="height: 250px;">
                        <canvas id="budgetChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card p-4">
                    <h5 class="mb-4">Sisa Anggaran</h5>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini -->
<section class="py-5" id="berita">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">Berita Terkini</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Update Informasi dan Kegiatan Terbaru</p>
        </div>
        <div class="row">
            @foreach($news as $item)
            <div class="col-md-4 mb-4">
                <div class="news-card h-100">
                    <div class="news-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800" 
                             class="news-card-img" alt="{{ $item['title'] }}">
                        <div class="news-card-overlay">
                            <span class="news-badge">{{ $item['category'] }}</span>
                        </div>
                    </div>
                    <div class="news-card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-calendar3 text-success me-2"></i>
                            <small class="text-muted">{{ date('d F Y', strtotime($item['date'])) }}</small>
                        </div>
                        <h5 class="news-card-title">{{ $item['title'] }}</h5>
                        <a href="#" class="news-card-link">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
            @endforeach
            <div class="col-md-4 mb-4">
                <div class="news-card h-100">
                    <div class="news-card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800" 
                            class="news-card-img" alt="Program Pelatihan Digital">
                        <div class="news-card-overlay">
                            <span class="news-badge">Program</span>
                        </div>
                    </div>
                    <div class="news-card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-calendar3 text-success me-2"></i>
                            <small class="text-muted">09 February 2026</small>
                        </div>
                        <h5 class="news-card-title">Program Pelatihan Digital Marketing untuk UMKM Desa</h5>
                        <a href="#" class="news-card-link">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('berita') }}" class="shiny-button" style="text-decoration: none; display: inline-block;">
                <span class="button-text">
                    Lihat Semua Berita
                    <i class="bi bi-arrow-right"></i>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- Galeri Desa -->
<section class="py-5 bg-light" id="galeri">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">Galeri Desa</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Dokumentasi Kegiatan dan Keindahan Desa</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="gallery-item gallery-item-large">
                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800" 
                         alt="Sawah Desa">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title">Pemandangan Sawah</h5>
                            <p class="gallery-desc">Hamparan sawah hijau yang asri</p>
                            <button class="gallery-btn"><i class="bi bi-eye"></i> Lihat</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="gallery-item gallery-item-medium mb-4">
                    <img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=400" 
                         alt="Balai Desa">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title">Balai Desa</h5>
                            <p class="gallery-desc">Pusat pemerintahan desa</p>
                            <button class="gallery-btn"><i class="bi bi-eye"></i> Lihat</button>
                        </div>
                    </div>
                </div>
                <div class="gallery-item gallery-item-medium">
                    <img src="https://images.unsplash.com/photo-1577495508326-19a1b3cf65b7?w=400" 
                         alt="Wisata Desa">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title">Wisata Desa</h5>
                            <p class="gallery-desc">Destinasi wisata lokal</p>
                            <button class="gallery-btn"><i class="bi bi-eye"></i> Lihat</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="gallery-item gallery-item-medium mb-4">
                    <img src="https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=400" 
                         alt="Produk UMKM">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title">Produk UMKM</h5>
                            <p class="gallery-desc">Hasil karya warga desa</p>
                            <button class="gallery-btn"><i class="bi bi-eye"></i> Lihat</button>
                        </div>
                    </div>
                </div>
                <div class="gallery-item gallery-item-medium">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400" 
                         alt="Kegiatan Warga">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h5 class="gallery-title">Kegiatan Warga</h5>
                            <p class="gallery-desc">Aktivitas masyarakat desa</p>
                            <button class="gallery-btn"><i class="bi bi-eye"></i> Lihat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('galeri') }}" class="shiny-button" style="text-decoration: none; display: inline-block;">
                <span class="button-text">
                    Lihat Semua Galeri
                    <i class="bi bi-arrow-right"></i>
                </span>
            </a>
            </button>
        </div>
    </div>
</section>

<!-- Demografi Desa -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title-center">Demografi Desa</h2>
            <p class="text-muted mt-3" style="font-size: 1.05rem; font-weight: 400; letter-spacing: 0.01em;">Data Kependudukan dan Peta Wilayah</p>
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
                            style="border:0; border-radius: 15px;" 
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
            data: [45, 35, 20],
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
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [
            {
                label: 'Pendapatan',
                data: [220, 240, 260, 210, 230, 250],
                backgroundColor: '#2d5016'
            },
            {
                label: 'Belanja',
                data: [180, 200, 190, 185, 195, 210],
                backgroundColor: '#4a7c24'
            },
            {
                label: 'Surplus',
                data: [40, 40, 70, 25, 35, 40],
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

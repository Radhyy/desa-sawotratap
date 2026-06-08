@extends('layouts.app')

@section('title', 'Profil Desa - Sawotratap')

@section('styles')
<style>
    .profile-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        position: relative;
        overflow: hidden;
    }

    html {
        scroll-behavior: smooth;
    }

    .profile-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .profile-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .profile-header .container {
        padding-top: 44px;
        padding-bottom: 44px;
    }

    .profile-page-shell {
        position: relative;
        z-index: 1;
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
        max-width: 780px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400;
    }

    .profile-stats {
        margin-top: 28px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .profile-stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #dde7d6;
        box-shadow: 0 6px 18px rgba(45, 80, 22, 0.06);
        text-align: center;
    }

    .profile-stat-number {
        display: block;
        font-family: 'Sora', sans-serif;
        color: var(--primary-green);
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .profile-stat-label {
        margin-top: 6px;
        display: block;
        color: #5e6d64;
        font-size: 0.88rem;
        font-weight: 500;
    }

    .profile-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
    }

    .profile-card .head {
        padding: 22px 24px;
        background: linear-gradient(135deg, rgba(74, 124, 36, 0.12), rgba(45, 80, 22, 0.08));
        border-bottom: 1px solid #e9f0e3;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .profile-card .head h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #24381f;
        margin: 0;
    }

    .profile-card .body {
        padding: 22px 24px 24px;
    }

    .anchor-nav {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 1.2rem;
    }

    .anchor-nav a {
        text-decoration: none;
        color: #355027;
        background: #eef5e8;
        border: 1px solid #dce9d2;
        padding: 0.58rem 1rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.86rem;
        transition: all 0.2s ease;
    }

    .anchor-nav a:hover {
        background: #dcfce7;
        transform: translateY(-1px);
    }

    .section-card {
        margin-bottom: 1rem;
    }

    .section-card[id] {
        scroll-margin-top: 130px;
    }

    .section-card p,
    .section-card li {
        color: #374151;
        line-height: 1.75;
        margin: 0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .info-list {
        margin: 0;
        padding-left: 1.15rem;
    }

    .info-list li {
        margin-bottom: 0.55rem;
    }

    .map-wrap {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #dce9d2;
        box-shadow: 0 8px 24px rgba(22, 163, 74, 0.12);
    }

    .map-wrap iframe {
        width: 100%;
        height: 380px;
        border: 0;
    }

    .geo-meta {
        margin-top: 0.85rem;
        font-size: 0.9rem;
        color: #4b5563;
    }

    @media (max-width: 1199.98px) {
        .profile-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .profile-header .container {
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
    }

    @media (max-width: 767.98px) {
        .profile-page {
            padding-bottom: 40px;
        }

        .profile-stats {
            grid-template-columns: 1fr;
        }

        .profile-card .head,
        .profile-card .body {
            padding: 18px;
        }

        .map-wrap iframe {
            height: 300px;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-page">
    <div class="profile-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profil Desa</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Profil Desa Sawotratap</h1>
                <p class="hero-subtitle">
                    Halaman ini memuat informasi umum mengenai desa, meliputi sejarah desa, visi dan misi,
                    serta gambaran geografis wilayah Desa Sawotratap.
                </p>
            </div>

            <div class="profile-stats">
                <div class="profile-stat-card">
                    <span class="profile-stat-number">Sejarah</span>
                    <span class="profile-stat-label">Latar perkembangan desa</span>
                </div>
                <div class="profile-stat-card">
                    <span class="profile-stat-number">Visi & Misi</span>
                    <span class="profile-stat-label">Arah pembangunan desa</span>
                </div>
                <div class="profile-stat-card">
                    <span class="profile-stat-number">Geografis</span>
                    <span class="profile-stat-label">Letak wilayah desa</span>
                </div>
            </div>

            <div class="anchor-nav">
                <a href="#sejarah"><i class="bi bi-book me-1"></i>Sejarah Desa</a>
                <a href="#visi-misi"><i class="bi bi-bullseye me-1"></i>Visi & Misi</a>
                <a href="#geografis"><i class="bi bi-geo-alt me-1"></i>Geografis</a>
            </div>
        </div>
    </section>

    <section class="profile-page-shell pt-4">
        <div class="container">
            <section id="sejarah" class="profile-card section-card">
                <div class="head">
                    <i class="bi bi-book"></i>
                    <h2>Sejarah Desa</h2>
                </div>
                <div class="body">
                    <p>
                        Desa Sawotratap merupakan salah satu wilayah yang berkembang dari kawasan agraris
                        menjadi desa yang terus bertransformasi dalam pelayanan publik dan digitalisasi informasi.
                        Secara historis, masyarakat desa membangun kehidupan berdasarkan nilai gotong royong,
                        budaya lokal, serta kekuatan komunitas yang kuat antarwarga.
                    </p>
                    <p class="mt-3">
                        Seiring perkembangan zaman, desa terus melakukan pembenahan pada sektor infrastruktur,
                        tata kelola pemerintahan, dan pelayanan kepada masyarakat untuk mewujudkan desa
                        yang maju, mandiri, dan berdaya saing.
                    </p>
                </div>
            </section>

            <section id="visi-misi" class="profile-card section-card">
                <div class="head">
                    <i class="bi bi-bullseye"></i>
                    <h2>Visi & Misi Desa</h2>
                </div>
                <div class="body">
                    <div class="info-grid">
                        <div class="profile-card" style="margin-bottom:0; background:#f7fbf3;">
                            <div class="head">
                                <i class="bi bi-eye"></i>
                                <h2 style="font-size:1.05rem;">Visi</h2>
                            </div>
                            <div class="body">
                                <p>
                                    Terwujudnya Desa Sawotratap yang maju, sejahtera, berbudaya, dan
                                    berbasis pelayanan publik yang transparan serta partisipatif.
                                </p>
                            </div>
                        </div>
                        <div class="profile-card" style="margin-bottom:0; background:#fffdf2;">
                            <div class="head">
                                <i class="bi bi-list-check"></i>
                                <h2 style="font-size:1.05rem;">Misi</h2>
                            </div>
                            <div class="body">
                                <ul class="info-list">
                                    <li>Meningkatkan kualitas pelayanan pemerintahan desa.</li>
                                    <li>Mendorong pertumbuhan ekonomi masyarakat dan UMKM lokal.</li>
                                    <li>Meningkatkan kualitas SDM melalui pendidikan dan pelatihan.</li>
                                    <li>Memperkuat infrastruktur desa dan tata lingkungan yang berkelanjutan.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="geografis" class="profile-card section-card">
                <div class="head">
                    <i class="bi bi-geo-alt"></i>
                    <h2>Geografis Desa</h2>
                </div>
                <div class="body">
                    <p class="mb-3">
                        Desa Sawotratap berada di Kecamatan Gedangan, Kabupaten Sidoarjo.
                        Peta berikut memberikan gambaran lokasi geografis desa.
                    </p>
                    <div class="map-wrap">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15827.411091290962!2d112.72474024399585!3d-7.3703938822210375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e495b3986b59%3A0x88b42aee982571fd!2sSawotratap%2C%20Kec.%20Gedangan%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1773199130099!5m2!1sid!2sid"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="geo-meta">
                        <i class="bi bi-info-circle me-1"></i>
                        Peta bersifat informatif dan dapat diperbesar langsung melalui Google Maps.
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection

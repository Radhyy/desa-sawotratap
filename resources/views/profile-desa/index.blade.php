@extends('layouts.app')

@section('title', 'Profil Desa - Sawotratap')

@section('styles')
<style>
    html {
        scroll-behavior: smooth;
    }

    .profile-page {
        margin-top: 0;
        padding-bottom: 80px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #eff5f0 100%);
        position: relative;
        overflow: hidden;
    }

    .profile-breadcrumb {
        margin-top: 80px;
        background: transparent;
    }

    .profile-header {
        background: transparent;
        border-bottom: none;
    }

    .profile-header .container {
        padding-top: 56px;
        padding-bottom: 56px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
    }

    .profile-page-shell {
        margin-top: 0.5rem;
    }

    .hero-title {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-family: 'Playfair Display', Georgia, serif;
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: -0.03em;
        color: #1e3723;
    }

    .hero-subtitle {
        color: #4d5d50;
        max-width: 760px;
        margin: 1rem auto 0;
        font-size: 1rem;
        line-height: 1.85;
        font-weight: 400;
    }

    .profile-stats {
        margin-top: 36px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .profile-stat-card {
        background: linear-gradient(180deg, #ffffff 0%, #f7fdf4 100%);
        border-radius: 22px;
        padding: 24px 22px;
        border: 1px solid rgba(74, 124, 36, 0.16);
        box-shadow: 0 18px 40px rgba(36, 63, 29, 0.08);
        text-align: center;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .profile-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 26px 55px rgba(36, 63, 29, 0.13);
    }

    .profile-stat-card i {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: rgba(74, 124, 36, 0.14);
        color: var(--primary-green);
        font-size: 1.2rem;
        margin-bottom: 14px;
    }

    .profile-stat-number {
        display: block;
        font-family: 'Sora', sans-serif;
        color: #20331f;
        font-size: 1.18rem;
        font-weight: 700;
        line-height: 1.25;
    }

    .profile-stat-label {
        margin-top: 10px;
        display: block;
        color: #556c58;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .profile-card {
        background: #ffffff;
        border: 1px solid rgba(74, 124, 36, 0.14);
        border-radius: 26px;
        box-shadow: 0 24px 60px rgba(37, 72, 37, 0.08);
        overflow: hidden;
    }

    .profile-card .head {
        padding: 26px 28px;
        background: #f6fbf3;
        border-bottom: 1px solid rgba(74, 124, 36, 0.12);
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }

    .profile-card .head i {
        width: 46px;
        height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(74, 124, 36, 0.18);
        color: #2f5c21;
        font-size: 1.2rem;
    }

    .profile-card .head h2 {
        font-size: 1.25rem;
        font-family: 'Playfair Display', Georgia, serif;
        font-weight: 700;
        color: #1f3a1f;
        margin: 0;
    }

    .profile-card .body {
        padding: 28px 28px 32px;
    }

    .anchor-nav {
        display: flex;
        gap: 0.85rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 1.8rem;
    }

    .anchor-nav a {
        text-decoration: none;
        color: #275126;
        background: #edf8ed;
        border: 1px solid #d8e9d7;
        padding: 0.68rem 1.15rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .anchor-nav a:hover {
        background: #d9f0d6;
        transform: translateY(-2px);
    }

    .section-card {
        margin-bottom: 1.5rem;
    }

    .section-card[id] {
        scroll-margin-top: 130px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .section-header .tag {
        background: #edf7ea;
        color: #2b5f25;
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        font-size: 0.86rem;
        font-weight: 700;
    }

    .section-card p,
    .section-card li {
        color: #475046;
        line-height: 1.84;
        margin: 0;
        font-size: 0.98rem;
    }

    .section-card p + p {
        margin-top: 1.15rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.5rem;
    }

    .feature-card {
        border-radius: 22px;
        border: 1px solid rgba(74, 124, 36, 0.14);
        background: #fbfdf7;
        box-shadow: 0 16px 36px rgba(14, 54, 25, 0.06);
        overflow: hidden;
    }

    .feature-card .head {
        padding: 20px 22px;
        background: #eff8ec;
        border-bottom: 1px solid rgba(74, 124, 36, 0.1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .feature-card .head h3 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #23421f;
    }

    .feature-card .body {
        padding: 20px 22px 22px;
    }

    .feature-card p,
    .feature-card ul {
        margin: 0;
        color: #4c5b4d;
        font-size: 0.96rem;
        line-height: 1.8;
    }

    .feature-card ul {
        padding-left: 1.35rem;
        margin-top: 0.85rem;
    }

    .feature-card li {
        margin-bottom: 0.85rem;
    }

    .highlight-note {
        background: #f2fbf0;
        border-left: 4px solid #7cc37e;
        padding: 1rem 1rem 1rem 1.05rem;
        border-radius: 16px;
        margin-top: 1.5rem;
        color: #3f553f;
        font-size: 0.95rem;
    }

    .map-wrap {
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(50, 114, 56, 0.14);
        box-shadow: 0 26px 60px rgba(31, 92, 41, 0.1);
    }

    .map-wrap iframe {
        width: 100%;
        height: 420px;
        border: 0;
    }

    .geo-meta {
        margin-top: 1rem;
        font-size: 0.95rem;
        color: #4f5c53;
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
            padding-top: 42px;
            padding-bottom: 42px;
        }

        .hero-title {
            font-size: 2.35rem;
        }

        .hero-subtitle {
            font-size: 0.98rem;
        }
    }

    @media (max-width: 767.98px) {
        .profile-page {
            padding-bottom: 56px;
        }

        .profile-stats {
            grid-template-columns: 1fr;
        }

        .profile-card .head,
        .profile-card .body,
        .feature-card .head,
        .feature-card .body {
            padding: 18px;
        }

        .map-wrap iframe {
            height: 320px;
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
                    <i class="bi bi-book"></i>
                    <span class="profile-stat-number">Sejarah</span>
                    <span class="profile-stat-label">Perjalanan dan nilai-nilai desa</span>
                </div>
                <div class="profile-stat-card">
                    <i class="bi bi-bullseye"></i>
                    <span class="profile-stat-number">Visi & Misi</span>
                    <span class="profile-stat-label">Fokus pembangunan berkelanjutan</span>
                </div>
                <div class="profile-stat-card">
                    <i class="bi bi-geo-alt"></i>
                    <span class="profile-stat-number">Geografis</span>
                    <span class="profile-stat-label">Letak dan kondisi wilayah desa</span>
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
                    <div class="section-header">
                        <span class="tag">Sejarah Singkat</span>
                    </div>
                    <p>
                        Desa Sawotratap tumbuh dari akar agraris menjadi komunitas yang semakin modern.
                        Perubahan ini terjadi melalui dorongan gotong royong, pelestarian budaya lokal,
                        dan pemanfaatan teknologi informasi untuk meningkatkan layanan publik.
                    </p>
                    <p>
                        Dengan tetap menjaga kearifan lokal, desa terus memperbaiki infrastruktur, tata
                        kelola, dan kemampuan warga demi visi desa yang lebih maju, mandiri, dan berdaya saing.
                    </p>
                    <div class="highlight-note">
                        Desa Sawotratap memadukan tradisi kuat dan pola pembangunan modern agar setiap
                        warga merasakan manfaat langsung dari pertumbuhan desa.
                    </div>
                </div>
            </section>

            <section id="visi-misi" class="profile-card section-card">
                <div class="head">
                    <i class="bi bi-bullseye"></i>
                    <h2>Visi & Misi Desa</h2>
                </div>
                <div class="body">
                    <div class="info-grid">
                        <div class="feature-card">
                            <div class="head">
                                <i class="bi bi-eye"></i>
                                <h3>Visi</h3>
                            </div>
                            <div class="body">
                                <p>
                                    Terwujudnya Desa Sawotratap yang maju, sejahtera, berbudaya, dan berbasis pelayanan
                                    publik yang transparan serta partisipatif.
                                </p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="head">
                                <i class="bi bi-list-check"></i>
                                <h3>Misi</h3>
                            </div>
                            <div class="body">
                                <ul class="info-list">
                                    <li>Meningkatkan kualitas pelayanan pemerintahan desa secara responsif.</li>
                                    <li>Mendukung pertumbuhan ekonomi masyarakat dan UMKM lokal.</li>
                                    <li>Membangun kualitas SDM melalui pendidikan dan pelatihan berkelanjutan.</li>
                                    <li>Memperkuat infrastruktur dan tata lingkungan yang ramah lingkungan.</li>
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
                    <div class="section-header">
                        <span class="tag">Lokasi</span>
                    </div>
                    <p>
                        Desa Sawotratap berada di Kecamatan Gedangan, Kabupaten Sidoarjo.
                        Peta berikut memberi gambaran posisi desa dan akses utama sekitarnya.
                    </p>
                    <div class="map-wrap mt-4">
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

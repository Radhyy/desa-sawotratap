@extends('layouts.app')

@section('title', 'Profil Desa - Sawotratap')

@section('styles')
<style>
    .desa-profile-page {
        padding-top: 138px;
        padding-bottom: 56px;
        min-height: 100vh;
        background:
            radial-gradient(circle at top right, rgba(22, 163, 74, 0.08), transparent 40%),
            radial-gradient(circle at bottom left, rgba(34, 197, 94, 0.07), transparent 38%),
            #f5faf6;
        position: relative;
        overflow: hidden;
    }

    .desa-profile-page::before {
        content: '';
        position: absolute;
        top: -120px;
        left: -120px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(22, 163, 74, 0.15), transparent 70%);
        pointer-events: none;
    }

    .desa-profile-page::after {
        content: '';
        position: absolute;
        bottom: -140px;
        right: -90px;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(34, 197, 94, 0.14), transparent 68%);
        pointer-events: none;
    }

    .desa-shell {
        position: relative;
        z-index: 1;
    }

    .desa-hero {
        background: linear-gradient(135deg, #166534 0%, #15803d 50%, #22c55e 100%);
        color: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 16px 40px rgba(22, 101, 52, 0.24);
        margin-bottom: 1.6rem;
        position: relative;
        overflow: hidden;
    }

    .desa-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        opacity: 0.2;
    }

    .desa-hero-deco {
        position: absolute;
        right: 34px;
        top: 50%;
        transform: translateY(-50%) rotate(-18deg);
        font-size: 9.5rem;
        color: rgba(255, 255, 255, 0.16);
        z-index: 1;
        pointer-events: none;
        filter: drop-shadow(0 8px 18px rgba(0, 0, 0, 0.12));
    }

    .desa-hero-content {
        position: relative;
        z-index: 1;
    }

    .desa-hero h1 {
        font-size: 2.1rem;
        font-weight: 800;
        margin-bottom: 0.6rem;
    }

    .desa-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.9);
        max-width: 760px;
        font-size: 1rem;
    }

    .desa-anchor-nav {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1.3rem;
    }

    .desa-anchor-nav a {
        text-decoration: none;
        color: #14532d;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        padding: 0.55rem 0.95rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.86rem;
        transition: all 0.2s ease;
    }

    .desa-anchor-nav a:hover {
        background: #dcfce7;
        transform: translateY(-1px);
    }

    .desa-card {
        background: #fff;
        border: 1px solid #dcfce7;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
        margin-bottom: 1rem;
    }

    .desa-card h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #166534;
        margin-bottom: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .desa-card p,
    .desa-card li {
        color: #374151;
        line-height: 1.75;
        margin: 0;
    }

    .desa-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .desa-list {
        margin: 0;
        padding-left: 1.15rem;
    }

    .desa-list li {
        margin-bottom: 0.55rem;
    }

    .map-wrap {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #bbf7d0;
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

    @media (max-width: 992px) {
        .desa-grid {
            grid-template-columns: 1fr;
        }

        .desa-hero {
            padding: 2rem;
        }

        .desa-hero-deco {
            font-size: 7.2rem;
            right: 22px;
            opacity: 0.8;
        }

        .desa-hero h1 {
            font-size: 1.65rem;
        }
    }

    @media (max-width: 768px) {
        .desa-hero-deco {
            font-size: 5.2rem;
            right: 14px;
            top: 22px;
            transform: rotate(-15deg);
            color: rgba(255, 255, 255, 0.12);
        }
    }
</style>
@endsection

@section('content')
<div class="desa-profile-page">
    <div class="container desa-shell">
        <section class="desa-hero">
            <i class="bi bi-building-fill desa-hero-deco"></i>
            <div class="desa-hero-content">
                <h1>Profil Desa Sawotratap</h1>
                <p>
                    Halaman ini memuat informasi umum mengenai desa, meliputi sejarah desa, visi dan misi,
                    serta gambaran geografis wilayah Desa Sawotratap.
                </p>
            </div>
        </section>

        <div class="desa-anchor-nav">
            <a href="#sejarah"><i class="bi bi-book me-1"></i>Sejarah Desa</a>
            <a href="#visi-misi"><i class="bi bi-bullseye me-1"></i>Visi & Misi</a>
            <a href="#geografis"><i class="bi bi-geo-alt me-1"></i>Geografis</a>
        </div>

        <section id="sejarah" class="desa-card mt-3">
            <h2><i class="bi bi-book"></i>Sejarah Desa</h2>
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
        </section>

        <section id="visi-misi" class="desa-card">
            <h2><i class="bi bi-bullseye"></i>Visi & Misi Desa</h2>
            <div class="desa-grid">
                <div class="desa-card" style="margin-bottom:0; background:#f0fdf4;">
                    <h2 style="font-size:1.05rem; margin-bottom:0.6rem;"><i class="bi bi-eye"></i>Visi</h2>
                    <p>
                        Terwujudnya Desa Sawotratap yang maju, sejahtera, berbudaya, dan
                        berbasis pelayanan publik yang transparan serta partisipatif.
                    </p>
                </div>
                <div class="desa-card" style="margin-bottom:0; background:#f7fee7;">
                    <h2 style="font-size:1.05rem; margin-bottom:0.6rem;"><i class="bi bi-list-check"></i>Misi</h2>
                    <ul class="desa-list">
                        <li>Meningkatkan kualitas pelayanan pemerintahan desa.</li>
                        <li>Mendorong pertumbuhan ekonomi masyarakat dan UMKM lokal.</li>
                        <li>Meningkatkan kualitas SDM melalui pendidikan dan pelatihan.</li>
                        <li>Memperkuat infrastruktur desa dan tata lingkungan yang berkelanjutan.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="geografis" class="desa-card">
            <h2><i class="bi bi-geo-alt"></i>Geografis Desa</h2>
            <p class="mb-3">
                Desa Sawotratap berada di Kecamatan Gedangan, Kabupaten Sidoarjo.
                Peta berikut memberikan gambaran lokasi geografis desa.
            </p>
            <div class="map-wrap">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15827.411091290962!2d112.72474024399585!3d-7.3703938822210375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e495b3986b59%3A0x88b42aee982571fd!2sSawotratap%2C%20Kec.%20Gedangan%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1773199130099!5m2!1sid!2sid"                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="geo-meta">
                <i class="bi bi-info-circle me-1"></i>
                Peta bersifat informatif dan dapat diperbesar langsung melalui Google Maps.
            </div>
        </section>
    </div>
</div>
@endsection

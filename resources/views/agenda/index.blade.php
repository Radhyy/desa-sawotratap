@extends('layouts.app')

@section('title', 'Agenda Desa - Desa Sawotratap')

@section('styles')
<style>
    .agenda-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background:
            radial-gradient(circle at top left, rgba(74, 124, 36, 0.08), transparent 28%),
            radial-gradient(circle at 80% 10%, rgba(45, 80, 22, 0.06), transparent 22%),
            linear-gradient(180deg, #fbfdf8 0%, #f4f7fa 55%, #eff5ef 100%);
        position: relative;
        overflow: hidden;
    }

    .agenda-page::before,
    .agenda-page::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        filter: blur(30px);
        opacity: 0.55;
    }

    .agenda-page::before {
        width: 260px;
        height: 260px;
        top: 120px;
        right: -90px;
        background: rgba(74, 124, 36, 0.12);
    }

    .agenda-page::after {
        width: 220px;
        height: 220px;
        bottom: 180px;
        left: -80px;
        background: rgba(45, 80, 22, 0.08);
    }

    .agenda-breadcrumb {
        margin-top: 80px;
        background: rgba(248, 249, 250, 0.9);
        border-bottom: 1px solid #e8ecef;
        backdrop-filter: blur(8px);
        position: relative;
        z-index: 1;
    }

    .agenda-header {
        background: linear-gradient(180deg, rgba(248, 249, 250, 0.98), rgba(250, 252, 248, 0.92));
        border-bottom: 1px solid #e8ecef;
        position: relative;
        z-index: 1;
    }

    .agenda-header .container {
        padding-top: 48px;
        padding-bottom: 52px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
        position: relative;
    }

    .agenda-hero-badge {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.45rem 0.9rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #eef5e8, #f8fbf3);
        color: #355027;
        border: 1px solid #dce9d2;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 14px;
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 8px 18px rgba(45, 80, 22, 0.06);
    }

    .hero-title {
        font-size: 2.55rem;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 0.5rem;
    }

    .agenda-page h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        line-height: 1.25;
    }

    .hero-subtitle {
        color: #5e6d64 !important;
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400 !important;
        background: none !important;
        -webkit-background-clip: unset !important;
        background-clip: unset !important;
        -webkit-text-fill-color: unset !important;
        margin-top: 0.2rem;
    }

    .agenda-shell {
        position: relative;
        z-index: 1;
    }

    .agenda-stats {
        margin-top: 30px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .agenda-stat-card {
        background: linear-gradient(180deg, #ffffff, #f8fcf5);
        border-radius: 18px;
        padding: 18px 16px 17px;
        border: 1px solid #dfe9d5;
        box-shadow: 0 10px 24px rgba(45, 80, 22, 0.07);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .agenda-stat-card::before {
        content: '';
        position: absolute;
        inset: 0 0 auto 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--light-green));
    }

    .agenda-stat-number {
        display: block;
        font-family: 'Sora', sans-serif;
        color: var(--primary-green);
        font-size: 1.85rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .agenda-stat-label {
        margin-top: 6px;
        display: block;
        color: #5e6d64;
        font-size: 0.88rem;
        font-weight: 500;
    }

    .agenda-grid {
        display: grid;
        grid-template-columns: 1.3fr 0.9fr;
        gap: 1.15rem;
    }

    .agenda-card {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid #e4ecdf;
        border-radius: 22px;
        box-shadow: 0 12px 32px rgba(45, 80, 22, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .agenda-card:hover {
        transform: translateY(-4px);
        border-color: #b6d0a3;
        box-shadow: 0 18px 38px rgba(45, 80, 22, 0.14);
    }

    .agenda-card .head {
        padding: 22px 24px;
        background: linear-gradient(135deg, rgba(74, 124, 36, 0.14), rgba(45, 80, 22, 0.08));
        border-bottom: 1px solid #e9f0e3;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .agenda-card .head h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #24381f;
        margin: 0;
        font-family: 'Playfair Display', serif;
    }

    .agenda-body {
        padding: 22px 24px 24px;
    }

    .agenda-item {
        border: 1px solid #e5ece0;
        background: linear-gradient(180deg, #ffffff, #fbfdf8);
        border-radius: 18px;
        padding: 1rem;
        box-shadow: 0 8px 18px rgba(45, 80, 22, 0.07);
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .agenda-item:hover {
        transform: translateY(-5px);
        border-color: #b6d0a3;
        box-shadow: 0 14px 28px rgba(45, 80, 22, 0.13);
    }

    .agenda-item::before {
        content: '';
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        background: linear-gradient(180deg, var(--primary-green), var(--light-green));
    }

    .agenda-item:last-child {
        margin-bottom: 0;
    }

    .agenda-item-top {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
    }

    .agenda-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: #fff;
        font-size: 1.15rem;
        flex-shrink: 0;
        box-shadow: 0 10px 18px rgba(45, 80, 22, 0.18);
    }

    .agenda-item h3 {
        margin: 0 0 0.35rem;
        color: #22331d;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .agenda-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem;
        margin-bottom: 0.65rem;
    }

    .agenda-pill {
        border-radius: 999px;
        padding: 0.35rem 0.65rem;
        font-size: 0.76rem;
        font-weight: 700;
        background: #eef5e8;
        color: #355027;
    }

    .agenda-item p {
        margin: 0;
        color: #5c6a62;
        line-height: 1.65;
        font-size: 0.92rem;
    }

    .agenda-side-box {
        border-radius: 18px;
        border: 1px solid #dce9d2;
        background: linear-gradient(180deg, #f9fcf7, #f2f8ef);
        padding: 1.05rem 1rem;
        margin-bottom: 0.9rem;
        box-shadow: 0 8px 18px rgba(45, 80, 22, 0.06);
    }

    .agenda-side-box h3 {
        margin: 0 0 0.3rem;
        color: #22331d;
        font-size: 1rem;
        font-weight: 700;
    }

    .agenda-side-box p {
        margin: 0;
        color: #4b5563;
        line-height: 1.55;
        font-size: 0.9rem;
    }

    .agenda-timeline {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .agenda-timeline li {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1rem;
        align-items: flex-start;
    }

    .timeline-dot {
        width: 12px;
        height: 12px;
        margin-top: 0.45rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #16a34a, #22c55e);
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.1);
        flex-shrink: 0;
    }

    .timeline-content h4 {
        margin: 0 0 0.2rem;
        color: #22331d;
        font-size: 0.93rem;
        font-weight: 700;
    }

    .timeline-content p {
        margin: 0;
        color: #5c6a62;
        font-size: 0.87rem;
        line-height: 1.5;
    }

    .agenda-note {
        margin-top: 1.1rem;
        border-radius: 18px;
        border: 1px solid #dce9d2;
        background: linear-gradient(135deg, #f7fbf3, #eef5e8);
        padding: 1.1rem;
        box-shadow: 0 10px 20px rgba(45, 80, 22, 0.07);
    }

    .agenda-note h3 {
        margin: 0 0 0.25rem;
        color: #22331d;
        font-size: 1rem;
        font-weight: 700;
    }

    .agenda-note p {
        margin: 0 0 0.8rem;
        color: #4b5563;
        font-size: 0.9rem;
    }

    .agenda-note .btn {
        border-radius: 999px;
        font-weight: 700;
        padding: 0.62rem 1rem;
        box-shadow: 0 8px 16px rgba(22, 101, 52, 0.18);
    }

    @media (max-width: 1199.98px) {
        .agenda-grid {
            grid-template-columns: 1fr;
        }

        .agenda-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .agenda-page {
            padding-bottom: 40px;
        }

        .agenda-header .container {
            padding-top: 36px;
            padding-bottom: 38px;
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

        .agenda-stats {
            grid-template-columns: 1fr;
        }

        .agenda-card .head,
        .agenda-body {
            padding: 18px;
        }

        .agenda-item-top {
            gap: 0.7rem;
        }

        .agenda-icon {
            width: 46px;
            height: 46px;
        }
    }
</style>
@endsection

@section('content')
<div class="agenda-page">
    <div class="agenda-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="agenda-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <div class="agenda-hero-badge">
                    <i class="bi bi-calendar2-week"></i>
                    Jadwal Kegiatan Desa
                </div>
                <h1 class="section-title-center hero-title">Agenda Desa</h1>
                <p class="hero-subtitle">
                    Informasi jadwal kegiatan desa yang akan datang, mulai dari layanan warga,
                    kegiatan sosial, hingga agenda rapat dan pemberdayaan masyarakat.
                </p>
            </div>

            <div class="agenda-stats">
                <div class="agenda-stat-card">
                    <span class="agenda-stat-number">{{ $agendaItems->count() }}</span>
                    <span class="agenda-stat-label">Agenda Terjadwal</span>
                </div>
                <div class="agenda-stat-card">
                    <span class="agenda-stat-number">4</span>
                    <span class="agenda-stat-label">Kategori Kegiatan</span>
                </div>
                <div class="agenda-stat-card">
                    <span class="agenda-stat-number">Mingguan</span>
                    <span class="agenda-stat-label">Pembaruan Informasi</span>
                </div>
            </div>
        </div>
    </section>

    <section class="agenda-shell pt-4">
        <div class="container">
            <div class="agenda-grid">
                <section class="agenda-card">
                    <div class="head">
                        <i class="bi bi-calendar2-event"></i>
                        <h2>Agenda Mendatang</h2>
                    </div>
                    <div class="agenda-body">
                        @foreach($agendaItems as $item)
                            <article class="agenda-item">
                                <div class="agenda-item-top">
                                    <div class="agenda-icon">
                                        <i class="bi {{ $item['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <div class="agenda-meta">
                                            <span class="agenda-pill">{{ $item['type'] }}</span>
                                            <span class="agenda-pill"><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($item['date'])->translatedFormat('d F Y') }}</span>
                                            <span class="agenda-pill"><i class="bi bi-clock me-1"></i>{{ $item['time'] }}</span>
                                        </div>
                                        <h3>{{ $item['title'] }}</h3>
                                        <p class="mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $item['location'] }}</p>
                                        <p>{{ $item['description'] }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <div class="d-grid gap-3">
                    <section class="agenda-card">
                        <div class="head">
                            <i class="bi bi-list-check"></i>
                            <h2>Catatan Agenda</h2>
                        </div>
                        <div class="agenda-body">
                            <div class="agenda-side-box">
                                <h3>Informasi Kegiatan</h3>
                                <p>Jadwal dapat berubah menyesuaikan kondisi lapangan dan kebijakan desa.</p>
                            </div>
                            <div class="agenda-side-box">
                                <h3>Konfirmasi Kehadiran</h3>
                                <p>Untuk agenda tertentu, warga dapat menghubungi perangkat desa atau ketua RT setempat.</p>
                            </div>
                            <div class="agenda-side-box">
                                <h3>Agenda Berulang</h3>
                                <p>Beberapa kegiatan layanan masyarakat dilaksanakan rutin setiap minggu atau setiap bulan.</p>
                            </div>
                        </div>
                    </section>

                    <section class="agenda-card">
                        <div class="head">
                            <i class="bi bi-clock-history"></i>
                            <h2>Urutan Pelaksanaan</h2>
                        </div>
                        <div class="agenda-body">
                            <ul class="agenda-timeline">
                                <li>
                                    <span class="timeline-dot"></span>
                                    <div class="timeline-content">
                                        <h4>Pengumuman Jadwal</h4>
                                        <p>Agenda dipublikasikan melalui website dan papan informasi desa.</p>
                                    </div>
                                </li>
                                <li>
                                    <span class="timeline-dot"></span>
                                    <div class="timeline-content">
                                        <h4>Persiapan Warga</h4>
                                        <p>Warga menyiapkan dokumen, perlengkapan, atau kehadiran sesuai agenda.</p>
                                    </div>
                                </li>
                                <li>
                                    <span class="timeline-dot"></span>
                                    <div class="timeline-content">
                                        <h4>Pelaksanaan Kegiatan</h4>
                                        <p>Kegiatan berlangsung sesuai waktu, lokasi, dan alur yang telah ditetapkan.</p>
                                    </div>
                                </li>
                            </ul>

                            <div class="agenda-note">
                                <h3>Butuh informasi layanan lain?</h3>
                                <p>Gunakan halaman Pengajuan Surat, Pengaduan, atau Perizinan sesuai kebutuhan warga.</p>
                                <a href="{{ route('home') }}" class="btn btn-success">
                                    <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
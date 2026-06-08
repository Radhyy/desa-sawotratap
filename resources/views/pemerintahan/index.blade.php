@extends('layouts.app')

@section('title', 'Pemerintahan Desa - Sawotratap')

@section('styles')
<style>
    .gov-page {
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

    .gov-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .gov-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .gov-header .container {
        padding-top: 44px;
        padding-bottom: 44px;
    }

    .gov-shell {
        position: relative;
        z-index: 1;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 2.5rem;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    .hero-subtitle {
        color: #5e6d64 !important;
        max-width: 780px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400 !important;
        background: none !important;
        -webkit-background-clip: unset !important;
        background-clip: unset !important;
        -webkit-text-fill-color: unset !important;
        margin-top: 0.25rem !important;
    }

    .gov-stats {
        margin-top: 32px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .gov-stat-card {
        background: #fff;
        border-radius: 18px;
        padding: 22px;
        border: 1px solid #dde7d6;
        box-shadow: 0 10px 28px rgba(39, 107, 60, 0.08);
        text-align: center;
        min-height: 170px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .gov-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 34px rgba(39, 107, 60, 0.14);
    }

    .gov-stat-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 0.75rem;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #16a34a, #4ade80);
        color: #fff;
        box-shadow: 0 10px 24px rgba(36, 117, 60, 0.18);
        font-size: 1.15rem;
    }

    .gov-stat-number {
        display: block;
        font-family: 'Sora', sans-serif;
        color: #1f3b1b;
        font-size: 1.18rem;
        font-weight: 800;
        margin-top: 0.25rem;
    }

    .gov-stat-label {
        margin-top: 8px;
        display: block;
        color: #52615d;
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.5;
    }

    .gov-pill-nav {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: center;
        margin: 1.5rem 0 0;
    }

    .gov-pill-nav a {
        text-decoration: none;
        color: #1f3b1b;
        background: #f1f8f2;
        border: 1px solid #d2e7d0;
        border-radius: 999px;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        font-weight: 700;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .gov-pill-nav a:hover {
        background: #d9f1dc;
        transform: translateY(-1px);
    }

    .section-card[id] {
        scroll-margin-top: 130px;
    }

    #struktur-organisasi,
    #perangkat-desa,
    #bpd {
        scroll-margin-top: 130px;
    }

    .gov-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 20px;
        box-shadow: 0 10px 28px rgba(45, 80, 22, 0.08);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .gov-card .head {
        padding: 24px 26px;
        background: #f5fbf5;
        border-bottom: 1px solid #e9f0e3;
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }

    .gov-card .head i {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #d4f0d4;
        color: #166534;
        font-size: 1.1rem;
        border: 1px solid rgba(22, 101, 52, 0.16);
    }

    .gov-card .head h2 {
        font-size: 1.22rem;
        color: #1f3b1b;
        font-weight: 700;
        margin: 0;
        font-family: 'Playfair Display', serif;
    }

    .gov-card .body {
        padding: 26px;
    }

    .gov-muted {
        color: #4b5563;
        line-height: 1.75;
    }

    .org-flow {
        display: grid;
        gap: 16px;
    }

    .org-row {
        display: grid;
        gap: 16px;
    }

    .org-row--single {
        grid-template-columns: 1fr;
    }

    .org-row--two {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .org-row--three {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .org-node {
        background: #f8fef9;
        border: 1px solid #dce9d2;
        border-radius: 14px;
        padding: 0.95rem;
        text-align: center;
        box-shadow: 0 5px 12px rgba(22, 163, 74, 0.08);
    }

    .org-node .title {
        display: block;
        font-weight: 800;
        color: #355027;
        margin-bottom: 0.2rem;
        font-size: 0.9rem;
    }

    .org-node .name {
        font-size: 0.86rem;
        color: #374151;
        font-weight: 600;
    }

    .staff-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.75rem;
    }

    .staff-item {
        background: #fff;
        border: 1px solid #e5ece0;
        border-radius: 14px;
        padding: 1rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .staff-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(21, 128, 61, 0.12);
    }

    .staff-top {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        margin-bottom: 0.55rem;
    }

    .staff-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.03rem;
        box-shadow: 0 6px 14px rgba(22, 163, 74, 0.22);
        flex-shrink: 0;
    }

    .staff-role {
        color: #355027;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .staff-name {
        color: #1f2937;
        font-size: 0.92rem;
        font-weight: 700;
    }

    .staff-detail {
        font-size: 0.82rem;
        color: #6b7280;
        margin: 0;
    }

    .bpd-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.85rem;
    }

    .bpd-item {
        background: #fff;
        border: 1px solid #e5ece0;
        border-radius: 14px;
        padding: 1rem;
        box-shadow: 0 5px 16px rgba(45, 80, 22, 0.07);
    }

    .bpd-item .head {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.5rem;
    }

    .bpd-item .head i {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #eef5e8;
        color: #355027;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .bpd-item .position {
        margin: 0;
        color: #355027;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .bpd-item .person {
        margin: 0.1rem 0 0;
        color: #1f2937;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .bpd-item .desc {
        margin: 0.45rem 0 0;
        font-size: 0.84rem;
        color: #4b5563;
        line-height: 1.6;
    }

    @media (max-width: 1199.98px) {
        .gov-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px) {
        .org-row,
        .staff-grid,
        .bpd-grid {
            grid-template-columns: 1fr 1fr;
        }

        .gov-header .container {
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
        .org-row,
        .staff-grid,
        .bpd-grid {
            grid-template-columns: 1fr;
        }

        .gov-page {
            padding-bottom: 40px;
        }

        .gov-stats {
            grid-template-columns: 1fr;
        }

        .gov-card .head,
        .gov-card .body {
            padding: 18px;
        }
    }
</style>
@endsection

@section('content')
<div class="gov-page">
    <div class="gov-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pemerintahan</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="gov-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Pemerintahan Desa Sawotratap</h1>
                <p class="hero-subtitle">
                    Halaman ini menyajikan informasi pemerintahan desa dalam satu tampilan terpadu,
                    meliputi Struktur Organisasi, Perangkat Desa, dan BPD.
                </p>
            </div>

            <div class="gov-stats">
                <div class="gov-stat-card">
                    <span class="gov-stat-icon"><i class="bi bi-diagram-3"></i></span>
                    <span class="gov-stat-number">1 Struktur</span>
                    <span class="gov-stat-label">Alur organisasi pemerintahan desa</span>
                </div>
                <div class="gov-stat-card">
                    <span class="gov-stat-icon"><i class="bi bi-people"></i></span>
                    <span class="gov-stat-number">5 Perangkat</span>
                    <span class="gov-stat-label">Fungsi pelayanan dan administrasi desa</span>
                </div>
                <div class="gov-stat-card">
                    <span class="gov-stat-icon"><i class="bi bi-building"></i></span>
                    <span class="gov-stat-number">4 BPD</span>
                    <span class="gov-stat-label">Mitra pengawasan dan aspirasi masyarakat</span>
                </div>
            </div>

            <div class="gov-pill-nav">
                <a href="#struktur-organisasi"><i class="bi bi-diagram-3 me-1"></i>Struktur Organisasi</a>
                <a href="#perangkat-desa"><i class="bi bi-people me-1"></i>Perangkat Desa</a>
                <a href="#bpd"><i class="bi bi-building me-1"></i>BPD</a>
            </div>
        </div>
    </section>

    <section class="pt-4">
        <div class="container gov-shell">
            <section id="struktur-organisasi" class="gov-card section-card">
                <div class="head">
                    <i class="bi bi-diagram-3"></i>
                    <h2>Struktur Organisasi</h2>
                </div>
                <div class="body">
                    <p class="gov-muted mb-3">
                        Susunan jabatan pemerintahan desa ditampilkan secara ringkas sebagai gambaran alur koordinasi
                        dan pelaksanaan pelayanan kepada masyarakat.
                    </p>

                    <div class="org-flow">
                        <div class="org-row org-row--single">
                            <div class="org-node">
                                <span class="title">Kepala Desa</span>
                                <span class="name">H. Santoso Wibowo</span>
                            </div>
                        </div>
                        <div class="org-row org-row--two">
                            <div class="org-node">
                                <span class="title">Sekretaris Desa</span>
                                <span class="name">Rina Maharani, S.Sos.</span>
                            </div>
                            <div class="org-node">
                                <span class="title">Kasi Pemerintahan</span>
                                <span class="name">Agus Priyanto</span>
                            </div>
                        </div>
                        <div class="org-row org-row--three">
                            <div class="org-node">
                                <span class="title">Kasi Pelayanan</span>
                                <span class="name">Dewi Lestari</span>
                            </div>
                            <div class="org-node">
                                <span class="title">Kaur Keuangan</span>
                                <span class="name">Bambang Setiawan</span>
                            </div>
                            <div class="org-node">
                                <span class="title">Kaur Umum</span>
                                <span class="name">Nadia Putri</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="perangkat-desa" class="gov-card section-card">
                <div class="head">
                    <i class="bi bi-people"></i>
                    <h2>Perangkat Desa</h2>
                </div>
                <div class="body">
                    <p class="gov-muted mb-3">
                        Tim perangkat desa berperan dalam administrasi, pelayanan publik, pembangunan, dan
                        pemberdayaan masyarakat di tingkat desa.
                    </p>

                    <div class="staff-grid">
                        <div class="staff-item">
                            <div class="staff-top">
                                <span class="staff-icon"><i class="bi bi-person-badge"></i></span>
                                <div>
                                    <div class="staff-role">Sekretaris Desa</div>
                                    <div class="staff-name">Rina Maharani</div>
                                </div>
                            </div>
                            <p class="staff-detail">Koordinasi administrasi umum dan penyusunan dokumen desa.</p>
                        </div>
                        <div class="staff-item">
                            <div class="staff-top">
                                <span class="staff-icon"><i class="bi bi-cash-coin"></i></span>
                                <div>
                                    <div class="staff-role">Kaur Keuangan</div>
                                    <div class="staff-name">Bambang Setiawan</div>
                                </div>
                            </div>
                            <p class="staff-detail">Pengelolaan APBDes dan laporan keuangan pemerintahan desa.</p>
                        </div>
                        <div class="staff-item">
                            <div class="staff-top">
                                <span class="staff-icon"><i class="bi bi-journal-text"></i></span>
                                <div>
                                    <div class="staff-role">Kasi Pelayanan</div>
                                    <div class="staff-name">Dewi Lestari</div>
                                </div>
                            </div>
                            <p class="staff-detail">Pelayanan surat menyurat dan kebutuhan administrasi warga.</p>
                        </div>
                        <div class="staff-item">
                            <div class="staff-top">
                                <span class="staff-icon"><i class="bi bi-building"></i></span>
                                <div>
                                    <div class="staff-role">Kasi Pemerintahan</div>
                                    <div class="staff-name">Agus Priyanto</div>
                                </div>
                            </div>
                            <p class="staff-detail">Pelaksanaan program tata kelola dan pemerintahan wilayah.</p>
                        </div>
                        <div class="staff-item">
                            <div class="staff-top">
                                <span class="staff-icon"><i class="bi bi-tools"></i></span>
                                <div>
                                    <div class="staff-role">Kaur Umum</div>
                                    <div class="staff-name">Nadia Putri</div>
                                </div>
                            </div>
                            <p class="staff-detail">Pengelolaan inventaris, sarana kantor, dan dukungan operasional.</p>
                        </div>
                        <div class="staff-item">
                            <div class="staff-top">
                                <span class="staff-icon"><i class="bi bi-person-workspace"></i></span>
                                <div>
                                    <div class="staff-role">Operator Desa</div>
                                    <div class="staff-name">Fajar Ramadhan</div>
                                </div>
                            </div>
                            <p class="staff-detail">Pemutakhiran data desa dan pengelolaan layanan digital.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="bpd" class="gov-card section-card">
                <div class="head">
                    <i class="bi bi-building"></i>
                    <h2>Badan Permusyawaratan Desa (BPD)</h2>
                </div>
                <div class="body">
                    <p class="gov-muted mb-3">
                        BPD merupakan mitra pemerintah desa dalam fungsi pengawasan, aspirasi warga,
                        dan musyawarah perumusan kebijakan desa.
                    </p>

                    <div class="bpd-grid">
                        <div class="bpd-item">
                            <div class="head">
                                <i class="bi bi-person-lines-fill"></i>
                                <div>
                                    <p class="position">Ketua BPD</p>
                                    <p class="person">Suwarno</p>
                                </div>
                            </div>
                            <p class="desc">Memimpin rapat BPD dan memastikan fungsi pengawasan berjalan efektif.</p>
                        </div>
                        <div class="bpd-item">
                            <div class="head">
                                <i class="bi bi-person-video3"></i>
                                <div>
                                    <p class="position">Wakil Ketua</p>
                                    <p class="person">Siti Aminah</p>
                                </div>
                            </div>
                            <p class="desc">Mendampingi ketua serta mengoordinasikan penyampaian aspirasi masyarakat.</p>
                        </div>
                        <div class="bpd-item">
                            <div class="head">
                                <i class="bi bi-pencil-square"></i>
                                <div>
                                    <p class="position">Sekretaris</p>
                                    <p class="person">Arif Hidayat</p>
                                </div>
                            </div>
                            <p class="desc">Pengelolaan administrasi rapat dan dokumentasi keputusan BPD.</p>
                        </div>
                        <div class="bpd-item">
                            <div class="head">
                                <i class="bi bi-people-fill"></i>
                                <div>
                                    <p class="position">Anggota</p>
                                    <p class="person">Unsur Kewilayahan</p>
                                </div>
                            </div>
                            <p class="desc">Mewakili wilayah dusun dan menyalurkan kebutuhan prioritas warga.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection

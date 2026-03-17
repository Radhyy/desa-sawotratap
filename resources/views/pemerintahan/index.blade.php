@extends('layouts.app')

@section('title', 'Pemerintahan Desa - Sawotratap')

@section('styles')
<style>
    .gov-page {
        padding-top: 132px;
        padding-bottom: 60px;
        min-height: 100vh;
        background:
            radial-gradient(circle at 88% 6%, rgba(22, 163, 74, 0.10), transparent 34%),
            radial-gradient(circle at 5% 80%, rgba(34, 197, 94, 0.08), transparent 32%),
            #f6faf7;
        position: relative;
        overflow: hidden;
    }

    .gov-page::before {
        content: '';
        position: absolute;
        top: -120px;
        left: -110px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(22, 163, 74, 0.15), transparent 70%);
        pointer-events: none;
    }

    .gov-shell {
        position: relative;
        z-index: 1;
    }

    .gov-hero {
        background: linear-gradient(135deg, #166534 0%, #15803d 56%, #22c55e 100%);
        border-radius: 24px;
        padding: 2.4rem;
        box-shadow: 0 18px 42px rgba(21, 128, 61, 0.24);
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .gov-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.09) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.09) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.16;
    }

    .gov-hero-content {
        position: relative;
        z-index: 1;
    }

    .gov-hero h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.55rem;
    }

    .gov-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.92);
        max-width: 780px;
        line-height: 1.7;
    }

    .gov-pill-nav {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin: 1rem 0 1.4rem;
    }

    .gov-pill-nav a {
        text-decoration: none;
        color: #14532d;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 999px;
        padding: 0.58rem 0.95rem;
        font-size: 0.86rem;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .gov-pill-nav a:hover {
        background: #dcfce7;
        transform: translateY(-1px);
    }

    #struktur-organisasi,
    #perangkat-desa,
    #bpd {
        scroll-margin-top: 120px;
    }

    .gov-card {
        background: #fff;
        border: 1px solid #dcfce7;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(2, 6, 23, 0.06);
        padding: 1.45rem;
        margin-bottom: 1rem;
    }

    .gov-card h2 {
        font-size: 1.28rem;
        color: #166534;
        font-weight: 800;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.58rem;
    }

    .gov-muted {
        color: #4b5563;
        line-height: 1.75;
    }

    .org-flow {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    .org-row {
        display: grid;
        gap: 0.75rem;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .org-node {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 1px solid #bbf7d0;
        border-radius: 14px;
        padding: 0.95rem;
        text-align: center;
        box-shadow: 0 5px 12px rgba(22, 163, 74, 0.08);
    }

    .org-node .title {
        display: block;
        font-weight: 800;
        color: #166534;
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
        background: #f8fef9;
        border: 1px solid #d1fae5;
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
        color: #166534;
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
        background: linear-gradient(135deg, #f0fdf4, #f7fee7);
        border: 1px solid #bbf7d0;
        border-radius: 14px;
        padding: 1rem;
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
        background: #dcfce7;
        color: #166534;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .bpd-item .position {
        margin: 0;
        color: #166534;
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

    @media (max-width: 992px) {
        .org-row,
        .staff-grid,
        .bpd-grid {
            grid-template-columns: 1fr 1fr;
        }

        .gov-hero {
            padding: 2rem;
        }

        .gov-hero h1 {
            font-size: 1.65rem;
        }
    }

    @media (max-width: 768px) {
        .org-row,
        .staff-grid,
        .bpd-grid {
            grid-template-columns: 1fr;
        }

        .gov-page {
            padding-top: 118px;
        }

        .gov-card {
            padding: 1.2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="gov-page">
    <div class="container gov-shell">
        <section class="gov-hero">
            <div class="gov-hero-content">
                <h1>Pemerintahan Desa Sawotratap</h1>
                <p>
                    Halaman ini menyajikan informasi pemerintahan desa dalam satu tampilan terpadu,
                    meliputi Struktur Organisasi, Perangkat Desa, dan BPD.
                </p>
            </div>
        </section>

        <div class="gov-pill-nav">
            <a href="#struktur-organisasi"><i class="bi bi-diagram-3 me-1"></i>Struktur Organisasi</a>
            <a href="#perangkat-desa"><i class="bi bi-people me-1"></i>Perangkat Desa</a>
            <a href="#bpd"><i class="bi bi-building me-1"></i>BPD</a>
        </div>

        <section id="struktur-organisasi" class="gov-card">
            <h2><i class="bi bi-diagram-3"></i>Struktur Organisasi</h2>
            <p class="gov-muted mb-3">
                Susunan jabatan pemerintahan desa ditampilkan secara ringkas sebagai gambaran alur koordinasi
                dan pelaksanaan pelayanan kepada masyarakat.
            </p>

            <div class="org-flow">
                <div class="org-row" style="grid-template-columns: 1fr;">
                    <div class="org-node">
                        <span class="title">Kepala Desa</span>
                        <span class="name">H. Santoso Wibowo</span>
                    </div>
                </div>
                <div class="org-row" style="grid-template-columns: 1fr 1fr;">
                    <div class="org-node">
                        <span class="title">Sekretaris Desa</span>
                        <span class="name">Rina Maharani, S.Sos.</span>
                    </div>
                    <div class="org-node">
                        <span class="title">Kasi Pemerintahan</span>
                        <span class="name">Agus Priyanto</span>
                    </div>
                </div>
                <div class="org-row">
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
        </section>

        <section id="perangkat-desa" class="gov-card">
            <h2><i class="bi bi-people"></i>Perangkat Desa</h2>
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
        </section>

        <section id="bpd" class="gov-card">
            <h2><i class="bi bi-building"></i>Badan Permusyawaratan Desa (BPD)</h2>
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
        </section>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Perizinan - Desa Sawotratap')

@section('styles')
<style>
    .permit-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background:
            linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        position: relative;
        overflow: hidden;
    }

    .permit-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .permit-shell {
        position: relative;
        z-index: 1;
    }

    .permit-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .permit-header .container {
        padding-top: 44px;
        padding-bottom: 44px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        color: #6c757d;
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.08rem;
        line-height: 1.6;
        font-weight: 400;
    }

    .permit-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 1rem;
    }

    .permit-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
    }

    .permit-card .head {
        padding: 22px 24px;
        background: linear-gradient(135deg, rgba(74, 124, 36, 0.12), rgba(45, 80, 22, 0.08));
        border-bottom: 1px solid #e9f0e3;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .permit-card .head h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #24381f;
        margin: 0;
    }

    .permit-body {
        padding: 22px 24px 24px;
        height: 100%;
    }

    .permit-list {
        margin: 0;
        padding-left: 1.1rem;
    }

    .permit-list li {
        margin-bottom: 0.55rem;
        color: #374151;
        line-height: 1.6;
    }

    .service-item {
        border: 1px solid #e5ece0;
        background: #fff;
        border-radius: 14px;
        padding: 0.95rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 5px 16px rgba(45, 80, 22, 0.07);
    }

    .service-item h3 {
        margin: 0 0 0.45rem;
        color: #24381f;
        font-size: 0.98rem;
        font-weight: 700;
    }

    .service-item p {
        margin: 0;
        color: #4b5563;
        font-size: 0.88rem;
        line-height: 1.55;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .meta-box {
        border-radius: 12px;
        border: 1px solid #dce9d2;
        background: #f7fbf3;
        padding: 0.8rem;
    }

    .meta-box .label {
        font-size: 0.75rem;
        color: #355027;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.3rem;
    }

    .meta-box .value {
        color: #22331d;
        font-weight: 700;
        line-height: 1.35;
    }

    .step-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .step-list li {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        align-items: flex-start;
    }

    .step-number {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: #fff;
        font-size: 0.82rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 6px 14px rgba(22, 163, 74, 0.25);
    }

    .step-content h4 {
        margin: 0 0 0.2rem;
        color: #22331d;
        font-size: 0.94rem;
        font-weight: 700;
    }

    .step-content p {
        margin: 0;
        color: #4b5563;
        font-size: 0.86rem;
        line-height: 1.5;
    }

    .faq-item {
        border-top: 1px dashed #dce9d2;
        padding-top: 0.75rem;
        margin-top: 0.75rem;
    }

    .faq-item:first-child {
        border-top: none;
        margin-top: 0;
        padding-top: 0;
    }

    .faq-item h4 {
        margin: 0 0 0.35rem;
        color: #24381f;
        font-size: 0.92rem;
        font-weight: 700;
    }

    .faq-item p {
        margin: 0;
        color: #4b5563;
        font-size: 0.86rem;
        line-height: 1.5;
    }

    .permit-cta {
        margin-top: 1rem;
        border-radius: 16px;
        border: 1px solid #dce9d2;
        background: linear-gradient(135deg, #f7fbf3, #eef5e8);
        padding: 1rem;
    }

    .permit-cta h3 {
        margin: 0 0 0.25rem;
        color: #22331d;
        font-size: 1rem;
        font-weight: 700;
    }

    .permit-cta p {
        margin: 0 0 0.8rem;
        color: #4b5563;
        font-size: 0.9rem;
    }

    .permit-cta .btn {
        border-radius: 10px;
        font-weight: 700;
        padding: 0.58rem 0.95rem;
    }

    @media (max-width: 992px) {
        .permit-grid {
            grid-template-columns: 1fr;
        }

        .permit-header .container {
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

    @media (max-width: 576px) {
        .meta-grid {
            grid-template-columns: 1fr;
        }

        .permit-page {
            padding-bottom: 40px;
        }

        .permit-card .head,
        .permit-body {
            padding: 18px;
        }
    }
</style>
@endsection

@section('content')
@php
    $permitServices = [
        [
            'name' => 'Izin Keramaian Kegiatan Warga',
            'desc' => 'Untuk kegiatan hajatan, pentas seni, pengajian besar, atau acara warga lainnya yang membutuhkan surat pengantar desa.',
        ],
        [
            'name' => 'Izin Usaha Mikro',
            'desc' => 'Layanan pengantar perizinan untuk usaha rumahan, kuliner, kerajinan, dan jasa skala mikro agar legalitas usaha lebih tertib.',
        ],
        [
            'name' => 'Izin Penggunaan Fasilitas Desa',
            'desc' => 'Pengajuan pemakaian balai desa atau fasilitas umum desa untuk rapat, pelatihan, atau kegiatan komunitas.',
        ],
        [
            'name' => 'Rekomendasi Kegiatan Sosial',
            'desc' => 'Surat rekomendasi desa untuk kegiatan bakti sosial, pengumpulan donasi, atau program kemasyarakatan lintas RT/RW.',
        ],
    ];
@endphp

<div class="permit-page">
    <div class="permit-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Perizinan</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="permit-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Layanan Perizinan Desa</h1>
                <p class="hero-subtitle">
                    Halaman ini memuat jenis perizinan yang difasilitasi Pemerintah Desa Sawotratap,
                    beserta alur pengajuan, syarat dokumen, dan estimasi waktu layanan.
                </p>
            </div>
        </div>
    </section>

    <div class="container permit-shell section-wrap pt-4">
        <div class="permit-grid">
            <div class="d-grid gap-3">
                <section class="permit-card">
                    <div class="head">
                        <i class="bi bi-folder2-open"></i>
                        <h2>Jenis Layanan Perizinan</h2>
                    </div>
                    <div class="permit-body">
                    @foreach($permitServices as $service)
                        <article class="service-item">
                            <h3>{{ $service['name'] }}</h3>
                            <p>{{ $service['desc'] }}</p>
                        </article>
                    @endforeach
                    </div>
                </section>

                <section class="permit-card">
                    <div class="head">
                        <i class="bi bi-diagram-3"></i>
                        <h2>Alur Pengajuan</h2>
                    </div>
                    <div class="permit-body">
                    <ol class="step-list">
                        <li>
                            <span class="step-number">1</span>
                            <div class="step-content">
                                <h4>Persiapan Berkas</h4>
                                <p>Siapkan KTP, KK, dan dokumen pendukung sesuai jenis perizinan yang diajukan.</p>
                            </div>
                        </li>
                        <li>
                            <span class="step-number">2</span>
                            <div class="step-content">
                                <h4>Ajukan Permohonan</h4>
                                <p>Warga datang ke kantor desa atau menghubungi petugas layanan untuk registrasi pengajuan.</p>
                            </div>
                        </li>
                        <li>
                            <span class="step-number">3</span>
                            <div class="step-content">
                                <h4>Verifikasi Data</h4>
                                <p>Petugas memeriksa kelengkapan berkas dan melakukan validasi administrasi.</p>
                            </div>
                        </li>
                        <li>
                            <span class="step-number">4</span>
                            <div class="step-content">
                                <h4>Penerbitan Surat</h4>
                                <p>Surat izin/rekomendasi diterbitkan dan dapat diambil sesuai jadwal yang ditentukan.</p>
                            </div>
                        </li>
                    </ol>
                    </div>
                </section>
            </div>

            <div class="d-grid gap-3">
                <section class="permit-card">
                    <div class="head">
                        <i class="bi bi-card-checklist"></i>
                        <h2>Persyaratan Umum</h2>
                    </div>
                    <div class="permit-body">
                        <ul class="permit-list">
                            <li>Fotokopi KTP pemohon (masih berlaku).</li>
                            <li>Fotokopi Kartu Keluarga.</li>
                            <li>Surat pengantar RT/RW (jika diperlukan).</li>
                            <li>Dokumen pendukung sesuai jenis izin.</li>
                            <li>Nomor kontak aktif untuk konfirmasi.</li>
                        </ul>
                    </div>
                </section>

                <section class="permit-card">
                    <div class="head">
                        <i class="bi bi-clock-history"></i>
                        <h2>Informasi Layanan</h2>
                    </div>
                    <div class="permit-body">
                        <div class="meta-grid">
                            <div class="meta-box">
                                <div class="label">Estimasi Waktu</div>
                                <div class="value">1 - 3 Hari Kerja</div>
                            </div>
                            <div class="meta-box">
                                <div class="label">Jam Layanan</div>
                                <div class="value">Senin - Jumat, 08.00 - 14.00</div>
                            </div>
                            <div class="meta-box">
                                <div class="label">Lokasi</div>
                                <div class="value">Kantor Desa Sawotratap</div>
                            </div>
                            <div class="meta-box">
                                <div class="label">Biaya</div>
                                <div class="value">Sesuai ketentuan yang berlaku</div>
                            </div>
                        </div>

                        <div class="permit-cta">
                            <h3>Butuh surat administratif lain?</h3>
                            <p>Gunakan layanan pengajuan surat online untuk kebutuhan surat keterangan umum warga.</p>
                            <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-success">
                                <i class="bi bi-send me-1"></i> Buka Pengajuan Surat
                            </a>
                        </div>
                    </div>
                </section>

                <section class="permit-card">
                    <div class="head">
                        <i class="bi bi-question-circle"></i>
                        <h2>Tanya Jawab Singkat</h2>
                    </div>
                    <div class="permit-body">
                        <div class="faq-item">
                            <h4>Apakah bisa diwakilkan?</h4>
                            <p>Bisa, dengan membawa surat kuasa sederhana dan identitas pemberi serta penerima kuasa.</p>
                        </div>
                        <div class="faq-item">
                            <h4>Bagaimana jika berkas belum lengkap?</h4>
                            <p>Petugas akan memberikan catatan kekurangan, dan pemohon dapat melengkapi tanpa mengulang dari awal.</p>
                        </div>
                        <div class="faq-item">
                            <h4>Apakah ada layanan percepatan?</h4>
                            <p>Untuk kondisi mendesak, silakan konsultasi langsung dengan petugas layanan desa.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
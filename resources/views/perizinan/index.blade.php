@extends('layouts.app')

@section('title', 'Perizinan - Desa Sawotratap')

@section('styles')
<style>
    .permit-page {
        padding-top: 138px;
        padding-bottom: 56px;
        min-height: 100vh;
        background:
            radial-gradient(circle at 12% 12%, rgba(20, 184, 166, 0.11), transparent 32%),
            radial-gradient(circle at 88% 18%, rgba(34, 197, 94, 0.11), transparent 34%),
            linear-gradient(180deg, #f3fbf7 0%, #f8fffc 100%);
        position: relative;
        overflow: hidden;
    }

    .permit-shell {
        position: relative;
        z-index: 1;
    }

    .permit-hero {
        border-radius: 22px;
        padding: 2rem;
        margin-bottom: 1.2rem;
        color: #fff;
        background: linear-gradient(135deg, #0f766e 0%, #15803d 55%, #22c55e 100%);
        box-shadow: 0 18px 36px rgba(15, 118, 110, 0.26);
        position: relative;
        overflow: hidden;
    }

    .permit-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.11) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.11) 1px, transparent 1px);
        background-size: 28px 28px;
        opacity: 0.24;
    }

    .permit-hero-content {
        position: relative;
        z-index: 1;
    }

    .permit-hero h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .permit-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.92);
        max-width: 760px;
    }

    .permit-chip-wrap {
        margin-top: 1rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.55rem;
    }

    .permit-chip {
        border: 1px solid rgba(255, 255, 255, 0.34);
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
        border-radius: 999px;
        padding: 0.4rem 0.8rem;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .permit-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 1rem;
    }

    .permit-card {
        background: #fff;
        border: 1px solid #d1fae5;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
        padding: 1.2rem;
        height: 100%;
    }

    .permit-card h2 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #166534;
        margin-bottom: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.45rem;
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
        border: 1px solid #d1fae5;
        background: #f7fffb;
        border-radius: 14px;
        padding: 0.95rem;
        margin-bottom: 0.75rem;
    }

    .service-item h3 {
        margin: 0 0 0.45rem;
        color: #065f46;
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
        border: 1px solid #bbf7d0;
        background: #ecfdf5;
        padding: 0.8rem;
    }

    .meta-box .label {
        font-size: 0.75rem;
        color: #166534;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.3rem;
    }

    .meta-box .value {
        color: #14532d;
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
        color: #14532d;
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
        border-top: 1px dashed #bbf7d0;
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
        color: #166534;
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
        border: 1px solid #a7f3d0;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        padding: 1rem;
    }

    .permit-cta h3 {
        margin: 0 0 0.25rem;
        color: #14532d;
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

        .permit-page {
            padding-top: 130px;
        }
    }

    @media (max-width: 576px) {
        .meta-grid {
            grid-template-columns: 1fr;
        }

        .permit-hero {
            padding: 1.5rem;
        }

        .permit-hero h1 {
            font-size: 1.6rem;
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
    <div class="container permit-shell">
        <section class="permit-hero">
            <div class="permit-hero-content">
                <h1>Layanan Perizinan Desa</h1>
                <p>
                    Halaman ini memuat jenis perizinan yang difasilitasi Pemerintah Desa Sawotratap,
                    beserta alur pengajuan, syarat dokumen, dan estimasi waktu layanan.
                </p>
                <div class="permit-chip-wrap">
                    <span class="permit-chip">Transparan</span>
                    <span class="permit-chip">Cepat</span>
                    <span class="permit-chip">Akuntabel</span>
                    <span class="permit-chip">Ramah Warga</span>
                </div>
            </div>
        </section>

        <div class="permit-grid">
            <div class="d-grid gap-3">
                <section class="permit-card">
                    <h2><i class="bi bi-folder2-open"></i> Jenis Layanan Perizinan</h2>
                    @foreach($permitServices as $service)
                        <article class="service-item">
                            <h3>{{ $service['name'] }}</h3>
                            <p>{{ $service['desc'] }}</p>
                        </article>
                    @endforeach
                </section>

                <section class="permit-card">
                    <h2><i class="bi bi-diagram-3"></i> Alur Pengajuan</h2>
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
                </section>
            </div>

            <div class="d-grid gap-3">
                <section class="permit-card">
                    <h2><i class="bi bi-card-checklist"></i> Persyaratan Umum</h2>
                    <ul class="permit-list">
                        <li>Fotokopi KTP pemohon (masih berlaku).</li>
                        <li>Fotokopi Kartu Keluarga.</li>
                        <li>Surat pengantar RT/RW (jika diperlukan).</li>
                        <li>Dokumen pendukung sesuai jenis izin.</li>
                        <li>Nomor kontak aktif untuk konfirmasi.</li>
                    </ul>
                </section>

                <section class="permit-card">
                    <h2><i class="bi bi-clock-history"></i> Informasi Layanan</h2>
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
                </section>

                <section class="permit-card">
                    <h2><i class="bi bi-question-circle"></i> Tanya Jawab Singkat</h2>
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
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
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
        grid-template-columns: 1.4fr 1fr;
        gap: 1.4rem;
        align-items: start;
    }

    .permit-card {
        background: #f8fdf5;
        border: 1px solid rgba(34, 139, 80, 0.14);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(31, 59, 27, 0.08);
    }

    .permit-card .permit-body {
        background: transparent;
    }

    .permit-list {
        margin: 0;
        padding-left: 0;
        list-style: none;
    }

    .permit-list li {
        position: relative;
        margin-bottom: 1rem;
        padding-left: 1.55rem;
        color: #2f4d2f;
        line-height: 1.8;
        font-weight: 500;
    }

    .permit-list li::before {
        content: '\2022';
        position: absolute;
        left: 0;
        top: 0.25rem;
        color: #16a34a;
        font-size: 1.6rem;
        line-height: 1;
    }

    .permit-card .head,
    .section-block .head,
    .permit-form .head {
        padding: 16px 22px;
        background: #f5faf5;
        border-bottom: 1px solid #e5ece0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .permit-card .head h2,
    .section-block .head h2,
    .permit-form .head h2 {
        font-size: 1.35rem;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        line-height: 1.28;
    }

    .permit-card .head i,
    .section-block .head i,
    .permit-form .head i {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #d6f0d6;
        color: #166534;
        font-size: 1.2rem;
    }

    .permit-body,
    .permit-form .permit-body {
        padding: 26px;
    }

    .section-block {
        background: transparent;
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .section-block .head {
        background: transparent;
        border-bottom: none;
        padding-left: 0;
    }

    .user-flow {
        position: relative;
        display: grid;
        gap: 1.5rem;
        padding-left: 0;
    }

    .user-flow::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 12px;
        bottom: 12px;
        width: 2px;
        background: rgba(34, 139, 80, 0.18);
        border-radius: 1px;
    }

    .user-flow-step {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        position: relative;
    }

    .step-badge {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #1f3b1b;
        color: #fff;
        font-size: 0.95rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
        border: 3px solid #f8fbf7;
        box-shadow: 0 0 0 4px rgba(255,255,255,0.7);
    }

    .user-flow-step .step-content {
        position: relative;
        z-index: 1;
    }

    .step-content h4 {
        margin: 0 0 0.35rem;
        color: #1f3b1b;
        font-size: 1rem;
        font-weight: 700;
    }

    .step-content p {
        margin: 0;
        color: #4b5563;
        font-size: 0.92rem;
        line-height: 1.65;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.85rem;
    }

    .meta-box {
        border-radius: 16px;
        border: 1px solid #d6e8d7;
        background: #f7fbf5;
        padding: 1rem;
    }

    .meta-box .label {
        font-size: 0.75rem;
        color: #2f4d2f;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.35rem;
    }

    .meta-box .value {
        color: #1f3b1b;
        font-weight: 700;
        line-height: 1.5;
    }

    .step-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .step-list li {
        display: grid;
        grid-template-columns: 40px 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
        align-items: start;
    }

    .step-number {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #1f3b1b;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .step-content h4 {
        margin: 0 0 0.3rem;
        color: #1f3b1b;
        font-size: 1rem;
        font-weight: 700;
    }

    .step-content p {
        margin: 0;
        color: #4b5563;
        font-size: 0.92rem;
        line-height: 1.7;
    }

    .permit-cta {
        margin-top: 1rem;
        border-radius: 18px;
        border: 1px solid #cfe5d0;
        background: #f4fbf6;
        padding: 1.15rem 1rem;
    }

    .permit-cta h3 {
        margin: 0 0 0.35rem;
        color: #1f3b1b;
        font-size: 1rem;
        font-weight: 700;
    }

    .permit-cta p {
        margin: 0 0 0.85rem;
        color: #4b5563;
        font-size: 0.93rem;
        line-height: 1.6;
    }

    .permit-cta .btn {
        border-radius: 12px;
        font-weight: 700;
        padding: 0.65rem 1rem;
    }

    .permit-form {
        background: #fff;
        border: 1px solid #d9e4d6;
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
    }

    .permit-form .head {
        padding: 20px 24px;
        background: #f5faf5;
        border-bottom: 1px solid #e5ece0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .permit-form .head h2 {
        font-size: 1.25rem;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #1f3b1b;
        margin: 0;
        line-height: 1.2;
    }

    .permit-form .head i {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #d6f0d6;
        color: #166534;
        font-size: 1.2rem;
    }

    .permit-form .permit-body {
        padding: 30px;
    }

    .permit-form .form-control,
    .permit-form .form-select,
    .permit-form textarea.form-control {
        border-radius: 14px;
        border-color: #d1ddce;
        min-height: 48px;
        box-shadow: none;
    }

    .permit-form .form-control:focus,
    .permit-form .form-select:focus,
    .permit-form textarea.form-control:focus {
        border-color: #78b082;
        box-shadow: 0 0 0 0.15rem rgba(34, 140, 80, 0.12);
    }

    .permit-form .form-label {
        font-weight: 700;
        color: #22331d;
    }

    .permit-form .form-text {
        color: #5a6b58;
    }

    .permit-form .btn-submit {
        border-radius: 14px;
        padding: 0.75rem 1.5rem;
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
                    Halaman ini menampilkan alur pengajuan perizinan desa, syarat dokumen, dan informasi waktu layanan agar proses lebih mudah dan teratur.
                </p>
            </div>
        </div>
    </section>

    <div class="container permit-shell section-wrap pt-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; margin-bottom: 2rem;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; margin-bottom: 2rem;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="permit-grid">
            <section class="section-block">
                <div class="head">
                    <i class="bi bi-diagram-3"></i>
                    <h2>Alur Pengajuan</h2>
                </div>
                <div class="permit-body">
                    <div class="user-flow">
                        <div class="user-flow-step">
                            <span class="step-badge">1</span>
                            <div class="step-content">
                                <h4>Persiapan Berkas</h4>
                                <p>Siapkan KTP, KK, dan dokumen pendukung sesuai jenis perizinan yang diajukan.</p>
                            </div>
                        </div>
                        <div class="user-flow-step">
                            <span class="step-badge">2</span>
                            <div class="step-content">
                                <h4>Ajukan Permohonan</h4>
                                <p>Datang langsung ke kantor desa atau ajukan melalui petugas layanan desa.</p>
                            </div>
                        </div>
                        <div class="user-flow-step">
                            <span class="step-badge">3</span>
                            <div class="step-content">
                                <h4>Verifikasi Data</h4>
                                <p>Petugas memeriksa kelengkapan berkas dan melakukan validasi administrasi.</p>
                            </div>
                        </div>
                        <div class="user-flow-step">
                            <span class="step-badge">4</span>
                            <div class="step-content">
                                <h4>Penerbitan Surat</h4>
                                <p>Surat izin diterbitkan dan bisa diambil sesuai jadwal yang disepakati.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="permit-card">
                <div class="head">
                    <i class="bi bi-card-checklist"></i>
                    <h2>Persyaratan Umum</h2>
                </div>
                <div class="permit-body">
                    <ul class="permit-list">
                        <li>Fotokopi KTP pemohon (masih berlaku).</li>
                        <li>Fotokopi Kartu Keluarga.</li>
                        <li>Surat pengantar RT/RW bila diminta.</li>
                        <li>Dokumen pendukung sesuai jenis izin.</li>
                        <li>Nomor kontak aktif untuk konfirmasi.</li>
                    </ul>
                </div>
            </section>
        </div>

        <!-- Form Pengajuan -->
        <div class="permit-form mt-4" id="form-pengajuan">
            <div class="head">
                <i class="bi bi-pencil-square"></i>
                <h2>Formulir Pengajuan Perizinan</h2>
            </div>
            <div class="permit-body">
                @auth
                <form action="{{ route('perizinan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Pemohon</label>
                            <input type="text" name="nama_pemohon" class="form-control" value="{{ old('nama_pemohon', Auth::user()->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NIK</label>
                            <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required maxlength="16" minlength="16">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Jenis Izin yang Diajukan</label>
                            <select name="jenis_izin" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Jenis Izin --</option>
                                @foreach($permitServices as $service)
                                    <option value="{{ $service['name'] }}" {{ old('jenis_izin') == $service['name'] ? 'selected' : '' }}>{{ $service['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Keterangan / Keperluan</label>
                            <textarea name="keterangan" class="form-control" rows="4" required placeholder="Jelaskan secara detail keperluan dan informasi pendukung untuk perizinan Anda...">{{ old('keterangan') }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Lampiran Berkas (Opsional)</label>
                            <input type="file" name="lampiran" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, PNG. Maksimal 5MB. (Misal: KTP, Surat Pengantar RT/RW, Proposal, dll)</small>
                        </div>
                        <div class="col-md-12 mt-4 text-end">
                            <button type="submit" class="btn btn-success btn-submit px-4 fw-bold">
                                <i class="bi bi-send me-1"></i> Kirim Pengajuan Perizinan
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-shield-lock text-muted fs-1 d-block mb-3"></i>
                    <h5 class="fw-bold">Anda harus login terlebih dahulu</h5>
                    <p class="text-muted">Untuk mengajukan perizinan, warga diwajibkan untuk masuk menggunakan akun terdaftar agar data dapat divalidasi dengan aman.</p>
                    <a href="{{ route('login') }}" class="btn btn-success mt-2 px-4">Login Sekarang</a>
                </div>
                @endauth
            </div>
        </div>

        <section class="permit-card mt-4">
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
                    <h3>Perizinan lebih mudah dengan data lengkap</h3>
                    <p>Pastikan semua dokumen sudah siap sebelum mengisi formulir agar proses berjalan lancar.</p>
                    <a href="#form-pengajuan" class="btn btn-success">
                        <i class="bi bi-pencil-square me-1"></i> Buka Formulir Perizinan
                    </a>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
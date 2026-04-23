@extends('layouts.app')

@section('title', 'Pengaduan Infrastruktur - Desa Sawotratap')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}">
<style>
    .complaint-page {
        margin-top: 0;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        min-height: 100vh;
        padding-bottom: 70px;
    }

    .complaint-breadcrumb {
        margin-top: 80px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .complaint-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e8ecef;
    }

    .complaint-header .container {
        padding-top: 44px;
        padding-bottom: 44px;
    }

    .hero-content-box {
        padding: 0;
        margin-bottom: 2.1rem;
        position: relative;
        z-index: 2;
    }

    .hero-kicker .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary-green);
        animation: pulse 2s infinite ease-in-out;
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

    .hero-stat-grid {
        margin-top: 26px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .hero-stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        border: 1px solid #dde7d6;
        box-shadow: 0 6px 18px rgba(45, 80, 22, 0.06);
        text-align: center;
        transition: all 0.3s ease;
    }

    .hero-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(45, 80, 22, 0.12);
    }

    .hero-stat-number {
        display: block;
        font-family: 'Sora', sans-serif;
        color: var(--primary-green);
        font-size: 1.7rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .hero-stat-label {
        margin-top: 6px;
        display: block;
        color: #5e6d64;
        font-size: 0.88rem;
        font-weight: 500;
    }

    .section-wrap {
        padding-top: 32px;
    }

    .infra-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .infra-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5ece0;
        box-shadow: 0 5px 16px rgba(45, 80, 22, 0.07);
        padding: 20px;
        transition: all 0.3s ease;
    }

    .infra-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(45, 80, 22, 0.14);
        border-color: #b6d0a3;
    }

    .infra-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: #fff;
        font-size: 1.18rem;
        margin-bottom: 12px;
    }

    .infra-title {
        font-family: 'Sora', sans-serif;
        font-size: 1.03rem;
        font-weight: 700;
        color: #22331d;
        margin-bottom: 8px;
    }

    .infra-desc {
        margin: 0;
        color: #5c6a62;
        line-height: 1.6;
        font-size: 0.92rem;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 20px;
    }

    .panel-card {
        background: #fff;
        border: 1px solid #e4ecdf;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(45, 80, 22, 0.08);
        overflow: hidden;
    }

    .panel-head {
        padding: 22px 24px;
        background: linear-gradient(135deg, rgba(74, 124, 36, 0.12), rgba(45, 80, 22, 0.08));
        border-bottom: 1px solid #e9f0e3;
    }

    .panel-title {
        margin: 0;
        font-family: 'Sora', sans-serif;
        color: #24381f;
        font-size: 1.23rem;
        font-weight: 700;
    }

    .panel-subtitle {
        margin: 8px 0 0;
        color: #5c6a62;
        font-size: 0.92rem;
    }

    .panel-body {
        padding: 22px 24px 24px;
    }

    .form-label {
        color: #2c4225;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border-radius: 11px;
        border: 1px solid #c9d8c1;
        padding: 0.7rem 0.86rem;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--light-green);
        box-shadow: 0 0 0 0.2rem rgba(74, 124, 36, 0.2);
    }

    .hint-inline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        background: #eef5e8;
        border: 1px solid #dce9d2;
        color: #355027;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 8px 12px;
    }

    .btn-submit-complaint {
        width: 100%;
        border: 0;
        border-radius: 12px;
        padding: 12px 16px;
        color: #fff;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        box-shadow: 0 10px 22px rgba(45, 80, 22, 0.25);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-submit-complaint:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(45, 80, 22, 0.3);
    }

    .btn-submit-complaint::after {
        content: '';
        position: absolute;
        top: -40%;
        left: -30%;
        width: 26%;
        height: 180%;
        background: rgba(255, 255, 255, 0.24);
        transform: rotate(20deg);
        transition: left 0.55s ease;
    }

    .btn-submit-complaint:hover::after {
        left: 110%;
    }

    .checklist {
        display: grid;
        gap: 10px;
    }

    .check-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border: 1px dashed #d4e2ca;
        border-radius: 12px;
        padding: 12px;
        color: #4d5f54;
        font-size: 0.92rem;
    }

    .timeline-list {
        display: grid;
        gap: 12px;
    }

    .timeline-item {
        border: 1px solid #e3ebde;
        border-radius: 12px;
        padding: 14px;
        background: #fff;
        transition: all 0.25s ease;
    }

    .timeline-item:hover {
        transform: translateY(-3px);
        border-color: #b8d1a8;
        box-shadow: 0 10px 20px rgba(45, 80, 22, 0.1);
    }

    .ticket {
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #5d7762;
        font-weight: 700;
    }

    .report-meta {
        margin-top: 10px;
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .meta-pill {
        font-size: 0.74rem;
        border-radius: 999px;
        padding: 6px 10px;
        background: #eff6eb;
        color: #305030;
        font-weight: 600;
    }

    .empty-state {
        border: 1px dashed #cddfc0;
        background: #f7fbf3;
        border-radius: 12px;
        padding: 14px;
        color: #54655a;
        font-size: 0.92rem;
    }

    .is-reveal {
        opacity: 0;
        transform: translateY(18px);
        transition: all 0.55s ease;
    }

    .is-reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 1199.98px) {
        .infra-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .complaint-page {
            padding-bottom: 40px;
        }

        .complaint-header .container {
            padding-top: 34px;
            padding-bottom: 34px;
        }

        .hero-content-box {
            margin-bottom: 1.4rem;
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

        .hero-stat-grid {
            grid-template-columns: 1fr;
        }

        .infra-grid {
            grid-template-columns: 1fr;
        }

        .panel-head,
        .panel-body {
            padding: 18px;
        }
    }
</style>
@endsection

@section('content')
<div class="complaint-page">
    <div class="complaint-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pengaduan Infrastruktur</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="complaint-header py-5">
        <div class="container">
            <div class="hero-content-box text-center is-reveal">
                <h1 class="section-title-center hero-title">Pengaduan Infrastruktur</h1>
                <p class="hero-subtitle">
                    Sampaikan laporan kerusakan fasilitas umum secara online agar tim desa dapat
                    menindaklanjuti dengan cepat dan tepat.
                </p>
            </div>

            <div class="hero-stat-grid">
                <div class="hero-stat-card is-reveal">
                    <span class="hero-stat-number js-counter" data-target="{{ $reports->count() }}">0</span>
                    <span class="hero-stat-label">Laporan Tercatat</span>
                </div>
                <div class="hero-stat-card is-reveal">
                    <span class="hero-stat-number js-counter" data-target="{{ count($infrastrukturTypes) }}">0</span>
                    <span class="hero-stat-label">Kategori Infrastruktur</span>
                </div>
                <div class="hero-stat-card is-reveal">
                    <span class="hero-stat-number js-counter" data-target="24">0</span>
                    <span class="hero-stat-label">Target Respon Awal (Jam)</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section-wrap">
        <div class="container">
            <div class="infra-grid">
                @foreach($infrastrukturTypes as $item)
                <article class="infra-card is-reveal" data-delay="{{ $loop->index * 90 }}">
                    <div class="infra-icon">
                        <i class="bi {{ $item['icon'] }}"></i>
                    </div>
                    <h3 class="infra-title">{{ $item['title'] }}</h3>
                    <p class="infra-desc">{{ $item['description'] }}</p>
                </article>
                @endforeach
            </div>

            <div class="content-grid">
                <div class="panel-card is-reveal" data-delay="120">
                    <div class="panel-head">
                        <h2 class="panel-title">Form Laporan Pengaduan</h2>
                        <p class="panel-subtitle">Semakin lengkap data yang Anda isi, semakin cepat laporan dapat diverifikasi.</p>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="border-radius: 12px;">
                                <strong>Periksa kembali data Anda:</strong>
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="complaintForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Pelapor</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Ahmad Fauzi" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_whatsapp" class="form-label">Nomor WhatsApp</label>
                                    <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="08xxxxxxxxxx" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label">Jenis Pengaduan</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">Pilih jenis pengaduan</option>
                                        @foreach(['Jalan Rusak', 'Lampu Jalan Mati', 'Drainase & Banjir', 'Fasilitas Umum', 'Lainnya'] as $kategori)
                                            <option value="{{ $kategori }}" {{ old('kategori') === $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tingkat_urgensi" class="form-label">Tingkat Urgensi</label>
                                    <select class="form-select" id="tingkat_urgensi" name="tingkat_urgensi" required>
                                        <option value="">Pilih urgensi</option>
                                        @foreach(['Rendah', 'Sedang', 'Tinggi'] as $urgensi)
                                            <option value="{{ $urgensi }}" {{ old('tingkat_urgensi') === $urgensi ? 'selected' : '' }}>{{ $urgensi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="lokasi" class="form-label">Lokasi Kejadian</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: RT 03/RW 02 depan Masjid Al-Ikhlas" required>
                                </div>
                                <div class="col-12">
                                    <label for="waktu_kejadian" class="form-label">Waktu Kejadian (Opsional)</label>
                                    <input type="datetime-local" class="form-control" id="waktu_kejadian" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}">
                                </div>
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">Deskripsi Laporan</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan kondisi kerusakan, dampak, dan situasi terkini..." required>{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="lampiran" class="form-label">Lampiran Foto (Opsional)</label>
                                    <input type="file" class="form-control" id="lampiran" name="lampiran" accept="image/*">
                                    <div class="form-text">Maksimal 4MB. Format: JPG, PNG, WEBP.</div>
                                </div>
                                <div class="col-12">
                                    <span class="hint-inline"><i class="bi bi-shield-check"></i> Data dipakai untuk verifikasi dan tindak lanjut laporan.</span>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="setuju" name="setuju" {{ old('setuju') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="setuju">
                                            Saya menyatakan laporan ini sesuai kondisi sebenarnya.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-submit-complaint" id="submitComplaintBtn">
                                        <i class="bi bi-send-fill me-2"></i>Kirim Laporan Pengaduan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <div class="panel-card is-reveal" data-delay="220">
                        <div class="panel-head">
                            <h2 class="panel-title">Panduan Pelaporan</h2>
                            <p class="panel-subtitle">Ikuti checklist singkat agar laporan Anda cepat diproses.</p>
                        </div>
                        <div class="panel-body">
                            <div class="checklist">
                                <div class="check-item"><i class="bi bi-check2-circle text-success"></i><div>Jelaskan titik lokasi secara spesifik (RT/RW atau patokan tempat).</div></div>
                                <div class="check-item"><i class="bi bi-check2-circle text-success"></i><div>Uraikan dampak kerusakan terhadap aktivitas warga.</div></div>
                                <div class="check-item"><i class="bi bi-check2-circle text-success"></i><div>Lampirkan foto kondisi terbaru agar validasi lebih cepat.</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-card is-reveal" data-delay="280">
                        <div class="panel-head">
                            <h2 class="panel-title">Laporan Terbaru Warga</h2>
                            <p class="panel-subtitle">Ringkasan laporan terbaru untuk transparansi layanan.</p>
                        </div>
                        <div class="panel-body">
                            @if($reports->isEmpty())
                                <div class="empty-state">
                                    Belum ada laporan yang masuk. Anda bisa jadi pelapor pertama untuk membantu perbaikan infrastruktur desa.
                                </div>
                            @else
                                <div class="timeline-list">
                                    @foreach($reports as $report)
                                    <article class="timeline-item">
                                        <div class="ticket">{{ $report['ticket'] }}</div>
                                        <h3 class="mb-1" style="font-size: 1rem; color: #233720; font-weight: 700;">{{ $report['kategori'] }} - {{ $report['lokasi'] }}</h3>
                                        <p class="mb-2" style="color: #5c6a62; font-size: 0.9rem;">{{ \Illuminate\Support\Str::limit($report['deskripsi'], 120) }}</p>
                                        <div class="report-meta">
                                            <span class="meta-pill"><i class="bi bi-person-circle me-1"></i>{{ $report['nama'] }}</span>
                                            <span class="meta-pill"><i class="bi bi-flag me-1"></i>{{ $report['urgensi'] }}</span>
                                            <span class="meta-pill"><i class="bi bi-clock me-1"></i>{{ $report['submitted_at'] }}</span>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revealElements = document.querySelectorAll('.is-reveal');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const delay = Number(entry.target.dataset.delay || 0);
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, delay);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14 });

        revealElements.forEach((el) => revealObserver.observe(el));

        const counters = document.querySelectorAll('.js-counter');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const el = entry.target;
                const target = Number(el.dataset.target || 0);
                const duration = 1100;
                const start = performance.now();

                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    el.textContent = Math.floor(progress * target).toLocaleString('id-ID');
                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    } else {
                        el.textContent = target.toLocaleString('id-ID');
                    }
                };

                requestAnimationFrame(tick);
                counterObserver.unobserve(el);
            });
        }, { threshold: 0.6 });

        counters.forEach((counter) => counterObserver.observe(counter));

        const form = document.getElementById('complaintForm');
        const submitBtn = document.getElementById('submitComplaintBtn');
        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim Laporan...';
            });
        }
    });
</script>
@endpush

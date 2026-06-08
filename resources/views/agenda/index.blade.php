@extends('layouts.app')

@section('title', 'Agenda Desa - Desa Sawotratap')

@section('styles')
<style>
    /* Typography aligned with announcements */
    .agenda-page {
        margin-top: 0;
        padding-bottom: 70px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fbf7 0%, #f4f7fa 100%);
        font-family: 'Inter', 'Sora', sans-serif;
        color: #243129;
    }

    .agenda-header { background: #f8f9fa; border-bottom: 1px solid #e8ecef; }
    .agenda-header .container { padding-top:24px; padding-bottom:34px; }
    
    .agenda-breadcrumb { margin-top:60px; background:#f8f9fa; border-bottom:1px solid #e8ecef; }
    .hero-title { font-size:2.5rem; line-height:1.15; margin-bottom:6px; font-family:'Playfair Display', 'Sora', serif; font-weight:700; color:#1a1a1a !important; }
    .agenda-page .hero-subtitle { background: none !important; -webkit-background-clip: unset !important; background-clip: unset !important; -webkit-text-fill-color: unset !important; color:#5e6d64 !important; font-weight:400 !important; font-size:1.08rem !important; line-height:1.6 !important; margin-top:0.25rem !important; max-width:760px; margin:0 auto; }
    
    .agenda-page h2 { font-family:'Playfair Display', 'Sora', serif; color:#1a1a1a; }

    .agenda-stats { margin-top:28px; display:grid; grid-template-columns:repeat(3, minmax(0,1fr)); gap:14px; }
    .agenda-stat-card { background:#fff; border-radius:14px; padding:16px; border:1px solid #dde7d6; box-shadow:0 6px 18px rgba(45,80,22,0.06); text-align:center; }
    .agenda-stat-number { font-size:1.9rem; font-weight:800; display:block; color:#22331d; line-height:1.1; }
    .agenda-stat-label { font-size:0.88rem; margin-top:5px; color:#5e6d64; font-weight:500; }

    .agenda-grid { display:grid; grid-template-columns:1.45fr 0.95fr; gap:1.15rem; align-items:start; }

    /* keep agenda-card for right column */
    .agenda-card { background:rgba(255,255,255,0.92); border:1px solid #e4ecdf; border-radius:22px; box-shadow:0 12px 32px rgba(45,80,22,0.1); overflow:hidden; }
    .agenda-card .head { padding:18px 22px; background:linear-gradient(135deg, rgba(74,124,36,0.12), rgba(45,80,22,0.06)); border-bottom:1px solid #e9f0e3; display:flex; gap:.55rem; align-items:center; }
    .agenda-card .head h2 { margin:0; font-weight:700; font-size:1.25rem; }
    .agenda-body { padding:20px; }

    /* Timeline numbered style for Urutan Pelaksanaan */
    .agenda-timeline-flow {
        position: relative;
        display: grid;
        gap: 1.8rem;
        padding-left: 50px;
    }

    .agenda-timeline-flow::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 12px;
        bottom: 12px;
        width: 2px;
        background: rgba(34, 139, 80, 0.15);
        border-radius: 1px;
    }

    .timeline-step {
        display: flex;
        gap: 1.2rem;
        align-items: flex-start;
        position: relative;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #1f3b1b;
        color: #fff;
        font-weight: 700;
        font-size: 1.05rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
        border: 3px solid #f8fbf7;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.7);
        flex-shrink: 0;
    }

    .step-text h4 {
        margin: 0 0 0.4rem;
        color: #1a1a1a;
        font-weight: 700;
        font-size: 1.05rem;
        font-family: 'Playfair Display', 'Sora', serif;
    }

    .step-text p {
        margin: 0;
        color: #5e6d64;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .agenda-shell { background: #fff; }\n    .agenda-shell .container { padding-top: 20px; padding-bottom: 20px; }

    /* Announcement-style list for Agenda Mendatang (left column) */
    .agenda-list .head { padding:0; margin-bottom:20px; display:flex; gap:.6rem; align-items:center; }\n    .agenda-list h2 { margin:0; font-weight:700; font-size:1.25rem; font-family:'Playfair Display', 'Sora', serif; }
    .agenda-list-item { background:#fff; border-radius:14px; border:1px solid #e4ecdf; padding:16px; margin-bottom:12px; box-shadow:0 10px 22px rgba(45,80,22,0.06); transition:transform .22s ease; }
    .agenda-list-item:hover { transform:translateY(-6px); box-shadow:0 20px 42px rgba(45,80,22,0.12); }
    .agenda-list-item h3 { margin:0 0 .5rem; color:#1a1a1a; font-weight:700; font-size:1.05rem; font-family:'Playfair Display', 'Sora', serif; }
    .agenda-list-item .summary { margin-top:6px; color:#5e6d64; font-size:0.94rem; }
    .agenda-list-item .view-more { margin-top:10px; }

    .agenda-pill { border-radius:999px; padding:.28rem .55rem; background:#eef5e8; color:#355027; font-weight:700; font-size:.78rem; }
    
    .agenda-side-box { border-radius:14px; border:1px solid #dce9d2; background:linear-gradient(180deg, #f9fcf7, #f2f8ef); padding:1rem; margin-bottom:0.9rem; box-shadow:0 8px 18px rgba(45,80,22,0.06); }
    .agenda-side-box h3 { margin:0 0 .4rem; color:#1a1a1a; font-weight:700; font-size:1rem; font-family:'Playfair Display', 'Sora', serif; }
    .agenda-side-box p { margin:0; color:#5e6d64; font-size:0.94rem; line-height:1.55; }

    @media (max-width: 1199.98px) { .agenda-grid { grid-template-columns:1fr; } .agenda-stats { grid-template-columns:repeat(2, minmax(0,1fr)); } }
    @media (max-width: 767.98px) { .agenda-page { padding-bottom:40px; } .agenda-header .container { padding-top:34px; padding-bottom:34px; } .hero-title { font-size:2rem; } .hero-subtitle { font-size:0.97rem; line-height:1.62; } .agenda-stats { grid-template-columns:1fr; } .agenda-timeline-flow { padding-left:40px; } .step-number { width:36px; height:36px; font-size:0.95rem; } }


</style>
@endsection

@section('content')
<div class="agenda-page">
    <div class="agenda-breadcrumb py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-green);"><i class="bi bi-house-door"></i> Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="agenda-header py-5">
        <div class="container">
            <div class="hero-content-box text-center">
                <h1 class="section-title-center hero-title">Agenda Desa</h1>
                <p class="hero-subtitle">
                    Informasi lengkap jadwal kegiatan desa, layanan warga, kegiatan sosial, dan agenda rapat pemberdayaan masyarakat.
                </p>
            </div>

            <div class="agenda-stats">
                <div class="agenda-stat-card">
                    <i class="bi bi-calendar2-event" style="font-size:2rem; margin-bottom:8px; display:block; color:var(--primary-green);"></i>
                    <span class="agenda-stat-number">{{ $agendaItems->count() }}</span>
                    <span class="agenda-stat-label">Agenda Terjadwal</span>
                </div>
                <div class="agenda-stat-card">
                    <i class="bi bi-bookmark" style="font-size:2rem; margin-bottom:8px; display:block; color:var(--primary-green);"></i>
                    <span class="agenda-stat-number">4</span>
                    <span class="agenda-stat-label">Kategori Kegiatan</span>
                </div>
                <div class="agenda-stat-card">
                    <i class="bi bi-arrow-repeat" style="font-size:2rem; margin-bottom:8px; display:block; color:var(--primary-green);"></i>
                    <span class="agenda-stat-number">Berkala</span>
                    <span class="agenda-stat-label">Pembaruan Informasi</span>
                </div>
            </div>
        </div>
    </section>

    <section class="agenda-shell pt-4">
        <div class="container">
            <div class="agenda-grid">

                <!-- Left: Agenda Mendatang (announcement-style list) -->
                <section class="agenda-list">
                    <div class="head"><i class="bi bi-calendar2-event"></i><h2>Agenda Mendatang</h2></div>
                    <div class="agenda-body">
                        @foreach($agendaItems as $item)
                            <div class="agenda-list-item">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="agenda-icon" style="width:56px;height:56px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,var(--primary-green),var(--light-green));color:#fff;">
                                        <i class="bi {{ $item['icon'] }}"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                            <span class="agenda-pill">{{ $item['type'] }}</span>
                                            <span class="agenda-pill"><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($item['date'])->translatedFormat('d F Y') }}</span>
                                            <span class="agenda-pill"><i class="bi bi-clock me-1"></i>{{ $item['time'] }}</span>
                                        </div>
                                        <h3 style="margin:0 0 .5rem;color:#1a1a1a;font-weight:700;font-size:1.05rem;font-family:'Playfair Display', 'Sora', serif;">{{ $item['title'] }}</h3>
                                        <p class="summary">{{ \Illuminate\Support\Str::limit(strip_tags($item['description']), 160) }}</p>
                                        <div class="view-more">
                                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="collapse" data-bs-target="#agendaDetails{{ $loop->index }}">Lihat Selengkapnya</button>
                                        </div>
                                        <div class="collapse mt-2" id="agendaDetails{{ $loop->index }}">
                                            <div class="card card-body" style="background:#f8fdf5;border:1px solid rgba(34,139,80,0.08);">
                                                <p class="mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $item['location'] }}</p>
                                                {!! $item['description'] !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Right column: Urutan Pelaksanaan then Catatan Agenda -->
                <div class="d-grid gap-3">
                    <section class="agenda-card">
                        <div class="head"><i class="bi bi-clock-history"></i><h2>Urutan Pelaksanaan</h2></div>
                        <div class="agenda-body">
                            <div class="agenda-timeline-flow">
                                <div class="timeline-step">
                                    <span class="step-number">1</span>
                                    <div class="step-text">
                                        <h4>Persiapan Berkas</h4>
                                        <p>Siapkan KTP, KK, dan dokumen pendukung sesuai jenis perizinan yang diajukan.</p>
                                    </div>
                                </div>
                                <div class="timeline-step">
                                    <span class="step-number">2</span>
                                    <div class="step-text">
                                        <h4>Ajukan Permohonan</h4>
                                        <p>Datang langsung ke kantor desa atau ajukan melalui petugas layanan desa.</p>
                                    </div>
                                </div>
                                <div class="timeline-step">
                                    <span class="step-number">3</span>
                                    <div class="step-text">
                                        <h4>Verifikasi Data</h4>
                                        <p>Petugas memeriksa kelengkapan berkas dan melakukan validasi administrasi.</p>
                                    </div>
                                </div>
                                <div class="timeline-step">
                                    <span class="step-number">4</span>
                                    <div class="step-text">
                                        <h4>Penerbitan Surat</h4>
                                        <p>Surat izin diterbitkan dan bisa diambil sesuai jadwal yang disepakati.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="agenda-card">
                        <div class="head"><i class="bi bi-list-check"></i><h2>Catatan Agenda</h2></div>
                        <div class="agenda-body">
                            <div class="agenda-side-box"><h3>Informasi Kegiatan</h3><p>Jadwal dapat berubah menyesuaikan kondisi lapangan dan kebijakan desa.</p></div>
                            <div class="agenda-side-box"><h3>Konfirmasi Kehadiran</h3><p>Untuk agenda tertentu, warga dapat menghubungi perangkat desa atau ketua RT setempat.</p></div>
                            <div class="agenda-side-box"><h3>Agenda Berulang</h3><p>Beberapa kegiatan layanan masyarakat dilaksanakan rutin setiap minggu atau setiap bulan.</p></div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

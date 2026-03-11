@extends('layouts.app')

@section('title', 'Profil Saya - Desa Sawotratap')

@section('styles')
<style>
    /* ===========================
       PAGE WRAPPER
    =========================== */
    .pg-profile {
        padding-top: 80px;
        min-height: 100vh;
        background: #f0f4f0;
        position: relative;
        overflow: hidden;
    }

    /* Decorative background blobs */
    .pg-profile::before {
        content: '';
        position: fixed;
        top: -120px;
        right: -120px;
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(22,163,74,0.10) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }
    .pg-profile::after {
        content: '';
        position: fixed;
        bottom: -100px;
        left: -100px;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(34,197,94,0.09) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .pg-profile .inner {
        position: relative;
        z-index: 1;
        padding: 2rem 0 4rem;
    }

    /* ===========================
       FLASH ALERT
    =========================== */
    .pg-flash {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        border: 1.5px solid #86efac;
        color: #15803d;
        padding: 1rem 1.5rem;
        border-radius: 14px;
        margin-bottom: 1.75rem;
        font-weight: 600;
        box-shadow: 0 2px 12px rgba(22,163,74,0.12);
    }

    .pg-flash i { font-size: 1.3rem; }

    /* ===========================
       HERO HEADER CARD
    =========================== */
    .hero-card {
      background:
        radial-gradient(circle at top right, rgba(255,255,255,0.14), transparent 30%),
        radial-gradient(circle at bottom left, rgba(134, 239, 172, 0.16), transparent 32%),
        linear-gradient(135deg, #166534 0%, #15803d 45%, #22c55e 100%);
      border-radius: 24px;
      padding: 0;
      box-shadow: 0 18px 50px rgba(22, 101, 52, 0.22);
      overflow: hidden;
      margin-bottom: 1.75rem;
      position: relative;
      isolation: isolate;
    }

    .hero-card::before,
    .hero-card::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      filter: blur(8px);
      opacity: 0.8;
    }

    .hero-card::before {
      width: 340px;
      height: 340px;
      top: -110px;
      right: -90px;
      background: radial-gradient(circle, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0.04) 50%, transparent 72%);
    }

    .hero-card::after {
      width: 220px;
      height: 220px;
      bottom: -70px;
      left: 18%;
      background: radial-gradient(circle, rgba(134,239,172,0.22) 0%, rgba(255,255,255,0.04) 52%, transparent 74%);
    }

    .hero-pattern {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
      background-size: 28px 28px;
      mask-image: linear-gradient(135deg, rgba(0,0,0,0.08), rgba(0,0,0,0.7));
      opacity: 0.18;
      z-index: 0;
    }

    .hero-overlay {
      position: absolute;
      inset: 14px;
      border-radius: 20px;
      background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
      border: 1px solid rgba(255,255,255,0.18);
      backdrop-filter: blur(10px);
      z-index: 0;
    }

    .hero-body {
      padding: 2.35rem 2.35rem 2rem;
      position: relative;
      z-index: 1;
    }

    .hero-top {
      display: flex;
      align-items: center;
      gap: 1.75rem;
      flex-wrap: wrap;
      margin-bottom: 1.65rem;
    }

    .hero-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: linear-gradient(180deg, rgba(255,255,255,0.28), rgba(255,255,255,0.14));
      border: 5px solid rgba(255,255,255,0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 54px;
      color: white;
      flex-shrink: 0;
      box-shadow: 0 14px 34px rgba(0,0,0,0.18);
      backdrop-filter: blur(10px);
    }

    .hero-meta {
      color: white;
      flex: 1;
      min-width: 0;
    }

    .hero-meta h1 {
      font-size: 2.35rem;
      font-weight: 800;
      margin: 0 0 0.5rem;
      letter-spacing: -0.7px;
      line-height: 1.05;
      text-shadow: 0 2px 8px rgba(0,0,0,0.16);
    }

    .hero-subrows {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem 1.1rem;
      margin-bottom: 0.95rem;
    }

    .hero-meta .meta-row {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      color: rgba(255,255,255,0.92);
      font-size: 0.96rem;
      padding: 0.55rem 0.85rem;
      background: rgba(255,255,255,0.10);
      border: 1px solid rgba(255,255,255,0.14);
      border-radius: 999px;
      backdrop-filter: blur(8px);
    }

    .hero-meta .meta-row i {
      font-size: 0.95rem;
      color: #dcfce7;
    }

    .hero-badges {
      display: flex;
      flex-wrap: wrap;
      gap: 0.65rem;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      background: rgba(255,255,255,0.14);
      border: 1px solid rgba(255,255,255,0.22);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 999px;
      font-size: 0.86rem;
      font-weight: 700;
      backdrop-filter: blur(10px);
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
    }

    .hero-badge i {
      color: #dcfce7;
    }

    .hero-stats {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 1rem;
    }

    .hero-stat {
      padding: 1rem 1rem 0.95rem;
      text-align: left;
      color: white;
      border-radius: 16px;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.16);
      backdrop-filter: blur(14px);
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
      min-height: 112px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .hero-stat-icon {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255,255,255,0.16);
      border: 1px solid rgba(255,255,255,0.14);
      color: #ecfdf5;
      font-size: 1.05rem;
      margin-bottom: 0.8rem;
    }

    .hero-stat-val {
      font-size: 1.35rem;
      font-weight: 800;
      line-height: 1.15;
      text-shadow: 0 2px 6px rgba(0,0,0,0.10);
    }

    .hero-stat-lbl {
      font-size: 0.75rem;
      color: rgba(240, 253, 244, 0.86);
      margin-top: 0.3rem;
      text-transform: uppercase;
      letter-spacing: 0.55px;
      font-weight: 600;
    }

    /* ===========================
       GENERIC SECTION CARD
    =========================== */
    .sec-card {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        border: 1px solid rgba(22,163,74,0.08);
        margin-bottom: 1.5rem;
        transition: box-shadow 0.25s, transform 0.25s;
    }
    .sec-card:hover {
        box-shadow: 0 8px 28px rgba(22,163,74,0.13);
        transform: translateY(-2px);
    }

    .sec-head {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.25rem;
        border-bottom: 2px solid #f0fdf4;
    }
    .sec-head-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #16a34a;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(22,163,74,0.15);
    }
    .sec-head h2 {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 700;
        color: #15803d;
    }
    .sec-head span {
        font-size: 0.82rem;
        color: #86a390;
        display: block;
        margin-top: 1px;
    }

    /* ===========================
       INFO GRID (4 items)
    =========================== */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .info-chip {
        background: #f8fef9;
        border: 1.5px solid #d1fae5;
        border-radius: 12px;
        padding: 1rem 1.1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .info-chip:hover {
        border-color: #22c55e;
        box-shadow: 0 4px 12px rgba(22,163,74,0.10);
    }
    .info-chip-lbl {
        font-size: 0.75rem;
        font-weight: 700;
        color: #16a34a;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.45rem;
    }
    .info-chip-val {
        font-size: 1rem;
        font-weight: 600;
        color: #1a2e1e;
        word-break: break-all;
    }

    /* ===========================
       SECURITY ITEMS
    =========================== */
    .sec-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        border-radius: 12px;
        background: #f8fef9;
        border: 1.5px solid #d1fae5;
        margin-bottom: 0.75rem;
        transition: background 0.2s, border-color 0.2s;
    }
    .sec-item:last-child { margin-bottom: 0; }
    .sec-item:hover {
        background: #ecfdf5;
        border-color: #22c55e;
    }
    .sec-item-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #16a34a, #22c55e);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(22,163,74,0.25);
    }
    .sec-item-body p { margin: 0; }
    .sec-item-body .title { font-weight: 700; color: #15803d; font-size: 0.95rem; }
    .sec-item-body .desc { font-size: 0.82rem; color: #6b8c72; margin-top: 2px; }

    /* ===========================
       ACTION BUTTONS
    =========================== */
    .action-btn {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.1rem 1.3rem;
        border-radius: 14px;
        border: 2px solid transparent;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.25s ease;
        font-weight: 700;
        width: 100%;
        margin-bottom: 0.75rem;
        position: relative;
        overflow: hidden;
    }
    .action-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0.12);
        opacity: 0;
        transition: opacity 0.25s;
    }
    .action-btn:hover::before { opacity: 1; }
    .action-btn:last-child { margin-bottom: 0; }

    .action-btn-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .action-btn-text { line-height: 1.25; }
    .action-btn-text .t { font-size: 0.95rem; }
    .action-btn-text .s { font-size: 0.78rem; opacity: 0.8; display: block; font-weight: 500; }
    .action-btn i.arrow {
        margin-left: auto;
        font-size: 1.1rem;
        opacity: 0.6;
        transition: transform 0.2s;
    }
    .action-btn:hover i.arrow { transform: translateX(4px); opacity: 1; }

    /* Edit variant */
    .ab-edit {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: white;
        box-shadow: 0 6px 20px rgba(22,163,74,0.30);
    }
    .ab-edit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(22,163,74,0.38);
        color: white;
    }
    .ab-edit .action-btn-icon { background: rgba(255,255,255,0.2); color: white; }

    /* Password variant */
    .ab-pwd {
        background: white;
        color: #374151;
        border-color: #d1fae5;
        box-shadow: 0 3px 10px rgba(0,0,0,0.06);
    }
    .ab-pwd:hover {
        transform: translateY(-3px);
        border-color: #22c55e;
        box-shadow: 0 8px 20px rgba(22,163,74,0.15);
        color: #374151;
    }
    .ab-pwd .action-btn-icon { background: #dcfce7; color: #16a34a; }

    /* Logout variant */
    .ab-logout {
        background: white;
        color: #374151;
        border-color: #fecaca;
        box-shadow: 0 3px 10px rgba(0,0,0,0.06);
    }
    .ab-logout:hover {
        transform: translateY(-3px);
        border-color: #f87171;
        box-shadow: 0 8px 20px rgba(239,68,68,0.15);
        color: #374151;
    }
    .ab-logout .action-btn-icon { background: #fee2e2; color: #ef4444; }
    .ab-logout form { margin: 0; }

    /* ===========================
       TIPS LIST
    =========================== */
    .tips-list { margin: 0; padding: 0; list-style: none; }
    .tips-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0fdf4;
        font-size: 0.9rem;
        color: #374151;
        line-height: 1.5;
    }
    .tips-list li:last-child { border-bottom: none; padding-bottom: 0; }
    .tips-list .ti {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #16a34a;
        font-size: 0.8rem;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ===========================
       ACTIVITY TIMELINE
    =========================== */
    .timeline { list-style: none; padding: 0; margin: 0; }
    .tl-item {
        display: flex;
        gap: 1rem;
        padding-bottom: 1.25rem;
        position: relative;
    }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-item::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 36px;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #d1fae5, transparent);
    }
    .tl-item:last-child::before { display: none; }
    .tl-dot {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }
    .tl-dot-green { background: linear-gradient(135deg,#16a34a,#22c55e); color: white; }
    .tl-dot-blue  { background: linear-gradient(135deg,#2563eb,#3b82f6); color: white; }
    .tl-dot-amber { background: linear-gradient(135deg,#d97706,#f59e0b); color: white; }
    .tl-body { flex: 1; }
    .tl-body .tl-title { font-weight: 700; font-size: 0.92rem; color: #1a2e1e; margin: 0; }
    .tl-body .tl-desc  { font-size: 0.82rem; color: #6b8c72; margin: 2px 0 0; }
    .tl-body .tl-time  { font-size: 0.78rem; color: #9ca3af; margin-top: 4px; }

    /* ===========================
       RESPONSIVE
    =========================== */
    @media (max-width: 991px) {
      .hero-meta h1 { font-size: 1.8rem; }
      .hero-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 767px) {
      .hero-body { padding: 1.8rem 1.25rem 1.4rem; }
      .hero-overlay { inset: 10px; border-radius: 18px; }
      .hero-top { flex-direction: column; text-align: center; }
      .hero-meta h1 { font-size: 1.55rem; }
      .hero-subrows,
      .hero-badges { justify-content: center; }
      .hero-meta .meta-row { justify-content: center; }
      .info-grid { grid-template-columns: 1fr; }
      .hero-avatar { margin: 0 auto; width: 104px; height: 104px; font-size: 48px; }
      .hero-stats { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="pg-profile">
  <div class="inner">
    <div class="container">

      {{-- Flash --}}
      @if(session('success'))
      <div class="pg-flash">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
      </div>
      @endif

      {{-- ==================== HERO CARD ==================== --}}
      <div class="hero-card">
        <div class="hero-pattern"></div>
        <div class="hero-overlay"></div>
        <div class="hero-body">
          <div class="hero-top">
            {{-- Avatar --}}
            <div class="hero-avatar">
              <i class="bi bi-person-fill"></i>
            </div>

            {{-- Meta --}}
            <div class="hero-meta">
              <h1>{{ $user->name }}</h1>
              <div class="hero-subrows">
                <div class="meta-row"><i class="bi bi-envelope-fill"></i> {{ $user->email }}</div>
                <div class="meta-row"><i class="bi bi-geo-alt-fill"></i> Sawotratap, Gedangan, Sidoarjo</div>
              </div>
              <div class="hero-badges">
                <span class="hero-badge">
                  <i class="bi bi-shield-check"></i>
                  {{ ucfirst($user->role) }}
                </span>
                <span class="hero-badge">
                  <i class="bi bi-patch-check-fill"></i>
                  Aktif
                </span>
              </div>
            </div>
          </div>

          {{-- Glass Stats --}}
          <div class="hero-stats">
            <div class="hero-stat">
              <div class="hero-stat-icon"><i class="bi bi-calendar-event-fill"></i></div>
              <div class="hero-stat-val">{{ $user->created_at->format('Y') }}</div>
              <div class="hero-stat-lbl">Tahun Bergabung</div>
            </div>
            <div class="hero-stat">
              <div class="hero-stat-icon"><i class="bi bi-activity"></i></div>
              <div class="hero-stat-val">{{ (int) $user->created_at->diffInDays(now()) }}</div>
              <div class="hero-stat-lbl">Hari Aktif</div>
            </div>
            <div class="hero-stat">
              <div class="hero-stat-icon"><i class="bi bi-person-workspace"></i></div>
              <div class="hero-stat-val">{{ ucfirst($user->role) }}</div>
              <div class="hero-stat-lbl">Role</div>
            </div>
            <div class="hero-stat">
              <div class="hero-stat-icon"><i class="bi bi-patch-check-fill"></i></div>
              <div class="hero-stat-val">Valid</div>
              <div class="hero-stat-lbl">Terverifikasi</div>
            </div>
          </div>
        </div>
      </div>

      {{-- ==================== MAIN GRID ==================== --}}
      <div class="row g-4">

        {{-- ===== LEFT COLUMN ===== --}}
        <div class="col-lg-8">

          {{-- Informasi Profil --}}
          <div class="sec-card">
            <div class="sec-head">
              <div class="sec-head-icon"><i class="bi bi-person-badge-fill"></i></div>
              <div>
                <h2>Informasi Profil</h2>
                <span>Data akun Anda yang terdaftar</span>
              </div>
            </div>
            <div class="info-grid">
              <div class="info-chip">
                <div class="info-chip-lbl"><i class="bi bi-person-fill"></i> Nama Lengkap</div>
                <div class="info-chip-val">{{ $user->name }}</div>
              </div>
              <div class="info-chip">
                <div class="info-chip-lbl"><i class="bi bi-envelope-fill"></i> Email</div>
                <div class="info-chip-val">{{ $user->email }}</div>
              </div>
              <div class="info-chip">
                <div class="info-chip-lbl"><i class="bi bi-at"></i> Username</div>
                <div class="info-chip-val">{{ explode('@', $user->email)[0] }}</div>
              </div>
              <div class="info-chip">
                <div class="info-chip-lbl"><i class="bi bi-shield-fill-check"></i> Role</div>
                <div class="info-chip-val">{{ ucfirst($user->role) }}</div>
              </div>
              <div class="info-chip">
                <div class="info-chip-lbl"><i class="bi bi-calendar-event-fill"></i> Bergabung</div>
                <div class="info-chip-val">{{ $user->created_at->format('d M Y') }}</div>
              </div>
              <div class="info-chip">
                <div class="info-chip-lbl"><i class="bi bi-arrow-repeat"></i> Diperbarui</div>
                <div class="info-chip-val">{{ $user->updated_at->format('d M Y') }}</div>
              </div>
            </div>
          </div>

          {{-- Keamanan --}}
          <div class="sec-card">
            <div class="sec-head">
              <div class="sec-head-icon"><i class="bi bi-shield-lock-fill"></i></div>
              <div>
                <h2>Keamanan Akun</h2>
                <span>Status perlindungan akun Anda</span>
              </div>
            </div>
            <div class="sec-item">
              <div class="sec-item-icon"><i class="bi bi-lock-fill"></i></div>
              <div class="sec-item-body">
                <p class="title">Password Terenkripsi</p>
                <p class="desc">Password disimpan menggunakan bcrypt hash — tidak ada yang bisa membacanya</p>
              </div>
            </div>
            <div class="sec-item">
              <div class="sec-item-icon"><i class="bi bi-patch-check-fill"></i></div>
              <div class="sec-item-body">
                <p class="title">Akun Terverifikasi</p>
                <p class="desc">Akun Anda telah diverifikasi dan aktif di sistem</p>
              </div>
            </div>
            <div class="sec-item">
              <div class="sec-item-icon"><i class="bi bi-key-fill"></i></div>
              <div class="sec-item-body">
                <p class="title">Ganti Password Berkala</p>
                <p class="desc">Disarankan mengganti password setiap 3 bulan untuk keamanan optimal</p>
              </div>
            </div>
          </div>

          {{-- Timeline Aktivitas --}}
          <div class="sec-card">
            <div class="sec-head">
              <div class="sec-head-icon"><i class="bi bi-clock-history"></i></div>
              <div>
                <h2>Riwayat Aktivitas</h2>
                <span>Log aktivitas akun Anda</span>
              </div>
            </div>
            <ul class="timeline">
              <li class="tl-item">
                <div class="tl-dot tl-dot-green"><i class="bi bi-person-plus-fill"></i></div>
                <div class="tl-body">
                  <p class="tl-title">Akun dibuat</p>
                  <p class="tl-desc">Registrasi berhasil dilakukan</p>
                  <p class="tl-time">{{ $user->created_at->format('d M Y, H:i') }}</p>
                </div>
              </li>
              <li class="tl-item">
                <div class="tl-dot tl-dot-blue"><i class="bi bi-pencil-fill"></i></div>
                <div class="tl-body">
                  <p class="tl-title">Profil diperbarui</p>
                  <p class="tl-desc">Data akun terakhir diubah</p>
                  <p class="tl-time">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                </div>
              </li>
              <li class="tl-item">
                <div class="tl-dot tl-dot-amber"><i class="bi bi-box-arrow-in-right"></i></div>
                <div class="tl-body">
                  <p class="tl-title">Login sesi ini</p>
                  <p class="tl-desc">Sesi login aktif sekarang</p>
                  <p class="tl-time">{{ now()->format('d M Y, H:i') }}</p>
                </div>
              </li>
            </ul>
          </div>

        </div>{{-- /col-lg-8 --}}

        {{-- ===== RIGHT COLUMN ===== --}}
        <div class="col-lg-4">

          {{-- Aksi Cepat --}}
          <div class="sec-card">
            <div class="sec-head">
              <div class="sec-head-icon"><i class="bi bi-lightning-charge-fill"></i></div>
              <div>
                <h2>Aksi Cepat</h2>
                <span>Kelola akun Anda</span>
              </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="action-btn ab-edit">
              <div class="action-btn-icon"><i class="bi bi-pencil-square"></i></div>
              <div class="action-btn-text">
                <div class="t">Edit Profil</div>
                <span class="s">Ubah nama akun Anda</span>
              </div>
              <i class="bi bi-arrow-right arrow"></i>
            </a>

            <a href="{{ route('profile.reset-password') }}" class="action-btn ab-pwd">
              <div class="action-btn-icon"><i class="bi bi-key-fill"></i></div>
              <div class="action-btn-text">
                <div class="t">Reset Password</div>
                <span class="s">Ganti password sekarang</span>
              </div>
              <i class="bi bi-arrow-right arrow" style="color:#16a34a;"></i>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
              @csrf
              <button type="submit" class="action-btn ab-logout" style="background:white;">
                <div class="action-btn-icon"><i class="bi bi-box-arrow-right"></i></div>
                <div class="action-btn-text">
                  <div class="t">Logout</div>
                  <span class="s">Keluar dari sesi ini</span>
                </div>
                <i class="bi bi-arrow-right arrow" style="color:#ef4444;"></i>
              </button>
            </form>
          </div>

          {{-- Statistik --}}
          <div class="sec-card" style="background: linear-gradient(135deg,#f0fdf4,#dcfce7);">
            <div class="sec-head" style="border-bottom-color:#bbf7d0;">
              <div class="sec-head-icon"><i class="bi bi-bar-chart-fill"></i></div>
              <div>
                <h2>Statistik Akun</h2>
                <span>Ringkasan data Anda</span>
              </div>
            </div>
            <div class="row g-3 text-center">
              <div class="col-6">
                <div style="background:white; border-radius:12px; padding:1.2rem; box-shadow:0 2px 8px rgba(22,163,74,0.10);">
                  <div style="font-size:1.8rem; font-weight:800; color:#16a34a;">{{ (int) $user->created_at->diffInDays(now()) }}</div>
                  <div style="font-size:0.75rem; color:#6b8c72; font-weight:600; text-transform:uppercase; letter-spacing:.4px; margin-top:4px;">Hari Aktif</div>
                </div>
              </div>
              <div class="col-6">
                <div style="background:white; border-radius:12px; padding:1.2rem; box-shadow:0 2px 8px rgba(22,163,74,0.10);">
                  <div style="font-size:1.8rem; font-weight:800; color:#16a34a;">{{ $user->created_at->format('Y') }}</div>
                  <div style="font-size:0.75rem; color:#6b8c72; font-weight:600; text-transform:uppercase; letter-spacing:.4px; margin-top:4px;">Sejak Tahun</div>
                </div>
              </div>
              <div class="col-6">
                <div style="background:white; border-radius:12px; padding:1.2rem; box-shadow:0 2px 8px rgba(22,163,74,0.10);">
                  <div style="font-size:1.8rem; font-weight:800; color:#16a34a;">
                    <i class="bi bi-patch-check-fill" style="font-size:1.5rem;"></i>
                  </div>
                  <div style="font-size:0.75rem; color:#6b8c72; font-weight:600; text-transform:uppercase; letter-spacing:.4px; margin-top:4px;">Terverifikasi</div>
                </div>
              </div>
              <div class="col-6">
                <div style="background:white; border-radius:12px; padding:1.2rem; box-shadow:0 2px 8px rgba(22,163,74,0.10);">
                  <div style="font-size:1.8rem; font-weight:800; color:#16a34a;">
                    <i class="bi bi-lock-fill" style="font-size:1.5rem;"></i>
                  </div>
                  <div style="font-size:0.75rem; color:#6b8c72; font-weight:600; text-transform:uppercase; letter-spacing:.4px; margin-top:4px;">Aman</div>
                </div>
              </div>
            </div>
          </div>

          {{-- Tips Keamanan --}}
          <div class="sec-card">
            <div class="sec-head">
              <div class="sec-head-icon" style="background:linear-gradient(135deg,#fef9c3,#fef08a); color:#ca8a04;">
                <i class="bi bi-lightbulb-fill"></i>
              </div>
              <div>
                <h2 style="color:#a16207;">Tips Keamanan</h2>
                <span>Jaga akun Anda tetap aman</span>
              </div>
            </div>
            <ul class="tips-list">
              <li>
                <div class="ti"><i class="bi bi-check"></i></div>
                <span>Gunakan password minimal <strong>8 karakter</strong> kombinasi huruf dan angka</span>
              </li>
              <li>
                <div class="ti"><i class="bi bi-check"></i></div>
                <span>Jangan bagikan password kepada siapa pun, termasuk petugas</span>
              </li>
              <li>
                <div class="ti"><i class="bi bi-check"></i></div>
                <span>Selalu <strong>logout</strong> setelah selesai menggunakan perangkat umum</span>
              </li>
              <li>
                <div class="ti"><i class="bi bi-check"></i></div>
                <span>Ganti password secara <strong>berkala</strong> setiap 3 bulan</span>
              </li>
              <li>
                <div class="ti"><i class="bi bi-check"></i></div>
                <span>Waspadai email atau pesan mencurigakan yang meminta data akun</span>
              </li>
            </ul>
          </div>

        </div>{{-- /col-lg-4 --}}
      </div>{{-- /row --}}

    </div>{{-- /container --}}
  </div>{{-- /inner --}}
</div>{{-- /pg-profile --}}
@endsection

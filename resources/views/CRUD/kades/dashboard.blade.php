@extends('CRUD.layouts.kades')

@section('title', 'Dashboard Kepala Desa - Desa Sawotratap')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan statistik dan persetujuan')

@push('styles')
<style>
    .stat-card {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        padding: 1.4rem 1.5rem;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.09);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px;
        height: 100%;
        border-radius: 16px 0 0 16px;
    }
    .stat-card.sc-green::before  { background: #2d5016; }
    .stat-card.sc-teal::before   { background: #0d9488; }
    .stat-card.sc-indigo::before { background: #4f46e5; }
    .stat-card.sc-amber::before  { background: #d97706; }

    .stat-card .stat-bg-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5.5rem;
        opacity: 0.05;
        line-height: 1;
    }
    .stat-card .stat-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 0.4rem;
    }
    .stat-card .stat-value {
        font-family: 'Sora', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1;
        color: #111827;
        margin-bottom: 0.4rem;
    }
    .stat-card .stat-desc {
        font-size: 0.78rem;
        color: #6b7280;
    }
    .stat-card.sc-green  .stat-accent { color: #2d5016; }
    .stat-card.sc-teal   .stat-accent { color: #0d9488; }
    .stat-card.sc-indigo .stat-accent { color: #4f46e5; }
    .stat-card.sc-amber  .stat-accent { color: #d97706; }

    .ann-item {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 0.85rem 0;
        border-bottom: 1px dashed #e5e7eb;
    }
    .ann-item:last-child { border-bottom: none; padding-bottom: 0; }
    .ann-date-box {
        flex-shrink: 0;
        width: 46px;
        height: 50px;
        background: #f3f4f6;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .ann-date-box .day {
        font-size: 1.15rem;
        font-weight: 800;
        color: #111827;
        line-height: 1;
    }
    .ann-date-box .mon {
        font-size: 0.6rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush

@section('content')
<div class="row mb-4 g-3">
    <!-- Stat Card 1: Menunggu Persetujuan -->
    <div class="col-md-3">
        <div class="stat-card sc-amber">
            <i class="bi bi-hourglass-split stat-bg-icon stat-accent"></i>
            <div class="stat-label">Menunggu Persetujuan</div>
            <div class="stat-value">{{ $stats['surat_menunggu'] }}</div>
            <div class="stat-desc"><span class="stat-accent fw-semibold">Surat</span> perlu ditandatangani</div>
        </div>
    </div>
    <!-- Stat Card 2: Selesai Disetujui -->
    <div class="col-md-3">
        <div class="stat-card sc-green">
            <i class="bi bi-check2-all stat-bg-icon stat-accent"></i>
            <div class="stat-label">Surat Selesai</div>
            <div class="stat-value">{{ $stats['surat_selesai'] }}</div>
            <div class="stat-desc"><span class="stat-accent fw-semibold">Telah</span> disetujui & terbit</div>
        </div>
    </div>
    <!-- Stat Card 3: Total Pengajuan -->
    <div class="col-md-3">
        <div class="stat-card sc-indigo">
            <i class="bi bi-envelope-paper stat-bg-icon stat-accent"></i>
            <div class="stat-label">Total Pengajuan</div>
            <div class="stat-value">{{ $stats['total_surat'] }}</div>
            <div class="stat-desc"><span class="stat-accent fw-semibold">Semua</span> pengajuan warga</div>
        </div>
    </div>
    <!-- Stat Card 4: Total Warga -->
    <div class="col-md-3">
        <div class="stat-card sc-teal">
            <i class="bi bi-people stat-bg-icon stat-accent"></i>
            <div class="stat-label">Pengguna Warga</div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-desc"><span class="stat-accent fw-semibold">Terdaftar</span> di sistem</div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Chart -->
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="admin-card h-100">
            <div class="card-header-custom">
                <h5><i class="bi bi-pie-chart-fill me-2 text-primary"></i>Anggaran Dana Desa 2026</h5>
            </div>
            <div class="chart-container" style="position: relative; height:300px; width:100%; display: flex; align-items: center; justify-content: center;">
                <canvas id="budgetChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Announcements -->
    <div class="col-lg-4">
        <div class="admin-card h-100">
            <div class="card-header-custom">
                <h5><i class="bi bi-clock-history me-2 text-warning"></i>Pengumuman Terbaru</h5>
            </div>
            <div class="announcement-list">
                @forelse($recent_announcements->take(3) as $announcement)
                <div class="ann-item">
                    <div class="ann-date-box">
                        <span class="day">{{ $announcement->date->format('d') }}</span>
                        <span class="mon">{{ $announcement->date->format('M') }}</span>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div class="fw-bold text-dark mb-1" style="font-size: 0.88rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ Str::limit($announcement->title, 35) }}
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge rounded-pill {{ $announcement->status == 'active' ? 'bg-success' : 'bg-secondary' }}" style="font-size: 0.65rem; font-weight: 600;">
                                {{ $announcement->status == 'active' ? '● Aktif' : '● Nonaktif' }}
                            </span>
                            <small class="text-muted" style="font-size: 0.72rem;">{{ $announcement->date->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="bi bi-megaphone fs-1 text-muted opacity-25 d-block mb-2"></i>
                    <p class="text-muted mb-0 small">Belum ada pengumuman</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Surat Menunggu Kades -->
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="admin-card h-100">
            <div class="card-header-custom">
                <h5><i class="bi bi-envelope-paper-fill me-2 text-success"></i>Surat Menunggu Persetujuan</h5>
                <a href="{{ route('kades.pengajuan-surat.index') }}" class="text-decoration-none" style="font-size: 0.85rem; font-weight: 600; color: var(--sidebar-active);">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600;">Pemohon</th>
                            <th class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600;">Jenis Surat</th>
                            <th class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_surat as $surat)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $surat->nama_lengkap }}</div>
                                <small class="text-muted">{{ $surat->created_at->diffForHumans() }}</small>
                            </td>
                            <td>{{ Str::limit($surat->jenis_surat, 25) }}</td>
                            <td>
                                <span class="badge bg-{{ $surat->status_badge }}">{{ $surat->status_label }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Belum ada surat yang masuk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Pengaduan -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="card-header-custom">
                <h5><i class="bi bi-chat-left-text-fill me-2 text-danger"></i>Pengaduan Warga <span class="badge bg-light text-dark ms-2 border" style="font-size: 0.7rem; font-weight: 500;">DUMMY</span></h5>
                <a href="#" class="text-decoration-none" style="font-size: 0.85rem; font-weight: 600; color: var(--sidebar-active);">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600;">Pelapor</th>
                            <th class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600;">Aduan</th>
                            <th class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_pengaduan as $aduan)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $aduan->nama_pelapor }}</div>
                                <small class="text-muted">{{ $aduan->tanggal->diffForHumans() }}</small>
                            </td>
                            <td>
                                <div class="text-dark fw-medium">{{ Str::limit($aduan->judul, 30) }}</div>
                                <span class="badge bg-light text-dark border mt-1" style="font-weight: 500;">{{ $aduan->kategori }}</span>
                            </td>
                            <td>
                                @if($aduan->status == 'Pending')
                                    <span class="badge bg-warning text-dark border border-warning">Pending</span>
                                @elseif($aduan->status == 'Diproses')
                                    <span class="badge bg-info text-dark border border-info">Diproses</span>
                                @else
                                    <span class="badge bg-success border border-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Belum ada pengaduan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('budgetChart').getContext('2d');
        const chartData = @json($chartData);
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.data,
                    backgroundColor: [
                        '#2d5016',
                        '#4a7c24',
                        '#8ab661',
                        '#eab308',
                        '#ef4444'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: { family: 'Inter', size: 12 },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) label += ': ';
                                if (context.parsed !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed);
                                }
                                return label;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endpush

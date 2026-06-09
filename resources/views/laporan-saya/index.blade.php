@extends('layouts.app')

@section('title', 'Laporan Saya - Desa Sawotratap')

@section('styles')
<style>
    .laporan-page {
        padding: 100px 0 60px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .laporan-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .laporan-header {
        background: linear-gradient(135deg, #198754, #157347);
        padding: 30px;
        color: white;
    }

    .laporan-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .laporan-subtitle {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .laporan-body {
        padding: 0;
    }

    /* Custom Nav Tabs */
    .nav-tabs-custom {
        border-bottom: 1px solid #dee2e6;
        background: #f8f9fa;
        padding: 15px 20px 0;
    }

    .nav-tabs-custom .nav-link {
        color: #495057;
        font-weight: 600;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 12px 20px;
        transition: all 0.2s;
    }

    .nav-tabs-custom .nav-link:hover {
        color: #198754;
        background: transparent;
    }

    .nav-tabs-custom .nav-link.active {
        color: #198754;
        background: transparent;
        border-bottom: 3px solid #198754;
    }

    .tab-content {
        padding: 25px;
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .status-pending { background-color: #fff3cd; color: #856404; }
    .status-proses { background-color: #cce5ff; color: #004085; }
    .status-selesai { background-color: #d4edda; color: #155724; }
    .status-ditolak { background-color: #f8d7da; color: #721c24; }

    /* Custom Table */
    .table-custom {
        margin-bottom: 0;
    }
    .table-custom thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table-custom tbody td {
        vertical-align: middle;
        font-size: 0.9rem;
        color: #212529;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 15px;
        display: block;
    }

    /* Mobile Responsive Details */
    @media (max-width: 768px) {
        .nav-tabs-custom {
            padding: 10px 10px 0;
        }
        .nav-tabs-custom .nav-link {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
        .tab-content {
            padding: 15px;
        }
        .table-responsive {
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
    }
</style>
@endsection

@section('content')
<div class="laporan-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-11">
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="laporan-card">
                    <div class="laporan-header">
                        <h1 class="laporan-title"><i class="bi bi-file-earmark-text me-2"></i> Laporan Saya</h1>
                        <p class="laporan-subtitle mb-0">Lacak riwayat pengajuan surat, perizinan, dan pengaduan Anda di sini.</p>
                    </div>
                    
                    <div class="laporan-body">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom" id="laporanTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pengajuan-tab" data-bs-toggle="tab" data-bs-target="#pengajuan" type="button" role="tab">
                                    <i class="bi bi-envelope me-1"></i> Pengajuan Surat
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="perizinan-tab" data-bs-toggle="tab" data-bs-target="#perizinan" type="button" role="tab">
                                    <i class="bi bi-journal-text me-1"></i> Perizinan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pengaduan-tab" data-bs-toggle="tab" data-bs-target="#pengaduan" type="button" role="tab">
                                    <i class="bi bi-megaphone me-1"></i> Pengaduan
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="laporanTabsContent">
                            
                            <!-- Tab Pengajuan Surat -->
                            <div class="tab-pane fade show active" id="pengajuan" role="tabpanel">
                                @if($pengajuanSurat->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-custom table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jenis Surat</th>
                                                    <th>Keperluan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pengajuanSurat as $p)
                                                <tr>
                                                    <td>{{ $p->created_at->format('d M Y') }}</td>
                                                    <td class="fw-bold">{{ $p->jenis_surat }}</td>
                                                    <td>{{ Str::limit($p->keperluan, 30) }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $p->status_badge }}">{{ $p->status_label }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-envelope-x"></i>
                                        <p>Anda belum pernah mengajukan surat.</p>
                                        <a href="{{ route('home') }}#layanan" class="btn btn-outline-success btn-sm mt-2">Buat Pengajuan</a>
                                    </div>
                                @endif
                            </div>

                            <!-- Tab Perizinan -->
                            <div class="tab-pane fade" id="perizinan" role="tabpanel">
                                @if($perizinan->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-custom table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Nomor Izin</th>
                                                    <th>Jenis Izin</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($perizinan as $p)
                                                <tr>
                                                    <td>{{ $p->created_at->format('d M Y') }}</td>
                                                    <td>{{ $p->nomor_izin ?? '-' }}</td>
                                                    <td class="fw-bold">{{ $p->jenis_izin }}</td>
                                                    <td>
                                                        @if(in_array($p->status, ['pending', 'menunggu_admin']))
                                                            <span class="badge bg-warning text-dark">Menunggu Admin</span>
                                                        @elseif(in_array($p->status, ['menunggu_kades']))
                                                            <span class="badge bg-info">Menunggu Kades</span>
                                                        @elseif($p->status == 'disetujui')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @elseif($p->status == 'ditolak')
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ $p->status }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-journal-x"></i>
                                        <p>Anda belum pernah mengajukan perizinan.</p>
                                        <a href="{{ route('home') }}#layanan" class="btn btn-outline-success btn-sm mt-2">Buat Perizinan</a>
                                    </div>
                                @endif
                            </div>

                            <!-- Tab Pengaduan -->
                            <div class="tab-pane fade" id="pengaduan" role="tabpanel">
                                @if($pengaduan->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-custom table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tiket</th>
                                                    <th>Kategori</th>
                                                    <th>Lokasi</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pengaduan as $p)
                                                <tr>
                                                    <td>{{ $p->created_at->format('d M Y') }}</td>
                                                    <td><span class="text-muted">{{ $p->ticket }}</span></td>
                                                    <td class="fw-bold">{{ $p->kategori }}</td>
                                                    <td>{{ Str::limit($p->lokasi, 25) }}</td>
                                                    <td>
                                                        @if($p->status == 'Menunggu Verifikasi')
                                                            <span class="badge bg-warning text-dark">{{ $p->status }}</span>
                                                        @elseif($p->status == 'Diproses' || $p->status == 'Sedang Diproses')
                                                            <span class="badge bg-info">{{ $p->status }}</span>
                                                        @elseif($p->status == 'Selesai')
                                                            <span class="badge bg-success">{{ $p->status }}</span>
                                                        @elseif($p->status == 'Ditolak')
                                                            <span class="badge bg-danger">{{ $p->status }}</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ $p->status }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="bi bi-megaphone-fill text-muted" style="opacity: 0.3;"></i>
                                        <p>Anda belum pernah mengirim pengaduan infrastruktur.</p>
                                        <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-success btn-sm mt-2">Buat Pengaduan</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

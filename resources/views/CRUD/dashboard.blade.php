@extends('CRUD.layouts.admin')

@section('title', 'Dashboard Admin - Desa Sawotratap')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan statistik dan aktivitas terbaru')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="admin-card text-center">
            <div class="stat-icon mb-3" style="font-size: 2.5rem; color: var(--primary-green);">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <h3 class="mb-1" style="font-family: 'Sora', sans-serif; font-weight: 700; color: #2c3e50;">
                {{ $stats['total_announcements'] }}
            </h3>
            <p class="text-muted mb-0">Total Pengumuman</p>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="admin-card text-center">
            <div class="stat-icon mb-3" style="font-size: 2.5rem; color: #28a745;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h3 class="mb-1" style="font-family: 'Sora', sans-serif; font-weight: 700; color: #2c3e50;">
                {{ $stats['active_announcements'] }}
            </h3>
            <p class="text-muted mb-0">Pengumuman Aktif</p>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="admin-card text-center">
            <div class="stat-icon mb-3" style="font-size: 2.5rem; color: #007bff;">
                <i class="bi bi-people-fill"></i>
            </div>
            <h3 class="mb-1" style="font-family: 'Sora', sans-serif; font-weight: 700; color: #2c3e50;">
                {{ $stats['total_users'] }}
            </h3>
            <p class="text-muted mb-0">Total Pengguna</p>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="admin-card text-center">
            <div class="stat-icon mb-3" style="font-size: 2.5rem; color: #ffc107;">
                <i class="bi bi-shield-check"></i>
            </div>
            <h3 class="mb-1" style="font-family: 'Sora', sans-serif; font-weight: 700; color: #2c3e50;">
                {{ $stats['admin_users'] }}
            </h3>
            <p class="text-muted mb-0">Administrator</p>
        </div>
    </div>
</div>

<!-- Recent Announcements -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header-custom">
                <h5><i class="bi bi-clock-history me-2"></i>Pengumuman Terbaru</h5>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>

            @if($recent_announcements->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_announcements as $announcement)
                        <tr>
                            <td>
                                <strong>{{ $announcement->title }}</strong><br>
                                <small class="text-muted">{{ Str::limit($announcement->description, 80) }}</small>
                            </td>
                            <td>{{ $announcement->date->format('d M Y') }}</td>
                            <td>
                                @if($announcement->status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <h5 class="mt-3 text-muted">Belum ada pengumuman</h5>
                <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Pengumuman
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

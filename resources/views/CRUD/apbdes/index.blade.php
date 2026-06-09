@extends('CRUD.layouts.admin')

@section('title', 'Kelola APBDes - Admin')
@section('page-title', 'Kelola APBDes')
@section('page-description', 'Manajemen data transparansi Anggaran Desa')

@push('styles')
<style>
    .tbl-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.85rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.18s ease;
    }
    .tbl-action-btn.edit  { background: #fef9c3; color: #854d0e; }
    .tbl-action-btn.del   { background: #fee2e2; color: #b91c1c; }
    .tbl-action-btn:hover { transform: translateY(-2px); filter: brightness(0.92); }
    .tbl-action-btn.edit:hover { color: #854d0e; }
    .tbl-action-btn.del:hover  { color: #b91c1c; }
    .tbl-action-btn.del:disabled {
        background: #f3f4f6; color: #9ca3af; cursor: not-allowed;
        transform: none; filter: none;
    }
</style>
@endpush

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold" style="color: #152c0a;">Daftar APBDes</h5>
        <a href="{{ route('admin.apbdes.create') }}" class="btn btn-primary" style="background: #2d5016; border: none; border-radius: 10px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah APBDes
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-body p-4">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($apbdesList->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%">Tahun</th>
                        <th width="20%">Target Anggaran</th>
                        <th width="20%">Realisasi</th>
                        <th width="20%">Status Tampil</th>
                        <th width="30%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apbdesList as $apbdes)
                    <tr>
                        <td class="fw-bold">{{ $apbdes->year }}</td>
                        <td>Rp {{ number_format($apbdes->target_amount, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($apbdes->realization_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($apbdes->is_active)
                                <span class="badge bg-success px-3 py-2" style="border-radius: 8px;"><i class="bi bi-check-circle-fill me-1"></i>Aktif di Beranda</span>
                            @else
                                <form action="{{ route('admin.apbdes.activate', $apbdes) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">Set Aktif</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1 align-items-center">
                                <a href="{{ route('admin.apbdes.edit', $apbdes) }}" class="tbl-action-btn edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if(!$apbdes->is_active)
                                <form action="{{ route('admin.apbdes.destroy', $apbdes) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tbl-action-btn del" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                                @else
                                <button type="button" class="tbl-action-btn del" title="Tidak dapat dihapus karena aktif" disabled>
                                    <i class="bi bi-trash3"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $apbdesList->links('pagination::bootstrap-5') }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-bar-chart-steps text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 fw-bold text-muted">Belum ada data APBDes</h5>
            <p class="text-muted">Klik tombol "Tambah APBDes" untuk memasukkan data anggaran.</p>
        </div>
        @endif
    </div>
</div>
@endsection

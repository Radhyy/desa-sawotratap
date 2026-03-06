@extends('CRUD.layouts.admin')

@section('title', 'Kelola Pengumuman - Admin')
@section('page-title', 'Kelola Pengumuman')
@section('page-description', 'Daftar semua pengumuman desa')

@push('styles')
<style>
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .view-btn {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }
    
    .view-btn:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
        color: white;
    }
    
    .edit-btn {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
    }
    
    .edit-btn:hover {
        background: linear-gradient(135deg, #0056b3, #004085);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        color: white;
    }
    
    .delete-btn {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }
    
    .delete-btn:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }
    
    .action-btn:active {
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-megaphone me-2"></i>Daftar Pengumuman</h5>
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Pengumuman
        </a>
    </div>

    @if($announcements->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">#</th>
                    <th width="35%">Judul</th>
                    <th width="15%">Tanggal</th>
                    <th width="10%">Status</th>
                    <th width="15%">Dibuat</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $index => $announcement)
                <tr>
                    <td>{{ $announcements->firstItem() + $index }}</td>
                    <td>
                        <div class="d-flex align-items-start">
                            @if($announcement->image)
                            <img src="{{ asset('storage/' . $announcement->image) }}" 
                                 alt="{{ $announcement->title }}"
                                 class="me-3"
                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @endif
                            <div>
                                <strong class="d-block">{{ $announcement->title }}</strong>
                                <small class="text-muted">{{ Str::limit($announcement->description, 100) }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $announcement->date->format('d M Y') }}</td>
                    <td>
                        @if($announcement->status == 'active')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('announcements.show', $announcement) }}" 
                               class="action-btn view-btn" 
                               title="Lihat"
                               target="_blank">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" 
                               class="action-btn edit-btn" 
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" 
                                    class="action-btn delete-btn" 
                                    title="Hapus"
                                    onclick="confirmDelete({{ $announcement->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        
                        <!-- Delete Form -->
                        <form id="delete-form-{{ $announcement->id }}" 
                              action="{{ route('admin.announcements.destroy', $announcement) }}" 
                              method="POST" 
                              class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $announcements->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-inbox" style="font-size: 5rem; color: #ccc;"></i>
        <h4 class="mt-3 text-muted">Belum ada pengumuman</h4>
        <p class="text-muted">Mulai tambahkan pengumuman pertama Anda</p>
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle me-2"></i>Tambah Pengumuman
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush

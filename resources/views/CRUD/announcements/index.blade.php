@extends('CRUD.layouts.admin')

@section('title', 'Kelola Pengumuman - Admin')
@section('page-title', 'Kelola Pengumuman')
@section('page-description', 'Daftar semua pengumuman desa')

@push('styles')
<style>
    .tbl-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.85rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.18s ease;
    }
    .tbl-action-btn.view  { background: #e0f2fe; color: #0369a1; }
    .tbl-action-btn.edit  { background: #fef9c3; color: #854d0e; }
    .tbl-action-btn.del   { background: #fee2e2; color: #b91c1c; }
    .tbl-action-btn:hover { transform: translateY(-2px); filter: brightness(0.92); }
    .tbl-action-btn.view:hover { color: #0369a1; }
    .tbl-action-btn.edit:hover { color: #854d0e; }
    .tbl-action-btn.del:hover  { color: #b91c1c; }

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 99px;
    }
    .badge-status.active   { background: #dcfce7; color: #15803d; }
    .badge-status.inactive { background: #f1f5f9; color: #64748b; }

    thead th {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #9ca3af;
        border-bottom: 1px solid #f3f4f6 !important;
        padding-top: 0.6rem;
        padding-bottom: 0.6rem;
        background: transparent;
    }

    tbody tr {
        border-bottom: 1px solid #f9fafb;
        transition: background 0.15s;
    }
    tbody tr:hover { background: #f9fafb; }
    tbody td { vertical-align: middle; padding: 0.85rem 0.75rem; }

    .ann-thumb {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f3f4f6;
    }
    .ann-thumb-placeholder {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d1d5db;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #152c0a;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.55rem 1.2rem;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-add:hover { background: #2d5016; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(21,44,10,0.25); }

    /* Modal delete */
    .del-modal-overlay {
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 9998;
        align-items: center;
        justify-content: center;
    }
    .del-modal-overlay.show { display: flex; }
    .del-modal {
        background: #fff;
        border-radius: 18px;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .del-modal .icon-wrap {
        width: 60px; height: 60px;
        background: #fee2e2;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.6rem;
        color: #b91c1c;
    }
</style>
@endpush

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <div>
            <h5 style="font-family:'Sora',sans-serif; font-weight:700; margin:0; color:#111827;">Daftar Pengumuman</h5>
            <small class="text-muted">{{ $announcements->total() }} pengumuman tersimpan</small>
        </div>
        <a href="{{ route('admin.announcements.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Pengumuman
        </a>
    </div>

    @if($announcements->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0" style="border-collapse:separate; border-spacing:0;">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="38%">Pengumuman</th>
                    <th width="14%">Tanggal</th>
                    <th width="11%">Status</th>
                    <th width="16%">Dibuat</th>
                    <th width="17%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $index => $announcement)
                <tr>
                    <td class="text-muted" style="font-size:0.85rem;">{{ $announcements->firstItem() + $index }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($announcement->image)
                                <img src="{{ asset('storage/' . $announcement->image) }}" alt="" class="ann-thumb">
                            @else
                                <div class="ann-thumb-placeholder"><i class="bi bi-image"></i></div>
                            @endif
                            <div style="min-width:0;">
                                <div class="fw-semibold text-dark" style="font-size:0.92rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:280px;">
                                    {{ $announcement->title }}
                                </div>
                                <div class="text-muted" style="font-size:0.78rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:280px;">
                                    {{ Str::limit($announcement->description, 80) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:0.88rem; color:#374151;">{{ $announcement->date->format('d M Y') }}</td>
                    <td>
                        @if($announcement->status == 'active')
                            <span class="badge-status active"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Aktif</span>
                        @else
                            <span class="badge-status inactive"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:0.82rem; color:#6b7280;">{{ $announcement->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        <div class="d-flex gap-1 align-items-center">
                            <a href="{{ route('announcements.show', $announcement) }}"
                               class="tbl-action-btn view"
                               title="Lihat di Website"
                               target="_blank">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.announcements.edit', $announcement) }}"
                               class="tbl-action-btn edit"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button"
                                    class="tbl-action-btn del"
                                    title="Hapus"
                                    onclick="openDeleteModal({{ $announcement->id }})">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>

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

    <div class="d-flex justify-content-center mt-4">
        {{ $announcements->links() }}
    </div>

    @else
    <div class="text-center py-5">
        <div style="width:80px;height:80px;background:#f3f4f6;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
            <i class="bi bi-megaphone" style="font-size:2rem;color:#d1d5db;"></i>
        </div>
        <h5 class="fw-bold text-dark mb-1">Belum ada pengumuman</h5>
        <p class="text-muted mb-4" style="font-size:0.9rem;">Mulai tambahkan pengumuman pertama untuk website desa.</p>
        <a href="{{ route('admin.announcements.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Pengumuman
        </a>
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="del-modal-overlay" id="deleteModal">
    <div class="del-modal">
        <div class="icon-wrap"><i class="bi bi-trash3"></i></div>
        <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif;">Hapus Pengumuman?</h5>
        <p class="text-muted mb-4" style="font-size:0.9rem;">Pengumuman ini akan dihapus permanen dan tidak bisa dikembalikan.</p>
        <div class="d-flex gap-2 justify-content-center">
            <button onclick="closeDeleteModal()" class="btn btn-light fw-semibold px-4" style="border-radius:10px;">Batal</button>
            <button onclick="submitDelete()" class="btn btn-danger fw-semibold px-4" style="border-radius:10px;">Ya, Hapus</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let deleteTargetId = null;

function openDeleteModal(id) {
    deleteTargetId = id;
    document.getElementById('deleteModal').classList.add('show');
}
function closeDeleteModal() {
    deleteTargetId = null;
    document.getElementById('deleteModal').classList.remove('show');
}
function submitDelete() {
    if (deleteTargetId) {
        document.getElementById('delete-form-' + deleteTargetId).submit();
    }
}
// close on overlay click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
@endpush

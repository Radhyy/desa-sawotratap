@extends('CRUD.layouts.admin')

@section('title', 'Kelola Berita - Admin')
@section('page-title', 'Kelola Berita')
@section('page-description', 'Daftar semua berita desa')

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
    .tbl-action-btn.view  { background: #e0f2fe; color: #0369a1; }
    .tbl-action-btn.edit  { background: #fef9c3; color: #854d0e; }
    .tbl-action-btn.del   { background: #fee2e2; color: #b91c1c; }
    .tbl-action-btn:hover { transform: translateY(-2px); filter: brightness(0.92); }
    .tbl-action-btn.view:hover { color: #0369a1; }
    .tbl-action-btn.edit:hover { color: #854d0e; }
    .tbl-action-btn.del:hover  { color: #b91c1c; }

    .badge-cat {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 99px;
        background: #f0fdf4;
        color: #15803d;
        letter-spacing: 0.3px;
    }
    .badge-trending {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 0.68rem; font-weight: 700;
        padding: 2px 8px; border-radius: 99px;
        background: #fff7ed; color: #c2410c;
    }

    thead th {
        font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.8px; text-transform: uppercase;
        color: #9ca3af;
        border-bottom: 1px solid #f3f4f6 !important;
        padding-top: 0.6rem; padding-bottom: 0.6rem;
        background: transparent;
    }
    tbody tr { border-bottom: 1px solid #f9fafb; transition: background 0.15s; }
    tbody tr:hover { background: #f9fafb; }
    tbody td { vertical-align: middle; padding: 0.8rem 0.75rem; }

    .news-thumb {
        width: 52px; height: 52px;
        border-radius: 10px; object-fit: cover; flex-shrink: 0;
    }
    .news-thumb-placeholder {
        width: 52px; height: 52px;
        border-radius: 10px; background: #f3f4f6;
        display: flex; align-items: center; justify-content: center;
        color: #d1d5db; font-size: 1.3rem; flex-shrink: 0;
    }

    .btn-add {
        display: inline-flex; align-items: center; gap: 8px;
        background: #152c0a; color: #fff;
        border: none; border-radius: 10px;
        padding: 0.55rem 1.2rem;
        font-weight: 600; font-size: 0.9rem;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-add:hover { background: #2d5016; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(21,44,10,0.25); }

    .del-modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.45); z-index: 9998;
        align-items: center; justify-content: center;
    }
    .del-modal-overlay.show { display: flex; }
    .del-modal {
        background: #fff; border-radius: 18px; padding: 2rem;
        max-width: 400px; width: 90%; text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .del-modal .icon-wrap {
        width: 60px; height: 60px; background: #fee2e2; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem; font-size: 1.6rem; color: #b91c1c;
    }
</style>
@endpush

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <div>
            <h5 style="font-family:'Sora',sans-serif; font-weight:700; margin:0; color:#111827;">Daftar Berita</h5>
            <small class="text-muted">{{ $beritas->total() }} berita tersimpan</small>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Berita
        </a>
    </div>

    @if($beritas->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0" style="border-collapse:separate; border-spacing:0;">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="36%">Berita</th>
                    <th width="13%">Kategori</th>
                    <th width="12%">Tanggal</th>
                    <th width="10%">Penulis</th>
                    <th width="8%">Views</th>
                    <th width="17%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beritas as $index => $berita)
                <tr>
                    <td class="text-muted" style="font-size:0.85rem;">{{ $beritas->firstItem() + $index }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($berita->image)
                                <img src="{{ Str::startsWith($berita->image, ['http://', 'https://']) ? $berita->image : asset('storage/' . $berita->image) }}" alt="" class="news-thumb">
                            @else
                                <div class="news-thumb-placeholder"><i class="bi bi-newspaper"></i></div>
                            @endif
                            <div style="min-width:0;">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <div class="fw-semibold text-dark" style="font-size:0.9rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:240px;">
                                        {{ $berita->title }}
                                    </div>
                                    @if($berita->trending)
                                        <span class="badge-trending"><i class="bi bi-fire"></i> Trending</span>
                                    @endif
                                </div>
                                <div class="text-muted" style="font-size:0.78rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:270px;">
                                    {{ Str::limit($berita->excerpt, 75) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge-cat">{{ $berita->category }}</span></td>
                    <td style="font-size:0.85rem; color:#374151;">{{ $berita->date->format('d M Y') }}</td>
                    <td style="font-size:0.83rem; color:#6b7280;">{{ $berita->author }}</td>
                    <td style="font-size:0.85rem; color:#374151;">{{ number_format($berita->views) }}</td>
                    <td>
                        <div class="d-flex gap-1 align-items-center">
                            <a href="{{ route('berita.show', $berita->id) }}"
                               class="tbl-action-btn view"
                               title="Lihat di Website"
                               target="_blank">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.berita.edit', $berita) }}"
                               class="tbl-action-btn edit"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button"
                                    class="tbl-action-btn del"
                                    title="Hapus"
                                    onclick="openDeleteModal({{ $berita->id }}, '{{ addslashes(Str::limit($berita->title, 50)) }}')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                        <form id="delete-form-{{ $berita->id }}"
                              action="{{ route('admin.berita.destroy', $berita) }}"
                              method="POST" class="d-none">
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
        {{ $beritas->links() }}
    </div>

    @else
    <div class="text-center py-5">
        <div style="width:80px;height:80px;background:#f3f4f6;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
            <i class="bi bi-newspaper" style="font-size:2rem;color:#d1d5db;"></i>
        </div>
        <h5 class="fw-bold text-dark mb-1">Belum ada berita</h5>
        <p class="text-muted mb-4" style="font-size:0.9rem;">Mulai tulis berita pertama untuk website desa.</p>
        <a href="{{ route('admin.berita.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Berita
        </a>
    </div>
    @endif
</div>

<!-- Delete Modal -->
<div class="del-modal-overlay" id="deleteModal">
    <div class="del-modal">
        <div class="icon-wrap"><i class="bi bi-trash3"></i></div>
        <h5 class="fw-bold mb-1" style="font-family:'Sora',sans-serif;">Hapus Berita?</h5>
        <p class="text-muted mb-1" style="font-size:0.9rem;">Anda akan menghapus:</p>
        <p class="fw-semibold text-dark mb-4" id="deleteModalTitle" style="font-size:0.87rem;"></p>
        <p class="text-muted mb-4" style="font-size:0.82rem;">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
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

function openDeleteModal(id, title) {
    deleteTargetId = id;
    document.getElementById('deleteModalTitle').textContent = '\u201c' + title + '\u201d';
    document.getElementById('deleteModal').classList.add('show');
}
function closeDeleteModal() {
    deleteTargetId = null;
    document.getElementById('deleteModal').classList.remove('show');
}
function submitDelete() {
    if (deleteTargetId) document.getElementById('delete-form-' + deleteTargetId).submit();
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
@endpush

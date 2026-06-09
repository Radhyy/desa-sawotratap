@extends('CRUD.layouts.admin')

@section('title', 'Manajemen Pengguna - Admin Desa Sawotratap')
@section('page-title', 'Kelola Pengguna')
@section('page-description', 'Daftar semua pengguna sistem')

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
    .badge-status.kades   { background: #dcfce7; color: #15803d; }
    .badge-status.admin { background: #fee2e2; color: #b91c1c; }
    .badge-status.warga { background: #e0f2fe; color: #0369a1; }

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
</style>
@endpush
@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <div>
            <h5 style="font-family:'Sora',sans-serif; font-weight:700; margin:0; color:#111827;">Daftar Pengguna</h5>
            <small class="text-muted">{{ count($users) }} pengguna terdaftar</small>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive mt-3">
        <table class="table mb-0" style="border-collapse:separate; border-spacing:0;">
            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 35px; height: 35px; background: #e5e7eb; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-person text-secondary"></i>
                                        </div>
                                        <span class="fw-bold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge-status admin"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Admin</span>
                                    @elseif($user->role == 'kades')
                                        <span class="badge-status kades"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Kades</span>
                                    @else
                                        <span class="badge-status warga"><i class="bi bi-circle-fill" style="font-size:0.4rem;"></i> Warga</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center align-items-center">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="tbl-action-btn edit" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                        <button type="button" class="tbl-action-btn del" onclick="confirmDelete({{ $user->id }})" title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada data pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus pengguna ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary ms-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection

@extends('CRUD.layouts.admin')

@section('title', 'Kategori UMKM - Desa Sawotratap')
@section('page-title', 'Kategori UMKM')
@section('page-description', 'Kelola daftar kategori untuk produk UMKM')

@section('content')
<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2d5016;">Daftar Kategori UMKM</h5>
        <a href="{{ route('admin.kategori-umkm.create') }}" class="btn" style="background: #2d5016; color: white; border-radius: 8px; padding: 8px 16px;">
            <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" width="50">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col" class="text-center" width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ $kategori->name }}</td>
                    <td>
                        <span class="badge bg-info">{{ $kategori->umkm_count }} Produk</span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.kategori-umkm.edit', $kategori->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $kategori->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $kategori->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        Apakah Anda yakin ingin menghapus kategori <strong>{{ $kategori->name }}</strong>?
                                        @if($kategori->umkm_count > 0)
                                        <div class="alert alert-warning mt-2 mb-0">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Kategori ini memiliki {{ $kategori->umkm_count }} produk. Anda tidak bisa menghapusnya sebelum memindahkan produk ke kategori lain.
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        @if($kategori->umkm_count == 0)
                                        <form action="{{ route('admin.kategori-umkm.destroy', $kategori->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </form>
                                        @else
                                        <button type="button" class="btn btn-danger" disabled>Ya, Hapus</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada data Kategori UMKM.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

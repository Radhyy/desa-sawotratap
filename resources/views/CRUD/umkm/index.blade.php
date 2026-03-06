@extends('CRUD.layouts.admin')

@section('title', 'Kelola UMKM - Admin')
@section('page-title', 'Kelola UMKM')
@section('page-description', 'Daftar semua produk UMKM desa')

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
    
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    /* Pagination Styles */
    .pagination {
        gap: 6px;
    }
    
    .pagination .page-item .page-link {
        border: 1px solid #dee2e6;
        color: #2d5016;
        border-radius: 8px;
        padding: 8px 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 0 2px;
    }
    
    .pagination .page-item .page-link:hover {
        background: #2d5016;
        color: white;
        border-color: #2d5016;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(45, 80, 22, 0.3);
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #2d5016, #3d6b1f);
        border-color: #2d5016;
        color: white;
        box-shadow: 0 4px 8px rgba(45, 80, 22, 0.3);
    }
    
    .pagination .page-item.disabled .page-link {
        background: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-shop me-2"></i>Daftar Produk UMKM</h5>
        <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>

    @if($umkm->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">#</th>
                    <th width="30%">Produk</th>
                    <th width="10%">Kategori</th>
                    <th width="12%">Harga</th>
                    <th width="15%">Penjual</th>
                    <th width="8%">Stok</th>
                    <th width="10%">Status</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($umkm as $index => $product)
                <tr>
                    <td>{{ $umkm->firstItem() + $index }}</td>
                    <td>
                        <div class="d-flex align-items-start">
                            @if($product->image)
                                @if(str_starts_with($product->image, 'http'))
                                <img src="{{ $product->image }}" 
                                     alt="{{ $product->name }}"
                                     class="me-3 product-image">
                                @else
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="me-3 product-image">
                                @endif
                            @else
                            <div class="me-3 product-image bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                            @endif
                            <div>
                                <strong class="d-block">{{ $product->name }}</strong>
                                <small class="text-muted">{{ Str::limit($product->description, 60) }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($product->category == 'Kuliner')
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-cup-hot me-1"></i>{{ $product->category }}
                            </span>
                        @else
                            <span class="badge bg-info">
                                <i class="bi bi-hammer me-1"></i>{{ $product->category }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                    </td>
                    <td>
                        <small class="text-muted">
                            <i class="bi bi-person-circle me-1"></i>{{ $product->seller }}
                        </small>
                    </td>
                    <td>
                        @if($product->stock > 0)
                            <span class="badge bg-success">{{ $product->stock }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td>
                        @if($product->status == 'active')
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Aktif</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('umkm.show', $product->id) }}" 
                               class="action-btn view-btn" 
                               title="Lihat"
                               target="_blank">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.umkm.edit', $product) }}" 
                               class="action-btn edit-btn" 
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" 
                                    class="action-btn delete-btn" 
                                    title="Hapus"
                                    onclick="confirmDelete({{ $product->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        
                        <!-- Delete Form -->
                        <form id="delete-form-{{ $product->id }}" 
                              action="{{ route('admin.umkm.destroy', $product) }}" 
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
        {{ $umkm->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-inbox" style="font-size: 5rem; color: #ccc;"></i>
        <h4 class="mt-3 text-muted">Belum ada produk UMKM</h4>
        <p class="text-muted">Mulai tambahkan produk UMKM pertama Anda</p>
        <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush

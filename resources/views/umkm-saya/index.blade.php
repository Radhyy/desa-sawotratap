@extends('layouts.app')

@section('title', 'Produk UMKM Saya - Desa Sawotratap')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(45,80,22,0.9), rgba(45,80,22,0.8)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?w=1600&q=80') center/cover;
        padding: 100px 0 60px;
        color: white;
        margin-bottom: -40px;
    }

    .main-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        border: none;
        position: relative;
        z-index: 10;
        margin-bottom: 50px;
        padding: 30px;
    }

    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="fw-bold mb-2" style="font-family: 'Playfair Display', serif;">Produk UMKM Saya</h1>
        <p class="lead opacity-75 mb-0">Kelola daftar produk jualan Anda yang terdaftar di sistem Desa Sawotratap</p>
    </div>
</div>

<div class="container">
    <div class="main-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0" style="color: #2d5016;"><i class="bi bi-box-seam me-2"></i>Daftar Produk Anda</h5>
            <a href="{{ route('umkm.create') }}" class="btn btn-success" style="background: #2d5016; border: none; border-radius: 10px;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>



        @if($umkmSaya->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="35%">Detail Produk</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Harga</th>
                        <th width="15%">Status Persetujuan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($umkmSaya as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($item->image)
                                    <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image) }}" alt="{{ $item->name }}" class="product-img me-3">
                                @else
                                    <div class="product-img bg-light me-3 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted fs-4"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $item->name }}</h6>
                                    <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $item->seller }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $item->kategori->name ?? '-' }}</span>
                        </td>
                        <td class="fw-semibold">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td>
                            @if($item->approval_status == 'pending')
                                <span class="badge bg-warning text-dark status-badge"><i class="bi bi-hourglass-split me-1"></i>Menunggu</span>
                            @elseif($item->approval_status == 'approved')
                                <span class="badge bg-success status-badge"><i class="bi bi-check-circle-fill me-1"></i>Disetujui</span>
                            @else
                                <span class="badge bg-danger status-badge"><i class="bi bi-x-circle-fill me-1"></i>Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('umkm-saya.edit', $item->id) }}" class="btn btn-primary btn-action" title="Edit Produk">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('umkm-saya.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action" title="Hapus Produk">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-shop text-muted" style="font-size: 4rem;"></i>
            <h5 class="mt-3 fw-bold text-muted">Belum Ada Produk</h5>
            <p class="text-muted mb-4">Anda belum menambahkan satupun produk UMKM.</p>
            <a href="{{ route('umkm.create') }}" class="btn btn-outline-success" style="border-radius: 10px; font-weight: 600;">
                Daftarkan Produk Pertama Anda
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

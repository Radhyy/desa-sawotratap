@extends('layouts.app')

@section('title', 'Edit Produk UMKM - Desa Sawotratap')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, rgba(45,80,22,0.9), rgba(45,80,22,0.8)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?w=1600&q=80') center/cover;
        padding: 100px 0 60px;
        color: white;
        margin-bottom: -40px;
    }

    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        padding: 40px;
        border: none;
        position: relative;
        z-index: 10;
        margin-bottom: 50px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1.5px solid #e5e7eb;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2d5016;
        box-shadow: 0 0 0 4px rgba(45,80,22,0.1);
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .btn-submit {
        background: #2d5016;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        border: none;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        background: #1e360f;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(45,80,22,0.2);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="fw-bold mb-2" style="font-family: 'Playfair Display', serif;">Edit Produk Anda</h1>
        <p class="lead opacity-75 mb-0">Perbarui informasi produk UMKM Anda</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <h5 class="fw-bold mb-0" style="color: #2d5016;"><i class="bi bi-pencil-square me-2"></i>Form Edit Produk</h5>
                    <a href="{{ route('umkm-saya.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                @if($errors->any())
                <div class="alert alert-danger mb-4 rounded-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="alert alert-warning mb-4 rounded-3 d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-warning"></i>
                    <div>
                        <strong>Perhatian:</strong> Menyimpan perubahan pada produk akan mengembalikan status persetujuan menjadi <strong>Menunggu (Pending)</strong> agar Admin dapat meninjaunya ulang.
                    </div>
                </div>

                <form action="{{ route('umkm-saya.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $umkm->name) }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="kategori_umkm_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="kategori_umkm_id" name="kategori_umkm_id" required>
                                @foreach($kategori_umkms as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_umkm_id', $umkm->kategori_umkm_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $umkm->price) }}" min="0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Produk <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $umkm->description) }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label for="image" class="form-label">Foto Produk Baru <span class="text-muted">(Opsional, Maks. 2MB)</span></label>
                            @if($umkm->image)
                            <div class="mb-2 d-flex align-items-center bg-light p-2 rounded">
                                <img src="{{ str_starts_with($umkm->image, 'http') ? $umkm->image : asset('storage/'.$umkm->image) }}" alt="Current Image" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto saat ini.</small>
                            </div>
                            @endif
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stok Produk <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $umkm->stock) }}" min="0" required>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 mt-4 text-muted">Informasi Penjual</h6>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="seller" class="form-label">Nama Toko / Penjual <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="seller" name="seller" value="{{ old('seller', $umkm->seller) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $umkm->phone) }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="location" name="location" rows="2" required>{{ old('location', $umkm->location) }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

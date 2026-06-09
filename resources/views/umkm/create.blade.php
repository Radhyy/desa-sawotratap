@extends('layouts.app')

@section('title', 'Daftar UMKM - Desa Sawotratap')

@section('styles')
<style>
    .hero-mini {
        background: linear-gradient(135deg, rgba(45,80,22,0.9), rgba(45,80,22,0.7)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?w=1600&q=80') center/cover;
        padding: 140px 0 100px;
        color: white;
        text-align: center;
        margin-bottom: -60px;
    }

    .form-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.1);
        padding: 40px;
        border: none;
        position: relative;
        z-index: 10;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e5e7eb;
        font-size: 1rem;
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
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
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
<div class="hero-mini">
    <div class="container">
        <h1 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Daftarkan UMKM</h1>
        <p class="lead mb-0 opacity-75">Ajukan produk Anda untuk dipromosikan di website resmi Desa Sawotratap</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">


                @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="fw-bold mb-4" style="color: #2d5016; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Informasi Produk</h5>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Keripik Singkong Balado" required>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label for="kategori_umkm_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="kategori_umkm_id" name="kategori_umkm_id" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($kategori_umkms as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_umkm_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Contoh: 15000" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Deskripsi Produk <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Ceritakan tentang produk Anda secara menarik..." required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label for="image" class="form-label">Foto Produk <span class="text-muted">(Maks. 2MB)</span></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stok Produk <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', 1) }}" min="0" required>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 mt-5" style="color: #2d5016; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Informasi Penjual</h5>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label for="seller" class="form-label">Nama Toko / Penjual <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="seller" name="seller" value="{{ old('seller', auth()->user()->name ?? '') }}" placeholder="Nama Anda atau toko Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="location" class="form-label">Alamat Lengkap / Lokasi Penjualan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="location" name="location" rows="2" placeholder="Contoh: Jl. Mangga No. 5, RT 01 RW 02, Desa Sawotratap" required>{{ old('location') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">Kirim Pengajuan UMKM</button>
                    <p class="text-center text-muted mt-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i> Setelah dikirim, data akan ditinjau oleh Admin Desa terlebih dahulu sebelum ditampilkan.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

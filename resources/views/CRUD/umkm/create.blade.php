@extends('CRUD.layouts.admin')

@section('title', 'Tambah Produk UMKM - Admin')
@section('page-title', 'Tambah Produk UMKM')
@section('page-description', 'Tambahkan produk UMKM baru ke katalog')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card">
            <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="Contoh: Kerupuk Udang"
                            required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="category" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" 
                                name="category" 
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="Kuliner" {{ old('category') == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="Kerajinan" {{ old('category') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="price" class="form-label fw-bold">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" 
                                class="form-control @error('price') is-invalid @enderror" 
                                id="price" 
                                name="price" 
                                value="{{ old('price') }}"
                                placeholder="50000"
                                min="0"
                                required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Deskripsi Produk <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="4"
                                placeholder="Jelaskan detail produk, bahan, ukuran, dll"
                                required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="seller" class="form-label fw-bold">Nama Penjual <span class="text-danger">*</span></label>
                        <input type="text" 
                                class="form-control @error('seller') is-invalid @enderror" 
                                id="seller" 
                                name="seller" 
                                value="{{ old('seller') }}"
                                placeholder="Contoh: Ibu Siti"
                                required>
                        @error('seller')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="location" class="form-label fw-bold">Lokasi/Alamat <span class="text-danger">*</span></label>
                        <input type="text" 
                                class="form-control @error('location') is-invalid @enderror" 
                                id="location" 
                                name="location" 
                                value="{{ old('location') }}"
                                placeholder="Contoh: Dusun Krajan"
                                required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="stock" class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                        <input type="number" 
                                class="form-control @error('stock') is-invalid @enderror" 
                                id="stock" 
                                name="stock" 
                                value="{{ old('stock') }}"
                                placeholder="100"
                                min="0"
                                required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="phone" class="form-label fw-bold">Nomor WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                placeholder="628123456789"
                                required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: 628xxxxxxxxxx (tanpa +)</small>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold">Foto Produk</label>
                    <input type="file" 
                            class="form-control @error('image') is-invalid @enderror" 
                            id="image" 
                            name="image"
                            accept="image/*"
                            onchange="previewImage(this)">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <img id="preview" src="" alt="Preview" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" 
                            name="status" 
                            required>
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Produk
                    </button>
                    <a href="{{ route('admin.umkm.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Panduan</h6>
            <ul class="list-unstyled small">
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Nama produk harus jelas dan menarik
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Pilih kategori yang sesuai
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Harga dalam Rupiah (tanpa titik/koma)
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Deskripsi detail membantu penjualan
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Foto produk berkualitas lebih menarik
                </li>
                <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    WhatsApp untuk pemesanan langsung
                </li>
            </ul>
        </div>

        <div class="admin-card mt-3">
            <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2"></i>Tips</h6>
            <ul class="list-unstyled small text-muted">
                <li class="mb-2">📸 Gunakan foto dengan pencahayaan baik</li>
                <li class="mb-2">📱 Pastikan nomor WhatsApp aktif</li>
                <li class="mb-2">📦 Update stok secara berkala</li>
                <li class="mb-2">💰 Harga kompetitif menarik pembeli</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('preview').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

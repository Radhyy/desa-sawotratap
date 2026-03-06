@extends('CRUD.layouts.admin')

@section('title', 'Edit Produk UMKM - Admin')
@section('page-title', 'Edit Produk UMKM')
@section('page-description', 'Perbarui informasi produk UMKM')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card">
            <form action="{{ route('admin.umkm.update', $umkm) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $umkm->name) }}"
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
                            <option value="Kuliner" {{ old('category', $umkm->category) == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="Kerajinan" {{ old('category', $umkm->category) == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
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
                                value="{{ old('price', $umkm->price) }}"
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
                                required>{{ old('description', $umkm->description) }}</textarea>
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
                                value="{{ old('seller', $umkm->seller) }}"
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
                                value="{{ old('location', $umkm->location) }}"
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
                                value="{{ old('stock', $umkm->stock) }}"
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
                                value="{{ old('phone', $umkm->phone) }}"
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
                    
                    @if($umkm->image)
                    <div class="mb-3">
                        <p class="small text-muted mb-2">Foto saat ini:</p>
                        @if(str_starts_with($umkm->image, 'http'))
                        <img src="{{ $umkm->image }}" 
                                alt="{{ $umkm->name }}"
                                style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        @else
                        <img src="{{ asset('storage/' . $umkm->image) }}" 
                                alt="{{ $umkm->name }}"
                                style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        @endif
                    </div>
                    @endif
                    
                    <input type="file" 
                            class="form-control @error('image') is-invalid @enderror" 
                            id="image" 
                            name="image"
                            accept="image/*"
                            onchange="previewImage(this)">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. {{ $umkm->image ? 'Kosongkan jika tidak ingin mengubah foto.' : '' }}</small>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <p class="small text-muted mb-2">Preview foto baru:</p>
                        <img id="preview" src="" alt="Preview" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" 
                            name="status" 
                            required>
                        <option value="active" {{ old('status', $umkm->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $umkm->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Perbarui Produk
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
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Informasi</h6>
            <ul class="list-unstyled small">
                <li class="mb-2">
                    <strong>Dibuat:</strong><br>
                    {{ $umkm->created_at->format('d M Y H:i') }}
                </li>
                <li class="mb-2">
                    <strong>Terakhir diubah:</strong><br>
                    {{ $umkm->updated_at->format('d M Y H:i') }}
                </li>
                <li class="mb-2">
                    <strong>ID:</strong> {{ $umkm->id }}
                </li>
            </ul>
            
            <hr>
            
            <div class="d-grid">
                <a href="{{ route('umkm.show', $umkm->id) }}" 
                    class="btn btn-outline-info btn-sm mb-2"
                    target="_blank">
                    <i class="bi bi-eye me-2"></i>Lihat di Website
                </a>
                <button type="button" 
                        class="btn btn-outline-danger btn-sm"
                        onclick="confirmDelete()">
                    <i class="bi bi-trash me-2"></i>Hapus Produk
                </button>
            </div>
        </div>

        <div class="admin-card mt-3">
            <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2"></i>Tips</h6>
            <ul class="list-unstyled small text-muted">
                <li class="mb-2">📸 Upload foto berkualitas baik</li>
                <li class="mb-2">📱 Pastikan nomor WhatsApp aktif</li>
                <li class="mb-2">📦 Update stok secara berkala</li>
                <li class="mb-2">💰 Sesuaikan harga dengan pasar</li>
            </ul>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" 
        action="{{ route('admin.umkm.destroy', $umkm) }}" 
        method="POST" 
        class="d-none">
    @csrf
    @method('DELETE')
</form>
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

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush
